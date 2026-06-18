<?php
/**
 * About page values section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_values_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="about-page-values" aria-label="<?php esc_attr_e( 'Our values', 'optimalu-e-scan' ); ?>">
	<div class="about-page-values__inner">
		<header class="about-page-values__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="about-page-values__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] ) : ?>
				<h2 class="about-page-values__title"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['items'] ) ) : ?>
			<div class="about-page-values__grid">
				<?php foreach ( $data['items'] as $item ) : ?>
					<article class="about-page-values__card">
						<?php if ( ! empty( $item['number'] ) ) : ?>
							<p class="about-page-values__number" aria-hidden="true"><?php echo esc_html( $item['number'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $item['title'] ) ) : ?>
							<h3 class="about-page-values__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>

						<?php if ( ! empty( $item['text'] ) ) : ?>
							<p class="about-page-values__card-text"><?php echo esc_html( $item['text'] ); ?></p>
						<?php endif; ?>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
