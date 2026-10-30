<?php
/**
 * ACF Free field: unlimited Media Library gallery.
 *
 * @package optimalu-e-scan
 */

if ( ! function_exists( 'optimalu_e_scan_parse_media_gallery_ids' ) ) {
	/**
	 * Parse stored gallery IDs.
	 *
	 * @param mixed $value Raw field value.
	 * @return array<int, int>
	 */
	function optimalu_e_scan_parse_media_gallery_ids( $value ) {
		if ( is_array( $value ) ) {
			$parts = $value;
		} else {
			$parts = preg_split( '/[\s,]+/', (string) $value );
			$parts = is_array( $parts ) ? $parts : array();
		}

		$ids = array();
		foreach ( $parts as $part ) {
			$id = absint( $part );
			if ( $id && ! in_array( $id, $ids, true ) ) {
				$ids[] = $id;
			}
		}

		return $ids;
	}
}

if ( ! function_exists( 'optimalu_e_scan_get_media_gallery_admin_item_markup' ) ) {
	/**
	 * Admin thumbnail item markup.
	 *
	 * @param int $attachment_id Attachment ID.
	 * @return string
	 */
	function optimalu_e_scan_get_media_gallery_admin_item_markup( $attachment_id ) {
		$attachment_id = absint( $attachment_id );
		if ( ! $attachment_id ) {
			return '';
		}

		$thumb = wp_get_attachment_image(
			$attachment_id,
			'thumbnail',
			false,
			array(
				'draggable' => 'false',
			)
		);

		if ( ! $thumb ) {
			return '';
		}

		$edit_link = get_edit_post_link( $attachment_id, 'raw' );
		$alt       = (string) get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

		ob_start();
		?>
		<li class="optimalu-media-gallery__item" data-id="<?php echo esc_attr( (string) $attachment_id ); ?>">
			<?php if ( $edit_link ) : ?>
				<a class="optimalu-media-gallery__thumb" href="<?php echo esc_url( $edit_link ); ?>" target="_blank" rel="noopener noreferrer" title="<?php esc_attr_e( 'Redaguoti alt tekstą medijos bibliotekoje', 'optimalu-e-scan' ); ?>">
					<?php echo $thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_get_attachment_image. ?>
				</a>
			<?php else : ?>
				<span class="optimalu-media-gallery__thumb"><?php echo $thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_get_attachment_image. ?></span>
			<?php endif; ?>
			<?php if ( $alt ) : ?>
				<span class="optimalu-media-gallery__alt"><?php echo esc_html( wp_trim_words( $alt, 12, '…' ) ); ?></span>
			<?php endif; ?>
			<button type="button" class="optimalu-media-gallery__remove" aria-label="<?php esc_attr_e( 'Pašalinti nuotrauką', 'optimalu-e-scan' ); ?>">&times;</button>
		</li>
		<?php
		return (string) ob_get_clean();
	}
}

/**
 * AJAX: admin gallery item markup.
 */
function optimalu_e_scan_ajax_media_gallery_items() {
	if ( ! current_user_can( 'upload_files' ) ) {
		wp_send_json_error( array( 'message' => 'forbidden' ), 403 );
	}

	check_ajax_referer( 'optimalu_media_gallery', 'nonce' );

	$ids = isset( $_POST['ids'] ) ? wp_unslash( $_POST['ids'] ) : array(); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
	$ids = optimalu_e_scan_parse_media_gallery_ids( $ids );
	$html = '';

	foreach ( $ids as $id ) {
		$html .= optimalu_e_scan_get_media_gallery_admin_item_markup( $id );
	}

	wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_optimalu_media_gallery_items', 'optimalu_e_scan_ajax_media_gallery_items' );

/**
 * Register the custom ACF field type.
 */
function optimalu_e_scan_register_acf_media_gallery_field() {
	if ( ! function_exists( 'acf_register_field_type' ) || ! class_exists( 'acf_field' ) ) {
		return;
	}

	if ( class_exists( 'Optimalu_E_Scan_ACF_Field_Media_Gallery' ) ) {
		acf_register_field_type( 'Optimalu_E_Scan_ACF_Field_Media_Gallery' );
		return;
	}

	/**
	 * Stores ordered attachment IDs as a comma-separated string.
	 */
	class Optimalu_E_Scan_ACF_Field_Media_Gallery extends acf_field {

		/**
		 * Setup field type.
		 */
		public function initialize() {
			$this->name     = 'optimalu_media_gallery';
			$this->label    = __( 'Nuotraukų galerija', 'optimalu-e-scan' );
			$this->category = 'content';
			$this->defaults = array();
		}

		/**
		 * Admin assets.
		 *
		 * @return void
		 */
		public function input_admin_enqueue_scripts() {
			wp_enqueue_media();
			wp_enqueue_script( 'jquery-ui-sortable' );

			wp_enqueue_script(
				'optimalu-e-scan-acf-media-gallery',
				get_template_directory_uri() . '/js/acf-media-gallery.js',
				array( 'jquery', 'jquery-ui-sortable', 'acf-input' ),
				OPTIMALU_E_SCAN_VERSION,
				true
			);

			wp_enqueue_style(
				'optimalu-e-scan-acf-media-gallery',
				get_template_directory_uri() . '/js/acf-media-gallery.css',
				array(),
				OPTIMALU_E_SCAN_VERSION
			);

			wp_localize_script(
				'optimalu-e-scan-acf-media-gallery',
				'optimaluMediaGallery',
				array(
					'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
					'nonce'        => wp_create_nonce( 'optimalu_media_gallery' ),
					'selectTitle'  => __( 'Pasirinkite nuotraukas', 'optimalu-e-scan' ),
					'selectButton' => __( 'Pridėti nuotraukas', 'optimalu-e-scan' ),
				)
			);
		}

		/**
		 * Render the field.
		 *
		 * @param array<string, mixed> $field Field settings.
		 * @return void
		 */
		public function render_field( $field ) {
			$ids = optimalu_e_scan_parse_media_gallery_ids( isset( $field['value'] ) ? $field['value'] : '' );
			?>
			<div class="optimalu-media-gallery">
				<input
					type="hidden"
					class="optimalu-media-gallery__input"
					name="<?php echo esc_attr( $field['name'] ); ?>"
					value="<?php echo esc_attr( implode( ',', $ids ) ); ?>"
				>
				<ul class="optimalu-media-gallery__list">
					<?php foreach ( $ids as $attachment_id ) : ?>
						<?php echo optimalu_e_scan_get_media_gallery_admin_item_markup( $attachment_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- escaped in helper. ?>
					<?php endforeach; ?>
				</ul>
				<p class="optimalu-media-gallery__actions">
					<button type="button" class="button button-primary optimalu-media-gallery__add">
						<?php esc_html_e( 'Pridėti nuotraukas', 'optimalu-e-scan' ); ?>
					</button>
				</p>
				<p class="description">
					<?php esc_html_e( 'Vilkite miniatiūras, kad pakeistumėte eiliškumą. Nuotrauką pašalinkite su ×. Alternatyvų tekstą redaguokite Medijos bibliotekoje (spustelėkite miniatiūrą).', 'optimalu-e-scan' ); ?>
				</p>
			</div>
			<?php
		}

		/**
		 * Sanitize saved value.
		 *
		 * @param mixed $value Raw value.
		 * @return string
		 */
		public function update_value( $value, $post_id, $field ) {
			unset( $post_id, $field );
			return implode( ',', optimalu_e_scan_parse_media_gallery_ids( $value ) );
		}

		/**
		 * Format value for templates.
		 *
		 * @param mixed $value Stored value.
		 * @return array<int, int>
		 */
		public function format_value( $value, $post_id, $field ) {
			unset( $post_id, $field );
			return optimalu_e_scan_parse_media_gallery_ids( $value );
		}

		/**
		 * Load value.
		 *
		 * @param mixed $value Stored value.
		 * @return string
		 */
		public function load_value( $value, $post_id, $field ) {
			unset( $post_id, $field );
			return implode( ',', optimalu_e_scan_parse_media_gallery_ids( $value ) );
		}
	}

	acf_register_field_type( 'Optimalu_E_Scan_ACF_Field_Media_Gallery' );
}
add_action( 'acf/include_field_types', 'optimalu_e_scan_register_acf_media_gallery_field' );
