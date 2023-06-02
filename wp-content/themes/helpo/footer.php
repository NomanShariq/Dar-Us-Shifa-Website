

            <?php
            if (helpo_get_prefered_option('bottom_image_status') == 'show') {
                if (helpo_get_post_option('bottom_image_type') == 'custom') {
                    foreach (helpo_get_post_option('custom_bottom_image') as $key => $image) {
                        $bottom_image_url = $image['full_url'];
                    }
                } else {
                    $bottom_image_url = helpo_get_theme_mod('bottom_image');
                }

                ?>
                <div class="helpo_bottom-background <?php echo ((helpo_get_post_option('bottom_image_bg_type') == 'custom') ? 'helpo_js_bg_color' : ''); ?>" <?php echo ((helpo_get_post_option('bottom_image_bg_type') == 'custom') ? 'data-bg-color="' . esc_attr(helpo_get_post_option('custom_bottom_image_bg')) . '"' : ''); ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="bottom-background__img">
                                    <img src="<?php echo esc_url($bottom_image_url); ?>" alt="<?php echo esc_attr__('Bottom Image', 'helpo'); ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }

            if (helpo_get_prefered_option('prefooter_status') == 'show') {
                if (helpo_get_prefered_option('prefooter_type') == 'type_1') {
                    $footer_sidebar = 'sidebar-footer';
                }

                if (helpo_get_prefered_option('prefooter_type') == 'type_2') {
                    $footer_sidebar = 'sidebar-footer-2';
                }

                if (helpo_get_prefered_option('prefooter_type') == 'type_3') {
                    $footer_sidebar = 'sidebar-footer-3';
                }

                if (is_active_sidebar($footer_sidebar)) {
                    ?>
                    <div class="helpo_prefooter_container">
                        <div class="container">
                            <div class="helpo_prefooter_wrapper helpo_prefooter_<?php echo esc_attr(helpo_get_prefered_option('prefooter_type')); ?>">
                                <?php dynamic_sidebar($footer_sidebar); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                if (helpo_get_prefered_option('footer_status') == 'show') {
                    $helpo_menu_locations = get_nav_menu_locations();

                    if (isset($helpo_menu_locations['footer_menu']) && wp_get_nav_menu_object($helpo_menu_locations['footer_menu'])->count !== 0 && helpo_get_theme_mod('footer_menu_status') == 'show' || helpo_get_theme_mod('copyright') !== '' || helpo_get_prefered_option('footer_type') == 'type_2' && helpo_get_theme_mod('footer_form') !== '') {
                        ?>
                        <footer class="helpo_footer footer_<?php echo esc_attr(helpo_get_prefered_option('footer_type')); ?>">
                            <?php
                            // --- Footer Type 1 --- //
                            if (helpo_get_prefered_option('footer_type') == 'type_1') {
                                ?>
                                <div class="container">
                                    <div class="row">
                                        <?php
                                        if (helpo_get_theme_mod('copyright_status') == 'show') {
                                            if (helpo_get_theme_mod('copyright') !== '') {
                                                ?>
                                                <div class="col-sm-6 helpo_copyright_container"><?php echo helpo_get_theme_mod('copyright'); ?></div>
                                                <?php
                                            }
                                        }

                                        if (isset($helpo_menu_locations['footer_menu']) && $helpo_menu_locations['footer_menu'] !== 0 && wp_get_nav_menu_object($helpo_menu_locations['footer_menu'])->count !== 0) {
                                            if (helpo_get_theme_mod('footer_menu_status') == 'show') {
                                                ?>
                                                <div class="<?php echo ((helpo_get_theme_mod('copyright') !== '' && helpo_get_theme_mod('copyright_status') == 'show') ? 'col-sm-6' : 'col-sm-12'); ?> helpo_footer_menu_container">
                                                    <?php wp_nav_menu(array('theme_location' => 'footer_menu', 'menu_class' => 'helpo_footer_menu', 'depth' => '1', 'container' => '')); ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }

                            // --- Footer Type 2 --- //
                            if (helpo_get_prefered_option('footer_type') == 'type_2') {
                                ?>
                                <div class="helpo_footer_wrapper">
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            if (helpo_get_theme_mod('copyright_status') == 'show') {
                                                ?>
                                                <div class="col-md-6 col-xl-7 helpo_copyright_container"><?php echo helpo_get_theme_mod('copyright'); ?></div>
                                                <?php
                                            }

                                            if (helpo_get_theme_mod('footer_form') !== '') {
                                                ?>
                                                <div class="col-md-6 col-xl-5 helpo_footer_form"><?php echo do_shortcode(wp_kses(helpo_get_theme_mod('footer_form'), 'strip')); ?></div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </footer>
                        <?php
                    }
                }
            }

            ?>
        </div>
        <?php
        wp_footer(); ?>
    </body>
</html>
