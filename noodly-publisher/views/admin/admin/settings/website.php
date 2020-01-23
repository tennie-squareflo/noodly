<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
	<!-- begin:: Content -->
	<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

		<!-- begin:: Content Head -->
		<div class="k-content__head	k-grid__item">
			<div class="k-content__head-main">
				<h3 class="k-content__head-title">Website Area</h3>
			
			</div>
			<div class="k-content__head-toolbar">
				<div class="k-content__head-toolbar-wrapper">
					
					<a class="btn btn-success" id="save-btn-website">
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
            <?php
              if ($publisher_id !== 0 && count($website) === 0) {
                $publisher_id = 0;
            ?>
              <div class="alert alert-danger" id="error-message" role="alert">
                <div class="alert-text">Incorrect publisher provided! Mode changed to create.</div>
              </div>
            <?php
              }
            ?>
            <form class="k-form" id="register-form-website"  method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $publisher_id; ?>" />
								<div class="row">
									<div class="col-xl-2"></div>
									<div class="col-xl-8">
										<div class="k-section k-section--first">
											<div class="k-section__body">
												<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

												<div class="form-group">
													<label class="col-3 col-form-label">Logo</label>
													<div class="col-9">
                          <div class="slim"
                            data-service="<?php echo BASE_URL; ?>settings/logo_upload"
															data-push="true"
                            data-did-throw-error="handleError">
                            <input type="file" name="logo" data-value='<?php echo count($website) ? '{"file": "'.$website['website_logo'].'"}' : ''; ?>'/>
                            <?php
                              if (count($website)) {
                            ?>
                            <img src="<?php echo ASSETS_URL.'media/logos/'.$website['website_logo']; ?>" alt="">
                            <?php
                              }?>
                          </div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-7 col-form-label">Logo Size:</label>
													<div class="col-12">
														<input class="form-control" placeholder="30px" name="logo_size" type="text" value="<?php echo count($website) ? $website['website_logo_size'] : ''; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-7 col-form-label">Color 1:</label>
													<div class="col-12">
														<input class="form-control" placeholder="#f17070" name="color_bg" type="text" value="<?php echo count($website) ? $website['website_color_primary'] : ''; ?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-7 col-form-label">Color 2:</label>
													<div class="col-12">
														<input class="form-control" placeholder="#f17070" name="color_text" type="text" value="<?php echo count($website) ? $website['website_color_secondary'] : ''; ?>">
													</div>
												</div>	
											</div>
										</div>
									</div>
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
