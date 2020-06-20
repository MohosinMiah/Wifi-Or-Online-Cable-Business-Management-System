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
          <h2>Send SMS To All Customer </h2>
          <hr>
          <h3>Step - 1 : Download All User Phone Number : <a href="{{ route('download_all') }}">Download</a></h3>
          <h3>Step - 2 :   Login Dashboard  and Upload CSV File : <a href="http://login.bulksmsbd.com/admin.php" target="__blank">Login</a></h3>
          
            
 </div>

  </div>

@endsection