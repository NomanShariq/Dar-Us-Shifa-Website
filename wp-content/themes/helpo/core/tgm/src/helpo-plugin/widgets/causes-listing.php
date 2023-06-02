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

class Helpo_Causes_Listing_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_causes_listing';
    }

    public function get_title() {
        return esc_html__('Causes Listing', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-post-list';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['causes_listing_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Causes Listing', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('Type 1', 'helpo_plugin'),
                    'type_2' => esc_html__('Type 2', 'helpo_plugin'),
                    'type_3' => esc_html__('Type 3', 'helpo_plugin'),
                    'type_4' => esc_html__('Type 4', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('Two Columns', 'helpo_plugin'),
                    '3' => esc_html__('Three Columns', 'helpo_plugin'),
                    '4' => esc_html__('Four Columns', 'helpo_plugin')
                ],
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
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

        $this->add_control(
            'popup_button_text',
            [
                'label' => esc_html__('Donate Popup Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+ Donate', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Donate Popup Button Text', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------------- //
        // ---------- Causes Listing Settings ---------- //
        // --------------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Causes Listing Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'items_padding',
            [
                'label' => esc_html__('Spaces Between Items in Row', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_causes_listing_wrapper' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_causes_list_item' => 'padding-left: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type!' => 'type_3'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'items_margin',
            [
                'label' => esc_html__('Spaces Between Rows', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_causes_list_item' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'items_bg',
            [
                'label' => esc_html__('Items Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_info_container, {{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_causes_list_wrapper, {{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_causes_list_item' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__('Items Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_1 .helpo_info_container, {{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_2 .helpo_causes_list_wrapper, {{WRAPPER}} .helpo_causes_listing_wrapper.helpo_view_type_3 .helpo_causes_list_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_post_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_post_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_excerpt' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_margin',
            [
                'label' => esc_html__('Space After Excerpt', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__('Category Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_category_container' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'cat_bg_color',
            [
                'label' => esc_html__('Category Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_category_container' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $posts_per_page = $settings['posts_per_page'];
        $columns = $settings['columns'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $pagination = $settings['pagination'];
        $popup_button_text = $settings['popup_button_text'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_causes_listing_widget">
            <div class="helpo_causes_listing_wrapper helpo_view_<?php echo esc_attr($view_type); ?> <?php echo (($view_type !== 'type_3') ? 'helpo_columns_' . esc_attr($columns) . '' : ''); ?>">
                <?php
                if (get_query_var('paged')) {
                    $paged = get_query_var('paged');
                } elseif (get_query_var('page')) {
                    $paged = get_query_var('page');
                } else {
                    $paged = 1;
                }

                $args = array(
                    'post_type' => 'helpo-causes',
                    'posts_per_page' => $posts_per_page,
                    'orderby' => $post_order_by,
                    'order' => $post_order,
                    'paged' => esc_attr($paged)
                );

                query_posts($args);

                while (have_posts()) {
                    the_post();
                    ?>

                    <div class="helpo_causes_list_item">
                        <div class="helpo_causes_list_wrapper">
                            <?php
                            $featured_image_url = helpo_get_featured_image_url();
                            $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                            $terms = get_the_terms(get_the_ID(), 'causes-category');
                            $categories = array();

                            if (is_array($terms)) {
                                foreach ($terms as $term) {
                                    $categories[] = '
                                        <span class="helpo_category">' . esc_html($term->name) . '</span>
                                    ';
                                }
                            }

                            if ($view_type == 'type_1' || $view_type == 'type_2' || $view_type == 'type_4') {

                                if ($columns == '2') {
                                    $featured_image_src = aq_resize(esc_url($featured_image_url), 960, 734, true, true, true);
                                    $helpo_excerpt = substr(get_the_excerpt(), 0, 120);
                                }

                                if ($columns == '3') {
                                    $featured_image_src = aq_resize(esc_url($featured_image_url), 640, 490, true, true, true);
                                    $helpo_excerpt = substr(get_the_excerpt(), 0, 100);
                                }

                                if ($columns == '4') {
                                    $featured_image_src = aq_resize(esc_url($featured_image_url), 480, 367, true, true, true);
                                    $helpo_excerpt = substr(get_the_excerpt(), 0, 80);
                                }
                            }

                            if ($view_type == 'type_1') {
                                ?>
                                <div class="helpo_info_container">
                                    <div class="helpo_causes_list_content_container">
                                        <h6 class="helpo_post_title">
                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                        </h6>

                                        <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>
                                    </div>

                                    <div class="helpo_featured_image_container">
                                        <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                        <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                    </div>

                                    <?php
                                    if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                        ?>
                                        <div class="helpo_donation_details">
                                            <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>

                                <div class="helpo_donate_button_container">
                                    <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html($popup_button_text); ?></a>
                                </div>
                                <?php
                            }

                            if ($view_type == 'type_2') {
                                ?>
                                <div class="helpo_causes_content_container">
                                    <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                    <h6 class="helpo_post_title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                    </h6>

                                    <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                    <?php
                                    if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                        ?>
                                        <div class="helpo_donation_details">
                                            <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="helpo_donate_button_container">
                                        <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_donate_popup_button"><?php echo esc_html($popup_button_text); ?></a>
                                    </div>
                                </div>
                                <?php
                            }

                            if ($view_type == 'type_3') {
                                $featured_image_src = aq_resize(esc_url($featured_image_url), 350, 260, true, true, true);
                                $helpo_excerpt = substr(get_the_excerpt(), 0, 190);
                                ?>
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-xl-4">
                                        <div class="helpo_featured_image_container">
                                            <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-xl-8">
                                        <div class="helpo_causes_content_container">
                                            <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                            <h6 class="helpo_post_title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                            </h6>

                                            <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                            <?php
                                            if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                                ?>
                                                <div class="helpo_donation_details">
                                                    <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="helpo_donate_button_container">
                                                <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_donate_popup_button"><?php echo esc_html($popup_button_text); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            if ($view_type == 'type_4') {
                                ?>
                                <div class="helpo_info_container">
                                    <div class="helpo_causes_list_content_container">
                                        <h6 class="helpo_post_title">
                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                        </h6>

                                        <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>
                                    </div>

                                    <div class="helpo_featured_image_container">
                                        <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                        <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                    </div>

                                    <?php
                                    if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                        ?>
                                        <div class="helpo_donation_details">
                                            <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                    <div class="helpo_donate_button_container">
                                        <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html($popup_button_text); ?></a>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
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