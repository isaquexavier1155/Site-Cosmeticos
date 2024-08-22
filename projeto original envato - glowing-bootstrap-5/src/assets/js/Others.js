var APP = APP || {};
(function ($) {
	'use strict';

	APP.Others = {
		init: function () {
			this.canvasCart();
			this.reInitTooltip();
		},
		canvasCart: function () {
			$('.shop-down').on('click', function (e) {
				e.preventDefault();
				var $parent = $(this).parent('.input-group');
				var $input = $parent.find('input:not([disabled])');
				var $value = parseInt($input.val());
				if ($value > 0) {
					$value -= 1;
					$input.val($value);
				}
			});
			$('.shop-up').on('click', function (e) {
				e.preventDefault();
				var $parent = $(this).parent('.input-group');
				var $input = $parent.find('input:not([disabled])');
				var $value = $input.val();
				if ($value !== '') {
					$value = parseInt($value);
					$value += 1;
					$input.val($value);
				} else {
					$input.val(1);
				}
			});
		},
		reInitTooltip: function () {
			window.onload = (event) => {
				$('[data-bs-toggle="tooltip"]').tooltip();
			};
		}
	};

	$(document).ready(function () {
		APP.Others.init();
	})
})(jQuery);
