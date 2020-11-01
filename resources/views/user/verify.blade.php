@extends('layouts.front')
@section('title','Verify Your Email Address')
@section('content')
<div class="section-padding login-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  col-xs-12">
                <div class="signIn-area">
                    <h2 class="signIn-title text-center">Verify Your Email Address</h2>
                    <hr>
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection