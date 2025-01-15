@extends('admin.admin_dashboard')

@section('title', 'Manage bKash')


@section('body')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>All bKash Task</h4><span></span>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="row_create" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl NO</th>
                            <th>bKash Number</th>
                            <th>Description</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($bkashs as $bkash)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bkash->bkash_number }}</td>
                                <td>{{ $bkash->description }}</td>
                                <td></td>
                                <td class="text-center">
                                    <form action="{{ route('admin.bkash-task-delete', ['id' => $bkash->id]) }}" method="post" onsubmit="return confirm('Are you sure want to delete this item!...')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
@endsection
