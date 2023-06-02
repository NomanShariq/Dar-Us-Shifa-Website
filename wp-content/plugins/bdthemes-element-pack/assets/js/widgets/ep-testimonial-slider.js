/**
 * Start testimonial slider widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetCustomCarousel = function( $scope, $ ) {

		var $carousel = $scope.find( '.bdt-testimonial-slider' );
				
        if ( ! $carousel.length ) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
			$settings 		 = $carousel.data('settings');

		var swiper = new Swiper($carouselContainer, $settings);

		if ($settings.pauseOnHover) {
			 $($carouselContainer).hover(function() {
				(this).swiper.autoplay.stop();
			}, function() {
				(this).swiper.autoplay.start();
			});
		}

	};


	jQuery(window).on('elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-slider.default', widgetCustomCarousel );
		elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-testimonial-slider.bdt-single', widgetCustomCarousel );
	});

}( jQuery, window.elementorFrontend ) );

/**
 * End testimonial slider widget script
 */

