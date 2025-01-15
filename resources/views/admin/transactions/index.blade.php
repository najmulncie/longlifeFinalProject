@extends('admin.admin_dashboard')

@section('title', 'All Transaction')

@section('body')


    <div class="container-fluid">
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>All Transaction List</h4><span></span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="row_create" style="width:100%">
                                <thead>
                                <tr class="text-center">
                                    <th>SL NO</th>
                                    <th>Transaction Id</th>
                                    <th>Payment Method</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $transaction)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->transaction_id }}</td>
                                            <td>{{ $transaction->payment_method}}</td>
                                            <td>{{ number_format($transaction->amount, 2) }}</td>
                                            <td>{{ ucfirst($transaction->status) }}</td>
                        <td>
                            @if($transaction->status === 'pending')
                                <form action="{{ route('admin.transactions.approve', $transaction->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.transactions.cancel', $transaction->id) }}" method="POST" class="d-inline" onsubmit="return confirmCancel()">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                </form>
                            @else
                                <span class="text-muted">Processed</span>
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
        <!-- Container-fluid Ends-->
    </div>


<!-- JavaScript Confirmation -->
<script>
    function confirmCancel() {
        return confirm("Are you sure you want to cancel this transaction? Click OK to confirm or Cancel to abort.");
    }
</script>


@endsection
