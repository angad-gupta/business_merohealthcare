@extends('layouts.front')
@section('title','Reset Password')
@section('content')
<style>
    .invalid-feedback{
        color: red;
    }
</style>

<div class="section-padding login-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1  col-xs-12">
                <div class="signIn-area">
                    <h2 class="signIn-title text-center">Reset Password</h2>
                    <hr>
                    
                    <div class="login-form">
                    <form action="{{ route('password.update') }}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                            <label for="forgot_email">{{$lang->fpe}} <span>*</span></label>
                            <input class="form-control" placeholder="{{$lang->fpe}}" type="email" name="email" id="forgot_email" value="{{ old('email') }}" required="">

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                            <label>{{$lang->np}} <span>*</span></label>
                            <input class="form-control" placeholder="{{$lang->np}}" name="password" required type="password">

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group {{$lang->rtl == 1 ? 'text-right' : ''}}">
                            <label for="forgot_email">{{$lang->rnp}} <span>*</span></label>
                            <input class="form-control" placeholder="{{$lang->rnp}}" type="password" placeholder="Confirm Password" name="password_confirmation" required>

                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-block">{{$lang->fpb}}</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection