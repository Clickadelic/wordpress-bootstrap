<?php

// Theme Customizer Felder
function bootstrap_custom_logo($wp_customize) {
    //////////////////////////////////////////////////////////////////
    // Settings
    //////////////////////////////////////////////////////////////////
    // Header Image
    $wp_customize->add_setting('custom_logo_upload');
    $wp_customize->add_setting('author_card_background');
    //////////////////////////////////////////////////////////////////
    // Sections
    //////////////////////////////////////////////////////////////////
    /* Theme Logo Upload */
    $wp_customize->add_section('header_image', array(
        'title' => __('Image upload', 'bootstrap'),
        'description' => __('Upload images or a logo of your company or your product.', 'bootstrap'),
        'priority' => 30
    ));
    //////////////////////////////////////////////////////////////////
    // Controls
    //////////////////////////////////////////////////////////////////
    $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'logo-upload', array(
        'label'    => __('Your current logo', 'bootstrap'),
        'section'  => 'header_image',
        'settings' => 'custom_logo_upload'
    )));
    $wp_customize->add_control(new WP_Customize_Image_Control( $wp_customize, 'author-card-background', array(
        'label'    => __('Author background image', 'bootstrap'),
        'section'  => 'header_image',
        'settings' => 'author_card_background'
    )));
}
add_action('customize_register', 'bootstrap_custom_logo');