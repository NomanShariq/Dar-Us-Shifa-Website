<?php
/*
 * Created by Artureanec
*/

get_header();

$helpo_sidebar_position = helpo_get_theme_mod('sidebar_position');
$helpo_sidebar_name = 'Sidebar';

// --- Page Title Block --- //
if (helpo_get_theme_mod('page_title_status') == 'show') {
    echo helpo_page_title_block_output();
}
?>

    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="helpo_page_content_container">
            <div class="helpo_page_content_wrapper">
                <div class="container">
                    <div class="row helpo_sidebar_<?php echo esc_attr($helpo_sidebar_position); ?>">
                        <!-- Content Container -->
                        <div class="col-sm-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '8' : '12'); ?> col-lg-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '9' : '12'); ?>">
                            <div class="helpo_content_wrapper">

                                <div class="helpo_standard_blog_listing">
                                    <div class="helpo_standard_blog_listing_wrapper">
                                        <?php
                                        while (have_posts()) : the_post();
                                            get_template_part('standard-listing');
                                        endwhile;
                                        ?>
                                    </div>

                                    <div class="helpo_pagination">
                                        <?php
                                        echo get_the_posts_pagination(array(
                                            'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>' . esc_html__('Back', 'helpo'),
                                            'next_text' => esc_html__('Next', 'helpo') . '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                                        ));
                                        ?>
                                    </div>
                                </div>

                            </div>
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
