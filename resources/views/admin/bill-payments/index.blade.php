@extends('admin.admin_dashboard')

@section('title', 'Bill Payment Request')

@section('body')


<div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4> Bill Payments</h4><span></span>

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
                        <th>ID</th>
                        <th>Bill No</th>
                        <th>Mobile Number</th>
                        <th>Operator</th>
                        <th>Total Bill</th>
                        <th>Status</th>
                        <th>Cashback</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>{{ $payment->bill_no }}</td>
                <td>{{ $payment->mobile_number }}</td>
                <td>{{ $payment->operator }}</td>
                <td>{{ $payment->total_bill }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>{{ $payment->cashback }}</td>
                <td>
                    @if($payment->status === 'pending')
                        <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST">
                            @csrf
                            <!-- Cashback Input Field -->
                            <div class="form-group">
                                <input 
                                    type="number" 
                                    name="cashback" 
                                    placeholder="Enter Cashback" 
                                    class="form-control" 
                                    step="0.01" 
                                    min="0" 
                                    required
                                >
                            </div>
                             <span class="text-danger">
                                {{ $errors->has('mobile_number') ? $errors->first('mobile_number'): '' }}
                            </span>

                            <button type="submit" class="btn btn-success mt-2">Approve</button>
                        </form>
                        <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST" style="margin-top: 10px;" onsubmit="return confirmReject()">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    @else
                       Success
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



<script>
    
    function confirmReject() {
        // Show a confirmation dialog
        if (confirm("Are you sure you want to reject this payment? This will refund the amount to the user's wallet.")) {
            return true; // Proceed with form submission
        } else {
            return false; // Prevent form submission
        }
    }
</script>


@endsection