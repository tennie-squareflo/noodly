<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
		<!-- begin:: Content -->
		<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

			<!-- begin:: Content Head -->
			<div class="k-content__head	k-grid__item">
				<div class="k-content__head-main">
					<h3 class="k-content__head-title">User Settings</h3>
				
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
                <?php
                  if ($user_id !== 0 && count($user) === 0) {
                    $user_id = 0;
                ?>
                  <div class="alert alert-danger" id="error-message" role="alert">
                    <div class="alert-text">Incorrect user provided! Mode changed to create.</div>
                  </div>
                <?php
                  }
                ?>
                <form class="k-form" id="register-form"  method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $user_id; ?>" />
									<div class="row">
										<div class="col-xl-2"></div>
										<div class="col-xl-8">
											<div class="k-section k-section--first">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

													<div class="form-group row">
														<label class="col-3 col-form-label">Profile picture</label>
														<div class="col-lg-4 col-md-4 col-sm-6 col-xs-9">
                              <div class="slim rounded-circle"
                                data-service="<?php echo BASE_URL; ?>users/avatar_upload"
																data-push="true"
																data-ratio="1:1"
																data-size="240,240"
                                data-did-throw-error="handleError">
                                <input type="file" name="avatar" data-value='<?php echo count($user) ? '{"file": "'.$user['avatar'].'"}' : ''; ?>'/>
                                <?php
                                  if (count($user) && $user['avatar'] != '') {
                                ?>
                                <img src="<?php echo ASSETS_URL.'media/avatars/'.$user['avatar']; ?>" alt="">
                                <?php
                                  }?>
                              </div>
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-3 col-form-label">First Name</label>
														<div class="col-9">
															<input class="form-control" placeholder="First Name" name="firstname" type="text" value="<?php echo count($user) ? $user['firstname'] : ''; ?>">
														</div>
                          </div>
                          <div class="form-group row">
														<label class="col-3 col-form-label">Last Name</label>
														<div class="col-9">
															<input class="form-control" placeholder="Last Name" name="lastname" type="text" value="<?php echo count($user) ? $user['lastname'] : ''; ?>">
														</div>
                          </div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Email Address</label>
														<div class="col-9">
															<input class="form-control" placeholder="Email Address" name="email" type="text" value="<?php echo count($user) ? $user['email'] : ''; ?>" <?php echo isset($edit_user) && $edit_user == true ? '' : 'diabled readonly' ?> >
														</div>
                          </div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Password</label>
														<div class="col-9">
															<input class="form-control" placeholder="Password" name="password" id="password" type="password" value="<?php echo count($user) ? $user['password'] : ''; ?>">
														</div>
                          </div>

													<div class="form-group row">
														<label class="col-3 col-form-label">Confirm Password</label>
														<div class="col-9">
															<input class="form-control" placeholder="Confirm Password" name="confirm_password" type="password" value="<?php echo count($user) ? $user['password'] : ''; ?>">
														</div>
                          </div>
                          
                          <div class="form-group row">
														<label class="col-3 col-form-label">Phone</label>
														<div class="col-9">
															<input class="form-control" placeholder="Phone" name="phonenumber" type="text" value="<?php echo count($user) ? $user['phonenumber'] : ''; ?>">
														</div>
                          </div>
                          
													<?php 
													if (isset($edit_user) && $edit_user == true) { ?>
                          <div class="form-group row">
														<label class="col-3 col-form-label">Role</label>
														<div class="col-9">
															<select class="form-control" placeholder="Role" name="role">
                                <?php
                                  $options = array(
                                    '' => 'Select Role', 
                                    'super_admin' => 'Super Admin',
                                    'admin' => 'Publisher Admin',
                                    'contributor' => 'Contributor');
                                  foreach ($options as $key => $option) {
                                    echo "<option value='$key' ".($key === (count($user) ? $user['role'] : '') ? 'selected' : '').">$option</option>";
                                  }
                                ?>
                              </select>
														</div>
                          </div>
                          
                          <div class="form-group row">
														<label class="col-3 col-form-label">Publisher</label>
														<div class="col-9">
															<select class="form-control" placeholder="Role" name="pid">
                                <?php
																	$publishers = array('' => 'Select Publisher') + $publishers;
                                  foreach ($publishers as $key => $publisher) {
                                    echo "<option value='$key' ".($key == (count($user) ? $user['pid'] : '') ? 'selected' : '').">$publisher</option>";
                                  }
                                ?>
                              </select>
														</div>
                          </div>
                          <?php
													} ?>
												</div>
											</div>
											<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
											<div class="k-section">
												<div class="k-section__body">
													<h3 class="k-section__title k-section__title-lg">Address:</h3>
													<div class="form-group row">
														<label class="col-3 col-form-label">Country</label>
														<div class="col-9">
                              <select class="form-control" name="country" data-start-value="<?php echo count($user) ? $user['country'] : ''; ?>">
															</select>
														</div>
													</div>

													<div class="form-group row">
														<label class="col-3 col-form-label">State / Province / Region</label>
														<div class="col-9">
															<select class="form-control" name="state" data-start-value="<?php echo count($user) ? $user['state'] : ''; ?>"></select>
														</div>
													</div>


													<div class="form-group row">
														<label class="col-3 col-form-label">Address Line 1</label>
														<div class="col-9">
															<input class="form-control" placeholder="Address Line1" name="address1" type="text" value="<?php echo count($user) ? $user['address1'] : ''; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-3 col-form-label">Address Line 2</label>
														<div class="col-9">
															<input class="form-control" placeholder="Address Line 2" name="address2" type="text" value="<?php echo count($user) ? $user['address2'] : ''; ?>">
														</div>
													</div>
													<div class="form-group row">
														<label class="col-3 col-form-label">City</label>
														<div class="col-9">
															<input class="form-control" placeholder="City" name="city" type="text" value="<?php echo count($user) ? $user['city'] : ''; ?>">
														</div>
													</div>
													
													<div class="form-group row">
														<label class="col-3 col-form-label">Zip / Postal Code</label>
														<div class="col-9">
															<input class="form-control" placeholder="ZipCode" name="zipcode" type="text" value="<?php echo count($user) ? $user['zipcode'] : ''; ?>">
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
