{{-- @extends('layouts/admin-layout')
 --}}
 @extends('layouts.admin-layout')
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
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Is Admin</th>

            </tr>
            </thead>
            <tbody>



            @foreach ($users as $user )
            <tr>

                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if ($user->role == 1)
                <td>Admin</td>
                @else
                <td>User</td>
                @endif


                <td>
                <a href="{{ route('admin.showUser',$user->id) }}" class="btn btn-success">Show</a>
                {{-- <a href="{{ route('admin.SwitchToAdmin',$user->id) }}" class="btn btn-primary">Switch to admin</a> --}}
                @if ($user->role == 0)

                <form action="{{ route('admin.SwitchToAdmin', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Switch to admin</button>
                </form>
                @else

                <form action="{{ route('admin.SwitchToUser', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Switch to user</button>
                </form>
                @endif


                <form action="{{ route('admin.deleteUser',$user->id) }}" method="post" class=" d-inline">
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
