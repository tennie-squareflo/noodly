"use strict";

import("../../../vendors/custom/slim/slim.kickstart.min.js");
import(
  "../../../vendors/custom/country-province-select/jquery.countryProvinceSelect.js"
).then(() => {
  $('.form-control[name="country"]').countryProvinceSelect({
    type: "country",
    countryFirstValue: ":Select your Country",
    provinceFirstValue: ":Select your Province",
    showHideProvinceOnChange: false,
    provinceSelect: '.form-control[name="state"]'
    //,onlyUseTheseCountries:'|Canada|United States'
    //,doNotUseTheseCountries:'|Canada|United States'
  });
});

$(function() {
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
    "checkDomain",
    function(value) {
      return value.match(/[A-Za-z0-9][A-Za-z0-9-]*[A-Za-z0-9]/g)[0] === value;
    },
    "Domain must be valid"
  );

  $("#register-form").validate({
    rules: {
      name: {
        required: true
      },
      logo: {
        required: true
      },
      adminlogo: {
        required: true
      },
      domain: {
        required: true,
        checkDomain: true
      },
      phone: {
        required: true
      },
      email: {
        required: true,
        email: true
      },
      country: {
        required: true
      },
      state: {
        required: true
      },
      address1: {
        required: true
      },
      city: {
        required: true
      },
      zipcode: {
        required: true
      }
    },
    messages: {
      email: "Please enter a valid email address",
      checkDomain: "Please enter a valid domain"
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "settings/action/edit",
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

  $("#register-form-email").validate({
    rules: {
      logo: {
        required: true
      },
      admin_logo: {
        required: true
      },
      // size: {
      //   required: true
      // },
      color_bg: {
        required: true
      },
      color_heading: {
        required: true
      },
      color_text: {
        required: true
      },
      color_button: {
        required: true
      },
      color_button_text: {
        required: true
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "settings/action/email",
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

  $("#register-form-notifications").validate({
    rules: {
      invite_subject: {
        required: true
      },
      invite_heading: {
        required: true
      },
      invite_message: {
        required: true
      },
      new_subject: {
        required: true
      },
      new_heading: {
        required: true
      },
      new_message: {
        required: true
      }
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "settings/action/notifications",
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

  $("#save-btn").click(() => {
    $("#register-form").submit();
  });

  $("#save-btn-notifications").click(() => {
    $("#register-form-notifications").submit();
  });

  $("#save-btn-email").click(() => {
    $("#register-form-email").submit();
  });
  setTimeout(() => {
    $("#register-form")
      .find('input[name="logo"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
    $("#register-form")
      .find('input[name="adminlogo"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
  }, 500);

  setTimeout(() => {

    console.log($("#register-form")
          .find('input[type="file"]'), "sddfdf");
    $("#register-form-email")
      .find('input[name="logo"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
    $("#register-form-email")
      .find('input[name="adminlogo"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
  }, 1000);

});
