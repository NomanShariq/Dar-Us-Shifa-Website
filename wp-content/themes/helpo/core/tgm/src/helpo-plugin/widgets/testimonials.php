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

class Helpo_Testimonials_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_testimonials';
    }

    public function get_title() {
        return esc_html__('Testimonials', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['testimonials_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Testimonials', 'helpo_plugin')
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
                    'type_3' => esc_html__('Type 3', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Testimonials Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Testimonials Up Title', 'helpo_plugin'),
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'heading_part_1',
            [
                'label' => esc_html__('Testimonials Title Part One', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter testimonials title part 1', 'helpo_plugin'),
                'default' => esc_html__('Part 1', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'heading_part_2',
            [
                'label' => esc_html__('Testimonials Title Part Two', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter testimonials title part 2', 'helpo_plugin'),
                'default' => esc_html__('Part 2', 'helpo_plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'testimonial',
            [
                'label' => esc_html__('Testimonial', 'helpo_plugin'),
                'type' => Controls_Manager::WYSIWYG,
                'rows' => '10',
                'default' => '',
                'placeholder' => esc_html__('Enter Testimonial Text', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Author Name', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $repeater->add_control(
            'position',
            [
                'label' => esc_html__('Author Position', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'testimonials_items',
            [
                'label' => esc_html__('Testimonials', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{name}}}',
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ---------------------------- //
        // ---------- Slider ---------- //
        // ---------------------------- //
        $this->start_controls_section(
            'section_slider',
            [
                'label' => esc_html__('Slider Settings', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Animation Speed', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rtl_support',
            [
                'label' => esc_html__('Rtl Support', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ----------------------------------- //
        // ---------- Text Settings ---------- //
        // ----------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Testimonials Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'items_bg_color',
            [
                'label' => esc_html__('Testimonials Background Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_testimonials_item_wrapper' => 'background-color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_3'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_up_heading'
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'up_title_margin',
            [
                'label' => esc_html__('Space After Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_1_typography',
                'label' => esc_html__('Title Part 1 Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_heading'
            ]
        );

        $this->add_control(
            'title_1_color',
            [
                'label' => esc_html__('Title Part 1 Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_2_typography',
                'label' => esc_html__('Title Part 2 Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_heading span'
            ]
        );

        $this->add_control(
            'title_2_color',
            [
                'label' => esc_html__('Title Part 2 Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading span' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_testimonials_widget_title_container, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_heading, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
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
                    'nav_color',
                    [
                        'label' => esc_html__('Slider Buttons Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'nav_bg',
                    [
                        'label' => esc_html__('Slider Buttons Background', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'nav_border_color',
                    [
                        'label' => esc_html__('Slider Buttons Border Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button' => 'border-color: {{VALUE}};'
                        ]
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
                    'nav_hover',
                    [
                        'label' => esc_html__('Slider Buttons Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'nav_bg_hover',
                    [
                        'label' => esc_html__('Slider Buttons Hover Background', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'nav_border_hover',
                    [
                        'label' => esc_html__('Slider Buttons Border Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'markers_color',
            [
                'label' => esc_html__('Markers Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_testimonials_icon, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_testimonials_icon, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_testimonials_icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_author_container:before, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_author_container:before, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_author_container:before' => 'background: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Space After Testimonial', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_1 .helpo_testimonial, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_2 .helpo_testimonial, {{WRAPPER}} .helpo_testimonials_wrapper.helpo_view_type_3 .helpo_testimonial' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Testimonial Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_testimonial'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Testimonial Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_testimonial' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_typography',
                'label' => esc_html__('Author Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_author_container'
            ]
        );

        $this->add_control(
            'author_color',
            [
                'label' => esc_html__('Author Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_author_container' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $up_title = $settings['up_title'];
        $heading_part_1 = $settings['heading_part_1'];
        $heading_part_2 = $settings['heading_part_2'];
        $testimonials_items = $settings['testimonials_items'];

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        if ($view_type == 'type_1' || $view_type == 'type_2') {
            $slidesToShow = 1;
        }

        if ($view_type == 'type_3') {
            $slidesToShow = 3;
        }

        $slider_options = [
            'slidesToShow' => $slidesToShow,
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'infinite' => ('yes' === $settings['infinite']),
            'speed' => absint($settings['speed']),
            'rtl' => $rtl
        ];

        if ($settings['autoplay'] == 'yes') {
            $slider_options['autoplaySpeed'] = absint( $settings['autoplay_speed'] );
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_testimonials_widget">
            <div class="helpo_testimonials_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">
                <?php

                $slider_code = '';

                foreach ($testimonials_items as $item) {
                    $slider_code .= '
                        <div class="helpo_testimonials_item">';
                            if ($view_type == 'type_3') {
                                $slider_code .= '
                                    <div class="helpo_testimonials_item_wrapper">
                                ';
                            }

                            $slider_code .= '
                            <div class="helpo_testimonials_icon">“</div>
                            
                            <div class="helpo_testimonials_content">
                                <div class="helpo_testimonial">' . helpo_output_code($item['testimonial']) . '</div>
                                
                                <div class="helpo_author_container">
                                    <span class="helpo_author_name">' . esc_html($item['name']) . ', </span>
                                    
                                    <span class="helpo_author_position">' . esc_html($item['position']) . '</span>
                                </div>
                            </div>';

                            if ($view_type == 'type_3') {
                                $slider_code .= '
                                    </div>
                                ';
                            }
                            $slider_code .= '
                        </div>
                    ';
                }

                // ------------------- //
                // --- View Type 1 --- //
                // ------------------- //
                if ($view_type == 'type_1') {
                    ?>
                    <div class="helpo_testimonials_widget_title_container">
                        <div class="row align-items-end">
                            <div class="col-lg-8 col-xl-7 offset-xl-1">
                                <div class="helpo_up_heading"><?php echo esc_html($up_title); ?></div>
                                <h2 class="helpo_heading">
                                    <?php echo helpo_output_code($heading_part_1); ?>
                                    <span><?php echo helpo_output_code($heading_part_2); ?></span>
                                </h2>
                            </div>

                            <div class="col-lg-4 col-xl-3">
                                <div class="helpo_causes_slider_navigation_container">
                                    <div class="helpo_slider_arrows">
                                        <div class="helpo_slider_nav_button helpo_prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>

                                        <div class="helpo_slider_nav_button helpo_next">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="helpo_testimonials_slider_container">
                        <div class="row">
                            <div class="col-xl-10 offset-xl-1">
                                <div class="helpo_testimonials_slider helpo_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                    <?php echo helpo_output_code($slider_code); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                // ------------------- //
                // --- View Type 2 --- //
                // ------------------- //
                if ($view_type == 'type_2') {
                    ?>
                    <div class="row">
                        <div class="col-xl-4 helpo_testimonials_widget_title_container">
                            <div class="helpo_up_heading"><?php echo esc_html($up_title); ?></div>
                            <h2 class="helpo_heading">
                                <?php echo helpo_output_code($heading_part_1); ?>
                                <span><?php echo helpo_output_code($heading_part_2); ?></span>
                            </h2>

                            <div class="helpo_causes_slider_navigation_container">
                                <div class="helpo_slider_arrows">
                                    <div class="helpo_slider_nav_button helpo_prev">
                                        <i class="fa fa-chevron-left"></i>
                                    </div>

                                    <div class="helpo_slider_nav_button helpo_next">
                                        <i class="fa fa-chevron-right"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8 helpo_testimonials_slider_container">
                            <div class="helpo_testimonials_slider helpo_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                <?php echo helpo_output_code($slider_code); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                // ------------------- //
                // --- View Type 3 --- //
                // ------------------- //
                if ($view_type == 'type_3') {
                    ?>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="row align-items-end">
                                <div class="col-sm-8 col-md-6 col-xl-12">
                                    <div class="helpo_up_heading"><?php echo esc_html($up_title); ?></div>
                                    <h2 class="helpo_heading">
                                        <?php echo helpo_output_code($heading_part_1); ?>
                                        <span><?php echo helpo_output_code($heading_part_2); ?></span>
                                    </h2>
                                </div>

                                <div class="col-sm-4 col-md-6 col-xl-12">
                                    <div class="helpo_causes_slider_navigation_container">
                                        <div class="helpo_slider_arrows">
                                            <div class="helpo_slider_nav_button helpo_prev">
                                                <i class="fa fa-chevron-left"></i>
                                            </div>

                                            <div class="helpo_slider_nav_button helpo_next">
                                                <i class="fa fa-chevron-right"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-8">
                            <div class="helpo_offset_container">
                                <div class="helpo_testimonials_slider helpo_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                    <?php echo helpo_output_code($slider_code); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}