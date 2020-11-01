<?php

namespace App\Http\Controllers;

use App\Classes\GeniusMailer;
use App\Order;
use App\VendorOrder;
use App\User;
use App\Generalsetting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Product;
use Illuminate\Support\Facades\Input;
use Mail;
use App\Mail\PurchaseThankyou;
use App\Mail\DeliveryEmail;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::where('status','!=','pending')->orderBy('id','desc')->paginate(50);
        return view('admin.order.index',compact('orders'));
    }

    public function ordersearch()
    {
        $q = Input::get('search');
        $orders = Order::where('status','!=','pending')->where('customer_email', 'LIKE', '%' . $q . '%')->orWhere('customer_name', 'LIKE', '%' . $q . '%')->orWhere('customer_address', 'LIKE', '%' . $q . '%')->orWhere('customer_phone', 'LIKE', '%' . $q . '%')
        ->orderBy('customer_email')->paginate(50);
            // dd($prods);
        $orders->appends(['search' => $q]);
        return view('admin.order.index', compact('orders'));
    }

    public function pending()
    {
        $orders = Order::where('status','=','pending')->orderBy('id','desc')->get();
        return view('admin.order.pending',compact('orders'));
    }
    public function processing()
    {
        $orders = Order::where('status','=','processing')->orderBy('id','desc')->get();
        return view('admin.order.processing',compact('orders'));
    }
    public function completed()
    {
        $orders = Order::where('status','=','completed')->orderBy('id','desc')->get();
        return view('admin.order.completed',compact('orders'));
    }
    public function requestCancellation()
    {
        $orders = Order::where('status','=','cancellation request')->orderBy('id','desc')->get();
        return view('admin.order.cancellation',compact('orders'));
    }
    public function declined()
    {
        $orders = Order::where('status','=','declined')->orderBy('id','desc')->get();
        return view('admin.order.declined',compact('orders'));
    }
    public function show($id)
    {
        
        // $orderfiles = Order::findOrFail($id);
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.details',compact('order','cart'));
    }

    public function getPrescriptionOrderFile($id, $filename,$pfid)
    {
        // dd($id);
        $order = Order::findOrFail($id);
        $pf= $order->files()->findOrFail($pfid);

        try{
            $path = \Storage::get('public/prescriptions/'.$pf->file);
            $mimetype = \Storage::mimeType('public/prescriptions/'.$pf->file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function invoice($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.invoice',compact('order','cart'));
    }

    public function emailsub(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        if($gs->is_smtp == 1)
        {
            $data = [
                    'to' => $request->to,
                    'subject' => $request->subject,
                    'body' => $request->message,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);                
        }
        else
        {
            $data = 0;
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
            $mail = mail($request->to,$request->subject,$request->message,$headers);
            if($mail) {   
                $data = 1;
            }
        }

        return response()->json($data);
    }
    
    public function printpage($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.print',compact('order','cart'));
    }

    public function printpagedetails($id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('admin.order.print-details',compact('order','cart'));
    }

    public function license(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        return redirect()->route('admin-order-show',$order->id)->with('success','Successfully Changed The License Key.');
    }

    public function status($id,$status)
    {
        $mainorder = Order::findOrFail($id);
        
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }
        if ($mainorder->status == "declined"){
            return redirect()->back()->with('success','This Order is Already Cancelled');
        }else{
            if ($status == "completed"){

                $stat['completed_at'] = Carbon::now();
                $stat['payment_status'] = 'paid';
              

                foreach($mainorder->vendororders as $vorder)
                {
                    $uprice = User::findOrFail($vorder->user_id);
                    $uprice->current_balance = $uprice->current_balance + $vorder->price;
                    $uprice->update();
                }
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => $mainorder->customer_email,
                        'subject' => 'Thank You For Your Order #'.$mainorder->order_number.'',
                        'body' => "<b>Hello ".$mainorder->customer_name.",</b>"."<br> <p>Thank you for shopping with <b>MEROHEALTHCARE.</b></p> 
                        <p>Hope your order has been delivered to you up to your satisfaction. We really appreciate if you could share your service experience <a class='btn btn-primary' href='https://docs.google.com/forms/d/e/1FAIpQLScvhiOjXJ1tmS-FeJfxbE7dtLme1cHcZG1aVRnAOY9n-aLChA/viewform?usp=sf_link' target='__blank'>here</a> and help us to develop much better service experience for you.</p> 
                        <p>Thank you once again on trusting us. We really look forward to service you again. </p>",
                            
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);    

                    // Mail::send(new PurchaseThankyou($mainorder));
                    
                    
                }
                else
                {
                    $to = $mainorder->customer_email;
                    $subject = 'Your order '.$mainorder->order_number.' is Confirmed!';
                    $msg = "Hello ".$mainorder->customer_name.","."\n <p>Thank you choosing Merohealthcare as your service partner.</p> <p>Hope your order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience here and help us to develop much better service experience for you.</p> <p>Thank you once again on trusting us. We really look forward to service you again.</p> ";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);    
                    // Mail::send(new PurchaseThankyou($mainorder));            
                }
            }
            elseif ($status == "declined"){
                $stat['completed_at'] = null;

                if($mainorder->status == "cancellation request"){
                    $data = [
                        'to' => $mainorder->customer_email,
                        'subject' => 'Your order '.$mainorder->order_number.' has been cancelled!',
                        'body' => "<b>Hello ".$mainorder->customer_name.",</b>"."<br> We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                }
                else{
                    $gs = Generalsetting::findOrFail(1);
                    if($gs->is_smtp == 1)
                    {
                        $data = [
                            'to' => $mainorder->customer_email,
                            'subject' => 'Your order '.$mainorder->order_number.' is Declined!',
                            'body' => "<b>Hello ".$mainorder->customer_name.",</b>"."<br> We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                        ];
                        $mailer = new GeniusMailer();
                        $mailer->sendCustomMail($data);
                    }
                    else
                    {
                        $to = $mainorder->customer_email;
                        $subject = 'Your order '.$mainorder->order_number.' is Declined!';
                        $msg = "Hello ".$mainorder->customer_name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.";
                        $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                        mail($to,$subject,$msg,$headers);
                    }
                }

                $cart = unserialize(bzdecompress(utf8_decode($mainorder->cart)));
                
                foreach($cart->items as $item){
                    $product = Product::find($item['item']['id']);

                    if($product){
                        $product->stock += $item['qty'];
                        $product->save();
                    }
                }
            }
            else
                $stat['completed_at'] = null;

            $stat['status'] = $status;
            
            if ($status == "completed"){
                 $stat['payment_status'] = 'paid';
            }else{
                $stat['payment_status'] = ucfirst($status);
            }
         
       
            $order = VendorOrder::where('order_id','=',$id)->update(['status' => $status]);
            $mainorder->update($stat);
            return redirect()->back()->with('success','Order Status Updated Successfully');
        }
    }

    public function delivery($id,Request $request){
        // $this->validate($request, [
        //     'delivery_received_by' => 'required',
        //     'delivery_datetime' => 'required',
        //   ]);

          $datetime = Carbon::parse($request->delivery_datetime)->format('Y-m-d h:i:s');

          $order = Order::findorFail($id);
          $order->delivery_received_by = $request->delivery_received_by;
          $order->delivery_datetime = $datetime;

          $order->update();
          Mail::send(new DeliveryEmail($order));
          return redirect()->back()->with('success','Delivery Email Send Successfully');
    }

}
