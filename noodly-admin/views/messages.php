					<!-- begin:: Content -->
          <div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">

<!-- begin:: Content Head -->
<div class="k-content__head	k-grid__item">
  <h3 class="k-content__head-title">Messages</h3>
</div>

<!-- end:: Content Head -->

<!-- begin:: Content Body -->
<div class="k-content__body	k-grid__item k-grid__item--fluid" id="k_content_body">
				
				<div class="k-portlet k-portlet--mobile">
					<div class="k-portlet__head">
						<div class="k-portlet__head-label">
							<h3 class="k-portlet__head-title">
									<br /><div class="form-group ">
											<div class="input-group">
												<input type="text" class="form-control" placeholder="Search for...">
												<div class="input-group-append">
													<button class="btn btn-secondary" type="button">Go!</button>
												</div>
											</div>
									</div>
							</h3>
						</div>
						<div class="k-portlet__head-toolbar">
							<div class="k-portlet__head-toolbar-wrapper">
									
								<div class="dropdown dropdown-inline">
									
									
									

									<a href="#" class="btn btn-danger btn-delete-selected">
										<i class="la la-trash"></i> Delete Selected
								</a>
								</div>
							</div>
						</div>
					</div>
					<div class="k-portlet__body">

							<!--begin::Portlet-->
					
								
									
										<table class="table table-head-noborder table-striped">
											<colgroup>
												<col width="5%">
												<col width="20%">
												<col width="15%">
												<col width="60%">
											</colgroup>
											<thead>
												<tr>
													
														<th>&nbsp</th>
														<th>From</th>
														<th>Posted</th>
														<th>Message</th>
													
												</tr>
											</thead>
											<tbody>
											<?php
												foreach ($messages as $message) {
													echo '<tr>';
													echo '	<td>';
													echo '		<div class="form-check">';
													echo '			<input class="form-check-input" name="defaultCheck[]" type="checkbox" value="'.$message['mid'].'" id="defaultCheck">';
													echo '			<label class="form-check-label" for="defaultCheck"></label>';
													echo '		</div>';
													echo '	</td>';
													echo '	<td><h5>'.$message['firstname'].' '.$message['lastname'].'</h5></td>';
													echo '	<td>'.time_diff_format($message['created_at']).'</td>';
													echo '	<td>'.str_replace("\n", "<br/>", $message['message']).'</td>';
													echo '</tr>';
												}
											?>
												
											</tbody>
										</table>
							

								
							

							<!--end::Form-->
						</div>

						<!--end::Portlet-->
								
		
								

						<!--end: Datatable -->
					</div>
				</div>
			</div>

			<!-- end:: Content Body -->
</div>
</div>	<!-- end:: Content Body -->
</div> <!-- end:: Content -->