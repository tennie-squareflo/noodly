<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Noodly</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A corporate Bootstrap theme by Medium Rare">
    <link href="<?php echo ASSETS_URL; ?>custom/admin/homepage/css/loaders/loader-typing.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo ASSETS_URL; ?>custom/admin/homepage/css/theme-saas-trend.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="preload" as="font" href="<?php echo ASSETS_URL; ?>custom/admin/homepage/fonts/Inter-UI-upright.var.woff2" type="font/woff2" crossorigin="anonymous">
    <link rel="preload" as="font" href="<?php echo ASSETS_URL; ?>custom/admin/homepage/fonts/Inter-UI.var.woff2" type="font/woff2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/55a4c8757d.js" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="loader">
      <div class="loading-animation"></div>
    </div>

    <div class="navbar-container bg-primary">
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary" data-sticky="top">
        <div class="container">
          <a class="navbar-brand fade-page" href="index.html">
            <img src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/logo.png"  height="40px" alt="Leap">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <img class="icon navbar-toggler-open" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/interface/menu.svg" alt="menu interface icon" data-inject-svg />
            <img class="icon navbar-toggler-close" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/interface/cross.svg" alt="cross interface icon" data-inject-svg />
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <div class="py-2 py-lg-0">
              <ul class="navbar-nav">
                <li class="nav-item"><a href="<?php echo BASE_URL; ?>login" class="nav-link" aria-expanded="false" aria-haspopup="false">Sign In</a></li>
               
               
              </ul>
            </div><a onclick="gotoEarlyAccess()" class="btn btn-white ml-lg-3">Get Early Access</a>

          </div>
        </div>
      </nav>
    </div>

    <section class="bg-primary text-light o-hidden">
      <div class="container">
        <div class="row align-items-center min-vh-50">
          <div class="col-lg-12 text-center text-lg-left mb-4 mb-lg-0">
            <h1 class="display-3">Online publishing, perfected.</h1>
            <div class="my-4">
              <p class="lead">Noodly is the perfect, <strong>white-label</strong>, multi-contributor platform for digital publishers.
            </div>
            <!-- <a href="#" class="btn btn-lg btn-dark"><i class="fab fa-youtube"></i> &nbsp How It Works</a> -->
          </div>
          <div class="col-lg-12 text-center" data-aos="fade-left">
            <img src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/saas-sketch-1.svg" alt="Image" class="min-vw-60">
          </div>
        </div>
      </div>
    </section>
    <section id="get-early-access">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-8 col-xl-8">
            <div class="text-center mb-4">
              <h2 class="h1">Contact Us</h2>
              <p class="lead">Want early access to our platform? Please get in touch below.
              </p>
            </div>
            <form action="/forms/smtp.php" data-form-email novalidate>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Your Name *</label>
                    <input name="contact-name" type="text" class="form-control" required>
                    <div class="invalid-feedback">
                      Please type your name.
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Email Address *</label>
                    <input name="contact-email" type="email" placeholder="you@yoursite.com" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Company Name</label>
                    <input name="contact-company" type="text" class="form-control" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Contact Number *</label>
                    <input name="contact-phone" type="tel" class="form-control" required>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Message: *</label>
                    <textarea class="form-control" name="contact-message" rows="10" placeholder="How can we help?"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div data-recaptcha data-sitekey="<?php echo ENV === 'server' ? '6LepB9QUAAAAAKHnmsVOZZg2I1j3DlE8joPnlUWr' : '6LfYBtQUAAAAAJIMSkkTWhRQYshnjDtFJ0mfzWxJ'; ?>"></div>
                </div>
                <div class="col">
                  <div class="d-none alert alert-success" role="alert" data-success-message>
                    Thanks, a member of our team will be in touch shortly.
                  </div>
                  <div class="d-none alert alert-danger" role="alert" data-error-message>
                    Please fill all fields correctly.
                  </div>
                  <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Sending">
                    <img class="icon" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/theme/code/loading.svg" alt="loading icon" data-inject-svg />
                    <span>Send!</span>
                  </button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </section>
    <footer class="pb-5 bg-primary text-light">
      <div class="container">
       
        <div class="row mb-4">
          <div class="col">
            <ul class="nav justify-content-center">
              <li class="nav-item"><a href="<?php echo BASE_URL; ?>login" class="nav-link">Sign In</a>
              </li>
              <li class="nav-item"><a onclick="gotoEarlyAccess()" class="nav-link">Get Early Access</a>
              </li>
              
            </ul>
          </div>
        </div>
        <!-- <div class="row justify-content-center mt-5 mb-5">
          <div class="col-auto">
            <ul class="nav">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/social/instagram.svg" alt="instagram social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/social/twitter.svg" alt="twitter social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/social/youtube.svg" alt="youtube social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/social/medium.svg" alt="medium social icon" data-inject-svg />
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <img class="icon undefined" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/social/facebook.svg" alt="facebook social icon" data-inject-svg />
                </a>
              </li>
            </ul>
          </div>
        </div> -->
        <div class="row justify-content-center text-center">
          <div class="col-xl-10">
            <small class="text-muted">&copy;2020 All Rights Reserved. Noodly.io</small>
          </div>
        </div>
      </div>
    </footer>

    <a href="#" class="btn back-to-top btn-primary btn-round" data-smooth-scroll data-aos="fade-up" data-aos-offset="2000" data-aos-mirror="true" data-aos-once="false">
      <img class="icon" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/img/icons/theme/navigation/arrow-up.svg" alt="arrow-up icon" data-inject-svg />
    </a>
    <!-- Required vendor scripts (Do not remove) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/popper.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/bootstrap.js"></script>

    <!-- Optional Vendor Scripts (Remove the plugin script here and comment initializer script out of index.js if site does not use that feature) -->

    <!-- AOS (Animate On Scroll - animates elements into view while scrolling down) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/aos.js"></script>
    <!-- Clipboard (copies content from browser into OS clipboard) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/clipboard.js"></script>
    <!-- Fancybox (handles image and video lightbox and galleries) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jquery.fancybox.min.js"></script>
    <!-- Flatpickr (calendar/date/time picker UI) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/flatpickr.min.js"></script>
    <!-- Flickity (handles touch enabled carousels and sliders) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/flickity.pkgd.min.js"></script>
    <!-- Ion rangeSlider (flexible and pretty range slider elements) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/ion.rangeSlider.min.js"></script>
    <!-- Isotope (masonry layouts and filtering) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/isotope.pkgd.min.js"></script>
    <!-- jarallax (parallax effect and video backgrounds) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jarallax.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jarallax-video.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jarallax-element.min.js"></script>
    <!-- jQuery Countdown (displays countdown text to a specified date) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jquery.countdown.min.js"></script>
    <!-- jQuery smartWizard facilitates steppable wizard content -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/jquery.smartWizard.min.js"></script>
    <!-- Plyr (unified player for Video, Audio, Vimeo and Youtube) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/plyr.polyfilled.min.js"></script>
    <!-- Prism (displays formatted code boxes) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/prism.js"></script>
    <!-- ScrollMonitor (manages events for elements scrolling in and out of view) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/scrollMonitor.js"></script>
    <!-- Smooth scroll (animation to links in-page)-->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/smooth-scroll.polyfills.min.js"></script>
    <!-- SVGInjector (replaces img tags with SVG code to allow easy inclusion of SVGs with the benefit of inheriting colors and styles)-->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/svg-injector.umd.production.js"></script>
    <!-- TwitterFetcher (displays a feed of tweets from a specified account)-->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/twitterFetcher_min.js"></script>
    <!-- Typed text (animated typing effect)-->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/typed.min.js"></script>
    <!-- Required theme scripts (Do not remove) -->
    <script type="text/javascript" src="<?php echo ASSETS_URL; ?>custom/admin/homepage/js/theme.js"></script>
    <!-- Removes page load animation when window is finished loading -->
    <script type="text/javascript">
      window.addEventListener("load", function () {    document.querySelector('body').classList.add('loaded');  });

      function gotoEarlyAccess() {
        $("html, body").animate({ scrollTop: $('#get-early-access').offset().top - 80 }, "slow");
      }
    </script>

  </body>

</html>
