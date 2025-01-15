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

      <title>Long Life - Login</title>
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
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
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
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <div class="container-fluid p-0">
        <div class="row">
          <div class="col-12">
            <div class="login-card login-dark">
              <div>
                  @php
                      $logo = \App\Models\Logo::where('status', 1)->first(); // সক্রিয় লোগো খুঁজে আনা
                  @endphp
                  <div>
                      <a class="logo text-start" href="{{ route('login') }}">
                      @if($logo && $logo->image)  <!-- লোগো পাওয়া গেছে কিনা এবং ইমেজ ফাইল আছে কিনা চেক -->
                          <img class="img-fluid" src="{{ asset($logo->image) }}" alt="Logo">
                          @else
                              <img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="Default Logo"> <!-- ডিফল্ট লোগো -->
                          @endif
                          <strong class="fs-3">Long life</strong></a>
                  <div class="login-main">
                  <form class="theme-form" method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <h4>Forgot Your Password</h4>

                    <div class="form-group">
                      <label class="col-form-label">Email</label>
                      <div class="form-input position-relative">
                        <input class="form-control" id="email" type="email" name="email">
                        <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ' ' }}</span>
                      </div>
                    </div>
                    <div class="form-group mb-0">
                      <button class="btn btn-primary btn-block w-100" type="submit">Email Password Reset Link                          </button>
                    </div>
                    <p class="mt-4 mb-0 text-center">Already have an password?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
    <!-- scrollbar js-->
    <!-- Sidebar jquery-->
    <script src="{{ asset('/') }}admin/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <!-- calendar js-->
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('/') }}admin/assets/js/script.js"></script>
    <!-- Plugin used-->
  </body>
</html>
