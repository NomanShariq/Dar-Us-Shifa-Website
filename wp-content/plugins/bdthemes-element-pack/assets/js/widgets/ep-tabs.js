/**
 * Start tabs widget script
 */

(function($, elementor) {
    'use strict';
    var widgetTabs = function($scope, $) {
        var $tabsArea = $scope.find('.bdt-tabs-area'),
            $tabs = $tabsArea.find('.bdt-tabs'),
            $tab = $tabs.find('.bdt-tab');
        if (!$tabsArea.length) {
            return;
        }
        var $settings = $tabs.data('settings');
        var animTime = $settings.hashScrollspyTime;
        var customOffset = $settings.hashTopOffset;
        var navStickyOffset = $settings.navStickyOffset;
        if (navStickyOffset == 'undefined') {
            navStickyOffset = 10;
        }


        function hashHandler($tabs, $tab, animTime, customOffset) {
        	// debugger;
            if (window.location.hash) {
                if ($($tabs).find('[data-title="' + window.location.hash.substring(1) + '"]').length) {
                    var hashTarget = $('[data-title="' + window.location.hash.substring(1) + '"]').closest($tabs).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - customOffset
                    }, animTime, function() {
                        //#code
                    }).promise().then(function() {
                        bdtUIkit.tab($tab).show($('[data-title="' + window.location.hash.substring(1) + '"]').data('tab-index'));
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes' && $settings.status != 'bdt-sticky-custom') {
            $(window).on('load', function() {
                hashHandler($tabs, $tab, animTime, customOffset);
            });
            $($tabs).find('.bdt-tabs-item-title').off('click').on('click', function(event) {
                window.location.hash = ($.trim($(this).attr('data-title')));
            });
            $(window).on('hashchange', function(e) {
                hashHandler($tabs, $tab, animTime, customOffset);
            });
        }
        //# code for sticky and also for sticky with hash
        function stickyHachChange($tabs, $tab, navStickyOffset) {
            if ($($tabs).find('[data-title="' + window.location.hash.substring(1) + '"]').length) {
                var hashTarget = $('[data-title="' + window.location.hash.substring(1) + '"]').closest($tabs).attr('id');
                $('html, body').animate({
                    easing: 'slow',
                    scrollTop: $('#' + hashTarget).offset().top - navStickyOffset
                }, 1000, function() {
                    //#code
                }).promise().then(function() {
                    bdtUIkit.tab($tab).show($($tab).find('[data-title="' + window.location.hash.substring(1) + '"]').data('tab-index'));
                });
            }
        }
        if ($settings.status == 'bdt-sticky-custom') {
            $($tabs).find('.bdt-tabs-item-title').bind().click('click', function(event) {
                if ($settings.activeHash == 'yes') {
                    window.location.hash = ($.trim($(this).attr('data-title')));
                } else {
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $($tabs).offset().top - navStickyOffset
                    }, 500, function() {
                        //#code
                    });
                }
            });
            // # actived Hash#
            if ($settings.activeHash == 'yes' && $settings.status == 'bdt-sticky-custom') {
                $(window).on('load', function() {
                    if (window.location.hash) {
                        stickyHachChange($tabs, $tab, navStickyOffset);
                    }
                });
                $(window).on('hashchange', function(e) {
                    stickyHachChange($tabs, $tab, navStickyOffset);
                });
            }
        }
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-tabs.default', widgetTabs);
    });
}(jQuery, window.elementorFrontend));

/**
 * End tabs widget script
 */

