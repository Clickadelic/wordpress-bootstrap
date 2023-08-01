<?php do_action('before_footer_widgets_render'); ?>
<?php

// See hooks/widgets-init.php
$widgets_size = get_theme_mod('widgets_size');
switch ($widgets_size) {
	case '0':
		# code...
		break;
	
	case '1':
		echo '<div class="wrap-footer">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col">';
						dynamic_sidebar('footer-widget-1');
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		break;

	case '2':
		echo '<div class="wrap-footer">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-6">';
						dynamic_sidebar('footer-widget-1');
					echo '</div>';
					echo '<div class="col-md-6">';
						dynamic_sidebar('footer-widget-2');
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		break;

	case '3':
		echo '<div class="wrap-footer">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-4">';
						dynamic_sidebar('footer-widget-1');
					echo '</div>';
					echo '<div class="col-md-4">';
						dynamic_sidebar('footer-widget-2');
					echo '</div>';
					echo '<div class="col-md-4">';
						dynamic_sidebar('footer-widget-3');
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		break;

	case '4':
		echo '<div class="wrap-footer">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-3">';
						dynamic_sidebar('footer-widget-1');
					echo '</div>';
					echo '<div class="col-md-3">';
						dynamic_sidebar('footer-widget-2');
					echo '</div>';
					echo '<div class="col-md-3">';
						dynamic_sidebar('footer-widget-3');
					echo '</div>';
					echo '<div class="col-md-3">';
						dynamic_sidebar('footer-widget-4');
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
		break;
	
	default:
		# code...
		break;
}

?>
<?php do_action('after_footer_widgets_render'); ?>