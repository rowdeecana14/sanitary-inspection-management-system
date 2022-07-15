<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> EDIT SIGNATURE
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 sanitary_inspector">
                            <div class="form-group">
                                <label for="sanitary_inspector_id">Sanitary Inspector <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="sanitary_inspector_id" name="sanitary_inspector_id" class="form-control select2-list required" 
                                        data-module="health_official" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 sanitary_inspector">
                            <div class="form-group">
                                <label for="si_position">Position Label <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="si_position" name="si_position" >
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="city_health_officer_id">City Health Officer/ Medical Officer<span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="city_health_officer_id" name="city_health_officer_id" class="form-control select2-list required" 
                                        data-module="health_official" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="cho_position">Position Label <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="cho_position" name="cho_position" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" form="edit-form" class="btn btn-secondary"><i class="fas fa-check-circle"></i> Save</button>
            </div>
        </div>
    </div>
</div>