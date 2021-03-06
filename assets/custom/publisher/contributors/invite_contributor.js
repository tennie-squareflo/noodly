"use strict";

$(function() {
  $("#invite-form").validate({
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
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "contributor/invite",
        data: $(form).serialize(),
        dataType: "json",
        method: "POST",
        success: function(res) {
          if (res.code == 0) {
            //location.href = 'dashboard.php';
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
              location.href = location.href;
            }, 3000);
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

            toastr.warning(res.message);
          }
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

  $("#invite-btn").click(() => {
    $("#invite-form").submit();
  });

  // Check Email
  $("#invite-form input[name=email]").keyup(
    $.debounce(500, e => {
      // check if email exists
      if ($("#invite-form input[name=email]").valid()) {
        $.ajax({
          url: BASE_URL + "api/check_email",
          data: { email: $("#invite-form input[name=email]").val() },
          dataType: "json",
          method: "POST",
          success: function(res) {
            if (res.code === 0) {
              // user exists
              $("#invite-form input[name=firstname]").val(res.name);
              $("#invite-form input[name=firstname]").attr("readonly", true);
            } else {
              //user doesn't exist
              $("#invite-form input[name=firstname]").val("");
              $("#invite-form input[name=firstname]").removeAttr("readonly");
            }
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
            toastr.error("Check your internet connction.");
          }
        });
      }
    })
  );
});
