<body>
    <div id="main">
      <header>
        <div class="header-wrapper">
          <div class="container">
            <div class="header-menu">
              <div class="row no-gutters align-items-center justify-content-center">
                <div class="col-4 col-md-2"><a class="logo" href="index.html"><img src="<?php echo ASSETS_URL;?>media/logos/<?php echo $publisher['logo'];?>" alt="logo" width="170px"></a></div>
                <div class="col-8 col-md-8">
                  <div class="mobile-menu"><a href="#" id="showMenu"><i class="fas fa-bars"></i></a></div>
                  <nav class="navigation">
                    <ul>

                      <li class="nav-item"><a class="pisen-nav-link active" href="index.html">Latest</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="popular.html">Popular</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="#">Sections</a><i class="submenu-opener fas fa-plus"></i>
                        <ul class="sub-menu">
                          <?php
                            $this->load_model('category');
                            $categories = $this->category_model->get_categories($publisher['pid'], 0);
                            foreach ($categories as $key => $category) {
                          ?>
                            <li class="sub-menu_item"><a class="sub-menu-link" href="#"><?php echo $category['name']; ?></a></li>
                          <?php
                            }
                          ?>
                        </ul>
                      </li>
                      <li class="nav-item"><a class="pisen-nav-link" href="contributors.html">Contributors</a></li>
                      <li class="nav-item"><a class="pisen-nav-link" href="contact-us.html">Contact Us</a><i class="submenu-opener fas fa-plus"></i>
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