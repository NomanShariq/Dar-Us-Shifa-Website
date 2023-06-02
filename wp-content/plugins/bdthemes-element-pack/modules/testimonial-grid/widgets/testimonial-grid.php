<?php

namespace ElementPack\Modules\TestimonialGrid\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly
class Testimonial_Grid extends Module_Base {

    public function get_name() {
        return 'bdt-testimonial-grid';
    }

    public function get_title() {
        return BDTEP . esc_html__('Testimonial Grid', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-testimonial-grid';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['testimonial', 'grid'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['element-pack-font', 'ep-testimonial-grid'];
        }
    }
   
    public function get_script_depends() {
        return ['imagesloaded'];
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/pYMTXyDn8g4';
    }

    public function _register_controls() {

        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__('Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => esc_html__('Layout', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => esc_html__('Default', 'bdthemes-element-pack'),
                    '2' => esc_html__('Top Avatar', 'bdthemes-element-pack'),
                    '3' => esc_html__('Reverse', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__('Columns', 'bdthemes-element-pack'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '2',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'posts',
            [
                'label'   => esc_html__('Posts Per Page', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        $this->add_control(
        	'show_pagination',
        	[
        		'label' => esc_html__( 'Pagination', 'bdthemes-element-pack' ),
        		'type'  => Controls_Manager::SWITCHER,
        	]
        );

        $this->add_responsive_control(
            'item_gap',
            [
                'label'     => esc_html__('Column Gap', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 35,
                ],
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid > .bdt-grid'     => 'margin-left: -{{SIZE}}px',
                    '{{WRAPPER}} .bdt-testimonial-grid > .bdt-grid > *' => 'padding-left: {{SIZE}}px',
                ],
            ]
        );

        $this->add_responsive_control(
            'row_gap',
            [
                'label'     => esc_html__('Row Gap', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 35,
                ],
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid > .bdt-grid'     => 'margin-top: -{{SIZE}}px',
                    '{{WRAPPER}} .bdt-testimonial-grid > .bdt-grid > *' => 'margin-top: {{SIZE}}px',
                ],
            ]
        );

        $this->add_control(
            'show_image',
            [
                'label'   => esc_html__('Testimonial Image', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'   => esc_html__('Title', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_address',
            [
                'label'   => esc_html__('Address', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'meta_multi_line',
            [
                'label'   => esc_html__('Meta Multiline', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_comma',
            [
                'label' => esc_html__('Show Comma After Title', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_text',
            [
                'label'   => esc_html__('Text', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'text_limit',
            [
                'label'       => esc_html__('Text Limit', 'bdthemes-element-pack'),
                'description' => esc_html__('It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 25,
                'condition'   => [
                    'show_text' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'strip_shortcode',
            [
                'label'   => esc_html__('Strip Shortcode', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'condition'   => [
                    'show_text' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_rating',
            [
                'label'   => esc_html__('Rating', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_filter_bar',
            [
                'label' => esc_html__('Filter Bar', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'item_match_height',
            [
                'label' => esc_html__('Item Match Height', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'item_masonry',
            [
                'label' => esc_html__('Masonry', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_query',
            [
                'label' => esc_html__('Query', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'source',
            [
                'label'       => _x('Source', 'Posts Query Control', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SELECT,
                'options'     => [
                    ''        => esc_html__('Show All', 'bdthemes-element-pack'),
                    'by_name' => esc_html__('Manual Selection', 'bdthemes-element-pack'),
                ],
                'label_block' => true,
            ]
        );


        $post_categories = get_terms('testimonial_categories');

        $post_options = [];
        foreach ( $post_categories as $category ) {
            $post_options[$category->slug] = $category->name;
        }

        $this->add_control(
            'post_categories',
            [
                'label'       => esc_html__('Categories', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SELECT2,
                'options'     => $post_options,
                'default'     => [],
                'label_block' => true,
                'multiple'    => true,
                'condition'   => [
                    'source' => 'by_name',
                ],
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'   => esc_html__('Order by', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date'     => esc_html__('Date', 'bdthemes-element-pack'),
                    'title'    => esc_html__('Title', 'bdthemes-element-pack'),
                    'category' => esc_html__('Category', 'bdthemes-element-pack'),
                    'rand'     => esc_html__('Random', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->add_control(
            'order',
            [
                'label'   => esc_html__('Order', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC' => esc_html__('Descending', 'bdthemes-element-pack'),
                    'ASC'  => esc_html__('Ascending', 'bdthemes-element-pack'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('Item', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'item_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'item_border',
                'label'       => esc_html__('Border Color', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'item_hover_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'item_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_shadow',
                'selector' => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-item-inner:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => esc_html__('Image', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'image_border',
                'label'       => esc_html__('Border Color', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-img-wrapper',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'image_hover_border_color',
            [
                'label'     => esc_html__('Hover Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'image_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-img-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-img-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label' => esc_html__('Size', 'bdthemes-element-pack') . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-img-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label'     => esc_html__('Title', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_address',
            [
                'label'     => esc_html__('Address', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_address' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'address_color',
            [
                'label'     => esc_html__('Company Name/Address Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-address' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'address_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-address' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'address_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-address',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label'     => esc_html__('Text', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_text' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-grid .bdt-testimonial-grid-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_rating',
            [
                'label'     => esc_html__('Rating', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_rating' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rating_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e7e7e7',
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating .bdt-rating-item' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'active_rating_color',
            [
                'label'     => esc_html__('Active Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFCC00',
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating.bdt-rating-1 .bdt-rating-item:nth-child(1)'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating.bdt-rating-2 .bdt-rating-item:nth-child(-n+2)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating.bdt-rating-3 .bdt-rating-item:nth-child(-n+3)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating.bdt-rating-4 .bdt-rating-item:nth-child(-n+4)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating.bdt-rating-5 .bdt-rating-item:nth-child(-n+5)' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_margin',
            [
                'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-grid .bdt-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_size',
            [
                'label' => esc_html__('Size', 'bdthemes-element-pack') . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .bdt-rating .bdt-rating-item' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_spacing',
            [
                'label' => esc_html__('Spacing', 'bdthemes-element-pack') . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .bdt-rating .bdt-rating-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_design_filter',
            [
                'label'     => esc_html__('Filter Bar', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_filter_bar' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'filter_alignment',
            [
                'label'     => esc_html__('Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'center',
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters-wrapper' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_filter',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .bdt-ep-grid-filters li',
            ]
        );

        $this->add_control(
            'filter_spacing',
            [
                'label'     => esc_html__('Bottom Space', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_style_desktop');

        $this->start_controls_tab(
            'filter_tab_desktop',
            [
                'label' => __('Desktop', 'bdthemes-element-pack')
            ]
        );

        $this->add_control(
            'desktop_filter_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'color_filter',
            [
                'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desktop_filter_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'desktop_filter_padding',
            [
                'label'      => __('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'desktop_filter_border',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-ep-grid-filters li'
            ]
        );

        $this->add_control(
            'desktop_filter_radius',
            [
                'label'      => __('Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'desktop_filter_shadow',
                'selector' => '{{WRAPPER}} .bdt-ep-grid-filters li'
            ]
        );

        $this->add_control(
            'filter_item_spacing',
            [
                'label'     => esc_html__('Space Between', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters > li.bdt-ep-grid-filter:not(:last-child)'  => 'margin-right: calc({{SIZE}}{{UNIT}}/2)',
                    '{{WRAPPER}} .bdt-ep-grid-filters > li.bdt-ep-grid-filter:not(:first-child)' => 'margin-left: calc({{SIZE}}{{UNIT}}/2)',
                ],
            ]
        );

        $this->add_control(
            'desktop_filter_active',
            [
                'label' => esc_html__('Active', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'color_filter_active',
            [
                'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li.bdt-active' => 'color: {{VALUE}}; border-bottom-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desktop_active_filter_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li.bdt-active' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desktop_active_filter_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li.bdt-active' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desktop_active_filter_radius',
            [
                'label'      => __('Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-ep-grid-filters li.bdt-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'desktop_active_filter_shadow',
                'selector' => '{{WRAPPER}} .bdt-ep-grid-filters li.bdt-active'
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'filter_tab_mobile',
            [
                'label' => __('Mobile', 'bdthemes-element-pack')
            ]
        );

        $this->add_control(
            'filter_mbtn_width',
            [
                'label'     => __('Button Width(%)', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 2,
                        'max' => 100
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-button' => 'width: {{SIZE}}%;'
                ]
            ]
        );

        $this->add_control(
            'filter_mbtn_color',
            [
                'label'     => __('Button Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-button' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'filter_mbtn_background',
            [
                'label'     => __('Button Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-button' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'filter_mbtn_dropdown_color',
            [
                'label'     => __('Text Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-dropdown-nav li' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'filter_mbtn_dropdown_background',
            [
                'label'     => __('Dropdown Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-dropdown' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'filter_mbtn_dropdown_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .bdt-dropdown-nav li',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_pagination',
			[
				'label'     => esc_html__( 'Pagination', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_pagination_style' );

		$this->start_controls_tab(
			'tab_pagination_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'pagination_background',
				'selector'  => '{{WRAPPER}} ul.bdt-pagination li a',
				'separator' => 'after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'pagination_border',
				'label'    => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} ul.bdt-pagination li a',
			]
		);

		$this->add_responsive_control(
			'pagination_offset',
			[
				'label'     => esc_html__( 'Offset', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagination' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_space',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-pagination'     => 'margin-left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-pagination > *' => 'padding-left: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_padding',
			[
				'label'     => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_radius',
			[
				'label'     => esc_html__( 'Radius', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_arrow_size',
			[
				'label'     => esc_html__( 'Arrow Size', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a svg' => 'height: {{SIZE}}px; width: auto;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pagination_hover_background',
				'selector' => '{{WRAPPER}} ul.bdt-pagination li a:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_pagination_active',
			[
				'label' => esc_html__( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'pagination_active_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pagination_active_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pagination_active_background',
				'selector' => '{{WRAPPER}} ul.bdt-pagination li.bdt-active a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();		

		$this->end_controls_section();
    }

    public function render_image($image_id) {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_image'] ) {
            return;
        }

        $testimonial_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($image_id), 'medium');

        ?>
        <div>
            <div class="bdt-testimonial-grid-img-wrapper bdt-overflow-hidden bdt-border-circle bdt-background-cover">
                <img src="<?php echo esc_url($testimonial_thumb[0]); ?>"
                     alt="<?php echo esc_attr(get_the_title()); ?>"/>
            </div>
        </div>
        <?php
    }

    public function render_title($post_id) {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_title'] ) {
            return;
        }

        ?>
        <h4 class="bdt-testimonial-grid-title bdt-margin-remove-bottom"><?php echo esc_attr(get_the_title($post_id)); ?><?php if ( $settings['show_comma'] ) {
                echo (($settings['show_title']) and ($settings['show_address'])) ? ', ' : '';
            } ?></h4>
        <?php
    }

    public function render_address($post_id) {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_address'] ) {
            return;
        }

        ?>
        <p class="bdt-testimonial-grid-address bdt-text-meta bdt-margin-remove">
            <?php echo get_post_meta($post_id, 'bdthemes_tm_company_name', true); ?>
        </p>
        <?php
    }

    public function render_excerpt() {

        if ( !$this->get_settings('show_text') ) {
            return;
        }

        $strip_shortcode = $this->get_settings_for_display('strip_shortcode');

        ?>
        <div class="bdt-testimonial-grid-text">
            <?php
            if ( has_excerpt() ) {
                the_excerpt();
            } else {
                echo element_pack_custom_excerpt($this->get_settings_for_display('text_limit'), $strip_shortcode);
            }
            ?>
        </div>
        <?php

    }

    public function render_rating($post_id) {
        $settings = $this->get_settings_for_display();

        if ( !$settings['show_rating'] ) {
            return;
        }

        ?>
        <div class="bdt-testimonial-grid-rating">
            <ul class="bdt-rating bdt-rating-<?php echo get_post_meta($post_id, 'bdthemes_tm_rating', true); ?> bdt-grid bdt-grid-collapse" data-bdt-grid>
                <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
                <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
                <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
                <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
                <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
            </ul>
        </div>
        <?php
    }

    public function render_filter_menu() {
        $settings         = $this->get_settings_for_display();
        $testi_categories = [];
        $wp_query         = $this->render_query();

        if ( 'by_name' === $settings['source'] and !empty($settings['post_categories']) ) {
            $testi_categories = $settings['post_categories'];
        } else {

            while ( $wp_query->have_posts() ) : $wp_query->the_post();
                $terms = get_the_terms(get_the_ID(), 'testimonial_categories');
                foreach ( $terms as $term ) {
                    $testi_categories[] = esc_attr($term->slug);
                };
            endwhile;

            $testi_categories = array_unique($testi_categories);

            wp_reset_postdata();

        }

        ?>

        <div class="bdt-ep-grid-filters-wrapper">

            <button class="bdt-button bdt-button-default bdt-hidden@m"
                    type="button"><?php esc_html_e('Filter', 'bdthemes-element-pack'); ?></button>
            <div data-bdt-dropdown="mode: click;" class="bdt-dropdown bdt-margin-remove-top bdt-margin-remove-bottom">
                <ul class="bdt-nav bdt-dropdown-nav">

                    <li class="bdt-ep-grid-filter bdt-active"
                        data-bdt-filter-control><?php esc_html_e('All', 'bdthemes-element-pack'); ?></li>

                    <?php foreach ( $testi_categories as $testi_category => $value ) : ?>
                        <?php $filter_name = get_term_by('slug', $value, 'testimonial_categories'); ?>
                        <li class="bdt-ep-grid-filter"
                            data-bdt-filter-control="[data-filter*='bdtf-<?php echo esc_attr(trim($value)); ?>']">
                            <?php echo esc_html($filter_name->name); ?>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>


            <ul class="bdt-ep-grid-filters bdt-visible@m" data-bdt-margin>
                <li class="bdt-ep-grid-filter bdt-active"
                    data-bdt-filter-control><?php esc_html_e('All', 'bdthemes-element-pack'); ?></li>

                <?php foreach ( $testi_categories as $product_category => $value ) : ?>
                    <?php $filter_name = get_term_by('slug', $value, 'testimonial_categories'); ?>
                    <li class="bdt-ep-grid-filter"
                        data-bdt-filter-control="[data-filter*='bdtf-<?php echo esc_attr(trim($value)); ?>']">
                        <?php echo esc_html($filter_name->name); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    public function render_header() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('testimonial-grid-wrapper', 'class', ['bdt-testimonial-grid-layout-' . $settings['layout'], 'bdt-testimonial-grid', 'bdt-ep-grid-filter-container']);

        

        if ( $settings['show_filter_bar'] ) {
            $this->add_render_attribute('testimonial-grid-wrapper', 'data-bdt-filter', 'target: #bdt-testimonial-grid-' . $this->get_id());
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('testimonial-grid-wrapper'); ?>>

        <?php if ( $settings['show_filter_bar'] ) {
            $this->render_filter_menu();
        }

        ?>
        
        <?php
    }

    public function render_footer() {
        ?>
        </div>
        <?php
    }

    public function render_query() {
        $settings = $this->get_settings_for_display();

        if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
		else { $paged = 1; }

        $args = array(
            'post_type'      => 'bdthemes-testimonial',
            'posts_per_page' => $settings['posts'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'post_status'    => 'publish',
            'paged'          => $paged,
        );

        if ( 'by_name' === $settings['source'] and !empty($settings['post_categories']) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'testimonial_categories',
                'field'    => 'slug',
                'terms'    => $settings['post_categories'],
            );
        }

        $wp_query = new \WP_Query($args);

        return $wp_query;
    }

    public function render_loop_item() {
        $settings = $this->get_settings_for_display();
        $wp_query = $this->render_query();

        $this->add_render_attribute('testimonial-grid', 'data-bdt-grid', '');
        $this->add_render_attribute('testimonial-grid', 'class', 'bdt-grid');

        if ( $settings['item_match_height'] ) {
            $this->add_render_attribute('testimonial-grid', 'data-bdt-height-match', 'div > .bdt-testimonial-grid-item-inner');
        }

        if ( $settings['item_masonry'] ) {
            $this->add_render_attribute('testimonial-grid', 'data-bdt-grid', 'masonry: true;');
        }

        if ( $wp_query->have_posts() ) {


            ?>
            <div id="bdt-testimonial-grid-<?php echo $this->get_id(); ?>" <?php echo $this->get_render_attribute_string('testimonial-grid'); ?>>
            <?php
            $this->add_render_attribute('testimonial-grid-item', 'class', 'bdt-testimonial-grid-item');
            $this->add_render_attribute('testimonial-grid-item', 'class', 'bdt-width-1-' . $settings['columns_mobile']);
            $this->add_render_attribute('testimonial-grid-item', 'class', 'bdt-width-1-' . $settings['columns_tablet'] . '@s');
            $this->add_render_attribute('testimonial-grid-item', 'class', 'bdt-width-1-' . $settings['columns'] . '@m');

            while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

                <?php

                if ( $settings['show_filter_bar'] ) {
                    $item_filters = get_the_terms(get_the_ID(), 'testimonial_categories');
                    foreach ( $item_filters as $item_filter ) {
                        $this->add_render_attribute('testimonial-grid-item', 'data-filter', 'bdtf-' . $item_filter->slug, true);
                    }
                }
                ?>

                <div <?php echo $this->get_render_attribute_string('testimonial-grid-item'); ?>>
                    <?php if ( '1' == $settings['layout'] ) : ?>
                        <div class="bdt-testimonial-grid-item-inner">
                            <div class="bdt-grid bdt-position-relative bdt-grid-small bdt-flex-middle" data-bdt-grid>
                                <?php $this->render_image(get_the_ID()); ?>
                                <?php if ( $settings['show_title'] || $settings['show_address'] ) : ?>
                                    <div class="bdt-testimonial-grid-title-address <?php echo ($settings['meta_multi_line']) ? 'bdt-meta-multi-line' : ''; ?>">
                                        <?php
                                        $this->render_title(get_the_ID());
                                        $this->render_address(get_the_ID());

                                        if ( $settings['show_rating'] ) : ?>
                                            <?php if ( '3' <= $settings['columns'] ) : ?>
                                                <?php $this->render_rating(get_the_ID()); ?>
                                            <?php endif; ?>

                                            <?php if ( '2' >= $settings['columns'] ) : ?>
                                                <div class="bdt-position-center-right">
                                                    <?php $this->render_rating(get_the_ID()); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php $this->render_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( '2' == $settings['layout'] ) : ?>
                        <div class="bdt-testimonial-grid-item-inner bdt-position-relative bdt-text-center">
                            <div class=""><?php $this->render_image(get_the_ID()); ?></div>
                            <?php if ( $settings['show_title'] || $settings['show_address'] ) : ?>
                                <div class="bdt-testimonial-grid-title-address <?php echo ($settings['meta_multi_line']) ? 'bdt-meta-multi-line' : ''; ?>">
                                    <?php
                                    $this->render_title(get_the_ID());
                                    $this->render_address(get_the_ID());
                                    ?>
                                </div>
                            <?php endif; ?>
                            <?php $this->render_excerpt(); ?>
                            <?php $this->render_rating(get_the_ID()); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( '3' == $settings['layout'] ) : ?>
                        <div class="bdt-testimonial-grid-item-inner">
                            <?php $this->render_excerpt(); ?>
                            <div class="bdt-grid bdt-position-relative bdt-grid-small bdt-flex-middle" data-bdt-grid>
                                <?php $this->render_image(get_the_ID()); ?>
                                <?php if ( $settings['show_title'] || $settings['show_address'] ) : ?>
                                    <div class="bdt-testimonial-grid-title-address <?php echo ($settings['meta_multi_line']) ? 'bdt-meta-multi-line' : ''; ?>">
                                        <?php
                                        $this->render_title(get_the_ID());
                                        $this->render_address(get_the_ID());

                                        if ( $settings['show_rating'] ) : ?>
                                            <?php if ( '3' <= $settings['columns'] ) : ?>
                                                <?php $this->render_rating(get_the_ID()); ?>
                                            <?php endif; ?>

                                            <?php if ( '2' >= $settings['columns'] ) : ?>
                                                <div class="bdt-position-center-right">
                                                    <?php $this->render_rating(get_the_ID()); ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>

            </div>

            <?php
            if ($settings['show_pagination']) { ?>
                <div class="ep-pagination">
                    <?php element_pack_post_pagination($wp_query, $this->get_id()); ?>
                </div>
                <?php
            }

            wp_reset_postdata();

        } else {
            echo '<div class="bdt-alert-warning" bdt-alert>Oppps!! There is no post, please select actual post or categories.<div>';
        }
    }

    public function render() {
        $this->render_header();
        $this->render_loop_item();
        $this->render_footer();
    }
}
