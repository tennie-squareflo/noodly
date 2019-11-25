
"use strict";

$(function() {
  $('.delete-btn').click(function() {
    console.log('aaa');
    const id = $(this).attr('data-id');
    if (confirm('Really?')) {
      $.ajax({
        url: 'action.php?action=delete_publisher',
        data: {id},
        dataType: 'json',
        method: 'POST',
        success: function(res) {
          if (res.code == 0) {
            //location.href = 'dashboard.php';
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            
            toastr.success(res.message);
            setTimeout(() => {
              location.href = `publishers.php`;
            }, 3000);
          } else {
            toastr.options = {
              "closeButton": false,
              "debug": false,
              "newestOnTop": false,
              "progressBar": false,
              "positionClass": "toast-top-right",
              "preventDuplicates": false,
              "onclick": null,
              "showDuration": "300",
              "hideDuration": "1000",
              "timeOut": "5000",
              "extendedTimeOut": "1000",
              "showEasing": "swing",
              "hideEasing": "linear",
              "showMethod": "fadeIn",
              "hideMethod": "fadeOut"
            };
            
            toastr.error(res.message);
          }
        }
      })
    }
  })
}); 