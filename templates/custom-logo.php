<?php

do_action('before_logo_render');

$custom_logo_url = get_theme_mod('custom_logo_upload', null);
if($custom_logo_url !== null) {
?>
	<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php _e('Start', 'bootstrap'); ?>">
		<img src="<?php echo $custom_logo_url ?>" class="navbar-brand-logo" alt="<?php echo bloginfo('name'); ?>" />
	</a>
<?php
} else {
?>
	<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php _e('Start', 'bootstrap'); ?>">
		<?php echo bloginfo('name'); ?>
	</a>
<?php
}
?>

<?php do_action('after_logo_render'); ?>