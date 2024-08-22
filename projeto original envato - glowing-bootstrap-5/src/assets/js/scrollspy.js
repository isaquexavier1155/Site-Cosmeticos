var APP = APP || {};
(function ($) {
	'use strict';


	APP.scrollSpy = {
		init: function () {
			this.scrollSpyLanding();
		},
		scrollSpyLanding: function () {
			var $langding_menu = $('#landingMenu');
			if ($langding_menu.length < 1) {
				return;
			}

			const scrollSpy = new bootstrap.ScrollSpy(document.body, {
				target: '#landingMenu',
			});
		}
	};


	$(document).ready(function () {
		APP.scrollSpy.init();
	});

})(jQuery);
