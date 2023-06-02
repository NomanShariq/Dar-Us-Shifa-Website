/**
 * Start portfolio carousel widget script
 */

(function($, elementor) {

    'use strict';

    var widgetPortfolioCarousel = function($scope, $) {

        var $carousel = $scope.find('.bdt-portfolio-carousel');

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
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.default', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-abetis', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-fedara', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-trosia', widgetPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-portfolio-carousel.bdt-janes', widgetPortfolioCarousel);
    });

}(jQuery, window.elementorFrontend));

/**
 * End portfolio carousel widget script
 */

