<body>
    <div id="main">
      <header>
        <div class="header-wrapper">
          <div class="container">
            <div class="header-menu">
              <div class="row no-gutters align-items-center justify-content-center">
                <div class="d-xl-none d-xxl-none d-xxxl-none col-4 col-sm-4 col-xs-2 col-md-4">
                    <div id="search"><a class="search-btn" href="#"><i class="fas fa-search"></i></a></div>
                </div>
                <div class="col-0 col-xs-8 col-sm-4 col-md-4 d-xl-none d-xxl-none d-xxxl-none text-center"><a class="logo" href="<?php echo BASE_URL; ?>"><img src="<?php echo ASSETS_URL;?>media/logos/<?php echo (empty($_env['light_back_logo']) ? 'logo-on-light-background.png' : $_env['light_back_logo']);?>" alt="logo" height="<?php echo $_env['website_logo_size']; ?>"></a></div>
                <div class="d-sm-none d-xs-none d-md-none d-lg-none col-4 col-md-2 col-xs-8"><a class="logo" href="<?php echo BASE_URL; ?>"><img src="<?php echo ASSETS_URL;?>media/logos/<?php echo (empty($_env['light_back_logo']) ? 'logo-on-light-background.png' : $_env['light_back_logo']);?>" alt="logo" height="<?php echo $_env['website_logo_size']; ?>"></a></div>
                <div class="col-8 col-xl-8 col-lg-4 col-md-4 col-sm-4 col-xs-2">
                  <div class="mobile-menu"><a href="#" id="showMenu"><i class="fas fa-bars"></i></a></div>
                  <nav class="navigation">
                    <ul>
                      <li class="nav-item"><a class="pisen-nav-link latest_menu <?php echo $current_page === 'latest' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>">Latest</a></li>
                      <li class="nav-item"><a class="pisen-nav-link popular_menu <?php echo $current_page === 'popular' ? 'active' : ''; ?>" href="<?php echo BASE_URL; ?>popular">Popular</a></li>
                      <li class="nav-item"><a class="pisen-nav-link channel_menu submenu-opener <?php echo $current_page === 'channels' ? 'active' : ''; ?>" href="#">Channels</a>
                        <ul class="sub-menu">
                          <?php
                            foreach ($trendings as $key => $trending) {
                          ?>
                            <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'channel/'.$trending['slug']; ?>"><?php echo $trending['name']; ?></a></li>
                          <?php
                            }
                          ?>
                            <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'channel/all' ?>">All</a></li>
                        </ul>
                      </li>
                      <!-- <li class="nav-item"><a class="pisen-nav-link <?php echo $current_page === 'contributors' ? 'active' : ''; ?>" href="<?php echo BASE_URL.'contributors' ?>">Contributors</a></li> -->
                      <li class="nav-item"><a class="pisen-nav-link submenu-opener" href="#"><i class="fa fa-ellipsis-h"></i></a>
                        <ul class="sub-menu">
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'aboutus' ?>">About Us</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'contact' ?>">Contact Us</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php if(!isset($_SESSION['user'])) echo BASE_URL.'contact'; else echo BASE_URL.'story'; ?>">Post A Story</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'login' ?>"><?php if(!isset($_SESSION['user'])) echo 'Sign In'; else echo 'Sign Out'; ?></a></li>
                        </ul>
                      </li>
                      
                    </ul>
                  </nav>
                </div>
                <div class="col-0 col-xl-2">
                  <div class="menu-function">
                    <div id="search"><a class="search-btn" href="#"><i class="fas fa-search"></i></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </header><!--End header-->