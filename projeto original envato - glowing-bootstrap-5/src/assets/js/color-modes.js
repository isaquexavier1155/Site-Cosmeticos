var APP = APP || {};
(function ($) {
	'use strict';

	APP.colorModes = {
		init: function () {
			this.colorModes();
		},

		colorModes: function () {
			if (!document.documentElement.hasAttribute("data-bs-theme")) {
				return
			}

			const storedTheme = localStorage.getItem('theme');
			const getPreferredTheme = () => {
				if (storedTheme) {
					return storedTheme
				}

				return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
			};
			const setTheme = function (theme) {
				if (theme === 'auto' && window.matchMedia('(prefers-color-scheme: dark)').matches) {
					document.documentElement.setAttribute('data-bs-theme', 'dark');
				} else {
					if (theme === 'auto') {
						theme = 'light';
					}
					document.documentElement.setAttribute('data-bs-theme', theme);
				}
			};

			setTheme(getPreferredTheme());

			const showActiveTheme = (theme, focus = false) => {
				const themeSwitcher = document.querySelector('.color-modes');

				if (!themeSwitcher) {
					return
				}

				document.querySelectorAll('[data-bs-theme-value]').forEach(element => {
					element.classList.remove('active');
					element.setAttribute('aria-pressed', 'false');
				});

				document.querySelectorAll('.color-modes').forEach(element => {
					const activeThemeIcon = element.querySelector('.theme-icon-active use');
					const btnToActive = element.querySelector('[data-bs-theme-value="' + theme + '"]');
					const svgOfActiveBtn = btnToActive.querySelector('svg use').getAttribute('href');

					btnToActive.classList.add('active');
					btnToActive.setAttribute('aria-pressed', 'true');
					activeThemeIcon.setAttribute('href', svgOfActiveBtn);
				});

				if (focus) {
					themeSwitcher.focus();
				}
			};

			window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
				if (storedTheme !== 'light' || storedTheme !== 'dark') {
					setTheme(getPreferredTheme());
				}
			});

			const _switch = function () {
				showActiveTheme(getPreferredTheme());
				document.querySelectorAll('[data-bs-theme-value]')
					.forEach(toggle => {
						toggle.addEventListener('click', () => {
							const theme = toggle.getAttribute('data-bs-theme-value');
							localStorage.setItem('theme', theme);
							setTheme(theme);
							showActiveTheme(theme, true);
						})
					})
			};
			_switch();
		}

	};

	$(document).ready(function () {
		APP.colorModes.init();
	})
})(jQuery);
