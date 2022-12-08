<?php do_action('before_navbar_render'); ?>
<nav class="navbar navbar-expand-lg" id="wrap-bootstrap-navbar">
	<?php do_action('before_navbar_nav_open_render'); ?>
	<div class="container">
		<?php get_template_part('templates/custom-logo'); ?>
		<?php if(wp_is_mobile()): ?>
		<button class="btn btn-outline-primary search-trigger" id="the-search-trigger-mobile-1" data-bs-toggle="modal" data-bs-target="#the-search-modal">
			<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/><path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/></svg>
		</button>
		<?php endif; ?>
		<div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#bootstrap-navbar" aria-controls="bootstrap-navbar" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="ham hamRotate ham8" viewBox="0 0 100 100" width="60" onclick="this.classList.toggle('active')">
              <path
                    class="line top"
                    d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
              <path
                    class="line middle"
                    d="m 30,50 h 40" />
              <path
                    class="line bottom"
                    d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
            </svg>
		</div>
		<div class="collapse navbar-collapse" id="bootstrap-navbar">
			<?php do_action('before_collapse_open_render'); ?>
			<?php
				wp_nav_menu([
					'menu'            => 'primary',
					'theme_location'  => 'primary',
					'container'       => false,
					'menu_id'         => 'main-menu',
					'menu_class'      => 'navbar-nav ms-auto',
					'depth'           => 2,
					'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
					'walker'          => new WP_Bootstrap_Navwalker()
				]);
			?>
			<?php do_action('after_collapse_open_render'); ?>
		</div>
	</div>
	<?php do_action('before_navbar_nav_close_render'); ?>
</nav>
<?php do_action('after_navbar_render'); ?>