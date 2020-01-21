<?php
  $this->load_model('category');
  $this->load_model('publisher');
  $categories = $this->category_model->get_categories($publisher['pid'], 0);
?>
<body>
    <div id="main">
      <header>
        <div class="header-wrapper">
          <div class="container">
            <div class="header-menu">
              <div class="row no-gutters align-items-center justify-content-center">
                <div class="col-4 col-md-2"><a class="logo" href="<?php echo BASE_URL; ?>"><img src="<?php echo ASSETS_URL;?>media/logos/<?php echo $publisher['logo'];?>" alt="logo" width="170px"></a></div>
                <div class="col-8 col-md-8">
                  <div class="mobile-menu"><a href="#" id="showMenu"><i class="fas fa-bars"></i></a></div>
                  <nav class="navigation">
                    <ul>

                      <li class="nav-item"><a class="pisen-nav-link active" href="<?php echo BASE_URL; ?>">Latest</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="<?php echo BASE_URL; ?>popular">Popular</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="#">Sections</a><i class="submenu-opener fas fa-plus"></i>
                        <ul class="sub-menu">
                          <?php
                            
                            foreach ($categories as $key => $category) {
                          ?>
                            <li class="sub-menu_item"><a class="sub-menu-link" href="#"><?php echo $category['name']; ?></a></li>
                          <?php
                            }
                          ?>
                        </ul>
                      </li>
                      <li class="nav-item"><a class="pisen-nav-link" href="<?php echo BASE_URL.'contributors' ?>">Contributors</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="#"><i class="fa fa-ellipsis-h"></i></a><i class="submenu-opener fas fa-plus"></i>
                        <ul class="sub-menu">
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'contact' ?>">About Us</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'contact' ?>">Contact Us</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'contact' ?>">Post A Story</a></li>
                          <li class="sub-menu_item"><a class="sub-menu-link" href="<?php echo BASE_URL.'login' ?>">Log In</a></li>
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