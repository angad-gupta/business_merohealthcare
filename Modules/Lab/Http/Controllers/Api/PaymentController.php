<?php

namespace Modules\Lab\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Coupon;
use App\Generalsetting;
use App\Notification;
use Modules\Lab\Entities\LabOrder as Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use App\PaymentGateway;
use Modules\Lab\Emails\CustomerInvoice;
use App\Classes\GeniusMailer;
use Mail;
use Session;
use Auth;
use Redirect;

class PaymentController extends Controller
{
    public function payment(Request $request ){
        

        $user = Auth::user();
 
        $order = Order::where('status','pending')->where('user_id',$user->id)->where('order_number',$request->order_number)->firstOrFail();
        $items = $order->items;

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
        
        return response()->json(['order'=>$order,'products' => $items,'gateways' => $gateways],200);
    }

    public function payWithKhalti($order_number){
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();
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

        Session::put('lab_gateway', $pay);
        $module = 'Lab Order';

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

        $gateway = Session::get('lab_gateway');

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
            //$order->payment_status = 'paid';
            $order->discount = $gateway->discount;
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

        Session::put('lab_gateway', $pay);
        
        $fonepay = config('fonepay');

        $MD = 'P';
        $AMT = $order->pay_amount;
        $CRN = 'NPR';
        $DT = date('m/d/Y');
        $R1 = 'Payment for Order No: '.$order_number;
        $R2 = 'N/A';
        $RU = route('lab.payment.verify_fonepay',$order_number); //fully valid verification page link

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

        $paymentUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest';

        

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
            return redirect()->route('lab.payment', $order->order_number);

        $gateway = Session::get('lab_gateway');

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
        $verifyUrl = 'https://dev-clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        // for live server
        // $verifyUrl = 'https://clientapi.fonepay.com/api/merchantRequest/verificationMerchant';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $verifyUrl.'?'.http_build_query($requestData));

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $responseXML = curl_exec($ch);

        if($response = simplexml_load_string($responseXML)){

            if($response->success == 'true'){

                //$order->payment_status = 'paid';
                $order->discount = $gateway->discount;
                $order->method = 'FonePay';
                $order->status = 'processing';
                $order->txnid = $response->uniqueId;
                $order->save();
                
                self::success($order);

                return redirect('/payment/return');

            }else{

                Session::flash('error',"Payment Verifcation Failed: ".$response->message);
                return redirect()->route('lab.payment', $order->order_number);
            }

        }
        $order->order_status = 'pending';
        $order->save();

        Session::flash('error',"Payment Verifcation Failed. Please Try Again.");        
        return redirect()->route('lab.payment', $order->order_number);
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

        Session::put('lab_gateway', $pay);

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
        curl_setopt($ch, CURLOPT_URL, 'https://stg.imepay.com.np:7979/api/Web/GetToken');
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

            $paymentUrl = "https://stg.imepay.com.np:7979/WebCheckout/Checkout";

            $args = array(
                'url' => $paymentUrl,
                "TokenId" => $token,
                "MerchantCode" => $imepay['merchant_code'],
                "RefId" => $ref_id,
                "TranAmount" => $order->pay_amount,
                "Source" => 'W'
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

        if($request->ResponseCode !== 0)
            return redirect()->route('lab.payment', $order->order_number);

        $gateway = Session::get('lab_gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        //$order->payment_status = 'paid';
        $order->discount = $gateway->discount;
        $order->method = 'IMEpay';
        $order->status = 'processing';
        $order->txnid = $request->TransactionId;
        $order->save();
        
        self::success($order);

        return redirect('/payment/return');
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

        $gateway = Session::get('lab_gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $esewa = config('esewa');
        $url = "https://uat.esewa.com.np/epay/transrec";

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
#        $response = json_decode($response, TRUE);
        if($status_code == 200){

            $order->discount = $gateway->discount;
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
        return redirect()->route('lab.payment', $order->order_number);
    }

    public function cashondelivery($order_number)
    {
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        
        if(!self::CheckAvailability($cart->items, $order->coupon_code))
            return redirect()->route('lab.index')->with('error',Session::get('error'));

        $success_url = route('lab.payment.return');

        $order->payment_status = "pending";
        $order->status = "processing";

        $order->save();

        self::success($order);

        return redirect($success_url);
    }

    private function success($order){
        
        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->vendor_id = $order->vendor_id;
        $notification->save();

        Mail::send(new CustomerInvoice($order));

        $vendor = User::where('is_vendor',2)->find($order->vendor_id);

        $data = [
            'to' => $vendor->email,
            'subject' => "New Order Recieved!!",
            'body' => "<b>Hello ".$vendor->name."!</b><br>Your lab has received a new order. Please login to your panel to check.",
        ];
        
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);

        Session::forget('lab_cart');
        Session::forget('lab_gateway');
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
        foreach ($purchases as $product_id => $prod) { 
            $purchase = $prod['item'];

            $product = Product::where('status',1)->find($product_id);
            
            if(!$product){
                Session::flash('error', $purchase->name . ' is no longer available.');
                return false;
            }

            if($product->requires_prescription){
                Session::flash('error', $purchase->name . ' requires prescription and cannot be purchased directly.');
                return false;
            }
   
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
