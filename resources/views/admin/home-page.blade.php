@extends('layouts/admin-layout')
@section('tabel-style')

<link
        href="{{ asset('dashboard/assets') }}/css/dataTables.bootstrap4.css"
        rel="stylesheet"
      />
@endsection
@section('space-work')


<div class="row">
<div class="col-12">
<div class="card">
    <div class="card-body">
        @if (Session::has('msg'))
        <div class="alert alert-success">{{ Session::get('msg') }}</div>
    @endif
        <h5 class="card-title">Basic Datatable</h5>
        <div class="table-responsive">
        <table
            id="zero_config"
            class="table table-striped table-bordered"
        >
            <thead>
            <tr>
                <th>User Name</th>
                <th>Post Title</th>
                <th>Post Content</th>

            </tr>
            </thead>
            <tbody>



            @foreach ($data as $post )
            <tr>

                <td>{{ $post->user->name }}</td>
                <td>{{ $post->post_title }}</td>
                <td>{{ $post->content }}</td>

                <td>
                <a href="{{ route('admin.show',$post->id) }}" class="btn btn-success">Show</a>
                <form action="{{ route('admin.destroy',$post->id) }}" method="post" class=" d-inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete" class="btn btn-danger">
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

@section('table-scripts')
<!-- this page js -->
<script src="{{ asset('dashboard/assets') }}/js/datatables.min.js"></script>
<script>
  /****************************************
   *       Basic Table                   *
   ****************************************/
  $("#zero_config").DataTable();
</script>
@endsection
