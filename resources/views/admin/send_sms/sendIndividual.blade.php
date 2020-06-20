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
            
       <div class="row">
        <div class="jumbotron">
          <h2>Send SMS To The Customer </h2>
          @if (Session::has('message'))
          <h2 class="alert alert-info" style="color: #28a745;">{!! session('message') !!}</h2>
     @endif
            @if ( count( $errors ) > 0 )      
                  @foreach ($errors->all() as $error)
              <h3  class="alert alert-danger" style="color:red">{{ $error }}</h3>
              @endforeach
              @endif
          <hr>
          <form action="{{ route('sms_individual_send') }}" method="POST">
          @csrf
<fieldset>
                        <div class="form-group">
                              <label class="col-md-4 control-label">Select Customer (**)</label>
                              <div class="col-md-8 inputGroupContainer">
                                 <div class="input-group">
                                    <span class="input-group-addon" style="max-width: 100%;"><i class="glyphicon glyphicon-list"></i></span>
                                    <select class="selectpicker form-control" id="customer_id" name="cust_id" required="true">
                                          <option value="">Select Customer</option>
                                          @foreach ($customers as $customer)
                                          <option value="{{ $customer->id }}">Reg :{{ $customer->id}} - Full Name : {{ $customer->name }}</option>
                                          @endforeach
                                      </select>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <br>
                           <br>
                           <div class="form-group">
                            <label class="col-md-4 control-label">Message</label>
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-file"></i></span><textarea id="message" name="message" placeholder="Short Notes" class="form-control" required=true></textarea></div>
                            <br>
                              </div>
                         </div>
                
                             
               
                         <div class="form-group">
                            <div class="col-md-8 inputGroupContainer">
                               <div class="input-group"><input id="sendSMS" name="sendSMS" class="btn btn-primary" value="Send SMS" type="submit"></div>
                            </div>
                         </div>
                   </fieldset>
          </form>
        </div>


 </div>

  </div>

@endsection