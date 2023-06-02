/**
 * Start products widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetWCProductTable = function( $scope, $ ) {

		var $productTable = $scope.find( '.bdt-wc-products-skin-table' ),
            $settings 	  = $productTable.data('settings'),
            $table        = $productTable.find('> table');
            
        if ( ! $productTable.length ) {
            return;
        }

        $settings.language = window.ElementPackConfig.data_table.language;

        $($table).DataTable($settings);

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-wc-products.bdt-table', widgetWCProductTable );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End products widget script
 */

