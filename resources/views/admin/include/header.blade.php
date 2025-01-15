<div class="page-header row">
    <div class="header-logo-wrapper col-auto">
      <div class="logo-wrapper"><a href="index.html"><img class="img-fluid for-light" src="{{ asset('/') }}admin/assets/images/logo/logo.png" alt=""/><img class="img-fluid for-dark" src="{{ asset('/') }}admin/assets/images/logo/logo_light.png" alt=""/></a></div>
    </div>
    <div class="col-4 col-xl-4 page-title">
      <h4 class="f-w-700">Default dashboard</h4>
      <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
          <li class="breadcrumb-item"><a href="index.html"> <i data-feather="home"> </i></a></li>
          <li class="breadcrumb-item f-w-400">Dashboard</li>
          <li class="breadcrumb-item f-w-400 active">Default</li>
        </ol>
      </nav>
    </div>
    <!-- Page Header Start-->
    <div class="header-wrapper col m-0">
      <div class="row">
        <form class="form-inline search-full col" action="#" method="get">
          <div class="form-group w-100">
            <div class="Typeahead Typeahead--twitterUsers">
              <div class="u-posRelative">
                <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Mofi .." name="q" title="" autofocus>
                <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading...</span></div><i class="close-search" data-feather="x"></i>
              </div>
              <div class="Typeahead-menu"></div>
            </div>
          </div>
        </form>
        <div class="header-logo-wrapper col-auto p-0">


          <div class="logo-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('/') }}admin/assets/images/logo/logo.png" alt=""></a></div>
          <div class="toggle-sidebar">
            <svg class="stroke-icon sidebar-toggle status_toggle middle">
              <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#toggle-icon"></use>
            </svg>
          </div>
        </div>
        <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
          <ul class="nav-menus">
              <!-- mode -->
            <li>
              <div class="form-group w-100">
                <div class="Typeahead Typeahead--twitterUsers">
                  <div class="u-posRelative d-flex align-items-center">
                    <svg class="search-bg svg-color">
                      <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#search"></use>
                    </svg>
                    <input class="demo-input py-0 Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Mofi .." name="q" title="">
                  </div>
                </div>
              </div>
            </li>
            <li>
              <div class="mode">
                <svg>
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#moon"></use>
                </svg>
              </div>
            </li>

              <!-- cart -->
            <li class="cart-nav onhover-dropdown">
              <div class="cart-box">
                <svg>
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-ecommerce"></use>
                </svg>
              </div>
              <div class="cart-dropdown onhover-show-div">
                <h5 class="f-18 f-w-600 mb-0 dropdown-title">Cart</h5>
                <ul>
                  <li>
                    <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('/') }}admin/assets/images/other-images/cart-img.jpg" alt="">
                      <div class="flex-grow-1"><span class="f-w-600">Furniture Chair for Home</span>
                        <div class="qty-box">
                          <div class="input-group"><span class="input-group-prepend">
                              <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                            <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                              <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                          </div>
                        </div>
                        <h6 class="font-primary">$500</h6>
                      </div>
                      <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                    </div>
                  </li>
                  <li>
                    <div class="d-flex"><img class="img-fluid b-r-5 me-3 img-60" src="{{ asset('/') }}admin/assets/images/other-images/table-img.jpg" alt="">
                      <div class="flex-grow-1"><span class="f-w-600">Furniture Table for Office</span>
                        <div class="qty-box">
                          <div class="input-group"><span class="input-group-prepend">
                              <button class="btn quantity-left-minus" type="button" data-type="minus" data-field="">-</button></span>
                            <input class="form-control input-number" type="text" name="quantity" value="1"><span class="input-group-prepend">
                              <button class="btn quantity-right-plus" type="button" data-type="plus" data-field="">+</button></span>
                          </div>
                        </div>
                        <h6 class="font-primary">$500.00</h6>
                      </div>
                      <div class="close-circle"><a class="bg-danger" href="#"><i data-feather="x"></i></a></div>
                    </div>
                  </li>
                  <li class="total">
                    <h6 class="mb-0">Order Total : <span class="f-w-600 f-right">$1000.00</span></h6>
                  </li>
                  <li class="text-center"><a class="d-block mb-3 view-cart f-w-700" href="cart.html">Go to your cart</a><a class="btn btn-primary view-checkout" href="checkout.html">Checkout</a></li>
                </ul>
              </div>
            </li>

              @php
                $id = Auth::user()->id;
                $profile_data = App\Models\User::find($id);
              @endphp

            <li class="profile-nav onhover-dropdown px-0 py-0">
              <div class="d-flex profile-media align-items-center">

                  <img class="img-30" src="{{ (!empty($profile_data->photo)) ? url('upload/admin_images/'.$profile_data->photo) : url('upload/profile.png')  }}" alt="">

                <div class="flex-grow-1"><span>{{ Auth::user()->name }}</span>
                  <p class="mb-0 font-outfit">{{ Auth::user()->username }}<i class="fa fa-angle-down"></i></p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="{{ route('admin.profile') }}"><i data-feather="user"></i><span>Account </span></a></li>
                <li><a href="{{ route('admin.changePassword') }}"><i data-feather="mail"></i><span>Chnage Password</span></a></li>
                <li><a href="task.html"><i data-feather="file-text"></i><span>Taskboard</span></a></li>
                <li><a href="{{ route('admin.logout') }}"><i data-feather="log-in"> </i><span>Log out</span></a></li>
              </ul>
            </li>
          </ul>
        </div>
        <script class="result-template" type="text/x-handlebars-template">
          <div class="ProfileCard u-cf">
          <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
          <div class="ProfileCard-details">
          <div class="ProfileCard-realName">

            </div>
          </div>
          </div>
        </script>
        <script class="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
      </div>
    </div>
    <!-- Page Header Ends -->
  </div>
