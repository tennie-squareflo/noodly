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
            location.href = BASE_URL + 'contributor';
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

  $(".admin-btn").click(function() {
    const id = $(this).attr("data-id");
    if (confirm("Really?")) {
      call_api('admin', id, true);
    }
  });

  $(".invite-btn").click(function() {
    const id = $(this).attr("data-id");
    call_api('invite', id);
  });

  $(".edit-btn").click(function() {
    const id = $(this).attr("data-id");
    call_api('edit', id);
  });
  
  
  $(".activate-btn").click(function() {
    const id = $(this).attr("data-id");
    if (confirm("Really?")) {
      call_api('activate', id, true);
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
        url: BASE_URL + "contributor/action/block_selected",
        data: { id: selectedIds },
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
            location.href = BASE_URL + `contributors`;
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
