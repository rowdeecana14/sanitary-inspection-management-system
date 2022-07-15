<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-edit"></i> EDIT HEALTH OFFICIAL
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div> 
            <div class="modal-body">
                <form id="edit-form">
                    <div class="row">
                        <div class="col-md-6 col-lg-6">
                            <div class="card card-profile mt-2" style="margin-bottom: 0;">
                                <div class="card-header" style="background-image: url('../../public/assets/img/blogpost.jpg')">
                                    <div class="profile-picture">
                                        <div class="avatar avatar-xl  image-gallery">
                                            <a href="../../public/assets/img/config/female.png" class="image_href">
                                                <img src="../../public/assets/img/config/female.png" alt="..." class="avatar-img rounded-circle preview-image image_profile"  data-toggle="tooltip" data-placement="bottom" title="View Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding-bottom: 0px;">
                                    <div class="view-profile">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                <button type="button" class="btn btn-primary btn-sm  btn-border btn-round btn-open-camera mr-1" style="font-weight:900;"><i class="fas fa-camera-retro pl-1"></i> Camera</button>
                                            </div>
                                            <div>
                                                <input type="file" class="form-control required form-control edit-upload-image" id="edit_image" name="image" accept="image/*"  hidden>
                                                <label class="btn btn-primary btn-sm  btn-border btn-round ml-1" for="edit_image" style="font-weight:900; font-size: 12px !important;"><i class="fas fa-paperclip"></i> Choose</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-profile text-center mt-2">
										<div style="font-size: 15px;">Take photo/choose file</div>
                                        <div id="profileImage">
                                            <input type="hidden" name="image_to_upload" class="image_to_upload">
                                        </div>
                                        <div class="form-group text-left">
                                            <label class="form-label">Status</label>
                                            <div class="selectgroup w-100">
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Active" class="selectgroup-input" id="status_active">
                                                    <span class="selectgroup-button">Active</span>
                                                </label>
                                                <label class="selectgroup-item">
                                                    <input type="radio" name="status" value="Inactive" class="selectgroup-input" id="status_inactive">
                                                    <span class="selectgroup-button">Inactive</span>
                                                </label>
                                            </div>
                                        </div>
									</div>
                                </div>
                            </div>

                            <div class="form-group" >
                                <label for="first_name">First Name <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="first_name" name="first_name"  >
                            </div>

                            <div class="form-group">
                                <label for="middle_name">Middle Name <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="middle_name" name="middle_name"  >
                            </div>

                            <div class="form-group">
                                <label for="last_name">Last Name <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="last_name" name="last_name"  >
                            </div>

                            <div class="form-group">
                                <label for="suffix">Suffix</label>
                                <input type="text" class="form-control input" id="suffix" name="suffix"  >
                            </div>

                            <div class="form-group">
                                <label for="edit_gender">Gender <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_gender" name="gender_id" class="form-control select2-list required"
                                        data-module="gender" data-action="select2">
                                        <option value="" disabled selected>Select Gender</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-6">

                            <div class="form-group"  style="margin-top: 3rem;">
                                <label for="license_no">License No <span class="-label">*</span></label>
                                <input type="text" class="form-control input" id="license_no" name="license_no"  >
                            </div>
                             <div class="form-group" >
                                <label for="edit_position_id">Position </label>
                                    <div class="select2-input">
                                    <select id="edit_position_id" name="position_id" class="form-control select2-list required"
                                        data-module="occupation" data-action="select2">
                                        <option value="" disabled selected>Select Position</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_birth_date">Birth Date <span class="-label">*</span></label>
                                <input type="text" class="form-control datepicker input" id="edit_birth_date" name="birth_date">
                            </div>

                            <div class="form-group">
                                <label for="edit_civil_status">Civil Status <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_civil_status" name="civil_status_id" class="form-control select2-list required"
                                        data-module="civil_status" data-action="select2">
                                        <option value="" disabled selected>Select Civil Status</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="email" name="email"  >
                            </div>

                            <div class="form-group">
                                <label for="contact_no">Contact No. <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="contact_no" name="contact_no"  >
                            </div>

                            <div class="form-group" >
                                <label for="edit_baranggay_id">Baranggay <span class="-label">*</span></label>
                                <div class="select2-input">
                                    <select id="edit_baranggay_id" name="baranggay_id" class="form-control select2-list required"
                                        data-module="baranggay" data-action="select2">
                                        <option value="" disabled selected>Select Barrangay</option>
                                    </select>
                                </div>
                            </div>

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

                        <div class="col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="street_building_house">Street/Buiding No/House No <span class="-label">*</span></label>
                                <input type="text" class="form-control required input" id="street_building_house" name="street_building_house">
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