"use strict";

$(function() {
  $(".delete-btn").click(function() {
    const id = $(this).data("id");
    if (confirm("Really?")) {
      $.ajax({
        url: BASE_URL + "subscriptions/action/delete",
        data: { id },
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
          setTimeout(() => {
            // location.href = BASE_URL + `subscriptions`;
          }, 3000);
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
  $(".form-check-input").change(function() {
    var checkedNum = $('input[name="defaultCheck[]"]:checked').length;
    if(!checkedNum) {
      $(".btn-delete-selected").css("display", "none");
    }
    else {
      $(".btn-delete-selected").css("display", "block");
    }
  });
  $(".btn-delete-selected").click(function() {
    const selectedIds = [];
    $('input[name="defaultCheck[]"]:checked').each(function() {
      selectedIds.push($(this).data('id'));
    });
    if (confirm("Really?")) {
      $.ajax({
        url: BASE_URL + "subscriptions/action/delete_selected",
        data: { selectedIds },
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
          setTimeout(() => {
            // location.href = BASE_URL + `subscriptions`;
          }, 3000);
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
    // console.log(selectedIds);
  });
});
