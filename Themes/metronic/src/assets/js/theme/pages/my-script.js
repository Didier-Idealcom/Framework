// variables
var datatable;

var MyListDatatable = function() {
    // init
    var init = function(target, url, columns) {
        // init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $(target).KTDatatable({
            // datasource definition
            data: {
                type: 'remote',
                source: {
                    read: {
                        url: url,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    }
                },
                pageSize: 10, // display 20 records per page
                serverPaging: true,
                serverFiltering: true,
                serverSorting: true,
            },

            // layout definition
            layout: {
                scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                footer: false // display/hide footer
            },

            // column sorting
            sortable: true,

            pagination: true,

            search: {
                input: $('#databable_search'),
                delay: 400
            },

            // columns definition
            columns: columns
        });
    }

    // search
    var search = function() {
        $('#kt_form_status').on('change', function() {
            datatable.search($(this).val().toLowerCase(), 'Status');
        });
    }

    // selection
    var selection = function() {
        // init form controls
        //$('#kt_form_status, #kt_form_type').selectpicker();

        // event handler on check and uncheck on records
        datatable.on('kt-datatable--on-check kt-datatable--on-uncheck kt-datatable--on-layout-updated', function(e) {
            var checkedNodes = datatable.rows('.kt-datatable__row--active').nodes(); // get selected records
            var count = checkedNodes.length; // selected records count

            $('#kt_subheader_group_selected_rows').html(count);

            if (count > 0) {
                $('#kt_subheader_search').addClass('kt-hidden');
                $('#kt_subheader_group_actions').removeClass('kt-hidden');
            } else {
                $('#kt_subheader_search').removeClass('kt-hidden');
                $('#kt_subheader_group_actions').addClass('kt-hidden');
            }
        });
    }

    return {
        // public functions
        init: function(target, url, columns) {
            init(target, url, columns);
            search();
            selection();
        }
    };
}();

// On document ready
KTUtil.ready(function() {
    // Active button
    $('.kt-portlet__body').on('click', '.toggle-active', function(e) {
        //e.preventDefault();
        var btn = $(this);
        $.ajax({
            method: 'GET',
            url: $(this).data('url'),
            success: function(data, textStatus, jqXHR) {
                var label_on = btn.data('label-on');
                var label_off = btn.data('label-off');
                if (btn.hasClass('btn-success')) {
                    btn.html(btn.html().replace(label_on, label_off));
                } else {
                    btn.html(btn.html().replace(label_off, label_on));
                }
                btn.toggleClass('btn-success btn-danger');
                btn.find('i').toggleClass('la-toggle-on la-toggle-off');

                if (btn.data('reload')) {
                    datatable.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Status ' + textStatus + ' : ' + errorThrown);
            }
        });
    });

    // Shortcut save button
    $('.my-link__save').on('click', function(e) {
        e.preventDefault();
        $($(this).attr('href')).trigger('click');
    });

    // Change language
    var lang = 'fr';
    $('.input-multilangue').not('.lang-' + lang).parents('.form-group').hide();
    $('.lang-change[data-lang="' + lang + '"]').addClass('active');

    $('.lang-change').on('click', function(e) {
        e.preventDefault();

        if (!$(this).hasClass('active')) {
            var data_lang = $(this).data('lang');
            $('.input-multilangue').parents('.form-group').hide();
            $('.input-multilangue.lang-' + data_lang).parents('.form-group').fadeIn();
            $('.lang-change').removeClass('active');
            $('.lang-change[data-lang="' + data_lang + '"]').addClass('active');
        }
    });
});
