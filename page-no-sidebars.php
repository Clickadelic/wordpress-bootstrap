<?php
/*
Template Name: No Sidebars
*/
?>
<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="offset-md-3 col-md-6">
				<?php get_template_part('the-loop'); ?>	
			</main>
		</div>
	</div>
</div>
<?php get_footer(); ?>