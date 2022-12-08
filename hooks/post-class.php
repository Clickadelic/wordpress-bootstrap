<?php

if(!function_exists('custom_post_classes')) {
	function custom_post_class($format) {
		
	}
}
add_filter('post_class', 'custom_post_classes');