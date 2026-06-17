<?php
/**
 * Registration / booking section template.
 *
 * @package optimalu-e-scan
 */

$post_id = optimalu_e_scan_resolve_section_post_id( isset( $args ) && is_array( $args ) ? $args : array() );
$data    = optimalu_e_scan_get_registration_section_data( $post_id );
?>

<section id="booking" class="home-registration" aria-label="<?php esc_attr_e( 'Registration', 'optimalu-e-scan' ); ?>">
	<div class="home-registration__inner">
		<header class="home-registration__intro">
			<?php if ( $data['eyebrow'] ) : ?>
				<p class="home-registration__eyebrow"><?php echo esc_html( $data['eyebrow'] ); ?></p>
			<?php endif; ?>

			<?php if ( $data['title'] || $data['title_highlight'] ) : ?>
				<h2 class="home-registration__title">
					<?php if ( $data['title'] ) : ?>
						<?php echo esc_html( $data['title'] ); ?>
					<?php endif; ?>
					<?php if ( $data['title_highlight'] ) : ?>
						<br>
						<span class="home-registration__title-highlight"><?php echo esc_html( $data['title_highlight'] ); ?></span>
					<?php endif; ?>
				</h2>
			<?php endif; ?>

			<?php if ( $data['description'] ) : ?>
				<p class="home-registration__description"><?php echo esc_html( $data['description'] ); ?></p>
			<?php endif; ?>
		</header>

		<div class="home-registration__layout">
			<div class="home-registration__info">
				<?php if ( $data['info_heading'] ) : ?>
					<h3 class="home-registration__info-heading"><?php echo esc_html( $data['info_heading'] ); ?></h3>
				<?php endif; ?>

				<?php if ( $data['info_text'] ) : ?>
					<p class="home-registration__info-text"><?php echo esc_html( $data['info_text'] ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $data['info_items'] ) ) : ?>
					<ul class="home-registration__info-list">
						<?php foreach ( $data['info_items'] as $info_item ) : ?>
							<li class="home-registration__info-item"><?php echo esc_html( $info_item ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if ( $data['faq_link_text'] && $data['faq_link_url'] ) : ?>
					<a class="home-registration__faq-link" href="<?php echo esc_url( $data['faq_link_url'] ); ?>">
						<?php echo esc_html( $data['faq_link_text'] ); ?>
						<svg class="home-registration__faq-link-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M5 12h14" />
							<path d="m12 5 7 7-7 7" />
						</svg>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( $data['booking_shortcode'] ) : ?>
				<div class="home-registration__booking">
					<?php echo do_shortcode( $data['booking_shortcode'] ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
