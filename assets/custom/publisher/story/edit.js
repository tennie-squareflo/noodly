"use strict";

const newBlock = {
  video: `<div class="row new-form-row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
										<form class="k-form new-form" id="k_form" name="k_form">
											<input type="hidden" name="type" value="video"/>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a> <label for="exampleTextarea">Video URL</label> <input class="form-control" type="text" placeholder="http://youtube.com/" name="content">
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
  heading: `<div class="row new-form-row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
										<form class="k-form new-form" id="k_form" name="k_form">
											<input type="hidden" name="type" value="heading"/>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a> <label for="exampleTextarea">Sub-heading</label> <input class="form-control" type="text" placeholder="Say Something Here" name="content">
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
  image: `<div class="row new-form-row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
										<form class="k-form new-form" id="k_form" name="k_form">
											<input type="hidden" name="type" value="image"/>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a> <label for="exampleTextarea">Image</label><br>
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
  text: `<div class="row new-form-row">
							<div class="col-lg-12">
								<!--begin::Portlet-->
								<div class="k-portlet" id="k_page_portlet">
									<div class="k-portlet__body">
										<form class="k-form new-form" id="k_form" name="k_form">
											<input type="hidden" name="type" value="text"/>
											<div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<div class="form-group form-group-last">
																<a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a> <label for="exampleTextarea">Text</label> 
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
  // intialize images
  setTimeout(() => {
    $(".main-form")
      .find('input[name="thumb_image"]')
      .val(
        $(".main-form")
          .find('input[name="thumb_image"]')
          .siblings('input[type="file"]')
          .attr("data-value")
      );
    $(".main-form")
      .find('input[name="cover_image"]')
      .val(
        $(".main-form")
          .find('input[name="thumb_image"]')
          .siblings('input[type="file"]')
          .attr("data-value")
      );
      $(".sortable .k-form").each(function() {
        $(this)
          .find(".slim input[name=content]")
          .val(
            $(this)
              .find('input[type="file"]')
              .attr("data-value")
          );
      });
  }, 500);

  jQuery.validator.setDefaults({
    errorElement: "span",
    errorPlacement: function(error, element) {
      error.addClass("invalid-feedback");
      error.addClass("text-right");
      error.addClass("px-3");
      element.closest(".form-group").append(error);
    },
    highlight: function(element, errorClass, validClass) {
      $(element).addClass("is-invalid");
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).removeClass("is-invalid");
    }
  });

  jQuery.validator.addMethod(
    "checkUrl",
    e => {
      if (e.match(/[a-zA-Z0-9-]*/)) {
        let exist = false;
        $.ajax({
          url: BASE_URL + "api/check_story_url",
          data: {
            url: $(".main-form input[name=url]").val(),
            id: $(".main-form input[name=id]").val()
          },
          dataType: "json",
          method: "POST",
          async: false,
          success: function(res) {
            exist = res.exist;
          }
        });
        return !exist;
      }
      return false;
    },
    "URL must be valid and unique"
  );

  $(".sortable").sortable({
    revert: true
  });

  $('.btn-block-delete').click(function() {
    $(this).parents('.new-form-row').remove();
  });

  $(".btn-add-block").click(function() {
    const type = $(this).data("block-type");
    const block = $(newBlock[type]);
    //block.insertBefore("#k_content_body #insert_block");
    $(".sortable").append(block);
    block.find('.btn-block-delete').click(function() {
      $(this).parents('.new-form-row').remove();
    });
    if (type === "image") {
      block.find('input[type="file"]').slim({
        service: `${BASE_URL}api/story_image_upload/content`,
        push: true,
        didReceiveServerError: "handleError"
      });
    }
    block.find("form").validate({
      rules: {
        content: {
          required: true
        }
      }
    });
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
  });

  $(".main-form").validate({
    rules: {
      title: {
        required: true
      },
      url: {
        required: true,
        checkUrl: true
      },
      category: {
        required: true
      },
      thumb_image: {
        required: true
      },
      cover_image: {
        required: true
      },
      summary: {
        required: true
      },
      first_paragraph: {
        required: true
      }
    }
  });

  $(".save-button").click(() => {
    submitForm("save");
  });

  $(".draft-button").click(() => {
    submitForm("draft");
  });

  let getSlug = $('.form-control[name=url]').val() === '';
  // get default slug
  $('.form-control[name=title]').change((e) => {
    if (getSlug === true) {
      $.ajax({
        url: `${BASE_URL}story/get_slug`,
        method: "post",
        dataType: "JSON",
        data: { title: e.target.value },
        success: function(res) {
          $('.form-control[name=url]').val(res.slug);
          getSlug = false;
        }
      });
    }
  });
});

const submitForm = type => {
  let valid = false;

  if (!$(".main-form").valid()) {
    valid = true;
  }
  $(".new-form").each(function() {
    if (!$(this).valid()) {
      valid = true;
    }
  });

  if (valid) {
    return;
  }

  const mainData = {};
  $(".main-form")
    .serializeArray()
    .forEach(item => {
      mainData[item.name] = item.value;
    });

  var data = {
    mainForm: mainData,
    otherForms: []
  };
  $(".new-form").each(function() {
    const otherData = {};
    $(this)
      .serializeArray()
      .forEach(item => {
        otherData[item.name] = item.value;
      });
    data.otherForms.push(otherData);
  });

  $.ajax({
    url: `${BASE_URL}story/action/edit`,
    method: "post",
    dataType: "JSON",
    data: { data, type },
    success: function(res) {
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      };

      toastr.success(res.message);

      setTimeout(() => {
        //location.href= BASE_URL + 'story/edit/' + res.id;
      }, 3000);
    },
    error: function(res) {
      toastr.options = {
        closeButton: false,
        debug: false,
        newestOnTop: false,
        progressBar: false,
        positionClass: "toast-top-right",
        preventDuplicates: false,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "5000",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
      };
      toastr.error(res.responseJSON.message);
    }
  });
};
