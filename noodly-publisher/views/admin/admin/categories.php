<!-- begin:: Content -->
<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor">
					<!-- begin:: Content Head -->
					<div class="k-content__head k-grid__item">
						<h3 class="k-content__head-title">Sections</h3>
					</div><!-- end:: Content Head -->
					<!-- begin:: Content Body -->
					<div class="k-content__body k-grid__item k-grid__item--fluid" id="k_content_body">
						<div class="k-portlet k-portlet--mobile">
							<div class="k-portlet__head">
								<div class="k-portlet__head-label">
									<h3 class="k-portlet__head-title"><br></h3>
									<div class="form-group">
										<h3 class="k-portlet__head-title"></h3>
										
									</div>
								</div>
								<div class="k-portlet__head-toolbar">
									<div class="k-portlet__head-toolbar-wrapper">
										<div class="dropdown dropdown-inline">
											<a class="btn btn-success" href="<?php echo BASE_URL;?>section/edit"><i class="la la-user-plus"></i> Add A Section</a>
										</div>
									</div>
								</div>
							</div>
							<div class="k-portlet__body">
								<!--begin::Portlet-->
								<table class="table table-head-noborder table-striped">
									<thead>
										<tr>
											<th>&nbsp;</th>
											<th>Section</th>
											<th>Stories</th>
											<th>&nbsp</th>
											<th>&nbsp</th>
											<th>&nbsp</th>
											<th>Views</th>
											<th>&nbsp</th>
										</tr>
									</thead>
									<tbody>
                    <?php
                      foreach ($categories as $key => $category) {
                    ?>
										<tr>
											<td>
												<div class="form-check">
													<input class="form-check-input" id="defaultCheck1" type="checkbox" value=""> <label class="form-check-label" for="defaultCheck1"></label>
												</div>
											</td>
											<td>
												<h5><?php echo $category['name']; ?></h5>
											</td>
											<td><?php echo $category['storiescount']; ?></td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td><?php echo $category['visits']; ?></td>
											<td class="text-right">
												<div class="btn-group" role="group">
													<button aria-expanded="false" aria-haspopup="true" class="btn btn-outline-secondary dropdown-toggle btn-sm" data-toggle="dropdown" id="btnGroupDrop1" type="button"><i class="fa fa-bars"></i> Actions</button>
													<div aria-labelledby="btnGroupDrop1" class="dropdown-menu">
                            <a class="dropdown-item" href="<?php echo BASE_URL.'section/edit/'.$category['cid'] ?>"><i class="fa fa-pencil-alt"></i>Edit</a>
                            <a class="dropdown-item delete-btn" data-id="<?php echo $category['cid'];?>"><i class="fa fa-trash"></i> Delete</a>
													</div>
												</div>
											</td>
                    </tr>
                    <?php 
                      }
                    ?>
									</tbody>
								</table><!--end::Form-->
							</div><!--end::Portlet-->
							<!--end: Datatable -->
						</div>
					</div>
				</div><!-- end:: Content Body -->
			</div><!-- end:: Content -->