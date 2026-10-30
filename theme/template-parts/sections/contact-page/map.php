<?php
/**
 * Contact page map and contact panel.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_contact_page_map_data();

if ( ! $data['map_markup'] && ! $data['items'] && ! $data['title'] && ! $data['title_highlight'] ) {
	return;
}

$icons = array(
	'address' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>',
	'phone'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384"/></svg>',
	'email'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>',
	'hours'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6l4 2"/><circle cx="12" cy="12" r="10"/></svg>',
	'other'   => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/></svg>',
);
?>

<section class="contact-page-map" aria-label="<?php esc_attr_e( 'Kontaktai ir lokacija', 'optimalu-e-scan' ); ?>">
	<div class="contact-page-map__layout">
		<?php if ( $data['map_markup'] ) : ?>
			<div class="contact-page-map__canvas">
				<?php echo $data['map_markup']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- sanitized iframe markup. ?>
			</div>
		<?php endif; ?>

		<div class="contact-page-map__panel">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="contact-page-map__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
				<h2 class="contact-page-map__title">
					<?php if ( $data['title'] ) : ?>
						<?php echo esc_html( $data['title'] ); ?>
					<?php endif; ?>
					<?php if ( $data['title_highlight'] ) : ?>
						<br>
						<em><?php echo esc_html( $data['title_highlight'] ); ?></em>
					<?php endif; ?>
				</h2>
			<?php endif; ?>

			<?php if ( $data['items'] ) : ?>
				<ul class="contact-page-map__list">
					<?php foreach ( $data['items'] as $item ) : ?>
						<?php
						$icon = isset( $icons[ $item['type'] ] ) ? $icons[ $item['type'] ] : $icons['other'];
						$href = $item['href'];
						?>
						<li class="contact-page-map__item">
							<span class="contact-page-map__icon" aria-hidden="true">
								<?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG markup. ?>
							</span>
							<div class="contact-page-map__item-body">
								<?php if ( $item['label'] ) : ?>
									<p class="contact-page-map__item-label"><?php echo esc_html( $item['label'] ); ?></p>
								<?php endif; ?>
								<?php if ( $item['primary'] ) : ?>
									<?php if ( $href ) : ?>
										<a class="contact-page-map__item-link" href="<?php echo esc_url( $href ); ?>"<?php echo ( 0 === strpos( $href, 'http' ) ) ? ' target="_blank" rel="noopener noreferrer"' : ''; ?>>
											<?php echo esc_html( $item['primary'] ); ?>
										</a>
									<?php else : ?>
										<p class="contact-page-map__item-value"><?php echo esc_html( $item['primary'] ); ?></p>
									<?php endif; ?>
								<?php endif; ?>
								<?php if ( $item['secondary'] ) : ?>
									<p class="contact-page-map__item-secondary"><?php echo esc_html( $item['secondary'] ); ?></p>
								<?php endif; ?>
							</div>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</section>
