<?php
// Let's add two classes to the wp function get_next_posts_link()
function custom_posts_link_attributes() {
    return 'class="btn btn-primary btn-pagination"';
}
add_filter('next_posts_link_attributes', 'custom_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'custom_posts_link_attributes');