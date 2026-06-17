<?php
/**
 * Shared helpers for reusable homepage sections.
 *
 * @package optimalu-e-scan
 */

if ( ! function_exists( 'optimalu_e_scan_get_section_field' ) ) {
	/**
	 * Read an ACF field for a specific page/post.
	 *
	 * @param string   $field_name Field name.
	 * @param int|null $post_id    Post ID. Defaults to current post in the loop.
	 * @return mixed
	 */
	function optimalu_e_scan_get_section_field( $field_name, $post_id = null ) {
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

if ( ! function_exists( 'optimalu_e_scan_resolve_section_post_id' ) ) {
	/**
	 * Resolve the post ID used by a section template part.
	 *
	 * @param array<string, mixed> $args Template part arguments.
	 * @return int
	 */
	function optimalu_e_scan_resolve_section_post_id( $args = array() ) {
		if ( isset( $args['post_id'] ) && $args['post_id'] ) {
			return (int) $args['post_id'];
		}

		return (int) get_the_ID();
	}
}

if ( ! function_exists( 'optimalu_e_scan_is_allowed_google_maps_embed_url' ) ) {
	/**
	 * Whether a URL is an allowed Google Maps embed source.
	 *
	 * @param string $url Embed source URL.
	 * @return bool
	 */
	function optimalu_e_scan_is_allowed_google_maps_embed_url( $url ) {
		$host = wp_parse_url( $url, PHP_URL_HOST );
		$path = wp_parse_url( $url, PHP_URL_PATH );

		if ( ! $host ) {
			return false;
		}

		$host = strtolower( $host );

		if ( ! in_array( $host, array( 'www.google.com', 'google.com', 'maps.google.com' ), true ) ) {
			return false;
		}

		return is_string( $path ) && false !== strpos( $path, '/maps/embed' );
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_map_iframe' ) ) {
	/**
	 * Build a sanitized Google Maps iframe from embed code or URL.
	 *
	 * @param string $embed_raw Raw iframe HTML or embed URL.
	 * @return string
	 */
	function optimalu_e_scan_get_contact_map_iframe( $embed_raw ) {
		$default_src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2301.3863487!2d25.2796524!3d54.6871551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd9407b0fb6e8b%3A0x7e8fd6e6a6aaf6f8!2sGedimino%20pr.%2028%2C%20Vilnius%2011103%20Lietuva!5e0!3m2!1slt!2slt!4v1718450000000!5m2!1slt!2slt';
		$embed_raw   = trim( (string) $embed_raw );
		$src         = '';

		if ( '' === $embed_raw ) {
			$src = $default_src;
		} elseif ( preg_match( '/<iframe/i', $embed_raw ) ) {
			$allowed_iframe = wp_kses(
				$embed_raw,
				array(
					'iframe' => array(
						'src'             => true,
						'width'           => true,
						'height'          => true,
						'style'           => true,
						'allowfullscreen' => true,
						'loading'         => true,
						'referrerpolicy'  => true,
						'title'           => true,
						'aria-label'      => true,
						'class'           => true,
					),
				)
			);

			if ( preg_match( '/src=["\']([^"\']+)["\']/i', $allowed_iframe, $matches ) ) {
				$src = html_entity_decode( $matches[1], ENT_QUOTES );
			}
		} elseif ( filter_var( $embed_raw, FILTER_VALIDATE_URL ) ) {
			$src = $embed_raw;
		}

		if ( ! optimalu_e_scan_is_allowed_google_maps_embed_url( $src ) ) {
			$src = $default_src;
		}

		if ( ! optimalu_e_scan_is_allowed_google_maps_embed_url( $src ) ) {
			return '';
		}

		return sprintf(
			'<iframe class="contact__map-iframe" src="%s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="%s"></iframe>',
			esc_url( $src ),
			esc_attr__( 'Klinikos vieta žemėlapyje', 'optimalu-e-scan' )
		);
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_address_lines' ) ) {
	/**
	 * Split multiline address text into display lines.
	 *
	 * @param string $address Raw address field value.
	 * @return array<int, string>
	 */
	function optimalu_e_scan_get_contact_address_lines( $address ) {
		$lines = preg_split( '/\r\n|\r|\n/', (string) $address );
		$lines = is_array( $lines ) ? $lines : array();
		$lines = array_map( 'trim', $lines );
		$lines = array_filter( $lines );

		return array_values( $lines );
	}
}

if ( ! function_exists( 'optimalu_e_scan_resolve_specialist_photo' ) ) {
	/**
	 * Resolve specialist photo URL and alt text from ACF/raw values.
	 *
	 * @param mixed  $photo_raw Raw photo field value.
	 * @param string $name      Specialist name used for alt fallback.
	 * @return array{photo_url: string, photo_alt: string}
	 */
	function optimalu_e_scan_resolve_specialist_photo( $photo_raw, $name = '' ) {
		$photo_alt = $name ? $name : __( 'Specialistas', 'optimalu-e-scan' );
		$photo_url = '';
		$photo_id  = 0;

		if ( is_array( $photo_raw ) ) {
			if ( ! empty( $photo_raw['url'] ) ) {
				$photo_url = $photo_raw['url'];
				$photo_alt = ! empty( $photo_raw['alt'] ) ? $photo_raw['alt'] : $photo_alt;
			}

			if ( ! empty( $photo_raw['ID'] ) ) {
				$photo_id = (int) $photo_raw['ID'];
			}
		} elseif ( is_numeric( $photo_raw ) || ( is_string( $photo_raw ) && ctype_digit( $photo_raw ) ) ) {
			$photo_id = (int) $photo_raw;
		} elseif ( is_string( $photo_raw ) && filter_var( $photo_raw, FILTER_VALIDATE_URL ) ) {
			$photo_url = $photo_raw;
		}

		if ( $photo_id && ! $photo_url ) {
			$photo_url = wp_get_attachment_image_url( $photo_id, 'large' );
			$photo_alt = get_post_meta( $photo_id, '_wp_attachment_image_alt', true ) ?: $photo_alt;
		}

		return array(
			'photo_url' => $photo_url,
			'photo_alt' => $photo_alt,
		);
	}
}
