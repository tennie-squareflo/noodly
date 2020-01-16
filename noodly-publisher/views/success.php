<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" >
		<title>Welcome | Noodly.io</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
			
		<!-- Google Fonts -->
				<link href="https://fonts.googleapis.com/css?family=DM+Sans:100,200,300,400,600,500,700,800,900|DM+Sans:100,200,300,400,500,600,700,800,900&amp;subset=latin" rel="stylesheet">
				<!-- Bootstrap 4.3.1 CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<!-- Slick 1.8.1 jQuery plugin CSS (Sliders) -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
		<!-- Fancybox 3 jQuery plugin CSS (Open images and video in popup) -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
		<!-- AOS 2.3.4 jQuery plugin CSS (Animations) -->
		<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
		<!-- FontAwesome CSS -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<!-- Startup 3 CSS (Styles for all blocks) -->

					<link href="<?php echo ASSETS_URL; ?>custom/publisher/success/style_success.css" rel="stylesheet" />
				<!-- jQuery 3.3.1 -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
			</head> 
	<body>

<!-- Header 1 -->

<header class="pt-195 pb-110 bg-light header_1">

<!-- Header Menu 1 -->

	

	<div class="container">
		<h1 class="big text-center" data-aos-duration="600" data-aos="fade-down" data-aos-delay="0">High Five!</h1>
		<div class="mw-600 mx-auto mt-30 f-22 color-heading text-center text-adaptive" data-aos-duration="600" data-aos="fade-down" data-aos-delay="300">
			You have successfully created a <?php echo $publisher['name']; ?> profile. You can now sign in as a contributor.		</div>
		
		<div class="mt-80 text-center buttons" data-aos-duration="600" data-aos="fade-down" data-aos-delay="600">
			<div><a class="btn lg action-1" href="<?php echo BASE_URL.'login';?>">Sign In</a></div>
		
		</div>
	</div>
</header>
<!-- forms alerts -->
<div class="alert alert-success alert-dismissible fixed-top alert-form-success" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	Thanks for your message!
</div>
<div class="alert alert-warning alert-dismissible fixed-top alert-form-check-fields" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	Please, fill in required fields.
</div>
<div class="alert alert-danger alert-dismissible fixed-top alert-form-error" role="alert">
	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	An error occurred while sending data :(
</div>

<!-- Bootstrap 4.3.1 JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!-- Fancybox 3 jQuery plugin JS (Open images and video in popup) -->
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<!-- Google maps JS API -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyDP6Ex5S03nvKZJZSvGXsEAi3X_tFkua4U"></script>
<!-- Slick 1.8.1 jQuery plugin JS (Sliders) -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- AOS 2.3.4 jQuery plugin JS (Animations) -->
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<!-- Maskedinput jQuery plugin JS (Masks for input fields) -->
<script src="<?php echo ASSETS_URL;?>custom/publisher/success/jquery.maskedinput.min.js"></script>
<!-- Startup 3 JS (Custom js for all blocks) -->
<script src="<?php echo ASSETS_URL;?>custom/publisher/success/script.js"></script>
</body>
</html>
