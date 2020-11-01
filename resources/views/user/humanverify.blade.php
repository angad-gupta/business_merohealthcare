@extends('layouts.front')
@section('title','Human Verify')
@section('content')
<div class="section-padding login-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  col-xs-12">
                <div class="signIn-area">
                    <h2 class="signIn-title text-center"> Registration Certificate verification is in Progress. </h2>
                    <div class="text-center" style="font-size:100px;" >
                        <i class="icon-finance-258 u-line-icon-pro"></i>
                   </div>
                    <h6 class="signIn-title text-center"> Usually verified within 24 hrs. </h6>
                    
                    <hr>

                    
                    {{-- @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    
                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                         --}}

                         <div class="text-center">
           
                            <a href="{{ route('front.index')}}" class="btn u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase g-rounded-25 g-py-15 g-px-30 " role="button">Back to Home</a>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection