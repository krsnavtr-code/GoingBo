<!DOCTYPE html>
<html lang="en">
    
<head>
<meta charset="utf-8">
<title>Goingbo Membership Plan Details for 25 Years</title>
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="keywords">
<meta content="" name="description">
<link href="img/favicon.ico" rel="icon">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

<link href="{{ asset('membership/lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('membership/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('membership/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/member/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/member/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/member/external.css') }}" rel="stylesheet">
    
</head>

<body>

    <div class="container-fluid bg-dark px-5 d-none d-lg-block">
        <div class="row gx-0">
            <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <small class="me-3 text-light"><i class="fa fa-map-marker-alt me-2"></i>B-63 1st Floor, Sector-64, Noida, India -201301</small>
                    <small class="me-3 text-light"><i class="fa fa-phone-alt me-2"></i>+91 9990999561</small>
                    <small class="text-light"><i class="fa fa-envelope-open me-2"></i>info@goingbo.com</small>
                </div>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <div class="d-inline-flex align-items-center" style="height: 45px;">
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.facebook.com/goingbo/"><i class="fab fa-facebook-f fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://twitter.com/going_bo"><i class="fab fa-twitter fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.linkedin.com/company/goingbo"><i class="fab fa-linkedin-in fw-normal"></i></a>
                    <a class="btn btn-sm btn-outline-light btn-sm-square rounded-circle me-2" href="https://www.instagram.com/goingbo_"><i class="fab fa-instagram fw-normal"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="/" class="navbar-brand p-0"><img src="{{ asset('img/GoingBologocopy.png') }}" alt="Logo"></a>
        </nav>
    </div>

    <div class="container-xxl wow fadeInUp GoingboExperience booking" data-wow-delay="0.1s">
        <div class="container" id="joinclub">
            <div class="p-5">
                <div class="row g-5 align-items-center">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                        <h6 class=" text-uppercase" style="color: #ee8837;"> Membership Booking</h6>
                        <h1 class=" mb-4" style="color: #ee8837;">Online Booking for {{ $type }} Card Membership </h1>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit.</p>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12 WonderFulme">
                        <h1 class="text-white mb-4">Invest in a lifetime of wonderful holiday memories.</h1>
                        <form method="POST" action= "{{ url('membership/'. $type. '/book') }}" class="form-horizontal" name="query">
                            @csrf
                            <div class="row g-3">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                    <input type="text" class="form-control bgtransparent" name="name" id="name" placeholder="Name" maxlength="40" pattern="[A-Za-z\s]*" required>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-12">
                                    <input type="tel" class="form-control bgtransparent" name ="mobile_no" id="Mobile Number" placeholder="Mobile Number" pattern="[0-9]{10}" maxlength="10"  required>
                                </div>
                                <div class="col-sm-7 col-md-7 col-lg-7 col-xs-12">
                                    <input type="email" class="form-control bgtransparent" name ="email" id="email" placeholder="Email" maxlength="40" required>
                                </div>
                                <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
                                    <select class="form-control"  name ="agegroup" required>
                                        <option value="" disabled="" selected="">Age group</option>  
                                        <option value="<24">&lt;24</option>  
                                        <option value="25-28">25-28</option>  
                                        <option value="29-35">29-35</option>  
                                        <option value="36-49">36-49</option>  
                                        <option value="50-55">50-55</option>  
                                        <option value=">55">&gt;55</option>   
                                    </select>
                                </div>
                               
                                <div class="col-sm-12 col-md-12 col-lg-12 col-xs-12">
                                    <input type="submit" value="Book Now" name="submit" class="btn btn-outline-light w-100 py-3">
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<div class="container-fluid bg-dark text-light footer pt-5  wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Company</h4>
                <a class="btn btn-link" href="https://www.goingbo.com/about-us">About Us</a>
                <a class="btn btn-link" href="https://www.goingbo.com/contact-us">Contact Us</a>
                <a class="btn btn-link" href="https://www.goingbo.com/privacy-policy">Privacy Policy</a>
                <a class="btn btn-link" href="https://www.goingbo.com/terms-of-uses">Terms & Condition</a>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Contact</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>B-63 1st Floor, Sector-64, Noida, India -201301</p>
                <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+91 9990999561</p>
                <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@goingbo.com</p>
                <div class="d-flex pt-2">
                    <a class="btn btn-outline-light btn-social" href="https://www.facebook.com/goingbo/"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://twitter.com/going_bo"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.linkedin.com/company/goingbo"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-light btn-social" href="https://www.instagram.com/goingbo_"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Gallery</h4>
                <div class="row g-2 pt-2">
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-1.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-3.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-2.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-3.jpg') }}" alt="">
                    </div>
                    <div class="col-4">
                        <img class="img-fluid bg-light p-1" src="{{ asset('img/package-1.jpg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <h4 class="text-white mb-3">Newsletter</h4>
                <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class="position-relative mx-auto" style="max-width: 400px;">
                    <form>
                        <input class="form-control border-primary w-100 py-3 ps-4 pe-5" type="email" placeholder="Your email" required>
                        <button type="submit" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2"> SignUp </button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; <a class="border-bottom" href="https://www.goingbo.com/">Goingbo</a>, © Copyright 2017- 2021 GoingBo Tours. All rights reserved <a class="border-bottom" href="https://www.goingbo.com/">Goingbo</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
<script src="{{ asset('lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>



</body>
</html>