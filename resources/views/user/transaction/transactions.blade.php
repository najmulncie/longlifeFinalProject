@extends('user.user_dashboard')

@section('title', 'Wallet')

@section('body')

<div class="container">
<a href="{{ route('income.walletMoney') }}" class="btn btn-sm btn-primary mb-2">Back to wallet</a>
 

    <div class="card">
        <div class="card-header">
        
                    <!-- Wallet Balance -->
 <span class="btn btn-sm btn-primary mb-2" style="color:white">
                        Wallet Balance: {{ number_format($totalApprovedPayments, 2) }} BDT
                    </span>
        
        Payment History


        </div>
        <div class="card-body">

            @foreach($transactions as $transaction)
                <div class="transaction">
                    <p>Amount: ৳ {{ $transaction->amount }}</p>
                    <p>Transaction ID: {{ $transaction->transaction_id }}</p>
                    <p>Payment Method: {{ $transaction->payment_method }}</p>
                    <p>Status: {{ $transaction->status }}</p>
                    <hr>
                </div>
            @endforeach

        </div>
    </div>
</div>


@endsection