"use strict";

// ---------------------- //
// --- Document Ready --- //
// ---------------------- //
jQuery(document).ready(function () {

    // aside dropdown
    function asideDropdown() {
        var dropdown = jQuery('.helpo_aside-dropdown');

        if (!dropdown.length) return;

        var trigger = jQuery('.helpo_dropdown-trigger');
        var	close = jQuery('.helpo_aside-dropdown__close');
        var introLink = jQuery('.helpo_aside-dropdown .main-menu__link--scroll');

        trigger.on('click', function(){
            dropdown.addClass('helpo_aside-dropdown--active');
        });

        close.on('click', function(){
            dropdown.removeClass('helpo_aside-dropdown--active');
        });

        introLink.on('click', function(){
            dropdown.removeClass('helpo_aside-dropdown--active');
        });

        jQuery(document).on('click', function(event) {
            if (jQuery(event.target).closest('.helpo_dropdown-trigger, .helpo_aside-dropdown__inner').length) return;
            dropdown.removeClass('helpo_aside-dropdown--active');
            event.stopPropagation();
        });
    }

    asideDropdown();

    // Background Image CSS From JS
    if (jQuery('.helpo_js_bg_image').length) {
        jQuery('.helpo_js_bg_image').each(function(){
            jQuery(this).css('background-image', 'url('+jQuery(this).attr('data-background')+')');
        });
    }

    // Background Color CSS From JS
    if (jQuery('.helpo_js_bg_color').length) {
        jQuery('.helpo_js_bg_color').each(function(){
            jQuery(this).css('background-color', jQuery(this).attr('data-bg-color'));
        });
    }

    // Min Height CSS From JS
    if (jQuery('.helpo_js_min_height').length) {
        jQuery('.helpo_js_min_height').each(function(){
            jQuery(this).css('min-height', jQuery(this).attr('data-min-height')+'px');
        });
    }

    jQuery('.helpo_main_donate_popup_trigger').on('click', function () {
        jQuery('.helpo_main_donation_popup').addClass('active');
        jQuery('.helpo_close_main_donation_popup_layer').addClass('active');

        setTimeout(function () {
            jQuery('.helpo_close_main_donation_popup_layer').addClass('visible');
            jQuery('.helpo_main_donation_popup').addClass('visible');
        }, 100);
    });

    jQuery('.helpo_close_main_donation_popup_layer').on('click', function () {
        jQuery(this).removeClass('visible');
        jQuery('.helpo_main_donation_popup').removeClass('visible');

        setTimeout(function () {
            jQuery('.helpo_close_main_donation_popup_layer').removeClass('active');
            jQuery('.helpo_main_donation_popup').removeClass('active');
        }, 500);
    });

    jQuery('.elementor-widget-alert.helpo_view_type_1 .elementor-alert-success, .elementor-widget-alert.helpo_view_type_2 .elementor-alert-success').each(function () {
        jQuery(this).prepend('<div class="helpo_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 488.878 488.878" id="check" xmlns="http://www.w3.org/2000/svg"><path d="M143.294 340.058l-92.457-92.456L0 298.439l122.009 122.008.14-.141 22.274 22.274L488.878 98.123l-51.823-51.825z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.helpo_view_type_1 .elementor-alert-info, .elementor-widget-alert.helpo_view_type_2 .elementor-alert-info').each(function () {
        jQuery(this).prepend('<div class="helpo_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 489.418 489.418" id="warning" xmlns="http://www.w3.org/2000/svg"><path d="M244.709 389.496c18.736 0 34.332-14.355 35.91-33.026l24.359-290.927a60.493 60.493 0 00-15.756-46.011C277.783 7.09 261.629 0 244.709 0s-33.074 7.09-44.514 19.532a60.485 60.485 0 00-15.755 46.011l24.359 290.927c1.578 18.671 17.174 33.026 35.91 33.026zm0 21.412c-21.684 0-39.256 17.571-39.256 39.256 0 21.683 17.572 39.254 39.256 39.254s39.256-17.571 39.256-39.254c0-21.685-17.572-39.256-39.256-39.256z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.helpo_view_type_1 .elementor-alert-warning, .elementor-widget-alert.helpo_view_type_2 .elementor-alert-warning').each(function () {
        jQuery(this).prepend('<div class="helpo_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 31.357 31.357" id="question" xmlns="http://www.w3.org/2000/svg"><path d="M15.255 0c5.424 0 10.764 2.498 10.764 8.473 0 5.51-6.314 7.629-7.67 9.62-1.018 1.481-.678 3.562-3.475 3.562-1.822 0-2.712-1.482-2.712-2.838 0-5.046 7.414-6.188 7.414-10.343 0-2.287-1.522-3.643-4.066-3.643-5.424 0-3.306 5.592-7.414 5.592-1.483 0-2.756-.89-2.756-2.584C5.339 3.683 10.084 0 15.255 0zm-.211 24.406a3.492 3.492 0 013.475 3.476 3.49 3.49 0 01-3.475 3.476 3.49 3.49 0 01-3.476-3.476 3.491 3.491 0 013.476-3.476z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.helpo_view_type_1 .elementor-alert-danger, .elementor-widget-alert.helpo_view_type_2 .elementor-alert-danger').each(function () {
        jQuery(this).prepend('<div class="helpo_alert_icon"><svg class="icon">\n' +
            '        <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>\n' +
            '    </svg></div>'
        );
    });

    jQuery('.elementor-widget-alert.helpo_view_type_1 .elementor-alert-dismiss, .elementor-widget-alert.helpo_view_type_2 .elementor-alert-dismiss').each(function () {
        jQuery(this).html('<svg class="icon">\n' +
            '        <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>\n' +
            '    </svg>'
        );
    });
});

// ------------------- //
// --- Window Load --- //
// ------------------- //
jQuery(window).on('load', function () {
    let window_width = jQuery(window).width();

    jQuery('body').css('opacity', '1');
    setTimeout("", 100);

    if (jQuery('.helpo_single_post_donation_form_container .give-progress-bar').length) {
        let progress_bar = jQuery('.helpo_single_post_donation_form_container .give-progress-bar'),
            progress_bar_value = jQuery(progress_bar).attr('aria-valuenow');

        jQuery(progress_bar).find('span').append('<span class="helpo_progress_bar_marker">' + progress_bar_value + '%</span>');
    }

    jQuery('.helpo_mobile_menu_container .helpo_mobile_menu li.menu-item-has-children > a').on('click', function () {
        jQuery(this).parent().toggleClass('open');
        jQuery(this).parent().children('.sub-menu').stop().slideToggle(300);
    });


    if (jQuery('nav').is('#quadmenu')) {
        if (window_width < 991) {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.helpo_mobile_menu_container').prepend(quadmenu);
        }
    }

    if (jQuery('ul').is('.helpo_main-menu')) {
        if (window_width < 991) {
            let main_menu = jQuery('.helpo_main-menu').detach();

            jQuery('.helpo_mobile_menu_container').prepend(main_menu);
        }
    }

    jQuery('.helpo_main-menu .menu-item-has-children').on('click', function () {
        jQuery(this).toggleClass('open');
    });

    if (window_width < 569) {
        jQuery('#wpadminbar').css('position', 'fixed');
    }

    jQuery('.helpo_mobile_menu_container > ul > .menu-item-has-children > a').each(function () {
        jQuery(this).on('click', function (event) {
            event.preventDefault();
        });
    });

    jQuery('.widget select, .wp-block-archives-dropdown select').wrap('<div class="helpo_widget_select_wrapper"></div>');

    if (jQuery('.give-form .give-select-level').length) {
        jQuery('.give-form .give-select-level').wrap('<span class="helpo_donation_select_cont"></span>');
    }
});

// --------------------- //
// --- Window Resize --- //
// --------------------- //
jQuery(window).on('resize', function () {
    let window_width = jQuery(window).width();

    if (jQuery('nav').is('#quadmenu')) {
        if (window_width < 991) {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.helpo_mobile_menu_container').prepend(quadmenu);
        } else {
            let quadmenu = jQuery('#quadmenu').detach();

            jQuery('.helpo_header_menu_container nav').prepend(quadmenu);
        }
    }

    if (jQuery('ul').is('.helpo_main-menu')) {
        if (window_width < 991) {
            let main_menu = jQuery('.helpo_main-menu');

            jQuery('.helpo_mobile_menu_container').prepend(main_menu);
        } else {
            let main_menu = jQuery('.helpo_main-menu');

            jQuery('.helpo_header_menu_container nav').prepend(main_menu);
        }
    }
});

// --------------------- //
// --- Window Scroll --- //
// --------------------- //
jQuery(window).on('scroll', function () {
    let header = jQuery('header'),
        scroll_position = jQuery(window).scrollTop();

    if (header.is('.helpo_tagline_off')) {
        if (scroll_position > 0) {
            header.addClass('helpo_header_without_padding');
        } else {
            header.removeClass('helpo_header_without_padding');
        }
    } else {
        let tagline_height = jQuery('.helpo_top-bar').height();

        if (scroll_position >= tagline_height) {
            header.addClass('helpo_header_without_padding');
        } else {
            header.removeClass('helpo_header_without_padding');
        }
    }

    if (header.is('.helpo_transparent_header_on')) {
        if (scroll_position > 0) {
            header.addClass('helpo_transparent_header_with_color');
        } else {
            header.removeClass('helpo_transparent_header_with_color');
        }
    }
});

jQuery('a[href="#"]').on('click', function(event){
    event.preventDefault();
});

jQuery('.helpo_sidebar .widget_nav_menu ul li.menu-item-has-children a').on('click', function () {
    jQuery(this).parent().toggleClass('open');
    jQuery(this).next().slideToggle(300);
});

jQuery('.footer_widget.widget_nav_menu ul li.menu-item-has-children a').on('click', function () {
    jQuery(this).parent().toggleClass('open');
    jQuery(this).next().slideToggle(300);
});
