var APP = APP || {};
(function ($) {
	'use strict';

	APP.fullPageScroll = {
		$_dots: null,
		_slides: [],
		_isEnabled: true,
		_tween: null,
		_oldSlide: 0,
		_activeSlide: 0,
		init: function () {
			if (typeof (gsap) === "undefined") {
				return;
			}
			if (!document.querySelector('body.full-page-scroll')) {
				return;
			}

			this._slides = document.querySelectorAll('[data-full-page]');
			this.$_dots = $('.full-page-dots');

			if (this.$_dots.length === 0) {
				this.$_dots = $('<div class="full-page-dots"></div>');
				$('body').append(this.$_dots);
			}

			if (this.$_dots.length) {
				for (let i = 0; i < this._slides.length; i++) {
					let $dot = $('<div class="full-page-dots-nav"></div>');
					$dot.attr('title', $(this._slides[i]).data('full-page'));
					$dot.attr('data-index', i);
					this.$_dots.append($dot);
				}

				this.$_dots.find('.full-page-dots-nav').each(function (el) {
					bootstrap.Tooltip.getOrCreateInstance(this, {
						title: this.title,
						container: this.parentNode
					});
				});

				this.$_dots.find('.full-page-dots-nav').on('click', function () {
					let index = $(this).attr('data-index');
					APP.fullPageScroll._isEnabled = false;
					APP.fullPageScroll.gotoSlide(index);
				});
			}

			document.addEventListener('mousedown', function (event) {
				if (event.target === document.querySelector('html')) {
					if (APP.fullPageScroll._tween) {
						APP.fullPageScroll._tween.pause();
						APP.fullPageScroll._isEnabled = false;
					}
				}
			});

			document.addEventListener('mouseup', function (event) {
				if (event.target === document.querySelector('html')) {
					APP.fullPageScroll._isEnabled = true;
				}
			});

			window.addEventListener('wheel', function (event) {
				APP.fullPageScroll._oldSlide = APP.fullPageScroll._activeSlide;
				APP.fullPageScroll._activeSlide += (event.deltaY > 0 ? 1 : -1);

				if (APP.fullPageScroll._activeSlide < 0) {
					APP.fullPageScroll._activeSlide = 0;
				}

				if (APP.fullPageScroll._activeSlide > APP.fullPageScroll._slides.length) {
					APP.fullPageScroll._activeSlide = APP.fullPageScroll._slides.length;
				}

				if (APP.fullPageScroll._activeSlide === APP.fullPageScroll._oldSlide) {
					return;
				}
				APP.fullPageScroll.gotoSlide(APP.fullPageScroll._activeSlide);
			});

			window.addEventListener('scroll', function (event) {
				APP.fullPageScroll.calculateSlideActive();
			});

			$(document).ready(function () {
				APP.fullPageScroll.calculateSlideActive();
			});
		},
		gotoSlide: function (slideIndex) {
			if (slideIndex >= APP.fullPageScroll._slides.length) {
				return;
			}

			$('html').css('scroll-behavior', 'auto');
			let currentSlide = APP.fullPageScroll._slides[slideIndex];

			APP.fullPageScroll._tween = gsap.to(window, {
				scrollTo: { y: currentSlide.offsetTop, autoKill: false, ease: "Power3.easeInOut" },
				duration: 0.85,
				onComplete: function () {
					APP.fullPageScroll._isEnabled = true;
				}
			});
		},
		calculateSlideActive: function() {
			let scrollTop = window.scrollY;
			let currentSlide = 0;
			for (let i = 0; i < APP.fullPageScroll._slides.length; i++) {
				let slideTop = APP.fullPageScroll._slides[i].offsetTop;
				if (slideTop - scrollTop > window.innerHeight * 2 / 3) {
					break;
				}
				currentSlide = i;
			}
			APP.fullPageScroll.activeDot(currentSlide);
		},
		activeDot: function (slideIndex) {
			let currentSlide = APP.fullPageScroll._slides[slideIndex];

			if (APP.fullPageScroll.$_dots.length) {
				let dotsSkin = $(currentSlide).data('full-page-dots');
				APP.fullPageScroll.$_dots.removeClass('dark light');
				if (dotsSkin !== undefined) {
					APP.fullPageScroll.$_dots.addClass(dotsSkin);
				}

				APP.fullPageScroll.$_dots.find('.full-page-dots-nav').removeClass('active');
				let $curDot = APP.fullPageScroll.$_dots.find('.full-page-dots-nav[data-index="' + slideIndex + '"]');
				$curDot.addClass('active');
			}
		}
	}
	APP.fullPageScroll.init();
})(jQuery);
