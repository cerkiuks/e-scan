/**
 * Mobile header navigation.
 */

document.addEventListener('DOMContentLoaded', () => {
	const toggle = document.querySelector('.site-header__toggle');
	const panel = document.getElementById('site-navigation-mobile');

	if (!toggle || !panel) {
		return;
	}

	const labelOpen = toggle.dataset.labelOpen || 'Open menu';
	const labelClose = toggle.dataset.labelClose || 'Close menu';

	function setMobileMenuOpen(isOpen) {
		toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
		toggle.setAttribute('aria-label', isOpen ? labelClose : labelOpen);
		panel.toggleAttribute('hidden', !isOpen);
		panel.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
		document.body.classList.toggle('site-header-mobile-open', isOpen);
	}

	toggle.addEventListener('click', () => {
		const isOpen = toggle.getAttribute('aria-expanded') === 'true';
		setMobileMenuOpen(!isOpen);
	});

	panel.querySelectorAll('a').forEach((link) => {
		link.addEventListener('click', () => {
			setMobileMenuOpen(false);
		});
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') {
			setMobileMenuOpen(false);
			toggle.focus();
		}
	});
});

/**
 * Specialists horizontal carousel controls.
 */
document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-specialists-carousel]').forEach((carousel) => {
		const track = carousel.querySelector('.specialists__track');
		const prevButton = carousel.querySelector('.specialists__nav--prev');
		const nextButton = carousel.querySelector('.specialists__nav--next');
		const counter = carousel.querySelector('[data-specialists-counter]');
		const counterCurrent = counter?.querySelector('.specialists__counter-current');
		const cards = track ? Array.from(track.querySelectorAll('.specialists__card')) : [];

		if (!track || !prevButton || !nextButton || !counterCurrent || cards.length === 0) {
			return;
		}

		const getScrollStep = () => {
			const card = cards[0];

			if (!card) {
				return 0;
			}

			const gap = Number.parseFloat(window.getComputedStyle(track).columnGap || window.getComputedStyle(track).gap) || 0;

			return card.getBoundingClientRect().width + gap;
		};

		const isDesktopCarousel = () => window.matchMedia('(min-width: 768px)').matches;

		const getActiveIndex = () => {
			const trackRect = track.getBoundingClientRect();
			const trackCenter = trackRect.left + trackRect.width / 2;

			let closestIndex = 0;
			let closestDistance = Number.POSITIVE_INFINITY;

			cards.forEach((card, index) => {
				const cardRect = card.getBoundingClientRect();
				const cardCenter = cardRect.left + cardRect.width / 2;
				const distance = Math.abs(cardCenter - trackCenter);

				if (distance < closestDistance) {
					closestDistance = distance;
					closestIndex = index;
				}
			});

			return closestIndex;
		};

		const updateCarouselState = () => {
			const activeIndex = getActiveIndex();
			const maxScroll = track.scrollWidth - track.clientWidth;
			const atStart = track.scrollLeft <= 1;
			const atEnd = track.scrollLeft >= maxScroll - 1;
			const isScrollable = maxScroll > 1;

			counterCurrent.textContent = String(activeIndex + 1).padStart(2, '0');
			prevButton.disabled = !isScrollable || atStart;
			nextButton.disabled = !isScrollable || atEnd;
			prevButton.setAttribute('aria-disabled', prevButton.disabled ? 'true' : 'false');
			nextButton.setAttribute('aria-disabled', nextButton.disabled ? 'true' : 'false');
		};

		prevButton.addEventListener('click', () => {
			track.scrollBy({
				left: -getScrollStep(),
				behavior: 'smooth',
			});
		});

		nextButton.addEventListener('click', () => {
			track.scrollBy({
				left: getScrollStep(),
				behavior: 'smooth',
			});
		});

		track.addEventListener('scroll', updateCarouselState, { passive: true });
		track.addEventListener(
			'wheel',
			(event) => {
				if (!isDesktopCarousel()) {
					return;
				}

				if (Math.abs(event.deltaX) > Math.abs(event.deltaY)) {
					event.preventDefault();
				}
			},
			{ passive: false }
		);
		track.addEventListener('keydown', (event) => {
			if (event.key === 'ArrowLeft') {
				event.preventDefault();
				track.scrollBy({
					left: -getScrollStep(),
					behavior: 'smooth',
				});
			}

			if (event.key === 'ArrowRight') {
				event.preventDefault();
				track.scrollBy({
					left: getScrollStep(),
					behavior: 'smooth',
				});
			}
		});

		window.addEventListener('resize', updateCarouselState);
		updateCarouselState();
	});
});
