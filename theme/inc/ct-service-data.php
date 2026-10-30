<?php
/**
 * Data loaders for the CT service page template.
 *
 * @package optimalu-e-scan
 */

if ( ! defined( 'OPTIMALU_E_SCAN_CT_EXAM_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CT_EXAM_SLOTS', 10 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CT_PROCESS_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CT_PROCESS_SLOTS', 6 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CT_PREP_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CT_PREP_SLOTS', 4 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CT_FAQ_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CT_FAQ_SLOTS', 10 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_CT_GALLERY_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_CT_GALLERY_SLOTS', 2 );
}

if ( ! function_exists( 'optimalu_e_scan_is_ct_service_template' ) ) {
	/**
	 * Whether the current request uses the CT service page template.
	 *
	 * @return bool
	 */
	function optimalu_e_scan_is_ct_service_template() {
		return is_page_template( 'page-template-ct-service.php' );
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_field' ) ) {
	/**
	 * Read a CT service ACF field.
	 *
	 * @param string   $field_name Field name.
	 * @param int|null $post_id    Post ID.
	 * @return mixed
	 */
	function optimalu_e_scan_get_ct_service_field( $field_name, $post_id = null ) {
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

if ( ! function_exists( 'optimalu_e_scan_resolve_acf_image' ) ) {
	/**
	 * Normalize an ACF image field to url/alt/id.
	 *
	 * @param mixed  $image Image field value.
	 * @param string $size  Attachment size.
	 * @return array{url:string,alt:string,id:int}
	 */
	function optimalu_e_scan_resolve_acf_image( $image, $size = 'large' ) {
		$url = '';
		$alt = '';
		$id  = 0;

		if ( is_array( $image ) ) {
			$id  = isset( $image['ID'] ) ? (int) $image['ID'] : ( isset( $image['id'] ) ? (int) $image['id'] : 0 );
			$url = ! empty( $image['url'] ) ? (string) $image['url'] : '';
			$alt = ! empty( $image['alt'] ) ? (string) $image['alt'] : '';
		} elseif ( is_numeric( $image ) ) {
			$id = (int) $image;
		}

		if ( $id && ! $url ) {
			$resolved = wp_get_attachment_image_url( $id, $size );
			$url      = $resolved ? $resolved : '';
		}

		if ( $id && ! $alt ) {
			$alt = (string) get_post_meta( $id, '_wp_attachment_image_alt', true );
		}

		return array(
			'url' => $url,
			'alt' => $alt,
			'id'  => $id,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_slot_items' ) ) {
	/**
	 * Collect filled numbered slots from an ACF group.
	 *
	 * @param mixed    $group     Group field value.
	 * @param string   $prefix    Slot name prefix, e.g. exam.
	 * @param string[] $keys      Sub keys without index, e.g. title, text.
	 * @param int      $max       Slot count.
	 * @return array<int, array<string, string>>
	 */
	function optimalu_e_scan_get_ct_slot_items( $group, $prefix, $keys, $max ) {
		$items = array();

		if ( ! is_array( $group ) ) {
			return $items;
		}

		for ( $i = 1; $i <= $max; $i++ ) {
			$item    = array();
			$has_val = false;

			foreach ( $keys as $key ) {
				$field_key     = "{$prefix}_{$i}_{$key}";
				$item[ $key ]  = isset( $group[ $field_key ] ) ? trim( (string) $group[ $field_key ] ) : '';
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

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_hero_data' ) ) {
	/**
	 * Hero data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_hero_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'breadcrumb_home'    => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_breadcrumb_home', $post_id ),
			'breadcrumb_parent'  => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_breadcrumb_parent', $post_id ),
			'breadcrumb_current' => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_breadcrumb_current', $post_id ),
			'home_url'           => home_url( '/' ),
			'parent_url'         => home_url( '/kt-tyrimai/' ),
			'title'              => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_title', $post_id ),
			'title_highlight'    => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_title_highlight', $post_id ),
			'description'        => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_description', $post_id ),
			'primary_text'       => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_primary_text', $post_id ),
			'primary_url'        => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_primary_url', $post_id ),
			'secondary_text'     => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_secondary_text', $post_id ),
			'secondary_url'      => (string) optimalu_e_scan_get_ct_service_field( 'ct_hero_secondary_url', $post_id ),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_featured_data' ) ) {
	/**
	 * Featured image + badge data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_featured_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$image = optimalu_e_scan_resolve_acf_image( optimalu_e_scan_get_ct_service_field( 'ct_featured_image', $post_id ), 'full' );

		if ( ! $image['url'] ) {
			$image = optimalu_e_scan_resolve_acf_image( optimalu_e_scan_get_ct_service_field( 'ct_about_image', $post_id ), 'full' );
		}

		return array(
			'badge_eyebrow' => (string) optimalu_e_scan_get_ct_service_field( 'ct_badge_eyebrow', $post_id ),
			'badge_text'    => (string) optimalu_e_scan_get_ct_service_field( 'ct_badge_text', $post_id ),
			'image_url'     => $image['url'],
			'image_alt'     => $image['alt'],
			'image_id'      => $image['id'],
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_about_data' ) ) {
	/**
	 * About section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_about_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$image = optimalu_e_scan_resolve_acf_image( optimalu_e_scan_get_ct_service_field( 'ct_about_image', $post_id ) );
		$paras = array_filter(
			array(
				(string) optimalu_e_scan_get_ct_service_field( 'ct_about_paragraph_1', $post_id ),
				(string) optimalu_e_scan_get_ct_service_field( 'ct_about_paragraph_2', $post_id ),
				(string) optimalu_e_scan_get_ct_service_field( 'ct_about_paragraph_3', $post_id ),
			)
		);

		return array(
			'eyebrow'     => (string) optimalu_e_scan_get_ct_service_field( 'ct_about_eyebrow', $post_id ),
			'title'       => (string) optimalu_e_scan_get_ct_service_field( 'ct_about_title', $post_id ),
			'paragraphs'  => array_values( $paras ),
			'image_url'   => $image['url'],
			'image_alt'   => $image['alt'],
			'image_id'    => $image['id'],
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_exams_data' ) ) {
	/**
	 * Examinations section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_exams_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_ct_service_field( 'ct_exams_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_exams_title', $post_id ),
			'intro'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_exams_intro', $post_id ),
			'items'   => optimalu_e_scan_get_ct_slot_items(
				optimalu_e_scan_get_ct_service_field( 'ct_exams_items', $post_id ),
				'exam',
				array( 'title', 'text' ),
				OPTIMALU_E_SCAN_CT_EXAM_SLOTS
			),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_process_data' ) ) {
	/**
	 * Process section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_process_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_ct_service_field( 'ct_process_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_process_title', $post_id ),
			'intro'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_process_intro', $post_id ),
			'items'   => optimalu_e_scan_get_ct_slot_items(
				optimalu_e_scan_get_ct_service_field( 'ct_process_items', $post_id ),
				'step',
				array( 'title', 'text' ),
				OPTIMALU_E_SCAN_CT_PROCESS_SLOTS
			),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_preparation_data' ) ) {
	/**
	 * Preparation section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_preparation_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items     = optimalu_e_scan_get_ct_slot_items(
			optimalu_e_scan_get_ct_service_field( 'ct_prep_items', $post_id ),
			'prep',
			array( 'title', 'text' ),
			OPTIMALU_E_SCAN_CT_PREP_SLOTS
		);
		$highlight = array();

		if ( count( $items ) > 3 ) {
			$highlight = array_pop( $items );
		}

		return array(
			'eyebrow'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_prep_eyebrow', $post_id ),
			'title'     => (string) optimalu_e_scan_get_ct_service_field( 'ct_prep_title', $post_id ),
			'intro'     => (string) optimalu_e_scan_get_ct_service_field( 'ct_prep_intro', $post_id ),
			'items'     => $items,
			'highlight' => $highlight,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_gallery_data' ) ) {
	/**
	 * Gallery section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_gallery_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$group = optimalu_e_scan_get_ct_service_field( 'ct_gallery_items', $post_id );
		$items = array();

		if ( is_array( $group ) ) {
			for ( $i = 1; $i <= OPTIMALU_E_SCAN_CT_GALLERY_SLOTS; $i++ ) {
				$image = optimalu_e_scan_resolve_acf_image( isset( $group[ "gallery_{$i}_image" ] ) ? $group[ "gallery_{$i}_image" ] : null, 'large' );
				$alt   = isset( $group[ "gallery_{$i}_alt" ] ) ? trim( (string) $group[ "gallery_{$i}_alt" ] ) : '';

				if ( ! $image['url'] ) {
					continue;
				}

				$items[] = array(
					'url' => $image['url'],
					'alt' => $alt ? $alt : $image['alt'],
					'id'  => $image['id'],
				);
			}
		}

		return array(
			'items' => $items,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_faq_data' ) ) {
	/**
	 * FAQ section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_faq_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_ct_service_field( 'ct_faq_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_faq_title', $post_id ),
			'intro'   => (string) optimalu_e_scan_get_ct_service_field( 'ct_faq_intro', $post_id ),
			'items'   => optimalu_e_scan_get_ct_slot_items(
				optimalu_e_scan_get_ct_service_field( 'ct_faq_items', $post_id ),
				'faq',
				array( 'question', 'answer' ),
				OPTIMALU_E_SCAN_CT_FAQ_SLOTS
			),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_ct_service_cta_data' ) ) {
	/**
	 * CTA section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_ct_service_cta_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow'     => (string) optimalu_e_scan_get_ct_service_field( 'ct_cta_eyebrow', $post_id ),
			'title'       => (string) optimalu_e_scan_get_ct_service_field( 'ct_cta_title', $post_id ),
			'description' => (string) optimalu_e_scan_get_ct_service_field( 'ct_cta_description', $post_id ),
			'button_text' => (string) optimalu_e_scan_get_ct_service_field( 'ct_cta_button_text', $post_id ),
			'button_url'  => (string) optimalu_e_scan_get_ct_service_field( 'ct_cta_button_url', $post_id ),
		);
	}
}
