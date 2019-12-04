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
  $("#register-form").validate({
    rules: {
      firstname: {
        required: true,
      },
      email: {
        required: true,
        email: true
      },
      role: {
        required: true
      },
      pid: {
        required: {
          depends: function() {
            return $('.form-control[name="role"]').val() !== "super_admin";
          }
        }
      }
    },
    messages: {
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "users/action/edit",
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
              location.href = BASE_URL + `users/edit/${res.id}`;
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
  $("#save-btn").click(() => {
    $("#register-form").submit();
  });
  // setTimeout(() => {
  //   $("#register-form")
  //     .find('in  t[name="logo"]')
  //     .val(
  //       $("#register-form")
  //         .find('input[type="file"]')
  //         .attr("data-value")
  //     );
  // }, 500);
});
