
<body class="k-login-v2--enabled k-header--fixed k-header--skin-dark k-header-mobile--skin-dark k-header-mobile--fixed k-aside--enabled k-aside--fixed k-aside--skin-light k-aside__brand--skin-dark k-aside-secondary--enabled">
	<!-- begin:: Page -->
	<div class="k-grid k-grid--ver k-grid--root k-page">
		<div class="k-grid__item k-grid__item--fluid k-grid k-grid k-grid--hor k-login-v2" id="k_login_v2">
			<!--begin::Item-->
			<div class="k-grid__item k-grid--hor">
				<!--begin::Heade-->
				<div class="k-login-v2__head">
					<div class="k-login-v2__head-logo">
						<!-- <a href="#"><img alt="" height="40px" src="<?php echo ASSETS_URL.'media/logos/'.(empty($_env['light_back_logo']) ? 'logo-on-light-background.png' : $_env['light_back_logo']);?>"></a> -->
					</div>
				</div><!--begin::Head-->
			</div><!--end::Item-->
			<!--begin::Item-->
			<div class="k-grid__item k-grid k-grid--ver k-grid__item--fluid">
				<!--begin::Body-->
				<div class="k-login-v2__body">
					<!--begin::Wrapper-->
					<div class="k-login-v2__body-wrapper">
					<a href="#"><img alt="" height="<?php echo $_env['login_logo_size']; ?>" src="<?php echo ASSETS_URL.'media/logos/'.(empty($_env['light_back_logo']) ? 'logo-on-light-background.png' : $_env['light_back_logo']);?>" style="padding-bottom: 30px;"></a>
						<div class="k-login-v2__body-container">
							<div class="k-login-v2__body-title">
								<h3> </h3>
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
									<a class="k-link k-link--brand" href="#">Forgot Password ?</a> <button class="btn btn-success btn-elevate" type="submit">Sign In</button>
								</div><!--end::Action-->
							</form><!--end::Form-->
							<!--begin::Separator-->
							<div class="k-login-v2__body-separator">
								<br>
								<br>
							</div>
						</div>
					</div><!--end::Wrapper-->
				</div><!--begin::Body-->
			</div><!--end::Item-->
			<!--begin::Item-->
			<!--end::Item-->
		</div>
