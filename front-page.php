<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="col-md-9">
				<?php
					// Title or no title show_on_front > posts/pages
					$page_modus = get_option('show_on_front');
					if($page_modus == 'posts') {
					    echo '<div class="row">';
					        echo '<div class="col">';
					            echo '<h2 class="content-title">'.__('News', 'bootstrap').'</h2>';
					        echo '</div>';
					    echo '</div>';
					}
				?>
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
