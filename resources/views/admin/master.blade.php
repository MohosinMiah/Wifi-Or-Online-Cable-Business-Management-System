<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

{{--  Css   --}}
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
{{-- <!-- Bootstrap Date-Picker Plugin --> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

{{--  For data table   --}}
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">


{{--  Scripts   --}}
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>



  
</head>
<body>
<br>
<div class="container">
      <div class="row">
            <nav class="navbar navbar-inverse">
                  <div class="container-fluid">
                    <div class="navbar-header">
                      <a class="navbar-brand" href="{{ route('customer_create') }}">Dashboard</a>
                    </div>
                    <ul class="nav navbar-nav">
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Customer Settings<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('customer_create') }}">Add New Customer</a></li>
                          <li><a href="{{ route('customer_list') }}">Customer List</a></li>
                          <li><a href="{{ route('search_customer') }}">Search Customer</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Payment Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('payment_create') }}">Register  New Payment</a></li>
                          <li><a href="{{ route('payment_monthly') }}">Monthly Payment Report</a></li>
                          <li><a href="{{ route('payment_list') }}">All Payment History</a></li>
                        </ul>
                      </li>
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Router Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('router_create') }}">Add New Router</a></li>
                          <li><a href="{{ route('router_list') }}">Router List</a></li>
                        </ul>
                      </li>

                      @if (Auth::user()->roll == 3)
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">Analysis Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('analysis_index') }}">Reports</a></li>
                          <li><a href="{{ route('analysis_graphical') }}">Graphical Reports</a></li>
                        </ul>
                      </li>
                      @endif 


                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">SMS Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="{{ route('sms_individual') }}">Send SMS Individual User</a></li>
                          <li><a href="{{ route('send_sms_all') }}">Send SMS All User</a></li>
                        </ul>
                      </li>

                      @if (Auth::user()->roll == 3)
                          
                      
                      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown">User Settings <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="/register">Add New User</a></li>
                          <li><a href="{{ route('user_list') }}">User List</a></li>
                        </ul>
                      </li>
                      
                      @endif 
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                  </div>
                </nav>
      </div>
  </div>


    @yield('content')

    <script>
      $(document).ready(function(){
        var date_input=$('input[name="reg_date"]'); //our date input has the name "date"
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
          format: 'yyyy-mm-dd',
          container: container,
          todayHighlight: true,
          autoclose: true,
        };
        date_input.datepicker(options);

        var date_input2=$('input[name="pay_date"]'); //our date input has the name "date"
        var container2=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options2={
          format: 'yyyy-mm-dd',
          container: container2,
          todayHighlight: true,
          autoclose: true,
        };
        date_input2.datepicker(options2);

        
        var date_input3=$('input[name="search"]'); //our date input has the name "date"
        var container3=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options3={
          format: 'yyyy-mm',
          container: container3,
          todayHighlight: true,
          autoclose: true,
        };
        date_input3.datepicker(options3);

        
      })
  </script>
  @yield('javascript')

</body>
</html>
