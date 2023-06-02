/**
 * Start woocommerce widget script
 */

(function($, elementor) { 
    'use strict';
    var widgetWCCarousel = function($scope, $) {
        var $wcCarousel = $scope.find('.bdt-wc-carousel');
        if (!$wcCarousel.length) {
            return;
        }
        var $wcCarouselContainer = $wcCarousel.find('.swiper-container'),
        $settings = $wcCarousel.data('settings');
        var swiper = new Swiper($wcCarouselContainer, $settings);
        if ($settings.pauseOnHover) {
            $($wcCarouselContainer).hover(function() {
                (this).swiper.autoplay.stop();
            }, function() {
                (this).swiper.autoplay.start();
            });
        }
    };
    var widgetWCProductTable = function($scope, $) { 
        var $productTable = $scope.find('.bdt-wc-products-skin-table'),
        $settings = $productTable.data('settings'),
        $table = $productTable.find('> table');
        if (!$productTable.length) {
            return;
        }
        $settings.language = window.ElementPackConfig.data_table.language;

        if( $settings.hideHeader == 'yes'){
           $($table).DataTable({
            cache          : false,
            order          : [],
            paging         : $settings.paging,
            info           : $settings.info,
            bLengthChange  : $settings.bLengthChange,
            searching      : $settings.searching,
            ordering       : $settings.ordering,
            pageLength     : $settings.pageLength,
            drawCallback   : function( settings ) {
                $( $table).find("thead").remove(); } , 
            });
           return;
       }
       if( $settings.orderColumn != 'default' && $('.bdt-wc-product').find('.bdt-'+$settings.orderColumn).length > 0 && $settings.hideHeader != 'yes'){
        var orderColumn = $('.bdt-wc-product .bdt-'+$settings.orderColumn);
        orderColumn = $(orderColumn).index(this);
        $($table).DataTable({
            cache          : false,
            paging         : $settings.paging,
            info           : $settings.info,
            bLengthChange  : $settings.bLengthChange,
            searching      : $settings.searching,
            ordering       : $settings.ordering,
            pageLength     : $settings.pageLength,
            order          : [[ orderColumn, $settings.orderColumnQry ]],
        });
    }else{
       $($table).DataTable({
        cache         : false,
        order         : [],
        paging        : $settings.paging,
        info          : $settings.info,
        bLengthChange : $settings.bLengthChange,
        searching     : $settings.searching,
        ordering      : $settings.ordering,
        pageLength    : $settings.pageLength,
        
    });
   }



};
    // Quickviews
    var widgetProductQuickView = {
        loadQuickViewHtml: function(_this, $scope) {
            var product_id = $(_this).data('id');
            bdtUIkit.notification({
                message: '<div bdt-spinner></div>' + $scope.find('.bdt_modal_spinner_message').val(),
                timeout: false
            });
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: element_pack_ajax_login_config.ajaxurl,
                data: {
                    'action': 'element_pack_wc_product_quick_view_content',
                    'product_id': product_id,
                    'security': $scope.find('#bdt-wc-product-modal-sc').val()
                },
                success: function(response) {
                    bdtUIkit.modal(response.data).show();
                    bdtUIkit.notification.closeAll();

                    var form_variation = jQuery('.bdt-product-quick-view').find('.variations_form');
                    form_variation.each(function () {
                        jQuery(this).wc_variation_form();
                    });
                }
            });
        }
    };

    var widgetWCQuickViewTrigger = function($scope, $) {
        $scope.on('click', '.bdt-quick-view a', function(e) {
            e.preventDefault();
            widgetProductQuickView.loadQuickViewHtml(this, $scope);
        });
    };
    var widgetWCHashFilter = function($scope, $) {
        var $productWrapper = $scope.find('.bdt-wc-products'),
        $productFilter = $productWrapper.find('.bdt-ep-grid-filters-wrapper');
        if (!$productFilter.length) {
            return;
        }
        var $settings = $productFilter.data('hash-settings');
        var activeHash = $settings.activeHash;
        var hashTopOffset = $settings.hashTopOffset;
        var hashScrollspyTime = $settings.hashScrollspyTime;

        function hashHandler($productFilter, hashScrollspyTime, hashTopOffset) {
            if (window.location.hash) {
                if ($($productFilter).find('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').length) {
                    var hashTarget = $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').closest($productFilter).attr('id');
                    $('html, body').animate({
                        easing: 'slow',
                        scrollTop: $('#' + hashTarget).offset().top - hashTopOffset
                    }, hashScrollspyTime, function() {
                        //#code
                    }).promise().then(function() {
                        $('[bdt-filter-control="[data-filter*=\'bdtf-' + window.location.hash.substring(1) + '\']"]').trigger("click");
                    });
                }
            }
        }
        if ($settings.activeHash == 'yes') {
            $(window).on('load', function() {
                hashHandler($productFilter, hashScrollspyTime = 1500, hashTopOffset);
            });
            $($productFilter).find('.bdt-ep-grid-filter').off('click').on('click', function(event) {
                window.location.hash = ($.trim($(this).context.innerText.toLowerCase())).replace(/\s+/g, '-');
                // hashHandler( $productFilter, hashScrollspyTime, hashTopOffset);
            });
            $(window).on('hashchange', function(e) {
                hashHandler($productFilter, hashScrollspyTime, hashTopOffset);
            });
        }
    };
    jQuery(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.default', widgetWCCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.wc-carousel-hidie', widgetWCCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.bdt-table', widgetWCProductTable);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.default', widgetWCQuickViewTrigger);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.default', widgetWCHashFilter);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-carousel.default', widgetWCQuickViewTrigger);
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-wc-products.bdt-table', widgetWCQuickViewTrigger);
    });
}(jQuery, window.elementorFrontend));

/**
 * End woocommerce widget script
 */

