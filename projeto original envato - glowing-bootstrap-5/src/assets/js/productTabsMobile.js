var APP = APP || {};
(function ($) {
	'use strict';

	APP.productTabsMobile = {
		init: function () {
			this.tabsMobile();
		},
		tabsMobile: function () {
			$('.product-tabs-mobile button').on('click', function (e) {
				e.preventDefault();
				var $this = $(this),
					control = $this.attr('data-control'),
					elmControl = $('#' + control);
				elmControl.trigger('click');
			});
		},
	};

	$(document).ready(function () {
		APP.productTabsMobile.init();
	})
})(jQuery);
