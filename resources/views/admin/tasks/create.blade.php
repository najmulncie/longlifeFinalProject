@extends('admin.admin_dashboard')

@section('title', 'My Job create')

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card height-equal">
                <div class="card-header">
                    <h4>Add New Task</h4>
                    <p class="f-m-light mt-1">
                </div>
                <div class="card-body custom-input">
                    <form class="row g-3" action="{{ route('admin.tasks.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label class="form-label" for="title">Task Title</label>
                            <input class="form-control" name="title" id="title" type="text" placeholder="Job Title" aria-label="name" >
                            <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'): '' }}</span>
                        </div>
                        <div class="col-12">
                            <label class="form-label" for="exampleFormControlInput1">Task Description</label>
                            <textarea name="description" class="form-control" id="description" cols="20" rows="5"></textarea>
                            <span class="text-danger">{{ $errors->has('description') ? $errors->first('description'): '' }}</span>
                        </div>

                        <div class="col-12">
                            <label class="col-sm-12 col-form-label" for="amount">Amount</label>
                            <input type="number" class="form-control" name="amount" id="amount" min="0" step="0.01" placeholder="Amount">
                            <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount'): '' }}</span>

                        </div>
                        <div class="col-12">
                            <label class="col-sm-12 col-form-label" for="inputPassword2">Link</label>
                            <input class="form-control" name="link" id="link" placeholder="Enter your link"  type="url">
                            <span class="text-danger">{{ $errors->has('link') ? $errors->first('link'): '' }}</span>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Add Task</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
