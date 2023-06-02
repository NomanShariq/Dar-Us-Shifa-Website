/**
 * Start advanced gmap widget script
 */

( function( $, elementor ) {

	'use strict';

	//Adavanced Google Map
	var widgetAvdGoogleMap = function( $scope, $ ) {

		var $advancedGoogleMap = $scope.find( '.bdt-advanced-gmap' ),
			map_settings       = $advancedGoogleMap.data('map_settings'),
			markers            = $advancedGoogleMap.data('map_markers'),
			map_form           = $scope.find('.bdt-gmap-search-wrapper > form');

		if ( ! $advancedGoogleMap.length ) {
			return;
		}

		var avdGoogleMap = new GMaps( map_settings );

		for (var i in markers) {
			avdGoogleMap.addMarker(markers[i]);
		}

		if($advancedGoogleMap.data('map_geocode')) {
			$(map_form).submit(function(e){
				e.preventDefault();
				GMaps.geocode({
					address: $(this).find('.bdt-search-input').val().trim(),
					callback: function(results, status){
						if( status === 'OK' ){
							var latlng = results[0].geometry.location;
							avdGoogleMap.setCenter(
								latlng.lat(),
								latlng.lng()
							);
							avdGoogleMap.addMarker({
								lat: latlng.lat(),
								lng: latlng.lng()
							});
						}
					}
				});
			});
		}

		if($advancedGoogleMap.data('map_style')) {
			avdGoogleMap.addStyle({
				styledMapName: 'Custom Map',
				styles: $advancedGoogleMap.data('map_style'),
				mapTypeId: 'map_style'
			});
			avdGoogleMap.setStyle('map_style');
		}

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-advanced-gmap.default', widgetAvdGoogleMap );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End advanced gmap widget script
 */

