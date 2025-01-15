@extends('admin.admin_dashboard')

@section('title', 'Admin withdrawal')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>Pending Withdrawals</h3><span></span>

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
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($withdrawals as $withdrawal)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $withdrawal->user->name }}</td>
                                            <td>{{ $withdrawal->mobile_number }}</td>
                                            <td>{{ $withdrawal->amount }}</td>
                                            <td>{{ $withdrawal->payment_method }}</td>
                                            <td>{{ ucfirst($withdrawal->status) }}</td>
                                            <td>
                                                <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm mb-1" type="submit">Approve</button>
                                                </form>
                                                <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-danger btn-sm" type="submit">Reject</button>
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
