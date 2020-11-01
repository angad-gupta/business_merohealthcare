<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Mail\ConfirmUserEmail;
use Carbon\Carbon;
use App\User;
use Auth;
use Mail;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $d = Carbon::parse($request->dob)->format('Y-m-d');

        $this->validate($request, [
            'firstname'=>'required',
            'lastname'=>'required',
            'gender'=>'required|in:Male,Female,Others',
          'email'   => 'required|email|unique:users',
          'password' => 'required|confirmed',

        ]);
        $name = $request->firstname.' '.$request->middlename.' '.$request->lastname;
        // dd($name);
#        $gs = Generalsetting::findOrFail(1);
        $user = new User;
        $input = $request->all();
        $user->user_type = 'Customer';
        $user->name = $name;
        $user->gender = $request->gender;
        $user->dob = $d;
        $input['password'] = bcrypt($request['password']);
        $input['activation_code'] = Str::random(60);

        $user->fill($input)->save();
        $user->sendEmailVerificationNotification();

       $data=[];
        // Mail::to($request->email)->send(new ConfirmUserEmail($user));
        $data['success']="true";
        $data['message']="Account Successfully Created!. Please Check your email to verify your account.";
        return response()->json($data, 200);
    }

    public function resendConfirmation(Request $request){

        $email = $request->get('email');
        $user = User::where('email',$email)->first();
        if(!$user)
            return response()->json([
                'success'=>'false',
                'message' => 'User not found.'
            ], 404);

        if(!$user->verified){
            $user->sendEmailVerificationNotification();
            return response()->json([
                'success'=>'true',
                'message' => 'Email Sent!. Please Check your email to verify your account.'
            ], 200);
        }else{
            return response()->json([
                'success'=>'true',
                'message' => 'Your Account has already been verified!. Please login.'
            ], 200);
        }
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'These credentials do not match our records.'
            ], 401);

        if(!$request->user()->email_verified_at){
            return response()->json([
                'message' => 'Your account is not verified yet!'
            ], 401);
        }

       $user=$request->user();

        $ut= $user->user_type;
        // dd($ut);

        if(!$user->verified_at && $ut == 'Business'){

            return response()->json([
                'message' => 'Your account is not valid'
            ], 401);
        }


        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        // if ($request->remember_me)
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

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
}
