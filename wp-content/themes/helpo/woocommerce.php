<?php
/*
 * Created by Artureanec
*/

get_header();

if (is_shop()) {
    global $post;
    $page_id = wc_get_page_id('shop');
    $post = get_post($page_id);
    $helpo_sidebar_position = esc_attr(helpo_get_prefered_option('sidebar_position'));
} else {
    $helpo_sidebar_position = esc_attr(helpo_get_prefered_option('sidebar_position'));
}

$helpo_sidebar_name = 'Sidebar WooCommerce';

// --- Page Title Block --- //
if (helpo_get_prefered_option('page_title_status') == 'show') {
    echo helpo_page_title_block_output();
}
?>

<div id="post-<?php the_ID(); ?>" class="helpo_page_content_container">
    <div class="helpo_page_content_wrapper helpo_woocommerce_wrapper">
        <div class="container">
            <div class="row helpo_sidebar_<?php echo esc_attr($helpo_sidebar_position); ?>">
                <!-- Content Container -->
                <div class="col-sm-<?php echo ((is_active_sidebar($helpo_sidebar_name) && $helpo_sidebar_position !== 'none') ? '8' : '12'); ?> col-lg-<?php echo ((is_active_sidebar($helpo_sidebar_name) && $helpo_sidebar_position !== 'none') ? '9' : '12'); ?>">
                    <div class="helpo_content_wrapper">
                        <?php
                        $shop_loop = false;
                        if (is_shop() || is_product_taxonomy() || is_product_tag() || is_product_category()) {
                            $shop_loop = true;
                        }
                        if ($shop_loop) {
                            echo '<div class="helpo_shop_loop">';
                        }
                        woocommerce_content();
                        if ($shop_loop) {
                            echo '</div>';
                        }
                        ?>
                    </div>

                    <div class="helpo_content_paging_wrapper">
                        <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'helpo') . ': ', 'after' => '</div>')); ?>
                    </div>
                </div>

                <!-- Sidebar Container -->
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
