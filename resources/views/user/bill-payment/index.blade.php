@extends('user.user_dashboard')

@section('title', 'Bill Payment')

@section('body')

<style>
.offer-card {
  background-color: #fce4ec;
  border: 1px solid #f8bbd0;
  border-radius: 8px;
}

.offer-card h5 {
  color: #d81b60;
}

.offer-card small {
  font-size: 0.85rem;
}
</style>

<div class="container">
<a href="{{ route('user.bill.payment-history') }}" class="btn btn-primary mb-2">History</a>

    <!-- Offer Card -->
    <div class="offer-card p-3 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="mb-1">ঘরে বসে বিল পেমেন্ট করুন লং লাইফ এর মাধ্যমে🎁</h5>
          <!-- <p class="mb-1">ক্যাশব্যাক:  TK</p> -->
          <small class="text-success">
            ✅ বিল পেমেন্ট করুন ফ্রিতে কোন চার্জ ছাড়া <br>
            ✅ ৯৯% নিশ্চিত পাবে।
          </small>
        </div>
        <!-- <div class="text-end">
          <span class="badge bg-danger text-white p-2"> TK</span>
          <p class="mb-0">Prepaid</p>
        </div> -->
      </div>
    </div>


    <div class="card">
        <div class="card-header">
            <h1>ঘরে বসে বিল পেমেন্ট</h1>
        </div>

        <div class="card-body">
            <!-- Display Success Message -->
            @if(session('success'))
                <p style="color: green;">{{ session('success') }}</p>
            @endif

            
            @if($errors->has('insufficient_balance'))
                <p style="color: red;">{{ $errors->first('insufficient_balance') }}</p>
            @endif

            <form action="{{ route('bill.payment.process') }}" method="POST">
                @csrf
                <!-- <label for="bill_no">বিল নং</label>
                <input type="text" name="bill_no" id="bill_no" required> -->


                <div class="mb-1">
                    <label for="bill_no" class="form-label">বিল নং</label>
                    <input type="text" name="bill_no" class="form-control" id="bill_no" placeholder="Type your bill no" >
                    <span class="text-danger">{{ $errors->has('bill_no') ? $errors->first('bill_no'): '' }}</span>
                </div>


                <div class="mb-1">
                    <label for="mobile_number" class="form-label">মোবাইল নাম্বার</label>
                    <input type="text" name="mobile_number" class="form-control" id="mobile_number" placeholder="Type your mobile number" >
                    <span class="text-danger">{{ $errors->has('mobile_number') ? $errors->first('mobile_number'): '' }}</span>
                </div>

                <div class="mb-1">
                    <label for="operator" class="form-label">অপারেটর</label>
                    <select name="operator" id="operator" class="form-select" required>
                        @foreach($operators as $operator)
                            <option value="{{ $operator }}">{{ $operator }}</option>
                        @endforeach
                        <span class="text-danger">{{ $errors->has('operator') ? $errors->first('operator'): '' }}</span>

                    </select>
                </div>
                
                <div class="mb-1">
                    <label for="total_bill" class="form-label">সর্বমোট বিল</label>
                    <input type="number" name="total_bill" class="form-control" id="total_bill" placeholder="Enter your total_bill" >
                    <span class="text-danger">{{ $errors->has('total_bill') ? $errors->first('total_bill'): '' }}</span>
                </div>

                <div class="mb-1">
                    <label for="address" class="form-label">ঠিকানা</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Type your address" >
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address'): '' }}</span>
                </div>

                <!-- Checkbox -->
                <div class="form-check mb-1">
                    <input class="form-check-input" name="terms" type="checkbox" id="terms" required>
                    <label class="form-check-label" for="terms">
                    আমি রিটার্ন এন্ড রিফান্ড পলিসির সাথে একমত।
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">পেমেন্ট করুন</button>
            </form>
        </div>
    </div>
</div>

@endsection