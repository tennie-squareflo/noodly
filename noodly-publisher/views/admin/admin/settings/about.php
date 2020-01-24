<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
	<!-- begin:: Content -->
	<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

		<!-- begin:: Content Head -->
		<div class="k-content__head	k-grid__item">
			<div class="k-content__head-main">
				<h3 class="k-content__head-title">About Us</h3>
			
			</div>
			<div class="k-content__head-toolbar">
				<div class="k-content__head-toolbar-wrapper">
					
					<a class="btn btn-success" id="save-btn-about">
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
              if ($publisher_id !== 0 && count($aboutus) === 0) {
                $publisher_id = 0;
            ?>
              <div class="alert alert-danger" id="error-message" role="alert">
                <div class="alert-text">Incorrect publisher provided! Mode changed to create.</div>
              </div>
            <?php
              }
            ?>
            <form class="k-form" id="register-form-about"  method="post" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $publisher_id; ?>" />
								<div class="row">
									<div class="col-xl-2"></div>
									<div class="col-xl-8">
										<div class="k-section k-section--first">
											<div class="k-section__body">
												<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

												<div class="row new-form-row" data-type="video">
													<div class="col-lg-12">
														<!--begin::Portlet-->
														<div class="k-portlet" id="k_page_portlet">
															<div class="k-portlet__body">
																	<input type="hidden" name="type" value="video"/>
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="form-group form-group-last">
						                            <div class="col-12 k-section__content k-section__content--border">
						                              <div class="handle">
						                                <label for="exampleTextarea">Video URL</label>
						                              </div>
						                              <input class="form-control" type="text" placeholder="http://youtube.com/" name="videourl" value="<?php echo empty($aboutus['about_video']) ? null : $aboutus['about_video'] ?>">
																				</div>
																			</div>
																		</div>
																	</div>
															</div>
														</div>
													</div>
						            			</div>

												<div class="row new-form-row" data-type="image">
													<div class="col-lg-12">
														<!--begin::Portlet-->
														<div class="k-portlet" id="k_page_portlet">
															<div class="k-portlet__body">
																	<input type="hidden" name="type" value="image"/>
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="form-group form-group-last">
																				<div class="col-12 k-section__content k-section__content--border">
																					<div class="handle">
																						<label for="exampleTextarea">Image</label><br>
													                              	</div>
																					<div class="slim"
															                            data-service="<?php echo BASE_URL; ?>api/about_image_upload/imageurl"
																						data-push="true"
															                            data-did-throw-error="handleError">
															                            <input type="file" name="imageurl" data-value='<?php echo count($aboutus) ? '{"file": "'.$aboutus['about_image'].'"}' : ''; ?>'/>
															                            <?php
															                              if (count($aboutus)) {
															                            ?>
															                            <img src="<?php echo ASSETS_URL.'media/logos/'.$aboutus['about_image']; ?>" alt="">
															                            <?php
															                              }?>
															                          </div>
																				</div>
																			</div>
																		</div>
						                      						</div>
															</div>
														</div>
													</div>
						            			</div>
  												<div class="row new-form-row" data-type="text">
													<div class="col-lg-12">
														<!--begin::Portlet-->
														<div class="k-portlet" id="k_page_portlet">
															<div class="k-portlet__body">
																	<input type="hidden" name="type" value="text"/>
																	<div class="row">
																		<div class="col-xl-12">
																			<div class="form-group form-group-last">
																				<div class="col-12 k-section__content k-section__content--border">
						                              								<div class="form-group form-group-last">
														                                <div class="handle">
																							<label for="exampleTextarea">Text</label> 
														                                </div>
																						<div class="quilltext form-control" name="content">
																							<?php echo $aboutus['about_content']; ?> 
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
															</div>
														</div>
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
