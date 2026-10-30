<?php
/**
 * CT service hero.
 *
 * @package optimalu-e-scan
 */

$data = optimalu_e_scan_get_ct_service_hero_data();

if ( ! $data['title'] && ! $data['title_highlight'] && ! $data['description'] ) {
	return;
}
?>

<section class="ct-service-hero" aria-label="<?php esc_attr_e( 'Tyrimo antraštė', 'optimalu-e-scan' ); ?>">
	<div class="ct-service-hero__inner">
		<?php if ( $data['breadcrumb_home'] || $data['breadcrumb_parent'] || $data['breadcrumb_current'] ) : ?>
			<nav class="ct-service-hero__breadcrumb" aria-label="<?php esc_attr_e( 'Trupininė navigacija', 'optimalu-e-scan' ); ?>">
				<ol class="ct-service-hero__breadcrumb-list">
					<?php if ( $data['breadcrumb_home'] ) : ?>
						<li><a href="<?php echo esc_url( $data['home_url'] ); ?>"><?php echo esc_html( $data['breadcrumb_home'] ); ?></a></li>
					<?php endif; ?>
					<?php if ( $data['breadcrumb_parent'] ) : ?>
						<li><a href="<?php echo esc_url( $data['parent_url'] ); ?>"><?php echo esc_html( $data['breadcrumb_parent'] ); ?></a></li>
					<?php endif; ?>
					<?php if ( $data['breadcrumb_current'] ) : ?>
						<li aria-current="page"><?php echo esc_html( $data['breadcrumb_current'] ); ?></li>
					<?php endif; ?>
				</ol>
			</nav>
		<?php endif; ?>

		<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
			<h1 class="ct-service-hero__title">
				<?php if ( $data['title'] ) : ?>
					<span class="ct-service-hero__title-main"><?php echo esc_html( $data['title'] ); ?></span>
				<?php endif; ?>
				<?php if ( $data['title_highlight'] ) : ?>
					<span class="ct-service-hero__title-highlight"><?php echo esc_html( $data['title_highlight'] ); ?></span>
				<?php endif; ?>
			</h1>
		<?php endif; ?>

		<?php if ( $data['description'] || ( $data['primary_text'] && $data['primary_url'] ) || ( $data['secondary_text'] && $data['secondary_url'] ) ) : ?>
			<div class="ct-service-hero__footer">
				<?php if ( $data['description'] ) : ?>
					<p class="ct-service-hero__description"><?php echo esc_html( $data['description'] ); ?></p>
				<?php endif; ?>

				<?php if ( ( $data['primary_text'] && $data['primary_url'] ) || ( $data['secondary_text'] && $data['secondary_url'] ) ) : ?>
					<div class="ct-service-hero__actions">
						<?php if ( $data['primary_text'] && $data['primary_url'] ) : ?>
							<a class="ct-service-hero__button ct-service-hero__button--primary" href="<?php echo esc_url( $data['primary_url'] ); ?>">
								<?php echo esc_html( $data['primary_text'] ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg>
							</a>
						<?php endif; ?>
						<?php if ( $data['secondary_text'] && $data['secondary_url'] ) : ?>
							<a class="ct-service-hero__button ct-service-hero__button--secondary" href="<?php echo esc_url( $data['secondary_url'] ); ?>">
								<?php echo esc_html( $data['secondary_text'] ); ?>
								<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14" /><path d="m19 12-7 7-7-7" /></svg>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
