@extends('admin.admin_dashboard')

@section('title', 'Purchase Requests')

@section('body')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
          <h2>Pending Requests</h2>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Service</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $request)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->professionalService->description }}</td>
                    <td>{{ ucfirst($request->status) }}</td>
                    <td>
                        <form action="{{ route('admin.requests.update', $request->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="form-select">
                                <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="accepted" {{ $request->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                                <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-1">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
    
   
</div>
@endsection
