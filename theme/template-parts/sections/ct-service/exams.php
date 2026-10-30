<?php
/**
 * CT service examinations list.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_exams_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="ct-service-exams" aria-label="<?php esc_attr_e( 'Atliekami tyrimai', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-exams__inner">
		<header class="ct-service-exams__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="ct-service-kicker"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>
			<?php if ( $data['title'] ) : ?>
				<h2 class="ct-service-heading"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>
			<?php if ( $data['intro'] ) : ?>
				<p class="ct-service-lede"><?php echo esc_html( $data['intro'] ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['items'] ) ) : ?>
			<ol class="ct-service-exams__list">
				<?php foreach ( $data['items'] as $index => $item ) : ?>
					<li class="ct-service-exams__item">
						<span class="ct-service-exams__number" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<div class="ct-service-exams__body">
							<?php if ( ! empty( $item['title'] ) ) : ?>
								<h3 class="ct-service-exams__title"><?php echo esc_html( $item['title'] ); ?></h3>
							<?php endif; ?>
							<?php if ( ! empty( $item['text'] ) ) : ?>
								<p class="ct-service-exams__text"><?php echo esc_html( $item['text'] ); ?></p>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
	</div>
</section>
