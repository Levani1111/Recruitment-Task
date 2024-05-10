jQuery(document).ready(function ($) {
    $("#submitBtn").click(function () {
        var email = $("#email").val();
        if (validateEmail(email)) {
            var coupon_code = generateCouponCode();
            $(".thank-you-message")
                .html(
                    "<p>Thank you for subscribing! Your single-use €20 coupon code is: <strong>" +
                    coupon_code +
                    "</strong></p>"
                )
                .show();
        } else {
            alert("Please enter a valid email address.");
        }
    });

    function validateEmail(email) {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }

    function generateCouponCode() {
        return "20OFF" + Math.random().toString(36).substr(2, 9);
    }
});
