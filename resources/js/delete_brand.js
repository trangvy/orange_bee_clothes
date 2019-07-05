$(document).ready(function(){
    $('.btn-del-brand').click(function() {
        if (confirm('You are sure?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var brandId = $(this).data('brand-id');
            var url = '/admin/brands/' + brandId;
            console.log(url);
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function(result) {

                    if (result.status) {
                        $('.row_' + brandId).remove();
                    } else {
                        alert(result.msg);
                    }
                },
                error: function() {
                    
                    location.reload();
                }
            });
        }
    });
});
