<?php

$headless_enabled = get_theme_option("headless_mode");
function redirect_to_backend($headless_enabled) {
	if($headless_enabled == 'on' && !is_user_logged_in()){
		wp_redirect(site_url('wp-admin'));
	}
}
add_action( 'init', 'redirect_to_backend' );