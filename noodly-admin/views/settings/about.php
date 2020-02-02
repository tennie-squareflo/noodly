<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">Notification Settings</h3>
				
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

                          <div class="row new-form-row" data-type="text">
                            <div class="col-lg-12">
                              <!--begin::Portlet-->
                              <div class="k-portlet" id="k_page_portlet">
                                <div class="k-portlet__body">
                                    <div class="row">
                                      <div class="col-xl-12">
                                        <div class="form-group form-group-last">
                                          <div class="col-12 k-section__content k-section__content--border">
                                                            <div class="form-group form-group-last">
                                                              <div class="handle">
                                                <label for="exampleTextarea">Text</label> 
                                                              </div>
                                              <div class="quilltext form-control" name="about_text">
                                                <?php echo $_env['about_text']; ?> 
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
													<!--
													<div class="row new-form-row" data-type="video">
                            <div class="col-lg-12">
                              <div class="k-portlet" id="k_page_portlet">
                                <div class="k-portlet__body">
                                    <div class="row">
                                      <div class="col-xl-12">
                                        <div class="form-group form-group-last">
                                          <div class="col-12 k-section__content k-section__content--border">
                                            <div class="handle">
                                              <label for="exampleTextarea">Video URL</label>
                                            </div>
                                            <input class="form-control" type="text" placeholder="http://youtube.com/" name="about_video" value="<?php echo $_env['about_video'] ?>">
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
														<div class="k-portlet" id="k_page_portlet">
															<div class="k-portlet__body">
                                <div class="row">
                                  <div class="col-xl-12">
                                    <div class="form-group form-group-last">
                                      <div class="col-12 k-section__content k-section__content--border">
                                        <div class="handle">
                                          <label for="exampleTextarea">about us</label>
                                        </div>
                                        <div class="slim"
                                          data-service="<?php echo BASE_URL; ?>settings/about_image_upload"
                                          data-push="true"
                                          data-ratio="1:1"
                                          data-size="240,240"
                                          data-did-throw-error="handleError">
                                          <input type="file" name="about_image" data-value='<?php echo !empty($_env['about_image']) ? '{"file": "'.$_env['about_image'].'"}' : ''; ?>'/>
                                          <?php
                                            if (!empty($_env['about_image'])) {
                                          ?>
                                          <img src="<?php echo ASSETS_URL.'media/images/'.$_env['about_image']; ?>" alt="">
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
                              -->
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
