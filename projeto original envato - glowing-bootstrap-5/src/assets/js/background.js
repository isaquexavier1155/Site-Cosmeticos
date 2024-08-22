var APP = APP || {};
(function ($) {
	'use strict';

	APP.backgroundImage = {
		init: function () {
			this.initBackgroundImage();
		},
		initBackgroundImage: function () {
			$('.bg-image:not(.lazy-bg)').each(function () {
				if ($(this).attr('data-bg-src')) {
					$(this).css('background-image', 'url("' + $(this).attr('data-bg-src') + '")')
				}
			});
		}
	};

	APP.backgroundImage.init();
})(jQuery);
