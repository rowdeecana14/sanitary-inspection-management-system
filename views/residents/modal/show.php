<div class="modal fade" id="show-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header no-bd">
                <h5 class="modal-title">
                    <i class="fas fa-id-card"></i> RESIDENT PROFILE
                </h5>
                <button type="button" class="btn btn-circle" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-placement="top" title="Close Modal">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <ul class="nav nav-pills nav-secondary nav-pills-no-bd" id="pills-tab-without-border" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-profile-tab-nobd" data-toggle="pill" href="#pills-profile-nobd" role="tab" aria-controls="pills-profile-nobd" aria-selected="false"><i class="fas fa-address-card pr-1"></i>  Profile</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="pills-case-involves-tab-nobd" data-toggle="pill" href="#pills-case-involves-nobd" role="tab" aria-controls="pills-case-involves-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i> Case Involves</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-permits-issued-tab-nobd" data-toggle="pill" href="#pills-permits-issued-nobd" role="tab" aria-controls="pills-permits-issued-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i> Medical Certificates</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pills-certificates-issued-tab-nobd" data-toggle="pill" href="#pills-certificates-issued-nobd" role="tab" aria-controls="pills-certificates-issued-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i> Exhumation Certificates</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="pills-transfer-cadaver-tab-nobd" data-toggle="pill" href="#pills-transfer-cadaver-nobd" role="tab" aria-controls="pills-transfer-cadaver-nobd" aria-selected="false"><i class="fas fa-copy pr-1"></i> Transfer Cadavers</a>
                            </li> -->
                        </ul>
                        <div class="tab-content mt-2 mb-3" id="pills-without-border-tabContent">
                            <div class="tab-pane fade show active" id="pills-profile-nobd" role="tabpanel" aria-labelledby="pills-profile-tab-nobd">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title"><i class="fas fa-address-card "> </i>  Resident Profile</div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Profile -->
                                        <?php include_once('./profile.php'); ?>
                                        <!-- End Profile -->
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-case-involves-nobd" role="tabpanel" aria-labelledby="pills-case-involves-tab-nobd">
                                <div class="card-header">
                                    <div class="card-title"><i class="fas fa-certificate"> </i>  Cases Involves</div>
                                </div>
                                <div class="card-body">
                                    <!-- Case Involves Table -->
                                    <?php include_once('table/case-involves.php'); ?>
                                    <!-- End Case Involves Table -->
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-permits-issued-nobd" role="tabpanel" aria-labelledby="pills-permits-issued-tab-nobd">
                                <div class="card-header">
                                    <div class="card-title"><i class="fas fa-certificate"> </i>  Medical Certificates</div>
                                </div>
                                <div class="card-body">
                                    <!-- Permits Issued Table -->
                                    <?php include_once('table/medical-certificates.php'); ?>
                                    <!-- End Permits Issued Table -->
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-certificates-issued-nobd" role="tabpanel" aria-labelledby="pills-certificates-issued-tab-nobd">
                                <div class="card-header">
                                    <div class="card-title"><i class="fas fa-certificate"> </i>  Exhumation Certificates</div>
                                </div>
                                <div class="card-body">
                                    <!-- Certificates Issued Table -->
                                    <?php include_once('table/exhumation-certificates.php'); ?>
                                    <!-- End Certificates Issued Table -->
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pills-transfer-cadaver-nobd" role="tabpanel" aria-labelledby="pills-transfer-cadaver-tab-nobd">
                                <div class="card-header">
                                    <div class="card-title"><i class="fas fa-certificate"> </i>  Transfer Cadavers</div>
                                </div>
                                <div class="card-body">
                                    <!-- Certificates Issued Table -->
                                    <?php include_once('table/transfer-cadavers.php'); ?>
                                    <!-- End Certificates Issued Table -->
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