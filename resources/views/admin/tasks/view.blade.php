@extends('admin.admin_dashboard')

@section('title', 'My all Jobs')

@section('body')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header pb-0 card-no-border">
                    <h3>My {{ $task->title }} Job Details</h3><span></span>
                    @if (session('success'))
                        <p style="color: green;">{{ session('success') }}</p>
                    @endif
                </div>
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="display" id="row_create" style="width:100%">

                            <tbody>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $task->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $task->description }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $task->amount }} Tk</td>
                                </tr>
                                <tr>
                                    <th>Link</th>
                                    <td>{{ $task->link }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>



@endsection
