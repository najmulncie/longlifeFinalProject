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
@foreach($all_purchases as $purchase)
    <!-- Offer Card -->
    <div class="offer-card p-2 mb-4">
      <div class="d-flex align-items-center justify-content-between">
        <div>
        <p class="mb-1">{{ $purchase->mobile }}</p>
          <h5 class="mb-1">{{ $purchase->package->title }}🎁</h5>
          <small class="text-success">
            ✅ ক্যাশব্যাক: {{ $purchase->package->cashback }} ৳
          </small>
            @if($purchase->updated_at)
                <p class="text-muted"> {{ $purchase->updated_at->format('d M Y') }}</p>
            @endif
        </div>
        <div class="text-end">
          <span class="badge  text-white p-2">
            <td>
                @if($purchase->status == 'pending')
                <span class="btn badge btn-sm bg-warning">Pending</span>
                @elseif($purchase->status == 'completed')
                <span class="btn badge btn-sm bg-success">Success</span>
                @elseif($purchase->status == 'rejected')
                <span class="btn badge btn-sm bg-danger">Rejected</span>
                @endif
            </td>
          </span>
          <p class="mb-0 me-3">৳ {{ number_format($purchase->price, 0) }}</p>
        </div>
      </div>
    </div>
    @endforeach


</div>

@endsection