
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta content="<?= $_GET['id'] ?>" name="medical_certificate_id" />
<title>Print Health Certificate - SIMS</title>
<meta content="<?= api_url() ?>" name="api-url" />
<meta content="<?= base_url() ?>" name="base-url" />
<meta content="<?= csrf() ?>" name="csrf-token" />
<meta content="<?= auth_user()?>" name="auth-user" />
<link rel="stylesheet" href="../../public/assets/js/plugin/loader/waitMe.min.css">
<script src="../../public/assets/js/plugin/webfont/webfont.min.js"></script>
<script>
	WebFont.load({
		google: {"families":["Lato:300,400,700,900"]},
		custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../public/assets/css/fonts.min.css']},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
</script>
<style>
	body {
		padding: 0px;
		margin: 0px;
		font-family: Calibri ;
		font-size: 18px;
		display: flex;
		justify-content: center;

	}
	.width{
		padding-top: 50px;
		padding-bottom: 100px;
		width:  19.286cm;
		border: 1px solid black;

	}
	.tbl {
		border-collapse: collapse;
		margin-left: auto;
		margin-right: auto;
	}
	.tbl-no-border td {
		border: none;
	}
	.col-1 {
		width: 50%;
	}
	.col-2 {
		width: 50%;
	}
	.row {
		display: flex;
		width: 100%;
	}
	.text-bold {
		font-weight: bold;
	}
	.text-center {
		text-align: center;
	}
	.signature {
		font-size: 24px;
		margin-left: 40%;
	}
	.text-italic {
		font-style: italic;
	}
	.btn-circle {
		background: rgba(255, 255, 255, 1);
		border-radius: 60px;
		bottom: 100px;
		box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
		display: block;
		color: #222;
		font-size: 30px;
		height: 60px;
		line-height: 57.5px;
		position: fixed;
		right: 20px;
		text-align: center;
		transition: 0.3s ease;
		-webkit-transition: 0.3s ease;
		-moz-transition: 0.3s ease;
		-ms-transition: 0.3s ease;
		-o-transition: 0.3s ease;
		width: 60px;
		cursor: pointer;
	}
	.btn-circle-back {
		background: rgba(255, 255, 255, 1);
		border-radius: 60px;
		bottom: 20px;
		box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.5);
		display: block;
		color: #222;
		font-size: 30px;
		height: 60px;
		line-height: 57.5px;
		position: fixed;
		right: 20px;
		text-align: center;
		transition: 0.3s ease;
		-webkit-transition: 0.3s ease;
		-moz-transition: 0.3s ease;
		-ms-transition: 0.3s ease;
		-o-transition: 0.3s ease;
		width: 60px;
		cursor: pointer;
	}
	.times-new-roman {
		font-family: 'Times New Roman', Times, serif;
	}

	.hd-title {
		text-align: center;
		font-weight: bold;
		font-size: 26px;
	}
	.hd-logo-left {
		margin-left: 120px;
	}
	.hd-logo-right {
		margin-right: 120px;
	}
	.hd-logo {
		height: 100px;
		width: 100px;
	}

	.hd-title-main {
		text-align: center;
		font-size: 16px;
		font-weight: bold;
	}
	.medical-certificate {
		font-size: 32px;
		color: #683894;
		text-align: center;
		font-family: Book Antiqua;
		font-weight: bold;
		margin-top: 10px;
	}
	.whom_concern {
		padding-top: 40px;
		margin-left: 8%;
		font-size: 18px;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	}
	.certify {
		font-size: 18px;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		margin-left: 27%;
		margin-top: 20px;
	}
	.name {
		font-size: 26px;
		text-align: center;
		font-family: Arial black;
		margin-top: 20px;
	}
	.content {
		font-size: 18px;
		font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
		margin-left: 8%;
		margin-right: 8%;
		margin-top: 40px;
		text-indent: 50px;
	}
	.certificate {
		margin-top: 20px;
	}
	.medical-officer {
		border-bottom: 1px solid black;
	}
	.signature {
		font-family: 'Times New Roman', Times, serif;
		text-align: center;
		margin-top: 80px;
		font-size: 18px;
	}
	.resident-details {
		margin-top: 100px;
		margin-left: 100px;
		font-size: 18px;
	}
	.div-center {
		display: flex;
		justify-content: left;
	}
	.div-content-center {
		justify-content: left;
		margin-bottom: 5px;
	}
	.resident-details-value {
		margin-left: 15px;
	}

	@media  print {
		@page  {
			margin-top: 0;
			margin-bottom: 0;
			margin-left: 0;
			margin-right: 0;
			size: 8.5in 13in;
		}
		.btn-circle, .btn-circle-back { display: none; }
		.width {
			border: none;
		}
	}
</style>
</head>
<body>
	<button class="btn-circle-back" onclick="window.location.href='<?= base_url(); ?>/views/medical-certificates/'" >
		<i class="fas fa-angle-left"></i>
	</button>	
	<button class="btn-circle" onclick="window.print();">
		<i class="fa fa-print"></i>
	</button>
	<div class="width">
		<table class="tbl tbl-no-border">
			<tr class="center">
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>san-carlos.png" alt="" class="hd-logo-left hd-logo">
				</td>
				<td style="width: 80%;" class="hd-title-main">
					<div>Republic of the Philippines</div>
					<div>Province of Negros Occidental</div>
					<div>City of San Carlos</div>
					<div class="hd-title">CITY HEALTH OFFICE</div>
				</td>
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>all-for-health.png" alt="" class="hd-logo-right hd-logo">
				</td>
			</tr>
		</table>

		<div class="medical-certificate">MEDICAL CERTIFICATE</div>

		<div class="whom_concern">To Whom It May Concern:</div>
		<div class="certify">This is to certify that I have physically examined Mr./Ms</div>

		<div class="name">__________________________</div>

		<div class="content">
			<div>
				<span class="age">___</span> years old, <span class="civil_status">_____</span>, a resident of <span class="address">_______________</span>, San Carlos City, Negros Occ. and found to have physical fit, midically sound and is free from 
				any diseases and that he/she if fit for <span class="fit_for text-bold">____</span>.
			</div>
			<div class="certificate">
				This certificate is issued as per parent’s request for whatever purpose that may serve her/ him  best.
			</div>
			<div class="certificate">
				Given this <span class="day">___</span> day of <span class="month_and_year">______</span> at San Carlos City, Negros Occidental, Philippines.
			</div>
		</div>

		<div style="width: 100%;">
			<div class=" signature">
				<span class="medical-officer text-bold text-center cho_name ">___________</span>
				<div class="text-center  cho_position">______________</div>
				<!-- <div class="text-center ">License No. <span class="cho_license_no"></span></div> -->
			</div>
		</div>

		<div style="width: 100%;">
			<div class="resident-details">
				<div class="div-center">
					<div>Blood Pressure: </div> <div class="resident-details-value" style="margin-left: 20px"><span class="blood_pressure">____</span> mmhg.</div>
				</div>
				<div class="div-center">
					<div>Weight in Kls: </div> <div class="resident-details-value"  style="margin-left: 36px"><span class="weight">____</span> kgs.</div>
				</div>
				<div class="div-center">
					<div>Height in Cms: </div> <div class="resident-details-value"  style="margin-left: 28px"><span class="height">____</span> cms.</div>
				</div>
				<div class="div-center">
					<div>Or. No.:  </div> <div class="resident-details-value" style="margin-left: 78px"><span class="or_no">____</span> </div>
				</div>
				<div class="div-center">
					<div>Date paid: </div> <div class="resident-details-value" style="margin-left: 58px"><span class="paid_at">_____</span> </div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../public/assets/js/core/bootstrap.min.js"></script>
	<script src="../../public/assets/js/plugin/loader/waitMe.min.js"></script>
    <script src="../../public/custom/js/medical-certificate-print.js"></script>
</body>
</html>

