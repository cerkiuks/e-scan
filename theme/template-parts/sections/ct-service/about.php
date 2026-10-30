<?php
/**
 * CT service about section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_about_data();

if ( ! $data['title'] && empty( $data['paragraphs'] ) ) {
	return;
}
?>

<section id="apie-tyrima" class="ct-service-about" aria-label="<?php esc_attr_e( 'Apie tyrimą', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-about__copy">
		<?php if ( $data['eyebrow'] ) : ?>
			<p class="ct-service-kicker"><?php echo esc_html( $data['eyebrow'] ); ?></p>
		<?php endif; ?>

		<?php if ( $data['title'] ) : ?>
			<h2 class="ct-service-heading"><?php echo esc_html( $data['title'] ); ?></h2>
		<?php endif; ?>

		<?php foreach ( $data['paragraphs'] as $index => $paragraph ) : ?>
			<?php if ( 2 === $index ) : ?>
				<div class="ct-service-about__note">
					<p><?php echo esc_html( $paragraph ); ?></p>
				</div>
			<?php else : ?>
				<p class="ct-service-about__text"><?php echo esc_html( $paragraph ); ?></p>
			<?php endif; ?>
		<?php endforeach; ?>
	</div>
</section>
