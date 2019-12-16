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
												<div class="k-widget-3__content-title">Publishers</div>
											
											</div>
											<div class="k-widget-3__content-section">
												<span class="k-widget-3__content-number"><?php echo $count['publishers']; ?></span>
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
												<div class="k-widget-3__content-title">contributors</div>
											
											</div>
											<div class="k-widget-3__content-section">
												<span class="k-widget-3__content-number"><?php echo $count['contributors']; ?></span>
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
										<div class="k-widget-3__content-title">Stories</div>
										<div class="k-widget-3__content-desc"></div>
									</div>
									<div class="k-widget-3__content-section">
										<span class="k-widget-3__content-number"><?php echo $count['stories']; ?></span>
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
									<h3 class="k-portlet__head-title">Publishers</h3>
								</div>
								<div class="k-portlet__head-toolbar">
									<div class="k-portlet__head-toolbar-wrapper">
										<button class="btn btn-sm btn-outline-success" onClick="location.href = '<?php echo $base_url; ?>publishers.php';" type="button"><i class="la la-list"></i> View All</button>
									</div>
								</div>
							</div>
							<div class="k-portlet__body">
								<!--begin: Datatable -->
								<table class="table table-striped table-bordered table-hover table-responsive{-sm}" id="k_table_2">
									<thead>
										<tr>
											<th>Name</th>
											<th>Contributors</th>
											<th>Stories</th>
											<th>Visits</th>
											<th>Subscribers</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($publishers as $publisher) {
											# code...
										?>
										<tr>
											<td><h5><a href="http://<?php echo $publisher['domain'];?>.noodly.io/"><?php echo $publisher['name'];?></a></h5></td>
											<td><?php echo $publisher['contributors'];?></td>
											<td><?php echo $publisher['stories'];?></td>
											<td><?php echo $publisher['visits'];?></td>
											<td><span class="badge badge-warning"><?php echo $publisher['subscribers'];?></span></td>
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
</div>
</div><!-- end:: Content -->