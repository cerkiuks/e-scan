<?php
/**
 * ACF field group for the Contact page template.
 *
 * @package optimalu-e-scan
 */

/**
 * Company row sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_contact_page_company_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_cp_company_{$index}_label",
			'label' => sprintf( 'Įmonės eilutė %d — etiketė', $index ),
			'name'  => "company_{$index}_label",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_cp_company_{$index}_value",
			'label' => sprintf( 'Įmonės eilutė %d — reikšmė', $index ),
			'name'  => "company_{$index}_value",
			'type'  => 'text',
		),
	);
}

/**
 * FAQ slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_contact_page_faq_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_cp_faq_{$index}_question",
			'label' => sprintf( 'Klausimas %d', $index ),
			'name'  => "faq_{$index}_question",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_cp_faq_{$index}_answer",
			'label' => sprintf( 'Atsakymas %d', $index ),
			'name'  => "faq_{$index}_answer",
			'type'  => 'textarea',
			'rows'  => 3,
		),
	);
}

/**
 * Contact item slot sub-fields.
 *
 * @param int $index Slot index.
 * @return array<int, array<string, mixed>>
 */
function optimalu_e_scan_get_contact_page_item_slot_sub_fields( $index ) {
	return array(
		array(
			'key'   => "field_optimalu_cp_item_{$index}_label",
			'label' => sprintf( 'Kontaktas %d — etiketė', $index ),
			'name'  => "item_{$index}_label",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_cp_item_{$index}_primary",
			'label' => sprintf( 'Kontaktas %d — pagrindinė eilutė', $index ),
			'name'  => "item_{$index}_primary",
			'type'  => 'text',
		),
		array(
			'key'   => "field_optimalu_cp_item_{$index}_secondary",
			'label' => sprintf( 'Kontaktas %d — antra eilutė', $index ),
			'name'  => "item_{$index}_secondary",
			'type'  => 'text',
		),
		array(
			'key'           => "field_optimalu_cp_item_{$index}_url",
			'label'         => sprintf( 'Kontaktas %d — nuoroda', $index ),
			'name'          => "item_{$index}_url",
			'type'          => 'text',
			'instructions'  => 'Tel., el. paštas arba žemėlapio nuoroda. Palikus tuščią, telefonas ir el. paštas susiejami automatiškai.',
		),
		array(
			'key'           => "field_optimalu_cp_item_{$index}_type",
			'label'         => sprintf( 'Kontaktas %d — tipas', $index ),
			'name'          => "item_{$index}_type",
			'type'          => 'select',
			'choices'       => array(
				'address' => 'Adresas',
				'phone'   => 'Telefonas',
				'email'   => 'El. paštas',
				'hours'   => 'Darbo laikas',
				'other'   => 'Kita',
			),
			'default_value' => 'other',
			'allow_null'    => 0,
			'ui'            => 0,
		),
	);
}

/**
 * Register Contact page ACF fields.
 */
function optimalu_e_scan_register_contact_page_acf_fields() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	$company_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CP_COMPANY_SLOTS; $i++ ) {
		$company_sub_fields = array_merge( $company_sub_fields, optimalu_e_scan_get_contact_page_company_slot_sub_fields( $i ) );
	}

	$faq_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CP_FAQ_SLOTS; $i++ ) {
		$faq_sub_fields = array_merge( $faq_sub_fields, optimalu_e_scan_get_contact_page_faq_slot_sub_fields( $i ) );
	}

	$item_sub_fields = array();
	for ( $i = 1; $i <= OPTIMALU_E_SCAN_CP_CONTACT_SLOTS; $i++ ) {
		$item_sub_fields = array_merge( $item_sub_fields, optimalu_e_scan_get_contact_page_item_slot_sub_fields( $i ) );
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_optimalu_contact_page',
			'title'                 => 'Kontaktų puslapis',
			'fields'                => array(
				array(
					'key'   => 'field_optimalu_cp_tab_hero',
					'label' => 'Hero',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_cp_hero_eyebrow',
					'label' => 'Antgalvė',
					'name'  => 'cp_hero_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_hero_title',
					'label' => 'Antraštė',
					'name'  => 'cp_hero_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_hero_title_highlight',
					'label' => 'Antraštės akcentas',
					'name'  => 'cp_hero_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_hero_description',
					'label' => 'Aprašymas',
					'name'  => 'cp_hero_description',
					'type'  => 'textarea',
					'rows'  => 3,
				),
				array(
					'key'   => 'field_optimalu_cp_tab_company',
					'label' => 'Rekvizitai',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_cp_company_eyebrow',
					'label' => 'Rekvizitai — antgalvė',
					'name'  => 'cp_company_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_company_title',
					'label' => 'Rekvizitai — antraštė',
					'name'  => 'cp_company_title',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_cp_company_items',
					'label'        => 'Įmonės duomenys',
					'name'         => 'cp_company_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CP_COMPANY_SLOTS . ' eilučių. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $company_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_cp_bank_title',
					'label' => 'Banko blokas — antraštė',
					'name'  => 'cp_bank_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_name_label',
					'label' => 'Bankas — etiketė',
					'name'  => 'cp_bank_name_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_name',
					'label' => 'Bankas',
					'name'  => 'cp_bank_name',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_iban_label',
					'label' => 'IBAN — etiketė',
					'name'  => 'cp_bank_iban_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_iban',
					'label' => 'IBAN',
					'name'  => 'cp_bank_iban',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_swift_label',
					'label' => 'SWIFT — etiketė',
					'name'  => 'cp_bank_swift_label',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_bank_swift',
					'label' => 'SWIFT',
					'name'  => 'cp_bank_swift',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_tab_faq',
					'label' => 'Praktinė informacija',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_cp_faq_eyebrow',
					'label' => 'DUK — antgalvė',
					'name'  => 'cp_faq_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_faq_title',
					'label' => 'DUK — antraštė',
					'name'  => 'cp_faq_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_faq_title_highlight',
					'label' => 'DUK — antraštės akcentas',
					'name'  => 'cp_faq_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_cp_faq_items',
					'label'        => 'Klausimai ir atsakymai',
					'name'         => 'cp_faq_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CP_FAQ_SLOTS . ' klausimų. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $faq_sub_fields,
				),
				array(
					'key'   => 'field_optimalu_cp_tab_map',
					'label' => 'Kontaktai ir žemėlapis',
					'name'  => '',
					'type'  => 'tab',
				),
				array(
					'key'   => 'field_optimalu_cp_map_eyebrow',
					'label' => 'Kontaktų blokas — antgalvė',
					'name'  => 'cp_map_eyebrow',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_map_title',
					'label' => 'Kontaktų blokas — antraštė',
					'name'  => 'cp_map_title',
					'type'  => 'text',
				),
				array(
					'key'   => 'field_optimalu_cp_map_title_highlight',
					'label' => 'Kontaktų blokas — antraštės akcentas',
					'name'  => 'cp_map_title_highlight',
					'type'  => 'text',
				),
				array(
					'key'          => 'field_optimalu_cp_contact_items',
					'label'        => 'Kontaktų sąrašas',
					'name'         => 'cp_contact_items',
					'type'         => 'group',
					'layout'       => 'block',
					'instructions' => 'Iki ' . OPTIMALU_E_SCAN_CP_CONTACT_SLOTS . ' eilučių. Tuščios pozicijos nerodomos.',
					'sub_fields'   => $item_sub_fields,
				),
				array(
					'key'           => 'field_optimalu_cp_map_embed',
					'label'         => 'Žemėlapio įterpimo kodas arba URL',
					'name'          => 'cp_map_embed',
					'type'          => 'textarea',
					'rows'          => 4,
					'instructions'  => 'Google Maps iframe arba įterpimo nuoroda. Palikus tuščią, naudojama numatytoji Gedimino pr. 28 vieta.',
				),
				array(
					'key'   => 'field_optimalu_cp_map_iframe_title',
					'label' => 'Žemėlapio iframe pavadinimas',
					'name'  => 'cp_map_iframe_title',
					'type'  => 'text',
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'page_template',
						'operator' => '==',
						'value'    => 'page-template-contact.php',
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
add_action( 'acf/init', 'optimalu_e_scan_register_contact_page_acf_fields' );
