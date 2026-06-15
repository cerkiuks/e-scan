<?php
/**
 * Homepage about section.
 *
 * @package optimalu-e-scan
 */

$about_eyebrow       = function_exists( 'get_field' ) ? get_field( 'about_eyebrow' ) : '';
$about_title         = function_exists( 'get_field' ) ? get_field( 'about_title' ) : '';
$about_paragraph_1   = function_exists( 'get_field' ) ? get_field( 'about_paragraph_1' ) : '';
$about_paragraph_2   = function_exists( 'get_field' ) ? get_field( 'about_paragraph_2' ) : '';
$about_link_text     = function_exists( 'get_field' ) ? get_field( 'about_link_text' ) : '';
$about_link_url      = function_exists( 'get_field' ) ? get_field( 'about_link_url' ) : '';
$about_highlights_raw  = function_exists( 'get_field' ) ? get_field( 'about_highlights' ) : array();
$about_highlights      = array();

if ( is_array( $about_highlights_raw ) && ! empty( $about_highlights_raw ) ) {
	// Legacy repeater rows saved before switching to a group field.
	if ( isset( $about_highlights_raw[0] ) && is_array( $about_highlights_raw[0] ) ) {
		$about_highlights = $about_highlights_raw;
	} else {
		for ( $i = 1; $i <= 4; $i++ ) {
			$highlight_value = isset( $about_highlights_raw[ "highlight_{$i}_value" ] ) ? $about_highlights_raw[ "highlight_{$i}_value" ] : '';
			$highlight_label = isset( $about_highlights_raw[ "highlight_{$i}_label" ] ) ? $about_highlights_raw[ "highlight_{$i}_label" ] : '';
			$highlight_sub   = isset( $about_highlights_raw[ "highlight_{$i}_sub" ] ) ? $about_highlights_raw[ "highlight_{$i}_sub" ] : '';

			if ( $highlight_value || $highlight_label || $highlight_sub ) {
				$about_highlights[] = array(
					'highlight_value' => $highlight_value,
					'highlight_label' => $highlight_label,
					'highlight_sub'   => $highlight_sub,
				);
			}
		}
	}
}

if ( empty( $about_eyebrow ) ) {
	$about_eyebrow = 'Apie mus';
}

if ( empty( $about_title ) ) {
	$about_title = 'Diagnostikos centras,<br><span class="about__title-muted">kuriam rūpite jūs</span>';
}

if ( empty( $about_paragraph_1 ) ) {
	$about_paragraph_1 = 'Nuo 2012 metų teikiame aukštos kokybės diagnostikos paslaugas Vilniuje. Specializuojamės kompiuterinėje tomografijoje — procedūroje, leidžiančioje tiksliai diagnozuoti ligas ir stebėti gydymo eigą.';
}

if ( empty( $about_paragraph_2 ) ) {
	$about_paragraph_2 = 'Kiekvienas pacientas mums — individualus. Mūsų specialistai ne tik atlieka tyrimus, bet konsultuoja, padeda suprasti rezultatus ir rekomenduoja tolesnius žingsnius.';
}

if ( empty( $about_link_text ) ) {
	$about_link_text = 'Susisiekti su mumis';
}

if ( empty( $about_link_url ) ) {
	$about_link_url = home_url( '/kontaktai/' );
}

if ( empty( $about_highlights ) ) {
	$about_highlights = array(
		array(
			'highlight_value' => '12+',
			'highlight_label' => 'Metų rinkoje',
			'highlight_sub'   => 'Patikimumas ir patirtis',
		),
		array(
			'highlight_value' => '15K+',
			'highlight_label' => 'Pacientų',
			'highlight_sub'   => 'Aptarnauta per metus',
		),
		array(
			'highlight_value' => '98%',
			'highlight_label' => 'Pasitenkinimas',
			'highlight_sub'   => 'Pacientų įvertinimas',
		),
		array(
			'highlight_value' => '3',
			'highlight_label' => 'Specialistai',
			'highlight_sub'   => 'Sertifikuoti radiologai',
		),
	);
}
?>

<section id="about" class="about" aria-label="<?php esc_attr_e( 'About', 'optimalu-e-scan' ); ?>">
	<div class="about__inner">
		<div class="about__grid">
			<div class="about__content">
				<?php if ( $about_eyebrow ) : ?>
					<p class="about__eyebrow"><?php echo esc_html( $about_eyebrow ); ?></p>
				<?php endif; ?>

				<?php if ( $about_title ) : ?>
					<h2 class="about__title">
						<?php
						echo wp_kses(
							$about_title,
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

				<?php if ( $about_paragraph_1 ) : ?>
					<p class="about__text about__text--first"><?php echo esc_html( $about_paragraph_1 ); ?></p>
				<?php endif; ?>

				<?php if ( $about_paragraph_2 ) : ?>
					<p class="about__text about__text--second"><?php echo esc_html( $about_paragraph_2 ); ?></p>
				<?php endif; ?>

				<?php if ( $about_link_text && $about_link_url ) : ?>
					<a class="about__link" href="<?php echo esc_url( $about_link_url ); ?>">
						<?php echo esc_html( $about_link_text ); ?>
						<svg class="about__link-icon" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
							<path d="M5 12h14" />
							<path d="m12 5 7 7-7 7" />
						</svg>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $about_highlights ) ) : ?>
				<div class="about__highlights">
					<?php foreach ( $about_highlights as $highlight ) : ?>
						<?php
						$value = isset( $highlight['highlight_value'] ) ? $highlight['highlight_value'] : '';
						$label = isset( $highlight['highlight_label'] ) ? $highlight['highlight_label'] : '';
						$sub   = isset( $highlight['highlight_sub'] ) ? $highlight['highlight_sub'] : '';

						if ( ! $value && ! $label && ! $sub ) {
							continue;
						}
						?>
						<div class="about__highlight">
							<?php if ( $value ) : ?>
								<p class="about__highlight-value"><?php echo esc_html( $value ); ?></p>
							<?php endif; ?>
							<?php if ( $label ) : ?>
								<p class="about__highlight-label"><?php echo esc_html( $label ); ?></p>
							<?php endif; ?>
							<?php if ( $sub ) : ?>
								<p class="about__highlight-sub"><?php echo esc_html( $sub ); ?></p>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
