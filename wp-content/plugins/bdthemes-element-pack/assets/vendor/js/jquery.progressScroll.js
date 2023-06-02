/*
 * December 2014
 * progressScroll 1.0.0
 * @author Mario Vidov
 * @url http://vidov.it
 * @twitter MarioVidov
 * GPL license
 */
jQuery(function($) {
    $.fn.progressScroll = function(options) {
        var settings = $.extend({
            borderSize: 10,
            mainBgColor: '#E6F4F7',
            lightBorderColor: '#A2ECFB',
            darkBorderColor: '#39B4CC'
        }, options);
        var colorBg = options['0'];  //'red'
        var progressColor =  options['1']; //'green';

        var innerHeight, offsetHeight, netHeight,
            self = this,
            container = this.selector,
            borderContainer = 'bdt-reading-progress-border',
            circleContainer = 'bdt-reading-progress-circle',
            textContainer = 'bdt-reading-progress-text';
        this.getHeight = function() {
            innerHeight = window.innerHeight;
            offsetHeight = document.body.offsetHeight;
            netHeight = offsetHeight - innerHeight;
        };
        this.addEvent = function() {
            var e = document.createEvent('Event');
            e.initEvent('scroll', false, false);
            window.dispatchEvent(e);
        };
        this.updateProgress = function(percnt) {
            var per = Math.round(100 * percnt);
            var deg = per * 360 / 100;
            if (deg <= 180) {
                $('.' + borderContainer, container).css('background-image', 'linear-gradient(' + (90 + deg) + 'deg, transparent 50%, '+colorBg+' 50%),linear-gradient(90deg, '+colorBg+' 50%, transparent 50%)');
            } else {
                $('.' + borderContainer, container).css('background-image', 'linear-gradient(' + (deg - 90) + 'deg, transparent 50%, '+progressColor+' 50%),linear-gradient(90deg, '+colorBg+' 50%, transparent 50%)');
            }
            $('.' + textContainer, container).text(per + '%');
        };
        this.prepare = function() {
            //$(container).addClass("bdt-reading-progress");
            $(container).html("<div class='" + borderContainer + "'><div class='" + circleContainer + "'><span class='" + textContainer + "'></span></div></div>");

            $('.' + borderContainer, container).css({
                'background-color': progressColor,
                'background-image': 'linear-gradient(91deg, transparent 50%,' + settings.lightBorderColor + '50%), linear-gradient(90deg,' + settings.lightBorderColor + '50%, transparent 50%'
            });
            $('.' + circleContainer, container).css({
                'width': settings.width - settings.borderSize,
                'height': settings.height - settings.borderSize
            });

        };
        this.init = function() {
            self.prepare();
            $(window).on('scroll', function() {
                var getOffset = window.pageYOffset || document.documentElement.scrollTop,
                    per = Math.max(0, Math.min(1, getOffset / netHeight));
                self.updateProgress(per);
            });
            $(window).on('resize', function() {
                self.getHeight();
                self.addEvent();
            });
            $(window).on('load', function() {
                self.getHeight();
                self.addEvent();
            });
        };
        self.init();
    };
});

