<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Website Settings</h3>
				
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
														<label class="col-12 col-form-label">Website Primary Color</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="website_primary_color" type="color" value="<?php echo $_env['website_primary_color']; ?>">
														</div>
                          </div>
<!-- 
                          <div class="form-group">
														<label class="col-12 col-form-label">Website Secondary Color</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="website_secondary_color" type="color" value="<?php echo $_env['website_secondary_color']; ?>">
														</div>
                          </div>

                          <div class="form-group">
														<label class="col-12 col-form-label">Website Button Color</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="website_button_color" type="color" value="<?php echo $_env['website_button_color']; ?>">
														</div>
                          </div> -->

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
