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

		if ( is_string( $path ) && false !== strpos( $path, '/maps/embed' ) ) {
			return true;
		}

		$query = wp_parse_url( $url, PHP_URL_QUERY );
		parse_str( (string) $query, $args );

		return 'maps.google.com' === $host
			&& is_string( $path )
			&& '/maps' === untrailingslashit( $path )
			&& isset( $args['output'] )
			&& 'embed' === $args['output'];
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_contact_map_iframe' ) ) {
	/**
	 * Build a sanitized Google Maps iframe from embed code or URL.
	 *
	 * @param string $embed_raw     Raw iframe HTML or embed URL.
	 * @param string $title         Iframe title attribute.
	 * @param string $iframe_class  CSS class for the iframe.
	 * @return string
	 */
	function optimalu_e_scan_get_contact_map_iframe( $embed_raw, $title = '', $iframe_class = 'contact__map-iframe' ) {
		$default_src = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2301.3863487!2d25.2796524!3d54.6871551!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd9407b0fb6e8b%3A0x7e8fd6e6a6aaf6f8!2sGedimino%20pr.%2028%2C%20Vilnius%2011103%20Lietuva!5e0!3m2!1slt!2slt!4v1718450000000!5m2!1slt!2slt';
		$embed_raw   = trim( (string) $embed_raw );
		$src         = '';
		$title       = '' !== trim( (string) $title ) ? trim( (string) $title ) : __( 'Klinikos vieta žemėlapyje', 'optimalu-e-scan' );
		$iframe_class = '' !== trim( (string) $iframe_class ) ? trim( (string) $iframe_class ) : 'contact__map-iframe';

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
			'<iframe class="%s" src="%s" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="%s"></iframe>',
			esc_attr( $iframe_class ),
			esc_url( $src ),
			esc_attr( $title )
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
