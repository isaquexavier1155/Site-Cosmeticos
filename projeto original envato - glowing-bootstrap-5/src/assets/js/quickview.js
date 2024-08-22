var APP = APP || {};
(function ($) {
	'use strict';

	APP.quickview = {
		init: function () {
			this.quickviewLoad();
		},
		quickviewLoad: function () {
			$('a.quick-view').on('click', function (e) {
				e.preventDefault();
			});
			const myModal = document.getElementById('quickViewModal');
			if (myModal != null) {
				var $slider = $('#quickViewModal').find('#slider'),
					$slider_thumb = $('#quickViewModal').find('#slider-thumb');
				myModal.addEventListener('shown.bs.modal', () => {
					$slider.slick('refresh');
					$slider_thumb.slick('refresh');
				});
			}
		}
	};

	$(document).ready(function () {
		APP.quickview.init();
	})
})(jQuery);
