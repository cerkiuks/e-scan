<?php
/**
 * CT service process steps.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_process_data();

if ( empty( $data['items'] ) && ! $data['title'] ) {
	return;
}
?>

<section class="ct-service-process" aria-label="<?php esc_attr_e( 'Tyrimo eiga', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-process__inner">
		<header class="ct-service-process__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="ct-service-kicker ct-service-kicker--on-dark"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>
			<?php if ( $data['title'] ) : ?>
				<h2 class="ct-service-heading ct-service-heading--light"><?php echo esc_html( $data['title'] ); ?></h2>
			<?php endif; ?>
			<?php if ( $data['intro'] ) : ?>
				<p class="ct-service-lede ct-service-lede--light"><?php echo esc_html( $data['intro'] ); ?></p>
			<?php endif; ?>
		</header>

		<?php if ( ! empty( $data['items'] ) ) : ?>
			<ol class="ct-service-process__list">
				<?php foreach ( $data['items'] as $index => $item ) : ?>
					<li class="ct-service-process__item">
						<span class="ct-service-process__number" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
						<?php if ( ! empty( $item['title'] ) ) : ?>
							<h3 class="ct-service-process__title"><?php echo esc_html( $item['title'] ); ?></h3>
						<?php endif; ?>
						<?php if ( ! empty( $item['text'] ) ) : ?>
							<p class="ct-service-process__text"><?php echo esc_html( $item['text'] ); ?></p>
						<?php endif; ?>
					</li>
				<?php endforeach; ?>
			</ol>
		<?php endif; ?>
	</div>
</section>
