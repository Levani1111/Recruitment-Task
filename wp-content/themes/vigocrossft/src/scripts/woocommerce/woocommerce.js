jQuery(document).ready(function ($) {
    $(".add_to_cart_button").on("click", function (e) {
        if ($(this).text() === "Go to cart") {
            window.location.href = "/cart/";
        } else {
            $(this).attr("href", "/cart/");
            $(this).text("Go to cart");
        }
    });
    $(".add_to_cart_button").text("BUY NOW");
});

