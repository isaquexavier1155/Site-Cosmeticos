var APP = APP || {};
(function ($) {
	'use strict';

	APP.docSearch = {
		isFirstRun: true,
		fuse: null,
		docData: [],
		preTerm: null,

		init: function () {
			this.eventHandler();
		},
		eventHandler: function () {
			$('.doc-search-button').on('click', function () {
				if(APP.docSearch.isFirstRun) {
					APP.docSearch.loadDocSearch(); // loads our json data and builds fuse.js search index
					APP.docSearch.isFirstRun = false; // let's never do this again
				}
				APP.docSearch.openDocSearch();
			});

			// Open docs search: CMD + /
			$(document).on('keydown', function (event) {
				if (event.ctrlKey && (event.keyCode === 191)) {
					$('.doc-search-button').trigger('click');
				}

				var $modal = $('#doc-search-modal-container');

				if (!$modal.hasClass('visually-hidden')) {
					var $list = $('.doc-search-result-list'),
						$liCurrent = $list.find('li.active');

					// ESC press
					if (event.keyCode === 27) {
						$modal.addClass('visually-hidden');
					}

					if ($list.is(':visible')) {
						// key UP press
						if (event.keyCode === 38) {
							var $liPre = $liCurrent.prev();
							if ($liPre.length === 0) {
								$liPre = $list.find('li:last');
							}

							$liCurrent.removeClass('active');
							$liPre.addClass('active');
							event.preventDefault();
						}

						// key DOWN press
						if (event.keyCode === 40) {
							var $liNext = $liCurrent.next();
							if ($liNext.length === 0) {
								$liNext = $list.find('li:first');
							}

							$liCurrent.removeClass('active');
							$liNext.addClass('active');
							event.preventDefault();
						}

						// ENTER press
						if (event.keyCode === 13) {
							if ($liCurrent.length > 0) {
								window.location.href = $liCurrent.find('a').attr('href');
							}
							event.preventDefault();
						}
					}
				}
			});
			var $docInput = $('#docsearch-input');

			$docInput.on('keyup', function (event) {
				APP.docSearch.excuteSearch(this.value);
			});

			$docInput.on('change', function (event) {
				APP.docSearch.excuteSearch(this.value);
			});

			$('#doc-search-modal-container').on('click', function (event) {
				if ($(event.target).closest('.doc-search-modal').length === 0) {
					$('#doc-search-modal-container').addClass('visually-hidden');
				}
			});
		},

		getDocPath: function () {
			var arrPath = window.location.href.split('/');
			arrPath.pop();
			arrPath.pop();
			arrPath.pop();

			return arrPath.join('/');
		},

		excuteSearch: function (term) {
			var $list = $('.doc-search-result-list'),
				$noResult = $('.doc-search-no-result'),
				$startScreen = $('.doc-search-start-screen');

			if (APP.docSearch.fuse === null) {
				return;
			}

			term = term.trim();
			if (term === '') {
				$startScreen.show();
				$list.hide();
				$noResult.hide();
			}
			else if (APP.docSearch.preTerm !== term) {
				$startScreen.hide();

				let result = APP.docSearch.fuse.search(term);
				if (result.length === 0) {
					$list.hide();
					$noResult.show();
					$('.doc-search-result-message > span').text(term);
				}
				else {
					$list.find('ul').html('');
					var docPath = APP.docSearch.getDocPath();

					for (var i in result.slice(0,10)) {
						var itemUrl = docPath + result[i].item.permalink;
						var description = result[i].item.description ? '<p>' + result[i].item.description + '</p>' : '';
						$list.find('ul').append('<li class=""><a href="' + itemUrl + '"><span></span><div><h6>' + result[i].item.title + '</h6>' + description + '</div></a></li>');
					}
					$list.find('a > span').append('<svg viewBox="0 0 20 20"><path d="M17 6v12c0 .52-.2 1-1 1H4c-.7 0-1-.33-1-1V2c0-.55.42-1 1-1h8l5 5zM14 8h-3.13c-.51 0-.87-.34-.87-.87V4" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linejoin="round"></path></svg>');
					$list.show();
					$list.find('li').first().addClass('active');
					$noResult.hide();

					$('.doc-search-result-list li').mouseenter(function () {
						$('.doc-search-result-list li').removeClass('active');
						$(this).addClass('active');
					});
				}
			}

			APP.docSearch.preTerm = term;
		},

		loadDocSearch: function () {
			$.ajax({
				url: APP.docSearch.getDocPath() + '/index.json',
				dataType: "json",
				success: function( response ) {
					APP.docSearch.docData = response;

					APP.docSearch.fuse = new Fuse(response, {
						minMatchCharLength: 1,
						location: 0,
						threshold: 0.1,
						fieldNormWeight: 1,
						distance: 10000,
						findAllMatches: true,
						keys: [
							'title',
							'description',
							'contents'
						]
					});
				}
			});
		},
		openDocSearch: function () {
			var $modal = $('#doc-search-modal-container');

			if ($modal.length === 0) {
				return;
			}
			$modal.toggleClass('visually-hidden');
			$modal.find('#docsearch-input').focus();
		}
	}

	$(document).ready(function () {
		APP.docSearch.init();
	})
})(jQuery);
