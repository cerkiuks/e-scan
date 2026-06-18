<?php
/**
 * Specialists section template.
 *
 * @package optimalu-e-scan
 */

$args = isset( $args ) && is_array( $args ) ? $args : array();

if ( function_exists( 'optimalu_e_scan_is_about_page_template' ) && optimalu_e_scan_is_about_page_template() ) {
	$data = optimalu_e_scan_get_about_page_specialists_data();
} else {
	$data = optimalu_e_scan_get_specialists_section_data( optimalu_e_scan_resolve_section_post_id( $args ) );
}
?>

<section id="team" class="specialists" aria-label="<?php esc_attr_e( 'Specialists', 'optimalu-e-scan' ); ?>">
	<div class="specialists__inner">
		<header class="specialists__intro">
			<div class="specialists__intro-left">
				<?php if ( $data['eyebrow'] ) : ?>
					<p class="specialists__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<?php endif; ?>

				<?php if ( $data['heading'] ) : ?>
					<h2 class="specialists__title"><?php echo esc_html( $data['heading'] ); ?></h2>
				<?php endif; ?>
			</div>

			<?php if ( $data['description'] ) : ?>
				<div class="specialists__intro-right">
					<p class="specialists__description"><?php echo esc_html( $data['description'] ); ?></p>
				</div>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['specialists'] ) ) : ?>
			<?php
			$specialists_track_id   = wp_unique_id( 'specialists-track-' );
			$specialists_total      = count( $data['specialists'] );
			$specialists_total_text = sprintf( '%02d', $specialists_total );
			?>
			<div
				class="specialists__carousel"
				data-specialists-carousel
				data-specialists-total="<?php echo esc_attr( (string) $specialists_total ); ?>"
			>
				<div class="specialists__viewport">
					<div
						id="<?php echo esc_attr( $specialists_track_id ); ?>"
						class="specialists__track"
						tabindex="0"
						role="region"
						aria-label="<?php esc_attr_e( 'Specialists carousel', 'optimalu-e-scan' ); ?>"
					>
						<?php foreach ( $data['specialists'] as $index => $specialist ) : ?>
							<?php
							$card_index = sprintf( '%02d', $index + 1 );
							$has_link   = ! empty( $specialist['link_text'] ) && ! empty( $specialist['link_url'] );
							?>
							<article class="specialists__card">
								<div class="specialists__card-media">
									<?php if ( ! empty( $specialist['photo_url'] ) ) : ?>
										<img
											class="specialists__card-image"
											src="<?php echo esc_url( $specialist['photo_url'] ); ?>"
											alt="<?php echo esc_attr( $specialist['photo_alt'] ); ?>"
											loading="lazy"
											decoding="async"
											draggable="false"
										>
									<?php else : ?>
										<div class="specialists__card-placeholder" aria-hidden="true"></div>
									<?php endif; ?>
								</div>

								<div class="specialists__card-footer">
									<div class="specialists__card-copy">
										<?php if ( ! empty( $specialist['name'] ) ) : ?>
											<h3 class="specialists__card-name"><?php echo esc_html( $specialist['name'] ); ?></h3>
										<?php endif; ?>

										<?php if ( ! empty( $specialist['position'] ) ) : ?>
											<p class="specialists__card-position"><?php echo esc_html( $specialist['position'] ); ?></p>
										<?php endif; ?>

										<?php if ( ! empty( $specialist['desc'] ) ) : ?>
											<p class="specialists__card-desc"><?php echo esc_html( $specialist['desc'] ); ?></p>
										<?php endif; ?>

										<?php if ( $has_link ) : ?>
											<a class="specialists__card-link" href="<?php echo esc_url( $specialist['link_url'] ); ?>">
												<?php echo esc_html( $specialist['link_text'] ); ?>
												<svg class="specialists__card-link-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
													<path d="M5 12h14" />
													<path d="m12 5 7 7-7 7" />
												</svg>
											</a>
										<?php endif; ?>
									</div>

									<span class="specialists__card-index" aria-hidden="true"><?php echo esc_html( $card_index ); ?></span>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="specialists__controls">
					<button
						type="button"
						class="specialists__nav specialists__nav--prev"
						aria-label="<?php esc_attr_e( 'Previous specialist', 'optimalu-e-scan' ); ?>"
						aria-controls="<?php echo esc_attr( $specialists_track_id ); ?>"
						aria-disabled="true"
						disabled
					>
						<svg class="specialists__nav-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="m15 18-6-6 6-6" />
						</svg>
					</button>

					<p class="specialists__counter" data-specialists-counter aria-live="polite">
						<span class="specialists__counter-current">01</span>
						<span class="specialists__counter-separator" aria-hidden="true"> / </span>
						<span class="specialists__counter-total"><?php echo esc_html( $specialists_total_text ); ?></span>
					</p>

					<button
						type="button"
						class="specialists__nav specialists__nav--next"
						aria-label="<?php esc_attr_e( 'Next specialist', 'optimalu-e-scan' ); ?>"
						aria-controls="<?php echo esc_attr( $specialists_track_id ); ?>"
						aria-disabled="<?php echo $specialists_total > 1 ? 'false' : 'true'; ?>"
						<?php disabled( $specialists_total <= 1 ); ?>
					>
						<svg class="specialists__nav-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="m9 18 6-6-6-6" />
						</svg>
					</button>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $data['footer_link_text'] && $data['footer_link_url'] ) : ?>
			<div class="specialists__footer">
				<a class="specialists__footer-link" href="<?php echo esc_url( $data['footer_link_url'] ); ?>">
					<?php echo esc_html( $data['footer_link_text'] ); ?>
					<svg class="specialists__footer-link-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M5 12h14" />
						<path d="m12 5 7 7-7 7" />
					</svg>
				</a>
			</div>
		<?php endif; ?>
	</div>
</section>
