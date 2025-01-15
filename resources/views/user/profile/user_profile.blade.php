@extends('user.user_dashboard')

@section('titile', 'User Profile')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

@section('body')

<div class="container-fluid">
    <div class="row">
      <div class="col-xl-12 col-md-12 col-sm-12">
        <div class="card height-equal">
          <div class="card-header">
            <h4>User Profile</h4>
              <p>Your main balance: {{ auth()->user()->main_balance }} টাকা</p>

              <p class="f-m-light mt-1">
          </div>
          <div class="card-body custom-input">
            <form class="row g-3" action="{{ route('user.user_profile_store') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="col-12">
                <label class="form-label" for="title">Name</label>
                <input class="form-control" name="name" id="name" type="text" value="{{ $profileData->name }}" aria-label="name" >
              </div>
              <div class="col-12">
                <label class="form-label" for="title">User name</label>
                <input class="form-control" name="username" id="username" type="text" value="{{ $profileData->username }}" aria-label="username">
            </div>
            <div class="col-12">
                <label class="col-sm-12 col-form-label" for="inputPassword2">Email</label>
                <input class="form-control" name="email" id="inputPassword2" value="{{ $profileData->email }}" type="email">
            </div>
            <div class="col-12">
                <label class="form-label" for="exampleFormControlInput1">Address</label>
                <textarea name="address" class="form-control" id="" cols="20" rows="5">{{ $profileData->address }}</textarea>
            </div>

            <div class="col-12">
                <label class="col-sm-12 col-form-label" for="inputPassword2">Phone</label>
                <input class="form-control" name="phone" id="inputPassword2" value="{{ $profileData->phone }}" type="text">
            </div>
                <div class="col-12">
                    <label class="col-sm-12 col-form-label" for="inputPassword2">Refer Code</label>
                    <input class="form-control" name="referral_code" id="inputPassword2" value="{{ $profileData->referral_code }}" type="text" readonly>
                </div>

                @php
                    $id = Auth::user()->id;
                    $profile_data = App\Models\User::find($id);
                @endphp

              <div class="col-12">
                <label class="col-sm-12 col-form-label" for="inputPassword2">Photo</label>
                <input class="form-control" name="photo" id="image" type="file" >
{{--                <img id="showImage" class="rounded mt-2" height="60" width="60" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images'.$profileData->photo) : url('upload/profile.png') }}" alt="no images">--}}
                  <img id="showImage" class="rounded mt-2" height="60" width="60"
                       src="{{ (!empty($profileData->photo)) ? url('upload/user_images/'.$profileData->photo) : url('upload/profile.png') }}"
                       alt="no image">
              </div>
              <div class="col-12">
                <div class="form-check form-switch">
                  <input class="form-check-input" id="flexSwitchCheckDefault" type="checkbox" role="switch" required>
                  <label class="form-check-label" for="flexSwitchCheckDefault">Are you sure above information are true</label>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Update Profile</button>
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
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>


@endsection
