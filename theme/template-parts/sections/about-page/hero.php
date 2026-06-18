<?php
/**
 * About page hero section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_hero_data();

if ( ! $data['title'] && ! $data['description'] && ! $data['eyebrow'] ) {
	return;
}
?>

<section class="about-page-hero" aria-label="<?php esc_attr_e( 'About page hero', 'optimalu-e-scan' ); ?>">
	<div class="about-page-hero__background" aria-hidden="true"></div>
	<div class="about-page-hero__inner">
		<?php if ( $data['eyebrow'] ) : ?>
			<p class="about-page-hero__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
		<?php endif; ?>

		<?php if ( $data['title'] ) : ?>
			<h1 class="about-page-hero__title"><?php echo esc_html( $data['title'] ); ?></h1>
		<?php endif; ?>

		<?php if ( $data['description'] ) : ?>
			<p class="about-page-hero__description"><?php echo esc_html( $data['description'] ); ?></p>
		<?php endif; ?>
	</div>
</section>
