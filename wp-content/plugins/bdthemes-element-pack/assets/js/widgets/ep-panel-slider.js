/**
 * Start panel slider widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetPanelSlider = function( $scope, $ ) {

		var $slider = $scope.find( '.bdt-panel-slider' );
				
        if ( ! $slider.length ) {
            return;
        }

		var $sliderContainer = $slider.find('.swiper-container'),
			$settings 		 = $slider.data('settings');

		var swiper = new Swiper($sliderContainer, $settings);

		if ($settings.pauseOnHover) {
			 $($sliderContainer).hover(function() {
				(this).swiper.autoplay.stop();
			}, function() {
				(this).swiper.autoplay.start();
			});
		}

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-panel-slider.default', widgetPanelSlider );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-panel-slider.bdt-middle', widgetPanelSlider );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End panel slider widget script
 */

