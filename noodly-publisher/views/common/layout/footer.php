<footer>
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="row">
                <div class="col-sm-6 col-md-3 col-lg-4">
                  <div class="footer-links">
                    <h5 class="footer-link--title">Quick Link</h5>
                    <ul>
                        <li><a class="footer-link" href="">The Latest</a></li>
                        <li><a class="footer-link" href="">Popular</a></li>
                        <li><a class="footer-link" href="">About Us</a></li>
                        <li><a class="footer-link" href="">Contact Us</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-sm-6 col-md-3 col-lg-4">
                  <div class="footer-links">
                    <h5 class="footer-link--title">Contributors</h5>
                    <ul>
                      
                      <li><a class="footer-link" href="">Post A Story</a></li>
                      <li><a class="footer-link" href="about_us.html">Sign Up</a></li>
                      <li><a class="footer-link" href="contact.html">Sign In</a></li>
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
                      <p><?php echo $publisher['address1']; ?></p>
                      <p><?php echo $publisher['email']; ?></p>
                    </div>
                    <div class="social-contact">
                      <a class="icon-btn" href="https://www.facebook.com/">
                        <i class="fab fa-facebook-f"></i>
                        </a>
                      <a class="icon-btn" href="https://www.instagram.com/">
                        <i class="fab fa-instagram"></i>
                      </a>
                      <a class="icon-btn" href="https://twitter.com/">
                        <i class="fab fa-twitter"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <h5 class="footer-link--title">Subscribe To Our Mailing List </h5>
              <form action="" method="post">
                <div class="email-form">
                  <input class="input-form" type="text" placeholder="Enter Your Mail">
                  <button> <i class="fas fa-paper-plane"></i></button>
                </div>
              </form>
              <p class="copyright">Copyright ©2019 <?php echo $publisher['name'] ?></p>
            </div>
          </div>
        </div>
      </footer><!--End footer-->
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
    </div>
  </body>
</html>