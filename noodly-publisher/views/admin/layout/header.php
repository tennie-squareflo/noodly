  <!-- begin::Body -->
  <body
    class="k-page--loading-enabled k-page--loading k-sweetalert2--nopadding k-header--static k-header-mobile--fixed k-aside--enabled k-aside--skin-blue k-aside__brand--skin-blue k-aside--fixed"
  >
    <?php if (!empty($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') :?>
      <!-- Load Facebook SDK for JavaScript -->
      <div id="fb-root"></div>
          <script>
            window.fbAsyncInit = function() {
              FB.init({
                xfbml            : true,
                version          : 'v5.0'
              });
            };

            (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));</script>

          <!-- Your customer chat code -->
          <div class="fb-customerchat"
            attribution=setup_tool
            page_id="104881847722399"
      logged_in_greeting="Hi! Let me know if you need help, or have any questions. "
      logged_out_greeting="Hi! Let me know if you need help, or have any questions. ">
          </div>
        <?php endif; ?>
    <!-- begin::Page loader -->
    <!-- end::Page Loader -->
    <!-- begin:: Page -->
    <!-- begin:: Header Mobile -->
    <div class="k-header-mobile k-header-mobile--fixed" id="k_header_mobile">
      <div class="k-header-mobile__logo">
        <a href="#"
          ><img
            alt="Logo"
            src="<?php echo ASSETS_URL;?>/media/logos/<?php echo $publisher['adminlogo'];?>"
            width="100px"
        /></a>
      </div>
      <div class="k-header-mobile__toolbar">
        <button
          class="k-header-mobile__toolbar-toggler k-header-mobile__toolbar-toggler--left"
          id="k_aside_mobile_toggler"
        >
          <span></span>
        </button>
        
      </div>
    </div>
    <!-- end:: Header Mobile -->
    <div class="k-grid k-grid--hor k-grid--root">
      <div class="k-grid__item k-grid__item--fluid k-grid k-grid--ver k-page">
        <!-- begin:: Aside -->
        <button class="k-aside-close" id="k_aside_close_btn">
          <i class="la la-close"></i>
        </button>
        <div
          class="k-aside k-aside--skin-blue k-aside--fixed k-grid__item k-grid k-grid--desktop k-grid--hor-desktop"
          id="k_aside"
        >
          <!-- begin:: Aside -->
          <div
            class="k-aside__brand k-aside__brand--skin-blue k-grid__item"
            id="k_aside_brand"
          >
            <div class="k-aside__brand-logo">
              <a href="#"
                ><img
                  alt="Logo"
                  src="<?php echo ASSETS_URL;?>/media/logos/<?php echo $publisher['adminlogo'];?>"
                  width="130px"
              /></a>
            </div>
            <div class="k-aside__brand-tools">
              <button
                class="k-aside__brand-aside-toggler k-aside__brand-aside-toggler--left"
                id="k_aside_toggler"
              >
                <span></span>
              </button>
            </div>
          </div>
          <!-- end:: Aside -->
          <?php
            require_once('sidebar.php');
        ?>
        </div>
        <!-- end:: Aside -->
        <div
          class="k-grid__item k-grid__item--fluid k-grid k-grid--hor k-wrapper"
        >
