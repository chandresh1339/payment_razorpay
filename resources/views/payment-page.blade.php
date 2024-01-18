<!--Click this Pay button automatically when the page load with javascript

Hide the button here once the payment is done
-->
<button id="rzp-button1" hidden>Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
var options = {
    "key": "{{$response['razorpayId']}}", // Enter the Key ID generated from the Dashboard
    "amount": "{{$response['amount']}}", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    "currency": "INR",
    "name": "{{$response['name']}}",
    "image": "https://example.com/your_logo",
    "order_id": "{{$response['orderID']}}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
    "handler": function (response){

        //After payment, it will successfully,response will come here
        //Create a form for sending the data
        //Set the data in the form
        document.getElementById('razorpay_payment_id').value=response.razorpay_payment_id;
        document.getElementById('razorpay_order_id').value=response.razorpay_order_id;
        document.getElementById('razorpay_signature').value=response.razorpay_signature;
       /* alert(response.razorpay_payment_id);
        alert(response.razorpay_order_id);
        alert(response.razorpay_signature) */

    //Let's submit the Click button form
    document.getElementById('rzp-paymentresponse').click();

    },
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "contact": "9000090000"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#3399cc"
    }
};
var rzp1 = new Razorpay(options);
window.onload=function(){

    document.getElementById('rzp-button1').click();
};

document.getElementById('rzp-button1').onclick = function(e){
    rzp1.open();
    e.preventDefault();
}
</script>

<!--I will copy the form and hide it-->
<form action="{{url('/payment-complete')}}" method="post" hidden>
  <input type="hidden" value="{{csrf_token()}}" name="_token">
  <input type="text" id="razorpay_payment_id" name="razorpay_payment_id"><br>
  <input type="text" id="razorpay_order_id" name="razorpay_order_id"><br>
  <input type="text" id="razorpay_signature" name="razorpay_signature"><br><br>
  <input type="submit" id="rzp-paymentresponse"  value="Submit">
</form>

