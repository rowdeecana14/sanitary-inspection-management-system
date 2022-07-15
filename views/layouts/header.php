<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
<meta content="<?= api_url() ?>" name="api-url" />
<meta content="<?= base_url() ?>" name="base-url" />
<meta content="<?= csrf() ?>" name="csrf-token" />
<meta content="<?= auth_user()?>" name="auth-user" />

<!-- <link rel="icon" href="../../public/assets/img/icon.ico" type="image/x-icon"/> -->
<link rel="icon" href="../../public/assets/img/config/san-carlos.png">

<!-- Fonts and icons -->
<script src="../../public/assets/js/plugin/webfont/webfont.min.js"></script>
<script>
	WebFont.load({
		google: {"families":["Lato:300,400,700,900"]},
		custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../../public/assets/css/fonts.min.css']},
		active: function() {
			sessionStorage.fonts = true;
		}
	});
	let auth_user = <?=auth_user();?>
</script>
<!-- CSS Loader -->
<link rel="stylesheet" href="../../public/assets/js/plugin/loader/waitMe.min.css">

<!-- Datatables -->
<link rel="stylesheet" href="../../public/assets/js/plugin/datatables/datatables.min.css">
<link rel="stylesheet" href="../../public/assets/js/plugin/datatables/Buttons-2.2.2/css/buttons.bootstrap5.min.css">
<link rel="stylesheet" href="../../public/assets/js/plugin/datatables/Responsive-2.2.9/css/responsive.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="../../public/assets/js/plugin/select2/select2.min.css">

<!-- Daterangepicker -->
<link rel="stylesheet" href="../../public/assets/js/plugin/daterangepicker/daterangepicker.css">

<!-- CSS Files -->
<link rel="stylesheet" href="../../public/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="../../public/assets/css/atlantis.css">
<link rel="stylesheet" href="../../public/assets/css/plugins.css">

<!-- CSS Just for demo purpose, don't include it in your project -->
<link rel="stylesheet" href="../../public/assets/css/demo.css">

<!-- Custom CSS -->
<link rel="stylesheet" href="../../public/custom/css/style.css">

