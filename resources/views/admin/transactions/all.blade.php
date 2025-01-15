@extends('admin.admin_dashboard')

@section('title', 'All Transaction')

@section('body')


<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4>All Transaction</h4><span></span>

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
                    <th>Transaction Id</th>
                    <th>Balance</th>
                     <th>Status</th>
                    <th>Action</th>

                  </tr>
                </thead>
                <tbody>
                    
@foreach($transactions as $transaction)
    <div class="transaction">
        <p>User: {{ $transaction->user->name }}</p>
     <p>Amount: ৳ {{ $transaction->amount }}</p>
        <p>Transaction ID: {{ $transaction->transaction_id }}</p>
        <p>Status: {{ $transaction->status }}</p>
        @if($transaction->status == 'pending')
            <form action="{{ route('admin.transactions.verify', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Verify</button>
            </form>
        @endif
    </div>
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
