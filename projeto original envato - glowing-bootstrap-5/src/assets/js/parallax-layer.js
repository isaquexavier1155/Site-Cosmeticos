var APP = APP || {};
(function ($) {
	'use strict';

	APP.parallaxLayer = {
		init: function () {
			if (typeof (gsap) === "undefined") {
				return;
			}

			$('.parallax-layers').on('mousemove', function (event) {
				event.preventDefault();
				let $this = $(this),
					$window = $(window),
					wx = $window.width(),
					wy = $window.height(),
					x = event.pageX - this.offsetLeft,
					y = event.pageY - this.offsetTop,
					newX = x - wx / 2,
					newY = y - wy / 2;

				$this.find('.layer').each(function (index, el) {
					var speed = 0.02 + index / 100;
					gsap.to(el, {duration: 1, x: (1 - newX * speed), y: (1 - newY * speed)});
				});

			}).on('mouseleave', function (event) {
				event.preventDefault();
				let $this = $(this);

				$this.find('.layer').each(function (index, el) {
					let speed = 0.01 + index / 100;
					gsap.to(el, {duration: 1, x: 0, y: 0});
				});
			});
		}
	};

	APP.parallaxLayer.init();
})(jQuery);
