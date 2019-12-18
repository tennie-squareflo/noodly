"use strict";

const call_api = (action, id, refresh = false) => {
  $.ajax({
    url: BASE_URL + "contributor/action/" + action,
    data: { id },
    dataType: "json",
    method: "POST",
    success: function(res) {
      if (res.code == 0) {
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
        if (refresh) {
          setTimeout(() => {
            location.href = location.href;
          }, 3000);
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

$(function() {
  $(".delete-btn").click(function() {
    const id = $(this).attr("data-id");
    if (confirm("Really?")) {
      call_api('delete', id, true);
    }
  });

  $(".block-btn").click(function() {
    const id = $(this).attr("data-id");
    if (confirm("Really?")) {
      call_api('block', id, true);
    }
  });

  $(".invite-btn").click(function() {
    const id = $(this).attr("data-id");
    call_api('invite', id);
  });

  $(".activate-btn").click(function() {
    const id = $(this).attr("data-id");
    if (confirm("Really?")) {
      call_api('activate', id, true);
    }
  });
});
