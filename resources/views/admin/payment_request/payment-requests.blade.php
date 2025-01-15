@extends('admin.admin_dashboard')

@section('title', 'admin Dashboard')


@section('body')


    <table class="table">
        <thead>
        <tr>
            <th>User</th>
            <th>Transaction ID</th>
            <th>Mobile Number</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($paymentRequests as $request)
            <tr>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->transaction_id }}</td>
                <td>{{ $request->mobile_number }}</td>
                <td>{{ $request->status }}</td>
                <td>
                    <form action="{{ route('admin.approve-payment', $request->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success mb-1">Approved</button>
                    </form>
                    <!-- Reject/Delete Button -->
                    <form action="{{ route('admin.reject-payment', $request->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>


   <!-- JavaScript এর মাধ্যমে কনফার্মেশন পপ-আপ -->
    <script type="text/javascript">
        function confirmDelete() {
            return confirm('Are you sure you want to delete this payment request?');
        }
    </script>


@endsection
