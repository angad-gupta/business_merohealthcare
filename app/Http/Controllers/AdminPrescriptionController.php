<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Prescription;
use App\Classes\GeniusMailer;
use App\Generalsetting;
use App\PrescriptionInvoice;
use App\Currency;
use App\Product;
use App\Mail\CustomerPrescriptionInvoice;
use App\Mail\CustomerPrescriptionUpload;
use App\BusinessOrder;
use App\BusinessOrderInvoice;
use App\PrescriptionfilePrescription;
use Session;
use Mail;
use Carbon\Carbon;
use App\Notification;
use App\LabPrescription;

class AdminPrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    

    public function index()
    {
        $prescriptions = Prescription::where('type','=','medicine')->orderBy('id','desc')->get();
        return view('admin.prescriptions.index',compact('prescriptions'));
    }

    public function labindex()
    {
        $prescriptions = Prescription::where('type','=','lab')->orderBy('id','desc')->get();
        return view('admin.prescriptions.labindex',compact('prescriptions'));
    }

    public function show($id)
    {
        $prescription = Prescription::findOrFail($id);
        return view('admin.prescriptions.show',compact('prescription'));
    }

    public function labshow($id)
    {
        $prescription = Prescription::findOrFail($id);
        return view('admin.prescriptions.labshow',compact('prescription'));
    }

    public function invoice($id){
        // $order = Prescription::findOrFail($id);
        // return view('emails.prescriptioninvoice',compact('order'));

        $prescription = Prescription::findOrFail($id);
        $invoice = $prescription->invoice;
        
        return view('admin.prescriptions.invoice',compact('prescription','invoice'));
    }

    public function saveLabInvoice(Request $request, $id){
        // dd($request);
        $lab_pres = new LabPrescription();
        $lab_pres->user_id = $request->user_id;
        $lab_pres->prescription_id = $request->prescription_id;
        $lab_pres->status = $request->status;
        $lab_pres->vendor_id = $request->vendor_id;

        if($request->has('lab_ids')){
            foreach ($request->lab_ids as $id){
                $data[] = $id;
            }  
            $lab_pres->lab_id = json_encode($data);    
        }
        $lab_pres->save();

        $data = [
            'to' => $request->email,
            'subject' => 'Your Prescription order',
            'body' => "<b>Hello ".$request->name.",</b>"."<br> We have made suggested for prescription your lab prescription order. Login to your account to place your order. Thankyou.",
            ];
            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);

        return redirect()->back()->with('success','Lab Prescription Suggestion Send Successfully');

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
        
        $prescription = Prescription::findOrFail($id);
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

        $invoice = new PrescriptionInvoice;
        $invoice->items = json_encode($request->items);
        $invoice->amount = $total + $request->shipping_cost;
        $invoice->shipping_cost = $request->shipping_cost;
        $invoice->note = $request->note;
        $invoice->prescription_id = $id;

        $invoice->currency_sign = $curr->sign;
        $invoice->currency_value = $curr->value;
        $invoice->save();

        Mail::send(new CustomerPrescriptionInvoice($prescription,$invoice));

        return redirect()->back()->with('success','Prescription Invoice Updated Successfully');
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

    public function getPrescriptionFile($id, $filename,$pfid)
    {
        $prescription = Prescription::findOrFail($id);
        $pf= $prescription->files()->findOrFail($pfid);

        try{
            $path = \Storage::get('public/prescriptions/'.$pf->file);
            $mimetype = \Storage::mimeType('public/prescriptions/'.$pf->file);

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

        // dd($status);
        $mainorder = Prescription::findOrFail($id);
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
                        'body' => "<b>Hello ".$mainorder->name.",</b>"."<br> <p>Thank you choosing Merohealthcare as your service partner.</p> <p>Hope your prescription order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience here and help us to develop much better service experience for you.</p> <p>Thank you once again on trusting us. We really look forward to service you again.</p> ",
                    ];

                    $mailer = new GeniusMailer();
                    $mailer->sendCustomMail($data);                
                }
                else
                {
                    $to = $mainorder->email;
                    $subject = 'Your Prescription order '.$mainorder->id.' is Confirmed!';
                    $msg = "Hello ".$mainorder->name.","."\n <p>Thank you choosing Merohealthcare as your service partner.</p> <p>Hope your prescription order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience here and help us to develop much better service experience for you.</p> <p>Thank you once again on trusting us. We really look forward to service you again.</p> ";
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
}
