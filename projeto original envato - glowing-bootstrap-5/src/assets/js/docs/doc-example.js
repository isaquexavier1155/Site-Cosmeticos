var APP = APP || {};
(function ($) {
	'use strict';

	APP.docExample = {
		init: function () {
			this.alert();
		},
		alert: function () {
			const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
			const alertTrigger = document.getElementById('liveAlertBtn');
			const appendAlert = (message, type) => {
				const wrapper = document.createElement('div')
				wrapper.innerHTML = [
					`<div class="alert alert-${type} alert-dismissible" role="alert">`,
					`   <div>${message}</div>`,
					'   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
					'</div>'
				].join('')

				alertPlaceholder.append(wrapper)
			}
			if (alertTrigger) {
				alertTrigger.addEventListener('click', () => {
					appendAlert('Nice, you triggered this alert message!', 'success')
				})
			}
		},
	};

	$(document).ready(function () {
		APP.docExample.init();
	})
})(jQuery);
