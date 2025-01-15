@extends('user.user_dashboard')

@section('title', 'User Refferal Tree')


@section('body')

    <style>
        table {
            border-collapse: collapse; /* সীমানাগুলির মধ্যে দূরত্ব কমাতে */
            width: 100%; /* টেবিলের প্রস্থ নির্ধারণ */
        }
        td {
            border: 1px solid #dddddd; /* সীমানা রং */
            padding: 8px; /* প্যাডিং যুক্ত করা */
            vertical-align: top; /* টেবিল সেলগুলির মধ্যে সঠিক বিন্যাস */
        }
        li {
            list-style-type: none; /* লিস্ট স্টাইল বাদ দিন */
        }
        li:last-child {
            border-bottom: none; /* শেষ নামের নিচে সীমানা বাদ দিন */
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <h3>Total Referral Commission:   <strong class="badge rounded-pill badge-primary mb-1">{{ $user->referral_commission }} টাকা</strong></h3>

                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h5>Referral Generation for <strong>{{ $user->name }}</strong></h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            @if(count($referrals) > 0)
                                <table class="display" id="row_create" style="width:100%">
                                <thead>
                                <tr class="text-center fs-5">
                                    <th>Generation</th>
                                    <th>Total Active Members</th>
                                    <th>Total Inactive Members</th>
                                    <th>Active Members</th>
                                    <th>Inactive Members</th>
                                </tr>
                                </thead>
                                <tbody>


                                    @foreach($levelsSummary as $level => $data)
                                        <tr class="text-center">
                                            <td>Generation: <strong>{{ $level }}</strong></td>
                                            <td>{{ $data['active'] }}</td>
                                            <td>{{ $data['inactive'] }}</td>
                                            <td>

                                                @foreach ($data['members']['active'] as $member)
                                                    <li style="border-bottom: 1px solid #dddddd;">{{ $member['name'] }}</li>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($data['members']['inactive'] as $member)
                                                    <li style="border-bottom: 1px solid #dddddd;">{{ $member['name'] }}</li>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @else
                                <p>No referrals found for this user.</p>
                            @endif
                        </div>
                        <!-- Add Commission to Balance Form -->
                        <form action="{{ route('user.addCommissionToBalance', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary float-end">Add to Balance</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>

@endsection

