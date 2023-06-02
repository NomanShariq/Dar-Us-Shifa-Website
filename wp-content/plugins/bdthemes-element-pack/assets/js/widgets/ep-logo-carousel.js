/**
 * Start logo carousel widget script
 */

(function($, elementor) {

    'use strict';

    var widgetLogoCarousel = function($scope, $) {

        var $logocarousel = $scope.find('.bdt-logo-carousel-wrapper');

        if (!$logocarousel.length) {
            return;
        }

        var $tooltip = $logocarousel.find('> .bdt-tippy-tooltip');

        $tooltip.each(function(index) {
            tippy(this, {
                appendTo: $scope[0]
            });
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-logo-carousel.default', widgetLogoCarousel);
    });

}(jQuery, window.elementorFrontend));

/**
 * End logo carousel widget script
 */

