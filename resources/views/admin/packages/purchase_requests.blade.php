@extends('admin.admin_dashboard')

@section('title', 'Purchase Requests')

@section('body')
<div class="container my-5">
    <h2>Pending Purchase Requests</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Package</th>
                <th>Price</th>
                <th>Mobile</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->package->title }}</td>
                <td>{{ $request->price }} TK</td>
                <td>{{ $request->mobile }}</td>
                <td><span class="badge bg-warning">{{ ucfirst($request->status) }}</span></td>
                <td>
                    <form action="{{ route('admin.approveRequest', $request->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                    </form>
                    <form action="{{ route('admin.rejectRequest', $request->id) }}" method="POST" class="d-inline" onsubmit="return confrim('Are you sure want to reject this?');">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
