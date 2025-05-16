jQuery(document).ready(function($) {
    $('.change-view').on('click', function() {
        var view = $(this).data('view');

        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'change_view',
                view: view,
            },
            success: function(response) {
                if (response.success) {
                    $('#lokale-results').html(response.data);
                }
            },
            error: function() {
                alert('Wystąpił błąd.');
            }
        });
    });
});
