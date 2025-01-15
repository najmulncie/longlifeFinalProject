@extends('admin.admin_dashboard')

@section('title', 'notification')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1>All Notifications</h1>
                    <a class="btn btn-primary btn-sm" href="{{ route('notifications.create') }}">Add Notification</a>
                </div>

                <div class="card-body">
                    @foreach($notifications as $notification)
                        <div class="notification-item p-3 mb-4 border-bottom">
                            <h5><strong>Title:</strong> {{ $notification->title }}</h5>
                            <p><strong>Description:</strong> {{ $notification->description }}</p>

                            @if($notification->image)
                                <p><strong>Image:</strong></p>
                                <img src="{{ asset($notification->image) }}" alt="Notification Image" width="100" class="my-2">
                            @endif

                            <form action="{{ route('notifications.destroy', $notification->id) }}" method="POST" class="mt-3" onsubmit="return confirm('Are you sure you want to delete this notification?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>


@endsection
