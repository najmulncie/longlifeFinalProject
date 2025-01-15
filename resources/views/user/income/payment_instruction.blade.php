@extends('user.user_dashboard')

@section('title', 'Payment Instruction')

@section('body')
<style>
        .instruction-card {
            background-color: #ff5b77;
            color: white;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
        }
        .instruction-card h5 {
            font-weight: bold;
            margin-bottom: 15px;
        }
        .highlight {
            color: #ffd700; /* Gold color for emphasis */
            font-weight: bold;
        }
        .btn-verify {
            background-color: #ff5b77;
            color: white;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
        }
        .amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #444;
            margin-bottom: 10px;
        }
        .copy-button {
            background-color: #ff9fb1;
            border: none;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .list-unstyled li::before {
            content: "•"; /* Custom bullet */
            font-weight: bold;
            font-size: 1.2rem;
            margin-right: 8px;
            color: white;
        }
    </style>

<div class="container mt-4">
        <div class="amount text-center">৳ 200.00</div>
        <div class="instruction-card">
            <h5 class="text-center">ট্রানজেকশন আইডি দিন</h5>
            <input type="text" class="form-control mb-3" placeholder="ট্রানজেকশন আইডি দিন">
            <ul class="list-unstyled">
                <li>*247# ডায়াল করে আপনার BKASH (মোবাইল মেনুতে যান অথবা BKASH অ্যাপে যান)।</li>
                <li><span class="highlight">"Payment"</span> -এ ক্লিক করুন।</li>
                <li>প্রাপক নম্বর হিসাবে এই নম্বরটি লিখুন: <strong>01866255596</strong>
                    <button class="copy-button">Copy</button>
                </li>
                <li>টাকার পরিমাণ: <strong>200.00</strong></li>
                <li>নিশ্চিত করতে এখন আপনার BKASH (মোবাইল মেনু পিন লিখুন)।</li>
                <li>সবকিছু ঠিক থাকলে, আপনি BKASH থেকে একটি নিশ্চিতকরণ বার্তা পাবেন।</li>
                <li>এখন উপরের বক্সে আপনার Transaction ID দিন এবং নিচের VERIFY বাটনে ক্লিক করুন।</li>
            </ul>
        </div>
        <button class="btn btn-verify w-100">VERIFY</button>
    </div>

@endsection