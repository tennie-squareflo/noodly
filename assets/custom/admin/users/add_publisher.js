"use strict";

$(function() {
  $("#add-publication-form").validate({
    rules: {
      email: {
        required: true,
        email: true
      },
      firstname: {
        required: true
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
        url: BASE_URL + "users/action/invite",
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

  $("#add-btn").click(() => {
    // $("#add-publication-form").submit();
    // $.ajax({
    //   success: function($post) {
    //     console.log($post);
    //   }
    // })
    $.get("http://dev.noodly.com/admin/users/edit", function(data, status) {
      console.log(data);
    })
  });

  $("#add-publication-form #publisher-row").css("display", "none");

  $('#add-publication-form select[name="role"]').change(e => {
    if (e.target.value === "super_admin" || e.target.value === "") {
      $('#add-publication-form select[name="pid"]').val("");
      $('#add-publication-form select[name="pid"]').attr("disabled", true);
      $("#add-publication-form #publisher-row").css("display", "none");
    } else {
      $('#add-publication-form select[name="pid"]').attr("disabled", false);
      $("#add-publication-form #publisher-row").css("display", "flex");
    }
  });
  if ($('#add-publication-form select[name="role"]').val() === "super_admin" || $('#add-publication-form select[name="role"]').val() === "") {
    $('#add-publication-form select[name="pid"]').val("");
    $('#add-publication-form select[name="pid"]').attr("disabled", true);
    $("#add-publication-form #publisher-row").css("display", "none");
  } else {
    $('#add-publication-form select[name="pid"]').attr("disabled", false);
    $("#add-publication-form #publisher-row").css("display", "flex");
  }
});
