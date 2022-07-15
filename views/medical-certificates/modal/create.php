<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> ADD MEDICAL CERTIFICATE
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
                                <label for="issued_at">Date Issued<span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required current-date input" id="issued_at" name="issued_at">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group" >
                                <label for="baranggay_id">Baranggay <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="baranggay_id" name="baranggay_id" class="form-control select2-list required" 
                                        data-module="baranggay" data-action="select2">
                                        <option value="" disabled selected>Select Barrangay</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="purok_id">Purok <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="purok_id" name="purok_id" class="form-control select2-list required"
                                        data-module="purok" data-action="select2">
                                        <option value="" disabled selected>Select Purok</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="street_building_house">Street/Buiding No/House No <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="street_building_house" name="street_building_house">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="gender_id">Gender <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="gender_id" name="gender_id" class="form-control select2-list required"
                                        data-module="gender" data-action="select2">
                                        <option value="" disabled selected>Select Gender</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="age">Age<span class="required-label">*</span></label>
                                <input type="text" class="form-control required numbers-only input" id="age" name="age">
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
                                <label for="height">Height (Cms)<span class="required-label">*</span></label>
                                <input type="text" class="form-control required numbers-only input" id="height" name="height">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="weight">Weight (Kls)<span class="required-label">*</span></label>
                                <input type="text" class="form-control required numbers-only input" id="weight" name="weight">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="blood_pressure">Blood Pressure <span class="required-label">*</span></label>
                                <input type="text" class="form-control required blood-pressure-only" id="blood_pressure" name="blood_pressure">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="fit_for">Fit for <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="fit_for" name="fit_for">
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
                                <label for="amount">Amount Paid <span class="required-label">*</span></label>
                                <input type="text" class="form-control required number-decimals-only current-date input" id="amount" name="amount">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="paid_at">Date Paid<span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required current-date input" id="paid_at" name="paid_at">
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