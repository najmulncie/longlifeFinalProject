<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Long Life - Make money, earn profit.</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @php
        $logo = \App\Models\Logo::where('status', 1)->first(); // সক্রিয় লোগো খুঁজে আনা
    @endphp
    <link rel="icon" href="{{ asset($logo->image) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset($logo->image) }}" type="image/x-icon">

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/LineIcons.2.0.css" />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/animate.css" />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/tiny-slider.css" />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/glightbox.min.css" />
    <link rel="stylesheet" href="{{ asset('/') }}frontend/assets/css/main.css" />

</head>

<body>
<!--[if]>
<p class="browserupgrade">
    You are using an <strong>outdated</strong> browser. Please
    <a href="https://browsehappy.com/">upgrade your browser</a> to improve
    your experience and security.
</p>
<![endif]-->

<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- /End Preloader -->

<!-- Start Header Area -->
<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <!-- Start Navbar -->
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="{{ route('home') }}">
                            @foreach( $logos as $logo )
                                <img class="img-fluid" src="{{ asset( $logo->image ) }}" alt="Logo">
                            @endforeach
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>


                        @if (Route::has('login'))

                            <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ms-auto">
                                    @auth
                                        <li class="nav-item">
                                            <a href="{{ url('/dashboard') }}" aria-label="Toggle navigation">Dashboard</a>
                                        </li>
                                    @else

                                    <li class="nav-item">
                                        <a href="{{ route('login') }}" aria-label="Toggle navigation">login</a>
                                    </li>
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a href="{{ route('register') }}" aria-label="Toggle navigation">Register</a>
                                            </li>
                                        @endif
                                    @endauth
                                </ul>
                            </div> <!-- navbar collapse -->
                        @endif
                            <div class="button add-list-button">
                            <a href="javascript:void(0)" class="btn">Get it now</a>
                        </div>
                    </nav>
                    <!-- End Navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
<!-- End Header Area -->

<!-- Start Hero Area -->
<section id="home" class="hero-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12 col-12">
                <div class="hero-content">
                    <h1 class="wow fadeInLeft" data-wow-delay=".4s">A powerful site for your earn money.</h1>
                    <p class="wow fadeInLeft" data-wow-delay=".6s">Earning money is a simple thing,
                        Work with heart, let success ring.
                        With talent, the path will unfold,
                        Hard work brings success untold.</p>
                    <div class="button wow fadeInLeft" data-wow-delay=".8s">
                        <a href="javascript:void(0)" class="btn"><i class="lni lni-apple"></i> App Store</a>
                        <a href="javascript:void(0)" class="btn btn-alt"><i class="lni lni-play-store"></i> Google
                            Play</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-12">
                <div class="hero-image wow fadeInRight" data-wow-delay=".4s">
                    <img src="{{ asset('/') }}frontend/assets/images/hero/phone.png" alt="#">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Hero Area -->


<!-- ========================= JS here ========================= -->
<script src="{{ asset('/') }}frontend/assets/js/bootstrap.min.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/wow.min.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/tiny-slider.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/glightbox.min.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/count-up.min.js"></script>
<script src="{{ asset('/') }}frontend/assets/js/main.js"></script>
<script type="text/javascript">

    //====== counter up
    var cu = new counterUp({
        start: 0,
        duration: 2000,
        intvalues: true,
        interval: 100,
        append: " ",
    });
    cu.start();
</script>
</body>

</html>
