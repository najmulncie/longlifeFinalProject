@extends('admin.admin_dashboard')

@section('title', 'Manage Nagod')


@section('body')

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>All Nagod Task</h4><span></span>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="row_create" style="width:100%">
                        <thead>
                        <tr>
                            <th>Sl NO</th>
                            <th>Nagod Number</th>
                            <th>Description</th>
                            <th></th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                           @foreach($nagods as $nagod)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $nagod->nagod_number }}</td>
                                    <td>{{ $nagod->nagod_description }}</td>
                                    <td></td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.nagod-task-delete', ['id' => $nagod->id]) }}" method="post" onsubmit="return confirm('Are you sure want to delete this item!...')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form>

{{--                                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirmDelete()">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button class="btn btn-sm btn-outline-danger-2x" type="submit">Delete</button>--}}
{{--                                        </form>--}}
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
