<?php
/**
 * CT service preparation.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_preparation_data();

if ( empty( $data['items'] ) && empty( $data['highlight'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="ct-service-prep" aria-label="<?php esc_attr_e( 'Pasiruošimas tyrimui', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-prep__inner">
		<header class="ct-service-prep__intro">
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

		<div class="ct-service-prep__content">
			<?php if ( ! empty( $data['items'] ) ) : ?>
				<div class="ct-service-prep__grid">
					<?php foreach ( $data['items'] as $item ) : ?>
						<article class="ct-service-prep__card">
							<div class="ct-service-prep__card-heading">
								<span class="ct-service-prep__card-icon" aria-hidden="true">
									<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5" /></svg>
								</span>
								<?php if ( ! empty( $item['title'] ) ) : ?>
									<h3 class="ct-service-prep__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
								<?php endif; ?>
							</div>
							<?php if ( ! empty( $item['text'] ) ) : ?>
								<p class="ct-service-prep__card-text"><?php echo esc_html( $item['text'] ); ?></p>
							<?php endif; ?>
						</article>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $data['highlight']['title'] ) || ! empty( $data['highlight']['text'] ) ) : ?>
				<aside class="ct-service-prep__highlight">
					<svg class="ct-service-prep__highlight-icon" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
						<path d="M14 2v4a2 2 0 0 0 2 2h4" />
						<path d="M4 22h14a2 2 0 0 0 2-2V7.5L14.5 2H6a2 2 0 0 0-2 2v4" />
						<path d="m9 15 2 2 4-4" />
					</svg>
					<div class="ct-service-prep__highlight-copy">
						<p class="ct-service-prep__highlight-kicker"><?php esc_html_e( 'Patvirtina klinika', 'optimalu-e-scan' ); ?></p>
						<?php if ( ! empty( $data['highlight']['title'] ) ) : ?>
							<h3 class="ct-service-prep__highlight-title"><?php echo esc_html( $data['highlight']['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $data['highlight']['text'] ) ) : ?>
							<p class="ct-service-prep__highlight-text"><?php echo esc_html( $data['highlight']['text'] ); ?></p>
						<?php endif; ?>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</section>
