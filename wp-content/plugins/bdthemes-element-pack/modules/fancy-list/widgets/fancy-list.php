<?php

namespace ElementPack\Modules\FancyList\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Icons_Manager;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use ElementPack\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Fancy_List extends Module_Base {

    public function get_name() {
        return 'bdt-fancy-list';
    }

    public function get_title() {
        return BDTEP . esc_html__('Fancy List', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-fancy-list';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-fancy-list'];
        }
    }

    public function get_keywords() {
        return ['fancy', 'list', 'group', 'fl'];
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/faIeyW7LOJ8';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Fancy List', 'bdthemes-dark-mode'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __('Title', 'bdthemes-element-pack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('List Item', 'bdthemes-element-pack'),
                'default' => __('List Item', 'bdthemes-element-pack'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'text_details',
            [
                'label' => __('Sub Title', 'bdthemes-element-pack'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __('Sub Title', 'bdthemes-element-pack'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'list_icon',
            [
                'label' => __('Icon', 'bdthemes-element-pack'),
                'type' => Controls_Manager::ICONS,
                'label_block' => false,
                'skin' => 'inline',

            ]
        );

        $repeater->add_control(
            'img',
            [
                'label' => __('Image', 'bdthemes-element-pack'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => false,

            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Link', 'bdthemes-element-pack'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'placeholder' => __('https://your-link.com', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_list',
            [
                'label' => '',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => __('List Item #1', 'bdthemes-element-pack'),
                    ],
                    [
                        'text' => __('List Item #2', 'bdthemes-element-pack'),
                    ],
                    [
                        'text' => __('List Item #3', 'bdthemes-element-pack'),
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, list_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}} {{{ text }}}',
            ]
        );

        $this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Columns', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'           => Controls_Manager::SELECT,
				'default'        => '1',
				'tablet_default' => '1',
				'mobile_default' => '1',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list ul.custom-list-group' => 'grid-template-columns: repeat({{SIZE}}, 1fr);',
                ],
                'separator' => 'before',
			]
		);

        $this->add_responsive_control(
            'list_item_space_between',
            [
                'label' => __('Grid Gap', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list ul.custom-list-group' => 'grid-gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'show_number_icon',
            [
                'label' => __('Show Number Count', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'title_tags',
            [
                'label'   => __('Title HTML Tag', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h4',
                'options' => element_pack_title_tags(),
            ]
        );

        $this->add_control(
            'content_position',
            [
                'label' => __('Content Position', 'bdthemes-element-pack') . BDTEP_NC,
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
                'toggle' => false,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'bdt-content-position--',
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'list_item_align',
            [
                'label' => __('Alignment', 'bdthemes-element-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_list_items',
            [
                'label' => __('List Item', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs(
            'list_item_tabs'
        );

        $this->start_controls_tab(
            'list_item_tabs_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'list_item_bg_color',
                'selector'  => '{{WRAPPER}} .bdt-fancy-list .flex-wrap',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'list_item_border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .custom-list-group li .flex-wrap',
            ]
        );

        $this->add_responsive_control(
            'list_item_border_radius',
            [
                'label' => __('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group li .flex-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'list_item_padding',
            [
                'label' => __('Padding', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group li .flex-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow',
                'label' => __('Box Shadow', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .custom-list-group li .flex-wrap',
            ]
        );

        $this->add_responsive_control(
            'list_item_border',
            [
                'label' => __('Height', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .flex-wrap' => 'min-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'list_item_tabs_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-element-pack') . BDTEP_NC,
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'list_item_hover_bg_color',
                'selector'  => '{{WRAPPER}} .bdt-fancy-list .flex-wrap:hover',
            ]
        );

        $this->add_control(
            'list_item_hover_border',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .flex-wrap:hover' => 'border-color: {{VALUE}} !important',
                ],
                'condition' => [
                    'list_item_border_border!' => ''
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'list_item_box_shadow_hover',
                'label' => __('Box Shadow', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .custom-list-group li .flex-wrap:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Number Count', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_number_icon' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_number_icon_style');

        $this->start_controls_tab(
            'tab_number_icon_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'number_icon_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .flex-wrap .number-icon-area span' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .number-icon-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_number_border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .number-icon-area',
            ]
        );

        $this->add_responsive_control(
            'icon_number_border_radius',
            [
                'label' => __('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .number-icon-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_number_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list .number-icon-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_number_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list .number-icon-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'number_icon_typography',
                'selector' => '{{WRAPPER}} .bdt-fancy-list .number-icon-area span',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_number_icon_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack') . BDTEP_NC,
            ]
        );

        $this->add_control(
            'number_icon_color_hover',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group a:hover .flex-wrap .number-icon-area span' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_control(
            'number_icon_bg_color_hover',
            [
                'label' => __('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group a:hover .number-icon-area' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'number_icon_border_color_hover',
            [
                'label' => __('Border Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group a:hover .number-icon-area' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'icon_number_border_border!' => ''
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => __('Title / Subtitle', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_mode_style');
        $this->start_controls_tab(
            'tab_normal_mode_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label' => __('Title', 'bdthemes-element-pack'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .list-text .bdt-list-title ' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bdt-fancy-list .list-text .bdt-list-title',
            ]
        );

        $this->add_control(
            'sub_title_heading',
            [
                'label' => __('Sub Title', 'bdthemes-element-pack'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'des_text_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .list-text-des' => 'color: {{VALUE}} ',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .bdt-fancy-list  .list-text-des',
            ]
        );

        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list  .list-text-des' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_hover_mode_normal',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => __('Title Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-text .bdt-list-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => __('Sub Title Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-text-des' => 'color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __('Icon', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_mode_style1');
        $this->start_controls_tab(
            'tab_normal_mode_normal1',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#242424',
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .list-icon i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .bdt-fancy-list .list-icon svg *' => 'fill: {{VALUE}} ; stroke: {{VALUE}} ;'
                ],
            ]
        );

        $this->add_control(
            'right_icon_bg_color',
            [
                'label' => __('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .list-icon ' => 'background: {{VALUE}} ;'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .custom-list-group .list-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .list-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .list-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list .list-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .bdt-fancy-list .custom-list-group .list-icon',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_hover_mode_normal1',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_color_hover',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-icon i' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-icon svg *' => 'fill: {{VALUE}}  !important; stroke: {{VALUE}}  ; '
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color_hover',
            [
                'label' => __('Background Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-icon' => 'background-color: {{VALUE}} ;',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color_hover',
            [
                'label' => __('Border Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .custom-list-group .bdt-list-wrap:hover .list-icon' => 'border-color: {{VALUE}} ;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __('Image', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => esc_html__('Border', 'bdthemes-element-pack'),
                'selector' => '{{WRAPPER}} .bdt-fancy-list .image-area img',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label' => __('Border Radius', 'bdthemes-element-pack'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-list .image-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack') . BDTEP_NC,
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-list .image-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('icon_list', 'class', 'list-icon');
        $this->add_render_attribute('list_item', 'class', 'elementor-icon-list-item');
?>
        <div class="bdt-fancy-list">
            <ul class="bdt-list custom-list-group" <?php echo $this->get_render_attribute_string('icon_list'); ?>>
                <?php
                $i = 1;
                foreach ($settings['icon_list'] as $index => $item) :
                    $repeater_setting_key = $this->get_repeater_setting_key('text', 'icon_list', $index);
                    $this->add_render_attribute($repeater_setting_key, 'class', 'elementor-icon-list-text');
                    $this->add_inline_editing_attributes($repeater_setting_key);

                    $this->add_render_attribute('list_title_tags', 'class', 'bdt-list-title', true);
                ?>
                    <li>
                        <?php
                        if (!empty($item['link']['url'])) {
                            $link_key = 'link_' . $index;

                            $this->add_render_attribute($link_key, 'href', $item['link']['url']);

                            if ($item['link']['is_external']) {
                                $this->add_render_attribute($link_key, 'target', '_blank');
                            }

                            if ($item['link']['nofollow']) {
                                $this->add_render_attribute($link_key, 'rel', 'nofollow');
                            }

                            echo '<a class="bdt-list-wrap" ' . $this->get_render_attribute_string($link_key) . '>';
                        } else {
                            echo '<div class="bdt-list-wrap">';
                        }
                        ?>
                        <div class="bdt-flex  flex-wrap">
                            <?php
                            if ($settings['show_number_icon'] == 'yes') {
                                echo '<div class="number-icon-area"><span>'; ?>
                                <?php echo $i++; ?>
                            <?php echo '</span></div>';
                            }
                            ?>
                            <?php
                            if (!empty($item['img']['url'])) {
                                echo '<div class=" image-area"> <img src=" ' . $item['img']['url'] . '" alt="' . esc_html($item['text']) . '"> </div>';
                            }
                            ?>
                            <div class="list-text ">
                                <<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('list_title_tags'); ?>>
                                    <?php echo wp_kses_post($item['text']); ?>
                                </<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?>>
                                <p class="list-text-des"> <?php echo $item['text_details']; ?></p>
                            </div>
                            <?php if (!empty($item['list_icon']['value'])) : ?>
                                <div class="list-icon">
                                    <?php Icons_Manager::render_icon($item['list_icon'], ['aria-hidden' => 'true']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php
                        if (!empty($item['link']['url'])) :
                        ?>
                            </a>
                        <?php else : ?>
                        </div>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
<?php
    }
}
