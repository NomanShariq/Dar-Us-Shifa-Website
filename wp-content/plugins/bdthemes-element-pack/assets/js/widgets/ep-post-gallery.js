/**
 * Start post gallery widget script
 */

(function($, elementor) {
    'use strict';
    // PostGallery
    var widgetPostGallery = function($scope, $) {
        var $postGalleryWrapper = $scope.find('.bdt-post-gallery-wrapper'),
            $postFilter = $postGalleryWrapper.find('.bdt-ep-grid-filters-wrapper');
        if (!$postFilter.length) {
            return;
        }
        var $settings = $postFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler( $postFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($postFilter).find('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').closest($postFilter).attr('id');                

                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function() {
                        //#code
                    }).promise().then(function() {
                        $('[bdt-filter-control="[data-filter*=\'' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function() {
                hashHandler( $postFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($postFilter).find('.bdt-ep-grid-filter').off('click').on('click', function(event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $postFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function(e) {
                hashHandler( $postFilter, hashScrollspyTime, hashTopOffset);
            });
        }
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.default', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-abetis', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-fedara', widgetPostGallery);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-post-gallery.bdt-trosia', widgetPostGallery);
    });
}(jQuery, window.elementorFrontend));

/**
 * End post gallery widget script
 */

