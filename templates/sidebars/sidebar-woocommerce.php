<aside class="col-xs-12 col-sm-12 col-md-3 col-lg-3 sidebars" id="sidebar-woocommerce">
	<?php if(is_active_sidebar('sidebar-woocommerce')) : ?>
	<ul class="list-unstyled sidebar">
		<?php do_action('tbt_theme_before_woocommerce_widets_render'); ?>
		<?php dynamic_sidebar('sidebar-woocommerce'); ?>
		<?php do_action('tbt_theme_after_woocommerce_widets_render'); ?>
	</ul>
	<?php endif; ?>
</aside>