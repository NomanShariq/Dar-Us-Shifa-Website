<?php
/*
 * Created by Artureanec
*/

if (class_exists('WooCommerce')) {
    if (is_shop()) {
        global $post;
        $page_id = wc_get_page_id('shop');
        $post = get_post($page_id);
    }
}

global $helpo_sidebar_name;

if (is_active_sidebar($helpo_sidebar_name)) {
    if (class_exists('WooCommerce')) {
        if (is_woocommerce()) {
            if (is_shop()) {
                $helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
            } else {
                $helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
            }
        } else {
            $helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
        }
    } else {
        $helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
    }

    if ($helpo_sidebar_position !== 'none') {
        echo "<div class='helpo_sidebar col-md-4 col-lg-3'>";
            dynamic_sidebar($helpo_sidebar_name);
        echo "</div>";
    }
}
