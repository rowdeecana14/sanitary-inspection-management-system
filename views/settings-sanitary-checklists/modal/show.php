<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-list-ul pr-1"></i> SANITARY CHECKLIST
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="satisfaction_from">Satisfaction Rate From <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only" min="0" max="100" id="satisfaction_from" name="satisfaction_from" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="satisfaction_to">Satisfaction Rate To <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only" min="0" max="100" id="satisfaction_to" name="satisfaction_to" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="very_satisfaction_from">Very Satisfaction Rate From <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only" min="0" max="100" id="very_satisfaction_from" name="very_satisfaction_from" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="very_satisfaction_to">Very Satisfaction Rate To <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only" min="0" max="100" id="very_satisfaction_to" name="very_satisfaction_to" readonly>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="excelent_from">Excelent Rate From <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only rate" min="0" max="100" id="excelent_from" name="excelent_from" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="excelent_to">Excelent Rate To <span class="required-label">*</span></label>
                                    <input type="number" class="form-control required input number-decimals-only rate" min="0" max="100" id="excelent_to" name="excelent_to" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Checklists <span class="required-label">*</span></label>
                            <ul class="list-group list-group-flush checklist-content">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
            </div>
        </div>
    </div>
</div>