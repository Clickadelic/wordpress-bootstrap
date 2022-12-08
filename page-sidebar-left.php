<?php
/*
Template Name: Sidebar Left
*/
?>
<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<?php get_template_part('templates/sidebars/sidebar-left-desktop'); ?>
			<main class="col-md-9">
				<?php get_template_part('the-loop'); ?>	
			</main>
			<?php get_template_part('templates/sidebars/sidebar-left-mobile'); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>