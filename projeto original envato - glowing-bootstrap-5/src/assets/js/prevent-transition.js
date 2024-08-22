var APP = APP || {};
(function ($) {
	'use strict';

	APP.preventTransitionResize = {
		resizeTimer: null,
		beforeWindowWidth: 0,
		init: function () {
			this.beforeWindowWidth = window.outerWidth;
			this.resize();
		},
		resize: function () {
			$(window).resize(function () {
				let currentWidth = window.outerWidth;
				if (currentWidth === APP.preventTransitionResize.beforeWindowWidth) {
					return;
				}
				APP.preventTransitionResize.beforeWindowWidth = currentWidth;

				clearTimeout(APP.preventTransitionResize.resizeTimer);

				$('body').addClass('disable-transition-all');

				$(document).trigger('after_prevent_transition_resize');

				APP.preventTransitionResize.resizeTimer = setTimeout(function () {
					$('body').removeClass('disable-transition-all');
				}, 400);
			});
		}
	};

	$(document).ready(function () {
		APP.preventTransitionResize.init();
	});
})(jQuery);
