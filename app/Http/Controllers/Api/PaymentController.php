<?php

namespace App\Http\Controllers\Api;
use App\Cart;
use App\Coupon;
use App\Currency;
use App\Generalsetting;
use App\Notification;
use App\Order;
use App\Product;
use App\Pickup;

use App\Prescriptionfile;
use App\PrescriptionfileOrder;
use App\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CheckoutValidationRequest;
use App\PaymentGateway;
use App\Mail\CustomerInvoice;
use Mail;
use Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Redirect;
use Carbon\Carbon;
use App\Classes\GeniusMailer;

use \League\OAuth2\Server\ResourceServer;
use \Laravel\Passport\TokenRepository;
use \Laravel\Passport\Guards\TokenGuard;
use \Laravel\Passport\ClientRepository;

class PaymentController extends Controller
{

    private function getUser($bearerToken) {
        $tokenguard = new TokenGuard(
            \App::make(ResourceServer::class),
            Auth::createUserProvider('users'),
            \App::make(TokenRepository::class),
            \App::make(ClientRepository::class),
            \App::make('encrypter')
        );
        $request = Request::create('/');
        $request->headers->set('Authorization', 'Bearer ' . $bearerToken);
        return $tokenguard->user($request);
    }

    public function store(CheckoutValidationRequest $request)
    {
 
        if (!$request->has('cart')) {
            $data['success'] = false;
            $data['message'] = "You don't have any product to checkout.";
            return response()->json($data,500);
        }
        $this->validate($request, [
            'filenames.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
        ],[
            'filenames.*.mimes' => 'Only files of type doc, pdf, docx, zip, jpeg, jpg, png, pdf are allowed.',
        ]);
        if ($request->has('currency'))
        {
            $curr = Currency::find($request->get('currency'));
        }
        else
        {
            $curr = Currency::where('is_default','=',1)->first();
        }

        $gs = Generalsetting::findOrFail(1);

        $oldCart = $request->get('cart');

        $cart = json_decode($oldCart);

        $calculated=$this->calculate($gs, $cart);

        $cart = $calculated['cart'];
        $total = $cart->totalPrice;

        $coupon = null;

        if ($request->has('coupon')) {
            $coupon = $this->calculateCoupon($request->coupon,$total);

            if(!$coupon){
                $data['success'] = false;
                $data['message'] = 'Invalid Coupon Code';
                return response()->json($data,500);
            }
            $total -= $coupon->discount;
            if($total < 0) $total = 0;
        }

        $total += $calculated['shipping_cost']+$calculated['tax'];

        $errors = self::CheckAvailability($cart->items, $request->coupon_code);
        if($errors){
            $data['success'] = false;
            $data['message'] = $errors['message'];
            return response()->json($data,500);
        }
        $user = $this->getUser($request->bearerToken());

        $latlong = [
            'lat'=>floatval($request->latlong['lat']),
            'lng'=>floatval($request->latlong['lng']),
        ];

        $shipping_latlng = [
            'lat'=>floatval($request->shipping_latlong['lat']),
            'lng'=>floatval($request->shipping_latlong['lng']),
        ];
        $order = new Order;
        $item_name = $gs->title." Order";
        $item_number = str_random(4).time();
        $order['user_id'] = $user ? $user->id : 0;
        $order['cart'] = utf8_encode(bzcompress(serialize($cart), 9));
        $order['totalQty'] = $cart->totalQty;
        $order['pay_amount'] = round($total, 2);
        $order['method'] = "Cash On Delivery";
        $order['shipping'] = $request->shipping;
        $order['pickup_location'] = $request->pickup_location;
        $order['customer_email'] = $request->email;
        $order['customer_name'] = $request->name;
        $order['shipping_cost'] = $calculated['shipping_cost'];
        $order['tax'] = $calculated['tax'];
        $order['customer_phone'] = $request->phone;
        $order['order_number'] = str_random(4).time();
        $order['customer_address'] = $request->address;
        $order['customer_latlong'] = json_encode($latlong);
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
        $order['shipping_latlong'] = json_encode($shipping_latlng);
        $order['shipping_country'] = $request->shipping_country;
        // $order['shipping_city'] = $request->shipping_city;
        // $order['shipping_zip'] = $request->shipping_zip;
        // $order['shipping_landmark'] = $request->shipping_landmark;
        $order['shipping_address_type'] = $request->shipping_address_type;
        $order['shipping_pan_number'] = $request->shipping_pan_number;
        $order['order_note'] = $request->order_notes;
        $order['coupon_code'] = $coupon ? $coupon->code : null;
        $order['coupon_discount'] = $coupon ? $coupon->discount : null;
        $order['payment_status'] = "pending";
        $order['status'] = "pending";
        $order['currency_sign'] = $curr->sign;
        $order['currency_value'] = $curr->value;

        $order->save();
        $files = [];
        if($request->hasFile('filenames')){
            foreach ($request->filenames as $reg_certificate_file){

                
                $filenameWithExt = $reg_certificate_file->getClientOriginalName();
                $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $files []= $filenameWithExt;
                $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
                $path = $reg_certificate_file->storeAs('public/prescriptionorders', $filename);


            $prescription_image = new Prescriptionfile;
            $prescription_image->file = $filename;

            $prescription_image->save();

            $poid = new PrescriptionfileOrder;
            $poid->order_id = $order->id;
            $poid->prescriptionfile_id = $prescription_image->id;
            $poid->save();

            }
        }

        $order->cart = json_encode($cart);
        $order->prescriptions = $files;
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

        return response()->json(["order"=>$order,'payment_gateways'=>$gateways],200);
    }

    public function total($cart){
        if ($cart["items"]) {
            $total = 0;
            foreach ($cart["items"] as $item) {

                $product=Product::findOrFail($item['item']['id']);
                $total += $product->price;
            }
            return $total;
        }
        return 0;
    }

    public function total_with_discount(){
        $total = $this->total();

        $gateway = Session::get('gateway');
        $gateway_discount = $gateway ? $gateway->discount : 0;

        $coupon = Session::get('already');
        $coupon_discount = $coupon ? $coupon->discount : 0;

        $total = $total - $gateway_discount - $coupon_discount;
        return $total > 0 ? $total : 0;
    }


    public function calculate1($cart)
    {
        // return $cart;
        $cart['totalPrice']=$this->total($cart);

        if(Auth::check())
        {
            $pickups = Pickup::all();
            $products = $cart->items;

            $gs = Generalsetting::findOrFail(1);
            $dp = 1;


            $user = null;
            foreach ($cart["items"] as $prod) {
                $user[] = $prod['item']['user_id'];
            }

            $ship  = 0;
            $users = array_unique($user);
            if(!empty($users))
            {
                foreach ($users as $user) {
                    if($user != 0){
                            $nship = User::findOrFail($user);
                                $ship += $nship->shipping_cost;
                    }
                    else {

                        if($gs->min_free_ship)
                            $ship += $cart['totalPrice'] >= $gs->min_free_ship ? 0: $gs->ship;
                        else
                            $ship  += $gs->ship;
                    }

                }
            }



            foreach ($products as $prod) {
                if($prod['item']['type'] == 0)
                {
                    $dp = 0;
                    break;
                }
            }
            $total = $cart['totalPrice'] + $ship;
            if($gs->tax != 0)
            {
                $tax = ($total / 100) * $gs->tax;
                $total = $total + $tax;
            }

            return ['products' => $cart->items,
                         'totalPrice' => $total, 'pickups' => $pickups,
                         'totalQty' => $cart->totalQty,
                         'shipping_cost' => $ship,
                         ];
        }
        else
        {
            // If guest checkout is activated then user can go for checkout
                $pickups = Pickup::all();
                // return $cart;
            $gs = Generalsetting::findOrFail(1);

                $products = $cart["items"];


                    $user = null;
                    // dd($cart);
                    foreach ($cart["items"] as $prod) {
                            $user[] = $prod['item']['user_id'];
                    }
                    $ship  = 0;
                    $users = array_unique($user);

                    if(!empty($users))
                    {
                        foreach ($users as $user) {
                            if($user != 0){
                                $nship = User::findOrFail($user);
                                    $ship += $nship->shipping_cost;
                            }
                            else {
                                // $ship += $gs->ship;
                                if($gs->min_free_ship)
                                    $ship += ($cart['totalPrice'] >= $gs->min_free_ship ? 0: $gs->ship);
                                else
                                    $ship += $gs->ship;
                            }

                        }
                    }else{
                        // $ship = $gs->ship;
                        if($gs->min_free_ship)
                            $ship = $cart['totalPrice'] >= $gs->min_free_ship ? 0: $gs->ship;
                        else
                            $ship = $gs->ship;

                    }

            //    dd($products);
                foreach ($products as $prod) {
                    if($prod['item']['type'] == 0)
                    {
                        $dp = 0;
                        break;
                    }
                }
                $total = $cart['totalPrice'] + $ship;
                if($gs->tax != 0)
                {
                    $tax = ($total / 100) * $gs->tax;
                    $total = $total + $tax;
                }
                foreach ($products as $prod) {
                    if($prod['item']['type'] != 0)
                    {
                        if(!Auth::check())
                        {
                            $ck = 1;
                            return ['products' => $cart->items,
                                                     'totalPrice' => $total,
                                                     'pickups' => $pickups,
                                                     'shipping_cost' => $ship,
                                                     'checked' => $ck];
                        }
                    }
                }

                return ['products' => $cart['items'],
                                        'totalPrice' => $total,
                                         'shipping_cost' => $ship];
        }
    }

    public function calculate($gs,$cart)
    {
        $validated_cart = (object)[];
        $validated_cart->items = [];
        $validated_cart->totalQty = 0;
        $validated_cart->ship = 0;
        $validated_cart->tax = 0;
        $validated_cart->totalPrice = 0;

        $products = $cart->items;

        foreach ($products as $prod) {
            $prod = (object)$prod;
            
            $product = Product::where('status',1)->findOrFail($prod->id);
            $product->price = $product->getPrice($prod->qty);

            $prod = ['qty' => $prod->qty, 'size' => $product->size, 'color' => $product->color, 'stock' => $product->stock, 'price' => $prod->qty * $product->price,'item' => $product, 'license' => '', 'family' => []];
            $validated_cart->items[$product->id] = $prod;
            $validated_cart->totalPrice += $prod['price'];
            $validated_cart->totalQty++;
        }
        $ship  = 0;
        
        // $ship = $gs->ship;
        if($gs->min_free_ship)
            $ship = $validated_cart->totalPrice >= $gs->min_free_ship ? 0: $gs->ship;
        else
            $ship = $gs->ship;


        $total = $validated_cart->totalPrice + $ship;

        $tax = 0;
        if($gs->tax != 0)
        {
            $tax = ($total / 100) * $gs->tax;
            $total = $total + $tax;
        }

        return ['cart' => $validated_cart,
            'totalPrice' => $total,
            'totalQty' => $validated_cart->totalQty,
            'tax' => $tax,
            'shipping_cost' => $ship
        ];
    }

    public function calculateCoupon($code,$totalPrice)
    {
        $fnd = Coupon::where('code','=',$code)->get()->count();
        if($fnd < 1)
        {
            return null;
        }
        else{
            $coupon = Coupon::where('code','=',$code)->first();
            $curr = Currency::where('is_default','=',1)->first();

            if($coupon->times != null)
            {
                if($coupon->times == "0")
                {
                    return null;
                }
            }

            $today = (int)date('d');
            $from = (int)date('d',strtotime($coupon->start_date));
            $to = (int)date('d',strtotime($coupon->end_date));
            if($from <= $today && $to >= $today)
            {
                if($coupon->status == 1)
                {
                    $val = null;
                    $total = $totalPrice;
                    $data = [];

                    if($coupon->type == 0)
                    {
                        $coupon->price = (int)$coupon->price;
                        $val = $total / 100;
                        $sub = round($val * $coupon->price, 2);
                        $coupon->discount = round($sub * $curr->value,2);
                        $coupon->discount_text = $coupon->price."%";
                    }
                    else{
                        if($total < $coupon->price)
                            $sub = $total;
                        else
                            $sub = $coupon->price;

                        $coupon->discount = round($sub * $curr->value, 2);
                        $coupon->discount_text = $curr->sign . round($coupon->price* $curr->value,2);

                    }

                    return $coupon;
                }
                else{
                    return null;
                }
            }
            else{
                return null;
            }
        }
    }

    public function payment(Request $request){
        $order = Order::where('order_number','770o159436168')->firstOrFail();

        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

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

        return response()->json(['order'=>$order,'gateways'=>$gateways]);
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

        $request->put('gateway', $pay);
        $module = 'Order';

        $view = view('includes.khalti',compact('order','module'))->render();

        return response()->json($view, 200);
    }

    // Verification after trannsaction
    public function khaltiVerification(Request $request)
    {
        $order = Order::where('order_number',$request->order_number)->first();
        if(!$order)
        {
            $data['success'] = false;
            $data['message'] = 'Order Not Found';
            return response()->json($data,500);
        }
           if($order->status != 'pending')
           {
            $data['success'] = false;
            $data['message'] = 'Order is already completed';
            return response()->json($data,422);
           }


        if($order->pay_amount*100 != $request->amount)
        {
            $data['success'] = false;
            $data['message'] = 'Order Amount is incorrect';
            return response()->json($data,422);
        }

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
            $order->discount = 0;
            $order->status = 'processing';
            $order->method = 'Khalti';
            $order->txnid = $token['idx'];
            $order->save();

            self::success($order);

            return $response;
        }

        $data['success'] = false;
        $data['message'] = 'Something went wrong.';
        return response()->json($data,500);

    }

    private function payWithFonePay($order){
        $fonepay = config('fonepay');

        $MD = 'P';
        $AMT = $order->pay_amount;
        $CRN = 'NPR';
        $DT = date('m/d/Y');
        $R1 = 'Payment for Order No: '.$order->order_number;
        $R2 = 'N/A';
        $RU = url('/api/ecommerce/checkout/'.$order->order_number.'/fonepay/verify'); //fully valid verification page link

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

        return $paymentUrl.'?'.$args;
    }

    public function verifyFonePay($order_number,Request $request){
        $order = Order::where('order_number',$order_number)->first();

        if(!$order){
            return redirect('/api/failure');
        }
        if($order->status != 'pending'){
            return redirect('/api/failure');
        }

        if($request->BC == 'N/A')
            return redirect('/api/failure');


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

                $order->payment_status = 'paid';
                $order->discount = $gateway->discount;
                $order->method = 'FonePay';
                $order->status = 'processing';
                $order->txnid = $response->uniqueId;
                $order->save();

                self::success($order);

                return redirect('/api/success');

            }else{

                return redirect('/api/failure');
            }

        }
        return redirect('/api/failure');
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

        $request->put('gateway', $pay);

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
            $request->flash('error','Order is already complete');
            return Redirect::to('/cart');
        }

        if($request->ResponseCode !== 0)
            return redirect()->route('payment.pay', $order->order_number);

        $gateway = $request->get('gateway');

        if($gateway){
            $order->pay_amount -= $gateway->discount;
        }

        $order->payment_status = 'paid';
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
            return redirect('/api/failure');
        }
        if($order->status != 'pending'){
            return redirect('/api/failure');
        }

        $esewa = config('esewa');
        $url = "https://uat.esewa.com.np/epay/transrec";

        $data = [
            'rid'=> $request->refId,
            'amt'=> $order->pay_amount,
            'pid'=> $order_number,
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
            $order->payment_status = 'paid';
            $order->discount = 0;
            $order->method = 'Esewa';
            $order->status = 'processing';
            $order->txnid = $request->refId;
            $order->save();

            self::success($order);

            $data['success'] = true;
            return redirect('/api/success');

        }
        
        $data['success'] = false;
        $data['message'] = 'Payment Verifcation Failed. Please Try Again. If error persists, please contact our support.';
        return redirect('/api/failure');


    }

    public function cashondelivery($order_number)
    {
        $order = Order::where('status','pending')->where('order_number',$order_number)->firstOrFail();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        $order->payment_status = "pending";
        $order->status = "processing";

        $order->save();

        self::success($order);
        $data['success'] = true;
        return response()->json($data,200);
    }

    private function success($order){

        $gs = Generalsetting::findOrFail(1);

        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));

        $notification = new Notification;
        $notification->order_id = $order->id;
        $notification->save();


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

        Mail::send(new CustomerInvoice($order));

        //Sending Email To Admin
        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $gs->email,
                'subject' => "New Order Recieved!!",
                'body' => "<b>Hello Admin!</b><br>Your store has received a new order. Please login to your panel to check.",
            ];

            $mailer = new GeniusMailer();
            // $mailer->sendCustomMail($data);
        }
        else
        {
           $to = $gs->email;
           $subject = "New Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new order. Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        //   mail($to,$subject,$msg,$headers);
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
                return ['message' => $purchase->name . ' is no longer available.','error'=>422];
            }

            // if($product->requires_prescription){
            //     $request->flash('error', $purchase->name . ' requires prescription and cannot be purchased directly.');
            //     return false;
            // }

            if($product->stock !== null){
                if($product->stock == 0){
                    return ['message' => $purchase->name . ' has already sold out','error'=>422];
                }

                if($prod['qty'] > $product->stock){
                    return ['message' => $purchase->name . ' only ' . $product->stock . ' in stock','error'=>422];
                }
            }

            if($product->getPrice($prod['qty']) != $prod['item']['price']){
                return ['message' => $purchase->name . ' price has been updated.','error'=>422];
            }
        }

        if($code){
            $coupon = Coupon::where('code',$code)->first();
            if(!$coupon)
            {
                return ['message' => $code . ' is no longer available.','error'=>422];
            }
            if($coupon->times != null)
            {
                if($coupon->times == "0")
                {
                    return ['message' => $code . ' is no longer available.','error'=>422];
                }
            }
        }
        return null;
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
            $request->forget('cart');
        }else{
            $payment = Order::where('user_id',$_POST['custom'])
                ->where('order_number',$_POST['item_number'])->first();
            $payment->delete();
            $request->forget('cart');

        }

    }

}
