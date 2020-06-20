<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use Auth;
use App\Customer;
use App\Payment;
use App\Roter;
use Illuminate\View\View;
use DateTime;
use DatePeriod;
use DateInterval;


class CustomerController extends Controller
{

    private $table ='customers';
    
    
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
     * Search Customer
     *
     * @return \Illuminate\Http\Response
     */
    public function search_customer()
    {
        $customer = '';
        $payments = '';


        return view('admin.customer.search',compact("customer","payments"));
    }
    
    /**
     * Search Customer
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        if($_GET['search_customer']){
            $id = $_GET['search_customer'];
            $customer = Customer::with('payments')->where('id',$id)->first();
            $payments = Payment::where('cust_id', $id)->get();
            // return $customer;
        }
          

     
        return view('admin.customer.search',compact("customer","payments"));
    }
    


    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $customers = Customer::orderBy('id', 'DESC')->get();
        
        return view('admin.customer.index',compact('customers'));
    }

   /**
     * Download Customer Data
     */

    public function customer_data(){
        $customers = Customer::orderBy('id', 'DESC')->get();

        $pdf = PDF::loadView('admin.customer.index', $customers);
        return $pdf->download('customer.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $routers = Roter::orderBy('id', 'DESC')->get();

        return view("admin.customer.create",compact("routers"));
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
            'phone' => 'required|unique:customers',
            'id_card' => 'id_card|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'reg_date' => 'required',
            'id_card' => 'required',
            'address' => 'required',
            'wifi_plan' => 'required|integer',
            'monthly_bill' => 'required|integer',
            'payment_method' => 'required',
        ]);
        /**
         * Get Data From User Input
         */
        $name = $request->input('name');
        $reg_date = $request->input('reg_date');
        $id_card = $request->file('id_card');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $wifi_plan = $request->input('wifi_plan');
        $monthly_bill = $request->input('monthly_bill');
        $payment_method = $request->input('payment_method');
        $email = $request->input('email');
        $agent_name = $request->input('agent_name');
        $bill_address = $request->input('bill_address');
        $router_id = $request->input('router_id');
        $note = $request->input('note');
        $nMonths = 1; // choose how many months you want to move ahead
        $final = $this->endCycle($reg_date, $nMonths); // output: 2014-07-02


        // Check Router Availity 

        $router = Roter::find($router_id);
      if($router != null){
        if($router->qty >= 1){
            $router->qty =  $router->qty -1;
            $router->sell = $router->sell + 1;
            $router->update();
        }else{
            \Session::flash('message', 'Fail To Save  Data.Router is not available....... ');
            return redirect()->back()->withInput()->withErrors($v);
        }
      }
      







        /**
         * Check File is uploaded or not
         */
        if ($id_card) {
            $img_name = time()."_".$id_card->getClientOriginalName();
        }
        /**
         * Check Data is Valid or Not
         */
        if ($v->fails()) {
     
            \Session::flash('message', 'Fail To Save  Data.Please check error messages ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        } else {
            // route(View Path Address or Location)
            // return redirect()->route('galary.index');
            if ($id_card) {
                DB::table($this->table)->insert(
                    [
                        'name' => $name,
                        'reg_date' => $reg_date,
                        'expaire_date' => $final,
                        'id_card' => $img_name,
                        'phone' => $phone,
                        'address' => $address,
                        'wifi_plan' => $wifi_plan,
                        'monthly_bill' => $monthly_bill,
                        'payment_method' => $payment_method,
                        'email' => $email,
                        'agent_name' => $agent_name,
                        'bill_address' => $bill_address,
                        'router_id' => $router_id,
                        'note' => $note,
                    ]
                );
            } 
            if ($id_card) { 
                $destinationPathOne = public_path('images');
                $id_card->move($destinationPathOne, $img_name);  
            }
            \Session::flash('message', 'Data Save Successfully ....... ');
            return redirect('/admin/customer/create');
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
        if (Auth::user()->roll == 3){
            $customer = Customer::where('id', $id)->first();
            return view("admin.customer.edit",compact("customer"));
        }else{
            return view("/admin/customer/create");
        }


        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        if (Auth::user()->roll == 3){
            
        

        /**
         *  Data  Validation.....
         */
        $v = Validator::make($request->all(), [
            'phone' => 'required',
            'name' => 'required',
            'address' => 'required',
            'wifi_plan' => 'required|integer',
            'monthly_bill' => 'required|integer',
            'payment_method' => 'required',
        ]);
        /**
         * Get Data From User Input
         */
        $name = $request->input('name');
        $reg_date = $request->input('reg_date');
        $id_card = $request->file('id_card');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $wifi_plan = $request->input('wifi_plan');
        $monthly_bill = $request->input('monthly_bill');
        $payment_method = $request->input('payment_method');
        $email = $request->input('email');
        $agent_name = $request->input('agent_name');
        $bill_address = $request->input('bill_address');
        $router_id = $request->input('router_id');
        $note = $request->input('note');
        $nMonths = 1; // choose how many months you want to move ahead
        $final = $this->endCycle($reg_date, $nMonths); // output: 2014-07-02
        /**
         * Check File is uploaded or not
         */
        if ($id_card) {
            $img_name = time()."_".$id_card->getClientOriginalName();
        }
        /**
         * Check Data is Valid or Not
         */
        if ($v->fails()) {
     
            \Session::flash('message', 'Fail To Save  Data.Please check error messages ....... ');
            return redirect()->back()->withInput()->withErrors($v);
        } else {
            // route(View Path Address or Location)
            // return redirect()->route('galary.index');
            if ($id_card) {
                DB::table($this->table)->where('id',$id)->update(
                    [
                        'name' => $name,
                        'id_card' => $img_name,
                        'phone' => $phone,
                        'address' => $address,
                        'wifi_plan' => $wifi_plan,
                        'monthly_bill' => $monthly_bill,
                        'payment_method' => $payment_method,
                        'email' => $email,
                        'agent_name' => $agent_name,
                        'bill_address' => $bill_address,
                        'note' => $note,
                    ]
                );
            } else{
                DB::table($this->table)->where('id',$id)->update(
                    [
                        'name' => $name,
                        'phone' => $phone,
                        'address' => $address,
                        'wifi_plan' => $wifi_plan,
                        'monthly_bill' => $monthly_bill,
                        'payment_method' => $payment_method,
                        'email' => $email,
                        'agent_name' => $agent_name,
                        'bill_address' => $bill_address,
                        'note' => $note,
                    ]
                );
            }
            if ($id_card) { 
                $destinationPathOne = public_path('images');
                $id_card->move($destinationPathOne, $img_name);  
            }
            \Session::flash('message', 'Data Save Successfully ....... ');
            return redirect('/admin/customer/edit/'.$id);
        }
    }else{
        return view("/admin/customer/create");
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
        if (Auth::user()->roll == 3){
       
            Customer::where('id', $id)->delete();
            Payment::where('cust_id', $id)->delete();
            return redirect('/admin/customer/list');
        }else{
            return view("/admin/customer/create");
        }
      
    }
}
