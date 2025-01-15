@extends('admin.admin_dashboard')


@section('title', 'show all notificaiton')

@section('body')


    <div>
        <h3>{{ $notification->title }}</h3>
        <p>{{ $notification->description }}</p>
        @if($notification->image)
            <img src="{{ asset('upload/admin_images/notification/' . $notification->image) }}" alt="Notification Image" width="100">
        @endif
        <p>Status: {{ $notification->seen ? 'Seen' : 'Unseen' }}</p>
    </div>
    <a href="{{ route('notifications.index') }}">Back to Notifications</a>


@endsection
