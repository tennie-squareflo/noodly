"use strict";

$(function() {
  $("#settings-form").validate({
    rules: {
      email_expiration_time: {
        required: true
      },
      user_invite: {
        required: true
      },
      user_welcome: {
        required: true
      },
      new_story_posted: {
        required: true
      },
      client_private_draft: {
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
