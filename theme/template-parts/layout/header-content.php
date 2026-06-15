<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package optimalu-e-scan
 */

$is_home_header = is_front_page();
$header_classes = array( 'site-header' );

if ( $is_home_header ) {
	$header_classes[] = 'site-header--home';
	$header_classes[] = 'site-header--transparent';
} else {
	$header_classes[] = 'site-header--solid';
}

$logo_alt         = __( 'E-SCAN Kompiuterinė tomografija', 'optimalu-e-scan' );
$logo_light_url   = get_template_directory_uri() . '/assets/images/logo-light.png';
$logo_dark_url    = get_template_directory_uri() . '/assets/images/logo-dark.png';

if ( has_custom_logo() ) {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$custom_logo    = wp_get_attachment_image_src( $custom_logo_id, 'full' );

	if ( ! empty( $custom_logo[0] ) ) {
		$logo_dark_url = $custom_logo[0];
	}
}

$cta_url = home_url( '/kt-tyrimai/' );
?>

<header id="masthead" class="<?php echo esc_attr( implode( ' ', $header_classes ) ); ?>"<?php echo $is_home_header ? ' data-home-header="true"' : ''; ?>>
	<div class="site-header__inner">
		<a class="site-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<span class="site-header__logo-images">
				<img
					class="site-header__logo-image site-header__logo-image--light"
					src="<?php echo esc_url( $logo_light_url ); ?>"
					alt="<?php echo esc_attr( $logo_alt ); ?>"
					width="200"
					height="40"
					decoding="async"
				/>
				<img
					class="site-header__logo-image site-header__logo-image--dark"
					src="<?php echo esc_url( $logo_dark_url ); ?>"
					alt="<?php echo esc_attr( $logo_alt ); ?>"
					width="200"
					height="40"
					decoding="async"
				/>
			</span>
			<span class="sr-only"><?php bloginfo( 'name' ); ?></span>
		</a>

		<nav id="site-navigation" class="site-header__nav" aria-label="<?php esc_attr_e( 'Main Navigation', 'optimalu-e-scan' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'site-header__menu',
					'fallback_cb'    => false,
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<a class="site-header__cta" href="<?php echo esc_url( $cta_url ); ?>">
			<?php esc_html_e( 'Registruotis', 'optimalu-e-scan' ); ?>
			<svg class="site-header__cta-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M5 12h14" />
				<path d="m12 5 7 7-7 7" />
			</svg>
		</a>

		<button
			type="button"
			class="site-header__toggle"
			aria-controls="site-navigation-mobile"
			aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Open menu', 'optimalu-e-scan' ); ?>"
			data-label-open="<?php esc_attr_e( 'Open menu', 'optimalu-e-scan' ); ?>"
			data-label-close="<?php esc_attr_e( 'Close menu', 'optimalu-e-scan' ); ?>"
		>
			<svg class="site-header__toggle-icon site-header__toggle-icon--open" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M4 5h16" />
				<path d="M4 12h16" />
				<path d="M4 19h16" />
			</svg>
			<svg class="site-header__toggle-icon site-header__toggle-icon--close" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
				<path d="M18 6 6 18" />
				<path d="m6 6 12 12" />
			</svg>
		</button>
	</div>
</header>

<div
	id="site-navigation-mobile"
	class="site-header__mobile-panel"
	aria-hidden="true"
	hidden
>
	<div class="site-header__mobile-panel-inner">
		<img
			class="site-header__mobile-logo"
			src="<?php echo esc_url( $logo_light_url ); ?>"
			alt="<?php echo esc_attr( $logo_alt ); ?>"
			width="240"
			height="48"
			decoding="async"
		/>

		<nav aria-label="<?php esc_attr_e( 'Mobile Navigation', 'optimalu-e-scan' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'container'      => false,
					'menu_id'        => 'primary-menu-mobile',
					'menu_class'     => 'site-header__mobile-menu',
					'fallback_cb'    => false,
					'depth'          => 1,
				)
			);
			?>
		</nav>

		<a class="site-header__mobile-cta" href="<?php echo esc_url( $cta_url ); ?>">
			<?php esc_html_e( 'Registruotis', 'optimalu-e-scan' ); ?>
		</a>
	</div>
</div>

<?php if ( $is_home_header ) : ?>
<script>
(function () {
	var header = document.getElementById('masthead');
	if (!header || header.dataset.homeHeader !== 'true') {
		return;
	}

	var isScrolled = false;

	function updateHeaderState() {
		var nextScrolled = window.scrollY > 64;

		if (nextScrolled === isScrolled) {
			return;
		}

		isScrolled = nextScrolled;
		header.classList.toggle('site-header--scrolled', isScrolled);
		header.classList.toggle('site-header--transparent', !isScrolled);
	}

	window.addEventListener('scroll', updateHeaderState, { passive: true });
	updateHeaderState();
})();
</script>
<?php endif; ?>
