<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
class SendSmsController extends Controller
{
 
    
  public function send_sms(){
      $customers = Customer::all();
      return view("admin.send_sms.sendIndividual",compact('customers'));
  }

public function send_sms_post(Request $request){

       /**
         *  Data  Validation.....
         */
        $v = Validator::make($request->all(), [
          'cust_id' => 'required',
          'message'    => 'required',     
      ]);
    /**
         * Get Data From User Input
         */
        $id = $request->cust_id;
        $message = $request->message;
   
   
          /**
         * Check Data is Valid or Not
         */
        if ($v->fails()) {
     
          \Session::flash('message', 'Message Not Send . Please check error messages ....... ');
          return redirect()->back()->withInput()->withErrors($v);
      } else {
           
  
      // Get Customer  based on Id
      $customer = Customer::where('id',$id)->first();
       
     $status =  $this->sendSmsToUser($customer->phone,$message);
     switch($status){
      case 1101:
        \Session::flash('message', 'Message Status :  Message Send Successfully');
       break;
       case 1010:
        \Session::flash('message', 'Message Status :  Max number limit exceeded');
       break;
       case 1009:
        \Session::flash('message', 'Message Status :  Inactive Account');
       break;
       case 1004:
        \Session::flash('message', 'Message Status :  Invalid number');
       break;
       case 1003:
        \Session::flash('message', 'Message Status :  Invalid message or empty message');
       break;
       case 1002:
        \Session::flash('message', 'Message Status :  Empty Number');
       break;
       

     }
     return redirect()->back();

      // die($customer);
      

      }

}

public function sendSmsToUser($number,$text){
  

    // Twilio::message('8801816073636', $code);
    // to  8801857126452
    //  ar  8801767086814


    $url = "http://66.45.237.70/api.php";



    
    $data= array(
    'username'=>"01857126452",
    'password'=>"2RVXW48F",
    'number'=>"$number",
    'message'=>"$text"
    );

   


    
    $ch = curl_init(); // Initialize cURL
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    $p = explode("|",$smsresult);
    $sendstatus = $p[0];
    return $sendstatus;

}

  public function send_sms_all(){
      // return redirect("http://login.bulksmsbd.com/admin.php");
      return view("admin.send_sms.sendall");
  }


  public function download_all(){
    $users = Customer::get(); // All users
   $csvExporter = new \Laracsv\Export();
  $csvExporter->build($users, ['phone'])->download();
  }

}
