<div class="row">
	<div class="col">
		<h2 class="content-title"><?php the_title(); ?></h2>
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
		<?php the_content(); ?>
	</div>
</div>
<div class="row">
	<div class="col-md-8 wrap-tags">
		<?php the_tags('<ul class="taglist"><li>', '</li><li>', '</li></ul>'); ?>
	</div>
    <div class="col-md-4 wrap-author">
        <span class="posted-by"><?php _e('posted by', 'bootstrap'); ?></span><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta('user_nicename')); ?>" class="comment-author"><span class="the-author" id="author-id-<?php the_author(); ?>"><?php the_author(); ?></a>
    </div>
</div>
<div class="row">
	<div class="col">
		<?php wp_link_pages('before=<div id="page-links">&after=</div>'); ?>
	</div>
</div>