<?php

if(!isset($content_width)){
	$content_width = 848;
}

define("THEME_ROOT", realpath(dirname(__FILE__)));

require 'hooks/init.php';

require 'hooks/woocommerce-actions.php';

require 'hooks/wp-enqueue-scripts.php';

require 'hooks/wp-before-admin-bar-render.php';

// Customizer Logo
require 'hooks/customize-register-custom-logo.php';

// Add Menu, widgets, remove shit, etc.
require 'hooks/after-setup-theme.php';

// Widgets
require 'hooks/widgets-init.php';

// Nice title tag
require 'hooks/wp-title.php';

// Add a custom avatar, no gravatar bullshit please
require 'hooks/avatar-defaults.php';

// Admin enqueque scripts
require 'hooks/admin-enqueue-scripts.php';

// Numeric posts pagination
require 'hooks/custom-pagination.php';

// Admin enqueue scripts
require 'hooks/pagination-link-attributes.php';

// Gutenberg editor enqueue assets
require 'hooks/enqueue-block-editor-assets.php';

// Custom excerpt length function
require 'hooks/excerpt-length.php';

// Make YouTube Videos responsive
require 'hooks/embed-oembed-html.php';

// Customize register
require 'hooks/the-content.php';

// Category images
require 'hooks/category-image.php';

// // Add Editor Style
require 'hooks/admin-init.php';

// Hide version in backend for non-admins
require 'hooks/admin-menu.php';

// Change backend credits
require 'hooks/admin-footer-text.php';

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

// Customizer Output
require 'hooks/filter-widget-title.php';