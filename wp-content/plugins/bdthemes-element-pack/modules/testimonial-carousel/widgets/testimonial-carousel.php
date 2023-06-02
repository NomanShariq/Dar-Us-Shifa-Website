<?php

namespace ElementPack\Modules\TestimonialCarousel\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

use ElementPack\Traits\Global_Swiper_Controls;
use ElementPack\Modules\TestimonialCarousel\Skins;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Testimonial_Carousel extends Module_Base {

    use Global_Swiper_Controls;

    public function get_name() {
        return 'bdt-testimonial-carousel';
    }

    public function get_title() {
        return BDTEP . esc_html__('Testimonial Carousel', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-testimonial-carousel';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['testimonial', 'carousel'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['element-pack-font', 'ep-testimonial-carousel'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/VbojVJzayvE';
    }

    protected function _register_skins() {
        $this->add_skin(new Skins\Skin_Twyla($this));
        $this->add_skin(new Skins\Skin_Vyxo($this));
    }

    protected function _register_controls() {
        $slides_per_view = range( 1, 10 );
        $slides_per_view = array_combine( $slides_per_view, $slides_per_view );
        
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__('Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'              => esc_html__('Columns', 'bdthemes-element-pack'),
                'type'               => Controls_Manager::SELECT,
                'default'            => '3',
                'tablet_default'     => '2',
                'mobile_default'     => '1',
                'options'            => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'frontend_available' => true,
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
                'default'     => 40,
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
		
		$this->add_responsive_control(
			'content_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item-wrapper, {{WRAPPER}} .bdt-testimonial-carousel.bdt-testimonial-carousel-skin-vyxo .bdt-testimonial-carousel-item' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
            'item_match_height',
            [
                'label'   => esc_html__('Item Match Height', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
				'render_type' => 'template'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_query',
            [
                'label' => esc_html__('Query', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
                'default' => 10,
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

		//Navigation Controls
        $this->start_controls_section(
            'section_content_navigation',
            [
                'label' => __( 'Navigation', 'bdthemes-element-pack' ),
            ]
        );

        //Global Navigation Controls
        $this->register_navigation_controls();

        $this->end_controls_section();

		//Global Carousel Settings Controls
		$this->register_carousel_settings_controls();
        
		//Style
        $this->start_controls_section(
            'section_style_item',
            [
                'label' => esc_html__('Items', 'bdthemes-element-pack'),
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item-wrapper' => 'background-color: {{VALUE}};',
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
                'selector'    => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item',
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item, {{WRAPPER}} .bdt-testimonial-carousel .swiper-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item',
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_gap',
            [
                'label'              => esc_html__('Item Gap', 'bdthemes-element-pack'),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'size' => 35,
                ],
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
			'shadow_mode',
			[
				'label'        => esc_html__( 'Shadow Mode', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-ep-shadow-mode-',
			]
		);

		$this->add_control(
			'shadow_color',
			[
				'label'     => esc_html__( 'Shadow Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'shadow_mode' => 'yes',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container:before' => is_rtl() ? 'background: linear-gradient(to left, {{VALUE}} 5%,rgba(255,255,255,0) 100%);' : 'background: linear-gradient(to right, {{VALUE}} 5%,rgba(255,255,255,0) 100%);',
					'{{WRAPPER}} .elementor-widget-container:after'  => is_rtl() ? 'background: linear-gradient(to left, rgba(255,255,255,0) 0%, {{VALUE}} 95%);' : 'background: linear-gradient(to right, rgba(255,255,255,0) 0%, {{VALUE}} 95%);',
				],
			]
		);

		$this->add_control(
			'item_opacity',
			[
				'label'      => esc_html__( 'Opacity', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 0.1,
						'max'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item' => 'opacity: {{SIZE}};',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item-wrapper:hover' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_hover_shadow',
                'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item:hover',
            ]
        );

        $this->add_responsive_control(
            'item_shadow_padding',
            [
                'label'       => __('Match Padding', 'bdthemes-element-pack'),
                'description' => __('You have to add padding for matching overlaping hover shadow', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SLIDER,
                'range'       => [
                    'px' => [
                        'min'  => 0,
                        'step' => 1,
                        'max'  => 50,
                    ]
                ],
                'default'     => [
                    'size' => 10
                ],
                'selectors'   => [
                    '{{WRAPPER}} .swiper-container' => 'padding: {{SIZE}}{{UNIT}}; margin: 0 -{{SIZE}}{{UNIT}};'
                ]
            ]
        );

		$this->add_control(
			'item_hover_opacity',
			[
				'label'      => esc_html__( 'Opacity', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 0.1,
						'max'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ) . BDTEP_NC,
			]
		);

		$this->add_control(
			'item_active_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item.swiper-slide-active .bdt-testimonial-carousel-item-wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_active_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'item_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item.swiper-slide-active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_active_shadow',
				'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item.swiper-slide-active',
			]
		);

		$this->add_control(
			'item_active_opacity',
			[
				'label'      => esc_html__( 'Opacity', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 0.1,
						'max'  => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-item.swiper-slide-active' => 'opacity: {{SIZE}};',
				],
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
                'selector'    => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-img-wrapper',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-img-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-img-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-img-wrapper' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-title',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-address' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'address_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-address',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_top_border_color',
            [
                'label'     => esc_html__('Top Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-text' => 'border-top-color: {{VALUE}};',
                ],
                'condition' => [
                    '_skin' => '',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
                //'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-text',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating .bdt-rating-item' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating.bdt-rating-1 .bdt-rating-item:nth-child(1)'    => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating.bdt-rating-2 .bdt-rating-item:nth-child(-n+2)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating.bdt-rating-3 .bdt-rating-item:nth-child(-n+3)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating.bdt-rating-4 .bdt-rating-item:nth-child(-n+4)' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-testimonial-carousel .bdt-rating.bdt-rating-5 .bdt-rating-item:nth-child(-n+5)' => 'color: {{VALUE}};',
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

        //Navigation Style
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label'      => __( 'Navigation', 'bdthemes-element-pack' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'conditions' => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'navigation',
                            'operator' => '!=',
                            'value'    => 'none',
                        ],
                        [
                            'name'  => 'show_scrollbar',
                            'value' => 'yes',
                        ],
                    ],
                ],
            ]
        );

        //Global Navigation Style Controls
		$this->register_navigation_style_controls( 'testimonial-carousel');

        $this->end_controls_section();
    }

    public function render_image($image_id) {
        $settings = $this->get_settings_for_display();

        if ( 'yes' != $settings['show_image'] ) {
            return;
        }

        $testimonial_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($image_id), 'medium');

        if ( !$testimonial_thumb ) {
            $testimonial_thumb = BDTEP_ASSETS_URL . 'images/member.svg';
        } else {
            $testimonial_thumb = $testimonial_thumb[0];
        }

        ?>
        <div class="bdt-width-auto">
            <div class="bdt-testimonial-carousel-img-wrapper bdt-overflow-hidden bdt-border-circle bdt-background-cover">
                <img src="<?php echo esc_url($testimonial_thumb); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"/>
            </div>
        </div>
        <?php
    }

    public function render_title($post_id) {
        $settings = $this->get_settings_for_display();

        if ( 'yes' != $settings['show_title'] ) {
            return;
        }

        ?>
        <h4 class="bdt-testimonial-carousel-title bdt-margin-remove-bottom"
            itemprop="name"><?php echo esc_attr(get_the_title($post_id)); ?><?php if ( $settings['show_comma'] ) {
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
        <p class="bdt-testimonial-carousel-address bdt-text-meta bdt-margin-remove">
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
        <div class="bdt-testimonial-carousel-text" itemprop="description">
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

        if ( 'yes' != $settings['show_rating'] ) {
            return;
        }

        ?>
        <meta itemprop="datePublished" content="<?php echo get_the_date(); ?>">
        <ul class="bdt-rating bdt-rating-<?php echo get_post_meta($post_id, 'bdthemes_tm_rating', true); ?> bdt-grid bdt-grid-collapse"
            data-bdt-grid itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
            <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
            <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
            <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
            <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
            <li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
        </ul>
        <meta itemprop="worstRating" content="1">
        <meta itemprop="ratingValue" content="<?php echo get_post_meta($post_id, 'bdthemes_tm_rating', true); ?>">
        <meta itemprop="bestRating" content="5">
        <?php
    }

    public function render_header($skin = 'default') {
        $settings = $this->get_settings_for_display();

		//Global Function
		$this->render_swiper_header_attribute( 'testimonial-carousel');

        $this->add_render_attribute('carousel', 'class', 'bdt-testimonial-carousel bdt-testimonial-carousel-skin-' . $skin);

        if ( 'yes' == $settings['item_match_height'] ) {
            $this->add_render_attribute('carousel', 'data-bdt-height-match', 'target: > div > div > div > div > .bdt-testimonial-carousel-text');
        }

        ?>
        <div <?php echo $this->get_render_attribute_string('carousel'); ?>>
        <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
    }

    public function render_query() {
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

        $wp_query = new \WP_Query($args);

        return $wp_query;
    }

    public function render_loop_item() {
        $settings = $this->get_settings_for_display();
        $wp_query = $this->render_query();

        if ( $wp_query->have_posts() ) {
            while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
                <div class="swiper-slide bdt-testimonial-carousel-item" itemprop="review" itemscope
                     itemtype="http://schema.org/Review">
                    <div class="bdt-testimonial-carousel-item-wrapper">
                        <div class="testimonial-item-header">
                            <div class="bdt-grid bdt-grid-small bdt-flex-middle" data-bdt-grid>

                                <?php
                                $this->render_image(get_the_ID());

                                if ( $settings['show_rating'] || $settings['show_text'] || $settings['show_address'] ) : ?>
                                    <div class="bdt-width-expand">
                                        <div class="bdt-testimonial-meta <?php echo ($settings['meta_multi_line']) ? '' : 'bdt-meta-multi-line'; ?>">
                                            <?php
                                            $this->render_title(get_the_ID());
                                            $this->render_address(get_the_ID());
                                            if ( $settings['show_rating'] && ('yes' != $settings['show_text']) ) : ?>
                                                <div class="bdt-testimonial-carousel-rating bdt-margin-small-top bdt-padding-remove">
                                                    <?php $this->render_rating(get_the_ID()); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php $this->render_excerpt(); ?>

                        <?php if ( $settings['show_rating'] && $settings['show_text'] ) : ?>
                            <div class="bdt-testimonial-carousel-rating">
                                <?php $this->render_rating(get_the_ID()); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile;
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


