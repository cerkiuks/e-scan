<?php
/**
 * CT service FAQ accordion.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_faq_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="ct-service-faq" aria-label="<?php esc_attr_e( 'Dažniausiai užduodami klausimai', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-faq__inner">
		<header class="ct-service-faq__intro">
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
			<div class="ct-service-faq__list">
				<?php foreach ( $data['items'] as $index => $item ) : ?>
					<?php
					$faq_id      = 'ct-faq-' . (int) get_the_ID() . '-' . ( $index + 1 );
					$button_id   = $faq_id . '-button';
					$panel_id    = $faq_id . '-panel';
					$question    = ! empty( $item['question'] ) ? $item['question'] : '';
					$answer      = ! empty( $item['answer'] ) ? $item['answer'] : '';
					?>
					<?php if ( $question ) : ?>
						<div class="ct-service-faq__item">
							<h3 class="ct-service-faq__question">
								<button
									type="button"
									class="ct-service-faq__toggle"
									id="<?php echo esc_attr( $button_id ); ?>"
									aria-expanded="false"
									aria-controls="<?php echo esc_attr( $panel_id ); ?>"
								>
									<span><?php echo esc_html( $question ); ?></span>
									<svg class="ct-service-faq__icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m6 9 6 6 6-6" /></svg>
								</button>
							</h3>
							<div
								class="ct-service-faq__panel"
								id="<?php echo esc_attr( $panel_id ); ?>"
								role="region"
								aria-labelledby="<?php echo esc_attr( $button_id ); ?>"
								hidden
							>
								<?php if ( $answer ) : ?>
									<p><?php echo esc_html( $answer ); ?></p>
								<?php endif; ?>
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
