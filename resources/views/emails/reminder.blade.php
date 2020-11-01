@extends('layouts.email')

@section('body')

    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">
        Hello {{ $user->name }},
    </p>
    <div style="font-size: 16px; font-weight: 400; line-height: 24px; color: #333333;">

        {!! $content !!}
        
        <div style="text-align:center;margin:20px">
            <a href="{{ $url }}" style="background-color:#383333;color:#ffffff;display:inline-block;font-family:brandon-grotesque;text-transform: uppercase;font-size:14px;font-weight:regular;line-height:45px;text-align:center;text-decoration:none;width:155px;-webkit-text-size-adjust:none;mso-hide:all;">Visit</a>
        </div>
        
        <p style="font-size: 12px; font-weight: 800; line-height: 24px; color: #333333;">
            If you have already re-ordered, please ignore this email.
        </p>
    </div>
    <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
        <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
            Regards,<br>
            MEROHEALTHCARE Team
        </p>
@endsection

@section('note')
    This email was sent from a notification-only address that cannot accept incoming email. Please do not reply to this message.
@endsection