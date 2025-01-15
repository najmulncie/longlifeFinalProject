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
            <li>                         <span class="header-search">
                <svg>
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#search"></use>
                </svg></span></li>
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

              <style>
                  .unseen-notification {
                      background-color: #f0f0f0; /* হালকা ধূসর রঙ */
                  }

                  .seen-notification {
                      background-color: #ffffff; /* সাধারণ সাদা রঙ */
                  }
              </style>

              <li class="onhover-dropdown">
                  <div class="notification-box">
                      <svg>
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#notification"></use>
                      </svg><span class="badge rounded-pill badge-primary">{{ $unseenCount }} </span>
                  </div>
                  <div class="onhover-show-div notification-dropdown">
                      <h5 class="f-18 f-w-600 mb-0 dropdown-title">Notitications                               </h5>
                      <ul class="notification-box">

                          @if(isset($headerNotifications) && !$headerNotifications->isEmpty())
                              @foreach($headerNotifications as $notification)
                              <li class="d-flex {{  $notification->pivot->seen ? 'seen-notification' : 'bg-primary' }}">
                                  <div class="flex-shrink-0 bg-light-primary">
                                      @if($notification->image)
                                          <img src="{{ asset($notification->image) }}" alt="Notification Image" class="rounded-circle me-2" width="50">
                                      @endif
                                  </div>
                                  <div class="flex-grow-1"> <a href="{{route('notifications.show', $notification->id)}}">
                                          <h6>{{ $notification->title }}</h6></a>
                                      <p>{{ $notification->created_at }}</p>
                                  </div>
                              </li>
                              @endforeach
                          @else
                              <p>No new notifications</p>
                          @endif
                          <li><a class="f-w-700" href="">Check all     </a></li>
                      </ul>
                  </div>
              </li>

            <li>
              <div class="mode">
                <svg>
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#moon"></use>
                </svg>
              </div>
            </li>

              @php
                $id = Auth::user()->id;
                $profile_data = App\Models\User::find($id);
              @endphp

            <li class="profile-nav onhover-dropdown px-0 py-0">
              <div class="d-flex profile-media align-items-center"><img class="img-30" src="{{ (!empty($profile_data->photo)) ? url('upload/user_images/'.$profile_data->photo) : url('upload/profile.png')  }}" alt="">
                <div class="flex-grow-1"><span>{{ Auth::user()->name }}</span>
                  <p class="mb-0 font-outfit">{{ Auth::user()->username }}<i class="fa fa-angle-down"></i></p>
                </div>
              </div>
              <ul class="profile-dropdown onhover-show-div">
                <li><a href="{{ route('user.profile') }}"><i data-feather="user"></i><span>Profile </span></a></li>
                <li><a href="{{ route('user.changePassword') }}"><i data-feather="mail"></i><span>Change Password</span></a></li>
                <li><a href="{{ route('user.withdrawPage') }}"><i data-feather="file-text"></i><span>Withdraw</span></a></li>
                <li><a href="edit-profile.html"><i data-feather="settings"></i><span>Settings</span></a></li>
                <li><a href="{{ route('user.logout') }}"><i data-feather="log-in"> </i><span>Log out</span></a></li>
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
    <!-- Page Header Ends                              -->
  </div>
