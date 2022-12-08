<?php

function bootstrap_filter_widget_title_tag($params){
    $params[0]['before_title'] = '<h2 class="widget-title">';
    $params[0]['after_title'] = '</h2>';
    return $params;
}
add_filter('dynamic_sidebar_params', 'bootstrap_filter_widget_title_tag');