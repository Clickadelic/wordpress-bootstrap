<?php

// Add column to overview
function manage_bootstrap_theme_columns($columns){
    // add 'My Column'
    $columns['category-image'] = __('Category image', 'bootstrap');
    return $columns;
}
add_filter('manage_edit-category_columns','manage_bootstrap_theme_columns');

// Add data (cat-image-url meta-key) to custom column (taken from database)
function bootstrap_show_term_image_data($content, $column_name, $term_id){
    if( $column_name !== 'category-image' ){
        return $content;
    }
    $term_id = absint($term_id);
    $cat_image_url = get_term_meta( $term_id, 'cat-image-url', true );
    if(!empty($cat_image_url)){
        $content .= '<img src="'.$cat_image_url.'" width="100px" height="auto" alt="term-image" />';
    }
    return $content;
}
add_filter('manage_category_custom_column', 'bootstrap_show_term_image_data', 10, 3);

// Add fields
function bootstrap_add_category_image_upload_form_fields_to_new_category() {
    $placeholder_url = get_template_directory_uri(). '/assets/images/Default-category-image.png';
    $cat_image_url = get_term_meta('cat-image-url');
    ?>
    <div class="form-field term-image-upload-wrap">
        <label for="cat-image-url"><?php _e('Category image', 'bootstrap'); ?></label>
        <input type="hidden" name="cat-image-url" id="cat-image-url" value="">
        <div class="cat-image-preview-field">
            <img src="<?php echo $placeholder_url; ?>" class="backend-term-image" id="cat-image-preview" alt="category image frame">
        </div>
        <p class="mb-2"><?php _e('An image, which represets the category.','bootstrap'); ?></p>
        <div class="term-image-controls">
            <a href="#" class="btn btn-primary btn-sm" id="cat-image-upload"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" style="margin-top: -3px; margin-right: 5px;" fill="white" class="bi bi-upload" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8zM5 4.854a.5.5 0 0 0 .707 0L8 2.56l2.293 2.293A.5.5 0 1 0 11 4.146L8.354 1.5a.5.5 0 0 0-.708 0L5 4.146a.5.5 0 0 0 0 .708z"/><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 2z"/></svg><?php _e('Upload category image', 'bootstrap'); ?></a>
            <a href="#" class="btn btn-danger btn-sm" id="cat-image-delete" data-placeholder-url="<?php echo $placeholder_url; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>
        </div>
    </div>
    <?php
}
add_action('category_add_form_fields', 'bootstrap_add_category_image_upload_form_fields_to_new_category', 10);

// First save event, when creating new tax
function bootstrap_add_category_image_upload_catch_first_save($term_id, $tt_id){
    if(isset( $_POST['cat-image-url']) && !empty($_POST['cat-image-url'])){
        $cat_image_url = sanitize_url($_POST['cat-image-url']);
        add_term_meta( $term_id, 'cat-image-url', $cat_image_url, true);
    }
}
add_action('created_category', 'bootstrap_add_category_image_upload_catch_first_save', 10, 2);

// Edit screen
function bootstrap_edit_category_image($term, $taxonomy){
    $placeholder_url = get_template_directory_uri() . '/components/images/Default-category-image.png';
    $cat_image_url = get_term_meta($term->term_id, 'cat-image-url', true);
    if(empty($cat_image_url)) {
        $cat_image_url = $placeholder_url;
    }
    ?><tr class="form-field term-image-upload-wrap">
        <th scope="row"><label for="cat-image-url"><?php _e('Category image', 'bootstrap'); ?></label></th>
        <td><div class="form-field cat-image-upload-wrap">
            <input type="hidden" name="cat-image-url" id="cat-image-url" value="<?php if(!empty($cat_image_url)) { echo $cat_image_url; } ?>">
            <div class="cat-image-preview-field">
                <img src="<?php echo $cat_image_url; ?>" class="backend-term-image" id="cat-image-preview" alt="Tax image frame">
            </div>
            <p class="mb-2"><?php _e('An image representing the category.','bootstrap'); ?></p>
            <div class="cat-image-controls">
                <a href="#" class="btn btn-primary btn-sm" id="cat-image-upload"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" style="margin-top: -3px; margin-right: 5px;" fill="white" class="bi bi-upload" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M.5 8a.5.5 0 0 1 .5.5V12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V8.5a.5.5 0 0 1 1 0V12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8.5A.5.5 0 0 1 .5 8zM5 4.854a.5.5 0 0 0 .707 0L8 2.56l2.293 2.293A.5.5 0 1 0 11 4.146L8.354 1.5a.5.5 0 0 0-.708 0L5 4.146a.5.5 0 0 0 0 .708z"/><path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0v-8A.5.5 0 0 1 8 2z"/></svg><?php _e('Category image upload', 'bootstrap'); ?></a>
                <a href="#" class="btn btn-danger btn-sm" id="delete-cat-image" data-placeholder-url="<?php echo $placeholder_url; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="white" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/><path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/></svg></a>
            </div>
            </div>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'bootstrap_edit_category_image', 10, 2);

// Update edit
function bootstrap_category_image_edit_image($term_id, $tt_id){
    if(isset($_POST['cat-image-url']) && !empty($_POST['cat-image-url'])) {
        $cat_image_url = $_POST['cat-image-url'];
        update_term_meta($term_id,'cat-image-url', $cat_image_url);
    } else if(isset($_POST['cat-image-url']) && empty($_POST['cat-image-url'])) {
        update_term_meta($term_id, 'cat-image-url', '');
    }
}
add_action('edited_category', 'bootstrap_category_image_edit_image', 10, 2);