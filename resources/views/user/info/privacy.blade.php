@extends('user.components.layout')
@push('css')
    <style>
        .tnc-container {
            padding: 8rem;
            position: relative;
        }

        .tnc-container h1 {
            font-size: 3rem;
            color: #2b3e50;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 1rem;
        }

        .tnc-container li {
            font-size: 2rem;
            color: #000;
            margin-bottom: 1rem;
        }

        .tnc-container img {
            position: fixed;
            right: 0;
            top: 50%;
            transform: translate(0, -50%);
            z-index: -2;
            opacity: 0.6;
        }

        footer{
            background: #fff;
        }

        @media only screen and (max-width:600px) {
            .tnc-container {
                padding: 4rem;
            }
        }
    </style>
@endpush
@section('main')
    <main>
        <div class="tnc-container">
            <div class="text-box">
                <h1> Privacy Policy</h1>
                <ul>
                    <li>GoingBo respects your privacy and recognizes the need to protect the personally identifiable information (any information by which you can be identified such as name, gender, email address, postal address, frequent flyer number, age, telephone number, etc.) you share with us. We would like to assure you that we follow appropriate standards when it comes to protecting your privacy on our Sales Channel.</li>
                    <li>This Privacy Policy is applicable to persons who purchase/intend to purchase/inquire about any product(s) and/or service(s) made available by GoingBo ('User') through any of GoingBo's customer interface channels including website, mobile site, mobile app, & offline channels including call centers and offices (collectively referred herein as "Sales Channels").</li>
                    <li>By using or accessing the Website or other Sales Channels, the User hereby agrees with the terms of this Privacy Policy and the contents herein. If you disagree with this Privacy Policy, please do not use or access our Website or other Sales Channels.</li>
                    <li>This Privacy Policy does not apply to any website(s), mobile sites, and mobile apps of third parties even if their websites/products are linked to our Website. Users should take note that information and privacy practices of GoingBo's business partners, advertisers, sponsors, or other sites to which GoingBo provides hyperlink(s) may be materially different from this Privacy Policy. Accordingly, it is recommended that you review the privacy statements and policies of any such third parties.</li>
                    <li>Information We Collect: With specific reference to booking/e-commerce transactions, GoingBo collects the following personal sensitive information from you while transacting through GoingBo:
                        <ul>
                            <li>Name and Gender</li>
                            <li>Phone Number</li>
                            <li>Address</li>
                            <li>Credit Card details</li>
                            <li>Date of birth in case of a child</li>
                            <li>Passport Number & frequent flyer number (wherever needed)</li>
                        </ul>
                    </li>
                    <li>How the Information is used: GoingBo does not sell or trade upon any of the above foregoing information without the consent of the user or customer. The foregoing information collected from the users/customers/travelers is put to the following use:
                        <ul>
                            <li>Customer name, address, phone number, traveler's name, and age are shared with applicable service providers like the airlines, hotels, etc. for the purpose of reservation and booking the services for the customer/traveler.</li>
                            <li>Information like Credit Card Details and Net Banking Details are usually collected directly by the payment gateways and banks and not by GoingBo, but if ever stored or retained by us remain internal and are never shared.</li>
                            <li>These details are also shared with certain third parties only for the purpose of processing 'Cash Back & Discounts' and Charge Backs if applicable.</li>
                            <li>Information like Mobile no, e-mail address, and postal address may be used for promotional purposes unless the customer/user "opts-out" of such use.</li>
                        </ul>
                    </li>
                    <li>If you choose not to share this information, you can still visit the GoingBo website, but you may be unable to avail certain options, offers, and services.</li>
                    <li>In general, you can visit the GoingBo website without telling us who you are or revealing any personal information about yourself. We track the Internet address of the domains from which people visit us and analyze this data for trends and statistics, but the individual user remains anonymous.</li>
                    <li>Cookies and Session Data: Some of our web pages use "cookies" so that we can better serve you with customized information when you return to our site. Cookies are identifiers which web sites send to the browser on your computer to facilitate your next visit to our site. You can set your browser to notify you when you are sent a cookie, giving you the option to decide whether or not to accept it. The information we collect and analyze is used to improve our service to you.</li>
                    <li>Automatic Logging of Session Data: Each time you access the Website, your session data gets logged. Session data consists of the User's IP address, operating system, and type of browser software being used and the activities conducted by the User while on the Website. We collect session data because it helps us analyze User's choices, browsing pattern including the frequency of visits and duration for which a User is logged on. It also helps us diagnose problems with our servers and lets us better administer our systems. The aforesaid information cannot identify any User personally. However, it is possible to determine a User's Internet Service Provider (ISP) and the approximate geographic location of User's point of connectivity from the IP address.</li>
                    <li>With whom your Personal Information is Shared: GoingBo respects your privacy and recognizes the need to protect the personally identifiable information (any information by which you can be identified such as name, gender, email address, postal address, frequent flyer number, age, telephone number, etc.) you share with us. We would like to assure you that we follow appropriate standards when it comes to protecting your privacy on our Sales Channel.</li>
                    <li>This Privacy Policy is applicable to persons who purchase/intend to purchase/inquire about any product(s) and/or service(s) made available by GoingBo('User') through any of GoingBo's customer interface channels including website, mobile site, mobile app, & offline channels including call centers and offices (collectively referred herein as "Sales Channels").</li>
                    <li>By using or accessing the Website or other Sales Channels, the User hereby agrees with the terms of this Privacy Policy and the contents herein. If you disagree with this Privacy Policy, please do not use or access our Website or other Sales Channels.</li>
                    <li>This Privacy Policy does not apply to any website(s), mobile sites, and mobile apps of third parties even if their websites/products are linked to our Website. Users should take note that information and privacy practices of GoingBo's business partners, advertisers, sponsors, or other sites to which GoingBo provides hyperlink(s) may be materially different from this Privacy Policy. Accordingly, it is recommended that you review the privacy statements and policies of any such third parties.</li>
                    <li>The other information that we collect:
                        <ul>
                            <li>Analytics: Google Analytics, Appsflyer, Facebook Ads conversion tracking, Google Tag Manager, Omniture- Cookies Usage Data and various types of Data as specified in the privacy policy of the service.</li>
                            <li>Infrastructure monitoring: Crashlytics- Geographic position, unique device identifiers for advertising (Google Advertiser ID or IDFA for example), and various types of Data as specified in the privacy policy of the service.</li>
                            <li>Location-based interactions: Geographical locations, Unique device identification.</li>
                        </ul>
                    </li>
                    <li>This Application may track Users by storing a unique identifier of their device for analytics purposes or for storing Users' preferences.</li>
                    
                    
                </ul>
                <h5>Thank you for using GoingBo!</h5>
            </div>
            <img src="{{ asset('images/all-img/work-img-7.png') }}" alt="Terms and Conditions Image">

        </div>
    </main>
@endsection
