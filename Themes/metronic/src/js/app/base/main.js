jQuery(document).ready(function() {
    $('.m_datatable').on('click', '.toggle-active', function(e) {
        e.preventDefault();
        var btn = $(this);

        $.ajax({
            url: btn.data('url'),
            success: function(data, textStatus, jqXHR) {
                if (btn.hasClass('btn-success')) {
                    btn.html(btn.html().replace(btn.data('label-on'), btn.data('label-off')));
                } else {
                    btn.html(btn.html().replace(btn.data('label-off'), btn.data('label-on')));
                }
                btn.toggleClass('btn-success btn-danger');
                btn.find('i').toggleClass('la-toggle-on la-toggle-off');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });
    });
});
