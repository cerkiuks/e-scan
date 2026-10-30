<?php
/**
 * Contact page hero.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_contact_page_hero_data();

if ( ! $data['title'] && ! $data['title_highlight'] && ! $data['description'] ) {
	return;
}
?>

<section class="contact-page-hero" aria-label="<?php esc_attr_e( 'Kontaktai', 'optimalu-e-scan' ); ?>">
	<div class="contact-page-hero__dots" aria-hidden="true">
		<?php for ( $i = 0; $i < 42; $i++ ) : ?>
			<span></span>
		<?php endfor; ?>
	</div>

	<div class="contact-page-hero__inner">
		<?php if ( $data['eyebrow'] ) : ?>
			<p class="contact-page-hero__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
		<?php endif; ?>

		<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
			<h1 class="contact-page-hero__title">
				<?php if ( $data['title'] ) : ?>
					<?php echo esc_html( $data['title'] ); ?>
				<?php endif; ?>
				<?php if ( $data['title_highlight'] ) : ?>
					<br>
					<em><?php echo esc_html( $data['title_highlight'] ); ?></em>
				<?php endif; ?>
			</h1>
		<?php endif; ?>

		<?php if ( $data['description'] ) : ?>
			<p class="contact-page-hero__description"><?php echo esc_html( $data['description'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
