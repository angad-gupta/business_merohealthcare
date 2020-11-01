@extends('layouts.front')
@section('title','Discount Offers')
@section('content')
<style>
    #promotion{
        font-weight: 700;
        color:#2385aa !important;
    }
    p{
        text-align:justify !important;
    }
</style>

    <div class="title-overlay-wrap overlay" style="background-image: url('https://static-06.tfipost.com/wp-content/uploads/2018/03/coupon-code-750x375.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                  
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="margin-bottom: 15px;">
<div class="row">
<div class="col-md-12">
    <div class="container">
       
        <p>&nbsp;</p>
        <p style="font-size:20px;"><strong>Sign up and get 5% additional discount.</strong></p>
        <p><strong>1. Sign Up</strong></p>
        <p>Be a family of Merohealthcare by clicking <span style="color: #2383aa;">&ldquo;LOGIN&rdquo; </span>at the right corner of the homepage.</p>
        <p>You can also sign it with your Facebook and Google Account.</p>
        <p><strong>2. Verify your Email</strong></p>
        <p>After you sign up you will receive an auto generated email on your registered email id. Open the email and click the link <span style="color: #2383aa;">&ldquo;verify your email id&rdquo;</span></p>
        <p><strong>3. Shop</strong></p>
        <p>Once the link is verified you will be auto redirected to the homepage and logged in with your account. Now you can start shopping and add items to your cart.</p>
        <p><strong>4. Checkout</strong></p>
        <p>After you have finished loading items on your cart, please click<span style="color: #2383aa;"> <strong>&ldquo;</strong>CHECKOUT&rdquo;</span> located at the top right screen of the page.</p>
        <p><strong>5. Use coupon code &ldquo;MERO&rdquo;</strong></p>
        <p>After you click <span style="color: #2383aa;">“CHECKOUT”</span> you will be directed to the order detail page that shows your total listed 
            items, right next to it is an order summary section on it there is a drop down named <span style="color: #2383aa;">“coupon code”</span>, click 
            it and type <span style="color: #2383aa;">“MERO”</span> on the blank field and press <span style="color: #2383aa;">“Apply Coupon”</span> you will see your bill auto deducted by 
            additional 5%. Fill in the further details as shown in the later page and proceed checkout. </p>
        <p><span style="color: #2383aa;"><strong>HAPPY SHOPPING and welcome to the MERO family.</strong></span></p>
        <p><strong>What are you getting on signing up with MEROHEALTHCARE? </strong></p>
        <p>1. Firstly, you will be a member of MERO family. <i class="fa fa-smile-o" style="color:orange;"></i>
        </p>
        <p>2. Personal dashboard where you can track your purchase history and store your medical prescription.  
        </p>
        <p>3. Add to “Favorites” for quick and easy shopping. 
        </p>
        <p>4. Simple and fast checkouts process. 
        </p>
        <p>5. Write your health questions to our in-house doctors for FREE. </p>
        <p>6. Advanced email alerts notifying upcoming promotional deals. 
        </p>
        <p>7. Discount coupons rewards on different promotional campaigns.  
        </p>
      
    </div>
</div>
<div class="col-md-4">
    <!-- Ending of Section title overlay area -->
    @php
        $adv = App\Advertise::where('status','=','1')->get();
    @endphp

 <div class="container">
    {{-- <h1 class="h4">Discount Offers</h1> --}}
    
     {{-- <div class="col-md-12">
        <img src="https://www.merohealthcare.com/assets/images/1598684998WhatsApp%20Image%202020-08-29%20at%2012.06.31%20PM.jpeg"/>
     </div>
    --}}
    </div>
</div>
</div>

</div>

<div class="container">
    <p style="font-size:20px;"><strong>Our upcoming projects for MERO family member only. </strong></p>
    <p><strong>Family:</strong> Family is a smart digital database that will allow our MERO family member to store all type of 
        medical file online. The program is being designed in a simple database structure which further allows 
        the member to store the medical files of their family too. All listed family member will have separate 
        designated section to store their individual medical files so that the management and retrieval process 
        of these files will be easy. </p>
    <p>
        The family program also lets members to share and retrieve their saved medical files with Merohealtcare 
        mobile application.  
    </p>
    <p>Mero member can also assign to services like medicine reminder, medicine refills that can be assign to 
        any or all member on listed on his/her  family list.  </p>
    <p><strong>Loyalty point programs: </strong> The program is designed to reward and thank all our MERO member for their 
        continuous support and trust in us. The loyalty point programs allows the MERO member to earn certain 
        MERO points on their every purchase. The member can redeem their collected MERO points in their 
        future transaction to receive the award benefited with the loyalty points.    </p>
    <p style="font-size:20px;"><strong>Our other upcoming projects</strong> </p>
    <p><strong>Online medical consultation:</strong> The program allows clients to take doctor consultation online. This 
        program will have a pool of doctors from different specialty. The clients can book appointments, do live 
        consultation, send medical reports, schedule later appointments online to any doctor from the pool.  
        MERO member’s medical database will be interlinked in this program allowing MERO members to share 
        their and their family medical files to any medical sessions with simple clicks. </p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
</div>


@endsection