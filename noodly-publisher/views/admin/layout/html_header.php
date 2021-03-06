<!DOCTYPE html>
<!-- 
Theme: Keen - The Ultimate Bootstrap Admin Theme
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: You must have a valid license purchased only from https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/ in order to legally use the theme for your project.
-->
<html lang="en">
<!-- begin::Head -->
<head>
	<meta charset="utf-8">
	<title><?php echo $publisher['name'] ?> Admin</title>
	<meta content="Noodly admin" name="description">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="IE=edge" http-equiv="X-UA-Compatible"><!--begin::Web font -->

	<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
	<!-- Main Quill library -->

	<!-- Theme included stylesheets -->
	<!-- Core build with no theme, formatting, non-essential modules -->
	<script>
	           WebFont.load({
	               google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
	               active: function() {
	                   sessionStorage.fonts = true;
	               }
	           });
	</script><!--end::Web font -->
	<!--begin::Global Theme Styles -->
	<link href="<?php echo ASSETS_URL;?>vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"><!--RTL version:<link href="<?php echo ASSETS_URL;?>vendors/base/vendors.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
	<link href="<?php echo ASSETS_URL;?>vendors/base/style.bundle.css" rel="stylesheet" type="text/css"><!--RTL version:<link href="<?php echo ASSETS_URL;?>vendors/base/style.bundle.rtl.css" rel="stylesheet" type="text/css" />-->
	<!--end::Global Theme Styles -->

	<!--begin::Component Theme Styles -->
	<!--end::Component Theme Styles -->
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
</head><!-- end::Head -->
<!-- begin::Body -->