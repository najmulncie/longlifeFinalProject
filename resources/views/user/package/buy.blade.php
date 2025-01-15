@extends('user.user_dashboard')

@section('title', 'Buy Package')

@section('body')

<style>
body {
  background-color: #f8f9fa;
}

.card {
  border-radius: 10px;
  max-width: 500px;
  margin: auto;
}

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
@if ($errors->has('error'))
    <div class="alert alert-danger">
        {{ $errors->first('error') }}
    </div>
@endif

<div class="container my-5">


<div class="card">
    <!-- Buttons Row -->
    <div class="card-header d-flex justify-content-between">
        <!-- Back Button (Left) -->
        <a href="{{ route('user.package.index') }}" class="btn btn-secondary">
            Back
        </a>
        
        <!-- History Button (Right) -->
        <a href="{{ route('user.package.purchases-history') }}" class="btn btn-primary">
            History
        </a>
    </div>

</div>



  <div class="card shadow p-4">
    <h3 class="text-center mb-4">ড্রাইভ অফার অর্ডার ফরম</h3>
    
    <!-- Offer Card -->
    <div class="offer-card p-3 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="mb-1">{{ $package->title }} 🎁</h5>
          <p class="mb-1">ক্যাশব্যাক: {{ $package->cashback }} TK</p>
          <small class="text-success">
            ✅ {{ $package->description }} <br>
            ✅ ৯৯% নিশ্চিত পাবে।
          </small>
        </div>
        <div class="text-end">
          <span class="badge bg-danger text-white p-2">{{ $package->price }} TK</span>
          <p class="mb-0">Prepaid</p>
        </div>
      </div>
    </div>

    <!-- Input Fields -->
    <form action="{{ route('process.package.purchase') }}" method="POST">
      @csrf
      <input type="hidden" name="package_id" value="{{ $package->id }}">

      <div class="mb-3">
        <label for="mobileNumber" class="form-label">মোবাইল নাম্বার</label>
        <input type="text" name="mobile" class="form-control" id="mobileNumber" placeholder="মোবাইল নাম্বার" >
        <span class="text-danger">{{ $errors->has('mobile') ? $errors->first('mobile'): '' }}</span>
      </div>

      <div class="mb-3">
        <label for="price" class="form-label">মূল্য</label>
        <!-- Display the price in a read-only input field -->
        <input type="text" class="form-control" id="price" value="{{ $package->price }}" readonly>
        
        <!-- Use a hidden field to send the price in the form submission -->
        <input type="hidden" name="price" value="{{ $package->price }}">
      </div>


      <div class="mb-3">
        <label for="operator" class="form-label">অপারেটর</label>
        <select name="operator" id="operator" class="form-select" required>
            @foreach($operators as $operator)
              <option value="{{ $operator }}">{{ ucfirst($operator) }}</option>
            @endforeach
        </select>
        <span class="text-danger">{{ $errors->has('operator') ? $errors->first('operator'): '' }}</span>
        
      </div>

      <div class="mb-3">
            <label for="connection_type" class="form-label">সংযোগের ধরন</label>
            <select class="form-select" name="connection_type" id="connection_type" required>
                <option value="prepaid" selected>prepaid</option>
                <option value="postpaid">postpaid</option>
            </select>
            <span class="text-danger">{{ $errors->has('connection_type') ? $errors->first('connection_type'): '' }}</span>
      </div>


      <div class="mb-3">
        <label for="region">গ্রাহকের বিভাগ</label>
        <select name="region" id="region" class="form-select" required>
          <option value="" selected>গ্রাহকের বিভাগ নির্বাচন করুন...</option>
          @foreach($regions as $region)
              <option value="{{ $region }}">{{ ucfirst($region) }}</option>
            @endforeach
        </select>
        <span class="text-danger">{{ $errors->has('region') ? $errors->first('region'): '' }}</span>

      </div>

      <!-- Checkbox -->
      <div class="form-check mb-4">
        <input class="form-check-input" name="terms" type="checkbox" id="terms" required>
        <label class="form-check-label" for="terms">
          আমি রিটার্ন এন্ড রিফান্ড পলিসির সাথে একমত।
        </label>
      </div>

      <!-- Buttons -->
      <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary w-100 me-2">রিকুয়েষ্ট দিন</button>
        <!-- <a href="{{ url()->previous() }}" class="btn btn-danger w-100 ms-2">বন্ধ করুন</a> -->
      </div>
    </form>
  </div>
</div>

@endsection
