<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class PasswordResetController extends Controller
{
    public function sendResetLinkEmail(Request $request){
        $request->validate([
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        if (!$user)
            return response()->json([
                'success'=>'false',
                'message' => "We can't find a user with that e-mail address."
            ], 404);

        $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($user);

        $user->sendPasswordResetNotification($token);

        return response()->json([
            'success'=>'true',
            'message' => 'We have e-mailed your password reset link!'
        ],200);
    }
}
