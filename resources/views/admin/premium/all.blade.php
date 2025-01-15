@extends('admin.admin_dashboard')

@section('title', 'All Premium')

@section('body')



<div class="container-fluid">
<a href="{{ route('admin.premium.index') }}" class="btn btn-primary fs-5 mb-2">Create Premium</a>

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header pb-0 card-no-border">
            <h4> View All Premium</h4><span></span>

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
                        <th>Image</th>
                        <th>Initial Price</th>
                        <th>Selling Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($premiums as $premium)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $premium->title }}</td>
                        <td>{{ $premium->description }}</td>
                        <td>
                            <img src="{{ asset($premium->image_path) }}" width='50px' height='50px'; alt="{{ $premium->title }}">
                        </td>
                        <td>{{ $premium->initial_cost }}</td>
                        <td>{{ $premium->selling_price }}</td>
                        <td>
                            <form action="{{ route('admin.premium.delete', $premium->id) }}" method="POST" style="margin-top: 10px;" onsubmit="return confirmReject()">
                             @csrf
                                @method('PATCH')
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
    
   function confirmReject() {
    return confirm("Are you sure you want to delete this premium?");
}

</script>


@endsection