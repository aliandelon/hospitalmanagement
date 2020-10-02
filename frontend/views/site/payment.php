<button id="rzp-button1" onclick="test()">Pay</button>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

 
// document.getElementById('rzp-button1').onclick = function(e){
function test(){
    var options = {
    "key":'<?php echo $apikey?>',
    "amount": "50000", 
    "currency": "INR",
    "name": "Acme Corp",
    "description": "Test Transaction",
    "image": "https://example.com/your_logo",
    "handler": function (response){
        alert(response.razorpay_payment_id);
        alert(response.razorpay_order_id);
        alert(response.razorpay_signature)
    },
    "prefill": {
        "name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "contact": "9999999999"
    },
    "notes": {
        "address": "Razorpay Corporate Office"
    },
    "theme": {
        "color": "#F37254"
    }
};




   var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();
}
</script>
Read more: Learn about the Checkout Form Fields.

Handler Function vs Callback URL:





