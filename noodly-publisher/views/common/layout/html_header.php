<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Index</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="keywords" content="blog, business, clean, clear, cooporate, creative, design web, flat, marketing, minimal, portfolio, shop, shopping, unique">
    <meta name="author" content="PISEN | Deer Creative Theme">
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
  </head>