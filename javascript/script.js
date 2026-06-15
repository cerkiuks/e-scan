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
