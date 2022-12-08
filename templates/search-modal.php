<div class="modal" id="the-search-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<?php do_action('before_search_modal_inner'); ?>
					<div class="search-modal-inner">
						<?php echo do_shortcode('[wpdreams_ajaxsearchlite]'); ?>
					</div>
				<?php do_action('after_search_modal_inner'); ?>
			</div>
		</div>
	</div>
</div>