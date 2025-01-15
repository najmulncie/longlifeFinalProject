@extends('user.user_dashboard')

@section('title', 'Buy Premium')

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




<div class="container my-5">


@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <!-- Buttons Row -->
    <div class="card-header d-flex justify-content-between">
        <!-- Back Button (Left) -->
        <a href="{{ route('user.premium.show') }}" class="btn btn-secondary">
            Back
        </a>
        
        <!-- History Button (Right) -->
        <a href="{{ route('user.history.premium') }}" class="btn btn-primary">
            History
        </a>
    </div>

</div>



  <div class="card shadow p-4">
    <h3 class="text-center mb-4">অর্ডার ফরম</h3>
    
    <!-- Offer Card -->
    <div class="offer-card p-3 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <small class="text-success">
            {{ $premium->description }}
          </small>
        </div>
        
      </div>
    </div>

    <!-- Input Fields -->
    <form action="{{ route('user.request.premium') }}" method="POST">
        @csrf

        <!-- Premium ID -->
        <!-- <input type="hidden" name="premium_id" value="{{ $premium->id }}"> -->

        <!-- User ID -->
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <!-- Referred By -->
        <input type="hidden" name="referred_by" value="{{ auth()->user()->referred_by }}">

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" value="{{ auth()->user()->name }}" readonly>
            <input type="hidden" name="name" value="{{ auth()->user()->name }}">
        </div>

        <!-- Premium Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Premium Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $premium->title }}" readonly>
            <input type="hidden" name="title" value="{{ $premium->title }}">
        </div>

        <!-- Selling Price -->
        <div class="mb-3">
            <label for="selling_price" class="form-label">Price</label>
            <input type="text" class="form-control" id="selling_price" value="{{ $premium->selling_price }}" readonly>
            <input type="hidden" name="selling_price" value="{{ $premium->selling_price }}">
        </div>

        <!-- Gmail -->
        <div class="mb-3">
            <label for="gmail" class="form-label">Gmail</label>
            <input type="email" name="gmail" class="form-control" id="gmail" placeholder="Type your valid Gmail">
            <span class="text-danger">{{ $errors->has('gmail') ? $errors->first('gmail') : '' }}</span>
        </div>

        <!-- Terms Checkbox -->
        <div class="form-check mb-4">
            <input class="form-check-input" name="terms_accepted" type="checkbox" id="terms_accepted" value="1" required>
            <label class="form-check-label" for="terms_accepted">
                আমি রিটার্ন এন্ড রিফান্ড পলিসির সাথে একমত।
            </label>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary w-100 me-2">রিকুয়েষ্ট দিন</button>
        </div>
    </form>

  </div>
</div>

@endsection
