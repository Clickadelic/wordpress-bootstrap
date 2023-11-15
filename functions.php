<?php

class WordPress_Bootstrap_Core {

	public function __construct(){
		add_action('load_theme_textdomain', array( $this, 'load_translations'));
		add_action('wp_before_admin_bar_render', array($this, 'filter_admin_bar_items'), 21);
	}

	public static function load_translations(){
		load_theme_textdomain('wordpress-bootstrap', false, esc_url(get_template_directory_uri('/languages')));
	}

	public static function filter_admin_bar_items() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('view-site');
        $wp_admin_bar->remove_menu('wtf-bar-powered-by');
	}

	// Helpers
	public static function is_woocommerce_active() {
		if ( class_exists( 'woocommerce' ) ) {
			return true;
		}
		return false;
	}

	public static function is_plugin_active(){
		if(in_array('plugin-directory/plugin-file.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
			//plugin is activated
		}
	}
}

class WordPress_Bootstrap_Frontend_Scripts extends WordPress_Bootstrap_Core {

	public function __construct(){
		add_action('wp_enqueue_scripts', array( $this, 'load_frontend_styles_and_scripts'));
	}

	public static function load_frontend_styles_and_scripts() {
		wp_enqueue_style('wordpress-default-style', get_template_directory_uri() . '/style.css', null, null, 'all');
		wp_enqueue_style('wordpress-bootstrap-style', get_template_directory_uri() . '/wordpress-bootstrap.css', null, null, 'all');
        wp_enqueue_script('wordpress-bootstrap-popper-min-js', get_template_directory_uri() . '/assets/js/popper.min.js', null, null, true);
        wp_enqueue_script('wordpress-bootstrap-min-js', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('bootstrap-popper-min-js'), null, true);
    }
}


$current_theme = new WordPress_Bootstrap_Core();
$current_styles = new WordPress_Bootstrap_Frontend_Scripts();

if($current_theme->is_woocommerce_active()){
	require 'hooks/woocommerce-hooks.php';
}