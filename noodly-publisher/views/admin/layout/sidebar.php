<!-- begin:: Aside Menu -->
<div class="k-aside-menu-wrapper k-grid__item k-grid__item--fluid" id="k_aside_menu_wrapper">
  <div class="k-aside-menu k-aside-menu--skin-light" data-kmenu-dropdown-timeout="500" data-kmenu-scroll="1" data-kmenu-vertical="1" id="k_aside_menu" style="position: relative;">
    <ul class="k-menu__nav">
    <?php
      if (isset($_SESSION['user']['user_status']) && $_SESSION['user']['user_status'] === true):
    ?>
      <?php
        if ($_SESSION['user']['role'] === 'admin') : // if admin
      ?>
          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>dashboard"><i class="k-menu__link-icon fas fa-tachometer-alt"></i><span class="k-menu__link-text">Dashboard</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>story"><i class="k-menu__link-icon fa fa-newspaper"></i><span class="k-menu__link-text">Stories</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>contributor"><i class="k-menu__link-icon fa fa-users"></i><span class="k-menu__link-text">Contributors</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>channels"><i class="k-menu__link-icon fa fa-list"></i><span class="k-menu__link-text">Channels</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>admin"><i class="k-menu__link-icon fa fa-user-astronaut"></i><span class="k-menu__link-text">Admins</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>messages"><i class="k-menu__link-icon fa fa-envelope"></i><span class="k-menu__link-text">Messages</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>settings"><i class="k-menu__link-icon fa fa-cogs"></i><span class="k-menu__link-text">Settings</span></a>
          </li>
      <?php
        else:   // if contributor
      ?>
          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>dashboard"><i class="k-menu__link-icon fas fa-tachometer-alt"></i><span class="k-menu__link-text">Dashboard</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>story"><i class="k-menu__link-icon fa fa-newspaper"></i><span class="k-menu__link-text">Stories</span></a>
          </li>

          <li aria-haspopup="true" class="k-menu__item">
            <a class="k-menu__link" href="<?php echo BASE_URL; ?>message"><i class="k-menu__link-icon fa fa-envelope"></i><span class="k-menu__link-text">Messages</span></a>
          </li>
      <?php
        endif;
      ?>
    <?php 
      endif;
    ?>
      <li aria-haspopup="true" class="k-menu__item">
        <a class="k-menu__link" href="<?php echo BASE_URL; ?>my-account"><i class="k-menu__link-icon fa fa-user"></i><span class="k-menu__link-text">My Account</span></a>
      </li>

      <li aria-haspopup="true" class="k-menu__item">
        <a class="k-menu__link" href="<?php echo BASE_URL; ?>login"><i class="k-menu__link-icon fa fa-lock"></i><span class="k-menu__link-text">Log Out</span></a>
      </li>
    </ul>
  </div>
</div><!-- end:: Aside Menu -->