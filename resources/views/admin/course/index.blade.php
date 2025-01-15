@extends('admin.admin_dashboard')

@section('title', 'Course Vedio')

@section('body')



<div class="container">
<a href="{{ route('course.sections.create') }}" class="btn btn-primary mb-2">Create New Section</a>

    <div class="row">

        <div class="card">
             <div class="card-header pb-0 card-no-border">
                <h4>All Category</h4><span></span>
                <hr>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                <table class="display" id="row_create" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Video URL</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach ($sections as $section)
                        <tr>
                            <td>{{ $section->id }}</td>
                            <td>{{ $section->title }}</td>
                            <td>{{ $section->video_url }}</td>
                            <td>
                                @if($section->category)
                                    {{ $section->category->name }}
                                @else
                                    No Category
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('course.sections.destroy', $section->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
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
</div>






@endsection