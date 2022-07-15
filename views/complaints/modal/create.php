<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> ADD COMPLAINT
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="create-form">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="complainant_id">Complainant Resident <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="complainant_id" name="complainant_id" class="form-control select2-list required" 
                                        data-module="resident" data-action="select2">
                                        <option value="" disabled selected>Select Complainant</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="date_incident">Date Incident <span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required" id="date_incident" name="date_incident" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="complaint_type_id">Complaint Type<span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="complaint_type_id" name="complaint_type_id" class="form-control select2-list required"
                                        data-module="complaint_type" data-action="select2">
                                        <option value="" disabled selected>Select Complaint Type</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="date_reported">Date Reported <span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required" id="date_reported" name="date_reported">
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="statement">Complainant Statement <span class="required-label">*</span></label>
                                <input type="text" class="form-control" id="statement" name="statement" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="respondent_id">Respondent<span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="respondent_id" name="respondent_id" class="form-control select2-list required" 
                                        data-module="health_official" data-action="select2">
                                        <option value="" disabled selected>Select Respondent</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="person_involved_id">Person Involved <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="person_involved_id" name="person_involved_id" class="form-control select2-list required" 
                                        data-module="resident" data-action="select2">
                                        <option value="" disabled selected>Select Person Involved</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="incident_address">Incident Address<span class="required-label">*</span></label>
                                <input type="text" class="form-control" id="incident_address" name="incident_address" placeholder="" required>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="submit" form="create-form" class="btn btn-secondary"><i class="fas fa-check-circle"></i> Save</button>
            </div>
        </div>
    </div>
</div>