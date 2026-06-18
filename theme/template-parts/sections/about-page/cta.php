<?php
/**
 * About page CTA section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_cta_data();

if ( ! $data['title'] && ! $data['primary_text'] ) {
	return;
}
?>

<section class="about-page-cta" aria-label="<?php esc_attr_e( 'Contact call to action', 'optimalu-e-scan' ); ?>">
	<div class="about-page-cta__inner">
		<?php if ( $data['eyebrow'] ) : ?>
			<p class="about-page-cta__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
		<?php endif; ?>

		<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
			<h2 class="about-page-cta__title">
				<?php if ( $data['title'] ) : ?>
					<?php echo esc_html( $data['title'] ); ?>
				<?php endif; ?>
				<?php if ( $data['title_highlight'] ) : ?>
					<span class="about-page-cta__title-highlight"><?php echo esc_html( $data['title_highlight'] ); ?></span>
				<?php endif; ?>
			</h2>
		<?php endif; ?>

		<?php if ( ( $data['primary_text'] && $data['primary_url'] ) || ( $data['secondary_text'] && $data['secondary_url'] ) ) : ?>
			<div class="about-page-cta__actions">
				<?php if ( $data['primary_text'] && $data['primary_url'] ) : ?>
					<a class="about-page-cta__button about-page-cta__button--primary" href="<?php echo esc_url( $data['primary_url'] ); ?>">
						<?php echo esc_html( $data['primary_text'] ); ?>
					</a>
				<?php endif; ?>

				<?php if ( $data['secondary_text'] && $data['secondary_url'] ) : ?>
					<a class="about-page-cta__button about-page-cta__button--secondary" href="<?php echo esc_url( $data['secondary_url'] ); ?>">
						<?php echo esc_html( $data['secondary_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
