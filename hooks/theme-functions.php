<?php

function theme_detect_browser($classes) {
	// See https://codex.wordpress.org/Global_Variables #Browser Detection Booleans
	global
	$is_chrome,
	$is_safari,
	$is_NS4,
	$is_gecko,
	$is_IE,
	$is_edge,
	$is_opera,
	$is_macIE,
	$is_winIE,
	$is_lynx;

	if($is_safari){
		$classes[] = 'safari';
	} else if($is_chrome) {
		$classes[] = 'chrome';
	} else if($is_gecko) {
		$classes[] = 'gecko';
	} else if($is_lynx) {
		$classes[] = 'lynx';
	} else if($is_NS4) {
		$classes[] = 'netscape-4';
	} else if($is_macIE) {
		$classes[] = 'macie';
	} else if($is_edge) {
		$classes[] = 'edge';
	} else if($is_IE){
		$classes[] = 'internet-explorer';
	} else {
		$classes[] = 'unknown-browser';
	}
	
	return $classes;
}
add_filter('body_class', 'theme_detect_browser');

function theme_detect_device($classes){
	include_once THEME_ROOT . '/classes/Class-mobile-detect.php';
	
	$detect = new Mobile_Detect;
	// Any mobile device (phones or tablets).
	if ( $detect->isMobile() ) {
		$classes[] = 'device-mobile';
	// Any tablet device
	} else if( $detect->isTablet() ){
		$classes[] = 'device-tablet';
	// Exclude tablets
	} else if( $detect->isMobile() && !$detect->isTablet() ){
		$classes[] = 'device-not-mobile';
	// Check for specific platform with the help of the magic method
	} else if( $detect->isiOS() ){
		$classes[] = 'device-ios';
	} else if( $detect->isAndroidOS() ){
		$classes[] = 'device-android';
	} else {
		$classes[] = 'device-desktop-pc';
	}

	return $classes;
}
add_filter('body_class', 'theme_detect_browser');

// Deny shitty p and <br> Contact Form 7 output
add_filter('wpcf7_autop_or_not', '__return_false');

// https://www.it-swarm.dev/de/functions/ipad-von-wp-is-mobile-ausschliessen/961814381/
function theme_exclude_ipad_from_wp_is_mobile($is_mobile){
	if (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
		$is_mobile = false;
	}
	return $is_mobile;
}
add_filter('wp_is_mobile', 'theme_exclude_ipad_from_wp_is_mobile');

// Manage the right sidebar with WooCommerce
function manage_right_sidebar(){
	// WooCommerce checks > needs Improvement
	if(
		function_exists('is_shop') && is_shop() ||
		function_exists('is_product') && is_product() ||
		function_exists('is_cart') && is_cart() ||
		is_page('warenkorb') ||
		is_page('my-cart') ||
		is_page('mon-panier') ||
		is_page('kasse') ||
		is_page('checkout') ||
		is_page('mein-konto') ||
		is_page('my-account')
		){
		get_template_part('templates/sidebars/sidebar-woocommerce');
	} else {
		get_template_part('templates/sidebars/sidebar-right');
	}
}

/* Bootstrap Comment Pagination Markup */
if(!function_exists('custom_comment_layout')) {
    function custom_comment_layout($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
		
        $user = get_userdata($comment->user_id);
        $comment_to = $comment->user_id;
        $comment_classes = comment_class('', null, null, false);

        $link = get_comment_reply_link( array_merge( $args, 
        array(
            'reply_text' => $comment_to .'&nbsp;'.__('reply', 'bootstrap'),
            'depth' => $depth,
            'max_depth' => $args['max_depth']
            )
        ),
        $comment->comment_ID );

        if ( $args['avatar_size'] != 0 ) {
            // Kommentar und Avatar Size
            $avatar = get_avatar( $comment, '120' );
        }
        $html = '';
        // The actual Comment
        if ( $depth > 1 ) {
            $html .= '<li '. $comment_classes .' id="li-comment-'. get_comment_ID() .'">';
        }
        $html .= '<div class="row row-comments" id="comment-' . get_comment_ID() . '">';
            // Thumbs
            $html .= '<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 thumbnail-holder">';
                $html .= '<div class="thumbnail">';
                    $html .= $avatar;
                $html .= '</div>';
            $html .= '</div>';
            // The actual Comment
            $html .= '<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 comment-holder">';
                $html .= '<div class="panel panel-default panel-comment">';
                    $html .= '<div class="panel-heading timestamp">';
                        $html .= '<div class="comment-corner"></div>';
                        $html .= '<span class="author-data author-name">';
                            $html .= get_comment_author();
                        $html .= '</span>';
                        
                        $html .= '<span class="author-details author-says">';
                            $html .= __('says', 'bootstrap');
                        $html .= '</span>';

                        $html .= '<span class="author-details author-at">';
                            $html .= __('at', 'bootstrap');
                        $html .= '</span>';

                        $html .= '<span class="text-muted author-details author-time">';
                            $html .= get_comment_time();
                        $html .= '</span>';

                        $html .= '<span class="author-details author-at">';
                            $html .= __('o\'clock', 'bootstrap');
                        $html .= '</span>';

                        $html .= '<span class="author-details author-on">';
                            $html .= __('on', 'bootstrap');
                        $html .= '</span>';

                        $html .= '<span class="text-muted author-details author-date">';
                            $html .= get_comment_date() . ':';
                        $html .= '</span>';
                    $html .= '</div>';

                    $html .= '<div id="comment-'. get_comment_ID() .'" class="comment-body panel-body '. $comment_classes.'">';
                        $html .= get_comment_text();
                    $html .= '</div>';
                    
                    $html .= '<div class="comment-reply-link-holder">';
                        $html .= $link;
                    $html .= '</div>';

                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';
        if ( $depth > 1 ) {
            $html .= '</li>';
        }

        // Spit it out
        echo $html;
    }
}

// Count Comments
if(!function_exists('theme_comment_logic')){
	function theme_comment_logic() {
		$html = '';
		$num_comments = get_comments_number();
		if (comments_open()) {
			if ( $num_comments == 0 ) {
				$html = '<span class="number-of-comments no-comments-yet">'. __('no comments yet', 'bootstrap').'</span>';
			} elseif ( $num_comments > 1 ) {
				$html = '<span class="number-of-comments number-of-comments-'. $num_comments .'">'. $num_comments .'</span><span class="multiple-comments">'. __('Comments', 'bootstrap').'</span>';
			} else {
				$html = '<span class="number-of-comments number-of-comments-1">'. __('1 Comment', 'bootstrap').'</span>';
			}
		} else {
			$html =  '<span class="number-of-comments comments-closed">'.__('Comments closed', 'bootstrap').'</span>';
		}
		return $html;
	}
}