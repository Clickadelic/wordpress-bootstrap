<?php
// No more "update-done" notification emails
add_filter( 'auto_plugin_update_send_email', '__return_false' ); 
add_filter( 'auto_theme_update_send_email', '__return_false' );