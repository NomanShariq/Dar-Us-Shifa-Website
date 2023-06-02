<?php
namespace ElementPack\Modules\CircleMenu\Widgets;

use Elementor\Repeater;
use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Circle_Menu extends Module_Base {
	public function get_name() {
		return 'bdt-circle-menu';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Circle Menu', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-circle-menu';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'circle', 'menu', 'rounded' ];
	}

	public function get_style_depends() {
		if ($this->ep_is_edit_mode()) {
			return ['ep-all-styles'];
		} else {
			return [ 'element-pack-font', 'ep-circle-menu' ];
		}
	}

	public function get_script_depends() {
		return [ 'circle-menu' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/rfW22T-U7Ag';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_iconnav',
			[
				'label' => esc_html__( 'Circle Menu', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'toggle_icon',
			[
				'label'   => __( 'Choose Toggle Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'label_block' => true,
				'options' => [
					'plus' => [
						'title' => __( 'Plus', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-plus',
					],
					'plus-circle' => [
						'title' => __( 'Plus Circle', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-plus-circle',
					],
					'close' => [
						'title' => __( 'Close', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-times',
					],
					'cog' => [
						'title' => __( 'Settings', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-cog',
					],
					'menu' => [
						'title' => __( 'Bars', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-bars',
					],
					'custom' => [
						'title' => __( 'Custom', 'bdthemes-element-pack' ),
						'icon'  => 'fas fa-edit',
					],
				],
				'default' => 'plus',
			]
		);

		$this->add_control(
			'custom_icon',
			[
				'label'            => __( 'Custom Icon', 'bdthemes-element-pack' ),
				'type'             => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-times-circle',
					'library' => 'fa-regular',
				],
				'condition'        => [
					'toggle_icon' => 'custom',
				],
				'label_block' => false,
				'skin' => 'inline'
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => esc_html__( 'Menu Title', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
				'default' => 'Home',
			]
		);

		$repeater->add_control(
			'circle_menu_icon',
			[
				'label'   => esc_html__( 'Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-home',
					'library' => 'fa-solid',
				],
				'label_block' => false,
				'skin' => 'inline'
			]
		); 

		$repeater->add_control(
			'iconnav_link',
			[
				'label'       => esc_html__( 'Link', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::URL,
				'default'     => [ 'url' => '#' ],
				'dynamic'     => [ 'active' => true ],
				'description' => 'Add your section id WITH the # key. e.g: #my-id also you can add internal/external URL',
			]
		);

		$repeater->add_control(
            'custom_style_popover',
            [
                'label'        => esc_html__('Custom Style', 'bdthemes-element-pack') . BDTEP_NC,
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'render_type'  => 'ui',
                'return_value' => 'yes',
            ]
        );

		$repeater->start_popover();

		$repeater->add_control(
            'icon_color', 
             [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon a svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'icon_hover_color', 
             [
                'label'     => __('Hover Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon:hover a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon:hover a svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'icon_background_color', 
             [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon' => 'background: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'icon_hover_background_color', 
             [
                'label'     => __('Hover Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-circle-menu {{CURRENT_ITEM}}.bdt-menu-icon:hover' => 'background: {{VALUE}};',
                ],
            ]
		);
		
		$repeater->end_popover();

		$this->add_control(
			'circle_menu',
			[
				'label'   => esc_html__( 'Circle Menu Items', 'bdthemes-element-pack' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'separator' => 'before',
				'default' => [
					[
						'circle_menu_icon'  => ['value' => 'fas fa-home', 'library' => 'fa-solid'],
						'iconnav_link' 		=> [
							'url' => '#',
						], 
						'title' 			=> esc_html__( 'Home', 'bdthemes-element-pack' ) 
					],
					[
						'circle_menu_icon'  => ['value' => 'fas fa-shopping-bag', 'library' => 'fa-solid'],
						'iconnav_link' => [
							'url' => '#',
						],
						'title' 			=> esc_html__( 'Products', 'bdthemes-element-pack' ) 
					],
					[
						'circle_menu_icon'  => ['value' => 'fas fa-wrench', 'library' => 'fa-solid'],
						'iconnav_link' 		=> [
							'url' => '#',
						],
						'title' 			=> esc_html__( 'Settings', 'bdthemes-element-pack' ) 
					],
					[
						'circle_menu_icon'  => ['value' => 'fas fa-book', 'library' => 'fa-solid'],
						'iconnav_link' 		=> [
							'url' => '#',
						],
						'title' 			=> esc_html__( 'Documentation', 'bdthemes-element-pack' ) 
					],
					[
						'circle_menu_icon'  => ['value' => 'fas fa-envelope', 'library' => 'fa-solid'],
						'iconnav_link' 		=> [
							'url' => '#',
						],
						'title' 			=> esc_html__( 'Contact Us', 'bdthemes-element-pack' ) 
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'toggle_icon_position',
			[
				'label'   => __( 'Toggle Icon Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => element_pack_position(),			
			]
		);

		$this->add_control(
			'toggle_icon_alignment',
			[
				'label'   => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'.elementor-widget-bdt-circle-menu' => 'justify-content: {{VALUE}}; display: flex;',
				],
				'condition' => [
					'toggle_icon_position' => '',
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_x_position',
			[
				'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' =>  0,
				],
				'range' => [
					'px' => [
						'min'  => -500,
						'step' => 10,
						'max'  => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-circle-menu-h-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'toggle_icon_y_position',
			[
				'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' =>  0,
				],
				'range' => [
					'px' => [
						'min'  => -500,
						'step' => 10,
						'max'  => 500,
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => '--ep-circle-menu-v-offset: {{SIZE}}px;'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_additional_settings',
			[
				'label' => esc_html__( 'Additional Settings', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'direction',
			[
				'label'   => __( 'Menu Direction', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-right',
				'options' => [
					'top'          => esc_html__('Top', 'bdthemes-element-pack'),
					'right'        => esc_html__('Right', 'bdthemes-element-pack'),
					'bottom'       => esc_html__('Bottom', 'bdthemes-element-pack'),
					'left'         => esc_html__('Left', 'bdthemes-element-pack'),
					'top'          => esc_html__('Top', 'bdthemes-element-pack'),
					'full'         => esc_html__('Full', 'bdthemes-element-pack'),
					'top-left'     => esc_html__('Top-Left', 'bdthemes-element-pack'),
					'top-right'    => esc_html__('Top-Right', 'bdthemes-element-pack'),
					'top-half'     => esc_html__('Top-Half', 'bdthemes-element-pack'),
					'bottom-left'  => esc_html__('Bottom-Left', 'bdthemes-element-pack'),
					'bottom-right' => esc_html__('Bottom-Right', 'bdthemes-element-pack'),
					'bottom-half'  => esc_html__('Bottom-Half', 'bdthemes-element-pack'),
					'left-half'    => esc_html__('Left-Half', 'bdthemes-element-pack'),
					'right-half'   => esc_html__('Right-Half', 'bdthemes-element-pack'),
				]
			]
		);

		$this->add_control(
			'item_diameter',
			[
				'label'   => __( 'Circle Menu Size', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 35,
				],
				'range' => [
					'px' => [
						'min'  => 20,
						'step' => 1,
						'max'  => 50,
					],
				],
			]
		);

		$this->add_control(
			'circle_radius',
			[
				'label'   => __( 'Circle Menu Distance', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
				],
				'range' => [
					'px' => [
						'min'  => 20,
						'step' => 5,
						'max'  => 500,
					],
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 500,
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'step' => 10,
						'max'  => 1000,
					],
				],
			]
		);

		$this->add_control(
			'delay',
			[
				'label'   => __( 'Delay', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1000,
				],
				'range' => [
					'px' => [
						'min'  => 100,
						'step' => 10,
						'max'  => 2000,
					],
				],
			]
		);

		$this->add_control(
			'step_out',
			[
				'label'   => __( 'Step Out', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min'  => -200,
						'step' => 5,
						'max'  => 200,
					],
				],
			]
		);

		$this->add_control(
			'step_in',
			[
				'label'   => __( 'Step In', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -20,
				],
				'range' => [
					'px' => [
						'min'  => -200,
						'step' => 5,
						'max'  => 200,
					],
				],
			]
		);

		$this->add_control(
			'trigger',
			[
				'label'   => __( 'Trigger', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [
					'hover' => esc_html__('Hover', 'bdthemes-element-pack'),
					'click' => esc_html__('Click', 'bdthemes-element-pack'),
				],
			]
		);

		$this->add_control(
			'tooltip_on_trigger',
			[
				'label'   => __('Tooltip Show', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_style_toggle_icon',
			[
				'label' => esc_html__( 'Toggle Icon', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'tabs_toggle_icon_style' );

		$this->start_controls_tab(
			'tab_toggle_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'toggle_icon_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'toggle_icon_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'toggle_icon_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon',
			]
		);

		$this->add_responsive_control(
			'toggle_icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'toggle_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'selectors'  => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'toggle_icon_shadow',
				'selector' => '{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon',
			]
		);

		$this->add_responsive_control(
			'toggle_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 48,
					],
				],
				'default' => [
					'size' => 16,
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon a svg' => 'height: {{SIZE}}px; width: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon a i' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'transition_function',
			[
				'label'   => esc_html__( 'Transition', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'ease',
				'options' => [
					'ease'        => esc_html__('Ease', 'bdthemes-element-pack'),
					'linear'      => esc_html__('Linear', 'bdthemes-element-pack'),
					'ease-in'     => esc_html__('Ease-In', 'bdthemes-element-pack'),
					'ease-out'    => esc_html__('Ease-Out', 'bdthemes-element-pack'),
					'ease-in-out' => esc_html__('Ease-In-Out', 'bdthemes-element-pack'),
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'toggle_icon_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_icon_hover_background',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_icon_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'toggle_icon_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-toggle-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_circle_menu_icon',
			[
				'label' => esc_html__( 'Circle Icon', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->start_controls_tabs( 'tabs_circle_menu_icon_style' );

		$this->start_controls_tab(
			'tab_circle_menu_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'circle_menu_icon_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu-container .bdt-menu-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-circle-menu-container .bdt-menu-icon svg *' => 'fill: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'circle_menu_icon_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'circle_menu_icon_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon',
			]
		);

		$this->add_responsive_control(
			'circle_menu_icon_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'circle_menu_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'selectors'  => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'circle_menu_icon_shadow',
				'selector' => '{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon',
			]
		);

		$this->add_responsive_control(
			'circle_menu_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'step' => 1,
						'max'  => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .bdt-circle-menu li.bdt-menu-icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'circle_menu_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'circle_menu_icon_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu-container .bdt-menu-icon:hover i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-circle-menu-container .bdt-menu-icon:hover svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_menu_icon_hover_background',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'circle_menu_icon_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'circle_menu_icon_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-circle-menu li:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render_loop_iconnav_list($settings, $list) {

		$this->add_render_attribute(
			[
				'iconnav-link' => [
					'class' => [
						'bdt-position-center',
					],
					'target' => [
						$list['iconnav_link']['is_external'] ? '_blank' : '_self',
					],
					'rel' => [
						$list['iconnav_link']['nofollow'] ? 'nofollow' : '',
					],
					'title' => [
						esc_html($list['title']),
					],
					'href' => [
						esc_url($list['iconnav_link']['url']),
					],
				],
			], '', '', true
		);

		if ( ! isset( $settings['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['icon'] = 'fas fa-arrow-right';
		}

		$migrated  = isset( $list['__fa4_migrated']['circle_menu_icon'] );
		$is_new    = empty( $list['icon'] ) && Icons_Manager::is_migration_allowed();

		$this->add_render_attribute('menu-item', 'class', 'bdt-menu-icon elementor-repeater-item-' . esc_attr($list['_id']), true);

		?>
		<li <?php echo($this->get_render_attribute_string('menu-item')); ?>>
			<a <?php echo $this->get_render_attribute_string( 'iconnav-link' ); ?>>
				<?php if ($list['circle_menu_icon']['value']) : ?>
					<span>

						<?php if ( $is_new || $migrated ) :
							Icons_Manager::render_icon( $list['circle_menu_icon'], [ 'aria-hidden' => 'true', 'class' => 'fa-fw' ] );
							else : ?>
								<i class="<?php echo esc_attr( $list['icon'] ); ?>" aria-hidden="true"></i>
							<?php endif; ?>

						</span>

					<?php endif; ?>
				</a>
			</li>
			<?php
		}

		protected function render() {
			$settings    = $this->get_settings_for_display();
			$id          = 'bdt-circle-menu-' . $this->get_id();
			$toggle_icon = ($settings['toggle_icon']) ? : 'plus';

			$this->add_render_attribute(
				[
					'circle-menu-container' => [
						'id' => [
							esc_attr($id),
						],
						'class' => [
							'bdt-circle-menu-container',
							$settings['toggle_icon_position'] ? 'bdt-position-fixed bdt-position-' . $settings['toggle_icon_position'] : '',
						],
					],
				]
			);		

			if ('custom' == $settings['toggle_icon']) {
				$this->add_render_attribute(
					[
						'toggle-icon' => [
							'href' => [
								'javascript:void(0)',
							],
							'class' => [
								'bdt-icon bdt-link-reset',
								'bdt-position-center',
							],
						],
					]
				);
			} else {
				$this->add_render_attribute(
					[
						'toggle-icon' => [
							'href' => [
								'javascript:void(0)',
							],
							'class' => [
								'bdt-icon bdt-link-reset',
								'bdt-position-center',
							],
						],
					]
				);
			}


			if( isset($settings['tooltip_on_trigger']) && $settings['tooltip_on_trigger'] == 'yes' ){
				$this->add_render_attribute(
					[
						'toggle-icon' => [
							'title' => [
								esc_html__('Click me to show menus.', 'bdthemes-element-pack'),
							],
						],
					]
				);
			}


			$circle_menu_settings = wp_json_encode(
				array_filter([
					"direction"           => $settings["direction"],
					"item_diameter"       => $settings["item_diameter"]["size"],
					"circle_radius"       => $settings["circle_radius"]["size"],
					"speed"               => $settings["speed"]["size"],
					"delay"               => $settings["delay"]["size"],
					"step_out"            => $settings["step_out"]["size"],
					"step_in"             => $settings["step_in"]["size"],
					"trigger"             => $settings["trigger"],
					"transition_function" => $settings["transition_function"]
				])
			);

			$this->add_render_attribute('circle-menu-settings', 'data-settings', $circle_menu_settings);			
			
			?>
			<div <?php echo $this->get_render_attribute_string( 'circle-menu-container' ); ?>>
				<ul class="bdt-circle-menu" <?php echo $this->get_render_attribute_string( 'circle-menu-settings' ); ?>>
					<li class="bdt-toggle-icon">

						<?php if ('custom' == $settings['toggle_icon']) { ?>
							<a <?php echo $this->get_render_attribute_string( 'toggle-icon' ); ?>>
								<?php Icons_Manager::render_icon( $settings['custom_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</a>
						<?php } else { ?>
							<a <?php echo $this->get_render_attribute_string( 'toggle-icon' ); ?>>
								<i class="ep-icon-<?php echo esc_attr($toggle_icon); ?>" aria-hidden="true"></i>
							</a>
						<?php } ?>

					</li>
					<?php
					foreach ($settings['circle_menu'] as $key => $nav) : 
						$this->render_loop_iconnav_list($settings, $nav);
					endforeach;
					?>
				</ul>
			</div>
			<?php
		}
	}
