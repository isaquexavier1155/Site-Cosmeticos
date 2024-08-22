var APP = APP || {};
(function ($) {
	'use strict';

	APP.mapBox = {
		init: function () {
			var $map_box = $('.mapbox-gl');
			if ($map_box.length < 1) {
				return;
			}

			var options_default = {
				style: 'mapbox://styles/mapbox/streets-v10',
				center: [-73.9927227, 40.6734035],
				zoom: 16
			};
			$map_box.each(function () {
				var $this = $(this),
					options = $this.data('mapbox-options'),
					markers = $this.data('mapbox-marker');
				options = $.extend({}, options_default, options);

				var idContainer = $this.attr('id');
				if (idContainer.length < 1) {
					return;
				}
				options['container'] = idContainer;
				mapboxgl.accessToken = $this.data('mapbox-access-token');
				var map = new mapboxgl.Map(options);
				var $marker_el = $($this.data('marker-target'));
				var $marker_els = $marker_el.find('.marker-item');
				if ($marker_els.length > 0) {
					$.each($marker_els, function () {
						var $marker_style = $(this).data('marker-style');
						var el = document.createElement('div');
						el.className = $marker_style.className;
						el.style.backgroundImage = 'url(' + $(this).data('icon-marker') + ')';
						el.style.width = $marker_style.style.width;
						el.style.height = $marker_style.style.height;
						new mapboxgl.Marker(el)
							.setLngLat($(this).data('position'))
							.setPopup(new mapboxgl.Popup({className: $marker_style.popup.className})
								.setHTML($(this).html())
								.setMaxWidth($marker_style.popup.maxWidth)
							)
							.addTo(map);
					});
				} else {
					$.each(markers, function () {
						var el = document.createElement('div');
						el.className = this.className;
						el.style.backgroundImage = 'url(' + this.backgroundImage + ')';
						el.style.backgroundRepeat = this.backgroundRepeat;
						el.style.width = this.width;
						el.style.height = this.height;
						var marker = new mapboxgl.Marker(el)
							.setLngLat(this.position)
							.addTo(map);
					})
				}

				map.scrollZoom.disable();
				map.addControl(new mapboxgl.NavigationControl());
				map.on('load', function () {
					map.resize();
				});
			});


		}
	};

	$(document).ready(function () {
		APP.mapBox.init();
	})
})(jQuery);