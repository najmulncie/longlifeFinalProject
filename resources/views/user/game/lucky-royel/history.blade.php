@extends('user.user_dashboard')


@section('title', 'Lucky-Royel')


@section('body')

<div class="container">
    <h2>Your Bet History</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bets as $bet)
                <tr>
                    <td>{{ $bet->amount }}</td>
                    <td>{{ ucfirst($bet->status) }}</td>
                    <td>{{ $bet->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
