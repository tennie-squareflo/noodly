"use strict";

$(function() {
  $('#subscribe-pub-form').validate({
    rules: {
      firstname: {
        required: true
      },
      email: {
        required: true,
        email: true
      }
    },
    submitHandler: function() {
      const obj = $('#subscribe-pub-form').serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
      }, {});
      subscribeTo(obj.firstname, obj.email, obj.type, obj.id);
    }
  });
  $('#subscribe-modal-form').validate({
    rules: {
      firstname: {
        required: true
      },
      email: {
        required: true,
        email: true
      }
    },
    submitHandler: function() {
      const obj = $('#subscribe-modal-form').serializeArray().reduce(function(obj, item) {
          obj[item.name] = item.value;
          return obj;
      }, {});
      subscribeTo(obj.firstname, obj.email, obj.type, obj.id);
      
    }
  });
  $('#subscribe-btn').click(function () {
    $('#subscribe-modal-form').submit();
  })
});

function openModal(type, id) {
  $('#subscribe-modal-form').find('input[name="type"]').val(type);
  $('#subscribe-modal-form').find('input[name="id"]').val(id);

  $('#subscribe-modal').modal();
}

function subscribeTo(firstname, email, type, id) {
    $.ajax({
      url: BASE_URL + `api/subscribe_to`,
      type: "post",
      data: {
        firstname, email, type, id
      },
      dataType: "JSON",
      success: function() {
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

        toastr.success('Subscription Success');
      },
      error: function() {
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

        toastr.error('Subscription Failed');
      }
  });
}