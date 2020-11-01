<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Classes\GeniusMailer;
use App\Generalsetting;
use App\PrescriptionInvoice;
use App\Currency;
use App\Product;
use App\Mail\CustomerPresciptionInvoice;
use App\BusinessOrder;
use App\User;
use App\BusinessOrderInvoice;
use Session;
use Mail;
use Carbon\Carbon;

class AdminBusinessOrderController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $business_prescriptions = BusinessOrder::orderBy('id','desc')->get();
        return view('admin.businessprescriptions.index',compact('business_prescriptions'));

    }

    public function businessindex(){
        $business_customers = User::where('user_type','=', 'Business')->where('verified_at','=', null)->orderBy('id','desc')->get();
        // dd($business_customers);
        return view('admin.businesscustomer.index',compact('business_customers'));

    }

    public function businessCustomerVerify($id){
        
        $business_customers_verify = User::findOrFail($id);
        // $now = Carbon::now()->format('Y-m-d h:i:s');
        $current_date_time = Carbon::now()->toDateTimeString();
        //  dd($now);
        $business_customers_verify->verified_at = $current_date_time;
        $business_customers_verify->save();
       
        // dd($business_customers_verify);
        return redirect('/admin/buisnesscustomers')->with('success','Business Customer Verified');
      

    }


    public function show($id)
    {
        // dd($id);
        $business_prescriptions = BusinessOrder::findOrFail($id);

        return view('admin.businessprescriptions.show',compact('business_prescriptions'));
    }

    public function invoice($id){
       
        // dd($id);
        $business_prescriptions = BusinessOrder::findOrFail($id);
        $invoice = $business_prescriptions->invoice;
        
        return view('admin.businessprescriptions.invoice',compact('business_prescriptions','invoice'));
    }


    
    private function CheckAvailability($purchases){
        foreach ($purchases as $prod) { 
            if(!$prod['id']) continue;

            $product = Product::where('status',1)->find($prod['id']);
            
            if(!$product){
                Session::flash('error', $prod['name'] . ' is no longer available.');
                return false;
            }
            
            $stock = $product->getOriginal('stock');

            if($stock != null){
                if($stock == 0){
                    Session::flash('error', $product->name . ' has already sold out');
                    return false;
                }

                if($prod['qty'] > $stock){
                    Session::flash('error', $product->name . ' only ' . $stock . ' in stock');
                    return false;
                }
            }
        }
        return true;
    }

    public function getBusinessCustomerRegFile($id, $filename)
    {
        // dd($id);
        $businesscustomer = User::findOrFail($id);
        // dd($businesscustomer);
       

        try{
            $path = \Storage::get('public/business_certificates/'.$filename);
            $mimetype = \Storage::mimeType('public/business_certificates/'.$filename);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function getBusinessorderRegFile($id, $filename)
    {
        
        $businessorder = BusinessOrder::findOrFail($id);
        // dd($businessorder);
       

        try{
            $path = \Storage::get('public/businessorders/'.$businessorder->reg_certificate_file);
            $mimetype = \Storage::mimeType('public/businessorders/'.$businessorder->reg_certificate_file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }



    public function getBusinessorderFile($id, $filename, $bfid)
    {
        $businessorder = BusinessOrder::findOrFail($id);
        $bf = $businessorder->files()->findOrFail($bfid);
       

        try{
            $path = \Storage::get('public/businessorders/'.$bf->file);
            $mimetype = \Storage::mimeType('public/businessorders/'.$bf->file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
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

    public function status($id,$status)
    {
        $mainorder = BusinessOrder::findOrFail($id);
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Prescription is Already Completed');
        }else{
            if ($status == "completed"){
                
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => $mainorder->email,
                        'subject' => 'Your Prescription order '.$mainorder->id.' is Confirmed!',
                        'body' => "<b>Hello ".$mainorder->name.",</b>"."<br> Thank you for shopping with us. We are looking forward to your next visit.",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);                
                }
                else
                {
                    $to = $mainorder->email;
                    $subject = 'Your Prescription order '.$mainorder->id.' is Confirmed!';
                    $msg = "Hello ".$mainorder->name.","."\n Thank you for shopping with us. We are looking forward to your next visit.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);                
                }
            }
            if ($status == "declined"){
                $gs = Generalsetting::findOrFail(1);
                if($gs->is_smtp == 1)
                {
                    $data = [
                        'to' => $mainorder->email,
                        'subject' => 'Your Prescription order '.$mainorder->id.' is Declined!',
                        'body' => "<b>Hello ".$mainorder->name.",</b>"."<br> We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                    ];
                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);
                }
                else
                {
                    $to = $mainorder->email;
                    $subject = 'Your Prescription order '.$mainorder->id.' is Declined!';
                    $msg = "Hello ".$mainorder->name.","."\n We are sorry for the inconvenience caused. We are looking forward to your next visit.";
                    $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
                    mail($to,$subject,$msg,$headers);
                }

            }

            $mainorder->status = $status;
            $mainorder->save();
            return redirect()->back()->with('success','Prescription Status Updated Successfully');
        }
    }

    public function saveInvoice(Request $request, $id){
        
        $this->validate($request,[
            'items' => 'required|min:1',
            'items.*.id' => 'nullable|exists:products,id',
            'items.*.name' => 'required',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:1',
            'shipping_cost' => 'required|min:0|numeric'
        ]);
        
        $prescription = BusinessOrder::findOrFail($id);
        if($prescription->invoice)
            return redirect()->back()->with('error','Invoice already exists.');
            

        if(!self::CheckAvailability($request->items))
            return redirect()->back()->with('error',Session::get('error'))->withInput($request->input());

        
        $total = 0;

        foreach($request->items as $prod)
        {
            $total += $prod['qty'] * $prod['price'];
            if(!$prod['id']) continue;

            $x = (string)$prod['qty'];
            if($x != null)
            {
                $product = Product::findOrFail($prod['id']);

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

        $curr = Currency::where('is_default','=',1)->first();

        $invoice = new BusinessOrderInvoice;
        $invoice->items = json_encode($request->items);
        $invoice->amount = $total + $request->shipping_cost;
        $invoice->shipping_cost = $request->shipping_cost;
        $invoice->note = $request->note;
        $invoice->business_order_id = $id;

        $invoice->currency_sign = $curr->sign;
        $invoice->currency_value = $curr->value;
        $invoice->save();

        Mail::send(new CustomerPresciptionInvoice($prescription,$invoice));

        return redirect()->back()->with('success','Prescription Invoice Updated Successfully');
    }

}
