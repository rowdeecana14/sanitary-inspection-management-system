<div class="sidebar sidebar-style-2" data-background-color="green2" style="background-color: #3d753f !important;">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="avatar-sm float-left mr-2">
                    <img src="../../public/assets/img/config/default.png" alt="..." class="avatar-img rounded-circle auth-image">
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            <span class="auth-name">TEST ADMIN</span>
                            <span class="user-level auth-position">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="../profile/">
                                   <span class="link-collapse"> Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="" class="logout" >
                                    <span class="link-collapse">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <ul class="nav nav-success">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menu</h4>
                </li>
                <li class="nav-item <?= $navbar_active == 'dashboard' ? 'active' : ''; ?>">
                    <a href="../dashboard/">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= $navbar_active == 'residents' ? 'active' : ''; ?>">
                    <a href="../residents/">
                        <i class="fas fa-users"></i>
                        <p>Residents</p>
                    </a>
                </li>
                <li class="nav-item <?= $navbar_active == 'health_officials' ? 'active' : ''; ?>">
                    <a href="../health-officials/">
                        <i class="fas fa-user-md"></i>
                        <p>Health Officials </p>
                    </a>
                </li>
                <li class="nav-item <?= $navbar_active == 'complaints' ? 'active' : ''; ?>">
                    <a href="../complaints/">
                        <i class="fas fa-people-carry"></i>
                        <p> Complaints</p>
                    </a>
                </li>
                <li class="nav-item <?= $navbar_active == 'companies' ? 'active' : ''; ?>">
                    <a href="../companies/">
                        <i class="fas fa-building"></i>
                        <p>Companies</p>
                    </a>
                </li>
                <li class="nav-item
                    <?= 
                        in_array($navbar_active, ['business_permits', 'sanitary_permits', 'medical_certificates', 'exhumation_certificates', 'transfer_of_cadaver', 'health_certificates']) ? 'active submenu' : ''; 
                    ?>">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-certificate"></i>
                        <p>Permits & Certificates</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse  
                        <?= 
                            in_array($navbar_active, ['business_permits', 'sanitary_permits', 'medical_certificates', 'exhumation_certificates', 'transfer_of_cadaver', 'health_certificates']) ? 'show' : ''; 
                        ?>" 
                        id="forms">
                        <ul class="nav nav-collapse">
                            <li class="<?= $navbar_active == 'sanitary_permits' ? 'active' : ''; ?>">
                            <a href="../sanitary-permits/">
                                    <span class="sub-item">Sanitary Permits</span>
                                </a>
                            </li>
                            
                            <li class="<?= $navbar_active == 'business_permits' ? 'active' : ''; ?>">
                                <a href="../business-permits/">
                                    <span class="sub-item">Business Permits</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'health_certificates' ? 'active' : ''; ?>">
                                <a href="../health-certificates/">
                                    <span class="sub-item">Health Certificates</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'medical_certificates' ? 'active' : ''; ?>">
                                <a href="../medical-certificates/">
                                    <span class="sub-item">Medical Certificates</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'exhumation_certificates' ? 'active' : ''; ?>">
                                <a href="../exhumation-certificates/">
                                    <span class="sub-item">Exhumation Certificates</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'transfer_of_cadaver' ? 'active' : ''; ?>">
                                <a href="../transfer-of-cadaver/">
                                    <span class="sub-item">Transfer of Cadaver</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                
                <li class="nav-item <?= $navbar_active == 'reports' ? ' active' : ''; ?>">
                    <a href="../reports/">
                        <i class="fas fa-list-alt"></i>
                        <p>Reports</p>
                    </a>
                </li>
                <li class="nav-item <?= $navbar_active == 'activity_logs' ? '  active' : ''; ?>">
                    <a href="../activity-logs/">
                        <i class="fas fa-history"></i>
                        <p>Activity Logs</p>
                    </a>
                </li>
                <!-- <li class="nav-item <?= $navbar_active == 'db_backups_or_restore' ? ' active' : ''; ?>">
                    <a href="../db-backups-or-restore">
                        <i class="fas fa-database"></i>
                        <p>DB backups / restore</p>
                    </a>
                </li> -->
                <li class="nav-item
                        <?= 
                            in_array($navbar_active, [
                                'setting_users', 'setting_baranggays', 'setting_puroks', 'setting_complaint_types', 'setting_citizenships',
                                'setting_civil_statuses', 'setting_occupations', 'setting_genders', 'setting_relationships', 'setting_complaint_statuses',
                                'setting_person_disabilities', 'setting_educational_attainments', 'setting_blood_types', 'setting_cemeteries',
                                'setting_establishments', 'setting_signatures', 'setting_fees', 'setting_checklists', 'setting_sanitary_checklists'
                            ]) ? ' active submenu' : ''; 
                        ?>">
                    <a data-toggle="collapse" href="#settings">
                        <i class="fas fa-cogs"></i>
                        <p>Settings</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse
                         <?= 
                            in_array($navbar_active, [
                                'setting_users', 'setting_baranggays', 'setting_puroks', 'setting_complaint_types', 'setting_citizenships',
                                'setting_civil_statuses', 'setting_occupations', 'setting_genders', 'setting_relationships', 'setting_complaint_statuses',
                                'setting_person_disabilities', 'setting_educational_attainments', 'setting_blood_types', 'setting_cemeteries',
                                'setting_establishments', 'setting_signatures', 'setting_fees', 'setting_checklists', 'setting_sanitary_checklists'
                            ]) ? ' show' : ''; 
                        ?>" id="settings">
                        <ul class="nav nav-collapse">
                            <li class="<?= $navbar_active == 'setting_users' ? ' active' : ''; ?>"> 
                                <a href="../settings-users/">
                                    <span class="sub-item">Users</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_signatures' ? 'active' : ''; ?>"> 
                                <a href="../settings-signatures/">
                                    <span class="sub-item">Signatures</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_fees' ? 'active' : ''; ?>"> 
                                <a href="../settings-fees/">
                                    <span class="sub-item">Fees</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_checklists' ? 'active' : ''; ?>"> 
                                <a href="../settings-checklists/">
                                    <span class="sub-item">Checklists</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_sanitary_checklists' ? 'active' : ''; ?>"> 
                                <a href="../settings-sanitary-checklists/">
                                    <span class="sub-item">Sanitary Checklists</span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Health Information</span>
                                </a>
                            </li> -->
                            <li class="<?= $navbar_active == 'setting_baranggays' ? 'active' : ''; ?>"> 
                                <a href="../settings-baranggays/">
                                    <span class="sub-item">Baranggays</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_puroks' ? 'active' : ''; ?>"> 
                                <a href="../settings-puroks/">
                                    <span class="sub-item">Puroks</span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_complaint_types' ? 'active' : ''; ?>"> 
                                <a href="../settings-complaint-types/">
                                    <span class="sub-item">Complaint Types </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_complaint_statuses' ? 'active' : ''; ?>"> 
                                <a href="../settings-complaint-statuses/">
                                    <span class="sub-item">Complaint Statuses </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_citizenships' ? 'active' : ''; ?>"> 
                                <a href="../settings-citizenships/">
                                    <span class="sub-item">Citizenships </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_civil_statuses' ? 'active' : ''; ?>"> 
                                <a href="../settings-civil-statuses/">
                                    <span class="sub-item">Civil Statuses </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_occupations' ? 'active' : ''; ?>"> 
                                <a href="../settings-occupasions/">
                                    <span class="sub-item">Occupations </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_genders' ? 'active' : ''; ?>"> 
                                <a href="../settings-genders/">
                                    <span class="sub-item">Genders </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_relationships' ? 'active' : ''; ?>"> 
                                <a href="../settings-relationships/">
                                    <span class="sub-item">Relationships </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_person_disabilities' ? 'active' : ''; ?>"> 
                                <a href="../settings-person-disabilities/">
                                    <span class="sub-item">Person Disabilities </span>
                                </a>
                            </li>
                            <li class="<?= $navbar_active == 'setting_educational_attainments' ? 'active' : ''; ?>"> 
                                <a href="../settings-educational-attainments/">
                                    <span class="sub-item">Educational Attainments </span>
                                </a>
                            </li>

                            <li class="<?= $navbar_active == 'setting_blood_types' ? 'active' : ''; ?>"> 
                                <a href="../settings-blood-types/">
                                    <span class="sub-item">Blood Types </span>
                                </a>
                            </li>

                            <li class="<?= $navbar_active == 'setting_cemeteries' ? 'active' : ''; ?>"> 
                                <a href="../settings-cemeteries/">
                                    <span class="sub-item">Cemeteries </span>
                                </a>
                            </li>

                            <li class="<?= $navbar_active == 'setting_establishments' ? 'active' : ''; ?>"> 
                                <a href="../settings-establishments/">
                                    <span class="sub-item">Establishments </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>