"use strict";

$(function() {
  $(".btn-delete-selected").click(function() {
    const selectedIds = [];
    $('input[name="defaultCheck[]"]:checked').each(function() {
      selectedIds.push($(this).val());
    });
    if (confirm("Really?")) {
      $.ajax({
        url: BASE_URL + "messages/delete",
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
            location.href = BASE_URL + `messages`;
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
  })
});
