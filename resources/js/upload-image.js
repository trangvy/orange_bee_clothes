$(document).ready(function() {
    $('#upload_form').on('submit', function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        event.preventDefault();
        var url = "{{ route('admin.upimage.store') }}";
        $.ajax({
            url: url,
            type: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data) {
                const pos = simplemde.codemirror.getCursor();
                simplemde.codemirror.replaceRange('![]('+(data.image_path)+')', pos);
            }
        })
    });
});
