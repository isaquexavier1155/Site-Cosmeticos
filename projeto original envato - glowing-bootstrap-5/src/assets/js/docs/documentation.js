var APP = APP || {};
(function ($) {
	'use strict';

	APP.documentation = {
		init: function () {
			this.docToc();
			this.docAnchorLink();
			this.docSidebar();
		},
		docToc: function () {
			// Initial document toc
			if ($.fn.toc) {
				$('#docs-toc').toc({
					content: '.doc-content'
				});
			}
		},
		docAnchorLink: function () {
			// Add heading link
			$('#docs-toc a').each(function () {
				var $this = $(this),
					id = $this.attr('href');
				$(id).append('<a class="anchor-link" href="' + id + '"></a>');
			});

			// Scroll to anchor element
			if ($('.doc-content').length > 0) {
				try {
					var hash = location.hash;
					if (hash && ($(hash).length > 0)) {
						$(hash)[0].scrollIntoView();
					}
				}
				catch {}
			}
		},
		docSidebar: function () {
			var $header = $('header.bd-navbar'),
				headerHeight = $header.outerHeight();
			$('.doc-sidebar').css('--header-height', headerHeight + 'px');
		}
	};

	$(document).ready(function () {
		APP.documentation.init();
	})
})(jQuery);
