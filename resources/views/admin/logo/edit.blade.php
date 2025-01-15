@extends('admin.admin_dashboard')

@section('title', 'Edit Logo')


@section('body')

    <div class="col-lg-8 mx-auto">
        <h3 class="text-center text-success">{{ session('message') }}</h3>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit Logo</h4>

                <form action="{{ route('logo.logo-update', ['id' => $logo->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="{{ $logo->title }}" id="horizontal-firstname-input">
                            <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Image <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="image" class="form-control" id="horizontal-password-input">
                            <img src="{{ asset($logo->image) }}" alt="" height="80" width="80" class="mt-1">
                            <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update Logo</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
