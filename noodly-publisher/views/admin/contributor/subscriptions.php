<!-- begin:: Content -->
<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor">
					<!-- begin:: Content Head -->
					<div class="k-content__head k-grid__item">
						<h3 class="k-content__head-title">Subscriptions</h3>
					</div><!-- end:: Content Head -->
					<!-- begin:: Content Body -->
					<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
						<div class="k-portlet k-portlet--mobile">
							<div class="k-portlet__head">
								<div class="k-portlet__head-toolbar">
									<div class="k-portlet__head-toolbar-wrapper">
										<div class="dropdown dropdown-inline">
											<a class="btn btn-warning btn-delete-selected"><i class="la la-trash"></i> Delete Selected</a>
										</div>
									</div>
								</div>
								<div class="k-portlet__head-toolbar" id="contributor-action-invite">
									<div class="k-portlet__head-toolbar-wrapper">
										<div class="dropdown dropdown-inline">
										</div>
									</div>
								</div>
							</div>
							<div class="k-portlet__body">
								<!--begin::Portlet-->
								<div class="table-responsive">
									<table class="table table-head-noborder table-striped">
                  <colgroup>
                    <col width="5%">
                    <col width="40%">
                    <col width="40%">
                    <col width="15%">
                  </colgroup>
									<thead>
										<tr>
											<th>&nbsp;</th>
											<th>First Name</th>
											<th class="">Email</th>
											<th>&nbsp</th>
										</tr>
									</thead>
									<tbody>
                    <?php
                      foreach ($subscriptions as $key => $subscription) {
                    ?>
										<tr>
											<td>
												<div class="form-check">
													<input class="form-check-input" id="defaultCheck_<?php echo $subscription['id']; ?>" data-id="<?php echo $subscription['id']; ?>" name="defaultCheck[]" type="checkbox" value="<?php echo $category['cid'];?>"> <label class="form-check-label" for="defaultCheck1"></label>
												</div>
											</td>
											<td>
												<h5><?php echo $subscription['firstname']; ?></h5>
											</td>
											<td class=""><?php echo $subscription['email']; ?></td>
											<td class="text-right">
												<div class="btn-group" role="group">
													<button class="btn btn-sm delete-btn" id="btnGroupDrop1" type="button" data-id="<?php echo $subscription['id']; ?>"><i class="fa fa-trash"></i></button>
												</div>
											</td>
                    </tr>
                    <?php 
                      }
                    ?>
									</tbody>
								</table><!--end::Form-->
								</div>
							</div><!--end::Portlet-->
							<!--end: Datatable -->
						</div>
					</div>
				</div><!-- end:: Content Body -->
			</div><!-- end:: Content -->