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
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helpo_Heading_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_heading';
    }

    public function get_title() {
        return esc_html__('Heading', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_heading',
            [
                'label' => esc_html__('Heading', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('Heading View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'helpo_plugin'),
                    'type_2' => esc_html__('View Type 2', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'heading',
            [
                'label' => esc_html__('Heading', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter your heading', 'helpo_plugin' ),
                'default' => esc_html__( 'This is heading element', 'helpo_plugin' ),
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'heading_part_1',
            [
                'label' => esc_html__('Heading Part One', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter heading part 1', 'helpo_plugin' ),
                'default' => esc_html__( 'Part 1', 'helpo_plugin' ),
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'heading_part_2',
            [
                'label' => esc_html__('Heading Part Two', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter heading part 2', 'helpo_plugin' ),
                'default' => esc_html__( 'Part 2', 'helpo_plugin' ),
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__('HTML Tag', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => esc_html__( 'H1', 'helpo_plugin' ),
                    'h2' => esc_html__( 'H2', 'helpo_plugin' ),
                    'h3' => esc_html__( 'H3', 'helpo_plugin' ),
                    'h4' => esc_html__( 'H4', 'helpo_plugin' ),
                    'h5' => esc_html__( 'H5', 'helpo_plugin' ),
                    'h6' => esc_html__( 'H6', 'helpo_plugin' ),
                    'div' => esc_html__( 'div', 'helpo_plugin' ),
                    'span' => esc_html__( 'span', 'helpo_plugin' ),
                    'p' => esc_html__( 'p', 'helpo_plugin' )
                ],
                'default' => 'h2'
            ]
        );

        $this->add_responsive_control(
            'title_align',
            [
                'label' => esc_html__('Heading Alignment', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'helpo_plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'helpo_plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'helpo_plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'up_title_status',
            [
                'label' => esc_html__('Up Heading', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Enter Up Heading', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter up heading', 'helpo_plugin' ),
                'default' => esc_html__( 'Up Heading', 'helpo_plugin' ),
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_align',
            [
                'label' => esc_html__('Heading Alignment', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'helpo_plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'helpo_plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'helpo_plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Heading Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_heading_settings',
            [
                'label' => esc_html__('Heading Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Heading Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_heading'
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'label' => esc_html__('Heading Text Shadow', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_heading'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Heading Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Heading Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_up_heading',
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Heading Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'up_title_margin',
            [
                'label' => esc_html__('Space After Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'up_title_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $title_tag = $settings['title_tag'];
        $up_title_status = $settings['up_title_status'];

        if ($view_type == 'type_1') {
            $heading = $settings['heading'];
            $heading_part_1 = '';
            $heading_part_2 = '';
        } else {
            $heading = '';
            $heading_part_1 = $settings['heading_part_1'];
            $heading_part_2 = $settings['heading_part_2'];
        }

        if ($up_title_status == 'yes') {
            $up_title = $settings['up_title'];
        } else {
            $up_title = '';
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_heading_widget">
            <?php
            if ($heading !== '' || $heading_part_1 !== '' || $heading_part_2 !== '') {

                if ($up_title_status == 'yes') {
                    ?>
                    <div class="helpo_up_heading"><?php echo esc_html($up_title); ?></div>
                    <?php
                }
                ?>
                <<?php echo $title_tag; ?> class="helpo_heading">

                    <?php
                    if ($view_type == 'type_1') {
                        echo helpo_output_code($heading);
                    } else {
                        echo helpo_output_code($heading_part_1) . ' ';
                        ?>
                        <span><?php echo helpo_output_code($heading_part_2); ?></span>
                        <?php
                    }
                    ?>
                </<?php echo $title_tag; ?>>
                <?php
            }
            ?>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
