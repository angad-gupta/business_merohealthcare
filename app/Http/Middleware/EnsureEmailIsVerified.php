<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Redirect;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->guard()->user()){
            return $request->expectsJson()
                    ? abort(403, 'Your are not logged in.')
                    : Redirect::route('user-login');
        }
        
        if (!$this->guard()->user()->email_verified_at) {

            $request->session()->put('loggedUser', $this->guard()->user());

            $this->guard()->logout();

            return $request->expectsJson()
                    ? abort(403, 'Your email address is not verified.')
                    : Redirect::route('verification.notice');
        }

        return $next($request);
    }

    protected function guard()
    {
        return Auth::guard('user');
    }
}
