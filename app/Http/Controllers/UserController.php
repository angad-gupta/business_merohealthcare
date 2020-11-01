<?php

namespace App\Http\Controllers;

use App\AdminUserConversation;
use App\AdminUserMessage;
use App\Category;
use App\Classes\GeniusMailer;
use App\Conversation;
use App\Currency;
use App\FavoriteSeller;
use App\Generalsetting;
use App\Http\Requests\StoreValidationRequest;
use App\Http\Requests\UpdateValidationRequest;
use App\Language;
use App\Message;
use App\Notification;
use App\Order;
use App\Product;
use App\Subscription;
use App\User;
use App\UserNotification;
use App\UserSubscription;
use App\VendorOrder;
use App\Wishlist;
use App\Prescription;
use App\Family;
use App\BusinessOrder;
use App\Prescriptionfile;
use App\Folder;
use App\VendorDescription;
use App\PrescriptionfilePrescription;
use Auth;
use Carbon\Carbon;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Mail\CustomerPrescriptionUpload;
use App\Mail\CustomerPrescriptionCancelled;
use App\Mail\PasswordSuccess;
use Mail;

use Modules\Lab\Entities\LabCart as Cart;
use Modules\Lab\Entities\LabProductUser as LabProduct;



class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:user');
    }

    public function index()
    {
    	$user = Auth::guard('user')->user();
        $complete = $user->orders()->where('status','=','completed')->get()->count();
        $process = $user->orders()->where('status','=','processing')->get()->count();
        $wishes =$user->wishlists ;
        $currency_sign = Currency::where('is_default','=',1)->first();
        // $family= Family::where('user_id','=',$user->id)->get();
        $files = Prescriptionfile::where('user_id','=',$user->id)->get();
        $message = AdminUserConversation::where('user_id','=',$user->id)->get();
        return view('user.dashboard',compact('user','complete','process','wishes','currency_sign','files','message'));
    }

    public function profile()
    {
    	$user = Auth::guard('user')->user();
        return view('user.profile',compact('user'));
    }

    public function filemanager()
    {
        $user = Auth::guard('user')->user();
        $p_folder = Folder::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        $pfiles = PrescriptionFile::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.filemanager.index',compact('user','p_folder', 'pfiles'));
    }

    public function updatefilemanager($id)
    {
        // dd($id);

        $user = Auth::guard('user')->user();
        $p_fileupdate = Folder::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_fileupdate);
        if($p_fileupdate->status == 'active'){
            $p_fileupdate->status = 'inactive';
        }

        $p_fileupdate->save();

    
        // dd($p_fileupdatefiles);
        foreach($p_fileupdate->files as $pff){

            if($pff->status == 'active'){
                $pff->status = 'inactive';
            }
            $pff->save();

        }
        
        

        // $p_file = PrescriptionFile::where('user_id','=',$user->id)->get();

        return redirect()->back()->with('success','Family File Deleted Successfully');
    }

    public function updatefilemanagertitle(Request $request, $id)
    {
        // dd($request->title);
        $user = Auth::guard('user')->user();
        $p_fileupdate = Folder::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_fileupdate);
        $p_fileupdate->title = $request->title;
        $p_fileupdate->save();

        foreach($p_fileupdate->files as $pff){
            $pff->title = $request->title;
            $pff->save();
        }

        // $p_file = PrescriptionFile::where('user_id','=',$user->id)->get();

        return redirect()->back()->with('success','Family Title Updated Successfully');
    }

    public function updatefilemanagersingle($id)
    {
        // dd($id);
        $user = Auth::guard('user')->user();
        $p_fileupdate = PrescriptionFile::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_fileupdate);
        if($p_fileupdate->status == 'active'){
            $p_fileupdate->status = 'inactive';
        }

        elseif($p_fileupdate->status == 'inactive'){
            $p_fileupdate->status = 'active';
        }
        
        $p_fileupdate->save();

        // $p_file = PrescriptionFile::where('user_id','=',$user->id)->get();

        return redirect()->back()->with('success','Family File Deleted Successfully');
    }

    public function updatefilemanagertitlesingle(Request $request, $id)
    {
        // dd($request->title);
        $user = Auth::guard('user')->user();
        $p_fileupdate = PrescriptionFile::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_fileupdate);
        $p_fileupdate->title = $request->title;
        $p_fileupdate->save();

        // $p_file = PrescriptionFile::where('user_id','=',$user->id)->get();

        return redirect()->back()->with('success','Family Title Updated Successfully');
    }

    public function orders()
    {
        $user = Auth::guard('user')->user();
        $orders = Order::where('user_id','=',$user->id)->where('status','!=','pending')->orderBy('id','desc')->get();
        return view('user.orders',compact('user','orders'));
    }

    public function requestCancellation($id)
    {
        $user = Auth::guard('user')->user();

        $order = Order::where('user_id','=',$user->id)->where('status','!=','pending')->findOrFail($id);

        if ($order->status == 'cancellation request')
            return redirect()->back()->with('unsuccess','You have already requested for cancellation');
        elseif ($order->status == 'processing' || ($order->status == 'completed' && $order->completed_at > Carbon::today()->subDays(1))){
            $order->status = 'cancellation request';
            $order->save();
            return redirect()->back()->with('success','You have successfully requested cancellation for the order. We will contact you soon.');
        }
        else
            return redirect()->back()->with('unsuccess','You have cannot cancellation request for this order.');

        return view('user.orders',compact('user','orders'));
    }

    public function family()
    {
        $user = Auth::guard('user')->user();
     
        $p_file = PrescriptionFile::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        $family = $user->family;
        // $family_name = Family::where('user_id','=',$user->id)->where('id','=', 41)->get(); 
        // dd($family_name[0]->relation);
        return view('user.family.index',compact('user','family','p_file'));
    }

    public function createFamily()
    {
       
        return view('user.family.createfamily');
    }

    public function storeFamily(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|string|max:191',
            'relation' => 'required',

            'dob' => 'required',
            // 'age' => 'required|integer|min:1',
            'gender' => 'required|in:Male,Female,Other'
        ]);
        
        
        $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;
        // dd($name);
        $user = Auth::guard('user')->user();
        $family = new Family();
        $family->name = $name;
        $family->dob = $request->dob;
        $family->email = $request->email;
        $family->phone = $request->phone;
        $family->gender = $request->gender;
        $family->relation = $request->relation;
        $family->user_id = $user->id;
        $family->save();

        return redirect()->route('user-family.index')->with('success','Family Information added Successfully');
    }

    // public function storeFamily(Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|string|max:191',
    //         'relation' => 'required',
    //         'age' => 'required|integer|min:1',
    //         'gender' => 'required|in:Male,Female,Other'
    //     ]);

       
    //     $user = Auth::guard('user')->user();
    //     // $name = $request->name.' '.$request->relation;
      
    //     // dd($name);
    //     $family = $user->family()->create($request->all());
      
    //     return redirect()->back()->with('success','Family Information added Successfully')->with('defaultFamily',$family);
    // }

    public function storeManyFamily(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'familys.*.name' => 'required|string|max:191',
            'familys.*.relation' => 'required',
            'familys.*.age' => 'required|integer|min:1',
            'familys.*.gender' => 'required|in:Male,Female,Other'
        ],[
            'familys.*.name.required' => 'This filed is required',
            'familys.*.relation.required' => 'This filed is required',
            'familys.*.age.required' => 'This filed is required',
            'familys.*.gender.required' => 'This filed is required',

            'familys.*.age.integer' => 'This filed is invalid',
            'familys.*.age.min' => 'This filed is invalid',
            'familys.*.gender.in' => 'This filed is invalid',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator,'familys')->withInput();
        }

        $user = Auth::guard('user')->user();
        $user->family()->createMany($request->familys);
        return redirect()->route('user-family.index')->with('success','Family Information added Successfully');;
    }

    public function editFamily($id)
    {
        $user = Auth::guard('user')->user();
        
        $member = $user->family()->findOrFail($id);
        $str = $member->name;
        $name = explode(" ", $str);
        $lastname = array_pop($name);
        $firstname = implode(" ", $name);
        // dd($firstname);
        
        
        
        return view('user.family.edit',compact('member','firstname','lastname'));
    }

    public function updateFamily($id,Request $request)
    {

        
        $this->validate($request, [
            'firstname' => 'required|string|max:191',
            
            'relation' => 'required',
            // 'age' => 'required|integer|min:1',
            'dob' => 'required',
            'gender' => 'required|in:Male,Female,Other'
        ]);

        // dd($request);
        $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;    
        $user = Auth::guard('user')->user();

        $family = Family::find($id);
        $family->name = $name;
        $family->dob = $request->dob;
        $family->gender = $request->gender;
        $family->relation = $request->relation;
        $family->user_id = $user->id;
        $family->save();
        
        // $family = $user->family()->findOrFail($id);

        // $family->update($request->all());

        return redirect()->route('user-family.index')->with('success','Family Information updated Successfully');;
    }

    // public function updateFamily($id,Request $request)
    // {
    //     $this->validate($request, [
    //         'name' => 'required|string|max:191',
    //         'relation' => 'required',
    //         'age' => 'required|integer|min:1',
    //         'gender' => 'required|in:Male,Female,Other'
    //     ]);

    //     $user = Auth::guard('user')->user();
        
    //     $family = $user->family()->findOrFail($id);

    //     $family->update($request->all());

    //     return redirect()->route('user-family.index')->with('success','Family Information updated Successfully');;
    // }

    public function deleteFamily($id)
    {

        // dd($id);
        $user = Auth::guard('user')->user();
        
        $family = $user->family()->findOrFail($id);
        $family->delete();

        return redirect()->route('user-family.index')->with('success','Family Information deleted Successfully');
    }

    public function getfamilyprescriptions(Request $request)
    {
       
        // dd($request);
        $user = Auth::guard('user')->user();
        $family_id = $request->family_id;
        // dd($family_id);
        $prescriptions = Prescription::where('family_id','=',$family_id)->where('user_id','=',$user->id)->orderBy('id','desc')->get();
        $families = Family::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.prescriptions.index',compact('user','prescriptions','families'));
        

    }

    public function getfamilyfilterprescriptions($id)
    {
       
        $user = Auth::guard('user')->user();
        $family_id = $id;
        $prescriptions = Prescription::where('family_id','=',$family_id)->orderBy('id','desc')->get();
        
        $families = Family::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.prescriptions.index',compact('user','prescriptions','families','family_id'));
        

    }


    public function getfamilyfilterfile($id)
    {
       
        $user = Auth::guard('user')->user();
        $f_id = $id;
        $p_folder = Folder::where('family_id','=',$id)->orderBy('id','desc')->get();
        $pfiles = PrescriptionFile::where('family_id','=',$id)->orderBy('id','desc')->get();
        // dd($prescriptionfiles);

        return view('user.filemanager.index',compact('user','p_folder','pfiles','f_id'));
        

    }



    public function businessorders()
    {
        $user = Auth::guard('user')->user();
        $products = Product::all();
        // dd($user);
        $businessorders = BusinessOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.businessorders.index',compact('user','businessorders','products'));
    }


    public function prescriptions()
    {
        $user = Auth::guard('user')->user();
        $prescriptions = Prescription::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        // $families = Family::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.prescriptions.index',compact('user','prescriptions'));
    }

    public function labprescriptions()
    {
        $user = Auth::guard('user')->user();
        $prescriptions = Prescription::where('user_id','=',$user->id)->where('type','=','lab')->orderBy('id','desc')->get();
        // $families = Family::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        return view('user.prescriptions.labindex',compact('user','prescriptions'));
    }

    public function labtestredirect(Request $request){
        // dd($request);
        Session::forget('lab_cart');

        $ids = $request->lab_ids;
        // dd($ids);

        $vendor_id = $request->vendor_id;

        // if($vendor_id == null){
        //     return redirect()->route('lab.cart'); 
        // }


        $cart = new Cart(null);

        foreach($ids as $id){
            $prod = LabProduct::where('user_id','=',$vendor_id)->where('product_id','=',$id)->where('status',1)->first();
            
            $prod->price = $prod->cprice;
            $prod->name = $prod->type->name;

            $cart->add($prod, $prod->id);
        }

        Session::put('lab_cart',$cart);

        return redirect()->route('lab.cart'); 
    }



    public function prescriptionInvoice($id)
    {
        
        $user = Auth::guard('user')->user();
        $prescription = Prescription::where('user_id','=',$user->id)->findOrFail($id);
        $family_id = $prescription->family_id;
        $invoice = $prescription->invoice;
        // dd($invoice);
        
        if($invoice)
            return view('user.prescriptions.invoice',compact('invoice','prescription'));
        else
            return redirect()->route('user-prescriptions.index');
    }

    public function uploadPrescriptionPage(){
        $user = Auth::guard('user')->user();
        $prescriptions = PrescriptionFile::where('user_id','=',$user->id)->orderBy('id','desc')->get();
        // dd($prescriptions);
       
        return view('user.prescriptions.create', compact('prescriptions'));
    }

    public function uploadPrescriptionPagefamily($id){
        // dd($id)
        $user = Auth::guard('user')->user();
        $family = Family::findOrFail($id);
        // $fid = $id;
        // dd($family);
        $prescriptions = PrescriptionFile::where('family_id','=',$id)->orderBy('id','desc')->get();
        return view('user.family.create', compact('family','prescriptions'));
    }


    public function updateBusinessorderstatus($id){
        // dd($id);
        $user = Auth::guard('user')->user();
        $p_status = BusinessOrder::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_status);
        $p_status->status = "cancelled";
        $p_status->save();
    
        return redirect('/user/businessorders')->with('success','Business Order Cancelled Successfully');
    }

   

    public function updatePrescriptionstatus($id){
        // dd($id);
        $user = Auth::guard('user')->user();
        $p_status = Prescription::where('user_id','=',$user->id)->findOrFail($id);
        // dd($p_status);
        $p_status->status = "cancelled";
        $p_status->save();

        Mail::send(new CustomerPrescriptionCancelled($user));
    
        return redirect()->route('user-prescriptions.index')->with('success','Prescription Cancelled Successfully');
    }

    public function uploadPrescriptionFile(Request $request, $id){

        // dd($request);

        $this->validate($request, [
          
            'filename.*' => 'mimes:doc,pdf,docx,jpeg,jpg,png,pdf'
            
     
        ]);

        $folder_title = new Folder;
        $folder_title->title = $request->title;
        $folder_title->family_id = $request->family;
        $folder_title->user_id = $id;
        $folder_title->save();


        if($request->hasFile('filename')){
            foreach ($request->filename as $reg_certificate_file){


            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/prescriptions', $filename);
            

            // $pfupload = new PrescriptionFile;
            // $pfupload->file = $filename;
            // $pfupload->title = $request->title;
        
            // // dd($pfupload->file);
            // $pfupload->user_id = $id;
            // $pfupload->save();

            $pfupload = new PrescriptionFile;
            $pfupload->folder_id = $folder_title->id;
            $pfupload->title = $folder_title->title;
            $pfupload->file = $filename;
            // $pfupload->family_id = $fid;
            // dd($pfupload->file);
            $pfupload->user_id = $id;
            $pfupload->save();
            
         
          
            }
        }
        // dd($request->filename);


        
        
        return redirect()->route('user-prescriptions.family-file-filter',$request->family)->with('success','File Uploaded Successfully');

    }

    public function uploadPrescriptionFamilyFile(Request $request,$id, $fid){
        
        // dd($fid);
        $this->validate($request, [
          
            'filename.*' => 'mimes:doc,pdf,docx,jpeg,jpg,png,pdf',
            'title'=>'required'
     
        ]);

        $folder_title = new Folder;
        $folder_title->title = $request->title;
        $folder_title->family_id = $fid;
        $folder_title->user_id = $id;
        $folder_title->save();




        if($request->hasFile('filename')){
            foreach ($request->filename as $reg_certificate_file){


            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/prescriptions', $filename);
            

            $pfupload = new PrescriptionFile;
            $pfupload->folder_id = $folder_title->id;
            $pfupload->title = $folder_title->title;
            $pfupload->file = $filename;
            $pfupload->family_id = $fid;
            // dd($pfupload->file);
            $pfupload->user_id = $id;
            $pfupload->save();
            
         
          
            }
        }
        // dd($request->filename);
     return redirect('/user/family')->with('success','Family Prescription File Uploaded Successfully');

    }

    public function uploadPrescriptionFamilyFileSingle(Request $request,$id){
        
        // dd($request);
        $this->validate($request, [
          
            'filenames.*' => 'mimes:doc,pdf,docx,jpeg,jpg,png,pdf',
            'title'=>'required'
     
        ]);

        $folder_title = new Folder;
        $folder_title->title = $request->title;
        $folder_title->user_id = $id;
        $folder_title->save();

        if($request->hasFile('filenames')){
            foreach ($request->filenames as $reg_certificate_file){


            $filenameWithExt = $reg_certificate_file->getClientOriginalName();
            $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
            $path = $reg_certificate_file->storeAs('public/prescriptions', $filename);
            

            $pfupload = new PrescriptionFile;
            $pfupload->folder_id = $folder_title->id;
            $pfupload->title = $folder_title->title;
            $pfupload->file = $filename;
            // dd($pfupload->file);
            $pfupload->user_id = $id;
            $pfupload->save();
            
         
          
            }
        }
        // dd($request->filename);
     return redirect()->route('user-filemanager',$request->family)->with('success','Prescription File Uploaded Successfully');

    }

    public function uploadPrescription(Request $request){

        // dd($request);
        // dd($request->fileid);
        $user = Auth::user();
        $gs = Generalsetting::findOrFail(1);

        $this->validate($request, [
            'title' => 'required|string|max:191',
            'location' => 'required|string|max:191',
            'phone' => 'required',
            'filenames.*' => 'mimes:doc,pdf,docx,zip,jpeg,jpg,png,pdf',
            // 'family' => 'nullable|exists:families,id,user_id,'.$user->id,
            // 'duration' => 'nullable|required_if:reminderCheck,1|min:1'
        ]);
        
        $prescription = new Prescription;
        $prescription->title = $request->title;
        $prescription->name = $user->name;
        $prescription->email = $user->email;
        $prescription->phone = $request->phone;
        $prescription->location = $request->location;
        $prescription->latlong = $request->latlong;
        $prescription->additional_info = $request->additional_info;
        $prescription->user_id = $user->id;
        // $prescription->family_id = $request->family;
        $prescription->status = 'processing';
        $prescription->type = $request->type;

        $prescription->save();
        // dd("asd");
        
        //  dd($prescription->id);
        if($request->has('fileid')){
            foreach ($request->fileid as $fid){

            $pid = new PrescriptionfilePrescription;

            $pid->prescription_id = $prescription->id;
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

            
            $prescription_file = new Prescriptionfile;
            $prescription_file->title = $request->title;
            $prescription_file->user_id = $user->id;
          
            $prescription_file->file = $filename;

            $prescription_file->save();

            $pid = new PrescriptionfilePrescription;
            
          

            $pid->prescription_id = $prescription->id;
            $pid->prescriptionfile_id = $prescription_file->id;
            $pid->save();
          
            }
        }

      
        

        // if($request->reminderCheck){
            $data['duration'] = 15;
            $data['start_date'] = Carbon::today();
            $prescription->reminder()->create($data);
        // }

        $notification = new Notification;
        $notification->prescription_id = $prescription->id;
        $notification->save();

        Mail::send(new CustomerPrescriptionUpload($user));

        if($gs->is_smtp == 1)
        {
            $data = [
                'to' => $gs->email,
                'subject' => "New Prescription Order Recieved!!",
                'body' => "<b>Hello Admin!</b><br>Your store has received a new prescription order. Please login to your panel to check.",
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        }
        else
        {
           $to = $gs->email;
           $subject = "New Prescription Order Recieved!!";
           $msg = "Hello Admin!\nYour store has recieved a new prescription order. Please login to your panel to check. \nThank you.";
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
           mail($to,$subject,$msg,$headers);
        }

        return redirect()->route('user-prescriptions.index',$request->family)->with('success','Thanks for your prescription we will come back to you at earliest.');
    }

    public function prescriptionReorder($id)
    {

        // dd($id);
        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);

        $prescription_files = PrescriptionfilePrescription::where('prescription_id','=', $id)->get();

        // foreach($prescription_files as $pf){
        // dd($pf);
        // }

        $new_prescription = new Prescription;
        $new_prescription->title = $prescription->title;
        $new_prescription->name = $prescription->name;
        $new_prescription->email = $prescription->email;
        $new_prescription->phone = $prescription->phone;
        $new_prescription->location = $prescription->location;
        $new_prescription->additional_info = $prescription->additional_info;
        $new_prescription->file = $prescription->file;
        $new_prescription->user_id = $prescription->user_id;
        $new_prescription->family_id = $prescription->family_id;
        $new_prescription->status = 'processing';

   

        $new_prescription->save();

        foreach($prescription_files as $pf){
            $new_prescription_file = new PrescriptionfilePrescription;
            $new_prescription_file->prescription_id = $new_prescription->id;
            $new_prescription_file->prescriptionfile_id = $pf->prescriptionfile_id;
            $new_prescription_file->save();

            // dd($new_prescription_file);
        }

        $notification = new Notification;
        $notification->prescription_id = $new_prescription->id;
        $notification->save();

       $family_id = $prescription->family_id;

       $data = [
        'to' => $prescription->email,
        'subject' => 'Your Prescription order '.$new_prescription->id.' is Reordered!',
        'body' => "<b>Hello ".$prescription->name.",</b>"."<br> We have made Reorder for prescription order. We will serve at the earliest. Thankyou.",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);

        

        
        // $new_prescription_file->prescriptionfile_id = $prescription_files


        return redirect()->route('user-prescriptions.index')->with('success','Prescription Re-Ordered Successfully');
    }

    public function labprescriptionReorder($id)
    {

        // dd($id);
        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);

        $prescription_files = PrescriptionfilePrescription::where('prescription_id','=', $id)->get();

        // foreach($prescription_files as $pf){
        // dd($pf);
        // }

        $new_prescription = new Prescription;
        $new_prescription->title = $prescription->title;
        $new_prescription->name = $prescription->name;
        $new_prescription->email = $prescription->email;
        $new_prescription->phone = $prescription->phone;
        $new_prescription->location = $prescription->location;
        $new_prescription->additional_info = $prescription->additional_info;
        $new_prescription->file = $prescription->file;
        $new_prescription->user_id = $prescription->user_id;
        $new_prescription->family_id = $prescription->family_id;
        $new_prescription->status = 'processing';
        $new_prescription->type = 'lab';

   

        $new_prescription->save();

        foreach($prescription_files as $pf){
            $new_prescription_file = new PrescriptionfilePrescription;
            $new_prescription_file->prescription_id = $new_prescription->id;
            $new_prescription_file->prescriptionfile_id = $pf->prescriptionfile_id;
            $new_prescription_file->save();

            // dd($new_prescription_file);
        }

        $notification = new Notification;
        $notification->prescription_id = $new_prescription->id;
        $notification->save();

       $family_id = $prescription->family_id;

       $data = [
        'to' => $prescription->email,
        'subject' => 'Your Lab Prescription order '.$new_prescription->id.' is Reordered!',
        'body' => "<b>Hello ".$prescription->name.",</b>"."<br> We have made Reorder for lab prescription order. We will serve at the earliest. Thankyou.",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);

        

        
        // $new_prescription_file->prescriptionfile_id = $prescription_files


        return redirect()->route('user-lab-prescriptions.index')->with('success','Lab Prescription Re-Ordered Successfully');
    }


    

    public function getPrescriptionFile($id, $filename,$pfid)
    {
        
        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);
      
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

    public function getFile($file)
    {
        // dd($file);

        try{
            $path = \Storage::get('public/prescriptions/'.$file);
            
            $mimetype = \Storage::mimeType('public/prescriptions/'.$file);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function prescriptionReminderAdd($id,Request $request){
        $this->validate($request, [
            'duration' => 'required|min:1'
        ]);

        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);

        $data['duration'] = $request->duration;
        $data['start_date'] = Carbon::parse($prescription->created_at)->startOfDay();
        $prescription->reminder()->create($data);

        return redirect()->route('user-prescriptions.index')->with('success','Prescription Reminder Added Successfully');
    }

    public function prescriptionReminderUpdate($id,Request $request){

        $validator = Validator::make($request->all(),[
            'duration' => 'required|min:1',
            'status' => 'nullable|in:0,1'
        ],[
            
            'status.in' => 'This filed is invalid'
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator,'edit')->withInput();
        }

        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);

        $data['duration'] = $request->duration;
        $data['status'] = $request->status ? 1 : 0;
        $prescription->reminder()->update($data);

        return redirect()->route('user-prescriptions.index')->with('success','Prescription Reminder Updated Successfully');
    }

    public function prescriptionReminderDelete($id,Request $request){
        $prescription = Auth::guard('user')->user()->prescriptions()->findOrFail($id);

        $prescription->reminder()->delete();

        return redirect()->route('user-prescriptions.index')->with('success','Prescription Reminder Deleted Successfully');
    }

    public function messages()
    {
        $user = Auth::guard('user')->user();

        $convs = Conversation::where('sent_user','=',$user->id)->orWhere('recieved_user','=',$user->id)->get();
        return view('user.messages',compact('user','convs'));            
    }

    public function message($id)
    {
            $user = Auth::guard('user')->user();
            $conv = Conversation::findOrfail($id);
            return view('user.message',compact('user','conv'));                 
    }
    public function messagedelete($id)
    {
            $conv = Conversation::findOrfail($id);
            if($conv->messages->count() > 0)
            {
                foreach ($conv->messages as $key) {
                    $key->delete();
                }
            }
            if($conv->notifications->count() > 0)
            {
                foreach ($conv->notifications as $key) {
                    $key->delete();
                }
            }
            $conv->delete();
            return redirect()->back()->with('success','Message Deleted Successfully');                 
    }
    public function postmessage(Request $request)
    {
        $msg = new Message();
        $input = $request->all();  
        $msg->fill($input)->save();
        $notification = new UserNotification;
        $notification->user_id= $request->reciever;
        $notification->conversation_id = $request->conversation_id;
        $notification->save();
        Session::flash('success', 'Message Sent!');
        return redirect()->back();
    }
    public function emailsub(Request $request)
    {
        $user = Auth::guard('user')->user();
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
    public function order($id)
    {
        $user = Auth::guard('user')->user();
        $order = Order::findOrfail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order',compact('user','order','cart'));
    }

    public function orderdownload($slug,$id)
    {
        $user = Auth::guard('user')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $prod = Product::findOrFail($id);
        if(!isset($order) || $prod->type == 0 || $order->user_id != $user->id)
        {
            return redirect()->back();
        }
        return response()->download(public_path('assets/files/'.$prod->file));
    }

    public function orderprint($id)
    {
        $user = Auth::guard('user')->user();
        $order = Order::findOrfail($id);
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.print',compact('user','order','cart'));
    }
    public function vendororders()
    {
        $user = Auth::guard('user')->user();
        $orders = VendorOrder::where('user_id','=',$user->id)->orderBy('id','desc')->get()->groupBy('order_number');

        return view('user.order.index',compact('user','orders'));
    }
    public function vendorlicense(Request $request, $slug)
    {
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        $cart->items[$request->license_key]['license'] = $request->license;
        $order->cart = utf8_encode(bzcompress(serialize($cart), 9));
        $order->update();         
        return redirect()->route('vendor-order-show',$order->order_number)->with('success','Successfully Changed The License Key.');
    }
    public function vendororder($slug)
    {
        $user = Auth::guard('user')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.details',compact('user','order','cart'));
    }
    public function invoice($slug)
    {
        $user = Auth::guard('user')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.invoice',compact('user','order','cart'));
    }
    public function printpage($slug)
    {
        $user = Auth::guard('user')->user();
        $order = Order::where('order_number','=',$slug)->first();
        $cart = unserialize(bzdecompress(utf8_decode($order->cart)));
        return view('user.order.print',compact('user','order','cart'));
    }
    public function status($slug,$status)
    {
        $mainorder = VendorOrder::where('order_number','=',$slug)->first();
        if ($mainorder->status == "completed"){
            return redirect()->back()->with('success','This Order is Already Completed');
        }else{
            $user = Auth::guard('user')->user();
            $order = VendorOrder::where('order_number','=',$slug)->where('user_id','=',$user->id)->update(['status' => $status]);
            return redirect()->route('vendor-order-index')->with('success','Order Status Updated Successfully');
        }
    }
    public function resetform()
    {
        $user = Auth::guard('user')->user();
        return view('user.reset',compact('user'));
    }

    public function shop()
    {
        $user = Auth::guard('user')->user();
        return view('user.shop-description',compact('user'));
    }

    public function shopup(Request $request)
    {
        $input = $request->all();  
        $user = Auth::guard('user')->user();
        $user->update($input);
        Session::flash('success', 'Successfully updated the data');
        return redirect()->back();
    }

    public function settings()
    {
        $user = Auth::guard('user')->user();
        return view('user.ship',compact('user'));
    }

    public function settings_vendor_description()
    {
        $user = Auth::guard('user')->user();
    
        return view('user.vendor_description',compact('user'));
    }

    public function affilate_code()
    {
        $user = Auth::guard('user')->user();
        return view('user.affilate_code',compact('user'));
    }

    public function settingsUpdate(Request $request)
    {
        $this->validate($request,[
            'service_areas' => 'required|array|min:1'
        ]);
        
        $input = $request->all();  
        $input['service_areas'] = json_encode($request->service_areas);
        $user = Auth::guard('user')->user();
        $user->update($input);
        Session::flash('success', 'Successfully updated the data');
        return redirect()->back();
    }

    // public function settings_vendor_description_create(Request $request)
    // {
    //     // dd($request);
    //     $user = Auth::guard('user')->user();
    //     $vendor = new VendorDescription;
    //     $vendor->user_id = $user->id;
    //     $vendor->description = $request->description;
    //     $vendor->link = $request->link;
    //     $vendor->save();
  
    //     Session::flash('success', 'Successfully Created vendor description ');
    //     return redirect()->back();
    // }
    

    public function settings_vendor_description_update(Request $request, $id)
    {
        // dd($id);
        $user = Auth::guard('user')->user();
        // dd($id);
        $vendor = User::findOrFail($id);
        // $vendor->user_id = $user->id;
        $vendor->description = $request->description;
        $vendor->link = $request->link;
        $vendor->save();
  
        Session::flash('success', 'Successfully updated vendor description ');
        return redirect()->back();
    }

    public function reset(Request $request)
    {
        $input = $request->all();  
        $user = Auth::guard('user')->user();
         if($user->is_provider == 1)
         {
            return redirect()->back();
         }
        if ($request->cpass){
            if (Hash::check($request->cpass, $user->password)){
                if ($request->newpass == $request->renewpass){
                    $input['password'] = Hash::make($request->newpass);
                }else{
                    Session::flash('unsuccess', 'Confirm password does not match.');
                    return redirect()->back();
                }
            }else{
                Session::flash('unsuccess', 'Current password Does not match.');
                return redirect()->back();
            }
        }
        $user->update($input);
        Mail::send(new PasswordSuccess($user));
        Session::flash('success', 'Successfully updated your password');
        return redirect()->back();
    }


    public function package()
    {
        $user = Auth::guard('user')->user();
        $subs = Subscription::all();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        return view('user.package',compact('user','subs','package'));
    }


    public function vendorrequest($id)
    {
        $subs = Subscription::findOrFail($id);
        $gs = Generalsetting::findOrfail(1);
        $user = Auth::guard('user')->user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        if($gs->reg_vendor != 1)
        {
            return redirect()->back();
        }
        return view('user.vendor-request',compact('user','subs','package'));
    }

    public function vendorrequestsub(StoreValidationRequest $request)
    {
        $this->validate($request, [
            'shop_name'   => 'unique:users',
           ],[ 
               'shop_name.unique' => 'This shop name has already been taken.'
            ]);
        $user = Auth::guard('user')->user();
        $package = $user->subscribes()->where('status',1)->orderBy('id','desc')->first();
        $subs = Subscription::findOrFail($request->subs_id);
        $settings = Generalsetting::findOrFail(1);
        $today = Carbon::now()->format('Y-m-d');
        $input = $request->all();  
        $user->is_vendor = 2;
        $user->date = date('Y-m-d', strtotime($today.' + '.$subs->days.' days'));
        $user->mail_sent = 1;
        $user->update($input);
        $sub = new UserSubscription;
        $sub->user_id = $user->id;
        $sub->subscription_id = $subs->id;
        $sub->title = $subs->title;
        $sub->currency = $subs->currency;
        $sub->currency_code = $subs->currency_code;
        $sub->price = $subs->price;
        $sub->days = $subs->days;
        $sub->allowed_products = $subs->allowed_products;
        $sub->details = $subs->details;
        $sub->method = 'Free';
        $sub->status = 1;
        $sub->save();
        if($settings->is_smtp == 1)
        {
        $data = [
            'to' => $user->email,
            'type' => "vendor_accept",
            'cname' => $user->name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
        ];    
        $mailer = new GeniusMailer();
        $mailer->sendAutoMail($data);        
        }
        else
        {
        $headers = "From: ".$settings->from_name."<".$settings->from_email.">";
        mail($user->email,'Your Vendor Account Activated','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.',$headers);
        }

        return redirect()->route('user-dashboard')->with('success','Vendor Account Activated Successfully');

    }

    public function profile_delete_image(Request $request)
    { 
        // $this->validate($request, [
        //     "name" => "required",
        //     "pan_number" => 'nullable|numeric',
        //     "address_type" => "required",
        //     // "nearest_landmark" => "required",
        //     "address" => "required",
        //     "phone" => "required",
        //     // "city" => "required"
        // ]);

        // dd($request);

        $input = $request->all();

        $user = Auth::guard('user')->user();

        $user->photo = null;
        // if ($file = $request->file('photo'))
        // {
        //     $name = time().$file->getClientOriginalName();
        //     $file->move('assets/images',$name);
        //     if($user->photo != null)
        //     {
        //             if (file_exists(public_path().'/assets/images/'.$user->photo)) {
        //                 unlink(public_path().'/assets/images/'.$user->photo);
        //             }
        //     }
            
        //     $input['photo'] = null;
        // }
        // $user->update($input);
        // dd($user);
        $user->save();
   

        $language = Language::find(1);

        Session::flash('success', $language->success);
        return redirect()->route('user-profile');
    }

    public function profileupdate(Request $request)
    { 
        $d = Carbon::parse($request->dob)->format('Y-m-d');
        // dd($d);
        $this->validate($request, [
            "name" => "required",
            "pan_number" => 'nullable|numeric',
            "address_type" => "required",
            "gender" => "required",
            // "nearest_landmark" => "required",
            "address" => "required",
            "phone" => "required",
            // "city" => "required"
        ]);

        $input = $request->all();
        // dd($request);

        $user = Auth::guard('user')->user();
        if ($file = $request->file('photo'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('assets/images',$name);
            if($user->photo != null)
            {
                    if (file_exists(public_path().'/assets/images/'.$user->photo)) {
                        unlink(public_path().'/assets/images/'.$user->photo);
                    }
            }
            
            $input['photo'] = $name;
        }

        $profile = User::findOrFail($user->id);
        $profile->gender = $request->gender;
        $profile->dob = $d;
        $profile->save(); 

        // $input['gender'] = $gender;

        $user->update($input);
        $language = Language::find(1);
        Session::flash('success', $language->success);
        return redirect()->route('user-profile');
    }

    public function wishlists()
    {
        $user = Auth::guard('user')->user();
        $wishes = Wishlist::where('user_id','=',$user->id)->get();
        return view('user.wishlist',compact('user','wishes'));
    }

    public function favorites()
    {
        $user = Auth::guard('user')->user();
        $favorites = FavoriteSeller::where('user_id','=',$user->id)->get();
        return view('user.favorite',compact('user','favorites'));
    }

    public function delete($id)
    {
        $gs = Generalsetting::findOrfail(1);
        $wish = Wishlist::findOrFail($id);
        $wish->delete();
        return redirect()->route('user-wishlist')->with('success',$gs->wish_remove);
    }

    public function favdelete($id)
    {
        $gs = Generalsetting::findOrfail(1);
        $wish = FavoriteSeller::findOrFail($id);
        $wish->delete();
        return redirect()->route('user-favorites')->with('success','Successfully Removed The Seller.');
    }

    public function wishlist(Request $request)
    {
        $sort = '';
        if(!empty($request->min) || !empty($request->max))
        {
        $min = $request->min;
        $max = $request->max;
        $user = Auth::guard('user')->user();
        $wishes = Wishlist::where('user_id','=',$user->id)->pluck('product_id');
        $wproducts = Product::whereIn('id',$wishes)->whereBetween('cprice', [$min, $max])->orderBy('id','desc')->paginate(9);
        return view('front.wishlist',compact('user','wproducts','sort','min','max'));
        }
        $user = Auth::guard('user')->user();
        $wishes = Wishlist::where('user_id','=',$user->id)->pluck('product_id');
        $wproducts = Product::whereIn('id',$wishes)->orderBy('id','desc')->paginate(9);
        return view('front.wishlist',compact('user','wproducts','sort'));
    }

    public function wishlistsort($sorted)
    {
        $sort = $sorted;
        $user = Auth::guard('user')->user();
        $wishes = Wishlist::where('user_id','=',$user->id)->pluck('product_id');
        if($sort == "new")
        {
        $wproducts = Product::whereIn('id',$wishes)->orderBy('id','desc')->paginate(9);
        }
        else if($sort == "old")
        {
        $wproducts = Product::whereIn('id',$wishes)->paginate(9);
        }
        else if($sort == "low")
        {
        $wproducts = Product::whereIn('id',$wishes)->orderBy('cprice','asc')->paginate(9);
        }
        else if($sort == "high")
        {
        $wproducts = Product::whereIn('id',$wishes)->orderBy('cprice','desc')->paginate(9);
        }
        return view('front.wishlist',compact('user','wproducts','sort'));
    }

    public function social()
    {
        $socialdata = Auth::guard('user')->user();
        return view('user.social',compact('socialdata'));
    }

    public function socialupdate(Request $request)
    {
        $socialdata = Auth::guard('user')->user();
        $input = $request->all();
        if ($request->f_check == ""){
            $input['f_check'] = 0;
        }
        if ($request->t_check == ""){
            $input['t_check'] = 0;
        }

        if ($request->g_check == ""){
            $input['g_check'] = 0;
        }

        if ($request->l_check == ""){
            $input['l_check'] = 0;
        }

        $socialdata->update($input);
        Session::flash('success', 'Social links updated successfully.');
        return redirect()->route('user-social-index');
    }
    //Send email to user
    public function usercontact(Request $request)
    {
        $data = 1;
        $user = User::findOrFail($request->user_id);
        $vendor = User::where('email','=',$request->email)->first();
        if(empty($vendor))
        {
            $data = 0;
            return response()->json($data);   
            
        }

        $subject = $request->subject;
        $to = $vendor->email;
        $name = $request->name;
        $from = $request->email;
        $msg = "Name: ".$name."\nEmail: ".$from."\nMessage: ".$request->message;
        $gs = Generalsetting::findOrfail(1);
        if($gs->is_smtp == 1)
        {
        $data = [
            'to' => $vendor->email,
            'subject' => $request->subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }

        $conv = Conversation::where('sent_user','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new Message();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->sent_user = $user->id;
            $msg->save();
            return response()->json($data);   
        }
        else{
            $message = new Conversation();
            $message->subject = $subject;
            $message->sent_user= $request->user_id;
            $message->recieved_user = $vendor->id;
            $message->message = $request->message;
            $message->save();
        $notification = new UserNotification;
        $notification->user_id= $vendor->id;
        $notification->conversation_id = $message->id;
        $notification->save();
            $msg = new Message();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->sent_user = $request->user_id;;
            $msg->save();
            return response()->json($data);   
        }
    }
    public function adminmessages()
    {
            $user = Auth::guard('user')->user();
            $convs = AdminUserConversation::where('user_id','=',$user->id)->get();
            return view('user.message.index',compact('convs'));            
    }

    public function adminmessage($id)
    {
            $conv = AdminUserConversation::findOrfail($id);
            return view('user.message.create',compact('conv'));                 
    }   
    public function adminmessagedelete($id)
    {
            $conv = AdminUserConversation::findOrfail($id);
            if($conv->messages->count() > 0)
            {
                foreach ($conv->messages as $key) {
                    $key->delete();
                }
            }
            if($conv->notifications->count() > 0)
            {
                foreach ($conv->notifications as $key) {
                    $key->delete();
                }
            }
            $conv->delete();
            return redirect()->back()->with('success','Message Deleted Successfully');                 
    }
    public function adminpostmessage(Request $request)
    {
        $msg = new AdminUserMessage();
        $input = $request->all();  
        $msg->fill($input)->save();
        $notification = new Notification;
        $notification->conversation_id = $msg->conversation->id;
        $notification->save();
        Session::flash('success', 'Message Sent!');
        return redirect()->back();
    }
    public function adminusercontact(Request $request)
    {
        $data = 1;
        $user = Auth::guard('user')->user();        
        $gs = Generalsetting::findOrFail(1);
        $subject = $request->subject;
        $to = $gs->email;
        $from = $user->email;
        $msg = "Email: ".$from."\nMessage: ".$request->message;
        if($gs->is_smtp == 1)
        {
            $data = [
            'to' => $to,
            'subject' => $subject,
            'body' => $msg,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        }
        else
        {
            $headers = "From: ".$gs->from_name."<".$gs->from_email.">";
        mail($to,$subject,$msg,$headers);
        }

    $conv = AdminUserConversation::where('user_id','=',$user->id)->where('subject','=',$subject)->first();
        if(isset($conv)){
            $msg = new AdminUserMessage();
            $msg->conversation_id = $conv->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json($data);   
        }
        else{
            $message = new AdminUserConversation();
            $message->subject = $subject;
            $message->user_id= $user->id;
            $message->message = $request->message;
            $message->save();
        $notification = new Notification;
        $notification->conversation_id = $message->id;
        $notification->save();
            $msg = new AdminUserMessage();
            $msg->conversation_id = $message->id;
            $msg->message = $request->message;
            $msg->user_id = $user->id;
            $msg->save();
            return response()->json($data);   

        }
}
}
