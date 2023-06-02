<?php

namespace ElementPack\Modules\Tabs\Widgets;

use Elementor\Repeater;
use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use ElementPack\Element_Pack_Loader;
use ElementPack\Includes\Controls\SelectInput\Dynamic_Select;

if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class Tabs extends Module_Base {

    public function get_name() {
        return 'bdt-tabs';
    }

    public function get_title() {
        return BDTEP . esc_html__('Tabs', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-tabs';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['tabs', 'toggle', 'accordion'];
    }

    public function is_reload_preview_required() {
        return false;
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-tabs'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/1BmS_8VpBF4';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Tabs', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'tab_layout',
            [
                'label'   => esc_html__('Layout', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Top (Default)', 'bdthemes-element-pack'),
                    'bottom'  => esc_html__('Bottom', 'bdthemes-element-pack'),
                    'left'    => esc_html__('Left', 'bdthemes-element-pack'),
                    'right'   => esc_html__('Right', 'bdthemes-element-pack'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => __('Title', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => __('Tab Title', 'bdthemes-element-pack'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_sub_title',
            [
                'label'       => __('Sub Title', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_select_icon',
            [
                'label'            => __('Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'tab_icon',
            ]
        );

        $repeater->add_control(
            'source',
            [
                'label'   => esc_html__('Select Source', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'        => esc_html__('Custom Content', 'bdthemes-element-pack'),
                    "elementor"     => esc_html__('Elementor Template', 'bdthemes-element-pack'),
                    'anywhere'      => esc_html__('AE Template', 'bdthemes-element-pack'),
                    'external_link' => esc_html__('External Link', 'bdthemes-element-pack'),
                    'link_widget'  => esc_html__('Link Widget', 'bdthemes-element-pack'),
                ],
            ]
        );



        $repeater->add_control(
            'tab_content',
            [
                'type'      => Controls_Manager::WYSIWYG,
                'dynamic'   => ['active' => true],
                'default'   => __('Tab Content', 'bdthemes-element-pack'),
                'condition' => ['source' => 'custom'],
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
            'source_link_widget',
            [
                'label'   => __('Link Widget ID', 'bdthemes-element-pack') . BDTEP_NC,
                'type'    => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'condition'   => ['source' => "link_widget"],
            ]
        );

        $repeater->add_control(
            'source_link_widget_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('Note: Please insert multiple widgets on the same section then place your widgets id here. You must use Link widget on every Items. Results will visible on the front page.', 'bdthemes-element-pack'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'   => ['source' => "link_widget"],
            ]
        );

        $repeater->add_control(
            'external_link',
            [
                'label'       => esc_html__('External Link', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => ['active' => true],
                'placeholder' => esc_html__('https://your-link.com', 'bdthemes-element-pack'),
                'default'     => [
                    'url' => '#',
                ],
            ]
        );


        $this->add_control(
            'tabs',
            [
                'label'       => __('Tab Items', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'   => __('Tab #1', 'bdthemes-element-pack'),
                        'tab_content' => __('I am tab #1 content. Click edit button to change this text. One morning, when Gregor Samsa woke from troubled dreams, he found himself transformed in his bed into a horrible vermin.', 'bdthemes-element-pack'),
                    ],
                    [
                        'tab_title'   => __('Tab #2', 'bdthemes-element-pack'),
                        'tab_content' => __('I am tab #2 content. Click edit button to change this text. A collection of textile samples lay spread out on the table - Samsa was a travelling salesman.', 'bdthemes-element-pack'),
                    ],
                    [
                        'tab_title'   => __('Tab #3', 'bdthemes-element-pack'),
                        'tab_content' => __('I am tab #3 content. Click edit button to change this text. Drops of rain could be heard hitting the pane, which made him feel quite sad. How about if I sleep a little bit longer and forget all this nonsense.', 'bdthemes-element-pack'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'align',
            [
                'label'     => __('Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    ''        => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'condition' => [
                    'tab_layout' => ['default', 'bottom']
                ],
            ]
        );

        $this->add_responsive_control(
            'item_spacing',
            [
                'label'     => __('Nav Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item'                                                                 => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tab'                                                                                => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tab.bdt-tab-left .bdt-tabs-item, {{WRAPPER}} .bdt-tab.bdt-tab-right .bdt-tabs-item' => 'padding-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tab.bdt-tab-left, {{WRAPPER}} .bdt-tab.bdt-tab-right'                               => 'margin-top: -{{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->add_responsive_control(
            'nav_spacing',
            [
                'label'     => __('Nav Width', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-grid:not(.bdt-grid-stack) .bdt-tab-wrapper' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'tab_layout' => ['left', 'right']
                ],
            ]
        );

        $this->add_responsive_control(
            'content_spacing',
            [
                'label'     => __('Content Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs-default .bdt-switcher-wrapper'                              => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tabs-bottom .bdt-switcher-wrapper'                               => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tabs-left .bdt-grid:not(.bdt-grid-stack) .bdt-switcher-wrapper'  => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tabs-right .bdt-grid:not(.bdt-grid-stack) .bdt-switcher-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tabs-left .bdt-grid-stack .bdt-switcher-wrapper,
                    {{WRAPPER}} .bdt-tabs-right .bdt-grid-stack .bdt-switcher-wrapper'      => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
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
            'active_item',
            [
                'label' => __('Active Item No', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::NUMBER,
                'min'   => 1,
                'max'   => 20,
            ]
        );

        $this->add_control(
            'tab_transition',
            [
                'label'   => esc_html__('Transition', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'options' => element_pack_transition_options(),
                'default' => '',
            ]
        );

        $this->add_control(
            'duration',
            [
                'label'     => __('Animation Duration', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 501,
                        'step' => 50,
                    ],
                ],
                'default'   => [
                    'size' => 200,
                ],
                'condition' => [
                    'tab_transition!' => ''
                ],
            ]
        );

        $this->add_control(
            'media',
            [
                'label'       => __('Turn On Horizontal mode', 'bdthemes-element-pack'),
                'description' => __('It means that tabs nav will switch vertical to horizontal on mobile mode', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => [
                    960 => [
                        'title' => __('On Tablet', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-device-tablet',
                    ],
                    768 => [
                        'title' => __('On Mobile', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-device-mobile',
                    ],
                ],
                'default'     => 960,
                'condition'   => [
                    'tab_layout' => ['left', 'right']
                ],
            ]
        );

        $this->add_control(
            'nav_sticky_mode',
            [
                'label'     => esc_html__('Tabs Nav Sticky', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'tab_layout!' => 'bottom',
                ],
            ]
        );

        $this->add_control(
            'nav_sticky_offset',
            [
                'label'     => esc_html__('Offset', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                ],
                'condition' => [
                    'nav_sticky_mode' => 'yes',
                    'tab_layout!'     => 'bottom',
                ],
            ]
        );

        $this->add_control(
            'nav_sticky_on_scroll_up',
            [
                'label'       => esc_html__('Sticky on Scroll Up', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('Set sticky options when you scroll up your mouse.', 'bdthemes-element-pack'),
                'condition'   => [
                    'nav_sticky_mode' => 'yes',
                    'tab_layout!'     => 'bottom',
                ],
            ]
        );

        $this->add_control(
            'fullwidth_on_mobile',
            [
                'label'       => esc_html__('Fullwidth Nav on Mobile', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('If you have long test tab so this can help design issue.', 'bdthemes-element-pack')
            ]
        );

        $this->add_control(
            'swiping_on_mobile',
            [
                'label'       => esc_html__('Swiping Tab on Mobile', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('If you set yes so tab will swiping on mobile device by touch.', 'bdthemes-element-pack'),
                'default'     => 'yes',
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
                    'nav_sticky_mode!' => 'yes',
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
                    'size' => 1500,
                ],
                'condition'  => [
                    'active_hash'      => 'yes',
                    'nav_sticky_mode!' => 'yes',
                ],
            ]
        );


        $this->add_control(
            'tabs_match_height',
            [
                'label'       => esc_html__('Equal Tab Height', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SWITCHER,
                'description' => esc_html__('You can on/off tab item equal height feature.', 'bdthemes-element-pack'),
                'default'     => 'yes',
                'separator'   => 'before',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __('Tab', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_title_style');

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'title_background',
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => __('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title',
            ]
        );

        $this->add_control(
            'title_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item .bdt-tabs-item-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'hover_title_background',
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .bdt-tab .bdt-tabs-item:hover .bdt-tabs-item-title',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'hover_title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item:hover .bdt-tabs-item-title'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item:hover .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_hover_border',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack') . BDTEP_NC,
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'title_border_border!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item:hover .bdt-tabs-item-title' => 'border-color: {{VALUE}};',
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
            'active_style_color',
            [
                'label'     => __('Style Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title:after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'active_title_background',
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'active_title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'active_title_shadow',
                'selector' => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'active_title_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title',
            ]
        );

        $this->add_control(
            'active_title_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tabs-item-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_title',
            [
                'label' => __('Sub Title', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_sub_title_style');

        $this->start_controls_tab(
            'tab_sub_title_normal',
            [
                'label' => __('Normal', 'bdthemes-element-pack'),
            ]
        );


        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tab-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_spacing',
            [
                'label'     => __('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tab-sub-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .bdt-tab .bdt-tab-sub-title',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_sub_title_hover',
            [
                'label' => __('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'hover_sub_title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item:hover .bdt-tab-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_sub_title_active',
            [
                'label' => __('Active', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'active_sub_title_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item.bdt-active .bdt-tab-sub-title' => 'color: {{VALUE}};',
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

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'content_background_color',
                'types'     => ['classic', 'gradient'],
                'selector'  => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
                'separator' => 'after',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'content_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
            ]
        );

        $this->add_control(
            'content_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
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
                    '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .bdt-tabs .bdt-switcher-item-content',
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label' => __('Icon', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
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
            'icon_align',
            [
                'label'   => __('Alignment', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'  => [
                        'title' => __('Start', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => __('End', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tab .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
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
                'default'   => [
                    'size' => 8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item-title .bdt-button-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item-title .bdt-button-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
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
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item:hover .bdt-tabs-item-title i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item:hover .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
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
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item.bdt-active .bdt-tabs-item-title i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-tabs .bdt-tabs-item.bdt-active .bdt-tabs-item-title svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_tabs_sticky_style',
            [
                'label' => __('Sticky', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sticky_background',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-tabs > div > .bdt-sticky.bdt-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'sticky_shadow',
                'selector' => '{{WRAPPER}} .bdt-tabs > div > .bdt-sticky.bdt-active',
            ]
        );

        $this->add_control(
            'sticky_border_radius',
            [
                'label'      => __('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-tabs > div > .bdt-sticky.bdt-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings    = $this->get_settings_for_display();
        $id          = $this->get_id();
        $stickyClass = '';
        if (isset($settings['nav_sticky_mode']) && $settings['nav_sticky_mode'] == 'yes') {
            $stickyClass = 'bdt-sticky-custom';
        }


        // source_link_widget
        $link_widget_arr = [];
        foreach ($settings['tabs'] as $index => $item) {
            $link_widget_arr[$index] = $item['source_link_widget'];
        }

        // print_r($link_widget_arr);


        $this->add_render_attribute(
            [
                'tabs_sticky_data' => [
                    'data-settings' => [
                        wp_json_encode(
                            array_filter([
                                "id"                => 'bdt-tabs-' . $this->get_id(),
                                "status"            => $stickyClass,
                                "activeHash"        => $settings['active_hash'],
                                "hashTopOffset"     => (isset($settings['hash_top_offset']['size']) && !empty($settings['hash_top_offset']['size'])) ? $settings['hash_top_offset']['size'] : 70,
                                "hashScrollspyTime" => (isset($settings['hash_scrollspy_time']['size']) ? $settings['hash_scrollspy_time']['size'] : 1500),
                                "navStickyOffset"   => (isset($settings['nav_sticky_offset']['size']) ? $settings['nav_sticky_offset']['size'] : 1),
                                "linkWidgetSettings" => ($item['source'] == 'link_widget') ? $link_widget_arr : NULL,
                                "activeItem" => (!empty($settings['active_item'])) ? $settings['active_item'] : NULL,
                                "linkWidgetId" => $this->get_id(),
                            ])
                        ),
                    ],
                ],
            ]
        );

        $this->add_render_attribute('tabs', 'id', 'bdt-tabs-' . esc_attr($id));
        $this->add_render_attribute('tabs', 'class', 'bdt-tabs ');
        $this->add_render_attribute('tabs', 'class', 'bdt-tabs-' . $settings['tab_layout']);

        if ($settings['fullwidth_on_mobile']) {
            $this->add_render_attribute('tabs', 'class', 'fullwidth-on-mobile');
        }

?>


        <div class="bdt-tabs-area">

            <div <?php echo $this->get_render_attribute_string('tabs'); ?> <?php echo $this->get_render_attribute_string('tabs_sticky_data'); ?>>
                <?php
                if ('left' == $settings['tab_layout'] or 'right' == $settings['tab_layout']) {
                    echo '<div class="bdt-grid-collapse"  bdt-grid>';
                }
                ?>

                <?php if ('bottom' == $settings['tab_layout']) : ?>
                    <?php $this->tabs_content(); ?>
                <?php endif; ?>

                <?php $this->desktop_tab_items(); ?>


                <?php if ('bottom' != $settings['tab_layout']) : ?>
                    <?php $this->tabs_content(); ?>
                <?php endif; ?>

                <?php
                if ('left' == $settings['tab_layout'] or 'right' == $settings['tab_layout']) {
                    echo "</div>";
                }
                ?>
                <a href="#" id="bottom-anchor-<?php echo esc_attr($id); ?>" data-bdt-hidden></a>
            </div>
        </div>
    <?php
    }

    public function tabs_content() {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();

        $this->add_render_attribute('switcher-width', 'class', 'bdt-switcher-wrapper');

        if ('left' == $settings['tab_layout'] or 'right' == $settings['tab_layout']) {

            if (768 == $settings['media']) {
                $this->add_render_attribute('switcher-width', 'class', 'bdt-width-expand@s');
            } else {
                $this->add_render_attribute('switcher-width', 'class', 'bdt-width-expand@m');
            }
        }

    ?>

        <div <?php echo $this->get_render_attribute_string('switcher-width'); ?>>
            <div id="bdt-tab-content-<?php echo esc_attr($id); ?>" class="bdt-switcher bdt-switcher-item-content">
                <?php foreach ($settings['tabs'] as $index => $item) : ?>
                    <?php

                    $tab_count = $index + 1;
                    $tab_count_active = '';
                    if ($tab_count === $settings['active_item']) {
                        $tab_count_active = 'bdt-active';
                    }

                    ?>
                    <div class="<?php echo $tab_count_active; ?>" data-content-id="<?php echo strtolower(preg_replace('#[ -]+#', '-', trim(preg_replace("![^a-z0-9]+!i", " ", esc_html($item['tab_title']))))); ?>">
                        <div>
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

    public function desktop_tab_items() {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();

        if ('left' == $settings['tab_layout'] or 'right' == $settings['tab_layout']) {

            $this->add_render_attribute('tabs-width', 'class', 'bdt-tab-wrapper');

            if ('right' == $settings['tab_layout']) {
                $this->add_render_attribute('tabs-width', 'class', 'bdt-flex-last@m');
            }

            if (768 == $settings['media']) {
                $this->add_render_attribute('tabs-width', 'class', 'bdt-width-auto@s');
                if ('right' == $settings['tab_layout']) {
                    $this->add_render_attribute('tabs-width', 'class', 'bdt-flex-last');
                }
            } else {
                $this->add_render_attribute('tabs-width', 'class', 'bdt-width-auto@m');
            }
        }

        $this->add_render_attribute(
            [
                'tab-settings' => [
                    'class' => [
                        'bdt-tab',
                        ('' !== $settings['tab_layout']) ? 'bdt-tab-' . $settings['tab_layout'] : '',
                        ('' != $settings['align'] and 'left' != $settings['tab_layout'] and 'right' != $settings['tab_layout']) ? (('justify' != $settings['align']) ? 'bdt-flex-' . $settings['align'] : 'bdt-child-width-expand') : ''
                    ]
                ]
            ]
        );
        
        $this->add_render_attribute('tab-settings', 'data-bdt-tab', 'connect: #bdt-tab-content-' . esc_attr($id) . ';');

        if (isset($settings['tab_transition']) and $settings['tab_transition']) {
            $this->add_render_attribute('tab-settings', 'data-bdt-tab', 'animation: bdt-animation-' . $settings['tab_transition'] . ';');
        }
        if (isset($settings['duration']['size']) and $settings['duration']['size']) {
            $this->add_render_attribute('tab-settings', 'data-bdt-tab', 'duration: ' . $settings['duration']['size'] . ';');
        }
        if (isset($settings['media']) and $settings['media']) {
            $this->add_render_attribute('tab-settings', 'data-bdt-tab', 'media: ' . intval($settings['media']) . ';');
        }
        if ('yes' != $settings['swiping_on_mobile']) {
            $this->add_render_attribute('tab-settings', 'data-bdt-tab', 'swiping: false;');
        }

        if ($settings['tabs_match_height']) {
            $this->add_render_attribute('tab-settings', 'data-bdt-height-match', 'target: > .bdt-tabs-item > .bdt-tabs-item-title; row: false;');
        }

        if (isset($settings['nav_sticky_mode']) && 'yes' == $settings['nav_sticky_mode']) {
            $this->add_render_attribute('tabs-sticky', 'data-bdt-sticky', 'bottom: #bottom-anchor-' . $id . ';');

            if ($settings['nav_sticky_offset']['size']) {
                $this->add_render_attribute('tabs-sticky', 'data-bdt-sticky', 'offset: ' . $settings['nav_sticky_offset']['size'] . ';');
            }
            if ($settings['nav_sticky_on_scroll_up']) {
                $this->add_render_attribute('tabs-sticky', 'data-bdt-sticky', 'show-on-up: true; animation: bdt-animation-slide-top');
            }
        }

    ?>
        <div <?php echo ($this->get_render_attribute_string('tabs-width')); ?>>
            <div <?php echo ($this->get_render_attribute_string('tabs-sticky')); ?>>
                <div <?php echo ($this->get_render_attribute_string('tab-settings')); ?>>
                    <?php foreach ($settings['tabs'] as $index => $item) :

                        $tab_count = $index + 1;
                        $tab_id = ($item['tab_title']) ? element_pack_string_id($item['tab_title']) : $id . $tab_count;
                        // $tab_id = 'bdt-tab-' . $tab_id;
                        $tab_id = 'bdt-tab-' . strtolower(preg_replace('#[ -]+#', '-', trim(preg_replace("![^a-z0-9]+!i", " ", $tab_id))));

                        $this->add_render_attribute('tabs-item', 'class', 'bdt-tabs-item', true);
                        if (empty($item['tab_title'])) {
                            $this->add_render_attribute('tabs-item', 'class', 'bdt-has-no-title');
                        }
                        if ($tab_count === $settings['active_item']) {
                            $this->add_render_attribute('tabs-item', 'class', 'bdt-active');
                        }

                        if (!isset($item['tab_icon']) && !Icons_Manager::is_migration_allowed()) {
                            // add old default
                            $item['tab_icon'] = 'fas fa-book';
                        }

                        $migrated = isset($item['__fa4_migrated']['tab_select_icon']);
                        $is_new   = empty($item['tab_icon']) && Icons_Manager::is_migration_allowed();

                        $this->add_render_attribute('tab-link', 'data-title', strtolower(preg_replace('#[ -]+#', '-', trim(preg_replace("![^a-z0-9]+!i", " ", esc_html($item['tab_title']))))), true);

                        if (empty($item['tab_title'])) {
                            $this->add_render_attribute('tab-link', 'data-title', $this->get_id() . '-' . $tab_count, true);
                        }

                        $this->add_render_attribute('tab-link', 'class', 'bdt-tabs-item-title', true);
                        $this->add_render_attribute('tab-link', 'id', esc_attr($tab_id), true);
                        $this->add_render_attribute('tab-link', 'data-tab-index', esc_attr($index), true);
                        if ('external_link' == $item['source'] and '' !== $item['external_link']['url']) {
                            $target = $item['external_link']['is_external'] ? '_blank' : '_self';
                            $this->add_render_attribute('tab-link', 'href', $item['external_link']['url'], true);
                            $this->add_render_attribute('tab-link', 'onclick', "window.open('" . $item['external_link']['url'] . "', '$target')", true);
                        } else {
                            $this->remove_render_attribute('tab-link', 'onclick');
                            $this->add_render_attribute('tab-link', 'href', '#', true);
                        }

                    ?>
                        <div <?php echo $this->get_render_attribute_string('tabs-item'); ?>>
                            <a <?php echo $this->get_render_attribute_string('tab-link'); ?>>
                                <div class="bdt-tab-text-wrapper bdt-flex-column">

                                    <div class="bdt-tab-title-icon-wrapper">

                                        <?php if ('' != $item['tab_select_icon']['value'] and 'left' == $settings['icon_align']) : ?>
                                            <span class="bdt-button-icon-align-<?php echo esc_html($settings['icon_align']); ?>">

                                                <?php if ($is_new || $migrated) :
                                                    Icons_Manager::render_icon($item['tab_select_icon'], [
                                                        'aria-hidden' => 'true',
                                                        'class'       => 'fa-fw'
                                                    ]);
                                                else : ?>
                                                    <i class="<?php echo esc_attr($item['tab_icon']); ?>" aria-hidden="true"></i>
                                                <?php endif; ?>

                                            </span>
                                        <?php endif; ?>

                                        <?php if ($item['tab_title']) : ?>
                                            <span class="bdt-tab-text">
                                                <?php echo wp_kses($item['tab_title'], element_pack_allow_tags('title')); ?>
                                            </span>
                                        <?php endif; ?>

                                        <?php if ('' != $item['tab_select_icon']['value'] and 'right' == $settings['icon_align']) : ?>
                                            <span class="bdt-button-icon-align-<?php echo esc_html($settings['icon_align']); ?>">

                                                <?php if ($is_new || $migrated) :
                                                    Icons_Manager::render_icon($item['tab_select_icon'], [
                                                        'aria-hidden' => 'true',
                                                        'class'       => 'fa-fw'
                                                    ]);
                                                else : ?>
                                                    <i class="<?php echo esc_attr($item['tab_icon']); ?>" aria-hidden="true"></i>
                                                <?php endif; ?>

                                            </span>
                                        <?php endif; ?>

                                    </div>

                                    <?php if ($item['tab_sub_title'] and $item['tab_title']) : ?>
                                        <span class="bdt-tab-sub-title bdt-text-small">
                                            <?php echo wp_kses($item['tab_sub_title'], element_pack_allow_tags('title')); ?>
                                        </span>
                                    <?php endif; ?>

                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
<?php
    }
}
