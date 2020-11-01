<?php

namespace App\Http\Controllers\Auth;

use App\Classes\GeniusMailer;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\User;
use App\Family;
use App\Generalsetting;
use App\SocialProvider;
use Socialite;
use Config;
use App\Notification;
use Carbon\Carbon;

class UserRegisterController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:user', ['except' => ['logout']]);
    }

    public function register(Request $request)
    {
      
      // Validate the form data
      // dd($request);

      $d = Carbon::parse($request->dob)->format('Y-m-d');

      $this->validate($request, [
        'email'   => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'user_type' => 'required'
      ]);
      $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;  
      // dd($name); 
      $gs = Generalsetting::findOrFail(1);
      $user = new User;
      $input = $request->all(); 
      $user->user_type = $request->user_type;   
      $user->name = $name;
      $user->gender = $request->gender;
      $user->dob = $d;
      $input['password'] = bcrypt($request['password']);
      $input['affilate_code'] = $request->name.$request->email;
      $input['affilate_code'] = md5($input['affilate_code']);
      $input['activation_code'] = Str::random(60);
     
      $user->fill($input)->save();
      
      $request->session()->put('loggedUser', $user);
      
      $user->sendEmailVerificationNotification();
      return redirect()->route('verification.notice');

      //   $notification = new Notification;
      //   $notification->user_id = $user->id;
      //   $notification->save();
      //   Auth::guard('user')->login($user); 
        // return redirect()->route('user-dashboard');
    }

    public function vendorregister(Request $request)
    {
      
      // Validate the form data
      // dd($request);

      $d = Carbon::parse($request->dob)->format('Y-m-d');

      $this->validate($request, [
        'email'   => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'user_type' => 'required'
      ]);
      $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;  
      // dd($name); 
      $gs = Generalsetting::findOrFail(1);
      $user = new User;
      $input = $request->all(); 
      $user->user_type = $request->user_type;   
      $user->name = $name;
      $user->gender = $request->gender;
      $user->dob = $d;
      $user->is_vendor = 2;
      $input['password'] = bcrypt($request['password']);
      $input['affilate_code'] = $request->name.$request->email;
      $input['affilate_code'] = md5($input['affilate_code']);
      $input['activation_code'] = Str::random(60);

      if($request->hasFile('filenames')){
        foreach ($request->filenames as $reg_certificate_file){
        $filenameWithExt = $reg_certificate_file->getClientOriginalName();
        $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
  
        $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
        $path = $reg_certificate_file->storeAs('public/lab_vendor_certificates', $filename);
        
        $data[] = $filename;
  
        }

        $user->registration_file = json_encode($data);
      }
     
      $user->fill($input)->save();

      $request->session()->put('loggedUser', $user);
      
      $user->sendEmailVerificationNotification();
      return redirect()->route('verification.notice');

      //   $notification = new Notification;
      //   $notification->user_id = $user->id;
      //   $notification->save();
      //   Auth::guard('user')->login($user); 
        // return redirect()->route('user-dashboard');
    }

    public function productvendorregister(Request $request)
    {
      
   
      // dd($request);

      $d = Carbon::parse($request->dob)->format('Y-m-d');

      $this->validate($request, [
        'email'   => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'user_type' => 'required'
      ]);
      $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;  
      // dd($name); 
      $gs = Generalsetting::findOrFail(1);
      $user = new User;
      $input = $request->all(); 
      $user->user_type = $request->user_type;   
      $user->name = $name;
      $user->gender = $request->gender;
      $user->dob = $d;
      $user->is_vendor = 3;
      $input['password'] = bcrypt($request['password']);
      $input['affilate_code'] = $request->name.$request->email;
      $input['affilate_code'] = md5($input['affilate_code']);
      $input['activation_code'] = Str::random(60);

     

      if($request->hasFile('filenames')){
        foreach ($request->filenames as $reg_certificate_file){
        $filenameWithExt = $reg_certificate_file->getClientOriginalName();
        $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);
  
        $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
        $path = $reg_certificate_file->storeAs('public/product_vendor_certificates', $filename);
        
        $data[] = $filename;
  
        }

        $user->registration_file = json_encode($data);
      }
      
      // dd($user->registration_file);
  


      $user->fill($input)->save();

      $request->session()->put('loggedUser', $user);
      
      $user->sendEmailVerificationNotification();
      return redirect()->route('verification.notice');

      //   $notification = new Notification;
      //   $notification->user_id = $user->id;
      //   $notification->save();
      //   Auth::guard('user')->login($user); 
        // return redirect()->route('user-dashboard');
    }


    public function businessregister(Request $request)
    {

      // dd($request);
      // dd($request);

      $d = Carbon::parse($request->dob)->format('Y-m-d');
      $this->validate($request, [
        'email'   => 'required|email|unique:users',
        'password' => 'required|confirmed',
        'user_type' => 'required|max:255',
        'firstname' => 'required|max:255',
        'lastname' => 'required|max:255',
        'companyname' => 'required|max:255',
        'phone' => 'required',
        'panvat' => 'required',
        'address' => 'required|max:255',
        'dob' => 'required',
        'gender' => 'required|max:255',
        
      ]);
      $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;  
  
      $gs = Generalsetting::findOrFail(1);
      $user = new User;
      $input = $request->all(); 
      $user->user_type = $request->user_type;   
      $user->name = $name;
      $user->dob = $d;
      $user->company_name = $request->companyname;
      $user->registration_number = $request->registrationname;
      $user->pan_vat = $request->panvat;
      $user->company_details = $request->companydetails;
      $user->gender = $request->gender;

      $input['password'] = bcrypt($request['password']);
      $input['affilate_code'] = $request->name.$request->email;
      $input['affilate_code'] = md5($input['affilate_code']);
      $input['activation_code'] = Str::random(60);

    
      if($request->hasFile('filenames')){
        foreach ($request->filenames as $reg_certificate_file){


        $filenameWithExt = $reg_certificate_file->getClientOriginalName();
        $name = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        $filename = str_replace(' ','',$name).'_'.time() . '.' . $reg_certificate_file->getClientOriginalExtension();
        $path = $reg_certificate_file->storeAs('public/business_certificates', $filename);
        
        $data[] = $filename;

        }
     

      $user->registration_file = json_encode($data);
      }
     
      $user->fill($input)->save();
  

      $request->session()->put('loggedUser', $user);
      
      $user->sendEmailVerificationNotification();
      return redirect()->route('verification.notice');

      //   $notification = new Notification;
      //   $notification->user_id = $user->id;
      //   $notification->save();
      //   Auth::guard('user')->login($user); 
        // return redirect()->route('user-dashboard');
    }
  
}