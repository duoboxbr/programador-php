    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '.delete-btn', function(e) {
        var $this = $(this),
            $id = $(this).attr('id');

        if (confirm('Deseja mesmo deletar?')) {
            $.post({
                type: $this.data('method'),
                url: $this.attr('href'),
				success: function(data){
                	if (data == "true") {
                    	window.location.href=window.location.href;
                    };
                }
            }).done(function (data) {
                $('#parent-' + $id).slideUp(300, function() {
                    $(this).remove();
                });
            }).fail(function (data) {
                console.log(data);  
            });
        }

        e.preventDefault();
    });