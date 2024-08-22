var APP = APP || {};
(function ($) {
	'use strict';

	APP.singleShop = {
		init: function () {
			this.shopFBT();
		},
		shopFBT: function () {
			var FBT = $('.frequently-bought-togheter'),
				fbtItem = FBT.find('.frequently-bought-togheter-item'),
				addItem = fbtItem.find('.add-to-item');

			const originalTitle = addItem.attr('data-bs-title');
			const titleAdded = addItem.attr('data-bs-added');

			if (FBT.length < 1 && fbtItem.length < 1) {
				return;
			}

			addItem.unbind('click').on('click', function (e) {
				e.preventDefault();
				var $this = $(this),
					idTooltip = $this.attr('aria-describedby');

				if ($this.hasClass('checked')) {
					$this.removeClass('checked');
					$this.siblings('.form-check-input').prop("checked", false);
					$this.html('<svg class="icon icon-plus"><use xlink:href="#icon-plus"></use></svg>');
					switchTooltip($this, idTooltip, originalTitle);

				} else {
					$this.addClass('checked');
					$this.siblings('.form-check-input').prop("checked", true);
					$this.html('<svg class="icon icon-check-bold"><use xlink:href="#icon-check-bold"></use></svg>');
					switchTooltip($this, idTooltip, titleAdded);
				}

			});

			function switchTooltip(selector, id, word) {
				var toolTip = $('#' + id);

				if (id !== '' && toolTip.length < 1) {
					return;
				}

				selector.attr('data-bs-title', word);
				toolTip.find('.tooltip-inner').html(word);
			}
		},
	};

	$(document).ready(function () {
		APP.singleShop.init();
	})
})(jQuery);
