<?php
// Hide WP version from regular users
function bs5_remove_core_version() {
	if(!current_user_can('manage_options')) {
    	remove_filter('update_footer', 'core_update_footer'); 
	}
}
add_action('admin_menu', 'bs5_remove_core_version');