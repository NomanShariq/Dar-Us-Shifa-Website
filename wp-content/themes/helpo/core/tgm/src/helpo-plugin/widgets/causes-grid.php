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

class Helpo_Causes_Grid_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_causes_grid';
    }

    public function get_title() {
        return esc_html__('Causes Grid', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['causes_grid_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Causes Grid', 'helpo_plugin')
            ]
        );

        $args = array('post_type' => 'helpo-causes', 'numberposts' => '-1');
        $all_causes = get_posts($args);
        $causes_list = array();

        if ($all_causes > 0) {
            foreach ($all_causes as $cause) {
                setup_postdata($cause);
                $causes_list[$cause->ID] = $cause->post_title;
            }
        } else {
            $causes_list = array(
                'no_posts' => esc_html__('No Posts Were Found', 'helpo_plugin')
            );
        }

        $repeater = new Repeater();

        $repeater->add_control(
            'cause_item',
            [
                'label' => esc_html__('Choose Cause Item', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT2,
                'options' => $causes_list,
                'label_block' => true,
                'multiple' => false
            ]
        );

        $repeater->add_control(
            'donate_goal',
            [
                'label' => esc_html__('Donation Goal', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'content_bg_color',
            [
                'label' => esc_html__('Content Part Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .projects-masonry__text, {{WRAPPER}} {{CURRENT_ITEM}} .projects-masonry__img:after' => 'background: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Image Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .projects-masonry__img:after' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'causes',
            [
                'label' => esc_html__('Slides', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Causes Grid Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__img:after' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__('Category Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__badge' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'cat_bg_color',
            [
                'label' => esc_html__('Category Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__badge' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__title a' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .projects-masonry__title'
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
                    '{{WRAPPER}} .projects-masonry__title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_excerpt' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
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
            'details_color',
            [
                'label' => esc_html__('Details Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__details-holder' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'details_typography',
                'label' => esc_html__('Details Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .projects-masonry__details-holder'
            ]
        );

        $this->add_control(
            'details_margin',
            [
                'label' => esc_html__('Space Before Details', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__details-holder' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $causes = $settings['causes'];

        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_causes_grid_widget">
            <div class="helpo_causes_grid_wrapper">
                <div class="row no-gutters projects-masonry helpo_isotope_trigger">
                    <?php

                    foreach ($causes as $cause) {
                        $post_id = $cause['cause_item'];
                        $cause_post = get_post($post_id);

                        if ($i == 1) {
                            $item_class = 'col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-1 projects-masonry__item--vertical helpo_item_1';
                        }
                        if ($i == 2) {
                            $item_class = 'col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--horizontal helpo_item_2';
                        }
                        if ($i == 3) {
                            $item_class = 'col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-1 projects-masonry__item--primary helpo_item_3';
                        }
                        if ($i == 4) {
                            $item_class = 'col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--primary helpo_item_4';
                        }
                        if ($i == 5) {
                            $item_class = 'col-lg-6 col-xl-8 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--horizontal helpo_item_5';
                        }
                        if ($i == 6) {
                            $item_class = 'col-lg-6 col-xl-4 projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--primary helpo_item_6';
                        }

                        $featured_image_url = get_the_post_thumbnail_url($post_id, 'full');

                        $terms = get_the_terms($post_id, 'causes-category');
                        $categories = array();

                        if (is_array($terms)) {
                            foreach ($terms as $term) {
                                $categories[] = '
                                    <span class="projects-masonry__badge">' . esc_html($term->name) . '</span>
                                ';
                            }
                        }

                        $helpo_excerpt = substr($cause_post->post_excerpt, 0, 100);
                        ?>

                        <div class="<?php echo esc_attr($item_class); ?> elementor-repeater-item-<?php echo esc_attr($cause['_id']); ?>">
                            <?php
                            if ($i == 1 || $i == 2 || $i == 5) {
                                ?>
                                <div class="projects-masonry__img">
                                    <img class="img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Image', 'helpo_plugin'); ?>" />
                                </div>

                                <div class="projects-masonry__text">
                                    <div class="projects-masonry__inner">
                                        <?php echo (is_array($categories) ? join('', $categories) : ''); ?>

                                        <h3 class="projects-masonry__title">
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html($cause_post->post_title); ?></a>
                                        </h3>

                                        <p class="helpo_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                        <div class="projects-masonry__details-holder">
                                            <?php
                                            if ($cause['donate_goal'] !== '') {
                                                ?>
                                                <div class="projects-masonry__details-item">
                                                    <span><?php echo esc_html__('Goal: ', 'helpo_plugin'); ?></span>
                                                    <?php echo esc_html($cause['donate_goal']); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="projects-masonry__details-item">
                                                <span><?php echo esc_html__('Date: ', 'helpo_plugin'); ?></span>
                                                <?php echo get_the_date(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }

                            if ($i == 3 || $i == 4 || $i == 6) {
                                ?>
                                <div class="projects-masonry__img">
                                    <img class="img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Image', 'helpo_plugin'); ?>" />

                                    <div class="projects-masonry__inner">
                                        <?php echo (is_array($categories) ? join('', $categories) : ''); ?>

                                        <h3 class="projects-masonry__title">
                                            <a href="<?php echo esc_url(get_permalink($post_id)); ?>"><?php echo esc_html($cause_post->post_title); ?></a>
                                        </h3>

                                        <p class="helpo_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                        <div class="projects-masonry__details-holder">
                                            <?php
                                            if ($cause['donate_goal'] !== '') {
                                                ?>
                                                <div class="projects-masonry__details-item">
                                                    <span><?php echo esc_html__('Goal: ', 'helpo_plugin'); ?></span>
                                                    <?php echo esc_html($cause['donate_goal']); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>

                                            <div class="projects-masonry__details-item">
                                                <span><?php echo esc_html__('Date: ', 'helpo_plugin'); ?></span>
                                                <?php echo get_the_date(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php

                        if ($i < 6) {
                            $i++;
                        } else {
                            $i = 1;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}