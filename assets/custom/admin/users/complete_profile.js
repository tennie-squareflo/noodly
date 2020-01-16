"use strict";

import(
  "../../../vendors/custom/country-province-select/jquery.countryProvinceSelect.js"
).then(() => {
  $('.form-control[name="country"]').countryProvinceSelect({
    type: "country",
    countryFirstValue: ":Select your Country",
    provinceFirstValue: ":Select your Province",
    showHideProvinceOnChange: false,
    provinceSelect: '.form-control[name="state"]'
  });
});

$(function() {
  
  $("#register-form").validate({
    rules: {
      firstname: {
        required: true
      },
      password: {
        minlength: 8,
        required: true
      },
      confirm_password: {
        equalTo: "#password"
      },
      phonenumber: {
        required: true
      },
      country: {
        required: true
      },
      state: {
        required: true
      },
      address1: {
        required: true
      },
      city: {
        required: true
      },
      zipcode: {
        required: true
      }
    },
    messages: {
      email: "Please enter a valid email address"
    },
    submitHandler: function(form) {
      $.ajax({
        url: BASE_URL + "accept/save_profile",
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
            if (res.navigate) {
              setTimeout(() => {
                location.href = BASE_URL + `accept/success`;
              });
            } else if (res.id) {
              setTimeout(() => {
                location.href = BASE_URL + `users/edit/${res.id}`;
              }, 300);
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
  });

  // submit the form if the save button is clicked.
  $("#save-btn").click(() => {
    $("#register-form").submit();
  });

  // get inital value of the profile image
  setTimeout(() => {
    $("#register-form")
      .find('input[name="avatar"]')
      .val(
        $("#register-form")
          .find('input[type="file"]')
          .attr("data-value")
      );
  }, 500);

  if (editUser) {

    updateAll();

    if ($('select[name="role"]').val() !== "") {
      $('.access-section').css('display', 'none');
    } else {
      $('.access-section').css('display', 'block');
    }

    $('select[name="role"]').change((e) => {
      if (e.target.value !== "") {
        $('.access-section').css('display', 'none');
      } else {
        $('.access-section').css('display', 'block');
      }
    });

    $('#add-prole-form').validate({
      submitHandler: function(form) {
        const data = $(form).serializeArray();
        let pid, role;
        data.forEach((item) => {
          if (item.name === 'add-role') {
            role = item.value;
          } else if (item.name === 'add-pid') {
            pid = item.value;
          }
        });
        selectedPublisher[pid] = role;
        updateAll();
      }
    });
    $('#add-publisher-btn').click(() => {
      $('#add-prole-form').submit();
    })
  }
});

const drawTable = () => {
  let html = '';
  const tbody = $('#access-table-body');
  selectedPublisher.forEach((item, index) => {
    if (item) {
      const tr = $(`<tr data-index='${index}'></tr>`);
      tr.append(`<td>${publisherList[index].name}</td>`);
      tr.append(`<td>
        <input class="mr-1" type="radio" name="prole[${index}]" value="admin" ${item === "admin" ? "checked" : ""}><span class="mr-3">Admin</span>
        <input class="mr-1" type="radio" name="prole[${index}]" value="contributor" ${item === "contributor" ? "checked" : ""}><span class="mr-3">Contributor</span>
        <a class="delete-prole">X</a>
      </td>`);
      html += tr[0].outerHTML;
    }
  });
  tbody.html(html);
  tbody.find('a.delete-prole').click(function () {
    const index = $(this).closest('tr').data('index');
    delete selectedPublisher[index];
    updateAll();
  });
  tbody.find('input[type="radio"]').click(function() {
    const index = $(this).closest('tr').data('index');
    selectedPublisher[index] = this.value;
  })
}

const updatePublisherOptions = () => {
  let html = '';
  publisherList.forEach((item, index) => {
    if (!selectedPublisher[index] && index !== 0) {
      const elem = $(`<option value="${index}">${item.name}</option>`);
      html += elem[0].outerHTML;
    }
  });
  $('#add-pid').html(html);
}

const updateAll = () => {
  drawTable();
  updatePublisherOptions();
}