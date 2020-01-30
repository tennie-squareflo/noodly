
<section class="blog-detail">
        <div class="container">
          <div class="contact">
            <div class="leave-message text-center">
              <h1>Contributors</h1>
            </div>
          </div>
          <div class="row justify-content-center">
            
          <?php
            foreach ($contributors as $key => $contributor) {
          ?>
            <div class="col-12 col-lg-12">


              <div class="post-author-detail">
                <div class="row no-gutters align-items-center">
                  <div class="col-sm-5 col-md-3">
                    <div class="author-avatar">
                      <?php
                        if (empty($contributor['avatar'])
                          || !file_exists(ASSETS_PATH."media/avatars/".$contributor['avatar'])) {
                      ?>
                          <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?auto=compress&cs=tinysrgb&dpr=2&w=500"
                        />
                      <?php
                        } else {
                      ?>
                        <img src="<?php echo ASSETS_URL;?>media/avatars/<?php echo $contributor['avatar'];?>?auto=compress&cs=tinysrgb&dpr=2&w=500"
                        />
                      <?php
                        }
                      ?>
                      <!-- <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?auto=compress&cs=tinysrgb&dpr=2&w=500" alt="avatar"> -->
                    </div>
                  </div>
                  <div class="col-sm-7 col-md-9">
                    <div class="author-info">
                      <h5><?php echo $contributor['username']; ?></h5>
                      <p><?php echo $contributor['shortbio']; ?></p>
                      <button class="normal-btn">Send message</button><br /><br />
                      <div class="author-social">
                        <?php if(!empty($contributor['facebookurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['facebookurl']; ?>">
                            <i class="fab fa-facebook-f"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['twitterurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['twitterurl']; ?>">
                            <i class="fab fa-twitter"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['instagramurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['instagramurl']; ?>">
                            <i class="fab fa-instagram"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['youtubeurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['youtubeurl']; ?>">
                            <i class="fab fa-youtube"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['vimeourl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['vimeourl']; ?>">
                            <i class="fab fa-vimeo"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['soundcloudurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['soundcloudurl']; ?>">
                            <i class="fab fa-soundcloud"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['websiteurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['websiteurl']; ?>">
                            <i class="fa fa-globe"></i>
                          </a>
                          <?php } ?>
                          <?php if(!empty($contributor['otherurl'])) { ?>
                          <a target="_blank" href="<?php echo $contributor['otherurl']; ?>">
                            <i class="fa fa-globe"></i>
                          </a>
                          <?php } ?>
                        </div>
                        
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php
            }
          ?>
          

            
          </div>
        </div>
      </section><!--End posts-->