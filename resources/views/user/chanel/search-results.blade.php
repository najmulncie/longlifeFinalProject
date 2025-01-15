@extends('user.user_dashboard')

@section('title', 'chennel')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">আমার রেফারকৃত গ্রাহক চ্যানেল</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th>Account Info</th>
                                    <th>Level</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($levels as $level => $users) <!-- Assuming $levels is passed from the controller -->
                                @foreach($users as $user)
                                    <tr>
                                        <td class="text-left">
                                            <div>
                                                <span>Name: <strong>{{ $user->name }}</strong></span><br>
                                                <span>Phone: <strong>{{ $user->phone }}</strong></span><br>
                                                <span>Code: <strong>{{ $user->referral_code }}</strong></span><br>
                                            </div>
                                        </td>
                                        <td class="text-left">
                                            <div>
                                                <span>Level: <strong>{{ $level }}</strong></span><br>
                                                <span>Status: <strong>{{ $user->is_active ? 'Active' : 'Inactive' }}</strong></span><br>
                                                @if($user->is_active && $user->activated_at)
                                                    <span>Activated on: <strong>{{ $user->activated_at }}</strong></span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>


@endsection
