var APP = APP || {};
(function ($) {
	'use strict';

	APP.slickSlider = {
		init: function () {
			this.slickSetup();
			this.animateSlider();
		},
		slickSetup: function ($wrap) {
			var $slicks;
			if ($wrap !== undefined) {
				$slicks = $wrap
			} else {
				$slicks = $('.slick-slider');
			}
			var options_default = {
				slidesToScroll: 1,
				slidesToShow: 1,
				adaptiveHeight: true,
				arrows: true,
				dots: true,
				autoplay: false,
				autoplaySpeed: 3000,
				centerMode: false,
				centerPadding: "50px",
				draggable: true,
				fade: false,
				focusOnSelect: false,
				infinite: false,
				pauseOnHover: false,
				responsive: [],
				rtl: false,
				speed: 300,
				vertical: false,
				prevArrow: '<div class="slick-prev" aria-label="Previous">' +
					'<svg class="icon"><use xlink:href="#icon-chevron-left"></use></svg>' +
					'</div>',
				nextArrow: '<div class="slick-next" aria-label="Next">' +
					'<svg class="icon"><use xlink:href="#icon-chevron-right"></use></svg>' +
					'</div>',
				customPaging: function (slider, i) {
					return $('<span></span>');
				}
			};
			$slicks.each(function () {
				var $this = $(this);
				if (!$this.hasClass('slick-initialized')) {
					var options = $this.data('slick-options');

					if (typeof options.appendArrow != 'undefined') {
						options.appendArrows = $(options.appendArrow);
					}

					if ($this.hasClass('custom-arrows-02')) {
						options.prevArrow = $(".custom-arrows-02-prev");
						options.nextArrow = $(".custom-arrows-02-next");
					}
					if ($this.hasClass('our-best-seller-4')) {
						options.customPaging = function (slider, i) {
							var $index = '';
							if (i < 9) {
								$index = i + 1;
							} else {
								$index = i + 1;
							}
							var count = '';
							if (slider.slideCount < 9) {
								count = (slider.slideCount);
							} else {
								count = slider.slideCount;
							}

							return '<span class="dot-text">Show</span><span class="dot">' + $index + '</span>' + '<span class="dot-divider">/</span><span class="dot">' + count + '</span>';
						}
					}
					options = $.extend({}, options_default, options);

					$this.slick(options);
					$this.on('setPosition', function (event, slick) {
						var max_height = 0;
						slick.$slides.each(function () {
							var $slide = $(this);
							if ($slide.hasClass('slick-active')) {
								if (slick.options.adaptiveHeight && (slick.options.slidesToShow > 1) && (slick.options.vertical === false)) {
									if (max_height < $slide.outerHeight()) {
										max_height = $slide.outerHeight();
									}
								}
							}
						});
						if (max_height !== 0) {
							$this.find('> .slick-list').animate({
								height: max_height
							}, 500);
						}
					});
				}
			});
		},

		animateSlider: function () {
			var Slider = $(".slick-slider");
			Slider.on("beforeChange", function () {
				var sliderItem = $(this).find('.slick-slide:not(.slick-active)'),
					sliderAnimate = sliderItem.find('.animate__animated'),
					dataAnimate = '';
				if (sliderAnimate.length <= 0) {
					return;
				}
				sliderAnimate.each(function () {
					dataAnimate = $(this).attr('data-animate');
					if (dataAnimate.length) {
						$(this).removeClass('animate__animated').removeClass('animate__' + dataAnimate);
					}
				});
			});

			Slider.on("afterChange", function () {
				var sliderActive = $(this).find('.slick-active'),
					sliderAnimate = sliderActive.find('[data-animate]:not(.animate__animated)'),
					dataAnimate = '';

				if (APP.lazyLoad) {
					APP.lazyLoad.update();
				}

				if (sliderAnimate.length <= 0) {
					return;
				}
				sliderAnimate.each(function () {
					dataAnimate = $(this).attr('data-animate');
					if (dataAnimate.length) {
						$(this).addClass('animate__animated').addClass('animate__' + dataAnimate);
					}
				});
			});
		}
	};
	$(document).ready(function () {
		APP.slickSlider.init();
	});
})(jQuery);
