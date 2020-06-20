@extends('admin.master')
@section('content')

    <?php  

    use App\Payment;
    use Carbon\Carbon;

    ?>
  <div class="container">
    <div class="row">
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Reg. No</th>
                    <th>Full Name</th>
                    <th>Phone</th>
                    <th>Payment Method</th>
                    <th>Wifi Plan</th>
                    <th>Monthly Bill</th>
                    <th>Register Date(Y-M-D) </th>
                    <th>Expaire Date</th>
                    <th>Payment Status</th>
                    @if (Auth::user()->roll == 3)
                        
                    
                    <th>Action </th>
                    @endif
                </tr>
            </thead>
            <tbody>
            
           @foreach ( $customers as $customer )
               
          
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>
                        @switch($customer->payment_method)
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
                    <td>{{ $customer->wifi_plan }} GB</td>
                    <td>{{ $customer->monthly_bill }}</td>
                    <td>{{ $customer->reg_date }}</td>
                    <td>
                        <?php  
                          $payment = Payment::orderBy('id','desc')->where('cust_id',$customer->id)->first();
                          if(!empty($payment)){
                              echo $payment['expir_date'];
  
                          }else{
                             echo  $customer->expaire_date;
                          }
                     ?>
                      </td>
  
                      <td>
                        <?php  
                          if(!empty($payment)){
                             // var_dump($payment['status']);
                               //die();
                              switch($payment['status']){
                                  case 1: 
                                  echo "<p class='badge badge-success' style='background-color:green'>Active</p>";
                                  break;
                                  case 2: 
                                  echo "<p class='badge badge-danger' style='background-color:red'>Due </p>";
                                  break;  
                              }
  
                          }else{
                            $mytime = Carbon::now();
                            $current_date =  date('Y-m-d', strtotime($mytime));
                            if($customer->expaire_date > $current_date){
                                echo "<p class='badge badge-success' style='background-color:green'>Active</p>";
                            }else{
                                echo "<p class='badge badge-danger' style='background-color:red'>Due </p>";
 
                            }
                          }
                     ?>
                      </td>
                     
                      @if (Auth::user()->roll == 3)

                    <td>
                            <a href="{{ route('customer_edit',$customer->id) }}"> <span class="glyphicon glyphicon-edit" title="Edit Customer"></span> </a>
                            || <a href="{{ route('customer_delete',$customer->id) }}" onclick="return confirm('Are You Sure To Delete !')"> <span class="glyphicon glyphicon-trash" title="Delete Customer"></span> </a>
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