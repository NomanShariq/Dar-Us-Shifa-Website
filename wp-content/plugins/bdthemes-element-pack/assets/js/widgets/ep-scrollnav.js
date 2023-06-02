/**
 * Start scrollnav widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetScrollNav = function( $scope, $ ) {

		var $scrollnav = $scope.find( '.bdt-dotnav > li' );

        if ( ! $scrollnav.length ) {
            return;
        }

		var $tooltip = $scrollnav.find('> .bdt-tippy-tooltip');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				appendTo: $scope[0]
			});				
		});

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-scrollnav.default', widgetScrollNav );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End scrollnav widget script
 */

