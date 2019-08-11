$(document).ready(function(){
    $(function () {
        $('.select2').select2();
        $('#products').DataTable();
        $('#category').DataTable();
    });

    $('.btn-del-product').click(function() {
        if (confirm('You are sure?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var productId = $(this).data('product-id');
            var url = '/admin/products/' + productId;
            $.ajax({
                url: url,
                type: 'DELETE',

                success: function(result) {
                    if (result.status) {
                        location.reload();
                    } else {
                        $('.alert-warning').show().html('<p>' +  result.message + '</p>');
                    }
                },
                error: function(result) {
                    $('.alert-warning').show().html('<p>' +  result.message + '</p>');
                }
            });
        }
    });

    $('.btn-del-order').click(function() {
        if (confirm('You are sure?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var orderId = $(this).data('order-id');
            var url = '/admin/orders/' + orderId;
            $.ajax({
                url: url,
                type: 'DELETE',

                success: function(result) {
                    if (result.status) {
                        // Removing row from HTML Table
                        $('.row_' + orderId).css('background','tomato');
                        $('.row_' + orderId).fadeOut(800, function(){ 
                           $(this).remove();
                        });
                        $('.alert-success').show().html('<p>' +  result.message + '</p>');
                    } else {
                        $('.alert-warning').show().html('<p>' +  result.message + '</p>');
                    }
                },
                error: function(result) {
                    $('.alert-warning').show().html('<p>' +  result.message + '</p>');
                }
            });
        }
    });

    $('.remove-single-image').click(function() {
        $('.single-image').hide();
        $(this).hide();
    });

    $('#image').change(function(e){
      if ($('#image').get(0).files.length != 0) {
            $('.single-image').hide();
            $('.remove-single-image').hide();
        }
    });
    
    $('.remove-multi-image').click(function() {
        var id = $(this).data('id');
        $('.image_' + id).hide();
        $(this).hide();
        var imageDelete = $('#image-delete').val();
        var newlist;

        if (imageDelete === '') {
            newlist = $(this).data('file-name');

        } else {
            newlist = imageDelete + ',' + $(this).data('file-name');
        }
        
        $('#image-delete').attr('value', newlist);
    });
});

$(document).ready(function(){
    $('#btn-attr-add').click(function() {
        var moreAttribute = $('.template').clone();
        moreAttribute.removeClass("template");
        moreAttribute.removeClass("hidden");
        $('.attribute-value').append(moreAttribute);
    });
});
