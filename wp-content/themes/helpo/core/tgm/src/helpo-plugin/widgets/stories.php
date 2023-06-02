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

class Helpo_Stories_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_stories';
    }

    public function get_title() {
        return esc_html__('Stories', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-posts-group';
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
                'label' => esc_html__('Stories', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
                'separator' => 'before'
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
            'titles_type',
            [
                'label' => esc_html__('Titles Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default Title', 'helpo_plugin'),
                    'alt' => esc_html__('Alternative Title', 'helpo_plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read Story', 'helpo_plugin'),
                'separator' => 'before'
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

        // -------------------------------------- //
        // ---------- Stories Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Stories Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'layout_images',
            [
                'label' => esc_html__('Layout Images', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'label_off' => esc_html__('Hide', 'helpo_plugin'),
                'label_on' => esc_html__('Show', 'helpo_plugin'),
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'count_typography',
                'label' => esc_html__('Story Counter Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .heading__pre-title'
            ]
        );

        $this->add_control(
            'count_color',
            [
                'label' => esc_html__('Story Counter Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading__pre-title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'count_margin',
            [
                'label' => esc_html__('Space After Story Counter', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .heading__pre-title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .heading__title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .heading__title' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .heading__title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_excerpt' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .helpo_excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Button Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_button_settings',
            [
                'label' => esc_html__('Button Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_button'
            ]
        );

        $this->start_controls_tabs('button_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__('Normal', 'helpo_plugin')
                ]
            );

                $this->add_control(
                    'button_color',
                    [
                        'label' => esc_html__('Button Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg',
                    [
                        'label' => esc_html__('Button Background', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_border',
                    [
                        'label' => esc_html__('Button Border', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'selector' => '{{WRAPPER}} .helpo_button',
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__('Hover', 'helpo_plugin')
                ]
            );

                $this->add_control(
                    'button_color_hover',
                    [
                        'label' => esc_html__('Button Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg_hover',
                    [
                        'label' => esc_html__('Button Background Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_border_hover',
                    [
                        'label' => esc_html__('Button Border Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow_hover',
                        'selector' => '{{WRAPPER}} .helpo_button:hover',
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_radius',
            [
                'label' => esc_html__('Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $titles_type = $settings['titles_type'];
        $button_text = $settings['button_text'];
        $pagination = $settings['pagination'];
        $layout_images = $settings['layout_images'];

        $i = 1;
        $count = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_stories_widget">
            <div class="helpo_stories_wrapper">
                <div class="row">
                    <?php
                    if (get_query_var('paged')) {
                        $paged = get_query_var('paged');
                    } elseif (get_query_var('page')) {
                        $paged = get_query_var('page');
                    } else {
                        $paged = 1;
                    }

                    $args = array(
                        'post_type' => 'helpo-stories',
                        'posts_per_page' => $posts_per_page,
                        'orderby' => $post_order_by,
                        'order' => $post_order,
                        'paged' => esc_attr($paged)
                    );

                    query_posts($args);

                    while (have_posts()) {
                        the_post();

                        $featured_image_url = helpo_get_featured_image_url();
                        $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                        $featured_image_src = aq_resize(esc_url($featured_image_url), 470, 515, true, true, true);
                        $helpo_excerpt = substr(get_the_excerpt(), 0, 350);

                        if ($i == 1) {
                            $image_layout_src = plugins_url('helpo-plugin/img/story_1-layout.png');
                        }

                        if ($i == 2) {
                            $image_layout_src = plugins_url('helpo-plugin/img/story_2-layout.png');
                        }

                        if ($i == 3) {
                            $image_layout_src = plugins_url('helpo-plugin/img/story_3-layout.png');
                        }

                        if ($i == 4) {
                            $image_layout_src = plugins_url('helpo-plugin/img/story_4-layout.png');
                        }

                        if ($i % 2 == 0) {
                            $reverse_class = 'flex-column-reverse flex-lg-row-reverse';
                            $image_offset_class = 'offset-xl-1';
                            $content_offset_class = '';
                        } else {
                            $reverse_class = '';
                            $image_offset_class = '';
                            $content_offset_class = 'offset-xl-1';
                        }
                        ?>

                        <div class="col-md-10 offset-md-1 col-lg-12 offset-lg-0">
                            <div class="stories-item">
                                <div class="row align-items-center <?php echo esc_attr($reverse_class); ?>">
                                    <div class="col-lg-6 col-xl-5 <?php echo esc_attr($image_offset_class); ?>">
                                        <div class="img-box">
                                            <?php
                                            if ($layout_images == 'yes') {
                                                ?>
                                                <img class="img--layout" src="<?php echo esc_url($image_layout_src); ?>" alt="<?php echo esc_html__('Image Layout'); ?>" />
                                                <?php
                                            }
                                            ?>

                                            <div class="img-box__img">
                                                <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_html($image_alt_text) ?>" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-xl-6 <?php echo esc_attr($content_offset_class); ?>">
                                        <div class="heading heading--primary">
                                            <?php
                                            if ($count < 10) {
                                                ?>
                                                <span class="heading__pre-title">0<?php echo esc_attr($count); ?></span>
                                                <?php
                                            } else {
                                                ?>
                                                <span class="heading__pre-title"><?php echo esc_attr($count); ?></span>
                                                <?php
                                            }
                                            ?>

                                            <h2 class="heading__title helpo_heading">
                                                <?php
                                                if ($titles_type == 'default') {
                                                    echo helpo_output_code(get_the_title());
                                                } else {
                                                    echo helpo_output_code(helpo_get_post_option('alt_title'));
                                                }
                                                ?>
                                            </h2>
                                        </div>

                                        <p class="helpo_excerpt"><?php echo esc_html($helpo_excerpt) ?></p>

                                        <a class="helpo_button helpo_button--primary" href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($button_text); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php

                        if ($i < 4) {
                            $i++;
                        } else {
                            $i = 1;
                        }

                        $count++;
                    }
                    ?>
                </div>
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