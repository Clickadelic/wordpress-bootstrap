<?php

// Change product markup
function bootstrap_custom_woocommerce_card() {
    $html = '<span>DUMMY</span>';
    return $html;
}
add_action('woocommerce_before_shop_loop_item_title', 'bootstrap_custom_woocommerce_card');