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
    <?php } else if (!empty($current_page) && $current_page === 'hashtags' && !empty($current_hashtag)) { ?>
      <div class="contact">
        <div class="mb-4 leave-message px-3">
          <h1>#<?php echo $current_hashtag; ?></h1>
        </div>
      </div>
    <?php } ?>
    <div class="blog-masonry_wrapper">
      <script>
        const current_page = "<?php echo $current_page; ?>";
        const key = "<?php echo $key; ?>";
      </script>
      <div id="insert-post-here"/>
    </div>
  </div>
</section><!--End posts-->