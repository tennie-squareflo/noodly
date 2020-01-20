<section class="posts blog-creative">
<div class="container-fluid">
  <div class="row">
    <div class="slider-image">
    
      <div class="post-classic-tib big-post" style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('<?php echo ASSETS_URL.'media/stories/'.$post['cover_image'];?>')">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-10 col-lg-12">
              <div class="post-detail">
                <div class="post-credit">
                  <div class="post-tag"><a href="index.html"><?php echo $category['name']; ?></a></div>
                </div>
                <h1 class="post-title title"><?php echo $post['title'];?></h1>
                <div class="post-credit">
                  <div class="author">
                    <h5 class="author-name"><?php echo 'By '.$author['firstname'].' '.$author['lastname']; ?></h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</section>

<section class="blog-detail blog-detail blog-detail-sidebar">
<div class="container">

<div class="row justify-content-center">
  <div class="col-10 col-lg-12">
    <div class="post-block">
      <div class="blog-pragraph first-paragraph"> <?php echo $post['first_paragraph']; ?></div>

      <div id="add-section-here"></div>
      <script>
        const firstPid = <?php echo $post['first_pid']; ?>;
      </script>
    </div>
    
    <div class="post-author-detail">
      <div class="row no-gutters align-items-center">
        <div class="col-sm-1 col-md-2">
          <div class="author-avatar">
          <?php
            if (empty($author['avatar']) || (empty($_SESSION['user']['avatar']))
              || !file_exists(ASSETS_PATH."media/avatars/".$_SESSION['user']['avatar'])) {
          ?>
              <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000" class="rounded-circle"
            />
          <?php
            } else {
          ?>
            <img src="<?php echo ASSETS_URL;?>media/avatars/<?php echo $_SESSION['user']['avatar'];?>" class="rounded-circle"
            />
          <?php
            }
            ?>
          </div>
        </div>
        <div class="col-sm-7 col-md-9">
          <div class="author-info">
            <h5><?php echo $author['firstname'].' '.$author['lastname']; ?></h5>
            <div class="author-social">
              <?php if(!empty($author['facebookurl'])) { ?>
              <a target="_blank" href="<?php echo $author['facebookurl']; ?>">
                <i class="fab fa-facebook-f"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['twitterurl'])) { ?>
              <a target="_blank" href="<?php echo $author['twitterurl']; ?>">
                <i class="fab fa-twitter"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['instagramurl'])) { ?>
              <a target="_blank" href="<?php echo $author['instagramurl']; ?>">
                <i class="fab fa-instagram"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['youtubeurl'])) { ?>
              <a target="_blank" href="<?php echo $author['youtubeurl']; ?>">
                <i class="fab fa-youtube"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['vimeourl'])) { ?>
              <a target="_blank" href="<?php echo $author['vimeourl']; ?>">
                <i class="fab fa-vimeo"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['soundcloudurl'])) { ?>
              <a target="_blank" href="<?php echo $author['soundcloudurl']; ?>">
                <i class="fab fa-soundcloud"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['websiteurl'])) { ?>
              <a target="_blank" href="<?php echo $author['websiteurl']; ?>">
                <i class="fa fa-globe"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['otherurl'])) { ?>
              <a target="_blank" href="<?php echo $author['otherurl']; ?>">
                <i class="fa fa-globe"></i>
              </a>
              <?php } ?>
            </div>
            <p><?php echo $author['shortbio']; ?></p>
            <button class="normal-btn btn-secondary">Contact</button> &nbsp; <button class="normal-btn">Subscribe</button>
          </div>
        </div>
      </div>
      <div class="another-posts"><a class="arrow-control arrow-prev" href="blog_detail.html"><i class="arrow_left"></i></a><a class="arrow-control arrow-next" href="blog_detail.html"><i class="arrow_right"></i></a>
      <div class="row no-gutters">
        <div class="col-12 col-md-6"><a href=""></a>
          <div class="another-post_block prev-post">
            <div class="post-mini-img text-left"><a href="blog_detail.html"><img src="https://images.pexels.com/photos/999248/pexels-photo-999248.png?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></a></div>
            <div class="post-title">
              <p>Previous post</p><a href="blog_detail.html">The Personality Trait That Makes People Happier</a>
            </div>
          </div>
        </div>
        <div class="col-12 col-md-6">
          <div class="another-post_block text-right next-post">
            <div class="post-title">
              <p>Next post</p><a href="blog_detail.html">The Personality Trait That Makes People Happier</a>
            </div>
            <div class="post-mini-img text-right"><a href="blog_detail.html"><img src="https://images.pexels.com/photos/3133688/pexels-photo-3133688.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></a></div>
          </div>
        </div>
      </div>
    </div>
    </div>
    
  </div>

</div>
</section><!--End posts-->