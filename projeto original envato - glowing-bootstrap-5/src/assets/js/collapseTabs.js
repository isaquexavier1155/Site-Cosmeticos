var APP = APP || {};
(function ($) {
	'use strict';

	APP.collapseTabs = {
		init: function () {
			this.collapseTabSetUp();
		},
		collapseTabSetUp: function () {
			var _that = this;
			var $tabs = $('.collapse-tabs'),
				$tabContent = $tabs.find('.tab-content'),
				collapse = $tabContent.find('.collapse'),
				target = $tabContent.find('.collapse.show').attr('id'),
				btnCollapseActive = $tabContent.find('[data-bs-target="#' + target + '"]'),
				$navTab = $tabs.find('.nav-tabs'),
				$tabPane = $tabs.find('.tab-pane'),
				$navLink = $tabs.find('.nav-link');

			btnCollapseActive.attr('data-bs-toggle', false);
			$navLink.on('show.bs.tab', function (e) {
				var target = $(this).attr('data-bs-target'),
					tabPaneActive = $tabContent.find(target),
					btnCollapse = $tabContent.find('[data-bs-toggle]'),
					btnCollapseActive = tabPaneActive.find('[data-bs-toggle]'),
					collapseActive = tabPaneActive.find('.collapse');

				_that.switchDataToggle(btnCollapse, btnCollapseActive);
				_that.switchStatusActive(collapse, collapseActive, 'show');
			});

			collapse.on('show.bs.collapse', function () {
				var $this = $(this),
					target = $this.closest('.tab-pane').attr('id'),
					tabPaneActive = $(this).closest('.tab-pane'),
					btnCollapse = $tabContent.find('[data-bs-toggle]'),
					btnCollapseActive = tabPaneActive.find('[data-bs-toggle]'),
					$navLinkActive = $navTab.find('[data-bs-target="#' + target + '"]');

				collapse.removeClass('show');
				_that.switchDataToggle(btnCollapse, btnCollapseActive);
				_that.switchStatusActive($navLink, $navLinkActive, 'active');
				_that.switchStatusActive($tabPane, tabPaneActive, 'active');
				_that.switchStatusActive($tabPane, tabPaneActive, 'show');
			})
		},

		switchDataToggle: function (collapse, collapseActive) {
			collapse.attr('data-bs-toggle', 'collapse');
			collapseActive.attr('data-bs-toggle', false);
		},

		switchStatusActive: function (el, elActive, status) {
			el.removeClass(status);
			elActive.addClass(status);
		}
	};

	$(document).ready(function () {
		APP.collapseTabs.init();
	})
})(jQuery);
