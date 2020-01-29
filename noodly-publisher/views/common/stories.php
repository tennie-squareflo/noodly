<section class="posts blog-masonry">
  <div class="container">
    <?php if(!empty($current_page) && $current_page === 'popular') { ?>
      <div class="contact">
        <div class="mb-4 leave-message px-3">
          <h1>Popular</h1>
        </div>
      </div>
      
    <?php } else if(!empty($current_page) && $current_page === 'channels' && !empty($current_channel)) { ?>
      <div class="contact">
        <div class="mb-4 leave-message px-3">
          <h1><?php echo $current_channel['name']; ?></h1>
        </div>
      </div>
    <?php } ?>
    <div class="blog-masonry_wrapper">
      <?php
        foreach ($stories as $key => $story) {
      ?>
        <div class="post-block post-classic">
          <div class="post-img"><a target="_self" href="<?php echo BASE_URL.'story/'.$story['url'];?>"><img class="blog-thumbnail-linked img-fluid" src="<?php echo ASSETS_URL;?>media/stories/<?php echo $story['thumb_image'];?>" alt="post image"  onError="this.src='<?php echo ASSETS_URL;?>media/images/no-image-found.png';"></a></div>
          <div class="post-detail">
            <div class="post-credit">

              <h5 class="upload-day"><?php echo display_date($story['created_at']) ?></h5>
              <div class="post-tag"><a href="#" style="color: <?php echo $categories[$story['cid']]['channel_color']; ?>;"><?php echo $categories[$story['cid']]['name']; ?></a></div>
            </div><a class="post-title regular" target="_self" href="<?php echo BASE_URL.'story/'.$story['url'];?>"><?php echo $story['title'];?></a>
          </div>
        </div>
      <? } ?>
    </div>
    <div class="row">
      <div class="col-12 text-center">
        <button class="normal-btn" id="load-more">Load more</button>
      </div>
    </div>
  </div>
</section><!--End posts-->