@extends('admin.admin_dashboard')

@section('title', 'Admin withdrawal')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Approval Withdrawals</h3><span></span>
                        <h4>User Total payment: <span class="badge badge-info">{{$approvedWithdrawals->sum('amount') }} Taka</span></h4>
                        @if (session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="row_create" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>User</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Withdrwal Method</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($approvedWithdrawals as $approvedWithdrawal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $approvedWithdrawal->user->name }}</td>
                                        <td>{{ $approvedWithdrawal->mobile_number }}</td>
                                        <td class="text-end">{{ $approvedWithdrawal->amount }}</td>
                                        <td>{{ $approvedWithdrawal->payment_method }}</td>
                                        <td class="text-center ">
                                            <button class="btn btn-sm btn-primary">
                                                {{ ucfirst($approvedWithdrawal->status) }}
                                            </button>
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
