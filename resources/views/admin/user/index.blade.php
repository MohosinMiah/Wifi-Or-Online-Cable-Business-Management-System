@extends('admin.master')
@section('content')

    
  <div class="container">
    <div class="row">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID </th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Roll</th>
                    @if (Auth::user()->roll == 3)
                    
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            
           @foreach ( $users as $user )
               
          
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>@if($user->roll == 2) {{ "Staf" }} @else {{ "Admin" }} @endif</td>
               
                    @if (Auth::user()->roll == 3)

                    <td>
                            <a href="{{ route('user_delete',$user->id) }}" onclick="return confirm('Are You Sure To Delete !')"> @if ($user->roll == 3) @else <span class="glyphicon glyphicon-trash" title="Delete Router"></span> @endif </a>
                    </td>
                    @endif
                </tr>

                @endforeach
            </tfoot>
        </table>    

    </div>
  </div>
<script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
</script>
@endsection