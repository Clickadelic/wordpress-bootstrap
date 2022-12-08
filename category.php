<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="col-md-9">
				<div class="row">
					<div class="col">
						<h2 class="content-title">
						<?php _e('All posts in', 'bootstrap'); ?>:&nbsp;<?php single_cat_title(); ?></h2>
					</div>
				</div>
				<?php get_template_part('the-loop'); ?>	
				<?php the_posts_pagination(
					array(
						'prev_text' => __('back', 'bootstrap'),
						'next_text' => __('forward', 'bootstrap')
					));
				?>
			</main>
			<?php manage_right_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
