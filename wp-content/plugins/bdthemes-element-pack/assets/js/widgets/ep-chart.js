/**
 * Start chart widget script
 */

( function( $, elementor ) {

	'use strict';

	var widgetChart = function( $scope, $ ) {

		var	$chart    	  = $scope.find( '.bdt-chart' ),
        $chart_canvas = $chart.find( '> canvas' ),
        settings      = $chart.data('settings'),
        suffixprefix  = $chart.data('suffixprefix');

        if ( ! $chart.length ) {
            return;
        }

        elementorFrontend.waypoint( $chart_canvas, function() {
            var $this   = $( this ),
            ctx     = $this[0].getContext('2d'),
            myChart = new Chart(ctx, settings);
                // start update
                 // s_p_status = s=suffix, p = prefix 
                 var 
                 s_p_status = (typeof suffixprefix.suffix_prefix_status !== 'undefined') ? suffixprefix.suffix_prefix_status : 'no',

                 x_prefix = (typeof suffixprefix.x_custom_prefix !== 'undefined') ? suffixprefix.x_custom_prefix : '',
                 x_suffix = (typeof suffixprefix.x_custom_suffix !== 'undefined') ? suffixprefix.x_custom_suffix : '',

                 y_suffix = (typeof suffixprefix.y_custom_suffix !== 'undefined') ? suffixprefix.y_custom_suffix : '',
                 y_prefix = (typeof suffixprefix.y_custom_prefix !== 'undefined') ? suffixprefix.y_custom_prefix : '';

                 function updateChartSetting(chart) {
                    chart.options = {
                        scales: { 
                            xAxes: [{
                                ticks: {
                                    callback: function(value, index, values) {
                                        // return '$' + value + '%';
                                        return x_prefix + value + x_suffix;
                                    }
                                }
                            }],
                            yAxes: [{
                                ticks: {
                                    callback: function(value, index, values) {
                                        return y_prefix + value + y_suffix;
                                    }
                                }
                            }],

                        }

                    };
                    chart.update();
                }
                if(s_p_status == 'yes'){
                    updateChartSetting(myChart)
                }
                // end update

            }, {
                offset: 'bottom-in-view'
            } );

    };


    jQuery(window).on('elementor/frontend/init', function() {
      elementorFrontend.hooks.addAction( 'frontend/element_ready/bdt-chart.default', widgetChart );
  });

}( jQuery, window.elementorFrontend ) );

/**
 * End chart widget script
 */

