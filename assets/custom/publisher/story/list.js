"use strict";

const update = (id, action) => {
  if (confirm("Really?")) {
    $.ajax({
      url: BASE_URL + "story/action/" + action,
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
          location.href = BASE_URL + `story`;
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
};

$(function() {
  $('.submit-btn').click(function() {
    const id = $(this).data('id');
    update(id, 'submit');
  });

  $('.publish-btn').click(function() {
    const id = $(this).data('id');
    update(id, 'publish');
  });

  $('.delete-btn').click(function() {
    const id = $(this).data('id');
    update(id, 'delete');
  });

  $('.block-btn').click(function() {
    const id = $(this).data('id');
    update(id, 'block');
  });

  $('.activate-btn').click(function() {
    const id = $(this).data('id');
    update(id, 'activate');
  });
});
