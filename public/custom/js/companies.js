
$(document).ready(function(){
    fields = ['name', 'establishment_id', 'owner', 'contact_no', 'email', 'address', 'status'];
    profile_fields = [
        'name', 'establishment', 'owner', 'contact_no', 'email', 'address', 'status', 'created_by', 'created_at', 'updated_by', 'updated_at'
    ];
    let id = null;
    let module_label = 'Company';
    let module = 'company';
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
            { "data": "name" },
            { "data": "establishment" },
            { "data": "owner" },
            { "data": "contact_no" },
            { "data": "status" },
            { "data": "action" },
        ]
    });

    let table_sanitary_permits = $('.table_sanitary_permits').DataTable( {
        paging:  true,
        search: {
            return: true
        },
        columns: [
            { "data": "index" },
            { "data": "issued_at" },
            { "data": "expired_at" },
            { "data": "or_no" },
            { "data": "amount" },
            { "data": "paid_at" },
        ]
    });

    let table_business_permits = $('.table_business_permits').DataTable( {
        paging:  true,
        search: {
            return: true
        },
        columns: [
            { "data": "index" },
            { "data": "issued_at" },
            { "data": "expired_at" },
            { "data": "or_no" },
            { "data": "amount" },
            { "data": "paid_at" },
        ]
    });

    table_main.on( 'order.dt search.dt', function () {
        table_main.column(0, {}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    table_sanitary_permits.on( 'order.dt search.dt', function () {
        table_sanitary_permits.column(0, {}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

    table_business_permits.on( 'order.dt search.dt', function () {
        table_business_permits.column(0, {}).nodes().each( function (cell, i) {
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

        loadTable($('.table-main'), response.data);
        $('[data-toggle="tooltip"]').tooltip()
    }

    $('.table-list tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table_list.$('tr.selected').removeClass('selected');
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
            showModalDetails($('#edit-modal'), response.data);
            initSelect($('#edit-modal .select2-list'));
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });

    $(document).on('click', '.btn-show', async function() {
        $('#show-modal').modal('show');
        runLoader($('#show-modal .modal-content'));

        id =  Number($(this).data('id'));
        let payload = {
            module: module,
            action: 'profile',
            csrf_token: app_csrf_token,
            id: id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            showModalProfile($('#show-modal'), response.data.profile);
            loadTable($('.table_sanitary_permits'), response.data.sanitary_permits);
            loadTable($('.table_business_permits'), response.data.business_permits);
        }
        else {
            serverError();
        }

        $('#show-modal .modal-content').waitMe("hide");
    });

    $(document).on('click', '.btn-create', function() {
        $('#create-modal').modal('show');
        initSelect($('#create-modal .select2-list'));
    });

    $("#create-form").validate({
        ignore: 'hidden',
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
        }
        else {
            serverError();
        }
        
        $('#create-modal .modal-content').waitMe("hide");
        $('#create-modal').modal('hide');
    });

    $("#edit-form").validate({
        ignore: 'hidden',
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
});