
<?php include_once('../../app/template/BaseTemplate.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta content="<?= $_GET['id'] ?>" name="business_permit_id" />
<title>Print Business Permit - SIMS</title>
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
		padding-top: 5px;
		text-align: center;
		font-weight: bold;
		font-size: 26px;
	}
	.hd-logo-left {
		margin-left: 70px;
	}
	.hd-logo-right {
		margin-right: 70px;
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
	.business-permit {
		font-size: 48px;
		color: red;
		text-align: center;
		font-family: Book Antiqua;
		font-weight: bold;
		margin-top: 20px;
		letter-spacing: 4px;
	}
	.content {
		margin-left: 10%;
		margin-right: 10%;
	}
	.issued_to {
		font-weight: bold;
		margin-top: 60px;
		font-size: 18px;
	}
	.company-content {
		text-align: center;
		font-weight: bold;
		font-size: 18px;
	}
	.company {
		border-bottom: 1px solid black;
		font-size: 24px;
	}
	.company-label {
		text-align: center;
		font-size: 16px;
	}
	.establishment-content {
		margin-top: 30px;
		text-align: center;
		font-weight: bold;
		font-size: 18px;
	}
	.establishment {
		border-bottom: 1px solid black;
		font-size: 24px;
	}
	.establishment-label {
		text-align: center;
		font-size: 16px;
	}
	.address-content {
		font-weight: bold;
		margin-top: 10px;
		font-size: 18px;
	}
	.address {
		border-bottom: 1px solid black;
	}
	.permit-no-content {
		font-weight: bold;
		margin-top: 50px;
		font-size: 18px;
	}
	.permit_no {
		border-bottom: 1px solid black;
	}
	.issued-at-content {
		font-weight: bold;
		margin-top: 10px;
		font-size: 18px;
	}
	.issued_at {
		border-bottom: 1px solid black;
	}
	.expiration-at-content {
		font-weight: bold;
		margin-top: 10px;
		font-size: 18px;
	}
	.expired_at {
		border-bottom: 1px solid black;
	}
	.notice {
		margin-top: 20px;
		margin-left: 10%;
		margin-right: 5%;
		font-size: 18px;
		text-indent: 70px;
	}
	.recommending-approval {
		margin-top: 50px;
		margin-left: 7%;
		margin-right: 7%;
	}
	.signature-content {
		display: flex;
		justify-content: center;
		margin-top: 50px;
		margin-left: 7%;
		margin-right: 7%;
	}
	.si_name {
		font-weight: bold;
		border-bottom: 1px solid black;
	}
	.inspector-content, .inspector-label {
		text-align: center;
	}
	.col-4 {
		width: 40%;
	}
	.col-8 {
		width: 60%;
	}
	.cho_name {
		font-weight: bold;
		border-bottom: 1px solid black;
	}
	.city-health-content, .city-health-label {
		text-align: center;
	}
	.signature-city-health {
		display: flex;
		justify-content: center;
		margin-top: 10px;
		margin-left: 7%;
		margin-right: 7%;
	}
	.payment-content {
		margin-left: 7%;
		margin-right: 7%;
		text-align: center;
	}
	.caution-content {
		display: flex;
		justify-content: center;
		margin-top: 20px;
	}
	.caution {
		background-color: red;
		padding-left: 20px;
		padding-right: 20px;
		color: white;
		text-align: center;
		font-weight: bold;
		font-size: 24px;
	}
	.san-carlos {
		text-align: center;
		font-size: 32px;
		font-weight: bold;
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
	@media  print {
		body {-webkit-print-color-adjust: exact;}
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
	<button class="btn-circle-back" onclick="window.location.href='<?= base_url(); ?>/views/business-permits/'" >
		<i class="fas fa-angle-left"></i>
	</button>	
	<button class="btn-circle" onclick="window.print();">
		<i class="fa fa-print"></i>
	</button>
	<img class="bg-seal" src="<?= image_url(); ?>no-fixers.jpg" alt="Sealed background">

	<div class="width">
		<table class="tbl tbl-no-border">
			<tr class="center">
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>san-carlos.png" alt="" class="hd-logo-left hd-logo">
				</td>
				<td style="width: 80%;" class="hd-title-main">
					<div>Republic of the Philippines</div>
					<div>Province of Negros Occidental</div>
					<div>CITY OF SAN CARLOS </div>
					<div class="hd-title">CITY HEALTH OFFICE</div>
				</td>
				<td style="width: 10%;">
					<img src="<?= image_url(); ?>kalusugan-pangkalahatan.png" alt="" class="hd-logo-right hd-logo">
				</td>
			</tr>
		</table>

		<div class="business-permit">BUSINESS PERMIT</div>

		<div class="content">
			<div class="issued_to">ISSUED TO:</div>
			<div class="company-content"><span class="company">YUNIKA KPLUS DRY GOODS TRADING</span></div>
			<div class="company-label">(REGISTERED NAME)</div>

			<div class="establishment-content"><span class="establishment">SURPLUS</span></div>
			<div class="establishment-label">(TYPE OF ESTABLISHMENT)</div>

			<div class="address-content">ADDRESS: <span class="address"> ST., BRGY. V, SAN CARLOS CITY</span></div>

			<div class="permit-no-content">SANITARY PERMIT NO: <span class="permit_no">3254354353</span></div>

			<div class="issued-at-content">DATE ISSUED: <span class="issued_at">December 31, 2022</span></div>

			<div class="expiration-at-content">DATE OF EXPIRATION: <span class="expired_at">December 31, 2022</span></div>
		</div>

		<div class="notice">
			The permit is not transferable and will be revoked for violation of Sanitary Rules, Laws, or Regulations
			and P.D 522 & 856 and local oridinance.
		</div>

		<div class="recommending-approval">
			Recommending Approval: 
		</div>

		<div class="signature-content">
			<div class="col-4">
				<div class="inspector-content"> <span class="si_name">ELIAKIM U. LASCO</span> </div>
				<div class="inspector-label"> <span class="si_position"> Sanitation Inspector lll/OIC</span> </div>
			</div>
			<div class="col-8">
				<div class="city-health-content" style="text-align: left;">Approved:</div>
			</div>
		</div>

		<div class="signature-city-health">
			<div class="col-4">
			</div>
			<div class="col-8">
				<div class="city-health-content"> <span class="cho_name">ARNEIL LAIRENCE Q. PORTUQUEZ, M.D.</span> </div>
				<div class="city-health-label"> <span class="cho_position"> City Health Officer</span> </div>
			</div>
		</div>

		<div class="col-4">
			<div class="payment-content">
				<div>Or No.: <span class="or_no">32432432432</span></div>
				<div>Amount Paid.: <span class="amount">650.00</span></div>
				<div>Date Paid.: <span class="paid_at">2022-02-02</span></div>
			</div>
		</div>

		<div class="caution-content">
			<div class="caution">
				THIS PERMIT MUST BE POSTED IN A CONSPICUOUS PLACE <br> FOR PUBLIC VIEW
			</div>
		</div>

		<div class="san-carlos">VAMOS SAN CARLOS</div>
	</div>

	<script src="../../public/assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="../../public/assets/js/core/bootstrap.min.js"></script>
	<script src="../../public/assets/js/plugin/loader/waitMe.min.js"></script>
	<script src="../../public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="../../public/custom/js/business-permit-print.js"></script>
</body>
</html>

