<?php

namespace Modules\Lab\Http\Controllers;

use App\Classes\GeniusMailer;
use Modules\Lab\Entities\LabOrder as Order;
use Modules\Lab\Entities\LabOrderItem;
use App\User;
use App\Generalsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $orders = Order::where('status','!=','pending')->orderBy('id','desc')->get();
        return view('lab::admin.order.index',compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::where('status','!=','pending')->findOrFail($id);
        $items = $order->items;
        return view('lab::admin.order.details',compact('order','items'));
    }

    public function invoice($id)
    {
        $order = Order::where('status','!=','pending')->findOrFail($id);
        $items = $order->items;        
        return view('lab::admin.order.invoice',compact('order','items'));
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
        $order = Order::where('status','!=','pending')->findOrFail($id);
        $items = $order->items;
        
        return view('lab::admin.order.print',compact('order','items'));
    }

    public function status($id,$status)
    {
        $mainorder = Order::where('status','!=','pending')->findOrFail($id);
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }else{
        if ($status == "completed"){
            // $vorder = $mainorder->vendor;

            // $uprice = User::findOrFail($vorder->id);
            // $uprice->current_balance = $uprice->current_balance + $mainorder->pay_amount;
            // $uprice->update();

            $gs = Generalsetting::findOrFail(1);
            if($gs->is_smtp == 1)
            {
                $data = [
                    'to' => $mainorder->customer_email,
                    'subject' => 'Your order '.$mainorder->order_number.' is Confirmed!',
                    'body' => "<b>Hello ".$mainorder->customer_name.",</b>"."<br> <p>Thank you choosing Merohealthcare as your service partner.</p> <p>Hope your lab order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience here and help us to develop much better service experience for you.</p> <p>Thank you once again on trusting us. We really look forward to service you again.</p> ",
                ];

                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($data);                
            }
            else
            {
                $to = $mainorder->customer_email;
                $subject = 'Your order '.$mainorder->order_number.' is Confirmed!';
                $msg = "Hello ".$mainorder->customer_name.","."\n <p>Thank you choosing Merohealthcare as your service partner.</p> <p>Hope your lab order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience here and help us to develop much better service experience for you.</p> <p>Thank you once again on trusting us. We really look forward to service you again.</p> ";
                $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                mail($to,$subject,$msg,$headers);                
            }
        }
        if ($status == "declined"){
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
        // $stat['payment_status'] = ucfirst($status);
        
        $mainorder->status = $status;
        $mainorder->save();
        return redirect()->back()->with('success','Order Status Updated Successfully');
        }
    }

    public function getReportFile($id, $filename)
    {
        $order = LabOrderItem::findOrFail($id);

        try{
            $path = \Storage::get('public/labreports/'.$order->report_file);
            $mimetype = \Storage::mimeType('public/labreports/'.$order->report_file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

}
