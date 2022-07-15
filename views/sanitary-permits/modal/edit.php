<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit pr-1"></i> EDIT SANITARY PERMIT
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-pills nav-secondary nav-pills-no-bd tablist" id="pills-tab-without-border" role="tablist">
                    <li class="nav-item tab-link" >
                        <a class="nav-link active current details default-tab" data-tab="details"  id="pills-details-tab-2-nobd" data-toggle="pill" href="#pills-details-2-nobd" role="tab" aria-controls="pills-details-2-nobd" aria-selected="false"><i class="fas fa-address-card pr-1"></i> Details</a>
                    </li>
                    <li class="nav-item tab-link" >
                        <a class="nav-link inspection" data-tab="inspection" id="pills-inspection-2-tab-nobd" data-toggle="pill" href="#pills-inspection-2-nobd" role="tab" aria-controls="pills-inspection-2-nobd" aria-selected="false"><i class="fa fa-search-minus pr-1"></i> Inspection</a>
                    </li>
                </ul>
                <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                    <div class="tab-pane fade show active details-tab-content default-tab-content" id="pills-details-2-nobd" role="tabpanel" aria-labelledby="pills-details-2-tab-nobd">
                        <div class="card">
                            <div class="card-body">
                                <form id="details_form_edit">
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="company_id">Company Name <span class="required-label">*</span></label>
                                                <div class="select2-input">
                                                    <select id="company_id" name="company_id" class="form-control select2-list required"
                                                        data-module="company" data-action="select2">
                                                        <option value="" disabled selected>Select Company</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="issued_at">Date Issued <span class="required-label">*</span></label>
                                                <input type="text" class="form-control required datepicker input" id="issued_at" name="issued_at"
                                                    style="opacity: 1 !important; border-color: #2f7e32 !important; color: #2f7e32 !important;">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="or_no">OR No. <span class="required-label">*</span></label>
                                                <input type="text" class="form-control required input" id="or_no" name="or_no" >
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="expired_at">Date Expired <span class="required-label">*</span></label>
                                                <input type="text" class="form-control datepicker required input"
                                                    style="opacity: 1 !important; border-color: #2f7e32 !important; color: #2f7e32 !important;"
                                                    id="expired_at" name="expired_at" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="amount">Amount Paid <span class="required-label">*</span></label>
                                                <input type="text" class="form-control required number-decimals-only input" id="amount" name="amount">
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6">
                                            <div class="form-group">
                                                <label for="paid_at">Date Paid <span class="required-label">*</span></label>
                                                <input type="text" class="form-control datepicker required current-date input" id="paid_at" name="paid_at"
                                                    style="opacity: 1 !important; border-color: #2f7e32 !important; color: #2f7e32 !important;" >
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-lg-6 sanitary_inspector">
                                            <div class="form-group">
                                                <label data-type="edit" for="sanitary_inspector_id">Sanitary Inspector <span class="required-label">*</span></label>
                                                <div class="select2-input">
                                                    <select  data-type="edit"  id="sanitary_inspector_id" name="sanitary_inspector_id" 
                                                        class="form-control select2-list required sanitary_inspector_id" 
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
                                                <label for="city_health_officer_id">Medical Officer<span class="required-label">*</span></label>
                                                <div class="select2-input">
                                                    <select data-type="edit" id="city_health_officer_id" name="city_health_officer_id" class="form-control select2-list required city_health_officer_id" 
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
                        </div>
                    </div>
                    <div class="tab-pane fade inspection-tab-content" id="pills-inspection-2-nobd" role="tabpanel" aria-labelledby="pills-inspection-2-tab-nobd">
                        <div class="card">
                            <div class="card-body">
                                <form id="inspection_form_edit">
                                    <div class="form-group">
                                        <div class="d-flex flex-row">
                                            <div class="">
                                                <label>Checklists <span class="required-label">*</span></label>
                                            </div>
                                            <div class="form-check ml-2">
                                                <label class="form-check-label">[
                                                    <input class="form-check-input checkall" type="checkbox" name="checkall" value="checkall" data-type="edit-modal">
                                                    <span class="form-check-sign">Check all</span>
                                                    ]
                                                </label>
                                            </div>
                                        </div>
                                        <div class="checklist-content">
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="text-center"  style="text-align: left !important;
                                                        font-size: 16px;
                                                        font-weight: bold;">
                                                        <span>RATING:  <span class="rating">0%</span></span>
                                                    </td>
                                                    <td colspan="2"></td></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center text-bold" style="background-color: #ffad46; color: white">
                                                        <span class="statisfaction" >0%</span>
                                                        <br>
                                                        <span>SATISFACTION</span>
                                                    </td>
                                                    <td class="text-center  text-bold" style="background-color: #1572e8; color: white">
                                                        <span class="very_statisfaction">0%</span>
                                                        <br>
                                                        <span>VERY SATISFACTION</span>
                                                    </td>
                                                    <td class="text-center  text-bold" style="background-color: #31ce36; color: white">
                                                        <span class="excelent">0%</span>
                                                        <br>
                                                        <span>EXCELLENT</span>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer no-bd">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times-circle"></i> Close</button>
                <button type="button" class="btn btn-secondary btn-save-edit"><i class="fas fa-check-circle"></i> Save</button>
            </div>
        </div>
    </div>
</div>