<!-- begin:: Content -->
<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
						<!-- begin:: Content Head -->
						<div class="k-content__head k-grid__item">
							<div class="k-content__head-main">
								<h3 class="k-content__head-title"><?php echo $is_new ? 'Add A Section' : 'Edit A Section'; ?></h3>
							</div>
							<div class="k-content__head-toolbar">
								<div class="k-content__head-toolbar-wrapper">
									<a class="btn btn-success save-button"><i class="la la-check"></i> <?php echo $is_new ? 'Add Section' : 'Update'; ?></a>
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
											<form class="k-form" id="k_form" name="k_form">
												<input type="hidden" value="<?php echo $is_new ? '0' : $category['cid'];?>" name="id"/>
												<div class="row">
													<div class="col-xl-2"></div>
													<div class="col-xl-8">
														<div class="k-section k-section--first">
															<div class="k-section__body">
																<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>
																<div class="form-group">
																	<label class="col-12 col-form-label">Section Name</label>
																	<div class="col-12">
																		<input class="form-control" name="name" type="text" value="<?php echo $is_new ? '' : $category['name']; ?>">
																	</div>
																</div>

																<div class="form-group form-group">
																		<label class="col-3 col-form-label">URL</label>
																		<div class="col-12">
																			<div class="input-group">
																				<div class="input-group-append">
																					<span class="input-group-text">http://<?php echo $publisher['domain'];?>.noodly.io/section/</span>
																				</div><input class="form-control" type="text" placeholder="story-title-goes-here" value="<?php echo $is_new ? '' : $category['slug']; ?>" name="slug">
																			</div>
																		</div>
																	</div>
															
																<div class="form-group">
																	<label class="col-5 col-form-label">Image</label>
																	<div class="col-9">
																		<div class="slim"
																				data-service="<?php echo BASE_URL; ?>api/section_image_upload/image"
																				data-push="true"
																				data-did-throw-error="handleError">
																				<input type="file" name="image" data-value='<?php echo !$is_new ? '{"file": "'.$category['image'].'"}' : ''; ?>'/>
																				<?php
																					if (!$is_new && $category['image'] != '') {
																				?>
																				<img src="<?php echo ASSETS_URL.'media/sections/'.$category['image']; ?>" alt="">
																				<?php
																					}?>
																			</div>
																	
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
												</div>
												<div class="col-xl-2"></div>
											</form>
										</div>
									</div>
								</div><!--end::Portlet-->
							</div>
						</div>
					</div><!-- end:: Content Body -->
				</div><!-- end:: Content -->