<?php
	require_once('../common/initialize.php');
	session_destroy();
?>


<!DOCTYPE html>
<!-- 
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<html lang="en">
<!-- begin::Head -->
<head>
	<meta charset="utf-8">
	<title>Noodly.io Admin Login</title>
	<meta content="User login example" name="description">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible"><!--begin::Web font -->

	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js">
	</script>
	<script>
	           WebFont.load({
	               google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
	               active: function() {
	                   sessionStorage.fonts = true;
	               }
	           });
	</script><!--end::Web font -->
	<!--begin::Global Theme Styles -->
	<link href="<?php echo $assets_url;?>vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"><!--RTL version:<link href="<?php echo $assets_url;?>vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
	<link href="<?php echo $assets_url;?>demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"><!--RTL version:<link href="<?php echo $assets_url;?>demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
	<!--end::Global Theme Styles -->
	<link href="<?php echo $assets_url;?>media/logos/favicon.ico" rel="shortcut icon">
</head><!-- end::Head -->
<!-- begin::Body -->
<body class="k-login-v2--enabled k-header--fixed k-header--skin-dark k-header-mobile--skin-dark k-header-mobile--fixed k-aside--enabled k-aside--fixed k-aside--skin-light k-aside__brand--skin-dark k-aside-secondary--enabled">
	<!-- begin:: Page -->
	<div class="k-grid k-grid--ver k-grid--root k-page">
		<div class="k-grid__item k-grid__item--fluid k-grid k-grid k-grid--hor k-login-v2" id="k_login_v2">
			<!--begin::Item-->
			<div class="k-grid__item k-grid--hor">
				<!--begin::Heade-->
				<div class="k-login-v2__head">
					<div class="k-login-v2__head-logo">
						<a href="#"><img alt="" height="40px" src="<?php echo $assets_url.'media/logos/';?>logo-1.png"></a>
					</div>
				</div><!--begin::Head-->
			</div><!--end::Item-->
			<!--begin::Item-->
			<div class="k-grid__item k-grid k-grid--ver k-grid__item--fluid">
				<!--begin::Body-->
				<div class="k-login-v2__body">
					<!--begin::Wrapper-->
					<div class="k-login-v2__body-wrapper">
						<div class="k-login-v2__body-container">
							<div class="k-login-v2__body-title">
								<h3>Login</h3>
							</div><!--begin::Form-->
							<form action="#" autocomplete="off" class="k-login-v2__body-form k-form k-login-v2__body-form--border" id="login-form">
								<div class="alert alert-danger" id="error-message" role="alert">
									<div class="alert-text">Incorrect email or password!</div>
								</div>
								<div class="form-group">
									<input autocomplete="off" class="form-control" name="email" placeholder="Email" type="email">
								</div>
								<div class="form-group">
									<input autocomplete="off" class="form-control" name="password" placeholder="Password" type="password">
								</div>
								<!--begin::Action-->
								<div class="k-login-v2__body-action k-login-v2__body-action--brand">
									<a class="k-link k-link--brand" href="#">Forgot Password ?</a> <button class="btn btn-pill btn-brand btn-elevate" type="submit">Sign In</button>
								</div><!--end::Action-->
							</form><!--end::Form-->
							<!--begin::Separator-->
							<div class="k-login-v2__body-separator">
								<br>
								<br>
							</div>
						</div>
					</div><!--end::Wrapper-->
					<!--begin::Pic-->
					<div class="k-login-v2__body-pic"><img alt="" src="<?php echo $assets_url;?>media/misc/bg_icon.svg"></div><!--begin::Pic-->
				</div><!--begin::Body-->
			</div><!--end::Item-->
			<!--begin::Item-->
			<!--end::Item-->
		</div>
	</div><!-- end:: Page -->
	<!-- begin::Global Config -->
	<script>
	           var KAppOptions = {
	               "colors": {
	                   "brand": "#5c4de5",
	                   "metal": "#c4c5d6",
	                   "light": "#ffffff",
	                   "accent": "#00c5dc",
	                   "primary": "#5867dd",
	                   "success": "#34bfa3",
	                   "info": "#36a3f7",
	                   "warning": "#ffb822",
	                   "danger": "#fd3995",
	                   "focus": "#9816f4"
	               }
	           };
	</script> <!-- end::Global Config -->
	 <!--begin::Global Theme Bundle -->
	 
	<script src="<?php echo $assets_url;?>vendors/base/vendors.bundle.js" type="text/javascript">
	</script> 
	<script src="<?php echo $assets_url;?>demo/default/base/scripts.bundle.js" type="text/javascript">
	</script> <!--end::Global Theme Bundle -->
	 <!--begin::Page Scripts -->
	 
	<script src="<?php echo $assets_url;?>demo/default/custom/custom/login/login.js" type="text/javascript">
	</script> <!--end::Page Scripts -->
	 <!--begin::Global App Bundle -->
	 
	<script src="<?php echo $assets_url;?>app/scripts/bundle/app.bundle.js" type="text/javascript">
	</script> <!--end::Global App Bundle -->
	 
	<script>
	           var KThemeMode = 'released';
	</script><!-- end::Body -->
</body>
</html>
