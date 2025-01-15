@extends('user.user_dashboard')


@section('title', 'show all notificaiton')

@section('body')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>{{ $notification->title }}</h3>
            </div>
            <div class="card-body">
                <p class="card-text">{{ $notification->description }}</p>
                @if($notification->image)
                    <img src="{{ asset($notification->image) }}" class="img-fluid" alt="Notification Image" width="100">
                @endif
                <p>Status: {{ $notification->seen ? 'Seen' : 'Unseen' }}</p>
            </div>
        </div>
        <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-primary">Back to Notifications</a>

    </div>



@endsection
