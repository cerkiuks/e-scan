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

		if (!isOpen) {
			return;
		}

		const currentAncestor = panel.querySelector(
			'.menu-item-has-children.current-menu-ancestor, .menu-item-has-children.current-menu-item'
		);

		if (currentAncestor) {
			return;
		}

		panel.querySelectorAll('.site-header__mobile-submenu-toggle').forEach((button) => {
			button.setAttribute('aria-expanded', 'false');
			button.closest('.menu-item-has-children')?.classList.remove('is-open');
		});
	}

	toggle.addEventListener('click', () => {
		const isOpen = toggle.getAttribute('aria-expanded') === 'true';
		setMobileMenuOpen(!isOpen);
	});

	panel.querySelectorAll('.site-header__mobile-submenu-toggle').forEach((button) => {
		button.addEventListener('click', (event) => {
			event.preventDefault();
			event.stopPropagation();

			const item = button.closest('.menu-item-has-children');
			const isExpanded = button.getAttribute('aria-expanded') === 'true';

			panel.querySelectorAll('.site-header__mobile-submenu-toggle').forEach((otherButton) => {
				if (otherButton === button) {
					return;
				}

				otherButton.setAttribute('aria-expanded', 'false');
				otherButton.closest('.menu-item-has-children')?.classList.remove('is-open');
			});

			button.setAttribute('aria-expanded', isExpanded ? 'false' : 'true');
			item?.classList.toggle('is-open', !isExpanded);
		});
	});

	panel.querySelectorAll('.menu-item-has-children.current-menu-ancestor, .menu-item-has-children.current-menu-item').forEach((item) => {
		item.classList.add('is-open');
		item.querySelector('.site-header__mobile-submenu-toggle')?.setAttribute('aria-expanded', 'true');
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

document.addEventListener('DOMContentLoaded', () => {
	const faqItems = document.querySelectorAll('.ct-service-faq__item');

	if (!faqItems.length) {
		return;
	}

	faqItems.forEach((item) => {
		const toggle = item.querySelector('.ct-service-faq__toggle');
		const panel = item.querySelector('.ct-service-faq__panel');

		if (!toggle || !panel) {
			return;
		}

		toggle.addEventListener('click', () => {
			const isOpen = toggle.getAttribute('aria-expanded') === 'true';

			faqItems.forEach((otherItem) => {
				const otherToggle = otherItem.querySelector('.ct-service-faq__toggle');
				const otherPanel = otherItem.querySelector('.ct-service-faq__panel');

				if (!otherToggle || !otherPanel || otherItem === item) {
					return;
				}

				otherToggle.setAttribute('aria-expanded', 'false');
				otherPanel.hidden = true;
			});

			toggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
			panel.hidden = isOpen;
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('.site-header__menu > .menu-item-has-children').forEach((item) => {
		const link = item.querySelector(':scope > .site-header__menu-link');

		if (!link) {
			return;
		}

		const setExpanded = (isExpanded) => {
			link.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
		};

		item.addEventListener('mouseenter', () => setExpanded(true));
		item.addEventListener('mouseleave', () => setExpanded(false));
		item.addEventListener('focusin', () => setExpanded(true));
		item.addEventListener('focusout', (event) => {
			if (!item.contains(event.relatedTarget)) {
				setExpanded(false);
			}
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-about-gallery]').forEach((root) => {
		const track = root.querySelector('.about-page-gallery__track');
		const originals = track ? Array.from(track.querySelectorAll('.about-page-gallery__slide')) : [];
		const count = originals.length;

		if (!track || count < 2) {
			return;
		}

		const prevButton = root.querySelector('[data-about-gallery-prev]');
		const nextButton = root.querySelector('[data-about-gallery-next]');
		const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
		const duration = reduceMotion ? 0 : 420;

		let index = 0;
		let cloneCount = 0;
		let step = 0;
		let isAnimating = false;
		let dragStartX = 0;
		let dragStartY = 0;
		let dragging = false;
		let dragLocked = null;
		let dragOffset = 0;

		function visibleCount() {
			if (window.innerWidth <= 767) {
				return 1;
			}

			return window.innerWidth <= 1023 ? 2 : 2;
		}

		function setTransform(x, animate) {
			track.style.transition = animate ? `transform ${duration}ms ease` : 'none';
			track.style.transform = `translate3d(${x}px, 0, 0)`;
		}

		function positionFor(logicalIndex) {
			return -(logicalIndex + cloneCount) * step;
		}

		function measure() {
			const first = track.querySelector('.about-page-gallery__slide');

			if (!first) {
				return;
			}

			const styles = window.getComputedStyle(track);
			const gap = Number.parseFloat(styles.columnGap || styles.gap) || 0;
			step = first.getBoundingClientRect().width + gap;
			setTransform(positionFor(index), false);
		}

		function rebuildClones() {
			track.querySelectorAll('[data-about-gallery-clone]').forEach((node) => node.remove());

			cloneCount = Math.min(count, visibleCount() + 1);
			const slides = Array.from(track.querySelectorAll('.about-page-gallery__slide:not([data-about-gallery-clone])'));
			const prependFrag = document.createDocumentFragment();
			const appendFrag = document.createDocumentFragment();

			for (let i = 0; i < cloneCount; i += 1) {
				const nextClone = slides[i].cloneNode(true);
				const prevClone = slides[count - cloneCount + i].cloneNode(true);

				[nextClone, prevClone].forEach((clone, cloneIndex) => {
					clone.setAttribute('data-about-gallery-clone', cloneIndex === 0 ? 'next' : 'prev');
					clone.setAttribute('aria-hidden', 'true');
					clone.querySelectorAll('img').forEach((img) => img.setAttribute('alt', ''));
				});

				appendFrag.appendChild(nextClone);
				prependFrag.appendChild(prevClone);
			}

			track.insertBefore(prependFrag, slides[0]);
			track.appendChild(appendFrag);

			measure();
		}

		function goTo(nextIndex, animate) {
			if (isAnimating) {
				return;
			}

			index = nextIndex;
			const shouldAnimate = Boolean(animate && duration > 0);
			isAnimating = shouldAnimate;
			setTransform(positionFor(index), shouldAnimate);

			if (!shouldAnimate) {
				normalize();
			}
		}

		function normalize() {
			if (index < 0) {
				index += count;
				setTransform(positionFor(index), false);
			} else if (index >= count) {
				index -= count;
				setTransform(positionFor(index), false);
			}

			isAnimating = false;
		}

		function next() {
			goTo(index + 1, true);
		}

		function prev() {
			goTo(index - 1, true);
		}

		track.addEventListener('transitionend', (event) => {
			if (event.propertyName !== 'transform') {
				return;
			}

			normalize();
		});

		prevButton?.addEventListener('click', prev);
		nextButton?.addEventListener('click', next);

		track.addEventListener('keydown', (event) => {
			if (event.key === 'ArrowRight') {
				event.preventDefault();
				next();
			}

			if (event.key === 'ArrowLeft') {
				event.preventDefault();
				prev();
			}
		});

		track.addEventListener(
			'pointerdown',
			(event) => {
				if (event.pointerType === 'mouse' && event.button !== 0) {
					return;
				}

				dragging = true;
				dragLocked = null;
				dragOffset = 0;
				dragStartX = event.clientX;
				dragStartY = event.clientY;
				track.setPointerCapture(event.pointerId);
				setTransform(positionFor(index), false);
			},
			{ passive: true }
		);

		track.addEventListener(
			'pointermove',
			(event) => {
				if (!dragging) {
					return;
				}

				const dx = event.clientX - dragStartX;
				const dy = event.clientY - dragStartY;

				if (dragLocked === null && Math.abs(dx) + Math.abs(dy) > 8) {
					dragLocked = Math.abs(dx) > Math.abs(dy) ? 'x' : 'y';
				}

				if (dragLocked !== 'x') {
					return;
				}

				event.preventDefault();
				dragOffset = dx;
				setTransform(positionFor(index) + dragOffset, false);
			},
			{ passive: false }
		);

		function endDrag() {
			if (!dragging) {
				return;
			}

			dragging = false;

			if (dragLocked === 'x' && Math.abs(dragOffset) > Math.min(60, step * 0.18)) {
				if (dragOffset < 0) {
					next();
				} else {
					prev();
				}
			} else {
				goTo(index, true);
			}

			dragLocked = null;
			dragOffset = 0;
		}

		track.addEventListener('pointerup', endDrag);
		track.addEventListener('pointercancel', endDrag);

		window.addEventListener('resize', () => {
			rebuildClones();
		});

		rebuildClones();
	});
});
