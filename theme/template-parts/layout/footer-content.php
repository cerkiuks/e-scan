<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package optimalu-e-scan
 */

$logo_url           = get_template_directory_uri() . '/assets/images/logo-light.png';
$footer_logo_id     = get_theme_mod( 'optimalu_footer_logo' );
$footer_logo_src    = $footer_logo_id ? wp_get_attachment_image_src( $footer_logo_id, 'full' ) : false;
$footer_description = get_theme_mod(
	'optimalu_footer_description',
	'Profesionali kompiuterinės tomografijos diagnostika Vilniuje nuo 2012 metų. Tikslūs rezultatai per 24 valandas.'
);
$address_line_1     = get_theme_mod( 'optimalu_footer_address_line_1', 'Gedimino pr. 28' );
$address_line_2     = get_theme_mod( 'optimalu_footer_address_line_2', 'LT-01104 Vilnius' );
$phone              = get_theme_mod( 'optimalu_footer_phone', '+370 5 222 33 44' );
$email              = get_theme_mod( 'optimalu_footer_email', 'info@e-scan.lt' );
$hours_weekday_label = get_theme_mod( 'optimalu_footer_hours_weekday_label', 'Pirmadienis–Penktadienis' );
$hours_weekday      = get_theme_mod( 'optimalu_footer_hours_weekday', '8:00 – 20:00' );
$hours_saturday_label = get_theme_mod( 'optimalu_footer_hours_saturday_label', 'Šeštadienis' );
$hours_saturday     = get_theme_mod( 'optimalu_footer_hours_saturday', '9:00 – 15:00' );

if ( ! empty( $footer_logo_src[0] ) ) {
	$logo_url = $footer_logo_src[0];
} elseif ( has_custom_logo() ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo    = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( ! empty( $custom_logo[0] ) ) {
		$logo_url = $custom_logo[0];
	}
}

$phone_href = preg_replace( '/[^\d+]/', '', $phone );
?>

<footer id="colophon" class="site-footer">
	<div class="site-footer__inner">
		<div class="site-footer__grid">
			<div class="site-footer__brand">
				<a class="site-footer__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img
						class="site-footer__logo"
						src="<?php echo esc_url( $logo_url ); ?>"
						alt="<?php echo esc_attr__( 'E-SCAN Kompiuterinė tomografija', 'optimalu-e-scan' ); ?>"
						width="200"
						height="40"
						decoding="async"
					/>
				</a>
				<?php if ( $footer_description ) : ?>
					<p class="site-footer__tagline"><?php echo esc_html( $footer_description ); ?></p>
				<?php endif; ?>
			</div>

			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<div class="site-footer__column">
					<h2 class="site-footer__heading"><?php esc_html_e( 'Navigacija', 'optimalu-e-scan' ); ?></h2>
					<nav aria-label="<?php esc_attr_e( 'Footer Navigation', 'optimalu-e-scan' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-2',
								'container'      => false,
								'menu_id'        => 'footer-menu',
								'menu_class'     => 'site-footer__menu',
								'depth'          => 1,
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				</div>
			<?php endif; ?>

			<div class="site-footer__column">
				<h2 class="site-footer__heading"><?php esc_html_e( 'Kontaktai', 'optimalu-e-scan' ); ?></h2>
				<ul class="site-footer__contact-list">
					<?php if ( $address_line_1 || $address_line_2 ) : ?>
						<li class="site-footer__contact-item site-footer__contact-item--address">
							<svg class="site-footer__contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
								<circle cx="12" cy="10" r="3" />
							</svg>
							<div>
								<?php if ( $address_line_1 ) : ?>
									<p><?php echo esc_html( $address_line_1 ); ?></p>
								<?php endif; ?>
								<?php if ( $address_line_2 ) : ?>
									<p><?php echo esc_html( $address_line_2 ); ?></p>
								<?php endif; ?>
							</div>
						</li>
					<?php endif; ?>
					<?php if ( $phone ) : ?>
						<li class="site-footer__contact-item">
							<svg class="site-footer__contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
							</svg>
							<a class="site-footer__contact-link" href="<?php echo esc_url( 'tel:' . $phone_href ); ?>"><?php echo esc_html( $phone ); ?></a>
						</li>
					<?php endif; ?>
					<?php if ( $email ) : ?>
						<li class="site-footer__contact-item">
							<svg class="site-footer__contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />
								<rect x="2" y="4" width="20" height="16" rx="2" />
							</svg>
							<a class="site-footer__contact-link" href="<?php echo esc_url( 'mailto:' . $email ); ?>"><?php echo esc_html( $email ); ?></a>
						</li>
					<?php endif; ?>
				</ul>
			</div>

			<div class="site-footer__column">
				<h2 class="site-footer__heading"><?php esc_html_e( 'Darbo laikas', 'optimalu-e-scan' ); ?></h2>
				<div class="site-footer__hours">
					<?php if ( $hours_weekday_label ) : ?>
						<p><?php echo esc_html( $hours_weekday_label ); ?></p>
					<?php endif; ?>
					<?php if ( $hours_weekday ) : ?>
						<p class="site-footer__hours-time"><?php echo esc_html( $hours_weekday ); ?></p>
					<?php endif; ?>
					<?php if ( $hours_saturday_label ) : ?>
						<p class="site-footer__hours-day"><?php echo esc_html( $hours_saturday_label ); ?></p>
					<?php endif; ?>
					<?php if ( $hours_saturday ) : ?>
						<p class="site-footer__hours-time"><?php echo esc_html( $hours_saturday ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div class="site-footer__bar">
			<p class="site-footer__copyright">
				<?php
				printf(
					/* translators: %s: current year */
					esc_html__( '© %s UAB "E-SCAN Diagnostika". Visos teisės saugomos.', 'optimalu-e-scan' ),
					esc_html( gmdate( 'Y' ) )
				);
				?>
			</p>

			<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
				<nav class="site-footer__legal" aria-label="<?php esc_attr_e( 'Footer Legal', 'optimalu-e-scan' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'container'      => false,
							'menu_class'     => 'site-footer__legal-menu',
							'depth'          => 1,
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>
			<?php endif; ?>
		</div>
	</div>
</footer>
