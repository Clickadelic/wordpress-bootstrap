<?php do_action('before_credits_render'); ?>
<footer class="wrap-credits">
	<div class="container-md">
		<div class="row">
			<div class="col text-center">
				<a href="#top" class="back-to-top" id="btn-back-to-top" title="<?php _e('back to top', 'bootstrap'); ?>" data-toggle="tooltip" data-placement="top">
					<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="white" class="bi bi-chevron-double-up" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M7.646 2.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 3.707 2.354 9.354a.5.5 0 1 1-.708-.708l6-6z"/><path fill-rule="evenodd" d="M7.646 6.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 7.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/></svg>
				</a>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<nav class="navbar navbar-credits navbar-expand-md">
				<?php
					wp_nav_menu([
						'menu'            => 'credits-menu',
						'theme_location'  => 'credits-menu',
						'container'       => true,
						'container_id'    => 'menu-wrap-credits-menu',
						'container_class' => 'col',
						'menu_id'         => 'credits-menu',
						'menu_class'      => 'navbar-nav m-auto',
						'depth'           => 2,
						'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
						'walker'          => new WP_Bootstrap_Navwalker()
					]);
				?>
				</nav>
			</div>
		</div>
		<div class="row">
			<div class="col credits-text">
				<p><small><?php _e('All rights reserved', 'bootstrap'); ?>.
				<?php if(wp_is_mobile()): ?>
					</small></p><p><small>
				<?php endif; ?>
				<?php echo bloginfo('name'); ?>&nbsp;&copy;&nbsp;<?php echo date('Y'); ?>.</small></p>
			</div>
		</div>
	</div>
</footer>
<?php do_action('after_credits_render'); ?>