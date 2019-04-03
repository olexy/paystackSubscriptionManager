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
            echo "User already registered !";
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
}
