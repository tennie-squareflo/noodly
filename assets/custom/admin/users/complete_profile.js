"use strict";

import(
  "../../../vendors/custom/country-province-select/jquery.countryProvinceSelect.js"
).then(() => {
  $('.form-control[name="country"]').countryProvinceSelect({
    type: "country",
    countryFirstValue: ":Select your Country",
    provinceFirstValue: ":Select your Province",
    showHideProvinceOnChange: false,
    provinceSelect: '.form-control[name="state"]'
  });
});

$(function() {
  $("#register-form").validate({
    rules: {
      firstname: {
        required: true
      },
      password: {
        minlength: 8,
        required: true
      },
      confirm_password: {
        equalTo: "#password"
      },
      phonenumber: {
        required: true
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
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "accept/save_profile",
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
            if (res.navigate) {
              setTimeout(() => {
                location.href = BASE_URL + `accept/success`;
              });
            }
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

  // If role is super admin, hide publishers list
  $('select[name="role"]').change(e => {
    if (e.target.value === "super_admin") {
      $('select[name="pid"]').val("");
      $('select[name="pid"]').attr("disabled", true);
      $("#publisher-row").css("display", "none");
    } else {
      $('select[name="pid"]').attr("disabled", false);
      $("#publisher-row").css("display", "flex");
    }
  });

  if ($('select[name="role"]').val() === "super_admin") {
    $('select[name="pid"]').val("");
    $('select[name="pid"]').attr("disabled", true);
    $("#publisher-row").css("display", "none");
  } else {
    $('select[name="pid"]').attr("disabled", false);
    $("#publisher-row").css("display", "flex");
  }

  // submit the form if the save button is clicked.
  $("#save-btn").click(() => {
    $("#register-form").submit();
  });

  // get inital value of the profile image
  setTimeout(() => {
    $("#register-form")
      .find('input[name="avatar"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
  }, 500);
});
