<?php

if (!function_exists('theme_widgets_init')) {
    function theme_widgets_init($widgets_size) {
        $widgets_size = get_theme_mod('widgets_size');
        $canvas_enabled = get_theme_mod('canvas_enabled', '0');
        /* Left and Right Sidebar */
        register_sidebar(array(
            'name'          => __('Sidebar Left', 'bootstrap'),
            'id'            => 'sidebar-left',
            'description'   => __('Left standard sidebar', 'bootstrap'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
        register_sidebar(array(
            'name'          => __('Sidebar Right', 'bootstrap'),
            'id'            => 'sidebar-right',
            'description'   => __('Right standard sidebar', 'bootstrap'),
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget'  => '</li>',
            'before_title'  => '<h2 class="widgettitle">',
            'after_title'   => '</h2>',
        ));
        // Canvas sidebar widget
        if(!empty($canvas_enabled) && $canvas_enabled == ('1')){
            register_sidebar(array(
                'name'          => __('Canvas Sidebar widget', 'bootstrap'),
                'id'            => 'widget-canvas',
                'description'   => __('Canvas widget when activated in the theme options', 'bootstrap'),
                'before_widget' => '<li id="%1$s" class="widget canvas-widget %2$s">',
                'after_widget'  => '</li>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>',
            ));
        }
        switch ($widgets_size) {

            case '0':

                break;

            case '1':
                register_sidebar(array(
                    'name'          => __('Single Footer Widget', 'bootstrap'),
                    'description' => __('Footer widget in the lower section of the theme.', 'bootstrap'),
                    'id'            => 'footer-widget-1',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));
                break;

            case '2':
                register_sidebar(array(
                    'name'          => __('Left Footer Widget', 'bootstrap'),
                    'description' => __('Left footer widget in the lower section of the theme.', 'bootstrap'),
                    'id'            => 'footer-widget-1',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Right Footer Widget', 'bootstrap'),
                    'description' => __('Right footer widget in the lower section of the theme.', 'bootstrap'),
                    'id'            => 'footer-widget-2',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                break;

            case '3':

                register_sidebar(array(
                    'name'          => __('Left Footer Widget', 'bootstrap'),
                    'description' => __('Left footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-1',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Center Footer Widget', 'bootstrap'),
                    'description' => __('Centered footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-2',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Right Footer Widget', 'bootstrap'),
                    'description' => __('Right footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-3',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                break;

            case '4':

                register_sidebar(array(
                    'name'          => __('Left Footer Widget', 'bootstrap'),
                    'description' => __('Left footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-1',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Center Left Footer Widget', 'bootstrap'),
                    'description' => __('Left centered footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-2',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Center Right Footer Widget', 'bootstrap'),
                    'description' => __('Right centered footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-3',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                register_sidebar(array(
                    'name'          => __('Right Footer Widget', 'bootstrap'),
                    'description' => __('Right footer widget in the middle of the lower footer section.', 'bootstrap'),
                    'id'            => 'footer-widget-4',
                    'before_widget' => '<div id="widget-footer-%1$s" class="widget widget-footer %2$s">',
                    'after_widget'  => '</div>'
                ));

                break;

            default:

                break;
        }
        include_once( ABSPATH . 'wp-admin/includes/plugin.php');
        if(is_plugin_active('woocommerce/woocommerce.php')){
            register_sidebar(array(
                'name'          => __('Sidebar WooCommerce', 'bootstrap'),
                'id'            => 'sidebar-woocommerce',
                'description'   => __('WooCommerce sidebar visible on all woocommerce pages.', 'bootstrap'),
                'before_widget' => '<li id="%1$s" class="widget %2$s">',
                'after_widget'  => '</li>',
                'before_title'  => '<h2 class="widgettitle">',
                'after_title'   => '</h2>'
            ));
        }

    }
}
add_action('widgets_init', 'theme_widgets_init');