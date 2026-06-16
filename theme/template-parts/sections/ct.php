<?php
/**
 * Homepage CT service section.
 *
 * @package optimalu-e-scan
 */

$ct_eyebrow         = function_exists( 'get_field' ) ? get_field( 'ct_eyebrow' ) : '';
$ct_title           = function_exists( 'get_field' ) ? get_field( 'ct_title' ) : '';
$ct_description     = function_exists( 'get_field' ) ? get_field( 'ct_description' ) : '';
$ct_image           = function_exists( 'get_field' ) ? get_field( 'ct_image' ) : null;
$ct_price_label     = function_exists( 'get_field' ) ? get_field( 'ct_price_label' ) : '';
$ct_price_value     = function_exists( 'get_field' ) ? get_field( 'ct_price_value' ) : '';
$ct_price_note      = function_exists( 'get_field' ) ? get_field( 'ct_price_note' ) : '';
$ct_features_raw    = function_exists( 'get_field' ) ? get_field( 'ct_features' ) : array();
$ct_button_text     = function_exists( 'get_field' ) ? get_field( 'ct_button_text' ) : '';
$ct_button_url      = function_exists( 'get_field' ) ? get_field( 'ct_button_url' ) : '';
$ct_features        = array();

if ( is_array( $ct_features_raw ) && ! empty( $ct_features_raw ) ) {
	if ( isset( $ct_features_raw[0] ) && is_array( $ct_features_raw[0] ) ) {
		$ct_features = $ct_features_raw;
	} else {
		for ( $i = 1; $i <= 4; $i++ ) {
			$num   = isset( $ct_features_raw[ "feature_{$i}_num" ] ) ? $ct_features_raw[ "feature_{$i}_num" ] : '';
			$title = isset( $ct_features_raw[ "feature_{$i}_title" ] ) ? $ct_features_raw[ "feature_{$i}_title" ] : '';
			$desc  = isset( $ct_features_raw[ "feature_{$i}_desc" ] ) ? $ct_features_raw[ "feature_{$i}_desc" ] : '';

			if ( $num || $title || $desc ) {
				$ct_features[] = array(
					'num'   => $num,
					'title' => $title,
					'desc'  => $desc,
				);
			}
		}
	}
}

if ( empty( $ct_eyebrow ) ) {
	$ct_eyebrow = 'Paslauga';
}

if ( empty( $ct_title ) ) {
	$ct_title = 'Kompiuterinė<br>tomografija';
}

if ( empty( $ct_description ) ) {
	$ct_description = 'Neinvazinis diagnostinis tyrimas, kurio metu gaunami detalūs kūno vidinių struktūrų vaizdai. Tyrimas trunka 15–30 minučių, nereikia jokio specialaus pasiruošimo.';
}

if ( empty( $ct_price_label ) ) {
	$ct_price_label = 'Tyrimo kaina';
}

if ( empty( $ct_price_value ) ) {
	$ct_price_value = 'nuo 89 €';
}

if ( empty( $ct_price_note ) ) {
	$ct_price_note = 'Priklausomai nuo tyrimo srities';
}

if ( empty( $ct_features ) ) {
	$ct_features = array(
		array(
			'num'   => '01',
			'title' => 'Aukšta diagnostinė kokybė',
			'desc'  => '512-eilučių CT skaneris leidžia gauti ypač detalius organų, kraujagyslių ir audinių vaizdus.',
		),
		array(
			'num'   => '02',
			'title' => 'Rezultatai per 24 val.',
			'desc'  => 'Tyrimo atsakymai per 24 valandas. Skubiais atvejais — paruošiami tą pačią dieną.',
		),
		array(
			'num'   => '03',
			'title' => 'Minimali spinduliuotė',
			'desc'  => 'Pažangios dozės sumažinimo technologijos užtikrina maksimalią saugą kiekvienam pacientui.',
		),
		array(
			'num'   => '04',
			'title' => 'Specialisto vertinimas',
			'desc'  => 'Kiekvieną tyrimą aprašo sertifikuotas radiologas. Galima papildoma konsultacija.',
		),
	);
}

if ( empty( $ct_button_text ) ) {
	$ct_button_text = 'Daugiau informacijos';
}

if ( empty( $ct_button_url ) ) {
	$ct_button_url = home_url( '/kt-tyrimai/' );
}

$ct_image_url = '';
$ct_image_alt = __( '512-eilučių KT skanavimo aparatas', 'optimalu-e-scan' );

if ( is_array( $ct_image ) && ! empty( $ct_image['url'] ) ) {
	$ct_image_url = $ct_image['url'];
	$ct_image_alt = ! empty( $ct_image['alt'] ) ? $ct_image['alt'] : $ct_image_alt;
} elseif ( is_numeric( $ct_image ) ) {
	$ct_image_url = wp_get_attachment_image_url( $ct_image, 'large' );
	$ct_image_alt = get_post_meta( $ct_image, '_wp_attachment_image_alt', true ) ?: $ct_image_alt;
}
?>

<section id="ct" class="ct" aria-label="<?php esc_attr_e( 'CT Service', 'optimalu-e-scan' ); ?>">
	<div class="ct__inner">
		<div class="ct__header">
			<div class="ct__header-copy">
				<?php if ( $ct_eyebrow ) : ?>
					<p class="ct__eyebrow"><?php echo esc_html( $ct_eyebrow ); ?></p>
				<?php endif; ?>

				<?php if ( $ct_title ) : ?>
					<h2 class="ct__title">
						<?php
						echo wp_kses(
							$ct_title,
							array(
								'br'     => array(),
								'em'     => array(
									'class' => true,
								),
								'span'   => array(
									'class' => true,
								),
								'strong' => array(),
							)
						);
						?>
					</h2>
				<?php endif; ?>
			</div>

			<?php if ( $ct_description ) : ?>
				<div class="ct__header-aside">
					<p class="ct__description"><?php echo esc_html( $ct_description ); ?></p>
				</div>
			<?php endif; ?>
		</div>

		<div class="ct__content">
			<div class="ct__media">
				<?php if ( $ct_image_url ) : ?>
					<div class="ct__image-frame">
						<img
							class="ct__image"
							src="<?php echo esc_url( $ct_image_url ); ?>"
							alt="<?php echo esc_attr( $ct_image_alt ); ?>"
							width="600"
							height="800"
							loading="lazy"
							decoding="async"
						/>
					</div>
				<?php endif; ?>

				<?php if ( $ct_price_label || $ct_price_value || $ct_price_note ) : ?>
					<div class="ct__price-card">
						<?php if ( $ct_price_label ) : ?>
							<p class="ct__price-label"><?php echo esc_html( $ct_price_label ); ?></p>
						<?php endif; ?>
						<?php if ( $ct_price_value ) : ?>
							<p class="ct__price-value"><?php echo esc_html( $ct_price_value ); ?></p>
						<?php endif; ?>
						<?php if ( $ct_price_note ) : ?>
							<p class="ct__price-note"><?php echo esc_html( $ct_price_note ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<div class="ct__details">
				<?php if ( ! empty( $ct_features ) ) : ?>
					<div class="ct__features">
						<?php foreach ( $ct_features as $feature ) : ?>
							<?php
							$num   = isset( $feature['num'] ) ? $feature['num'] : '';
							$title = isset( $feature['title'] ) ? $feature['title'] : '';
							$desc  = isset( $feature['desc'] ) ? $feature['desc'] : '';

							if ( ! $num && ! $title && ! $desc ) {
								continue;
							}
							?>
							<div class="ct__feature">
								<?php if ( $num ) : ?>
									<span class="ct__feature-num"><?php echo esc_html( $num ); ?></span>
								<?php endif; ?>
								<div class="ct__feature-copy">
									<?php if ( $title ) : ?>
										<h3 class="ct__feature-title"><?php echo esc_html( $title ); ?></h3>
									<?php endif; ?>
									<?php if ( $desc ) : ?>
										<p class="ct__feature-desc"><?php echo esc_html( $desc ); ?></p>
									<?php endif; ?>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php if ( $ct_button_text && $ct_button_url ) : ?>
					<div class="ct__actions">
						<a class="ct__button" href="<?php echo esc_url( $ct_button_url ); ?>">
							<?php echo esc_html( $ct_button_text ); ?>
							<svg class="ct__button-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
								<path d="M5 12h14" />
								<path d="m12 5 7 7-7 7" />
							</svg>
						</a>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
