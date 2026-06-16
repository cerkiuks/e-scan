<?php
/**
 * Homepage registration section.
 *
 * @package optimalu-e-scan
 */

$registration_eyebrow            = function_exists( 'get_field' ) ? get_field( 'registration_eyebrow' ) : '';
$registration_title              = function_exists( 'get_field' ) ? get_field( 'registration_title' ) : '';
$registration_title_highlight    = function_exists( 'get_field' ) ? get_field( 'registration_title_highlight' ) : '';
$registration_description        = function_exists( 'get_field' ) ? get_field( 'registration_description' ) : '';
$registration_info_heading     = function_exists( 'get_field' ) ? get_field( 'registration_info_heading' ) : '';
$registration_info_text          = function_exists( 'get_field' ) ? get_field( 'registration_info_text' ) : '';
$registration_info_items_raw     = function_exists( 'get_field' ) ? get_field( 'registration_info_items' ) : array();
$registration_faq_link_text      = function_exists( 'get_field' ) ? get_field( 'registration_faq_link_text' ) : '';
$registration_faq_link_url       = function_exists( 'get_field' ) ? get_field( 'registration_faq_link_url' ) : '';
$registration_booking_shortcode  = function_exists( 'get_field' ) ? get_field( 'registration_booking_shortcode' ) : '';
$registration_info_items         = array();

if ( is_array( $registration_info_items_raw ) && ! empty( $registration_info_items_raw ) ) {
	for ( $i = 1; $i <= 4; $i++ ) {
		$item = isset( $registration_info_items_raw[ "info_item_{$i}" ] ) ? trim( (string) $registration_info_items_raw[ "info_item_{$i}" ] ) : '';

		if ( $item ) {
			$registration_info_items[] = $item;
		}
	}
}

if ( empty( $registration_eyebrow ) ) {
	$registration_eyebrow = 'Registracija';
}

if ( empty( $registration_title ) ) {
	$registration_title = 'Užsiregistruokite';
}

if ( empty( $registration_title_highlight ) ) {
	$registration_title_highlight = 'KT tyrimui';
}

if ( empty( $registration_description ) ) {
	$registration_description = 'Pasirinkite patogų laiką ir užpildykite paprastą formą. Su jumis susisieksime per 2 valandas, atsakysime į klausimus ir patvirtinsime vizitą. Viskas paprasta ir greita.';
}

if ( empty( $registration_info_heading ) ) {
	$registration_info_heading = 'Pasiruošimas KT tyrimui';
}

if ( empty( $registration_info_text ) ) {
	$registration_info_text = 'Prieš registraciją naudinga žinoti pagrindinę informaciją apie kompiuterinės tomografijos tyrimą. Jei turite klausimų — susisiekite arba peržiūrėkite DUK.';
}

if ( empty( $registration_info_items ) ) {
	$registration_info_items = array(
		'Paprastai nereikia specialaus pasiruošimo prieš tyrimą',
		'Atvykite 10–15 minučių anksčiau nurodytu laiku',
		'Informuokite specialistą apie alergijas, nėštumą ar inkstų funkciją',
		'Tyrimo rezultatus paprastai gausite per 24 valandas',
	);
}

if ( empty( $registration_faq_link_text ) ) {
	$registration_faq_link_text = 'Dažniausiai užduodami klausimai';
}

if ( empty( $registration_faq_link_url ) ) {
	$registration_faq_link_url = home_url( '/duk/' );
}

if ( empty( $registration_booking_shortcode ) ) {
	$registration_booking_shortcode = "[booking resource_id=1 form_type='standard']";
}
?>

<section id="booking" class="home-registration" aria-label="<?php esc_attr_e( 'Registration', 'optimalu-e-scan' ); ?>">
	<div class="home-registration__inner">
		<header class="home-registration__intro">
			<?php if ( $registration_eyebrow ) : ?>
				<p class="home-registration__eyebrow"><?php echo esc_html( $registration_eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( $registration_title || $registration_title_highlight ) : ?>
				<h2 class="home-registration__title">
					<?php if ( $registration_title ) : ?>
						<?php echo esc_html( $registration_title ); ?>
					<?php endif; ?>
					<?php if ( $registration_title_highlight ) : ?>
						<br>
						<span class="home-registration__title-highlight"><?php echo esc_html( $registration_title_highlight ); ?></span>
					<?php endif; ?>
				</h2>
			<?php endif; ?>

			<?php if ( $registration_description ) : ?>
				<p class="home-registration__description"><?php echo esc_html( $registration_description ); ?></p>
			<?php endif; ?>
		</header>

		<div class="home-registration__layout">
			<div class="home-registration__info">
				<?php if ( $registration_info_heading ) : ?>
					<h3 class="home-registration__info-heading"><?php echo esc_html( $registration_info_heading ); ?></h3>
				<?php endif; ?>

				<?php if ( $registration_info_text ) : ?>
					<p class="home-registration__info-text"><?php echo esc_html( $registration_info_text ); ?></p>
				<?php endif; ?>

				<?php if ( ! empty( $registration_info_items ) ) : ?>
					<ul class="home-registration__info-list">
						<?php foreach ( $registration_info_items as $info_item ) : ?>
							<li class="home-registration__info-item"><?php echo esc_html( $info_item ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<?php if ( $registration_faq_link_text && $registration_faq_link_url ) : ?>
					<a class="home-registration__faq-link" href="<?php echo esc_url( $registration_faq_link_url ); ?>">
						<?php echo esc_html( $registration_faq_link_text ); ?>
						<svg class="home-registration__faq-link-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M5 12h14" />
							<path d="m12 5 7 7-7 7" />
						</svg>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( $registration_booking_shortcode ) : ?>
				<div class="home-registration__booking">
					<?php echo do_shortcode( $registration_booking_shortcode ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
