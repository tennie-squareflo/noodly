  <!-- begin::Body -->
  <body
    class="k-page--loading-enabled k-page--loading k-sweetalert2--nopadding k-header--static k-header-mobile--fixed k-aside--enabled k-aside--skin-blue k-aside__brand--skin-blue k-aside--fixed"
  >
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
        <button
          class="k-header-mobile__toolbar-topbar-toggler"
          id="k_header_mobile_topbar_toggler"
        >
          <i class="flaticon-more-1"></i>
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
          <!-- begin:: Header -->
          <div
            class="k-header k-grid__item"
            data-kheader-minimize="on"
            id="k_header"
          >
            <!-- begin:: Content Head -->
            <div class="k-header__title"></div>
            <!-- end:: Content Head -->
            <!-- begin:: Header Topbar -->
            <div class="k-header__topbar">
              <!--begin: Quick actions -->
              <div class="k-header__topbar-item dropdown">
                <div
                  class="k-header__topbar-item-wrapper"
                  data-offset="30px -2px"
                  data-toggle="dropdown"
                >
                  <span class="k-header__topbar-icon">
                    <?php
                      if (!isset($_SESSION['user']['avatar'])
                        || !file_exists(ASSETS_URL."media/avatars/".$_SESSION['user']['avatar'])) {
                    ?>
                        <i class="fa fa-user-circle"></i>
                    <?php
                      } else {
                    ?>
                      <img src="<?php echo ASSETS_URL;?>media/avatars/<?php echo $_SESSION['user']['avatar'];?>" class="rounded-circle" width="24px"
                      />
                    <?php
                      }
                      ?>
                  </span>
                </div>
              </div>
            </div>
            <!-- end:: Header Topbar -->
          </div>
          <!-- end:: Header -->