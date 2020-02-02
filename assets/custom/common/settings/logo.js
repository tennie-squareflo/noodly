"use strict";

$(function() {
  setTimeout(() => {
    $("#settings-form")
      .find('input[name="light_back_logo"]')
      .val(
        $("#settings-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
    $("#settings-form")
      .find('input[name="dark_back_logo"]')
      .val(
        $("#settings-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
      $("#settings-form")
      .find('input[name="favicon"]')
      .val(
        $("#settings-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
  }, 500);
  $("#settings-form").validate({
    rules: {
      login_logo_size: {
        required: true
      },
      admin_logo_size: {
        required: true
      },
      website_logo_size: {
        required: true
      },
      email_logo_size: {
        required: true
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "settings/edit",
        data: $(form).serialize(),
        dataType: "json",
        method: "POST",
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

  $("#save-btn").click(() => {
    $("#settings-form").submit();
  });
});
