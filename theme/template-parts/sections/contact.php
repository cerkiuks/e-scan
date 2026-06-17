<?php
/**
 * Contact / location section template.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_contact_section_data();
?>

<section id="contact" class="contact" aria-label="<?php esc_attr_e( 'Contact and location', 'optimalu-e-scan' ); ?>">
	<div class="contact__layout">
		<?php if ( $data['map_markup'] ) : ?>
			<div class="contact__map" aria-hidden="false">
				<?php echo $data['map_markup']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- sanitized iframe markup. ?>
			</div>
		<?php endif; ?>

		<div class="contact__panel">
			<div class="contact__panel-inner">
				<?php if ( $data['eyebrow'] ) : ?>
					<p class="contact__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<?php endif; ?>

				<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
					<h2 class="contact__title">
						<?php if ( $data['title'] ) : ?>
							<?php echo esc_html( $data['title'] ); ?>
						<?php endif; ?>
						<?php if ( $data['title_highlight'] ) : ?>
							<br>
							<span class="contact__title-highlight"><?php echo esc_html( $data['title_highlight'] ); ?></span>
						<?php endif; ?>
					</h2>
				<?php endif; ?>

				<ul class="contact__list">
					<?php if ( ! empty( $data['address_lines'] ) ) : ?>
						<li class="contact__item">
							<span class="contact__icon" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
									<circle cx="12" cy="10" r="3" />
								</svg>
							</span>
							<div class="contact__item-body">
								<?php if ( $data['address_label'] ) : ?>
									<p class="contact__item-label"><?php echo esc_html( $data['address_label'] ); ?></p>
								<?php endif; ?>
								<?php foreach ( $data['address_lines'] as $line_index => $line ) : ?>
									<p class="contact__item-value<?php echo $line_index > 0 ? ' contact__item-value--muted' : ''; ?>"><?php echo esc_html( $line ); ?></p>
								<?php endforeach; ?>
							</div>
						</li>
					<?php endif; ?>

					<?php if ( $data['phone'] ) : ?>
						<li class="contact__item">
							<span class="contact__icon" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
								</svg>
							</span>
							<div class="contact__item-body">
								<?php if ( $data['phone_label'] ) : ?>
									<p class="contact__item-label"><?php echo esc_html( $data['phone_label'] ); ?></p>
								<?php endif; ?>
								<a class="contact__item-link" href="<?php echo esc_url( 'tel:' . $data['phone_href'] ); ?>"><?php echo esc_html( $data['phone'] ); ?></a>
							</div>
						</li>
					<?php endif; ?>

					<?php if ( $data['email'] ) : ?>
						<li class="contact__item">
							<span class="contact__icon" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
									<rect x="2" y="4" width="20" height="16" rx="2" />
								</svg>
							</span>
							<div class="contact__item-body">
								<?php if ( $data['email_label'] ) : ?>
									<p class="contact__item-label"><?php echo esc_html( $data['email_label'] ); ?></p>
								<?php endif; ?>
								<a class="contact__item-link" href="<?php echo esc_url( 'mailto:' . $data['email'] ); ?>"><?php echo esc_html( $data['email'] ); ?></a>
							</div>
						</li>
					<?php endif; ?>

					<?php if ( $data['hours_main'] || $data['hours_secondary'] ) : ?>
						<li class="contact__item">
							<span class="contact__icon" aria-hidden="true">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
									<path d="M12 6v6l4 2" />
									<circle cx="12" cy="12" r="10" />
								</svg>
							</span>
							<div class="contact__item-body">
								<?php if ( $data['hours_label'] ) : ?>
									<p class="contact__item-label"><?php echo esc_html( $data['hours_label'] ); ?></p>
								<?php endif; ?>
								<?php if ( $data['hours_main'] ) : ?>
									<p class="contact__item-value"><?php echo esc_html( $data['hours_main'] ); ?></p>
								<?php endif; ?>
								<?php if ( $data['hours_secondary'] ) : ?>
									<p class="contact__item-value contact__item-value--muted"><?php echo esc_html( $data['hours_secondary'] ); ?></p>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
				</ul>

				<?php if ( $data['cta_text'] && $data['cta_url'] ) : ?>
					<a class="contact__cta" href="<?php echo esc_url( $data['cta_url'] ); ?>">
						<?php echo esc_html( $data['cta_text'] ); ?>
						<svg class="contact__cta-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M5 12h14" />
							<path d="m12 5 7 7-7 7" />
						</svg>
					</a>
				<?php endif; ?>

				<?php if ( $data['secondary_link_text'] && $data['secondary_link_url'] ) : ?>
					<a class="contact__secondary-link" href="<?php echo esc_url( $data['secondary_link_url'] ); ?>">
						<?php echo esc_html( $data['secondary_link_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
