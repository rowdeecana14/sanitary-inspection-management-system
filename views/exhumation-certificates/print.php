
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Print Exhumation Certificate - SIMS</title>
<meta content="<?= $_GET['id'] ?>" name="exhumation_id" />
<meta content="<?= api_url() ?>" name="api-url"/>
<meta content="<?= base_url() ?>" name="base-url"/>
<meta content="<?= csrf() ?>" name="csrf-token"/>
<meta content="<?= auth_user()?>" name="auth-user"/>
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
		width:  19.286cm;
		border: 3px solid black;
		height: 100%;
	}
	.content {
		margin: 1px;
		border: 1px solid black;
		position: relative; 
		height: 100%;
		padding-bottom: 30px;
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
		margin-left: 80px;
	}
	.hd-logo-right {
		margin-right: 80px;
	}
	.hd-logo {
		height: 100px;
		width: 100px;
	}
	.hd-title-main {
		font-family: "Bell MT";
		margin-top: -20px;
	}
	.header {
		margin-top: 30px;
		text-align: center;
		font-weight: bold;
		font-size: 22px;;
	}
	.city-health-office {
		display: flex;
		justify-content: center;
	}
	.city-health-office-content {
		text-align: center;
		font-weight: bold;
		font-size: 22px;
		width: 60%;
		border-bottom: 1px solid black;
	}
	.border-bottom {
		border-bottom: 1px solid black;
	}
	.border-line {
		width: 100px;
	}
	.exhumation-certificate {
		text-align: center;
		margin-top: 25px;
		color: red;
		font-weight: bold;
		font-family: "Bell MT";
		font-size: 22px;
	}
	.permit-content {
		padding-left: 30px;
		padding-right: 30px;
		margin-top: 25px;
		font-family: "Bell MT";
		text-indent: 80px;
		font-size: 18px;
	}
	.text-bold {
		font-weight: bold;
	}
	.authority-content {
		margin-top: 20px;
		padding-left: 30px;
		padding-right: 30px;
		text-indent:  60px;;
	}
	.width-100 {
		width: 100%;
	}
	.medical-signature {
		text-align: center;
		font-family: "Bell MT";
		font-weight: bold;	
		width: 60%;
		margin: 0px 0px 0px auto;
		margin-top: 40px;
	}
	.transfer-address {
		font-family: "Bell MT";
		font-weight: bold;	
		border-bottom: 2px solid black;
		margin-left: 30px;
		margin-right: 30px;
	}
	.affidavit {
		text-align: center;
		font-family: "Bell MT";
		font-weight: bold;
		margin-top: 20px;
	}
	.affidavit-content-1 {
		margin-left: 30px;
		margin-right: 30px;
		margin-top: 30px;
		font-family: "Bell MT";
		text-indent: 20px;
		font-size: 18px;
	}
	.affidavit-content-2 {
		margin-top: 30px;
		margin-left: 30px;
		margin-right: 30px;
		font-family: "Bell MT";
		text-indent: 80px;
		font-size: 18px;
	}
	.affidavit-content-4 {
		margin-top: 30px;
		margin-left: 30px;
		margin-right: 30px;
		font-family: "Bell MT";
		text-indent: 80px;
		font-size: 18px;
	}
	.affidavit-content-3  {
		margin-top: 30px;
		margin-left: 30px;
		margin-right: 30px;
		font-family: "Bell MT";
		font-size: 18px;
	}
	.affiant-signature {
		text-align: center;
		font-family: "Bell MT";
		font-weight: bold;	
		width: 50%;
		margin: 0px 0px 0px auto;
		margin-top: 40px;
	}
	.subscribe_and_sworn {
		margin-top: 20px;
		margin-left: 30px;
		margin-right: 30px;
		font-family: "Bell MT";
		font-size: 18px;
	}
	.payment-details {
		font-size: 18px;
		margin-top: 100px;
		margin-left: 30px;
		margin-right: 30px;
		font-family: Arial, Helvetica, sans-serif;
	}
	.payment-details-value {
		margin-left: 15px;
	}
	.div-center {
		display: flex;
		justify-content: left;
	}
	.bg-seal {
		position: fixed;
		z-index: 0;
		opacity: 0.15;
		transform: translate(-50%, -50%);
		width: 500px;
		top: 50%;
		left: 50%;
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
	.padding-5 {
		padding-left: 5px;
	}
	.seperator {
		margin-top: 10px;
		border-bottom: 1px solid black;
		margin-left: 30px;
		margin-right: 30px;
		width: 90%;
	}
	@media  print {
		@page  {
			margin-bottom: 0;
			margin-left: 0;
			margin-right: 0;
			size: 8.5in 13in;
		}
		.btn-circle, .btn-circle-back { display: none; }
		.width, .content {
			border: none;
		}
	}
</style>
</head>
<body>
	<button class="btn-circle-back" onclick="window.location.href='<?= base_url(); ?>/views/exhumation-certificates/'" >
		<i class="fas fa-angle-left"></i>
	</button>	
	<button class="btn-circle" onclick="window.print();">
		<i class="fa fa-print"></i>
	</button>
	<img class="bg-seal" src="<?= image_url(); ?>san-carlos-seal.png" alt="San-carlos logo sealed background">
	<div class="width">
		<div class="content">
			<table class="tbl tbl-no-border header">
				<tr class="center">
					<td style="width: 10%;">
						<img src="<?= image_url(); ?>san-carlos.png" alt="" class="hd-logo-left hd-logo">
					</td>
					<td style="width: 80%;">
						<div class="hd-title-main">
							<div>Republic of the Philippines</div>
							<div>Province of Negros Occidental</div>
							<div>City of San Carlos</div>
						</div>
					</td>
					<td style="width: 10%;">
						<img src="<?= image_url(); ?>f1-plus.png" alt="" class="hd-logo-right hd-logo">
					</td>
				</tr>
			</table>

			<div class="city-health-office">
				<div class="city-health-office-content">CITY HEALTH OFFICE</div>
			</div>

			<div class="exhumation-certificate">EXHUMATION PERMIT</div>

			<div class="permit-content">
				Permit is hereby granted to <span class="resident text-bold">_________</span>  to exhume the remains  of 
				the late <span class="name_of_deceased text-bold">_________________</span> who died of <span class="cause_of_death text-bold">_________</span> on <span class="death_at text-bold">___________</span> And to enter the cadaver, in the tomb
				provided that the undertaker will make the necessary disinfection as provided in the Rules and Regulations of the Department of Health.
			</div>

			<div class="authority-content">
				By authority of section 92 of Presidential Decree 856 otherwise known as the Code of Sanitation of the Philippines.
			</div>

			<div class="width-100">
				<div class="medical-signature">
					<span class="border-bottom cho_name"> ROMEO G. AGRAVIADOR JR., M.D </span>
					<div class="text-center cho_position">Medical Officer IV</div>
				</div>
			</div>
			<div class="seperator">
			</div>
			<!-- <div class="width-100">
				<div class="transfer-address">TRANSFER TO <span>________________</span></div>
			</div> -->

			<div class="affidavit">A F F I D A V I T</div>
			<div class="affidavit-content-1">
				I , <span class="resident text-bold">________________</span> of legal age, <span class="civil_status">__________</span>, <span class="citizenship"></span> with residence and postal address at 
				<span class="address text-bold">________________________</span>, San Carlos City, Negros Occ. after having duly sworn to in accordance with law, depose and say;
			</div>

			<div class="affidavit-content-2">
				That I am the <span class="relationship">_________</span> of the remains to be exhumed who died of 
				<span class="cause_of_death text-bold">________________________</span>  That I have already asked permission from 
				the family of the owner of the subject tomb where remains are to be exhumed and I am 
				given their action and approval.
			</div>

			<div class="affidavit-content-3">
				That I will obey the Rules and Regulations of the Department of Health regarding transfer of cadaver.
			</div>

			<div class="affidavit-content-4">
				In testimony hereof I have hereto set my hand and fix my signature this <span class="issued_at text-bold">__________</span>  in San Carlos City, Negros Occidental, Philippines.
			</div>

			<div class="width-100">
				<div class="affiant-signature">
					<span class="border-bottom resident"> ROLANDO A. BARAN </span>
					<div class="text-center">Affiant</div>
				</div>
			</div>

			<div class="subscribe_and_sworn">
				SUBSCRIBED AND SWORN to before me this  <span class="month_day">________________</span>
			</div>

			<!-- <div class="width-100">
				<div class="medical-signature">
					<span class="border-bottom cho_name"> ROMEO G. AGRAVIADOR JR., M.D </span>
					<div class="text-center cho_position">Medical Officer IV</div>
					<div class="text-center">License No. <span class="cho_license_no">0080109</span></div>
				</div>
			</div> -->

			<div style="width: 100%;">
				<div class="payment-details">
					<div class="div-center">
						<div>Paid under OR No </div> <div class="payment-details-value" style="margin-left: 10x">:<span class="or_no padding-5">________</span></div>
					</div>
					<div class="div-center">
						<div>Amount Paid </div> <div class="payment-details-value"  style="margin-left: 58px">:<span class="amount padding-5">________</span></div>
					</div>
					<div class="div-center">
						<div>Date Paid </div> <div class="payment-details-value"  style="margin-left: 82px">:<span class="paid_at padding-5">________</span></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="../../public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../public/assets/js/core/bootstrap.min.js"></script>
	<script src="../../public/assets/js/plugin/loader/waitMe.min.js"></script>
    <script src="../../public/custom/js/exhumation-certificate-print.js"></script>
	<script src="../../public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
</body>
</html>

