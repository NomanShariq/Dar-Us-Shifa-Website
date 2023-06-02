/**
 * Start time zone widget script
 */

(function($, elementor) {
    'use strict';
    // TimeZone
    var widgetTimeZone = function($scope, $) {
        var $TimeZone = $scope.find('.bdt-time-zone');
        var $TimeZoneTimer = $scope.find('.bdt-time-zone-timer');
        if (!$TimeZone.length) {
            return;
        }
        elementorFrontend.waypoint($TimeZoneTimer, function() {
            //  start for timeZone
            var $this = $(this);
            var $settings = $this.data('settings');
            var timeFormat;
            if ($settings.timeHour == '12h') {
                timeFormat = '%I:%M:%S %p';
            } else {
                timeFormat = '%H:%M:%S';
            }
            // dateFormat
            var dateFormat = $settings.dateFormat;
            if (dateFormat != 'emptyDate') {
                dateFormat = '<div class=\"bdt-time-zone-date\"> ' + $settings.dateFormat + ' </div>'
            } else {
                dateFormat = '';
            }
            var country;
            if ($settings.country != 'emptyCountry') {
                country = '<div  class=\"bdt-time-zone-country\">' + $settings.country + '</div>';
            } else {
                country = ' ';
            }
            var timeZoneFormat;
            // timeZoneFormat = '<div class=\"bdt-time-zone-dt\"><div  class=\"bdt-time-zone-country\">Bangladesh</div> <div class=\"bdt-time-zone-date\">%A, %d %B </div> <div class=\"bdt-time-zone-time\">%H:%M:%S </div> </div>';
            timeZoneFormat = '<div class=\"bdt-time-zone-dt\"> ' + country + ' ' + dateFormat + ' <div class=\"bdt-time-zone-time\">' + timeFormat + ' </div> </div>';
            // if ($('#' + $settings.id).length > 0) { $('#' + $settings.id).remove(); }
            var offset = $settings.gmt;
            if (offset == '') return;
            var options = {
                // format:'<span class=\"dt\">%A, %d %B %I:%M:%S %P</span>',
                //    format:'<span class=\"dt\">  %I:%M:%S </span>',
                format: timeZoneFormat,
                timeNotation: $settings.timeHour, //'24h',
                am_pm: true,
                utc: true,
                utc_offset: offset
            }
            $('#' + $settings.id).jclock(options);
            //  end for timeZone
        }, {
            offset: 'bottom-in-view'
        });
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-time-zone.default', widgetTimeZone);
    });
}(jQuery, window.elementorFrontend));

/**
 * End time zone widget script
 */

