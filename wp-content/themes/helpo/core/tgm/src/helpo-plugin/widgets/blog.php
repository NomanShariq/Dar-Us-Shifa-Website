<?php
/*
 * Created by Artureanec
*/

namespace Helpo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\REPEATER;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helpo_Blog_Listing_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_blog_listing';
    }

    public function get_title() {
        return esc_html__('Blog Listing', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-gallery-justified';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Blog Listing', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 7
            ]
        );

        $this->add_control(
            'post_order_by',
            [
                'label' => esc_html__('Order By', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Post Date', 'helpo_plugin'),
                    'rand' => esc_html__('Random', 'helpo_plugin'),
                    'ID' => esc_html__('Post ID', 'helpo_plugin'),
                    'title' => esc_html__('Post Title', 'helpo_plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => esc_html__('Order', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('Descending', 'helpo_plugin'),
                    'asc' => esc_html__('Ascending', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => esc_html__('Pagination', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => esc_html__('Show', 'helpo_plugin'),
                    'hide' => esc_html__('Hide', 'helpo_plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $pagination = $settings['pagination'];
        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_blog_listing_widget">
            <div class="helpo_blog_listing_wrapper">
                <?php
                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } elseif (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }

                $args = array(
                    'post_type' => 'post',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $post_order_by,
                    'order' => $post_order,
                    'paged' => esc_attr($paged)
                );

                query_posts($args);

                while (have_posts()) {
                    the_post();
                    if ($i == 1 || $i == 3 || $i == 5) {
                        ?>
                        <div class="helpo_blog_listing_row <?php echo (($i == 5) ? 'helpo_blog_listing_third_row' : ''); ?>">
                                <?php
                            }

                            ?>
                            <div class="helpo_blog_listing_item helpo_blog_item_<?php echo esc_attr($i); ?>">
                                <div class="helpo_blog_item_wrapper">
                                    <?php
                                    $featured_image_url = helpo_get_featured_image_url();
                                    $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);

                                    $categories = get_the_category();
                                    $categ_code = array();

                                    if (is_array($categories)) {
                                        foreach ($categories as $category) {
                                            $categ_code[] = '
                                                <span class="helpo_category">' . esc_html($category->name) . '</span>
                                            ';
                                        }
                                    }

                                    if ($i == 2 || $i == 3) {
                                        $featured_image_src = aq_resize(esc_url($featured_image_url), 1267, 890, true, true, true);
                                        $helpo_excerpt = substr(get_the_excerpt(), 0, 350);
                                        ?>

                                        <div class="helpo_blog_item_container" style="background: url('<?php echo esc_url($featured_image_src); ?>')">
                                            <div class="helpo_overlay"></div>

                                            <div class="helpo_post_info_container">
                                                <div class="helpo_post_content">
                                                    <div class="helpo_category_container"><?php echo (is_array($categ_code) ? join('', $categ_code) : ''); ?></div>

                                                    <h6 class="helpo_post_title">
                                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                                    </h6>

                                                    <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>
                                                </div>

                                                <div class="helpo_post_meta">
                                                    <span class="helpo_post_date"><?php echo get_the_date(); ?></span>
                                                    <span class="helpo_post_comments_counter">
                                                        <svg class="icon">
                                                            <svg viewBox="0 0 510 510" id="comment-<?php echo mt_rand(0, 99999); ?>" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M459 0H51C22.95 0 0 22.95 0 51v459l102-102h357c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51z"></path>
                                                            </svg>
                                                        </svg>
                                                        <?php comments_number('0', '1', '%'); ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        $featured_image_src = aq_resize(esc_url($featured_image_url), 634, 485, true, true, true);
                                        $helpo_excerpt = substr(get_the_excerpt(), 0, 110);

                                        ?>
                                        <div class="helpo_image_container">
                                            <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />

                                            <div class="helpo_category_container"><?php echo (is_array($categ_code) ? join('', $categ_code) : ''); ?></div>
                                        </div>

                                        <div class="helpo_post_info_container">
                                            <h6 class="helpo_post_title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                            </h6>

                                            <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                            <div class="helpo_post_meta">
                                                <span class="helpo_post_date"><?php echo get_the_date(); ?></span>
                                                <span class="helpo_post_comments_counter">
                                                    <svg class="icon">
                                                        <svg viewBox="0 0 510 510" id="comment-<?php echo mt_rand(0, 99999); ?>" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M459 0H51C22.95 0 0 22.95 0 51v459l102-102h357c28.05 0 51-22.95 51-51V51c0-28.05-22.95-51-51-51z"></path>
                                                        </svg>
                                                    </svg>
                                                    <?php comments_number('0', '1', '%'); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php

                            if ($i == 2 || $i == 4 || $i == 7) {
                                ?>
                        </div>
                        <?php
                    }

                    if ($i < 7) {
                        $i++;
                    } else {
                        $i = 1;
                    }
                }
                ?>
            </div>

            <?php
            if ($pagination == 'show') {
                ?>
                <div class="helpo_pagination">
                    <?php
                    echo get_the_posts_pagination(array(
                        'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>' . esc_html__('Back', 'helpo_plugin'),
                        'next_text' => esc_html__('Next', 'helpo_plugin') . '<i class="fa fa-angle-right" aria-hidden="true"></i>'
                    ));
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <?php
        wp_reset_query();
    }

    protected function content_template() {}

    public function render_plain_content() {}
}