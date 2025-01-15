
@extends('user.user_dashboard')

@section('titile', 'My Referrals')

@section('body')


    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card height-equal">
                    <div class="card-header">
                        <h3>Withdrawal From</h3>
                        <h4 class="float-start">Your main balance: <span class="badge rounded-pill badge-primary">{{ auth()->user()->main_balance }} টাকা</span></h4>

                            <a href="{{ route('user.withdrawHistory') }}" class="btn btn-primary btn-sm float-end" type="submit">History</a>

                    </div>
                    <div class="card-body custom-input">
                        <form class="row g-3" action="{{ route('user.withdraw') }}" method="post">
                            @csrf

                            <div class="col-12">
                                <label class="form-label" for="mobile_number">Mobile Number:</label>
                                <input class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" type="text" placeholder="Your mobile number">
                                <span class="text-danger">{{ $errors->has('mobile_number') ? $errors->first('mobile_number'): '' }}</span>
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="payment_method">Payment Method:</label>
                                <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method">
                                    <option value="">Select Payment Method</option>
                                    <option value="bKash">bKash</option>
                                    <option value="Nagad">Nagad</option>
                                    <option value="Bank_Transfer">Bank Transfer</option>
                                </select>
                                <span class="text-danger">{{ $errors->has('payment_method') ? $errors->first('payment_method'): '' }}</span>
                            </div>


                            <div class="col-12">
                                <label class="form-label" for="title">Enter Amount to Withdraw:</label>
                                <input class="form-control @error('amount') is-invalid @enderror" name="amount"  type="number" placeholder="amount" >
                                <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount'): '' }}</span>
                            </div>

                            <div class="col-6">
                                <button class="btn btn-primary" type="submit">Withdraw</button>
                            </div>
                            @if(session('error'))
                                <p style="color: red;">{{ session('error') }}</p>
                            @endif

                            @if(session('success'))
                                <p style="color: green;">{{ session('success') }}</p>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <p>*নোটঃ</p>
            <p>*সর্বনিম্ন উত্তলনের পরিমাণঃ ২০০ টাকা
            <p>উত্তলন সফল হওয়ার সময় ১ থেকে ৩ কার্য দিবস </p>
            <p>*২% চার্জ প্রযোজ্য</p>
        </div>
    </div>



@endsection
