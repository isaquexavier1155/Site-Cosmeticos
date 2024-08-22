var APP = APP || {};
(function ($) {
	'use strict';

	APP.select2 = {
		init: function () {
			//$('select').selectpicker();
			$('.multiple-select-field').select2({
				theme: "bootstrap-5",
				placeholder: $(this).data('placeholder') ? $(this).data('placeholder') : 'Nothing selected',
				containerCssClass: $(this).data('container-css-class'),
				closeOnSelect: false,
			});
		},
	};

	$(document).ready(function () {
		APP.select2.init();
	})
})(jQuery);
