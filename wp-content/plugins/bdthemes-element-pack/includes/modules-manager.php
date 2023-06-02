<?php

namespace ElementPack;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

if (!function_exists('is_plugin_active')) {
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

final class Manager {
	private $_modules = [];

	private function is_module_active($module_id) {

		$module_data = $this->get_module_data($module_id);
		$options     = get_option('element_pack_active_modules', []);

		if (!isset($options[$module_id])) {
			return $module_data['default_activation'];
		} else {
			if ($options[$module_id] == "on") {
				return true;
			} else {
				return false;
			}
		}
	}

	private function has_module_style($module_id) {

		$module_data = $this->get_module_data($module_id);

		if (isset($module_data['has_style'])) {
			return $module_data['has_style'];
		} else {
			return false;
		}
	}

	private function get_module_data($module_id) {
		return isset($this->_modules[$module_id]) ? $this->_modules[$module_id] : false;
	}

	public function __construct() {

		$modules   = [];
		$modules[] = 'query-control';

		if (ep_is_accordion_enabled()) {
			$modules[] = 'accordion';
		}
		if (ep_is_audio_player_enabled()) {
			$modules[] = 'audio-player';
		}
		if (ep_is_advanced_button_enabled()) {
			$modules[] = 'advanced-button';
		}
		if (ep_is_advanced_calculator_enabled()) {
			$modules[] = 'advanced-calculator';
		}
		if (ep_is_advanced_counter_enabled()) {
			$modules[] = 'advanced-counter';
		}
		if (ep_is_animated_heading_enabled()) {
			$modules[] = 'animated-heading';
		}
		// if (ep_is_animated_card_enabled()) {
		// 	$modules[] = 'animated-card';
		// }
		// if (ep_is_animated_link_enabled()) {
		// 	$modules[] = 'animated-link';
		// }
		if (ep_is_advanced_heading_enabled()) {
			$modules[] = 'advanced-heading';
		}
		if (ep_is_advanced_icon_box_enabled()) {
			$modules[] = 'advanced-icon-box';
		}
		if (ep_is_advanced_gmap_enabled()) {
			$modules[] = 'advanced-gmap';
		}
		if (ep_is_advanced_image_gallery_enabled()) {
			$modules[] = 'advanced-image-gallery';
		}
		if (ep_is_advanced_progress_bar_enabled()) {
			$modules[] = 'advanced-progress-bar';
		}
		// if (ep_is_age_gate_enabled()) {
		// 	$modules[] = 'age-gate';
		// }
		if (ep_is_advanced_divider_enabled()) {
			$modules[] = 'advanced-divider';
		}
		if (ep_is_air_pollution_enabled()) {
			$modules[] = 'air-pollution';
		}
		if (ep_is_barcode_enabled()) {
			$modules[] = 'barcode';
		}
		// if (ep_is_brand_grid_enabled()) {
		// 	$modules[] = 'brand-grid';
		// }
		// if (ep_is_brand_carousel_enabled()) {
		// 	$modules[] = 'brand-carousel';
		// }
		if (ep_is_business_hours_enabled()) {
			$modules[] = 'business-hours';
		}
		if (ep_is_breadcrumbs_enabled()) {
			$modules[] = 'breadcrumbs';
		}
		if (ep_is_chart_enabled()) {
			$modules[] = 'chart';
		}
		if (ep_is_call_out_enabled()) {
			$modules[] = 'call-out';
		}
		if (ep_is_carousel_enabled()) {
			$modules[] = 'carousel';
		}
		if (ep_is_changelog_enabled()) {
			$modules[] = 'changelog';
		}
		if (ep_is_circle_menu_enabled()) {
			$modules[] = 'circle-menu';
		}
		if (ep_is_countdown_enabled()) {
			$modules[] = 'countdown';
		}
		if (ep_is_contact_form_enabled()) {
			$modules[] = 'contact-form';
		}
		if (ep_is_cookie_consent_enabled()) {
			$modules[] = 'cookie-consent';
		}
		if (ep_is_comment_enabled()) {
			$modules[] = 'comment';
		}
		if (ep_is_crypto_currency_enabled()) {
			$modules[] = 'crypto-currency';
		}
		if (ep_is_custom_gallery_enabled()) {
			$modules[] = 'custom-gallery';
		}
		if (ep_is_custom_carousel_enabled()) {
			$modules[] = 'custom-carousel';
		}
		if (ep_is_circle_info_enabled()) {
			$modules[] = 'circle-info';
		}
		// if (ep_is_creative_button_enabled()) {
		// 	$modules[] = 'creative-button';
		// }
		if (ep_is_coupon_code_enabled()) {
			$modules[] = 'coupon-code';
		}
		if (ep_is_dual_button_enabled()) {
			$modules[] = 'dual-button';
		}
		if (ep_is_device_slider_enabled()) {
			$modules[] = 'device-slider';
		}
		if (ep_is_document_viewer_enabled()) {
			$modules[] = 'document-viewer';
		}
		if (ep_is_dropbar_enabled()) {
			$modules[] = 'dropbar';
		}
		if (ep_is_dark_mode_enabled()) {
			$modules[] = 'dark-mode';
		}
		if (ep_is_fancy_card_enabled()) {
			$modules[] = 'fancy-card';
		}
		if (ep_is_fancy_list_enabled()) {
			$modules[] = 'fancy-list';
		}
		if (ep_is_fancy_slider_enabled()) {
			$modules[] = 'fancy-slider';
		}
		if (ep_is_fancy_icons_enabled()) {
			$modules[] = 'fancy-icons';
		}
		if (ep_is_fancy_tabs_enabled()) {
			$modules[] = 'fancy-tabs';
		}
		if (ep_is_flip_box_enabled()) {
			$modules[] = 'flip-box';
		}
		if (ep_is_featured_box_enabled()) {
			$modules[] = 'featured-box';
		}
		if (ep_is_google_reviews_enabled()) {
			$modules[] = 'google-reviews';
		}
		if (ep_is_helpdesk_enabled()) {
			$modules[] = 'helpdesk';
		}
		if (ep_is_honeycombs_enabled()) {
			$modules[] = 'honeycombs';
		}
		if (ep_is_hover_box_enabled()) {
			$modules[] = 'hover-box';
		}
		if (ep_is_hover_video_enabled()) {
			$modules[] = 'hover-video';
		}
		if (ep_is_image_compare_enabled()) {
			$modules[] = 'image-compare';
		}
		if (ep_is_image_magnifier_enabled()) {
			$modules[] = 'image-magnifier';
		}
		if (ep_is_image_accordion_enabled()) {
			$modules[] = 'image-accordion';
		}
		if (ep_is_image_expand_enabled()) {
			$modules[] = 'image-expand';
		}
		if (ep_is_image_stack_enabled()) {
			$modules[] = 'image-stack';
		}
		if (ep_is_iconnav_enabled()) {
			$modules[] = 'iconnav';
		}
		if (ep_is_iframe_enabled()) {
			$modules[] = 'iframe';
		}
		if (ep_is_instagram_enabled()) {
			$modules[] = 'instagram';
		}
		if (ep_is_interactive_card_enabled()) {
			$modules[] = 'interactive-card';
		}
		if (ep_is_interactive_tabs_enabled()) {
			$modules[] = 'interactive-tabs';
		}
		if (ep_is_lightbox_enabled()) {
			$modules[] = 'lightbox';
		}
		if (ep_is_lottie_image_enabled()) {
			$modules[] = 'lottie-image';
		}
		if (ep_is_lottie_icon_box_enabled()) {
			$modules[] = 'lottie-icon-box';
		}
		if (ep_is_logo_carousel_enabled()) {
			$modules[] = 'logo-carousel';
		}
		if (ep_is_logo_grid_enabled()) {
			$modules[] = 'logo-grid';
		}
		if (ep_is_marker_enabled()) {
			$modules[] = 'marker';
		}
		if (ep_is_member_enabled()) {
			$modules[] = 'member';
		}
		if (ep_is_mailchimp_enabled()) {
			$modules[] = 'mailchimp';
		}
		if (ep_is_modal_enabled()) {
			$modules[] = 'modal';
		}
		if (ep_is_navbar_enabled()) {
			$modules[] = 'navbar';
		}
		if (ep_is_news_ticker_enabled()) {
			$modules[] = 'news-ticker';
		}
		if (ep_is_notification_enabled()) {
			$modules[] = 'notification';
		}
		if (ep_is_offcanvas_enabled()) {
			$modules[] = 'offcanvas';
		}
		if (ep_is_open_street_map_enabled()) {
			$modules[] = 'open-street-map';
		}
		if (ep_is_panel_slider_enabled()) {
			$modules[] = 'panel-slider';
		}
		if (ep_is_post_card_enabled()) {
			$modules[] = 'post-card';
		}
		if (ep_is_post_block_enabled()) {
			$modules[] = 'post-block';
		}
		if (ep_is_single_post_enabled()) {
			$modules[] = 'single-post';
		}
		if (ep_is_post_grid_enabled()) {
			$modules[] = 'post-grid';
		}
		if (ep_is_post_grid_tab_enabled()) {
			$modules[] = 'post-grid-tab';
		}
		if (ep_is_post_block_modern_enabled()) {
			$modules[] = 'post-block-modern';
		}
		if (ep_is_post_gallery_enabled()) {
			$modules[] = 'post-gallery';
		}
		if (ep_is_post_slider_enabled()) {
			$modules[] = 'post-slider';
		}
		if (ep_is_price_list_enabled()) {
			$modules[] = 'price-list';
		}
		if (ep_is_price_table_enabled()) {
			$modules[] = 'price-table';
		}
		if (ep_is_progress_pie_enabled()) {
			$modules[] = 'progress-pie';
		}
		if (ep_is_post_list_enabled()) {
			$modules[] = 'post-list';
		}
		if (ep_is_protected_content_enabled()) {
			$modules[] = 'protected-content';
		}
		if (ep_is_profile_card_enabled()) {
			$modules[] = 'profile-card';
		}
		if (ep_is_qrcode_enabled()) {
			$modules[] = 'qrcode';
		}
		if (ep_is_reading_progress_enabled()) {
			$modules[] = 'reading-progress';
		}
		if (ep_is_review_card_enabled()) {
			$modules[] = 'review-card';
		}
		// if (ep_is_review_card_grid_enabled()) {
		// 	$modules[] = 'review-card-grid';
		// }
		// if (ep_is_review_card_carousel_enabled()) {
		// 	$modules[] = 'review-card-carousel';
		// }
		if (ep_is_scrollnav_enabled()) {
			$modules[] = 'scrollnav';
		}
		if (ep_is_search_enabled()) {
			$modules[] = 'search';
		}
		if (ep_is_slider_enabled()) {
			$modules[] = 'slider';
		}
		if (ep_is_slideshow_enabled()) {
			$modules[] = 'slideshow';
		}
		if (ep_is_social_share_enabled()) {
			$modules[] = 'social-share';
		}
		if (ep_is_social_proof_enabled()) {
			$modules[] = 'social-proof';
		}
		if (ep_is_scroll_image_enabled()) {
			$modules[] = 'scroll-image';
		}
		if (ep_is_scroll_button_enabled()) {
			$modules[] = 'scroll-button';
		}
		if (ep_is_source_code_enabled()) {
			$modules[] = 'source-code';
		}
		if (ep_is_static_carousel_enabled()) {
			$modules[] = 'static-carousel';
		}
		if (ep_is_step_flow_enabled()) {
			$modules[] = 'step-flow';
		}
		if (ep_is_switcher_enabled()) {
			$modules[] = 'switcher';
		}
		if (ep_is_svg_image_enabled()) {
			$modules[] = 'svg-image';
		}
		if (ep_is_tabs_enabled()) {
			$modules[] = 'tabs';
		}
		if (ep_is_timeline_enabled()) {
			$modules[] = 'timeline';
		}
		if (ep_is_table_enabled()) {
			$modules[] = 'table';
		}
		if (ep_is_table_of_content_enabled()) {
			$modules[] = 'table-of-content';
		}
		if (ep_is_toggle_enabled()) {
			$modules[] = 'toggle';
		}
		if (ep_is_total_count_enabled()) {
			$modules[] = 'total-count';
		}
		if (ep_is_trailer_box_enabled()) {
			$modules[] = 'trailer-box';
		}
		if (ep_is_tags_cloud_enabled()) {
			$modules[] = 'tags-cloud';
		}
		if (ep_is_thumb_gallery_enabled()) {
			$modules[] = 'thumb-gallery';
		}
		if (ep_is_threesixty_product_viewer_enabled()) {
			$modules[] = 'threesixty-product-viewer';
		}
		if (ep_is_time_zone_enabled()) {
			$modules[] = 'time-zone';
		}
		if (ep_is_user_login_enabled()) {
			$modules[] = 'user-login';
		}
		if (ep_is_user_register_enabled()) {
			$modules[] = 'user-register';
		}
		if (ep_is_video_player_enabled()) {
			$modules[] = 'video-player';
		}
		if (ep_is_elementor_enabled()) {
			$modules[] = 'elementor';
		}
		if (ep_is_twitter_slider_enabled()) {
			$modules[] = 'twitter-slider';
		}
		if (ep_is_twitter_carousel_enabled()) {
			$modules[] = 'twitter-carousel';
		}
		if (ep_is_twitter_grid_enabled()) {
			$modules[] = 'twitter-grid';
		}
		if (ep_is_vertical_menu_enabled()) {
			$modules[] = 'vertical-menu';
		}
		if (ep_is_video_gallery_enabled()) {
			$modules[] = 'video-gallery';
		}
		if (ep_is_weather_enabled()) {
			$modules[] = 'weather';
		}


		// elementor extend
		if (ep_is_transform_effects_enabled()) {
			$transform_effects = element_pack_option('widget_transform_effects', 'element_pack_elementor_extend', 'on');
			if ('on' === $transform_effects) {
				$modules[] = 'transform-effects';
			}
		}

		if (ep_is_tooltip_enabled()) {
			$widget_tooltip = element_pack_option('widget_tooltip_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $widget_tooltip) {
				$modules[] = 'tooltip';
			}
		}

		if (ep_is_image_parallax_enabled()) {
			$image_parallax = element_pack_option('section_parallax_content_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $image_parallax) {
				$modules[] = 'image-parallax';
			}
		}
		if (ep_is_tile_scroll_enabled()) {
			$tile_scroll = element_pack_option('section_tile_scroll_show', 'element_pack_elementor_extend', 'off');
			if ('on' === $tile_scroll) {
				$modules[] = 'tile-scroll';
			}
		}
		if (ep_is_schedule_content_enabled()) {
			$section_schedule = element_pack_option('section_schedule_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $section_schedule) {
				$modules[] = 'schedule-content';
			}
		}

		if (ep_is_particles_enabled()) {
			$section_particles = element_pack_option('section_particles_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $section_particles) {
				$modules[] = 'particles';
			}
		}

		if (ep_is_section_sticky_enabled()) {
			$section_sticky = element_pack_option('section_sticky_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $section_sticky) {
				$modules[] = 'section-sticky';
			}
		}

		if (ep_is_background_parallax_enabled()) {
			$background_parallax = element_pack_option('section_parallax_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $background_parallax) {
				$modules[] = 'background-parallax';
			}
		}

		if (ep_is_background_overlay_enabled()) {
			$background_overlay = element_pack_option('background_overlay_show', 'element_pack_elementor_extend', 'off');
			if ('on' === $background_overlay) {
				$modules[] = 'background-overlay';
			}
		}

		if (ep_is_floating_effects_enabled()) {
			$floating = element_pack_option('widget_floating_show', 'element_pack_elementor_extend', 'off');
			if ('on' === $floating) {
				$modules[] = 'floating-effects';
			}
		}

		if (ep_is_parallax_effects_enabled()) {
			$widget_parallax = element_pack_option('widget_parallax_show', 'element_pack_elementor_extend', 'on');
			if ('on' === $widget_parallax) {
				$modules[] = 'parallax-effects';
			}
		}

		if (ep_is_equal_height_enabled()) {
			$widget_equal_height = element_pack_option('widget_equal_height', 'element_pack_elementor_extend', 'off');
			if ('on' === $widget_equal_height) {
				$modules[] = 'equal-height';
			}
		}

		if (ep_is_visibility_controls_enabled()) {
			$visibility_controls = element_pack_option('visibility_controls', 'element_pack_elementor_extend', 'off');
			if ('on' === $visibility_controls) {
				$modules[] = 'visibility-controls';
			}
		}

		if (ep_is_scroll_box_enabled()) {
			$scroll_box = element_pack_option('scroll_box', 'element_pack_elementor_extend', 'off');
			if ('on' === $scroll_box) {
				$modules[] = 'scroll-box';
			}
		}

		if (ep_is_visibility_control_enabled()) {
			$visibility_control = element_pack_option('visibility_control', 'element_pack_elementor_extend', 'off');
			if ('on' === $visibility_control) {
				$modules[] = 'visibility-control';
			}
		}

		if (ep_is_confetti_effects_enabled()) {
			$confetti = element_pack_option('widget_confetti_show', 'element_pack_elementor_extend', 'off');
			if ('on' === $confetti) {
				$modules[] = 'confetti-effects';
			}
		}

		if (ep_is_custom_js_enabled()) {
			$custom_js = element_pack_option('custom_js', 'element_pack_elementor_extend', 'off');
			if ('on' === $custom_js) {
				$modules[] = 'custom-js';
			}
		}

		if (ep_is_backdrop_filter_enabled()) {
			$backdrop_filter = element_pack_option('backdrop_filter', 'element_pack_elementor_extend', 'off');
			if ('on' === $backdrop_filter) {
				$modules[] = 'backdrop-filter';
			}
		}

		if (ep_is_wrapper_link_enabled()) {
			$wrapper_link = element_pack_option('wrapper_link', 'element_pack_elementor_extend', 'off');
			if ('on' === $wrapper_link) {
				$modules[] = 'wrapper-link';
			}
		}
		
		if (ep_is_grid_line_enabled()) {
			$grid_line = element_pack_option('grid_line', 'element_pack_elementor_extend', 'off');
			if ('on' === $grid_line) {
				$modules[] = 'grid-line';
			}
		}

		// 3rd party widgets
		if (ep_is_calendly_enabled()) {
			$calendly = element_pack_option('calendly', 'element_pack_third_party_widget', 'on');
			if ('on' === $calendly) {
				$modules[] = 'calendly';
			}
		}

		if (ep_is_booked_calendar_enabled()) {
			$booked_calendar = element_pack_option('booked-calendar', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('booked/booked.php') and 'on' === $booked_calendar) {
				$modules[] = 'booked-calendar';
			}
		}

		if (ep_is_portfolio_gallery_enabled()) {
			$portfolio_gallery = element_pack_option('portfolio-gallery', 'element_pack_third_party_widget', 'off');
			if (is_plugin_active('bdthemes-portfolio/bdthemes-portfolio.php') and 'on' === $portfolio_gallery) {
				$modules[] = 'portfolio-gallery';
			}
		}

		if (ep_is_portfolio_list_enabled()) {
			$portfolio_list = element_pack_option('portfolio-list', 'element_pack_third_party_widget', 'off');
			if (is_plugin_active('bdthemes-portfolio/bdthemes-portfolio.php') and 'on' === $portfolio_list) {
				$modules[] = 'portfolio-list';
			}
		}

		if (ep_is_portfolio_carousel_enabled()) {
			$portfolio_carousel = element_pack_option('portfolio-carousel', 'element_pack_third_party_widget', 'off');
			if (is_plugin_active('bdthemes-portfolio/bdthemes-portfolio.php') and 'on' === $portfolio_carousel) {
				$modules[] = 'portfolio-carousel';
			}
		}

		if (ep_is_bbpress_enabled()) {
			$bbpress = element_pack_option('bbpress', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('bbpress/bbpress.php') and 'on' === $bbpress) {
				$modules[] = 'bbpress';
			}
		}

		if (ep_is_buddypress_enabled()) {
			$buddypress = element_pack_option('buddypress', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('buddypress/bp-loader.php') and 'on' === $buddypress) {
				$modules[] = 'buddypress';
			}
		}

		if (ep_is_caldera_forms_enabled()) {
			$caldera_forms = element_pack_option('caldera-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('caldera-forms/caldera-core.php') and 'on' === $caldera_forms) {
				$modules[] = 'caldera-forms';
			}
		}

		if (ep_is_contact_form_seven_enabled()) {
			$cf_seven = element_pack_option('contact-form-seven', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('contact-form-7/wp-contact-form-7.php') and 'on' === $cf_seven) {
				$modules[] = 'contact-form-seven';
			}
		}

		if (ep_is_download_monitor_enabled()) {
			$downloadmonitor = element_pack_option('download-monitor', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('download-monitor/download-monitor.php') and 'on' === $downloadmonitor) {
				$modules[] = 'download-monitor';
			}
		}

		if (ep_is_easy_digital_downloads_enabled()) {
			$ed_downloads = element_pack_option('easy-digital-downloads', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('easy-digital-downloads/easy-digital-downloads.php') and 'on' === $ed_downloads) {
				$modules[] = 'easy-digital-downloads';
			}
		}

		if (ep_is_event_calendar_enabled()) {
			$event_calendar = element_pack_option('event-calendar', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('the-events-calendar/the-events-calendar.php') and 'on' === $event_calendar) {
				$modules[] = 'event-calendar';
			}
		}

		if (ep_is_faq_enabled()) {
			$faq = element_pack_option('faq', 'element_pack_third_party_widget', 'on');
			if ('on' === $faq) {
				$modules[] = 'faq';
			}
		}

		if (ep_is_gravity_forms_enabled()) {
			$gravity_forms = element_pack_option('gravity-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('gravityforms/gravityforms.php') and 'on' === $gravity_forms) {
				$modules[] = 'gravity-forms';
			}
		}

		if (ep_is_instagram_feed_enabled()) {
			$instagram_feed = element_pack_option('instagram-feed', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('instagram-feed/instagram-feed.php') and 'on' === $instagram_feed) {
				$modules[] = 'instagram-feed';
			}
		}

		if (ep_is_layer_slider_enabled()) {
			$layerslider = element_pack_option('layerslider', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('LayerSlider/layerslider.php') and 'on' === $layerslider) {
				$modules[] = 'layer-slider';
			}
		}

		if (ep_is_mailchimp_for_wp_enabled()) {
			$mailchimp_for_wp = element_pack_option('mailchimp-for-wp', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('mailchimp-for-wp/mailchimp-for-wp.php') and 'on' === $mailchimp_for_wp) {
				$modules[] = 'mailchimp-for-wp';
			}
		}

		if (ep_is_ninja_forms_enabled()) {
			$ninja_forms = element_pack_option('ninja-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('ninja-forms/ninja-forms.php') and 'on' === $ninja_forms) {
				$modules[] = 'ninja-forms';
			}
		}

		if (ep_is_the_newsletter_enabled()) {
			$the_newsletter = element_pack_option('the-newsletter', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('newsletter/plugin.php') and 'on' === $the_newsletter) {
				$modules[] = 'the-newsletter';
			}
		}

		if (ep_is_fluent_forms_enabled()) {
			$fluent_forms = element_pack_option('fluent-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('fluentform/fluentform.php') and 'on' === $fluent_forms) {
				$modules[] = 'fluent-forms';
			}
		}

		if (ep_is_everest_forms_enabled()) {
			$everest_forms = element_pack_option('everest-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('everest-forms/everest-forms.php') and 'on' === $everest_forms) {
				$modules[] = 'everest-forms';
			}
		}

		if (ep_is_formidable_forms_enabled()) {
			$formidable_forms = element_pack_option('formidable-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('formidable/formidable.php') and 'on' === $formidable_forms) {
				$modules[] = 'formidable-forms';
			}
		}

		if (ep_is_forminator_forms_enabled()) {
			$forminator_forms = element_pack_option('forminator-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('forminator/forminator.php') and 'on' === $forminator_forms) {
				$modules[] = 'forminator-forms';
			}
		}

		if (ep_is_we_forms_enabled()) {
			$we_forms = element_pack_option('we-forms', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('weforms/weforms.php') and 'on' === $we_forms) {
				$modules[] = 'we-forms';
			}
		}

		if (ep_is_revolution_slider_enabled()) {
			$rev_slider = element_pack_option('revolution-slider', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('revslider/revslider.php') and 'on' === $rev_slider) {
				$modules[] = 'revolution-slider';
			}
		}

		if (ep_is_quform_enabled()) {
			$quform = element_pack_option('quform', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('quform/quform.php') and 'on' === $quform) {
				$modules[] = 'quform';
			}
		}

		if (ep_is_tablepress_enabled()) {
			$tablepress = element_pack_option('tablepress', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('tablepress/tablepress.php') and 'on' === $tablepress) {
				$modules[] = 'tablepress';
			}
		}

		if (ep_is_testimonial_carousel_enabled()) {
			$tm_carousel = element_pack_option('testimonial-carousel', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('bdthemes-testimonials/bdthemes-testimonials.php') and 'on' === $tm_carousel) {
				$modules[] = 'testimonial-carousel';
			}
		}
		if (ep_is_testimonial_grid_enabled()) {
			$tm_grid = element_pack_option('testimonial-grid', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('bdthemes-testimonials/bdthemes-testimonials.php') and 'on' === $tm_grid) {
				$modules[] = 'testimonial-grid';
			}
		}
		if (ep_is_testimonial_slider_enabled()) {
			$tm_slider = element_pack_option('testimonial-slider', 'element_pack_third_party_widget', 'on');
			if (is_plugin_active('bdthemes-testimonials/bdthemes-testimonials.php') and 'on' === $tm_slider) {
				$modules[] = 'testimonial-slider';
			}
		}

		if (ep_is_wp_forms_enabled()) {
			$wp_forms = element_pack_option('wp-forms', 'element_pack_third_party_widget', 'on');
			if ((is_plugin_active('wpforms-lite/wpforms.php') or is_plugin_active('wpforms/wpforms.php')) and 'on' === $wp_forms) {
				$modules[] = 'wp-forms';
			}
		}

		// Check only plugin activation because those plugins have multiple widgets and widget condition declare in modules.php files
		if (ep_is_give_enabled()) {
			if (is_plugin_active('give/give.php')) {
				$modules[] = 'give';
			}
		}

		if (ep_is_charitable_enabled()) {
			if (is_plugin_active('charitable/charitable.php')) {
				$modules[] = 'charitable';
			}
		}

		if (ep_is_tutor_lms_enabled()) {
			if (is_plugin_active('tutor/tutor.php')) {
				$modules[] = 'tutor-lms';
			}
		}

		if (ep_is_woocommerce_enabled()) {
			if (is_plugin_active('woocommerce/woocommerce.php')) {
				$modules[] = 'woocommerce';
			}
		}

		// Fetch all modules data
		foreach ($modules as $module) {
			$this->_modules[$module] = require BDTEP_MODULES_PATH . $module . '/module.info.php';
		}

		$direction = is_rtl() ? '.rtl' : '';

		foreach ($this->_modules as $module_id => $module_data) {

			if (!$this->is_module_active($module_id)) {
				continue;
			}

			$class_name = str_replace('-', ' ', $module_id);
			$class_name = str_replace(' ', '', ucwords($class_name));
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			// register widgets css
			if ($this->has_module_style($module_id)) {
				wp_register_style('ep-' . $module_id, BDTEP_URL . 'assets/css/ep-' . $module_id . $direction . '.css', [], BDTEP_VER);
			}

			$class_name::instance();
		}
	}
}
