@extends('admin.admin_dashboard')

@section('title', 'Admin Dashboard')

@section('body')


<div class="container-fluid default-dashboard">
  <div class="row widget-grid">

      <div class="col-xxl-5 col-xl-5 box-col-6  proorder-xl-7 proorder-md-8">
          <div class="card">
              <div class="card-header card-no-border pb-0">
                  <div class="header-top">
                      <h4>Long Life Calender</h4>
                  </div>
              </div>
              <div class="card-body appointments relative">
                  <div class="row">
                      <div class="col-12">
                          <div class="datepicker-here mod" id="datepicker"></div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="col-xl-7 proorder-xl-5 box-col-7 proorder-md-5">
      <div class="card">
        <div class="card-header card-no-border pb-0">
          <div class="header-top">
              @php
                  $activeMembersCount = $activeMembers->count();
              @endphp
              <h4>Active Member: <span class="text-primary">{{ $activeMembersCount }}</span></h4>
          </div>
        </div>
        <div class="card-body pt-0 projects px-0">
          <div class="table-responsive theme-scrollbar">
            <table class="table display" id="selling-product" style="width:100%">
              <thead>
              <tr>
                  <th>Member Profile</th>
                  <th>Number</th>
                  <th class="text-center">Status</th>
              </tr>
              </thead>
              <tbody>
              @foreach($activeMembers as $member)
                  <tr>
                      <td>
                          <div class="d-flex align-items-center">
                              <div class="flex-grow-1">
                                  <a href="">
                                      <h5>{{ $member->name }}</h5>
                                  </a>
                                  <span>{{ $member->username }}</span>
                              </div>
                          </div>
                      </td>
                      <td>{{ $member->phone }}</td>
                      <td class="text-center">
                          @if($member->is_active)
                              <p class="btn background-light-primary text-center b-light-primary font-success"> &#10004; Active </p>
                          @else
                              <p class="btn background-light-danger text-center b-light-danger font-danger"> &#10006; Inactive </p>
                          @endif
                      </td>
                  </tr>
              @endforeach


              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>


  </div>
</div>


@endsection
