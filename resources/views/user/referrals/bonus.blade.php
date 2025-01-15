

@extends('user.user_dashboard')

@section('title', 'global bonus')

@section('body')

<style>
    .card-body {
        position: relative;
    }

    .image-container {
        position: relative;
        width: 100%; /* Full width */
        max-width: 370px; /* Controls max width on larger screens */
        margin: 0 auto; /* Center align */
    }

    .balance-overlay {
        position: absolute;
        top: 55%;
        left: 38%;
        transform: translate(-55%, -38%);
        font-size: 22px; /* Adjust size for readability */
        font-weight: bold;
        color: #ffffff;
        /* background: rgba(0, 0, 0, 0.6); Semi-transparent background */
        padding: 8px 16px;
        border-radius: 8px;
        text-align: center;
    }
    .condition-text {
            font-size: 16px;
            margin-top: 20px;
            text-align: center;
        }

        .progress-card {
            background-color: #7f3eff; /* purple background */
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 20px;
            font-size: 24px;
            font-weight: bold;
            margin: 10px;
        }

        .progress-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .progress-labels {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
</style>


<!-- 
<h1>Referral Bonus Page</h1>

<p><strong>Level 2 Referrals Count:</strong> {{ $level2ReferralsCount }}</p>
<p><strong>Active Level 2 Referrals Count:</strong> {{ $activeLevel2ReferralsCount }}</p>

<p><strong>Bonus Status:</strong> {{ $bonusMessage }}</p> -->



<div class='container'>
    <div class="card">
        <div class="card-body text-center position-relative">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="image-container">
                        <img src="{{ asset('user/referral_bonus/wallet_1.png') }}" class="img-fluid" alt="no image found">
                        <div class="balance-overlay">1000.00 ৳</div>
                    </div>
                </div>
                <div class="fs-3">গ্লোবাল বোনাস</div>
            </div>
        </div>
    </div>
</div> 
<!-- Condition Text -->
    <div class="condition-text">
        নিচের শর্তটি পূর্ণ হলে গ্লোবাল বোনাস মূল ব্যালেন্স এ চলে যাবে <br>
        আপনার জেনারেশন-২ এ রেফারেল সংখ্যাঃ{{ $level2ReferralsCount }}
        <p><strong>Active Bonus:</strong> {{ $bonusMessage }}</p>
    </div>

    <!-- Progress Indicators -->
    <div class="progress-container">
        <div>
            <div class="progress-card">{{ $activeLevel2ReferralsCount }}</div>
            <div class="progress-labels">একটিভ</div>
        </div>
        <div>
            <div class="progress-card">25</div>
            <div class="progress-labels">টারগেট</div>
        </div>
    </div>

@endsection



