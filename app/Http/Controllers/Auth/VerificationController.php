<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;
use Carbon\Carbon;
use Auth;
use App\Mail\WelcomeUser;
use Mail;


class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/user/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    public function show(Request $request)
    {
        $user = Session::get('loggedUser');
        if(!$user) return redirect('user/login');

        return view('user.verify');
    }

    public function humanshow(Request $request)
    {
     
        $user = Session::get('loggedUser');
        if(!$user) return redirect('user/login');

        return view('user.humanverify');
    }

    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function verify(Request $request)
    {
        $user = User::where('activation_code',$request->route('code'))->first();
        if(!$user)
            abort(404);

        if ($user->email_verified_at) {
            return redirect('user/login')->with('error','The Email Address has already been verified.');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        Mail::send(new WelcomeUser($user));
      
        
        if($user->is_vendor == '3' && $user->verified_at == null){
            return redirect()->route('verification.humannotice');
        }
        else if($user->is_vendor == '2' && $user->verified_at == null){
            return redirect()->route('verification.humannotice');
        }
        else if(!$user->verified_at){
            Auth::guard('user')->logout();
            $request->session()->put('loggedUser', $user);
            return redirect()->route('verification.humannotice');
        }else
        {
            Auth::guard('user')->login($user); 
            return redirect()->route('front.index');
        }
    }

    /**
     * Resend the email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resend(Request $request)
    {
        $user = Session::get('loggedUser');
        if(!$user) return redirect('login');

        $user->sendEmailVerificationNotification();

        return back()->with('resent', true);
    }

    public function redirectTo(){
        return Session::has('url.intended') ? Session::get('url.intended') : $this->redirectTo;
    }
}
