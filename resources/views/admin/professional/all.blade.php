@extends('admin.admin_dashboard')

@section('title', 'All Professional Service')

@section('body')



<div class="container-fluid">
<a href="{{ route('admin.professional.index') }}" class="btn btn-primary fs-5 mb-2">Create Professional Service</a>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4> View All Professional</h4><span></span>

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
                        <th>Description</th>
                        <th>F/like Count</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($professionals as $professional)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $professional->title }}</td>
                        <td>{{ $professional->description }}</td>
                        <td>{{ $professional->react_count }}</td>
                        <td>{{ $professional->price }}</td>
                        <td>
                            <form action="{{ route('admin.professional.delete', $professional->id) }}" method="POST" style="margin-top: 10px;" onsubmit="return confirmDelete()">
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
    </div>
    <!-- Container-fluid Ends-->
  </div>



<script>
    
   function confirmDelete() {
    return confirm("Are you sure you want to delete this professional Service?");
}

</script>


@endsection