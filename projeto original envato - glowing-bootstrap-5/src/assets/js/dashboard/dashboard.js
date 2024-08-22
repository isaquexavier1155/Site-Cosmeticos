var APP = APP || {};
(function ($) {
	'use strict';

	APP.dashboard = {
		init: function () {
			this.chartjs();
			this.activeSidebarMenu();
			this.dropdownMenuLeft();
		},
		chartjs: function () {
			var $chartEls = $('.chartjs');
			$chartEls.each(function () {
				var $chartEl = $(this);
				var chatType = $chartEl.data('chart-type'),
					options = $chartEl.data('chart-options'),
					labels = $chartEl.data('chart-labels'),
					datasets = $chartEl.data('chart-datasets'),
					more_setting = $chartEl.data('chart-additional-options'),
					chartId = more_setting.chatId,
					$ctx = $('#' + chartId),
					defaultOptions = {
						maintainAspectRatio: false,
					};
				options = $.extend(true, defaultOptions, options);
				var myChart = new Chart($ctx, {
					type: chatType,
					data: {
						labels: labels,
						datasets: datasets
					},
					options: options
				});

			});

		},

		dropdownMenuLeft: function () {
			var $multiEls = $('.has-children .sidebar-item');
			const bsCollapse = new bootstrap.Collapse($(".has-children"), {
				toggle: false
			});

			$.each($multiEls, function () {
				var $this = $(this);
				var $collapse_parent = $this.parents('.menu-collapse');
				if ($this.hasClass('active')) {
					setTimeout(function () {
						$collapse_parent.collapse('show');
					}, 100);

				} else {
					$collapse_parent.collapse('hide');
				}

			});

		},
		activeSidebarMenu: function () {
			var $sidebar = $('.db-sidebar');
			if ($sidebar.length < 1) {
				return;
			}
			var $current_link = window.location.pathname;
			var $sidebarLink = $sidebar.find('.sidebar-link');
			$sidebarLink.each(function () {
				var href = $(this).attr('href').replace('..', '');
				if ($current_link.indexOf(href) > -1) {
					var $sidebar_item = $(this).parent('.sidebar-item');
					$sidebar_item.addClass('active');
				}
			});

		},
	};

	$(document).ready(function () {
		APP.dashboard.init();
	})
})(jQuery);
