
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta content="<?= $_GET['id'] ?>" name="transfer_cadaver_id" />
<title>Print Transfer of Cadaver - SIMS</title>
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
		margin-left: 20px;
	}
	.hd-logo-right {
		margin-right: 20px;
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

	.city-health-office {
		font-size: 18px;
		color: #199f62;
		text-align: center;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
	}
	.tranfer-cadaver {
		font-size: 22px;
		color: #683894;
		text-align: center;
		font-family: Elephant;
		font-weight: bold;
		margin-top: 30px;
	}
	.content {
		padding-top: 50px;
		margin-left: 8%;
		font-size: 18px;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
	}
	.permit_hereby {
		margin-top: 20px;
	}
	.div-center {
		display: flex;
		justify-content: left;
		margin-bottom: 7px;
	}
	.name-deceased {
		margin-top: 40px;
	}
	.resident-details-value {
		margin-left: 15px;
	}
	.boder-bottom {
		border-bottom: 1px solid black;
	}
	.subject_cadaver {
		margin-top: 20px;
		text-indent: 20px;
	}
	.signature {
		font-size: 14px;
		margin-top: 40px;
		text-align: center;
	}
	.medical-officer {
		border-bottom: 1px solid black;
	}
	.payment-details {
		margin-top: 110px;
		font-size: 18px;
		font-family: Arial, Helvetica, sans-serif;
		font-weight: bold;
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
	<button class="btn-circle-back" onclick="window.location.href='<?= base_url(); ?>/views/transfer-of-cadaver/'" >
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
				<td style="width: 80%; padding-top: 25px" class="hd-title-main">
					<div>Province of Negros Occidental</div>
					<div>City of San Carlos</div>
				</td>
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>all-for-health.png" alt="" class="hd-logo-right hd-logo">
				</td>
			</tr>
		</table>

		<div class="city-health-office">CITY HEALTH OFFICE</div>
		<div class="tranfer-cadaver">TRANSFER OF CADAVER</div>

		<div class="content">
			<div class="whom_concern">To Whom It May Concern:</div>
			<div class="permit_hereby">
				Permit is hereby granted to <span class="resident">__________________</span> to transfer the <br>
				cadaver/remains of the late <span class="name_of_deceased"> __________________ </span> his/her  <span class="relationship">______</span> with <br>
				the following information:
			</div>
			<div class="div-center" style="margin-top: 40px;">
				<div>NAME OF DECEASED: </div> <div class="resident-details-value name_of_deceased">__________________</div>
			</div>
			<div class="div-center">
				<div>CIVIL STATUS: </div> <div class="resident-details-value boder-bottom civil_status">__________________</div>
			</div>
			<div class="div-center">
				<div>CITIZENSHIP: </div> <div class="resident-details-value  boder-bottom citizenship">__________________</div>
			</div>
			<div class="div-center">
				<div>DATE AND TIME OF DEATH: </div> <div class="resident-details-value  boder-bottom death_at">__________________</div>
			</div>
			<div class="div-center">
				<div >PLACE OF DEATH:   </div> <div class="resident-details-value  boder-bottom place_of_death">_________________________</div>
			</div>
			<div class="div-center">
				<div>CAUSE OF DEATH:   </div> <div class="resident-details-value  boder-bottom cause_of_death">__________________</div>
			</div>
			<div class="div-center">
				<div>ATTENDING PHYSICIAN:   </div> <div class="resident-details-value  boder-bottom physician">__________________</div>
			</div>

			<div class="subject_cadaver">
				The subject cadaver/remains shall be transferred to <span class="cemetery">__________________</span>, <spna class="cemetery_address"> __________________</spna> provided however that the said cadavermust be embalmed, disinfected.
			</div>

			<div class="row">
				<div class="col-1">
					<div class=" signature">
						<span class="medical-officer text-bold text-center cho_name ">__________________</span>
						<div class="text-center  cho_position">__________________</div>
					</div>

					<div class="payment-details">
						<div class="div-center">
							<div style="padding-right: 5px">Paid under OR No:   </div> <div class="payment-details-value"><span class="or_no">________</span> </div>
						</div>
						<div class="div-center">
							<div style="padding-right: 48px">Amount Paid:   </div> <div class="payment-details-value">₱ <span class="amount">________</span> </div>
						</div>
						<div class="div-center">
							<div  style="padding-right: 76px">Date paid: </div> <div class="payment-details-value"><span class="paid_at">________</span> </div>
						</div>
					</div>
				</div>
				<div class="col-2">
				</div>
			</div>
		</div>
		
		<script src="../../public/assets/js/core/jquery.3.2.1.min.js"></script>
		<script src="../../public/assets/js/core/bootstrap.min.js"></script>
		<script src="../../public/assets/js/plugin/loader/waitMe.min.js"></script>
		<script src="../../public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
		<script src="../../public/custom/js/transfer-of-cadaver-print.js"></script>
	</div>
</body>
</html>

