<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7 order-1"><img class="bg-img-cover bg-center" src="{{ asset('/') }}admin/assets/images/login/1.jpg" alt="loogin page"></div>
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
              </div>

                @if($errors->has('account_suspended'))
                    <div class="alert alert-danger">
                        {{ $errors->first('account_suspended') }}
                    </div>
                @endif

                <div class="login-main">
                <form id="loginForm" class="theme-form" method="POST" action="{{ route('login') }}">
                    @csrf
                  <h4>Sign in to account</h4>
                  <p>Enter your email or username or phone & password to login</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Or Phone Or UserName</label>
                    <input class="form-control" name="login" type="text" placeholder="email or phone or username">
                      <span class="text-danger">{{ $errors->has('login') ? $errors->first('login') : ''}}</span>
                      <span class="text-danger" id="errorLogin"></span>
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
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Remember password</label>
                    </div><a class="link" href="{{ route('password.request') }}">Forgot password?</a>
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" type="submit">Login</button>
                    </div>
                  </div>
{{--                  <h6 class="text-muted mt-4 or">Or Sign in with</h6>--}}
{{--                  <div class="social mt-4">--}}
{{--                    <div class="btn-showcase"><a class="btn btn-light" href="https://www.linkedin.com/login" target="_blank"><i class="txt-linkedin" data-feather="linkedin"></i> LinkedIn </a><a class="btn btn-light" href="https://twitter.com/login?lang=en" target="_blank"><i class="txt-twitter" data-feather="twitter"></i>twitter</a><a class="btn btn-light" href="https://www.facebook.com/" target="_blank"><i class="txt-fb" data-feather="facebook"></i>facebook</a></div>--}}
{{--                  </div>--}}
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="{{ route('register') }}">Create Account</a></p>

                </form>
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
      {{-- <script src="{{ asset('/') }}admin/assets/js/custom_js/validation/custom_validation.js"></script>
      <script src="{{ asset('/') }}admin/assets/js/custom_js/validation/validate.min.js"></script> --}}
      <!-- Plugin used-->
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

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
          var loginInput = document.getElementsByName('login')[0].value.trim();
          var passwordInput = document.getElementsByName('password')[0].value.trim();
          var errorLogin = document.getElementById('errorLogin');
          var errorPassword = document.getElementById('errorPassword');
          var isValid = true;

          // Reset error messages
          errorLogin.textContent = '';
          errorPassword.textContent = '';

          // Validate login field
          if (loginInput === '') {
            errorLogin.textContent = 'Please enter your email, phone, or username';
            isValid = false;
          }

          // Validate password field
          if (passwordInput === '') {
            errorPassword.textContent = 'Please enter your password';
            isValid = false;
          }
          if (loginInput !== '' && passwordInput !== '') {
            // errorLogin.textContent = 'Please enter a valid email, phone, or username';
            // errorPassword.textContent = 'Please enter a valid password';
            isValid = true;
            }

          if (isValid) {
            // If isValid is true, submit the form and proceed to dashboard
            return true;
            } else {
            // Prevent form submission if any validation fails
            event.preventDefault();
            return false;
            }
        });

      </script>


    </div>
  </body>
</html>
