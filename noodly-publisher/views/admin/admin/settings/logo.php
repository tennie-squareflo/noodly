<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Logo Settings</h3>
				
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
                <form class="k-form" id="settings-form"  method="post" enctype="multipart/form-data">
									<div class="row">
										<div class="col-xl-2"></div>
										<div class="col-xl-8">
											<div class="k-section k-section--first">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>


													<div class="form-group">
														<label class="col-12 col-form-label">Logo for Light Background</label>
														<div class="col-12">
                              <div class="slim"
															data-container-type="light-back-logo"
                                data-service="<?php echo BASE_URL; ?>settings/logo_upload/light_back_logo"
																data-push="true"
                                data-did-throw-error="handleError">
                                <input type="file" name="light_back_logo" data-value='<?php echo !empty($_env['light_back_logo']) ? '{"file": "'.$_env['light_back_logo'].'"}' : ''; ?>'/>
                                <?php
                                  if (!empty($_env['light_back_logo'])) {
                                ?>
                                <img src="<?php echo ASSETS_URL.'media/logos/'.$_env['light_back_logo']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-12 col-form-label">Logo for Dark Background</label>
														<div class="col-12">
                              <div class="slim"
																data-container-type="dark-back-logo"

                                data-service="<?php echo BASE_URL; ?>settings/logo_upload/dark_back_logo"
																data-push="true"
                                data-did-throw-error="handleError">
                                <input type="file" name="dark_back_logo" data-value='<?php echo !empty($_env['dark_back_logo']) ? '{"file": "'.$_env['dark_back_logo'].'"}' : ''; ?>'/>
                                <?php
                                  if (!empty($_env['dark_back_logo'])) {
                                ?>
                                <img src="<?php echo ASSETS_URL.'media/logos/'.$_env['dark_back_logo']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>

													<div class="form-group">
														<label class="col-12 col-form-label">Favicon</label>
														<div class="col-12">
                              <div class="slim"
																data-container-type="favicon"
                                data-service="<?php echo BASE_URL; ?>settings/logo_upload/favicon"
																data-push="true"
                                data-did-throw-error="handleError">
                                <input type="file" name="favicon" data-value='<?php echo !empty($_env['favicon']) ? '{"file": "'.$_env['favicon'].'"}' : ''; ?>'/>
                                <?php
                                  if (!empty($_env['favicon'])) {
                                ?>
                                <img src="<?php echo ASSETS_URL.'media/logos/'.$_env['favicon']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>
													
													
													<div class="form-group">
														<label class="col-12 col-form-label">Login logo size</label>
														<div class="col-12">
															<input class="form-control" placeholder="30px" name="login_logo_size" type="text" value="<?php echo $_env['login_logo_size']; ?>">
														</div>
                          </div>

                          <div class="form-group">
														<label class="col-12 col-form-label">Admin logo size</label>
														<div class="col-12">
															<input class="form-control" placeholder="30px" name="admin_logo_size" type="text" value="<?php echo $_env['admin_logo_size']; ?>">
														</div>
                          </div>

                          <div class="form-group">
														<label class="col-12 col-form-label">Website logo size</label>
														<div class="col-12">
															<input class="form-control" placeholder="30px" name="website_logo_size" type="text" value="<?php echo $_env['website_logo_size']; ?>">
														</div>
                          </div>

                          <div class="form-group">
														<label class="col-12 col-form-label">Email logo size</label>
														<div class="col-12">
															<input class="form-control" placeholder="30px" name="email_logo_size" type="text" value="<?php echo $_env['email_logo_size']; ?>">
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
