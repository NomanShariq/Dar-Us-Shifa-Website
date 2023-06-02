( function( $, elementor ) {

    'use strict';

    var ElementPack = {

        init: function() {

            elementor.hooks.addAction( 'frontend/element_ready/section', ElementPack.elementorSection );
        },

        elementorSection: function( $scope ) {
            var $section = $scope,
                instance = null;

            instance = new bdtWidgetTooltip($section);
            instance.init();
        }


    };

    $( window ).on( 'elementor/frontend/init', ElementPack.init );

    window.bdtWidgetTooltip = function ( $selector ) {

        var $tooltip = $selector.find('.elementor-widget.bdt-tippy-tooltip');

        this.init = function() {
            if ( ! $tooltip.length ) {
                return;
            }
            $tooltip.each( function( index ) {

                tippy( this, {
                    appendTo: this
                });
            });
        };

    };

}( jQuery, window.elementorFrontend ) );
