"use strict";
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
        url: BASE_URL + 'login/login',
        data: $(form).serialize(),
        dataType: 'json',
        method: 'POST',
        success: function(res) {
          location.href = BASE_URL+'dashboard';
        },
        error: function(res) {
          let message = '';
          switch(res.responseJSON.code) {
            case 1:
              message = 'Incorrect email or password';
              break;
            case 2:
              message = 'This user does not have a role in this publisher.';
              break;
            case 3:
              message = 'This user has not accepted the invitation yet. Please check your inbox to accept the invitation.';
              break;
          }
          $('#error-message').text(message);
          $('#error-message').show();
        }
      })
    }
  });
});