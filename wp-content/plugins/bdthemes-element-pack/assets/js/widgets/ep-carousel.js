(function($, elementor) {

    'use strict';

    var widgetCarousel = function($scope, $) {

        var $carousel = $scope.find('.bdt-carousel');

        if (!$carousel.length) {
            return;
        }

        var $carouselContainer = $carousel.find('.swiper-container'),
            $settings = $carousel.data('settings');

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
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.default', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-alice', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-vertical', widgetCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-carousel.bdt-ramble', widgetCarousel);
    });

}(jQuery, window.elementorFrontend));