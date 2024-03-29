<?php

namespace App\Http\Controllers;

use App\Category;
use App\Classes\GeniusMailer;
use App\Generalsetting;
use App\Http\Requests\StoreValidationRequest;
use App\User;
use App\UserSubscription;
use App\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\ProviderEnquiry;
use Carbon\Carbon;

class AdminVendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::whereNotNull('email_verified_at')
        ->where(function($q){
            $q->where('is_vendor','=',2)->orWhere('is_vendor','=',1);
        })->orderBy('id','desc')->get();
        
        $pendings = User::whereNotNull('email_verified_at')->where('is_vendor','=',1)->get()->count();
        return view('admin.vendor.index',compact('users','pendings'));
    }

    public function vendorverifyindex(){
        $users = User::whereNotNull('email_verified_at')->where('is_vendor','=',3)->orderBy('id','desc')->get();
        // dd($users);
        return view('admin.vendor.productverify',compact('users'));
      
    }

    public function labverifyindex(){
        $users = User::whereNotNull('email_verified_at')->where('is_vendor','=',2)->orderBy('id','desc')->get();
        // dd($users);
        return view('admin.vendor.labverify',compact('users'));
      
    }

    public function enquiryindex()
    {
       $enquiries = ProviderEnquiry::all();
        return view('admin.vendor.enquiryindex',compact('enquiries'));
    }

    public function enquirydetail($id)
    {
        $enquiry = ProviderEnquiry::findOrFail($id);
        return view('admin.vendor.enquirydetail',compact('enquiry'));
    }

    public function subs()
    {
        $subs = UserSubscription::where('status','=',1)->orderBy('id','desc')->get();
        return view('admin.vendor.subscriptions',compact('subs'));
    }

    public function sub($id)
    {
        $subs = UserSubscription::findOrFail($id);
        return view('admin.vendor.subdetails',compact('subs'));
    }

    public function pending()
    {
        $users = User::whereNotNull('email_verified_at')->where('is_vendor','=',1)->orderBy('id','desc')->get();
        return view('admin.vendor.pendings',compact('users'));
    }


  public function status($id1,$id2)
    {
        $user = User::findOrFail($id1);
        $user->is_vendor = $id2;
        $user->update();
        Session::flash('success', 'Vendor Status Upated Successfully.');
        return redirect()->back();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.vendor.edit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'shop_name'   => 'unique:users,shop_name,'.$id,
           ],[ 
             'shop_name.unique' => 'Shop Name "'.$request->shop_name.'" has already been taken. Please choose another name.'
           ]);
        $user = User::findOrFail($id);
        $data = $request->all();
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
            $data['photo'] = $name;
        }
        $user->update($data);
        return redirect()->route('admin-vendor-index')->with('success','Vendor Information Updated Successfully.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.vendor.details',compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->is_vendor = 0;
            $user->is_vendor = 0;
            $user->shop_name = null;
            $user->owner_name = null;
            $user->shop_number = null;
            $user->shop_address = null;
            $user->reg_number = null;
            $user->shop_message = null;
        $user->update();
        if($user->notivications->count() > 0)
        {
            foreach ($user->notivications as $gal) {
                $gal->delete();
            }
        }
        Session::flash('success', 'Vendor Removed Successfully');
        return redirect()->route('admin-vendor-index');
    }
    public function withdraws()
    {
        $withdraws = Withdraw::where('type','=','vendor')->orderBy('id','desc')->get();
        $pending = Withdraw::where('status','=','pending')->get()->count();
        return view('admin.vendor.withdraws',compact('withdraws','pending'));
    }

    public function pendings()
    {
        $withdraws = Withdraw::where('status','=','pending')->where('type','=','vendor')->orderBy('id','desc')->get();
        return view('admin.vendor.pending-withdraws',compact('withdraws'));
    }

    public function withdrawdetails($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return view('admin.vendor.withdraw-details',compact('withdraw'));
    }

    public function accept($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $data['status'] = "completed";
        $withdraw->update($data);

        return redirect()->route('admin-vendor-wt')->with('success','Withdraw Accepted Successfully');
    }

    public function reject($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $account = User::findOrFail($withdraw->user->id);
        $account->current_balance = $account->current_balance + $withdraw->amount + $withdraw->fee;
        $account->update();

        $data['status'] = "rejected";
        $withdraw->update($data);
        return redirect()->route('admin-vendor-wt')->with('success','Withdraw Rejected Successfully');
    }
    public function userwithdraws()
    {
        $withdraws = Withdraw::where('type','=','affilate')->orderBy('id','desc')->get();
        $pending = Withdraw::where('status','=','pending')->get()->count();
        return view('admin.user.withdraws',compact('withdraws','pending'));
    }

    public function userpendings()
    {
        $withdraws = Withdraw::where('status','=','pending')->where('type','=','affilate')->orderBy('id','desc')->get();
        return view('admin.user.pending-withdraws',compact('withdraws'));
    }

    public function userwithdrawdetails($id)
    {
        $withdraw = Withdraw::findOrFail($id);
        return view('admin.user.withdraw-details',compact('withdraw'));
    }

    public function useraccept($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $data['status'] = "completed";
        $withdraw->update($data);

        return redirect()->route('admin-vendor-wtt')->with('success','Withdraw Accepted Successfully');
    }

    public function userreject($id)
    {
        $withdraw = Withdraw::findOrFail($id);

        $account = User::findOrFail($withdraw->user->id);
        $account->affilate_income = $account->affilate_income + $withdraw->amount + $withdraw->fee;
        $account->update();

        $data['status'] = "rejected";
        $withdraw->update($data);
        return redirect()->route('admin-vendor-wtt')->with('success','Withdraw Rejected Successfully');
    }

    public function getProductVendorRegFile($id, $filename)
    {
        
        try{
            $path = \Storage::get('public/product_vendor_certificates/'.$filename);
            $mimetype = \Storage::mimeType('public/product_vendor_certificates/'.$filename);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function getLabVendorRegFile($id, $filename)
    {
        
        try{
            $path = \Storage::get('public/lab_vendor_certificates/'.$filename);
            $mimetype = \Storage::mimeType('public/lab_vendor_certificates/'.$filename);

            return \Response::make($path, 200, ['Content-Type' => $mimetype]);
        }
        catch (\Exception $e) {
            abort(404);
        }
    }

    public function productVendorVerify($id){
        
        $product_vendor_verify = User::findOrFail($id);
        $current_date_time = Carbon::now()->toDateTimeString();
        $product_vendor_verify->verified_at = $current_date_time;
        $product_vendor_verify->save();
       
        // dd($business_customers_verify);
        return redirect('/admin/product/vendors/verify')->with('success','Product Vendor Verified');
      

    }

    public function labVendorVerify($id){
        
        $lab_vendor_verify = User::findOrFail($id);
        $current_date_time = Carbon::now()->toDateTimeString();
        $lab_vendor_verify->verified_at = $current_date_time;
        $lab_vendor_verify->save();
       
        // dd($business_customers_verify);
        return redirect('/admin/lab/vendors/verify')->with('success','Lab Vendor Verified');
      

    }
}


