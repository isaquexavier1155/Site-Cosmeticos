var APP = APP || {};
(function ($) {
	'use strict';

	APP.countdown = {
		init: function () {
			var $countDownEl = $('[data-countdown]');
			if ($countDownEl.length < 1) {
				return;
			}
			var $endTime = $countDownEl.data('countdown-end');
			var countDownDate = new Date($endTime).getTime();
			var x = setInterval(function () {
				var now = new Date().getTime();
				var distance = countDownDate - now;
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				$(".day").html(days);
				$(".hour").html(('0' + hours).slice(-2));
				$(".minute").html(('0' + minutes).slice(-2));
				$(".second").html(('0' + seconds).slice(-2));
				if (distance < 0) {
					clearInterval(x);
				}
			}, 1000);
		},
	};
	$(document).ready(function () {
		APP.countdown.init()
	});
})(jQuery);
