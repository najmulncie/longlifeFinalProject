@extends('user.user_dashboard')

@section('title', 'Professional Service')

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


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

<div class="mb-1">
    <!-- Buttons Row -->
    <div class="card-header d-flex justify-content-between">
        <!-- Back Button (Left) -->
        <!-- <a href="" class="btn btn-secondary">
            Back
        </a> -->
        
        <!-- History Button (Right) -->
        <a href="{{ route('user.professional-requests.history') }}" class="btn btn-primary">
            History
        </a>
    </div>

</div>


@foreach($professionals as $professional)
    <!-- Offer Card -->
    <div class="offer-card p-2 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
        <p class="mb-1">{{ $professional->title }}</p>
          <h5 class="mb-1">{{ $professional->description }}🎁</h5>
          <small class="text-success">
            ✅ {{ $professional->react_count }} <br>
            ✅ {{ number_format($professional->price, 0) }} ৳
          </small>
        </div>
        <div class="text-end">
          <span class="badge  text-white p-2">
            <td>
                <form action="{{ route('professional.service-requests.store', $professional->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Request</button>
                </form>
            </td>
          </span>
        </div>
      </div>
    </div>
    @endforeach


</div>

@endsection