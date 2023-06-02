<?php

namespace ElementPack\Modules\TestimonialSlider\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

use ElementPack\Modules\TestimonialSlider\Skins;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Testimonial_Slider extends Module_Base {
	
	private $_query = null;
	
	public function get_name() {
        return 'bdt-testimonial-slider';
    }

    public function get_title() {
        return BDTEP . esc_html__('Testimonial Slider', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-testimonial-slider';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['testimonial', 'slider'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['element-pack-font', 'ep-testimonial-slider'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/pI-DLKNlTGg';
    }

    public function _register_skins() {
        $this->add_skin(new Skins\Skin_Thumb($this));
        $this->add_skin(new Skins\Skin_Single($this));
    }

    public function _register_controls() {

        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__('Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'thumb',
            [
                'label'     => esc_html__('Testimonial Image', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    '_skin' => '',
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'company_name',
            [
                'label'   => esc_html__('Company Name/Address', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'meta_multi_line',
            [
                'label' => esc_html__('Meta Multiline', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_comma',
            [
                'label'   => esc_html__('Show Comma After Title', 'bdthemes-element-pack'),
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
                'default'     => 80,
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
            'rating',
            [
                'label'   => esc_html__('Rating', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );


        $this->add_control(
            'meta_position',
            [
                'label'   => __('Meta Position', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'after'  => [
                        'title' => __('After', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'after',
            ]
        );

        $this->add_control(
            'meta_alignment',
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
				'prefix_class' => 'bdt-testi-meta-align-',
                'render_type'  => 'template',
                'condition' => [
                    '_skin' => '',
                ],
            ]
        );

        $this->add_control(
            'alignment',
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
                'default'   => 'left',
                'condition' => [
                    '_skin!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label'     => esc_html__('Image Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-testimonial-thumb' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin' => 'bdt-single',
                ],
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
            'posts',
            [
                'label'   => esc_html__('Posts Limit', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
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
            'section_content_slider_settins',
            [
                'label' => esc_html__('Slider Settings', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Auto Play', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_interval',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 7000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label' => esc_html__( 'Pause on Hover', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'velocity',
			[
				'label'   => __( 'Animation Speed (ms)', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_navigation',
            [
                'label'     => __('Navigation', 'bdthemes-element-pack'),
                'condition' => [
                    '_skin!' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'            => esc_html__( 'Arrows and Dots', 'bdthemes-element-pack' ),
					'arrows-fraction' => esc_html__( 'Arrows and Fraction', 'bdthemes-element-pack' ),
					'arrows'          => esc_html__( 'Arrows', 'bdthemes-element-pack' ),
					'dots'            => esc_html__( 'Dots', 'bdthemes-element-pack' ),
					'progressbar'     => esc_html__( 'Progress', 'bdthemes-element-pack' ),
					'none'            => esc_html__( 'None', 'bdthemes-element-pack' ),
				],
				'prefix_class' => 'bdt-navigation-type-',
				'render_type' => 'template',				
			]
		);

		$this->add_control(
			'dynamic_bullets',
			[
				'label'     => __( 'Dynamic Bullets?', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'show_scrollbar',
			[
				'label'     => __( 'Show Scrollbar?', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SWITCHER,
			]
		);
		
		$this->add_control(
			'both_position',
			[
				'label'     => __( 'Arrows and Dots Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => element_pack_navigation_position(),
				'condition' => [
					'navigation' => 'both',
				],
				
			]
		);

		$this->add_control(
			'arrows_fraction_position',
			[
				'label'     => __( 'Arrows and Fraction Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => element_pack_navigation_position(),
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
				
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __( 'Arrows Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => element_pack_navigation_position(),
				'condition' => [
					'navigation' => 'arrows',
				],
				
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __( 'Dots Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-center',
				'options'   => element_pack_pagination_position(),
				'condition' => [
					'navigation' => 'dots',
				],
				
			]
		);

		$this->add_control(
			'progress_position',
			[
				'label'   => __( 'Progress Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [
					'bottom' => esc_html__('Bottom', 'bdthemes-element-pack'),
					'top'    => esc_html__('Top', 'bdthemes-element-pack'),
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
				
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1' => esc_html__('Style 1', 'bdthemes-element-pack'),
					'2' => esc_html__('Style 2', 'bdthemes-element-pack'),
					'3' => esc_html__('Style 3', 'bdthemes-element-pack'),
					'4' => esc_html__('Style 4', 'bdthemes-element-pack'),
					'5' => esc_html__('Style 5', 'bdthemes-element-pack'),
					'6' => esc_html__('Style 6', 'bdthemes-element-pack'),
					'7' => esc_html__('Style 7', 'bdthemes-element-pack'),
					'8' => esc_html__('Style 8', 'bdthemes-element-pack'),
					'9' => esc_html__('Style 9', 'bdthemes-element-pack'),
					'10' => esc_html__('Style 10', 'bdthemes-element-pack'),
					'11' => esc_html__('Style 11', 'bdthemes-element-pack'),
					'12' => esc_html__('Style 12', 'bdthemes-element-pack'),
					'13' => esc_html__('Style 13', 'bdthemes-element-pack'),
					'14' => esc_html__('Style 14', 'bdthemes-element-pack'),
					'15' => esc_html__('Style 15', 'bdthemes-element-pack'),
					'16' => esc_html__('Style 16', 'bdthemes-element-pack'),
					'17' => esc_html__('Style 17', 'bdthemes-element-pack'),
					'18' => esc_html__('Style 18', 'bdthemes-element-pack'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-element-pack'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-element-pack'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-element-pack'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-element-pack'),
					'square-1' => esc_html__('Style 23', 'bdthemes-element-pack'),
				],
				'condition' => [
					'navigation' => ['arrows-fraction', 'both', 'arrows'],
				],
			]
		);

		$this->add_control(
			'hide_arrow_on_mobile',
			[
				'label'     => __( 'Hide Arrow on Mobile ?', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'navigation' => [ 'arrows-fraction', 'arrows', 'both' ],
				],				
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_style_thumb',
            [
                'label' => __('Item Style', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                // 	'_skin!' => '',
                // ],
            ]
        );

        $this->add_control(
            'heading_testimonial',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Testimonial', 'bdthemes-element-pack'),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'testimonial_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-item-inner'                                   => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-slider li.bdt-slider-thumbnav .bdt-slider-thumbnav-inner:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_padding',
            [
                'label'     => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-item-inner' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'testimonial_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-item-inner',
            ]
        );

        $this->add_responsive_control(
            'testimonial_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_thumb',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => esc_html__('Thumb', 'bdthemes-element-pack'),
                'separator' => 'before',
                'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_responsive_control(
            'horizontal_spacing',
            [
                'label'     => esc_html__('Horizontal Space', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-thumbnav:not(:first-child)' => 'padding-left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_responsive_control(
            'vertical_spacing',
            [
                'label'     => esc_html__('Vertical Space', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-thumbnav-inner' => 'padding-top: calc({{SIZE}}{{UNIT}} + 20px);',
                ],
                'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_control(
            'hide_arrow_style',
            [
                'label'        => esc_html__('Hide Arrow Style', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'bdt-arrow-style-hide-',
                'condition'    => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_control(
            'thumb_opacity',
            [
                'label'     => __('Thumbnail Opacity', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0.05,
                        'max'  => 1,
                        'step' => 0.05,
                    ],
                ],
                'default'   => [
                    'size' => 0.8,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-thumbnav-inner img' => 'opacity: {{SIZE}};',
                ],
                'condition' => [
                    '_skin' => 'bdt-thumb',
                ],

            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'thumb_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-thumbnav-inner img',
				'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_responsive_control(
            'thumb_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-slider-thumbnav-inner img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_control(
            'active_thumb_opacity',
            [
                'label'     => __('Active Opacity', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0.05,
                        'max'  => 1,
                        'step' => 0.05,
                    ],
                ],
                'default'   => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-active .bdt-slider-thumbnav-inner img' => 'opacity: {{SIZE}};',
                ],
                'separator' => 'before',
                'condition' => [
                    '_skin' => 'bdt-thumb',
                ],
            ]
        );

        $this->add_control(
            'active_thumb_border_color',
            [
                'label'     => __('Active Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-active .bdt-slider-thumbnav-inner img' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    '_skin'                => 'bdt-thumb',
                    'thumb_border_border!' => '',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_style',
            [
                'label' => esc_html__('Content Style', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quatation_heading',
            [
                'label'     => esc_html__('Quatation', 'bdthemes-element-pack'),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'quatation_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-text:after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'quatation_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-text:after',
            ]
        );

        $this->add_control(
            'text_heading',
            [
                'label'     => esc_html__('Text', 'bdthemes-element-pack'),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-text',
            ]
        );

        $this->add_responsive_control(
            'text_cite_space',
            [
                'label'     => __('Meta Space', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-slider-item-inner > div:first-child' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_heading',
            [
                'label'     => esc_html__('Title', 'bdthemes-element-pack'),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
                'condition' => ['title' => 'yes'],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-meta .bdt-testimonial-title' => 'color: {{VALUE}};',
                ],
                'condition' => ['title' => 'yes'],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .bdt-testimonial-meta .bdt-testimonial-title',
                'condition' => ['title' => 'yes'],
            ]
        );

        $this->add_control(
            'address_heading',
            [
                'label'     => esc_html__('Name/Address', 'bdthemes-element-pack'),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'company_name' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'address_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-meta .bdt-testimonial-address' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'company_name' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'address_typography',
                'label'     => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .bdt-testimonial-meta .bdt-testimonial-address',
                'condition' => [
                    'company_name' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'rating_heading',
            [
                'label'     => esc_html__('Rating', 'bdthemes-element-pack'),
                'separator' => 'before',
                'type'      => Controls_Manager::HEADING,
                'condition' => [
                    'rating' => 'yes',
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
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating .bdt-rating-item' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'rating' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'active_rating_color',
            [
                'label'     => esc_html__('Active Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#FFCC00',
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating.bdt-rating-1 .bdt-rating-item:nth-child(1)'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating.bdt-rating-2 .bdt-rating-item:nth-child(-n+2)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating.bdt-rating-3 .bdt-rating-item:nth-child(-n+3)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating.bdt-rating-4 .bdt-rating-item:nth-child(-n+4)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-slider .bdt-rating.bdt-rating-5 .bdt-rating-item:nth-child(-n+5)' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'rating' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => '_skin',
                            'operator' => '!==',
                            'value' => 'bdt-thumb'
                        ],
                        [
                            'relation' => 'or',
                            'terms' => [
                                [
                                    'name'  => 'navigation',
                                    'operator' => '!=',
                                    'value' => 'none',
                                ],
                                [
                                    'name'     => 'show_scrollbar',
                                    'value'    => 'yes',
                                ]
                            ]
                        ]
                    ]
                ]
			]
		);

		$this->add_control(
			'arrows_heading',
			[
				'label'     => __( 'Arrows', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_navigation_arrows_style' );

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev i, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'nav_arrows_border',
				'selector'    => '{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next',
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label' => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev i,
					{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next i' => 'font-size: {{SIZE || 24}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_space',
			[
				'label' => __( 'Space Between Arrows', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'margin-left: {{SIZE}}px;',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev:hover i, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'navigation!' => [ 'dots', 'progressbar', 'none' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_1',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_heading',
			[
				'label'     => __( 'Dots', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'hr_11',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-bullet' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-bullet-active' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation!' => [ 'arrows', 'arrows-fraction', 'progressbar', 'none' ],
				],
			]
		);

		$this->add_control(
			'hr_2',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_heading',
			[
				'label'     => __( 'Fraction', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_12',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'fraction_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'active_fraction_color',
			[
				'label'     => __( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'fraction_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-fraction',
				'condition' => [
					'navigation' => 'arrows-fraction',
				],
			]
		);

		$this->add_control(
			'hr_3',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_heading',
			[
				'label'     => __( 'Progresbar', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_13',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progresbar_color',
			[
				'label'     => __( 'Bar Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-progressbar' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'progres_color',
			[
				'label'     => __( 'Progress Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-progressbar .swiper-pagination-progressbar-fill' => 'background: {{VALUE}}',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_control(
			'hr_4',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_heading',
			[
				'label'     => __( 'Scrollbar', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_14',
			[
				'type' => Controls_Manager::DIVIDER,
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_color',
			[
				'label'     => __( 'Bar Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-scrollbar' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_drag_color',
			[
				'label'     => __( 'Drag Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-scrollbar .swiper-scrollbar-drag' => 'background: {{VALUE}}',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'scrollbar_height',
			[
				'label'   => __( 'Height', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-container-horizontal > .swiper-scrollbar' => 'height: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->add_control(
			'hr_5',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'navi_offset_heading',
			[
				'label'     => __( 'Offset', 'bdthemes-element-pack' ),
                'type'      => Controls_Manager::HEADING,
                'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'navigation',
							'operator' => '!=',
							'value' => 'none',
						],
						[
							'name'     => 'show_scrollbar',
							'value'    => 'yes',
                        ],
					],
				],
			]
		);

		$this->add_control(
			'hr_6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'arrows_ncx_position',
			[
				'label'   => __( 'Arrows Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-arrows-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_ncy_position',
			[
				'label'   => __( 'Arrows Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-arrows-ncy: {{SIZE}}px;'
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_acx_position',
			[
				'label'   => __( 'Arrows Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'  => 'arrows_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'dots_nnx_position',
			[
				'label'   => __( 'Dots Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-dots-nnx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'dots_nny_position',
			[
				'label'   => __( 'Dots Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'tablet_default' => [
					'size' => 30,
				],
				'mobile_default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-dots-nny: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncx_position',
			[
				'label'   => __( 'Arrows & Dots Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-both-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_ncy_position',
			[
				'label'   => __( 'Arrows & Dots Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-both-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'both_cx_position',
			[
				'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'both_cy_position',
			[
				'label'   => __( 'Dots Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncx_position',
			[
				'label'   => __( 'Arrows & Fraction Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'tablet_default' => [
					'size' => 0,
				],
				'mobile_default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-arrows-fraction-ncx: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_ncy_position',
			[
				'label'   => __( 'Arrows & Fraction Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'tablet_default' => [
					'size' => 40,
				],
				'mobile_default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'     => 'arrows_fraction_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-testimonial-slider-arrows-fraction-ncy: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cx_position',
			[
				'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-testimonial-slider .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_fraction_cy_position',
			[
				'label'   => __( 'Fraction Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-fraction' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows-fraction',
						],
						[
							'name'  => 'arrows_fraction_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'progress_y_position',
			[
				'label'   => __( 'Progress Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 15,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-pagination-progressbar' => 'transform: translateY({{SIZE}}px);',
				],
				'condition' => [
					'navigation' => 'progressbar',
				],
			]
		);

		$this->add_responsive_control(
			'scrollbar_vertical_offset',
			[
				'label'   => __( 'Scrollbar Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-slider .swiper-container-horizontal > .swiper-scrollbar' => 'bottom: {{SIZE}}px;',
				],
				'condition'   => [
					'show_scrollbar' => 'yes'
				],
			]
		);

		$this->end_controls_section();
    }

    public function query_posts() {

        $settings = $this->get_settings_for_display();

        $args = array(
            'post_type'      => 'bdthemes-testimonial',
            'posts_per_page' => $settings['posts'],
            'orderby'        => $settings['orderby'],
            'order'          => $settings['order'],
            'post_status'    => 'publish'
        );

        if ( 'by_name' === $settings['source'] and !empty($settings['post_categories']) ) {
            $args['tax_query'][] = array(
                'taxonomy' => 'testimonial_categories',
                'field'    => 'slug',
                'terms'    => $settings['post_categories'],
            );
        }

        $this->_query = new \WP_Query($args);
    }

    public function get_query() {
        return $this->_query;
    }

    public function render_header($skin, $id, $settings) {

        $this->add_render_attribute('testimonial-slider', 'id', 'bdt-testimonial-slider-' . esc_attr($id));
        $this->add_render_attribute('testimonial-slider', 'class', ['bdt-testimonial-slider', 'bdt-testimonial-slider-skin-' . esc_attr($skin)]);
        $id = 'bdt-testimonial-slider-' . $this->get_id();

        if ('arrows' == $settings['navigation']) {
			$this->add_render_attribute( 'testimonial-slider', 'class', 'bdt-arrows-align-'. $settings['arrows_position'] );
		} elseif ('dots' == $settings['navigation']) {
			$this->add_render_attribute( 'testimonial-slider', 'class', 'bdt-dots-align-'. $settings['dots_position'] );
		} elseif ('both' == $settings['navigation']) {
			$this->add_render_attribute( 'testimonial-slider', 'class', 'bdt-arrows-dots-align-'. $settings['both_position'] );
		} elseif ('arrows-fraction' == $settings['navigation']) {
			$this->add_render_attribute( 'testimonial-slider', 'class', 'bdt-arrows-dots-align-'. $settings['arrows_fraction_position'] );
		}

		if ('arrows-fraction' == $settings['navigation'] ) {
			$pagination_type = 'fraction';
		} elseif ('both' == $settings['navigation'] or 'dots' == $settings['navigation']) {
			$pagination_type = 'bullets';
		} elseif ('progressbar' == $settings['navigation'] ) {
			$pagination_type = 'progressbar';
		} else {
			$pagination_type = '';
		}

		$this->add_render_attribute(
			[
				'testimonial-slider' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							'autoplay'     => ( 'yes' == $settings['autoplay'] ) ? [ 'delay' => $settings['autoplay_interval'] ] : false,
							'loop'         => ($settings['loop'] == 'yes') ? true : false,
							'speed'        => $settings['velocity'],
							'pauseOnHover' => isset($settings['pause_on_hover']) ? true : false,
							'navigation'   => [
								'nextEl' => '#' . $id . ' .bdt-navigation-next',
								'prevEl' => '#' . $id . ' .bdt-navigation-prev',
							],
							"pagination" => [
								"el"             => "#" . $id . " .swiper-pagination",
								"type"           => $pagination_type,
								"clickable"      => "true",
								'autoHeight'     => true,
								'dynamicBullets' => ("yes" == $settings["dynamic_bullets"]) ? true: false,
							],
							"scrollbar" => [
								"el"            => "#" . $id . " .swiper-scrollbar",
								"hide"          => "true",
							],
				        ]))
					]
				]
			]
		);

        ?>

        <div <?php echo $this->get_render_attribute_string('testimonial-slider'); ?>>
            <div class="swiper-container">
                <div class="swiper-wrapper">

        <?php
    }

    public function render_navigation() {
		$settings = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? ' bdt-visible@m' : '';
		
		if ( 'arrows' == $settings['navigation'] ) : ?>
			<div class="bdt-position-z-index bdt-position-<?php echo esc_attr( $settings['arrows_position'] . $hide_arrow_on_mobile ); ?>">
				<div class="bdt-arrows-container bdt-slidenav-container">
					<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
						<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</a>
					<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
						<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
					</a>
				</div>
			</div>
		<?php endif;
	}

	public function render_pagination() {
		$settings = $this->get_settings_for_display();
		
		if ( 'dots' == $settings['navigation'] or 'arrows-fraction' == $settings['navigation'] ) : ?>
			<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['dots_position']); ?>">
				<div class="bdt-dots-container">
					<div class="swiper-pagination"></div>
				</div>
			</div>

		<?php elseif ( 'progressbar' == $settings['navigation'] ) : ?>
			<div class="swiper-pagination bdt-position-z-index bdt-position-<?php echo esc_attr($settings['progress_position']); ?>"></div>
		<?php endif;
	}

	public function render_both_navigation() {
		$settings = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'bdt-visible@m' : '';
		
		?>
		<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['both_position']); ?>">
			<div class="bdt-arrows-dots-container bdt-slidenav-container ">
				
				<div class="bdt-flex bdt-flex-middle">
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
							<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

					<?php if ('center' !== $settings['both_position']) : ?>
						<div class="swiper-pagination"></div>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
							<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>		
		<?php
	}

	public function render_arrows_fraction() {
		$settings             = $this->get_settings_for_display();
		$hide_arrow_on_mobile = $settings['hide_arrow_on_mobile'] ? 'bdt-visible@m' : '';
		
		?>
		<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['arrows_fraction_position']); ?>">
			<div class="bdt-arrows-fraction-container bdt-slidenav-container ">
				
				<div class="bdt-flex bdt-flex-middle">
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav">
							<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>

					<?php if ('center' !== $settings['arrows_fraction_position']) : ?>
						<div class="swiper-pagination"></div>
					<?php endif; ?>
					
					<div class="<?php echo esc_attr( $hide_arrow_on_mobile ); ?>">
						<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav">
							<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>		
		<?php
	}

	public function render_footer() {
		$settings = $this->get_settings_for_display();
		
		?>
				</div>
				<?php if ( 'yes' === $settings['show_scrollbar'] ) : ?>
				<div class="swiper-scrollbar"></div>
				<?php endif; ?>
			</div>
			
			<?php if ('both' == $settings['navigation']) : ?>
				<?php $this->render_both_navigation(); ?>
				<?php if ( 'center' === $settings['both_position'] ) : ?>
					<div class="bdt-position-z-index bdt-position-bottom">
						<div class="bdt-dots-container">
							<div class="swiper-pagination"></div>
						</div>
					</div>
				<?php endif; ?>
			<?php elseif ('arrows-fraction' == $settings['navigation']) : ?>
				<?php $this->render_arrows_fraction(); ?>
				<?php if ( 'center' === $settings['arrows_fraction_position'] ) : ?>
					<div class="bdt-dots-container">
						<div class="swiper-pagination"></div>
					</div>
				<?php endif; ?>
			<?php else : ?>			
				<?php $this->render_pagination(); ?>
				<?php $this->render_navigation(); ?>
			<?php endif; ?>
			
		</div>
		<?php
	}

    public function render_image() {
        $settings = $this->get_settings_for_display();

        if ( 'yes' != $settings['thumb'] ) {
            return;
        }

        $testimonial_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');

        if ( !$testimonial_thumb ) {
            $testimonial_thumb = BDTEP_ASSETS_URL . 'images/member.svg';
        } else {
            $testimonial_thumb = $testimonial_thumb[0];
        }

        ?>
        <div>
            <div class="bdt-testimonial-thumb">
                <img src="<?php echo esc_url($testimonial_thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
            </div>
        </div>
        <?php
    }

    public function render_excerpt() {

        $strip_shortcode = $this->get_settings_for_display('strip_shortcode');

        if ( has_excerpt() ) {
            the_excerpt();
        } else {
            echo element_pack_custom_excerpt($this->get_settings_for_display('text_limit'), $strip_shortcode);
        }

    }

    public function render_meta($element_key) {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute($element_key, 'class', ['bdt-rating', 'bdt-grid', 'bdt-grid-collapse']);
        $this->add_render_attribute($element_key, 'class', 'bdt-rating-' . get_post_meta(get_the_ID(), 'bdthemes_tm_rating', true));

        if ( !$settings['thumb'] ) {
            $this->add_render_attribute($element_key, 'class', 'bdt-flex-' . $settings['alignment']);
        }


        if ( $settings['title'] or $settings['company_name'] or $settings['rating'] ) : ?>
            <div class="bdt-testimonial-meta <?php echo ($settings['meta_multi_line']) ? 'bdt-meta-multi-line' : ''; ?>">
                <?php if ( $settings['title'] ) : ?>
                    <div class="bdt-testimonial-title">
                        <?php echo get_the_title(); ?><?php if ( $settings['show_comma'] ) {
                            echo (($settings['title']) and ($settings['company_name'])) ? ', ' : '';
                        } ?>
                    </div>

                <?php endif ?>

                <?php if ( $settings['company_name'] ) : ?>
                    <div class="bdt-testimonial-address"><?php echo get_post_meta(get_the_ID(), 'bdthemes_tm_company_name', true); ?></div>
                <?php endif ?>

                <?php if ( $settings['rating'] ) : ?>
                    <ul <?php echo $this->get_render_attribute_string($element_key); ?>>
                        <li class="bdt-rating-item"><span><i class="ep-icon-star-full" aria-hidden="true"></i></span></li>
                        <li class="bdt-rating-item"><span><i class="ep-icon-star-full" aria-hidden="true"></i></span></li>
                        <li class="bdt-rating-item"><span><i class="ep-icon-star-full" aria-hidden="true"></i></span></li>
                        <li class="bdt-rating-item"><span><i class="ep-icon-star-full" aria-hidden="true"></i></span></li>
                        <li class="bdt-rating-item"><span><i class="ep-icon-star-full" aria-hidden="true"></i></span></li>
                    </ul>
                <?php endif ?>

            </div>
        <?php endif;
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();
        $index    = 1;

        $this->query_posts();

        $wp_query = $this->get_query();

        if ( !$wp_query->found_posts ) {
            return;
        }

        $this->render_header('default', $id, $settings); ?>

        <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

            <div class="swiper-slide">
                <div class="bdt-slider-item-inner">
                    <?php if ( 'after' == $settings['meta_position'] ) : ?>
                        <div class="bdt-testimonial-text">
                            <?php $this->render_excerpt(); ?>
                        </div>
                    <?php endif; ?>

                    <div class="bdt-info-details bdt-flex bdt-flex-center bdt-flex-middle">

                        <?php $this->render_image(); ?>

                        <?php $this->render_meta('testmonial-meta-' . $index); ?>

                    </div>

                    <?php if ( 'before' == $settings['meta_position'] ) : ?>
                        <div class="bdt-testimonial-text">
                            <?php $this->render_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>


            <?php

            $index++;

        endwhile;
        wp_reset_postdata();

        $this->render_footer();
    }
}
