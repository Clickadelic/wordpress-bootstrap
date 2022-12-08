<?php do_action('before_logo_render'); ?>
<a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php _e('Start', 'bootstrap'); ?>">
	<?php echo bloginfo('name'); ?>
</a>
<?php do_action('after_logo_render'); ?>