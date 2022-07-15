<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-building pr-1"></i> COMPANY PROFILE
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 col-lg-4">
                        <div class="card card-profile">
                            <div class="card-header" style="background-image: url('../../public/assets/img/blogpost.jpg')">
                                <div class="profile-picture">
                                    <div class="avatar avatar-xl">
                                        <img src="../../public/assets/img/config/bussines_icon.png" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body" >
                                <div class="user-profile">
                                    <ul class="pricing-content">
                                        <li class="business-profile-list"><span class="far fa-address-card pr-1"></span> Business Name:</li>
                                        <li class="business-profile-list-value"><span class="name">---------------</span></li>

                                        <li class="business-profile-list"><span class="far fa-building pr-1"></span> Establishement:</li>
                                        <li class="business-profile-list-value"><span class="establishment">---------------</span></li>

                                        <li class="business-profile-list"><span class="icon-user pr-1"></span> Owner:</li>
                                        <li class="business-profile-list-value"><span class="owner">---------------</span></li>

                                        <li class="business-profile-list"><span class="icon-call-in pr-1"></span> Contact No:</li>
                                        <li class="business-profile-list-value"><span class="contact_no">---------------</span></li>

                                        <li class="business-profile-list"><span class=" flaticon-envelope-3 pr-1"></span> Email:</li>
                                        <li class="business-profile-list-value"><span class="email">---------------</span></li>

                                        <li class="business-profile-list"><span class="la flaticon-placeholder pr-1"></span> Adddress:</li>
                                        <li class="business-profile-list-value"><span class="address">---------------</span></li>

                                        <li class="business-profile-list"><span class="icon-information pr-1"></span> Status:</li>
                                        <li class="business-profile-list-value"><span class="status">---------------</span></li>

                                        <li class="business-profile-list"><span class="far fa-calendar-check pr-1"></span> Date Created:</li>
                                        <li class="business-profile-list-value"><span class="created_at">---------------</span></li>

                                        <li class="business-profile-list"><span class="icon-user pr-1"></span> Created By:</li>
                                        <li class="business-profile-list-value"><span class="created_by">---------------</span></li>

                                        <li class="business-profile-list"><span class="far fa-calendar-check pr-1"></span> Date Updated:</li>
                                        <li class="business-profile-list-value"><span class="updated_at">---------------</span></li>

                                        <li class="business-profile-list"><span class="icon-user pr-1"></span> Updated By:</li>
                                        <li class="business-profile-list-value"><span class="updated_by">---------------</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="col-md-8 col-lg-8">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i>  Sanitary Permit</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-contact-tab-nobd" data-toggle="pill" href="#pills-contact-nobd" role="tab" aria-controls="pills-contact-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i> Business Permit</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><i class="fas fa-certificate"> </i>  Sanitary Permits</div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Sanitary Permits Table -->
                                        <?php include_once('table/sanitary-permits.php'); ?>
                                        <!-- End Sanitary Permits Table -->
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact-nobd" role="tabpanel" aria-labelledby="pills-contact-tab-nobd">
                                <div class="card-header">
                                    <div class="card-title"><i class="fas fa-certificate"> </i>  Business Permits</div>
                                </div>
                                <div class="card-body">
                                    <!-- Business Permits Table -->
                                    <?php include_once('table/business-permits.php'); ?>
                                    <!-- End Business Permits Table -->
                                </div>
                            </div>
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