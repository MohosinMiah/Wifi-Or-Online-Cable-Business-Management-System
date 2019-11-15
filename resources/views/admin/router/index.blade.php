@extends('admin.master')
@section('content')

    
  <div class="container">
    <div class="row">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID #</th>
                    <th>Name</th>
                    <th>Model</th>
                    <th>Price</th>
                    <th>Total QTY</th>
                    <th>Left QTY</th>
                    <th>Sell QTY</th>
                    <th>Added Date(Y-M-D)</th>
                    <th>Picture</th>
                    @if (Auth::user()->roll == 3)

                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
            
           @foreach ( $routers as $router )
               
          
                <tr>
                        <td>{{ $router->id }}</td>
                        <td>{{ $router->name }}</td>
                        <td>{{ $router->model }}</td>
                        <td>{{ $router->price }}</td>
                        <td>{{ $router->qty }}</td>
                        <td>{{ $router->qty - $router->sell }}</td>
                        <td>{{ $router->sell }}</td>
                    <td>{{ date('Y-M-d', strtotime($router->created_at)) }}</td>
                    <td><img src="/images/{{$router->picture}}" alt="" width="80" height="60"></td>
                    @if (Auth::user()->roll == 3)

                    <td>
                            <a href="{{ route('router_edit',$router->id) }}"> <span class="glyphicon glyphicon-edit" title="Edit Router"></span> </a>
                            || <a href="{{ route('router_delete',$router->id) }}" onclick="return confirm('Are You Sure To Delete !')"> <span class="glyphicon glyphicon-trash" title="Delete Router"></span> </a>
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