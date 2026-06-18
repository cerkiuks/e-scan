<?php
/**
 * About page statistics section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_stats_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="about-page-stats" aria-label="<?php esc_attr_e( 'Statistics', 'optimalu-e-scan' ); ?>">
	<div class="about-page-stats__inner">
		<header class="about-page-stats__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="about-page-stats__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] ) : ?>
				<h2 class="about-page-stats__title"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['items'] ) ) : ?>
			<div class="about-page-stats__grid">
				<?php foreach ( $data['items'] as $item ) : ?>
					<div class="about-page-stats__item">
						<?php if ( ! empty( $item['value'] ) ) : ?>
							<p class="about-page-stats__value"><?php echo esc_html( $item['value'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $item['label'] ) ) : ?>
							<p class="about-page-stats__label"><?php echo esc_html( $item['label'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $item['text'] ) ) : ?>
							<p class="about-page-stats__text"><?php echo esc_html( $item['text'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
