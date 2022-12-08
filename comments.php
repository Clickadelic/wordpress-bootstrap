<?php if ( $have_comments = have_comments() ) : ?>
    <div class="row row-comments-head" id="comments">
        <div class="comments-title col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3><?php _e('Comments to', 'bootstrap'); ?>: <?php the_title() ?></h3>
        </div>
    </div>

    <?php // If the comments are paginated include the Bootstrap HTML, otherwise just spit out the comments
    $comments_limit = get_option('comments_per_page');
    $comments_total = get_comments_number(get_the_ID());
    if ( $comments_total < $comments_limit ) : ?>
        <div class="row row-comments">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comments-nav-holder">
                <div class="top-holder">
                    <?php paginate_comments_links(); ?>
                </div>
            </div>
        </div>
        <?php
        // Custom layout > theme-functions.php
        wp_list_comments('callback=custom_comment_layout'); ?>
        <div class="row row-comments">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comments-nav-holder">
                <div class="bottom-holder">
                    <?php paginate_comments_links(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>
<div class="row row-comment-reply">
    <div class="comment-reply-holder col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <?php comment_form(
        array( 
            'logged_in_as' => '<p class="logged-in-as">'. sprintf( __('Logged in as', 'bootstrap').' %1$s. <span class="logout-link"> | <a href="%2$s">'.__( 'Log out', 'bootstrap' ).'</a></span>', $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink()))).'</p>'
            )
        ); ?>
    </div>
</div>