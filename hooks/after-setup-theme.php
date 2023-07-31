<?php

// Tell Wordpress to load the Template Files
if (!function_exists('theme_template_setup')) {
    function theme_template_setup() {
        load_theme_textdomain( 'bootstrap', get_template_directory() . '/languages');
        // // Register the default header image
        // // TopBar Menus
        // $show_topbar = esc_attr(get_theme_mod('show_topbar'));
        // if($show_topbar) {
        //     register_nav_menus(array(
        //         'top_left_menu' => __('top left menu', 'bootstrap'),
        //         'top_right_menu' => __('top right menu', 'bootstrap'),
        //     ));
        // }
        // // Bottom Menus
        // $show_bottombar = esc_attr(get_theme_mod('show_bottombar'));
        // if($show_bottombar) {
        //     register_nav_menus(array(
        //         'bottom_left_menu' => __('bottom left menu', 'bootstrap'),
        //         'bottom_right_menu' => __('bottom right menu', 'bootstrap'),
        //     ));
        // }
        // Main Menus needed
        register_nav_menus(array(
            'primary' => __('main menu', 'bootstrap'),
            'errormenu' => __('error 404 menu', 'bootstrap'),
            'credits-menu' => __('credits menu', 'bootstrap')
        ));
        // Add nice Title Tag Support
        add_theme_support('title-tag');
        // add theme support post and comment automatic feed links
        add_theme_support('automatic-feed-links');
        // enable support for post thumbnail or feature image on posts and pages
        add_theme_support('post-thumbnails');
       

        // $header_defaults = array(
        //     'default-image'          => get_template_directory_uri() . '/components/images/Default-Slideshow.jpg',
        //     'width'                  => 1920,
        //     'height'                 => 380,
        //     'flex-height'            => false,
        //     'flex-width'             => true,
        //     'uploads'                => true,
        //     'random-default'         => false,
        //     'header-text'            => true,
        //     'default-text-color'     => '#ffffff',
        //     'wp-head-callback'       => '',
        //     'admin-head-callback'    => '',
        //     'admin-preview-callback' => '',
        // );
        // add_theme_support('custom-header', $header_defaults );
        // $background_defaults = array(
        //     'default-color'          => '',
        //     'default-image'          => '',
        //     'default-repeat'         => 'repeat',
        //     'default-position-x'     => 'center',
        //     'default-position-y'     => 'top',
        //     'default-size'           => 'auto',
        //     'default-attachment'     => 'scroll',
        //     'wp-head-callback'       => '_custom_background_cb',
        //     'admin-head-callback'    => '',
        //     'admin-preview-callback' => ''
        // );
        // add_theme_support( 'custom-background', $background_defaults );
        
        // Remove shitty Emoticons
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        if(!current_user_can('administrator')) {
            remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
        }
        // Add theme support for WooCommerce
        add_theme_support('woocommerce');

        // Add support for Gutenberg Editor Stylesheet
        // See https://rudrastyh.com/gutenberg/css.html
        add_theme_support('editor-styles');
        add_editor_style('components/css/bootstrap-editor-style.css');

        // Newsstream layout
        add_image_size('preview-thumbnail', 265, 195, true);

    }
}
add_action('after_setup_theme', 'theme_template_setup');
