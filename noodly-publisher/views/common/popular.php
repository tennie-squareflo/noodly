<style>
  #main {
    padding-top: 150px;
  }
</style>
<section class="posts blog-masonry">
  <div class="container">
    <div class="blog-masonry_wrapper">
      <?php
        foreach ($stories as $key => $story) {
      ?>
        <div class="post-block post-classic">
          <div class="post-img"><a target="_blank" href="<?php echo BASE_URL.'story/'.$story['url'];?>"><img class="blog-thumbnail-linked" src="<?php echo ASSETS_URL;?>media/stories/<?php echo $story['thumb_image'];?>" alt="post image"></a></div>
          <div class="post-detail">
            <div class="post-credit">

              <h5 class="upload-day"><?php echo display_date($story['created_at']) ?></h5>
              <div class="post-tag"><a href="index.html"><?php echo $categories[$story['cid']]['name']; ?></a></div>
            </div><a class="post-title regular" target="_blank" href="<?php echo BASE_URL.'story/'.$story['url'];?>"><?php echo $story['title'];?></a>
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