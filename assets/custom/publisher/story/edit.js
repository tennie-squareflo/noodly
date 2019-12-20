"use strict";

const newBlock = {
  video: `<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
                    <form class="k-form" id="k_form" name="k_form">
                      <input type="hidden" name="id" value="0" />
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-danger btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-trash"></i></a> <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-arrows-alt-v"></i></a> <label for="exampleTextarea">Video URL</label> <input class="form-control" type="text" placeholder="http://youtube.com/" name="content">
														</div>
													</div>
												</div>
												<div class="col-xl-2"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
            </div><!--end::Portlet-->`,
  heading: `<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
                    <form class="k-form" id="k_form" name="k_form">
                      <input type="hidden" name="id" value="0" />
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-danger btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-trash"></i></a> <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-arrows-alt-v"></i></a> <label for="exampleTextarea">Sub-heading</label> <input class="form-control" type="text" placeholder="Say Something Here" name="content">
														</div>
													</div>
												</div>
												<div class="col-xl-2"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
            </div><!--end::Portlet-->`,
  image: `<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
                    <form class="k-form" id="k_form" name="k_form">
                      <input type="hidden" name="id" value="0" />
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-danger btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-trash"></i></a> <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-arrows-alt-v"></i></a> <label for="exampleTextarea">Image</label><br>
                              <input type="file" name="content" data-value=''/>
														</div>
													</div>
												</div>
												<div class="col-xl-2"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
            </div><!--end::Portlet-->`,
  text: `<div class="row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
                    <form class="k-form" id="k_form" name="k_form">
                      <input type="hidden" name="id" value="0" />
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<div class="form-group form-group-last">
																<a class="btn btn-outline-hover-danger btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-trash"></i></a> <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right" href="#"><i class="fas fa-arrows-alt-v"></i></a> <label for="exampleTextarea">Text</label> 
																<textarea class="form-control" id="exampleTextarea" rows="10" name="content"></textarea>
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
            </div><!--end::Portlet--></div>`
};

$(function() {
  $(".btn-add-block").click(function() {
    const type = $(this).data("block-type");
    const block = $(newBlock[type]);
    block.insertBefore("#k_content_body #insert_block");
    if (type === "image") {
      block.find('input[type="file"]').slim();
    }
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
  });

  jQuery.validator.markMethod(
    "checkUrl",
    $.debounce(500, e => {
      if (e.match(/[a-zA-Z0-9-]*/)) {
        $.ajax({
          url: BASE_URL + "api/check_story_url",
          data: { url: $(".main-form input[name=url]").val() },
          dataType: "json",
          method: "POST",
          success: function(res) {
            console.log(res.exist);
            if (res.exist === true) {
              mainFormValidator.showErrors({
                url: "This url is used."
              });
            }
          }
        });
      }
    })
  );

  const mainFormValidator = $(".main-form").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      firstname: {
        required: true
      }
    },
    messages: {
      email: "Please enter a valid email address"
    }
  });

  $(".main-form input[name=url]").keyup();
});
