"use strict";

const setValidation = (element, isValid) => {
  if (isValid) {
    if (!$(element).hasClass('is-invalid')) {
      const error = $('<span id="summary-error">This field is required.</span>');
    error.addClass("invalid-feedback");
    error.addClass("text-right");
    error.addClass("px-3");
    $(element)
      .closest(".form-group")
      .append(error);
    $(element).addClass("is-invalid");
    }
  } else {
    $(element).removeClass("is-invalid");
    $(element)
      .closest(".form-group")
      .remove(".invalid-feedback");
  }
};

$(function() {

  const quillSettings = {
    modules: {
      toolbar: [
        ['bold', 'italic', 'link', 'strike', 'underline']
      ]
    },
    placeholder: "Compose an epic...",
    theme: "snow" // or 'bubble'
  };

  setTimeout(() => {
    $("#settings-form")
      .find('input[name="about_image"]')
      .val(
        $("#settings-form")
          .find('input[name="about_image"]')
          .siblings('input[type="file"]')
          .attr("data-value")
      );
  }, 500);

  const aboutText = new Quill(
    `.form-control[name="about_text"]`,
    quillSettings
  );

  $("#settings-form").validate({
    rules: {
      about_text: {
        required: true
      }
    },
    submitHandler: function(form) {
      const mainData = {};
      $("#settings-form")
        .serializeArray()
        .forEach(item => {
          mainData[item.name] = item.value;
        });
      mainData["about_text"] = aboutText.root.innerHTML;
      if (aboutText.root.innerHTML === "<p><br></p>") {
        setValidation(aboutText.container, true);
        return;
      } else {
        setValidation(aboutText.container, false);
      }
      $.ajax({
        url: BASE_URL + "settings/edit",
        data: mainData,
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

  $("#save-btn").click(() => {
    $("#settings-form").submit();
  });
});
