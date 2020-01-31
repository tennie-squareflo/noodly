"use strict";
const limit = 12;
let count = 0;
let end = false;

$(function() {

  var win = $(window);

  load_more();

	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() == win.scrollTop()) {
			$('#loading').show();
      if (end === false) {
        load_more();
      }
		}
  });
  
});

function load_more() {
  $.ajax({
    url: BASE_URL + `get_stories`,
    type: 'post',
    data: {
      by: current_page,
      key: key,
      limit: limit,
      start: count
    },
    dataType: "JSON",
    success: function(res) {
      let newBlock = res.map(item => {
        return `<div class="post-block post-classic">
          <div class="post-img">
            <a target="_self" href="${BASE_URL + "story/" +item["url"]}">
              <img class="blog-thumbnail-linked img-fluid" 
                src="${ASSETS_URL + "media/stories/" + item["thumb_image"]}"  alt="post image"  
                onError="this.src='${ASSETS_URL +"media/images/no-image-found.png"}';">
            </a>
          </div>
          <div class="post-detail">
            <div class="post-credit">
              <h5 class="upload-day">${item['created_at']}</h5>
              <div class="post-tag">
                <a href="#" style="color: ${item['channel_color']}; ?>;">
                  ${item['cname']}
                </a>
              </div>
            </div>
            <a class="post-title regular" target="_self" href="${BASE_URL+'story/'+item['url']}">${item['title']}</a>
          </div>
        </div>`
      }).join('');

      $(newBlock).insertBefore($('#insert-post-here'));
      
      $('.blog-masonry_wrapper').imagesLoaded().done(function() {
          console.log('imageloaded');
          $container.css('height', 'auto');
          $('.blog-masonry_wrapper').masonry({
              itemSelector: '.post-block',
          });
        });
      
      $('#loading').hide();

      count += res.length;
      if (res.length === 0) {
        end = true;
      }
    }
  });
}
