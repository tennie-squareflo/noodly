"use strict";
const limit = 12;
let count = 0;
let loading = false;

$(function() {

  var win = $(window);

  load_more();

	// Each time the user scrolls
	win.scroll(function() {
		// End of the document reached?
		if ($(document).height() - win.height() <= win.scrollTop() + 60) {
      $('#loading').show();
      if (!loading) {
        load_more();
      }
        
		}
  });
  
});

function load_more() {
  loading = true;
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
      
      var $container = $('.blog-masonry_wrapper');
      $container.imagesLoaded( function() {
        console.log($container.find('.post-block').length);
          $container.masonry({
            itemSelector: '.post-block',
        });
      });
      $('#loading').hide();
      loading = false;

      count += res.length;
    }
  });
}
