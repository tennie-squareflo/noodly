<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Settings</h3>
				
				</div>
				<div class="k-content__head-toolbar">
					<div class="k-content__head-toolbar-wrapper">
						
						<a class="btn btn-success" id="save-btn">
							<i class="la la-check"></i> Save!
						</a>
					</div>
				</div>
			</div>

			<!-- end:: Content Head -->
			<!-- begin:: Content Body -->
			<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
				<div class="row">
					<div class="col-lg-12">

						<!--begin::Portlet-->
						<div class="k-portlet" id="k_page_portlet">
							<div class="k-portlet__body">
                <form class="k-form" id="register-form"  method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-xl-2"></div>
										<div class="col-xl-8">

											<div class="k-section">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">Email Settings:</h3>
													<div class="form-group row">
														<label class="col-3 col-form-label">Email Background Image</label>
														<div class="col-9">
                              <div class="slim"
                                data-service="<?php echo BASE_URL; ?>settings/email_background_upload"
																data-push="true"
                                data-did-throw-error="handleError">
                                <input type="file" name="email_background_image" data-value='<?php echo $_env['email_background_image'] != '' ? '{"file": "'.$_env['email_background_image'].'"}' : ''; ?>'/>
                                <?php
                                  if ($_env['email_background_image'] != '') {
                                ?>
                                <img src="<?php echo ASSETS_URL.'media/email_background/'.$_env['email_background_image']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Email Background Color</label>
														<div class="col-9">
															<input type="color" class="form-control" name="email_background_color" value="<?php echo $_env['email_background_color']; ?>"></input>
														</div>
													</div>


													<div class="form-group row">
														<label class="col-3 col-form-label">Email Forground Color</label>
														<div class="col-9">
                            <input type="color" class="form-control" name="email_foreground_color" value="<?php echo $_env['email_foreground_color']; ?>"></input>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Email Expiration Time</label>
														<div class="col-9">
                            <div class="input-group">
																<input class="form-control" placeholder="Expiration Time" name="email_expiration_time" type="number" value="<?php $_env['email_expiration_time']; ?>">
																<div class="input-group-append">
																	<span class="input-group-text">minutes</span>
																</div>
															</div>															
														</div>
													</div>
												</div>
											</div>
											
											</div>
											<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
											
										</div>
										<div class="col-xl-2"></div>
									</div>
								</form>
							</div>
						</div>

						<!--end::Portlet-->
					</div>
				</div>
			</div>

			<!-- end:: Content Body -->
		</div>
