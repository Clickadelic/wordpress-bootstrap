<?php

// Add Stylesheets and Javascripts to the Wordpress Frontend Output 
if (!function_exists('theme_script_setup')) {
    function theme_script_setup() {
        // Script loading position
        $is_loaded_in_footer = true;
        $script_setting = get_theme_option('load_scripts_in_header');
        $debug_mode = get_theme_option('debug_mode');

        if($script_setting == 'on') {
            $is_loaded_in_footer = false;
        }

        // The styles > Default and Bootstrap Five
        wp_enqueue_style('bootstrap-defaults', get_template_directory_uri() . '/style.css', array(), '', 'all');
        wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap-frontend.css', array(), '', 'all');

        if($debug_mode == 'on') {
            wp_enqueue_style('bootstrap-debugger', get_template_directory_uri() . '/assets/css/bootstrap-debugger.css', array(), '', 'screen');
        }
        
        // Register scripts
        wp_enqueue_script('bootstrap-popper-min', get_template_directory_uri() . '/assets/js/popper.min.js', array('jquery'), '', $is_loaded_in_footer);
        wp_enqueue_script('bootstrap-bootstrap-min', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('bootstrap-popper-min'), '', $is_loaded_in_footer);
        wp_enqueue_script('bootstrap-frontend-actions', get_template_directory_uri() . '/assets/js/bootstrap-frontend-actions.js', array('bootstrap-popper-min', 'bootstrap-bootstrap-min'), '', $is_loaded_in_footer);
    }
}
add_action('wp_enqueue_scripts', 'theme_script_setup');