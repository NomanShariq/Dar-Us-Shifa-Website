/**
 * Start notification widget script
 */

(function($, elementor) {

    'use strict';

    // Notification
    var widgetNotification = function($scope, $) {

        var $avdNotification = $scope.find('.bdt-notification-wrapper');

        if (!$avdNotification.length) {
            return;
        }

        var $settings    = $avdNotification.data('settings');
        var id           = '#' + $settings.id;
        var timeOut      = $settings.notifyTimeout;
        var notifyType   = $settings.notifyType;
        var notifyFixPos = $settings.notifyFixPosition;

        if (typeof $settings.notifyTimeout === "undefined") {
            timeOut = null;
        }

        bdtUIkit.util.on(document, 'beforehide', '[bdt-alert]', function (event) {
            if( notifyFixPos === 'top' ){
                $('.bdt-notify-wrapper').next().css({'margin-top': 'unset'});
            }
        });



        function notifyActive(){
            if(notifyType === 'fixed' ){
                $('.bdt-notify-wrapper').next().css({'margin-top': 'unset'});
                if(notifyFixPos !== 'relative'){

                    $('body > ' + id).slice(1).remove();
                    $(id).prependTo($("body")).removeClass('bdt-hidden');

                    $(document).ready(function(){
                        var notifyHeight = $('.bdt-notify-wrapper').outerHeight();
                        if( notifyFixPos == 'top' ){
                            $('.bdt-notify-wrapper').next().css({'margin-top': notifyHeight});
                        }

                        $(window).on('resize', function(){
                            notifyHeight = $('.bdt-notify-wrapper').outerHeight();
                            if( notifyFixPos == 'top' ){
                                $('.bdt-notify-wrapper').next().css({'margin-top': notifyHeight});
                            }
                        });

                    });

                } else {
                    $('body > ' +id).remove();
                    $(id).removeClass('bdt-hidden');
                }
            }else{
                bdtUIkit.notification(this, {
                    message: $settings.msg,
                    status: $settings.notifyStatus,
                    pos: $settings.notifyPosition,
                    timeout: timeOut
                });
            }
        }

        if( $settings.notifyEvent == 'onload' ||  $settings.notifyEvent == 'inDelay'){
            $(document).ready(function(){
                setTimeout(function(){
                    notifyActive();
                }, $settings.notifyInDelay);

            });

        } else if( $settings.notifyEvent == 'click' || $settings.notifyEvent == 'mouseover' ){
            $($settings.notifySelector).on($settings.notifyEvent, function(){
                notifyActive();
            });
        } else{

        }
    };

    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-notification.default', widgetNotification);
    });

}(jQuery, window.elementorFrontend));

/**
 * End notification widget script
 */

