<?php
/*
Template Name: Two Sidebars
*/
?>
<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<?php get_template_part('templates/sidebars/sidebar-left-desktop'); ?>
			<main class="col-md-6">
				<?php get_template_part('the-loop'); ?>
			</main>
			<?php manage_right_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>