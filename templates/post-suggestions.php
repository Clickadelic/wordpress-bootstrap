<?php do_action('before_suggestions_render'); ?>
<?php
// Limit set manually for the bootstrap logic
$category_limit = 4;
$category = get_the_category();
$number_of_posts = $category[0]->category_count;

global $post;
$tags = wp_get_post_tags($post->ID);

if ($tags) {
	$tag_ids = array();
	foreach($tags as $individual_tag) {
		$tag_ids[] = $individual_tag->term_id;
	}
	$args = array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> 3, // Number of related posts to display.
			);
 
	$my_query = new wp_query( $args );

	if( $number_of_posts >= $category_limit && $my_query->have_posts() ) : ?>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="wrap-suggestions-title">
					<h3><?php _e('Maybe you are interested in the following topics', 'bootstrap'); ?></h3>
				</div>
			</div>
		</div>

		<div class="row">
			<?php
                while( $my_query->have_posts() ) {
                    $my_query->the_post();
                ?>
                    <div class="col-xs-12 col-sm-4">
                        <div class="single-post-suggestion">
                        	<a href="<?php the_permalink(); ?>" class="suggested-post-image" title="<?php the_title(); ?>">
                            	<img class="img-thumbnail" src="<?php the_post_thumbnail_url('thumbnail'); ?>" />
                            </a>
                            <h3><a href="<?php the_permalink(); ?>" class="suggested-post-title">
                                <?php the_title(); ?>
                            </a></h3>
                            <p><?php echo excerpt(25); ?></p>
                            <a href="<?php the_permalink(); ?>" class="suggested-post-link"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z"/><path fill-rule="evenodd" d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z"/></svg><?php _e('Continue to article', 'bootstrap'); ?></a>
                        </div>
                    </div>
                <?php } ?>
		</div>

	<?php
	endif;

}
wp_reset_postdata();
do_action('after_suggestions_render'); ?>