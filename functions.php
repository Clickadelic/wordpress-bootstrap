<?php

require 'hooks/wp-enqueue-scripts.php';

require 'hooks/customize-register-custom-logo.php';

// Add Menu, widgets, remove unused stuff etc.
require 'hooks/after-setup-theme.php';

// Widgets
require 'hooks/widgets-init.php';

// Admin enqueque scripts
require 'hooks/admin-enqueue-scripts.php';

// Numeric posts pagination
require 'hooks/custom-pagination.php';

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

// Navwalker with Bootstrap icons capability
require 'classes/Class-bootstrap-navwalker.php';

// Theme options
require 'classes/Class-theme-options.php';

// additional Theme Functions
require 'hooks/theme-functions.php';

/**
 * Check if WooCommerce is active
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

class WordPress_Bootstrap {

	public function __construct(){
		add_action('load_theme_textdomain', array( $this, 'init_theme'));
		add_action('wp_before_admin_bar_render', array($this, 'filter_admin_bar_items'));
		add_action('admin_footer', array($this, 'backend_posts_status_color'));
		add_action('admin_footer_text', array($this, 'backend_footer_text'));
		add_action('wp_before_admin_bar_render', 'bootstrap_tweakWPAdminBar', 0);
		add_action('admin_menu', 'bs5_remove_core_version');

		add_filter('wp_title', 'format_theme_title', 10, 2);
		add_filter('dynamic_sidebar_params', array($this, 'filter_widget_title_tag'));
		add_filter('avatar_defaults', 'theme_custom_avatar');

		add_filter('next_posts_link_attributes', 'custom_posts_link_attributes');
		add_filter('previous_posts_link_attributes', 'custom_posts_link_attributes');
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

	public static function bootstrap_tweakWPAdminBar() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('view-site');
        $wp_admin_bar->remove_menu('wtf-bar-powered-by');
        $admin_bar_icon = '<svg class="bi bi-display" width="1em" height="1em" style="margin: -2px 10px 0 0" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M5.75 13.5c.167-.333.25-.833.25-1.5h4c0 .667.083 1.167.25 1.5H11a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1h.75z"/><path fill-rule="evenodd" d="M13.991 3H2c-.325 0-.502.078-.602.145a.758.758 0 0 0-.254.302A1.46 1.46 0 0 0 1 4.01V10c0 .325.078.502.145.602.07.105.17.188.302.254a1.464 1.464 0 0 0 .538.143L2.01 11H14c.325 0 .502-.078.602-.145a.758.758 0 0 0 .254-.302 1.464 1.464 0 0 0 .143-.538L15 9.99V4c0-.325-.078-.502-.145-.602a.757.757 0 0 0-.302-.254A1.46 1.46 0 0 0 13.99 3zM14 2H2C0 2 0 4 0 4v6c0 2 2 2 2 2h12c2 0 2-2 2-2V4c0-2-2-2-2-2z"/></svg>';
        if(current_user_can('manage_options')) {
            $wp_admin_bar->add_menu( array(
                'parent' => false, 
                'id' => 'bootstrap-theme-settings',
                'title' => $admin_bar_icon.__('Theme-Settings', 'bootstrap'),
                'href' => admin_url('themes.php?page=theme-settings'),
                'meta' => array(
                    'class' => 'admin-bar-button'
                )
            ));
        }
    }

	public static function bs5_remove_core_version() {
		if(!current_user_can('manage_options')) {
			remove_filter('update_footer', 'core_update_footer'); 
		}
	}

	public static function custom_posts_link_attributes() {
    	return 'class="btn btn-primary btn-pagination"';
	}
}

$WordPress_Bootstrap = new WordPress_Bootstrap();

function checkPlugin(){
	if(in_array('plugin-directory/plugin-file.php', apply_filters('active_plugins', get_option('active_plugins')))){ 
		//plugin is activated
	}
}