"use strict";

jQuery(window).load(function () {
    // Isotope Activation
    if (jQuery('div').is('.helpo_isotope_trigger')) {
        jQuery('.helpo_isotope_trigger').isotope();
    }
});

jQuery(window).on('elementor/frontend/init', function () {

    // -------------------------- //
    // --- Causes Grid Widget --- //
    // -------------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_causes_grid.default', function ($scope) {
        if (jQuery('div').is('.projects-masonry')) {
            jQuery('.projects-masonry').each(function () {
                jQuery(this).isotope();
            });
        }
    });

    // ---------------------- //
    // --- Gallery Widget --- //
    // ---------------------- //
    elementorFrontend.hooks.addAction('frontend/element_ready/helpo_gallery.default', function ($scope) {
        if (jQuery('div').is('.gallery-masonry')) {
            jQuery('.gallery-masonry').each(function () {
                jQuery(this).isotope();
            });
        }
    });
});
