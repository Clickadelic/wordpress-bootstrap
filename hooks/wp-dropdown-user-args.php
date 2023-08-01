<?php
// still open in mid 2023 :(
// https://core.trac.wordpress.org/ticket/16841
function extend_authors_selector_list( $query_args, $r ){
    $blogusers = get_users( array( 'role__in' => array('redakteur', 'autor') ) );

	foreach ( $blogusers as $user ) {
		if( ! $user->has_cap( 'level_1' ) ) {
			$user->add_cap('level_1');
		}
	}

	$query_args['who'] = '';
	$query_args['role__in'] = array('administrator','redakteur','autor');

    return $query_args;
}
add_filter('wp_dropdown_users_args', 'extend_authors_selector_list', 10, 2);