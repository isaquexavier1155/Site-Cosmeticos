var APP = APP || {};
(function ($) {
	'use strict';

	APP.headerSticky = {
		scroll_offset_before: 0,
		bs_theme: 'light',
		init: function () {
			this.sticky();
			this.scroll();
			this.resize();
			this.processSticky();
			this.resetHeight();
		},
		sticky: function () {
			$('.header-sticky .sticky-area').each(function () {
				var $this = $(this);
				if (!$this.is(':visible')) {
					return;
				}
				if (!$this.parent().hasClass('sticky-area-wrap')) {
					$this.wrap('<div class="sticky-area-wrap"></div>');
				}
				var $wrap = $this.parent();
				$wrap.height($this.outerHeight());
			});
		},
		resize: function () {
			$(document).on('after_prevent_transition_resize', function () {
				APP.headerSticky.sticky();
				APP.headerSticky.processSticky();
				APP.headerSticky.resetHeight();
			});
		},


		scroll: function () {
			$(window).on('scroll', function () {
				APP.headerSticky.processSticky();
			});
		},
		processSticky: function () {
			var current_scroll_top = $(window).scrollTop();

			var $parent = $('.main-header');
			var is_dark = false;
			if ($parent.hasClass('navbar-dark')) {
				is_dark = true;
			}
			$('.header-sticky .sticky-area').each(function () {
				var $this = $(this);
				if (!$this.is(':visible')) {
					return;
				}

				var $wrap = $this.parent(),
					sticky_top = 0,
					sticky_current_top = $wrap.offset().top,
					borderWidth = $('body').css('border-width');
				if (borderWidth !== '') {
					sticky_top += parseInt(borderWidth);
				}

				if ($this.hasClass('unset-mode-when-sticky') && $this.attr('data-bs-theme') !== undefined && document.documentElement.hasAttribute("data-bs-theme")) {
					this.bs_theme = $this.attr('data-bs-theme');
				}

				if (sticky_current_top - sticky_top < current_scroll_top) {
					$this.css('position', 'fixed');
					$this.css('top', sticky_top + 'px');
					$wrap.addClass('sticky');

					if ($this.hasClass('unset-mode-when-sticky') && document.documentElement.hasAttribute("data-bs-theme")) {
						$this.removeAttr('data-bs-theme');
						if (this.bs_theme !== undefined) {
							$this.removeAttr('data-bs-theme');
						}
					}

					if (is_dark) {
						$parent.removeClass('navbar-dark');
						$parent.addClass('navbar-light');
						$parent.addClass('navbar-light-sticky');
					}

				} else {
					if ($parent.hasClass('navbar-light-sticky')) {
						$parent.addClass('navbar-dark');
						$parent.removeClass('navbar-light');
						$parent.removeClass('navbar-light-sticky');
					}
					if ($wrap.hasClass('sticky')) {
						$this.css('position', '').css('top', '');
						$wrap.removeClass('sticky');
					}

					if ($this.hasClass('unset-mode-when-sticky') && document.documentElement.hasAttribute("data-bs-theme")) {
						$this.attr('data-bs-theme', this.bs_theme);
					}
				}
			});

			if (APP.headerSticky.scroll_offset_before > current_scroll_top) {
				$('.header-sticky-smart .sticky-area').each(function () {
					if ($(this).hasClass('header-hidden')) {
						$(this).removeClass('header-hidden');
					}
				});
			} else {
				// down
				$('.header-sticky-smart .sticky-area').each(function () {
					var $wrapper = $(this).parent();
					if ($wrapper.length) {
						if ((APP.headerSticky.scroll_offset_before > ($wrapper.offset().top + $(this).outerHeight())) && !$(this).hasClass('header-hidden')) {
							$(this).addClass('header-hidden');
						}
					}
				});
			}
			APP.headerSticky.scroll_offset_before = current_scroll_top;
		},

		resetHeight: function () {
			$('.header-sticky .sticky-area').each(function () {
				let $this = $(this),
					$wrap = $this.parent(),
					isSticky = $wrap.hasClass('sticky');
				if (isSticky) {
					$wrap.removeClass('sticky');
				}
				$wrap.height($this.outerHeight());

				if (isSticky) {
					$wrap.addClass('sticky');
				}
			});
		}
	};

	APP.header = {
		init: function () {
			$('.header.disable-transition-all').removeClass('disable-transition-all');
		}
	};

	$(document).ready(function () {
		APP.headerSticky.init();
		APP.header.init();
	});
})(jQuery);
