<?php

namespace App\Http\Controllers;
use Razorpay\Api\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\PaymentController;

class PaymentController extends Controller
{
    private $razorpayId="rzp_test_z7p8YrpbeFGhft";
    private $razorpayKey="n4LvoDPCTI2M71hkpfQXKVo7";

    public function Initiate(Request $request)
    {

        //Generate a randon receipt id
        $receiptId=Str::random(20);

        //Create a razor pay order
        $api = new Api($this->razorpayId, $this->razorpayKey);
        //Creating a order and convert the request rupees to paise, we mulitply by 100
        //Currency will be INR
        $order =$api->order->create(array(
            'receipt'         => $receiptId,
            'amount'          => $request->all()['amount']*100, // 100000 rupees in paise
            'currency'        => 'INR'
        )
        );
       
        //Let's return the response

        //Let's create the razor payment page
        $response=[

            'orderID'=>$order['id'],
            'razorpayId'=>$this->razorpayId,
            'amount'          => $request->all()['amount']*100,
            'currency'        => 'INR',
            'name'             => $request->all()['name'],
           
        ];
//Let's check the view of the payment page
        return view('payment-page',compact('response'));


            }
            public function Complete(Request $request)
            {

                //Let print the payment response data
               // print_r($request->all());
                //exit();
                $status=$this->SignatureVerfiy(
                    $request->all()['razorpay_signature'],
                    $request->all()['razorpay_payment_id'],
                    $request->all()['razorpay_order_id']
                );
//Check the Signature status is true then save the payment response

                if($status==true){
                    //Show the success page of payment
return view('payment-success-page');
                }
                else{
                    //Show the failed page of payment
                    return view('payment-failed-page');
                }
            }
private function SignatureVerfiy($_signature,$_paymentId,$_orderId)
            {
                try{
                    $api=new Api($this->razorpayId,$this->razorpayKey);
                    $attributes=array(
                        'razorpay_order_id' => $_orderId,
                        'razorpay_payment_id' => $_paymentId, 
                        'razorpay_signature' => $_signature);
                    $api->utility->verifyPaymentSignature($attributes);
                return true;    
                }
                catch(Exception $e) 
                {   
                    //If Signature is not correct, it will return false
                    return false;


                }
       
            }
        
    
}
