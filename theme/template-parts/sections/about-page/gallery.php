<?php
/**
 * About page photo gallery carousel.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_gallery_data();

if ( empty( $data['images'] ) ) {
	return;
}

$count     = count( $data['images'] );
$track_id  = 'about-page-gallery-track';
$show_nav  = $count > 1;
?>

<section class="about-page-gallery" aria-label="<?php esc_attr_e( 'Klinikos nuotraukos', 'optimalu-e-scan' ); ?>">
	<div class="about-page-gallery__inner">
		<div
			class="about-page-gallery__carousel<?php echo $show_nav ? '' : ' is-single'; ?>"
			data-about-gallery
			data-about-gallery-count="<?php echo esc_attr( (string) $count ); ?>"
		>
			<div class="about-page-gallery__viewport">
				<ul
					id="<?php echo esc_attr( $track_id ); ?>"
					class="about-page-gallery__track"
					tabindex="0"
				>
					<?php foreach ( $data['images'] as $index => $image ) : ?>
						<li class="about-page-gallery__slide">
							<figure class="about-page-gallery__figure">
								<?php
								echo wp_get_attachment_image(
									$image['id'],
									'large',
									false,
									array(
										'class'    => 'about-page-gallery__image',
										'alt'      => $image['alt'],
										'loading'  => $index < 3 ? 'eager' : 'lazy',
										'decoding' => 'async',
										'draggable' => 'false',
										'sizes'    => '(max-width: 767px) 86vw, 42vw',
									)
								);
								?>
							</figure>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>

			<?php if ( $show_nav ) : ?>
				<div class="about-page-gallery__controls">
					<button
						type="button"
						class="about-page-gallery__nav about-page-gallery__nav--prev"
						data-about-gallery-prev
						aria-label="<?php esc_attr_e( 'Ankstesnė nuotrauka', 'optimalu-e-scan' ); ?>"
						aria-controls="<?php echo esc_attr( $track_id ); ?>"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="m15 18-6-6 6-6" />
						</svg>
					</button>
					<button
						type="button"
						class="about-page-gallery__nav about-page-gallery__nav--next"
						data-about-gallery-next
						aria-label="<?php esc_attr_e( 'Kita nuotrauka', 'optimalu-e-scan' ); ?>"
						aria-controls="<?php echo esc_attr( $track_id ); ?>"
					>
						<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="m9 18 6-6-6-6" />
						</svg>
					</button>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
