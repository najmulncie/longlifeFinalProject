@extends('admin.admin_dashboard')

@section('title', 'create support')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1>Add Contact</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('contacts.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" required>
                            <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : ' ' }}</span>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control" required>
                            <span class="text-danger">{{ $errors->has('phone_number') ? $errors->first('phone_number') : ' ' }}</span>
                        </div>

                        <button type="submit" class="btn btn-success">Add Contact</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
