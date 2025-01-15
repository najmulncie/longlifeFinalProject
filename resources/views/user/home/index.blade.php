@extends('user.user_dashboard')

@section('title', 'User dashboard')


@section('body')


    <!-- user/dashboard.blade.php -->
    <style>
        .icon-box {
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease;
        }

        .icon-box:hover {
            transform: scale(1.05);
        }

        .icon-img {
            width: 100px; /* Adjust the size of the icon */
            height: 100px;
            border-radius: 50%; /* Makes the image rounded */
            border: 2px solid rgba(0, 0, 0, 0.1); /* Light black border */
            object-fit: cover; /* Ensures the image fits within the rounded box */
        }

        p.text-center {
            font-size: 16px;
            color: #333;
            font-weight: bold;
            text-align: center;
        }
        .custom-bg {
            background-color: rgba(0, 0, 0, 0.05); /* Light black background (5% opacity) */
            padding: 20px; /* Add some padding to make space inside the row */
            border-radius: 10px; /* Optional: Rounds the corners of the row */
        }
        .header-title {
            font-size: 24px; /* Adjust font size as needed */
            color: #333; /* Dark text color */
            font-weight: bold; /* Make the header bold */
            margin-bottom: 20px; /* Space below the header */
        }
    </style>


<div class="container-fluid">

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                        @if($banners && !$banners->isEmpty())
                            @foreach($banners as $banner)
                                <div class="blog-box blog-details">
                                    <img class="img-fluid w-100" style="height: 300px" src="{{ asset($banner->image) }}" alt="banner">
                                </div>
                            @endforeach
                        @else
                            <p>No banners available</p>
                        @endif
                </div>
            </div>
        </div>
    </div>


    <div class="row">

        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card">
                <div class="card-body">
                    <h2>Welcome, {{ auth()->user()->name }}</h2>
                    {{--        <p>Your account status: {{ auth()->user()->is_active ? 'Active' : 'Inactive' }}</p>--}}
                    <p>Your account status:
                        @if(auth()->user()->is_active)
                            <span class="badge rounded-pill badge-success"><i class="fa fa-check-square"></i> Active</span>
                        @else
                            <span class="badge rounded-pill badge-danger"> Inactive</span>
                        @endif
                    </p>
                </div>
            </div>
            <!-- অন্যান্য কনটেন্ট -->
        </div>

        <div class="col-xl-4 col-sm-6 col-xxl-3 col-ed-4 box-col-4">
            <div class="card social-profile">
                <div class="card-body">

                    @php
                        $id = Auth::user()->id;
                        $profile_data = App\Models\User::find($id);
                    @endphp

                    <div class="social-img-wrap">
                        <div class="social-img"><img id="showImage" class="img-60" src="{{ (!empty($profile_data->photo)) ? url('upload/user_images/'.$profile_data->photo) : url('upload/profile.png')  }}" alt=""></div>
                        <div class="edit-icon">
                            <svg>
                                <use href="../assets/svg/icon-sprite.svg#profile-check"></use>
                            </svg>
                        </div>
                    </div>

                    <div class="social-details">
                        <h5 class="mb-1"><a href="#"> {{ auth()->user()->name }}</a></h5><span class="f-light"> {{ auth()->user()->email }}</span>
                        <br/>
                        <h5>Refferal Code: <span class="f-light" id="referralCode"> {{ auth()->user()->referral_code }}</span>
                            <button class="btn btn-primary p-2" onclick="copyReferralCode()"><i class="icofont icofont-copy-alt"></i></button>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- section/ project -->
    <div class="row custom-bg mt-5">
        <div class="col-12 text-center mb-4"> <!-- Header section -->
            <h2 class="header-title">All Project </h2>
        </div>
        @foreach($sections as $section)
            <div class="col-xl-4 col-sm-4 col-4 text-center"> <!-- Grid structure for mobile -->
                <a href="{{ $section->link }}" target="_blank" class="text-decoration-none">
                    <div class="icon-box">
                        <img src="{{ asset($section->icon) }}" alt="{{ $section->title }}" class="icon-img rounded-circle">
                        <p class="text-center">{{ $section->title }}</p> <!-- This should center the text -->
                    </div>
                </a>
            </div>
        @endforeach
    </div>


    <div class="row">
        <!-- Payment req subject -->
        <div class="col-sm-12 col-xl-6">
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
                                @if($bkashTask)
                                <div class="flex-space flex-wrap align-items-center"><img class="tab-img" src="{{ asset('/') }}admin/assets/images/avtar/7.jpg" alt="profile">
                                    <ul class="d-flex flex-column gap-1">
                                        <li>
                                            <strong>Description:  </strong>
                                            <p id="bkash-description" style="display: none;">{!! $bkashTask->description !!}</p>
                                            <p class="short-description">{!! Str::words($bkashTask->description, 10, '.....') !!}</p>
                                            <button class="read-more-btn btn btn-primary" data-target="bkash-description">Read More</button>
                                        </li>
                                        <li><strong>Bkash Number: </strong> <h2>{{ $bkashTask->bkash_number }}</h2></li>
                                    </ul>
                                </div>
                                @else
                                    <p>No Bkash task found.</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tabs">
                            <div class="pt-3 mb-0">
                                @if($nagodTask)
                                    <div class="flex-space flex-wrap align-items-center"><img class="tab-img" src="../assets/images/avtar/7.jpg" alt="profile">
                                        <ul class="d-flex flex-column gap-1">
                                            <li>
                                                <strong>Description:  </strong>
                                                <p id="nagodDescription" style="display: none;">{!! $nagodTask->nagod_description !!}</p>
                                                <p class="short-description">{!! Str::words($nagodTask->nagod_description, 10, '.....') !!}</p>
                                                <button class="read-more-btn btn btn-primary" data-target="nagodDescription">Read More</button>
                                            </li>
                                            <li>
                                                <strong>Nagod Number: </strong>
                                                <h2>{{ $nagodTask->nagod_number }}</h2>
                                            </li>
                                        </ul>
                                    </div>
                                @else
                                    <p>No nagod task found.</p>
                                @endif
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

        <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card height-equal">
                <div class="card-header">
                    <h3>For Account Activation</h3>
                </div>
                <div class="card-body custom-input">

                    <form action="{{ route('submit-payment-request') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="form-label" for="transaction_id">Transaction ID</label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="Transaction_id">
                            <span class="text-danger">{{ $errors->has('transaction_id') ? $errors->first('transaction_id'): '' }}</span>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number">Mobile Number</label>
                            <input type="text" class="form-control" id="mobile_number" name="mobile_number" placeholder="Transaction phone number" />
                            <span class="text-danger">{{ $errors->has('mobile_number') ? $errors->first('mobile_number'): '' }}</span>
                            {{--        value="{{ auth()->user()->mobile_number }}" readonly--}}
                        </div>
                        <button type="submit" class="btn btn-primary mt-1">Submit Payment Request</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.read-more-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const targetElement = document.getElementById(targetId);

                    if (targetElement) {
                        if (targetElement.style.display === 'none' || targetElement.style.display === '') {
                            targetElement.style.display = 'block';
                            this.textContent = 'Read Less'; // Optional: Change button text
                        } else {
                            targetElement.style.display = 'none';
                            this.textContent = 'Read More'; // Optional: Change button text
                        }
                    }
                });
            });
        });
    </script>

<script>
    function copyReferralCode() {
        // রেফার কোডটিকে নির্বাচন করুন
        var referralCode = document.getElementById("referralCode").textContent;

        // একটি টেক্সট এলিমেন্ট তৈরি করুন
        var tempInput = document.createElement("input");
        tempInput.style.position = "absolute";
        tempInput.style.left = "-1000px"; // এটি পেজের বাইরে সরিয়ে ফেলুন
        tempInput.value = referralCode;
        document.body.appendChild(tempInput);

        // কোডটিকে সিলেক্ট করে কপি করুন
        tempInput.select();
        tempInput.setSelectionRange(0, 99999); // মোবাইলের জন্য
        document.execCommand("copy");

        // অস্থায়ী ইনপুট এলিমেন্ট মুছে ফেলুন
        document.body.removeChild(tempInput);

        // কপি কনফার্মেশন দেখানোর জন্য একটি অ্যালার্ট বা নোটিফিকেশন যোগ করতে পারেন
        alert("Referral code copied: " + referralCode);
    }
</script>


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
