<?php
/**
 * Data loaders for reusable homepage sections.
 *
 * @package optimalu-e-scan
 */

if ( ! function_exists( 'optimalu_e_scan_get_registration_section_data' ) ) {
	/**
	 * Registration / booking section data for a page.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_registration_section_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$info_items_raw = optimalu_e_scan_get_section_field( 'registration_info_items', $post_id );
		$info_items     = array();

		if ( is_array( $info_items_raw ) && ! empty( $info_items_raw ) ) {
			for ( $i = 1; $i <= 4; $i++ ) {
				$item = isset( $info_items_raw[ "info_item_{$i}" ] ) ? trim( (string) $info_items_raw[ "info_item_{$i}" ] ) : '';

				if ( $item ) {
					$info_items[] = $item;
				}
			}
		}

		$data = array(
			'eyebrow'            => (string) optimalu_e_scan_get_section_field( 'registration_eyebrow', $post_id ),
			'title'              => (string) optimalu_e_scan_get_section_field( 'registration_title', $post_id ),
			'title_highlight'    => (string) optimalu_e_scan_get_section_field( 'registration_title_highlight', $post_id ),
			'description'        => (string) optimalu_e_scan_get_section_field( 'registration_description', $post_id ),
			'info_heading'       => (string) optimalu_e_scan_get_section_field( 'registration_info_heading', $post_id ),
			'info_text'          => (string) optimalu_e_scan_get_section_field( 'registration_info_text', $post_id ),
			'info_items'         => $info_items,
			'faq_link_text'      => (string) optimalu_e_scan_get_section_field( 'registration_faq_link_text', $post_id ),
			'faq_link_url'       => (string) optimalu_e_scan_get_section_field( 'registration_faq_link_url', $post_id ),
			'booking_shortcode'  => (string) optimalu_e_scan_get_section_field( 'registration_booking_shortcode', $post_id ),
		);

		if ( '' === $data['eyebrow'] ) {
			$data['eyebrow'] = 'Registracija';
		}

		if ( '' === $data['title'] ) {
			$data['title'] = 'Užsiregistruokite';
		}

		if ( '' === $data['title_highlight'] ) {
			$data['title_highlight'] = 'KT tyrimui';
		}

		if ( '' === $data['description'] ) {
			$data['description'] = 'Pasirinkite patogų laiką ir užpildykite paprastą formą. Su jumis susisieksime per 2 valandas, atsakysime į klausimus ir patvirtinsime vizitą. Viskas paprasta ir greita.';
		}

		if ( '' === $data['info_heading'] ) {
			$data['info_heading'] = 'Pasiruošimas KT tyrimui';
		}

		if ( '' === $data['info_text'] ) {
			$data['info_text'] = 'Prieš registraciją naudinga žinoti pagrindinę informaciją apie kompiuterinės tomografijos tyrimą. Jei turite klausimų — susisiekite arba peržiūrėkite DUK.';
		}

		if ( empty( $data['info_items'] ) ) {
			$data['info_items'] = array(
				'Paprastai nereikia specialaus pasiruošimo prieš tyrimą',
				'Atvykite 10–15 minučių anksčiau nurodytu laiku',
				'Informuokite specialistą apie alergijas, nėštumą ar inkstų funkciją',
				'Tyrimo rezultatus paprastai gausite per 24 valandas',
			);
		}

		if ( '' === $data['faq_link_text'] ) {
			$data['faq_link_text'] = 'Dažniausiai užduodami klausimai';
		}

		if ( '' === $data['faq_link_url'] ) {
			$data['faq_link_url'] = home_url( '/duk/' );
		}

		if ( '' === $data['booking_shortcode'] ) {
			$data['booking_shortcode'] = "[booking resource_id=1 form_type='standard']";
		}

		return $data;
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_specialists_section_data' ) ) {
	/**
	 * Specialists section data for a page.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_specialists_section_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items_raw  = optimalu_e_scan_get_section_field( 'specialists_items', $post_id );
		$specialists = array();

		if ( is_array( $items_raw ) && ! empty( $items_raw ) ) {
			for ( $i = 1; $i <= 4; $i++ ) {
				$photo_raw = isset( $items_raw[ "specialist_{$i}_photo" ] ) ? $items_raw[ "specialist_{$i}_photo" ] : null;

				if ( empty( $photo_raw ) && $post_id ) {
					$photo_raw = get_post_meta( $post_id, "specialists_items_specialist_{$i}_photo", true );
				}

				$name      = isset( $items_raw[ "specialist_{$i}_name" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_name" ] ) : '';
				$position  = isset( $items_raw[ "specialist_{$i}_position" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_position" ] ) : '';
				$desc      = isset( $items_raw[ "specialist_{$i}_description" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_description" ] ) : '';
				$link_text = isset( $items_raw[ "specialist_{$i}_link_text" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_link_text" ] ) : '';
				$link_url  = isset( $items_raw[ "specialist_{$i}_link_url" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_link_url" ] ) : '';

				if ( ! $name && ! $position && ! $desc && empty( $photo_raw ) ) {
					continue;
				}

				$photo = optimalu_e_scan_resolve_specialist_photo( $photo_raw, $name );

				$specialists[] = array(
					'photo_url' => $photo['photo_url'],
					'photo_alt' => $photo['photo_alt'],
					'name'      => $name,
					'position'  => $position,
					'desc'      => $desc,
					'link_text' => $link_text,
					'link_url'  => $link_url,
				);
			}
		}

		$data = array(
			'eyebrow'            => (string) optimalu_e_scan_get_section_field( 'specialists_eyebrow', $post_id ),
			'title'              => (string) optimalu_e_scan_get_section_field( 'specialists_title', $post_id ),
			'title_highlight'    => (string) optimalu_e_scan_get_section_field( 'specialists_title_highlight', $post_id ),
			'description'        => (string) optimalu_e_scan_get_section_field( 'specialists_description', $post_id ),
			'specialists'        => $specialists,
			'footer_link_text'   => (string) optimalu_e_scan_get_section_field( 'specialists_footer_link_text', $post_id ),
			'footer_link_url'    => (string) optimalu_e_scan_get_section_field( 'specialists_footer_link_url', $post_id ),
		);

		if ( '' === $data['eyebrow'] ) {
			$data['eyebrow'] = 'Komanda';
		}

		if ( '' === $data['title'] ) {
			$data['title'] = 'Mūsų';
		}

		if ( '' === $data['title_highlight'] ) {
			$data['title_highlight'] = 'specialistai';
		}

		if ( '' === $data['description'] ) {
			$data['description'] = 'Sertifikuoti radiologai su tarptautine patirtimi ir nuolatine kvalifikacijos kėlimu.';
		}

		if ( empty( $data['specialists'] ) ) {
			$data['specialists'] = array(
				array(
					'photo_url' => '',
					'photo_alt' => 'Dr. Rasa Petrauskienė',
					'name'      => 'Dr. Rasa Petrauskienė',
					'position'  => 'Radiologė',
					'desc'      => 'KT diagnostika',
					'link_text' => '',
					'link_url'  => '',
				),
				array(
					'photo_url' => '',
					'photo_alt' => 'Dr. Tomas Kazlauskas',
					'name'      => 'Dr. Tomas Kazlauskas',
					'position'  => 'Radiologas',
					'desc'      => 'Diagnostinė radiologija',
					'link_text' => '',
					'link_url'  => '',
				),
				array(
					'photo_url' => '',
					'photo_alt' => 'Dr. Aistė Rimkutė',
					'name'      => 'Dr. Aistė Rimkutė',
					'position'  => 'Radiologė',
					'desc'      => 'KT diagnostika',
					'link_text' => '',
					'link_url'  => '',
				),
			);
		}

		$data['heading'] = trim( $data['title'] . ' ' . $data['title_highlight'] );

		if ( '' === $data['footer_link_text'] ) {
			$data['footer_link_text'] = 'Susipažinkite su komanda plačiau';
		}

		if ( '' === $data['footer_link_url'] ) {
			$data['footer_link_url'] = home_url( '/komanda/' );
		}

		return $data;
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_section_data' ) ) {
	/**
	 * Contact / location section data for a page.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_contact_section_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$data = array(
			'eyebrow'               => (string) optimalu_e_scan_get_section_field( 'contact_eyebrow', $post_id ),
			'title'                 => (string) optimalu_e_scan_get_section_field( 'contact_title', $post_id ),
			'title_highlight'       => (string) optimalu_e_scan_get_section_field( 'contact_title_highlight', $post_id ),
			'address_label'         => (string) optimalu_e_scan_get_section_field( 'contact_address_label', $post_id ),
			'address'               => (string) optimalu_e_scan_get_section_field( 'contact_address', $post_id ),
			'phone_label'           => (string) optimalu_e_scan_get_section_field( 'contact_phone_label', $post_id ),
			'phone'                 => (string) optimalu_e_scan_get_section_field( 'contact_phone', $post_id ),
			'email_label'           => (string) optimalu_e_scan_get_section_field( 'contact_email_label', $post_id ),
			'email'                 => (string) optimalu_e_scan_get_section_field( 'contact_email', $post_id ),
			'hours_label'           => (string) optimalu_e_scan_get_section_field( 'contact_hours_label', $post_id ),
			'hours_main'            => (string) optimalu_e_scan_get_section_field( 'contact_hours_main', $post_id ),
			'hours_secondary'       => (string) optimalu_e_scan_get_section_field( 'contact_hours_secondary', $post_id ),
			'cta_text'              => (string) optimalu_e_scan_get_section_field( 'contact_cta_text', $post_id ),
			'cta_url'               => (string) optimalu_e_scan_get_section_field( 'contact_cta_url', $post_id ),
			'secondary_link_text'   => (string) optimalu_e_scan_get_section_field( 'contact_secondary_link_text', $post_id ),
			'secondary_link_url'    => (string) optimalu_e_scan_get_section_field( 'contact_secondary_link_url', $post_id ),
			'map_embed'             => (string) optimalu_e_scan_get_section_field( 'contact_map_embed', $post_id ),
		);

		if ( '' === $data['eyebrow'] ) {
			$data['eyebrow'] = 'Kontaktai ir lokacija';
		}

		if ( '' === $data['title'] ) {
			$data['title'] = 'Susisiekite';
		}

		if ( '' === $data['title_highlight'] ) {
			$data['title_highlight'] = 'su mumis';
		}

		if ( '' === $data['address_label'] ) {
			$data['address_label'] = 'Adresas';
		}

		if ( '' === $data['address'] ) {
			$data['address'] = "Gedimino pr. 28, Vilnius\nLT-01104";
		}

		if ( '' === $data['phone_label'] ) {
			$data['phone_label'] = 'Telefonas';
		}

		if ( '' === $data['phone'] ) {
			$data['phone'] = '+370 5 222 33 44';
		}

		if ( '' === $data['email_label'] ) {
			$data['email_label'] = 'El. paštas';
		}

		if ( '' === $data['email'] ) {
			$data['email'] = 'info@e-scan.lt';
		}

		if ( '' === $data['hours_label'] ) {
			$data['hours_label'] = 'Darbo laikas';
		}

		if ( '' === $data['hours_main'] ) {
			$data['hours_main'] = 'I–V: 8:00–20:00';
		}

		if ( '' === $data['hours_secondary'] ) {
			$data['hours_secondary'] = 'VI: 9:00–15:00';
		}

		if ( '' === $data['cta_text'] ) {
			$data['cta_text'] = 'Registruotis tyrimui';
		}

		if ( '' === $data['cta_url'] ) {
			$data['cta_url'] = '#booking';
		}

		if ( '' === $data['secondary_link_text'] ) {
			$data['secondary_link_text'] = 'Daugiau kontaktinės informacijos';
		}

		if ( '' === $data['secondary_link_url'] ) {
			$data['secondary_link_url'] = home_url( '/kontaktai/' );
		}

		$data['address_lines'] = optimalu_e_scan_get_contact_address_lines( $data['address'] );
		$data['phone_href']    = preg_replace( '/[^\d+]/', '', $data['phone'] );
		$data['map_markup']    = optimalu_e_scan_get_contact_map_iframe( $data['map_embed'] );

		return $data;
	}
}
