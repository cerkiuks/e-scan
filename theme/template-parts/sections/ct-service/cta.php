<?php
/**
 * CT service registration CTA.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_cta_data();

if ( ! $data['title'] && ! $data['button_text'] ) {
	return;
}
?>

<section class="ct-service-cta" aria-label="<?php esc_attr_e( 'Registracija', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-cta__inner">
		<div class="ct-service-cta__copy">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="ct-service-cta__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] ) : ?>
				<h2 class="ct-service-cta__title"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>

			<?php if ( $data['description'] ) : ?>
				<p class="ct-service-cta__description"><?php echo esc_html( $data['description'] ); ?></p>
			<?php endif; ?>
		</div>

		<?php if ( $data['button_text'] && $data['button_url'] ) : ?>
			<a class="ct-service-cta__button" href="<?php echo esc_url( $data['button_url'] ); ?>">
				<?php echo esc_html( $data['button_text'] ); ?>
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
			</a>
		<?php endif; ?>
	</div>
</section>
