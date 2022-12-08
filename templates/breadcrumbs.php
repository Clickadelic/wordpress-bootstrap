<?php do_action('before_breadcrumb_render'); ?>
<?php if(!is_front_page() && function_exists('bcn_display')) : ?>
<div class="wrap-breadcrumbs">
	<div class="container-md">
		<div class="row">
			<div class="col col-xs-hidden">
				<div class="breadcrumbs">
					<span id="you-are-here"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="margin-top: -3px;" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16"><path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/></svg></span>
					<?php bcn_display(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
<?php do_action('after_breadcrumb_render'); ?>