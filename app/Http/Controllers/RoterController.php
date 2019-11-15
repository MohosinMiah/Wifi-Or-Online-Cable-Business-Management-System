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
use Illuminate\Support\Arr;
use Response;

class RoterController extends Controller
{
    private $table = 'roters';


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
        $routers = Roter::all();
        
        return view("admin.router.index",compact("routers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.router.create");
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
            'name' => 'required',
            'price' => 'required',   
            'qty'    => 'required',     
        ]);
        /**
         * Get Data From User Input
         */
    
        $name = $request->name;
        $model = $request->model;
        $price = $request->price;
        $qty = $request->qty;
        $note = $request->note;
        $picture = $request->file('picture');


      /**
         * Check File is uploaded or not
         */
        if ($picture) {
            $img_name = time()."_".$picture->getClientOriginalName();
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
            if ($picture) {

                DB::table($this->table)->insert(
                    [
                        'name' => $name,
                        'model' => $model,
                        'price' => $price,
                        'qty' => $qty,
                        'picture' => $img_name,
                        'note' => $note,
                    ]
                );
            }else{
                DB::table($this->table)->insert(
                    [
                        'name' => $name,
                        'model' => $model,
                        'price' => $price,
                        'qty' => $qty,
                        'note' => $note,
                    ]
                );

            }
                if ($picture) { 
                    $destinationPathOne = public_path('images');
                    $picture->move($destinationPathOne, $img_name);  
                }
           
            \Session::flash('message', 'Data Save Successfully ....... ');
            return redirect('/admin/router/add');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roter  $roter
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roter  $roter
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          if (Auth::user()->roll == 3){
       
            $router = Roter::where('id', $id)->first();
     
     return view("admin.router.edit",compact('router'));
        }else{
            return view("/admin/customer/create");
        }
    

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roter  $roter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          
        if (Auth::user()->roll == 3){
       
      
    
        /**
         *  Data  Validation.....
         */
        $v = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required',   
            'qty'    => 'required',     
        ]);
        /**
         * Get Data From User Input
         */
    
        $name = $request->name;
        $model = $request->model;
        $price = $request->price;
        $qty = $request->qty;
        $note = $request->note;
        $picture = $request->file('picture');


      /**
         * Check File is uploaded or not
         */
        if ($picture) {
            $img_name = time()."_".$picture->getClientOriginalName();
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
           
            if ($picture) {

                DB::table($this->table)->where('id', $id)->update(
                    [
                        'name' => $name,
                        'model' => $model,
                        'price' => $price,
                        'qty' => $qty,
                        'picture' => $img_name,
                        'note' => $note,
                    ]
                );
            }else{
                DB::table($this->table)->where('id', $id)->update(
                    [
                        'name' => $name,
                        'model' => $model,
                        'price' => $price,
                        'qty' => $qty,
                        'note' => $note,
                    ]
                );

            }

                if ($picture) { 
                    $destinationPathOne = public_path('images');
                    $picture->move($destinationPathOne, $img_name);  
                }
           
            \Session::flash('message', 'Data Save Successfully ....... ');
            return redirect('/admin/router/edit/'.$id);
        }
             
    }else{
        return view("/admin/customer/create");
    }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roter  $roter
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 if (Auth::user()->roll == 3){
        DB::table($this->table)->where('id', '=', $id)->delete();
        return redirect('/admin/router/list');
 }

    }
}
