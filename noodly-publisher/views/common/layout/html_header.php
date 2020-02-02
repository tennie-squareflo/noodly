<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $publisher['name'] ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <!-- Meta data -->
    <?php
      if (!empty($post)) :
    ?>
    <meta name="title" content="<?php echo $post['title'].' - '.$publisher['name'];?>">
    <meta name="description" content="<?php echo $post['summary'];?>">
    <meta name="date" content="<?php echo $post['created_at'];?>">
    <meta name="keywords" content="<?php echo str_replace('#', '', $post['hashtags']); ?>">
    <meta name="image" content="<?php echo BASE_URL.ASSETS_URL.'media/stories/'.$post['cover_image'];?>">
    <?php
      endif;
    ?>
    

    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/style.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/slick.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/custom_bootstrap.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/fontawesome.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/elegant.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/plyr.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/aos.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/animate.css">
    <link rel="stylesheet" href="<?php echo ASSETS_URL; ?>vendors/publisher/css/themify-icons.css">
    <link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>vendors/publisher/images/shortcut_logo.png">

    <?php
		if (isset($style_files)) {
			foreach ($style_files as $file) {
				# code...
    ?>
      <link
        href="<?php echo ASSETS_URL.$file; ?>"
        rel="stylesheet"
        type="text/css"
      />
    <?php
        }
      }
    ?>

    <link href="<?php echo ASSETS_URL;?>media/logos/<?php echo $_env['favicon']; ?>" rel="shortcut icon">
  </head>