var APP = APP || {};
(function ($) {
	'use strict';

	APP.hightlight = {
		init: function () {
			this.initHighlight();
		},
		formatHtml: function(html) {
			return html_beautify(html);
		},
		initHighlight: function() {
			$('code.hljs').each(function () {
				let data = $(this).data('content');
				if (data) {
					data = APP.hightlight.formatHtml(JSON.parse(data));

					let html = hljs.highlight(data, {language: "html"}).value;

					this.innerHTML = html.replace(/^\s*[\r\n]/gm, "");
				}
			});
		}
	};
	APP.hightlight.init();

})(jQuery);
