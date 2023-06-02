"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_testimonials.default', function ($scope) {
        let testimonials = $scope.find('.helpo_slider_slick'),
            slider_options = testimonials.data('slider-options'),
            prev = $scope.find('.helpo_causes_slider_navigation_container .helpo_prev'),
            next = $scope.find('.helpo_causes_slider_navigation_container .helpo_next');

        testimonials.slick({
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: slider_options['slidesToShow'],
            prevArrow: prev,
            nextArrow: next,
            adaptiveHeight: true,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            }],
        });
    });
});
