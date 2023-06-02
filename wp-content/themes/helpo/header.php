<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
        <?php wp_head(); ?>
    </head>

    <?php
    if (!isset($content_width)) $content_width = 1200;
    ?>
    <body <?php body_class(); ?>>
        <?php wp_body_open(); ?>
        <div class="helpo_page-wrapper helpo_color_scheme_<?php echo esc_attr(helpo_get_theme_mod('hepho_color_scheme')); ?>">

            <!-- Main Donate Form -->
            <div class="helpo_close_main_donation_popup_layer"></div>

            <div class="helpo_main_donation_popup">
                <?php echo do_shortcode(wp_kses(helpo_get_theme_mod('donation_shortcode'), 'strip')); ?>
            </div>

            <!-- Side Panel -->
            <div class="helpo_aside-dropdown">
                <div class="helpo_aside-dropdown__inner">
                    <span class="helpo_aside-dropdown__close">
                        <svg class="icon">
                            <svg viewBox="0 0 47.971 47.971" id="close" xmlns="http://www.w3.org/2000/svg"><path d="M28.228 23.986L47.092 5.122a2.998 2.998 0 000-4.242 2.998 2.998 0 00-4.242 0L23.986 19.744 5.121.88a2.998 2.998 0 00-4.242 0 2.998 2.998 0 000 4.242l18.865 18.864L.879 42.85a2.998 2.998 0 104.242 4.241l18.865-18.864L42.85 47.091c.586.586 1.354.879 2.121.879s1.535-.293 2.121-.879a2.998 2.998 0 000-4.242L28.228 23.986z"/></svg>
                        </svg>
                    </span>

                    <div class="helpo_aside-dropdown__item helpo_mobile_menu_container d-lg-none d-block"></div>

                    <?php
                    if (helpo_get_theme_mod('side_panel') == 'on') {
                        ?>
                        <div class="helpo_aside-dropdown__item">
                            <?php
                            $helpo_menu_locations = get_nav_menu_locations();

                            if (isset($helpo_menu_locations['sidebar_menu']) && $helpo_menu_locations['sidebar_menu'] !== 0) {
                                wp_nav_menu(array('theme_location' => 'sidebar_menu', 'menu_class' => 'helpo_aside-menu', 'depth' => '1', 'container' => ''));
                            }
                            ?>

                            <?php
                            if (helpo_get_theme_mod('side_panel_info') == 'show') {
                                if (helpo_get_theme_mod('tagline_email') !== '') {
                                    ?>
                                    <div class="helpo_aside-inner">
                                        <span class="helpo_aside-inner__title"><?php echo esc_html__('Email', 'helpo') ?></span>

                                        <a class="helpo_aside-inner__link" href="mailto:<?php echo esc_attr(helpo_get_theme_mod('tagline_email')); ?>">
                                            <?php echo esc_html(helpo_get_theme_mod('tagline_email')); ?>
                                        </a>
                                    </div>
                                    <?php
                                }

                                if (helpo_get_theme_mod('tagline_phone_1') !== '' || helpo_get_theme_mod('tagline_phone_2') !== '') {
                                    ?>
                                    <div class="helpo_aside-inner">
                                        <?php
                                        if (helpo_get_theme_mod('number_of_phones') == '2') {
                                            ?>
                                            <span class="helpo_aside-inner__title">
                                            <?php echo esc_html__('Phone Numbers', 'helpo'); ?>
                                        </span>

                                            <a class="helpo_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_1'))); ?>">
                                                <?php echo esc_html(helpo_get_theme_mod('tagline_phone_1')); ?>
                                            </a>

                                            <a class="helpo_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_2'))); ?>">
                                                <?php echo esc_html(helpo_get_theme_mod('tagline_phone_2')); ?>
                                            </a>
                                            <?php
                                        } else {
                                            ?>
                                            <span class="helpo_aside-inner__title">
                                            <?php echo esc_html__('Phone Number', 'helpo'); ?>
                                        </span>

                                            <a class="helpo_aside-inner__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_1'))); ?>">
                                                <?php echo esc_html(helpo_get_theme_mod('tagline_phone_1')); ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php

                                    if (helpo_get_theme_mod('side_panel_socials') == 'show') {
                                        echo helpo_socials_output('helpo_aside-socials');
                                    }
                                }
                            }
                            ?>
                        </div>

                        <?php
                        if (helpo_get_theme_mod('side_panel_button') == 'show') {
                            ?>
                            <div class="helpo_aside-dropdown__item">
                                <a class="helpo_button helpo_button--squared helpo_main_donate_popup_trigger" href="<?php echo esc_js('javascript:void(0)'); ?>">
                                    <span><?php echo esc_html(helpo_get_theme_mod('header_button_text')); ?></span>
                                </a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>

            <!-- Tagline -->
            <?php
            if (helpo_get_prefered_option('header_style') == 'type_4') {
                if (helpo_get_prefered_option('header_tagline') == 'on') {
                    ?>
                    <div class="helpo_top-bar d-none d-lg-block">
                        <div class="helpo_top_bar_inner">
                            <div class="container-fluid">
                                <div class="row align-items-end">
                                    <!-- Info Block -->
                                    <div class="col-lg-9">
                                        <?php
                                        if (helpo_get_theme_mod('number_of_phones') == '2') {
                                            if (helpo_get_theme_mod('tagline_phone_1') !== '') {
                                                ?>
                                                <a class="helpo_top-bar__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(helpo_get_theme_mod('tagline_phone_1')); ?></a>
                                                <?php
                                            }

                                            if (helpo_get_theme_mod('tagline_phone_2') !== '') {
                                                ?>
                                                <a class="helpo_top-bar__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_2'))); ?>"><?php echo esc_html(helpo_get_theme_mod('tagline_phone_2')); ?></a>
                                                <?php
                                            }
                                        } else {
                                            if (helpo_get_theme_mod('tagline_phone_1') !== '') {
                                                ?>
                                                <a class="helpo_top-bar__link" href="tel:<?php echo esc_attr(str_replace(' ', '', helpo_get_theme_mod('tagline_phone_1'))); ?>"><?php echo esc_html(helpo_get_theme_mod('tagline_phone_1')); ?></a>
                                                <?php
                                            }
                                        }

                                        if (helpo_get_theme_mod('tagline_email') !== '') {
                                            ?>
                                            <a class="helpo_top-bar__link" href="mailto:<?php echo esc_attr(helpo_get_theme_mod('tagline_email')); ?>"><?php echo esc_html(helpo_get_theme_mod('tagline_email')); ?></a>
                                            <?php
                                        }
                                        ?>
                                    </div>

                                    <!-- Socials Block -->
                                    <div class="col-lg-3 helpo_header_socials_container">
                                        <?php
                                        if (helpo_get_theme_mod('tagline_socials') == 'on') {
                                            echo helpo_socials_output('helpo_header_socials');
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <!-- Header -->
            <?php
            if (helpo_get_prefered_option('header_style') == 'type_1') {
                $header_type_class = 'helpo_header--inner';
            }

            if (helpo_get_prefered_option('header_style') == 'type_2') {
                $header_type_class = 'helpo_header--front';
            }

            if (helpo_get_prefered_option('header_style') == 'type_3') {
                $header_type_class = 'helpo_header--front_2';
            }

            if (helpo_get_prefered_option('header_style') == 'type_4') {
                $header_type_class = 'helpo_header--front_3';
            }

            $transparent_header_class = 'helpo_transparent_header_' . esc_attr(helpo_get_prefered_option('transparent_header'));

            if (helpo_get_prefered_option('sticky_header') == 'off') {
                $sticky_header_class = 'helpo_no_sticky_header';
            } else {
                $sticky_header_class = 'helpo_sticky_header';
            }

            if (helpo_get_prefered_option('header_tagline') == 'on') {
                $header_tagline_class = 'helpo_tagline_on';
            } else {
                $header_tagline_class = 'helpo_tagline_off';
            }
            ?>

            <header class="helpo_header <?php echo esc_attr($header_type_class); ?> <?php echo esc_attr($transparent_header_class); ?> <?php echo esc_attr($sticky_header_class); ?> <?php echo esc_attr($header_tagline_class); ?>">
                <div class="container-fluid">
                    <div class="row no-gutters justify-content-between">

                        <!-- Logo Block -->
                        <div class="col-auto d-flex align-items-center helpo_logo_container helpo_side_panel_<?php echo esc_attr(helpo_get_theme_mod('side_panel')); ?>">
                            <div class="helpo_dropdown-trigger d-none d-sm-block">
                                <div class="helpo_dropdown-trigger__item"></div>
                            </div>

                            <?php
                            $helpo_logo_metadata = wp_get_attachment_metadata(attachment_url_to_postid(helpo_get_theme_mod('logo_image')));
                            $helpo_logo_width = (isset($helpo_logo_metadata['width']) ? $helpo_logo_metadata['width'] : '270');
                            $helpo_logo_height = (isset($helpo_logo_metadata['height']) ? $helpo_logo_metadata['height'] : '88');
                            $helpo_retina_class = 'helpo_non_retina_logo';

                            if (helpo_get_theme_mod('logo_retina') == true) {
                                $helpo_logo_width = $helpo_logo_width / 2;
                                $helpo_logo_height = $helpo_logo_height / 2;
                                $helpo_retina_class = 'helpo_retina_logo';
                            }

                            ?>
                            <div class="helpo_header-logo">
                                <a class="helpo_header-logo__link <?php echo esc_attr($helpo_retina_class); ?>" href="<?php echo esc_url(home_url('/')); ?>"></a>
                            </div>
                        </div>

                        <!-- Menu Block -->
                        <div class="col-auto helpo_header_menu_container">
                            <nav>
                                <?php
                                $helpo_menu_locations = get_nav_menu_locations();

                                if (isset($helpo_menu_locations['main']) && $helpo_menu_locations['main'] !== 0) {
                                    wp_nav_menu(array('theme_location' => 'main', 'menu_class' => 'helpo_main-menu helpo_main-menu--inner', 'depth' => '2', 'container' => ''));
                                } else {
                                    echo '<div class="helpo_menu_notify">' . esc_html__('Please create and select menu in Appearance (Menus)', 'helpo') . ' <a href="'.get_admin_url(null, 'nav-menus.php').'"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a></div>';
                                }
                                ?>
                            </nav>
                        </div>

                        <!-- Button Block -->
                        <div class="col-auto d-flex align-items-center helpo_header_button_container">
                            <?php
                            if (class_exists('WooCommerce')) {
                                if (is_shop() || is_product()) {
                                    ?>
                                    <a class="helpo_header_cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo ((WC()->cart->get_cart_contents_count() == 0) ? '' . esc_html__('Cart is empty', 'helpo') . '' : '' . sprintf(_n('%s item', '%s items', WC()->cart->get_cart_contents_count(), 'helpo'), WC()->cart->get_cart_contents_count()) . ''); ?>">
                                        <svg class="icon">
                                            <svg viewBox="0 0 12.8 16" id="bag" xmlns="http://www.w3.org/2000/svg"><path d="M12.797 13.831l-.916-10.317a.441.441 0 00-.438-.402H9.559C9.533 1.391 8.127 0 6.4 0S3.267 1.391 3.241 3.112H1.357a.437.437 0 00-.438.402L.003 13.831 0 13.87C0 15.045 1.076 16 2.4 16h8c1.324 0 2.4-.955 2.4-2.13 0-.013 0-.026-.003-.039zM6.4.883a2.28 2.28 0 012.276 2.228H4.124A2.28 2.28 0 016.4.883zm4 14.234h-8c-.831 0-1.504-.55-1.517-1.227l.876-9.891h1.478V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h4.556V5.34a.44.44 0 00.441.442.44.44 0 00.442-.442V3.998h1.478l.88 9.891c-.013.678-.69 1.228-1.517 1.228z" fill-rule="evenodd" clip-rule="evenodd"/></svg>
                                        </svg>
                                        <?php
                                        if (WC()->cart->get_cart_contents_count() !== 0) {
                                            ?>
                                            <span class="helpo_header_cart_counter"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                    <?php
                                }
                            }

                            if (helpo_get_theme_mod('header_button') == 'on') {
                                ?>
                                <a class="helpo_button helpo_button--squared <?php echo ((helpo_get_theme_mod('header_button_type') == 'shortcode') ? 'helpo_main_donate_popup_trigger' : ''); ?>" href="<?php echo ((helpo_get_theme_mod('header_button_type') == 'shortcode') ? '' . esc_js('javascript:void(0)') . '' : '' . esc_url(helpo_get_theme_mod('donation_link')) . ''); ?>">
                                    <span><?php echo esc_html(helpo_get_theme_mod('header_button_text')); ?></span>
                                </a>
                                <?php
                            }
                            ?>

                            <div class="helpo_dropdown-trigger d-block d-sm-none">
                                <div class="helpo_dropdown-trigger__item"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
