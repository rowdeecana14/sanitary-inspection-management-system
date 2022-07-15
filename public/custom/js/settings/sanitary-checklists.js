
$(document).ready(function(){
    fields = ['satisfaction_from', 'satisfaction_to', 'very_satisfaction_from', 'very_satisfaction_to', 'excelent_from', 
    'excelent_to', 'module_id', 'updated_at'];
    let id = null;
    let module_label = 'Sanitary Checklist';
    let module = 'sanitary_checklist';
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
            { "data": "name" },
            { "data": "satistfaction" },
            { "data": "very_satisfaction" },
            { "data": "excelent" },
            { "data": "updated_at" },
            { "data": "action" },
        ]
    });

    table.on( 'order.dt search.dt', function () {
        table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
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

    function showChecklists(element, checklists, checklist_assigns) {
        let content = '';

        Object.keys(checklists).forEach(key => {

            if(!['', null].includes(checklists[key])) {
                let id = checklists[key].id;
                let description = checklists[key].description;
                let checked = checkAssignChecklist(id, checklist_assigns) == true ? 'checked' : '';

                content +=`
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="checklists" value="${id}" ${checked}>
                            <span class="form-check-sign">${description}</span>
                        </label>
                    </div>
               `;
            }
        });

        $(element).find('.checklist-content').html(content);
    }

    function showChecklistAssigns(element, checklist_assigns) {
        let content = '';

        Object.keys(checklist_assigns).forEach(key => {

            if(!['', null].includes(checklist_assigns[key])) {
                let description = checklist_assigns[key].checklist;

                content +=`
                    <li class="list-group-item"><i class="fas fa-dot-circle"></i> <span style="margin-top: -3px; margin-left: 5px">${description}</span></li>
               `;
            }
        });

        $(element).find('.checklist-content').html(content);
    }

    function checkAssignChecklist(id, checklist_assigns) {
        for(let count = 0; count < checklist_assigns.length; count++) {
            if(checklist_assigns[count].checklist_id == id) {
                return true;
            }
        }
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
            showModalDetails($('#edit-modal'), response.data.sanitary_checklist);
            showChecklists($('#edit-modal'), response.data.checklists,  response.data.checklist_assigns);
        }
        else {
            serverError();
        }

        $('#edit-modal .modal-content').waitMe("hide");
    });

    $("#edit-form").validate({
        ignore: 'hidden',
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

    $(document).on('click', '.btn-show', async function() {
        $('#show-modal').modal('show');
        runLoader($('#show-modal .modal-content'));
        
        id =  Number($(this).data('id'));
        let payload = {
            module: module,
            action: 'show',
            csrf_token: app_csrf_token,
            id: id,
        };
        let response = await Api.show(payload);

        if(response.success) {
            showModalDetails($('#show-modal'), response.data.sanitary_checklist);
            showChecklistAssigns($('#show-modal'), response.data.checklist_assigns)
        }
        else {
            serverError();
        }

        $('#show-modal .modal-content').waitMe("hide");
    });

    $(document).on('input', '#satisfaction_from', async function() {
        let satisfaction_from = Number($('#satisfaction_from').val());
        let satisfaction_to =  Number($('#satisfaction_to').val());
        let very_satisfaction_from = Number($('#very_satisfaction_from').val());
        let very_satisfaction_to = Number($('#very_satisfaction_to').val());
        let excelent_from = Number($('#excelent_from').val());
        let excelent_to =  Number($('#excelent_to').val());

        $('#satisfaction_from').prop('min', 0).prop('max', 100);
        $('#satisfaction_to').prop('min', satisfaction_from + 1).prop('max', very_satisfaction_from - 1);
        $('#very_satisfaction_from').prop('min', satisfaction_to + 1).prop('max', very_satisfaction_to - 1);
        $('#very_satisfaction_to').prop('min', very_satisfaction_from + 1).prop('max', excelent_from - 1);
        $('#excelent_from').prop('min', very_satisfaction_to + 1).prop('max', excelent_to - 1);
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });

    $(document).on('input', '#satisfaction_to', async function() {
        let satisfaction_from = Number($('#satisfaction_from').val());
        let satisfaction_to =  Number($('#satisfaction_to').val());
        let very_satisfaction_from = Number($('#very_satisfaction_from').val());
        let very_satisfaction_to = Number($('#very_satisfaction_to').val());
        let excelent_from = Number($('#excelent_from').val());
        let excelent_to =  Number($('#excelent_to').val());

        $('#satisfaction_to').prop('min', satisfaction_from + 1).prop('max', 100);
        $('#very_satisfaction_from').prop('min', satisfaction_to + 1).prop('max', very_satisfaction_to - 1);
        $('#very_satisfaction_to').prop('min', very_satisfaction_from + 1).prop('max', excelent_from - 1);
        $('#excelent_from').prop('min', very_satisfaction_to + 1).prop('max', excelent_to - 1);
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });

    $(document).on('input', '#very_satisfaction_from', async function() {
        let satisfaction_to =  Number($('#satisfaction_to').val());
        let very_satisfaction_from = Number($('#very_satisfaction_from').val());
        let very_satisfaction_to = Number($('#very_satisfaction_to').val());
        let excelent_from = Number($('#excelent_from').val());
        let excelent_to =  Number($('#excelent_to').val());

        $('#very_satisfaction_from').prop('min', satisfaction_to + 1).prop('max', 100);
        $('#very_satisfaction_to').prop('min', very_satisfaction_from + 1).prop('max', excelent_from - 1);
        $('#excelent_from').prop('min', very_satisfaction_to + 1).prop('max', excelent_to - 1);
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });

    $(document).on('input', '#very_satisfaction_to', async function() {
        let very_satisfaction_from = Number($('#very_satisfaction_from').val());
        let very_satisfaction_to = Number($('#very_satisfaction_to').val());
        let excelent_from = Number($('#excelent_from').val());
        let excelent_to =  Number($('#excelent_to').val());

        $('#very_satisfaction_to').prop('min', very_satisfaction_from + 1).prop('max', 100);
        $('#excelent_from').prop('min', very_satisfaction_to + 1).prop('max', excelent_to - 1);
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });

    $(document).on('input', '#excelent_from', async function() {
        let very_satisfaction_to = Number($('#very_satisfaction_to').val());
        let excelent_from = Number($('#excelent_from').val());

        $('#excelent_from').prop('min', very_satisfaction_to + 1).prop('max', 100);
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });

    $(document).on('input', '#excelent_to', async function() {
        let excelent_from = Number($('#excelent_from').val());
        $('#excelent_to').prop('min', excelent_from + 1).prop('max', 100);
    });
});