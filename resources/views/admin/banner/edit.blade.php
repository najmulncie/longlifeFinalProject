@extends('admin.admin_dashboard')

@section('title', 'Edit banner')


@section('body')

    <div class="col-lg-8 mx-auto">
        <h3 class="text-center text-success">{{ session('message') }}</h3>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Edit banner</h4>

                <form action="{{ route('banner.banner-update', ['id' => $banner->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Title <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" name="title" class="form-control" value="{{ $banner->title }}" id="horizontal-firstname-input">
                            <span class="text-danger">{{ $errors->has('title') ? $errors->first('title') : ' ' }}</span>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Image <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="file" name="image" class="form-control" id="horizontal-password-input">
                            <img src="{{ asset($banner->image) }}" alt="" height="80" width="80" class="mt-1">
                            <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary w-md">Update banner</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
