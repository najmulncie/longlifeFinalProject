@extends('admin.admin_dashboard')

@section('title', 'All package')

@section('body')

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
        <h3>Add New Package</h3>
        </div>
        <div class="card-body">
        
            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-1">
                    <label for="operator" class="form-label">Operator</label>
                    <select class="form-control" id="operator" name="operator">
                        <option value="">Select Operator</option>
                        <option value="Robi">Robi</option>
                        <option value="Airtel">Airtel</option>
                        <option value="Banglalink">Banglalink</option>
                        <option value="Grameenphone">Grameenphone</option>
                        <option value="Teletalk">Teletalk</option>
                    </select>
                    
                    <span class="text-danger">{{ $errors->has('operator') ? $errors->first('operator'): '' }}</span>
                </div>

                <div class="mb-1">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select Category</option>
                        <option value="Bundle">Bundle</option>
                        <option value="Internet">Internet</option>
                        <option value="Minute">Minute</option>
                        <!-- <option value="SMS">SMS</option> -->
                    </select>
                    <span class="text-danger">{{ $errors->has('category') ? $errors->first('category'): '' }}</span>

                </div>

                <div class="mb-1">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                    <span class="text-danger">{{ $errors->has('title') ? $errors->first('title'): '' }}</span>

                </div>
                <div class="mb-1">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                    <span class="text-danger">{{ $errors->has('price') ? $errors->first('price'): '' }}</span>

                </div>
                <div class="mb-1">
                    <label for="cashback" class="form-label">Cashback</label>
                    <input type="number" class="form-control" id="cashback" name="cashback">
                    <span class="text-danger">{{ $errors->has('cashback') ? $errors->first('cashback'): '' }}</span>

                </div>
                <div class="mb-1">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    <span class="text-danger">{{ $errors->has('description') ? $errors->first('description'): '' }}</span>

                </div>
                <div class="mb-1">
                        <label for="horizontal-password-input" class="col-sm-3 col-form-label">Operator Logo <span class="text-danger">*</span></label>
                        <div class="col-sm-12">
                            <input type="file" name="image" class="form-control" id="horizontal-password-input">
                            <span class="text-danger">{{ $errors->has('image') ? $errors->first('image') : ' ' }}</span>
                        </div>
                    </div>
                <button type="submit" class="btn btn-primary">Add Package</button>
            </form>
        </div>
    </div>
</div>

@endsection