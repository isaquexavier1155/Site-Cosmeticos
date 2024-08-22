var APP = APP || {};
(function ($) {
	'use strict';

	APP.animation = {
		delay: 100,
		itemQueue: [],
		queueTimer: null,
		$wrapper: null,
		init: function () {
			var _self = this;
			_self.$wrapper = $('body');
			_self.itemQueue = [];
			_self.queueTimer = null;
			if (typeof delay !== 'undefined') {
				_self.delay = delay;
			}

			_self.itemQueue["animated_0"] = [];

			$('body').find('#content').find('>div,>section').each(function (index) {
				$(this).attr('data-animated-id', (index + 1));
				_self.itemQueue["animated_" + (index + 1)] = [];
			});

			setTimeout(function () {
				_self.registerAnimation();
			}, 200);
		},
		registerAnimation: function () {
			var _self = this;
			$('[data-animate]:not(.animate__animated)', _self.$wrapper).waypoint(function () {
				// Fix for different ver of waypoints plugin.
				var _el = this.element ? this.element : this,
					$this = $(_el);
				if ($this.is(":visible")) {
					var $animated_wrap = $this.closest("[data-animated-id]"),
						animated_id = '0';
					if ($animated_wrap.length) {
						animated_id = $animated_wrap.data('animated-id');
					}
					_self.itemQueue['animated_' + animated_id].push(_el);
					_self.processItemQueue();
				} else {
					$this.addClass('animate__' + $this.data('animate')).addClass('animate__animated');
				}
			}, {
				offset: '100%',
				triggerOnce: true
			});
		},
		processItemQueue: function () {
			var _self = this;
			if (_self.queueTimer) return; // We're already processing the queue
			_self.queueTimer = window.setInterval(function () {
				var has_queue = false;
				for (let animated_id in _self.itemQueue) {
					if (_self.itemQueue[animated_id].length) {
						has_queue = true;
						break;
					}
				}

				if (has_queue) {
					for (let animated_id in _self.itemQueue) {
						var $item = $(_self.itemQueue[animated_id].shift());
						$item.addClass('animate__' + $item.data('animate')).addClass('animate__animated');
					}
					_self.processItemQueue();
				} else {
					window.clearInterval(_self.queueTimer);
					_self.queueTimer = null
				}


			}, _self.delay);
		}
	};
	$(document).ready(function () {
		APP.animation.init();
	});

})(jQuery);
