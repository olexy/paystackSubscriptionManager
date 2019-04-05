<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Plan;
use App\Subscription;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function loadCustPlan()
    {
        $customers = Customer::all();
        $plans = Plan::all();
        
        return view('addsub')->with('customers', $customers)->with('plans', $plans);
    }

    // Load customer to verify subscription payment
    public function loadCust(){
        $customers = Subscription::select('customer')->whereNull('auth_code')->get();

        // $customers = Subscription::all();
        return view('refsub')->with('customers', $customers);
    }

    public function loadCustForSave(){
        $customers = Subscription::select('customer')->whereNull('sub_code')->get();
        
         return view('savesub')->with('customers', $customers);
    }

    //JQUERY

    //find amount on clicking customer name select button
    public function findAmount(Request $request){
        $data = Plan::select('amount')->where('name',$request->name)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    // find Customer name on clicking customer name select button
    public function findCustName(Request $request){  
        $data = Customer::select('name')->where('email',$request->email)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    // find subscription payment reference on clicking customer name select button
    public function findRef(Request $request){
        $data = Subscription::select('ref_code')->where('customer', $request->name)->take(100)->get();
        return response()->json($data); //then sent this data to ajax success
    }

    // find subscription payment auth code on clicking customer name select button
    public function findAuth(Request $request){
        $data = Subscription::select('auth_code')->where('customer', $request->name)->take(100)->get();
        return response()->json($data); //then sent this data to ajax success
    }


    // pick callback on successfull payment from PayStack
    public function callbackFunct(Request $request) {
        $reference = $request->reference;
        return view('welcome')->with('reference', $reference);
     }


}
