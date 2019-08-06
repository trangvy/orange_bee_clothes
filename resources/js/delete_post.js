$(document).ready(function(){
    $('.btn-del-post').click(function() {
        if (confirm('You are sure?')) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var categoryId = $(this).data('post-id');
            var url = '/admin/posts/' + categoryId;
            console.log(url);
            $.ajax({
                url: url,
                type: 'DELETE',
                success: function(result) {

                    if (result.status) {
                        $('.row_' + postId).remove();
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
