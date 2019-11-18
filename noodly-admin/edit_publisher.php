<?php
  include_once('../common/initialize.php');
  $style_files = array('vendors/custom/slim/slim.min.css');
  $script_files = array('demo/default/custom/custom/publisher-register/register.js');

  $publisher_id = isset($_GET['publisherid']) ? $_GET['publisherid'] : 0;
  $publisher = get_publisher_info($db, $publisher_id);
?>
<?php
  include_once('layout/header.php');
?>
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
						
						<a href="#" class="btn btn-success" id="save-btn">
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
                  if ($publisher_id !== 0 && count($publisher) === 0) {
                    $publisher_id = 0;
                ?>
                  <div class="alert alert-danger" id="error-message" role="alert">
                    <div class="alert-text">Incorrect publisher provided! Mode changed to create.</div>
                  </div>
                <?php
                  }
                ?>
                <form class="k-form" id="register-form"  method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $publisher_id; ?>" />
									<div class="row">
										<div class="col-xl-2"></div>
										<div class="col-xl-8">
											<div class="k-section k-section--first">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>
													
													<div class="form-group row">
														<label class="col-3 col-form-label">Company Name</label>
														<div class="col-9">
															<input class="form-control" placeholder="Company Name" name="name" type="text" value="<?php echo count($publisher) ? $publisher['name'] : ''; ?>">
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Domain Name</label>
														<div class="col-9">
															<input class="form-control" placeholder="Domain Name" name="domain" type="text" value="<?php echo count($publisher) ? $publisher['domain'] : ''; ?>">
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Logo</label>
														<div class="col-9">
                              <div class="slim"
                                data-service="../common/libraries/upload_logo.php"
                                data-did-throw-error="handleError">
                                <input type="file" name="logo" data-value='{"file": "<?php echo $publisher['logo']; ?>"}'/>
                                <?php
                                  if (count($publisher)) {
                                ?>
                                <img src="<?php echo $assets_url.'media/logos/'.$publisher['logo']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-3 col-form-label">Phone #</label>
														<div class="col-9">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text"><i class="la la-phone"></i></span></div>
																<input type="text" class="form-control" name="phone" value="<?php echo count($publisher) ? $publisher['phonenumber'] : ''; ?>" placeholder="Phone" aria-describedby="basic-addon1">
															</div>
														</div>
													</div>
													<div class="form-group row">
														<label class="col-3 col-form-label">Email Address</label>
														<div class="col-9">
															<div class="input-group">
																<div class="input-group-prepend"><span class="input-group-text"><i class="la la-at"></i></span></div>
																<input type="text" class="form-control" name="email" value="<?php echo count($publisher) ? $publisher['email'] : ''; ?>" placeholder="Email" aria-describedby="basic-addon1">
															</div>
														</div>
													</div>
													
												</div>
											</div>
											<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
											<div class="k-section">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">Address:</h3>
													<div class="form-group row">
														<label class="col-3 col-form-label">Country</label>
														<div class="col-9">
                              <select class="form-control" name="country">
                                <option value="" <?php echo count($publisher) ? '' : 'selected'; ?> disabled hidden>Select...</option>
                                <?php
                                  foreach (COUNTRY_NAMES as $key => $value) {
                                    # code...
                                    echo "<option value='$key' ".(count($publisher) && $key === $publisher['country'] ? 'selected' : '').">$value</option>\n";
                                  }
                                ?>
															</select>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">State / Province / Region</label>
														<div class="col-9">
															<input class="form-control" placeholder="State" name="state" type="text" value="<?php echo count($publisher) ? $publisher['state'] : ''; ?>">
														</div>
													</div>


													<div class="form-group row">
														<label class="col-3 col-form-label">Address Line 1</label>
														<div class="col-9">
															<input class="form-control" placeholder="Address Line1" name="address1" type="text" value="<?php echo count($publisher) ? $publisher['address1'] : ''; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-3 col-form-label">Address Line 2</label>
														<div class="col-9">
															<input class="form-control" placeholder="Address Line 2" name="address2" type="text" value="<?php echo count($publisher) ? $publisher['address2'] : ''; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-3 col-form-label">City</label>
														<div class="col-9">
															<input class="form-control" placeholder="City" name="city" type="text" value="<?php echo count($publisher) ? $publisher['city'] : ''; ?>">
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-3 col-form-label">Zip / Postal Code</label>
														<div class="col-9">
															<input class="form-control" placeholder="ZipCode" name="zipcode" type="text" value="<?php echo count($publisher) ? $publisher['zipcode'] : ''; ?>">
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

		<!-- end:: Content -->
<?php
  include_once('layout/footer.php');
?>