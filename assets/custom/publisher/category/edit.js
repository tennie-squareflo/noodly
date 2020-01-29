"use strict";

$(function() {
  // intialize images
  // setTimeout(() => {
  //   $("#k_form")
  //     .find('input[name="image"]')
  //     .val(
  //       $(".main-form")
  //         .find('input[name="image"]')
  //         .siblings('input[type="file"]')
  //         .attr("data-value")
  //     );
  // }, 500);

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
          url: BASE_URL + "api/check_section_url",
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
    "Slug must be valid and unique"
  );

  $("#k_form").validate({
    rules: {
      name: {
        required: true
      },
      slug: {
        required: true,
        checkUrl: true
      },
      // image: {
      //   required: true
      // }
    },
    submitHandler: function() {
      $.ajax({
      url: `${BASE_URL}channels/action/edit`,
      method: "post",
      dataType: "JSON",
      data: $('#k_form').serialize(),
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
          location.href= BASE_URL + 'channels/edit/' + res.id;
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
    }
  });

  $(".save-button").click(() => {
    submitForm("save");
  });

  let getSlug = $('.form-control[name=slug]').val() === '';
  // get default slug
  $('.form-control[name=name]').change((e) => {
    if (getSlug === true) {
      $.ajax({
        url: `${BASE_URL}channels/get_slug`,
        method: "post",
        dataType: "JSON",
        data: { title: e.target.value },
        success: function(res) {
          $('.form-control[name=slug]').val(res.slug);
          getSlug = false;
        }
      });
    }
  });
});

const submitForm = type => {
  let valid = false;
  $("#k_form").submit();
};
