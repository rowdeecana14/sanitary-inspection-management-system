<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> ADD EXHUMATION CERTIFICATE
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
                                <label for="resident_id">Name <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="resident_id" name="resident_id" class="resident_id form-control select2-list required" 
                                        data-module="resident" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="name_of_deceased">Name of Deceased <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="name_of_deceased" name="name_of_deceased">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="relationship_id">Relationship <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="relationship_id" name="relationship_id" class="form-control select2-list required" 
                                    data-module="relationship" data-action="select2">
                                        <option value="" disabled selected>Select Relationship</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="civil_status_id">Civil Status <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="civil_status_id" name="civil_status_id" class="form-control select2-list required"
                                        data-module="civil_status" data-action="select2">
                                        <option value="" disabled selected>Select Civil Status</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="citizenship_id">Citizenship <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="citizenship_id" name="citizenship_id" class="form-control select2-list required"
                                        data-module="citizenship" data-action="select2">
                                        <option value="" disabled selected>Select Citizenship</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="cause_of_death">Cause of Death <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="cause_of_death" name="cause_of_death">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="death_at">Date of Death <span class="required-label">*</span></label>
                                <input type="text" class="form-control required datepicker" id="death_at" name="death_at">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="or_no">OR No. <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="or_no" name="or_no">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="paid_at">Date Paid<span class="required-label">*</span></label>
                                <input type="text" class="form-control required datepicker current-date input" id="paid_at" name="paid_at">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="amount">Amount Paid<span class="required-label">*</span></label>
                                <input type="number" class="form-control required nunmber-decimals-only input" id="amount" name="amount">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="issued_at">Date Issued<span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required input current-date" id="issued_at" name="issued_at">
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