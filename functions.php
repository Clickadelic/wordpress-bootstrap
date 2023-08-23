<?php

require 'hooks/woocommerce-actions.php';

require 'hooks/wp-enqueue-scripts.php';

require 'hooks/wp-before-admin-bar-render.php';

require 'hooks/customize-register-custom-logo.php';

// Add Menu, widgets, remove unused stuff etc.
require 'hooks/after-setup-theme.php';

// Widgets
require 'hooks/widgets-init.php';

require 'hooks/avatar-defaults.php';

// Admin enqueque scripts
require 'hooks/admin-enqueue-scripts.php';

// Numeric posts pagination
require 'hooks/custom-pagination.php';

// Admin enqueue scripts
require 'hooks/pagination-link-attributes.php';

// Gutenberg editor enqueue assets
require 'hooks/enqueue-block-editor-assets.php';

// Custom excerpt length
require 'hooks/excerpt-length.php';

// YouTube Videos responsive
require 'hooks/embed-oembed-html.php';

// Responsive images
require 'hooks/responsive-images.php';

// Add category image
require 'hooks/category-image.php';

// Hide WordPress version in backend for non-admins
require 'hooks/admin-menu.php';

// Navwalker with Bootstrap icons capability
require 'classes/Class-bootstrap-navwalker.php';

// Theme options
require 'classes/Class-theme-options.php';

// additional Theme Functions
require 'hooks/theme-functions.php';

require 'hooks/headless-frontend.php';




/**
 * Check if WooCommerce is active
 * Use in the active_callback when adding the WooCommerce Section to test if WooCommerce is activated
 *
 * @return boolean
 */
function is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}

if(is_woocommerce_active()){
	require 'hooks/woocommerce-hooks.php';
}

// Disable "Update done" notification
require 'hooks/disable-update-message.php';

// Core Fix, show users in Author dropdown
require 'hooks/wp-dropdown-user-args.php';

// remove annoying modal on pages and posts for admins
require 'hooks/admin-head.php';

class WordPressBootstrap {

	public function __construct(){
		add_action('load_theme_textdomain', array( $this, 'init_theme'));
		add_action('wp_before_admin_bar_render', array($this, 'filter_admin_bar_items'));
		add_action('admin_footer', array($this, 'backend_posts_status_color'));
		add_action('admin_footer_text', array($this, 'backend_footer_text'));
		add_filter('wp_title', 'format_theme_title', 10, 2);
		add_filter('dynamic_sidebar_params', array($this, 'filter_widget_title_tag'));
		add_filter('avatar_defaults', 'theme_custom_avatar');
	}

	public static function init_theme(){
		load_theme_textdomain('wordpress-bootstrap', false, esc_url(get_template_directory_uri('/languages')));
	}

	public static function filter_admin_bar_items() {
		global $wp_admin_bar;
		$wp_admin_bar->remove_menu('wp-logo');
		$wp_admin_bar->remove_menu('view-site');
        $wp_admin_bar->remove_menu('wtf-bar-powered-by');
	}
	public static function filter_widget_title_tag($params){
		$params[0]['before_title'] = '<h2 class="widget-title">';
		$params[0]['after_title'] = '</h2>';
		return $params;
	}
	public static function backend_footer_text(){
		echo '<span class="backend-footer-credits">powered by <a href="https://www.tobias-hopp.de" title="Tobias Hopp" target="_blank">Tobias Hopp</a></span>';
	}

	public static function backend_posts_status_color(){
		// draft, pending, publish, future, private
	?>	
		<style type="text/css" id="wordpress-bootstrap-colored-admin-columns">
		  .status-draft{background: #fce3f2 !important;}
		  .status-pending{background: #87c5d6 !important;}
		  .status-future{background: #c6ebf5 !important;}
		  .status-private{background:#f2d46f;}
		</style>
	<?php
	}

	public static function format_theme_title( $title, $sep ) {
        if ( is_feed() ) {
            return $title;
        }
        
        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo( 'name', 'display' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
            $title .= " $sep " . sprintf( __( 'Page %', 'bootstrap' ), max( $paged, $page ) );
        }

        return $title;
    }
	
	public static function theme_custom_avatar ($avatar_defaults) {
		$theme_avatar =  get_template_directory_uri().'/assets/images/Default-Avatar.png';
		$new_avatar[$theme_avatar] = __('Theme Avatar (WordPress Bootstrap)', 'bootstrap');
		$avatar = array_merge($new_avatar, $avatar_defaults);
		return $avatar;
	}
	
	
}

$WordPressTheme = new WordPressBootstrap();

function checkPlugin(){
	if(in_array('plugin-directory/plugin-file.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
		//plugin is activated
	}
}