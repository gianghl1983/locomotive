<?php
/**
 * Admin dashbaord template file.
 *
 * @package Batch_processing/Admin
 */

?>
<div class="wrap">
	<h2><?php esc_html_e( get_admin_page_title() ); ?></h2>
	
	<form class="batch-processing-form" method="post">
		<ul class="batch-processes">
			<?php
			if ( empty( $registered_batches ) ) :
				echo wp_kses_post( __( 'No batches registered. Check out the <a href="https://github.com/reaktivstudios/batch-processing">GitHub Repo</a> for info on how to register one.' ) );
			else :
				foreach ( $registered_batches as $slug => $batch ) : ?>
					<li>
						<input type="radio" id="<?php echo esc_attr( $slug ); ?>" name="batch_process" class="batch-process-option" value="<?php echo esc_attr( $slug ); ?>">
						<label for="<?php echo esc_attr( $slug ); ?>">
							<?php echo esc_html( $batch['name'] ); ?>
							<small>
								last run:
								<?php if ( ! empty( $batch['last_run'] ) ) { ?>
									<?php echo esc_html( Batch_Process\time_ago( $batch['last_run'] ) ); ?>
								<?php } else { ?>
									never
								<?php } ?>
							</small>
						</label>
					</li>
				<?php endforeach;

				submit_button( 'Run Batch Process' );
			endif; ?>
		</ul>
	</form>
</div>

<div class="batch-processing-overlay">
	<div class="close">close</div>
	<div class="batch-overlay__inner"></div>
</div><!-- .batch-processing-overlay -->

<script type="text/html" id="tmpl-batch-processing-results">	
	<h2>{{ data.status }}: {{ data.batch }}</h2>
	<div class="batch-progress" data-progress="{{ data.progress }}">
		Progress: {{ data.progress }}%
	</div>
</script>
