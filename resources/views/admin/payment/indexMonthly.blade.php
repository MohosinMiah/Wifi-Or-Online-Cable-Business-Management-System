@extends('admin.master')
@section('content')
<?php 
use App\Payment;

?>
    
  <div class="container">
    <div class="row">
          <div class="jumbotron">
              <h1 class="text-center text-info">Monthly Report</h1>
              <h2 class="text-center text-success ">Search Payment Based On Year , Month and Date </h2>
              <br>
              <hr>
              <br>
              <form class="well form-horizontal"  action="{{ route('monthly_report')}}" method="POST">
                @csrf
                 <fieldset>
                         <div class="form-group">
                               <label class="col-md-4 control-label"> Date (**) </label>
                               <div class="col-md-8 inputGroupContainer">
                                  <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input class="form-control" id="search" name="search" placeholder="YY/MM" required="true" type="text"></div>
                               </div>
                            </div>         
                       <div class="form-group">
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><input id="addMonthly" name="addMonthly" class="btn btn-primary" value="SEARCH" type="submit"></div>
                          </div>
                       </div>
                 </fieldset>
              </form>
          </div>
    </div>

    <div class="row">
            @if(!empty($search_date))
        <div class="jumbotron">
            <h2 class="text text-info">Result Display For  ::  {{ $search_date }}</h2>
        </div>
        @endif
        <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>Customer ID  </th>
                    <th>Full Name</th>
                    <th>Expaire Date</th>
                    <th>Payment Date(Y-M-D)</th>
                    <th>Payment Amount</th>
                    <th>Due</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                    
                    
                @if ($reports)
            @foreach ($reports as $report)
            
                <tr>
                        <th>{{ $report->cust_id}}</th>
                        <th>{{ $report->customer->name }}</th>
                        <th>{{ $report->expir_date }}</th>
                        <th>{{ $report->pay_date }}</th>
                        <th>
                                @switch($report->payment_method)
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


                        </th>
                    <th>{{ $report->due }}</th>
                    <th>
                           <?php 
                           switch($report->status){
                            case 1: 
                            echo "<p class='badge badge-success' style='background-color:green'>Active</p>";
                            break;
                            case 2: 
                            echo "<p class='badge badge-danger' style='background-color:red'>Due </p>";
                            break;  
                        }
                           
                           ?>

                    </th>

                </tr>
                @endforeach
                @endif
        </table>  
    </div>
  </div>
<script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
</script>
@endsection