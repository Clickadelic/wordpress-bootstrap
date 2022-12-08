<?php get_header(); ?>
<div class="wrap-content">
	<div class="container-md">
		<div class="row">
			<main class="col-md-9">
				<div class="row">
					<div class="col">
						<h2 class="content-title"><?php _e('About the author', 'bootstrap'); ?></h2>
					</div>
				</div>
				<?php do_action('before_author_card_render'); ?>
				<div class="row">
					<div class="col-md-6 offset-md-3 mt-3 mb-3">
						<div class="card card-cascade wider card-author">
							<div class="view view-cascade overlay">
								<img class="card-img-top" src="<?php if (get_theme_mod('author_card_background')) : echo get_theme_mod( 'author_card_background'); else: echo get_template_directory_uri().'/components/images/Author-Background-Image.jpg'; endif; ?>" alt="<?php _e('Author Card Background', 'bootstrap'); ?>">
								<a href="#">
									<div class="mask rgba-white-slight"></div>
								</a>
							</div>
							<div class="card-body card-body-cascade text-center">
								<div class="avatar-box">
									<?php
                                    $avatar = get_avatar(get_the_author_meta('ID'), 120);
                                    echo $avatar;
                                    ?>
								</div>
                                <h3 class="card-title"><strong><?php echo get_the_author_meta('first_name'); ?>&nbsp;<?php echo get_the_author_meta('last_name'); ?></strong></h3>
								<h4 class="card-title"><strong><?php echo get_the_author_meta('nickname'); ?></strong></h4>
								<p class="card-text"><?php echo get_the_author_meta('description'); ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 offset-md-3 text-center">
						<a href="<?php echo get_post_type_archive_link('post'); ?>" class="btn btn-lg btn-back-to-stream"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-chevron-double-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8.354 1.646a.5.5 0 0 1 0 .708L2.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/><path fill-rule="evenodd" d="M12.354 1.646a.5.5 0 0 1 0 .708L6.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg><?php _e('Back', 'bootstrap'); ?></a>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<h3 class="author-name-title"><?php _e('Posts by', 'bootstrap'); ?><span class="author-name"><?php the_author() ; ?></span></h3>
					</div>
				</div>
				<?php do_action('after_author_card_render'); ?>
				<div class="row">
					<div class="col">
						<?php
							$args = array(
								'author'        =>  get_the_author_meta('ID'),
								'orderby'       =>  'post_date',
								'order'         =>  'ASC'
							);
							$the_query = new WP_Query( $args );

							// The Loop
							if ( $the_query->have_posts() ) {
							    echo '<ul class="list-unstyled posts-listed-by-author">';
							        // echo '<li><a href="'.get_the_permalink().'" title="' . get_the_title() . '" target="_self"><i class="lni-angle-double-right"></i>' . get_the_title() . '</a>, '.__('posted on','bootstrap').'<span class="date-posted-on">'. get_the_date().'</span></li>';
							        get_template_part('the-loop');
									the_posts_pagination(array(
										'prev_text' => __('back', 'bootstrap'),
										'next_text' => __('forward', 'bootstrap')
									));
							    echo '</ul>';
							} else {
							    echo '<div class="alert alert-warning" role="alert">';
							    	echo '<p class="mb-0">'.__('Sorry, this author hasn\'t posted any content yet','bootstrap').'</p>';
							    echo '</div>';
							}
							/* Restore original Post Data */
							wp_reset_postdata();
						?>
					</div>
				</div>
			</main>
			<?php manage_right_sidebar(); ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
