"use strict";

const newBlock = {
  video: `<div class="row new-form-row" data-type="video">
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
                              <div class="handle">
                                <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
                                <label for="exampleTextarea">Video URL</label>
                              </div>
                              <input class="form-control" type="text" placeholder="http://youtube.com/" name="content">
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
  heading: `<div class="row new-form-row" data-type="heading">
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
                              <div class="handle">
                                <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
                                <label for="exampleTextarea">Sub-heading</label>
                              </div>
                              <input class="form-control" type="text" placeholder="Say Something Here" name="content">
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
  image: `<div class="row new-form-row" data-type="image">
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
                              <div class="handle">
                                <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
                                <label for="exampleTextarea">Image</label><br>
                              </div>
                              <input type="file" name="content" data-value=''/>
														</div>
													</div>
												</div>
												<div class="col-xl-2"></div>
                      </div>
                      <div class="row">
												<div class="col-xl-2"></div>
												<div class="col-xl-8">
													<div class="form-group form-group-last">
														<div class="col-12 k-section__content k-section__content--border">
															<input class="form-control" type="text" placeholder="Say Something Here" name="caption">
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
  text: `<div class="row new-form-row" data-type="text">
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
                                <div class="handle">
                                  <a class="btn btn-outline-hover-primary btn-sm btn-icon btn-circle pull-right btn-block-delete"><i class="fas fa-trash"></i></a>
                                  <label for="exampleTextarea">Text</label> 
                                </div>
																<div class="quilltext form-control" name="content"></div>
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

const quillSettings = {
  modules: {
    toolbar: [
      ['bold', 'italic', 'link', 'strike', 'underline']
    ]
  },
  placeholder: "Compose an epic...",
  theme: "snow" // or 'bubble'
};

const setValidation = (element, isValid) => {
  if (isValid) {
    if (!$(element).hasClass('is-invalid')) {
      const error = $('<span id="summary-error">This field is required.</span>');
    error.addClass("invalid-feedback");
    error.addClass("text-right");
    error.addClass("px-3");
    $(element)
      .closest(".form-group")
      .append(error);
    $(element).addClass("is-invalid");
    }
  } else {
    $(element).removeClass("is-invalid");
    $(element)
      .closest(".form-group")
      .remove(".invalid-feedback");
  }
};

function Generator() {};
Generator.prototype.rand = Math.floor(Math.random() * 26) + Date.now();
Generator.prototype.getId = function() {
  return this.rand++;
};
const idGen = new Generator();

const quills = [];

function deleteForm(){
  const parent = $(this).parents(".new-form-row");
  if (parent.data('type') === 'text') {
    const id = parent.find(".form-control[name='content']").data('block-id');
    delete(quills[`content${id}`]);
  }
  parent.remove();
}

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

  $('#direct-draft-btn').click((e) => {
    if (isStoryFormValid()) {
      $('#add-client-modal').modal();
    } else {
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
      toastr.error(`Complete the fields below`);
      return;
    }
  })

  $("#add-client-form").validate({
    rules: {
      firstname: {
        required: true
      },
      lastname: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      company: {
        required: true
      }
    },
    submitHandler: function() {
      $.ajax({
        url: `${BASE_URL}story/action/addclient`,
        method: "post",
        dataType: "JSON",
        data: $("#add-client-form").serialize(),
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
          const newItem = JSON.parse(res.data);
          $('#client-id').val(newItem.cid);
          $('#add-client-modal').modal('hide');
          submitForm('client-draft');
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
    }
  });

  $(".quilltext").each(function() {
    const name = $(this).attr("name");
    const id = $(this).data("block-id");
    quills[`${name}${id}`] = new Quill(
      `.form-control[name="${name}"][data-block-id="${id}"]`,
      quillSettings
    );
  });

  $(".sortable").sortable({
    connectWith: '.sortable',
    handle: '.handle'
  });

  $(".btn-block-delete").click(deleteForm);

  $(".btn-add-block").click(function() {
    const type = $(this).data("block-type");
    const block = $(newBlock[type]);
    //block.insertBefore("#k_content_body #insert_block");
    $(".sortable").append(block);
    block.find(".btn-block-delete").click(deleteForm);
    if (type === "image") {
      block.find('input[type="file"]').slim({
        service: `${BASE_URL}api/story_image_upload/content`,
        push: true,
        didReceiveServerError: "handleError"
      });
    }
    if (type === "text") {
      const quillText = block.find(".form-control[name='content']");
      const id = idGen.getId();
      quillText.attr('data-block-id', id);
      quills[`content${id}`] = new Quill(
        `.form-control[name="content"][data-block-id="${id}"]`,
        quillSettings
      );
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
      thumb_image: {
        required: true
      },
      cover_image: {
        required: true
      },
      first_paragraph: {
        required: true
      }
    },
  });

  $(".save-button").click(() => {
    submitForm("save");
  });

  $(".draft-button").click(() => {
    submitForm("draft");
  });

  $("#send-client-btn").click(() => {
    submitClient();
  });

  $('#client_list').change((v) => {
    if (v.target.value === '') {
      $('.hidden-client-exists').show();
    }
    else {
      $('.hidden-client-exists').hide();
    }
  });
  if ($('#client_list').val() === '') {
    $('.hidden-client-exists').show();
  }
  else {
    $('.hidden-client-exists').hide();
  }

  let getSlug = $(".form-control[name=url]").val() === "";
  // get default slug
  $(".form-control[name=title]").change(e => {
    if (getSlug === true) {
      $.ajax({
        url: `${BASE_URL}story/get_slug`,
        method: "post",
        dataType: "JSON",
        data: { title: e.target.value },
        success: function(res) {
          $(".form-control[name=url]").val(res.slug);
          getSlug = false;
        }
      });
    }
  });
});

const isStoryFormValid = () => {
  let invalid = false;
  if (!$(".main-form").valid()) {
    invalid = true;
  }
  $(".new-form").each(function() {
    if (!$(this).valid()) {
      invalid = true;
    }
  });

  // quilltext validation
  Object.keys(quills).forEach(key => {
    const quill = quills[key];
    if (quill.root.innerHTML === "<p><br></p>") {
      setValidation(quill.container, true);
      invalid = true;
    } else {
      setValidation(quill.container, false);
    }
  });

  return !invalid;
}

const submitForm = type => {
  const valid = isStoryFormValid();

  if (!valid) {
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
    toastr.error(`Complete the fields below`);
    return;
  }

  const mainData = {};
  $(".main-form")
    .serializeArray()
    .forEach(item => {
      mainData[item.name] = item.value;
    });
  mainData["first_paragraph"] = quills["first_paragraph0"].root.innerHTML;

  var data = {
    mainForm: mainData,
    otherForms: []
  };
  $(".new-form").each(function() {
    const otherData = {};
    const fields = $(this).serializeArray();
    let isText = false;
    fields.forEach(item => {
      {
        otherData[item.name] = item.value;
        if (item.name === "type" && item.value === "text") {
          isText = true;
        }
      }
    });
    if (isText) {
      const id = $(this).find('.form-control.quilltext[name="content"]').data('block-id');
      otherData['content'] = quills[`content${id}`].root.innerHTML;
    }
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
        location.href = BASE_URL + "story/edit/" + res.id;
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

const submitClient = () => {
  const cid = $('#client_list').val();
  if (cid === '') {
    $("#add-client-form").submit();
  } else{
    $('#client-id').val(cid);
    $('#client-message').val($('#message').val());
    submitForm('client-draft');
  }
};