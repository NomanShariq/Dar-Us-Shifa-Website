/**
 * Start section sticky widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetSectionSticky = function( $scope, $ ) {

        var $section   = $scope;

        //sticky fixes for inner section.
        $.each($section, function( index ) {
            var $sticky      = $(this),
                $stickyFound = $sticky.find('.elementor-inner-section.bdt-sticky');
                
            if ($stickyFound.length) {
                $($stickyFound).wrap('<div class="bdt-sticky-wrapper"></div>');
            }
        });

	};


	jQuery(window).on('elementor/frontend/init', function() {
        elementor.hooks.addAction( 'frontend/element_ready/section', widgetSectionSticky );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End section sticky widget script
 */

