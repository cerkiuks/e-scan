<?php
/**
 * Homepage hero section.
 *
 * @package optimalu-e-scan
 */

$hero_eyebrow              = function_exists( 'get_field' ) ? get_field( 'hero_eyebrow' ) : '';
$hero_title                = function_exists( 'get_field' ) ? get_field( 'hero_title' ) : '';
$hero_description          = function_exists( 'get_field' ) ? get_field( 'hero_description' ) : '';
$hero_button_text          = function_exists( 'get_field' ) ? get_field( 'hero_button_text' ) : '';
$hero_button_url           = function_exists( 'get_field' ) ? get_field( 'hero_button_url' ) : '';
$hero_secondary_link_text  = function_exists( 'get_field' ) ? get_field( 'hero_secondary_link_text' ) : '';
$hero_secondary_link_url   = function_exists( 'get_field' ) ? get_field( 'hero_secondary_link_url' ) : '';
$hero_image                = function_exists( 'get_field' ) ? get_field( 'hero_image' ) : null;
$hero_card_label           = function_exists( 'get_field' ) ? get_field( 'hero_card_label' ) : '';
$hero_card_value           = function_exists( 'get_field' ) ? get_field( 'hero_card_value' ) : '';
$hero_stats_raw            = function_exists( 'get_field' ) ? get_field( 'hero_stats' ) : array();
$hero_stats                = array();

if ( is_array( $hero_stats_raw ) && ! empty( $hero_stats_raw ) ) {
	// Legacy repeater rows saved before switching to a group field.
	if ( isset( $hero_stats_raw[0] ) && is_array( $hero_stats_raw[0] ) ) {
		$hero_stats = $hero_stats_raw;
	} else {
		for ( $i = 1; $i <= 4; $i++ ) {
			$stat_value = isset( $hero_stats_raw[ "stat_{$i}_value" ] ) ? $hero_stats_raw[ "stat_{$i}_value" ] : '';
			$stat_label = isset( $hero_stats_raw[ "stat_{$i}_label" ] ) ? $hero_stats_raw[ "stat_{$i}_label" ] : '';

			if ( $stat_value || $stat_label ) {
				$hero_stats[] = array(
					'stat_value' => $stat_value,
					'stat_label' => $stat_label,
				);
			}
		}
	}
}

if ( empty( $hero_eyebrow ) ) {
	$hero_eyebrow = 'Vilnius · Sveikatos diagnostikos centras';
}

if ( empty( $hero_title ) ) {
	$hero_title = 'Moderni<br><em class="hero__title-accent">diagnostika</em><br><span class="hero__title-muted">jūsų sveikatai</span>';
}

if ( empty( $hero_description ) ) {
	$hero_description = 'Kompiuterinė tomografija su aukščiausios klasės įranga ir sertifikuotų radiologų komanda. Tikslūs rezultatai per 24 valandas.';
}

if ( empty( $hero_button_text ) ) {
	$hero_button_text = 'Registruotis tyrimui';
}

if ( empty( $hero_button_url ) ) {
	$hero_button_url = home_url( '/kt-tyrimai/' );
}

if ( empty( $hero_secondary_link_text ) ) {
	$hero_secondary_link_text = 'Sužinoti apie KT tyrimus';
}

if ( empty( $hero_secondary_link_url ) ) {
	$hero_secondary_link_url = '#ct';
}

if ( empty( $hero_card_label ) ) {
	$hero_card_label = 'Laisvas laikas';
}

if ( empty( $hero_card_value ) ) {
	$hero_card_value = 'Šiandien 14:30';
}

if ( empty( $hero_stats ) ) {
	$hero_stats = array(
		array(
			'stat_value' => '12+',
			'stat_label' => 'Metų patirtis',
		),
		array(
			'stat_value' => '15 000+',
			'stat_label' => 'Pacientų aptarnauta',
		),
		array(
			'stat_value' => '98%',
			'stat_label' => 'Pasitenkinimas',
		),
		array(
			'stat_value' => '24h',
			'stat_label' => 'Rezultatų laikas',
		),
	);
}

$hero_image_url = '';
$hero_image_alt = __( 'Moderni kompiuterinės tomografijos procedūra', 'optimalu-e-scan' );

if ( is_array( $hero_image ) && ! empty( $hero_image['url'] ) ) {
	$hero_image_url = $hero_image['url'];
	$hero_image_alt = ! empty( $hero_image['alt'] ) ? $hero_image['alt'] : $hero_image_alt;
} elseif ( is_numeric( $hero_image ) ) {
	$hero_image_url = wp_get_attachment_image_url( $hero_image, 'large' );
	$hero_image_alt = get_post_meta( $hero_image, '_wp_attachment_image_alt', true ) ?: $hero_image_alt;
}
?>

<section class="hero" aria-label="<?php esc_attr_e( 'Hero', 'optimalu-e-scan' ); ?>">
	<div class="hero__background" aria-hidden="true"></div>
	<div class="hero__dots" aria-hidden="true"></div>
	<div class="hero__divider" aria-hidden="true"></div>

	<div class="hero__content">
		<div class="hero__grid">
			<div class="hero__copy">
				<?php if ( $hero_eyebrow ) : ?>
					<p class="hero__eyebrow"><?php echo esc_html( $hero_eyebrow ); ?></p>
				<?php endif; ?>

				<?php if ( $hero_title ) : ?>
					<h1 class="hero__title">
						<?php
						echo wp_kses(
							$hero_title,
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
					</h1>
				<?php endif; ?>

				<?php if ( $hero_description ) : ?>
					<p class="hero__description"><?php echo esc_html( $hero_description ); ?></p>
				<?php endif; ?>

				<?php if ( ( $hero_button_text && $hero_button_url ) || ( $hero_secondary_link_text && $hero_secondary_link_url ) ) : ?>
					<div class="hero__actions">
						<?php if ( $hero_button_text && $hero_button_url ) : ?>
							<a class="hero__button" href="<?php echo esc_url( $hero_button_url ); ?>">
								<?php echo esc_html( $hero_button_text ); ?>
								<svg class="hero__button-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
									<path d="M5 12h14" />
									<path d="m12 5 7 7-7 7" />
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( $hero_secondary_link_text && $hero_secondary_link_url ) : ?>
							<a class="hero__secondary-link" href="<?php echo esc_url( $hero_secondary_link_url ); ?>">
								<?php echo esc_html( $hero_secondary_link_text ); ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( $hero_image_url ) : ?>
				<div class="hero__media">
					<div class="hero__media-frame">
						<img
							class="hero__media-image"
							src="<?php echo esc_url( $hero_image_url ); ?>"
							alt="<?php echo esc_attr( $hero_image_alt ); ?>"
							width="340"
							height="490"
							decoding="async"
						/>
						<div class="hero__media-overlay" aria-hidden="true"></div>
					</div>

					<?php if ( $hero_card_label || $hero_card_value ) : ?>
						<div class="hero__appointment-card">
							<?php if ( $hero_card_label ) : ?>
								<p class="hero__appointment-label"><?php echo esc_html( $hero_card_label ); ?></p>
							<?php endif; ?>
							<?php if ( $hero_card_value ) : ?>
								<p class="hero__appointment-value"><?php echo esc_html( $hero_card_value ); ?></p>
							<?php endif; ?>
						</div>
					<?php endif; ?>

					<div class="hero__media-accent" aria-hidden="true"></div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( ! empty( $hero_stats ) ) : ?>
		<div class="hero__stats">
			<div class="hero__stats-inner">
				<div class="hero__stats-grid">
					<?php foreach ( $hero_stats as $index => $stat ) : ?>
						<?php
						$stat_value = isset( $stat['stat_value'] ) ? $stat['stat_value'] : '';
						$stat_label = isset( $stat['stat_label'] ) ? $stat['stat_label'] : '';

						if ( ! $stat_value && ! $stat_label ) {
							continue;
						}
						?>
						<div class="hero__stat<?php echo $index > 0 ? ' hero__stat--bordered' : ''; ?>">
							<?php if ( $stat_value ) : ?>
								<p class="hero__stat-value"><?php echo esc_html( $stat_value ); ?></p>
							<?php endif; ?>
							<?php if ( $stat_label ) : ?>
								<p class="hero__stat-label"><?php echo esc_html( $stat_label ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</section>
