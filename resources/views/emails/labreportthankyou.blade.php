@extends('layouts.email')

@section('body')

    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">
        Hello {{ $user->name }},
    </p>
    <div style="font-size: 14px; font-weight: 400; line-height: 24px; color: #333333;">

        <p>Thank you for choosing <b>Merohealthcare</b> as your service partner. </p>
        <p>Hope your order has been serviced to you up to your satisfaction. We really appreciate if you could share your service experience on <a target="_blank" style="color: #5b9bd5;" href="https://g.page/merohealthcarenp/review?rc">Google</a> or <a target="_blank" style="color: #5b9bd5;" href="https://www.facebook.com/merohealthcarenp/reviews/">Facebook</a> and help us to develop much better service experience for you. </p>
    <p>If you wish to return any product, please check our detailed instruction on our <a href="{{route('front.refundpolicy')}}" target="__blank" style="color: #5b9bd5;">return and refund policy.</a> </p>
        <p>Thank you once again on trusting us. We really look forward to service you again. </p>
      
    </div>
    <p style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
        Regards,<br>
        MEROHEALTHCARE Team
    </p>

  
@endsection