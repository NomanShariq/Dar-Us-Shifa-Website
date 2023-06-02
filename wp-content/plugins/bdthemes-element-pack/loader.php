<?php

namespace ElementPack;

use Elementor\Plugin;
use ElementPack\Includes\Element_Pack_WPML;

use ElementPack\SVG_Support\SVG_Support;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

/**
 * Main class for element pack
 */
class Element_Pack_Loader {

	/**
	 * @var Element_Pack_Loader
	 */
	private static $_instance;

	/**
	 * @var Manager
	 */
	private $_modules_manager;

	private $classes_aliases = [
		'ElementPack\Modules\PanelPostsControl\Module'                       => 'ElementPack\Modules\QueryControl\Module',
		'ElementPack\Modules\PanelPostsControl\Controls\Group_Control_Posts' => 'ElementPack\Modules\QueryControl\Controls\Group_Control_Posts',
		'ElementPack\Modules\PanelPostsControl\Controls\Query'               => 'ElementPack\Modules\QueryControl\Controls\Query',
	];

	public $elements_data = [
		'sections' => [],
		'columns'  => [],
		'widgets'  => [],
	];

	/**
	 * @return string
	 * @deprecated
	 *
	 */
	public function get_version() {
		return BDTEP_VER;
	}

	/**
	 * return active theme
	 */
	public function get_theme() {
		return wp_get_theme();
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'bdthemes-element-pack'), '1.6.0');
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'bdthemes-element-pack'), '1.6.0');
	}

	/**
	 * @return Plugin
	 */

	public static function elementor() {
		return Plugin::$instance;
	}

	/**
	 * @return Element_Pack_Loader
	 */
	public static function instance() {
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}


	/**
	 * we loaded module manager + admin php from here
	 * @return [type] [description]
	 */
	private function _includes() {

		$live_copy            = element_pack_option('live_copy', 'element_pack_other_settings', 'off');
		$essential_shortcodes = element_pack_option('essential_shortcodes', 'element_pack_other_settings', 'off');
		$template_library     = element_pack_option('template_library', 'element_pack_other_settings', 'off');

		// Dynamic Select control
		require BDTEP_INC_PATH . 'controls/select-input/dynamic-select-input-module.php';
		require BDTEP_INC_PATH . 'controls/select-input/dynamic-select.php';
		// Global Controls
		require_once BDTEP_PATH . 'traits/global-widget-controls.php';
		require_once BDTEP_PATH . 'traits/global-swiper-controls.php';
		require_once BDTEP_PATH . 'traits/global-mask-controls.php';


		// json upload support for wordpress
		require BDTEP_INC_PATH . 'class-json-file-upload-control.php';
		// svg support for full wordpress site
		require BDTEP_INC_PATH . 'class-svg-support.php';
		// All modules loading from here
		require BDTEP_INC_PATH . 'modules-manager.php';
		// wpml compatibility class for wpml support
		require BDTEP_INC_PATH . 'class-elements-wpml-compatibility.php';
		// For changelog file parse
		require BDTEP_INC_PATH . 'class-parsedown.php';

		// Live copy paste from demo website
		if ($live_copy == 'on') {
			require BDTEP_INC_PATH . 'live-copy/class-live-copy.php';
		}

		// register the elementor template loading widget in widgets
		require BDTEP_INC_PATH . 'widgets/elementor-template.php';

		// Facebook access token generator control for editor
		require BDTEP_INC_PATH . 'class-fb-access-token-generator-control.php';

		require BDTEP_INC_PATH . 'class-google-recaptcha.php';

		// Shortcode loader for works some essential shortcode that need for any purpose
		if ($essential_shortcodes == 'on') {
			require BDTEP_INC_PATH . 'shortcodes/shortcode-loader.php';
		}

		// Rooten theme header footer compatibility
		if ('Rooten' === $this->get_theme()->name or 'Rooten' === $this->get_theme()->parent_theme) {
			if (!class_exists('RootenCustomTemplate')) {
				require BDTEP_INC_PATH . 'class-rooten-theme-compatibility.php';
			}
		}

		// editor template library
		if (!defined('BDTEP_CH') and $template_library == 'on') {
			require(BDTEP_INC_PATH . 'template-library/editor/init.php');
		}

		if (is_admin()) {
			if (!defined('BDTEP_CH')) {
				require BDTEP_INC_PATH . 'admin.php';
				// element pack admin settings here
				require(BDTEP_INC_PATH . 'admin-settings.php');

				if (!defined('BDTEP_CH') and $template_library == 'on') {
					require(BDTEP_INC_PATH . 'template-library/template-library-base.php');
					require(BDTEP_INC_PATH . 'template-library/editor/manager/api.php');
				}

				// Load admin class for admin related content process
				new Admin();
			}
		}
	}

	/**
	 * Autoloader function for all classes files
	 *
	 * @param  [type] class [description]
	 *
	 * @return [type]        [description]
	 */
	public function autoload($class) {
		if (0 !== strpos($class, __NAMESPACE__)) {
			return;
		}

		$has_class_alias = isset($this->classes_aliases[$class]);

		// Backward Compatibility: Save old class name for set an alias after the new class is loaded
		if ($has_class_alias) {
			$class_alias_name = $this->classes_aliases[$class];
			$class_to_load    = $class_alias_name;
		} else {
			$class_to_load = $class;
		}

		if (!class_exists($class_to_load)) {
			$filename = strtolower(
				preg_replace(
					['/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/'],
					['', '$1-$2', '-', DIRECTORY_SEPARATOR],
					$class_to_load
				)
			);
			$filename = BDTEP_PATH . $filename . '.php';

			if (is_readable($filename)) {
				include($filename);
			}
		}

		if ($has_class_alias) {
			class_alias($class_alias_name, $class);
		}
	}

	/**
	 * Register all script that need for any specific widget on call basis.
	 * @return [type] [description]
	 */
	public function register_site_scripts() {

		$suffix       = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$api_settings = get_option('element_pack_api_settings');
		//$widget_settings         = get_option( 'element_pack_active_modules' );

		$lottie_image              = element_pack_option('lottie-image', 'element_pack_active_modules', 'off');
		$lottie_icon_box           = element_pack_option('lottie-icon-box', 'element_pack_active_modules', 'off');
		$social_share              = element_pack_option('social-share', 'element_pack_active_modules', 'on');
		$progress_pie              = element_pack_option('progress-pie', 'element_pack_active_modules', 'on');
		$animated_heading          = element_pack_option('animated-heading', 'element_pack_active_modules', 'on');
		$qrcode                    = element_pack_option('qrcode', 'element_pack_active_modules', 'on');
		$barcode                   = element_pack_option('barcode', 'element_pack_active_modules', 'on');
		$video_player              = element_pack_option('video-player', 'element_pack_active_modules', 'off');
		$audio_player              = element_pack_option('audio-player', 'element_pack_active_modules', 'off');
		$circle_menu               = element_pack_option('circle-menu', 'element_pack_active_modules', 'on');
		$cookie_consent            = element_pack_option('cookie-consent', 'element_pack_active_modules', 'on');
		$dark_mode                 = element_pack_option('dark-mode', 'element_pack_active_modules', 'off');
		$user_register             = element_pack_option('user-register', 'element_pack_active_modules', 'on');
		$user_login                = element_pack_option('user-login', 'element_pack_active_modules', 'on');
		$contact_form              = element_pack_option('contact-form', 'element_pack_active_modules', 'on');
		$chart                     = element_pack_option('chart', 'element_pack_active_modules', 'on');
		$advanced_gmap             = element_pack_option('advanced-gmap', 'element_pack_active_modules', 'on');
		$open_street_map           = element_pack_option('open-street-map', 'element_pack_active_modules', 'on');
		$table_of_content          = element_pack_option('table-of-content', 'element_pack_active_modules', 'off');
		$image_magnifier           = element_pack_option('image-magnifier', 'element_pack_active_modules', 'on');
		$table                     = element_pack_option('table', 'element_pack_active_modules', 'off');
		$timeline                  = element_pack_option('timeline', 'element_pack_active_modules', 'on');
		$scrollnav                 = element_pack_option('scrollnav', 'element_pack_active_modules', 'on');
		$price_table               = element_pack_option('price-table', 'element_pack_active_modules', 'on');
		$marker                    = element_pack_option('marker', 'element_pack_active_modules', 'on');
		$logo_grid                 = element_pack_option('logo-grid', 'element_pack_active_modules', 'off');
		$logo_carousel             = element_pack_option('logo-carousel', 'element_pack_active_modules', 'off');
		$iconnav                   = element_pack_option('iconnav', 'element_pack_active_modules', 'on');
		$helpdesk                  = element_pack_option('helpdesk', 'element_pack_active_modules', 'on');
		$post_gallery              = element_pack_option('post-gallery', 'element_pack_active_modules', 'on');
		$custom_gallery            = element_pack_option('custom-gallery', 'element_pack_active_modules', 'on');
		$advanced_image_gallery    = element_pack_option('advanced-image-gallery', 'element_pack_active_modules', 'on');
		$video_gallery             = element_pack_option('video-gallery', 'element_pack_active_modules', 'off');
		$threesixty_product_viewer = element_pack_option('threesixty-product-viewer', 'element_pack_active_modules', 'on');
		$post_grid_tab             = element_pack_option('post-grid-tab', 'element_pack_active_modules', 'on');
		$iframe                    = element_pack_option('iframe', 'element_pack_active_modules', 'off');
		$slideshow                 = element_pack_option('slideshow', 'element_pack_active_modules', 'on');
		$reading_progress          = element_pack_option('reading-progress', 'element_pack_active_modules', 'off');
		$source_code               = element_pack_option('source-code', 'element_pack_active_modules', 'off');
		$advanced_counter          = element_pack_option('advanced-counter', 'element_pack_active_modules', 'off');
		$time_zone                 = element_pack_option('time-zone', 'element_pack_active_modules', 'off');
		$business_hours            = element_pack_option('business-hours', 'element_pack_active_modules', 'off');
		$honeycombs                = element_pack_option('honeycombs', 'element_pack_active_modules', 'off');
		$image_compare             = element_pack_option('image-compare', 'element_pack_active_modules', 'on');
		$interactive_card          = element_pack_option('interactive-card', 'element_pack_active_modules', 'off');
		$image_expand              = element_pack_option('image-expand', 'element_pack_active_modules', 'off');
		$tags_cloud                = element_pack_option('tags-cloud', 'element_pack_active_modules', 'off');
		$vertical_menu             = element_pack_option('vertical-menu', 'element_pack_active_modules', 'off');
		$wc_products               = element_pack_option('wc_products', 'element_pack_third_party_widget', 'on');
		$testimonial_grid          = element_pack_option('testimonial-grid', 'element_pack_third_party_widget', 'on');
		$calendly                  = element_pack_option('calendly', 'element_pack_third_party_widget', 'on');
		$total_count               = element_pack_option('total-count', 'element_pack_active_modules', 'on');
		$portfolio_list            = element_pack_option('portfolio-list', 'element_pack_third_party_widget', 'on');
		$portfolio_gallery         = element_pack_option('portfolio-gallery', 'element_pack_third_party_widget', 'on');
		$portfolio_carousel        = element_pack_option('portfolio-carousel', 'element_pack_third_party_widget', 'on');
		$tutor_lms_course_grid     = element_pack_option('tutor-lms-course-grid', 'element_pack_third_party_widget', 'on');
		$widget_tooltip_show       = element_pack_option('widget_tooltip_show', 'element_pack_elementor_extend', 'off');
		$section_particles_show    = element_pack_option('section-particles-show', 'element_pack_elementor_extend', 'on');
		$image_parallax            = element_pack_option('section_parallax_content_show', 'element_pack_elementor_extend', 'on');
		$floating_effects          = element_pack_option('widget_floating_show', 'element_pack_elementor_extend', 'off');
		$panel_slider          	   = element_pack_option('panel-slider', 'element_pack_active_modules', 'on');
		$confetti_effects          = element_pack_option('widget_confetti_show', 'element_pack_elementor_extend', 'off');
		$advanced_calculator       = element_pack_option('advanced-calculator', 'element_pack_active_modules', 'off');
		$image_stack       		   = element_pack_option('image-stack', 'element_pack_active_modules', 'off');
		// $tileScroll                = element_pack_option('section_tile_scroll_show', 'element_pack_elementor_extend', 'on');

		if ('on' === $social_share) {
			wp_register_script('goodshare', BDTEP_ASSETS_URL . 'vendor/js/goodshare' . $suffix . '.js', ['jquery'], '4.1.2', true);
		}
		if ('on' === $progress_pie) {
			wp_register_script('aspieprogress', BDTEP_ASSETS_URL . 'vendor/js/jquery-asPieProgress' . $suffix . '.js', ['jquery'], '0.4.7', true);
		}
		if ('on' === $animated_heading) {
			wp_register_script('morphext', BDTEP_ASSETS_URL . 'vendor/js/morphext' . $suffix . '.js', ['jquery'], '2.4.7', true);
			wp_register_script('typed', BDTEP_ASSETS_URL . 'vendor/js/typed' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $qrcode) {
			wp_register_script('qrcode', BDTEP_ASSETS_URL . 'vendor/js/jquery-qrcode' . $suffix . '.js', ['jquery'], '0.14.0', true);
		}
		if ('on' === $barcode) {
			wp_register_script('jsBarcode', BDTEP_ASSETS_URL . 'vendor/js/jsBarcode' . $suffix . '.js', null, 'v3.11.5', true);
		}
		if ('on' === $video_player or 'on' === $audio_player) {
			wp_register_script('jplayer', BDTEP_ASSETS_URL . 'vendor/js/jquery.jplayer' . $suffix . '.js', ['jquery'], '2.9.2', true);
		}
		if ('on' === $circle_menu) {
			wp_register_script('circle-menu', BDTEP_ASSETS_URL . 'vendor/js/jQuery.circleMenu' . $suffix . '.js', ['jquery'], '0.1.1', true);
		}
		if ('on' === $cookie_consent) {
			wp_register_script('cookieconsent', BDTEP_ASSETS_URL . 'vendor/js/cookieconsent' . $suffix . '.js', ['jquery'], '3.1.0', true);
		}
		if ('on' === $post_grid_tab) {
			wp_register_script('gridtab', BDTEP_ASSETS_URL . 'vendor/js/gridtab' . $suffix . '.js', ['jquery'], '2.1.1', true);
		}
		if ('on' === $dark_mode) {
			wp_register_script('darkmode', BDTEP_ASSETS_URL . 'vendor/js/darkmode' . $suffix . '.js', ['jquery'], '1.1.1', true);
		}
		if ('on' === $user_register or 'on' === $user_login or 'on' === $contact_form) {
			wp_register_script('recaptcha', 'https://www.google.com/recaptcha/api.js', ['jquery'], null, true);
		}
		if ('on' === $chart) {
			wp_register_script('chart', BDTEP_ASSETS_URL . 'vendor/js/chart' . $suffix . '.js', ['jquery'], '2.7.3', true);
		}
		if ('on' === $advanced_gmap) {
			if (!empty($api_settings['google_map_key'])) {
				wp_register_script('gmap-api', '//maps.googleapis.com/maps/api/js?key=' . $api_settings['google_map_key'], ['jquery'], null, true);
			} else {
				wp_register_script('gmap-api', '//maps.google.com/maps/api/js?sensor=true', ['jquery'], null, true);
			}
			wp_register_script('gmap', BDTEP_ASSETS_URL . 'vendor/js/gmap' . $suffix . '.js', ['jquery', 'gmap-api'], null, true);
		}
		if ('on' === $open_street_map) {
			wp_register_script('leaflet', BDTEP_ASSETS_URL . 'vendor/js/leaflet' . $suffix . '.js', ['jquery'], '', true);
		}
		if ('on' === $image_parallax or 'on' === $panel_slider) {
			wp_register_script('bdt-parallax', BDTEP_ASSETS_URL . 'vendor/js/parallax' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $section_particles_show) {
			wp_register_script('particles', BDTEP_ASSETS_URL . 'vendor/js/particles' . $suffix . '.js', ['jquery'], '2.0.0', true);
		}
		if ('on' === $table_of_content) {
			wp_register_script('table-of-content', BDTEP_ASSETS_URL . 'vendor/js/table-of-content' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $image_magnifier) {
			wp_register_script('imagezoom', BDTEP_ASSETS_URL . 'vendor/js/jquery.imagezoom' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $wc_products or 'on' === $table) {
			wp_register_script('datatables', BDTEP_ASSETS_URL . 'vendor/js/datatables' . $suffix . '.js', ['jquery'], null, true);
			wp_register_script('datatables-uikit', BDTEP_ASSETS_URL . 'vendor/js/datatables.uikit' . $suffix . '.js', ['jquery', 'datatables'], null, true);
		}
		if ('on' === $timeline) {
			wp_register_script('timeline', BDTEP_ASSETS_URL . 'vendor/js/timeline' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $scrollnav or 'on' === $price_table or 'on' === $marker or 'on' === $logo_grid or 'on' === $logo_carousel or 'on' === $iconnav or 'on' === $helpdesk or 'on' === $widget_tooltip_show or 'on' === $image_stack) {
			wp_register_script('popper', BDTEP_ASSETS_URL . 'vendor/js/popper' . $suffix . '.js', ['jquery'], null, true);
			wp_register_script('tippyjs', BDTEP_ASSETS_URL . 'vendor/js/tippy.all' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $testimonial_grid or 'on' === $post_gallery or 'on' === $custom_gallery or 'on' === $advanced_image_gallery or 'on' === $portfolio_list or 'on' === $portfolio_gallery or 'on' === $portfolio_carousel or 'on' === $tutor_lms_course_grid) {
			wp_register_script('tilt', BDTEP_ASSETS_URL . 'vendor/js/vanilla-tilt' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $video_gallery) {
			wp_register_script('rvslider', BDTEP_ASSETS_URL . 'vendor/js/rvslider' . $suffix . '.js', ['jquery'], null, true);
		}
		if ('on' === $threesixty_product_viewer) {
			wp_register_script('spritespin', BDTEP_ASSETS_URL . 'vendor/js/spritespin' . $suffix . '.js', ['jquery'], '4.0.5', true);
		}
		if ('on' === $post_grid_tab or 'on' === $iframe) {
			wp_register_script('recliner', BDTEP_ASSETS_URL . 'vendor/js/recliner' . $suffix . '.js', ['jquery'], '0.2.2', true);
		}
		if ('on' === $advanced_image_gallery) {
			wp_register_script('ep-justified-gallery', BDTEP_ASSETS_URL . 'vendor/js/jquery.justifiedGallery' . $suffix . '.js', ['jquery'], '1.0.0', true);
		}
		if ('on' === $lottie_image or 'on' === $lottie_icon_box) {
			wp_register_script('lottie', BDTEP_ASSETS_URL . 'vendor/js/lottie' . $suffix . '.js', [], '5.6.10', true);
		}
		if ('on' === $slideshow) {
			wp_register_script('thumbnail-scroller', BDTEP_ASSETS_URL . 'vendor/js/jquery.mThumbnailScroller' . $suffix . '.js', ['jquery'], '2.0.2', true);
		}
		if ('on' === $reading_progress) {
			wp_register_script('progressHorizontal', BDTEP_ASSETS_URL . 'vendor/js/jquery.progressHorizontal' . $suffix . '.js', ['jquery'], '2.0.2', true);
			wp_register_script('progressScroll', BDTEP_ASSETS_URL . 'vendor/js/jquery.progressScroll' . $suffix . '.js', ['jquery'], '2.0.2', true);
		}
		if ('on' === $source_code) {
			wp_register_script('prism', BDTEP_ASSETS_URL . 'vendor/js/prism' . $suffix . '.js', [], '1.17.1', true);
		}
		if ('on' === $advanced_counter or 'on' === $total_count) {
			wp_register_script('advanced-counter', BDTEP_ASSETS_URL . 'vendor/js/countUp' . $suffix . '.js', ['jquery'], '2.0.4', true);
		}
		if ('on' === $time_zone or 'on' === $business_hours) {
			wp_register_script('jclock', BDTEP_ASSETS_URL . 'vendor/js/jquery.jclock' . $suffix . '.js', ['jquery'], '0.0.1', true);
		}
		if ('on' === $honeycombs) {
			wp_register_script('honeycombs', BDTEP_ASSETS_URL . 'vendor/js/jquery.honeycombs' . $suffix . '.js', ['jquery'], '0.0.1', true);
		}
		if ('on' === $image_compare) {
			wp_register_script('image-compare-viewer', BDTEP_ASSETS_URL . 'vendor/js/image-compare-viewer' . $suffix . '.js', ['jquery'], '0.0.1', true);
		}
		if ('on' === $interactive_card or 'on' === $image_expand or 'on' === $animated_heading) {
			wp_register_script('gsap', BDTEP_ASSETS_URL . 'vendor/js/gsap' . $suffix . '.js', [], '3.3.0', true);
		}
		if ('on' === $image_expand or 'on' === $animated_heading) {
			wp_register_script('split-text', BDTEP_ASSETS_URL . 'vendor/js/SplitText' . $suffix . '.js', ['gsap'], '3.3.0', true);
		}
		if ('on' === $interactive_card) {
			wp_register_script('wavify', BDTEP_ASSETS_URL . 'vendor/js/wavify' . $suffix . '.js', ['gsap'], '0.0.1', true);
		}
		if ('on' === $tags_cloud) {
			wp_register_script('tags-cloud', BDTEP_ASSETS_URL . 'vendor/js/awesomeCloud' . $suffix . '.js', [], '0.2', true);
			wp_register_script('tags-exCanvas', BDTEP_ASSETS_URL . 'vendor/js/jquery.tagcanvas' . $suffix . '.js', [], '2.9', true);
		}
		if ('on' === $video_player) {
			wp_register_script('ep-video-player', BDTEP_ASSETS_URL . 'js/widget/ep-video-player' . $suffix . '.js', [], '2.9', true);
		}
		if ('on' === $vertical_menu) {
			wp_register_script('metis-menu', BDTEP_ASSETS_URL . 'vendor/js/metisMenu' . $suffix . '.js', [], '3.0.6', true);
		}

		if ('on' === $calendly) {
			wp_register_script('calendly', BDTEP_ASSETS_URL . 'vendor/js/calendly' . $suffix . '.js', ['jquery'], '0.0.1', true);
		}

		if ('on' === $floating_effects) {
			wp_register_script('anime', BDTEP_ASSETS_URL . 'vendor/js/anime.min.js', [], '3.2.1', true);
		}

		if ('on' === $confetti_effects) {
			wp_register_script('confetti', BDTEP_ASSETS_URL . 'vendor/js/confetti.browser' . $suffix . '.js', '5.3.5', true);
		}

		if ('on' === $advanced_calculator) {
			wp_register_script('jstat', BDTEP_ASSETS_URL . 'vendor/js/jstat' . $suffix . '.js', '1.9.2', true);
			wp_register_script('formula', BDTEP_ASSETS_URL . 'vendor/js/formula' . $suffix . '.js', '2.9.2', true);
		}
	}

	public function register_site_styles() {
		$direction_suffix    = is_rtl() ? '.rtl' : '';
		$wc_products         = element_pack_option('wc_products', 'element_pack_third_party_widget', 'on');
		$table               = element_pack_option('table', 'element_pack_active_modules', 'off');
		$image_magnifier     = element_pack_option('image-magnifier', 'element_pack_active_modules', 'on');
		$slideshow           = element_pack_option('slideshow', 'element_pack_active_modules', 'on');
		$widget_tooltip_show = element_pack_option('widget_tooltip_show', 'element_pack_elementor_extend', 'off');

		wp_register_style('ep-all-styles', BDTEP_URL . 'assets/css/ep-all-styles' . $direction_suffix . '.css', [], BDTEP_VER);

		// third party widget css
		if ('on' === $wc_products or 'on' === $table) {
			wp_register_style('datatables', BDTEP_ASSETS_URL . 'css/datatables' . $direction_suffix . '.css', [], BDTEP_VER);
			wp_register_style('datatables-uikit', BDTEP_ASSETS_URL . 'css/datatables.uikit' . $direction_suffix . '.css', [], BDTEP_VER);
		}
		if ('on' === $image_magnifier) {
			wp_register_style('imagezoom', BDTEP_ASSETS_URL . 'css/imagezoom' . $direction_suffix . '.css', [], BDTEP_VER);
		}
		if ('on' === $slideshow) {
			wp_register_style('mThumbnailScroller', BDTEP_ASSETS_URL . 'css/jquery-mThumbnailScroller' . $direction_suffix . '.css', [], BDTEP_VER);
		}
		//if ('on' === $scrollnav or 'on' === $price_table or 'on' === $marker or 'on' === $logo_grid or 'on' === $logo_carousel or 'on' === $iconnav or 'on' === $helpdesk or 'on' === $widget_tooltip_show) {
		wp_register_style('tippy', BDTEP_ASSETS_URL . 'css/tippy' . $direction_suffix . '.css', [], BDTEP_VER);
		//}

		wp_register_style('element-pack-font', BDTEP_ASSETS_URL . 'css/element-pack-font' . $direction_suffix . '.css', [], BDTEP_VER);
	}

	/**
	 * Loading site related style from here.
	 * @return [type] [description]
	 */
	public function enqueue_site_styles() {

		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_enqueue_style('bdt-uikit', BDTEP_ASSETS_URL . 'css/bdt-uikit' . $direction_suffix . '.css', [], '3.7.2');
		wp_enqueue_style('element-pack-site', BDTEP_ASSETS_URL . 'css/element-pack-site' . $direction_suffix . '.css', [], BDTEP_VER);
	}


	/**
	 * Loading site related script that needs all time such as uikit.
	 * @return [type] [description]
	 */
	public function enqueue_site_scripts() {

		$suffix           = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$floating_effects = element_pack_option('widget_floating_show', 'element_pack_elementor_extend', 'off');
		$section_particles_show    = element_pack_option('section-particles-show', 'element_pack_elementor_extend', 'on');
		$confetti = element_pack_option('widget_confetti_show', 'element_pack_elementor_extend', 'off');

		wp_enqueue_script('bdt-uikit', BDTEP_ASSETS_URL . 'js/bdt-uikit' . $suffix . '.js', ['jquery'], '3.7.2');
		wp_enqueue_script(
			'element-pack-site',
			BDTEP_ASSETS_URL . 'js/element-pack-site' . $suffix . '.js',
			[
				'jquery',
				'elementor-frontend'
			],
			BDTEP_VER,
			true
		); // tooltip file should be separate

		if (Element_Pack_Loader::elementor()->preview->is_preview_mode() || Element_Pack_Loader::elementor()->editor->is_edit_mode()) {
			if ('on' === $floating_effects) {
				wp_enqueue_script('anime');
			}
			if ('on' === $section_particles_show) {
				wp_enqueue_script('particles');
			}
			if ('on' === $confetti) {
				wp_enqueue_script('confetti');
			}
		}

		$script_config = [
			'ajaxurl'       => admin_url('admin-ajax.php'),
			'nonce'         => wp_create_nonce('element-pack-site'),
			'data_table'    => [
				'language' => [
					'lengthMenu' => sprintf(esc_html_x('Show %1s Entries', 'DataTable String', 'bdthemes-element-pack'), '_MENU_'),
					'info'       => sprintf(esc_html_x('Showing %1s to %2s of %3s entries', 'DataTable String', 'bdthemes-element-pack'), '_START_', '_END_', '_TOTAL_'),
					'search'     => esc_html_x('Search :', 'DataTable String', 'bdthemes-element-pack'),
					'paginate'   => [
						'previous' => esc_html_x('Previous', 'DataTable String', 'bdthemes-element-pack'),
						'next'     => esc_html_x('Next', 'DataTable String', 'bdthemes-element-pack'),
					],
				],
			],
			'contact_form'  => [
				'sending_msg' => esc_html_x('Sending message please wait...', 'Contact Form String', 'bdthemes-element-pack'),
				'captcha_nd'  => esc_html_x('Invisible captcha not defined!', 'Contact Form String', 'bdthemes-element-pack'),
				'captcha_nr'  => esc_html_x('Could not get invisible captcha response!', 'Contact Form String', 'bdthemes-element-pack'),

			],
			'mailchimp'     => [
				'subscribing' => esc_html_x('Subscribing you please wait...', 'Mailchimp String', 'bdthemes-element-pack'),
			],
			'elements_data' => $this->elements_data,
		];


		// localize for user login widget ajax login script

		// if (!defined('ICL_LANGUAGE_CODE')) {
		// 	define('ICL_LANGUAGE_CODE', null);
		// }
		// ICL_LANGUAGE_CODE = '';
		// TODO Language dynamic for ajax call

		wp_localize_script(
			'bdt-uikit',
			'element_pack_ajax_login_config',
			array(
				'ajaxurl'        => admin_url('admin-ajax.php'),
				'language' 		 => substr(get_locale(), 0, 2),
				'loadingmessage' => esc_html_x('Sending user info, please wait...', 'User Login and Register', 'bdthemes-element-pack'),
				'unknownerror'   => esc_html_x('Unknown error, make sure access is correct!', 'User Login and Register', 'bdthemes-element-pack'),
			)
		);

		$script_config = apply_filters('element_pack/frontend/localize_settings', $script_config);

		// TODO for editor script
		wp_localize_script('bdt-uikit', 'ElementPackConfig', $script_config);
	}

	public function enqueue_editor_scripts() {

		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script(
			'element-pack',
			BDTEP_ASSETS_URL . 'js/element-pack-editor' . $suffix . '.js',
			[
				'backbone-marionette',
				'elementor-common-modules',
				'elementor-editor-modules',
			],
			BDTEP_VER,
			true
		);

		// $locale_settings = [
		// 	'i18n' => [],
		// 	'urls' => [
		// 		'modules' => BDTEP_MODULES_URL,
		// 	],
		// ];

		// $locale_settings = apply_filters( 'element_pack/editor/localize_settings', $locale_settings );

		// wp_localize_script(
		// 	'element-pack',
		// 	'ElementPackConfig',
		// 	$locale_settings
		// );f
	}

	public function enqueue_admin_scripts() {

		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script('element-pack-admin', BDTEP_ASSETS_URL . 'js/element-pack-admin' . $suffix . '.js', ['jquery'], BDTEP_VER, true);
	}

	/**
	 * Load editor editor related style from here
	 * @return [type] [description]
	 */
	public function enqueue_preview_styles() {
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_enqueue_style('element-pack-preview', BDTEP_ASSETS_URL . 'css/element-pack-preview' . $direction_suffix . '.css', '', BDTEP_VER);
	}


	public function enqueue_editor_styles() {
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style('element-pack-editor', BDTEP_ASSETS_URL . 'css/element-pack-editor' . $direction_suffix . '.css', '', BDTEP_VER);
		wp_enqueue_style('element-pack-editor');
	}


	/**
	 * Callback to shortcode.
	 *
	 * @param array $atts attributes for shortcode.
	 */
	public function shortcode_template($atts) {

		$atts = shortcode_atts(
			array(
				'id' => '',
			),
			$atts,
			'rooten_custom_template'
		);

		$id = !empty($atts['id']) ? intval($atts['id']) : '';

		if (empty($id)) {
			return '';
		}

		return Plugin::elementor()->frontend->get_builder_content_for_display($id);
	}


	/**
	 * Add element_pack_ajax_login() function with wp_ajax_nopriv_ function
	 * @return [type] [description]
	 */
	public function element_pack_ajax_login_init() {
		// Enable the user with no privileges to run element_pack_ajax_login() in AJAX
		add_action('wp_ajax_nopriv_element_pack_ajax_login', [$this, "element_pack_ajax_login"]);
	}

	/**
	 * For ajax login
	 * @return [type] [description]
	 */
	public function element_pack_ajax_login() {
		// First check the nonce, if it fails the function will break
		check_ajax_referer('ajax-login-nonce', 'bdt-user-login-sc');

		// Nonce is checked, get the POST data and sign user on
		$access_info                  = [];
		$access_info['user_login']    = !empty($_POST['user_login']) ? $_POST['user_login'] : "";
		$access_info['user_password'] = !empty($_POST['user_password']) ? $_POST['user_password'] : "";
		$access_info['remember']      = !empty($_POST['rememberme']) ? true : false;
		$user_signon                  = wp_signon($access_info, false);

		if (!is_wp_error($user_signon)) {
			echo wp_json_encode(
				[
					'loggedin' => true,
					'message'  => esc_html_x('Login successful, Redirecting...', 'User Login and Register', 'bdthemes-element-pack')
				]
			);
		} else {
			echo wp_json_encode(
				[
					'loggedin' => false,
					'message'  => esc_html_x('Oops! Wrong username or password!', 'User Login and Register', 'bdthemes-element-pack')
				]
			);
		}

		die();
	}



	// Load WPML compatibility instance
	public function wpml_compatiblity() {
		return Element_Pack_WPML::get_instance();
	}


	/**
	 * initialize the category
	 * @return [type] [description]
	 */
	public function element_pack_init() {
		$this->_modules_manager = new Manager();

		do_action('bdthemes_element_pack/init');
	}

	/**
	 * initialize the category
	 * @return [type] [description]
	 */
	public function element_pack_category_register() {

		$elementor = Plugin::$instance;

		// Add element category in panel
		$elementor->elements_manager->add_category(BDTEP_SLUG, ['title' => BDTEP_TITLE, 'icon' => 'font']);
	}

	public function element_pack_svg_support() {

		return SVG_Support::get_instance();
	}

	private function setup_hooks() {
		add_action('elementor/elements/categories_registered', [$this, 'element_pack_category_register']);
		add_action('elementor/init', [$this, 'element_pack_init']);

		add_action('elementor/editor/after_enqueue_styles', [$this, 'enqueue_editor_styles']);

		add_action('elementor/frontend/before_register_styles', [$this, 'register_site_styles']);
		add_action('elementor/frontend/before_register_scripts', [$this, 'register_site_scripts']);

		add_action('elementor/preview/enqueue_styles', [$this, 'enqueue_preview_styles']);
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_scripts']);

		add_action('elementor/frontend/after_register_styles', [$this, 'enqueue_site_styles']);
		add_action('elementor/frontend/before_enqueue_scripts', [$this, 'enqueue_site_scripts']);

		add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_scripts']);

		add_shortcode('rooten_custom_template', [$this, 'shortcode_template']);


		// When user not login add this action
		if (!is_user_logged_in()) {
			add_action('elementor/init', [$this, 'element_pack_ajax_login_init']);
		}
	}

	/**
	 * Element_Pack_Loader constructor.
	 */
	private function __construct() {
		// Register class automatically
		spl_autoload_register([$this, 'autoload']);
		// Include some backend files
		$this->_includes();

		// Finally hooked up all things here
		$this->setup_hooks();

		$this->element_pack_svg_support()->init();

		$this->wpml_compatiblity()->init();
	}
}

if (!defined('BDTEP_TESTS')) {
	// In tests we run the instance manually.
	Element_Pack_Loader::instance();
}

// handy function for push data
function element_pack_config() {
	return Element_Pack_Loader::instance();
}
