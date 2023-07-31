<?php

if(have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<?php $format = get_post_format(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class($format); ?>>
			<?php

			// Frontpage
			if(is_front_page()) {
				$page_modus = get_option('show_on_front');
				if($page_modus == 'page') {
					get_template_part('templates/loops/loop-front-page');
				} else if($page_modus == 'posts') {
					get_template_part('templates/loops/loop-archive');
				}

			// Normal Page
			} elseif(is_page()) {
				get_template_part('templates/loops/loop-page');
				// Comment list
				if ( comments_open() || get_comments_number() ) {
					comments_template('/comments.php');
				}
				// Get Commenty Reply Script
				if ( is_singular()){
					wp_enqueue_script('comment-reply');
				}
			// Category, Tags
			} elseif(is_category() || is_tag()) {
				get_template_part('templates/loops/loop-archive');

			// Home, Archive
			} elseif(is_home() || is_archive()) {
				get_template_part('templates/loops/loop-archive');

			// Search Result Page
			} elseif(is_search()) {
				get_template_part('templates/loops/loop-archive');

			// Single Blog Post
			} elseif(is_single()) {
				get_template_part('templates/loops/loop-single');
				$post_suggestions = get_theme_option('post_suggestions');
				if($post_suggestions == 'on'){
					get_template_part('templates/post-suggestions');
				}
				// Comment list
				if ( comments_open() || get_comments_number() ) {
					comments_template('/comments.php');
				}
				// Get Comment Reply Script
				if ( is_singular()){
					wp_enqueue_script('comment-reply');
				}
			} else {
				get_template_part('templates/loops/loop-page');
			}

			?>
		</article>
	<?php endwhile; ?>
<?php endif; ?>