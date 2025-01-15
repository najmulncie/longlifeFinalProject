@extends('user.user_dashboard')

@section('title', 'Withdrawal History')

@section('body')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Withdrawal History</h4><span></span>

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
                                    <th>Balance</th>
                                    <th>Phone</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th>Time</th>

                                </tr>
                                </thead>
                                <tbody>

                                @foreach($withdrawals as $withdrawal)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $withdrawal->user ? $withdrawal->user->name : 'N/A' }}</td>
                                        <td>{{ $withdrawal->amount }}</td>
                                        <td>{{ $withdrawal->mobile_number }}</td>
                                        <td>{{ $withdrawal->payment_method }}</td>
                                        <td>{{ $withdrawal->status }}</td>
                                        <td>{{ $withdrawal->created_at }}</td>
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
