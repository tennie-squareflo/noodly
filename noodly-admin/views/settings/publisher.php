<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Publisher Settings</h3>
				
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
                  <input type="hidden" name="id" value="-1" />
									<div class="row">
										<div class="col-xl-2"></div>
										<div class="col-xl-8">
											<div class="k-section k-section--first">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>
													
													<div class="form-group">
														<label class="col-8 col-form-label">Company Name</label>
														<div class="col-12">
															<input class="form-control" placeholder="Company Name" name="name" type="text" value="<?php echo $publisher['name']; ?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-5 col-form-label">Phone #</label>
														<div class="col-12">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																<input type="text" class="form-control" name="phone" value="<?php echo $publisher['phonenumber']; ?>" placeholder="Phone" aria-describedby="basic-addon1">
															</div>
														</div>
													</div>
													<div class="form-group">
														<label class="col-7 col-form-label">Email Address</label>
														<div class="col-12">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
																<input type="text" class="form-control" name="email" value="<?php echo $publisher['email']; ?>" placeholder="Email" aria-describedby="basic-addon1">
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
											<div class="k-section">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">Address:</h3>
													<div class="form-group">
														<label class="col-3 col-form-label">Country</label>
														<div class="col-12">
                              <select class="form-control" name="country" data-start-value="<?php echo $publisher['country']; ?>">
															</select>
														</div>
													</div>

													<div class="form-group">
														<label class="col-9 col-form-label">State / Province / Region</label>
														<div class="col-12">
															<select class="form-control" name="state" data-start-value="<?php echo $publisher['state']; ?>"></select>
														</div>
													</div>


													<div class="form-group">
														<label class="col-7 col-form-label">Address Line 1</label>
														<div class="col-12">
															<input class="form-control" placeholder="Address Line1" name="address1" type="text" value="<?php echo $publisher['address1']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-7 col-form-label">Address Line 2</label>
														<div class="col-12">
															<input class="form-control" placeholder="Address Line 2" name="address2" type="text" value="<?php echo $publisher['address2']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-3 col-form-label">City</label>
														<div class="col-12">
															<input class="form-control" placeholder="City" name="city" type="text" value="<?php echo $publisher['city']; ?>">
														</div>
													</div>
													
													<div class="form-group">
														<label class="col-7 col-form-label">Zip / Postal Code</label>
														<div class="col-12">
															<input class="form-control" placeholder="ZipCode" name="zipcode" type="text" value="<?php echo $publisher['zipcode']; ?>">
														</div>
													</div>
												</div>
											</div>
											<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
											<div class="k-section">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">My Links:</h3>
													<div class="form-group">
														<label class="col-7 col-form-label">Facebook URL</label>
														<div class="col-12">
															<input class="form-control" placeholder="Facebook URL" name="facebookurl" type="text" value="<?php echo $publisher['facebookurl']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-7 col-form-label">Twitter URL</label>
														<div class="col-12">
															<input class="form-control" placeholder="Twitter URL" name="twitterurl" type="text" value="<?php echo $publisher['twitterurl']; ?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-7 col-form-label">Instagram URL</label>
														<div class="col-12">
															<input class="form-control" placeholder="Instagram URL" name="instagramurl" type="text" value="<?php echo $publisher['instagramurl']; ?>">
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
