<?php

/**
 * Element Pack widget filters
 * @since 5.7.4
 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Settings Filters
if (!function_exists('ep_is_dashboard_enabled')) {
    function ep_is_dashboard_enabled() {
        return apply_filters('elementpack/settings/dashboard', true);
    }
}

if (!function_exists('ep_is_accordion_enabled')) {
    function ep_is_accordion_enabled() {
        return apply_filters('elementpack/widget/accordion', true);
    }
}

if (!function_exists('ep_is_audio_player_enabled')) {
    function ep_is_audio_player_enabled() {
        return apply_filters('elementpack/widget/audio_player', true);
    }
}

if (!function_exists('ep_is_business_hours_enabled')) {
    function ep_is_business_hours_enabled() {
        return apply_filters('elementpack/widget/business_hours', true);
    }
}

if (!function_exists('ep_is_breadcrumbs_enabled')) {
    function ep_is_breadcrumbs_enabled() {
        return apply_filters('elementpack/widget/breadcrumbs', true);
    }
}

if (!function_exists('ep_is_advanced_button_enabled')) {
    function ep_is_advanced_button_enabled() {
        return apply_filters('elementpack/widget/advanced_button', true);
    }
}

if (!function_exists('ep_is_advanced_counter_enabled')) {
    function ep_is_advanced_counter_enabled() {
        return apply_filters('elementpack/widget/advanced_counter', true);
    }
}

if (!function_exists('ep_is_animated_heading_enabled')) {
    function ep_is_animated_heading_enabled() {
        return apply_filters('elementpack/widget/animated_heading', true);
    }
}

// if (!function_exists('ep_is_animated_card_enabled')) {
//     function ep_is_animated_card_enabled() {
//         return apply_filters('elementpack/widget/animated_card', true);
//     }
// }

// if (!function_exists('ep_is_animated_link_enabled')) {
//     function ep_is_animated_link_enabled() {
//         return apply_filters('elementpack/widget/animated_link', true);
//     }
// }

if (!function_exists('ep_is_advanced_heading_enabled')) {
    function ep_is_advanced_heading_enabled() {
        return apply_filters('elementpack/widget/advanced_heading', true);
    }
}

if (!function_exists('ep_is_advanced_icon_box_enabled')) {
    function ep_is_advanced_icon_box_enabled() {
        return apply_filters('elementpack/widget/advanced_icon_box', true);
    }
}

if (!function_exists('ep_is_advanced_gmap_enabled')) {
    function ep_is_advanced_gmap_enabled() {
        return apply_filters('elementpack/widget/advanced_gmap', true);
    }
}

if (!function_exists('ep_is_advanced_image_gallery_enabled')) {
    function ep_is_advanced_image_gallery_enabled() {
        return apply_filters('elementpack/widget/advanced_image_gallery', true);
    }
}

if (!function_exists('ep_is_advanced_progress_bar_enabled')) {
    function ep_is_advanced_progress_bar_enabled() {
        return apply_filters('elementpack/widget/advanced_progress_bar', true);
    }
}

// if (!function_exists('ep_is_age_gate_enabled')) {
//     function ep_is_age_gate_enabled() {
//         return apply_filters('elementpack/widget/age_gate', true);
//     }
// }

if (!function_exists('ep_is_advanced_divider_enabled')) {
    function ep_is_advanced_divider_enabled() {
        return apply_filters('elementpack/widget/advanced_divider', true);
    }
}

if (!function_exists('ep_is_chart_enabled')) {
    function ep_is_chart_enabled() {
        return apply_filters('elementpack/widget/chart', true);
    }
}

if (!function_exists('ep_is_call_out_enabled')) {
    function ep_is_call_out_enabled() {
        return apply_filters('elementpack/widget/call_out', true);
    }
}

if (!function_exists('ep_is_carousel_enabled')) {
    function ep_is_carousel_enabled() {
        return apply_filters('elementpack/widget/carousel', true);
    }
}

if (!function_exists('ep_is_changelog_enabled')) {
    function ep_is_changelog_enabled() {
        return apply_filters('elementpack/widget/changelog', true);
    }
}

if (!function_exists('ep_is_circle_menu_enabled')) {
    function ep_is_circle_menu_enabled() {
        return apply_filters('elementpack/widget/circle_menu', true);
    }
}

if (!function_exists('ep_is_countdown_enabled')) {
    function ep_is_countdown_enabled() {
        return apply_filters('elementpack/widget/countdown', true);
    }
}

if (!function_exists('ep_is_contact_form_enabled')) {
    function ep_is_contact_form_enabled() {
        return apply_filters('elementpack/widget/contact_form', true);
    }
}

if (!function_exists('ep_is_cookie_consent_enabled')) {
    function ep_is_cookie_consent_enabled() {
        return apply_filters('elementpack/widget/cookie_consent', true);
    }
}

if (!function_exists('ep_is_comment_enabled')) {
    function ep_is_comment_enabled() {
        return apply_filters('elementpack/widget/comment', true);
    }
}

if (!function_exists('ep_is_crypto_currency_enabled')) {
    function ep_is_crypto_currency_enabled() {
        return apply_filters('elementpack/widget/crypto_currency', true);
    }
}

if (!function_exists('ep_is_custom_gallery_enabled')) {
    function ep_is_custom_gallery_enabled() {
        return apply_filters('elementpack/widget/custom_gallery', true);
    }
}

if (!function_exists('ep_is_custom_carousel_enabled')) {
    function ep_is_custom_carousel_enabled() {
        return apply_filters('elementpack/widget/custom_carousel', true);
    }
}

if (!function_exists('ep_is_circle_info_enabled')) {
    function ep_is_circle_info_enabled() {
        return apply_filters('elementpack/widget/circle_info', true);
    }
}

// if (!function_exists('ep_is_creative_button_enabled')) {
//     function ep_is_creative_button_enabled() {
//         return apply_filters('elementpack/widget/creative_button', true);
//     }
// }

if (!function_exists('ep_is_coupon_code_enabled')) {
    function ep_is_coupon_code_enabled() {
        return apply_filters('elementpack/widget/coupon_code', true);
    }
}

if (!function_exists('ep_is_dual_button_enabled')) {
    function ep_is_dual_button_enabled() {
        return apply_filters('elementpack/widget/dual_button', true);
    }
}

if (!function_exists('ep_is_device_slider_enabled')) {
    function ep_is_device_slider_enabled() {
        return apply_filters('elementpack/widget/device_slider', true);
    }
}

if (!function_exists('ep_is_document_viewer_enabled')) {
    function ep_is_document_viewer_enabled() {
        return apply_filters('elementpack/widget/document_viewer', true);
    }
}

if (!function_exists('ep_is_dropbar_enabled')) {
    function ep_is_dropbar_enabled() {
        return apply_filters('elementpack/widget/dropbar', true);
    }
}

if (!function_exists('ep_is_dark_mode_enabled')) {
    function ep_is_dark_mode_enabled() {
        return apply_filters('elementpack/widget/dark_mode', true);
    }
}

if (!function_exists('ep_is_fancy_card_enabled')) {
    function ep_is_fancy_card_enabled() {
        return apply_filters('elementpack/widget/fancy_card', true);
    }
}

if (!function_exists('ep_is_fancy_list_enabled')) {
    function ep_is_fancy_list_enabled() {
        return apply_filters('elementpack/widget/fancy_list', true);
    }
}

if (!function_exists('ep_is_fancy_slider_enabled')) {
    function ep_is_fancy_slider_enabled() {
        return apply_filters('elementpack/widget/fancy_slider', true);
    }
}

if (!function_exists('ep_is_fancy_icons_enabled')) {
    function ep_is_fancy_icons_enabled() {
        return apply_filters('elementpack/widget/fancy_icons', true);
    }
}

if (!function_exists('ep_is_fancy_tabs_enabled')) {
    function ep_is_fancy_tabs_enabled() {
        return apply_filters('elementpack/widget/fancy_tabs', true);
    }
}

if (!function_exists('ep_is_interactive_tabs_enabled')) {
    function ep_is_interactive_tabs_enabled() {
        return apply_filters('elementpack/widget/interactive_tabs', true);
    }
}

if (!function_exists('ep_is_flip_box_enabled')) {
    function ep_is_flip_box_enabled() {
        return apply_filters('elementpack/widget/flip_box', true);
    }
}

if (!function_exists('ep_is_featured_box_enabled')) {
    function ep_is_featured_box_enabled() {
        return apply_filters('elementpack/widget/featured_box', true);
    }
}

// if ( ! function_exists( 'ep_is_featured_expand_enabled' ) ) {
//     function ep_is_featured_expand_enabled() {
//         return apply_filters( 'elementpack/widget/featured_expand', true );
//     }
// }

if (!function_exists('ep_is_google_reviews_enabled')) {
    function ep_is_google_reviews_enabled() {
        return apply_filters('elementpack/widget/google_reviews', true);
    }
}

if (!function_exists('ep_is_helpdesk_enabled')) {
    function ep_is_helpdesk_enabled() {
        return apply_filters('elementpack/widget/helpdesk', true);
    }
}

if (!function_exists('ep_is_honeycombs_enabled')) {
    function ep_is_honeycombs_enabled() {
        return apply_filters('elementpack/widget/honeycombs', true);
    }
}

if (!function_exists('ep_is_hover_box_enabled')) {
    function ep_is_hover_box_enabled() {
        return apply_filters('elementpack/widget/hover_box', true);
    }
}

if (!function_exists('ep_is_hover_video_enabled')) {
    function ep_is_hover_video_enabled() {
        return apply_filters('elementpack/widget/hover_video', true);
    }
}

if (!function_exists('ep_is_image_compare_enabled')) {
    function ep_is_image_compare_enabled() {
        return apply_filters('elementpack/widget/image_compare', true);
    }
}

if (!function_exists('ep_is_image_magnifier_enabled')) {
    function ep_is_image_magnifier_enabled() {
        return apply_filters('elementpack/widget/image_magnifier', true);
    }
}

if (!function_exists('ep_is_image_accordion_enabled')) {
    function ep_is_image_accordion_enabled() {
        return apply_filters('elementpack/widget/image_accordion', true);
    }
}

if (!function_exists('ep_is_image_expand_enabled')) {
    function ep_is_image_expand_enabled() {
        return apply_filters('elementpack/widget/image_expand', true);
    }
}

if (!function_exists('ep_is_image_stack_enabled')) {
    function ep_is_image_stack_enabled() {
        return apply_filters('elementpack/widget/image_stack', true);
    }
}

if (!function_exists('ep_is_iconnav_enabled')) {
    function ep_is_iconnav_enabled() {
        return apply_filters('elementpack/widget/iconnav', true);
    }
}

if (!function_exists('ep_is_iframe_enabled')) {
    function ep_is_iframe_enabled() {
        return apply_filters('elementpack/widget/iframe', true);
    }
}

if (!function_exists('ep_is_instagram_enabled')) {
    function ep_is_instagram_enabled() {
        return apply_filters('elementpack/widget/instagram', true);
    }
}

if (!function_exists('ep_is_interactive_card_enabled')) {
    function ep_is_interactive_card_enabled() {
        return apply_filters('elementpack/widget/interactive_card', true);
    }
}

if (!function_exists('ep_is_lightbox_enabled')) {
    function ep_is_lightbox_enabled() {
        return apply_filters('elementpack/widget/lightbox', true);
    }
}

if (!function_exists('ep_is_lottie_image_enabled')) {
    function ep_is_lottie_image_enabled() {
        return apply_filters('elementpack/widget/lottie_image', true);
    }
}

if (!function_exists('ep_is_lottie_icon_box_enabled')) {
    function ep_is_lottie_icon_box_enabled() {
        return apply_filters('elementpack/widget/lottie_icon_box', true);
    }
}

if (!function_exists('ep_is_logo_carousel_enabled')) {
    function ep_is_logo_carousel_enabled() {
        return apply_filters('elementpack/widget/logo_carousel', true);
    }
}

if (!function_exists('ep_is_logo_grid_enabled')) {
    function ep_is_logo_grid_enabled() {
        return apply_filters('elementpack/widget/logo_grid', true);
    }
}

if (!function_exists('ep_is_marker_enabled')) {
    function ep_is_marker_enabled() {
        return apply_filters('elementpack/widget/marker', true);
    }
}

if (!function_exists('ep_is_member_enabled')) {
    function ep_is_member_enabled() {
        return apply_filters('elementpack/widget/member', true);
    }
}

if (!function_exists('ep_is_mailchimp_enabled')) {
    function ep_is_mailchimp_enabled() {
        return apply_filters('elementpack/widget/mailchimp', true);
    }
}

if (!function_exists('ep_is_modal_enabled')) {
    function ep_is_modal_enabled() {
        return apply_filters('elementpack/widget/modal', true);
    }
}

if (!function_exists('ep_is_navbar_enabled')) {
    function ep_is_navbar_enabled() {
        return apply_filters('elementpack/widget/navbar', true);
    }
}

if (!function_exists('ep_is_news_ticker_enabled')) {
    function ep_is_news_ticker_enabled() {
        return apply_filters('elementpack/widget/news_ticker', true);
    }
}

if (!function_exists('ep_is_notification_enabled')) {
    function ep_is_notification_enabled() {
        return apply_filters('elementpack/widget/notification', true);
    }
}

if (!function_exists('ep_is_offcanvas_enabled')) {
    function ep_is_offcanvas_enabled() {
        return apply_filters('elementpack/widget/offcanvas', true);
    }
}

if (!function_exists('ep_is_open_street_map_enabled')) {
    function ep_is_open_street_map_enabled() {
        return apply_filters('elementpack/widget/open_street_map', true);
    }
}

if (!function_exists('ep_is_panel_slider_enabled')) {
    function ep_is_panel_slider_enabled() {
        return apply_filters('elementpack/widget/panel_slider', true);
    }
}

if (!function_exists('ep_is_post_card_enabled')) {
    function ep_is_post_card_enabled() {
        return apply_filters('elementpack/widget/post_card', true);
    }
}

if (!function_exists('ep_is_post_block_enabled')) {
    function ep_is_post_block_enabled() {
        return apply_filters('elementpack/widget/post_block', true);
    }
}

if (!function_exists('ep_is_single_post_enabled')) {
    function ep_is_single_post_enabled() {
        return apply_filters('elementpack/widget/single_post', true);
    }
}

if (!function_exists('ep_is_post_grid_enabled')) {
    function ep_is_post_grid_enabled() {
        return apply_filters('elementpack/widget/post_grid', true);
    }
}

if (!function_exists('ep_is_post_grid_tab_enabled')) {
    function ep_is_post_grid_tab_enabled() {
        return apply_filters('elementpack/widget/post_grid_tab', true);
    }
}

if (!function_exists('ep_is_post_block_modern_enabled')) {
    function ep_is_post_block_modern_enabled() {
        return apply_filters('elementpack/widget/post_block_modern', true);
    }
}

if (!function_exists('ep_is_post_gallery_enabled')) {
    function ep_is_post_gallery_enabled() {
        return apply_filters('elementpack/widget/post_gallery', true);
    }
}

if (!function_exists('ep_is_post_slider_enabled')) {
    function ep_is_post_slider_enabled() {
        return apply_filters('elementpack/widget/post_slider', true);
    }
}

if (!function_exists('ep_is_price_list_enabled')) {
    function ep_is_price_list_enabled() {
        return apply_filters('elementpack/widget/price_list', true);
    }
}

if (!function_exists('ep_is_price_table_enabled')) {
    function ep_is_price_table_enabled() {
        return apply_filters('elementpack/widget/price_table', true);
    }
}

if (!function_exists('ep_is_progress_pie_enabled')) {
    function ep_is_progress_pie_enabled() {
        return apply_filters('elementpack/widget/progress_pie', true);
    }
}

if (!function_exists('ep_is_post_list_enabled')) {
    function ep_is_post_list_enabled() {
        return apply_filters('elementpack/widget/post_list', true);
    }
}

if (!function_exists('ep_is_protected_content_enabled')) {
    function ep_is_protected_content_enabled() {
        return apply_filters('elementpack/widget/protected_content', true);
    }
}

if (!function_exists('ep_is_profile_card_enabled')) {
    function ep_is_profile_card_enabled() {
        return apply_filters('elementpack/widget/profile_card', true);
    }
}

if (!function_exists('ep_is_qrcode_enabled')) {
    function ep_is_qrcode_enabled() {
        return apply_filters('elementpack/widget/qrcode', true);
    }
}
if (!function_exists('ep_is_barcode_enabled')) {
    function ep_is_barcode_enabled() {
        return apply_filters('elementpack/widget/barcode', true);
    }
}

if (!function_exists('ep_is_reading_progress_enabled')) {
    function ep_is_reading_progress_enabled() {
        return apply_filters('elementpack/widget/reading_progress', true);
    }
}

// if (!function_exists('ep_is_brand_grid_enabled')) {
//     function ep_is_brand_grid_enabled() {
//         return apply_filters('elementpack/widget/brand_grid', true);
//     }
// }

// if (!function_exists('ep_is_brand_carousel_enabled')) {
//     function ep_is_brand_carousel_enabled() {
//         return apply_filters('elementpack/widget/brand_carousel', true);
//     }
// }

if (!function_exists('ep_is_review_card_enabled')) {
    function ep_is_review_card_enabled() {
        return apply_filters('elementpack/widget/review_card', true);
    }
}

// if (!function_exists('ep_is_review_card_grid_enabled')) {
//     function ep_is_review_card_grid_enabled() {
//         return apply_filters('elementpack/widget/review_card_grid', true);
//     }
// }

// if (!function_exists('ep_is_review_card_carousel_enabled')) {
//     function ep_is_review_card_carousel_enabled() {
//         return apply_filters('elementpack/widget/review_card_carousel', true);
//     }
// }

if (!function_exists('ep_is_scrollnav_enabled')) {
    function ep_is_scrollnav_enabled() {
        return apply_filters('elementpack/widget/scrollnav', true);
    }
}

if (!function_exists('ep_is_search_enabled')) {
    function ep_is_search_enabled() {
        return apply_filters('elementpack/widget/search', true);
    }
}

if (!function_exists('ep_is_slider_enabled')) {
    function ep_is_slider_enabled() {
        return apply_filters('elementpack/widget/slider', true);
    }
}

if (!function_exists('ep_is_slideshow_enabled')) {
    function ep_is_slideshow_enabled() {
        return apply_filters('elementpack/widget/slideshow', true);
    }
}

if (!function_exists('ep_is_social_share_enabled')) {
    function ep_is_social_share_enabled() {
        return apply_filters('elementpack/widget/social_share', true);
    }
}

if (!function_exists('ep_is_social_proof_enabled')) {
    function ep_is_social_proof_enabled() {
        return apply_filters('elementpack/widget/social_proof', true);
    }
}

if (!function_exists('ep_is_scroll_image_enabled')) {
    function ep_is_scroll_image_enabled() {
        return apply_filters('elementpack/widget/scroll_image', true);
    }
}

if (!function_exists('ep_is_scroll_button_enabled')) {
    function ep_is_scroll_button_enabled() {
        return apply_filters('elementpack/widget/scroll_button', true);
    }
}

if (!function_exists('ep_is_source_code_enabled')) {
    function ep_is_source_code_enabled() {
        return apply_filters('elementpack/widget/source_code', true);
    }
}

if (!function_exists('ep_is_static_carousel_enabled')) {
    function ep_is_static_carousel_enabled() {
        return apply_filters('elementpack/widget/static_carousel', true);
    }
}

if (!function_exists('ep_is_step_flow_enabled')) {
    function ep_is_step_flow_enabled() {
        return apply_filters('elementpack/widget/step_flow', true);
    }
}

if (!function_exists('ep_is_switcher_enabled')) {
    function ep_is_switcher_enabled() {
        return apply_filters('elementpack/widget/switcher', true);
    }
}

if (!function_exists('ep_is_svg_image_enabled')) {
    function ep_is_svg_image_enabled() {
        return apply_filters('elementpack/widget/svg_image', true);
    }
}

if (!function_exists('ep_is_tabs_enabled')) {
    function ep_is_tabs_enabled() {
        return apply_filters('elementpack/widget/tabs', true);
    }
}

if (!function_exists('ep_is_timeline_enabled')) {
    function ep_is_timeline_enabled() {
        return apply_filters('elementpack/widget/timeline', true);
    }
}

if (!function_exists('ep_is_table_enabled')) {
    function ep_is_table_enabled() {
        return apply_filters('elementpack/widget/table', true);
    }
}

if (!function_exists('ep_is_table_of_content_enabled')) {
    function ep_is_table_of_content_enabled() {
        return apply_filters('elementpack/widget/table_of_content', true);
    }
}

if (!function_exists('ep_is_toggle_enabled')) {
    function ep_is_toggle_enabled() {
        return apply_filters('elementpack/widget/toggle', true);
    }
}

if (!function_exists('ep_is_total_count_enabled')) {
    function ep_is_total_count_enabled() {
        return apply_filters('elementpack/widget/total_count', true);
    }
}

if (!function_exists('ep_is_trailer_box_enabled')) {
    function ep_is_trailer_box_enabled() {
        return apply_filters('elementpack/widget/trailer_box', true);
    }
}

if (!function_exists('ep_is_tags_cloud_enabled')) {
    function ep_is_tags_cloud_enabled() {
        return apply_filters('elementpack/widget/tags_cloud', true);
    }
}

if (!function_exists('ep_is_thumb_gallery_enabled')) {
    function ep_is_thumb_gallery_enabled() {
        return apply_filters('elementpack/widget/thumb_gallery', true);
    }
}

if (!function_exists('ep_is_threesixty_product_viewer_enabled')) {
    function ep_is_threesixty_product_viewer_enabled() {
        return apply_filters('elementpack/widget/threesixty_product_viewer', true);
    }
}

if (!function_exists('ep_is_time_zone_enabled')) {
    function ep_is_time_zone_enabled() {
        return apply_filters('elementpack/widget/time_zone', true);
    }
}

if (!function_exists('ep_is_user_login_enabled')) {
    function ep_is_user_login_enabled() {
        return apply_filters('elementpack/widget/user_login', true);
    }
}

if (!function_exists('ep_is_user_register_enabled')) {
    function ep_is_user_register_enabled() {
        return apply_filters('elementpack/widget/user_register', true);
    }
}

if (!function_exists('ep_is_video_player_enabled')) {
    function ep_is_video_player_enabled() {
        return apply_filters('elementpack/widget/video_player', true);
    }
}

if (!function_exists('ep_is_elementor_enabled')) {
    function ep_is_elementor_enabled() {
        return apply_filters('elementpack/widget/elementor', true);
    }
}

if (!function_exists('ep_is_twitter_slider_enabled')) {
    function ep_is_twitter_slider_enabled() {
        return apply_filters('elementpack/widget/twitter_slider', true);
    }
}

if (!function_exists('ep_is_twitter_carousel_enabled')) {
    function ep_is_twitter_carousel_enabled() {
        return apply_filters('elementpack/widget/twitter_carousel', true);
    }
}

if (!function_exists('ep_is_twitter_grid_enabled')) {
    function ep_is_twitter_grid_enabled() {
        return apply_filters('elementpack/widget/twitter_grid', true);
    }
}

if (!function_exists('ep_is_vertical_menu_enabled')) {
    function ep_is_vertical_menu_enabled() {
        return apply_filters('elementpack/widget/vertical_menu', true);
    }
}

if (!function_exists('ep_is_video_gallery_enabled')) {
    function ep_is_video_gallery_enabled() {
        return apply_filters('elementpack/widget/video_gallery', true);
    }
}

if (!function_exists('ep_is_weather_enabled')) {
    function ep_is_weather_enabled() {
        return apply_filters('elementpack/widget/weather', true);
    }
}

if (!function_exists('ep_is_air_pollution_enabled')) {
    function ep_is_air_pollution_enabled() {
        return apply_filters('elementpack/widget/air_pollution', true);
    }
}
if (!function_exists('ep_is_advanced_calculator_enabled')) {
    function ep_is_advanced_calculator_enabled() {
        return apply_filters('elementpack/widget/advanced_calculator', true);
    }
}



// elementor extend filters
if (!function_exists('ep_is_transform_effects_enabled')) {
    function ep_is_transform_effects_enabled() {
        return apply_filters('elementpack/extend/transform_effects', true);
    }
}

if (!function_exists('ep_is_tooltip_enabled')) {
    function ep_is_tooltip_enabled() {
        return apply_filters('elementpack/extend/tooltip', true);
    }
}

if (!function_exists('ep_is_image_parallax_enabled')) {
    function ep_is_image_parallax_enabled() {
        return apply_filters('elementpack/extend/image_parallax', true);
    }
}
if (!function_exists('ep_is_image_parallax_enabled')) {
    function ep_is_image_parallax_enabled() {
        return apply_filters('elementpack/extend/image_parallax', true);
    }
}
if (!function_exists('ep_is_tile_scroll_enabled')) {
    function ep_is_tile_scroll_enabled() {
        return apply_filters('elementpack/widget/tile_scroll', true);
    }
}

if (!function_exists('ep_is_schedule_content_enabled')) {
    function ep_is_schedule_content_enabled() {
        return apply_filters('elementpack/extend/schedule_content', true);
    }
}

if (!function_exists('ep_is_particles_enabled')) {
    function ep_is_particles_enabled() {
        return apply_filters('elementpack/extend/particles', true);
    }
}

if (!function_exists('ep_is_section_sticky_enabled')) {
    function ep_is_section_sticky_enabled() {
        return apply_filters('elementpack/extend/section_sticky', true);
    }
}

if (!function_exists('ep_is_background_parallax_enabled')) {
    function ep_is_background_parallax_enabled() {
        return apply_filters('elementpack/extend/background_parallax', true);
    }
}

if (!function_exists('ep_is_background_overlay_enabled')) {
    function ep_is_background_overlay_enabled() {
        return apply_filters('elementpack/extend/background_overlay', true);
    }
}

if (!function_exists('ep_is_floating_effects_enabled')) {
    function ep_is_floating_effects_enabled() {
        return apply_filters('elementpack/extend/floating_effects', true);
    }
}
if (!function_exists('ep_is_confetti_effects_enabled')) {
    function ep_is_confetti_effects_enabled() {
        return apply_filters('elementpack/extend/confetti_effects', true);
    }
}

if (!function_exists('ep_is_parallax_effects_enabled')) {
    function ep_is_parallax_effects_enabled() {
        return apply_filters('elementpack/extend/parallax_effects', true);
    }
}

if (!function_exists('ep_is_equal_height_enabled')) {
    function ep_is_equal_height_enabled() {
        return apply_filters('elementpack/extend/equal_height', true);
    }
}

if (!function_exists('ep_is_visibility_control_enabled')) {
    function ep_is_visibility_control_enabled() {
        return apply_filters('elementpack/extend/visibility_control', true);
    }
}

if (!function_exists('ep_is_visibility_controls_enabled')) {
    function ep_is_visibility_controls_enabled() {
        return apply_filters('elementpack/extend/visibility_controls', true);
    }
}

if (!function_exists('ep_is_scroll_box_enabled')) {
    function ep_is_scroll_box_enabled() {
        return apply_filters('elementpack/extend/scroll_box', true);
    }
}

if (!function_exists('ep_is_custom_js_enabled')) {
    function ep_is_custom_js_enabled() {
        return apply_filters('elementpack/extend/custom_js', true);
    }
}

if (!function_exists('ep_is_backdrop_filter_enabled')) {
    function ep_is_backdrop_filter_enabled() {
        return apply_filters('elementpack/extend/backdrop_filter', true);
    }
}

if (!function_exists('ep_is_wrapper_link_enabled')) {
    function ep_is_wrapper_link_enabled() {
        return apply_filters('elementpack/extend/wrapper_link', true);
    }
}

if (!function_exists('ep_is_grid_line_enabled')) {
    function ep_is_grid_line_enabled() {
        return apply_filters('elementpack/extend/grid_line', true);
    }
}


// 3rd party widgets filters
if (!function_exists('ep_is_calendly_enabled')) {
    function ep_is_calendly_enabled() {
        return apply_filters('elementpack/widget/calendly', true);
    }
}

if (!function_exists('ep_is_booked_calendar_enabled')) {
    function ep_is_booked_calendar_enabled() {
        return apply_filters('elementpack/widget/booked_calendar', true);
    }
}

if (!function_exists('ep_is_portfolio_gallery_enabled')) {
    function ep_is_portfolio_gallery_enabled() {
        return apply_filters('elementpack/widget/portfolio_gallery', true);
    }
}

if (!function_exists('ep_is_portfolio_list_enabled')) {
    function ep_is_portfolio_list_enabled() {
        return apply_filters('elementpack/widget/portfolio_list', true);
    }
}

if (!function_exists('ep_is_portfolio_carousel_enabled')) {
    function ep_is_portfolio_carousel_enabled() {
        return apply_filters('elementpack/widget/portfolio_carousel', true);
    }
}

if (!function_exists('ep_is_bbpress_enabled')) {
    function ep_is_bbpress_enabled() {
        return apply_filters('elementpack/widget/bbpress', true);
    }
}

if (!function_exists('ep_is_buddypress_enabled')) {
    function ep_is_buddypress_enabled() {
        return apply_filters('elementpack/widget/buddypress', true);
    }
}

if (!function_exists('ep_is_caldera_forms_enabled')) {
    function ep_is_caldera_forms_enabled() {
        return apply_filters('elementpack/widget/caldera_forms', true);
    }
}

if (!function_exists('ep_is_contact_form_seven_enabled')) {
    function ep_is_contact_form_seven_enabled() {
        return apply_filters('elementpack/widget/contact_form_seven', true);
    }
}

if (!function_exists('ep_is_download_monitor_enabled')) {
    function ep_is_download_monitor_enabled() {
        return apply_filters('elementpack/widget/download_monitor', true);
    }
}

if (!function_exists('ep_is_easy_digital_downloads_enabled')) {
    function ep_is_easy_digital_downloads_enabled() {
        return apply_filters('elementpack/widget/easy_digital_downloads', true);
    }
}

if (!function_exists('ep_is_event_calendar_enabled')) {
    function ep_is_event_calendar_enabled() {
        return apply_filters('elementpack/widget/event_calendar', true);
    }
}

if (!function_exists('ep_is_faq_enabled')) {
    function ep_is_faq_enabled() {
        return apply_filters('elementpack/widget/faq', true);
    }
}

if (!function_exists('ep_is_gravity_forms_enabled')) {
    function ep_is_gravity_forms_enabled() {
        return apply_filters('elementpack/widget/gravity_forms', true);
    }
}

if (!function_exists('ep_is_instagram_feed_enabled')) {
    function ep_is_instagram_feed_enabled() {
        return apply_filters('elementpack/widget/instagram_feed', true);
    }
}

if (!function_exists('ep_is_layer_slider_enabled')) {
    function ep_is_layer_slider_enabled() {
        return apply_filters('elementpack/widget/layer_slider', true);
    }
}

if (!function_exists('ep_is_mailchimp_for_wp_enabled')) {
    function ep_is_mailchimp_for_wp_enabled() {
        return apply_filters('elementpack/widget/mailchimp_for_wp', true);
    }
}

if (!function_exists('ep_is_ninja_forms_enabled')) {
    function ep_is_ninja_forms_enabled() {
        return apply_filters('elementpack/widget/ninja_forms', true);
    }
}

if (!function_exists('ep_is_the_newsletter_enabled')) {
    function ep_is_the_newsletter_enabled() {
        return apply_filters('elementpack/widget/the_newsletter', true);
    }
}

if (!function_exists('ep_is_fluent_forms_enabled')) {
    function ep_is_fluent_forms_enabled() {
        return apply_filters('elementpack/widget/fluent_forms', true);
    }
}

if (!function_exists('ep_is_everest_forms_enabled')) {
    function ep_is_everest_forms_enabled() {
        return apply_filters('elementpack/widget/everest_forms', true);
    }
}

if (!function_exists('ep_is_formidable_forms_enabled')) {
    function ep_is_formidable_forms_enabled() {
        return apply_filters('elementpack/widget/formidable_forms', true);
    }
}

if (!function_exists('ep_is_forminator_forms_enabled')) {
    function ep_is_forminator_forms_enabled() {
        return apply_filters('elementpack/widget/forminator_forms', true);
    }
}

if (!function_exists('ep_is_we_forms_enabled')) {
    function ep_is_we_forms_enabled() {
        return apply_filters('elementpack/widget/we_forms', true);
    }
}

if (!function_exists('ep_is_revolution_slider_enabled')) {
    function ep_is_revolution_slider_enabled() {
        return apply_filters('elementpack/widget/revolution_slider', true);
    }
}

if (!function_exists('ep_is_quform_enabled')) {
    function ep_is_quform_enabled() {
        return apply_filters('elementpack/widget/quform', true);
    }
}

if (!function_exists('ep_is_tablepress_enabled')) {
    function ep_is_tablepress_enabled() {
        return apply_filters('elementpack/widget/tablepress', true);
    }
}

if (!function_exists('ep_is_testimonial_carousel_enabled')) {
    function ep_is_testimonial_carousel_enabled() {
        return apply_filters('elementpack/widget/testimonial_carousel', true);
    }
}

if (!function_exists('ep_is_testimonial_grid_enabled')) {
    function ep_is_testimonial_grid_enabled() {
        return apply_filters('elementpack/widget/testimonial_grid', true);
    }
}

if (!function_exists('ep_is_testimonial_slider_enabled')) {
    function ep_is_testimonial_slider_enabled() {
        return apply_filters('elementpack/widget/testimonial_slider', true);
    }
}

if (!function_exists('ep_is_wp_forms_enabled')) {
    function ep_is_wp_forms_enabled() {
        return apply_filters('elementpack/widget/wp_forms', true);
    }
}

if (!function_exists('ep_is_give_enabled')) {
    function ep_is_give_enabled() {
        return apply_filters('elementpack/widget/give', true);
    }
}

if (!function_exists('ep_is_charitable_enabled')) {
    function ep_is_charitable_enabled() {
        return apply_filters('elementpack/widget/charitable', true);
    }
}

if (!function_exists('ep_is_tutor_lms_enabled')) {
    function ep_is_tutor_lms_enabled() {
        return apply_filters('elementpack/widget/tutor_lms', true);
    }
}

if (!function_exists('ep_is_woocommerce_enabled')) {
    function ep_is_woocommerce_enabled() {
        return apply_filters('elementpack/widget/woocommerce', true);
    }
}
