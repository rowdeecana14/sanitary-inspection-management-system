
$(document).ready(function(){
    fields = [ 
        'permit_no', 'company_id', 'issued_at', 'expired_at', 'or_no', 'amount', 'paid_at', 
        'city_health_officer_id', 'sanitary_inspector_id', 'cho_position', 'si_position',
    ];
    let id = null;
    let module_label = 'Sanitary Permit';
    let module = 'sanitary_permit';
    let action_type = 'create';
    let checklists = [];
    let tab_list = {
        1: {
            "name": "details",
            'validation': () => detailsValidation()
        },
        2: {
            "name": "inspection",
            'validation':  () => inspectionValidation()
        },
    };
    let table = $('.table-main').DataTable( {
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
            { "data": "permit_no" },
            { "data": "company" },
            { "data": "issued_at" },
            { "data": "expired_at" },
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

    function showChecklists(element, checklists) {
        let content = '';

        Object.keys(checklists).forEach(key => {

            if(!['', null].includes(checklists[key])) {
                let id = checklists[key].checklist_id;
                let description = checklists[key].checklist;

                content +=`
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checklist-checkbox required" type="checkbox" name="checklists" value="${id}" data-type="create-modal">
                            <span class="form-check-sign">${description}</span>
                        </label>
                    </div>
               `;
            }
        });

        $(element).find('.checklist-content').html(content);
    }

    function showChecklistsUpdate(element, checklists, inspection_checklists) {
        let content = '';

        Object.keys(checklists).forEach(key => {

            if(!['', null].includes(checklists[key])) {
                let id = checklists[key].checklist_id;
                let description = checklists[key].checklist;
                let checked = isChecklistInspect(id, inspection_checklists) ? 'checked' : '';

                content +=`
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input checklist-checkbox required" type="checkbox" name="checklists" value="${id}" ${checked} data-type="edit-modal">
                            <span class="form-check-sign">${description}</span>
                        </label>
                    </div>
               `;
            }
        });

        $(element).find('.checklist-content').html(content);
    }

    function isChecklistInspect(checklist_id, inspection_checklists) {
        let checked = false;

        for (let index = 0; index < inspection_checklists.length; index++) {
            const inspection = inspection_checklists[index];

            if(Number(checklist_id) == Number(inspection.checklist_id)) {
               checked = true;
               break;
            }
        }

        return checked;
    }

    function getTabIndex(tab_name) {
        let index = null;

        Object.keys(tab_list).forEach(key => {
            const tab = tab_list[key];

            if(tab_name == tab.name) {
                index = key;
            }
        });

        return Number(index);
    }

    function tabsValidation(current_tab_index, selected_tab_index) {
        if(current_tab_index < selected_tab_index) {
           return tab_list[current_tab_index].validation();
        }

        return true;
    }

    function tabsNavigation(current_tab, selected_tab) {
        let length = Object.keys(tab_list).length;
        let selected_tab_index = getTabIndex(selected_tab);

        if(action_type == "create") {
            $('#create-modal .tablist .current').removeClass('current');
            $(`#create-modal .${selected_tab}`).addClass('current');
        }
        else {
            $('#edit-modal .tablist .current').removeClass('current');
            $(`#edit-modal .${selected_tab}`).addClass('current');
        }
    }

    function detailsValidation() {
        let form = action_type == "create" ? "#details_form" : "#details_form_edit";

        $(form).validate({
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

        if(!$(form).valid()) {
            $(form).validate().focusInvalid();
            return false;
        }

        return true;
    }

    function inspectionValidation() {
        let form = action_type == "create" ? "#inspection_form" : "#inspection_form_edit";

        $(form).validate({
            ignore: 'hidden',
            errorPlacement: $.noop,
            highlight: function(element) {
               
                if($(element).is('select') ) {
                    let select2_selection = $(element).parent().find('.select2-selection');
                    let select2_selection_rendered = $(element).parent().find('.select2-selection__rendered');
    
                    $(select2_selection).attr("style", "border-color: #F25961 !important;");
                    $(select2_selection_rendered).attr("style", "border-color: #F25961 !important;");
                }
                else {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                    $(".error").remove("error");
                }
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

        if(!$(form).valid()) {
            $(form).validate().focusInvalid();
            return false;
        }

        return true;
    }

    function getExpirationDate(date) {
        var date = new Date(date);
        date = new Date(date.setYear(date.getFullYear() + 1));
        
        return (date.getMonth() + 1) + '/' + date.getDate() + '/' + date.getFullYear();
    }

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

        action_type = "edit";
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
            showModalDetails($('#edit-modal'), response.data.sanitary_permit);
            showChecklistsUpdate($('#edit-modal'), response.data.checklists, response.data.inspection_checklists);

            checklists = response.data.checklists;
            let sanitary_checklists = response.data.sanitary_checklists;
            let inspection_checklists = response.data.inspection_checklists;

            let rating = (inspection_checklists.length / checklists.length ) * 100;
            rating =  parseInt(rating).toFixed(0) + " %";

            $('.rating').text(rating);
            $('.statisfaction').text(`${sanitary_checklists.satisfaction_from}-${sanitary_checklists.satisfaction_to}%`);
            $('.very_statisfaction').text(`${sanitary_checklists.very_satisfaction_from}-${sanitary_checklists.very_satisfaction_to}%`);
            $('.excelent').text(`${sanitary_checklists.excelent_from}-${sanitary_checklists.excelent_to}%`);
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

        action_type = "create";
        let payload = {
            module: module,
            action: 'create',
            csrf_token: app_csrf_token,
        };
        let response = await Api.show(payload);

        if(response.success) {
            initSelect($('#create-modal .select2-list'));
            showModalDetails($('#create-modal'), response.data.fees);
            showChecklists($('#create-modal'), response.data.checklists);

            checklists = response.data.checklists;
            let sanitary_checklists = response.data.sanitary_checklists;
            let expired_at = getExpirationDate($('.current-date').val());

            $('#expired_at').val(expired_at).trigger('change');
            $('.statisfaction').text(`${sanitary_checklists.satisfaction_from}-${sanitary_checklists.satisfaction_to}%`);
            $('.very_statisfaction').text(`${sanitary_checklists.very_satisfaction_from}-${sanitary_checklists.very_satisfaction_to}%`);
            $('.excelent').text(`${sanitary_checklists.excelent_from}-${sanitary_checklists.excelent_to}%`);
        }
        else {
            serverError();
        }

        $('#create-modal .modal-content').waitMe("hide");
    });

    $("#create-form").validate({
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

    $(document).on('select2:select', '.sanitary_inspector_id', async function() {
        let type = $(this).attr('data-type');
        runLoader($(`#${type}-modal .modal-content`));
        let sanitary_permit_id = $(this).val();

        let payload = {
            module: 'signature',
            action: 'health_official',
            csrf_token: app_csrf_token,
            id: sanitary_permit_id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            $(`#${type}_si_position`).val(response.data.position).trigger('change');
        }
        else {
            serverError();
        }

        $(`#${type}-modal .modal-content`).waitMe("hide");
    });

    $(document).on('click', '.btn-print', function() {
        let sanitary_permit_id = $(this).attr('data-id');
        window.location.href = `${base_url}/views/sanitary-permits/print.php?id=${sanitary_permit_id}`;
    });

    $('.btn-save').on('click', async function() {
        let total_form = Object.keys(tab_list).length;
        let total_form_validated = 0;

        Object.keys(tab_list).forEach(key => {
            if(tab_list[key].validation()) {
                total_form_validated += 1;
            }
        });

        if(total_form == total_form_validated) {
            runLoader($('#create-modal .modal-content'));

            let form = new FormData(document.querySelector('#details_form'));
            let inspection =  $('#inspection_form').serializeArray();

            form = appendData(form, inspection);
            form.append('module',  module);
            form.append('action', 'store');
            form.append('csrf_token', app_csrf_token);

            let response = await Api.store(serialize(form))

            if(response.success) {
                formReset($('#details_form'));
                formReset($('#inspection_form'));
                resetTabs(tab_list, action_type);
                
                saveMessage(`${module_label} successfully saved.`);
                preloadTable();
            }
            else {
                serverError();
            }

            $('#create-modal .modal-content').waitMe("hide");
            $('#create-modal').modal('hide');
        }
        else {
            errorMessage(`Fill out all required fields.`);

        }
    });

    $('.btn-save-edit').on('click', async function() {
        let total_form = Object.keys(tab_list).length;
        let total_form_validated = 0;

        Object.keys(tab_list).forEach(key => {
            if(tab_list[key].validation()) {
                total_form_validated += 1;
            }
        });

        if(total_form == total_form_validated) {
            runLoader($('#edit-modal .modal-content'));

            let form = new FormData(document.querySelector('#details_form_edit'));
            let inspection =  $('#inspection_form_edit').serializeArray();

            form = appendData(form, inspection);
            form.append('module',  module);
            form.append('action', 'update');
            form.append('id', id);
            form.append('csrf_token', app_csrf_token);

            let response = await Api.store(serialize(form))

            if(response.success) {
                formReset($('#details_form_edit'));
                formReset($('#inspection_form_edit'));
                resetTabs(tab_list, action_type);
                
                updateMessage(`${module_label} successfully updated.`);
                preloadTable();
            }
            else {
                serverError();
            }

            $('#edit-modal .modal-content').waitMe("hide");
            $('#edit-modal').modal('hide');
        }
        else {
            errorMessage(`Fill out all required fields.`);

        }
    });

    $(document).on('click', '.tab-link', function() {
        let modal = action_type == "create" ? "create-modal" : "edit-modal";
        let current_tab = $(`#${modal} .tablist .current`).attr('data-tab');
        let selected_tab = $(this).find('a').attr('data-tab');

        let current_tab_index = getTabIndex(current_tab);
        let selected_tab_index = getTabIndex(selected_tab);

        if(tabsValidation(current_tab_index, selected_tab_index)) {
            tabsNavigation(current_tab, selected_tab);
        }
        else {
            $(`#${modal} .${selected_tab}`).removeClass('active').removeClass('show');
            setTimeout(function() {
                $(`#${modal} .${selected_tab}-tab-content`).removeClass('active').removeClass('show');

                $(`#${modal} .${current_tab}`).addClass("active").addClass("show");
                $(`#${modal} .${current_tab}-tab-content`).addClass("active").addClass("show");
            }, 300);
        }
    });

    $('#issued_at').on('dp.change', function(e){
        let issued_at = $(this).val();
        let expired_at = getExpirationDate(issued_at);
        $('#expired_at').val(expired_at).trigger('change');
    });

    $('#edit_issued_at').on('dp.change', function(e){
        let issued_at = $(this).val();
        let expired_at = getExpirationDate(issued_at);
        $('#edit_expired_at').val(expired_at).trigger('change');
    });

    $(document).on('change', '.checklist-checkbox', function() {
        let type = $(this).attr('data-type');
        let total = $(`#${type} .checklist-checkbox:checked`).length;
        let rating = (total / checklists.length ) * 100;
        rating =  parseInt(rating).toFixed(0) + " %";

        $(`#${type} .rating`).text(rating);
    });

    $(document).on('change', '.checkall', function() {
        let type = $(this).attr('data-type');

        if($(this).is(":checked")) {
            $(`#${type} .checklist-checkbox`).each(function(index, element) {
                $(element).prop('checked', true);
            });
        }
        else {
            $(`#${type} .checklist-checkbox`).each(function(index, element) {
                $(element).prop('checked', false);
            });
        }

        let total = $(`#${type} .checklist-checkbox:checked`).length;
        let rating = (total / checklists.length ) * 100;
        rating =  parseInt(rating).toFixed(0) + " %";

        $(`#${type} .rating`).text(rating);
    });
});