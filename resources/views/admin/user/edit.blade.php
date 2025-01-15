@extends('admin.admin_dashboard')

@section('title', 'Admin Profile')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-md-12 col-sm-12">
                <div class="card height-equal">
                    <div class="card-header">
                        <h4>Edit User Profile</h4>
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-body custom-input">
                        <form class="row g-3" action="{{ route('users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-12">
                                <label class="form-label" for="title">Name</label>
                                <input class="form-control" name="name" id="name" type="text" value="{{ $user->name }}" aria-label="name" >
                            </div>
                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="inputPassword2">Email</label>
                                <input class="form-control" name="email" id="inputPassword2" value="{{ $user->email }}" type="email">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="exampleFormControlInput1">Address</label>
                                <textarea name="address" class="form-control" id="" cols="20" rows="5">{{ $user->address }}</textarea>
                            </div>

                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="inputPassword2">Phone</label>
                                <input class="form-control" name="phone" id="inputPassword2" value="{{ $user->phone }}" type="text">
                            </div>

                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="inputPassword2">Refferral Code</label>
                                <input class="form-control" name="referral_code" id="inputPassword2" value="{{ $user->referral_code }}" type="text">
                            </div>

                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="referral_code">Referred By</label>

                                @if($user->referredBy)
                                    <input class="form-control" name="referral_code" id="referral_code"
                                           value="{{ $user->referredBy->referral_code }}" type="text">
                                    <small>Current Referrer: {{ $user->referredBy->name }} (Code: {{ $user->referredBy->referral_code }})</small>
                                @else
                                    <input class="form-control" name="referral_code" id="referral_code"
                                           placeholder="Enter new referral code" type="text">
                                    <small>No referrer available</small>
                                @endif
                            </div>

                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="inputPassword2">Balance</label>
                                <input class="form-control" name="main_balance" id="inputPassword2" value="{{ $user->main_balance }}" type="text">
                            </div>

                            <div class="col-12">
                                <label class="col-sm-12 col-form-label" for="inputPassword2">Activation Date</label>
                                <input class="form-control" name="activated_at" id="inputPassword2" value="{{ $user->activated_at }}" type="text">
                            </div>
{{--                            <div class="col-12">--}}
{{--                                <label class="col-sm-12 col-form-label" for="inputPassword2">Photo</label>--}}
{{--                                <input class="form-control" name="photo" id="image" type="file" >--}}
{{--                                <img id="showImage" class="rounded mt-2" height="60" width="60" src="{{ (!empty($profileData->photo)) ? url('upload/admin_images/'.$profileData->photo) : url('upload/profle.png') }}" alt="no images">--}}
{{--                            </div>--}}
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
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>

@endsection
