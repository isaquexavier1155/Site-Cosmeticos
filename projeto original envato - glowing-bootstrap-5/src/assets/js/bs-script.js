/**
 * Tooltips ***/
var APP = APP || {};
(function ($) {
	'use strict';

	APP.bsScript = {
		init: function () {
			this.tooltips();
		},
		tooltips: function () {
			const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
			const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
		}
	};

	APP.bsScript.init();
})(jQuery);