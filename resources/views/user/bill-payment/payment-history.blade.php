<!-- resources/views/user/payment-history.blade.php -->
@extends('user.user_dashboard')


@section('title', 'Bill Payment History')

@section('body')
    
    <div class="container-fluid">
        <a href="{{ route('bill.payment') }}" class="btn btn-primary mb-2">Back</a>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4> Payment History</h4><span></span>

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
                        <th>Bill No</th>
                        <th>Operator</th>
                        <th>Total Bill</th>
                        <th>Cashback</th>
                        <th>Payment Date</th>
                        <th>Cashback Date</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{ $payment->bill_no }}</td>
                            <td>{{ $payment->operator }}</td>
                            <td>{{ $payment->total_bill }}</td>
                            <td>
                                @if($payment->cashback)
                                    {{ $payment->cashback }} 
                                @else
                                    No Cashback
                                @endif
                            </td>
                            <td>{{ $payment->created_at->timezone('Asia/Dhaka')->format('d-m-Y H:i:s') }}</td>
                            <td>
                                @if($payment->cashback)
                                    {{ $payment->updated_at->timezone('Asia/Dhaka')->format('d-m-Y H:i:s') }}
                                @else
                                    No Cashback
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


@endsection


