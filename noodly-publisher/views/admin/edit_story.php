				<!-- begin:: Content -->
				<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
					<!-- begin:: Content Head -->
					<div class="k-content__head k-grid__item">
						<div class="k-content__head-main">
							<h3 class="k-content__head-title">Add A Story</h3>
						</div>
						<div class="k-content__head-toolbar">
							<div class="k-content__head-toolbar-wrapper">
								<a class="btn btn-metal draft-button"><i class="la la-save"></i> Save as Draft</a> <a class="btn btn-success save-button"><i class="la la-check"></i> Submit!</a>
							</div>
						</div>
					</div><!-- end:: Content Head -->
					<!-- begin:: Content Body -->
					<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
						<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
										<form class="k-form main-form" id="k_form" name="k_form">
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="k-section k-section--first">
														<div class="k-section__body">
															<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>
															<div class="form-group row">
																<label class="col-3 col-form-label">Story Title</label>
																<div class="col-9">
																	<input class="form-control" type="text" placeholder="Story Tite Goes Here" name="title">
																</div>
															</div>
															<div class="form-group form-group row">
																<label class="col-3 col-form-label">URL</label>
																<div class="col-9">
																	<div class="input-group">
																		<div class="input-group-append">
																			<span class="input-group-text">http://<?php echo $publisher['domain'];?>.noodly.io/story/</span>
																		</div><input class="form-control" placeholder="story url" type="text" name="url">
																	</div>
																</div>
															</div>
															<div class="k-section">
																<div class="k-section__body">
																	<div class="form-group row">
																		<label class="col-3 col-form-label">Category</label>
																		<div class="col-9">
																			<select class="form-control" name="cid">
																				<option value="">
																					Select A Category
																				</option>
																				<?php
																					foreach ($categories as $key => $value) {
																						echo "<option value='$key'>$value</option>";
																					}
																				?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-3 col-form-label">Thumbnail Image</label>
																		<div class="col-9">
																			<div class="slim"
																				data-service="<?php echo BASE_URL; ?>api/story_image_upload/thumb_image"
																				data-push="true"
																				data-did-throw-error="handleError">
																				<input type="file" name="thumb_image" data-value=''/>
																				<!-- <?php
																					if (count($user) && $user['avatar'] != '') {
																				?>
																				<img src="<?php echo ASSETS_URL.'media/avatars/'.$user['avatar']; ?>" alt="">
																				<?php
																					}?> -->
																			</div>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-3 col-form-label">Cover Image</label>
																		<div class="col-9">
																			<div class="slim"
																				data-service="<?php echo BASE_URL; ?>api/story_image_upload/cover_image"
																				data-push="true"
																				data-did-throw-error="handleError">
																				<input type="file" name="cover_image" data-value=''/>
																				<!-- <?php
																					if (count($user) && $user['avatar'] != '') {
																				?>
																				<img src="<?php echo ASSETS_URL.'media/avatars/'.$user['avatar']; ?>" alt="">
																				<?php
																					}?> -->
																			</div>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-3 col-form-label">Short Summary</label>
																		<div class="col-9">
																			<input class="form-control" type="text" placeholder="Summary/Short Description" name="summary">
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="exampleTextarea">First Paragraph</label> 
																		<textarea class="form-control" id="exampleTextarea" rows="10" name='first_paragraph'></textarea>
																	</div>
																</div>
															</div>
														</div>
														<div class="col-xl-2"></div>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div><!--end::Portlet-->
							</div>
						</div>
						
						<div class="sortable">
						</div>
						<div class="row" id="insert_block">
								<div class="col-lg-12">
									<!--begin::Portlet-->
									<div class="k-portlet" id="k_page_portlet">
										<div class="k-portlet__body">
											<form class="k-form" id="k_form" name="k_form">
												<div class="row">
													<div class="col-xl-2"></div>
													<div class="col-xl-8">
														<div class="form-group form-group-last">
															<div class="col-12 k-section__content k-section__content--border">
																<div class="form-group form-group-last">
																	<label for="exampleTextarea">Insert</label> <br />
																	<button type="button" class="btn btn-outline-primary btn-elevate btn-circle btn-icon btn-add-block" data-block-type="image"><i class="fa fa-image"></i></button>&nbsp;
																	<button type="button" class="btn btn-outline-primary btn-elevate btn-circle btn-icon btn-add-block" data-block-type="video"><i class="fab fa-youtube"></i></button>&nbsp;
																	<button type="button" class="btn btn-outline-primary btn-elevate btn-circle btn-icon btn-add-block" data-block-type="heading"><i class="fas fa-heading"></i></button>&nbsp;
																	<button type="button" class="btn btn-outline-primary btn-elevate btn-circle btn-icon btn-add-block" data-block-type="text"><i class="fas fa-align-left"></i></button>&nbsp;
																</div>
															</div>
														</div>
													</div>
													<div class="col-xl-2"></div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div><!--end::Portlet-->


						
					</div>
				</div>
			</div><!-- end:: Content Body -->