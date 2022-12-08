<?php
if(!function_exists('bootstrap_blog_name_title')) {
    function bootstrap_blog_name_title( $title, $sep ) {
        if ( is_feed() ) {
            return $title;
        }
        
        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo( 'name', 'display' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
            $title .= " $sep " . sprintf( __( 'Page %', 'bootstrap' ), max( $paged, $page ) );
        }

        return $title;
    }
}
add_filter('wp_title', 'bootstrap_blog_name_title', 10, 2);