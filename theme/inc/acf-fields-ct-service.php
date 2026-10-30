<?php
/**
 * ACF field group for the CT service page template.
 *
 * @package optimalu-e-scan
 */

/**
 * Slot sub-fields for titled text items.
 *
 * @param string $prefix Field key prefix.
 * @param string $name   Field name prefix.
 * @param string $label  Admin label prefix.
 * @param int    $index  Slot index.
 * @param string $title_key Title sub-name.
 * @param string $text_key  Text sub-name.
 * @param string $title_label Title label.
 * @param string $text_label  Text label.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_ct_text_slot_sub_fields( $prefix, $name, $label, $index, $title_key, $text_key, $title_label, $text_label ) {
	return array(
		array(
			'key'   => "field_optimalu_{$prefix}_{$index}_{$title_key}",
			'label' => sprintf( '%s %d — %s', $label, $index, $title_label ),
			'name'  => "{$name}_{$index}_{$title_key}",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_{$prefix}_{$index}_{$text_key}",
			'label' => sprintf( '%s %d — %s', $label, $index, $text_label ),
			'name'  => "{$name}_{$index}_{$text_key}",
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);
}

/**
 * Register CT service ACF fields.
 */
function optimalu_e_scan_register_ct_service_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$exam_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_EXAM_SLOTS; $i++ ) {
		$exam_sub_fields = array_merge(
			$exam_sub_fields,
			optimalu_e_scan_get_ct_text_slot_sub_fields( 'ct_exam', 'exam', 'Tyrimas', $i, 'title', 'text', 'pavadinimas', 'aprašymas' )
		);
	}

	$process_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_PROCESS_SLOTS; $i++ ) {
		$process_sub_fields = array_merge(
			$process_sub_fields,
			optimalu_e_scan_get_ct_text_slot_sub_fields( 'ct_step', 'step', 'Žingsnis', $i, 'title', 'text', 'pavadinimas', 'aprašymas' )
		);
	}

	$prep_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_PREP_SLOTS; $i++ ) {
		$prep_sub_fields = array_merge(
			$prep_sub_fields,
			optimalu_e_scan_get_ct_text_slot_sub_fields( 'ct_prep', 'prep', 'Pasiruošimas', $i, 'title', 'text', 'pavadinimas', 'aprašymas' )
		);
	}

	$faq_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_FAQ_SLOTS; $i++ ) {
		$faq_sub_fields = array_merge(
			$faq_sub_fields,
			optimalu_e_scan_get_ct_text_slot_sub_fields( 'ct_faq', 'faq', 'DUK', $i, 'question', 'answer', 'klausimas', 'atsakymas' )
		);
	}

	$gallery_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_GALLERY_SLOTS; $i++ ) {
		$gallery_sub_fields[] = array(
			'key'           => "field_optimalu_ct_gallery_{$i}_image",
			'label'         => sprintf( 'Galerijos nuotrauka %d', $i ),
			'name'          => "gallery_{$i}_image",
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		);
		$gallery_sub_fields[] = array(
			'key'   => "field_optimalu_ct_gallery_{$i}_alt",
			'label' => sprintf( 'Galerijos nuotraukos %d alt tekstas', $i ),
			'name'  => "gallery_{$i}_alt",
			'type'  => 'text',
		);
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_ct_service',
			'title'                 => 'KT tyrimo puslapis',
			'fields'                => array(
				array(
					'key'   => 'field_optimalu_ct_tab_hero',
					'label' => 'Hero',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_breadcrumb_home',
					'label' => 'Trupininė navigacija — pradžia',
					'name'  => 'ct_hero_breadcrumb_home',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_breadcrumb_parent',
					'label' => 'Trupininė navigacija — tėvinis puslapis',
					'name'  => 'ct_hero_breadcrumb_parent',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_breadcrumb_current',
					'label' => 'Trupininė navigacija — dabartinis puslapis',
					'name'  => 'ct_hero_breadcrumb_current',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_title',
					'label' => 'Hero antraštė',
					'name'  => 'ct_hero_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_title_highlight',
					'label' => 'Hero antraštės akcentas',
					'name'  => 'ct_hero_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_description',
					'label' => 'Hero aprašymas',
					'name'  => 'ct_hero_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_optimalu_ct_hero_primary_text',
					'label' => 'Pagrindinio mygtuko tekstas',
					'name'  => 'ct_hero_primary_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_primary_url',
					'label' => 'Pagrindinio mygtuko nuoroda',
					'name'  => 'ct_hero_primary_url',
					'type'  => 'url',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_secondary_text',
					'label' => 'Antro mygtuko tekstas',
					'name'  => 'ct_hero_secondary_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_hero_secondary_url',
					'label' => 'Antro mygtuko nuoroda',
					'name'  => 'ct_hero_secondary_url',
					'type'  => 'text',
				),
				array(
					'key'           => 'field_optimalu_ct_featured_image',
					'label'         => 'Hero nuotrauka',
					'name'          => 'ct_featured_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'   => 'field_optimalu_ct_badge_eyebrow',
					'label' => 'Ženkliuko viršutinė eilutė',
					'name'  => 'ct_badge_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_badge_text',
					'label' => 'Ženkliuko tekstas',
					'name'  => 'ct_badge_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_tab_about',
					'label' => 'Apie tyrimą',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_about_eyebrow',
					'label' => 'Apie tyrimą — antgalvė',
					'name'  => 'ct_about_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_about_title',
					'label' => 'Apie tyrimą — antraštė',
					'name'  => 'ct_about_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_about_paragraph_1',
					'label' => 'Apie tyrimą — 1 pastraipa',
					'name'  => 'ct_about_paragraph_1',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'   => 'field_optimalu_ct_about_paragraph_2',
					'label' => 'Apie tyrimą — 2 pastraipa',
					'name'  => 'ct_about_paragraph_2',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'   => 'field_optimalu_ct_about_paragraph_3',
					'label' => 'Apie tyrimą — 3 pastraipa',
					'name'  => 'ct_about_paragraph_3',
					'type'  => 'textarea',
					'rows'  => 4,
				),
				array(
					'key'           => 'field_optimalu_ct_about_image',
					'label'         => 'Apie tyrimą — nuotrauka',
					'name'          => 'ct_about_image',
					'type'          => 'image',
					'return_format' => 'array',
					'preview_size'  => 'medium',
					'library'       => 'all',
				),
				array(
					'key'   => 'field_optimalu_ct_tab_exams',
					'label' => 'Atliekami tyrimai',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_exams_eyebrow',
					'label' => 'Tyrimai — antgalvė',
					'name'  => 'ct_exams_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_exams_title',
					'label' => 'Tyrimai — antraštė',
					'name'  => 'ct_exams_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_exams_intro',
					'label' => 'Tyrimai — įvadas',
					'name'  => 'ct_exams_intro',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'          => 'field_optimalu_ct_exams_items',
					'label'        => 'Tyrimų sąrašas',
					'name'         => 'ct_exams_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CT_EXAM_SLOTS . ' įrašų. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $exam_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_ct_tab_process',
					'label' => 'Tyrimo eiga',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_process_eyebrow',
					'label' => 'Eiga — antgalvė',
					'name'  => 'ct_process_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_process_title',
					'label' => 'Eiga — antraštė',
					'name'  => 'ct_process_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_process_intro',
					'label' => 'Eiga — įvadas',
					'name'  => 'ct_process_intro',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'          => 'field_optimalu_ct_process_items',
					'label'        => 'Eigos žingsniai',
					'name'         => 'ct_process_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CT_PROCESS_SLOTS . ' žingsnių. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $process_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_ct_tab_prep',
					'label' => 'Pasiruošimas',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_prep_eyebrow',
					'label' => 'Pasiruošimas — antgalvė',
					'name'  => 'ct_prep_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_prep_title',
					'label' => 'Pasiruošimas — antraštė',
					'name'  => 'ct_prep_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_prep_intro',
					'label' => 'Pasiruošimas — įvadas',
					'name'  => 'ct_prep_intro',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'          => 'field_optimalu_ct_prep_items',
					'label'        => 'Pasiruošimo punktai',
					'name'         => 'ct_prep_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki 4 punktų. Paskutinis užpildytas punktas rodomas kaip išskirta atmintinė.',
					'sub_fields'   => $prep_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_ct_tab_gallery',
					'label' => 'Galerija',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'          => 'field_optimalu_ct_gallery_items',
					'label'        => 'Galerijos nuotraukos',
					'name'         => 'ct_gallery_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CT_GALLERY_SLOTS . ' nuotraukų. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $gallery_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_ct_tab_faq',
					'label' => 'DUK',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_faq_eyebrow',
					'label' => 'DUK — antgalvė',
					'name'  => 'ct_faq_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_faq_title',
					'label' => 'DUK — antraštė',
					'name'  => 'ct_faq_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_faq_intro',
					'label' => 'DUK — įvadas',
					'name'  => 'ct_faq_intro',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'          => 'field_optimalu_ct_faq_items',
					'label'        => 'DUK klausimai',
					'name'         => 'ct_faq_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CT_FAQ_SLOTS . ' klausimų. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $faq_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_ct_tab_cta',
					'label' => 'Registracijos kvietimas',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_ct_cta_eyebrow',
					'label' => 'Kvietimas — antgalvė',
					'name'  => 'ct_cta_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_cta_title',
					'label' => 'Kvietimas — antraštė',
					'name'  => 'ct_cta_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_cta_description',
					'label' => 'Kvietimas — aprašymas',
					'name'  => 'ct_cta_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_optimalu_ct_cta_button_text',
					'label' => 'Kvietimo mygtuko tekstas',
					'name'  => 'ct_cta_button_text',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_ct_cta_button_url',
					'label' => 'Kvietimo mygtuko nuoroda',
					'name'  => 'ct_cta_button_url',
					'type'  => 'url',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-template-ct-service.php',
					),
				),
			),
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'show_in_rest'          => 0,
		)
	);
}
add_action( 'acf/init', 'optimalu_e_scan_register_ct_service_acf_fields' );
