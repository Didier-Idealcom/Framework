"use strict";

var MyListDatatable = function() {
    // Define shared variables
    var table;
    var datatable;
    var toolbarBase;
    var toolbarSelected;
    var selectedCount;

    // Private functions
    var initDatatable = function(target, url, columns) {
        table = document.querySelector(target);

        // Init the datatables. Learn more: https://keenthemes.com/metronic/?page=docs&section=datatable
        datatable = $(table).DataTable({
            serverSide: true,
            pageLength: 10,
            ajax: {
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            },

            // column sorting
            ordering: true,
            order: [[1, 'asc']],
            paging: true,

            // columns definition
            columns: columns,

            autoWidth: false
        });

        // Add event listener for opening and closing details
        $('.dataTable').on('click', '.trigger_row_details', function() {
            var tr = $(this).closest('tr');
            var row = datatable.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(row.data().row_details).show();
                tr.addClass('shown');
            }
            $(this).find('.svg-icon').toggleClass('d-none');
        });

        // Function after Datatable init -- more info: https://datatables.net/reference/event/init
        datatable.on('init', function() {
            //console.log(datatable.settings().init().columns);
            datatable.settings().init().columns.forEach(function(columnSettings) {
                //console.log(columnSettings);
                if (columnSettings.customFilter === true) {
                    var column = datatable.column(columnSettings.name + ':name');
                    var filter_field = $('<div class="mb-10"><label class="form-label fs-6 fw-bold">' + columnSettings.title + ' :</label><select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-table-filter="' + columnSettings.name + '" data-hide-search="true"><option value=""></option></select></div>');
                    filter_field.prependTo($('[data-kt-table-filter="form"]'));
                    filter_field.find('select').on('change', function() {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        if (columnSettings.customFilterSmart === true) {
                            column.search(val ? val : '').draw();
                        } else {
                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        }
                    });

                    var values = column.data().unique().sort();
                    values = values
                        .each(function(value, index) {
                            if (value.indexOf(',') !== -1) {
                                value.split(', ').forEach(function(subvalue) {
                                    values.push(subvalue);
                                });
                            }
                        })
                        .filter(function(value, index) {
                            if (value !== '' && value.indexOf(',') === -1) {
                                return true;
                            }
                            return false;
                        })
                        .unique().sort().each(function(value, index) {
                            filter_field.find('select').append('<option value="' + value + '">' + value + '</option>')
                        });
                }
            });
            KTApp.initSelect2();
            datatable.table().header().classList = 'text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0';
            datatable.table().body().classList = 'text-gray-600 fw-bold';
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function() {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-table-filter="search"]');

        if (filterSearch) {
            filterSearch.addEventListener('keyup', function(e) {
                datatable.search(e.target.value).draw();
            });
        }
    }

    // Reset Filter
    var handleResetForm = () => {
        // Select reset button
        const resetButton = document.querySelector('[data-kt-table-filter="reset"]');

        // Reset datatable
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                // Select filter options
                const filterForm = document.querySelector('[data-kt-table-filter="form"]');
                const selectOptions = filterForm.querySelectorAll('select');

                // Reset select2 values -- more info: https://select2.org/programmatic-control/add-select-clear-items
                selectOptions.forEach(select => {
                    $(select).val('').trigger('change');
                });

                // Reset datatable --- official docs reference: https://datatables.net/reference/api/search()
                datatable.search('').draw();
            });
        }
    }

    // Delete subscirption
    var handleDeleteRows = () => {
        // Select all delete buttons
        const deleteButtons = table.querySelectorAll('[data-kt-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            // Delete button on click
            d.addEventListener('click', function(e) {
                e.preventDefault();

                // Select parent row
                const parent = e.target.closest('tr');

                // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
                Swal.fire({
                    text: "Are you sure you want to delete this record ?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, delete !",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function(result) {
                    if (result.value) {
                        Swal.fire({
                            text: "Successful deletion !",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function() {
                            // Remove current row
                            datatable.row($(parent)).remove().draw();
                        }).then(function() {
                            // Detect checked checkboxes
                            toggleToolbars();
                        });
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Deletion error",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it !",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    // Init toggle toolbar
    var initToggleToolbar = () => {
        // Toggle selected action toolbar
        // Select all checkboxes
        const checkboxes = table.querySelectorAll('[type="checkbox"]');

        // Select elements
        toolbarBase = document.querySelector('[data-kt-table-toolbar="base"]');
        toolbarSelected = document.querySelector('[data-kt-table-toolbar="selected"]');
        selectedCount = document.querySelector('[data-kt-table-select="selected_count"]');
        const deleteSelected = document.querySelector('[data-kt-table-select="delete_selected"]');

        // Toggle delete selected toolbar
        checkboxes.forEach(c => {
            // Checkbox on click event
            c.addEventListener('click', function() {
                setTimeout(function() {
                    toggleToolbars();
                }, 50);
            });
        });

        // Deleted selected rows
        deleteSelected.addEventListener('click', function() {
            // SweetAlert2 pop up --- official docs reference: https://sweetalert2.github.io/
            Swal.fire({
                text: "Are you sure you want to delete selected records ?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete !",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.value) {
                    Swal.fire({
                        text: "Successful deletion !",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(function() {
                        // Remove all selected customers
                        checkboxes.forEach(c => {
                            if (c.checked) {
                                datatable.row($(c.closest('tbody tr'))).remove().draw();
                            }
                        });

                        // Remove header checked box
                        const headerCheckbox = table.querySelectorAll('[type="checkbox"]')[0];
                        headerCheckbox.checked = false;
                    }).then(function() {
                        toggleToolbars(); // Detect checked checkboxes
                        initToggleToolbar(); // Re-init toolbar to recalculate checkboxes
                    });
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Deletion error",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it !",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    });
                }
            });
        });
    }

    // Toggle toolbars
    const toggleToolbars = () => {
        // Select refreshed checkbox DOM elements
        const allCheckboxes = table.querySelectorAll('tbody [type="checkbox"]');

        // Detect checkboxes state & count
        let checkedState = false;
        let count = 0;

        // Count checked boxes
        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        // Toggle toolbars
        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    return {
        // public functions
        init: function(target, url, columns) {
            initDatatable(target, url, columns);
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
        }
    };
}();

var MyScriptGeneral = function() {
    // Active button
    var handleToggleActive = function() {
        $('.card-body').on('click', '.toggle-active', function(e) {
            //e.preventDefault();
            var btn = $(this);
            $.ajax({
                method: 'GET',
                url: $(this).data('url'),
                success: function(data, textStatus, jqXHR) {
                    if (btn.data('reload')) {
                        datatable.reload();
                    } else {
                        var label_on = btn.data('label-on');
                        var label_off = btn.data('label-off');
                        if (btn.hasClass('btn-light-success')) {
                            btn.html(btn.html().replace(label_on, label_off));
                        } else {
                            btn.html(btn.html().replace(label_off, label_on));
                        }
                        btn.toggleClass('btn-light-success btn-light-danger');
                        btn.find('i').toggleClass('la-toggle-on la-toggle-off');
                        btn.blur();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Status ' + textStatus + ' : ' + errorThrown);
                }
            });
        });
    }

    // Shortcut save button
    var handleLinkSave = function() {
        $('.my-link__save').on('click', function(e) {
            e.preventDefault();
            $($(this).attr('href')).trigger('click');
        });
    }

    // Change language
    var handleChangeLanguage = function() {
        var lang = 'fr';
        $('.input-multilangue').not('.lang-' + lang).parents('.field-wrapper').hide();
        $('.lang-change[data-lang="' + lang + '"]').addClass('active');

        $('.lang-change').on('click', function(e) {
            e.preventDefault();

            if (!$(this).hasClass('active')) {
                var data_lang = $(this).data('lang');
                $('.input-multilangue').parents('.field-wrapper').hide();
                $('.input-multilangue.lang-' + data_lang).parents('.field-wrapper').fadeIn();
                $('.lang-change').removeClass('active');
                $('.lang-change[data-lang="' + data_lang + '"]').addClass('active');
            }
        });
    }

    return {
        // public functions
        init: function() {
            handleToggleActive();
            handleLinkSave();
            handleChangeLanguage();
        }
    };
}();

// On document ready
jQuery(document).ready(function() {
    MyScriptGeneral.init();
});
