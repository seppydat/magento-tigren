require(['jquery'], function($){
    $("#product_addtocart_form").submit(function (e) {
        alert('add to cart');
        console.log(1234);
        return false;
    });
});
