<?php
	include_once('../common/initialize.php');
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
		<meta charset="utf-8" />
		<title>Admin Login | Noodly.io</title>
		<meta name="description" content="User login example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />

		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<script>
			WebFont.load({
                google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>

		<!--end::Web font -->

		<!--begin::Global Theme Styles -->
		<link href="<?php echo $assets_url; ?>vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="<?php echo $assets_url; ?>vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
		<link href="<?php echo $assets_url; ?>demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--RTL version:<link href="<?php echo $assets_url; ?>demo/default/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->

		<!--end::Global Theme Styles -->
		<link rel="shortcut icon" href="<?php echo $assets_url; ?>media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background-image: url(<?php echo $assets_url; ?>media/misc/bg_1.jpg)" class="k-login-v2--enabled k-header--fixed k-header--skin-dark k-header-mobile--skin-dark k-header-mobile--fixed k-aside--enabled k-aside--fixed k-aside--skin-light k-aside__brand--skin-dark k-aside-secondary--enabled">

		<!-- begin:: Page -->
		<div class="k-grid k-grid--ver k-grid--root k-page">
			<div class="k-grid__item   k-grid__item--fluid k-grid  k-grid k-grid--hor k-login-v1" id="k_login_v1">

				<!--begin::Item-->
				<div class="k-grid__item  k-grid--hor">

					<!--begin::Heade-->
					<div class="k-login-v1__head">
						<div class="k-login-v1__head-logo">
							<a href="#">
								<img src="<?php echo $assets_url; ?>media/logos/logo-2.png" alt="" />
							</a>
						</div>
						<div class="k-login-v1__head-signup">
							<h4>Don't have an account?</h4>
							<a href="#" class="k-link">Sign Up</a>
						</div>
					</div>

					<!--begin::Head-->
				</div>

				<!--end::Item-->

				<!--begin::Item-->
				<div class="k-grid__item  k-grid  k-grid--ver  k-grid__item--fluid ">

					<!--begin::Body-->
					<div class="k-login-v1__body">

						<!--begin::Wrapper-->
						<div class="k-login-v1__body-wrapper">
							<div class="k-login-v1__body-container">
								<h3 class="k-login-v1__body-title">
									Sign To Account
								</h3>
								<div class="alert alert-danger" id="error-message" role="alert">
									<div class="alert-text">A simple danger alert—check it out!</div>
								</div>
								<!--begin::Form-->
								<form class="k-login-v1__body-form k-form" id="login-form" autocomplete="off">
									<div class="form-group validated">
										<input class="form-control" type="email" id="email" placeholder="Email" name="email" autocomplete="off">
									</div>
									<div class="form-group">
										<input class="form-control" type="password" id="password" placeholder="Password" name="password" autocomplete="off">
									</div>
									
									<!--begin::Action-->
									<div class="k-login-v1__body-action">
										<a href="#" class="k-link">
											<span>Forgot Password ?</span>
										</a>
										<button type="submit" id="login-button" class="btn btn-pill btn-elevate">Sign In</button>
									</div>

									<!--end::Action-->
								</form>

								<!--end::Form-->

							</div>
						</div>

						<!--end::Wrapper-->
					</div>

					<!--begin::Body-->
				</div>

				<!--end::Item-->

				<!--begin::Item-->
				<div class="k-grid__item">
					<div class="k-login-v1__footer">
						<div class="k-login-v1__footer-link">
							<a href="#" class="k-link">Privacy</a>
							<a href="#" class="k-link">Legal</a>
							<a href="#" class="k-link">Contact</a>
						</div>
						<div class="k-login-v1__footer-info">
							<a href="#" class="k-link">&copy; 2018 KeenThemes</a>
						</div>
					</div>
				</div>

				<!--end::Item-->
			</div>
		</div>

		<!-- end:: Page -->

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
		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle -->
		<script src="<?php echo $assets_url; ?>vendors/base/vendors.bundle.js" type="text/javascript"></script>
		<script src="<?php echo $assets_url; ?>demo/default/base/scripts.bundle.js" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->

		<!--begin::Page Scripts -->
		<script src="<?php echo $assets_url; ?>demo/default/custom/custom/login/login.js" type="text/javascript"></script>

		<!--end::Page Scripts -->

		<!--begin::Global App Bundle -->
		<script src="<?php echo $assets_url; ?>app/scripts/bundle/app.bundle.js" type="text/javascript"></script>

		<!--end::Global App Bundle -->
		<script>
			var KThemeMode = 'released';
		</script>
	</body>

	<!-- end::Body -->
</html>