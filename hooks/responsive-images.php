<?php

function add_bootstrap_image_responsive_class($content) {
	global $post;
	$pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
	$replacement = '<img$1class="$2 img-fluid img-thumbnail"$3>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}

add_filter('the_content', 'add_bootstrap_image_responsive_class');