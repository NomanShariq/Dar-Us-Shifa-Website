"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_content_slider.default', function ($scope) {
        let trigger = $scope.find('.helpo_video_trigger'),
            slider = $scope.find('.helpo_slider_slick'),
            slider_options = slider.data('slider-options'),
            prev = $scope.find('.helpo_causes_slider_navigation_container .helpo_prev'),
            next = $scope.find('.helpo_causes_slider_navigation_container .helpo_next'),
            status = $scope.find('.helpo_slider_counter');

        trigger.fancybox();

        slider.on('init afterChange', function (event, slick, currentSlide, nextSlide) {
            var i = (currentSlide ? currentSlide : 0) + 1;
            status.text(i + '/' + slick.slideCount);
        });

        slider.slick({
            fade: true,
            pauseOnHover: slider_options['pauseOnHover'],
            autoplay: slider_options['autoplay'],
            autoplaySpeed: slider_options['autoplaySpeed'],
            speed: slider_options['speed'],
            infinite: slider_options['infinite'],
            cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
            touchThreshold: 100,
            rtl: slider_options['rtl'],
            slidesToShow: 1,
            prevArrow: prev,
            nextArrow: next,
            adaptiveHeight: true
        });
    });
});
