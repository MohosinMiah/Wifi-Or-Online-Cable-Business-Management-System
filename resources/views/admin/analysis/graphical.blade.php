@extends('admin.master')
@section('title')
Graphical Reports
@endsection
@section('content')

    <?php  

    use App\Analysis;
    use Carbon\Carbon;

    ?>
 
    <div class="container">
         {{--  Graphical Reports For Customers  --}}
        <div class="row justify-content-center" style="padding-bottom:5px;">
            <h1 class="jumbotron text-center"> Graphical Reports For Customers</h1>
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['bar_customer']->options['chart_title'] }}</h1>
                        {!! $data['bar_customer']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['pie_customer']->options['chart_title'] }}</h1>
                        {!! $data['pie_customer']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
        </div>

 {{--  Graphical Reports For Payments  --}}
        <div class="row justify-content-center" style="padding-bottom:5px;">
            <h1 class="jumbotron text-center"> Graphical Reports For Payments</h1>
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['bar_payment']->options['chart_title'] }}</h1>
                        {!! $data['bar_payment']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['pie_payment']->options['chart_title'] }}</h1>
                        {!! $data['pie_payment']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
        </div>
        {{--  Graphical Reports For User and Router  --}}
        <div class="row justify-content-center" style="padding-bottom:5px;">
            <h1 class="jumbotron text-center"> Graphical Reports For Routers</h1>
            <div class="col-md-6" >
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['pie_router_number']->options['chart_title'] }}</h1>
                        {!! $data['pie_router_number']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1>{{ $data['pie_router_sell']->options['chart_title'] }}</h1>
                        {!! $data['pie_router_sell']->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
    </div>

    @endsection
    
    @section('javascript')
    {{--  Customers   --}}
    {!! $data['bar_customer']->renderChartJsLibrary() !!}
    {!! $data['bar_customer']->renderJs() !!}

    {!! $data['pie_customer']->renderChartJsLibrary() !!}
    {!! $data['pie_customer']->renderJs() !!}

    {{--  Payments  --}}
    {!! $data['bar_payment']->renderChartJsLibrary() !!}
    {!! $data['bar_payment']->renderJs() !!}

    {!! $data['pie_payment']->renderChartJsLibrary() !!}
    {!! $data['pie_payment']->renderJs() !!}

    {{--  Router Stock Number by month   --}}
    {!! $data['pie_router_number']->renderChartJsLibrary() !!}
    {!! $data['pie_router_number']->renderJs() !!}

    {{--  Router Sell by month  --}}
    {!! $data['pie_router_sell']->renderChartJsLibrary() !!}
    {!! $data['pie_router_sell']->renderJs() !!}

    @endsection
    