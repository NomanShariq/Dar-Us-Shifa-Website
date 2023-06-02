/**
 * Start advanced post tab widget script
 */

( function ($, elementor) {

    'use strict';

    var widgetAdvancedPosssstTab = {

        switchAdvancedPostTabClick: function (_this, $scope) {

            var page_id     = $(_this).data('page-id');
            var segment     = $(_this).data('segment');
            var taxonomy    = $(_this).data('taxonomy');

            var wrapperContent  = $scope.find(".bdt-advanced-post-tab-wrapper");
            var segmentClass    = '.segment-' + segment;

            if (wrapperContent.find(segmentClass).length == 0) {

                bdtUIkit.notification({
                    message: '<div bdt-spinner></div>' + $scope.find('.bdt_spinner_message').val(),
                    timeout: false
                });

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: element_pack_ajax_login_config.ajaxurl,
                    data: {
                        'action': 'element_pack_ajax_advanced_post_tab',
                        'widget_id': $scope.data('id'),
                        'page_id': page_id,
                        'taxonomy': taxonomy,
                        'segment': segment,
                        'security': $scope.find('#bdt-advanced-post-tab-sc').val()
                    },
                    success: function (response) {

                        var wrapper = $scope.find(".bdt-advanced-post-tab-wrapper");
                        if (wrapper.find(segmentClass).length) {
                            wrapper.find(segmentClass).replaceWith(response.data);
                        } else {
                            wrapper.append(response.data);
                        }

                        bdtUIkit.notification.closeAll();

                    },
                });
            }
        },
        switchAdvancedPostTabLoadMore: function (_this, $scope) {

            var page_id     = $(_this).data('page-id');
            var page_no     = $(_this).data('paged');
            var max_page_no = $(_this).data('max-paged');
            var taxonomy    = $(_this).data('taxonomy');

            bdtUIkit.notification({
                message: '<div bdt-spinner></div>' + $scope.find('.bdt_spinner_message').val(),
                timeout: false
            });

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: element_pack_ajax_login_config.ajaxurl,
                data: {
                    'action': 'element_pack_ajax_advanced_post_tab_load_more',
                    'widget_id': $scope.data('id'),
                    'page_id': page_id,
                    'paged': page_no,
                    'taxonomy': taxonomy,
                    'security': $scope.find('#bdt-advanced-post-tab-sc').val()
                },
                success: function (response) {

                    $(_this).parents('div.bdt-grid-row').find('.bdt-grid').append(response.data);

                    var maxPageNo = response.max_page_no;

                    if(page_no < max_page_no){
                        if(maxPageNo <= max_page_no){
                            $(_this).hide();
                        }else{
                            page_no = page_no + 1;
                            $(_this).data('paged', page_no);
                        }
                    }else{
                        $(_this).hide();
                    }

                    bdtUIkit.notification.closeAll();
                },
            });
        }

    }


    var widgetAdvancedPostTab = function ($scope, $) {
        $scope.find('.bdt-filter-item').on('click', 'a', function (e) {
            e.preventDefault();
            var _this = this;
            widgetAdvancedPosssstTab.switchAdvancedPostTabClick(_this, $scope);
        })

        $scope.on('click', 'a.load-more-pagination', function (e) {
            e.preventDefault();
            var _this = this;
            widgetAdvancedPosssstTab.switchAdvancedPostTabLoadMore(_this, $scope);
        })
    };


    jQuery(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/bdt-advanced-post-tab.default', widgetAdvancedPostTab);
    });

}(jQuery, window.elementorFrontend) );

/**
 * End advanced post tab widget script
 */

