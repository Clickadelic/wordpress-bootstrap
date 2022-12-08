<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="col col-sm-12 col-md-9 col-lg-9 col-xl-9 wc-archive-page">
				<div class="row">
					<div class="col">
						<h2 class="content-title"><?php _e('Shop', 'bootstrap'); ?></h2>
					</div>
				</div>
				<div class="row">
					<?php
						// See loop start and loop end in woocommerce/loop/*
						$args = array(
							'post_type' => 'product',
							'posts_per_page' => 36
						);
						$loop = new WP_Query( $args );
						if ( $loop->have_posts() ) {
							while ( $loop->have_posts() ) : $loop->the_post();
								wc_get_template_part('content', 'product');
							endwhile;
						} else {
							echo '<div class="alert alert-warning"><p>'.__('The are currently no products in stock. Please come back later. Thank you.', 'bootstrap').'</p></div>';
						}
						wp_reset_postdata();
					?>

				</div>
			</main>
			<?php manage_right_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>