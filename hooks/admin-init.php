<?php
function theme_add_editor_styles() {
    add_editor_style('custom-editor-style.css');
}
add_action('admin_init', 'theme_add_editor_styles');