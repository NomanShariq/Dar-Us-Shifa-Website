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

class Helpo_Content_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_content_slider';
    }

    public function get_title() {
        return esc_html__('Content Slider', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['content_slider_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content Slider', 'helpo_plugin')
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
            'content_width_type',
            [
                'label' => esc_html__('Content Width Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'boxed',
                'options' => [
                    'boxed' => esc_html__('Boxed', 'helpo_plugin'),
                    'full' => esc_html__('Fullwidth', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => '900',
                    'unit' => 'px'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 2000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slide' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slide_name',
            [
                'label' => esc_html__('Slide Name', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Slide Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $repeater->add_control(
            'heading_part_1',
            [
                'label' => esc_html__('Title Part One', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter title part 1', 'helpo_plugin'),
                'default' => esc_html__('Part 1', 'helpo_plugin')
            ]
        );

        $repeater->add_control(
            'heading_part_2',
            [
                'label' => esc_html__('Title Part Two', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter title part 2', 'helpo_plugin'),
                'default' => esc_html__('Part 2', 'helpo_plugin'),
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Promo Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => '10',
                'default' => '',
                'placeholder' => esc_html__('Enter Promo Text', 'helpo_plugin'),
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'helpo_plugin')
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'helpo_plugin'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'helpo_plugin' ),
            ]
        );

        $repeater->add_responsive_control(
            'content_max_width',
            [
                'label' => esc_html__('Content Container Max Width', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 2000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_container' => 'max-width: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__('Content Top Offset', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slide_wrapper' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_responsive_control(
            'text_padding',
            [
                'label' => esc_html__('Promo Text Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slider_promo_text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_align',
            [
                'label' => esc_html__('Content Container Alignment', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'helpo_plugin' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'helpo_plugin' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'helpo_plugin' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slide_wrapper' => 'justify-content: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_v_align',
            [
                'label' => esc_html__('Content Container Vertical Alignment', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Left', 'helpo_plugin' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'helpo_plugin' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Right', 'helpo_plugin' ),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slide_wrapper' => 'align-items: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_responsive_control(
            'content_text_align',
            [
                'label' => esc_html__('Content Container Text Align', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'helpo_plugin' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'helpo_plugin' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'helpo_plugin' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_container' => 'text-align: {{VALUE}};'
                ],
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'divider_1',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slider_title'
            ]
        );

        $repeater->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slider_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $repeater->add_control(
            'divider_2',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $repeater->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_2_typography',
                'label' => esc_html__('Title Part 2 Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slider_title span'
            ]
        );

        $repeater->add_control(
            'title_2_color',
            [
                'label' => esc_html__('Title Part 2 Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} .helpo_content_slider_title span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{slide_name}}}',
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Additional Fields ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_fields',
            [
                'label' => esc_html__('Additional Fields', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'short_promo_status',
            [
                'label' => esc_html__('Content Slider Anchor', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'short_promo',
            [
                'label' => esc_html__('Enter Anchor Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Scroll Down', 'helpo_plugin'),
                'label_block' => true,
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'anchor_link',
            [
                'label' => esc_html__('Enter Anchor ID', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_status',
            [
                'label' => esc_html__('Video', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__('Enter Video Link', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_image',
            [
                'label' => esc_html__('Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_text',
            [
                'label' => esc_html__('Play Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Play Button Text', 'helpo_plugin'),
                'default' => esc_html__('Watch Our Video', 'helpo_plugin'),
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_1_title_status',
            [
                'label' => esc_html__('Additional Info Block', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info_1_title',
            [
                'label' => esc_html__('Additional Info Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'info_1_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_1_text',
            [
                'label' => esc_html__('Additional Info Content', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'info_1_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_2_title_status',
            [
                'label' => esc_html__('Additional Info Block', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info_2_title',
            [
                'label' => esc_html__('Additional Info Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'info_2_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'info_2_text',
            [
                'label' => esc_html__('Additional Info Content', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'info_2_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'socials_status',
            [
                'label' => esc_html__('Social Icons', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'socials_title',
            [
                'label' => esc_html__('Socials Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'condition' => [
                    'socials_status' => 'yes',
                    'view_type' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'socials',
            [
                'label' => esc_html__('Add Social Icons', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => [
                    [
                        'name' => 'social_icon',
                        'label' => esc_html__('Icon', 'helpo_plugin'),
                        'type' => Controls_Manager::ICONS,
                        'label_block' => true,
                        'fa4compatibility' => 'social',
                        'default' => [
                            'value' => 'fab fa-wordpress',
                            'library' => 'brand'
                        ]
                    ],

                    [
                        'name' => 'social_link',
                        'label' => esc_html__('Link', 'helpo_plugin'),
                        'type' => Controls_Manager::URL,
                        'label_block' => true,
                        'default' => [
                            'url' => '',
                            'is_external' => 'true',
                        ],
                        'placeholder' => esc_html__( 'http://your-link.com', 'helpo_plugin' )
                    ]
                ],
                'title_field' => '{{{elementor.helpers.renderIcon(this, social_icon, {}, "i", "panel")}}}',
                'condition' => [
                    'socials_status' => 'yes'
                ]
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
                'default' => 1200,
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

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Content Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Promo Text Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_content_slider_promo_text'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Promo Text Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_promo_text' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Space Before Promo Text', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_promo_text' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
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

                $this->add_control(
                    'nav_color',
                    [
                        'label' => esc_html__('Slider Buttons Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button' => 'color: {{VALUE}};'
                        ],
                        'separator' => 'before'
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

                $this->add_control(
                    'nav_hover',
                    [
                        'label' => esc_html__('Slider Buttons Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'color: {{VALUE}};'
                        ],
                        'separator' => 'before'
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
            'button_margin',
            [
                'label' => esc_html__('Space Before Button', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

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

        // ------------------------------------- //
        // ---------- Fields Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_fields_settings',
            [
                'label' => esc_html__('Additional Fields Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'fields_height',
            [
                'label' => esc_html__('Additional Fields Height', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 600
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_1 .helpo_additional_fields_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_additional_fields_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_anchor_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_anchor_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_anchor_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_promo_video_container' => 'height: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'fields_bg_color',
            [
                'label' => esc_html__('Additional Fields Container Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_1 .helpo_additional_fields_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_additional_fields_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_2 .helpo_anchor_container, {{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_anchor_container' => 'background: {{VALUE}};'
                ]
            ]
        );

        // --- Slider Anchor --- //
        $this->add_control(
            'anchor_color',
            [
                'label' => esc_html__('Slider Anchor Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_anchor' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'short_promo_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'anchor_hover',
            [
                'label' => esc_html__('Slider Anchor Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_anchor:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'anchor_typography',
                'label' => esc_html__('Slider Anchor Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_anchor span',
                'condition' => [
                    'short_promo_status' => 'yes'
                ]
            ]
        );

        // --- Video --- //
        $this->add_control(
            'video_overlay_color',
            [
                'label' => esc_html__('Video Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container:before' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'video_text_color',
            [
                'label' => esc_html__('Play Button Text Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_text_hover',
            [
                'label' => esc_html__('Play Button Text Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_color',
            [
                'label' => esc_html__('Play Button Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_hover',
            [
                'label' => esc_html__('Play Button Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger:hover i' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_bg_color',
            [
                'label' => esc_html__('Play Button Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger i' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'video_button_bg_hover',
            [
                'label' => esc_html__('Play Button Background Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_promo_video_container .helpo_video_trigger:hover i' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'video_status' => 'yes'
                ]
            ]
        );

        // --- Info Fields --- //
        $this->add_control(
            'info_title_color',
            [
                'label' => esc_html__('Info Titles Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_additional_info_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_title_typography',
                'label' => esc_html__('Info Titles Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_additional_info_title'
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__('Info Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_additional_info, {{WRAPPER}} .helpo_additional_info a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'info_hover',
            [
                'label' => esc_html__('Info Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_additional_info a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => esc_html__('Info Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_additional_info'
            ]
        );

        // --- Socials --- //
        $this->add_control(
            'socials_color',
            [
                'label' => esc_html__('Socials Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_socials_container li a' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'socials_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'socials_hover',
            [
                'label' => esc_html__('Socials Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_socials_container li a:hover' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'socials_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'socials_margin',
            [
                'label' => esc_html__('Spaces Between Social Icons', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_content_slider_wrapper .helpo_socials_container li:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_content_slider_wrapper.helpo_view_type_3 .helpo_socials_container li:not(:last-of-type)' => 'margin: 0 {{SIZE}}{{UNIT}} 0 0;'
                ],
                'condition' => [
                    'socials_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $content_width_type = $settings['content_width_type'];
        $slides = $settings['slides'];
        $short_promo_status = $settings['short_promo_status'];
        $short_promo = $settings['short_promo'];
        $anchor_link = $settings['anchor_link'];
        $video_status = $settings['video_status'];
        $video_link = $settings['video_link'];
        $video_image = $settings['video_image'];
        $video_button_text = $settings['video_button_text'];
        $info_1_title_status = $settings['info_1_title_status'];
        $info_1_title = $settings['info_1_title'];
        $info_1_text = $settings['info_1_text'];
        $info_2_title_status = $settings['info_2_title_status'];
        $info_2_title = $settings['info_2_title'];
        $info_2_text = $settings['info_2_text'];
        $socials_status = $settings['socials_status'];
        $socials_title = $settings['socials_title'];
        $socials = $settings['socials'];

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        $slider_options = [
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

        <div class="helpo_content_slider_widget">
            <div class="helpo_content_slider_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">

                <div class="helpo_content_slider helpo_slider_slick" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                    <?php
                    foreach ($slides as $slide) {
                        ?>
                        <div class="helpo_content_slide elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>" style="background: url('<?php echo esc_attr($slide['image']['url']); ?>')">


                            <?php
                            if ($content_width_type == 'boxed') {
                                ?>
                                <div class="container helpo_full_cont">
                                    <div class="row helpo_full_cont">
                                        <div class="col-12 helpo_full_cont">
                                            <?php
                                            }
                                            ?>

                                            <div class="helpo_content_slide_wrapper">
                                                <div class="helpo_content_container">
                                                    <?php
                                                    if ($slide['heading_part_1'] !== '' || $slide['heading_part_2'] !== '') {
                                                        ?>
                                                        <div class="helpo_content_wrapper_1">
                                                            <h2 class="helpo_content_slider_title">
                                                                <?php echo helpo_output_code($slide['heading_part_1']); ?>
                                                                <span><?php echo helpo_output_code($slide['heading_part_2']); ?></span>
                                                            </h2>
                                                        </div>
                                                        <?php
                                                    }

                                                    if ($slide['text'] !== '') {
                                                        ?>
                                                        <div class="helpo_content_wrapper_2">
                                                            <div class="helpo_content_slider_promo_text"><?php echo helpo_output_code($slide['text']); ?></div>
                                                        </div>
                                                        <?php
                                                    }

                                                    if ($slide['button_text'] !== '') {
                                                        if ($slide['button_link']['url'] !== '') {
                                                            $button_url = $slide['button_link']['url'];
                                                        } else {
                                                            $button_url = '#';
                                                        }

                                                        ?>
                                                        <div class="helpo_content_wrapper_3">
                                                            <a class="helpo_button helpo_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($slide['button_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($slide['button_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($slide['button_text']); ?></a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                            <?php
                                            if ($content_width_type == 'boxed') {
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <!-- Slider Navigation -->
                <?php
                if ($view_type == 'type_2') {
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <?php
                                }
                                ?>

                                <div class="helpo_causes_slider_navigation_container">
                                    <div class="helpo_slider_counter"></div>

                                    <div class="helpo_slider_arrows">
                                        <div class="helpo_slider_nav_button helpo_prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>

                                        <div class="helpo_slider_nav_button helpo_next">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if ($view_type == 'type_2') {
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
                // --- Social Icons --- //
                if ($socials_status == 'yes' && $view_type !== 'type_3') {
                    ?>
                    <ul class="helpo_socials_container">
                        <?php
                        foreach ($socials as $social) {
                            if ($social['social_link']['url'] !== '') {
                                $social_url = $social['social_link']['url'];
                            } else {
                                $social_url = '#';
                            }
                            ?>

                            <li>
                                <a href="<?php echo esc_url($social_url); ?>" <?php echo (($social['social_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($social['social_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><i class="<?php echo esc_attr($social['social_icon']['value']); ?>"></i></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }

                // ------------------------- //
                // --- Additional Fields --- //
                // ------------------------- //

                // ################### //
                // ### View Type 1 ### //
                // ################### //
                if ($view_type == 'type_1') {
                    ?>
                    <div class="helpo_additional_fields_container">
                        <?php
                        if ($short_promo_status == 'yes') {
                            ?>
                            <a class="helpo_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                            <?php
                        }

                        if ($video_status == 'yes') {
                            ?>
                            <div class="helpo_promo_video_container">
                                <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'helpo_plugin'); ?>" />

                                <a class="helpo_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                    <span><?php echo esc_html($video_button_text); ?></span>
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <?php
                        }

                        if ($info_1_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_1_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_1_text); ?></div>
                            </div>
                            <?php
                        }

                        if ($info_2_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_2_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_2_text); ?></div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                // ################### //
                // ### View Type 2 ### //
                // ################### //
                if ($view_type == 'type_2') {
                    if ($short_promo_status == 'yes') {
                        ?>
                        <div class="helpo_anchor_container">
                            <a class="helpo_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="helpo_additional_fields_container">
                        <?php
                        if ($info_1_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_1_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_1_text); ?></div>
                            </div>
                            <?php
                        }

                        if ($info_2_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_2_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_2_text); ?></div>
                            </div>
                            <?php
                        }

                        if ($video_status == 'yes') {
                            ?>
                            <div class="helpo_promo_video_container">
                                <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'helpo_plugin'); ?>" />

                                <a class="helpo_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                    <span><?php echo esc_html($video_button_text); ?></span>
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                // ################### //
                // ### View Type 3 ### //
                // ################### //
                if ($view_type == 'type_3') {
                    if ($short_promo_status == 'yes') {
                        ?>
                        <div class="helpo_anchor_container">
                            <a class="helpo_anchor" href="#<?php echo esc_attr($anchor_link); ?>"><span><?php echo esc_html($short_promo); ?></span></a>
                        </div>
                        <?php
                    }

                    if ($video_status == 'yes') {
                        ?>
                        <div class="helpo_promo_video_container">
                            <img src="<?php echo esc_url($video_image['url']); ?>" alt="<?php echo esc_html__('Background', 'helpo_plugin'); ?>" />

                            <a class="helpo_video_trigger" href="<?php echo esc_url($video_link); ?>">
                                <span><?php echo esc_html($video_button_text); ?></span>
                                <i class="fa fa-play"></i>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="helpo_additional_fields_container">
                        <?php
                        if ($info_1_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_1_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_1_text); ?></div>
                            </div>
                            <?php
                        }

                        if ($info_2_title_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($info_2_title); ?></div>

                                <div class="helpo_additional_info"><?php echo helpo_output_code($info_2_text); ?></div>
                            </div>
                            <?php
                        }

                        if ($socials_status == 'yes') {
                            ?>
                            <div class="helpo_additional_info_container">
                                <div class="helpo_additional_info_title"><?php echo esc_html($socials_title); ?></div>

                                <ul class="helpo_socials_container">
                                    <?php
                                    foreach ($socials as $social) {
                                        if ($social['social_link']['url'] !== '') {
                                            $social_url = $social['social_link']['url'];
                                        } else {
                                            $social_url = '#';
                                        }
                                        ?>

                                        <li>
                                            <a href="<?php echo esc_url($social_url); ?>" <?php echo (($social['social_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($social['social_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><i class="<?php echo esc_attr($social['social_icon']['value']); ?>"></i></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                            <?php
                        }
                        ?>
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
