				<!-- begin:: Content -->
				<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
					<!-- begin:: Content Head -->
					<div class="k-content__head k-grid__item">
						<div class="k-content__head-main">
							<h3 class="k-content__head-title">Dashboard</h3>
							
						</div>
						<div class="k-content__head-toolbar"></div>
					</div><!-- end:: Content Head -->
					<!-- begin:: Content Body -->
					<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
						<!--begin::Row-->
						<div class="row">

								<div class="col-xl-4 col-xxl-4 order-xxl-1">

										<!--begin::Portlet-->
										<div class="k-portlet k-portlet--fit k-portlet--height-fluid">
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-3 k-widget-3--metal">
														<div class="k-widget-3__content">
															<div class="k-widget-3__content-info">
																<div class="k-widget-3__content-section">
																	<div class="k-widget-3__content-title">Stories</div>
																
																</div>
																<div class="k-widget-3__content-section">
																	<span class="k-widget-3__content-number"><?php echo number_k($stories_cnt); ?></span>
																</div>
																

																
															</div>
															
														</div>
													</div>
												</div>
											</div>
		
											<!--end::Portlet-->
		
		
											
									</div>


									<div class="col-xl-4 col-xxl-4 order-xxl-1">

										<!--begin::Portlet-->
										<div class="k-portlet k-portlet--fit k-portlet--height-fluid">
												<div class="k-portlet__body k-portlet__body--fluid">
													<div class="k-widget-3 k-widget-3--metal">
														<div class="k-widget-3__content">
															<div class="k-widget-3__content-info">
																<div class="k-widget-3__content-section">
																	<div class="k-widget-3__content-title">Messages</div>
																
																</div>
																<div class="k-widget-3__content-section">
																	<span class="k-widget-3__content-number">0</span>
																</div>
																

																
															</div>
															
														</div>
													</div>
												</div>
											</div>
		
											<!--end::Portlet-->
		
		
											
									</div>


							



						
							<div class="col-xl-4 col-xxl-4 order-xxl-1">

								<!--begin::Portlet-->
								<div class="k-portlet k-portlet--fit k-portlet--height-fluid">
									<div class="k-portlet__body k-portlet__body--fluid">
										<div class="k-widget-3 k-widget-3--warning">
											<div class="k-widget-3__content">
												<div class="k-widget-3__content-info">
													<div class="k-widget-3__content-section">
														<div class="k-widget-3__content-title">Subscribers</div>
														<div class="k-widget-3__content-desc"></div>
													</div>
													<div class="k-widget-3__content-section">
														<span class="k-widget-3__content-number"><?php echo number_k($subscribers_cnt);?></span>
													</div>

													
												</div>
												
											</div>
										</div>
									</div>
								</div>

								<!--end::Portlet-->
							</div>
							

							
						</div>

						<!--end::Row-->
						<div class="tab-content">
							<div class="tab-pane fade show active" id="k_tabs_1_1" role="tabpanel">
								<!--begin::Row-->
								<div class="row">
									<div class="col-xl-12 col-xxl-12 order-lg-12">
										<div class="k-portlet k-portlet--mobile">
											<div class="k-portlet__head">
												<div class="k-portlet__head-label">
													<h3 class="k-portlet__head-title">Latest Stories</h3>
												</div>
												<div class="k-portlet__head-toolbar">
													<div class="k-portlet__head-toolbar-wrapper">
														<button class="btn btn-sm btn-outline-success" onClick="location.href = '<?php echo BASE_URL; ?>story';" type="button"><i class="la la-list"></i> View All</button>
													</div>
												</div>
											</div>
											<div class="k-portlet__body">
												<!--begin: Datatable -->
												<table class="table table-striped table-bordered table-hover table-responsive{-sm}" id="k_table_2">
													<thead>
														<tr>
															<th>Title</th>
															<th>Contributor</th>
															<th>Posted</th>
															<th>Views</th>
															<th>Status</th>
															
														</tr>
													</thead>
													<tbody>
														<?php
															foreach ($latest_stories as $key => $story) {
														?>
															<tr>
																<td>
																	<strong><a href="<?php echo BASE_URL.'story/preview/'.$story['url'];?>" target="_blank"><?php echo $story['title']; ?></a></strong>
																</td>
																<td>
																	<strong><a href="#"><?php echo $story['username']; ?></a></strong>
																</td>
																<td><?php echo time_diff_format($story['created_at']); ?></td>
																<td><?php echo number_k($story['visits']); ?></td>
																<td>
																<?php
																	switch ($story['status']) {
																		case 'DRAFT':
																			echo '<span class="badge badge-warning">DRAFT</span>';
																		break;
																		case 'BLOCKED':
																			echo '<span class="badge badge-error">BLOCKED</span>';
																		break;
																		case 'SUBMITTED':
																			echo '<span class="badge badge-info">SUBMITTED</span>';
																		break;
																		case 'PUBLISHED':
																			echo '<span class="badge badge-success">PUBLISHED</span>';
																		break;
																	}
																?>
																</td>
															</tr>
														<?php
															}
														?>
													</tbody>
												</table><!--end: Datatable -->
											</div>
										</div>
									</div>
									
									
									</div>
								</div><!--end::Row-->
							</div>
							


							
						</div>
						<div class="tab-pane fade" id="k_tabs_1_3" role="tabpanel">
							<!--begin::Row-->
							<div class="row">
								<div class="col-xl-12 col-xxl-12">
									<div class="tab-content">
										HELLO BETCH!!
									</div>
								</div>
							</div><!--end::Row-->
						</div>
						<div class="tab-pane fade" id="k_tabs_1_4" role="tabpanel">
							<!--begin::Row-->
							<div class="row">
								<div class="col-xl-12 col-xxl-12">
									<div class="tab-content">
										HELLO BETCH!!!
									</div>
								</div>
							</div><!--end::Row-->
						</div>
					</div>
				</div><!-- end:: Content Body -->