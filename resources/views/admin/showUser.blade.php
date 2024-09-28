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
                    <th>User ID</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th>User Name</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th>User Image</th>
                    <td>
                        <img src="{{ asset('storage/images/'.$userDetails->image) }}" alt="Post Image"
                             style="width: 150px; height: 150px; border: 2px solid #ddd; border-radius: 5px;">
                    </td>
                </tr>
                <tr>
                    <th>User Email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>{{ $userDetails->company }}</td>
                </tr>
                <tr>
                    <th>Job</th>
                    <td>{{ $userDetails->job }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $userDetails->country }}</td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>{{ $userDetails->address }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $userDetails->phone }}</td>
                </tr>
                <tr>
                    <th>Facebook</th>
                    <td>{{ $userDetails->Facebook }}</td>
                </tr>
                <tr>
                    <th>Twitter</th>
                    <td>{{ $userDetails->Twitter }}</td>
                </tr>
                <tr>
                    <th>LinkedIn</th>
                    <td>{{ $userDetails->LinkedIn }}</td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td>{{ $userDetails->Instagram }}</td>
                </tr>
                <tr>
                    <th>About</th>
                    <td>{{ $userDetails->about }}</td>
                </tr>






            <tr>

                <td>

                <form action="{{ route('admin.showUser',$user->id) }}" method="post" class=" d-inline">
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
