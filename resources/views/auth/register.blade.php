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

      <title>Long Life - Register</title>
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
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-xl-7 p-0"><img class="bg-img-cover bg-center" src="{{ asset('/') }}admin/assets/images/login/1.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
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
                        <strong class="fs-3"></strong></a>

              <div class="login-main">
                <form class="theme-form" method="POST" action="{{ route('register') }}">
                    @csrf
                  <h4>Create your account</h4>
                  <p>Enter your personal details to create account</p>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Your Name</label>
                    <div class="row g-2">
                      <div class="form-group">
                        <input class="form-control" type="text"  name="name" placeholder="Name">
                        <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ''}}</span>
                      </div>
{{--                      <div class="col-6">--}}
{{--                        <input class="form-control" type="text" name="username" placeholder="Username">--}}
{{--                        <span class="text-danger">{{ $errors->has('username') ? $errors->first('username') : ''}}</span>--}}
{{--                      </div>--}}
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="email" name="email" placeholder="Test@gmail.com">
                    <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : ''}}</span>
                </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                        <input class="form-control" type="password" id="password" name="password" placeholder="*********">
                        <div class="show-hide">
                            <span class="show" onclick="togglePasswordVisibility(this)"></span>
                        </div>
                    </div>
                    <span class="text-danger" id="errorPassword"></span>
                    <span class="text-danger">{{ $errors->has('password') ? $errors->first('password') : ''}}</span>
                </div>
                  <div class="form-group">
                    <label class="col-form-label">Phone number</label>
                    <input class="form-control" type="text" name="phone" placeholder="phone">
                    <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : ''}}</span>
                  </div>

                  <div class="form-group">
                    <label class="col-form-label">Referral Code (Optional)</label>
                    <input class="form-control" type="text" name="referral_code" placeholder="Enter referral code">
{{--                    <span class="text-danger">{{ $errors->has('referral_code') ? $errors->first('referral_code') : ''}}</span>--}}
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button>
                  </div>
{{--                  <h6 class="text-muted mt-4 or">Or signup with</h6>--}}
{{--                  <div class="social mt-4">--}}
{{--                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>--}}
{{--                  </div>--}}
                  <p class="mt-4 mb-0 text-center">Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script>
        function togglePasswordVisibility(button) {
            var passwordInput = document.getElementById('password');
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                button.textContent = "";
            } else {
                passwordInput.type = "password";
                button.textContent = "";
            }
        }

      </script>


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

      <!-- Theme js-->
      <script src="{{ asset('/') }}admin/assets/js/script.js"></script>
      <!-- Plugin used-->
    </div>
  </body>
</html>
