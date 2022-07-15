<div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> ADD COMPANIES
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
                                <label for="name">Business Name <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="establishment_id">Establishment <span class="required-label">*</span></label>
                                <div class="select2-input">
                                    <select id="establishment_id" name="establishment_id" class="form-control select2-list required" 
                                        data-module="establishment" data-action="select2">
                                        <option value="" disabled selected>Select Establishment</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="owner">Owner <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="owner" name="owner">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="contact_no">Contact No. <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="contact_no" name="contact_no">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="email">Email <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="address">Address <span class="required-label">*</span></label>
                                <input type="text" class="form-control required" id="address" name="address">
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