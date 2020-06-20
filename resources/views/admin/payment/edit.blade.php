@extends('admin.master')

@section('title')
Edit Registered Payment
@endsection

@section('content')
  <div class="container">
    <table class="table table-responsive">
       <h3 class="text-center">Edit Registered Payment</h3>
         @if (Session::has('message'))
         <h2 class="alert alert-info" style="color: #28a745;">{!! session('message') !!}</h2>
    @endif
           @if ( count( $errors ) > 0 )      
                 @foreach ($errors->all() as $error)
             <h3  class="alert alert-danger" style="color:red">{{ $error }}</h3>
             @endforeach
             @endif
       <tbody>
          <tr>
             <td colspan="1">
                <form class="well form-horizontal"  action="{{ route('payment_update')}}" method="POST">
                  @csrf

                   <fieldset>
                        <div class="form-group">
                              <label class="col-md-4 control-label"> Customer Name </label>
                              <div class="col-md-8 inputGroupContainer">
                                 <div class="input-group">
                                  <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class="form-control" readonly value="{{ $payment->customer['name'] }}" required="true"  type="text"></div>
                                
                                    <input type="hidden" name="id" value="{{$payment->id}}">
                                    <input type="hidden" name="cust_id" value="{{$payment->cust_id}}">

                                 </div>                                
                                 </div>
                              </div>
                           </div>

                           <div class="form-group">
                                 <label class="col-md-4 control-label">Payment  Last  Date (**) </label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input readonly class="form-control" id="pay_date" value="{{$payment->pay_date}}" name="pay_date" placeholder="MM/DD/YYY" required="true" type="text"></div>
                                 </div>
                              </div>         

                              <div class="form-group">
                                    <label class="col-md-4 control-label"> Payment Amount (**)</label>
                                    <div class="col-md-8 inputGroupContainer">
                                     <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span><input id="pay_amount" min="1" name="pay_amount"  value="{{$payment->pay_amount}}" class="form-control" required="true"  type="number"></div>
                                  </div>
                                 </div>

                              <div class="form-group">
                                    <label class="col-md-4 control-label">Payment Method (**)</label>
                                    <div class="col-md-8 inputGroupContainer">
                                       <div class="input-group">
                                          <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                          <select class="selectpicker form-control" name="payment_method">
                                          
                                          
                                            
                                             <option value="SPB" @if ($payment->payment_method == "SPB")
                                                 {{ "selected" }}
                                             @endif>Shop Pay</option>
                                           
                                          <option value="BP"
                                          @if ($payment->payment_method == "BP")
                                                 {{ "selected" }}
                                             @endif
                                          >Bank Pay</option>

                                               
                                        
                                           <option value="PBP"
                                           @if ($payment->payment_method == "PBP")
                                                 {{ "selected" }}
                                             @endif
                                           >Post Bank Pay</option>
                 
                                             
                                     
                                       <option value="CP"
                                       @if ($payment->payment_method == "CP")
                                                 {{ "selected" }}
                                             @endif
                                       >Cash</option>
                 
                                             
                                                 
                                       
                                  </select>
                                       </div>
                                    </div>
                                 </div>

                                 <div class="form-group">
                                       <label class="col-md-4 control-label">Payment Status (**)</label>
                                       <div class="col-md-8 inputGroupContainer">
                                          <div class="input-group">
                                             <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                             <select class="selectpicker form-control" name="status" required="false">
                                                   <option value="1"
                                                   @if ($payment->status == "1")
                                                   {{ "selected" }}
                                               @endif
                                                   >Success</option>
                                                   <option value="2"
                                                   @if ($payment->status == "2")
                                                   {{ "selected" }}
                                               @endif
                                                   >Due</option>
                                              
                                   </select>
                                          </div>
                                       </div>
                                    </div>
               
                        <div class="form-group">
                            <label class="col-md-4 control-label">Notes</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span><textarea id="note" name="note" value="" class="form-control"  >{{$payment->note}}</textarea></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><input id="addPayment" name="addPayment" class="btn btn-primary" value="Update Payment" type="submit"></div>

                              </div>
                         </div>
                   </fieldset>
                </form>
             </td>
          </tr>
       </tbody>
    </table>
 </div>

 
 <script>
   $(document).ready(function() {
      $('#customer_payent').change(function() {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
  
         // var id =($(this).attr("data-id"));
         var id = document.getElementById("customer_payent").value;

          $.ajax({
               type:"GET",
               url:"/admin/payment/cust/"+id,
               success : function(results) {
                 if(results != "NULL"){
                  document.getElementById("pay_amount").value = results.payment_amount;
                  document.getElementById("pay_date").value = results.payment_date;
                  
                 }else{
                  document.getElementById("pay_amount").value = '';

                 }
                   console.log(results);
               }
          }); 
      });
  });  
 </script>

  @endsection
