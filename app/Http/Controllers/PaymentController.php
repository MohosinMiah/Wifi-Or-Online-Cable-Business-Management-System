<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Customer;
use App\Payment;
use Illuminate\View\View;
use DateTime;
use DatePeriod;
use DateInterval;
use Illuminate\Support\Arr;
use Response;

class PaymentController extends Controller
{

    private $table ='payments';


   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
        $this->middleware('auth');
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::with('customer')->get();
    //     return  $payments;
    //     foreach ( $payments as $payment ) {

    //    echo $payment->customer->name;

    // }
    // die();
    

        return view('admin.payment.index',compact('payments'));
    }



    public function add_months($months, DateTime $dateObject) 
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

    public function endCycle($d1, $months)
    {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add($this->add_months($months, $date));

        // goes back 1 day from date, remove if you want same day of month
        $newDate->sub(new DateInterval('P1D')); 

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }


public function  monthly_payment(){                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       

    $reports = Payment::with('customer')->orderBy('id', 'DESC')->get();
    //     foreach ( $payments as $payment ) {
               
    //        echo $payment->customer->reg_date;
    //        echo "<br>";
    //        echo date('Y-m-d', strtotime($payment->customer->reg_date));
    //        echo "<br>";
    //        $nMonths = 1; // choose how many months you want to move ahead
    //        $final = $this->endCycle($payment->customer->reg_date, $nMonths); // output: 2014-07-02
    //        echo $final;

    //        echo "<br>";

         
    //     var_dump($payment->customer->reg_date );
        // die();

    // }
    $reports = null;
        return view('admin.payment.indexMonthly',compact('reports'));

}


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
            $reports =  Payment::with('customer')->where('report_date', $search_date)->get();
        
        }
      
    

//  return response()->json($reports);

return view('admin.payment.indexMonthly',compact('reports','search_date'));
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();

        return view("admin.payment.create",compact('customers'));
    }

    public function customerandpaymentajax($id) {

        if(empty($id)){
            return Response::json("NULL");
        }
        $payment = Payment::orderBy('id','desc')->where('cust_id',$id)->first();
        $customer = Customer::select('*')->where('id',$id)->first();  

        $nMonths = 1; // choose how many months you want to move ahead

        if(!empty($payment)){
            // $payment_date = $this->endCycle($payment->expir_date, $nMonths);
            $payment_date = $payment->expir_date;

        }else{
            $payment_date = $customer->expaire_date;
        }


        $payment_amount = $customer->monthly_bill;

        $expaire_date = $this->endCycle($payment_date, $nMonths);
       
        $data  = array(       
            'payment_date' => $payment_date,       
            'payment_amount' => $payment_amount,   
            'expaire_date' => $expaire_date,    
          );

    
        return Response::json($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        /**
         *  Data  Validation.....
         */
        $v = Validator::make($request->all(), [
            'cust_id' => 'required',
            'pay_date' => 'required',
            'pay_amount' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
          
        ]);
        /**
         * Get Data From User Input
         */
        $cust_id = $request->input('cust_id');
        $findDueAmount = Customer::where('id',$cust_id)->first();

        // return  $findDueAmount->monthly_bill;

        // var_dump($findDueAmount['monthly_bill']);

        // die();

        $staf_id = 1;
        $pay_date = $request->input('pay_date');
        $pay_amount = $request->input('pay_amount');
        $payment_method = $request->input('payment_method');
        $status = $request->input('status');
        $note = $request->input('note');
        $expaire_date = $nMonths = 1; // choose how many months you want to move ahead
        $final = $this->endCycle($pay_date, $nMonths);
        if($pay_amount < $findDueAmount->monthly_bill ){
            \Session::flash('message', 'Payment Amount Is Less then Monthly Bill . It should be equal  ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        }elseif($pay_amount > $findDueAmount->monthly_bill ){
            \Session::flash('message', 'Payment Amount Is greater then Monthly Bill . It should be equal  ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        }else{
            $due =  $findDueAmount->monthly_bill - $pay_amount;

        }
        $report_date = date('Y-m',strtotime($pay_date));

        /**
         * Check Data is Valid or Not
         */
        if ($v->fails()) {
     
            \Session::flash('message', 'Fail To Save  Data.Please check error messages ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        } else {
            // route(View Path Address or Location)
            // return redirect()->route('galary.index');
           
                DB::table($this->table)->insert(
                    [
                        'cust_id' => $cust_id,
                        'staf_id' => $staf_id,
                        'pay_date' => $pay_date,
                        'report_date' => $report_date,
                        'expir_date' => $final,
                        'pay_amount' => $pay_amount,
                        'due' => $due,
                        'status' => $status,
                        'payment_method' => $payment_method,
                        'note' => $note,
                    ]
                );
             
           
            \Session::flash('message', 'Data Save Successfully ....... ');
            return redirect('/admin/payment/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $payment = Payment::findOrfail($id);
        return view('admin.payment.edit',compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //Update Data
        /**
         *  Data  Validation.....
         */
        $v = Validator::make($request->all(), [
            'cust_id' => 'required',
            'pay_date' => 'required',
            'pay_amount' => 'required',
            'payment_method' => 'required',
            'status' => 'required',
          
        ]);
        /**
         * Get Data From User Input
         */
       $id = $request->id;
       $cust_id = $request->cust_id;
        
        $findDueAmount = Customer::where('id',$cust_id)->first();

        // return  $findDueAmount->monthly_bill;
        // var_dump($id);
        // var_dump($findDueAmount);

        // die();

        // $staf_id = Auth::user()->id;
        $staf_id = 1;
        $pay_date = $request->input('pay_date');
        $pay_amount = $request->input('pay_amount');
        $payment_method = $request->input('payment_method');
        $status = $request->input('status');
        $note = $request->input('note');
        $expaire_date = $nMonths = 1; // choose how many months you want to move ahead
        $final = $this->endCycle($pay_date, $nMonths);
        if($pay_amount < $findDueAmount->monthly_bill ){
            \Session::flash('message', 'Payment Amount Is Less then Monthly Bill . It should be equal  ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        }elseif($pay_amount > $findDueAmount->monthly_bill ){
            \Session::flash('message', 'Payment Amount Is greater then Monthly Bill . It should be equal  ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        }else{
            $due =  $findDueAmount->monthly_bill - $pay_amount;

        }
        $report_date = date('Y-m',strtotime($pay_date));

        /**
         * Check Data is Valid or Not
         */
        if ($v->fails()) {
     
            \Session::flash('message', 'Fail To Update  Data.Please check error messages ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        } else {
            // route(View Path Address or Location)
            // return redirect()->route('galary.index');
           
                DB::table($this->table)->where('id',$id)->update(
                    [
                        'cust_id' => $cust_id,
                        'staf_id' => $staf_id,
                        'pay_date' => $pay_date,
                        'report_date' => $report_date,
                        'expir_date' => $final,
                        'pay_amount' => $pay_amount,
                        'due' => $due,
                        'status' => $status,
                        'payment_method' => $payment_method,
                        'note' => $note,
                    ]
                );
             
           
            \Session::flash('message', 'Data Update Successfully ....... ');
            return redirect('/admin/payment/edit/'.$id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Payment::destroy($id);
        \Session::flash('message', 'Delete Data Successfully ....... ');
        return back();
    }
}

// The instructions for the held ID picture:

//     - take a piece of paper and write on it "PAYONEER" and today's date
//     - take your ID card
//     - hold the paper on one hand and the ID card on the other hand
//     - ask someone to take a picture of you holding the paper and the ID near your face