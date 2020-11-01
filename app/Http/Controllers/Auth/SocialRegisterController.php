<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notification;
use App\SocialProvider;
use App\Sociallink;
use App\User;
use Auth;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Socialite;
use Carbon\Carbon;

class SocialRegisterController extends Controller
{

    public function __construct()
    {
      $link = Sociallink::findOrFail(1);
      Config::set('services.google.client_id', $link->gclient_id);
      Config::set('services.google.client_secret', $link->gclient_secret);
      Config::set('services.google.redirect', url('/signin/google/callback'));
      Config::set('services.facebook.client_id', $link->fclient_id);
      Config::set('services.facebook.client_secret', $link->fclient_secret);
      $url = url('/signin/facebook/callback');
      $url = preg_replace("/^http:/i", "https:", $url);
      Config::set('services.facebook.redirect', $url);
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request,$provider)
    {
        if (!$request->has('code') || $request->has('denied')) {
            return redirect()->route('user-login');
        }

        try
        {
            $socialUser = Socialite::driver($provider)->user();
        }
        catch(\Exception $e)
        {
            return redirect('/');
        }
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            if (!User::where('email', '=', $socialUser->email)->exists()) {
                //create a new user and provider

                if(!$socialUser->email){
                    Session::flash('error','Email Address is required');
                    return redirect()->route('user-login');
                }

                $user = new User;
                $user->email = $socialUser->email;
                $user->name = $socialUser->name;
                $user->photo = $socialUser->avatar_original;
                $user->is_provider = 1;
                $user->email_verified_at = Carbon::now();
                $user->affilate_code = $socialUser->name.$socialUser->email;
                $user->affilate_code = md5($user->affilate_code);
                $user->save();

                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                );
                // $notification = new Notification;
                // $notification->user_id = $user->id;
                // $notification->save();
            }else {
                $user = User::where('email','=',$socialUser->email)->first();
                $user->is_provider = 1;
                
                if(!$user->photo){
                    $user->photo = $socialUser->avatar_original;
                }
                if (!$user->email_verified_at) {
                    $user->email_verified_at = Carbon::now();
                }

                $user->save();

                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                );
            }

        }
        else
        {

            $user = $socialProvider->user;
            if ($user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
                $user->save();
            }
        }

        Auth::guard('user')->login($user); 
        return redirect()->route('front.index');

    }
}
