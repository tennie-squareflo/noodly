
"use strict";

import("../../../../../vendors/custom/slim/slim.kickstart.min.js");
$(function() {

  $('#error-message').hide();
  $("#login-form").validate({
    rules: {
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true
      }
    },
    messages: {
      password: {
        required: "Please provide a password"
      },
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      $.ajax({
        url: 'action.php?action=login',
        data: $(form).serialize(),
        dataType: 'json',
        method: 'POST',
        success: function(res) {
          if (res) {
            location.href = 'dashboard.php';
          } else {
            $('#error-message').show();
          }
        }
      })
    }
  });
});