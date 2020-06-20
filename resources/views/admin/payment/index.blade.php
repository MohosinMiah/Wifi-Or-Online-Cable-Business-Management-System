@extends('admin.master')
@section('content')
@section('title')
Payments
@endsection
    
  <div class="container">
      
    @if (Session::has('message'))
    <h2 class="alert alert-info" style="color: #28a745;">{!! session('message') !!}</h2>
@endif
      @if ( count( $errors ) > 0 )      
            @foreach ($errors->all() as $error)
        <h3  class="alert alert-danger" style="color:red">{{ $error }}</h3>
        @endforeach
        @endif
    <div class="row">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Full Name</th>
                    <th>Wifi Plan</th>
                    <th>Payment Method</th>
                    <th>Payment Date(Y-M-D)</th>
                    <th>Payment Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
           @foreach ( $payments as $payment )
               
          
                <tr>
                    <td>{{ $payment->id }}</td>
                    <td>{{ $payment->customer->name  }}</td>
                    <td>{{ $payment->customer->wifi_plan }} GB</td>
                    <td>
                        @switch($payment->payment_method)
                            @case("SPB")
                                {{ "Shop Pay" }}
                                @break
                           @case("BP")
                           {{ "Bank Pay" }}
                                @break 
                           @case("PBP")
                           {{ "Post Bank Pay" }}

                                @break  
                          @case("CP")
                          {{ "Cash Pay" }}

                                @break
                            @default
                                
                        @endswitch
                    </td>
                    <td>{{ date('Y-M-d', strtotime($payment->created_at)) }}</td>
                    <td>{{ $payment->pay_amount }}</td>
                    <td>
                        <a href="{{ route('payment_edit',$payment->id) }}"> <span class="glyphicon glyphicon-edit" title="Edit Customer"></span> </a>
                        || <a href="{{ route('payment_delete',$payment->id) }}" onclick="return confirm('Are You Sure To Delete !')"> <span class="glyphicon glyphicon-trash" title="Delete Customer"></span> </a>
                </td>
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