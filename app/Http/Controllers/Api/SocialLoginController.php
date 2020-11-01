<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Two\InvalidStateException;
use Carbon\Carbon;
use App\User;
use App\SocialProvider;
use Auth;
use Socialite;

class SocialLoginController extends Controller
{

    public function handleProviderCallback($provider,Request $request)
    {
         // 1 check if the user exists in our database with facebook_id
        // 2 if not create a new user
        // 3 login this user into our application
        if (!$request->has('code') || $request->has('denied')) {
            return response()->json([
                'message' => 'Something went wrong.'
            ], 401);
        }

        try
        {
            $socialUser = Socialite::driver($provider)->userFromToken($request->code);
        }
        catch(InvalidStateException $e){
            return response()->json([
                'message' => 'Something went wrong.'
            ], 401);
        }
        catch (Exception $e)
        {
            return response()->json([
                'message' => 'Something went wrong.'
            ], 401);
        }

        if(!$socialUser->getEmail()){
            return response()->json([
                'message' => "Email address not received!"
            ], 406);
        }
        
        //check if we have logged provider
        $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
        if(!$socialProvider)
        {
            if (!User::where('email', '=', $socialUser->email)->exists()) {
                //create a new user and provider


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

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        

        return response()->json([
            'user' => $user,
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
}