<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>

        @php
            $logo = \App\Models\Logo::where('status', 1)->first(); // সক্রিয় লোগো খুঁজে আনা
        @endphp

      <div class="logo-wrapper">
          <a href="{{ route('admin.admin_dashboard') }}">
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
      <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{ asset('/') }}admin/assets/images/logo/logo-icon.png" alt=""></a></div>
      <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
          <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn"><a href="index.html"><img class="img-fluid" src="{{ asset('/') }}admin/assets/images/logo/logo-icon.png" alt=""></a>
              <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="pin-title sidebar-main-title">
              <div>
                <h6>Pinned</h6>
              </div>
            </li>
            <li class="sidebar-main-title">
              <div>
                <h6 class="lan-1">General</h6>
              </div>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-home"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-home"></use>
                </svg><span class="lan-3">Dashboard</span></a>
              <ul class="sidebar-submenu">
                <li><a class="lan-4" href="{{ route('admin.admin_dashboard') }}">Default</a></li>
                <li><a class="" target="_blank" href="{{ route('home') }}">Visit Website</a></li>
              </ul>
            </li>
            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Logo</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('logo.add-logo') }}">Add logo</a></li>
                    <li><a href="{{ route('logo.manage-logo') }}">Manage logo</a></li>
                </ul>
            </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                      </svg><span class="">Banner</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('banner.add-banner') }}">Add Banner</a></li>
                      <li><a href="{{ route('banner.manage-banner') }}">Manage Banner</a></li>
                  </ul>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Project</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('sections.create') }}">Create Project</a></li>
                    <li><a href="{{ route('sections.index') }}">Show All project</a></li>
                </ul>
            </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Payment Request</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.payment-requests') }}">All Request</a></li>
                    <li><a href="{{ route('admin.approved-payment-requests') }}">Approved Request</a></li>
                </ul>
            </li>


            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Package Purchase Re</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.viewRequests') }}">All Pending Request</a></li>
                    <!-- <li><a href="{{ route('admin.approved-payment-requests') }}">Approved Request</a></li> -->
                </ul>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Transaction</span></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('admin.transactions.index') }}">All Transaction</a></li>
                    <!-- <li><a href="{{ route('admin.approved-payment-requests') }}">Approved Request</a></li> -->
                </ul>
            </li>


            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-widget"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-widget"></use>
                </svg><span class="">Drive Offer</span></a>
                <ul class="sidebar-submenu">
                
                    <li><a href="{{ route('admin.packages.create') }}">Create Package</a></li>
                    <li><a href="{{ route('admin.packages.index') }}">All Package</a></li>
                </ul>
            </li>

            <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                </svg><span class="">Task bKash/Nagod</span></a>
              <ul class="sidebar-submenu">
                <li><a href="{{ route('amdin.payment_tasks.gateway') }}">Add bKash/Nagod Task</a></li>
                <li><a href="{{ route('amdin.bkash_tasks.manage') }}">Manage bKash</a></li>
                <li><a href="{{ route('amdin.nagod_tasks.manage') }}">Manage Nagod</a></li>
              </ul>
            </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                <svg class="stroke-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                </svg>
                <svg class="fill-icon">
                  <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                </svg><span class="">Task</span></a>
              <ul class="sidebar-submenu">
{{--                <li><a href="{{ route('task.show') }}">Show Task</a></li>--}}
                <li><a href="{{ route('admin.tasks.create') }}">Task Add</a></li>
                <li><a href="{{ route('admin.tasks.index') }}">All Task</a></li>
              </ul>
            </li>

            {{--//for notification--}}
              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span class="">Notification</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('notifications.create') }}">Notification Add</a></li>
                      <li><a href="{{ route('notifications.index') }}">All Notification</a></li>
                  </ul>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span>Withdral Request</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('admin.withdrawals.index') }}"> all request </a></li>
                      <li><a href="{{ route('admin.withdrawals.approveRequest') }}"> Approve request </a></li>
                  </ul>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span>Bill Payment Request</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('admin.payments.index') }}"> all request </a></li>
                      <!-- <li><a href="{{ route('admin.withdrawals.approveRequest') }}"> Approve request </a></li> -->
                  </ul>
              </li>



              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span>Premium</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('admin.premium.index') }}"> Add Premium </a></li>
                      <li><a href="{{ route('admin.premium.all') }}"> All Premium </a></li>
                      <li><a href="{{ route('admin.premium.orders') }}"> Premium Orders </a></li>
                  </ul>
              </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span>Professional Serv.</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('admin.professional.index') }}"> Add Professional S. </a></li>
                      <li><a href="{{ route('admin.professional.all') }}"> All Professional </a></li>
                      <li><a href="{{ route('admin.requests.index') }}">  Requset </a></li>
                  </ul>
              </li>


              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-layout"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-layout"></use>
                      </svg><span>Course</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('course.category.create') }}"> Add Category. </a></li>
                      <li><a href="{{ route('course.sections.create') }}"> Add Course. </a></li>
                      <li><a href="{{ route('course.sections.index') }}"> All Course </a></li>
                  </ul>
              </li>


            <li class="sidebar-main-title">
              <div>
                <h6 class="">Users</h6>
              </div>
            </li>

              <li class="sidebar-list"><i class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title" href="javascript:void(0)">
                      <svg class="stroke-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#stroke-user"></use>
                      </svg>
                      <svg class="fill-icon">
                          <use href="{{ asset('/') }}admin/assets/svg/icon-sprite.svg#fill-user"></use>
                      </svg><span>Users</span></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('manage.user') }}">Manage User</a></li>
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
                      <li><a href="{{ route('contacts.create') }}">Create contact</a></li>
                      <li><a href="{{ route('contacts.index') }}">All contact</a></li>
                  </ul>
              </li>

          </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
    </div>
  </div>
