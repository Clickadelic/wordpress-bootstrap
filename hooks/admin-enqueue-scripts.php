<?php

// CSS and JS for the Backend
function theme_load_backend_scripts() {
	global $pagenow, $typenow, $taxnow;
	$dir = get_template_directory_uri();

    $ad_blocker = get_theme_option('ad_blocker');
    $disable_tips = get_theme_option('disable_tips');
    
    // AdBlocker CSS
    wp_register_style(
        'bootstrap-backend-ad-blocker',
        $dir . '/assets/css/bootstrap-backend-ad-blocker.css'
    );

    // Backend Style incl. Bootstrap 5
    wp_register_style(
        'bootstrap-backend-style',
        $dir.'/assets/css/bootstrap-backend.css'
    );
    // Popper JS
    wp_register_script(
        'bootstrap-popper-min-script',
        $dir.'/assets/js/popper.min.js',
        array('jquery'),
        NULL,
        true
    );
    // Bootstrap Min JS
    wp_register_script(
        'bootstrap-bootstrap-min-script',
        $dir.'/assets/js/bootstrap.min.js',
        array('jquery'),
        NULL,
        true
    );
    // Theme Backend Actions
    wp_register_script(
        'bootstrap-backend-actions',
        $dir.'/assets/js/bootstrap-backend-actions.js',
        array('jquery'),
        NULL,
        true
    );
    // Disable Gutenberg Tips
    wp_register_script(
        'bootstrap-disable-tips',
        $dir.'/assets/js/disable-gutenberg-tips.js',
        NULL,
        NULL,
        true
    );
    
    // Load AdBlocker CSS
    if($ad_blocker) {
        wp_enqueue_style('bootstrap-backend-ad-blocker');
    }

    // Dashboard Widget
    if($pagenow === 'index.php') {
        wp_enqueue_style('bootstrap-backend-style');
        wp_enqueue_script('bootstrap-bootstrap-min-script');
        wp_enqueue_script('bootstrap-popper-min-script');
        wp_enqueue_script('bootstrap-backend-actions');
    }

    // Settings Page
    if($pagenow === 'themes.php' && ( isset($_GET['page']) && $_GET['page'] === 'theme-settings' )) {
        wp_enqueue_style('bootstrap-datetime-picker-style');
        wp_enqueue_style('bootstrap-backend-style');
        wp_enqueue_script('bootstrap-bootstrap-min-script');
        wp_enqueue_script('bootstrap-popper-min-script');
        wp_enqueue_script('bootstrap-moment');
        wp_enqueue_script('bootstrap-datetime-picker');
        wp_enqueue_script('bootstrap-backend-actions');
    }

    // User Profile Page Backend
    if($pagenow === 'profile.php') {
        wp_enqueue_style('bootstrap-backend-style');
        wp_enqueue_script('bootstrap-bootstrap-min-script');
        wp_enqueue_script('bootstrap-popper-min-script');
        wp_enqueue_script('bootstrap-backend-actions'); 
    }

    // Category image upload
    if(($pagenow === 'edit-tags.php' && $taxnow === 'category') || ($pagenow === 'term.php' && $taxnow === 'category')){
        wp_enqueue_media();
        wp_enqueue_style('bootstrap-backend-style');
        wp_enqueue_script('bootstrap-bootstrap-min-script');
        wp_enqueue_script('bootstrap-popper-min-script');
        wp_enqueue_script('bootstrap-backend-actions');
        wp_localize_script('bootstrap-backend-actions', 'cat_meta',
            array(
                'title' => __('insert image', 'bootstrap' ),
                'button' => __('use this image', 'bootstrap' )
            )
        );
    }

    // Disable hints
    if($pagenow === 'post.php') {
        if($disable_tips == 'on') {
            wp_enqueue_script( 'bootstrap-disable-tips' );
        }
    }
}
add_action('admin_enqueue_scripts', 'theme_load_backend_scripts');