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
        <div class="mb-4 leave-message px-3 d-flex justify-content-between align-items-center">
          <h1 class="m-0"><?php echo $current_channel['name']; ?></h1>
          <button class="normal-btn" onclick="openModal('channel', <?php echo $current_channel['cid'];?>);">Subscribe</button>
        </div>
      </div>
    <?php } else if (!empty($current_page) && $current_page === 'hashtags' && !empty($current_hashtag)) { ?>
      <div class="contact">
        <div class="mb-4 leave-message px-3 d-flex justify-content-between align-items-center">
          <h1 class="m-0">#<?php echo $current_hashtag; ?></h1>
          <button class="normal-btn" onclick="openModal('hashtag', '<?php echo $current_hashtag;?>');">Subscribe</button>
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