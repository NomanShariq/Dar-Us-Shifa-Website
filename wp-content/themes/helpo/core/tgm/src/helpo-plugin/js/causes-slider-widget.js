"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_causes_slider.default', function ($scope) {
        let causesSlider = $scope.find('.helpo_slider_slick'),
            slider_options = causesSlider.data('slider-options'),
            prev = $scope.find('.helpo_causes_slider_navigation_container .helpo_prev'),
            next = $scope.find('.helpo_causes_slider_navigation_container .helpo_next');

        if (!causesSlider.length) return;

        $scope.find('.helpo_causes_list_item').each(function () {
            if (jQuery(this).find('.give-progress-bar').length) {
                let progress_bar = jQuery(this).find('.give-progress-bar'),
                    progress_bar_value = jQuery(progress_bar).attr('aria-valuenow');

                jQuery(progress_bar).find('span').append('<span class="helpo_progress_bar_marker">' + progress_bar_value + '%</span>');
            }

            jQuery(this).find('.give-form-title').detach();
            jQuery(this).find('form.give-form').detach();
        });

        $scope.find('.helpo_offset_container').width(jQuery(window).width());

        if (jQuery(causesSlider).is('.slider_type_3')) {
            causesSlider.slick({
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
                fade: true
            });
        } else {
            causesSlider.slick({
                pauseOnHover: slider_options['pauseOnHover'],
                autoplay: slider_options['autoplay'],
                autoplaySpeed: slider_options['autoplaySpeed'],
                speed: slider_options['speed'],
                infinite: slider_options['infinite'],
                cssEase: 'cubic-bezier(0.7, 0, 0.3, 1)',
                touchThreshold: 100,
                rtl: slider_options['rtl'],
                slidesToShow: 3,
                prevArrow: prev,
                nextArrow: next,
                responsive: [{
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 2,
                    }
                }, {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                    }
                }]
            });
        }
    });
});
