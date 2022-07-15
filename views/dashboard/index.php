<?php $navbar_active = "dashboard"; ?>
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<?php notAuthenticate(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard - SIMS</title>
	<meta content="<?= loginCount() ?>" name="login-count" />
	<?php include_once('../layouts/header.php'); ?>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<?php include_once('../layouts/logo_header.php'); ?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php include_once('../layouts/nav_bar.php'); ?>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<?php include_once('../layouts/side_bar.php'); ?>
		<!-- End Sidebar -->

		<div class="main-panel">
            <div class="content">
				<div class="page-inner">
					<div class="row mt-3">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-user-lock"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Users</p>
												<h4 class="card-title users">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-user-md"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Health Officials</p>
												<h4 class="card-title health_officials">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-building"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Companies</p>
												<h4 class="card-title companies">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-users"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Residents</p>
												<h4 class="card-title residents">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-male"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Males</p>
												<h4 class="card-title males">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-female"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Females</p>
												<h4 class="card-title females">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-blind"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Sinior Citizens</p>
												<h4 class="card-title siniors">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-wheelchair"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">PWD</p>
												<h4 class="card-title pwds">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-fingerprint"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Voters</p>
												<h4 class="card-title voters">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-people-carry"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Total Complaints</p>
												<h4 class="card-title complaints">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-thumbs-down"></i>
											</div>
										</div>
										<div class="col-9 col-stats">
											<div class="numbers">
												<p class="card-category">Unsettled Complaints</p>
												<h4 class="card-title unsettleds">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="fas fa-certificate"></i>
											</div>
										</div>
										<div class="col-9 col-stats">
											<div class="numbers">
												<p class="card-category">Permits & Certificates</p>
												<h4 class="card-title permits_and_certificates">0</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-venus-mars"></i> Genders</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="genders" style="width: 50%; height: 50%"></canvas>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-6">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-wheelchair"></i> Persons Disabilities</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="person_disabilities" style="width: 50%; height: 50%"></canvas>
									</div>
								</div>
							</div>
						</div>
						

						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-users"></i> Resident Registrations  (<?= date('Y'); ?>)</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="resident_registrations"></canvas>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-people-carry"></i> Complaint Incidents (<?= date('Y'); ?>)</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="complaint_incidents"></canvas>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-certificate"></i> Permits Issued (<?= date('Y'); ?>)</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="permits_issued"></canvas>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title"><i class="fas fa-certificate"></i> Certificates Issued (<?= date('Y'); ?>)</div>
								</div>
								<div class="card-body">
									<div class="chart-container">
										<canvas id="certificates_issued"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Start Footer -->
			<?php include_once('../layouts/footer.php'); ?>
			<!-- End Footer -->
		</div>
	</div>
	
	<!-- Start Scripts -->
    <?php include_once('../layouts/scripts.php'); ?>
	<!-- Chart JS -->
	<script src="../../public/assets/js/plugin/chart.js/chart.min.js"></script>
	<script src="../../public/custom/js/script.js"></script>
    <script src="../../public/custom/js/dashboard.js"></script>
	<!-- End Scripts -->
	
</body>
</html>