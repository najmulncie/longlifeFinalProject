@extends('admin.admin_dashboard')

@section('title', 'Create Course')

@section('body')
<div class="container mt-4">
<a href="{{ route('course.sections.index') }}" class="btn btn-primary mb-2">view all</a>

    <div class="card">
        <div class="card-header">
            <h3>Create New Course Section</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('course.sections.store') }}" method="POST">
                @csrf
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" required>
                <br>
                <label for="video_url">Video URL:</label>
                <input type="url" class="form-control" name="video_url" id="video_url" required>
                <br>
                

                <label for="category_id">Category</label>
                <select name="category_id" class="form-control"  id="category_id" required>
                    <option value=""> -- Select Category -- </option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <br>
                <button type="submit" class="btn btn-primary">Create Section</button>
            </form>

        </div>
    </div>
</div>


@endsection