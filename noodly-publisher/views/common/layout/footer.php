<footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-4">
                  <div class="footer-links">
                    <h5 class="footer-link--title">Quick Link</h5>
                    <ul>
                        <li><a class="footer-link" href="<?php echo BASE_URL; ?>">The Latest</a></li>
                        <li><a class="footer-link" href="<?php echo BASE_URL; ?>popular">Popular</a></li>
                        <li><a class="footer-link" href="<?php echo BASE_URL.'channels' ?>">Channels</a></li>
                        <li><a class="footer-link" href="<?php echo BASE_URL.'contact' ?>">Contact Us</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-4">
                  <div class="footer-links">
                    <h5 class="footer-link--title">Contributors</h5>
                    <ul>
                      
                      <li><a class="footer-link" href="">Post A Story</a></li>
                      <li><a class="footer-link" href="<?php echo BASE_URL.'index/signup' ?>">My Account</a></li>
                      <li><a class="footer-link" href="<?php echo BASE_URL.'login' ?>"><?php if(!isset($_SESSION['user'])) echo 'Sign In'; else echo 'Sign Out'; ?></a></li>
                    </ul>
                  </div>
                </div>
                <?php
                  
                ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                  <div class="footer-contact">
                    <h5 class="footer-link--title">Contact us</h5>
                    <div class="contact-method">
                      <p><?php echo $publisher['name']; ?></p>
                      <p><?php echo $publisher['address1'].'<br/>'.$publisher['city'].', '.$publisher['zipcode']; ?></p>
                      <p><?php echo '<a href="'.BASE_URL.'index/contact">Email Us</a>'; ?></p>
                    </div>
                    <div class="social-contact">
                      <?php if (!empty($publisher['facebookurl'])): ?>
                      <a target="_blank" class="icon-btn" href="<?php echo $publisher['facebookurl']; ?>">
                        <i class="fab fa-facebook-f"></i>
                        </a>
                      <?php endif; ?>
                      <?php if (!empty($publisher['instagramurl'])): ?>
                      <a target="_blank" class="icon-btn" href="<?php echo $publisher['instagramurl']; ?>">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <?php endif; ?>
                      <?php if (!empty($publisher['twitterurl'])): ?>
                      <a target="_blank" class="icon-btn" href="<?php echo $publisher['twitterurl']; ?>">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <h5 class="footer-link--title">Subscribe To Our Mailing List </h5>
              <form action="" method="post">
                <div class="email-form">
                  <input class="input-form" type="text" placeholder="Enter Your First Name">
                </div>
                <div class="email-form">
                  <input class="input-form" type="text" placeholder="Enter Your Email Address">
                  <button> <i class="fas fa-paper-plane"></i></button>
                </div>
              </form>
              <p class="copyright">Copyright ©2019 <?php echo $publisher['name'] ?></p>
            </div>
          </div>
        </div>
      </footer><!--End footer-->
      <script>
      const BASE_URL = "<?php echo BASE_URL; ?>";
      const ASSETS_URL = "<?php echo ASSETS_URL; ?>";
      </script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/jquery-3.4.0.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/jquery-ui.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/slick.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/plyr.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/aos.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/jquery.scrollUp.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/masonry.pkgd.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/imagesloaded.pkgd.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/numscroller-1.0.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/jquery.countdown.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/main.js"></script>

      <?php
	if (isset($script_files) && is_array($script_files)) {
		foreach ($script_files as $file) {
			# code...
?>
			<script src="<?php echo ASSETS_URL.$file; ?>" type="text/javascript">
			</script>
<?php
		}
	}
?>
    </div>
  </body>
</html>