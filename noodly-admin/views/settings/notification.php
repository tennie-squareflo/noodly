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

													<div class="form-group">
														<label class="col-12 col-form-label">Expiry</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="email_expiration_time" type="text" value="<?php echo $_env['email_expiration_time']; ?>">
														</div>
                          </div>
													
													<div class="form-group">
														<label class="col-12 col-form-label">User Invite Message</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="user_invite" type="text" value="<?php echo $_env['user_invite']; ?>">
														</div>
                          </div>

													<div class="form-group">
														<label class="col-12 col-form-label">User Welcome Message</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="user_welcome" type="text" value="<?php echo $_env['user_welcome']; ?>">
														</div>
                          </div>

													<div class="form-group">
														<label class="col-12 col-form-label">New Story Message</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="new_story_posted" type="text" value="<?php echo $_env['new_story_posted']; ?>">
														</div>
                          </div>

													<div class="form-group">
														<label class="col-12 col-form-label">Client Private Draft Message</label>
														<div class="col-12">
															<input class="form-control" placeholder="" name="client_private_draft" type="text" value="<?php echo $_env['client_private_draft']; ?>">
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
