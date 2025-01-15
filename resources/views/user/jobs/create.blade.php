@extends('user.user_dashboard')

@section('title', 'Create Jobs')

@section('body')
<div class="container-fluid">
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h1>Create Job</h1>
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

                <form action="{{ route('user.job.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="job title" required>
                        <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'): '' }}</span>
                   
                    </div>

                    <div class="">
                        <label for="link" class="form-label">Job Link</label>
                        <input type="url" class="form-control" id="link" name="link" placeholder="job link" required>
                        <span class="text-danger">{{ $errors->has('link') ? $errors->first('link'): '' }}</span>
                    
                    </div>

                    <div class="">
                        <label for="limit" class="form-label">Job Limit</label>
                        <input type="number" class="form-control" id="limit" name="limit" min="1" placeholder="job limit" required>
                        <span class="text-danger">{{ $errors->has('limit') ? $errors->first('limit'): '' }}</span>
                    
                    </div>
                    
                    <div class="">
                        <label for="min_amount" class="form-label">Minimum Amount per Job</label>
                        <input type="number" class="form-control" id="min_amount" name="min_amount" step="0.01" placeholder="job limit" required>
                        <span class="text-danger">{{ $errors->has('min_amount') ? $errors->first('min_amount'): '' }}</span>
                    </div>

                    <div class="">
                        <label for="description" class="form-label">Job Description</label>
                        <textarea name="description" class="form-control" id="description"></textarea>  
                        <span class="text-danger">{{ $errors->has('description') ? $errors->first('description'): '' }}</span>

                    </div>

                    <div class="">
                        <label for="image" class="form-label">Job Image</label>
                        <input type="file" class="form-control" accept="image/*" id="image" name="image" required>
                        <span class="text-danger">{{ $errors->has('image') ? $errors->first('image'): '' }}</span>

                    </div>

                
                    <button type="submit" class="btn btn-success">Create Job</button>
                </form>

            </div>
        </div>
    </div>



</div>

@endsection
