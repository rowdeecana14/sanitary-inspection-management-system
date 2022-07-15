$(document).ready(function(){
    fields = ['si_position', 'cho_position', 'sanitary_inspector_id', 'city_health_officer_id'];
    let module = 'signature';
    let module_label = 'Signature';

    let table_main = $('.table-main').DataTable( {
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
            { "data": "images" },
            { "data": "signatures" },
            { "data": "name" },
            { "data": "type" },
            { "data": "updated_at" },
            { "data": "action" },
        ]
    });

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

        loadTable($('.table-main'), response.data);
        $('[data-toggle="tooltip"]').tooltip()
    }

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

            // 4 => Medical Certificates
            if([4, 5, 6].includes(id)) {
                $('.sanitary_inspector').hide();
            }
            else {
                $('.sanitary_inspector').show();
            }

        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });

    $("#edit-form").validate({
        // ignore: 'hidden',
        rules: {
            email: {
                required: true,
                email: true
            }
        },
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

    $(document).on('select2:select', '#sanitary_inspector_id', async function() {
        runLoader($('#edit-modal .modal-content'));
        let health_official_id = $(this).val();

        let payload = {
            module: module,
            action: 'health_official',
            csrf_token: app_csrf_token,
            id: health_official_id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            $('#si_position').val(response.data.position);
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });

    $(document).on('select2:select', '#city_health_officer_id', async function() {
        runLoader($('#edit-modal .modal-content'));
        let health_official_id = $(this).val();

        let payload = {
            module: module,
            action: 'health_official',
            csrf_token: app_csrf_token,
            id: health_official_id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            $('#cho_position').val(response.data.position);
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });


});