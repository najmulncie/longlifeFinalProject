@extends('user.user_dashboard')
@section('title', 'Show Premium')

@section('body')
            <div class="container-fluid">
                <div class="row">
                    @foreach($premiums as $premium)
                        <div class="col-xl-4 xl-50 col-sm-6 box-col-4">
                            <div class="card">
                            <div class="blog-box blog-grid product-box">
                                <div class="product-img"><img class="img-fluid top-radius-blog" src="{{ asset($premium->image_path) }}" style="height:250px;" alt="">
                                <div class="product-hover">
                                    <ul>
                                    <!-- <li><i class="icon-link"></i></li>
                                    <li><i class="icon-import"></i></li> -->
                                    </ul>
                                </div>
                                </div>
                                <div class="blog-details-main p-2">
                                    <h5 class="f-w-600 fs-5">Premium Name: <span>{{ $premium->title }}</span></h5>
                                    <p class="card-text fs-5  pe-2">Price: <span>{{ $premium->selling_price }}</span>    <del class="" style="font-size:14px;"> {{ $premium->initial_cost }}</del></p>
                                    <a href="{{ route('user.premium.buy', $premium->id) }}" class="btn btn-sm btn-primary fs-5"> Buy Now</a>
                                </div>
                            </div>
                            </div>
                        </div>
                  @endforeach
                </div>
              </div>

@endsection