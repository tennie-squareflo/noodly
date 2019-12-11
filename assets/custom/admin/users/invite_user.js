"use strict";

$(function() {

  // $("#invite-form").validate({
  //   rules: {
  //     firstname: {
  //       required: true,
  //     },
  //     email: {
  //       required: true,
  //       email: true
  //     },
  //     confirm_password: {
  //       equalTo: '#password'
  //     },
  //     role: {
  //       required: true
  //     },
  //     pid: {
  //       required: {
  //         depends: function() {
  //           return $('.form-control[name="role"]').val() !== "super_admin";
  //         }
  //       }
  //     }
  //   },
  //   messages: {
  //     email: "Please enter a valid email address"
  //   },
  //   submitHandler: function(form) {
  //     $.ajax({
  //       url: BASE_URL + "users/action/invite",
  //       data: $(form).serialize(),
  //       dataType: "json",
  //       method: "POST",
  //       success: function(res) {
  //         if (res.code == 0) {
  //           //location.href = 'dashboard.php';
  //           toastr.options = {
  //             closeButton: false,
  //             debug: false,
  //             newestOnTop: false,
  //             progressBar: false,
  //             positionClass: "toast-top-right",
  //             preventDuplicates: false,
  //             onclick: null,
  //             showDuration: "300",
  //             hideDuration: "1000",
  //             timeOut: "5000",
  //             extendedTimeOut: "1000",
  //             showEasing: "swing",
  //             hideEasing: "linear",
  //             showMethod: "fadeIn",
  //             hideMethod: "fadeOut"
  //           };

  //           toastr.success(res.message);
  //           setTimeout(() => {
  //             location.href = BASE_URL + `users/edit/${res.id}`;
  //           }, 3000);
  //         } else {
  //           toastr.options = {
  //             closeButton: false,
  //             debug: false,
  //             newestOnTop: false,
  //             progressBar: false,
  //             positionClass: "toast-top-right",
  //             preventDuplicates: false,
  //             onclick: null,
  //             showDuration: "300",
  //             hideDuration: "1000",
  //             timeOut: "5000",
  //             extendedTimeOut: "1000",
  //             showEasing: "swing",
  //             hideEasing: "linear",
  //             showMethod: "fadeIn",
  //             hideMethod: "fadeOut"
  //           };

  //           toastr.warning(res.message);
  //         }
  //       },
  //       error: function(res) {
  //         toastr.options = {
  //           closeButton: false,
  //           debug: false,
  //           newestOnTop: false,
  //           progressBar: false,
  //           positionClass: "toast-top-right",
  //           preventDuplicates: false,
  //           onclick: null,
  //           showDuration: "300",
  //           hideDuration: "1000",
  //           timeOut: "5000",
  //           extendedTimeOut: "1000",
  //           showEasing: "swing",
  //           hideEasing: "linear",
  //           showMethod: "fadeIn",
  //           hideMethod: "fadeOut"
  //         };
  //         toastr.error(res.responseJSON.message);
  //       }
  //     });
  //   }
  // });

  // $("#invite-btn").click(() => {
  //   $("#invite-form").submit();
  // });

  // $('select[name="role"]').change((e) => {
  //   if (e.target.value === 'super_admin') {
  //     $('select[name="pid"]').val('');
  //     $('select[name="pid"]').attr('disabled', true);
  //     $('#publisher-row').css('display', 'none');
  //   } else {
  //     $('select[name="pid"]').attr('disabled', false);
  //     $('#publisher-row').css('display', 'flex');
  //   }
  // });
  // if ($('select[name="role"]').val() === 'super_admin') {
  //   $('select[name="pid"]').val('');
  //   $('select[name="pid"]').attr('disabled', true);
  //   $('#publisher-row').css('display', 'none');
  // } else {
  //   $('select[name="pid"]').attr('disabled', false);
  //   $('#publisher-row').css('display', 'flex');
  // }
  
  // Check Email
  $('#invite-form input[name=email]').change($.debounce(500, (e) => {
    console.log('debouce', e);
  }));
});
