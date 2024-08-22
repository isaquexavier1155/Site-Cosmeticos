var APP = APP || {};
(function ($) {
	'use strict';

	APP.isotopeFilter = {
		init: function () {
			this.setupIsotope();
			this.setupIsotopeFilter();
		},
		setupIsotope: function() {
			$('[data-options-isotope]').each(function (index, el) {
				var options = $(this).data('options-isotope');
				var options_default = {};
				options = $.extend({}, options_default, options);
				$(this).isotope(options);
			});
		},
		setupIsotopeFilter: function () {
			$('[data-isotope-filter]').on('click', function () {
				var $this = $(this),
					$grid = $($this.data('isotope-target')),
					$parent = $this.closest('[data-isotope-filter-parent]'),
					filter = $this.data('isotope-filter');
				$grid.isotope({filter: filter});
				$parent.find('[data-isotope-filter]').removeClass('active');
				$this.addClass('active');
			});
		}
	};

	$(document).ready(function () {
		APP.isotopeFilter.init();
	});
})(jQuery);
