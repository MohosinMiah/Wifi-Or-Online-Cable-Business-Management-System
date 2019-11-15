@extends('admin.master')

@section('title')
Add New Customer
@endsection

@section('content')
  <div class="container">
    <table class="table table-responsive">
         <h3 class="text-center">Update Customer</h3>

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
                <form class="well form-horizontal"  action="{{ route('customer_update',$customer->id)}}" method="POST"  enctype="multipart/form-data">
                  @csrf

                   <fieldset>

                      <div class="form-group">
                         <label class="col-md-4 control-label">Full Name (**) </label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName"  name="name" placeholder="Full Name" class="form-control" required="true" value="{{ $customer->name }}" type="text"></div>
                         </div>
                      </div>


                     <div class="form-group">
                      <label class="col-md-4 control-label">ID Card (**)</label>
                      <div class="col-md-8 inputGroupContainer">
                         <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span><input id="id_card" name="id_card"  class="form-control"   type="file">
                     
                           <img src="/images/{{ $customer->id_card }}" alt="ID Card" width="300" height="120">

                        </div>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-4 control-label">Phone Number (**)</label>
                      <div class="col-md-8 inputGroupContainer">
                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phone" name="phone" placeholder="Phone Number " class="form-control" required="true" value="{{ $customer->phone }}" type="text"></div>
                    </div>
                   </div>

                      <div class="form-group">
                         <label class="col-md-4 control-label">Address (**)</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="address" name="address" placeholder="Address Ex.House-10,Road-10,Sector-11,State-1222" class="form-control" required="true" value="{{ $customer->address }}" type="text"></div>
                         </div>
                      </div>
                 
                      <div class="form-group">
                         <label class="col-md-4 control-label">WiFi Plan (**)</label>
                         <div class="col-md-8 inputGroupContainer">
                          <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plane"></i></span><input id="wifi_plan" min="1" name="wifi_plan" placeholder="Wifi Plan (Ex.300 GP )" class="form-control" required="true" value="{{ $customer->wifi_plan }}" type="number"></div>
                       </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Monthly Bill (**)</label>
                          <div class="col-md-8 inputGroupContainer">
                           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span><input id="monthly_bill" min="1" name="monthly_bill" placeholder="Monthly Bill (Ex. 2000 )" class="form-control" required="true" value="{{ $customer->monthly_bill }}" type="number"></div>
                        </div>
                       </div>
                       <div class="form-group">
                          <label class="col-md-4 control-label">Payment Method (**)</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group">
                                <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                <select class="selectpicker form-control" name="payment_method">
                                    <option <?php if($customer->payment_method == "SPB"){ echo "selected";} ?>  value="SPB">Shop Pay</option>
                                    <option <?php if($customer->payment_method == "BP"){ echo "selected";} ?>  value="BP">Bank Pay</option>
                                    <option <?php if($customer->payment_method == "PBP"){ echo "selected";} ?>  value="PBP">Post Bank Pay</option>
                                    <option <?php if($customer->payment_method == "CP"){ echo "selected";} ?>  value="CP">Cash</option>
                      </select>
                             </div>
                          </div>
                       </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Email</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control"  value="{{ $customer->email }}" type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label">Agent Name</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="agent_name" name="agent_name" placeholder="Agent Name" class="form-control"  value="{{ $customer->agent_name }}" type="text"></div>
                          </div>
                       </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label">Billing Address</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="bill_address" name="bill_address" placeholder="Billing Address" class="form-control"  value="{{ $customer->bill_address }}" type="text"></div>
                          </div>
                       </div>
                    <hr>
                    <h3>Options</h3>
                
                        <div class="form-group">
                            <label class="col-md-4 control-label">Notes</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span><textarea id="note" name="note" placeholder="Short Notes" class="form-control"  >
                                    {{ $customer->note }}</textarea></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><input id="addCustomer" name="addCustomer" class="btn btn-primary" value="Update Customer" type="submit"></div>
                            </div>
                         </div>
                   </fieldset>
                </form>
             </td>
          </tr>
       </tbody>
    </table>
 </div>

  @endsection
