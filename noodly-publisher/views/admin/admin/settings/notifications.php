<!-- begin:: Content -->
<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor">
	<!-- begin:: Content -->
	<div class="k-content	k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">

		<!-- begin:: Content Head -->
		<div class="k-content__head	k-grid__item">
			<div class="k-content__head-main">
				<h3 class="k-content__head-title">Settings</h3>
			
			</div>
			<div class="k-content__head-toolbar">
				<div class="k-content__head-toolbar-wrapper">
					
					<a class="btn btn-success" id="save-btn-notifications">
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
              if ($publisher_id !== 0 && count($notifications) === 0) {
                $publisher_id = 0;
            ?>
              <div class="alert alert-danger" id="error-message" role="alert">
                <div class="alert-text">Incorrect publisher provided! Mode changed to create.</div>
              </div>
            <?php
              }
            ?>
            <form class="k-form" id="register-form-notifications"  method="post" enctype="multipart/form-data">
              	<input type="hidden" name="id" value="<?php echo $publisher_id; ?>" />
					<div class="row">
						<div class="col-xl-2"></div>
							<div class="col-xl-8">
								<div class="k-section k-section--first">
									<div class="k-section__body">
										<div class="col-12">
											<h3 class="k-section__title k-section__title-lg">User Invite</h3>
										</div>
											
										<div class="form-group">
											<label class="col-7 col-form-label">Subject:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="invite_subject" value="<?php echo count($notifications) ? $notifications['email_invitation_subject'] : ''; ?>" placeholder="Subject" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-7 col-form-label">Heading:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="invite_heading" value="<?php echo count($notifications) ? $notifications['email_invitation_title'] : ''; ?>" placeholder="Heading" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-7 col-form-label">Message:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="invite_message" value="<?php echo count($notifications) ? $notifications['email_invitation_message'] : ''; ?>" placeholder="Message" aria-describedby="basic-addon1">
											</div>
										</div>

										<div class="col-12">
											<h3 class="k-section__title k-section__title-lg">Account created</h3>
										</div>
											
										<div class="form-group">
											<label class="col-7 col-form-label">Subject:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="new_subject" value="<?php echo count($notifications) ? $notifications['email_new_user_subject'] : ''; ?>" placeholder="Subject" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-7 col-form-label">Heading:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="new_heading" value="<?php echo count($notifications) ? $notifications['email_new_user_title'] : ''; ?>" placeholder="Heading" aria-describedby="basic-addon1">
											</div>
										</div>
										<div class="form-group">
											<label class="col-7 col-form-label">Message:</label>
											<div class="col-12">
												<input type="text" class="form-control" name="new_message" value="<?php echo count($notifications) ? $notifications['email_new_user_message'] : ''; ?>" placeholder="Message" aria-describedby="basic-addon1">
											</div>
										</div>
									</div>
									
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
