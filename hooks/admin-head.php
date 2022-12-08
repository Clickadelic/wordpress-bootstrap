<?php
// Remove annoying "Intro Tour" of WP
function my_custom_admin_head() {
    $html = '<style type="text/css" id="bootstrap-admin-inline-css">';
    $html .= '[for="wp_welcome_panel-hide"] {display: none !important;}';
    if(current_user_can('manage_options')){
        $html .= '.components-modal__screen-overlay { display: none !important;}';
    }
    $html .= '</style>';
    echo $html;
}
add_action( 'admin_head', 'my_custom_admin_head' );