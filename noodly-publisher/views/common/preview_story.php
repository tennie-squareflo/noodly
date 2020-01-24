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
                  <div class="post-tag"><a href="index.html" style="background-color: <?php echo $category['channel_color'] ?>;"><?php echo $category['name']; ?></a></div>
                </div>
                <h1 class="post-title title"><?php echo $post['title'];?></h1>
                <div class="post-credit">
                  <div class="author">
                    <h5 class="author-name"><?php echo 'By '.$author['firstname'].' '.$author['lastname']; ?></h5>
                  </div>
                </div>
                <? if(!empty($client)): ?>
                  <div class="post-credit mt-4">
                    <a class="btn btn-success btn-font-sm font-weight-bold" style="font-size: 12px" href="<?php echo BASE_URL.'story/change_status/'.$sid.'/APPROVE' ?>">PUBLISH</a>
                    <a class="btn bg-white btn-font-sm font-weight-bold" style="font-size: 12px" href="<?php echo BASE_URL.'story/change_status/'.$sid.'/SUBMITTED' ?>">Request Changes</a>
                    <a class="btn btn-danger btn-font-sm font-weight-bold" style="font-size: 12px" href="<?php echo BASE_URL.'story/change_status/'.$sid.'/SUBMITTED' ?>">Reject</a>
                  </div>
                <? endif; ?>
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
    <div class="post-footer">
      <div class="row">
        <div class="col-sm-6">
          <div class="post-tags">
            <?php //
              $hashtags = explode(' ', $post['hashtags']);

              for($i =0; $i < count($hashtags); $i++) {?>
                <a href="#"><?php echo $hashtags[$i] ?></a>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <div class="post-author-detail">
      <div class="row no-gutters align-items-start">
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
            <button class="normal-btn">Subscribe</button>
          </div>
        </div>
      </div>
      <div class="another-posts">
        <?php if(!empty($prev_story['sid'])) { ?>
          <a class="arrow-control arrow-prev" href="<?php echo BASE_URL.'story/'.$prev_story['url'];?>"><i class="arrow_left"></i></a>
        <?php } ?>
        <?php if(!empty($next_story['sid'])) { ?>
          <a class="arrow-control arrow-next" href="<?php echo BASE_URL.'story/'.$next_story['url'];?>"><i class="arrow_right"></i></a>
        <?php } ?>
      <div class="row no-gutters">
        
        <div class="col-12 col-md-6"><a href=""></a>
          <?php if(!empty($prev_story['sid'])) { ?>
            <div class="another-post_block prev-post">
              <div class="post-mini-img text-left"><a href="<?php echo BASE_URL.'story/'.$prev_story['url'];?>"><img src="<?php echo ASSETS_URL;?>media/stories/<?php echo $prev_story['thumb_image'] ?>?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></a></div>
              <div class="post-title">
                <p>Previous post</p><a href="<?php echo BASE_URL.'story/'.$prev_story['url'];?>"><?php echo $prev_story['title']; ?></a>
              </div>
            </div>
          <?php } ?>
        </div>
        
        
        <div class="col-12 col-md-6">
          <?php if(!empty($next_story['sid'])) { ?>
            <div class="another-post_block text-right next-post">
              <div class="post-title">
                <p>Next post</p><a href="<?php echo BASE_URL.'story/'.$next_story['url'];?>"><?php echo $next_story['title'] ?></a>
              </div>
              <div class="post-mini-img text-right"><a href="<?php echo BASE_URL.'story/'.$next_story['url'];?>"><img src="<?php echo ASSETS_URL;?>media/stories/<?php echo $next_story['thumb_image'] ?>?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="post image"></a></div>
            </div>
          <?php } ?>
        </div>
        
      </div>
    </div>
    </div>
    
  </div>

</div>
</section><!--End posts-->