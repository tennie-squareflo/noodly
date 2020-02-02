<footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 d-xs-none d-sm-none">
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
                <div class="col-sm-6 col-md-3 col-lg-4 d-sm-none">
                  <div class="footer-links">
                    <h5 class="footer-link--title">Contributors</h5>
                    <ul>
                      
                      <li><a class="footer-link" href="<?php if(!isset($_SESSION['user'])) echo BASE_URL.'contact'; else echo BASE_URL.'story'; ?>">Post A Story</a></li>
                      <li><a class="footer-link" href="<?php echo BASE_URL.'index/signup' ?>">My Account</a></li>
                      <li><a class="footer-link" href="<?php echo BASE_URL.'login' ?>"><?php if(!isset($_SESSION['user'])) echo 'Sign In'; else echo 'Sign Out'; ?></a></li>
                    </ul>
                  </div>
                </div>
                <?php
                  
                ?>
                <div class="col-sm-12 col-md-6 col-lg-4 d-sm-none">
                  <div class="footer-contact">
                    <h5 class="footer-link--title">Contact us</h5>
                    <div class="contact-method">
                      <p><?php echo $publisher['name']; ?></p>
                      <p><?php echo $publisher['address1'].'<br/>'.$publisher['city'].', '.$publisher['zipcode']; ?></p>
                      <p><?php echo $publisher['phonenumber']; ?></p>
                      <p><?php echo '<a href="'.BASE_URL.'contact">Email Us</a>'; ?></p>
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
              <form id="subscribe-pub-form" method="post">
                <input type="hidden" name="id" value="<?php echo $publisher['pid']; ?>" />
                <input type="hidden" name="type" value="publisher" />
                <div class="email-form">
                  <input class="input-form" name="firstname" type="text" placeholder="Enter Your First Name">
                </div>
                <div class="email-form">
                  <input class="input-form" name="email" type="email" placeholder="Enter Your Email Address">
                  <button><i class="fas fa-paper-plane"></i></button>
                </div>
              </form>
              <p class="copyright">Copyright ©2019 <?php echo $publisher['name'] ?></p>
            </div>
          </div>
        </div>
      </footer><!--End footer-->

      <div class="modal" tabindex="-1" role="dialog" id="subscribe-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Subscribe</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="k-form" id="subscribe-modal-form"  method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="" />
                <input type="hidden" name="type" value="" />
                <div class="row">
                  <div class="col-xl-1"></div>
                  <div class="col-xl-10">
                    <div class="k-section k-section--first">
                      <div class="k-section__body">

                        <div class="form-group row hidden-client-exists">
                          <input type="text" name="firstname" class="form-control" placeholder="Enter Your First Name">
                        </div>

                        <div class="form-group row hidden-client-exists">
                          <input type="text" name="email" class="form-control" placeholder="Enter Your Email Address">
                        </div>

                    </div>
                    
                  </div>
                  <div class="col-xl-1"></div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="normal-btn" id="subscribe-btn">Subscribe</button>
            </div>
          </div>
        </div>
      </div>

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
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/numscroller-1.0.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/jquery.countdown.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/custom/components/extended/toastr.js" type="text/javascript">
	    </script> <!--end::Toastr Plugin -->
      
      <script src="<?php echo ASSETS_URL; ?>vendors/custom/jquery-debounce/jquery.debounce.js" type="text/javascript">
	  </script> <!--end::Debounce Plugin -->
    <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/main.js"></script>

      <script src="<?php echo ASSETS_URL; ?>vendors/base/vendors.bundle.js" type="text/javascript">
	</script> 
  

      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/masonry.pkgd.min.js"></script>
      <script src="<?php echo ASSETS_URL; ?>vendors/publisher/js/imagesloaded.pkgd.min.js"></script>

      
      <script src="<?php echo ASSETS_URL; ?>custom/publisher/subscription.js"></script>
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
	<script type="text/javascript">
		function onImageLoadError() {
			this.src = ASSETS_URL + 'media/default/no-image-found.png';
		}
	</script>
    </div>
  </body>
</html>