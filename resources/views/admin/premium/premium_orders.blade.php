@extends('admin.admin_dashboard')

@section('title', 'Premium Orders')


@section('body')
<h3>Premium Order History</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User Name</th>
            <th>Email</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($premiumOrders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->gmail }}</td>
                <td>{{ $order->selling_price }}</td>
                <td>
                    @if($order->is_approved === 0 )
                    <span class="badge bg-warning">Pending</span>
                    @elseif($order->is_approved === 1)
                        <span class="badge bg-success">Success</span>
                    @endif
                </td>
                <td>
            
                    @if($order->is_approved === 0)
                        <form action="{{ route('admin.premium.approve', $order->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success mb-1">Approve</button>
                        </form>

                       <!-- // Reject Button
                        <form action="{{ route('admin.premium.reject', $order->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmReject()">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form> -->
                    @elseif($order->is_approved === 1)
                        <span class="badge bg-warning">Proceed</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


   <!-- JavaScript এর মাধ্যমে কনফার্মেশন পপ-আপ -->
   <script type="text/javascript">
        function confirmReject() {
            return confirm('Are you sure you want to reject this Premium Orders?');
        }
    </script>



@endsection
