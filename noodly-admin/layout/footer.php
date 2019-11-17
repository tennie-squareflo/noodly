
	</div><!-- end:: Page -->
	<!-- begin::Scrolltop -->
	<div class="k-scrolltop" id="k_scrolltop">
		<i class="la la-arrow-up"></i>
	</div><!-- end::Scrolltop -->
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
	</script> <!-- end::Global Config -->
	 <!--begin::Global Theme Bundle -->
	 
	<script src="<?php echo $assets_url; ?>vendors/base/vendors.bundle.js" type="text/javascript">
	</script> 
	<script src="<?php echo $assets_url; ?>demo/default/base/scripts.bundle.js" type="text/javascript">
	</script> <!--end::Global Theme Bundle -->
	 <!--begin::Page Vendors -->
	 
	<script src="<?php echo $assets_url; ?>vendors/custom/datatables/datatables.bundle.js" type="text/javascript">
	</script> <!--end::Page Vendors -->
	 <!--begin::Page Scripts -->
	 
	<script src="<?php echo $assets_url; ?>demo/default/custom/components/datatables/basic/basic.js" type="text/javascript">
	</script> <!--begin::Global App Bundle -->
	 
	<script src="<?php echo $assets_url; ?>app/scripts/bundle/app.bundle.js" type="text/javascript">
	</script> <!--end::Global App Bundle -->

<?php
	if (isset($script_files)) {
		foreach ($script_files as $file) {
			# code...
?>
			<script src="<?php echo $assets_url.$file; ?>" type="text/javascript">
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