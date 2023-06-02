/**
 * Start helpdesk widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetHelpDesk = function( $scope, $ ) {

		var $helpdesk = $scope.find( '.bdt-helpdesk' ),
            $helpdeskTooltip = $helpdesk.find('.bdt-helpdesk-icons');

        if ( ! $helpdesk.length ) {
            return;
        }

		
		var $tooltip = $helpdeskTooltip.find('> .bdt-tippy-tooltip');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				appendTo: $scope[0]
			});				
		});

		

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-helpdesk.default', widgetHelpDesk );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End helpdesk widget script
 */

