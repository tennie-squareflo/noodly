
"use strict";

import("../../../../../vendors/custom/slim/slim.kickstart.min.js");
$(function() {
  $("#register-form").validate({
    rules: {
      name: {
        required: true
      },
      logo: {
        required: true
      },  
      domain: {
        required: true
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
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      $.ajax({
        url: 'action.php?action=publish_register',
        data: $(form).serialize(),
        dataType: 'json',
        method: 'POST',
        success: function(res) {
          if (res.code == 0) {
            //location.href = 'dashboard.php';
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            
            toastr.success(res.message);
            setTimeout(() => {
              location.href = `/edit_publisher.php?publisher_id=${res.id}`;
            }, 3000);
          } else {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            
            toastr.error(res.message);
          }
        }
      })
    }
  });

  $('#save-btn').click(() => {
    $('#register-form').submit();
  });
  setTimeout(() => {
    $('#register-form').find('input[name="logo"]').val($('#register-form').find('input[type="file"]').attr('data-value'));
  }, 500);
}); 