<?php
/**
 * Footer Customizer settings.
 *
 * @package optimalu-e-scan
 */

/**
 * Register footer content settings in the Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function optimalu_e_scan_footer_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'optimalu_footer',
		array(
			'title'    => __( 'Footer', 'optimalu-e-scan' ),
			'priority' => 130,
		)
	);

	$settings = array(
		'optimalu_footer_logo'                => array(
			'default'           => '',
			'sanitize_callback' => 'absint',
		),
		'optimalu_footer_description'         => array(
			'default'           => 'Profesionali kompiuterinės tomografijos diagnostika Vilniuje nuo 2012 metų. Tikslūs rezultatai per 24 valandas.',
			'sanitize_callback' => 'sanitize_textarea_field',
		),
		'optimalu_footer_address_line_1'      => array(
			'default'           => 'Gedimino pr. 28',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_address_line_2'      => array(
			'default'           => 'LT-01104 Vilnius',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_phone'               => array(
			'default'           => '+370 5 222 33 44',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_email'               => array(
			'default'           => 'info@e-scan.lt',
			'sanitize_callback' => 'sanitize_email',
		),
		'optimalu_footer_hours_weekday_label' => array(
			'default'           => 'Pirmadienis–Penktadienis',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_hours_weekday'       => array(
			'default'           => '8:00 – 20:00',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_hours_saturday_label' => array(
			'default'           => 'Šeštadienis',
			'sanitize_callback' => 'sanitize_text_field',
		),
		'optimalu_footer_hours_saturday'      => array(
			'default'           => '9:00 – 15:00',
			'sanitize_callback' => 'sanitize_text_field',
		),
	);

	foreach ( $settings as $id => $args ) {
		$wp_customize->add_setting(
			$id,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => $args['sanitize_callback'],
				'transport'         => 'refresh',
			)
		);
	}

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'optimalu_footer_logo',
			array(
				'label'       => __( 'Footer logo', 'optimalu-e-scan' ),
				'description' => __( 'Light logo for the dark footer. Falls back to Site Identity logo, then theme default.', 'optimalu-e-scan' ),
				'section'     => 'optimalu_footer',
				'mime_type'   => 'image',
			)
		)
	);

	$text_controls = array(
		'optimalu_footer_description'          => array(
			'label'   => __( 'Footer description', 'optimalu-e-scan' ),
			'type'    => 'textarea',
		),
		'optimalu_footer_address_line_1'       => array(
			'label' => __( 'Address line 1', 'optimalu-e-scan' ),
		),
		'optimalu_footer_address_line_2'       => array(
			'label' => __( 'Address line 2', 'optimalu-e-scan' ),
		),
		'optimalu_footer_phone'                => array(
			'label' => __( 'Phone', 'optimalu-e-scan' ),
		),
		'optimalu_footer_email'                => array(
			'label' => __( 'Email', 'optimalu-e-scan' ),
		),
		'optimalu_footer_hours_weekday_label'  => array(
			'label' => __( 'Weekday hours label', 'optimalu-e-scan' ),
		),
		'optimalu_footer_hours_weekday'        => array(
			'label' => __( 'Weekday hours', 'optimalu-e-scan' ),
		),
		'optimalu_footer_hours_saturday_label' => array(
			'label' => __( 'Saturday label', 'optimalu-e-scan' ),
		),
		'optimalu_footer_hours_saturday'       => array(
			'label' => __( 'Saturday hours', 'optimalu-e-scan' ),
		),
	);

	foreach ( $text_controls as $id => $args ) {
		$wp_customize->add_control(
			$id,
			array(
				'label'   => $args['label'],
				'section' => 'optimalu_footer',
				'type'    => isset( $args['type'] ) ? $args['type'] : 'text',
			)
		);
	}
}
add_action( 'customize_register', 'optimalu_e_scan_footer_customize_register' );
