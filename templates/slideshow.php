<?php do_action('before_slideshow_render'); ?>
<div class="wrap-slideshow">
	<div class="container">
		<div class="row">
			<div class="col">
				<!-- Your shortcode here -->
				<?php echo do_shortcode('[smartslider3 slider="1"]'); ?>
			</div>
		</div>
	</div>
</div>
<?php do_action('after_slideshow_render'); ?>