<div class="row">
    <div class="col-md-12 col-lg-4">
        <?php if(has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" class="link-to-post has-thumbnail" title="<?php the_title(); ?>">
                <?php echo get_the_post_thumbnail( get_the_ID() , 'preview-thumbnail', array( 'class' => 'img-fluid img-thumbnail' ) ); ?>
            </a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>" class="link-to-post has-thumbnail" title="<?php the_title(); ?>">
            <?php
                $terms = get_the_terms($post->ID, 'category');
                $cat_term = $terms[0]->term_id;
                $cat_image_url = get_term_meta( $cat_term, 'cat-image-url', true );
                echo '<img src="'.$cat_image_url.'" class="img-fluid category-image" alt="'.__('Category image of ' . $terms[0]->name, 'bootstrap').'">';
                ?>
            </a>
        <?php endif; ?>
    </div>
    <div class="col-lg-8">
        <div class="row">
            <div class="col">
                <h2 class="posttitle">
                    <a href="<?php the_permalink(); ?>" class="title-link" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <span class="in-cats"><?php _e('Category', 'bootstrap'); ?>:</span><?php the_category(); ?>
            </div>
            <div class="col-lg-4 wrap-date">
                <h3 class="date"><?php the_date(); ?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php echo excerpt(32); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 wrap-comments-count">
                <a href="<?php echo get_comments_link($post->ID); ?>" class="comments-count">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v11.586l2-2A2 2 0 0 1 4.414 11H14a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/><path fill-rule="evenodd" d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/></svg>
                    <?php echo theme_comment_logic(); ?>
                </a>
            </div>
            <div class="col-lg-6 wrap-author">
                <span class="posted-by"><?php _e('posted by', 'bootstrap'); ?></span>
                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta('user_nicename')); ?>" class="comment-author">
                    <span class="the-author" id="author-id-<?php the_author(); ?>">
                        <?php the_author(); ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8 wrap-tags">
        <?php the_tags('<ul class="taglist"><li>', '</li><li>', '</li></ul>'); ?>
    </div>
    <div class="col-lg-4 wrap-permalink">
        <a href="<?php the_permalink(); ?>" class="the-permalink" title="<?php _e('Continue to article', 'bootstrap');?>&nbsp;<?php the_title(); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/><path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/></svg>
            <?php _e('Continue to article', 'bootstrap') ?>
        </a>
    </div>
</div>
