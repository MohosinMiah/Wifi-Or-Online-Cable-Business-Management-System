<?php

namespace App\Http\Controllers;

use App\Analysis;
use App\Payment;
use App\Customer;
use App\Roter;
use App\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class AnalysisController extends Controller
{
    /**
     * Display a numeric reports
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data =  $this->analysis();
        $transcition_amont = null;
        return view("admin.analysis.index",compact('data','transcition_amont'));
    }


    /**
     * Display a graphical_reports
     *
     * @return \Illuminate\Http\Response
     */
    public function graphical_reports()
    {
        // Bar Chart for Customers
        $chart_options_bar_customer = [
            'chart_title' => 'Customer by Months Bar Chart',
            'report_type' => 'group_by_date',
            'model' => 'App\Customer',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        // Pie Chart  for Customers
        $chart_options_pie_customer = [
            'chart_title' => 'Customer by Months Pie Chart',
            'report_type' => 'group_by_date',
            'model' => 'App\Customer',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];

        // Bar Chart for Payments
        $chart_options_bar_payment = [
            'chart_title' => 'Number Of Payment By Months',
            'report_type' => 'group_by_date',
            'model' => 'App\Payment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        // Pie Chart  for Payments
        $chart_options_pie_payment = [
            'chart_title' => 'Amount Of Payment by Months',
            'report_type' => 'group_by_date',
            'model' => 'App\Payment',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'pay_amount',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];


        // Pie Chart  for Router Stock
        $chart_options_pie_router_number = [
            'chart_title' => 'Number Of Router Stocked ',
            'report_type' => 'group_by_date',
            'model' => 'App\Roter',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'qty',
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];


        // Pie Chart  for Number Of Router Sell
        $chart_options_pie_router_sell = [
            'chart_title' => 'Number Of Router Sell ',
            'report_type' => 'group_by_date',
            'model' => 'App\Roter',
            'group_by_field' => 'created_at',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'sell',
            // 'aggregate_transform' => function($value) {
            //     return $value;
            // },
            'group_by_period' => 'month',
            'chart_type' => 'pie',
        ];

        
      // Charts For Customers
      $bar_customer = new LaravelChart($chart_options_bar_customer);
      $pie_customer = new LaravelChart($chart_options_pie_customer);

      // Charts For Payments
      $bar_payment = new LaravelChart($chart_options_bar_payment);
      $pie_payment = new LaravelChart($chart_options_pie_payment);
    
      // Charts For Router
      $pie_router_number= new LaravelChart($chart_options_pie_router_number);
      $pie_router_sell = new LaravelChart($chart_options_pie_router_sell);
    
      $data = array(
        'bar_customer' => $bar_customer,
        'pie_customer' => $pie_customer,
        'bar_payment' => $bar_payment,
        'pie_payment' => $pie_payment,   
        'pie_router_number' => $pie_router_number,
        'pie_router_sell' => $pie_router_sell,
          
      );

        return view("admin.analysis.graphical", compact('data'));
    }

 /**
     *   Monthly Transcition
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly_report(Request $request){

        /**
            *  Data  Validation.....
            */
           $v = Validator::make($request->all(), [
               'search' => 'required',
             
           ]);
     /**
            * Check Data is Valid or Not
            */
           if ($v->fails()) {
        
               \Session::flash('message', 'Please check error messages ....... ');
               return redirect()->back()->withInput()->withErrors($v);
           }else{
               $search_date = $request->search;
           //    return  $search_date;
               $transcition_amont =  Payment::where('report_date', $search_date)->sum('pay_amount');
               if(empty($transcition_amont)){
                $transcition_amont = "No Transcition Found !";
               }
           
           }

           $data =  $this->analysis();
       
   
   //  return response()->json($reports);
   
   return view('admin.analysis.index',compact('data','transcition_amont'));
   }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function show(Analysis $analysis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function edit(Analysis $analysis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analysis $analysis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Analysis  $analysis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Analysis $analysis)
    {
        //
    }

    
    public function analysis(){
        // Total Summery 
        $toatalCustomer = Customer::count();  // Total Number Of Customer
        $toatalRouter = Roter::count();      // Total Number of Router
        $toatalRouterStock = Roter::sum('qty');
        $toatalRouterSell = Roter::sum('sell');
        $toatalPayment = Payment::count();   // Total Number of Payment
        $toatalPaymentAmount = Payment::sum('pay_amount');   //
        $toatalUser = User::count();   // Total Number of User
        
        
        /*
      Test Data
        var_dump($toatalRouterStock);
        die(); 
        */

     $data = array(
         'toatalCustomer' => $toatalCustomer ,
         'toatalRouter' => $toatalRouter,
         'toatalRouterStock' => $toatalRouterStock,
         'toatalRouterSell' => $toatalRouterSell,
         'toatalPayment' => $toatalPayment,
         'toatalPaymentAmount' => $toatalPaymentAmount,
         'toatalUser' => $toatalUser,

        );
        return $data;
 }
}
