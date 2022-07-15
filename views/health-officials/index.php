<?php $navbar_active = "health_officials"; ?>
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<?php notAuthenticate(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Health officials - SIMS</title>
	<?php include_once('../layouts/header.php'); ?>
</head>
<body>
    <!-- Loader Screen -->
    <?php include_once('../layouts/loader.php'); ?>
    <!-- End Loader Screen -->
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
					<div class="row">

						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title"><i class="fas fa-user-md"></i> Health Officials</h4>
										<button class="btn btn-primary btn-round ml-auto btn-create" >
											<i class="fas fa-plus-circle "></i>
											Add 
										</button>
									</div>
								</div>
								<div class="card-body">
                                    <!-- Create Modal -->
                                    <?php include_once('./modal/create.php'); ?>
									<!-- End Create Modal -->

                                    <!-- Edit Modal -->
                                    <?php include_once('./modal/edit.php'); ?>
									<!-- End Edit Modal -->

                                    <!-- Show Modal -->
                                    <?php include_once('./modal/show.php'); ?>
									<!-- End Show Modal -->

									<!-- Camera Modal -->
                                    <?php include_once('./modal/camera.php'); ?>
									<!-- End Camera Modal -->

                                    <!-- List Table -->
                                    <?php include_once('./table/lists.php'); ?>
									<!-- End List Table -->
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
    <script src="../../public/custom/js/script.js"></script>
    <script src="../../public/custom/js/health-officials.js"></script>
	<script src="../../public/assets/js/plugin/webcamjs/webcam.min.js"></script>
	<!-- End Scripts -->
</body>
</html>