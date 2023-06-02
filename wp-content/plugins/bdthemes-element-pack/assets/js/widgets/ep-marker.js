/**
 * Start marker widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetMarker = function( $scope, $ ) {

		var $marker = $scope.find( '.bdt-marker-wrapper' );

        if ( ! $marker.length ) {
            return;
        }

		var $tooltip = $marker.find('> .bdt-tippy-tooltip');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				appendTo: $scope[0]
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-marker.default', widgetMarker );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End marker widget script
 */

