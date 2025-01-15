@extends('admin.admin_dashboard')

@section('title', 'Payment Task')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>




@section('body')

    <div class="container-fluid">
        <div class="row">

            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4>পেমেন্ট বিষয়</h4>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                            <li class="nav-item"><a class="nav-link active txt-secondary" id="icon-home-tab" data-bs-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true"> বিকাশ</a></li>
                            <li class="nav-item"><a class="nav-link txt-secondary" id="profile-icon-tabs" data-bs-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false">নগদ</a></li>
                        </ul>
                        <div class="tab-content" id="icon-tabContent">
                            <div class="tab-pane fade show active" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                                <div class="pt-3 mb-0">
                                    <form class="row g-3" action="{{ route('admin.payment_gateway_bkash.task') }}" method="post">
                                        @csrf
                                        <div class="form-group">

                                            <label for="bkash_number">Bkash Number</label>
                                            <input type="text" class="form-control" id="bkash_number" name="bkash_number" placeholder="Enter Your Bkash Number">
                                            <span class="text-danger">{{ $errors->has('bkash_number') ? $errors->first('bkash_number'): '' }}</span>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="exampleFormControlInput1">Description</label>
                                            <textarea name="description" class="form-control" id="" cols="20" rows="5"></textarea>
                                            <span class="text-danger">{{ $errors->has('description') ? $errors->first('description'): '' }}</span>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Add Bkash Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tabs">
                                <div class="pt-3 mb-0">
                                    <form class="row g-3" action="{{ route('admin.payment_gateway_nagod.task') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="bkash_number">Nagod Number</label>
                                            <input type="text" class="form-control" id="nagod_number" name="nagod_number" placeholder="Enter Your Nagod Number">
                                            <span class="text-danger">{{ $errors->has('nagod_number') ? $errors->first('nagod_number'): '' }}</span>
                                        </div>
                                        <div class="col-12">
                                            <textarea  name="nagod_description" class="form-control" id="" cols="20" rows="5"></textarea>
                                            <span class="text-danger">{{ $errors->has('nagod_description') ? $errors->first('nagod_description'): '' }}</span>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Add Nagod Task</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-icon" role="tabpanel" aria-labelledby="contact-icon-tab">
                                <p class="pt-3">Us Technology offers web & mobile development solutions for all industry verticals.Include a short form using fields that'll help your business understand who's contacting them. </p>
                                <label class="form-label" for="exampleFormControlone">Email address</label>
                                <input class="form-control" id="exampleFormControlone" type="email" placeholder="youremail@gmail.com">
                            </div>
                        </div>
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
