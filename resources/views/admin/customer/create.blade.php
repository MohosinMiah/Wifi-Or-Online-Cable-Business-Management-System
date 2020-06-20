@extends('admin.master')

@section('title')
Add New Customer
@endsection

@section('content')
  <div class="container">
    <table class="table table-responsive">
         <h3 class="text-center">Add New Customer</h3>

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
                <form class="well form-horizontal"  action="{{ route('customer_save')}}" method="POST"  enctype="multipart/form-data">
                  @csrf

                   <fieldset>

                      <div class="form-group">
                         <label class="col-md-4 control-label">Full Name (**) </label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="fullName" name="name" placeholder="Full Name" class="form-control" required="true" value="" type="text"></div>
                         </div>
                      </div>

                      <div class="form-group">
                        <label class="col-md-4 control-label">Reg. Date (**) </label>
                        <div class="col-md-8 inputGroupContainer">
                           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span><input class="form-control" id="reg_date" name="reg_date" placeholder="MM/DD/YYY" required="true" type="text"></div>
                        </div>
                     </div>

                     <div class="form-group">
                      <label class="col-md-4 control-label">ID Card (**)</label>
                      <div class="col-md-8 inputGroupContainer">
                         <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span><input id="id_card" name="id_card"  class="form-control" required="true" value="" type="file"></div>
                      </div>
                   </div>
                   <div class="form-group">
                      <label class="col-md-4 control-label">Phone Number (**)</label>
                      <div class="col-md-8 inputGroupContainer">
                       <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span><input id="phone" name="phone" placeholder="Phone Number " class="form-control" required="true" value="" type="text"></div>
                    </div>
                   </div>

                      <div class="form-group">
                         <label class="col-md-4 control-label">Address (**)</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="address" name="address" placeholder="Address Ex.House-10,Road-10,Sector-11,State-1222" class="form-control" required="true" value="" type="text"></div>
                         </div>
                      </div>
                 
                      <div class="form-group">
                         <label class="col-md-4 control-label">WiFi Plan (**)</label>
                         <div class="col-md-8 inputGroupContainer">
                          <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plane"></i></span><input id="wifi_plan" min="1" name="wifi_plan" placeholder="Wifi Plan (Ex.300 GP )" class="form-control" required="true" value="" type="number"></div>
                       </div>
                      </div>

                      <div class="form-group">
                          <label class="col-md-4 control-label">Monthly Bill (**)</label>
                          <div class="col-md-8 inputGroupContainer">
                           <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span><input id="monthly_bill" min="1" name="monthly_bill" placeholder="Monthly Bill (Ex. 2000 )" class="form-control" required="true" value="" type="number"></div>
                        </div>
                       </div>
                       <div class="form-group">
                          <label class="col-md-4 control-label">Payment Method (**)</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group">
                                <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                <select class="selectpicker form-control" name="payment_method">
                                    <option value="SPB">Shop Pay</option>
                                    <option value="BP">Bank Pay</option>
                                    <option value="PBP">Post Bank Pay</option>
                                    <option value="CP">Cash</option>
                      </select>
                             </div>
                          </div>
                       </div>
                      <div class="form-group">
                         <label class="col-md-4 control-label">Email</label>
                         <div class="col-md-8 inputGroupContainer">
                            <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span><input id="email" name="email" placeholder="Email" class="form-control"  value="" type="text"></div>
                         </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label">Agent Name</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input id="agent_name" name="agent_name" placeholder="Agent Name" class="form-control"  value="" type="text"></div>
                          </div>
                       </div>
                      <div class="form-group">
                          <label class="col-md-4 control-label">Billing Address</label>
                          <div class="col-md-8 inputGroupContainer">
                             <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span><input id="bill_address" name="bill_address" placeholder="Billing Address" class="form-control"  value="" type="text"></div>
                          </div>
                       </div>
                    <hr>
                    <h3>Options</h3>
                    <div class="form-group">
                        <label class="col-md-4 control-label">Router</label>
                        <div class="col-md-8 inputGroupContainer">
                           <div class="input-group">
                              <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                              <select class="selectpicker form-control" name="router_id">
                                    <option value="0">Select Ruter</option>
                                    @foreach ($routers as $router)
                                        
                                 
                                    <option value="{{ $router->id }}">Name : {{ $router->name }} and  Model : {{ $router->model }}</option>
                                    @endforeach
                    </select>
                           </div>
                        </div>
                     </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Notes</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span><textarea id="note" name="note" placeholder="Short Notes" class="form-control"  value="" ></textarea></div>
                            </div>
                         </div>
                         <div class="form-group">
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><input id="addCustomer" name="addCustomer" class="btn btn-primary" value="Add Customer" type="submit"></div>
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
