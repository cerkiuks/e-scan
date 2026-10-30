(function ($) {
	function syncInput($gallery) {
		const ids = $gallery
			.find('.optimalu-media-gallery__item')
			.map(function () {
				return $(this).attr('data-id');
			})
			.get()
			.filter(Boolean);

		$gallery.find('.optimalu-media-gallery__input').val(ids.join(',')).trigger('change');
	}

	function initSortable($gallery) {
		const $list = $gallery.find('.optimalu-media-gallery__list');

		if ($list.data('ui-sortable')) {
			$list.sortable('refresh');
			return;
		}

		$list.sortable({
			items: '.optimalu-media-gallery__item',
			placeholder: 'optimalu-media-gallery__placeholder',
			tolerance: 'pointer',
			update: function () {
				syncInput($gallery);
			},
		});
	}

	function initGallery($gallery) {
		if ($gallery.data('optimaluGalleryReady')) {
			return;
		}

		$gallery.data('optimaluGalleryReady', true);
		initSortable($gallery);

		$gallery.on('click', '.optimalu-media-gallery__add', function (event) {
			event.preventDefault();

			const frame = wp.media({
				title: optimaluMediaGallery.selectTitle,
				button: { text: optimaluMediaGallery.selectButton },
				library: { type: 'image' },
				multiple: true,
			});

			frame.on('select', function () {
				const selection = frame.state().get('selection');
				const existing = $gallery
					.find('.optimalu-media-gallery__item')
					.map(function () {
						return $(this).attr('data-id');
					})
					.get();
				const ids = [];

				selection.each(function (attachment) {
					const id = String(attachment.id);
					if (existing.indexOf(id) === -1 && ids.indexOf(id) === -1) {
						ids.push(id);
					}
				});

				if (!ids.length) {
					return;
				}

				$.post(optimaluMediaGallery.ajaxUrl, {
					action: 'optimalu_media_gallery_items',
					nonce: optimaluMediaGallery.nonce,
					ids: ids,
				}).done(function (response) {
					if (!response || !response.success || !response.data || !response.data.html) {
						return;
					}

					$gallery.find('.optimalu-media-gallery__list').append(response.data.html);
					syncInput($gallery);
					initSortable($gallery);
				});
			});

			frame.open();
		});

		$gallery.on('click', '.optimalu-media-gallery__remove', function (event) {
			event.preventDefault();
			$(this).closest('.optimalu-media-gallery__item').remove();
			syncInput($gallery);
		});
	}

	function initAll(context) {
		$(context || document)
			.find('.optimalu-media-gallery')
			.each(function () {
				initGallery($(this));
			});
	}

	$(function () {
		initAll(document);
	});

	if (window.acf && typeof window.acf.addAction === 'function') {
		window.acf.addAction('ready_field/type=optimalu_media_gallery', function (field) {
			initAll(field.$el);
		});
		window.acf.addAction('append_field/type=optimalu_media_gallery', function (field) {
			initAll(field.$el);
		});
	}
})(jQuery);
