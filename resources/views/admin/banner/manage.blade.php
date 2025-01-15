@extends('admin.admin_dashboard')

@section('title', 'Manage banner')

@section('body')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">banner</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/banner">Add banner</a></li>
                        <li class="breadcrumb-item active">Manage banner</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center text-success">{{ session('message') }}</h4>
                    <h4 class="text-center text-danger">{{ session('message_delete') }}</h4>

                    <h4 class="card-title">banner Datatable</h4>
                    <p class="card-title-desc">All <code>banner</code> Here.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="text-center">
                            <th>Sl No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($banners as $banner)
                            <tr class="text-center {{ $banner->status == 1 ? '' : 'bg-warning text-white' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $banner->title }}</td>
                                <td>
                                    <img src="{{ asset($banner->image) }}" alt="" width="80" height="80">
                                </td>
{{--                                <td>{{ $banner->status == 1 ? 'Published' : 'Unpublished' }}</td>--}}
                                <td class="text-center">
{{--                                    <a href="{{ route('banner.banner-status', ['id' => $banner->id]) }}" class="btn btn-success btn-sm mr-1 mb-1"><i class="fa fa-arrow-circle-up"></i></a>--}}
                                    <a href="{{ route('banner.banner-edit', ['id' => $banner->id]) }}" class="btn btn-success btn-sm mr-1 mb-1"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('banner.banner-delete', ['id' => $banner->id]) }}" method="post" onsubmit="return confirm('Are you sure want to delete this item!...')">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->




@endsection
