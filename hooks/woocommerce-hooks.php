<?php

// Remove Breadcrumbs
function bs5_remove_woocommerce_breadcrumbs() {
	if(is_product()) {
		remove_action('woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
	}
}
add_filter('woocommerce_before_main_content', 'bs5_remove_woocommerce_breadcrumbs');

// Remove before and after div's
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 20);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 20);

// Add Bootstrap Thumbnail class
function bootstrap_wc_product_class_image($classes) {
    $classes[] = 'img-thumbnail';
    return $classes;
}
add_filter( 'woocommerce_single_product_image_gallery_classes', 'bootstrap_wc_product_class_image' );

function schoch_child_back_to_shop_button() {
	$shop_page_url = get_permalink(wc_get_page_id('shop'));
	$html ='<a href="'.esc_url($shop_page_url).'" class="btn btn-primary btn-xl btn-back-to-shop" title="'.__('Back to shop', 'bootstrap').'">';
	$html .= '<svg width="1em" height="1em" style="margin-top:-3px;margin-right:10px; viewBox="0 0 16 16" class="bi bi-chevron-double-left" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/><path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg>';
	$html .= __('Back to shop', 'bootstrap');
	$html .= '</a>';
	echo $html;
}
add_action( 'woocommerce_after_single_product_summary', 'schoch_child_back_to_shop_button', 30);