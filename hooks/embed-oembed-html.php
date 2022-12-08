<?php

function bs5_embedVideoBlock( $html ) {
 return '<div class="video-block">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'bs5_embedVideoBlock', 10, 3 );