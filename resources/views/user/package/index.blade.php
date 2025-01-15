@extends('user.user_dashboard')

@section('title', 'Drive Offers')

@section('body')

<style>
    .tab-content .card {
        margin-top: 10px;
    }

    .nav-tabs .nav-link.active {
        background-color: #ff5722;
        color: white;
    }

    .nav-pills .nav-link.active {
        background-color: #ffc107;
        color: black;
    }

    /* Card Border Styling */
    .operator-card, .category-card {
        border: 1px solid #ddd; /* Light border */
        border-radius: 5px; /* Slightly rounded corners */
        padding: 5px; /* Padding inside the card */
        margin-bottom: 15px; /* Space below the card */
        overflow: hidden; /* Prevent content from overflowing */
    }

    /* Ensure tabs and pills stay in a single line on all screen sizes */
    .nav-tabs {
        display: flex;
        flex-wrap: wrap; /* Allow wrapping on smaller devices */
        justify-content: space-evenly; /* Evenly space tabs across the container */
        margin-bottom: 0; /* Remove any extra bottom margin */
    }

    .nav-pills {
        display: flex;
        flex-wrap: wrap; /* Allow wrapping on smaller devices */
        justify-content: space-evenly; /* Evenly space pills across the container */
    }

    /* For small screens, ensure 3 operators per row */
    @media (max-width: 480px) {
        .nav-tabs .nav-item {
            flex: 0 0 33.33%; /* Each item takes up 33.33% of the width, 3 per row */
            max-width: 33.33%; /* Ensure 3 items per row */
            margin-bottom: 10px; /* Space between rows */
        }

        .nav-pills .nav-item {
            flex: 0 0 33.33%; /* Each category takes up 33.33% of the width, 3 per row */
            max-width: 33.33%; /* Ensure 3 categories per row */
            margin-bottom: 10px; /* Space between rows */
        }
    }

    /* For slightly larger mobile screens, like 600px, still 3 per row */
    @media (max-width: 600px) {
        .nav-tabs .nav-item {
            flex: 0 0 33.33%; /* Each item takes up 33.33% of the width */
            max-width: 33.33%; /* Ensure 3 items per row */
        }

        .nav-pills .nav-item {
            flex: 0 0 33.33%; /* Each item takes up 33.33% of the width */
            max-width: 33.33%; /* Ensure 3 items per row */
        }
    }
</style>

@php
    $operators = $operators ?? [];
    $packages = $packages ?? [];
@endphp

<div class="container mt-4">
    <!-- Operator Tabs inside a Card -->
    <div class="operator-card">
        <ul class="nav nav-tabs" id="operatorTabs" role="tablist">
            @foreach($operators as $operator)
            <li class="nav-item">
                <button class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" data-bs-target="#{{ strtolower($operator) }}" type="button" role="tab">{{ $operator }}</button>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="operatorTabsContent">
        @foreach($operators as $operator)
        <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ strtolower($operator) }}" role="tabpanel">
            <!-- Category Pills inside a Card -->
            <div class="category-card">
                @php
                    $categories = $packages[$operator]->keys(); // Get categories for each operator
                @endphp
                <ul class="nav nav-pills my-3" id="{{ strtolower($operator) }}Features" role="tablist">
                    @foreach($categories as $category)
                    <li class="nav-item">
                        <button class="nav-link @if($loop->first) active @endif" id="{{ strtolower($operator) }}-{{ strtolower($category) }}-tab" data-bs-toggle="pill" data-bs-target="#{{ strtolower($operator) }}-{{ strtolower($category) }}" type="button" role="tab" aria-controls="{{ strtolower($operator) }}-{{ strtolower($category) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                            {{ $category }}
                        </button>
                    </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content">
                <!-- Loop through categories and their packages -->
                @foreach($categories as $category)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ strtolower($operator) }}-{{ strtolower($category) }}" role="tabpanel" aria-labelledby="{{ strtolower($operator) }}-{{ strtolower($category) }}-tab">
                <div class="row">
                    @foreach($packages[$operator][$category] as $package)
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 mb-3">
                            <div class="card">
                                <div class="card-body d-flex">
                                    <!-- Left: Operator Image/Name -->
                                    <div class="col-3 d-flex align-items-center">
                                        <img src="{{ asset($package->image) }}" alt="{{ $operator }}" class="img-fluid" style="max-height: 50px;">
                                        <!-- Or simply display operator name if no image -->
                                        <!-- <span class="operator-name">{{ $operator }}</span> -->
                                    </div>

                                    <!-- Middle: Title, Cashback, and Description -->
                                    <div class="col-6">
                                        <h5 class="card-title">{{ $package->title }}</h5>
                                        <p class="card-text">Cashback: {{ $package->cashback ?? 'N/A' }} ৳</p>
                                        <p class="card-text"><small>Applicable for all {{ $operator }} users nationwide.</small></p>
                                    </div>

                                    <!-- Right: Price and Button -->
                                    <div class="col-3 text-end">
                                        <p class="card-text"><strong>{{ $package->price }} ৳</strong></p>
                                        <a href="{{ route('buy.package', $package->id) }}" class="btn btn-sm btn-primary">Buy Now</a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
