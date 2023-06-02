<?php
/*
 * Created by Artureanec
*/

# General
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');
add_theme_support('post-formats', array('image', 'video'));

# Hex 2 RGB
if (!function_exists('helpo_hex2rgb')) {
    function helpo_hex2rgb($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return $r . "," . $g . "," . $b;
    }
}

# Custom get_theme_mod
if (!function_exists('helpo_get_theme_mod')) {
    function helpo_get_theme_mod($name) {
        if (func_num_args() > 1) {
            die(esc_html__('The helpo_get_theme_mod("', 'helpo') . $name . esc_html__('") function takes only one argument. Define default values in core/customizer.php.', 'helpo'));
        }

        global $helpo_customizer_default_values;

        if (!isset($helpo_customizer_default_values[$name])) {
            die(esc_html__('Error! You did not add the default value for the "', 'helpo') .$name. esc_html__('" option! core/customizer.php.', 'helpo'));
        }
        return get_theme_mod($name, $helpo_customizer_default_values[$name]);
    }
}

# ADD Localization Folder
add_action('after_setup_theme', 'helpo_pomo');
if (!function_exists('helpo_pomo')) {
    function helpo_pomo()
    {
        load_theme_textdomain('helpo', get_template_directory() . '/languages');
    }
}

require_once(get_template_directory() . "/core/init.php");

# Register CSS/JS
add_action('wp_enqueue_scripts', 'helpo_css_js');
if (!function_exists('helpo_css_js')) {
    function helpo_css_js()
    {
        # CSS
        wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
        wp_enqueue_style('helpo-font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
        wp_enqueue_style('helpo-theme', get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css');

        if (class_exists('WooCommerce')) {
            wp_enqueue_style('helpo-woocommerce', get_template_directory_uri() . '/css/woocommerce.css');
        }

        # JS
        wp_enqueue_script('helpo-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false	, true);
        wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', true, false, true);

        if (class_exists('WooCommerce')) {
            wp_enqueue_script('helpo-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', true, false, true);
        }

        if (is_singular() && comments_open()) {
            wp_enqueue_script('comment-reply');
        }

        wp_localize_script('helpo-theme', 'helpo_ajaxurl',
            array(
                'url' => esc_url(admin_url('admin-ajax.php'))
            )
        );

        global $helpo_custom_css;

        // --------------------- //
        // ------ General ------ //
        // --------------------- //
        if (helpo_get_post_option('body_bg_type') == 'alt') {
            $helpo_custom_css .= '
                body {
                    background: ' . esc_attr(helpo_get_post_option('body_alt_bg_color')) . ';
                }
            ';
        } else {
            $helpo_custom_css .= '
                body {
                    background: ' . esc_attr(helpo_get_theme_mod('site_bg_color')) . ';
                }
            ';
        }

        wp_add_inline_style('helpo-theme', $helpo_custom_css);
    }
}

# Register CSS/JS for Admin Settings
add_action('admin_enqueue_scripts', 'helpo_admin_css_js');
if (!function_exists('helpo_admin_css_js')) {
    function helpo_admin_css_js()
    {
        # CSS
        wp_enqueue_style('helpo-admin', get_template_directory_uri() . '/css/admin.css');
        # JS
        wp_enqueue_script('helpo-admin', get_template_directory_uri() . '/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'), false, true);
    }
}



# WP Footer
add_action('wp_footer', 'helpo_wp_footer');
if (!function_exists('helpo_wp_footer')) {
    function helpo_wp_footer()
    {
        helpoHelper::getInstance()->echoFooter();
    }
}

# Register Menu
add_action('init', 'helpo_register_menu');
if (!function_exists('helpo_register_menu')) {
    function helpo_register_menu()
    {
        register_nav_menus(
            array(
                'main' => esc_attr__('Main menu', 'helpo')
            )
        );

        register_nav_menus(
            array(
                'sidebar_menu' => esc_html__('Side Menu', 'helpo')
            )
        );

        register_nav_menus(
            array(
                'footer_menu' => esc_html__('Footer Menu', 'helpo')
            )
        );
    }
}


# Register Sidebars
add_action('widgets_init', 'helpo_widgets_init');
if (!function_exists('helpo_widgets_init')) {
    function helpo_widgets_init()
    {
        register_sidebar(
            array(
                'name' => esc_attr__('Sidebar', 'helpo'),
                'id' => 'sidebar',
                'description' => esc_attr__('Widgets in this area will be shown on all posts and pages.', 'helpo'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h6 class="widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 1', 'helpo'),
                'id' => 'sidebar-footer',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'helpo'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="helpo_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 2', 'helpo'),
                'id' => 'sidebar-footer-2',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'helpo'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="helpo_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_attr__('Footer Sidebar Type 3', 'helpo'),
                'id' => 'sidebar-footer-3',
                'description' => esc_attr__('Widgets in this area will be shown on footer area.', 'helpo'),
                'before_widget' => '<div id="%1$s" class="widget footer_widget %2$s"><div class="footer_widget_wrapper">',
                'after_widget' => '</div></div>',
                'before_title' => '<h6 class="helpo_footer_widget_title">',
                'after_title' => '</h6>',
            )
        );

        if (class_exists('WooCommerce')) {
            register_sidebar(
                array(
                    'name' => esc_attr__('Sidebar WooCommerce', 'helpo'),
                    'id' => 'sidebar-woocommerce',
                    'description' => esc_attr__('Widgets in this area will be shown on Woocommerce Pages.', 'helpo'),
                    'before_widget' => '<div id="%1$s" class="widget wooсommerce_widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h6 class="widget_title">',
                    'after_title' => '</h6>',
                )
            );
        }
    }
}

# RWMB check
if (!function_exists('helpo_post_options')) {
    function helpo_post_options()
    {
        if (class_exists('RWMB_Loader')) {
            return true;
        } else {
            return false;
        }
    }
}

# RWMB get option
if (!function_exists('helpo_get_post_option')) {
    function helpo_get_post_option($name, $default = false)
    {
        if (class_exists('RWMB_Loader')) {
            if (rwmb_meta($name)) {
                return rwmb_meta($name);
            } else {
                return $default;
            }
        } else {
            return $default;
        }
    }
}

# Get Preffered Option
if (!function_exists('helpo_get_prefered_option')) {
    function helpo_get_prefered_option($name)
    {
        if (func_num_args() > 1) {
            die (esc_html__('The helpo_get_prefered_option("', 'helpo') . $name . esc_html__('") function may takes only one argument.', 'helpo'));
        }

        global $helpo_customizer_default_values;

        if (!isset($helpo_customizer_default_values[$name])) {
            die (esc_html__('Error! You did not add the default value for the "', 'helpo') . $name . esc_html__('" option! core/customizer.php.', 'helpo'));
        }

        if (helpo_get_post_option($name) && helpo_get_post_option($name) !== 'default') {
            return helpo_get_post_option($name, $helpo_customizer_default_values[$name]);
        } else {
            return helpo_get_theme_mod($name);
        }
    }
}

# Get Featured Image Url
if (!function_exists('helpo_get_featured_image_url')) {
    function helpo_get_featured_image_url()
    {
        $featured_image_full_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
        if (isset($featured_image_full_url[0]) && strlen($featured_image_full_url[0]) > 0) {
            return $featured_image_full_url[0];
        } else {
            return false;
        }
    }
}

if (!function_exists('helpo_get_attachment_meta')) {
    function helpo_get_attachment_meta($attachment_id)
    {
        $attachment = get_post($attachment_id);
        return array(
            'alt' => get_post_meta($attachment->ID, '_wp_attachment_image_alt', true),
            'caption' => $attachment->post_excerpt,
            'description' => $attachment->post_content,
            'href' => get_permalink($attachment->ID),
            'src' => $attachment->guid,
            'title' => $attachment->post_title
        );
    }
}

# PRE
if (!function_exists('helpo_pre')) {
    function helpo_pre($array)
    {
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
}

# Admin Footer
add_filter('admin_footer', 'helpo_admin_footer');
if (!function_exists('helpo_admin_footer')) {
    function helpo_admin_footer()
    {
        if (strlen(get_page_template_slug())>0) {
            echo "<input type='hidden' name='' value='" . (get_page_template_slug() ? get_page_template_slug() : '') . "' class='helpo_this_template_file'>";
        }
    }
}

if (!function_exists('helpo_remove_post_format_parameter')) {
    function helpo_remove_post_format_parameter($url) {
        $url = remove_query_arg('post_format', $url);
        return $url;
    }
    add_filter('preview_post_link', 'helpo_remove_post_format_parameter', 9999);
}

if (!function_exists('helpo_objectToArray')) {
    function helpo_objectToArray ($object) {
        if(!is_object($object) && !is_array($object))
            return $object;

        return array_map('helpo_objectToArray', (array) $object);
    }
}

# Social Links Output
if (!function_exists('helpo_socials_output')) {
    function helpo_socials_output($container_class) {

        $socials_output = '<ul class="' . $container_class . '">';

        if (helpo_get_theme_mod('socials_target')) {
            $socials_target = '_blank';
        } else {
            $socials_target = '_self';
        }

        # Facebook
        if (helpo_get_theme_mod('socials_facebook') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_facebook')) . '" target="' . $socials_target . '">
                        <i class="fa fa-facebook-f"></i>
                    </a>
                </li>
            ';
        }

        # Twitter
        if (helpo_get_theme_mod('socials_twitter') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_twitter')) . '" target="' . $socials_target . '">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
            ';
        }

        # LinkedIn
        if (helpo_get_theme_mod('socials_linkedin') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_linkedin')) . '" target="' . $socials_target . '">
                        <i class="fa fa-linkedin"></i>
                    </a>
                </li>
            ';
        }

        # YouTube
        if (helpo_get_theme_mod('socials_youtube') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_youtube')) . '" target="' . $socials_target . '">
                        <i class="fa fa-youtube-play"></i>
                    </a>
                </li>
            ';
        }

        # Instagram
        if (helpo_get_theme_mod('socials_instagram') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_instagram')) . '" target="' . $socials_target . '">
                        <i class="fa fa-instagram"></i>
                    </a>
                </li>
            ';
        }

        # Pinterest
        if (helpo_get_theme_mod('socials_pinterest') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_pinterest')) . '" target="' . $socials_target . '">
                        <i class="fa fa-pinterest-p"></i>
                    </a>
                </li>
            ';
        }

        # Tumblr
        if (helpo_get_theme_mod('socials_tumbl') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_tumbl')) . '" target="' . $socials_target . '">
                        <i class="fa fa-tumblr"></i>
                    </a>
                </li>
            ';
        }

        # Flickr
        if (helpo_get_theme_mod('socials_flickr') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_flickr')) . '" target="' . $socials_target . '">
                        <i class="fa fa-flickr"></i>
                    </a>
                </li>
            ';
        }

        # VK
        if (helpo_get_theme_mod('socials_vk') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_vk')) . '" target="' . $socials_target . '">
                        <i class="fa fa-vk"></i>
                    </a>
                </li>
            ';
        }

        # Dribbble
        if (helpo_get_theme_mod('socials_dribbble') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_dribbble')) . '" target="' . $socials_target . '">
                        <i class="fa fa-dribbble"></i>
                    </a>
                </li>
            ';
        }

        # Vimeo
        if (helpo_get_theme_mod('socials_vimeo') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_vimeo')) . '" target="' . $socials_target . '">
                        <i class="fa fa-vimeo"></i>
                    </a>
                </li>
            ';
        }

        # 500px
        if (helpo_get_theme_mod('socials_500px') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_500px')) . '" target="' . $socials_target . '">
                        <i class="fa fa-500px"></i>
                    </a>
                </li>
            ';
        }

        # XING
        if (helpo_get_theme_mod('socials_xing') !== '') {
            $socials_output .= '
                <li>
                    <a href="' . esc_url(helpo_get_theme_mod('socials_xing')) . '" target="' . $socials_target . '">
                        <i class="fa fa-xing"></i>
                    </a>
                </li>
            ';
        }

        $socials_output .= '</ul>';

        return $socials_output;
    }
}

// Disable QuadMenu Styles
if (class_exists('QuadMenu')) {

    function helpo_custom_dequeue() {
        wp_dequeue_style('quadmenu-normalize');
        wp_deregister_style('quadmenu-normalize');
        wp_dequeue_style('quadmenu-widgets');
        wp_deregister_style('quadmenu-widgets');
        wp_dequeue_style('quadmenu');
        wp_deregister_style('quadmenu');
        wp_dequeue_style('quadmenu-locations');
        wp_deregister_style('quadmenu-locations');
    }

    add_action('wp_enqueue_scripts', 'helpo_custom_dequeue', 9999);
}

// Init Custom Widgets
if (function_exists('helpo_add_custom_widget')) {
    helpo_add_custom_widget('helpo_socials_widget');
    helpo_add_custom_widget('helpo_address_widget');
    helpo_add_custom_widget('helpo_donation_widget');
    helpo_add_custom_widget('helpo_featured_posts_widget');
}

// Output Code
if (!function_exists('helpo_output_code')) {
    function helpo_output_code($code) {
        return $code;
    }
}

// Page Title Block
if (!function_exists('helpo_page_title_block_output')) {
    function helpo_page_title_block_output() {
        if (helpo_get_prefered_option('title_image') == 'show') {
            if (is_home() || is_archive() || is_tag() || is_search()) {
                if (class_exists('WooCommerce')) {
                    if (is_woocommerce()) {
                        if (helpo_get_post_option('page_title_image_type') == 'alt') {
                            if (helpo_get_post_option('page_title_alt_image') !== false) {
                                foreach (helpo_get_post_option('page_title_alt_image') as $key => $image) {
                                    $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                                }
                                $helpo_js_bg_image_class = 'helpo_js_bg_image';
                            } else {
                                if (helpo_get_featured_image_url()) {
                                    $helpo_js_bg_image_class = 'helpo_js_bg_image';
                                    $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                                } else {
                                    $helpo_js_bg_image_class = '';
                                    $data_bg_image = '';
                                }
                            }
                        } else {
                            if (helpo_get_featured_image_url()) {
                                if (is_product_category()) {
                                    global $wp_query;
                                    $cat = $wp_query->get_queried_object();
                                    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                                    $thumbnail_url = wp_get_attachment_url($thumbnail_id);

                                    $helpo_js_bg_image_class = 'helpo_js_bg_image';

                                    if ($thumbnail_url !== false) {
                                        $data_bg_image = 'data-background="' . $thumbnail_url . '"';
                                    } else {
                                        $data_bg_image = 'data-background="' . helpo_get_theme_mod('woo_title_bg_image') . '"';
                                    }
                                } else {
                                    $helpo_js_bg_image_class = 'helpo_js_bg_image';
                                    $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                                }
                            } else {
                                $helpo_js_bg_image_class = '';
                                $data_bg_image = '';
                            }
                        }
                    } else {
                        $helpo_js_bg_image_class = '';
                        $data_bg_image = '';
                    }
                } else {
                    $helpo_js_bg_image_class = '';
                    $data_bg_image = '';
                }
            } else {
                if (class_exists('WooCommerce')) {
                    if (is_product()) {
                        $helpo_js_bg_image_class = '';
                        $data_bg_image = '';
                    } else {
                        if (helpo_get_post_option('page_title_image_type') == 'alt') {
                            if (helpo_get_post_option('page_title_alt_image') !== false) {
                                foreach (helpo_get_post_option('page_title_alt_image') as $key => $image) {
                                    $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                                }
                                $helpo_js_bg_image_class = 'helpo_js_bg_image';
                            } else {
                                if (helpo_get_featured_image_url()) {
                                    $helpo_js_bg_image_class = 'helpo_js_bg_image';
                                    $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                                } else {
                                    $helpo_js_bg_image_class = '';
                                    $data_bg_image = '';
                                }
                            }
                        } else {
                            if (helpo_get_featured_image_url()) {
                                $helpo_js_bg_image_class = 'helpo_js_bg_image';
                                $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                            } else {
                                $helpo_js_bg_image_class = '';
                                $data_bg_image = '';
                            }
                        }
                    }
                } else {
                    if (helpo_get_post_option('page_title_image_type') == 'alt') {
                        if (helpo_get_post_option('page_title_alt_image') !== false) {
                            foreach (helpo_get_post_option('page_title_alt_image') as $key => $image) {
                                $data_bg_image = 'data-background="' . $image['full_url'] . '"';
                            }
                            $helpo_js_bg_image_class = 'helpo_js_bg_image';
                        } else {
                            if (helpo_get_featured_image_url()) {
                                $helpo_js_bg_image_class = 'helpo_js_bg_image';
                                $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                            } else {
                                $helpo_js_bg_image_class = '';
                                $data_bg_image = '';
                            }
                        }
                    } else {
                        if (helpo_get_featured_image_url()) {
                            $helpo_js_bg_image_class = 'helpo_js_bg_image';
                            $data_bg_image = 'data-background="' . helpo_get_featured_image_url() . '"';
                        } else {
                            $helpo_js_bg_image_class = '';
                            $data_bg_image = '';
                        }
                    }
                }
            }
        } else {
            $helpo_js_bg_image_class = 'helpo_title_block_without_image';
            $data_bg_image = '';
        }

        if (helpo_get_post_option('page_title_settings') == 'custom') {
            $helpo_js_min_height_class = 'helpo_js_min_height';
            $helpo_js_bg_color_class = 'helpo_js_bg_color';
            $data_min_height = 'data-min-height=' . esc_attr(absint(helpo_get_post_option('title_height'))) . '';
            $data_bg_color = 'data-bg-color=' . esc_attr(helpo_get_post_option('title_bg_color')) . '';
        } else {
            $helpo_js_min_height_class = '';
            $helpo_js_bg_color_class = '';
            $data_min_height = '';
            $data_bg_color = '';
        }

        $helpo_title_block = '
            <div class="helpo_page_title_container ' . esc_attr($helpo_js_bg_image_class) . ' ' . esc_attr($helpo_js_min_height_class) . ' ' . esc_attr($helpo_js_bg_color_class) . '" ' . esc_attr($data_bg_image) . ' ' . esc_attr($data_min_height) . ' ' . esc_attr($data_bg_color) . '>
                <div class="container">
                    <div class="helpo_page_title_wrapper">';

                        if (helpo_get_prefered_option('site_title_status') == 'show') {
                            if (helpo_get_theme_mod('site_title_type') == 'custom') {
                                $helpo_title_block .= '
                                    <div class="helpo_site_title_container">
                                        ' . esc_html(helpo_get_theme_mod('alt_site_title')) . '
                                    </div>
                                ';
                            } else {
                                $helpo_title_block .= '
                                    <div class="helpo_site_title_container">
                                        ' . esc_html(get_bloginfo()) . '
                                    </div>
                                ';
                            }
                        }

                        if (class_exists('WooCommerce')) {
                            if (is_product()) {
                                $page_title = esc_html__('Shop ', 'helpo') . '<span>' . esc_html__('Product', 'helpo') . '</span>';
                            } else {
                                if (is_home()) {
                                    $page_title = esc_html__('Home', 'helpo');
                                } elseif (is_archive()) {
                                    if (is_tag()) {
                                        $page_title = esc_html__('Archive by Tag ', 'helpo') . esc_html(single_tag_title('', false));
                                    } elseif (is_woocommerce()) {
                                        if (is_product_category()) {
                                            global $wp_query;
                                            $cat = $wp_query->get_queried_object();

                                            $page_title = esc_html__('Shop Category', 'helpo') . ' ' .$cat->name;
                                        } else {
                                            if (helpo_get_post_option('title_type') == 'alt') {
                                                $page_title = helpo_get_post_option('alt_title');
                                            } else {
                                                $page_title = get_the_title();
                                            }
                                        }
                                    } else {
                                        $page_title = esc_html__('Archive', 'helpo');
                                    }
                                } elseif (is_search()) {
                                    $page_title = esc_html__('Search Results By ', 'helpo') . esc_html(get_search_query());
                                } else {
                                    if (helpo_get_post_option('title_type') == 'alt') {
                                        $page_title = helpo_get_post_option('alt_title');
                                    } else {
                                        $page_title = get_the_title();
                                    }
                                }
                            }
                        } else {
                            if (is_home()) {
                                $page_title = esc_html__('Home', 'helpo');
                            } elseif (is_archive()) {
                                if (is_tag()) {
                                    $page_title = esc_html__('Archive by Tag ', 'helpo') . esc_html(single_tag_title('', false));
                                } else {
                                    $page_title = esc_html__('Archive', 'helpo');
                                }
                            } elseif (is_search()) {
                                $page_title = esc_html__('Search Results By ', 'helpo') . esc_html(get_search_query());
                            } else {
                                if (helpo_get_post_option('title_type') == 'alt') {
                                    $page_title = helpo_get_post_option('alt_title');
                                } else {
                                    if (get_the_title() !== '') {
                                        $page_title = get_the_title();
                                    } else {
                                        $page_title = esc_html('Your Title', 'helpo');
                                    }
                                }
                            }
                        }


                        $helpo_title_block .= '
                        <h1 class="helpo_page_title">' . helpo_output_code($page_title) . '</h1>
                    </div>
                </div>';

                if (helpo_get_post_option('title_subtitle') !== '') {
                    $helpo_title_block .= '
                        <div class="helpo_page_subtitle">';
                            if (class_exists('WooCommerce')) {
                                if (is_product()) {
                                    $helpo_title_block .= '
                                        <span>' . esc_html(helpo_get_theme_mod('woo_prod_subtitle')) . '</span>
                                    ';
                                } else {
                                    $helpo_title_block .= '
                                        <span>' . esc_html(helpo_get_post_option('title_subtitle')) . '</span>
                                    ';
                                }
                            } else {
                                $helpo_title_block .= '
                                    <span>' . esc_html(helpo_get_post_option('title_subtitle')) . '</span>
                                ';
                            }

                            $helpo_title_block .= '
                        </div>
                    ';
                }

                $helpo_title_block .= '
            </div>
        ';

        return $helpo_title_block;
    }
}

// Single Post Media Output
if (!function_exists('helpo_post_media_output')) {
    function helpo_post_media_output()
    {
        if (helpo_post_options()) {
            if (!empty($args)) {
                extract($args);
            }

            $helpo_post_format = get_post_format();
            if (empty($helpo_post_format)) {
                $helpo_post_format = 'standard';
            }

            $helpo_media_output_code = '
                <div class="helpo_media_output_container helpo_post_format_' . esc_attr($helpo_post_format) . '">';

                    // ------------------------- //
                    // --- Post Format Image --- //
                    // ------------------------- //
                    if ($helpo_post_format == 'image') {
                        if (is_array(helpo_get_post_option('helpo_pf_images'))) {
                            $helpo_media_output_code .= '
                                <div class="helpo_owlCarousel owl-carousel owl-theme">';

                                    foreach (helpo_get_post_option('helpo_pf_images') as $key => $image) {
                                        if (helpo_get_post_option('helpo_pf_images_crop_status', 'yes') == 'yes') {
                                            if (function_exists('aq_resize')) {
                                                $helpo_media_output_code .= '<div class="item"><img src="' . aq_resize(esc_url($image['full_url']), helpo_get_post_option('helpo_pf_images_width', '1200'), helpo_get_post_option('helpo_pf_images_height', '738'), true, true, true) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                            } else {
                                                $helpo_media_output_code .= '<div><img src="' . esc_url($image['full_url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                            }
                                        } else {
                                            $helpo_media_output_code .= '<div><img src="' . esc_url($image['full_url']) . '" alt="' . esc_attr($image['alt']) . '"></div>';
                                        }
                                    }
                            
                                    $helpo_media_output_code .='
                                </div>
                            ';

                            helpoHelper::getInstance()->addJSToFooter('owl_post_formats', '
                                jQuery(".helpo_owlCarousel").on("initialized.owl.carousel", function(e) {
                                    jQuery(".helpo_owlCarousel").css("opacity", "1");
                                });
                                jQuery(".helpo_owlCarousel").owlCarousel(
                                    {
                                        items:1,
                                        lazyLoad:true,
                                        loop:true,
                                        dots:false,
                                        nav:true,
                                        navText:["", ""],
                                        autoplay:true,
                                        autoplayTimeout:5000,
                                        autoplayHoverPause:true,
                                        autoHeight:true
                                    }
                                );
                            ', 'window-load');
                        } else {
                            $helpo_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

                            if (helpo_get_featured_image_url() !== false) {
                                if (function_exists('aq_resize')) {
                                    $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . aq_resize(esc_url(helpo_get_featured_image_url()), 1200, '') . '" alt="' . esc_attr($helpo_alt_text) . '">';
                                } else {
                                    $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . esc_url(helpo_get_featured_image_url()) . '" alt="' . esc_attr($helpo_alt_text) . '">';
                                }
                            }
                        }
                    }

                    // ------------------------- //
                    // --- Post Format Video --- //
                    // ------------------------- //
                    if ($helpo_post_format == 'video') {
                        $helpo_media_output_code .= '
                            <div class="helpo_post_format_video_container" style="height: ' . helpo_get_post_option('helpo_pf_video_height', '500') . 'px;">
                                ' . helpo_get_post_option('helpo_pf_video_url') . '
                            </div>
                        ';
                    }

                    // ---------------------------- //
                    // --- Post Format Standard --- //
                    // ---------------------------- //
                    if ($helpo_post_format == 'standard') {
                        $helpo_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

                        if (helpo_get_featured_image_url() !== false) {
                            if (function_exists('aq_resize')) {
                                $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . aq_resize(esc_url(helpo_get_featured_image_url()), 1200, '', true, true, true) . '" alt="' . esc_attr($helpo_alt_text) . '">';
                            } else {
                                $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . esc_url(helpo_get_featured_image_url()) . '" alt="' . esc_attr($helpo_alt_text) . '">';
                            }
                        }
                    }

                    $helpo_media_output_code .= '
                </div>
            ';

            return $helpo_media_output_code;
        } else {
            $helpo_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
            $helpo_post_format = get_post_format();
            if (empty($helpo_post_format)) {
                $helpo_post_format = 'standard';
            }

            $helpo_media_output_code = '
                <div class="helpo_media_output_container helpo_post_format_' . esc_attr($helpo_post_format) . '">';

                    if (helpo_get_featured_image_url() !== false) {
                        if (function_exists('aq_resize')) {
                            $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . aq_resize(esc_url(helpo_get_featured_image_url()), 1200, '', true, true, true) . '" alt="' . esc_attr($helpo_alt_text) . '">';
                        } else {
                            $helpo_media_output_code .= '<img class="helpo_standard_featured_image" src="' . esc_url(helpo_get_featured_image_url()) . '" alt="' . esc_attr($helpo_alt_text) . '">';
                        }
                    }

                    $helpo_media_output_code .= '
                </div>
            ';

            return $helpo_media_output_code;
        }
    }
}

// Custom Sort Fields in Comment Form
function helpo_sort_comment_fields($fields){
    $new_fields = array();
    $myorder = array('author','email','comment');

    foreach( $myorder as $key ){
        $new_fields[ $key ] = $fields[ $key ];
        unset( $fields[ $key ] );
    }

    if( $fields )
        foreach( $fields as $key => $val )
            $new_fields[ $key ] = $val;
    return $new_fields;
}
add_filter('comment_form_fields', 'helpo_sort_comment_fields' );

// Recent Posts
if (!function_exists('helpo_recent_posts_output')) {
    function helpo_recent_posts_output($args = array('orderby' => 'rand', 'numberposts' => '2', 'post_type' => 'post', 'order' => 'desc'))
    {
        extract($args);

        $currentID = get_the_ID();
        $args = array(
            'post_type' => esc_attr($post_type),
            'post__not_in' => array($currentID),
            'post_status' => 'publish',
            'orderby' => esc_attr($orderby),
            'order' => esc_attr($order),
            'posts_per_page' => absint($numberposts),
            'ignore_sticky_posts' => 1
        );

        query_posts($args);

        if (have_posts()) {
            echo '
                <div class="helpo_recent_posts_container helpo_js_bg_color" data-bg-color="' . helpo_get_post_option('recent_posts_bg') . '">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="helpo_recent_posts_container_title">' . esc_html__('Similar', 'helpo') . ' <span>' . esc_html__('Posts', 'helpo') . '</span></h2>
                                
                                <div class="helpo_recent_posts_wrapper helpo_columns_' . esc_attr($numberposts) . '">';
                                    $i = 1;

                                    while (have_posts()) {
                                        the_post();

                                        $featured_image_url = helpo_get_featured_image_url();

                                        if (function_exists('aq_resize')) {
                                            if ($numberposts == '2') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 600, 459, true, true, true);
                                            }

                                            if ($numberposts == '3') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 400, 306, true, true, true);
                                            }

                                            if ($numberposts == '4') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 300, 230, true, true, true);
                                            }
                                        } else {
                                            $featured_image_src = $featured_image_url;
                                        }

                                        if ($numberposts == '2') {
                                            $featured_post_excerpt = substr(get_the_excerpt(), 0, 200);
                                        }

                                        if ($numberposts == '3') {
                                            $featured_post_excerpt = substr(get_the_excerpt(), 0, 120);
                                        }

                                        if ($numberposts == '4') {
                                            $featured_post_excerpt = substr(get_the_excerpt(), 0, 200);
                                        }

                                        echo '
                                            <div class="helpo_recent_post helpo_post_' . $i . '">
                                                <div class="helpo_recent_post_wrapper">
                                                    <div class="helpo_recent_post_inner">';

                                                        if ($featured_image_src !== false) {
                                                            echo '
                                                                <div class="helpo_recent_post_image_cont">
                                                                    <img src="' . esc_url($featured_image_src) . '" alt="' . esc_attr(get_the_title()) . '" />
                                                                </div>
                                                            ';
                                                        }

                                                        echo '
                                                        <div class="helpo_recent_post_content_cont">
                                                            <div class="helpo_recent_post_category_cont">';
                                                                foreach (get_the_category() as $category) {
                                                                    echo '<span>' . esc_attr($category->name) . '</span>';
                                                                }
                                                                echo '
                                                            </div>
                                                            
                                                            <h6 class="helpo_recent_post_title">
                                                                <a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a>
                                                            </h6>
                                                            
                                                            <p class="helpo_recent_post_excerpt">' . esc_html($featured_post_excerpt) . '</p>
                                                            
                                                            <div class="helpo_recent_post_meta">
                                                                <div class="helpo_recent_post_date">' . get_the_date() . '</div>
                                                                
                                                                <div class="helpo_recent_post_comment_count">
                                                                    <svg class="icon">
                                                                        <svg viewBox="0 0 510 510" id="comment-' . mt_rand(0, 99999) . '" xmlns="http://www.w3.org/2000/svg">
                                                                            <path d="M459 0H51C22.95 0 0 22.95 0 51v459l102-102h357c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51z"></path>
                                                                        </svg>
                                                                    </svg>
                                                                    ' . get_comments_number('0', '1', '%') . '
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        ';

                                        $i++;
                                    }

                                    wp_reset_query();

                                    echo '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            ';
        }
    }
}

// Init Elementor for Custom Post Types
function helpo_init_elementor_for_events_post_type()
{
    add_post_type_support('helpo-events', 'elementor');
}

add_action('init', 'helpo_init_elementor_for_events_post_type');

function helpo_init_elementor_for_stories_post_type()
{
    add_post_type_support('helpo-stories', 'elementor');
}

add_action('init', 'helpo_init_elementor_for_stories_post_type');

function helpo_init_elementor_for_causes_post_type()
{
    add_post_type_support('helpo-causes', 'elementor');
}

add_action('init', 'helpo_init_elementor_for_causes_post_type');

# Shop Classes
if (!function_exists('helpo_shop_classes')) {
    function helpo_shop_classes($helpo_classes)
    {
//        $helpo_classes = '';

        if (class_exists('WooCommerce')) {
            if (is_shop()) {
                $helpo_classes[] = 'helpo_shop_list_page';
            } elseif (is_product()) {
                $helpo_classes[] = 'helpo_single_product_page';
            }
        }

        return $helpo_classes;
    }
}

add_filter('body_class', 'helpo_shop_classes');

# Post Classes
if (!function_exists('helpo_post_classes')) {
    function helpo_post_classes($helpo_post_classes) {
        return $helpo_post_classes;

//        var_dump($helpo_post_classes);
    }
}

add_filter('post_class', 'helpo_post_classes');

# WooCommerce
if (class_exists('WooCommerce')) {
    add_theme_support('woocommerce');
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-zoom' );

    # Update the Header Cart
    add_filter('woocommerce_add_to_cart_fragments', 'helpo_header_add_to_cart_fragment');

    function helpo_header_add_to_cart_fragment ($fragments) {
        ob_start();
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
        $fragments['a.helpo_header_cart'] = ob_get_clean();

        return $fragments;
    }
}

// Set Give Plugin Default Settings
if ( class_exists('Give') ) {
    if ( !function_exists('helpo_set_give_plugin_defaults') ) {
        function helpo_set_give_plugin_defaults() {
            give_update_option( 'the_content_filter', 'disabled' );
            give_update_option( 'disable_the_content_filter', 'on' );
        }
    }
    add_action( 'admin_init', 'helpo_set_give_plugin_defaults' );
}
