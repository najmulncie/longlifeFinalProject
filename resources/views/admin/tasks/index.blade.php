@extends('admin.admin_dashboard')

@section('title', 'My all Jobs')

@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>My All Task lists</h3><span></span>
                        @if (session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif

                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="row_create" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Actions</th>
                                </tr>

                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
{{--                                        <td class="description-cell"> {!! Str::limit($task->description, 100, '...') !!} </td>--}}
                                        <td height="50px">
                                            <a href="{{ $task->link }}" target="_blank">{{ $task->link }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.tasks.view', ['id' => $task->id]) }}" class="btn btn-sm btn-outline-success-2x mb-1" type="button">view</a>
{{--                                            {{ route('logo.logo-status', ['id' => $task->id]) }}--}}
                                            <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirmDelete()">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-outline-danger-2x" type="submit">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <script>
                                    function confirmDelete() {
                                        return confirm('Are you sure you want to delete this task?'); // "Yes" or "No" কনফার্মেশন ডায়লগ
                                    }
                                </script>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>


@endsection
