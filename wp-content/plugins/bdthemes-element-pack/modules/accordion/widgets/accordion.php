<?php

namespace ElementPack\Modules\Accordion\Widgets;

use Elementor\Repeater;
use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use ElementPack\Utils;



use ElementPack\Element_Pack_Loader;
use ElementPack\Includes\Controls\SelectInput\Dynamic_Select;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Accordion extends Module_Base {

    public function get_name() {
        return 'bdt-accordion';
    }

    public function get_title() {
        return BDTEP . esc_html__('Accordion', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-accordion';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['accordion', 'tabs', 'toggle'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-accordion'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/DP3XNV1FEk0';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Accordion', 'bdthemes-element-pack'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => __('Title & Content', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => __('Accordion Title', 'bdthemes-element-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'source',
            [
                'label'   => esc_html__('Select Source', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'    => esc_html__('Custom Content', 'bdthemes-element-pack'),
                    "elementor" => esc_html__('Elementor Template', 'bdthemes-element-pack'),
                    'anywhere'  => esc_html__('AE Template', 'bdthemes-element-pack'),
                ],
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'      => __('Content', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::WYSIWYG,
                'dynamic'    => ['active' => true],
                'default'    => __('Accordion Content', 'bdthemes-element-pack'),
                'show_label' => false,
                'condition'  => ['source' => 'custom'],
            ]
        );

        $repeater->add_control(
            'template_id',
            [
                'label'       => __('Select Template', 'bdthemes-element-pack'),
                'type'        => Dynamic_Select::TYPE,
                'label_block' => true,
                'placeholder' => __('Type and select template', 'bdthemes-element-pack'),
                'query_args'  => [
                    'query'        => 'elementor_template',
                ],
                'condition'   => ['source' => "elementor"],
            ]
        );
        $repeater->add_control(
            'anywhere_id',
            [
                'label'       => __('Select Template', 'bdthemes-element-pack'),
                'type'        => Dynamic_Select::TYPE,
                'label_block' => true,
                'placeholder' => __('Type and select template', 'bdthemes-element-pack'),
                'query_args'  => [
                    'query'        => 'anywhere_template',
                ],
                'condition'   => ['source' => "anywhere"],
            ]
        );

        $repeater->add_control(
            'repeater_icon',
            [
                'label'            => __('Title Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'       => __('Items', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'   => __('Accordion #1', 'bdthemes-element-pack'),
                        'tab_content' => __('I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                    ],
                    [
                        'tab_title'   => __('Accordion #2', 'bdthemes-element-pack'),
                        'tab_content' => __('I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                    ],
                    [
                        'tab_title'   => __('Accordion #3', 'bdthemes-element-pack'),
                        'tab_content' => __('I am item content. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'bdthemes-element-pack'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label'   => __('Title HTML Tag', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'options' => element_pack_title_tags(),
                'default' => 'div',
            ]
        );

        $this->add_control(
            'accordion_icon',
            [
                'label'            => __('Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-solid'   => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );

        $this->add_control(
            'accordion_active_icon',
            [
                'label'            => __('Active Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default'          => [
                    'value'   => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-solid'   => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin'             => 'inline',
                'label_block'      => false,
                'condition'        => [
                    'accordion_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'show_custom_icon',
            [
                'label'   => esc_html__('Show Title Icon', 'bdthemes-element-pack') . BDTEP_NC,
                'type'    => Controls_Manager::SWITCHER,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __('Additional', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'collapsible',
            [
                'label'   => __('Collapsible All Item', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'multiple',
            [
                'label' => __('Multiple Open', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'active_item',
            [
                'label' => __('Active Item No', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
                'max'   => 20,
            ]
        );

        $this->add_control(
            'active_hash',
            [
                'label'   => esc_html__('Hash Location', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'active_scrollspy',
            [
                'label'     => esc_html__('Scrollspy', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'return'    => 'yes',
                'condition' => [
                    'active_hash' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'hash_top_offset',
            [
                'label'      => esc_html__('Top Offset ', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', ''],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 1000,
                        'step' => 5,
                    ],

                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'condition'  => [
                    'active_hash'      => 'yes',
                    'active_scrollspy' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'hash_scrollspy_time',
            [
                'label'      => esc_html__('Scrollspy Time', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['ms', ''],
                'range'      => [
                    'px' => [
                        'min'  => 500,
                        'max'  => 5000,
                        'step' => 1000,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 1000,
                ],
                'condition'  => [
                    'active_hash'      => 'yes',
                    'active_scrollspy' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __('Item', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'item_spacing',
            [
                'label'     => __('Item Gap', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item + .bdt-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_alignment',
            [
                'label'       => __('Alignment', 'bdthemes-element-pack') . BDTEP_NC,
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'flex-start'  => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                // 'default'     => is_rtl() ? 'flex-end' : 'flex-start',
                'default'     => 'flex-start',
                'toggle'      => false,
                'label_block' => false,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-title' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'title_background',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item .bdt-accordion-title',
            ]
        );

        $this->add_responsive_control(
            'title_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item .bdt-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item .bdt-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .bdt-accordion .bdt-accordion-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'hover_title_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title .bdt-accordion-custom-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'hover_title_background',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title',
            ]
        );

        $this->add_control(
            'title_hover_border_color',
            [
                'label'     => __('Border Color', 'bdthemes-element-pack') . BDTEP_NC,
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'title_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_active',
            [
                'label' => __('Active', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'active_title_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title .bdt-accordion-custom-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'active_title_background',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_title_shadow',
                'selector' => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'active_title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title',
            ]
        );

        $this->add_responsive_control(
            'active_title_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title_icon',
            [
                'label' => __('Title Icon', 'bdthemes-element-pack') . BDTEP_NC,
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_custom_icon' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs('tabs_title_icon_style');

        $this->start_controls_tab(
            'tab_title_icon_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-accordion-custom-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-accordion-custom-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_icon_size',
            [
                'label'   => esc_html__('Size', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-custom-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_indent',
            [
                'label'   => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-custom-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_icon_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_hover_icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title .bdt-accordion-custom-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-title .bdt-accordion-custom-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_icon_active',
            [
                'label' => __('Active', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_active_icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title .bdt-accordion-custom-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-title .bdt-accordion-custom-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label'     => __('Open & Close Icon', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'accordion_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'       => __('Alignment', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    'left'  => [
                        'title' => __('Start', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('End', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default'     => is_rtl() ? 'left' : 'right',
                'toggle'      => false,
                'label_block' => false,
            ]
        );

        $this->start_controls_tabs('tabs_icon_style');

        $this->start_controls_tab(
            'tab_icon_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-accordion-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_background_color',
                'selector'  => '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-icon'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'icon_border',
                'selector'    => '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => __('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-icon.bdt-flex-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-icon.bdt-flex-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __('Icon Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-title .bdt-accordion-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-accordion-container .bdt-accordion .bdt-accordion-title .bdt-accordion-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_hover_background_color',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-icon'
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack') . BDTEP_NC,
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item:hover .bdt-accordion-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_active',
            [
                'label' => __('Active', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'icon_active_background_color',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-icon'
            ]
        );

        $this->add_control(
            'icon_active_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack') . BDTEP_NC,
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-item.bdt-open .bdt-accordion-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __('Content', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'content_background_color',
                'selector'  => '{{WRAPPER}} .bdt-accordion .bdt-accordion-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'item_border',
                'label'       => __('Border', 'bdthemes-element-pack') . BDTEP_NC,
                'selector'    => '{{WRAPPER}} .bdt-accordion .bdt-accordion-content',
            ]
        );

        $this->add_responsive_control(
            'content_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => __('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label'     => __('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-content' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .bdt-accordion .bdt-accordion-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_shadow',
                'label'       => __('Box Shadow', 'bdthemes-element-pack') . BDTEP_NC,
                'selector' => '{{WRAPPER}} .bdt-accordion .bdt-accordion-content',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __('Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    // '{{WRAPPER}} .bdt-accordion .bdt-accordion-title'   => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .bdt-accordion .bdt-accordion-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = 'bdt-accordion-' . $this->get_id();

        $this->add_render_attribute(
            [
                'accordion' => [
                    'id'            => $id,
                    'class'         => 'bdt-accordion',
                    'data-bdt-accordion' => [
                        wp_json_encode([
                            "collapsible" => $settings["collapsible"] ? true : false,
                            "multiple"    => $settings["multiple"] ? true : false,
                            "transition"  => "ease-in-out",
                        ])
                    ]
                ]
            ]
        );

        $this->add_render_attribute(
            [
                'accordion_data' => [
                    'data-settings' => [
                        wp_json_encode([
                            "id"                => 'bdt-accordion-' . $this->get_id(),
                            'activeHash'        => $settings['active_hash'],
                            'activeScrollspy'   => $settings['active_scrollspy'],
                            'hashTopOffset'     => isset($settings['hash_top_offset']['size']) ? $settings['hash_top_offset']['size'] : false,
                            'hashScrollspyTime' => isset($settings['hash_scrollspy_time']['size']) ? $settings['hash_scrollspy_time']['size'] : false,
                        ]),
                    ],
                ],
            ]
        );

        $migrated = isset($settings['__fa4_migrated']['accordion_icon']);
        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

        $active_migrated = isset($settings['__fa4_migrated']['accordion_active_icon']);
        $active_is_new   = empty($settings['icon_active']) && Icons_Manager::is_migration_allowed();

?>
        <div class="bdt-accordion-container">
            <div <?php echo $this->get_render_attribute_string('accordion'); ?> <?php echo $this->get_render_attribute_string('accordion_data'); ?>>
                <?php foreach ($settings['tabs'] as $index => $item) :
                    $acc_count = $index + 1;

                    $acc_id = ($item['tab_title']) ? element_pack_string_id($item['tab_title']) : $id . $acc_count;
                    $acc_id = 'bdt-accordion-' . $acc_id;

                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $this->add_render_attribute($tab_title_setting_key, [
                        'class' => ['bdt-accordion-title bdt-flex bdt-flex-middle'],
                    ]);

                    $this->add_render_attribute($tab_title_setting_key, 'class', ('right' == $settings['icon_align']) ? 'bdt-flex-between' : '');


                    $this->add_render_attribute($tab_content_setting_key, [
                        'class' => ['bdt-accordion-content'],
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');


                ?>
                    <div class="bdt-accordion-item<?php echo ($acc_count === $settings['active_item']) ? ' bdt-open' : ''; ?>">
                        <<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?> id="<?php echo strtolower(preg_replace('#[ -]+#', '-', trim(preg_replace("![^a-z0-9]+!i", " ", esc_attr($acc_id))))) ?>" data-accordion-index="<?php echo esc_attr($index); ?>" data-title="<?php echo strtolower(preg_replace('#[ -]+#', '-', trim(preg_replace("![^a-z0-9]+!i", " ", esc_html($item['tab_title']))))) ?>" role="heading">

                            <?php if ($settings['accordion_icon']['value']) : ?>
                                <span class="bdt-accordion-icon bdt-flex-align-<?php echo esc_attr($settings['icon_align']); ?>" aria-hidden="true">

                                    <?php if ($is_new || $migrated) : ?>
                                        <span class="bdt-accordion-icon-closed">
                                            <?php Icons_Manager::render_icon($settings['accordion_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>
                                        </span>
                                    <?php else : ?>
                                        <i class="bdt-accordion-icon-closed <?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>

                                    <?php if ($active_is_new || $active_migrated) : ?>
                                        <span class="bdt-accordion-icon-opened">
                                            <?php Icons_Manager::render_icon($settings['accordion_active_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>
                                        </span>
                                    <?php else : ?>
                                        <i class="bdt-accordion-icon-opened <?php echo esc_attr($settings['icon_active']); ?>" aria-hidden="true"></i>
                                    <?php endif; ?>

                                </span>
                            <?php endif; ?>

                            <span class="bdt-title bdt-flex bdt-flex-middle">

                                <?php if (!empty($item['repeater_icon']['value']) and $settings['show_custom_icon'] == 'yes') : ?>
                                    <span class="bdt-accordion-custom-icon">
                                        <?php Icons_Manager::render_icon($item['repeater_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>
                                    </span>
                                <?php endif; ?>
                                <?php echo esc_html($item['tab_title']); ?>
                            </span>

                        </<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
                        <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                            <?php
                            if ('custom' == $item['source'] and !empty($item['tab_content'])) {
                                echo $this->parse_text_editor($item['tab_content']);
                            } elseif ("elementor" == $item['source'] and !empty($item['template_id'])) {
                                echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($item['template_id']);
                                echo element_pack_template_edit_link($item['template_id']);
                            } elseif ('anywhere' == $item['source'] and !empty($item['anywhere_id'])) {
                                echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($item['anywhere_id']);
                                echo element_pack_template_edit_link($item['anywhere_id']);
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
<?php
    }

    protected function content_template() {
    }
}
