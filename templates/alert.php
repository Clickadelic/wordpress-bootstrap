<?php do_action('before_alert_render'); ?>	
<div class="alert alert-dismissible" id="bootstrap-alert-message" role="alert">
	<div class="<?php echo esc_attr(get_theme_mod('alert_width', 'container-md')); ?>")>
		<div class="row">
			<div class="col">
				<div class="alert-content">
					<button type="button" class="close" data-bs-dismiss="alert" aria-label="<?php _e('Close', 'bootstrap'); ?>"><span aria-hidden="true">&times;</span></button>
					<p class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg><?php echo $alert_text; ?>&nbsp;<?php echo '<a href="'.$alert_link_url.'" class="alert-link" target="'.$alert_link_target.'">'.$alert_link_text.'</a>'; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php do_action('after_alert_render'); ?>
