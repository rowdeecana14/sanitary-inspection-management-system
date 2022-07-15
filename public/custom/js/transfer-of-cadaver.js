
$(document).ready(function(){
    fields = [ 
        'resident_id', 'civil_status_id', 'relationship_id', 'citizenship_id', 'cemetery_id', 'city_health_officer_id', 'cho_position',
        'issued_at', 'or_no', 'amount', 'paid_at', 'name_of_deceased', 'cause_of_death', 'death_at', 'place_of_death', 'physician_id'
    ];
    let id = null;
    let module_label = 'Transfer of Cadaver';
    let module = 'transfer_cadaver';
    let table = $('.table').DataTable( {
        dom: 'Bfrtip',
        paging:  true,
        buttons: [
            'colvis'
        ],
        search: {
            return: true
        },
        columns: [
            { "data": "index" },
            { "data": "resident" },
            { "data": "name_of_deceased" },
            { "data": "relationship" },
            { "data": "issued_at" },
            { "data": "or_no" },
            { "data": "amount" },
            { "data": "paid_at" },
            { "data": "action" },
        ]
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    preloadTable();
    loadUserDetails();

    async function preloadTable() {
        let payload = {
            module: module,
            action: 'all',
            csrf_token: app_csrf_token,
        };

        let response = await Api.all(payload);

        if(!response.success) {
            serverError();
        }

        loadTable($('.table'), response.data);
        $('[data-toggle="tooltip"]').tooltip();
    }

    $('.table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    });
    
    $(document).on('click', '.btn-delete', async function()  {
        let confirm = await deleteConfirmation();

        if(confirm) {
            openLoaderModal();

            let payload = {
                module: module,
                action: 'remove',
                csrf_token: app_csrf_token,
                id:  Number($(this).data('id')),
            };
    
            let response = await Api.remove(payload);

            if(response.success) {
                deleteMessage(`${module_label} successfully deleted.`);
                preloadTable();
            }
            else {
                serverError();
            }

            closeLoaderModal();
        }
    });

    $(document).on('click', '.btn-edit', async function() {
        $('#edit-modal').modal('show');
        runLoader($('#edit-modal .modal-content'));

        id =  Number($(this).data('id'));
        let payload = {
            module: module,
            action: 'show',
            csrf_token: app_csrf_token,
            id: id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            initSelect($('#edit-modal .select2-list'));
            showModalDetails($('#edit-modal'), response.data);
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });

    $(document).on('click', '.btn-create', async function() {
        $('#create-modal').modal('show');
        runLoader($('#create-modal .modal-content'));
        
        $('.current-date').val(moment().format("MM/DD/YYYY")).trigger('change');

        let payload = {
            module: module,
            action: 'create',
            csrf_token: app_csrf_token,
        };
        let response = await Api.show(payload);

        if(response.success) {
            initSelect($('#create-modal .select2-list'));
            showModalDetails($('#create-modal'), response.data.fees);
        }
        else {
            serverError();
        }

        $('#create-modal .modal-content').waitMe("hide");
    });

    $("#create-form").validate({
        ignore: 'hidden',
        errorPlacement: $.noop,
        highlight: function(element) {
            
            if($(element).is('select') ) {
                let select2_selection = $(element).parent().find('.select2-selection');
                let select2_selection_rendered = $(element).parent().find('.select2-selection__rendered');

                $(select2_selection).attr("style", "border-color: #F25961 !important;");
                $(select2_selection_rendered).attr("style", "border-color: #F25961 !important;");
            }
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(".error").remove("error");
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');

            if($(element).is('select') ) {
                let select2_selection = $(element).parent().find('.select2-selection');
                let select2_selection_rendered = $(element).parent().find('.select2-selection__rendered');

                $(select2_selection).attr("style", "border-color: #2f7e32 !important;");
                $(select2_selection_rendered).attr("style", "border-color: #2f7e32 !important;");
            }
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).remove();
        },
    });

    $(document).on('submit', '#create-form', async function(e) {
        e.preventDefault();
        runLoader($('#create-modal .modal-content'));

        let form = new FormData(document.querySelector('#create-form'));
        form.append('module',  module);
        form.append('action', 'store');
        form.append('csrf_token', app_csrf_token);

        let response = await Api.store(serialize(form))

        if(response.success) {
            formReset($('#create-form'));
            saveMessage(`${module_label} successfully saved.`);
            preloadTable();

            window.location.href = `${base_url}/views/transfer-of-cadaver/print.php?id=${response.data.data.id}`;
        }
        else {
            serverError();
        }
        
        $('#create-modal .modal-content').waitMe("hide");
        $('#create-modal').modal('hide');
    });

    $("#edit-form").validate({
        ignore: 'hidden',
        // errorPlacement: $.noop,
        highlight: function(element) {
            if($(element).is('select') ) {
                let select2_selection = $(element).parent().find('.select2-selection');
                let select2_selection_rendered = $(element).parent().find('.select2-selection__rendered');

                $(select2_selection).attr("style", "border-color: #F25961 !important;");
                $(select2_selection_rendered).attr("style", "border-color: #F25961 !important;");
            }
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            $(".error").remove("error");
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');

            if($(element).is('select') ) {
                let select2_selection = $(element).parent().find('.select2-selection');
                let select2_selection_rendered = $(element).parent().find('.select2-selection__rendered');

                $(select2_selection).attr("style", "border-color: #2f7e32 !important;");
                $(select2_selection_rendered).attr("style", "border-color: #2f7e32 !important;");
            }
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).remove();
        },
    });

    $(document).on('submit', '#edit-form', async function(e) {
        e.preventDefault();
        runLoader($('#edit-modal .modal-content'));

        let form = new FormData(document.querySelector('#edit-form'));
        form.append('module',  module);
        form.append('action', 'update');
        form.append('id', id);
        form.append('csrf_token', app_csrf_token);

        let response = await Api.update(serialize(form));

        if(response.success) {
            formReset($('#edit-form'));
            updateMessage(`${module_label} successfully updated.`);
            preloadTable();
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
        $('#edit-modal').modal('hide');
    });

    $(document).on('click', '.btn-print', function() {
        let health_official_id = $(this).attr('data-id');
        window.location.href = `${base_url}/views/transfer-of-cadaver/print.php?id=${health_official_id}`;
    });

    $(document).on('select2:select', '.city_health_officer_id', async function() {
        let type = $(this).attr('data-type');
        runLoader($(`#${type}-modal .modal-content`));
        let health_official_id = $(this).val();

        let payload = {
            module: 'signature',
            action: 'health_official',
            csrf_token: app_csrf_token,
            id: health_official_id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            $(`#${type}_cho_position`).val(response.data.position).trigger('change');
        }
        else {
            serverError();
        }

        $(`#${type}-modal .modal-content`).waitMe("hide");
    });
});