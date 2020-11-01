<?php

namespace Modules\Lab\Http\Controllers;

use App\Classes\GeniusMailer;
use Modules\Lab\Entities\LabOrder as Order;
use Modules\Lab\Entities\LabOrderItem;
use App\Generalsetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class VendorOrderController extends Controller
{

    public function index()
    {
        $orders = Order::where('vendor_id',Auth::guard('user')->user()->id)->where('status','!=','pending')->orderBy('id','desc')->get();
        return view('lab::user.order.index',compact('orders'));
    }
    
    public function show($id)
    {
        $order = Order::where('vendor_id',Auth::guard('user')->user()->id)->where('status','!=','pending')->findOrFail($id);
        $items = $order->items;
        return view('lab::user.order.details',compact('order','items'));
    }

    public function invoice($id)
    {
        $order = Order::where('vendor_id',Auth::guard('user')->user()->id)->where('status','!=','pending')->findOrFail($id);
        $items = $order->items;
        return view('lab::user.order.invoice',compact('order','items'));
    }

    // public function emailsub(Request $request)
    // {
    //     $gs = Generalsetting::findOrFail(1);
    //     if($gs->is_smtp == 1)
    //     {
    //         $data = [
    //                 'to' => $request->to,
    //                 'subject' => $request->subject,
    //                 'body' => $request->message,
    //         ];

        

    //         $mailer = new GeniusMailer();
    //         $mailer->sendCustomMail($data);                
    //     }
    //     else
    //     {
    //         $data = 0;
    //         $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
    //         $mail = mail($request->to,$request->subject,$request->message,$headers);
    //         if($mail) {   
    //             $data = 1;
    //         }
    //     }

    //     return response()->json($data);
    // }

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
        $order = Order::where('vendor_id',Auth::guard('user')->user()->id)->where('status','!=','pending')->findOrFail($id);
        $items = $order->items;
        return view('lab::user.order.print',compact('order','items'));
    }

    public function status($id,$status)
    {
        $mainorder = Order::where('vendor_id',Auth::guard('user')->user()->id)->where('status','!=','pending')->findOrFail($id);
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
                        'body' => "<b>Hello ".$mainorder->customer_name.",</b>"."<br> Thank you for lab test order. Please check your account to see test report. We are looking forward to your next visit.",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);                
                }
                else
                {
                    $to = $mainorder->customer_email;
                    $subject = 'Your order '.$mainorder->order_number.' is Confirmed!';
                    $msg = "Hello ".$mainorder->customer_name.","."\n Thank you for shopping with us. We are looking forward to your next visit.";
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
            
            $mainorder->status = $status;
            $mainorder->save();
            return redirect()->back()->with('success','Order Status Updated Successfully');
        }
    }

    public function getReportFile($id, $filename)
    {
        $item = LabOrderItem::findOrFail($id);

        if($item->order->vendor_id != Auth::guard('user')->user()->id) abort(403);

        try{
            $path = \Storage::get('public/labreports/'.$item->report_file);
            $mimetype = \Storage::mimeType('public/labreports/'.$item->report_file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function uploadReportFile($id, Request $request){
        $item = LabOrderItem::findOrFail($id);

        if($item->order->vendor_id != Auth::guard('user')->user()->id) abort(403);

        $this->validate($request,[
            'file' => 'required|mimes:jpg,png,jpeg,pdf'
        ]);
        
        if($request->hasFile('file')){
            $file = $request->file('file');

            $filenameWithExt = $file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/labreports', $filename);
            $item->report_file = $filename;

            $item->save();

            return redirect()->back()->with('success','Report has been uploaded.');
   
        }
        return redirect()->back()->with('unsuccess','Please upload a valid file.');

    }

    public function removeReportFile($id)
    {
        $item = LabOrderItem::findOrFail($id);

        if($item->order->vendor_id != Auth::guard('user')->user()->id) abort(403);

        if (file_exists(storage_path().'/app/public/labreports/'.$item->report_file)) {
            unlink(storage_path().'/app/public/labreports/'.$item->report_file);
        }

        $item->report_file = null;
        $item->save();

        return redirect()->back()->with('success','Report has been deleted.');
    }

}
