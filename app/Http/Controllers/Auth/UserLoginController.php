<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:user', ['except' => ['logout']]);
    }

 	public function showLoginForm()
    {
        return view('user.login');
    }

    public function showBusinessLoginForm()
    {
        return view('user.businesslogin');
    }

    public function showVendorLoginForm()
    {
        return view('user.vendorlogin');
    }

    public function showProductVendorLoginForm()
    {
        return view('user.productvendorlogin');
    }

    public function login(Request $request)
    {
        // dd($request);

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)) {

            $user = Auth::guard('user')->user();

            // if($user->verified_at == null){
            //     return redirect()->back()-with('message', 'Human Verification not yet Verified');
            // }

           
            if(!$user->email_verified_at){
                Auth::guard('user')->logout();
                $request->session()->put('loggedUser', $user);
                return redirect()->route('verification.notice');
            }

            $ut= $user->user_type;
            if($user->verified_at == null && $ut == 'Product Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }

         
            if($user->verified_at == null && $ut == 'Lab Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }

            // if(!$user->verified_at){
            //     Auth::guard('user')->logout();
            //     $request->session()->put('loggedUser', $user);
            //     return redirect()->route('verification.humannotice');
            // }
            

            if($request->checkout)
            {
                return redirect()->route('lab.checkout');
            }

            if(isset($request->wish))
            {
                return redirect()->back();
            }

           if($ut == 'Lab Vendor' || $ut == "Product Vendor"){
            return redirect()->intended(route('user-dashboard'));
           }
           elseif($request->askdoctor == 1)
           {
            return redirect()->back();
           }
           {
            return redirect()->intended(route('front.index'));
           }
       
        }
        Session::flash('message',"f");
        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Session::forget('cart');
        Auth::guard('user')->logout();
        return redirect()->route('user-login');
    }    


    public function vendorlogin(Request $request)
    {
        
        // dd($request);
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)) {

            $user = Auth::guard('user')->user();

            // if($user->verified_at == null){
            //     return redirect()->back()-with('message', 'Human Verification not yet Verified');
            // }

           
            if(!$user->email_verified_at){
                Auth::guard('user')->logout();
                $request->session()->put('loggedUser', $user);
                return redirect()->route('verification.notice');
            }

            $ut= $user->user_type;
            // dd($ut);

            $ut= $user->user_type;
            if($user->verified_at == null && $ut == 'Product Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }

      
            if($user->verified_at == null && $ut == 'Lab Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }


            if(isset($request->wish))
            {
                return redirect()->back();
            }
            // else if(isset($request->package))
            // {
            //     return redirect()->intended(route('user-package'));
            // }
            // else
            // {
                return redirect()->intended(route('user-dashboard'));
            // }
        }
        Session::flash('message',"f");
        return redirect()->back()->withInput($request->only('email'));
    }



    public function vendorlogout()
    {
        // Session::forget('cart');
        Auth::guard('user')->logout();
        return redirect()->route('user-login');
    }  

    public function productVendorLogin(Request $request){
        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)) {

            $user = Auth::guard('user')->user();

            // if($user->verified_at == null){
            //     return redirect()->back()-with('message', 'Human Verification not yet Verified');
            // }

           
            if(!$user->email_verified_at){
                Auth::guard('user')->logout();
                $request->session()->put('loggedUser', $user);
                return redirect()->route('verification.notice');
            }

            $ut= $user->user_type;
       

            $ut= $user->user_type;
            if($user->verified_at == null && $ut == 'Product Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }


            if($user->verified_at == null && $ut == 'Lab Vendor'){
                Auth::guard('user')->logout();
                return view('user.humanverify');
            
            }

            // if(!$user->verified_at){
            //     Auth::guard('user')->logout();
            //     $request->session()->put('loggedUser', $user);
            //     return redirect()->route('verification.humannotice');
            // }
            

            if($request->checkout)
            {
                return redirect()->route('lab.checkout');
            }

            if(isset($request->wish))
            {
                return redirect()->back();
            }
            // else if(isset($request->package))
            // {
            //     return redirect()->intended(route('user-package'));
            // }
            // else
            // {
                return redirect()->intended(route('user-dashboard'));
            // }
        }
        Session::flash('message',"f");
        return redirect()->back()->withInput($request->only('email'));
    }

    public function businesslogin(Request $request)
    {
        

        $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password],$request->remember)) {

            $user = Auth::guard('user')->user();

            // if($user->verified_at == null){
            //     return redirect()->back()-with('message', 'Human Verification not yet Verified');
            // }

           
            if(!$user->email_verified_at){
                Auth::guard('user')->logout();
                $request->session()->put('loggedUser', $user);
                return redirect()->route('verification.notice');
            }

            if(!$user->verified_at){
                Auth::guard('user')->logout();
                $request->session()->put('loggedUser', $user);
                return redirect()->route('verification.humannotice');
            }
            

            if($request->checkout)
            {
                return redirect()->route('lab.checkout');
            }

            if(isset($request->wish))
            {
                return redirect()->back();
            }
            // else if(isset($request->package))
            // {
            //     return redirect()->intended(route('user-package'));
            // }
            // else
            // {
                return redirect()->intended(route('front.index'));
            // }
        }
        Session::flash('message',"f");
        return redirect()->back()->withInput($request->only('email'));
    }

    public function businesslogout()
    {
        Auth::guard('user')->logout();
        return redirect()->back();
    }   
}