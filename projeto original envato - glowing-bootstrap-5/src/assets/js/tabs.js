var APP = APP || {};
(function ($) {
	'use strict';

	APP.tabs = {
		init: function () {
			this.tab_accordion();
			this.tab_dropdown();
		},
		tab_accordion: function () {
			$('[data-bs-toggle="tab-accordion"] [data-bs-toggle="tab"]').on('shown.bs.tab', function (event) {
				var $currentTab = $(event.target),
					$previousTab = $(event.relatedTarget),
					$wrapper = $(this).closest('[data-bs-toggle="tab-accordion"]'),
					$currentPanel = $wrapper.find($currentTab.data('bs-target')),
					$previousPanel = $wrapper.find($previousTab.data('bs-target'));
				$currentPanel.find('.collapse').addClass('show');
				$previousPanel.find('.collapse').removeClass('show');
				$currentPanel.find('[data-bs-toggle="collapse"]').removeClass('collapsed');
				$previousPanel.find('[data-bs-toggle="collapse"]').addClass('collapsed');

			});

			$('[data-bs-toggle="tab-accordion"] .collapse').on('shown.bs.collapse', function (event) {
				var $currentPane = $(event.target).closest('.tab-pane');
				if ($currentPane.length) {
					var $currentTab =  $('[data-bs-target="#'+ $currentPane.attr('id')  +'"]');
					if ($currentTab.length) {
						var $parentTabs = $currentTab.closest('.nav-tabs');
						if ($parentTabs.length) {
							$parentTabs.find('[data-bs-toggle="tab"]').removeClass('active');
							var $tabContent = $parentTabs.next('.tab-content');
							if ($tabContent.length) {
								$tabContent.find('.tab-pane').removeClass('show active');
							}
							$currentPane.addClass('show active');
							$currentTab.addClass('active');
						}
					}
				}
			})
		},
		tab_dropdown: function () {
			$('[data-bs-toggle="tab-dropdown"] [data-bs-toggle="tab"]').on('shown.bs.tab',function (event) {
				var $currentTab = $(event.target),
					$previousTab = $(event.relatedTarget),
					$wrapper = $(this).closest('[data-bs-toggle="tab-dropdown"]'),
					target = $currentTab.data('bs-target');

				$wrapper.find('[data-bs-toggle="tab"]').removeClass('active');
				$wrapper.find('[data-bs-target="'+ target +'"]').addClass('active');
				$wrapper.find('[data-bs-toggle="dropdown"]').text($currentTab.text());
			})
		}

	};

	$(document).ready(function () {
		APP.tabs.init();
	});

})(jQuery);
