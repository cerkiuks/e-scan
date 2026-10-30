<?php
/**
 * Data loaders for the Contact page template.
 *
 * @package optimalu-e-scan
 */

if ( ! defined( 'OPTIMALU_E_SCAN_CP_COMPANY_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CP_COMPANY_SLOTS', 4 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CP_FAQ_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CP_FAQ_SLOTS', 6 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CP_CONTACT_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CP_CONTACT_SLOTS', 6 );
}

if ( ! function_exists( 'optimalu_e_scan_is_contact_page_template' ) ) {
	/**
	 * Whether the current request uses the Contact page template.
	 *
	 * @return bool
	 */
	function optimalu_e_scan_is_contact_page_template() {
		return is_page_template( 'page-template-contact.php' );
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_page_field' ) ) {
	/**
	 * Read a Contact page ACF field.
	 *
	 * @param string   $field_name Field name.
	 * @param int|null $post_id    Post ID.
	 * @return mixed
	 */
	function optimalu_e_scan_get_contact_page_field( $field_name, $post_id = null ) {
		if ( ! function_exists( 'get_field' ) ) {
			return null;
		}

		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		if ( ! $post_id ) {
			return null;
		}

		return get_field( $field_name, $post_id );
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_page_slot_items' ) ) {
	/**
	 * Collect filled numbered slots from an ACF group.
	 *
	 * @param mixed    $group  Group field value.
	 * @param string   $prefix Slot name prefix.
	 * @param string[] $keys   Sub keys without index.
	 * @param int      $max    Slot count.
	 * @return array<int, array<string, string>>
	 */
	function optimalu_e_scan_get_contact_page_slot_items( $group, $prefix, $keys, $max ) {
		$items = array();

		if ( ! is_array( $group ) ) {
			return $items;
		}

		for ( $i = 1; $i <= $max; $i++ ) {
			$item    = array();
			$has_val = false;

			foreach ( $keys as $key ) {
				$field_key    = "{$prefix}_{$i}_{$key}";
				$item[ $key ] = isset( $group[ $field_key ] ) ? trim( (string) $group[ $field_key ] ) : '';
				if ( '' !== $item[ $key ] ) {
					$has_val = true;
				}
			}

			if ( $has_val ) {
				$items[] = $item;
			}
		}

		return $items;
	}
}

if ( ! function_exists( 'optimalu_e_scan_resolve_contact_item_url' ) ) {
	/**
	 * Build a tel/mailto/maps URL when the explicit link is empty.
	 *
	 * @param string $type    Item type.
	 * @param string $primary Primary value.
	 * @param string $url     Explicit URL.
	 * @return string
	 */
	function optimalu_e_scan_resolve_contact_item_url( $type, $primary, $url ) {
		if ( '' !== $url ) {
			return $url;
		}

		if ( 'phone' === $type && '' !== $primary ) {
			$tel = preg_replace( '/[^\d+]/', '', $primary );
			return $tel ? 'tel:' . $tel : '';
		}

		if ( 'email' === $type && is_email( $primary ) ) {
			return 'mailto:' . $primary;
		}

		return '';
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_page_hero_data' ) ) {
	/**
	 * Hero data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, string>
	 */
	function optimalu_e_scan_get_contact_page_hero_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow'         => (string) optimalu_e_scan_get_contact_page_field( 'cp_hero_eyebrow', $post_id ),
			'title'           => (string) optimalu_e_scan_get_contact_page_field( 'cp_hero_title', $post_id ),
			'title_highlight' => (string) optimalu_e_scan_get_contact_page_field( 'cp_hero_title_highlight', $post_id ),
			'description'     => (string) optimalu_e_scan_get_contact_page_field( 'cp_hero_description', $post_id ),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_page_details_data' ) ) {
	/**
	 * Rekvizitai + FAQ data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_contact_page_details_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'company_eyebrow' => (string) optimalu_e_scan_get_contact_page_field( 'cp_company_eyebrow', $post_id ),
			'company_title'   => (string) optimalu_e_scan_get_contact_page_field( 'cp_company_title', $post_id ),
			'company_items'   => optimalu_e_scan_get_contact_page_slot_items(
				optimalu_e_scan_get_contact_page_field( 'cp_company_items', $post_id ),
				'company',
				array( 'label', 'value' ),
				OPTIMALU_E_SCAN_CP_COMPANY_SLOTS
			),
			'bank_title'      => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_title', $post_id ),
			'bank_name_label' => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_name_label', $post_id ),
			'bank_name'       => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_name', $post_id ),
			'bank_iban_label' => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_iban_label', $post_id ),
			'bank_iban'       => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_iban', $post_id ),
			'bank_swift_label' => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_swift_label', $post_id ),
			'bank_swift'      => (string) optimalu_e_scan_get_contact_page_field( 'cp_bank_swift', $post_id ),
			'faq_eyebrow'     => (string) optimalu_e_scan_get_contact_page_field( 'cp_faq_eyebrow', $post_id ),
			'faq_title'       => (string) optimalu_e_scan_get_contact_page_field( 'cp_faq_title', $post_id ),
			'faq_title_highlight' => (string) optimalu_e_scan_get_contact_page_field( 'cp_faq_title_highlight', $post_id ),
			'faq_items'       => optimalu_e_scan_get_contact_page_slot_items(
				optimalu_e_scan_get_contact_page_field( 'cp_faq_items', $post_id ),
				'faq',
				array( 'question', 'answer' ),
				OPTIMALU_E_SCAN_CP_FAQ_SLOTS
			),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_page_map_data' ) ) {
	/**
	 * Map + contact panel data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_contact_page_map_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$raw_items = optimalu_e_scan_get_contact_page_slot_items(
			optimalu_e_scan_get_contact_page_field( 'cp_contact_items', $post_id ),
			'item',
			array( 'label', 'primary', 'secondary', 'url', 'type' ),
			OPTIMALU_E_SCAN_CP_CONTACT_SLOTS
		);

		$items = array();
		foreach ( $raw_items as $item ) {
			if ( '' === $item['label'] && '' === $item['primary'] && '' === $item['secondary'] ) {
				continue;
			}

			$type         = $item['type'] ? $item['type'] : 'other';
			$item['type'] = $type;
			$item['href'] = optimalu_e_scan_resolve_contact_item_url( $type, $item['primary'], $item['url'] );
			$items[]      = $item;
		}

		$map_title = (string) optimalu_e_scan_get_contact_page_field( 'cp_map_iframe_title', $post_id );
		$map_embed = (string) optimalu_e_scan_get_contact_page_field( 'cp_map_embed', $post_id );

		return array(
			'eyebrow'         => (string) optimalu_e_scan_get_contact_page_field( 'cp_map_eyebrow', $post_id ),
			'title'           => (string) optimalu_e_scan_get_contact_page_field( 'cp_map_title', $post_id ),
			'title_highlight' => (string) optimalu_e_scan_get_contact_page_field( 'cp_map_title_highlight', $post_id ),
			'items'           => $items,
			'map_markup'      => optimalu_e_scan_get_contact_map_iframe( $map_embed, $map_title, 'contact-page-map__iframe' ),
		);
	}
}
