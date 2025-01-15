
@extends('user.user_dashboard')

@section('title', 'My Referrals')

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-2 ">
                    <h4 style="float:left">My Referrals
                        <span class="badge rounded-pill badge-success">
                            {{ $referrals->count() }}
                        </span>
                    </h4>
                    <h4 style="float: right">Commission
                        <span class="badge rounded-pill badge-success">

                            {{ ($referrals->count() * 10) - $user->withdrawals()->where('status', 'approved')->sum('amount') }}BDT
                        </span>
                    </h4>
                    <h4 style="float: right; margin-right: 15px;">Deducted Commission
                        <span class="badge rounded-pill badge-danger">
                         BDT
                        </span>
                    </h4>

                </div>
                <div class="card-body">
                    @if($referrals->isEmpty())
                        <p class="text-center">You have not referred anyone yet.</p>
                    @else
                    <div class="table-responsive theme-scrollbar">
                        <table class="display" id="row_create" style="width:100%">
                            <thead>
                            <tr>
                                <th>SL NO</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($referrals as $referral)

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $referral->name }}</td>
                                    <td>{{ $referral->email }}</td>
                                    <td>
                                        @if($referral->status === 'active')
                                            <span class="badge rounded-pill badge-success">
                                            <i class="fa fa-check-square"></i> Active </span>
                                        @else
                                            <span class="badge rounded-pill badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>


@endsection
