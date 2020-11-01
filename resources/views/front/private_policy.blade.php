@extends('layouts.front')
@section('title','Privacy Policy')
@section('content')

    <!-- Starting of Section title overlay area -->
    <div class="title-overlay-wrap overlay" style="background-image: url({{asset('assets/images/'.$gs->bgimg)}});">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 text-center">
            <h1>Privacy Policy</h1>
          </div>
        </div>
      </div>
    </div>
    <!-- Ending of Section title overlay area -->

<!-- Starting of faq area -->
        <div class="container">
            <div class="section-padding">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{-- <div class="styled-faq">
                            <h3  dir="{{$lang->rtl == 1 ? 'rtl':''}}">{{$lang->maq}}</h3>
                            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{$fq->id}}">
                                        <h4  dir="{{$lang->rtl == 1 ? 'rtl':''}}" class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$fq->id}}" aria-expanded="true" aria-controls="collapse{{$fq->id}}">
                                                <span>{{$fq->title}}</span>
                                                <i class="fa fa-plus"></i>
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$fq->id}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{$fq->id}}">
                                        <div class="panel-body"  dir="{{$lang->rtl == 1 ? 'rtl':''}}">
                                        {!! $fq->text !!}
                                        </div>
                                    </div>
                                </div>
                                @foreach($faqs as $faq)
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading{{$faq->id}}">
                                        <h4 dir="{{$lang->rtl == 1 ? 'rtl':''}}" class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$faq->id}}" aria-expanded="false" aria-controls="collapse{{$faq->id}}">
                                                <span>{{$faq->title}}</span>
                                                <i class="fa fa-plus"></i>
                                                <i class="fa fa-minus"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse{{$faq->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$faq->id}}">
                                        <div class="panel-body"  dir="{{$lang->rtl == 1 ? 'rtl':''}}">
                                        {!! $faq->text !!}
                                        </div>
                                    </div>
                                </div>

                                @endforeach
                            </div>
                        </div> --}}
                        <p style="text-align: justify;"><strong>Privacy Policy</strong></p>
<p style="text-align: justify;">Please read this privacy policy carefully by accessing or using the website, you agree to be bound by the terms described herein and all the terms incorporated by reference. If you do not agree to all of these terms, do not use the website.</p>
<p style="text-align: justify;"><strong>Content &amp; Purpose</strong></p>
<ol style="text-align: justify;">
<ol>
<li>This privacy policy (&ldquo;Privacy Policy&rdquo;) applies to your use of the domain name www.merohealthcare.com, an internet based portal, owned and operated by Web Health Company Company Private Limited, a company duly incorporated under the provisions of the Companies Act, 2013 (hereinafter, referred to as &ldquo;Web Health Company&rdquo; or &ldquo;We&rdquo; or &ldquo;Our&rdquo; or &ldquo;Us&rdquo; or &ldquo;Company&rdquo;). The domain name and the mobile application are collectively referred to as &ldquo;Website&rdquo;.</li>
<li>The Website is a platform that facilitates the purchase of complete health care products for sale by Web Health Company Company under the brand name &ldquo;Merohealthcare&rdquo; and Laboratory testing services by various registered Laboratories (hereinafter referred to as &ldquo;Services&rdquo;, with the relevant pharmacy/ Laboratories referred to as &ldquo;Sellers&rdquo;). The arrangement between the Sellers and Web Health Company shall be governed in accordance with this Privacy Policy and the Terms of Use. The Services would be made available to such natural persons who have agreed to become buyers on the Website after obtaining due registration, in accordance with the procedure as determined by Web Health Company, from time to time (referred to as &ldquo;You&rdquo; or &ldquo;Your&rdquo; or &ldquo;Yourself&rdquo; or &ldquo;User&rdquo;, which terms shall also include natural persons who are accessing the Website merely as visitors). The Services are offered to the Users through various modes which shall include issue of discount coupons and vouchers that can be redeemed for various goods/ services offered for sale by the Sellers.</li>
<li>We have implemented reasonable security practices and procedures that are commensurate with the information assets being protected and with the nature of our business. While we try our best to provide security that is commensurate with the industry standards, because of the inherent vulnerabilities of the internet, we cannot ensure or warrant complete security of all information that is being transmitted to us by you.</li>
<li>For the purpose of providing the Services and for other purposes identified in this Privacy Policy, Web Health Company will be required to collect and host certain data and information of the Users. Web Health Company is committed to protecting the Personal Information of the Users and takes all reasonable precautions for maintaining confidentiality of the User&rsquo;s Personal Information. This Privacy Policy has been designed and developed to help you understand the following:</li>
<ol>
<li><strong>The type of Personal Information (including Sensitive Personal Data or Information) that Web Health Company collects from the Users;</strong></li>
<li><strong>The purpose of collection, means and modes of usage of such Personal Information by Web Health Company;</strong></li>
<li><strong>How and to whom Web Health Company will disclose such information;</strong></li>
<li><strong>How Web Health Company will protect the Personal Information including Sensitive Personal Data or Information that is collected from the Users; and</strong></li>
<li><strong>How Users may access and/ or modify their Personal Information.</strong></li>
</ol>
<li>&nbsp;This Privacy Policy shall apply to the use of the Website by all Users / Sellers. Accordingly, a condition of each User's use of and access to the Website and to the other services provided by Web Health Company to Users is their acceptance of this Privacy policy. Any User is required to read and understand the provisions set out herein prior to submitting any Sensitive Personal Data or Information to Web Health Company, failing which they are required to leave the Website immediately.</li>
<li>&nbsp;This Privacy Policy is published in compliance of the Privacy Act, 2075 (2018) of Nepal.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>What is the personal information?</strong></p>
<ol style="text-align: justify;">
<li>&ldquo;Personal Information&rdquo; means any information that relates to a natural person, which, either directly or indirectly, in combination with other information available with Web Health Company, is capable of identifying the person concerned.</li>
<li>&ldquo;Sensitive Personal Data or Information&rdquo; means Personal Information of any individual relating to password; financial information such as bank account or credit card or debit card or other payment instrument details; physical, physiological and mental health condition; sexual orientation; medical records and history; biometric information; any detail relating to the above as provided to or received by Web Health Company for processing or storage. However, any data/ information relating to an individual that is freely available or accessible in public domain or furnished under the Right to Information Act, 2064 (2007) of Nepal or any other law shall not qualify as Sensitive Personal Data or Information.</li>
</ol>
<p style="text-align: justify;"><strong>Types of personal information collected by Web Health Company:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;A User may have limited access to the Website and utilize some of the Services provided by Web Health Company without creating an account on the Website. Unregistered Users can access some of the information and details available on the Website. In order to have access to all the features and benefits on our Website, a User may be required to first create an account on our Website. As part of the registration process, Web Health Company may collect the following categories of Personal Information from the Users (hereinafter collectively referred to as &ldquo;User Information&rdquo;):</li>
<ol>
<li><strong>Name;</strong></li>
<li><strong>Email address;</strong></li>
<li><strong>Address (including country and ZIP/postal code);</strong></li>
<li><strong>Gender; </strong></li>
<li><strong>Date of Birth;</strong></li>
<li><strong>Phone Number;</strong></li>
<li><strong>Password chosen by the User;</strong></li>
<li><strong>Valid financial account information; and</strong></li>
<li><strong>Other details as the User may volunteer.</strong></li>
</ol>
<li>&nbsp;In order to avail the Services, the Users may be required to upload copies of their prescriptions, on the Website and/ or e-mail the same to Web Health Company in accordance with the Terms of Use and the prescriptions will be stored/ disclosed by Web Health Company only in the manner specified in this Privacy Policy and the Terms of Use. The term &ldquo;User Information&rdquo; shall also include any such prescriptions uploaded or otherwise provided by Users.</li>
<li>&nbsp;Web Health Company may keep records of telephone calls received and made for making inquiries, orders, or other purposes for the purpose of administration of Services.</li>
<li>&nbsp;<strong>Internet use:&nbsp;</strong>Web Health Company may also receive and/or hold information about the User&rsquo;s browsing history including the URL of the site that the User visited prior to visiting the website as well as the Internet Protocol (IP) address of each User's computer (or the proxy server a User used to access the World Wide Web), User's computer operating system and type of web browser the User is using as well as the name of User's ISP. The Website uses temporary cookies to store certain data (that is not Sensitive Personal Data or Information) that is used by Web Health Company and its service providers for the technical administration of the Website, research and development, and for User administration.</li>
<li>&nbsp;The Website may enable User to communicate with other Users or to post information to be accessed by others, whereupon other Users may collect such data. Web Health Company hereby expressly disclaims any liability for any misuse of such information that is made available by visitors in such a manner.</li>
<li>&nbsp;Web Health Company does not knowingly collect Personal Information from children.</li>
<li>&nbsp;Web Health Company may in future include other optional requests for information from the User including through user surveys in order to help Web Health Company customize the Website to deliver personalized information to the User and for other purposes are mentioned herein. Such information may also be collected in the course of contests conducted by Web Health Company. Any such additional Personal Information will also be processed in accordance with this Privacy Policy.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<p style="text-align: justify;"><strong>Purposes for which your information may be used by Web Health Company:</strong></p>
<ol style="text-align: justify;">
<li>Web Health Company will retain User Information only to the extent it is necessary to provide Services to the Users. The information which Web Health Company collects from you may be utilized for various business and/or regulatory purposes including for the following purposes:</li>
</ol>
<ol style="text-align: justify;">
<ol>
<ol>
<li><strong>Registration of the User on the Website;</strong></li>
<li><strong>Processing the User&rsquo;s orders / requests and provision of Services (including provision of safe Services);</strong></li>
<li><strong>Completing transactions with Users effectively and billing for the products/ Services provided;</strong></li>
<li><strong>Technical administration and customization of Website;</strong></li>
<li><strong>Ensuring that the Website content is presented to the Users in an effective manner;</strong></li>
<li><strong>Delivery of personalized information and target advertisements to the User;</strong></li>
<li><strong>Improvement of Services, features and functionality of the Website;</strong></li>
<li><strong>Research and development and for User administration (including conducting user surveys);</strong></li>
<li><strong>Non-personally identifiable information, exclusively owned by Web Health Company may be used in an aggregated or non-personally identifiable form for internal research, statistical analysis and business intelligence purposes including those for the purposes of determining the number of visitors and transactional details, and Web Health Company may sell or otherwise transfer such research, statistical or intelligence data in an aggregated or non-personally identifiable form to third parties and affiliates;</strong></li>
<li><strong>Dealing with requests, enquiries, complaints or disputes and other customer care related activities including those arising out of the Users&rsquo; request of the Services and all other general administrative and business purposes;</strong></li>
<li><strong>In case of any contests conducted by Web Health Company in which the User participates, the User Information may be used for prize fulfillment and other aspects of any contest or similar offering;</strong></li>
<li><strong>Communicate any changes in our Services or this Privacy Policy or the Terms of Use to the Users;</strong></li>
<li><strong>Verification of identity of Users and perform checks to prevent frauds; and</strong></li>
</ol>
</ol>
</ol>
<p style="text-align: justify;"><strong>Investigating, enforcing, resolving disputes and applying our Terms of Use and Privacy Policy, either ourselves or through third party service providers.</strong></p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;">&nbsp;</p>
<p style="text-align: justify;"><strong>Disclosure and transfer of your personal information:</strong></p>
<ol style="text-align: justify;">
<li>Web Health Company may need to disclose/ transfer User&rsquo;s Personal Information to the following third parties for the purposes mentioned in this Privacy Policy and the Terms of Use:
<ol>
<li><strong>To Sellers and other service providers appointed by Web Health Company for the purpose of carrying out services on Web Health Company&rsquo;s behalf under contract. Generally these contractors do not have any independent right to share this information, however certain contractors who provide services on the Website, including the providers of online communications services, will have rights to use and disclose the Personal Information collected in connection with the provision of these services in accordance with their own privacy policies.</strong></li>
<li><strong>To our affiliates in Nepal or in other countries who may use and disclose your information for the same purposes as us.</strong></li>
</ol>
</li>
</ol>
<ul style="text-align: justify;">
<li><strong>To government institutions/ authorities to the extent required a) under the laws, rules, and regulations and/ or under orders of any relevant judicial or quasi-judicial authority; b) to protect and defend the rights or property of Web Health Company; c) to fight fraud and credit risk; d) to enforce Web Health Company&rsquo;s Terms of Use (to which this Privacy Policy is also a part) ; or e) when Web Health Company, in its sole discretion, deems it necessary in order to protect its rights or the rights of others.</strong></li>
</ul>
<ol style="text-align: justify;">
<li><strong>If otherwise required by an order under any law for the time being in force including in response to enquiries by Government agencies for the purpose of verification of identity, or for prevention, detection, investigation including cyber incidents, prosecution, and punishment of offences.</strong></li>
<li><strong>In case of contests conducted by Web Health Company in which the User participates, the concerned User&rsquo;s information may be disclosed to third parties, also be disclosed to third parties to the extent necessary for prize fulfillment and other aspects of such contest or similar offering.</strong></li>
</ol>
<ol style="text-align: justify;" start="2">
<li>Web Health Company makes all User Information accessible to its employees and data processors only on a need-to-know basis. All Web Health Company employees and data processors, who have access to, and are associated with the processing of User Information, are obliged to respect its confidentiality.</li>
<li>Non-personally identifiable information may be disclosed to third party ad servers, ad agencies, technology vendors and research firms to serve advertisements to the Users. Web Health Company may also share its aggregate findings (not specific information) based on information relating to the User&rsquo;s internet use to prospective, investors, strategic partners, sponsors and others in order to help growth of Web Health Company&rsquo;s business.</li>
<li>Web Health Company may also disclose or transfer the User Information, to another third party as part of reorganization or a sale of the assets or business of a Web Health Company corporation division or company. Any third party to which Web Health Company transfers or sells its assets will have the right to continue to use the Personal Information and/ or other information that a User provide to us.</li>
</ol>
<p style="text-align: justify;"><strong>Retention of the information:</strong></p>
<ol style="text-align: justify;">
<li>All the information collected/ stored under this Privacy Policy and Terms of Use is maintained by Web Health Company in electronic form on its equipment, and on the equipment of its employees. User Information may also be converted to physical form from time to time. Regardless of the manner of storage, Web Health Company will keep all User Information confidential and will use/ disclose it only the manner specified under the Privacy Policy and Terms of Use.</li>
<li>Part of the functionality of the Website is assisting the Sellers to maintain and organize such information to effect sale and purchase of products. Web Health Company may, therefore, retain and submit all such records to the appropriate authorities, or to Sellers who request access to such information.</li>
<li>The Website is also designed for assisting the Users to access information relating to pharmaceutical products. Web Health Company may, therefore, retain and submit all such records to the relevant Users.</li>
<li>Web Health Company will also ensure that User Information is not kept for a period longer than is required for the purposes for which it is collected or as required under any applicable law.</li>
</ol>
<p style="text-align: justify;"><strong>&nbsp;</strong></p>
<p style="text-align: justify;"><strong>Links to third-party advertisements:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;The links to third-party advertisements, third party websites or any third party electronic communication services (referred to as &ldquo;Third Party Links&rdquo;) may be provided on the Website which are operated by third parties and are not controlled by, or affiliated to, or associated with Web Health Company unless expressly specified on the Website.</li>
<li>&nbsp;If you access any such Third-Party Links, we request you review the website&rsquo;s privacy policy. We are not responsible for the policies or practices of Third-Party Links.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>Security practices and procedures:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;Web Health Company adopts reasonable security practices and procedures to include, technical, operational, managerial and physical security control measures in order to protect the Personal Information in its possession from loss, misuse and unauthorized access, disclosure, alteration and destruction.</li>
<li>&nbsp;Web Health Company takes adequate steps to ensure that third parties to whom the Users&rsquo; Sensitive Personal Data or Information may be transferred adopt reasonable level of security practices and procedures to ensure security of Personal Information.</li>
<li>&nbsp;You hereby acknowledge that Web Health Company is not responsible for any intercepted information sent via the internet, and you hereby release us from any and all claims arising out of or related to the use of intercepted information in any unauthorized manner.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>User's rights in relation to their personal information collected by Web Health Company:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;All the information provided to Web Health Company by a User, including Sensitive Personal Data or Information, is voluntary. User has the right to withdraw his/ her/ its consent at any time, in accordance with the terms of this Privacy Policy and the Terms of Use, but please note that withdrawal of consent will not be retroactive.</li>
<li>&nbsp;Users can access, modify, correct and delete the Personal Information provided by them which has been voluntarily given by the User and collected by Web Health Company in accordance with this Privacy Policy and Terms of Use. However, if the User updates his/ her information, Web Health Company may keep a copy of the information which User originally provided to Web Health Company in its archives for User documented herein.</li>
<li>&nbsp;If a User, as a casual visitor, has inadvertently browsed any other pages of this Website prior to reading the Privacy Policy and the Terms of Use, and such User does not agree with the manner in which such information is obtained, stored or used, merely quitting this browser application should ordinarily clear all temporary cookies installed by Web Health Company. All visitors, however, are encouraged to use the "clear cookies" functionality of their browsers to ensure such clearing/ deletion, as Web Health Company cannot guarantee, predict or provide for the behavior of the equipment of all the visitors of the Website.</li>
<li>&nbsp;If a User has inadvertently submitted any Personal Information to Web Health Company prior to reading the Privacy Policy and Terms of Use, and such User does not agree with the manner in which such information is collected, stored or used, then such User can ask Web Health Company, by sending an email to&nbsp;<a href="mailto:info@merohealthcare.com">info@merohealthcare.com</a>&nbsp;containing the rectification required, whether Web Health Company is keeping Personal Information about such User, and every User is also entitled to require Web Health Company to delete and destroy all such information relating to such user (but not other Users) in its possession.</li>
<li>&nbsp;In case the User does not provide his/ her information or consent for usage of Personal Information or subsequently withdraws his/ her consent for usage of the Personal Information so collected, Web Health Company reserves the right to discontinue the services for which the said information was sought.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>Additional notes to the user:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;Web Health Company does not exercise control over the sites displayed as search results or links from within its Services. These other sites may place their own cookies or other files on the Users' computer, collect data or solicit Personal Information from the Users, for which Web Health Company is not responsible or liable. Accordingly, Web Health Company does not make any representations concerning the privacy practices or policies of such third parties or terms of use of such websites, nor does Web Health Company guarantee the accuracy, integrity, or quality of the information, data, text, software, sound, photographs, graphics, videos, messages or other materials available on such websites. Web Health Company encourages the User to read the privacy policies of that website.</li>
<li>&nbsp;Web Health Company shall not be responsible in any manner for the authenticity of the Personal Information or Sensitive Personal Data or Information supplied by the User to Web Health Company or any Seller. If a User provides any information that is untrue, inaccurate, not current or incomplete (or becomes untrue, inaccurate, not current or incomplete), or Web Health Company has reasonable grounds to suspect that such information is untrue, inaccurate, not current or incomplete, Web Health Company has the right to suspend or terminate such account at its sole discretion.</li>
<li>Web Health Company shall not be responsible for any breach of security or for any actions of any third parties that receive Users' Personal Information or events that are beyond the reasonable control of Web Health Company including, acts of government, computer hacking, unauthorized access to computer data and storage device, computer crashes, breach of security and encryption, etc.</li>
<li>&nbsp;The User is responsible for maintaining the confidentiality of the User's account access information and password. The User shall be responsible for all uses of the User's account and password, whether or not authorized by the User. The User shall immediately notify Web Health Company of any actual or suspected unauthorized use of the User's account or password.</li>
</ol>
</ol>
<ol style="text-align: justify;" start="5">
<li>Web Health Company will communicate with the Users through email and notices posted on the Website or through other means available through the Service, including text and other forms of messaging. The Users can ask Web Health Company, by sending an email to&nbsp;info@merohealthcare.com&nbsp;containing the rectification required.</li>
</ol>
<p style="text-align: justify;"><strong>Changes in the privacy policy:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;Web Health Company may update this Privacy Policy at any time, with or without advance notice. In the event there are significant changes in the way Web Health Company treats User's Personal Information, Web Health Company will display a notice on the Website or send Users an email. If a User uses the Service after notice of changes have been sent to such User or published on the Website, such User hereby provides his/ her/ its consent to the changed practices.</li>
</ol>
</ol>
<p style="text-align: justify;"><strong>Complaints and grievance redressal:</strong></p>
<ol style="text-align: justify;">
<ol>
<li>&nbsp;Web Health Company addresses discrepancies and grievances of all Users with respect to processing of information in a time bound manner.&nbsp; The company will redress the grievances of the Users expeditiously but within one month from the date of receipt of grievance, and which can be reached by:</li>
<ol>
<li><strong>Sending a letter marked to the attention of &ldquo;Grievance Officer, Web Health Company Company to Kushibu, Kathmandu, Nepal</strong></li>
<li><strong>Sending an email to&nbsp;info@merohealthcare.com </strong></li>
</ol>
</ol>
</ol>
<p style="text-align: justify;"><strong>Contact us</strong></p>
<p style="text-align: justify;">You may contact us with any questions relating to this Privacy Policy by submitting your request here&nbsp;by postal mail or email at:</p>
<p style="text-align: justify;"><strong>Registered Address:</strong></p>
<p style="text-align: justify;">Kushibu, Kathmandu, Nepal Phone no: +977-01-5902444</p>
<p style="text-align: justify;"><strong>Email Address:</strong></p>
{{-- <p style="text-align: justify;">&nbsp;</p> --}}
<p style="text-align: justify;">info@merohealthcare.com</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Ending of faq area -->
@endsection