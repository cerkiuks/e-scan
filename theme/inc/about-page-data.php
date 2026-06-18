<?php
/**
 * Data loaders for the About page template.
 *
 * @package optimalu-e-scan
 */

if ( ! defined( 'OPTIMALU_E_SCAN_ABOUT_TIMELINE_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_ABOUT_TIMELINE_SLOTS', 6 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_ABOUT_VALUES_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_ABOUT_VALUES_SLOTS', 5 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_ABOUT_STATS_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_ABOUT_STATS_SLOTS', 4 );
}

if ( ! defined( 'OPTIMALU_E_SCAN_ABOUT_SPECIALISTS_SLOTS' ) ) {
	define( 'OPTIMALU_E_SCAN_ABOUT_SPECIALISTS_SLOTS', 6 );
}

if ( ! function_exists( 'optimalu_e_scan_is_about_page_template' ) ) {
	/**
	 * Whether the current request uses the About page template.
	 *
	 * @return bool
	 */
	function optimalu_e_scan_is_about_page_template() {
		return is_page_template( 'page-template-about.php' );
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_field' ) ) {
	/**
	 * Read an About page ACF field for the current or given page.
	 *
	 * @param string   $field_name Field name.
	 * @param int|null $post_id    Post ID.
	 * @return mixed
	 */
	function optimalu_e_scan_get_about_page_field( $field_name, $post_id = null ) {
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

if ( ! function_exists( 'optimalu_e_scan_get_about_page_hero_data' ) ) {
	/**
	 * About page hero section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_hero_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$image = optimalu_e_scan_get_about_page_field( 'about_page_hero_image', $post_id );
		$url   = '';

		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			$url = $image['url'];
		} elseif ( is_numeric( $image ) ) {
			$url = (string) wp_get_attachment_image_url( (int) $image, 'large' );
		}

		return array(
			'eyebrow'     => (string) optimalu_e_scan_get_about_page_field( 'about_page_hero_eyebrow', $post_id ),
			'title'       => (string) optimalu_e_scan_get_about_page_field( 'about_page_hero_title', $post_id ),
			'description' => (string) optimalu_e_scan_get_about_page_field( 'about_page_hero_description', $post_id ),
			'image_url'   => $url,
			'image_alt'   => is_array( $image ) && ! empty( $image['alt'] ) ? (string) $image['alt'] : '',
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_history_data' ) ) {
	/**
	 * About page history section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_history_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$image = optimalu_e_scan_get_about_page_field( 'about_page_history_image', $post_id );
		$url   = '';

		if ( is_array( $image ) && ! empty( $image['url'] ) ) {
			$url = $image['url'];
		} elseif ( is_numeric( $image ) ) {
			$url = (string) wp_get_attachment_image_url( (int) $image, 'large' );
		}

		return array(
			'eyebrow'          => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_eyebrow', $post_id ),
			'title'            => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_title', $post_id ),
			'paragraph_1'      => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_paragraph_1', $post_id ),
			'paragraph_2'      => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_paragraph_2', $post_id ),
			'paragraph_3'      => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_paragraph_3', $post_id ),
			'highlight_label'  => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_highlight_label', $post_id ),
			'highlight_value'  => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_highlight_value', $post_id ),
			'image_url'        => $url,
			'image_alt'        => is_array( $image ) && ! empty( $image['alt'] ) ? (string) $image['alt'] : '',
			'image_caption'    => (string) optimalu_e_scan_get_about_page_field( 'about_page_history_image_caption', $post_id ),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_timeline_data' ) ) {
	/**
	 * About page timeline section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_timeline_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items_raw = optimalu_e_scan_get_about_page_field( 'about_page_timeline_items', $post_id );
		$items     = array();

		if ( is_array( $items_raw ) && ! empty( $items_raw ) ) {
			for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_TIMELINE_SLOTS; $i++ ) {
				$year  = isset( $items_raw[ "timeline_item_{$i}_year" ] ) ? trim( (string) $items_raw[ "timeline_item_{$i}_year" ] ) : '';
				$title = isset( $items_raw[ "timeline_item_{$i}_title" ] ) ? trim( (string) $items_raw[ "timeline_item_{$i}_title" ] ) : '';
				$text  = isset( $items_raw[ "timeline_item_{$i}_text" ] ) ? trim( (string) $items_raw[ "timeline_item_{$i}_text" ] ) : '';

				if ( ! $year && ! $title && ! $text ) {
					continue;
				}

				$items[] = array(
					'year'  => $year,
					'title' => $title,
					'text'  => $text,
				);
			}
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_about_page_field( 'about_page_timeline_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_about_page_field( 'about_page_timeline_title', $post_id ),
			'items'   => $items,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_values_data' ) ) {
	/**
	 * About page values section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_values_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items_raw = optimalu_e_scan_get_about_page_field( 'about_page_values_items', $post_id );
		$items     = array();

		if ( is_array( $items_raw ) && ! empty( $items_raw ) ) {
			for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_VALUES_SLOTS; $i++ ) {
				$number = isset( $items_raw[ "value_{$i}_number" ] ) ? trim( (string) $items_raw[ "value_{$i}_number" ] ) : '';
				$title  = isset( $items_raw[ "value_{$i}_title" ] ) ? trim( (string) $items_raw[ "value_{$i}_title" ] ) : '';
				$text   = isset( $items_raw[ "value_{$i}_text" ] ) ? trim( (string) $items_raw[ "value_{$i}_text" ] ) : '';

				if ( ! $number && ! $title && ! $text ) {
					continue;
				}

				if ( ! $number ) {
					$number = sprintf( '%02d', count( $items ) + 1 );
				}

				$items[] = array(
					'number' => $number,
					'title'  => $title,
					'text'   => $text,
				);
			}
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_about_page_field( 'about_page_values_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_about_page_field( 'about_page_values_title', $post_id ),
			'items'   => $items,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_stats_data' ) ) {
	/**
	 * About page statistics section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_stats_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items_raw = optimalu_e_scan_get_about_page_field( 'about_page_stats_items', $post_id );
		$items     = array();

		if ( is_array( $items_raw ) && ! empty( $items_raw ) ) {
			for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_STATS_SLOTS; $i++ ) {
				$value = isset( $items_raw[ "stat_{$i}_value" ] ) ? trim( (string) $items_raw[ "stat_{$i}_value" ] ) : '';
				$label = isset( $items_raw[ "stat_{$i}_label" ] ) ? trim( (string) $items_raw[ "stat_{$i}_label" ] ) : '';
				$text  = isset( $items_raw[ "stat_{$i}_text" ] ) ? trim( (string) $items_raw[ "stat_{$i}_text" ] ) : '';

				if ( ! $value && ! $label && ! $text ) {
					continue;
				}

				$items[] = array(
					'value' => $value,
					'label' => $label,
					'text'  => $text,
				);
			}
		}

		return array(
			'eyebrow' => (string) optimalu_e_scan_get_about_page_field( 'about_page_stats_eyebrow', $post_id ),
			'title'   => (string) optimalu_e_scan_get_about_page_field( 'about_page_stats_title', $post_id ),
			'items'   => $items,
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_specialists_data' ) ) {
	/**
	 * About page specialists section data (same shape as homepage specialists).
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_specialists_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		$items_raw   = optimalu_e_scan_get_about_page_field( 'about_page_specialists_items', $post_id );
		$specialists = array();

		if ( is_array( $items_raw ) && ! empty( $items_raw ) ) {
			for ( $i = 1; $i <= OPTIMALU_E_SCAN_ABOUT_SPECIALISTS_SLOTS; $i++ ) {
				$photo_raw = isset( $items_raw[ "specialist_{$i}_photo" ] ) ? $items_raw[ "specialist_{$i}_photo" ] : null;
				$name      = isset( $items_raw[ "specialist_{$i}_name" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_name" ] ) : '';
				$position  = isset( $items_raw[ "specialist_{$i}_position" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_position" ] ) : '';
				$category  = isset( $items_raw[ "specialist_{$i}_category" ] ) ? trim( (string) $items_raw[ "specialist_{$i}_category" ] ) : '';

				if ( ! $name && ! $position && ! $category && empty( $photo_raw ) ) {
					continue;
				}

				$photo = optimalu_e_scan_resolve_specialist_photo( $photo_raw, $name );

				$specialists[] = array(
					'photo_url' => $photo['photo_url'],
					'photo_alt' => $photo['photo_alt'],
					'name'      => $name,
					'position'  => $position,
					'desc'      => $category,
					'link_text' => '',
					'link_url'  => '',
				);
			}
		}

		$title           = (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_title', $post_id );
		$title_highlight = (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_title_highlight', $post_id );

		return array(
			'eyebrow'            => (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_eyebrow', $post_id ),
			'title'              => $title,
			'title_highlight'    => $title_highlight,
			'description'        => (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_description', $post_id ),
			'specialists'        => $specialists,
			'footer_link_text'   => (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_footer_link_text', $post_id ),
			'footer_link_url'    => (string) optimalu_e_scan_get_about_page_field( 'about_page_specialists_footer_link_url', $post_id ),
			'heading'            => trim( $title . ' ' . $title_highlight ),
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_about_page_cta_data' ) ) {
	/**
	 * About page CTA section data.
	 *
	 * @param int|null $post_id Post ID.
	 * @return array<string, mixed>
	 */
	function optimalu_e_scan_get_about_page_cta_data( $post_id = null ) {
		if ( null === $post_id ) {
			$post_id = get_the_ID();
		}

		return array(
			'eyebrow'          => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_eyebrow', $post_id ),
			'title'            => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_title', $post_id ),
			'title_highlight'  => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_title_highlight', $post_id ),
			'primary_text'     => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_primary_text', $post_id ),
			'primary_url'      => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_primary_url', $post_id ),
			'secondary_text'   => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_secondary_text', $post_id ),
			'secondary_url'    => (string) optimalu_e_scan_get_about_page_field( 'about_page_cta_secondary_url', $post_id ),
		);
	}
}
