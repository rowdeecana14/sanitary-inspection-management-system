<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> EDIT HEALTH CERTIFICATE
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_resident_id">Name <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_resident_id" name="resident_id" class="resident_id form-control select2-list required" 
                                        data-module="resident" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="issued_at">Date Issued<span class="required-label">*</span></label>
                                <input type="text" class="form-control datepicker required input" id="issued_at" name="issued_at">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group" >
                                <label for="edit_baranggay_id">Baranggay <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_baranggay_id" name="baranggay_id" class="form-control select2-list required" 
                                        data-module="baranggay" data-action="select2">
                                        <option value="" disabled selected>Select Barrangay</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_purok_id">Purok <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_purok_id" name="purok_id" class="form-control select2-list required"
                                        data-module="purok" data-action="select2">
                                        <option value="" disabled selected>Select Purok</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="street_building_house">Street/Buiding No/House No <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="street_building_house" name="street_building_house">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_gender_id">Gender <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_gender_id" name="gender_id" class="form-control select2-list required"
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
                                <label for="edit_civil_status_id">Civil Status <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_civil_status_id" name="civil_status_id" class="form-control select2-list required"
                                        data-module="civil_status" data-action="select2">
                                        <option value="" disabled selected>Select Civil Status</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_occupation_id">Occupation <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_occupation_id" name="occupation_id" class="form-control select2-list required"
                                        data-module="occupation" data-action="select2">
                                        <option value="" disabled selected>Select Occupation</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="place_of_work">Place of Work<span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="place_of_work" name="place_of_work">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 sanitary_inspector">
                            <div class="form-group">
                                <label for="edit_sanitary_inspector_id">Sanitary Inspector <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_sanitary_inspector_id" name="sanitary_inspector_id" class="form-control select2-list required" 
                                        data-module="health_official" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 sanitary_inspector">
                            <div class="form-group">
                                <label for="edit_si_position">Position <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="edit_si_position" name="si_position" >
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_city_health_officer_id">City Health Officer<span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_city_health_officer_id" name="city_health_officer_id" class="form-control select2-list required" 
                                        data-module="health_official" data-action="select2">
                                        <option value="" disabled selected>Select Name</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_cho_position">Position <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="edit_cho_position" name="cho_position" >
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