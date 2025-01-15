@extends('user.user_dashboard')

@section('title', 'Package Purchase history')

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
    <a href="{{ route('user.professional.viewAll') }}" class="btn btn-primary mb-2">Back</a>

    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


    @foreach($requests as $request)    <!-- Offer Card -->
      <div class="offer-card p-2 mb-4">
        <div class="d-flex align-items-center justify-content-between">
          <div>
          <p class="mb-1"></p>
            <h5 class="mb-1">{{ $request->professionalService->title }}</h5>
            <small class="text-success">
              <!-- ✅ Price: ৳ -->
            </small>
            <p>Status: <strong>{{ ucfirst($request->status) }}</strong></p>
            <p>Requested at: {{ $request->created_at->format('d-m-Y') }}</p>
          </div>
        </div>
      </div>
    @endforeach


</div>

@endsection