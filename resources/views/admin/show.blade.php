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
            {{-- <thead> --}}

                {{-- </thead> --}}
                <tbody>
                <tr>
                    <th>User Name</th>
                    <td>{{ $post->user->name }}</td>
                </tr>
                <tr>
                    <th>Post Image</th>
                    <td>
                        <img src="{{ asset('storage/images/'.$post->photo) }}" alt="Post Image"
                             style="width: 150px; height: 150px; border: 2px solid #ddd; border-radius: 5px;">
                    </td>
                </tr>
                <tr>
                    <th>Post Title</th>
                    <td>{{ $post->post_title }}</td>
                </tr>
                <tr>
                    <th>Post Content</th>
                    <td>{{ $post->content }}</td>
                </tr>




            <tr>

                <td>

                <form action="{{ route('admin.destroy',$post->id) }}" method="post" class=" d-inline">
                    @csrf
                    @method('delete')
                    <input type="submit" value="delete" class="btn btn-danger">
                </form>
                
                </td>


            </tr>



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
