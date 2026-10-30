<?php
/**
 * CT service gallery.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_gallery_data();

if ( empty( $data['items'] ) ) {
	return;
}
?>

<section class="ct-service-gallery" aria-label="<?php esc_attr_e( 'Nuotraukų galerija', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-gallery__inner">
		<?php foreach ( $data['items'] as $item ) : ?>
			<figure class="ct-service-gallery__figure">
				<?php if ( ! empty( $item['id'] ) ) : ?>
					<?php
					echo wp_get_attachment_image(
						$item['id'],
						'large',
						false,
						array(
							'class' => 'ct-service-gallery__image',
							'alt'   => $item['alt'],
						)
					);
					?>
				<?php else : ?>
					<img class="ct-service-gallery__image" src="<?php echo esc_url( $item['url'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>" />
				<?php endif; ?>
			</figure>
		<?php endforeach; ?>
	</div>
</section>
