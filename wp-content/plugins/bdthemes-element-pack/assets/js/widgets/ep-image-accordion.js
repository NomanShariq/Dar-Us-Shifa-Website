/**
 * Start image accordion widget script
 */

(function($, elementor) {

    'use strict';

    var widgetImageAccordion = function($scope, $) {

        var $imageAccordion = $scope.find('.bdt-image-accordion'),
        $settings = $imageAccordion.data('settings');

        // var accordionItem = document.querySelectorAll('#' + $settings.tabs_id + ' .bdt-image-accordion-item');
        var accordionItem = $($imageAccordion).find('.bdt-image-accordion-item');

        $(accordionItem).on($settings.mouse_event, function() {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
 
            // console.log(this);

        });
        
        $("body").on($settings.mouse_event, function(e) {
            if (e.target.$imageAccordion == "bdt-image-accordion" || $(e.target).closest(".bdt-image-accordion").length) {
            }else{
              $('.bdt-image-accordion-item').removeClass('active');
            }
        });

    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-image-accordion.default', widgetImageAccordion);
    });

}(jQuery, window.elementorFrontend));

/**
 * End image accordion widget script
 */

