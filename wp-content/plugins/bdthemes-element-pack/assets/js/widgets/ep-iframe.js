/**
 * Start iframe widget script
 */

(function ($, elementor) {

    'use strict';

    var widgetIframe = function ($scope, $) {

        var $iframe     = $scope.find('.bdt-iframe > iframe'),
            $autoHeight = $iframe.data('auto_height');

        if ( !$iframe.length ) {
            return;
        }

        // Auto height only works when cross origin properly set
        if ( $autoHeight ) {
            $($iframe).load(function () {
                $(this).height($(this).contents().find('html').height());
            });
        }

        $($iframe).recliner({
            throttle : $iframe.data('throttle'),
            threshold: $iframe.data('threshold'),
            live     : $iframe.data('live')
        });
    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-iframe.default', widgetIframe);
    });

}(jQuery, window.elementorFrontend));

/**
 * End iframe widget script
 */

