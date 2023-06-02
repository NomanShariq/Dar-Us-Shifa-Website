/**
 * Start image expand widget script
 */

(function ($, elementor) {

    'use strict'; 

    var widgetImageExpand = function ($scope, $) {

        var $imageExpand = $scope.find('.bdt-image-expand'),
        $settings    = $imageExpand.data('settings');

        var wideitem = document.querySelectorAll('#' + $settings.wide_id + ' .bdt-image-expand-item');

        $(wideitem).click(function () {
            $(this).toggleClass('active');
            $('body').addClass('bdt-image-expanded');
        });

        $(document).on('click', 'body.bdt-image-expanded', function (e) {
            if ( e.target.$imageExpand == 'bdt-image-expand' || $(e.target).closest('.bdt-image-expand').length ) {
            } else {
                $('.bdt-image-expand-item').removeClass('active');
                
                $($imageExpand).find('.bdt-image-expand-item .bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);
                $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-animation-slide-bottom');
            }
        });

        if ( $settings.animation_status == 'yes' ) {

            $($imageExpand).find('.bdt-image-expand-item').each(function (i, e) {

                var self              = $(this),
                $quote            = self.find($settings.animation_of),
                mySplitText       = new SplitText($quote, {
                    type: 'chars, words, lines'
                }),
                splitTextTimeline = gsap.timeline();

                gsap.set($quote, {
                    perspective: 400 
                });

                function kill() {
                    splitTextTimeline.clear().time(0);
                    mySplitText.revert();
                }

                $(this).on('click', function () {
                    $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-animation-slide-bottom');
                    $($imageExpand).find('.bdt-image-expand-button').addClass('bdt-invisible');
                    setTimeout(function () {

                        kill();
                        mySplitText.split({
                            type: 'chars, words, lines'
                        });
                        var stringType = '';


                        if ( 'lines' == $settings.animation_on ) {
                            stringType = mySplitText.lines;
                        } else if ( 'chars' == $settings.animation_on ) {
                            stringType = mySplitText.chars;
                        } else {
                            stringType = mySplitText.words;
                        }

                        splitTextTimeline.staggerFrom(stringType, 0.5,{
                            opacity        : 0,
                            scale          : $settings.anim_scale, //0
                            y              : $settings.anim_rotation_y, //80
                            rotationX      : $settings.anim_rotation_x, //180
                            transformOrigin: $settings.anim_transform_origin, //0% 50% -50  
                        }, 0.1).then(function(){
                            $($imageExpand).find('.bdt-image-expand-button').removeClass('bdt-invisible');
                            $($imageExpand).find('.bdt-image-expand-item.active .bdt-image-expand-button').addClass('bdt-animation-slide-bottom');
                        });

                        splitTextTimeline.play();
                    }, 1000);


                });

            });

        }else{
            $($imageExpand).on('click', '.bdt-image-expand-item', function (e) {
            // $($imageExpand).find('.bdt-image-expand-item').on('click', function (e) {
                var thisInstance = $(this).attr('id'); 
                $('#'+thisInstance).siblings('.bdt-image-expand-item').find('.bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);
                $('#'+thisInstance).find('.bdt-image-expand-content *').removeClass('bdt-animation-'+$settings.default_animation_type);       
                setTimeout(function () {
                   $('#'+thisInstance+'.active').find('.bdt-image-expand-content *').addClass('bdt-animation-'+$settings.default_animation_type);
               }, 1000);
            });
        }


    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-image-expand.default', widgetImageExpand);
    });

}(jQuery, window.elementorFrontend));

/**
 * End image expand widget script
 */

