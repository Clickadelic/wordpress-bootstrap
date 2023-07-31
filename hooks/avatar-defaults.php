<?php

function bootstrap_custom_avatar ($avatar_defaults) {
	$myavatar =  get_template_directory_uri().'/assets/images/Default-Avatar.png';
	$new_avatar[$myavatar] = __('Bootstrap default avatar', 'bootstrap');
	$avatar = array_merge($new_avatar, $avatar_defaults);
	return $avatar;
}
add_filter('avatar_defaults', 'bootstrap_custom_avatar');