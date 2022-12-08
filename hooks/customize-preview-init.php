<?php

// Preview script
if (!function_exists('bootstrap_customizer_preview_scripts')) {
	function bootstrap_customizer_preview_scripts() {
		wp_enqueue_script(
            'bootstrap-customizer-preview',
            trailingslashit(get_template_directory_uri()) . 'components/js/customizer-preview.js',
            array('customize-preview', 'jquery'),
            NULL,
            true
        );
	}
}
add_action('customize_preview_init', 'bootstrap_customizer_preview_scripts');