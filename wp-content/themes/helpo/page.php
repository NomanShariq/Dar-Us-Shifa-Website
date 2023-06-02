<?php
/*
 * Created by Artureanec
*/

the_post();
get_header();

$helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
$helpo_sidebar_name = 'Sidebar';

if (helpo_get_post_option('page_top_padding') == 'off') {
    $helpo_top_padding_class = 'helpo_page_without_top_padding';
} else {
    $helpo_top_padding_class = '';
}

if (helpo_get_post_option('page_bottom_padding') == 'off') {
    $helpo_bottom_padding_class = 'helpo_page_without_bottom_padding';
} else {
    $helpo_bottom_padding_class = '';
}

// --- Page Title Block --- //
if (helpo_get_prefered_option('page_title_status') == 'show') {
    echo helpo_page_title_block_output();
}
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="helpo_page_content_container">
        <div class="helpo_page_content_wrapper <?php echo esc_attr($helpo_top_padding_class); ?> <?php echo esc_attr($helpo_bottom_padding_class); ?>">
            <div class="container">
                <div class="row helpo_sidebar_<?php echo esc_attr($helpo_sidebar_position); ?>">
                    <!-- Content Container -->
                    <div class="col-sm-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '8' : '12'); ?> col-lg-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '9' : '12'); ?>">
                        <div class="helpo_content_wrapper">
                            <?php the_content(); ?>
                        </div>

                        <div class="helpo_content_paging_wrapper">
                            <?php wp_link_pages(array('before' => '<div class="page-link">' . esc_html__('Pages', 'helpo') . ': ', 'after' => '</div>')); ?>
                        </div>

                        <?php comments_template(); ?>
                    </div>

                    <!-- Sidebar Container -->
                    <?php get_sidebar(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();