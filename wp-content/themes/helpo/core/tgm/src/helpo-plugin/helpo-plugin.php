<?php
/*
Plugin Name: Helpo Plugin
Plugin URI: https://demo.artureanec.com/
Description: Register Custom Widgets and Custom Post Types for Helpo Theme.
Version: 1.5
Author: Artureanec
Author URI: https://demo.artureanec.com/
Text Domain: helpo_plugin
*/

// --- Register Custom Widgets --- //
if (!function_exists('helpo_widgets_load')) {
    function helpo_widgets_load() {
        require_once(__DIR__ . "/widgets/socials.php");
        require_once(__DIR__ . "/widgets/address.php");
        require_once(__DIR__ . "/widgets/donation.php");
        require_once(__DIR__ . "/widgets/featured-posts.php");
    }
}
add_action('plugins_loaded', 'helpo_widgets_load');

if (!function_exists('helpo_add_custom_widget')) {
    function helpo_add_custom_widget($name) {
        register_widget($name);
    }
}

// --- Register Custom Post Types --- //
if (!function_exists('helpo_register_custom_post_types')) {
    function helpo_register_custom_post_types() {
        # Events
        register_post_type('helpo-events', array(
                'label' => 'Events',
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'events',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 4,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'post-formats'
                )
            )
        );
        register_taxonomy('events-category', 'helpo-events', array('hierarchical' => true, 'label' => 'Categories', 'singular_name' => 'Category'));

        # Stories
        register_post_type('helpo-stories', array(
                'label' => 'Stories',
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'stories',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 4,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'post-formats'
                )
            )
        );
        register_taxonomy('stories-category', 'helpo-stories', array('hierarchical' => true, 'label' => 'Categories', 'singular_name' => 'Category'));

        # Causes
        register_post_type('helpo-causes', array(
                'label' => 'Causes',
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'rewrite' => array(
                    'slug' => 'causes',
                    'with_front' => false
                ),
                'hierarchical' => true,
                'menu_position' => 4,
                'supports' => array(
                    'title',
                    'editor',
                    'thumbnail',
                    'excerpt',
                    'post-formats'
                )
            )
        );
        register_taxonomy('causes-category', 'helpo-causes', array('hierarchical' => true, 'label' => 'Categories', 'singular_name' => 'Category'));
    }
}

add_action('init', 'helpo_register_custom_post_types');

/**
 * Title         : Aqua Resizer
 * Description   : Resizes WordPress images on the fly
 * Version       : 1.2.0
 * Author        : Syamil MJ
 * Author URI    : http://aquagraphite.com
 * License       : WTFPL - http://sam.zoy.org/wtfpl/
 * Documentation : https://github.com/sy4mil/Aqua-Resizer/
 *
 * @param string  $url      - (required) must be uploaded using wp media uploader
 * @param int     $width    - (required)
 * @param int     $height   - (optional)
 * @param bool    $crop     - (optional) default to soft crop
 * @param bool    $single   - (optional) returns an array if false
 * @param bool    $upscale  - (optional) resizes smaller images
 * @uses  wp_upload_dir()
 * @uses  image_resize_dimensions()
 * @uses  wp_get_image_editor()
 *
 * @return str|array
 */

if(!class_exists('Aq_Resize')) {
    class Aq_Resize
    {
        /**
         * The singleton instance
         */
        static private $instance = null;

        /**
         * No initialization allowed
         */
        private function __construct() {}

        /**
         * No cloning allowed
         */
        private function __clone() {}

        /**
         * For your custom default usage you may want to initialize an Aq_Resize object by yourself and then have own defaults
         */
        static public function getInstance() {
            if(self::$instance == null) {
                self::$instance = new self;
            }

            return self::$instance;
        }

        /**
         * Run, forest.
         */
        public function process( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
            // Validate inputs.
            if ( ! $url || ( ! $width && ! $height ) ) return false;

            // Caipt'n, ready to hook.
            if ( true === $upscale ) add_filter( 'image_resize_dimensions', array($this, 'aq_upscale'), 10, 6 );

            // Define upload path & dir.
            $upload_info = wp_upload_dir();
            $upload_dir = $upload_info['basedir'];
            $upload_url = $upload_info['baseurl'];

            $http_prefix = "http://";
            $https_prefix = "https://";

            /* if the $url scheme differs from $upload_url scheme, make them match
               if the schemes differe, images don't show up. */
            if(!strncmp($url,$https_prefix,strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
                $upload_url = str_replace($http_prefix,$https_prefix,$upload_url);
            }
            elseif(!strncmp($url,$http_prefix,strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
                $upload_url = str_replace($https_prefix,$http_prefix,$upload_url);
            }


            // Check if $img_url is local.
            if ( false === strpos( $url, $upload_url ) ) return false;

            // Define path of image.
            $rel_path = str_replace( $upload_url, '', $url );
            $img_path = $upload_dir . $rel_path;

            // Check if img path exists, and is an image indeed.
            if ( ! file_exists( $img_path ) or ! getimagesize( $img_path ) ) return false;

            // Get image info.
            $info = pathinfo( $img_path );
            $ext = $info['extension'];
            list( $orig_w, $orig_h ) = getimagesize( $img_path );

            // Get image size after cropping.
            $dims = image_resize_dimensions( $orig_w, $orig_h, $width, $height, $crop );
            $dst_w = $dims[4];
            $dst_h = $dims[5];

            // Return the original image only if it exactly fits the needed measures.
            if ( ! $dims && ( ( ( null === $height && $orig_w == $width ) xor ( null === $width && $orig_h == $height ) ) xor ( $height == $orig_h && $width == $orig_w ) ) ) {
                $img_url = $url;
                $dst_w = $orig_w;
                $dst_h = $orig_h;
            } else {
                // Use this to check if cropped image already exists, so we can return that instead.
                $suffix = "{$dst_w}x{$dst_h}";
                $dst_rel_path = str_replace( '.' . $ext, '', $rel_path );
                $destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";

                if ( ! $dims || ( true == $crop && false == $upscale && ( $dst_w < $width || $dst_h < $height ) ) ) {
                    // Can't resize, so return false saying that the action to do could not be processed as planned.
                    return false;
                }
                // Else check if cache exists.
                elseif ( file_exists( $destfilename ) && getimagesize( $destfilename ) ) {
                    $img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
                }
                // Else, we resize the image and return the new resized image url.
                else {

                    $editor = wp_get_image_editor( $img_path );

                    if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
                        return false;

                    $resized_file = $editor->save();

                    if ( ! is_wp_error( $resized_file ) ) {
                        $resized_rel_path = str_replace( $upload_dir, '', $resized_file['path'] );
                        $img_url = $upload_url . $resized_rel_path;
                    } else {
                        return false;
                    }

                }
            }

            // Okay, leave the ship.
            if ( true === $upscale ) remove_filter( 'image_resize_dimensions', array( $this, 'aq_upscale' ) );

            // Return the output.
            if ( $single ) {
                // str return.
                $image = $img_url;
            } else {
                // array return.
                $image = array (
                    0 => $img_url,
                    1 => $dst_w,
                    2 => $dst_h
                );
            }

            return $image;
        }

        /**
         * Callback to overwrite WP computing of thumbnail measures
         */
        function aq_upscale( $default, $orig_w, $orig_h, $dest_w, $dest_h, $crop ) {
            if ( ! $crop ) return null; // Let the wordpress default function handle this.

            // Here is the point we allow to use larger image size than the original one.
            $aspect_ratio = $orig_w / $orig_h;
            $new_w = $dest_w;
            $new_h = $dest_h;

            if ( ! $new_w ) {
                $new_w = intval( $new_h * $aspect_ratio );
            }

            if ( ! $new_h ) {
                $new_h = intval( $new_w / $aspect_ratio );
            }

            $size_ratio = max( $new_w / $orig_w, $new_h / $orig_h );

            $crop_w = round( $new_w / $size_ratio );
            $crop_h = round( $new_h / $size_ratio );

            $s_x = floor( ( $orig_w - $crop_w ) / 2 );
            $s_y = floor( ( $orig_h - $crop_h ) / 2 );

            return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
        }
    }
}

if(!function_exists('aq_resize')) {
    /**
     * This is just a tiny wrapper function for the class above so that there is no
     * need to change any code in your own WP themes. Usage is still the same :)
     */
    function aq_resize( $url, $width = null, $height = null, $crop = null, $single = true, $upscale = false ) {
        $aq_resize = Aq_Resize::getInstance();
        return $aq_resize->process( $url, $width, $height, $crop, $single, $upscale );
    }
}

// Init Custom Widgets for Elementor
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

final class Helpo_Custom_Widgets
{
    const  VERSION = '1.0.0';
    const  MINIMUM_ELEMENTOR_VERSION = '2.0.0';
    const  MINIMUM_PHP_VERSION = '5.4';
    private static $_instance = null;

    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action('init', [$this, 'i18n']);
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function i18n()
    {
        load_plugin_textdomain('helpo_plugin', false, plugin_basename(dirname(__FILE__)) . '/languages');
    }

    public function init()
    {
        // Check if Elementor installed and activated
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'helpo_admin_notice_missing_main_plugin']);
            return;
        }

        // Check for required Elementor version
        if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
            add_action('admin_notices', [$this, 'helpo_admin_notice_minimum_elementor_version']);
            return;
        }

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'helpo_admin_notice_minimum_php_version']);
            return;
        }

        // Include Additional Files
        add_action('elementor/init', [$this, 'helpo_include_additional_files']);

        // Add new Elementor Categories
        add_action('elementor/init', [$this, 'helpo_add_elementor_category']);

        // Register Widget Scripts
        add_action('elementor/frontend/after_register_scripts', [$this, 'helpo_register_widget_scripts']);

        add_action('wp_enqueue_scripts', function () {
            wp_localize_script('ajax_query_products', 'helpo_ajaxurl',
                array(
                    'url' => admin_url('admin-ajax.php')
                )
            );
        });

        // Register Widget Styles
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'helpo_register_widget_styles']);

        // Register New Widgets
        add_action('elementor/widgets/widgets_registered', [$this, 'helpo_widgets_register']);

        // Register Editor Styles
        add_action('elementor/editor/before_enqueue_scripts', function () {
            wp_register_style('helpo_elementor_admin', plugins_url('helpo-plugin/css/helpo_plugin_admin.css'));
            wp_enqueue_style('helpo_elementor_admin');
        });
    }


    public function helpo_admin_notice_missing_main_plugin() {
        $message = sprintf(
        /* translators: 1: Helpo Plugin 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'helpo_plugin'),
            '<strong>' . esc_html__('Helpo Plugin', 'helpo_plugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'helpo_plugin') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function helpo_admin_notice_minimum_elementor_version() {
        $message = sprintf(
        /* translators: 1: Helpo Plugin 2: Elementor 3: Required Elementor version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'helpo_plugin'),
            '<strong>' . esc_html__('Helpo Plugin', 'helpo_plugin') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'helpo_plugin') . '</strong>',
            self::MINIMUM_ELEMENTOR_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function helpo_admin_notice_minimum_php_version() {
        $message = sprintf(
        /* translators: 1: Press Elements 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'helpo_plugin'),
            '<strong>' . esc_html__('Press Elements', 'helpo_plugin') . '</strong>',
            '<strong>' . esc_html__('PHP', 'helpo_plugin') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function helpo_include_additional_files() {

    }

    public function helpo_add_elementor_category() {
        \Elementor\Plugin::$instance->elements_manager->add_category(
            'helpo_widgets',
            [
                'title' => esc_html__('Helpo Widgets', 'helpo_plugin'),
                'icon' => 'fa fa-plug',
            ],
            5 // position
        );

    }

    public function helpo_register_widget_scripts() {
        // Lib
        wp_register_script('fancybox', plugins_url('helpo-plugin/js/lib/jquery.fancybox.min.js'), array('jquery'));
        wp_register_script('slick_slider', plugins_url('helpo-plugin/js/lib/slick.min.js'), array('jquery'));
        wp_register_script('isotope', plugins_url('helpo-plugin/js/lib/isotope.pkgd.min.js'), array('jquery', 'imagesloaded'));

        // Scripts
        wp_register_script('causes_grid_widget', plugins_url('helpo-plugin/js/causes-grid-widget.js'), array('jquery', 'isotope', 'fancybox'));
        wp_register_script('causes_listing_widget', plugins_url('helpo-plugin/js/causes-listing-widget.js'), array('jquery'));
        wp_register_script('causes_slider_widget', plugins_url('helpo-plugin/js/causes-slider-widget.js'), array('jquery', 'slick_slider'));
        wp_register_script('content_slider_widget', plugins_url('helpo-plugin/js/content-slider-widget.js'), array('jquery', 'slick_slider', 'fancybox'));
        wp_register_script('tabs_widget', plugins_url('helpo-plugin/js/tabs-widget.js'), array('jquery', 'fancybox'));
        wp_register_script('testimonials_widget', plugins_url('helpo-plugin/js/testimonials-widget.js'), array('jquery', 'slick_slider'));
        wp_register_script('video_widget', plugins_url('helpo-plugin/js/video-widget.js'), array('jquery', 'fancybox'));
    }

    public function helpo_register_widget_styles() {
        // Main Widgets Styles
        wp_register_style('helpo_styles', plugins_url('helpo-plugin/css/helpo_plugin.css'));
        wp_enqueue_style('helpo_styles');

        wp_register_style('fancybox_styles', plugins_url('helpo-plugin/css/jquery.fancybox.min.css'));
        wp_enqueue_style('fancybox_styles');
    }

    public function helpo_widgets_register() {

        // --- Include Widget Files --- //
        require_once __DIR__ . '/widgets/blockquote.php';
        require_once __DIR__ . '/widgets/blog.php';
        require_once __DIR__ . '/widgets/button.php';
        require_once __DIR__ . '/widgets/cause-item.php';
        require_once __DIR__ . '/widgets/causes-grid.php';
        require_once __DIR__ . '/widgets/causes-listing.php';
        require_once __DIR__ . '/widgets/causes-slider.php';
        require_once __DIR__ . '/widgets/content-slider.php';
        require_once __DIR__ . '/widgets/donation-box.php';
        require_once __DIR__ . '/widgets/events.php';
        require_once __DIR__ . '/widgets/events-listing.php';
        require_once __DIR__ . '/widgets/gallery.php';
        require_once __DIR__ . '/widgets/heading.php';
        require_once __DIR__ . '/widgets/icon-box.php';
        require_once __DIR__ . '/widgets/image.php';
        require_once __DIR__ . '/widgets/info-box.php';
        require_once __DIR__ . '/widgets/linked-item.php';
        require_once __DIR__ . '/widgets/person.php';
        require_once __DIR__ . '/widgets/price-item.php';
        require_once __DIR__ . '/widgets/recent-posts.php';
        require_once __DIR__ . '/widgets/stories.php';
        require_once __DIR__ . '/widgets/tabs.php';
        require_once __DIR__ . '/widgets/testimonials.php';
        require_once __DIR__ . '/widgets/video.php';

        // --- Register Widgets --- //
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Blockquote_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Blog_Listing_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Button_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Cause_Item_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Causes_Grid_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Causes_Listing_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Causes_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Content_Slider_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Donation_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Events_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Events_Listing_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Gallery_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Heading_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Icon_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Image_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Info_Box_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Linked_Item_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Person_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Price_Item_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Recent_Posts_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Stories_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Tabs_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Testimonials_Widget());
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Helpo\Widgets\Helpo_Video_Widget());
    }
}

Helpo_Custom_Widgets::instance();

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'text-editor' && $section_id == 'section_editor' ){
        $section->add_control(
            'columns_number',
            [
                'label' => esc_html__('Number of Columns', 'helpo_plugin'),
                'type' => Elementor\Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('One Column', 'helpo_plugin'),
                    '2' => esc_html__('Two Columns', 'helpo_plugin'),
                    '3' => esc_html__('Three Columns', 'helpo_plugin'),
                    '4' => esc_html__('Four Columns', 'helpo_plugin')
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-text-editor' => 'column-count: {{VALUE}}'
                ]
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'alert' && $section_id == 'section_alert' ){
        $section->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Elementor\Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'helpo_plugin'),
                    'type_1' => esc_html__('View Type 1', 'helpo_plugin'),
                    'type_2' => esc_html__('View Type 2', 'helpo_plugin')
                ],
                'prefix_class' => 'helpo_view_'
            ]
        );
    }
}, 10, 3);

add_action('elementor/element/before_section_end', function( $section, $section_id, $args ) {
    if( $section->get_name() == 'accordion' && $section_id == 'section_title_style' ){
        $section->add_control(
            'view_type',
            [
                'label' => esc_html__('Background Color', 'helpo_plugin'),
                'type' => Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'background: {{VALUE}};'
                ]
            ]
        );
    }
}, 10, 3);
