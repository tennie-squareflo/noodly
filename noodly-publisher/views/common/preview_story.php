<section class="posts blog-creative">
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
    
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
  <div class="col-10 col-lg-10">
    <div class="post-block">
      <div class="blog-pragraph first-paragraph"> <?php echo $post['first_paragraph']; ?></div>

      <?php
        $next_id = $post['first_pid'];
        while ($next_id) {
          switch ($paragraphs[$next_id]['type']) {
            case 'text':
              echo "<div class='blog-pragraph'>".$paragraphs[$next_id]['content']."</div>";
            break;
            case 'image':
              echo '<div class="row">
                <div class="col-12 col-sm-12"><img class="img-fluid w-100" src="'.ASSETS_URL.'media/stories/'.$paragraphs[$next_id]['content'].'" alt="post image"></div>
              </div>';
            break;
            case 'video':
              echo '<div class="row">
                <div class="col-12 col-sm-12">
                <iframe class="w-100" width="600" height="400" src="'.$paragraphs[$next_id]['content'].'"></iframe>
                </div>
              </div>';
            break;
            case 'heading':
              echo '<h3 class="post-title">'.$paragraphs[$next_id]['content'].'</h3>';
            break;
          }
          $next_id = $paragraphs[$next_id]['next_pid'];
        }
      ?>
    </div>

    <div class="post-author-detail">
      <div class="row no-gutters align-items-center">
        <div class="col-sm-5 col-md-3">
          <div class="author-avatar">
          <?php
            if (empty($author['avatar'])
              || !file_exists($_SERVER['DOCUMENT_ROOT']."/assets/media/avatars/".$_SESSION['user']['avatar'])) {
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
            <p><?php echo $author['shortbio']; ?></p>
            <div class="author-social">
              <?php if(!empty($author['facebookurl'])) { ?>
              <a href="<?php echo $author['facebookurl']; ?>">
                <i class="fab fa-facebook-f"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['twitterurl'])) { ?>
              <a href="<?php echo $author['twitterurl']; ?>">
                <i class="fab fa-twitter"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['instagramurl'])) { ?>
              <a href="<?php echo $author['instagramurl']; ?>">
                <i class="fab fa-instagram"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['youtubeurl'])) { ?>
              <a href="<?php echo $author['youtubeurl']; ?>">
                <i class="fab fa-youtube"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['vimeourl'])) { ?>
              <a href="<?php echo $author['vimeourl']; ?>">
                <i class="fab fa-vimeo"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['soundcloudurl'])) { ?>
              <a href="<?php echo $author['soundcloudurl']; ?>">
                <i class="fab fa-soundcloud"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['websiteurl'])) { ?>
              <a href="<?php echo $author['websiteurl']; ?>">
                <i class="fa fa-globe"></i>
              </a>
              <?php } ?>
              <?php if(!empty($author['otherurl'])) { ?>
              <a href="<?php echo $author['otherurl']; ?>">
                <i class="fa fa-globe"></i>
              </a>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</div>
</section><!--End posts-->