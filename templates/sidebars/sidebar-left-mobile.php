<?php if(wp_is_mobile() ) : ?>
<aside class="col-xs-12 hidden-sm hidden-md hidden-lg sidebars sidebars-mobile" id="sidebar-left-mobile">
	<?php if(is_active_sidebar ('sidebar-left') ) : ?>
		<ul class="list-unstyled sidebar">
			<?php dynamic_sidebar('sidebar-left'); ?>
		</ul>
	<?php endif; ?>
</aside>
<?php endif; ?>