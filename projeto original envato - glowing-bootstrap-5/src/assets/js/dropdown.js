(function ($) {
	'use strict';

	const HAS_DROPDOWN_CHILD_SHOW_CLASS = 'has-child-dropdown-show';

	$(document).on('show.bs.dropdown', function (event) {
		if ($(event.target).closest('#offCanvasNavBar').length === 0) {
			return;
		}

		if (!$(event.target).hasClass('nav-link')) {
			$(event.target).addClass(HAS_DROPDOWN_CHILD_SHOW_CLASS);
		}
	});

	$(document).on('hide.bs.dropdown', function (event) {
		if ($(event.target).closest('#offCanvasNavBar').length === 0) {
			return;
		}

		if ($(event.target).parent().find('.' + HAS_DROPDOWN_CHILD_SHOW_CLASS).length) {
			event.preventDefault();
		}

		$('#offCanvasNavBar').find('.' + HAS_DROPDOWN_CHILD_SHOW_CLASS).removeClass(HAS_DROPDOWN_CHILD_SHOW_CLASS);
		if ($(event.target).closest('.nav-item')
			&& !$(event.target).parent().hasClass('nav-item')
			&&  (event.clickEvent === undefined ||  event.clickEvent && (event.clickEvent.target === event.target))) {

			$(event.target).addClass(HAS_DROPDOWN_CHILD_SHOW_CLASS);
		}
	});
})(jQuery);
