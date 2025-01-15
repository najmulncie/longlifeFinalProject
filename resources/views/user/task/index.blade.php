@extends('user.user_dashboard')

@section('title', 'My all Jobs')

@section('body')


<div class="col-xxl-9 col-sm-12 col-xl-8 box-col-12">
    <div class="card">
        <div class="card-header d-flex">
            <h4 class="mb-0">All Tasks</h4>
        </div>
        <div class="card-body">
            @foreach($tasks as $task)
                <h5 class="card-title">{{ $task->title }}</h5>
                <p class="card-text">{!! Str::limit($task->description, 40, '...') !!}</p>
                <div class="text-end">
                    <a class="me-2 btn btn-sm btn-primary"  href="{{ route('tasks.show', $task->id) }}">Read More</a>
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>


@endsection
