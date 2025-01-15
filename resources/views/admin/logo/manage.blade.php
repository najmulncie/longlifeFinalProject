@extends('admin.admin_dashboard')

@section('title', 'Manage Logo')

@section('body')


    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Logo</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="/logo">Add Logo</a></li>
                        <li class="breadcrumb-item active">Manage logo</li>
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

                    <h4 class="card-title">Logo Datatable</h4>
                    <p class="card-title-desc">All <code>logo</code> Here.
                    </p>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr class="text-center">
                            <th>Sl No</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>
                        @foreach($logos as $logo)
                            <tr class="text-center {{ $logo->status == 1 ? '' : 'bg-warning text-white' }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $logo->title }}</td>
                                <td>
                                    <img src="{{ asset($logo->image) }}" alt="" width="80" height="80">
                                </td>
                                <td>{{ $logo->status == 1 ? 'Published' : 'Unpublished' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('logo.logo-status', ['id' => $logo->id]) }}" class="btn btn-success btn-sm mr-1 mb-1"><i class="fa fa-arrow-circle-up"></i></a>
                                    <a href="{{ route('logo.logo-edit', ['id' => $logo->id]) }}" class="btn btn-success btn-sm mr-1 mb-1"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('logo.logo-delete', ['id' => $logo->id]) }}" method="post" onsubmit="return confirm('Are you sure want to delete this item!...')">
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
