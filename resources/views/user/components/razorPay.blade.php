<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    var options = {
        "key": "{{ $key }}", // Enter the Key ID generated from the Dashboard
        "amount": "100", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
        "currency": "INR",
        "name": "Goingbo Tours Pvt. Lim.",
        "description": "Test Transaction",
        "image": "https://www.goingbo.com/images/logo.png",
        "order_id": "{{ $order['id'] }}", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "callback_url":"{{$redirect}}",
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
    document.getElementById('razorPay').onclick = function(e) {
        e.preventDefault();
        if (window.set_options) set_options();
        var rzp1 = new Razorpay(options);
        rzp1.open();
    }
</script>
