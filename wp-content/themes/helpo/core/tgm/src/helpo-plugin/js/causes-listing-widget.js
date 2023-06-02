"use strict";

jQuery(window).on('elementor/frontend/init', function () {

    // --- Causes Listing Widget --- //
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_causes_listing.default', function ($scope) {
        $scope.find('.helpo_causes_list_item').each(function () {
            if (jQuery(this).find('.give-progress-bar').length) {
                let progress_bar = jQuery(this).find('.give-progress-bar'),
                    progress_bar_value = jQuery(progress_bar).attr('aria-valuenow');

                jQuery(progress_bar).find('span').append('<span class="helpo_progress_bar_marker">' + progress_bar_value + '%</span>');
            }
        });
    });

    // --- Donation Box Widget --- //
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_donation_box.default', function ($scope) {
        let popup_button = $scope.find('.helpo_donate_popup_button');

        popup_button.on('click', function () {
            jQuery(this).parent().find('.helpo_donation_popup').addClass('active');
            jQuery(this).parent().find('.helpo_close_popup_layer').addClass('active');

            setTimeout(function (button) {
                jQuery(button).parent().find('.helpo_close_popup_layer').addClass('visible');
                jQuery(button).parent().find('.helpo_donation_popup').addClass('visible');
            }, 100, this);
        });

        $scope.find('.helpo_close_popup_layer').on('click', function () {
            jQuery(this).removeClass('visible');
            jQuery(this).parent().find('.helpo_donation_popup').removeClass('visible');

            setTimeout(function (close_layer) {
                jQuery(close_layer).removeClass('active');
                jQuery(close_layer).parent().find('.helpo_donation_popup').removeClass('active');
            }, 500, this);
        });
    });
});