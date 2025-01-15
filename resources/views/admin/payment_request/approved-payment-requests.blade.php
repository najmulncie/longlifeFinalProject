@extends('admin.admin_dashboard')

@section('title', 'Manage Approval Request')

@section('body')


    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>All Approved User List</h4><span></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="row_create" style="width:100%">
                                <thead>
                                <tr class="text-center">
                                    <th>SL NO</th>
                                    <th>Name</th>
                                    <th>Transaction Id</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($approvedPayments as $payment)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $payment->user ? $payment->user->name : 'N/A' }}</td>
                                            <td>{{ $payment->transaction_id }}</td>
                                            <td>{{ $payment->mobile_number}}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm btn-info">{{ $payment->status }}</button>
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
