/**
 * Start fancy slider widget script
 */

(function($, elementor) {

    'use strict';

    var widgetFancySlider = function($scope, $) {

        var $slider = $scope.find('.bdt-fancy-slider');

        if (!$slider.length) {
            return;
        }

        var $sliderContainer = $slider.find('.swiper-container'),
            $settings = $slider.data('settings');

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
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-fancy-slider.default', widgetFancySlider);
    });

}(jQuery, window.elementorFrontend));

/**
 * End fancy slider widget script
 */

