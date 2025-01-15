@extends('admin.admin_dashboard')

@section('title', 'Admin Change Password')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('body')

<div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card height-equal">
          <div class="card-header">
            <h4>Admin Change Password</h4>
            <p class="f-m-light mt-1">
          </div>
          <div class="card-body custom-input">
            <form class="row g-3" action="{{ route('admin.updatePassword') }}" method="post">
                @csrf
              <div class="col-12"> 
                <label class="form-label" for="title">Old Password</label>
                <input class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="name" type="password" placeholder="old password" aria-label="name" >
                <span class="text-danger">{{ $errors->has('old_password') ? $errors->first('old_password'): '' }}</span>
            </div>
              <div class="col-12"> 
                <label class="form-label" for="title">New Password</label>
                <input class="form-control @error('new_password') is-invalid @enderror" name="new_password" id="username" type="password" placeholder="new password" aria-label="username">
                <span class="text-danger">{{ $errors->has('new_password') ? $errors->first('new_password'): '' }}</span>
            </div>
            <div class="col-12"> 
                <label class="col-sm-12 col-form-label" for="inputPassword2">Confirm Password</label>
                <input class="form-control " name="new_password_confirmation" id="inputPassword2" placeholder="confirm password" type="password">
            </div>
            
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Update password</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
  </script>

@endsection