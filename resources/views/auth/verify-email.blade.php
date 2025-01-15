<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mofi admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Mofi admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    @php
        $logo = \App\Models\Logo::where('status', 1)->first(); // সক্রিয় লোগো খুঁজে আনা
    @endphp
    <link rel="icon" href="{{ asset($logo->image) }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset($logo->image) }}" type="image/x-icon">

    <title>Long Life - email verify</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/feather-icon.css">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ asset('/') }}admin/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}admin/assets/css/responsive.css">
</head>
<body>
<div class="loader-wrapper">
    <div class="loader loader-1">
        <div class="loader-outter"></div>
        <div class="loader-inner"></div>
        <div class="loader-inner-1"></div>
    </div>
</div>
<!-- loader ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper compact-wrapper" id="pageWrapper">

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Ends-->
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            @if (session('status') == 'verification-link-sent')
                                <div class="card-body">
                                    <div class="alert txt-success border-success outline-2x alert-dismissible fade show alert-icons" role="alert"><i data-feather="thumbs-up"></i>
                                        <p> Well done!A new verification link has been sent to the email address.</p>
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Email Verify</h4><span></span>
                            </div>
                            <div class="card-body">
                                <p class="fs-5">"Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another."</p>

                                <div class="mt-4 flex items-center justify-between">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf

                                        <div>
                                            <button class="float-start btn btn-primary btn-sm" type="submit">
                                                Resend Verification Email
                                            </button>

                                        </div>
                                    </form>

                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf

                                        <button type="submit" class="float-end btn btn-sm btn-info">
                                            Log Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
        </div>
    </div>
</div>
<!-- latest jquery-->
<script src="{{ asset('/') }}admin/assets/js/jquery.min.js"></script>
<!-- Bootstrap js-->
<script src="{{ asset('/') }}admin/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="{{ asset('/') }}admin/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="{{ asset('/') }}admin/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="{{ asset('/') }}admin/assets/js/config.js"></script>

<!-- Theme js-->
<script src="{{ asset('/') }}admin/assets/js/script.js"></script>
<script src="{{ asset('/') }}admin/assets/js/theme-customizer/customizer.js"></script>
<!-- Plugin used-->
</body>
</html>











{{--    <div class="mb-4 text-sm text-gray-600">--}}
{{--        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}--}}
{{--    </div>--}}

{{--    @if (session('status') == 'verification-link-sent')--}}
{{--        <div class="mb-4 font-medium text-sm text-green-600">--}}
{{--            {{ __('A new verification link has been sent to the email address you provided during registration.') }}--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="mt-4 flex items-center justify-between">--}}
{{--        <form method="POST" action="{{ route('verification.send') }}">--}}
{{--            @csrf--}}

{{--            <div>--}}
{{--                <x-primary-button>--}}
{{--                    {{ __('Resend Verification Email') }}--}}
{{--                </x-primary-button>--}}
{{--            </div>--}}
{{--        </form>--}}

{{--        <form method="POST" action="{{ route('logout') }}">--}}
{{--            @csrf--}}

{{--            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">--}}
{{--                {{ __('Log Out') }}--}}
{{--            </button>--}}
{{--        </form>--}}
{{--    </div>--}}

