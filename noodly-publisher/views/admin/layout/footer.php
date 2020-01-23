
	</div><!-- end:: Page -->
	<!-- begin::Scrolltop -->
	<div class="k-scrolltop" id="k_scrolltop">
		<i class="la la-arrow-up"></i>
	</div><!-- end::Scrolltop -->
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
      	}(document, 'script', 'facebook-jssdk'));
	</script>

      <!-- Your customer chat code -->
	<div class="fb-customerchat" 
		attribution=setup_tool 
		page_id="104881847722399" 
		logged_in_greeting="Hi! Let me know if you need help, or have any questions."
  		logged_out_greeting="Hi! Let me know if you need help, or have any questions.">
	</div>
	<!-- begin::Global Config -->
	<script>
	           var KAppOptions = {
	               "colors": {
	                   "brand": "#5c4de5",
	                   "metal": "#c4c5d6",
	                   "light": "#ffffff",
	                   "accent": "#00c5dc",
	                   "primary": "#5867dd",
	                   "success": "#34bfa3",
	                   "info": "#36a3f7",
	                   "warning": "#ffb822",
	                   "danger": "#fd3995",
	                   "focus": "#9816f4"
	               }
	           };
		const BASE_URL = "<?php echo BASE_URL; ?>";
		const ASSETS_URL = "<?php echo ASSETS_URL; ?>";
	</script> <!-- end::Global Config -->
	 <!--begin::Global Theme Bundle -->

	<script src="<?php echo ASSETS_URL; ?>vendors/base/vendors.bundle.js" type="text/javascript">
	</script> 
	<script src="<?php echo ASSETS_URL; ?>vendors/base/scripts.bundle.js" type="text/javascript">
	</script> <!--end::Global Theme Bundle -->
	 <!--begin::Page Vendors -->
	 
	<script src="<?php echo ASSETS_URL; ?>vendors/custom/datatables/datatables.bundle.js" type="text/javascript">
	</script> <!--end::Page Vendors -->
	 <!--begin::Page Scripts -->
	 
	<script src="<?php echo ASSETS_URL; ?>vendors/custom/components/datatables/basic/basic.js" type="text/javascript">
	</script> <!--begin::Global App Bundle -->
	 
	<script src="<?php echo ASSETS_URL; ?>app/scripts/bundle/app.bundle.js" type="text/javascript">
	</script> <!--end::Global App Bundle -->

	<script src="<?php echo ASSETS_URL; ?>vendors/custom/components/extended/toastr.js" type="text/javascript">
	</script> <!--end::Toastr Plugin -->

	<script src="<?php echo ASSETS_URL; ?>vendors/custom/jquery-debounce/jquery.debounce.js" type="text/javascript">
	</script> <!--end::Debounce Plugin -->

	<script src="<?php echo ASSETS_URL; ?>vendors/custom/jquery-ui/jquery-ui.bundle.js" type="text/javascript">
	</script> <!--end::jQuery UI Plugin -->

	<script src="<?php echo ASSETS_URL; ?>custom/admin/common.js" type="text/javascript">
	</script> <!--end::Common Plugin -->

	<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<?php
	if (isset($script_files) && is_array($script_files)) {
		foreach ($script_files as $file) {
			# code...
?>
			<script src="<?php echo ASSETS_URL.$file; ?>" type="text/javascript">
			</script>
<?php
		}
	}
?>

	<script>
	           var KThemeMode = 'released';
	</script><!-- end::Body -->
</body>
</html>