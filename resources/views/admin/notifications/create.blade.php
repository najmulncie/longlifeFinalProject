@extends('admin.admin_dashboard')

@section('title', 'Add Notification')


{{--@section('body')--}}
{{--    <h1>Create Notification</h1>--}}
{{--    <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--        @csrf--}}
{{--        <label>Title:</label>--}}
{{--        <input type="text" name="title" required>--}}
{{--        <label>Description:</label>--}}
{{--        <textarea name="description" required></textarea>--}}
{{--        <label>Image:</label>--}}
{{--        <input type="file" name="image">--}}
{{--        <button type="submit">Save</button>--}}
{{--    </form>--}}
{{--@endsection--}}


@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1>Create Notification</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('notifications.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Title" required>
                            <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Description" required></textarea>
                            <span class="text-danger">{{ $errors->has('description') ? $errors->first('description') : ' ' }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Image</label>
                            <input type="file" name="image" class="form-control" required>
                            <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                        </div>

                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
