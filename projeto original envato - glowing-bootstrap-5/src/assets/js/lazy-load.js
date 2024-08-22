var APP = APP || {};
(function ($) {
	'use strict';

	APP.lazyLoad = {
		instanceImage : null,
		instanceBackground : null,
		init: function () {
			if (typeof LazyLoad === 'undefined') {
				return;
			}
			var _self = this;

			this.handleLazyImages();
			this.handleLazyBackgrounds();
			setTimeout(function () {
				_self.update();
			},1000);
		},
		handleLazyImages: function() {
			this.instanceImage = new LazyLoad({
				// Your custom settings go here
				elements_selector: ".lazy-image",
				use_native: true,
				callback_loaded: function ($el) {
					$($el).removeClass('lazy-image');
				},
				callback_error: function ($el) {}
			});
		},
		handleLazyBackgrounds: function() {
			this.instanceBackground = new LazyLoad({
				elements_selector: ".lazy-bg",
				data_bg: 'bg-src',
				callback_loaded: function ($el) {
					$( $el ).removeClass( 'lazy-bg' );
					$( $el ).find('.placeholder').remove();
				}
			});
		},
		update: function () {
			$('.lazy-image').each(function () {
				var $parent = $(this).closest('.lazy-image').parent();
			});

			if (this.instanceImage !== null ) {
				this.instanceImage.update();
			}

			if (this.instanceBackground !== null ) {
				this.instanceBackground.update();
			}
		}
	};

	$(document).ready(function () {
		APP.lazyLoad.init();
	});

})(jQuery);
