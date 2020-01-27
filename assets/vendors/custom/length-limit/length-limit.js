$.fn.limitLength = function(length) {
  this.attr('maxlength', length);
  const counter = $(`<div class="text-right">${this.val().length}/${length}</div>`);
  counter.insertAfter(this);
  
  updateLength = function() {
    const value = $(this).val();
    if (value.length > length) {
      $(this).val(value.slice(0, length));
      counter.html(`${length}/${length}`);
    } else {
      counter.html(`${value.length}/${length}`);
    }
  }

  this.keydown(updateLength);
  this.keyup(updateLength);
  this.change(updateLength);
};
