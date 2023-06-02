<?php
/*
 * Created by Artureanec
*/

the_post();
get_header();

$helpo_sidebar_position = helpo_get_prefered_option('sidebar_position');
$helpo_sidebar_name = 'Sidebar';

// --- Page Title Block --- //
if (helpo_get_prefered_option('page_title_status') == 'show') {
    echo helpo_page_title_block_output();
}
?>

    <div id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="helpo_blog_content_container helpo_top_padding_<?php echo esc_attr(helpo_get_post_option('top_padding')); ?> helpo_bottom_padding_<?php echo esc_attr(helpo_get_post_option('bottom_padding')); ?>">
            <div class="helpo_blog_content_wrapper">
                <div class="container">
                    <div class="row helpo_sidebar_<?php echo esc_attr($helpo_sidebar_position); ?>">
                        <!-- Content Container -->
                        <div class="col-sm-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '8' : '12'); ?> col-lg-<?php echo ((is_active_sidebar('sidebar') && $helpo_sidebar_position !== 'none') ? '9' : '12'); ?>">
                            <?php
                            if (helpo_get_prefered_option('media_output_status') == 'show') {
                                echo helpo_post_media_output();
                            }
                            ?>

                            <?php

                            if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                ?>
                                <div class="helpo_single_post_donation_form_container">
                                    <?php echo do_shortcode(wp_kses(helpo_get_post_option('cause_donation_shortcode'), 'strip')); ?>
                                </div>
                                <?php
                            }
                            ?>

                            <div class="helpo_content_wrapper">
                                <?php the_content(); ?>
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