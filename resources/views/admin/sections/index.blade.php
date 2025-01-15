@extends('admin.admin_dashboard')

@section('title', 'Project')


@section('body')

    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h1>Create Section</h1>
                    <a href="{{ route('sections.create') }}" class="btn btn-primary mb-3">Add New Section</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Icon</th>
                            <th>Link</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->title }}</td>
                                <td><img src="{{ asset($section->icon) }}" alt="icon" width="50"></td>
                                <td>{{ $section->link }}</td>
                                <td>
                {{--                    <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-warning">Edit</a>--}}
                                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirmDelete()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
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

<script type="text/javascript">
    function confirmDelete() {
        return confirm('Are you sure you want to delete this section?');
    }
</script>


@endsection
