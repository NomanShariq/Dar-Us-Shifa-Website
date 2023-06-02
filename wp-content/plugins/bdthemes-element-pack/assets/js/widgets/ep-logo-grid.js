/**
 * Start logo grid widget script
 */

(function($, elementor) {

    'use strict';

    var widgetLogoGrid = function($scope, $) {

        var $logogrid = $scope.find('.bdt-logo-grid-wrapper');

        if (!$logogrid.length) {
            return;
        }

        var $tooltip = $logogrid.find('> .bdt-tippy-tooltip');

        $tooltip.each(function(index) {
            tippy(this, {
                appendTo: $scope[0]
            });
        });

    };


    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-logo-grid.default', widgetLogoGrid);
    });

}(jQuery, window.elementorFrontend));

/**
 * End logo grid widget script
 */

