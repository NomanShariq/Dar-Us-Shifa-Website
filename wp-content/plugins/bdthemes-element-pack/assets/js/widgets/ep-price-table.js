/**
 * Start price table widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetPriceTable = function( $scope, $ ) {

		var $priceTable = $scope.find( '.bdt-price-table' ),
            $featuresList = $priceTable.find( '.bdt-price-table-feature-inner' );

        if ( ! $priceTable.length ) {
            return;
        }

        var $tooltip = $featuresList.find('> .bdt-tippy-tooltip');
		
		$tooltip.each( function( index ) {
			tippy( this, {
				appendTo: $scope[0]
			});				
		});

    };
    

	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-price-table.default', widgetPriceTable );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-price-table.bdt-partait', widgetPriceTable );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End price table widget script
 */

