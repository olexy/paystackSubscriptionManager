<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Plan;
use App\Subscription;

use Alert;

use Illuminate\Http\Request;

class DbStorageController extends Controller
{
    public function storeCust(Request $request)
    {
        $customer = new Customer;

        if ($customer::where('name', $request->txtname)->first()) {
            echo "Customer already registered !";
         }else{
             // Call paystack and insert into db
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.paystack.co/customer",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "{ \n   \"email\": \"$request->txtemail\"}",
				  CURLOPT_HTTPHEADER => array(
				    "Authorization: Bearer sk_test_36e175c5c710aacac84e2a3974988707c0834e7d",
				    "Cache-Control: no-cache",
				    "Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				$key_gen ='';
				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  //echo "<br/>=========Paystack Response============<br/>".$response."<br/>";
				  // $myfile = file_put_contents('logs.txt', $response.PHP_EOL , FILE_APPEND | LOCK_EX);
				  $ans = json_decode($response);
				  $key_gen = $ans->data->customer_code;
				}
				//CURL ends here
                $customer->name = $request->txtname;
                $customer->email = $request->txtemail;
                $customer->cust_code = $key_gen;

                if($request->rdclass == 'individual'){
                    $customer->class = "Individual";   
                } 
                elseif ($request->rdclass == 'corporate'){    
                    $customer->class = "Corporate"; 
                }   
         
                $customer->save();

                Alert::success('Customer Successfully Added!');

                return redirect()->back();
        }
    }

    //storing plans
    public function storePlan(Request $request)
    {
        $plan = new Plan;

        if ($plan::where('name', $request->txtname)->first()) {
            echo "Plan already exists!";
         }else{
             // Call paystack and insert into db
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_URL => "https://api.paystack.co/plan",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "{\n   \"name\": \"$request->txtname\",\n   \"amount\": $request->txtamount,\n   \"interval\": \"$request->interval\",\n   \"send_invoices\": \"$request->invoice\",\n   \"send_sms\": \"$request->sms\",\n   \"description\": \"$request->description\"}",
				  CURLOPT_HTTPHEADER => array(
				    "Authorization: Bearer sk_test_36e175c5c710aacac84e2a3974988707c0834e7d",
				    "Cache-Control: no-cache",
				    "Content-Type: application/json"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				$key_gen ='';
				curl_close($curl);

				if ($err) {
				  echo "cURL Error #:" . $err;
				} else {
				  $ans = json_decode($response);
				  $key_gen = $ans->data->plan_code;
				}
				//CURL ends here
                $plan->name = $request->txtname;
                $plan->description = $request->description;
                $plan->amount = $request->txtamount;
                $plan->interval = $request->interval;
                $plan->invoice = $request->invoice;
                $plan->sms = $request->sms;
                $plan->plan_code = $key_gen;
 
         
                $plan->save();

                Alert::success('Plan Successfully Created!');

                return redirect()->back();
        }
    }

    //create & initialize subscription
    public function createSub(Request $request)
    {
        $sub = new Subscription;

        // Call paystack to initialize transactionsand insert into db
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n   \"email\": \"$request->customerlist\", \n   \"amount\": \"$request->txtamount\"}",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_36e175c5c710aacac84e2a3974988707c0834e7d",
            "Cache-Control: no-cache",
            "Content-Type: application/json"
            ),
        ));

            // echo $request->planlist. "===" . $request->customerlist;
            // echo "{\n   \"email\": \"$request->customerlist\", \n   \"amount\": \"$request->txtamount\"}";

        $response = curl_exec($curl);
        $err = curl_error($curl);

        $auth_url ='';
        $ref = '';
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<br/>=========Paystack Response============<br/>".$response."<br/>";
                $myfile = file_put_contents('logs.txt', $response.PHP_EOL , FILE_APPEND | LOCK_EX);
            $ans = json_decode($response);
            // echo $ans->data;
            $auth_url = $ans->data->authorization_url;
            $ref = $ans->data->reference;           
        }

        $sub->customer = $request->custName;
        $sub->plan = $request->planlist;
        $sub->start_date = $request->datepicker;
        $sub->ref_code = $ref;
    
        $sub->save();
        
        return redirect()->away($auth_url);

        //return redirect()->back();
        
    }

    //reference and verify subscription payment
    public function verifySub(Request $request)
    {
        $sub = Subscription::where('customer', $request->customerlist);

        $ref_code = $request->txtrefcode;
        $url = "https://api.paystack.co/transaction/verify/$ref_code";

        // Call paystack to initialize transactionsand insert into db
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            // CURLOPT_POSTFIELDS =>"{\n   \"email\": \"$request->customerlist\", \n   \"amount\": \"$request->txtamount\"}",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_36e175c5c710aacac84e2a3974988707c0834e7d",
            "Cache-Control: no-cache",
            "Content-Type: application/json"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        $auth_code ='';
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<br/>=========Paystack Response============<br/>".$response."<br/>";
                $myfile = file_put_contents('logs.txt', $response.PHP_EOL , FILE_APPEND | LOCK_EX);

            $ans = json_decode($response);
            $auth_code = $ans->data->authorization->authorization_code;       
        }
            
        $sub->update(['auth_code'=> $auth_code]);

        // Subscription::where('customer', $request->customerlist)->update(['auth_code'=> $auth_code]);

        return redirect()->back();
        
    }

    //saving subscription into the database
    public function safeSub(Request $request)
    {
        $sub = Subscription::where('customer', $request->customerlist);

        // Call paystack to initialize transactions and insert into db
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/subscription",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n   \"customer\": \"$request->txtcustcode\", \n   \"plan\": \"$request->txtplancode\", \n   \"authorization\": \"$request->txtauthcode\"}",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer sk_test_36e175c5c710aacac84e2a3974988707c0834e7d",
            "Cache-Control: no-cache",
            "Content-Type: application/json"
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        $sub_code ='';
        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo "<br/>=========Paystack Response============<br/>".$response."<br/>";
                $myfile = file_put_contents('logs.txt', $response.PHP_EOL , FILE_APPEND | LOCK_EX);

            $ans = json_decode($response);
            $sub_code = $ans->data->subscription_code;       
        }
            
        $sub->update(['sub_code'=> $sub_code]);

        return redirect()->back();        
    }
}
