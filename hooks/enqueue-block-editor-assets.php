<?php
// Loading editor styles for the block editor (Gutenberg)
function bootstrap_editor_styles_and_scripts() {
    wp_register_style(
        'bootstrap-editor-style',
        get_template_directory_uri().'/components/css/bootstrap-editor-style.css'
    );
    wp_register_script(
        'bootstrap-editor-actions',
        get_template_directory_uri(). '/components/js/bootstrap-editor-actions.js',
        array('jquery', 'wp-blocks', 'wp-dom'),
        NULL,
        true
    );

    wp_enqueue_style('bootstrap-editor-style');
    wp_enqueue_script('bootstrap-editor-actions');
}
add_action('enqueue_block_editor_assets', 'bootstrap_editor_styles_and_scripts' );