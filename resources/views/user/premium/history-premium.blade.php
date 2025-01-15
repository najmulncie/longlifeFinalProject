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
    <a href="{{ route('user.premium.show') }}" class="btn btn-primary mb-2">Buy Premium</a>

    
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


@foreach($premiumOrders as $premiumOrder)
    <!-- Offer Card -->
    <div class="offer-card p-2 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
        <p class="mb-1"></p>
          <h5 class="mb-1">{{ $premiumOrder->name }}</h5>
          <p class="">{{ $premiumOrder->gmail }}</p>
          <small class="text-success">
            ✅ Price: {{ $premiumOrder->selling_price }} ৳
          </small>
            @if($premiumOrder->updated_at)
                <p class="text-muted"> {{ $premiumOrder->updated_at->format('d M Y') }}</p>
            @endif
        </div>
        <div class="text-end">
          <span class="badge  text-white p-2">
            <td>
                @if($premiumOrder->is_approved == false)
                    <span class="btn badge btn-sm bg-warning">Pending</span>
                @elseif($premiumOrder->is_approved == true)
                    <span class="btn badge btn-sm bg-success">Success</span>
                @endif
            </td>
          </span>
        </div>
      </div>
    </div>
    @endforeach


</div>

@endsection