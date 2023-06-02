/**
 * Start search widget script
 */

( function( $, elementor ) {

	'use strict';

	var serachTimer;

	var widgetAjaxSearch = function($search) {

		var $searchWidget = $('.bdt-ajax-search');
		var $resultHolder = $($searchWidget).find('.bdt-search-result');
		
		clearTimeout( serachTimer );

		serachTimer = setTimeout( function() {

			$($searchWidget).addClass('bdt-search-loading');

			jQuery.ajax({
				url: window.ElementPackConfig.ajaxurl,
				type:'post',
				data: {
					action: 'element_pack_search',
					s: $search,

				},
				success:function(response){
					response=$.parseJSON(response);
					//console.log(response);
					//console.log(response.results);
					if( response.results.length > 0 ){
						var html = '<div class="bdt-search-result-inner">';
						html += '<h3 class="bdt-search-result-header">SEARCH RESULT</h3>';
						html += '<ul class="bdt-list bdt-list-divider">';
						for( var i = 0; i < response.results.length; i++ ){
							html += '<li class="bdt-search-item" data-url="'+ response.results[i].url + '">\
                                          <a href="' + response.results[i].url + '" target="_blank">\
                                              <div class="bdt-search-title">' + response.results[i].title + '</div>\
                                              <div class="bdt-search-text">' + response.results[i].text + '</div>\
                                          </a>\
                                      </li>\
                                    ';
						}
						html += '</ul>';
						html += '<a class="bdt-search-more">More Results</a>';
						html += '</div>';
						
						$resultHolder.html(html);

						bdtUIkit.drop($resultHolder, {
							pos: 'bottom-justify'
						}).show();

						$($searchWidget).removeClass('bdt-search-loading');

						$('.bdt-search-more').on('click', function(event){
							event.preventDefault();       
							$($searchWidget).submit();
						});

					}


				}
			});

		}, 450 );
		
	};

	window.elementPackAjaxSearch = widgetAjaxSearch;

}( jQuery, window.elementorFrontend ) );

/**
 * End search widget script
 */

