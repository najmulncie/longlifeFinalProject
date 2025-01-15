<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        @php
            $logo = \App\Models\Logo::where('status', 1)->first(); // সক্রিয় লোগো খুঁজে আনা
        @endphp

        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}">
            @if($logo && $logo->image)  <!-- লোগো পাওয়া গেছে কিনা এবং ইমেজ ফাইল আছে কিনা চেক -->
                <img class="img-fluid" src="{{ asset($logo->image) }}" alt="Logo">
                @else
                    <img class="img-fluid" src="{{ asset('admin/assets/images/logo/logo.png') }}" alt="Default Logo"> <!-- ডিফল্ট লোগো -->
                @endif
            </a>
          <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar">
          <svg class="stroke-icon sidebar-toggle status_toggle middle">
            <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#toggle-icon"></use>
          </svg>
          <svg class="fill-icon sidebar-toggle status_toggle middle">
            <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-toggle-icon"></use>
          </svg>
        </div>
      </div>
      <div class="logo-icon-wrapper">
          <a href="{{ route('dashboard') }}">
              <img class="img-fluid" src="{{ asset($logo->image) }}" alt="">
          </a>
      </div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset($logo->image) }}" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-main-title">
              <div>
                <h6>Pinned</h6>
              </div>
            </li>
            <li class="sidebar-main-title">
              <div>
                <h6 class="">Earn money, Make Profit</h6>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('dashboard') }}">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-home"></use>
                </svg><span class="">Dashboard</span></a>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                </svg><span class="">My Task</span></a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('user.tasks.index') }}">All Task</a></li>
              </ul>

            </li>


            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('user.premium.show') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Premium</span></a>
              </li>


              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-user"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-user"></use>
                </svg><span class="">My Refferals</span></a>
              <ul class="sidebar-submenu">
{{--                <li><a href="{{ route('my.referrals') }}">All</a></li>--}}
                <li><a href="{{ route('user.referral_tree', ['id' => Auth::user()->id]) }}">View Referral Tree</a></li>
              </ul>
            </li>

              <li class="sidebar-list"><i data-feather="globe"></i><a class="sidebar-link sidebar-title"
                  href="{{ route('chanel.index', ['id' => Auth::user()->id]) }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                      </svg><span class="">Chanel</span></a>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('income.index') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Income</span></a>
{{--                  <ul class="sidebar-submenu">--}}
{{--                      <li><a href="{{ route('income.today') }}">Income</a></li>--}}
{{--                  </ul>--}}
              </li>


              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('referral.bonus') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Global Bonus</span></a>
              </li>


              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('user.package.index') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Drive package</span></a>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('bill.payment') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Bill Payment</span></a>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('user.professional.viewAll') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Professional S.</span></a>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="{{ route('course.section.index') }}">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Course</span></a>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Jobs</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('user.jobs.create') }}">Create Job</a></li>
                  </ul>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="#">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-support-tickets"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-support-tickets"></use>
                      </svg><span>Support Number</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('user.contacts.index') }}">Support Number</a></li>
                  </ul>
              </li>


          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
