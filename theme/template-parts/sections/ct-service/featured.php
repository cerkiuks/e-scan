<?php
/**
 * CT service featured image.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_featured_data();

if ( ! $data['image_url'] && ! $data['badge_text'] ) {
	return;
}
?>

<section class="ct-service-featured" aria-label="<?php esc_attr_e( 'Tyrimo iliustracija', 'optimalu-e-scan' ); ?>">
	<?php if ( $data['image_url'] ) : ?>
		<figure class="ct-service-featured__figure">
			<?php if ( $data['image_id'] ) : ?>
				<?php
				echo wp_get_attachment_image(
					$data['image_id'],
					'full',
					false,
					array(
						'class' => 'ct-service-featured__image',
						'alt'   => $data['image_alt'],
					)
				);
				?>
			<?php else : ?>
				<img class="ct-service-featured__image" src="<?php echo esc_url( $data['image_url'] ); ?>" alt="<?php echo esc_attr( $data['image_alt'] ); ?>" />
			<?php endif; ?>
		</figure>
	<?php endif; ?>

	<?php if ( $data['badge_eyebrow'] || $data['badge_text'] ) : ?>
		<div class="ct-service-featured__badge">
			<?php if ( $data['badge_eyebrow'] ) : ?>
				<p class="ct-service-featured__badge-eyebrow"><?php echo esc_html( $data['badge_eyebrow'] ); ?></p>
			<?php endif; ?>
			<?php if ( $data['badge_text'] ) : ?>
				<p class="ct-service-featured__badge-text"><?php echo esc_html( $data['badge_text'] ); ?></p>
			<?php endif; ?>
		</div>
	<?php endif; ?>
</section>
