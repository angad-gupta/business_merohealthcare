@extends('layouts.email')

@section('body')

    <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">
        Hello {{ $order->name }},
    </p>

    <p>Your order #<b>{{ $order->order_number }}</b> is confirmed and will be soon on its way. Please Deposit the Rs.{{$order->pay_amount}} to Sanima Bank.</p>

  
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:600px;">
 
        <h4 style="font-weight:600; ">Please deposit the amount in bank details given below </h4> 
                       

           <div class="d-flex g-mt-2 g-mr-15">
             <img class="g-width-75 g-height-80 " src="https://www.collegenp.com/uploads/2018/12/Sanima-Bank.jpg" alt="Image Description">
           </div>
           <div class="media-body" >
             <div class="d-flex justify-content-between">
               <strong class="g-color-teal">Sanima Bank</strong>

             </div>
             <span class="d-block"><strong>Account name : </strong> Web Health Company Pvt Ltd</span>
             <br>
             <span class="d-block"><strong>AC. No.</strong> 909010020000028</span>
             <br>
             <span class="d-block"><strong>Branch : </strong> Head Office</span>
             
           </div>
      
         <div class="container" style="margin-top:10px;">
          
          <p><b>Payment Ways:</b><br/>1. Pay through online bank transfer. <br/>2. Or, Bank voucher deposit to nearest branch.</p>
          <i><b>Note: Show your transfer/voucher receipt after the delivery.</b></i>
         </div>
         
        

        <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:21px;color:#333333">We are coming very soon on <a target="_blank" href="https://www.apple.com/ios/app-store/" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5">iOS</a> and <a target="_blank" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;font-size:14px;text-decoration:underline;color:#5B9BD5" href="https://play.google.com/store/apps?hl=en">Android</a>.</p>
        <p style="font-size: 14px; font-weight: 600; line-height: 24px; color: #333333;">                              
            Regards,<br>
            MEROHEALTHCARE Team
        </p>
        
    </table>


        
@endsection
