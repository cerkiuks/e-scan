<?php
/**
 * About page history section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_history_data();

if ( ! $data['title'] && ! $data['paragraph_1'] && ! $data['highlight_value'] ) {
	return;
}
?>

<section class="about-page-history" aria-label="<?php esc_attr_e( 'Our history', 'optimalu-e-scan' ); ?>">
	<div class="about-page-history__inner">
		<div class="about-page-history__grid">
			<div class="about-page-history__content">
				<?php if ( $data['eyebrow'] ) : ?>
					<p class="about-page-history__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
				<?php endif; ?>

				<?php if ( $data['title'] ) : ?>
					<h2 class="about-page-history__title"><?php echo wp_kses_post( $data['title'] ); ?></h2>
				<?php endif; ?>

				<?php if ( $data['paragraph_1'] ) : ?>
					<p class="about-page-history__text"><?php echo esc_html( $data['paragraph_1'] ); ?></p>
				<?php endif; ?>

				<?php if ( $data['paragraph_2'] ) : ?>
					<p class="about-page-history__text"><?php echo esc_html( $data['paragraph_2'] ); ?></p>
				<?php endif; ?>

				<?php if ( $data['paragraph_3'] ) : ?>
					<p class="about-page-history__text"><?php echo esc_html( $data['paragraph_3'] ); ?></p>
				<?php endif; ?>
			</div>

			<aside class="about-page-history__aside">
				<?php if ( $data['image_url'] ) : ?>
					<figure class="about-page-history__figure">
						<img
							class="about-page-history__image"
							src="<?php echo esc_url( $data['image_url'] ); ?>"
							alt="<?php echo esc_attr( $data['image_alt'] ); ?>"
							loading="lazy"
							decoding="async"
							draggable="false"
						>
						<?php if ( $data['image_caption'] ) : ?>
							<figcaption class="about-page-history__caption"><?php echo esc_html( $data['image_caption'] ); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>

				<?php if ( $data['highlight_label'] || $data['highlight_value'] ) : ?>
					<div class="about-page-history__highlight">
						<?php if ( $data['highlight_label'] ) : ?>
							<p class="about-page-history__highlight-label"><?php echo esc_html( $data['highlight_label'] ); ?></p>
						<?php endif; ?>
						<?php if ( $data['highlight_value'] ) : ?>
							<p class="about-page-history__highlight-value"><?php echo esc_html( $data['highlight_value'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</section>
