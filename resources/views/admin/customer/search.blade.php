@extends('admin.master')
@section('content')
<?php 
use App\Payment;
?>
    
  <div class="container">
    <div class="row">
           <div class="jumbotron">
             <h2>Search Customer By Register ID# </h2>
             <form action="{{ route('search') }}" method="GET">
                 <input type="number" min="1" name="search_customer" required="true" placeholder="Seach By ID Ex. 22">
                 <input type="submit" value="Search By ID">

             </form>
           </div>


    </div>

    <div class="row">
        <div class="jumbotron">
          @if($customer)
          <h2>Search Result For -  {{ $customer->name }} . Register ID -  {{ $customer->id }} </h2>
          <hr>
          <h3> Full Name    : {{ $customer->name }} </h3>
          <hr>
          <h3> Register ID    : {{ $customer->id }} </h3>
          <hr>
          <h3> Wifi Plan   : {{ $customer->wifi_plan }} </h3>
          <hr>
          <h3> Monthly Bill   : {{ $customer->monthly_bill }} </h3>
          <hr>
          <h3> Payment Method  : 
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
          </h3>
          <hr>
          <h3> Monthly Bill   : {{ $customer->monthly_bill }} </h3>
          <hr>

          <h3> Register Date    : {{ $customer->reg_date }} </h3>
          <hr>

          <h3> Expaire  Date    : 
            <?php 
            
             $expaire = Payment::where('cust_id',$customer->id)->orderBy('id','DESC')->first();
                 if($expaire){
echo $expaire->expir_date;
                 }else{
                echo  $customer->expaire_date;
                 }
            ?>
         
          </h3>
          <hr>

          <h3> ID CARD   : <img src="/images/{{ $customer->id_card }}" alt="ID CARD"  width="500" height="200"> </h3>
          <hr>

          <h3> Phone   : {{ $customer->phone }} </h3>
          <hr>

          <h3> Address   : {{ $customer->address }} </h3>
          <hr>

          <h3> Email   : {{ $customer->email }} </h3>
          <hr>

          <h3> Agent Name   : {{ $customer->agent_name }} </h3>
          <hr>



          <h3> Billing Address   : {{ $customer->bill_address }} </h3>
          <hr>

          <h3> Router ID    : {{ $customer->router_id }} </h3>
          <hr>

          <h3> Short Note   : {{ $customer->note }} </h3>
          <hr>

          <h3> Payment History </h3>
          @foreach ($payments as $payment)
              <h4>{{ $payment->pay_date }}</h4>
          @endforeach
         
          <hr>
 
  @else
      
  <h2>No Data Is Available .Please Try Again</h2>
  @endif
        
        </div>
 </div>

  </div>

@endsection