<?php
// Change "thank you for using wordpress text"
function theme_change_admin_footer_text(){
    echo '<span class="backend-footer-credits">powered by <a href="https://www.tobias-hopp.de" title="Tobias Hopp" target="_blank">Tobias Hopp</a></span>';
}
add_filter('admin_footer_text', 'theme_change_admin_footer_text');

// Colorized admin rows, better visibility
function theme_backend_posts_status_color(){
?>
<style type="text/css" id="bootstrap-colored-admin-columns">
  .status-draft{background: #fce3f2 !important;}
  .status-pending{background: #87c5d6 !important;}
  .status-publish{/* no background keep wp alternating colors */}
  .status-future{background: #c6ebf5 !important;}
  .status-private{background:#f2d46f;}
</style>
<?php
}
add_action('admin_footer','theme_backend_posts_status_color');