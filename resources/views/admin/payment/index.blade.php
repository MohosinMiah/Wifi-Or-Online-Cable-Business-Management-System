@extends('admin.master')
@section('content')

    
  <div class="container">
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
                    <th>Due</th>
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
                    <td>{{ date('Y-M-d', strtotime($payment->pay_date)) }}</td>
                    <td>{{ $payment->pay_amount }}</td>
                    <td>{{ $payment->due }}</td>
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