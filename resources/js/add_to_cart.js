$(document).ready(function() {
    $('.add_to_cart').click(function () {
        var productId = $(this).data('product-id');
        var url = '/add-to-cart/' + productId;

        $.ajax({
            url: url,
            type: 'GET',

            success: function (result) {
                if (!result.check_cart) {
                    var content = "<div class=\"cart-img-details  row_"+result.id+"\">\n" +
                                      "<div class=\"cart-img-photo\">\n" +
                                          "<a href=\"#\"><img src=\"result.product_image\" alt=\"sale\"></a>\n" +
                                          "<span>"+result.product_quantity+"</span>\n" +
                                      "</div>\n" +
                                      "<div class=\"cart-img-contaent\">\n" +
                                          "<a href=\"#\"><p>"+result.product_name+"</p></a>\n" +
                                          "<span>"+result.product_price+"</span>\n" +
                                      "</div>\n" +
                                      "<div class=\"pro-del\">\n" +
                                          "<a class=\"cart_quantity_delete\" data-product-id=\"result.id\" role=\"button\">\n" +
                                          "<i class=\"fa fa-times-circle\"></i>\n" +
                                          "</a>\n" +
                                      "</div>\n" +
                                 "</div>";
                    $('.cart-product').append(content);
                } else {
                    $('.quantity_' + productId).html(result.product_quantity);
                    $('.price_' + productId).html(result.product_price);
                }
                $('.cart-count').text(result.total_count);
                $('.total').text(result.totalPrice);
            },
            error: function (result) {
                $('.alert-warning').show().html('<p>' +  result.message + '</p>');
            }
        });
    });
});