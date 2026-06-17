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

		if (!track || !prevButton || !nextButton) {
			return;
		}

		const getScrollStep = () => {
			const card = track.querySelector('.specialists__card');

			if (!card) {
				return 0;
			}

			const gap = Number.parseFloat(window.getComputedStyle(track).columnGap || window.getComputedStyle(track).gap) || 0;

			return card.getBoundingClientRect().width + gap;
		};

		const updateNavState = () => {
			const maxScroll = track.scrollWidth - track.clientWidth;
			const atStart = track.scrollLeft <= 1;
			const atEnd = track.scrollLeft >= maxScroll - 1;
			const isScrollable = maxScroll > 1;

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

		track.addEventListener('scroll', updateNavState, { passive: true });
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

		window.addEventListener('resize', updateNavState);
		updateNavState();
	});
});
