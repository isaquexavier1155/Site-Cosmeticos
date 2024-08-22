var APP = APP || {};
(function ($) {
	'use strict';

	APP.core = {
		_devices: {
			xs: 0,
			sm: '576',
			md: '768',
			lg: '992',
			xl: '1200',
			xxl: '1400'
		},
		isDeviceUp: function (device) {
			return window.matchMedia('(min-width: ' + APP.core._devices[device] + 'px)').matches;
		},
		isDeviceDown: function (device) {
			return window.matchMedia('(max-width: ' + (APP.core._devices[device] - 1) + 'px)').matches;
		}
	}
})(jQuery);
