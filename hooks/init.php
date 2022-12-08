<?php

if(!function_exists('theme_init')) {
	function theme_init() {
		load_theme_textdomain('bootstrap', get_template_directory() . '/languages');
	}
}
add_action('init', 'theme_init');