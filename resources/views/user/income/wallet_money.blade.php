@extends('user.user_dashboard')

@section('title', 'Wallet')

@section('body')

<!-- <div class="container mt-5"> -->
        <!-- <div class="card p-4">
            <h5 class="card-title text-center">মেনুতে সিলেক্ট করুন</h5>
            <form method="POST" action="{{ route('payment.verify') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter your amount">
                </div>
            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="checkbox">
                <label class="form-check-label" for="checkbox">
                    আমি নিশ্চিত এটা পালিশের সাথে এক মত
                </label>
            </div>
            <div class="d-flex justify-content-between">
                <a href="{{ route('income.payment.instruction') }}" class="btn btn-primary">নগদ</a>
                <button class="btn btn-secondary">বিকাশ</button>
                <button class="btn btn-success">Rocket</button>
            </div>
        </div>
    </div> -->

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


    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container mt-5">

     <!-- Payment History Button -->
     <a href="{{ route('payment.history') }}" class="btn btn-sm btn-primary me-3 mb-2">
                        View Payment History
    </a>

    <div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-wrap align-items-center mb-3">
                   
                    
                    <!-- Main Balance -->
                    <span class="btn btn-sm btn-primary me-3 mb-2">
                        Main Balance: {{ number_format($mainBalance, 2) }} BDT
                    </span>
                    
                    <!-- Wallet Balance -->
                    <span class="btn btn-sm btn-primary me-3 mb-2">
                        Transaction Balance: {{ number_format($totalApprovedPayments, 2) }} BDT
                    </span>
                </div>

                <!-- Total Approved and Transferred Amounts -->
                <div class="d-flex flex-wrap align-items-center">
                    <!-- Total Transferred Amount -->
                    <span class="btn btn-sm btn-primary me-3 mb-2">
                    Wallet Balance: {{ number_format($totalWalletBalance, 2) }} BDT                    </span>
                    
                    <!-- Total Wallet Amount -->
                    <span class="btn btn-sm btn-primary mb-2">
                    Total Wallet Amount: {{ number_format($totalTransferredAmount, 2) }} BDT   
                         </span>
                </div>
            </div>
        </div>
    </div>
</div>

 
        <div class="card">
            <div class="card-body">
                <form action="{{ route('transfer.to.wallet') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="transfer_amount" class="form-label">Transfer Amount</label>
                        <input type="number" name="transfer_amount" class="form-control" placeholder="Enter amount to transfer" required>
                        <span class="text-danger">{{ $errors->has('transfer_amount') ? $errors->first('transfer_amount'): '' }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Transfer to Wallet</button>
                </form>

            </div>
        </div>
        

        
        <div class="card p-4">
            <h5 class="card-title text-center">মেনুতে সিলেক্ট করুন</h5>
            <form method="POST" action="{{ route('payment.verify') }}">
                @csrf
                <div class="mb-3">
                    <input type="text" id="amount" name="amount" class="form-control" placeholder="Enter your amount">
                    <span class="text-danger">{{ $errors->has('amount') ? $errors->first('amount'): '' }}</span>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="checkbox">
                    <label class="form-check-label" for="checkbox">
                        আমি নিশ্চিত এটা পলিসির সাথে এক মত
                    </label>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-primary" onclick="showInstructions('nagad')">নগদ</button>
                    <button type="button" class="btn btn-secondary" onclick="showInstructions('bkash')">বিকাশ</button>
                    <button type="button" class="btn btn-success" onclick="showInstructions('rocket')">রকেট</button>
                </div>

                <div class="instruction-card" id="transaction-instructions" style="display: none;">
                    <div class="amount text-center" id="display-amount">৳ 0.00</div>
                    <h5 class="text-center">ট্রানজেকশন আইডি দিন</h5>
                    <input type="text" name="transaction_id" class="form-control mb-3" placeholder="ট্রানজেকশন আইডি দিন">
                    <span class="text-danger">{{ $errors->has('transaction_id') ? $errors->first('transaction_id'): '' }}</span>

                    <ul class="list-unstyled" id="instructions-content">
                        <!-- Instructions will be populated here -->
                    </ul>

                    <input type="hidden" name="payment_method" id="payment_method"> <!-- Hidden field for payment method -->
                    <hr>
                    <button type="submit" class="btn btn-verify w-100">VERIFY</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showInstructions(method) {
            const instructionsContent = document.getElementById('instructions-content');
            const displayAmount = document.getElementById('display-amount');
            const amount = document.getElementById('amount').value || '0.00';
            displayAmount.innerText = `৳ ${amount}`;

            // Show the instruction card
            document.getElementById('transaction-instructions').style.display = 'block';

            // Clear existing instructions
            instructionsContent.innerHTML = '';
            
            // Set the hidden input field to the selected method
            document.getElementById('payment_method').value = method;

            // Generate instructions based on the selected method
            let instructions = '';
            if (method === 'nagad') {
                instructions = `
                    <li>*167# ডায়াল করে আপনার Nagad (মোবাইল মেনুতে যান অথবা Nagad অ্যাপে যান)।</li>
                    <li><span class="highlight">"Send Money"</span> -এ ক্লিক করুন।</li>
                    <li>প্রাপক নম্বর হিসাবে এই নম্বরটি লিখুন: <strong>01784026450</strong></li>
                    <li>টাকার পরিমাণ: <strong>${amount}</strong></li>
                    <li>নিশ্চিত করতে আপনার Nagad পিন লিখুন।</li>
                    <li>সবকিছু ঠিক থাকলে, আপনি Nagad থেকে একটি নিশ্চিতকরণ বার্তা পাবেন।</li>
                    <li>এখন উপরের বক্সে আপনার Transaction ID দিন এবং নিচের VERIFY বাটনে ক্লিক করুন।</li>
                `;
            } else if (method === 'bkash') {
                instructions = `
                    <li>*247# ডায়াল করে আপনার BKASH (মোবাইল মেনুতে যান অথবা BKASH অ্যাপে যান)।</li>
                    <li><span class="highlight">"Payment"</span> -এ ক্লিক করুন।</li>
                    <li>প্রাপক নম্বর হিসাবে এই নম্বরটি লিখুন: <strong>01627212590</strong></li>
                    <li>টাকার পরিমাণ: <strong>${amount}</strong></li>
                    <li>নিশ্চিত করতে এখন আপনার BKASH (মোবাইল মেনু পিন লিখুন)।</li>
                    <li>সবকিছু ঠিক থাকলে, আপনি BKASH থেকে একটি নিশ্চিতকরণ বার্তা পাবেন।</li>
                    <li>এখন উপরের বক্সে আপনার Transaction ID দিন এবং নিচের VERIFY বাটনে ক্লিক করুন।</li>
                `;
            } else if (method === 'rocket') {
                instructions = `
                    <li>*322# ডায়াল করে আপনার Rocket (মোবাইল মেনুতে যান অথবা Rocket অ্যাপে যান)।</li>
                    <li><span class="highlight">"Send Money"</span> -এ ক্লিক করুন।</li>
                    <li>প্রাপক নম্বর হিসাবে এই নম্বরটি লিখুন: <strong>018XXXXXXXX</strong></li>
                    <li>টাকার পরিমাণ: <strong>${amount}</strong></li>
                    <li>নিশ্চিত করতে আপনার Rocket পিন লিখুন।</li>
                    <li>সবকিছু ঠিক থাকলে, আপনি Rocket থেকে একটি নিশ্চিতকরণ বার্তা পাবেন।</li>
                    <li>এখন উপরের বক্সে আপনার Transaction ID দিন এবং নিচের VERIFY বাটনে ক্লিক করুন।</li>
                `;
            }

            // Add the instructions to the list
            instructionsContent.innerHTML = instructions;
        }
    </script>


    @endsection