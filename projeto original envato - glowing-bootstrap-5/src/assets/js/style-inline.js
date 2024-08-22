var APP = APP || {};
(function ($) {
	'use strict';

	APP.styleInline = {
		init: function () {
			this.initCss();
		},
		initCss: function () {
			$('[data-styles]').each(function () {
				if (this.dataset['styles']) {
					let dataStyles = this.dataset['styles'].split(';');
					for (var i in dataStyles) {
						let styleItem = dataStyles[i].split(':');
						if (styleItem.length === 2) {
							$(this).css(styleItem[0].trim(), styleItem[1].trim());
						}
					}
				}
			});
		}
	};
	APP.styleInline.init();
})(jQuery);
