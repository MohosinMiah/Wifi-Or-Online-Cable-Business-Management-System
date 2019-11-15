@extends('admin.master')

@section('title')
Add New Payment
@endsection

@section('content')
  <div class="container">
    <table class="table table-responsive">
       <h3 class="text-center">Add New Router</h3>
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
                <form class="well form-horizontal"  action="{{ route('router_save')}}" method="POST" enctype="multipart/form-data">
                  @csrf

                   <fieldset>
                   

                        <div class="form-group">
                              <label class="col-md-4 control-label">Router Name (**)</label>
                              <div class="col-md-8 inputGroupContainer">
                                 <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-text-width"></i></span><input class="form-control" id="name" name="name" placeholder="Enter Router Name" required="true" type="text"></div>
                              </div>
                           </div>         

                           <div class="form-group">
                                 <label class="col-md-4 control-label">Router Model  </label>
                                 <div class="col-md-8 inputGroupContainer">
                                    <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-text-width"></i></span><input class="form-control" id="model" name="model" placeholder="Enter Router model"  type="text"></div>
                                 </div>
                              </div>         

                              <div class="form-group">
                                    <label class="col-md-4 control-label"> Router Price (**)</label>
                                    <div class="col-md-8 inputGroupContainer">
                                     <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span><input id="price" min="1" name="price"  class="form-control" required="true"  type="number"></div>
                                  </div>
                                 </div>    

                                 <div class="form-group">
                                       <label class="col-md-4 control-label"> Router Qty (**)</label>
                                       <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-plus"></i></span><input id="qty" min="1" name="qty"  class="form-control" required="true"  type="number"></div>
                                     </div>
                                    </div>    
                                    
                                 
                              <div class="form-group">
                                       <label class="col-md-4 control-label"> Router Picture </label>
                                       <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group"><span class="input-group-addon"><i class="glyphicon glyphicon-upload"></i></span><input id="picture"  name="picture"  class="form-control"   type="file"></div>
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
                               <div class="input-group"><input id="addRouter" name="addRouter" class="btn btn-primary" value="Add Router" type="submit"></div>
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
