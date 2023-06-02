(function ($) {
 
    $.fn.honeycombs = function (options) {

        // Establish our default settings
        var settings = $.extend({
            combWidth: 250,
            margin: 0,
            threshold: 3,
            widthTablet: 250,
            widthMobile: 300,
        }, options);

        function initialise(element) {

            $(element).addClass('bdt-honeycombs-wrapper');
            
            var width = 0;
            var combWidth = 0;
            var combHeight = 0;
            var num = 0;
            var $wrapper = null;

            /**
             * Build the dom
             */
             function buildHtml() {
                // add the 2 other boxes
                $(element).find('.bdt-comb').wrapAll('<div class="bdt-honeycombs-inner-wrapper"></div>');
                $wrapper = $(element).find('.bdt-honeycombs-inner-wrapper');


                $(element).find('.bdt-comb').append('<div class="bdt-comb-inner-wrapper"></div>');

                $(element).find('.bdt-comb-inner-wrapper').append('<div class="bdt-inner front"></div>');
                $(element).find('.bdt-comb-inner-wrapper').append('<div class="bdt-inner back"></div>');
                $(element).find('.bdt-inner').append('<div class="bdt-wrapper"></div>');
                $(element).find('.bdt-comb-inner-wrapper').append('<span class="bdt-icon-hex-lg"></span>');


                num = 0;

                $(element).find('.bdt-comb').each(function () {
                    num = num + 1;
                    if ($(this).find('.bdt-inner').length > 0) {
                        $(this).find('.bdt-inner.front .bdt-wrapper').html($(this).find('.bdt-front-content').html());
                        $(this).find('.bdt-inner.back .bdt-wrapper').html($(this).find('.bdt-back-content').html());
                        $(this).find('.bdt-front-content').remove();
                        $(this).find('.bdt-back-content').remove();
                    } else {
                        $(this).find('.bdt-inner').remove();
                    }
                });

                // Fix Firefox padding error
                // if (navigator.userAgent.search("Firefox") > -1) {
                //     $('.bdt-comb span').addClass('firefox');
                // }
            }

            /**
             * Update all scale values
             */
             function updateScales() {
                var combWidthByDevice = '';
                if(  (window.outerWidth) > (settings.viewportLg) ){
                   combWidthByDevice = settings.combWidth;
               }else if( (window.outerWidth) > (settings.viewportMd) ){
                combWidthByDevice = settings.widthTablet;
                    // viewportLg
                }else{
                    combWidthByDevice = settings.widthMobile;
                    // viewportMd
                }

                // combWidth = settings.combWidth;
                combWidth = combWidthByDevice;
                combHeight = combWidth;
                $(element).find('.bdt-comb').width(combWidth).height(combHeight);
                $(element).find('.bdt-icon-hex-lg').css('font-size', combWidth);
            }

            /**
             * update css classes
             */
             function reorder(animate) {

                updateScales();
                width = $(element).width();

                var newWidth = $(element).parent().width();


                if (newWidth < width) {
                    width = newWidth;
                }

                $wrapper.width(newWidth);

                var maxLeft = 0;
                var row = 0; // current row
                var offset = 0; // 1 is down
                var left = 1; // pos left
                var top = 0; // pos top
                var cols = 0; 

                var noOffset = function (offset) {
                    return offset;
                };

                var withOffset = function (offset) {
                    return (offset + 1) % 2;
                };

                var halfTop = function () {
                    return (row * (0.5 * combHeight * Math.sqrt(3) + settings.margin));
                };

                var fullTop = function () {
                    return (row * (combHeight + settings.margin + combHeight * 0.1));
                };

                function orderCombs(leftHandler, topHandler) {

                    $(element).find('.bdt-comb').filter(':not(.placeholder.hide)').each(function (index) {

                        top = topHandler(top);

                        if (animate === true) {
                            $(this).stop(true, false);
                            $(this).animate({'left': left, 'top': top});
                        } else {
                            $(this).css('left', left).css('top', top);
                        }

                        left = left + (combWidth + settings.margin);

                        if (left > maxLeft) {
                            maxLeft = left;
                        }


                        if (row === 0) {
                            cols = cols + 1;
                        }

                        if (left + combWidth > width) {
                            row = row + 1;
                            offset = leftHandler(offset);
                            left = offset / 2 * (combWidth + settings.margin);
                        }

                    });
                }


                if (newWidth < 1.5 * (combWidth + settings.margin)) {
                    $('.bdt-comb.placeholder').addClass('hide');
                    orderCombs(noOffset, fullTop);
                } else if (newWidth < settings.threshold * (combWidth + settings.margin)) {
                    $('.bdt-comb.placeholder').addClass('hide');
                    orderCombs(withOffset, halfTop);
                } else {
                    $('.bdt-comb.placeholder').removeClass('hide');
                    orderCombs(withOffset, halfTop);
                }


                $wrapper
                .height(top + combHeight)
                .width(maxLeft - settings.margin)
            }

            $(window).resize(function () {
                reorder(true);
            });

            buildHtml();
            reorder(false);
        }

        return this.each(function () {
            initialise(this);
        });

    };

}(jQuery)); 