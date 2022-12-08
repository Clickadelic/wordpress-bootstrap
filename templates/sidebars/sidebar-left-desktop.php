<?php if(!wp_is_mobile() ) : ?>
<aside class="hidden-xs col-sm-12 col-md-3 col-lg-3 sidebars sidebars-desktop" id="sidebar-left-desktop">
	<?php if(is_active_sidebar ('sidebar-left') ) : ?>
		<ul class="list-unstyled sidebar">
			<?php do_action('bs5_before_left_desktop_sidebar_widets_render'); ?>
			<?php dynamic_sidebar('sidebar-left'); ?>
			<?php do_action('bs5_after_left_desktop_sidebar_widets_render'); ?>
		</ul>
	<?php endif; ?>
</aside>
<?php endif; ?>