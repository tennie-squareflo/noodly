				<!-- begin:: Content -->
				<div class="k-content k-grid__item k-grid__item--fluid k-grid k-grid--hor" id="k_content">
					<!-- begin:: Content Head -->
					<div class="k-content__head k-grid__item">
						<div class="k-content__head-main">
							<h3 class="k-content__head-title"><?php echo $is_new ? 'Add A Story' : 'Edit Story'; ?></h3>
						</div>
						<div class="k-content__head-toolbar">
							<div class="k-content__head-toolbar-wrapper">
								<?php if ($is_new || $post['status'] === 'DRAFT' || $post['status'] === 'SUBMITTED' || $post['status'] === 'REJECTED' || $post['status'] === 'CLIENT-DRAFT') : ?>
									<a class="btn btn-metal direct-draft-button" id="direct-draft-btn"><i class="fa fa-paper-plane"></i> Send Private Draft</a>
								<?php endif; ?>
								<?php 
								if ($is_new) :
								?>
								<a class="btn btn-metal draft-button"><i class="la la-save"></i> Save as Draft</a>
								<?php 
								endif;
								?>
								<a class="btn btn-success save-button"><i class="la la-check"></i> <?php echo $_SESSION['user']['role'] === 'admin' ? 'Publish' : 'Submit'; ?></a>
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
											<input type="hidden" name="id" value="<?php echo $is_new ? '0' : $post['sid']; ?>" />
											<input type="hidden" name="client_id" id="client-id"/>
											<input type="hidden" name="client_message" id="client-message"/>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="k-section k-section--first">
														<div class="k-section__body">
															<h3 class="k-section__title k-section__title-lg">&nbsp;</h3>
															<div class="form-group">
																<label class="col-form-label">Story Title</label>
																<input class="form-control" type="text" placeholder="Story Title Goes Here" name="title" value="<?php echo $is_new ? '' : $post['title'];?>">
															</div>
															<div class="form-group form-group">
																<label class="col-form-label">URL</label>
																
																	<div class="input-group">
																	<div class="input-group-append">
																		<span class="input-group-text">http://<?php echo $publisher['domain'];?>.noodly.io/story/</span>
																	</div><input class="form-control" placeholder="story url" type="text" name="url" value="<?php echo $is_new ? '' : $post['url'];?>">
																</div>
															</div>
															<div class="k-section">
																<div class="k-section__body">
																	<div class="form-group">
																		<label class="col-form-label">Channel</label>
																		<select class="form-control" name="cid">
																			<option value="">
																				Select A Channel
																			</option>
																			<?php
																				foreach ($categories as $key => $value) {
																					if ($is_new === false && $key == $post['cid']) {
																						echo "<option value='$key' selected>$value</option>";
																					} else {
																						echo "<option value='$key'>$value</option>";
																					}
																				}
																			?>
																			</select>
																		</div>
																	</div>
																	<div class="form-group form-group">
																		<label class="col-form-label">Hash Tags</label>
																			<div class="input-group">
																				<input class="form-control" placeholder="Hash Tags" type="text" name="hashtags" value="<?php echo $is_new ? '' : $post['hashtags'];?>">
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-form-label">Thumbnail Image</label>
																		
																		<div class="slim"
																			data-service="<?php echo BASE_URL; ?>api/story_image_upload/thumb_image"
																			data-push="true"
																			data-did-throw-error="handleError" style="width: 50%">
																			<input type="file" name="thumb_image" data-value='<?php echo !$is_new ? '{"file": "'.$post['thumb_image'].'"}' : ''; ?>'/>
																			<?php
																				if (!$is_new && $post['thumb_image'] != '') {
																			?>
																			<img src="<?php echo ASSETS_URL.'media/stories/'.$post['thumb_image']; ?>" width="50%" alt="">
																			<?php
																				}?>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="col-form-label">Cover Image</label>
																		<div class="slim"
																			data-service="<?php echo BASE_URL; ?>api/story_image_upload/cover_image"
																			data-push="true"
																			data-did-throw-error="handleError">
																			<input type="file" name="cover_image" data-value='<?php echo !$is_new ? '{"file": "'.$post['cover_image'].'"}' : ''; ?>'/>
																			<?php
																				if (!$is_new && $post['cover_image'] != '') {
																			?>
																			<img src="<?php echo ASSETS_URL.'media/stories/'.$post['cover_image']; ?>" alt="">
																			<?php
																				}?>
																		</div>
																	</div>
																	<div class="form-group">
																		<label class="form-label">Short Summary</label>
																		<input class="form-control" type="text" placeholder="Summary/Short Description" name="summary" value="<?php echo $is_new ? '' : $post['summary'] ?>">
																	</div>
																	<div class="form-group">
																		<label class="form-label" for="exampleTextarea">First Paragraph</label> 
																		<div class="quilltext form-control" id="exampleTextarea" name='first_paragraph' data-block-id="0">
																			<?php echo $is_new ? '' : $post['first_paragraph']; ?> 
																		</div>
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
						<?php
							if (!$is_new) {
								$next_id = $post['first_pid'];
        				while ($next_id) {
									$paragraph = $paragraphs[$next_id];
									$next_id = $paragraph['next_pid'];
									echo '
									<div class="row new-form-row" data-type="'.$paragraph['type'].'">
										<div class="col-lg-12">
											<!--begin::Portlet-->
											<div class="k-portlet" id="k_page_portlet">
												<div class="k-portlet__body">
													<form class="k-form new-form" id="k_form" name="k_form">
														<input type="hidden" name="type" value="'.$paragraph['type'].'"/>
														<div class="row">
															<div class="col-xl-2"></div>
															<div class="col-xl-8">
													';
									switch ($paragraph['type']) {
										case 'video':
											echo '
												<div class="form-group form-group-last">
													<div class="col-12 k-section__content k-section__content--border">
														<div class="handle">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
															<label>Video URL</label>
														</div>
														<input class="form-control" type="text" placeholder="http://youtube.com/" name="content" value="'.$paragraph['content'].'">
													</div>
												</div>
											';
										break;
										case 'heading':
											echo '
												<div class="form-group form-group-last">
													<div class="col-12 k-section__content k-section__content--border">
														<div class="handle">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
															<label>Sub-heading</label>
														</div>
														<input class="form-control" type="text" placeholder="Say Something Here" name="content" value="'.$paragraph['content'].'">
													</div>
												</div>
											';
										break;
										case 'text':
											echo '
												<div class="form-group form-group-last">
													<div class="col-12 k-section__content k-section__content--border">
														<div class="form-group form-group-last">
															<div class="handle">
																<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
																<label>Text</label> 
															</div>
															<div class="form-control quilltext" data-block-id="'.$paragraph['pid'].'" name="content">'.$paragraph['content'].'</div>
														</div>
													</div>
												</div>
											';
										break;
										case 'image':
											echo '
											<div class="form-group form-group-last">
												<div class="col-12 k-section__content k-section__content--border">
													<div class="form-group form-group-last">
														<div class="handle">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
															<label>Image</label> 
														</div>
														<div class="slim"
															data-service="'.BASE_URL.'api/story_image_upload/content"
															data-push="true"
															data-did-throw-error="handleError">
															<input type="file" name="content" data-value=\''.'{"file": "'.$paragraph['content'].'"}'.'\'/>
															<img src="'.ASSETS_URL.'media/stories/'.$paragraph['content'].'" alt="">
															
														</div>'; ?>
														<input class="form-control" type="text" placeholder="Caption" name="caption" value="<?php echo $is_new ? '' : $paragraph['caption'];?>">
														<?php echo '</div>
													</div>
												</div>
											';
										break;
									}
									echo '
															</div>
															<div class="col-xl-2"></div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div><!--end::Portlet-->';
								}
							}
						?>
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

<div class="modal" tabindex="-1" role="dialog" id="add-client-modal">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
	    <div class="modal-header">
	      <h5 class="modal-title">Send to Client</h5>
	      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        <span aria-hidden="true">&times;</span>
	      </button>
	    </div>
	    <div class="modal-body">
	      <form class="k-form" id="add-client-form"  method="post" enctype="multipart/form-data">
	        <div class="row">
	          <div class="col-xl-1"></div>
	          <div class="col-xl-10">
	            <div class="k-section k-section--first">
	              <div class="k-section__body">
	                <h3 class="k-section__title k-section__title-lg">&nbsp;</h3>

									<div class="form-group row">
	                  <label class="col-form-label">Client</label>
										<select class="form-control" id="client_list" name="client_id">
											<option selected value="">Create Client</option>
											<?php
												foreach ($clients as $client) {
													if ($post['clientid'] === $client['cid'])
														echo "<option selected value='$client[cid]'>$client[firstname] $client[lastname]</option>";
													else
														echo "<option value='$client[cid]'>$client[firstname] $client[lastname]</option>";
												}
											?>
										</select>
	                </div>
	                
	                <div class="form-group row hidden-client-exists">
	                  <label class="col-form-label">FirstName</label>
	                  <input type="text" name="firstname" class="form-control" placeholder="FirstName">
	                </div>

	                <div class="form-group row hidden-client-exists">
	                  <label class="col-form-label">LastName</label>
	                  <input type="text" name="lastname" class="form-control" placeholder="LastName">
	                </div>

	                <div class="form-group row hidden-client-exists">
	                  <label class="col-form-label">E-Mail</label>
	                  <input type="text" name="email" class="form-control" placeholder="E-Mail">
	                </div>

	                <div class="form-group row hidden-client-exists">
	                  <label class="col-form-label">Company</label>
	                  <input type="text" name="company" class="form-control" placeholder="Company">
									</div>
									
									<div class="form-group row">
	                  <label class="col-form-label">Message</label>
	                  <textarea type="text" name="message" id="message" class="form-control" placeholder="Write your message to client here" rows="8"> </textarea>
	                </div>
	              </div>
	            </div>  
	            <div class="k-separator k-separator--border-dashed k-separator--space-lg"></div>
	            
	          </div>
	          <div class="col-xl-1"></div>
	        </div>
	      </form>
	    </div>
	    <div class="modal-footer">
	      <button type="button" class="btn btn-primary" id="send-client-btn">Send</button>
	      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	    </div>
	  </div>
	</div>
</div>