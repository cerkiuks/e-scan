<?php
/**
 * About page timeline section.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_about_page_timeline_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="about-page-timeline" aria-label="<?php esc_attr_e( 'Timeline', 'optimalu-e-scan' ); ?>">
	<div class="about-page-timeline__inner">
		<header class="about-page-timeline__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="about-page-timeline__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] ) : ?>
				<h2 class="about-page-timeline__title"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['items'] ) ) : ?>
			<ol class="about-page-timeline__list">
				<?php foreach ( $data['items'] as $item ) : ?>
					<li class="about-page-timeline__item">
						<?php if ( ! empty( $item['year'] ) ) : ?>
							<p class="about-page-timeline__year"><?php echo esc_html( $item['year'] ); ?></p>
						<?php endif; ?>

						<div class="about-page-timeline__body">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3 class="about-page-timeline__item-title"><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>

							<?php if ( ! empty( $item['text'] ) ) : ?>
								<p class="about-page-timeline__item-text"><?php echo esc_html( $item['text'] ); ?></p>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
	</div>
</section>
