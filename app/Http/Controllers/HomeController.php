<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view("admin.customer.create");
    }



    public function user_list(){
        $users = User::all();
        return view("admin.user.index",compact("users"));
   }

   public function user_delete($id){
    if (Auth::user()->roll == 3){
        $users = User::where('id', $id)->delete();
        return redirect("/admin/user/list");
    }
       
   }



    
}
