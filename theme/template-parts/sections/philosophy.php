<?php
/**
 * Homepage philosophy section.
 *
 * @package optimalu-e-scan
 */

$philosophy_marquee_raw     = function_exists( 'get_field' ) ? get_field( 'philosophy_marquee' ) : array();
$philosophy_eyebrow         = function_exists( 'get_field' ) ? get_field( 'philosophy_eyebrow' ) : '';
$philosophy_title           = function_exists( 'get_field' ) ? get_field( 'philosophy_title' ) : '';
$philosophy_description     = function_exists( 'get_field' ) ? get_field( 'philosophy_description' ) : '';
$philosophy_pillars_raw     = function_exists( 'get_field' ) ? get_field( 'philosophy_pillars' ) : array();

$philosophy_marquee = array();

if ( is_array( $philosophy_marquee_raw ) && ! empty( $philosophy_marquee_raw ) ) {
	for ( $i = 1; $i <= 5; $i++ ) {
		$phrase = isset( $philosophy_marquee_raw[ "marquee_{$i}" ] ) ? trim( (string) $philosophy_marquee_raw[ "marquee_{$i}" ] ) : '';

		if ( $phrase ) {
			$philosophy_marquee[] = $phrase;
		}
	}
}

if ( empty( $philosophy_marquee ) ) {
	$philosophy_marquee = array(
		'Kompiuterinė tomografija',
		'Tikslumas ir greitis',
		'Profesionalūs specialistai',
		'Jūsų sveikatos labui',
		'Modernios technologijos',
	);
}

if ( empty( $philosophy_eyebrow ) ) {
	$philosophy_eyebrow = 'Mūsų filosofija';
}

if ( empty( $philosophy_title ) ) {
	$philosophy_title = 'Tikslumas, kuris <em class="philosophy__title-accent">keičia gydymą</em>';
}

if ( empty( $philosophy_description ) ) {
	$philosophy_description = 'Šiuolaikinė diagnostika yra gydymo pagrindas. Investuojame į technologijas, kad jūsų gydytojai turėtų aiškiausius atsakymus.';
}

$philosophy_pillars = array();

if ( is_array( $philosophy_pillars_raw ) && ! empty( $philosophy_pillars_raw ) ) {
	for ( $i = 1; $i <= 3; $i++ ) {
		$num   = isset( $philosophy_pillars_raw[ "pillar_{$i}_num" ] ) ? $philosophy_pillars_raw[ "pillar_{$i}_num" ] : '';
		$title = isset( $philosophy_pillars_raw[ "pillar_{$i}_title" ] ) ? $philosophy_pillars_raw[ "pillar_{$i}_title" ] : '';
		$desc  = isset( $philosophy_pillars_raw[ "pillar_{$i}_desc" ] ) ? $philosophy_pillars_raw[ "pillar_{$i}_desc" ] : '';

		if ( $num || $title || $desc ) {
			$philosophy_pillars[] = array(
				'num'   => $num,
				'title' => $title,
				'desc'  => $desc,
			);
		}
	}
}

if ( empty( $philosophy_pillars ) ) {
	$philosophy_pillars = array(
		array(
			'num'   => '01',
			'title' => 'Greita',
			'desc'  => 'Rezultatai per 24 valandas',
		),
		array(
			'num'   => '02',
			'title' => 'Tiksli',
			'desc'  => '512-eilučių CT skaneris',
		),
		array(
			'num'   => '03',
			'title' => 'Saugi',
			'desc'  => 'Minimali spinduliuotės dozė',
		),
	);
}

/**
 * Render marquee phrase list.
 *
 * @param array<int, string> $phrases Marquee phrases.
 */
$render_philosophy_marquee_group = static function ( array $phrases ) {
	foreach ( $phrases as $index => $phrase ) {
		$modifier = 0 === $index % 2 ? 'philosophy__marquee-item--light' : 'philosophy__marquee-item--accent';
		?>
		<span class="philosophy__marquee-item <?php echo esc_attr( $modifier ); ?>">
			<?php echo esc_html( $phrase ); ?>
			<span class="philosophy__marquee-separator" aria-hidden="true">◆</span>
		</span>
		<?php
	}
};
?>

<section id="philosophy" class="philosophy" aria-label="<?php esc_attr_e( 'Philosophy', 'optimalu-e-scan' ); ?>">
	<?php if ( ! empty( $philosophy_marquee ) ) : ?>
		<div class="philosophy__marquee" aria-hidden="true">
			<div class="philosophy__marquee-track">
				<div class="philosophy__marquee-group">
					<?php
					for ( $repeat = 0; $repeat < 4; $repeat++ ) {
						$render_philosophy_marquee_group( $philosophy_marquee );
					}
					?>
				</div>
				<div class="philosophy__marquee-group">
					<?php
					for ( $repeat = 0; $repeat < 4; $repeat++ ) {
						$render_philosophy_marquee_group( $philosophy_marquee );
					}
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<div class="philosophy__intro">
		<?php if ( $philosophy_eyebrow ) : ?>
			<p class="philosophy__eyebrow"><?php echo esc_html( $philosophy_eyebrow ); ?></p>
		<?php endif; ?>

		<?php if ( $philosophy_title ) : ?>
			<h2 class="philosophy__title">
				<?php
				echo wp_kses(
					$philosophy_title,
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

		<?php if ( $philosophy_description ) : ?>
			<p class="philosophy__description"><?php echo esc_html( $philosophy_description ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( ! empty( $philosophy_pillars ) ) : ?>
		<div class="philosophy__pillars">
			<div class="philosophy__pillars-grid">
				<?php foreach ( $philosophy_pillars as $index => $pillar ) : ?>
					<?php
					$num   = isset( $pillar['num'] ) ? $pillar['num'] : '';
					$title = isset( $pillar['title'] ) ? $pillar['title'] : '';
					$desc  = isset( $pillar['desc'] ) ? $pillar['desc'] : '';

					if ( ! $num && ! $title && ! $desc ) {
						continue;
					}
					?>
					<div class="philosophy__pillar<?php echo $index > 0 ? ' philosophy__pillar--bordered' : ''; ?>">
						<?php if ( $num ) : ?>
							<span class="philosophy__pillar-num"><?php echo esc_html( $num ); ?></span>
						<?php endif; ?>
						<?php if ( $title ) : ?>
							<p class="philosophy__pillar-title"><?php echo esc_html( $title ); ?></p>
						<?php endif; ?>
						<?php if ( $desc ) : ?>
							<p class="philosophy__pillar-desc"><?php echo esc_html( $desc ); ?></p>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="philosophy__spacer" aria-hidden="true"></div>
</section>
