<?php

namespace App\Http\Controllers;
use App\Cart;
use App\Coupon;
use App\Currency;
use App\Generalsetting;
use App\Notification;
use App\Order;
use App\Product;

use App\Prescriptionfile;
use App\PrescriptionfileOrder;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutValidationRequest;
use App\PaymentGateway;
use App\Mail\CustomerInvoice;
use App\Mail\BankPayment;
use Mail;
use Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Redirect;
use Carbon\Carbon;
use App\Classes\GeniusMailer;
use App\Classes\MyIpay;
use App\PrescriptionfilePrescription;
use App\CouponCheck;


class PaymentController extends Controller
{

    public function store(CheckoutValidationRequest $request)
    {
    //    dd($request);

        // $this->validate($request, [
        //     'filename' => 'required',
        //     'filename.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
        // ]);

        // dd(Session::get('cart'));

        if (!Session::has('cart')) {
            return redirect()->route('front.cart')->with('success',"You don't have any product to checkout.");
        }
        if (Session::has('currency'))
        {
            $curr = Currency::find(Session::get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

        $gs = Generalsetting::findOrFail(1);

        $oldCart = Session::get('cart');
        // dd($oldcart);

        $family = $request->family_ids;
        $user = Auth::guard('user')->user();



        if($user && $family){
            $validator = \Validator::make($family,[
                '*.*' => 'nullable|exists:families,id,user_id,'.$user->id
            ]);

            if($validator->fails()){
                return redirect()->back()->withInput()->with('unsuccess','Invalid Family Members');
            }
            foreach($family as $id=>$f){
                $oldCart->updateFamily($id,$f);
            }
        }

        $cart = new Cart($oldCart);

        // Session::put('cart',$cart);

        $total = $cart->totalPrice;
        $coupon = null;
        $shipping_cost = 0;
        $tax = 0;

        if (Session::has('already')) {
            $coupon = Session::get('already');
            $total -= $coupon->discount;
            if($total < 0) $total = 0;
        }

        if(!self::CheckAvailability($oldCart->items,$coupon ? $coupon->code : null))
            return redirect()->route('front.cart')->with('error',Session::get('error'));

        if (Session::has('shipping') && $request->shipping == 'shipto') {
            $shipping_cost = Session::get('shipping');
            $total += $shipping_cost;
        }

        if($gs->tax != 0)
        {
            $tax = ($total / 100) * $gs->tax;
            $total = $total + $tax;
        }

        $order = new Order;
        $item_name = $gs->title." Order";
        $item_number = str_random(4).time();
        $order['user_id'] = Auth::guard('user')->check() ? Auth::guard('user')->user()->id : 0;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $cart->totalQty;
        $order['pay_amount'] = round($total, 2);
        $order['method'] = "Cash On Delivery";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['shipping_cost'] = $shipping_cost;
        $order['tax'] = $tax;
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_latlong'] = $request->latlong;
        // $order['customer_landmark'] = $request->landmark;
        $order['customer_address_type'] = $request->address_type;
        $order['customer_pan_number'] = $request->pan_number;
        $order['customer_country'] = $request->customer_country;
        // $order['customer_city'] = $request->city;
        // $order['customer_zip'] = $request->zip;
        $order['shipping_email'] = $request->shipping_email;
        $order['shipping_name'] = $request->shipping_name;
        $order['shipping_phone'] = $request->shipping_phone;
        $order['shipping_address'] = $request->shipping_address;
        $order['shipping_address'] = $request->shipping_latlong;
        $order['shipping_country'] = $request->shipping_country;
        // $order['shipping_city'] = $request->shipping_city;
        // $order['shipping_zip'] = $request->shipping_zip;
        // $order['shipping_landmark'] = $request->shipping_landmark;
        $order['shipping_address_type'] = $request->shipping_address_type;
        $order['shipping_pan_number'] = $request->shipping_pan_number;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $coupon ? $coupon->code : null;
        $order['coupon_discount'] = $coupon ? $coupon->discount : null;
        $order['dp'] = $request->dp;
        $order['payment_status'] = "pending";
        $order['status'] = "pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;



        if (Session::has('affilate'))
        {
            $val = $total / 100;
            $sub = $val * $gs->affilate_charge;
            $user = User::findOrFail(Session::get('affilate'));
            $user->affilate_income = $sub;
            $user->update();
            $order['affilate_user'] = $user->name;
            $order['affilate_charge'] = $sub;
        }
        $order->save();
        // dd($request->filename);

        if($request->has('fileid')){
            foreach ($request->fileid as $fid){

            $pid = new PrescriptionfileOrder;

            $pid->order_id = $order->id;
            $pid->prescriptionfile_id = $fid;
            $pid->save();
            }

        }


        if($request->hasFile('filenames')){
            foreach ($request->filenames as $reg_certificate_file){


                $filenameWithExt = $reg_certificate_file->getClientOriginalName();
                $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

                $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
                $path = $reg_certificate_file->storeAs('public/prescriptions', $filename);


            $prescription_image = new Prescriptionfile;
            $prescription_image->file = $filename;

            if($prescription_image->user_id){
            $prescription_image->user_id = $user->id;
            }

            $prescription_image->save();

            $poid = new PrescriptionfileOrder;
            $poid->order_id = $order->id;
            $poid->prescriptionfile_id = $prescription_image->id;
            $poid->save();

            }
        }




        return redirect()->route('payment.pay', $order->order_number);
    }

    public function payment($order_number){
   
        if (Session::has('gateway')) {
            Session::forget('gateway');
        }
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();

        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        if(!self::CheckAvailability($cart->items, $order->coupon_code))
            return redirect()->route('front.cart')->with('error',Session::get('error'));

        $gateways =  PaymentGateway::where('status','=',1)->get();

        foreach($gateways as $pay){
            $pay->discount = 0;

            if($pay->discount_value){

                $total = $order->pay_amount;
                if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                    if($pay->discount_type === 0)
                    {
                        $price = (int)$pay->discount_value;
                        $val = $total / 100;
                        $sub = round($val * $price, 2);
                        $total = $total - $sub;

                        $pay->discount_text = $price."% off";

                        $pay->discount = $sub;
                    }
                    else{
                        if($total < $pay->discount_value)
                            $sub = $total;
                        else
                            $sub = $pay->discount_value;

                        $total = $total - $sub;

                        $pay->discount_text = $order->currency_sign . round($pay->discount_value* $order->currency_value,2)." off";

                        $pay->discount = $sub;
                    }
                }
            }
        }


        return view('front.payment',compact('order','gateways'));
    }

    public function payWithKhalti($order_number){
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();

        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        $pay =  PaymentGateway::where('status','=',1)->where('title','Khalti')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);
        $module = 'Order';

        $view = view('includes.khalti',compact('order','module'))->render();

        return response()->json($view, 200);
    }

    // Verification after trannsaction
    public function khaltiVerification(Request $request)
    {
        $order = Order::where('order_number',$request->order_number)->first();
        if(!$order)
            return response()->json(['error' => 'Order not found'], 404);
        if($order->status != 'pending')
            return response()->json(['error' => 'Order is already complete'], 422);

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        if($order->pay_amount*100 != $request->amount)
            return response()->json(['error' => 'Order amount is incorrect'], 422);

        $args = http_build_query(array(
            'token' => $request->token,
            'amount'  => $request->amount
        ));

        $url = "https://khalti.com/api/v2/payment/verify/";

        # Make the call using API.
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $khalti = config('khalti');
        $headers = ['Authorization: Key '.$khalti['secret']];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Response
        $response = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $token = json_decode($response, TRUE);

        if (isset($token['idx']) && $status_code == 200)
        {
            $order->payment_status = 'paid';
            $order->discount =  $gateway ? $gateway->discount: 0;
            $order->status = 'processing';
            $order->method = 'Khalti';
            $order->txnid = $token['idx'];
            $order->save();

            self::success($order);

            return $response;
        }

        return $response;

    }

    public function payWithFonePay($order_number){
        $order = Order::where('order_number',$order_number)->first();
        if(!$order)
            return response()->json(['error' => 'Order not found'], 404);
        if($order->status != 'pending')
            return response()->json(['error' => 'Order is already complete'], 422);

        $pay =  PaymentGateway::where('status','=',1)->where('title','FonePay')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);

        $fonepay = config('fonepay');

        $MD = 'P';
        $AMT = $order->pay_amount;
        $CRN = 'NPR';
        $DT = date('m/d/Y');
        $R1 = 'Payment for Order No: '.$order_number;
        $R2 = 'N/A';
        $RU = route('payment.verify_fonepay',$order_number); //fully valid verification page link

        // $PRN = $order->id.'1';
        $PRN = uniqid();

        $PID = $fonepay['merchant_code'];
        $sharedSecretKey = $fonepay['secret'];

        $DV = hash_hmac('sha512', $PID.','.$MD.','.$PRN.','.$AMT.','.$CRN.','.$DT.','.$R1.','.$R2.','.$RU, $sharedSecretKey);

        $args = http_build_query(array(
            "PID" => $PID,
            "MD" => $MD,
            "AMT" => $AMT,
            "CRN" => $CRN,
            "DT" => $DT,
            "R1" => $R1,
            "R2" => $R2,
            "DV" => $DV,
            "RU" => $RU,
            "PRN" => $PRN
        ));

        // $paymentUrl = 'https://clientapi.fonepay.com/api/merchantRequest';

        // $paymentUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest';
        $paymentUrl = env('FONEPAY_URL')."/api/merchantRequest";




        return response()->json(['url' => $paymentUrl.'?'.$args], 200);
    }

    public function verifyFonePay($order_number,Request $request){
        $order = Order::where('order_number',$order_number)->first();

        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        if($request->BC == 'N/A')
            return redirect()->route('payment.pay', $order->order_number);

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $fonepay = config('fonepay');
        $PID = $fonepay['merchant_code'];
        $sharedSecretKey = $fonepay['secret'];

        $requestData = [
            'PRN' => $request->PRN,
            'PID' => $PID,
            'BID' => $request->BID,
            'AMT' => $order->pay_amount,
            'UID' => $request->UID,
            'DV' => hash_hmac('sha512', $PID.','.$order->pay_amount.','.$request->PRN.','.$request->BID.','.$request->UID, $sharedSecretKey),
        ];

        // for test server
        // $verifyUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        $verifyUrl = env('FONEPAY_URL')."/api/merchantRequest/verificationMerchant";
        // for live server
        // $verifyUrl = 'https://clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $verifyUrl.'?'.http_build_query($requestData));

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseXML = curl_exec($ch);

        if($response = simplexml_load_string($responseXML)){

            if($response->success == 'true'){

                $order->payment_status = 'paid';
                $order->discount = $gateway ? $gateway->discount: 0;
                $order->method = 'FonePay';
                $order->status = 'processing';
                $order->txnid = $response->uniqueId;
                $order->save();

                self::success($order);

                return redirect('/payment/return');

            }else{

                Session::flash('error',"Payment Verifcation Failed: ".$response->message);
                return redirect()->route('payment.pay', $order->order_number);
            }

        }
        $order->order_status = 'pending';
        $order->save();

        Session::flash('error',"Payment Verifcation Failed. Please Try Again.");
        return redirect()->route('payment.pay', $order->order_number);
    }

    public function payWithEsewa($order_number){
        $order = Order::where('order_number',$order_number)->first();
        if(!$order)
            return response()->json(['error' => 'Order not found'], 404);
        if($order->status != 'pending')
            return response()->json(['error' => 'Order is already complete'], 422);

        $pay =  PaymentGateway::where('status','=',1)->where('title','Esewa')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);

        $esewa = config('esewa');

        $data = [
            'url' => "https://esewa.com.np/epay/main",
            'amt'=> $order->pay_amount,
            'pdc'=> 0,
            'psc'=> 0,
            'txAmt'=> 0,
            'tAmt'=> $order->pay_amount,
            'pid'=>$order_number,
            'scd'=> $esewa['merchant_code'],
            'su'=>route('payment.verify_esewa',$order_number),
            'fu'=>route('payment.pay',$order_number)
        ];

        return response()->json($data, 200);
    }

    public function verifyEsewa($order_number,Request $request){
        $order = Order::where('order_number',$order_number)->first();

        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $esewa = config('esewa');
        $url = "https://esewa.com.np/epay/transrec";

        $data = [
            'rid'=> $request->refId,
            'amt'=> $order->pay_amount,
            'pid'=>$order_number,
            'scd'=> $esewa['merchant_code']
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if($status_code == 200){
            $order->payment_status="paid";
            $order->discount = $gateway ? $gateway->discount: 0;
            $order->method = 'Esewa';
            $order->status = 'processing';
            $order->txnid = $request->refId;
            $order->save();

            self::success($order);

            return redirect('/payment/return');

        }
        $order->order_status = 'pending';
        $order->save();

        Session::flash('error',"Payment Verifcation Failed. Please Try Again.");
        return redirect()->route('payment.pay', $order->order_number);
    }

    public function payWithIpay($order_number, Request $request){
        $order = Order::where('order_number',$order_number)->first();
        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        $pay =  PaymentGateway::where('status','=',1)->where('title','iPay')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);

        $ipay = config('ipay');

        $iPay_URL = $ipay['ipay_url'];  // ipay end point

        $ipay = new MyIpay($order);	    
        $httpParsedResponseAr = $ipay->saleTxn(route('payment.verify_ipay',$order->order_number));  

        if(!$httpParsedResponseAr){
            $request->session()->flash('error', 'Something went wrong');
            return redirect()->route('payment.pay',$order_number);
        }

        if(isset($httpParsedResponseAr['ipay_out__txn_uuid']))
        {

            ?>
                <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <script type="text/javascript">
                        function closethisasap() {
                            document.forms["redirectpost"].submit();
                        }
                    </script>
                </head>
                <body onload="closethisasap();">
                <form name="redirectpost" method="post" action="<?php echo $iPay_URL; ?>">
                    <?php
                        echo '<input type="hidden" name="TXN_UUID" value="' . $httpParsedResponseAr['ipay_out__txn_uuid'] . '"> ';
                    ?>
                </form>
                </body>
                </html>
            <?php
            exit;
        }
        else
        {
            $request->session()->flash('error', 'Something went wrong');
            return redirect()->route('payment.pay',$order_number);
        }
    }

    public function verifyIpay($order_number,Request $request){

        $order = Order::where('order_number',$order_number)->first();

        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $TxnUUID = $request->TXN_UUID;
        $MerRefID = $request->mer_ref_id;

        if(sprintf('%0.2f',$order->pay_amount) != $request->txn_amount){
            Session::flash('error','Transaction is Invalid');
            return redirect()->route('payment.pay',$order_number);
        }
        if($request->fail_reason){
            Session::flash('error',$request->fail_reason);
            return redirect()->route('payment.pay',$order_number);
        }

        $ipay = new MyIpay($order);	    
        $httpParsedResponseArsec = $ipay->saleTxnVerify($TxnUUID,$MerRefID);

        if(!$httpParsedResponseArsec){
            $request->session()->flash('error', 'Something went wrong');
            return redirect()->route('payment.pay',$order_number);
        }
		$IPGTransactionID = $httpParsedResponseArsec['ipay_out__ipg_txn_id'];
		$MerRefID = $httpParsedResponseArsec['ipay_out__mer_ref_id'];
		$TxnStatus = $httpParsedResponseArsec['ipay_out__txn_status'];
		$FailReason = isset($httpParsedResponseArsec['ipay_out__fail_reason']) ? $httpParsedResponseArsec['ipay_out__fail_reason'] : 0;

        if($TxnStatus == 'ACCEPTED'){
            $order->payment_status = "paid";
            $order->discount = $gateway ? $gateway->discount : 0;
            $order->method = 'iPay';
            $order->status = 'processing';
            $order->txnid = $IPGTransactionID;
            $order->save();

            self::success($order);

            return redirect('/payment/return');
        }

        Session::flash('error',$FailReason);
        return redirect()->route('payment.pay', $order->order_number);
    }

    public function payWithCard($order_number, Request $request){
        $order = Order::where('order_number',$order_number)->first();
        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        $pay =  PaymentGateway::where('status','=',1)->where('title','iPay')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);

        $ipay = config('card');

        $iPay_URL = $ipay['api_url'];

        $name = explode(' ',$order->customer_name);
        $first_name = $name[0];
        $last_name = $name[count($name) - 1];

        $params = [
            "access_key" => $ipay['access_key'],
            "profile_id" => $ipay['profileId'],
            "transaction_uuid" => uniqid(),
            "signed_field_names" => 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,reference_number,amount,currency,bill_to_address_line1,bill_to_address_city,bill_to_address_country,bill_to_email,bill_to_forename,bill_to_surname,bill_to_address_postal_code,bill_to_address_state',
            "unsigned_field_names" => '',
            "signed_date_time" => gmdate("Y-m-d\TH:i:s\Z"),
            "locale" => 'en',
            "transaction_type" => 'sale',
            "reference_number" => $order_number,
            "amount" => $order->pay_amount,
            "currency" => 'USD',
            "bill_to_address_line1" => $order->customer_address,
            "bill_to_address_city" => $order->customer_address,
            "bill_to_address_country" => 'NP',
            "bill_to_address_postal_code" => '44600',
            "bill_to_address_state" => 'Kathmandu',
            "bill_to_email" => $order->customer_email, 
            "bill_to_forename" => $first_name,
            "bill_to_surname" => $last_name
        ];

        $signedFieldNames = explode(",",$params["signed_field_names"]);
        $dataToSign = [];
        foreach ($signedFieldNames as $field) {
            $dataToSign[] = $field . "=" . $params[$field];
        }
        $dataToSign = implode(",",$dataToSign);
        $sign = base64_encode(hash_hmac('sha256', $dataToSign, $ipay['secret_key'], true));

        ?>
            <html xmlns="http://www.w3.org/1999/xhtml">
                <head>
                    <script type="text/javascript">
                        function closethisasap() {
                            document.forms["redirectpost"].submit();
                        }
                    </script>
                </head>
                <body onload="closethisasap();">
                    <form name="redirectpost" method="post" action="<?php echo $iPay_URL; ?>">
                        <?php
                            foreach($params as $name => $value) {
                                echo "<input type=\"hidden\" id=\"" . $name . "\" name=\"" . $name . "\" value=\"" . $value . "\"/>\n";
                            }
                            echo "<input type=\"hidden\" id=\"signature\" name=\"signature\" value=\"" . $sign . "\"/>\n";
                        ?>
                    </form>
                </body>
            </html>
        <?php
        exit;
    }

    public function verifyCard(Request $request){
        $order_number = $request->req_reference_number;
        $order = Order::where('order_number',$order_number)->first();

        if(!$order){
            Session::flash('error','Order not found');
            return Redirect::to('/cart');
        }
        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        if($request->reason_code != "100"){
            Session::flash('error','Transaction Failed');
            return redirect()->route('payment.pay',$order_number);
        }


        $order->payment_status = "paid";
        $order->discount = $gateway ? $gateway->discount : 0;
        $order->method = 'Card';
        $order->status = 'processing';
        $order->txnid = $request->transaction_id;
        $order->save();

        // self::success($order);

        return redirect('/payment/return');

        Session::flash('error','Transaction Failed');
        return redirect()->route('payment.pay', $order->order_number);
    }

    public function cancelCard(Request $request){
        Session::flash('error','Payment Cancelled.');
        return redirect()->route('payment.pay', $request->req_reference_number);
    }

    public function payWithIMEPay($order_number){
        $order = Order::where('order_number',$order_number)->first();
        if(!$order)
            return response()->json(['error' => 'Order not found'], 404);
        if($order->status != 'pending')
            return response()->json(['error' => 'Order is already complete'], 422);

        $pay =  PaymentGateway::where('status','=',1)->where('title','IMEPay')->firstOrFail();

        $pay->discount = 0;
        $total = $order->pay_amount;

        if($pay->discount_value){

            if(!$pay->min_purchase_amount ||  $total >= $pay->min_purchase_amount){
                if($pay->discount_type === 0)
                {
                    $price = (int)$pay->discount_value;
                    $val = $total / 100;
                    $sub = round($val * $price, 2);
                    $total = $total - $sub;

                    $pay->discount = $sub;
                }
                else{
                    if($total < $pay->discount_value)
                        $sub = $total;
                    else
                        $sub = $pay->discount_value;

                    $total = $total - $sub;
                    $pay->discount = $sub;
                }
            }
        }

        $order->pay_amount = $total;

        Session::put('gateway', $pay);

        $imepay = config('imepay');
        // $ref_id = uniqid();
        $ref_id = $order->order_number;
        //get token from IME
        $data = ["MerchantCode" => $imepay['merchant_code'], "Amount" => $order->pay_amount, "RefId" => $ref_id];
        $header_array = [];
        $header_array[] = "Authorization: Basic ".base64_encode($imepay['apiuser'].":".$imepay['password']);
        $header_array[] = "Module: ".base64_encode($imepay['module']);
        $header_array[] = "Content-Type: application/json";
        // Initializing a cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://payment.imepay.com.np:7979/api/Web/GetToken');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($result, TRUE);

        if (isset($response['TokenId']) && $status_code == 200)
        {
            $token = $response['TokenId'];

            $paymentUrl = "https://payment.imepay.com.np:7979/WebCheckout/Checkout";

            $args = array(
                'url' => $paymentUrl,
                "TokenId" => $token,
                "MerchantCode" => $imepay['merchant_code'],
                "RefId" => $ref_id,
                "TranAmount" => $order->pay_amount,
                "Method" => 'POST',
                "RespUrl" => route('payment.verify_imepay'),
                "CancelUrl" => route('payment.verify_imepay')
            );

            return response()->json($args, 200);
        }
        else{
            return response()->json(['error' => 'Something went wrong. Please try again'], 500);
        }
    }

    public function verifyIMEPay(Request $request){

        $order = Order::where('order_number',$request->RefId)->firstOrFail();

        if($order->status != 'pending'){
            Session::flash('error','Order is already complete');
            return Redirect::to('/cart');
        }
        
        if($request->ResponseCode == 1 || $request->ResponseCode == 3)
            return redirect()->route('payment.pay', $order->order_number);

        $gateway = Session::get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $imepay = config('imepay');

        $ref_id = $order->order_number;

        if($request->ResponseCode == 0){
            $data = [
                "MerchantCode" => $imepay['merchant_code'],
                "RefId" => $ref_id,
                "TokenId" => $request->TokenId,
                "TransactionId" => $request->TransactionId,
                "Msisdn" => $request->Msisdn,
            ];

            $url = 'https://payment.imepay.com.np:7979/api/Web/Confirm';
        }else{
            $data = [
                "MerchantCode" => $imepay['merchant_code'],
                "RefId" => $ref_id,
                "TokenId" => $request->TokenId
            ];

            $url = 'https://payment.imepay.com.np:7979/api/Web/Recheck';
        }
        
        $header_array = [];
        $header_array[] = "Authorization: Basic ".base64_encode($imepay['apiuser'].":".$imepay['password']);
        $header_array[] = "Module: ".base64_encode($imepay['module']);
        $header_array[] = "Content-Type: application/json";
        // Initializing a cURL session
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = json_decode($result, TRUE);

        if (isset($response['ResponseCode']) && $response['ResponseCode'] == 0 && $status_code == 200)
        {
            $order->payment_status = "paid";
            $order->discount = $gateway ? $gateway->discount: 0;
            $order->method = 'IMEpay';
            $order->status = 'processing';
            $order->txnid = $request->TransactionId;
            $order->save();

            self::success($order);

            return redirect('/payment/return');
        }
        
        Session::flash('error',"Payment Verifcation Failed. Please Try Again.");
        return redirect()->route('payment.pay',$order->order_number);
    }

    public function payWithBank($order_number)
    {
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        if(!self::CheckAvailability($cart->items, $order->coupon_code))
            return redirect()->route('front.cart')->with('error',Session::get('error'));

        $success_url = action('PaymentController@payreturn');

        $order->payment_status = "pending";
        $order->status = "processing";
        $order->method = 'Bank Payment';

        $order->save();

        self::success($order);

        Mail::send(new BankPayment($order));

        return redirect($success_url);
    }

    public function cashondelivery($order_number)
    {
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        if(!self::CheckAvailability($cart->items, $order->coupon_code))
            return redirect()->route('front.cart')->with('error',Session::get('error'));

        $success_url = action('PaymentController@payreturn');

        $order->payment_status = "pending";
        $order->status = "processing";

        $order->save();

        self::success($order);

        return redirect($success_url);
    }

    private function success($order){

        $gs = Generalsetting::findOrFail(1);

        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();

        if (Session::has('already'))
            $coupon = Session::get('already');

        if($order['coupon_code'])
        {
            $coupon = Coupon::where('code',$order->coupon_code)->first();
            $coupon->used++;
            if($coupon->times != null)
            {
                $i = (int)$coupon->times;
                $i--;
                $coupon->times = (string)$i;
            }
            $coupon->update();

            if($order['coupon_code'] == 'MERO'){

                $user = Auth::guard('user')->user();

                $cc =new CouponCheck;
                $cc->email = $user->email;
                $cc->code = 'MERO';
                $cc->save();
                }

        }

        foreach($cart->items as $prod)
        {
            $x = (string)$prod['stock'];
            if($x != null)
            {

                $product = Product::findOrFail($prod['item']['id']);

                $now = Carbon::now()->format('Y/m/d h:i A');

                if($product->sale_from && ($product->sale_from <= $now && $product->sale_to >= $now) && $product->sale_stock){
                    $product->sale_stock -=  $prod['qty'];

                    if($product->sale_stock < 0) $product->sale_stock = 0;
                }

                $stock = $product->stock =  $product->getOriginal('stock') - $prod['qty'];

                if($stock < 0) $product->stock = 0;

                $product->update();

                if($stock <= 5)
                {
                    $notification = new Notification;
                    $notification->product_id = $product->id;
                    $notification->save();
                }
            }
        }

        Session::forget('cart');
        Session::forget('already');
        Session::forget('shipping');
        Session::forget('gateway');

        Mail::send(new CustomerInvoice($order));

        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $gs->email,
                'subject' => "Business Merohealthcare New Order Recieved!!",
                'body' => "<b>Hello Admin!</b><br>Your store has received a new order. Your order invoice is #".$order->id.". Please login to Business Merohealthcare admin panel to check.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
           $to = $gs->email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order. Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }
    }

    public function paysuccess(){
        $success_url = action('PaymentController@payreturn');

        return redirect($success_url);
    }

    public function paycancel(){
        return redirect()->back()->with('unsuccess','Payment Cancelled.');
    }

    public function payreturn(){
        return view('payreturn');
    }

    private function CheckAvailability($purchases, $code = null){
        foreach ($purchases as $product_id=>$prod) {
            $purchase = $prod['item'];

            $product = Product::where('status',1)->find($product_id);

            if(!$product){
                Session::flash('error', $purchase->name . ' is no longer available.');
                return false;
            }

            // if($product->requires_prescription){
            //     Session::flash('error', $purchase->name . ' requires prescription and cannot be purchased directly.');
            //     return false;
            // }

            if($product->stock !== null){
                if($product->stock == 0){
                    Session::flash('error', $purchase->name . ' has already sold out');
                    return false;
                }

                if($prod['qty'] > $product->stock){
                    Session::flash('error', $purchase->name . ' only ' . $product->stock . ' in stock');
                    return false;
                }
            }

            if($product->getPrice($prod['qty']) != $prod['item']['price']){
                Session::flash('error', $purchase->name . ' price has been updated.');
                return false;
            }
        }

        if($code){
            $coupon = Coupon::where('code',$code)->first();
            if(!$coupon)
            {
                Session::flash('error', $code . ' is no longer available.');
                return false;
            }
            if($coupon->times != null)
            {
                if($coupon->times == "0")
                {
                    Session::flash('error', $code . ' is no longer available.');
                    return false;
                }
            }
        }
        return true;
    }


    public function notify(Request $request){

        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        //return $myPost;


        // Read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }

        /*
        * Post IPN data back to PayPal to validate the IPN data is genuine
        * Without this step anyone can fake IPN data
        */
        $paypalURL = "https://www.paypal.com/cgi-bin/webscr";
        $ch = curl_init($paypalURL);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
        $res = curl_exec($ch);

        /*
        * Inspect IPN validation result and act accordingly
        * Split response headers and payload, a better way for strcmp
        */
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {

            $order = Order::where('user_id',$_POST['custom'])
                ->where('order_number',$_POST['item_number'])->first();
            $data['txnid'] = $_POST['txn_id'];
            $data['payment_status'] = $_POST['payment_status'];
            if($order->dp == 1)
            {
                $data['status'] = 'completed';
            }
            $order->update($data);
            $notification = new Notification;
            $notification->order_id = $order->id;
            $notification->save();
            Session::forget('cart');
        }else{
            $payment = Order::where('user_id',$_POST['custom'])
                ->where('order_number',$_POST['item_number'])->first();
            $payment->delete();
            Session::forget('cart');

        }

    }

}
