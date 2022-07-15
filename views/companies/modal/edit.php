<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> EDIT COMPANIES
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
                                <label for="edit_business_id">Business Name <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="edit_establishment_id">Establishment <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_establishment_id" name="establishment_id" class="form-control select2-list required" 
                                        data-module="establishment" data-action="select2">
                                        <option value="" disabled selected>Select Establishment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="owner">Owner <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="owner" name="owner">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No. <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="contact_no" name="contact_no">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="email">Email <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="status">Status <span class="required-label">*</span></label>
                                <select id="status" name="status" class="form-control select-group required" >
                                    <option value="" disabled selected>Select Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="address">Address <span class="required-label">*</span></label>
                                <input type="text" class="form-control required input" id="address" name="address">
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