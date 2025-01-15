@extends('admin.admin_dashboard')

@section('title', 'Create Project')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1>Create Section</h1>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('sections.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="file" class="form-control" id="icon" name="icon" required>
                    </div>

                    <div class="mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="url" class="form-control" id="link" name="link" value="{{ old('link') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Create Section</button>
                </form>

            </div>
        </div>
    </div>



</div>

@endsection
