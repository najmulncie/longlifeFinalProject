@extends('admin.admin_dashboard')

@section('title', 'All package')


@section('body')
<div class="container">
    <a href="{{ route('admin.packages.create') }}" class="btn btn-primary mb-3">Add Package</a>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Operator</th>
                <th>Category</th>
                <th>Title</th>
                <th>Price</th>
                <th>Cashback</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->operator }}</td>
                <td>{{ $package->category }}</td>
                <td>{{ $package->title }}</td>
                <td>{{ $package->price }}</td>
                <td>{{ $package->cashback }}</td>
                <td>
                    <!-- <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-warning">Edit</a> -->
                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script>
    function confirmDelete() {
        return confirm("Are you sure want to delete this packages?");
    }
</script>


@endsection
