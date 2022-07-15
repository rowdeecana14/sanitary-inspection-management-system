
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta content="<?= $_GET['id'] ?>" name="health_official_id" />
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
		font-family: Arial ;
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
		width: 45%;
	}
	.col-2 {
		width: 55%;
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

	.hd-title {
		text-align: center;
		font-weight: bold;
		font-size: 26px;
	}
	.hd-logo-left {
		margin-left: 60px;
	}
	.hd-logo-right {
		margin-right: 60px;
	}
	.hd-logo {
		height: 80px;
		width: 80px;
	}
	.reg-no {
		font-weight: bold;
		margin-left: 70px;
		margin-top: 30px;
		display: flex;
		justify-content: left;
		font-size: 24px;
	}
	.reg-no-underline {
		width: 40%;
		margin-left: 10px;
		border-bottom: 1px solid black;
	}
	.pursuant {
		font-size: 22px;
		margin-top: 100px;
		margin-left: 40px;
	}
	.ordinance {
		width: 40px;
	}
	.resident-details {
		margin-top: 50px;
		margin-left: 20px;
		font-size: 22px;
	}
	.div-center {
		display: flex;
		justify-content: left;
		margin-bottom: 5px;
	}
	.div-content-center {
		justify-content: left;
		margin-bottom: 5px;
	}
	.resident-details-value {
		font-weight: bold;
		margin-left: 15px;
	}
	.margin-left-25 {
		margin-left: 25px;
	}
	.profile {
		margin-top: 20px;
		margin-left: 40px;
		height: 230px;
		width: 240px;
	}
	.resident-signature {
		width: 100%;
		margin-top: 70px;
		border-bottom: 1px solid black;
	}
	.sanitary-inspection-name, .city-health-officer {
		margin-top: 30px;
		font-size: 20px;
		border-bottom: 1px solid black;
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
	<button class="btn-circle-back" onclick="window.location.href='<?= base_url(); ?>/views/health-certificates/'" >
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
				<td style="width: 80%;" class="hd-title">
					<div>OFFICE OF THE CITY</div>
					<div>HEALTH OFFICER</div>
				</td>
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>kalusugan-pangkalahatan.png" alt="" class="hd-logo-right hd-logo">
				</td>
			</tr>
		</table>

		<div class="reg-no">
			<div>Reg No.</div> <span class="reg-no-underline register_no"></span>
		</div>

		<p class="pursuant">
			Pursuant to the Provision P.D 522 P.O. 856 and 
			City Ordinance No. <span class="ordinance">_______</span> s, _____ this certificate is issued 
		</p>

		<div class="resident-details">
			<div class="div-center">
				<div>Name: </div> <div class="name resident-details-value">----------</div>
			</div>
			<div class="div-center">
				<div>Occupation: </div> <div class="occupation resident-details-value">Developer: </div>
			</div>
			<div class="div-center">
				<div>Age: </div> <div class="age resident-details-value">---------- </div>
				<div class="margin-left-25">Sex: </div> <div class="gender resident-details-value">---------- </div>
				<div class="margin-left-25">Nationality: </div> <div class="citizenship resident-details-value">---------- </div>
			</div>
			<div class="div-center">
				<div>Place of Work: </div> <div class="place_of_work resident-details-value">----------</div>
			</div>
		</div>

		<div class="row">
			<div class="col-1">
				<img class="profile image" src=""
					alt="Resident">
			</div>
			<div class="col-2" style="padding-right: 5px">
				<div class="resident-signature"></div>
				<div class="text-center text-bold signature">SIGNATURE</div>

				<div class="sanitary-inspection-name text-bold text-center si_name ">ELIAKIM U. LASCO</div>
				<div class="text-center text-italic si_position">SANITARY INSPECTION ||| - OIC</div>

				<div class="city-health-officer text-bold text-center cho_name ">ARNEL LAURENCE Q. PORTUQUEZ, M.D</div>
				<div class="text-center text-italic cho_position">CITY HEALTH OFFICER</div>
			</div>
		</div>
	</div>
	<script src="../../public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../public/assets/js/core/bootstrap.min.js"></script>
	<script src="../../public/assets/js/plugin/loader/waitMe.min.js"></script>
	<script src="../../public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../../public/custom/js/health-certificate-print.js"></script>
</body>
</html>

