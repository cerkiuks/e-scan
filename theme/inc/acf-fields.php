<?php
/**
 * ACF local field registrations for the theme.
 *
 * @package optimalu-e-scan
 */

/**
 * Register simple ACF fields for the example page template.
 */
function optimalu_e_scan_register_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_example_template',
			'title'                 => 'Example Template Fields',
			'fields'                => array(
				array(
					'key'           => 'field_optimalu_hero_title',
					'label'         => 'Hero Title',
					'name'          => 'hero_title',
					'aria-label'    => '',
					'type'          => 'text',
					'instructions'  => 'Optional override for the page hero title.',
					'required'      => 0,
					'default_value' => '',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-template-example.php',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => '',
			'active'                => true,
			'description'           => 'Minimal ACF POC group for example template.',
		)
	);
}
add_action( 'acf/init', 'optimalu_e_scan_register_acf_fields' );
