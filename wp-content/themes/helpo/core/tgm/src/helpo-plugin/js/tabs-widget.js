"use strict";

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_tabs.default', function ($scope) {
        let button = $scope.find('.helpo_video_trigger_button'),
            video_popup = $scope.find('.helpo_video_container'),
            video_container = $scope.find('.helpo_video_wrapper'),
            close_popup_layer = $scope.find('.helpo_close_popup_layer'),
            video_src = jQuery(video_container).attr('data-src'),
            video_height,
            video_width,
            k = 16/9,
            tab_title_container = $scope.find('.helpo_tabs_titles_container'),
            tab_content_container = $scope.find('.helpo_tabs_content_container');

        jQuery(tab_title_container).find('.helpo_tab_title_item').first().addClass('active');
        jQuery(tab_content_container).find('.helpo_tab_content_item').first().addClass('active');

        $scope.find('.helpo_tab_title_item a').on('click', function () {
            let active_container_selector = jQuery(this).parent().attr('data-id');

            if (jQuery(this).parent().is('.active')) {} else {
                tab_title_container.find('.active').removeClass('active');
                tab_content_container.find('.active').removeClass('active');

                jQuery(this).parent().addClass('active');
                tab_content_container.find('#' + active_container_selector + '').addClass('active');
            }
        });

        // --- Open Video Popup --- //
        jQuery(button).on('click', function () {
            jQuery(video_popup).addClass('active');

            setTimeout(function () {
                video_height = jQuery(video_container).height();
                video_width = video_height * k;

                jQuery(video_container).width(video_width);
                jQuery(video_container).append('<iframe frameborder="0" allowfullscreen="1" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" title="YouTube video player" width="100%" height="100%" src="' + video_src + '?playlist=ZdXao5XqeqM&amp;iv_load_policy=3&amp;enablejsapi=1&amp;disablekb=1&amp;autoplay=1&amp;controls=1&amp;showinfo=0&amp;rel=0&amp;loop=0&amp;wmode=transparent"></iframe>');
            }, 100);

            setTimeout(function () {
                jQuery(video_popup).addClass('visible');
            }, 500);
        });

        // --- Close Video Popup --- //
        jQuery(close_popup_layer).on('click', function () {
            jQuery(video_popup).removeClass('visible');

            setTimeout(function () {
                jQuery(video_container).html('');
                jQuery(video_popup).removeClass('active');
            }, 500);
        });

        // --- Window Resize --- //
        jQuery(window).on('resize', function () {
            video_height = jQuery(video_container).height();
            video_width = video_height * k;

            jQuery(video_container).width(video_width);
        });
    });
});
