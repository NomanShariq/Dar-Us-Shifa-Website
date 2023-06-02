<?php
/*
 * Created by Artureanec
*/

global $helpo_custom_css;

// ------######################------ //
// ------### Color Scheme 1 ###------ //
// ------######################------ //
if (helpo_get_theme_mod('hepho_color_scheme') == 'color') {
    // ------------------------ //
    // ------ Side Panel ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        .helpo_aside-dropdown__inner {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_bg')) . ';
        }
        
        .helpo_aside-dropdown__close {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_close_color')) . ';
        }
        
        .helpo_aside-dropdown__close:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_close_hover')) . ';
        }
    
        .helpo_aside-menu li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('side_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('side_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('side_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('side_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('side_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('side_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_menu_color')) . ';
        }
        
        .helpo_aside-menu li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_menu_hover')) . ';
        }
        
        .helpo_aside-inner__link {
            font-family: ' . esc_attr(helpo_get_theme_mod('tagline_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('tagline_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('tagline_font_wight')) . ';
            text-transform: ' . (helpo_get_theme_mod('tagline_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('tagline_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_info_color')) . ';
        }
        
        .helpo_aside-inner__link:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_info_hover')) . ';
        }
        
        .helpo_aside-socials li a {
            font-size: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_size')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_color')) . ';
        }
        
        .helpo_aside-socials li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_hover')) . ';
        }
        
        .helpo_button,
        body .wp-block-button__link {
            color: ' . esc_attr(helpo_get_theme_mod('button_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_bg_color')) . ';
        }
        
        .wp-block-button {
            color: ' . esc_attr(helpo_get_theme_mod('button_color')) . ';
        }
        
        .helpo_button:hover,
        body .wp-block-button__link:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover')) . ';
        }
        
        .helpo_button--primary,
        .is-style-outline .wp-block-button__link {
            border-color: ' . esc_attr(helpo_get_theme_mod('button_bg_color')) . ';
        }
        
        .helpo_button--primary:hover {
            border-color: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover')) . ';
        }
        
        a.helpo_button--filled {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_color')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg')) . ';
        }
        
        a.helpo_button--filled:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_hover')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_hover')) . ';
        }
        
        .helpo_button--squared {
            font-family: ' . esc_attr(helpo_get_theme_mod('donate_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('donate_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('donate_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('donate_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('donate_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('donate_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('button_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_bg_color')) . ';
        }
        
        .helpo_button--squared:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover')) . ';
        }
        
        .helpo_aside-inner__title {
            color: #9e9e9e;
        }
    ';

    // ---------------------- //
    // ------ Tag Line ------ //
    // ---------------------- //
    $helpo_custom_css .= '
        .helpo_top-bar {
            background: ' . esc_attr(helpo_get_theme_mod('tadline_bg')) . ';
        }
        
        .helpo_top-bar a {
            font-family: ' . esc_attr(helpo_get_theme_mod('tagline_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('tagline_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('tagline_font_wight')) . ';
            text-transform: ' . (helpo_get_theme_mod('tagline_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('tagline_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_color')) . ';
        }
        
        .helpo_top-bar a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_hover')) . ';
        }
        
        .helpo_top-bar .helpo_header_socials li a {
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_socials_font_size')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_color')) . ';
        }
        
        .helpo_top-bar .helpo_header_socials li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_hover')) . ';
        }
    ';

    // -------------------- //
    // ------ Header ------ //
    // -------------------- //
    $helpo_custom_css.= '
        header.helpo_header,
        header.helpo_header.helpo_transparent_header_on.helpo_transparent_header_with_color {
            background: ' . esc_attr(helpo_get_theme_mod('header_bg')) . ';
        }
    
        .helpo_dropdown-trigger__item,
        .helpo_dropdown-trigger__item:after,
        .helpo_dropdown-trigger__item:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item:before {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_trigger_color')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_trigger_hover')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        .helpo_main-menu > li > a,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li > a,
        .quadmenu-navbar-nav > li > a,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li > a,
        .helpo_mobile_menu_container ul.helpo_mobile_menu > li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('header_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('header_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('header_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('header_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('header_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('header_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('header_menu_color')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_main-menu > li > a,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li > a {
            color: #ffffff;
        }
        
        .helpo_main-menu > li.menu-item-has-children > a:before,
        .helpo_main-menu > li.menu-item-has-children > a:after,
        .helpo_mobile_menu_container .helpo_mobile_menu > li.menu-item-has-children > a:before,
        .helpo_mobile_menu_container .helpo_mobile_menu > li.menu-item-has-children > a:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li.menu-item-has-children > a:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li.menu-item-has-children > a:after,
        .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after {
            background: ' . esc_attr(helpo_get_theme_mod('header_menu_color')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_main-menu > li.menu-item-has-children > a:before,
        header.helpo_transparent_header_on .helpo_main-menu > li.menu-item-has-children > a:after,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after {
            background: #ffffff;
        }
        
        .helpo_main-menu > li > a:hover,
        .quadmenu-navbar-nav > li > a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('header_menu_hover')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu {
            background: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_bg')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu:before,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu:before {
            border-top-color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_bg')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu > li > a,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a,
        .helpo_mobile_menu_container ul.helpo_mobile_menu > li .sub-menu li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('header_sub_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('header_sub_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_color')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu > li > a:hover,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_hover')) . ';
        }
        
        .helpo_main-menu > li:before,
        .quadmenu-navbar-nav > li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_menu_marker')) . ';
        }
        
        
        .helpo_main-menu > li ul.sub-menu > li > a::after,
        .helpo_mobile_menu > li ul.sub-menu > li > a::after,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:after {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        
    ';

    // ------------------ //
    // ------ Logo ------ //
    // ------------------ //
    $helpo_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(helpo_get_theme_mod('logo_image')));
    $helpo_logo_width = (isset($helpo_logo_metadata['width']) ? $helpo_logo_metadata['width'] : '270');
    $helpo_logo_height = (isset($helpo_logo_metadata['height']) ? $helpo_logo_metadata['height'] : '88');


    $helpo_custom_css .= '
        .helpo_header-logo__link,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color  .helpo_header-logo__link {
            width: ' . absint($helpo_logo_width) . 'px;
            height: ' . absint($helpo_logo_height) . 'px;
            background: url("' . esc_url(helpo_get_theme_mod('logo_image')) . '") 0 0 no-repeat transparent;
            background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
        }
        
        header.helpo_transparent_header_on .helpo_header-logo__link {
            background: url("' . esc_url(helpo_get_theme_mod('logo_transparent_image')) . '") 0 0 no-repeat transparent;
            width: ' . absint($helpo_logo_width) . 'px;
            height: ' . absint($helpo_logo_height) . 'px;
            background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
        }
    ';

    if (helpo_get_theme_mod('logo_retina') == true) {
        $helpo_logo_width = $helpo_logo_width / 2;
        $helpo_logo_height = $helpo_logo_height / 2;

        $helpo_custom_css .= '
            .helpo_header-logo__link.helpo_retina_logo,
            header.helpo_transparent_header_on .helpo_header-logo__link.helpo_retina_logo,
            header.helpo_transparent_header_on.helpo_transparent_header_with_color  .helpo_header-logo__link.helpo_retina_logo {
                width: ' . absint($helpo_logo_width) . 'px;
                height: ' . absint($helpo_logo_height) . 'px;
                background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
            }
        ';
    }

    // ------------------------ //
    // ------ Typography ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        body {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('main_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('main_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('main_font_weight')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color')) . ';
        }
        
        body .helpo_content_wrapper .elementor-widget-text-editor {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        .helpo_button,
        .wp-block-button__link {
            font-family: ' . esc_attr(helpo_get_theme_mod('buttons_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('buttons_font_size')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('buttons_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('buttons_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('buttons_italic') == true ? 'italic' : 'normal') . ';
        }
        
        h1, h2, h3, h4, h5, h6,
        body .elementor-widget-heading .elementor-heading-title {
            font-family: ' . esc_attr(helpo_get_theme_mod('headings_font_family')) . ', sans-serif;
            font-weight: ' . esc_attr(helpo_get_theme_mod('headings_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('headings_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('headings_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('headings_color')) . ';
        }
        
        .helpo_price_item .helpo_price_container .helpo_currency, 
        .helpo_price_item .helpo_price_container .helpo_price, 
        .helpo_price_item .helpo_price_container .helpo_period {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color')) . ';
        }
        
        h1,
        body .elementor-widget-heading h1.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h1_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h1_line_height')) . ';
        }
        
        h2,
        body .elementor-widget-heading h2.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h2_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h2_line_height')) . ';
        }
        
        h3,
        body .elementor-widget-heading h3.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h3_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h3_line_height')) . ';
        }
        
        h4,
        body .elementor-widget-heading h4.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h4_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h4_line_height')) . ';
        }
        
        h5,
        body .elementor-widget-heading h5.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h5_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h5_line_height')) . ';
        }
        
        h6,
        body .elementor-widget-heading h6.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h6_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h6_line_height')) . ';
        }
    ';

    // -------------------- //
    // ------ Footer ------ //
    // -------------------- //
    $helpo_custom_css .= '
        .helpo_bottom-background {
            background: ' . esc_attr(helpo_get_theme_mod('bottom_image_bg')) . ';
        }
        
        .helpo_prefooter_container {
            background: ' . esc_attr(helpo_get_theme_mod('prefooter_bg')) . ';
        }
        
        .footer_widget {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('main_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('main_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('main_font_weight')) . ';
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_color')) . ';
        }
        
        .footer_widget a {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_color')) . ';
        }
        
        .footer_widget a:hover {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_hover')) . ';
        }
        
        .helpo_footer-socials a {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_socials')) . ';
        }
        
        .helpo_footer-socials a:hover {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_socials_hover')) . ';
        }
        
        .footer_widget a.helpo_button--filled {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_color')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg')) . ';
        }
        
        .footer_widget a.helpo_button--filled:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_hover')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_hover')) . ';
        }
        
        .helpo_footer_widget_title {
            color: ' . esc_attr(helpo_get_theme_mod('prefooter_widget_title_color')) . ';
        }
        
        .footer_widget.widget_nav_menu ul.menu li a:after,
        .footer_widget.widget_recent_comments ul li:before,
        .helpo_sidebar .widget.widget_recent_comments ul li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        footer.helpo_footer {
            color: ' . esc_attr(helpo_get_theme_mod('footer_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('footer_bg')) . ';
        }
        
        footer.helpo_footer a {
            color: ' . esc_attr(helpo_get_theme_mod('footer_color')) . ';
        }
        
        footer.helpo_footer a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('footer_hover')) . ';
        }
    ';

    // ------------------------ //
    // ------ Page Title ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        .helpo_page_title_container {
            min-height: ' . absint(helpo_get_theme_mod('title_height')) . 'px;
            background-color: ' . esc_attr(helpo_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(helpo_get_theme_mod('post_title_bg')) .'");
        }
        
        .helpo_site_title_container {
            color: ' . esc_attr(helpo_get_theme_mod('site_title_color')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('site_title_font_family')) . ', cursive;
            font-size: ' . esc_attr(helpo_get_theme_mod('site_title_font_size')) . ';
        }
        
        .helpo_page_title {
            color: ' . esc_attr(helpo_get_theme_mod('page_title_color')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('page_title_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('page_title_font_size')) . ';
        }
        
        .helpo_page_subtitle {
            color: ' . esc_attr(helpo_get_theme_mod('page_subtitle_color')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_size')) . ';
        }
        
        .helpo_page_title:before {
            background: ' . esc_attr(helpo_get_theme_mod('title_divider_color_1')) . ';
        }
        
        .helpo_page_title:after {
            background: ' . esc_attr(helpo_get_theme_mod('title_divider_color_2')) . ';
        }
        
        body .helpo_additional_font .elementor-text-editor {
            font-family: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_family')) . ', sans-serif;
        }
    ';

    // ------------------------- //
    // ------ Single Post ------ //
    // ------------------------- //
    $helpo_custom_css .= '
        .helpo_post_details_tag_cont ul li:hover,
        .helpo_post_details_tag_cont ul li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_blog-post__socials a {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('post_socials_bg')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('post_socials_border_color')) . ';
        }
        
        .helpo_blog-post__socials a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_hover')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('post_socials_bg_hover')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('post_socials_border_hover')) . ';
        }
        
        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"],
        input[type="datetime"],
        input[type="url"],
        textarea,
        .form__field,
        body #give_checkout_user_info p input,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="text"],
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="email"],
        .wp-block-search input[type="search"],
        input[type="password"],
        .comment-form-cookies-consent input[type="checkbox"]:checked + label:before,
        .comment-form-cookies-consent input[type="checkbox"]:not(:checked) + label:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:checked + span:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:not(:checked) + span:before,
        .helpo_sidebar .widget_product_search input[type="search"] {
            color: ' . esc_attr(helpo_get_theme_mod('form_field_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_field_border')) . ';
        }
        
        body form[id*=give-form] .give-donation-amount #give-amount-text, 
        body form[id*=give-form] .give-donation-amount .give-text-input {
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg')) . ';
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus,
        input[type="time"]:focus,
        input[type="datetime"]:focus,
        input[type="url"]:focus,
        textarea:focus,
        .form__field:focus,
        body #give_checkout_user_info p input:focus {
            background: ' . esc_attr(helpo_get_theme_mod('active_form_field_bg')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('active_form_field_border')) . ';
        }
        
        input[type="submit"],
        .wp-block-search button[type="submit"],
        #cancel-comment-reply-link,
        body .give-btn {
            color: ' . esc_attr(helpo_get_theme_mod('form_button_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_button_bg')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_button_border_color')) . ';
        }
        
        .footer_widget .mc4wp-form input[type="submit"],
        .helpo_footer_form input[type="submit"],
        .helpo_sidebar .widget_calendar td a:after,
        .footer_widget.widget_calendar td a:after,
        .wp-block-calendar td a:after {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        input[type="submit"]:hover,
        .wp-block-search button[type="submit"]:hover,
        #cancel-comment-reply-link:hover,
        .footer_widget .mc4wp-form input[type="submit"]:hover,
        body .give-btn:hover {
            color: ' . esc_attr(helpo_get_theme_mod('form_button_hover')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_button_bg_hover')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_button_border_hover')) . ';
        }
        
        .helpo_comments__item-name,
        .helpo_comments__item-action a,
        .helpo_comment_reply_cont a.comment-edit-link {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color')) . ';
        }
        
        .comment-respond .logged-in-as a {
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color')) . ';
        }
        
        .helpo_comments__item-action a:hover,
        .helpo_comment_reply_cont a.comment-edit-link:hover,
        .comment-respond .logged-in-as a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_content_paging_wrapper .page-link span,
        .helpo_content_paging_wrapper .page-link a:hover,
        .helpo_pagination span.current,
        .helpo_pagination a:hover,
        .woocommerce nav.woocommerce-pagination ul li span.current,
        .woocommerce nav.woocommerce-pagination ul li a:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
    ';

    // -------------------------- //
    // ------ Single Cause ------ //
    // -------------------------- //
    $helpo_custom_css .= '
        form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before,
        body form[id*=give-form] #give-donation-level-radio-list li input[type="radio"]:checked + label:before,
        body form[id*=give-form] #give-gateway-radio-list li input[type="radio"]:checked + label:before,
        body form[id*=give-form] .give-donation-levels-wrap li input[type="radio"]:checked + label:before,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset ul li input[type="radio"]:checked + label:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        #give-payment-mode-select .give-payment-mode-label,
        #give_purchase_form_wrap #give_checkout_user_info > legend,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset .give-payment-mode-label,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div legend,
        .helpo_single_product_page.woocommerce div.product form.cart.grouped_form table a {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color')) . ';
        }
    ';

    // ---------------------------- //
    // ------ 404 Error Page ------ //
    // ---------------------------- //
    $helpo_custom_css .= '
        .helpo_404_error_container {
            background-image: url(' . esc_url(helpo_get_theme_mod('404_bg_image')) . ');
            background-color: ' . esc_attr(helpo_get_theme_mod('404_bg_color')) . ';
        }
        
        .helpo_404_error_title {
            color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_404_home_button.helpo_button.helpo_button--primary:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
    ';

    // ----------------------------------------- //
    // ------ Helpo Widgets for Elementor ------ //
    // ----------------------------------------- //
    $helpo_custom_css .= '
        .helpo_blockquote.helpo_view_type_1:before,
        .helpo_person_socials li a:hover,
        body .helpo_content_wrapper .elementor-text-editor a:hover strong,
        body .helpo_skills_info .elementor-widget-text-editor a:hover,
        .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_testimonials_icon,
        .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_testimonials_icon,
        .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_testimonials_icon,
        .helpo_causes_slider_wrapper.helpo_view_type_2 .helpo_post_title a:hover,
        .helpo_causes_grid_wrapper .projects-masonry__title a:hover,
        .helpo_cause_item_wrapper .projects-masonry__title a:hover,
        .helpo_events_listing_wrapper .upcoming-item__details .icon,
        .helpo_person_wrapper.helpo_view_type_2 .helpo_person_socials li a:hover,
        .helpo_person_item_type_3 .helpo_person_socials li a:hover,
        .helpo_person_item_type_3 .helpo_person_socials li:nth-of-type(even) a,
        .helpo_person_wrapper.helpo_view_type_1 .helpo_person_socials li a:hover,
        .helpo_page_content_container table a:hover,
        .helpo_blog_content_container table a:hover,
        .wp-block-quote:before,
        .wp-block-pullquote:before,
        blockquote:before {
            color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_events_listing_wrapper .upcoming-item__details .icon {
            stroke: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_blockquote.helpo_view_type_2,
        .helpo_donate_box_item .helpo_button:hover,
        .helpo_price_item .helpo_price_button_container .helpo_button:hover,
        .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_featured_image_container .helpo_category_container,
        .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_donate_button_container .helpo_button:hover,
        .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_category_container,
        .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_category_container,
        body .helpo_causes_slider_widget .helpo_slider_nav_button:hover,
        body .helpo_testimonials_wrapper .helpo_slider_nav_button:hover,
        body .helpo_content_slider_wrapper .helpo_slider_nav_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_1 .helpo_donate_button_container .helpo_button:hover,
        .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_author_container:before,
        .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_author_container:before,
        .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_author_container:before,
        .helpo_content_slider_wrapper .helpo_button:hover,
        .helpo_sidebar .widget.widget_tag_cloud .tagcloud a,
        .footer_widget.widget_tag_cloud .tagcloud a,
        .wp-block-tag-cloud a,
        .helpo_causes_grid_wrapper .projects-masonry__badge,
        .helpo_cause_item_wrapper .projects-masonry__badge,
        .helpo_events_listing_wrapper .upcoming-item__date,
        .helpo_stories_wrapper .helpo_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_button:hover,
        body .elementor .mc4wp-form-fields input[type="submit"]:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_standard_blog_listing .helpo_category_container {
            background: #F36F8F;
        }
        
        body .helpo_content_wrapper .elementor-text-editor ul li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_font_color')) . ';
        }
        
        p a,
        p a:hover,
        body .helpo_content_wrapper .elementor-text-editor ol li:before,
        .helpo_info_field a {
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color')) . ';
        }
        
        body .helpo_content_wrapper .elementor-text-editor ul li,
        body .helpo_content_wrapper .elementor-text-editor ol li,
        body .elementor-widget-counter .elementor-counter-title,
        .helpo_person_position,
        body .elementor-widget-progress .elementor-title,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title,
        body .helpo_view_type_1 .elementor-alert .elementor-alert-title,
        body .helpo_view_type_2 .elementor-alert .elementor-alert-title,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-content {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        body .elementor-widget-text-editor.elementor-drop-cap-view-default .elementor-drop-cap,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title a,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title a,
        body .elementor-widget-accordion .elementor-active .elementor-accordion-icon, 
        body .elementor-widget-accordion .elementor-active a,
        body .elementor-widget-accordion .elementor-accordion-icon,
        body .elementor-widget-accordion a,
        .helpo_causes_listing_wrapper .helpo_post_title a,
        .helpo_causes_slider_wrapper .helpo_post_title a,
        .helpo_content_slider_wrapper.helpo_view_type_1 .helpo_anchor,
        .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_anchor,
        .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_anchor,
        .helpo_content_slider_wrapper .helpo_additional_info,
        .helpo_content_slider_wrapper .helpo_additional_info a,
        .helpo_standard_blog_listing .helpo_post_title a,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title,
        p.has-drop-cap:not(:focus):first-letter {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color')) . ';
        }
        
        body .elementor-widget-counter .elementor-counter-number-wrapper,
        .helpo_person_name,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title {
            font-family: ' . esc_attr(helpo_get_theme_mod('headings_font_family')) . ', sans-serif;
        }
        
        body .elementor-accordion .elementor-tab-title .elementor-accordion-icon.elementor-accordion-icon-right,
        body .elementor-accordion .elementor-tab-title .elementor-accordion-icon.elementor-accordion-icon-left,
        body .helpo_causes_slider_widget .helpo_slider_nav_button,
        body .helpo_testimonials_wrapper .helpo_slider_nav_button,
        body .helpo_content_slider_wrapper .helpo_slider_nav_button,
        body .helpo_tabs_vertical .helpo_tabs_titles_container .helpo_tab_title_item a:hover,
        body .helpo_tabs_vertical .helpo_tabs_titles_container .helpo_tab_title_item.active a {
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_tabs_titles_container .helpo_tab_title_item a:hover,
        .helpo_tabs_titles_container .helpo_tab_title_item.active a {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color')) . ';
            border-bottom-color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_causes_slider_widget .helpo_slider_nav_button,
        .helpo_testimonials_wrapper .helpo_slider_nav_button,
        .helpo_content_slider_wrapper .helpo_slider_nav_button,
        .helpo_blog_listing_widget .helpo_post_title a,
        .helpo_recent_posts_widget .helpo_post_title a,
        .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger i,
        .helpo_sidebar .recent-posts__item-link,
        .helpo_sidebar .widget.widget_categories ul li a,
        .helpo_sidebar .widget.widget_recent_entries ul li a,
        .helpo_sidebar .widget.widget_archive ul li a,
        .helpo_sidebar .widget.widget_tag_cloud .tagcloud a,
        .footer_widget.widget_tag_cloud .tagcloud a,
        .helpo_sidebar .widget.widget_search .helpo_icon_search,
        .helpo_sidebar .widget.widget_pages ul li a,
        .helpo_sidebar .widget.widget_meta ul li a,
        .helpo_sidebar .widget.widget_recent_comments ul li a,
        .helpo_sidebar .widget.widget_rss .widget_title a,
        .helpo_sidebar .widget.widget_rss ul li a,
        .helpo_sidebar .widget.widget_nav_menu ul li a,
        .helpo_sidebar .widget.widget_product_categories ul li a,
        .helpo_sidebar .widget.widget_layered_nav ul li a,
        .helpo_sidebar .widget.widget_rating_filter ul li a,
        .helpo_sidebar .widget_calendar table a,
        .helpo_sidebar .widget_calendar nav a,
        .wp-block-calendar a,
        .wp-block-archives-list li a,
        .wp-block-calendar table a,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a,
        .helpo_events_wrapper .helpo_event_title a,
        .helpo_no_result_search_form .helpo_icon_search,
        .helpo_sidebar .widget_product_search button,
        .wp-block-latest-comments .wp-block-latest-comments__comment a,
        .wp-block-latest-posts li a,
        .wp-block-rss li a,
        .page-link,
        .page-link a,
        .page-link:hover,
        .helpo_page_content_container table th,
        .helpo_blog_content_container table th,
        .helpo_page_content_container table a,
        .helpo_blog_content_container table a,
        .wp-block-calendar table th {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ';
        }
        
        .helpo_sidebar .widget_calendar td#today:after,
        .wp-block-calendar td#today:after {
            background: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ';
        }
        
        .helpo_causes_slider_widget .helpo_slider_nav_button:hover,
        .helpo_testimonials_wrapper .helpo_slider_nav_button:hover,
        .helpo_content_slider_wrapper .helpo_slider_nav_button:hover,
        .helpo_blog_listing_widget .helpo_post_title a:hover,
        .helpo_recent_posts_widget .helpo_post_title a:hover,
        .helpo_content_slider_wrapper .helpo_button:hover,
        .helpo_sidebar .recent-posts__item-link:hover,
        .helpo_sidebar .widget.widget_categories ul li a:hover,
        .helpo_sidebar .widget.widget_recent_entries ul li a:hover,
        .helpo_sidebar .widget.widget_archive ul li a:hover,
        .helpo_sidebar .widget.widget_pages ul li a:hover,
        .helpo_sidebar .widget.widget_meta ul li a:hover,
        .helpo_sidebar .widget.widget_recent_comments ul li a:hover,
        .helpo_sidebar .widget.widget_rss .widget_title a:hover,
        .helpo_sidebar .widget.widget_rss ul li a:hover,
        .helpo_sidebar .widget.widget_nav_menu ul li a:hover,
        .helpo_sidebar .widget.widget_product_categories ul li a:hover,
        .helpo_sidebar .widget.widget_layered_nav ul li a:hover,
        .helpo_sidebar .widget.widget_rating_filter ul li a:hover,
        .helpo_sidebar .widget_calendar table a:hover,
        .helpo_sidebar .widget_calendar nav a:hover,
        .wp-block-calendar a:hover,
        .helpo_events_wrapper .helpo_event_title a:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_slider_nav_button:hover,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a:hover,
        .wp-block-latest-comments .wp-block-latest-comments__comment a:hover,
        .wp-block-latest-posts li a:hover,
        .wp-block-rss li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_hover')) . ';
        }
        
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item .icon {
            stroke: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_standard_blog_listing .helpo_standard_blog_item .helpo_button:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
    ';

    // --------------------------- //
    // ------- WooCommerce ------- //
    // --------------------------- //
    $helpo_custom_css .= '
        .helpo_shop_loop select.orderby {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ';
        }
        
        .helpo_single_product_page .helpo_page_title_container {
            background-color: ' . esc_attr(helpo_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(helpo_get_theme_mod('woo_title_bg_image')) .'"); 
        }
        
        .helpo_single_product_page .star-rating span,
        .helpo_single_product_page .helpo_minus_button:hover,
        .helpo_single_product_page .helpo_plus_button:hover,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars a:hover,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars.selected a:not(.active),
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars.selected a.active,
        .woocommerce div.product span.price {
            color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_header_cart .helpo_header_cart_counter,
        .helpo_sidebar .widget.widget_product_tag_cloud .tagcloud a,
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle:before,
        .woocommerce .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce .widget_shopping_cart .buttons a:hover,
        .woocommerce.widget_shopping_cart .buttons a:hover,
        .woocommerce ul.products li.product .button,
        .woocommerce ul.products li.product .added_to_cart,
        .helpo_single_product_page.woocommerce div.product form.cart .button,
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:before,
        #ebe9eb.woocommerce #respond input#submit, 
        .woocommerce #review_form #respond .form-submit input:hover,
        .woocommerce table.shop_table tbody td.actions .button:hover,
        .woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button:hover,
        .woocommerce-checkout .checkout_coupon .button:hover,
        .woocommerce #payment #place_order:hover, 
        .woocommerce-page #payment #place_order:hover,
        .woocommerce .woocommerce-MyAccount-content button.button:hover,
        .woocommerce .woocommerce-form-login .button:hover,
        .woocommerce-MyAccount-content .edit:hover,
        .woocommerce .return-to-shop .button:hover,
        .woocommerce .woocommerce-message .button:hover,
        .woocommerce .woocommerce-Message .button:hover,
        .woocommerce div.product form.cart .reset_variations {
            background: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_sidebar .widget.widget_product_tag_cloud .tagcloud a,
        .woocommerce ul.product_list_widget li a,
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--description table td,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-reply-title,
        .woocommerce-checkout .woocommerce-info a,
        .woocommerce-MyAccount-navigation ul li a,
        .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ';
        }
        
        .woocommerce ul.product_list_widget li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_hover')) . ';
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove,
        .woocommerce.widget_shopping_cart .cart_list li a.remove {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ' !important;
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
        .woocommerce.widget_shopping_cart .cart_list li a.remove:hover {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_hover')) . ' !important;
        }
        
        .woocommerce .widget_price_filter .price_slider_amount .button,
        .woocommerce .widget_shopping_cart .buttons a,
        .woocommerce.widget_shopping_cart .buttons a,
        body.woocommerce #review_form #respond .form-submit input,
        body .woocommerce table.shop_table tbody td.actions .button,
        body .woocommerce .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-checkout .checkout_coupon .button,
        body .woocommerce #payment #place_order, 
        body.woocommerce-page #payment #place_order,
        body .woocommerce .woocommerce-MyAccount-content button.button,
        body .woocommerce .woocommerce-form-login .button,
        body .woocommerce-MyAccount-content .edit,
        body .woocommerce .return-to-shop .button,
        body .woocommerce .woocommerce-message .button,
        body .woocommerce .woocommerce-Message .button,
        body.woocommerce .woocommerce-message .button {
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color')) . ';
        }
        
        .helpo_single_product_page .product_meta span,
        .helpo_single_product_page .product_meta span a,
        .woocommerce table.shop_table thead,
        .woocommerce table.shop_table tbody td.product-name,
        .woocommerce table.shop_table tbody td.product-quantity,
        .woocommerce table.shop_table tbody td.product-name a,
        .woocommerce table.shop_table tbody td.product-price,
        .woocommerce table.shop_table tbody td.product-subtotal,
        .woocommerce table.shop_table tbody td.actions .coupon label,
        .woocommerce .cart-collaterals table.shop_table th,
        .woocommerce-page .cart-collaterals table.shop_table th,
        .woocommerce .cart-collaterals table.shop_table td,
        .woocommerce-page .cart-collaterals table.shop_table td,
        .woocommerce-checkout .woocommerce table.shop_table tbody td,
        .woocommerce-checkout .woocommerce table.shop_table tfoot th,
        .woocommerce-checkout .woocommerce table.shop_table tfoot td,
        .woocommerce div.product form.cart .variations td.label {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color')) . ';
        }
        
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews input,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews textarea {
            color: ' . esc_attr(helpo_get_theme_mod('form_field_color')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg')) . ';
        }
    ';
}

// ------######################------ //
// ------### Color Scheme 2 ###------ //
// ------######################------ //
else {
    // ------------------------ //
    // ------ Side Panel ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        .helpo_aside-dropdown__inner {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_bg_2')) . ';
        }
        
        .helpo_aside-dropdown__close {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_close_color_2')) . ';
        }
        
        .helpo_aside-dropdown__close:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_close_hover_2')) . ';
        }
    
        .helpo_aside-menu li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('side_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('side_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('side_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('side_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('side_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('side_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_menu_color_2')) . ';
        }
        
        .helpo_aside-menu li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_menu_hover_2')) . ';
        }
        
        .helpo_aside-inner__link {
            font-family: ' . esc_attr(helpo_get_theme_mod('tagline_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('tagline_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('tagline_font_wight')) . ';
            text-transform: ' . (helpo_get_theme_mod('tagline_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('tagline_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_info_color_2')) . ';
        }
        
        .helpo_aside-inner__link:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_info_hover_2')) . ';
        }
        
        .helpo_aside-socials li a {
            font-size: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_size')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_color_2')) . ';
        }
        
        .helpo_aside-socials li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('side_panel_socials_hover_2')) . ';
        }
        
        .helpo_button,
        body .wp-block-button__link {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_bg_color_2')) . ';
        }
        
        .wp-block-button {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .helpo_button:hover,
        body .wp-block-button__link:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
        }
        
        .helpo_button--primary,
        .is-style-outline .wp-block-button__link {
            border-color: ' . esc_attr(helpo_get_theme_mod('button_bg_color_2')) . ';
        }
        
        .helpo_button--primary:hover {
            border-color: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
        }
        
        a.helpo_button--filled {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_color_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_2')) . ';
        }
        
        a.helpo_button--filled:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_hover_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_hover_2')) . ';
        }
        
        .helpo_button--squared {
            font-family: ' . esc_attr(helpo_get_theme_mod('donate_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('donate_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('donate_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('donate_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('donate_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('donate_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_bg_color_2')) . ';
        }
        
        .helpo_button--squared:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
        }
        
        .helpo_aside-inner__title {
            color: #818ea9;
        }
    ';

    // ---------------------- //
    // ------ Tag Line ------ //
    // ---------------------- //
    $helpo_custom_css .= '
        .helpo_top-bar {
            background: ' . esc_attr(helpo_get_theme_mod('tadline_bg_2')) . ';
        }
        
        .helpo_top-bar a {
            font-family: ' . esc_attr(helpo_get_theme_mod('tagline_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('tagline_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('tagline_font_wight')) . ';
            text-transform: ' . (helpo_get_theme_mod('tagline_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('tagline_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_color_2')) . ';
        }
        
        .helpo_top-bar a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_hover_2')) . ';
        }
        
        .helpo_top-bar .helpo_header_socials li a {
            font-size: ' . esc_attr(helpo_get_theme_mod('tagline_socials_font_size')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_color_2')) . ';
        }
        
        .helpo_top-bar .helpo_header_socials li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('tagline_link_hover_2')) . ';
        }
    ';

    // -------------------- //
    // ------ Header ------ //
    // -------------------- //
    $helpo_custom_css.= '
        header.helpo_header,
        header.helpo_header.helpo_transparent_header_on.helpo_transparent_header_with_color {
            background: ' . esc_attr(helpo_get_theme_mod('header_bg_2')) . ';
        }
    
        .helpo_dropdown-trigger__item,
        .helpo_dropdown-trigger__item:after,
        .helpo_dropdown-trigger__item:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger__item:before {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_trigger_color_2')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on .helpo_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before {
            background: ' . esc_attr(helpo_get_theme_mod('side_panel_trigger_hover_2')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item,
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:after,
        header.helpo_transparent_header_on .helpo_dropdown-trigger:hover .helpo_dropdown-trigger__item:before {
            background: #ffffff;
        }
        
        .helpo_main-menu > li > a,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li > a,
        .quadmenu-navbar-nav > li > a,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li > a,
        .helpo_mobile_menu_container ul.helpo_mobile_menu > li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('header_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('header_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('header_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('header_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('header_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('header_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('header_menu_color_2')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_main-menu > li > a,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li > a {
            color: #ffffff;
        }
        
        .helpo_main-menu > li.menu-item-has-children > a:before,
        .helpo_main-menu > li.menu-item-has-children > a:after,
        .helpo_mobile_menu_container .helpo_mobile_menu > li.menu-item-has-children > a:before,
        .helpo_mobile_menu_container .helpo_mobile_menu > li.menu-item-has-children > a:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li.menu-item-has-children > a:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .helpo_main-menu > li.menu-item-has-children > a:after,
        .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after {
            background: ' . esc_attr(helpo_get_theme_mod('header_menu_color_2')) . ';
        }
        
        header.helpo_transparent_header_on .helpo_main-menu > li.menu-item-has-children > a:before,
        header.helpo_transparent_header_on .helpo_main-menu > li.menu-item-has-children > a:after,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:before,
        header.helpo_transparent_header_on .quadmenu-navbar-nav > li.quadmenu-item-has-children > a:after {
            background: #ffffff;
        }
        
        .helpo_main-menu > li > a:hover,
        .quadmenu-navbar-nav > li > a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('header_menu_hover_2')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu {
            background: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_bg_2')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu:before,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu:before {
            border-top-color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_bg_2')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu > li > a,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a,
        .helpo_mobile_menu_container ul.helpo_mobile_menu > li .sub-menu li a {
            font-family: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('header_sub_menu_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('header_sub_menu_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_color_2')) . ';
        }
        
        .helpo_main-menu > li ul.sub-menu > li > a:hover,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('header_sub_menu_hover_2')) . ';
        }
        
        .helpo_main-menu > li:before,
        .quadmenu-navbar-nav > li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_menu_marker_2')) . ';
        }
        
        
        .helpo_main-menu > li ul.sub-menu > li > a::after,
        .helpo_mobile_menu > li ul.sub-menu > li > a::after,
        .quadmenu-navbar-nav > li .quadmenu-dropdown-menu ul > li > a:after {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        
    ';

    // ------------------ //
    // ------ Logo ------ //
    // ------------------ //
    $helpo_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(helpo_get_theme_mod('logo_image')));
    $helpo_logo_width = (isset($helpo_logo_metadata['width']) ? $helpo_logo_metadata['width'] : '270');
    $helpo_logo_height = (isset($helpo_logo_metadata['height']) ? $helpo_logo_metadata['height'] : '88');


    $helpo_custom_css .= '
        .helpo_header-logo__link,
        header.helpo_transparent_header_on.helpo_transparent_header_with_color  .helpo_header-logo__link {
            width: ' . absint($helpo_logo_width) . 'px;
            height: ' . absint($helpo_logo_height) . 'px;
            background: url("' . esc_url(helpo_get_theme_mod('logo_image')) . '") 0 0 no-repeat transparent;
            background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
        }
        
        header.helpo_transparent_header_on .helpo_header-logo__link {
            background: url("' . esc_url(helpo_get_theme_mod('logo_transparent_image')) . '") 0 0 no-repeat transparent;
            width: ' . absint($helpo_logo_width) . 'px;
            height: ' . absint($helpo_logo_height) . 'px;
            background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
        }
    ';

    if (helpo_get_theme_mod('logo_retina') == true) {
        $helpo_logo_width = $helpo_logo_width / 2;
        $helpo_logo_height = $helpo_logo_height / 2;

        $helpo_custom_css .= '
            .helpo_header-logo__link.helpo_retina_logo,
            header.helpo_transparent_header_on .helpo_header-logo__link.helpo_retina_logo,
            header.helpo_transparent_header_on.helpo_transparent_header_with_color  .helpo_header-logo__link.helpo_retina_logo {
                width: ' . absint($helpo_logo_width) . 'px;
                height: ' . absint($helpo_logo_height) . 'px;
                background-size: ' . absint($helpo_logo_width) . 'px ' . absint($helpo_logo_height) . 'px;
            }
        ';
    }

    // ------------------------ //
    // ------ Typography ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        body {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('main_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('main_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('main_font_weight')) . ';
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color_2')) . ';
        }
        
        body .helpo_content_wrapper .elementor-widget-text-editor {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        .helpo_button,
        .wp-block-button__link {
            font-family: ' . esc_attr(helpo_get_theme_mod('buttons_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('buttons_font_size')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('buttons_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('buttons_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('buttons_italic') == true ? 'italic' : 'normal') . ';
        }
        
        h1, h2, h3, h4, h5, h6,
        body .elementor-widget-heading .elementor-heading-title {
            font-family: ' . esc_attr(helpo_get_theme_mod('headings_font_family')) . ', sans-serif;
            font-weight: ' . esc_attr(helpo_get_theme_mod('headings_font_weight')) . ';
            text-transform: ' . (helpo_get_theme_mod('headings_uppercase') == true ? 'uppercase' : 'none') . ';
            font-style: ' . (helpo_get_theme_mod('headings_italic') == true ? 'italic' : 'normal') . ';
            color: ' . esc_attr(helpo_get_theme_mod('headings_color_2')) . ';
        }
        
        .helpo_price_item .helpo_price_container .helpo_currency, 
        .helpo_price_item .helpo_price_container .helpo_price, 
        .helpo_price_item .helpo_price_container .helpo_period {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color_2')) . ';
        }
        
        h1,
        body .elementor-widget-heading h1.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h1_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h1_line_height')) . ';
        }
        
        h2,
        body .elementor-widget-heading h2.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h2_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h2_line_height')) . ';
        }
        
        h3,
        body .elementor-widget-heading h3.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h3_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h3_line_height')) . ';
        }
        
        h4,
        body .elementor-widget-heading h4.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h4_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h4_line_height')) . ';
        }
        
        h5,
        body .elementor-widget-heading h5.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h5_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h5_line_height')) . ';
        }
        
        h6,
        body .elementor-widget-heading h6.elementor-heading-title {
            font-size: ' . esc_attr(helpo_get_theme_mod('h6_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('h6_line_height')) . ';
        }
    ';

    // -------------------- //
    // ------ Footer ------ //
    // -------------------- //
    $helpo_custom_css .= '
        .helpo_bottom-background {
            background: ' . esc_attr(helpo_get_theme_mod('bottom_image_bg_2')) . ';
        }
        
        .helpo_prefooter_container {
            background: ' . esc_attr(helpo_get_theme_mod('prefooter_bg_2')) . ';
        }
        
        .footer_widget {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('main_font_size')) . ';
            line-height: ' . esc_attr(helpo_get_theme_mod('main_line_height')) . ';
            font-weight: ' . esc_attr(helpo_get_theme_mod('main_font_weight')) . ';
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_color_2')) . ';
        }
        
        .footer_widget a {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_color_2')) . ';
        }
        
        .footer_widget a:hover {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_hover_2')) . ';
        }
        
        .helpo_footer-socials a {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_socials_2')) . ';
        }
        
        .helpo_footer-socials a:hover {
            color:  ' . esc_attr(helpo_get_theme_mod('prefooter_socials_hover_2')) . ';
        }
        
        .footer_widget a.helpo_button--filled {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_color_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_2')) . ';
        }
        
        .footer_widget a.helpo_button--filled:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_filled_hover_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('button_filled_bg_hover_2')) . ';
        }
        
        .helpo_footer_widget_title {
            color: ' . esc_attr(helpo_get_theme_mod('prefooter_widget_title_color_2')) . ';
        }
        
        .footer_widget.widget_nav_menu ul.menu li a:after,
        .footer_widget.widget_recent_comments ul li:before,
        .helpo_sidebar .widget.widget_recent_comments ul li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        footer.helpo_footer {
            color: ' . esc_attr(helpo_get_theme_mod('footer_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('footer_bg_2')) . ';
        }
        
        footer.helpo_footer a {
            color: ' . esc_attr(helpo_get_theme_mod('footer_color_2')) . ';
        }
        
        footer.helpo_footer a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('footer_hover_2')) . ';
        }
    ';

    // ------------------------ //
    // ------ Page Title ------ //
    // ------------------------ //
    $helpo_custom_css .= '
        .helpo_page_title_container {
            min-height: ' . absint(helpo_get_theme_mod('title_height')) . 'px;
            background-color: ' . esc_attr(helpo_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(helpo_get_theme_mod('post_title_bg')) .'");
        }
        
        .helpo_site_title_container {
            color: ' . esc_attr(helpo_get_theme_mod('site_title_color_2')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('site_title_font_family')) . ', cursive;
            font-size: ' . esc_attr(helpo_get_theme_mod('site_title_font_size')) . ';
        }
        
        .helpo_page_title {
            color: ' . esc_attr(helpo_get_theme_mod('page_title_color_2')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('page_title_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('page_title_font_size')) . ';
        }
        
        .helpo_page_subtitle {
            color: ' . esc_attr(helpo_get_theme_mod('page_subtitle_color_2')) . ';
            font-family: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_family')) . ', sans-serif;
            font-size: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_size')) . ';
        }
        
        .helpo_page_title:before {
            background: ' . esc_attr(helpo_get_theme_mod('title_divider_color_1_2')) . ';
        }
        
        .helpo_page_title:after {
            background: ' . esc_attr(helpo_get_theme_mod('title_divider_color_2_2')) . ';
        }
        
        body .helpo_additional_font .elementor-text-editor {
            font-family: ' . esc_attr(helpo_get_theme_mod('page_subtitle_font_family')) . ', sans-serif;
        }
    ';

    // ------------------------- //
    // ------ Single Post ------ //
    // ------------------------- //
    $helpo_custom_css .= '
        .helpo_post_details_tag_cont ul li:hover,
        .helpo_post_details_tag_cont ul li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_blog-post__socials a {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('post_socials_bg_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('post_socials_border_color_2')) . ';
        }
        
        .helpo_blog-post__socials a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('post_socials_bg_hover_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('post_socials_border_hover_2')) . ';
        }
        
        .form__field,
        body #give_checkout_user_info p input,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="text"],
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div p input[type="email"],
        .wp-block-search input[type="search"],
        input[type="password"],
        .comment-form-cookies-consent input[type="checkbox"]:checked + label:before,
        .comment-form-cookies-consent input[type="checkbox"]:not(:checked) + label:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:checked + span:before,
        .woocommerce-form-login__rememberme input[type="checkbox"]:not(:checked) + span:before,
        .helpo_sidebar .widget_product_search input[type="search"] {
            color: ' . esc_attr(helpo_get_theme_mod('form_field_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_field_border_2')) . ';
        }
        
        body form[id*=give-form] .give-donation-amount #give-amount-text, 
        body form[id*=give-form] .give-donation-amount .give-text-input {
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg_2')) . ';
        }
        
        .form__field:focus,
        body #give_checkout_user_info p input:focus {
            background: ' . esc_attr(helpo_get_theme_mod('active_form_field_bg_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('active_form_field_border_2')) . ';
        }
        
        input[type="submit"],
        .wp-block-search button[type="submit"],
        #cancel-comment-reply-link {
            color: ' . esc_attr(helpo_get_theme_mod('form_button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_button_bg_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_button_border_color_2')) . ';
        }
        
        .footer_widget .mc4wp-form input[type="submit"],
        .helpo_footer_form input[type="submit"],
        .helpo_sidebar .widget_calendar td a:after,
        .footer_widget.widget_calendar td a:after,
        .wp-block-calendar td a:after {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        input[type="submit"]:hover,
        .wp-block-search button[type="submit"]:hover,
        #cancel-comment-reply-link:hover,
        .footer_widget .mc4wp-form input[type="submit"]:hover {
            color: ' . esc_attr(helpo_get_theme_mod('form_button_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_button_bg_hover_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('form_button_border_hover_2')) . ';
        }
        
        .helpo_comments__item-name,
        .helpo_comments__item-action a,
        .helpo_comment_reply_cont a.comment-edit-link {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color_2')) . ';
        }
        
        .comment-respond .logged-in-as a {
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color_2')) . ';
        }
        
        .helpo_comments__item-action a:hover,
        .helpo_comment_reply_cont a.comment-edit-link:hover,
        .comment-respond .logged-in-as a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_pagination span.current,
        .helpo_pagination a:hover,
        .woocommerce nav.woocommerce-pagination ul li span.current,
        .woocommerce nav.woocommerce-pagination ul li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
    ';

    // -------------------------- //
    // ------ Single Cause ------ //
    // -------------------------- //
    $helpo_custom_css .= '
        form[id*=give-form] .give-donation-amount .give-currency-symbol.give-currency-position-before,
        body form[id*=give-form] #give-donation-level-radio-list li input[type="radio"]:checked + label:before,
        body form[id*=give-form] #give-gateway-radio-list li input[type="radio"]:checked + label:before,
        body form[id*=give-form] .give-donation-levels-wrap li input[type="radio"]:checked + label:before,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset ul li input[type="radio"]:checked + label:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        #give-payment-mode-select .give-payment-mode-label,
        #give_purchase_form_wrap #give_checkout_user_info > legend,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset .give-payment-mode-label,
        body form[id*=give-form] .give-donation-levels-wrap + fieldset + div legend,
        .helpo_single_product_page.woocommerce div.product form.cart.grouped_form table a {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color_2')) . ';
        }
    ';

    // ---------------------------- //
    // ------ 404 Error Page ------ //
    // ---------------------------- //
    $helpo_custom_css .= '
        .helpo_404_error_container {
            background-image: url(' . esc_url(helpo_get_theme_mod('404_bg_image')) . ');
            background-color: ' . esc_attr(helpo_get_theme_mod('404_bg_color')) . ';
        }
        
        .helpo_404_error_title {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_404_home_button.helpo_button.helpo_button--primary:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
    ';

    // ----------------------------------------- //
    // ------ Helpo Widgets for Elementor ------ //
    // ----------------------------------------- //
    $helpo_custom_css .= '
        body .elementor-widget-text-editor.elementor-drop-cap-view-default .elementor-drop-cap,
        .helpo_person_socials li a:hover,
        body .helpo_content_wrapper .elementor-text-editor a:hover strong,
        body .helpo_skills_info .elementor-widget-text-editor a:hover,
        .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_testimonials_icon,
        .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_testimonials_icon,
        .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_testimonials_icon,
        .helpo_causes_slider_wrapper.helpo_view_type_2 .helpo_post_title a:hover,
        .helpo_causes_grid_wrapper .projects-masonry__title a:hover,
        .helpo_cause_item_wrapper .projects-masonry__title a:hover,
        .helpo_events_listing_wrapper .upcoming-item__details .icon,
        .helpo_person_wrapper.helpo_view_type_2 .helpo_person_socials li a:hover,
        .helpo_person_item_type_3 .helpo_person_socials li a:hover,
        .helpo_person_item_type_3 .helpo_person_socials li:nth-of-type(even) a,
        .helpo_person_wrapper.helpo_view_type_1 .helpo_person_socials li a:hover,
        .page-link a:hover,
        .helpo_page_content_container table a:hover,
        .helpo_blog_content_container table a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_events_listing_wrapper .upcoming-item__details .icon {
            stroke: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_blockquote.helpo_view_type_2,
        .helpo_donate_box_item .helpo_button:hover,
        .helpo_price_item .helpo_price_button_container .helpo_button:hover,
        .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_donate_button_container .helpo_button:hover,
        body .helpo_causes_slider_widget .helpo_slider_nav_button:hover,
        body .helpo_testimonials_wrapper .helpo_slider_nav_button:hover,
        body .helpo_content_slider_wrapper .helpo_slider_nav_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_1 .helpo_donate_button_container .helpo_button:hover,
        .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_author_container:before,
        .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_author_container:before,
        .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_author_container:before,
        .helpo_content_slider_wrapper .helpo_button:hover,
        .helpo_sidebar .widget.widget_tag_cloud .tagcloud a,
        .footer_widget.widget_tag_cloud .tagcloud a,
        .wp-block-tag-cloud a,
        .helpo_causes_grid_wrapper .projects-masonry__badge,
        .helpo_cause_item_wrapper .projects-masonry__badge,
        .helpo_events_listing_wrapper .upcoming-item__date,
        .helpo_stories_wrapper .helpo_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_button:hover,
        body .elementor .mc4wp-form-fields input[type="submit"]:hover {
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_standard_blog_listing .helpo_category_container {
            background: #ffffff;
        }
        
        body .helpo_content_wrapper .elementor-text-editor ul li:before {
            background: ' . esc_attr(helpo_get_theme_mod('main_font_color_2')) . ';
        }
        
        p a,
        p a:hover,
        body .helpo_content_wrapper .elementor-text-editor ol li:before,
        .helpo_info_field a {
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color_2')) . ';
        }
        
        body .helpo_content_wrapper .elementor-text-editor ul li,
        body .helpo_content_wrapper .elementor-text-editor ol li,
        body .elementor-widget-counter .elementor-counter-title,
        .helpo_person_position,
        body .elementor-widget-progress .elementor-title,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title,
        body .helpo_view_type_1 .elementor-alert .elementor-alert-title,
        body .helpo_view_type_2 .elementor-alert .elementor-alert-title,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-content {
            font-family: ' . esc_attr(helpo_get_theme_mod('main_font_family')) . ', sans-serif;
        }
        
        .helpo_blockquote.helpo_view_type_1:before,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title a,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title a,
        body .elementor-widget-accordion .elementor-active .elementor-accordion-icon, 
        body .elementor-widget-accordion .elementor-active a,
        body .elementor-widget-accordion .elementor-accordion-icon,
        body .elementor-widget-accordion a,
        .helpo_content_slider_wrapper.helpo_view_type_1 .helpo_anchor,
        .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_anchor,
        .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_anchor,
        .helpo_content_slider_wrapper .helpo_additional_info,
        .helpo_content_slider_wrapper .helpo_additional_info a,
        .helpo_standard_blog_listing .helpo_post_title a,
        body .elementor-widget-image-box .elementor-image-box-content .elementor-image-box-title {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color_2')) . ';
        }
        
        .helpo_blockquote.helpo_view_type_1:before {
            font-family: "Noto Serif",serif;
        }
        
        body .elementor-widget-counter .elementor-counter-number-wrapper,
        .helpo_person_name,
        body .elementor-widget-accordion .elementor-accordion .elementor-tab-title,
        body .elementor-widget-toggle .elementor-toggle .elementor-tab-title {
            font-family: ' . esc_attr(helpo_get_theme_mod('headings_font_family')) . ', sans-serif;
        }
        
        body .helpo_causes_slider_widget .helpo_slider_nav_button,
        body .helpo_testimonials_wrapper .helpo_slider_nav_button,
        body .helpo_content_slider_wrapper .helpo_slider_nav_button,
        body .helpo_tabs_vertical .helpo_tabs_titles_container .helpo_tab_title_item a:hover,
        body .helpo_tabs_vertical .helpo_tabs_titles_container .helpo_tab_title_item.active a {
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_tabs_titles_container .helpo_tab_title_item a:hover,
        .helpo_tabs_titles_container .helpo_tab_title_item.active a {
            color: ' . esc_attr(helpo_get_theme_mod('post_socials_color')) . ';
            border-bottom-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_causes_slider_widget .helpo_slider_nav_button,
        .helpo_testimonials_wrapper .helpo_slider_nav_button,
        .helpo_content_slider_wrapper .helpo_slider_nav_button,
        .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger i,
        .wp-block-archives-list li a,
        .wp-block-calendar table a,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a,
        .helpo_events_wrapper .helpo_event_title a,
        .helpo_no_result_search_form .helpo_icon_search,
        .helpo_sidebar .widget_product_search button,
        .wp-block-latest-comments .wp-block-latest-comments__comment a,
        .wp-block-latest-posts li a,
        .wp-block-rss li a,
        .page-link,
        .page-link a,
        .page-link:hover,
        .helpo_page_content_container table th,
        .helpo_blog_content_container table th,
        .helpo_page_content_container table a,
        .helpo_blog_content_container table a,
        .helpo_causes_slider_wrapper .helpo_post_title a {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_color_2')) . ';
        }
        
        .helpo_sidebar .widget_calendar td#today:after,
        .wp-block-calendar td#today:after {
            background: ' . esc_attr(helpo_get_theme_mod('listing_titles_color')) . ';
        }
        
        .helpo_causes_slider_widget .helpo_slider_nav_button:hover,
        .helpo_testimonials_wrapper .helpo_slider_nav_button:hover,
        .helpo_content_slider_wrapper .helpo_slider_nav_button:hover,
        .helpo_content_slider_wrapper .helpo_button:hover,
        .helpo_events_wrapper .helpo_event_title a:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_slider_nav_button:hover,
        .has-avatars .wp-block-latest-comments__comment .wp-block-latest-comments__comment-meta a:hover,
        .wp-block-latest-comments .wp-block-latest-comments__comment a:hover,
        .wp-block-latest-posts li a:hover,
        .wp-block-rss li a:hover,
        .helpo_causes_listing_wrapper .helpo_post_title a,
        body .helpo_events_listing_wrapper .upcoming-item__title a,
        body .helpo_events_wrapper .helpo_event_content_container p,
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item .upcoming-item__title a,
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item,
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item strong {
            color: ' . esc_attr(helpo_get_theme_mod('listing_titles_hover_2')) . ';
        }
        
        body .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_info_container, 
        body .helpo_causes_slider_wrapper.helpo_view_type_1 .helpo_info_container,
        body .helpo_causes_listing_wrapper.helpo_view_type_4 .helpo_info_container, 
        body .helpo_causes_slider_wrapper.helpo_view_type_4 .helpo_info_container,
        body .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_causes_list_wrapper,
        body .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_causes_list_wrapper,
        body .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_causes_list_item,
        body .helpo_events_listing_wrapper .upcoming-item__body,
        body .helpo_events_wrapper .helpo_event_item_wrapper,
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item .helpo_event_item_wrapper {
            background: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
        
        body .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_featured_image_container .helpo_category_container,
        body .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_category_container,
        body .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_category_container,
        body .helpo_causes_slider_wrapper.helpo_view_type_1 .helpo_featured_image_container .helpo_category_container,
        body .helpo_causes_listing_wrapper.helpo_view_type_4 .helpo_featured_image_container .helpo_category_container,
        body .helpo_causes_slider_wrapper.helpo_view_type_4 .helpo_featured_image_container .helpo_category_container,
        body .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_causes_list_wrapper .helpo_category_container,
        body .helpo_blog_listing_widget .helpo_post_title a,
        body .helpo_blog_listing_widget .helpo_post_title a:hover,
        .helpo_recent_posts_widget .helpo_post_title a,
        .helpo_recent_posts_widget .helpo_post_title a:hover,
        body .helpo_blog_listing_widget .helpo_category_container,
        .helpo_sidebar .widget.widget_categories ul li a,
        .helpo_sidebar .recent-posts__item-link,
        .helpo_sidebar .widget.widget_recent_entries ul li a,
        .helpo_sidebar .widget.widget_archive ul li a,
        .helpo_sidebar .widget.widget_tag_cloud .tagcloud a,
        .footer_widget.widget_tag_cloud .tagcloud a,
        .helpo_sidebar .widget.widget_search .helpo_icon_search,
        .helpo_sidebar .widget.widget_pages ul li a,
        .helpo_sidebar .widget.widget_meta ul li a,
        .helpo_sidebar .widget.widget_recent_comments ul li a,
        .helpo_sidebar .widget.widget_rss .widget_title a,
        .helpo_sidebar .widget.widget_rss ul li a,
        .helpo_sidebar .widget.widget_nav_menu ul li a,
        .helpo_sidebar .widget.widget_product_categories ul li a,
        .helpo_sidebar .widget.widget_layered_nav ul li a,
        .helpo_sidebar .widget.widget_rating_filter ul li a,
        .helpo_sidebar .widget_calendar table a,
        .helpo_sidebar .widget_calendar nav a,
        .wp-block-calendar a {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .helpo_sidebar .widget.widget_categories ul li a:hover,
        .helpo_sidebar .recent-posts__item-link:hover,
        .helpo_sidebar .widget.widget_recent_entries ul li a:hover,
        .helpo_sidebar .widget.widget_archive ul li a:hover,
        .helpo_sidebar .widget.widget_pages ul li a:hover,
        .helpo_sidebar .widget.widget_meta ul li a:hover,
        .helpo_sidebar .widget.widget_recent_comments ul li a:hover,
        .helpo_sidebar .widget.widget_rss .widget_title a:hover,
        .helpo_sidebar .widget.widget_rss ul li a:hover,
        .helpo_sidebar .widget.widget_nav_menu ul li a:hover,
        .helpo_sidebar .widget.widget_product_categories ul li a:hover,
        .helpo_sidebar .widget.widget_layered_nav ul li a:hover,
        .helpo_sidebar .widget.widget_rating_filter ul li a:hover,
        .helpo_sidebar .widget_calendar table a:hover,
        .helpo_sidebar .widget_calendar nav a:hover,
        .wp-block-calendar a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
        }
        
        .helpo_causes_listing_wrapper.helpo_view_type_4 .helpo_donate_button_container .helpo_button,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_button,
        .helpo_causes_slider_wrapper.helpo_view_type_4 .helpo_donate_button_container .helpo_button {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        body .helpo_blog_listing_widget .helpo_category_container {
            background-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_causes_listing_wrapper.helpo_view_type_4 .helpo_donate_button_container .helpo_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_3 .helpo_button:hover,
        .helpo_causes_slider_wrapper.helpo_view_type_4 .helpo_donate_button_container .helpo_button:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
        }
        
        body .helpo_sidebar .widget.widget_tag_cloud .tagcloud a:hover, 
        body .footer_widget.widget_tag_cloud .tagcloud a:hover, 
        body .helpo_sidebar .widget.widget_product_tag_cloud .tagcloud a:hover, 
        body .wp-block-tag-cloud a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
        }
        
        body .helpo_causes_slider_widget .helpo_slider_nav_button {
            border-color: #a5d3be;
        }
        
        body .helpo_causes_slider_widget .helpo_slider_nav_button:hover {
            background: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('hutton_bg_hover_2')) . ';
        }
        
        body .helpo_recent_post.helpo_post_1 .helpo_recent_post_category_cont,
        body .helpo_recent_post.helpo_post_2 .helpo_recent_post_category_cont,
        body .helpo_recent_post.helpo_post_3 .helpo_recent_post_category_cont {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        body .helpo_color_scheme_mono .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_donate_popup_button,
        body .helpo_color_scheme_mono .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_donate_popup_button {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        body .helpo_color_scheme_mono .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_donate_popup_button:hover,
        body .helpo_color_scheme_mono .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_donate_popup_button:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        body .helpo_pagination span, 
        body .helpo_pagination a, 
        body .woocommerce nav.woocommerce-pagination ul li a, 
        body .woocommerce nav.woocommerce-pagination ul li span, 
        body .woocommerce nav.woocommerce-pagination ul li span.current {
            border-color: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
        
        .helpo_content_paging_wrapper .page-link span,
        .helpo_content_paging_wrapper .page-link a,
        body .helpo_pagination span.current, 
        body .helpo_pagination a:hover, 
        body .woocommerce nav.woocommerce-pagination ul li span.current, 
        body ommerce nav.woocommerce-pagination ul li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
            background-color: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
        
        body .elementor-accordion .elementor-tab-title .elementor-accordion-icon.elementor-accordion-icon-right,
        body .elementor-accordion .elementor-tab-title .elementor-accordion-icon.elementor-accordion-icon-left {
            border-color: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
        
        .helpo_color_scheme_mono .footer_widget .mc4wp-form input[type="submit"],
        .helpo_color_scheme_mono .helpo_footer_form input[type="submit"],
        body .helpo_color_scheme_mono .give-btn {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_color_scheme_mono .footer_widget .mc4wp-form input[type="submit"]:hover,
        .helpo_color_scheme_mono .helpo_footer_form input[type="submit"]:hover,
        body .helpo_color_scheme_mono .give-btn:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_hover_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            border-color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_events_wrapper.helpo_view_type_2 .helpo_event_item .icon {
            stroke: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
    ';

    // --------------------------- //
    // ------- WooCommerce ------- //
    // --------------------------- //
    $helpo_custom_css .= '
        .helpo_shop_loop select.orderby {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .helpo_single_product_page .helpo_page_title_container {
            background-color: ' . esc_attr(helpo_get_theme_mod('post_title_bg_color')) . ';
            background-image: url("'. esc_url(helpo_get_theme_mod('woo_title_bg_image')) .'"); 
        }
        
        .helpo_single_product_page .star-rating span,
        .helpo_single_product_page .helpo_minus_button:hover,
        .helpo_single_product_page .helpo_plus_button:hover,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars a:hover,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars.selected a:not(.active),
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-form-rating .stars.selected a.active,
        .woocommerce div.product span.price {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .helpo_sidebar .widget.widget_product_tag_cloud .tagcloud a,
        body.woocommerce ul.products li.product .onsale, 
        body.helpo_single_product_page.woocommerce span.onsale,
        body .helpo_header_cart .helpo_header_cart_counter {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_sidebar .widget.widget_product_tag_cloud .tagcloud a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        body.helpo_single_product_page.woocommerce div.product form.cart .button {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        body.helpo_single_product_page.woocommerce div.product form.cart .button:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .helpo_header_cart .helpo_header_cart_counter,
        .woocommerce .widget_price_filter .price_slider_amount .button:hover,
        .woocommerce .widget_shopping_cart .buttons a:hover,
        .woocommerce.widget_shopping_cart .buttons a:hover,
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:before,
        .woocommerce #respond input#submit, 
        .woocommerce #review_form #respond .form-submit input:hover,
        body .woocommerce table.shop_table tbody td.actions .button:hover,
        body.woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button:hover,
        body.woocommerce-checkout .checkout_coupon .button:hover,
        body .woocommerce #payment #place_order:hover, 
        body.woocommerce-page #payment #place_order:hover,
        body .woocommerce .woocommerce-MyAccount-content button.button:hover,
        body .woocommerce .woocommerce-form-login .button:hover,
        body .woocommerce-MyAccount-content .edit:hover,
        body .woocommerce .return-to-shop .button:hover,
        body .woocommerce .woocommerce-message .button:hover,
        body .woocommerce .woocommerce-Message .button:hover {
            color: #ffffff;
            background: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        body.woocommerce ul.products li.product .button,
        body.woocommerce ul.products li.product .added_to_cart {
            color: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        body.woocommerce ul.products li.product .button:hover,
        body.woocommerce ul.products li.product .added_to_cart:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('main_color_2')) . ';
        }
        
        .woocommerce ul.products li.product .woocommerce-loop-product__title {
            color: ' . esc_attr(helpo_get_theme_mod('main_font_color_2')) . ';
        }
        
        body.woocommerce ul.products li.product .woocommerce-loop-product__title:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
            opacity: 1;
        }
        
        body.woocommerce ul.products li.product .price {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .woocommerce ul.product_list_widget li a,
        .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
        .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--description table td,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews .comment-reply-title,
        .woocommerce-checkout .woocommerce-info a,
        .woocommerce-MyAccount-navigation ul li a,
        .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta .woocommerce-review__author {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .woocommerce ul.product_list_widget li a:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove,
        .woocommerce.widget_shopping_cart .cart_list li a.remove {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ' !important;
        }
        
        .woocommerce .widget_shopping_cart .cart_list li a.remove:hover,
        .woocommerce.widget_shopping_cart .cart_list li a.remove:hover {
            color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ' !important;
        }
        
        .woocommerce .widget_price_filter .price_slider_amount .button,
        .woocommerce .widget_shopping_cart .buttons a,
        .woocommerce.widget_shopping_cart .buttons a,
        body.woocommerce #review_form #respond .form-submit input,
        body .woocommerce table.shop_table tbody td.actions .button,
        body .woocommerce .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-page .cart-collaterals .wc-proceed-to-checkout .button,
        body.woocommerce-checkout .checkout_coupon .button,
        body .woocommerce #payment #place_order, 
        body.woocommerce-page #payment #place_order,
        body .woocommerce .woocommerce-MyAccount-content button.button,
        body .woocommerce .woocommerce-form-login .button,
        body .woocommerce-MyAccount-content .edit,
        body .woocommerce .return-to-shop .button,
        body .woocommerce .woocommerce-message .button,
        body .woocommerce .woocommerce-Message .button,
        body.woocommerce .woocommerce-message .button {
            border-color: ' . esc_attr(helpo_get_theme_mod('button_color_2')) . ';
        }
        
        .helpo_single_product_page .product_meta span,
        .helpo_single_product_page .product_meta span a,
        .woocommerce table.shop_table thead,
        .woocommerce table.shop_table tbody td.product-name,
        .woocommerce table.shop_table tbody td.product-quantity,
        .woocommerce table.shop_table tbody td.product-name a,
        .woocommerce table.shop_table tbody td.product-price,
        .woocommerce table.shop_table tbody td.product-subtotal,
        .woocommerce table.shop_table tbody td.actions .coupon label,
        .woocommerce .cart-collaterals table.shop_table th,
        .woocommerce-page .cart-collaterals table.shop_table th,
        .woocommerce .cart-collaterals table.shop_table td,
        .woocommerce-page .cart-collaterals table.shop_table td,
        .woocommerce-checkout .woocommerce table.shop_table tbody td,
        .woocommerce-checkout .woocommerce table.shop_table tfoot th,
        .woocommerce-checkout .woocommerce table.shop_table tfoot td,
        .woocommerce div.product form.cart .variations td.label {
            color: ' . esc_attr(helpo_get_theme_mod('headings_color_2')) . ';
        }
        
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews input,
        .woocommerce div.product .woocommerce-tabs .panel.woocommerce-Tabs-panel--reviews textarea {
            color: ' . esc_attr(helpo_get_theme_mod('form_field_color_2')) . ';
            background: ' . esc_attr(helpo_get_theme_mod('form_field_bg_2')) . ';
        }
        
        .woocommerce .widget_price_filter .ui-slider .ui-slider-handle:before {
            background: ' . esc_attr(helpo_get_theme_mod('listings_bg_color_2')) . ';
        }
    ';
}

