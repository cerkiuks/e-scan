<?php
/**
 * ACF field group for the About page template.
 *
 * @package optimalu-e-scan
 */

/**
 * Build timeline slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_about_timeline_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_about_timeline_{$index}_year",
			'label' => "Timeline {$index} year",
			'name'  => "timeline_item_{$index}_year",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_timeline_{$index}_title",
			'label' => "Timeline {$index} title",
			'name'  => "timeline_item_{$index}_title",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_timeline_{$index}_text",
			'label' => "Timeline {$index} text",
			'name'  => "timeline_item_{$index}_text",
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);
}

/**
 * Build values slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_about_values_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_about_value_{$index}_number",
			'label' => "Value {$index} number",
			'name'  => "value_{$index}_number",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_value_{$index}_title",
			'label' => "Value {$index} title",
			'name'  => "value_{$index}_title",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_value_{$index}_text",
			'label' => "Value {$index} text",
			'name'  => "value_{$index}_text",
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);
}

/**
 * Build stats slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_about_stats_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_about_stat_{$index}_value",
			'label' => "Stat {$index} value",
			'name'  => "stat_{$index}_value",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_stat_{$index}_label",
			'label' => "Stat {$index} label",
			'name'  => "stat_{$index}_label",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_stat_{$index}_text",
			'label' => "Stat {$index} text",
			'name'  => "stat_{$index}_text",
			'type'  => 'text',
		),
	);
}

/**
 * Build about-page specialist slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_about_specialist_slot_sub_fields( $index ) {
	return array(
		array(
			'key'           => "field_optimalu_about_specialist_{$index}_photo",
			'label'         => "Specialist {$index} photo",
			'name'          => "specialist_{$index}_photo",
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		),
		array(
			'key'   => "field_optimalu_about_specialist_{$index}_name",
			'label' => "Specialist {$index} name",
			'name'  => "specialist_{$index}_name",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_specialist_{$index}_position",
			'label' => "Specialist {$index} position",
			'name'  => "specialist_{$index}_position",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_about_specialist_{$index}_category",
			'label' => "Specialist {$index} category",
			'name'  => "specialist_{$index}_category",
			'type'  => 'text',
		),
	);
}

/**
 * Register About page ACF fields.
 */
function optimalu_e_scan_register_about_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$timeline_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_TIMELINE_SLOTS; $i++ ) {
		$timeline_sub_fields = array_merge( $timeline_sub_fields, optimalu_e_scan_get_about_timeline_slot_sub_fields( $i ) );
	}

	$values_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_VALUES_SLOTS; $i++ ) {
		$values_sub_fields = array_merge( $values_sub_fields, optimalu_e_scan_get_about_values_slot_sub_fields( $i ) );
	}

	$stats_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_STATS_SLOTS; $i++ ) {
		$stats_sub_fields = array_merge( $stats_sub_fields, optimalu_e_scan_get_about_stats_slot_sub_fields( $i ) );
	}

	$specialists_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_SPECIALISTS_SLOTS; $i++ ) {
		$specialists_sub_fields = array_merge( $specialists_sub_fields, optimalu_e_scan_get_about_specialist_slot_sub_fields( $i ) );
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_about_page',
			'title'                 => 'About Page',
			'fields'                => array(
				array(
					'key'   => 'field_optimalu_about_tab_hero',
					'label' => 'Hero',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_hero_eyebrow',
					'label' => 'Hero eyebrow',
					'name'  => 'about_page_hero_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_hero_title',
					'label' => 'Hero title',
					'name'  => 'about_page_hero_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_hero_description',
					'label' => 'Hero description',
					'name'  => 'about_page_hero_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'           => 'field_optimalu_about_hero_image',
					'label'         => 'Hero image',
					'name'          => 'about_page_hero_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'   => 'field_optimalu_about_tab_history',
					'label' => 'History',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_history_eyebrow',
					'label' => 'History eyebrow',
					'name'  => 'about_page_history_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_history_title',
					'label' => 'History title',
					'name'  => 'about_page_history_title',
					'type'  => 'textarea',
					'rows'  => 2,
				),
				array(
					'key'   => 'field_optimalu_about_history_paragraph_1',
					'label' => 'History paragraph 1',
					'name'  => 'about_page_history_paragraph_1',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'   => 'field_optimalu_about_history_paragraph_2',
					'label' => 'History paragraph 2',
					'name'  => 'about_page_history_paragraph_2',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'   => 'field_optimalu_about_history_paragraph_3',
					'label' => 'History paragraph 3',
					'name'  => 'about_page_history_paragraph_3',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'           => 'field_optimalu_about_history_image',
					'label'         => 'History image',
					'name'          => 'about_page_history_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'   => 'field_optimalu_about_history_image_caption',
					'label' => 'History image caption',
					'name'  => 'about_page_history_image_caption',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_history_highlight_label',
					'label' => 'Highlight label',
					'name'  => 'about_page_history_highlight_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_history_highlight_value',
					'label' => 'Highlight value',
					'name'  => 'about_page_history_highlight_value',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_tab_timeline',
					'label' => 'Timeline',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_timeline_eyebrow',
					'label' => 'Timeline eyebrow',
					'name'  => 'about_page_timeline_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_timeline_title',
					'label' => 'Timeline title',
					'name'  => 'about_page_timeline_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_about_timeline_items',
					'label'        => 'Timeline items',
					'name'         => 'about_page_timeline_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Up to ' . OPTIMALU_E_SCAN_ABOUT_TIMELINE_SLOTS . ' items. Leave unused slots empty.',
					'sub_fields'   => $timeline_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_about_tab_values',
					'label' => 'Values',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_values_eyebrow',
					'label' => 'Values eyebrow',
					'name'  => 'about_page_values_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_values_title',
					'label' => 'Values title',
					'name'  => 'about_page_values_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_about_values_items',
					'label'        => 'Values items',
					'name'         => 'about_page_values_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Up to ' . OPTIMALU_E_SCAN_ABOUT_VALUES_SLOTS . ' items. Leave unused slots empty.',
					'sub_fields'   => $values_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_about_tab_stats',
					'label' => 'Statistics',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_stats_eyebrow',
					'label' => 'Stats eyebrow',
					'name'  => 'about_page_stats_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_stats_title',
					'label' => 'Stats title',
					'name'  => 'about_page_stats_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_about_stats_items',
					'label'        => 'Statistics items',
					'name'         => 'about_page_stats_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Up to ' . OPTIMALU_E_SCAN_ABOUT_STATS_SLOTS . ' items. Leave unused slots empty.',
					'sub_fields'   => $stats_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_about_tab_specialists',
					'label' => 'Specialists',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_specialists_eyebrow',
					'label' => 'Specialists eyebrow',
					'name'  => 'about_page_specialists_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_specialists_title',
					'label' => 'Specialists title',
					'name'  => 'about_page_specialists_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_specialists_title_highlight',
					'label' => 'Specialists title highlight',
					'name'  => 'about_page_specialists_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_specialists_description',
					'label' => 'Specialists description',
					'name'  => 'about_page_specialists_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'          => 'field_optimalu_about_specialists_items',
					'label'        => 'Specialists',
					'name'         => 'about_page_specialists_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Up to ' . OPTIMALU_E_SCAN_ABOUT_SPECIALISTS_SLOTS . ' specialists. Leave unused slots empty.',
					'sub_fields'   => $specialists_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_about_specialists_footer_link_text',
					'label' => 'Specialists footer link text',
					'name'  => 'about_page_specialists_footer_link_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_specialists_footer_link_url',
					'label' => 'Specialists footer link URL',
					'name'  => 'about_page_specialists_footer_link_url',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_optimalu_about_tab_cta',
					'label' => 'CTA',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_about_cta_eyebrow',
					'label' => 'CTA eyebrow',
					'name'  => 'about_page_cta_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_cta_title',
					'label' => 'CTA title',
					'name'  => 'about_page_cta_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_cta_title_highlight',
					'label' => 'CTA title highlight',
					'name'  => 'about_page_cta_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_cta_primary_text',
					'label' => 'Primary button text',
					'name'  => 'about_page_cta_primary_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_cta_primary_url',
					'label' => 'Primary button URL',
					'name'  => 'about_page_cta_primary_url',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_optimalu_about_cta_secondary_text',
					'label' => 'Secondary button text',
					'name'  => 'about_page_cta_secondary_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_about_cta_secondary_url',
					'label' => 'Secondary button URL',
					'name'  => 'about_page_cta_secondary_url',
					'type'  => 'url',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-template-about.php',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
