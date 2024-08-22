var APP = APP || {};
(function ($) {
	'use strict';

	APP.gallery = {
		init: function () {
			this.lightGallery();
		},
		lightGallery: function () {
			$(document).on('click', 'a.view-single-image', function (event) {
				event.preventDefault();

				var $this = $(this),
					src = $this.attr('href'),
					title = $this.attr('title');

				lightGallery(this, {
					plugins: [lgThumbnail, lgZoom],
					dynamic: true,
					hash: false,
					dynamicEl: [
						{
							src: src,
							downloadUrl: src,
							thumb: src,
							subHtml: title
						}
					],
					index: 0
				}).openGallery();
			});

			/**
			 * Apply: <a href="[FULL IMAGE]" data-rel="lightGallery" data-gallery-id="[GALLERY ID]" data-thumb-src="[THUMB IMAGE]">[CONTENT]</a>
			 */
			$(document).on('click', "a[data-gallery]", function (event) {
				event.preventDefault();

				var $this = $(this),
					galleryId = $this.data('gallery'),
					_data = [],
					currentIndex = 0,
					current_src = $(this).attr('href'),
					current_thumb_src = $(this).data('thumb-src');

				$('[data-gallery="' + galleryId + '"]').each(function (index) {
					var src = $(this).attr('href'),
						thumb = $(this).data('thumb-src'),
						subHtml = $(this).attr('title');
					if (thumb === undefined) {
						thumb = src;
					}
					if (src == current_src && thumb == current_thumb_src) {
						currentIndex = index;
					}
					if (typeof(subHtml) == 'undefined') {
						subHtml = '';
					}
					_data.push({
						'src': src,
						'downloadUrl': src,
						'thumb': thumb,
						'subHtml': subHtml
					});
				});
				lightGallery(this, {
					plugins: [lgThumbnail, lgZoom],
					dynamic: true,
					hash: false,
					galleryId: galleryId,
					dynamicEl: _data,
					thumbWidth: 80,
					index: currentIndex
				}).openGallery();
			});

			$(document).on('click', 'a.view-video', function (event) {
				event.preventDefault();
				var src = $(this).attr('href');
				lightGallery(this, {
					dynamic: true,
					plugins: [lgThumbnail, lgZoom, lgVideo, lgVimeoThumbnail],
					dynamicEl: [{
						'src': src,
						'thumb': '',
						'subHtml': ''
					}]
				}).openGallery();
			});
		}
	};

	$(document).ready(function () {
		APP.gallery.init();
	})
})(jQuery);
