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

    public function loadCust()
    {
        $customers = Customer::all();
        
        return view('refsub')->with('customers', $customers);
    }

    // Find amount on clicking customer name select button
    public function findAmount(Request $request){

        $data = Plan::select('amount')->where('name',$request->name)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    // Find Customer name on clicking customer name select button

    public function findCustName(Request $request){

        $data = Customer::select('name')->where('email',$request->email)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    public function findRef(Request $request){

        $data = Subscription::select('ref_code')->where('customer',$request->name)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
    }

    public function callbackFunct(Request $request) {
        $reference = $request->reference;
        return view('welcome')->with('reference', $reference);
     }


}
