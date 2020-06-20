@extends('admin.master')
@section('title')
Reports
@endsection
@section('content')

    <?php  

    use App\Analysis;
    use Carbon\Carbon;

    ?>
  <div class="container">
    <div class="row" style="border:2px solid green";>
      <h2 class="text text-center">General Info</h2>
      <hr>
      <div class="col-md-6" style="border:2px solid black;";>
        <h2 class="text text-center">Total Info</h2>
        <hr>
        <h3>Total Number Of Customer :  <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalCustomer']}}</strong> </h3>
        <h3>Total Number Of Payments :  <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalPayment']}}</strong></h3>
        <h3>Total Number Of  User:  <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalUser']}}</strong></h3>
       </div>
       <div class="col-md-6" style="border:2px solid black;";>
        <h3>About Routers</h3>
        <hr>
        <h3>Type Of Routers in Stock : <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalRouter']}}</strong></h3>
        <h3>Total Number Of Routers in Stock : <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalRouterStock'] - $data['toatalRouterSell'] }}</strong></h3>
        <h3>Total Number Of Routers in Sells: <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalRouterSell']}}</strong></h3>
       
       </div>
        </div>
        <br>
        <div class="row" style="border:2px solid green";>
          <h2 class="text text-center">Payment Info</h2>
          <hr>
          <hr>
          <div class="col-md-6" style="border:2px solid black;";>
            <h3>Total Number Of Payment : <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalPayment']}}</strong></h3>
            <h3>Total Amount Of Transition : <span class="glyphicon glyphicon-hand-right"></span>  <strong>{{$data['toatalPaymentAmount']}} TK</strong></h3> 
           </div>
           <div class="col-md-6" style="border:2px solid black;";>
            <h3>Search Transition Based On Month</h3>
            <hr>
            <form class="well form-horizontal"  action="{{ route('analysis_monthly_transcition')}}" method="POST">
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

            <h3 class="text text-center text-success">Search Result :  <span class="glyphicon glyphicon-hand-right"></span>  <strong>
              @if ($transcition_amont != null)
                  
                  {{ $transcition_amont }}
              @endif
            </strong></h3>
           </div>
            </div>
            <div class="row">
              <div class="row">
                <div class="jumbotron">
                  <h2>Search Customer Details  By Register ID# </h2>
                  <form action="{{ route('search') }}" method="GET">
                      <input type="number" min="1" name="search_customer" required="true" placeholder="Seach By ID Ex. 22">
                      <input type="submit" value="Search By ID">
     
                  </form>
                </div>
     
     
         </div>
            </div>
  </div>

@endsection