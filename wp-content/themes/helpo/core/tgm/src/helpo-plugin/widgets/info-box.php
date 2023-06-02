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

class Helpo_Info_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_info_box';
    }

    public function get_title() {
        return esc_html__('Info Box', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-menu-toggle';
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
                'label' => esc_html__('Info Box', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Info Box Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Info Box Title', 'helpo_plugin')
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_title',
            [
                'label' => esc_html__('Field Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Field Title', 'helpo_plugin')
            ]
        );

        $repeater->add_control(
            'field_content',
            [
                'label' => esc_html__('Field Content', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Information', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'fields',
            [
                'label' => esc_html__('Fields', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{field_title}}}',
                'prevent_empty' => false,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'info_box_align',
            [
                'label' => esc_html__('Info Box Alignment', 'helpo_plugin'),
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
                    '{{WRAPPER}} .helpo_info_box_item' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Info Box Settings ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Info Box Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Info Box Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_box_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_radius',
            [
                'label' => esc_html__('Info Box Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_box_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label' => esc_html__('Info Box Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_box_item' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_box_shadow',
                'selector' => '{{WRAPPER}} .helpo_info_box_item',
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Info Box Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_box_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Info Box Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_info_box_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Info Box Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_box_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => esc_html__('Space After Info Fields', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_field' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => esc_html__('Info Fields Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_info_field'
            ]
        );

        $this->add_control(
            'field_color',
            [
                'label' => esc_html__('Info Fields Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_field, {{WRAPPER}} .helpo_info_field a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'field_title_margin',
            [
                'label' => esc_html__('Space After Info Field Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_field span' => 'margin-right: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_title_typography',
                'label' => esc_html__('Info Field Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_info_field span'
            ]
        );

        $this->add_control(
            'field_title_color',
            [
                'label' => esc_html__('Info Field Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_field span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $title = $settings['title'];
        $fields = $settings['fields'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_info_box_widget">
            <div class="helpo_info_box_item">
                <?php
                if ($title !== '') {
                    ?>
                    <h6 class="helpo_info_box_title"><?php echo esc_html($title); ?></h6>
                    <?php
                }

                if (!empty($fields)) {
                    ?>
                    <div class="helpo_info_fields_container">
                        <?php
                        foreach ($fields as $field) {
                            ?>
                            <div class="helpo_info_field">
                                <span><?php echo esc_html($field['field_title']); ?></span>
                                <?php echo helpo_output_code($field['field_content']); ?>
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