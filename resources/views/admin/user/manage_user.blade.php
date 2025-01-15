@extends('admin.admin_dashboard')

@section('title', 'Manage User')

@section('body')


<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4>All User</h4><span></span>

              @if(session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif

              @if(session('error'))
                  <div class="alert alert-danger">
                      {{ session('error') }}
                  </div>
              @endif

          </div>
          <div class="card-body">
            <div class="table-responsive theme-scrollbar">
              <table class="display" id="row_create" style="width:100%">
                <thead>
                  <tr>
                    <th>SL NO</th>
                    <th>Name</th>
                      <th>Referred By</th>
                    <th>Email</th>
                      <th>Phone</th>
                      <th>Balance</th>
                      <th>Status</th>
                      <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>
                            @if($user->referredBy)
                                Name: {{ $user->referredBy->name }},   Code: {{ $user->referredBy->referral_code }}
                            @else
                                No referrer available
                            @endif
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->main_balance }}</td>
                        <td>
                            @if($user->is_suspended)
                                <span class="badge bg-danger">Suspended</span>
                            @elseif(!$user->is_active)
                                <span class="badge bg-warning">Inactive</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </td>

                        <td>

                            @if($user->is_suspended)
                            <!-- আনসাসপেন্ড বাটন -->
                                <form action="{{ route('admin.unsuspendUser', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success mb-1">Unsuspend</button>
                                </form>
                            @else
                            <!-- সাসপেন্ড বাটন -->
                                <form action="{{ route('admin.suspendUser', $user->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger mb-1">Suspend</button>
                                </form>
                            @endif

                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm mb-1">Edit</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
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
    <!-- Container-fluid Ends-->
  </div>






  @endsection
