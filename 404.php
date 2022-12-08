<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="col-md-9">
				<article class="page page-404">
					<div class="row">
						<div class="col">
							<h2 class="content-title"><?php _e('Error 404', 'bootstrap'); ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="alert alert-warning mb-4">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/><path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/></svg>
								</button>
								<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-emoji-dizzy" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path fill-rule="evenodd" d="M9.146 5.146a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708zm-5 0a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 1 1 .708.708l-.647.646.647.646a.5.5 0 1 1-.708.708L5.5 7.207l-.646.647a.5.5 0 1 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 0-.708z"/><path d="M10 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg><?php _e('Uups, error 404! The page you are looking for could not be found.', 'bootstrap'); ?></p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 error404-searchbar mb-4">
							<h2><?php _e('Maybe a search can help', 'bootstrap'); ?>?</h2>
							<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 error404-page-menu">
							<h2 class="title"><?php _e('or these links', 'bootstrap'); ?>&hellip;</h2>
							<?php
							$errormenu = array(
								'theme_location' => 'errormenu',
								'container' => false,
								'menu_class' => 'nav',
								'depth' => 2,
								'walker' => new wp_bootstrap_navwalker()
							);
						?>
						<?php echo wp_nav_menu($errormenu); ?>
						</div>
					</div>
				</article>	
			</main>
			<?php manage_right_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>