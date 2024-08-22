var APP = APP || {};
(function ($) {
	'use strict';

	APP.backToTop = {
		init: function () {
			this.backToTop();
		},
		backToTop: function () {
			var $backToTop = $('.gtf-back-to-top'),
				$window = $(window);
			if ($backToTop.length > 0) {
				$backToTop.on('click', function (event) {
					event.preventDefault();
					$('html,body').animate({scrollTop: '0px'}, 100);
				});
				$window.on('scroll', function (event) {
					var scrollPosition = $window.scrollTop(),
						windowHeight = $window.height() / 2;
					if (scrollPosition > windowHeight) {
						$backToTop.addClass('in');
					} else {
						$backToTop.removeClass('in');
					}
				});
			}
		},
	};

	$(document).ready(function () {
		APP.backToTop.init();
	})
})(jQuery);
