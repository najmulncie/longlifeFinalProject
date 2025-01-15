@extends('user.user_dashboard')

@section('titile', 'User active')


<!-- activate-account.blade.php -->
<form class="theme-form" action="{{ route('submit-payment-request') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="transaction_id">Transaction ID</label>
        <input type="text" class="form-control" id="transaction_id" name="transaction_id" required>
    </div>
    <div class="form-group">
        <label for="mobile_number">Mobile Number</label>
        <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ auth()->user()->mobile_number }}" readonly>
    </div>
    <button type="submit" class="btn btn-primary">Submit Payment Request</button>
</form>



@endsection
