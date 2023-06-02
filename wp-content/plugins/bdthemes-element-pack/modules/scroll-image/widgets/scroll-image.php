<?php
namespace ElementPack\Modules\ScrollImage\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Scroll_Image extends Module_Base {

	public function get_name() {
		return 'bdt-scroll-image';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Scroll Image', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-scroll-image';
	}

	public function get_categories() {
	 	return [ 'element-pack' ];
 	}

 	public function get_keywords() {
		return [ 'scroll', 'image', 'link', 'view', 'lightbox' ];
	}

	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return [ 'ep-scroll-image', 'element-pack-font' ];
        }
    }

	public function get_custom_help_url() {
		return 'https://youtu.be/UpmtN1GsJkQ';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Image', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   => __( 'Choose Image', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image_size',
				'default'   => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'image_framing',
			[
				'label' => esc_html__( 'Image Framing', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'frame',
			[
				'label'   => esc_html__( 'Select Frame', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desktop',
				'options' => [
					'desktop'    => esc_html__('Desktop', 'bdthemes-element-pack') ,
					'safari'    => esc_html__('Safari', 'bdthemes-element-pack') ,
					'chrome'     => esc_html__('Chrome', 'bdthemes-element-pack') ,
					'chrome-dark'     => esc_html__('Chrome Dark', 'bdthemes-element-pack') ,
					'firefox'     => esc_html__('Firefox', 'bdthemes-element-pack') ,
					'edge'     	=> esc_html__('Edge', 'bdthemes-element-pack') ,
					'edge-dark'     	=> esc_html__('Edge Dark', 'bdthemes-element-pack') ,
					'macbookpro' => esc_html__('Macbook Pro', 'bdthemes-element-pack') ,
					'macbookair' => esc_html__('Macbook Air', 'bdthemes-element-pack') ,
					'tablet'     => esc_html__('Tablet', 'bdthemes-element-pack') ,
				],
				'condition' => [
					'image_framing' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'max_width',
			[
				'label'     => __( 'Width', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'range'     => [
					'px' => [
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'min_height',
			[
				'label' => __( 'Min Height', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 10,
						'min'  => 5,
						'max'  => 1200,
					],
				],
				'default' => [
					'size' => 320,
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-scroll-image' => 'min-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_control(
			'caption',
			[
				'label'       => __( 'Caption', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your image caption', 'bdthemes-element-pack' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label'   => __( 'Link To', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'lightbox',
				'options' => [
					'lightbox' => __( 'Lightbox', 'bdthemes-element-pack' ),
					'modal'    => __( 'Modal', 'bdthemes-element-pack' ),
					'external' => __( 'External', 'bdthemes-element-pack' ),
					''         => __( 'None', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'external_link',
			[
				'label'         => __( 'External Link', 'bdthemes-element-pack' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'placeholder'   => __( 'https://your-link.com', 'bdthemes-element-pack' ),
				'default'       => [
					'url' => '#',
				],
				'dynamic'     => [ 'active' => true ],
				'condition' => [
					'link_to' => ['external', 'modal'],
				],
			]
		);

		$this->add_control(
			'link_icon',
			[
				'label'   => __( 'Choose Link Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'link' => [
						'title' => __( 'Link', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-link',
					],
					'plus' => [
						'title' => __( 'Plus', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-plus',
					],
					'search' => [
						'title' => __( 'Zoom', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-search',
					],
				],
				'default' => 'link',
				'condition' => [
					'link_to!' => '',
				],
			]
		);

		$this->add_control(
			'link_icon_position',
			[
				'label'     => __( 'Link Icon Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => element_pack_position(),
				'default'   => 'top-left',
				'condition' => [
					'link_to!'       => '',
					'image_framing!' => 'yes',
				],
			]
		);

		$this->add_control(
			'image_scroll_option',
			[
				'label'   => esc_html__( 'Select Image Scroll', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-top',
				'options' => [
					'bottom-top'    => esc_html__('Bottom Top', 'bdthemes-element-pack') ,
					'top-bottom'    => esc_html__('Top Bottom', 'bdthemes-element-pack') ,
					'left-right'     => esc_html__('Left right', 'bdthemes-element-pack') ,
					'right-left'     => esc_html__('Right Left', 'bdthemes-element-pack') ,
				],
			]
		);

		$this->add_control(
			'link_icon_on_hover',
			[
				'label'        => __( 'Link Icon On Hover', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-link-icon-on-hover-',
				'conditions'   => [
					'terms' => [
						[
							'name'     => 'link_to',
							'operator' => '!=',
							'value'    => '',
						],
						[
							'name'     => 'link_icon',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'badge',
			[
				'label' => __( 'Badge', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_badge',
			[
				'label'     => __( 'Badge', 'bdthemes-element-pack' ),
				'condition' => [
					'badge' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_text',
			[
				'label'       => __( 'Badge Text', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'POPULAR',
				'placeholder' => 'Type Badge Title',
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'badge_position',
			[
				'label'   => esc_html__( 'Position', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top-right',
				'options' => element_pack_position(),
			]
		);

		$this->add_responsive_control(
			'badge_horizontal_offset',
			[
				'label' => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
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
						'min'  => -300,
						'step' => 2,
						'max'  => 300,
					],
				],
			]
		);

		$this->add_responsive_control(
			'badge_vertical_offset',
			[
				'label' => __( 'Vertical Offset', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
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
						'min'  => -300,
						'step' => 2,
						'max'  => 300,
					],
				],
			]
		);

		$this->add_responsive_control(
			'badge_rotate',
			[
				'label'   => esc_html__( 'Rotate', 'bdthemes-element-pack' ),
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
						'min'  => -360,
						'max'  => 360,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .bdt-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset.SIZE}}px, {{badge_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .bdt-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset_tablet.SIZE}}px, {{badge_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .bdt-scroll-image-badge' => 'transform: translate({{badge_horizontal_offset_mobile.SIZE}}px, {{badge_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'transition_duration',
			[
				'label'   => __( 'Transition Duration', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 2,
				],
				'range' => [
					'px' => [
						'step' => 0.1,
						'min'  => 0.1,
						'max'  => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image' => 'transition: background-position {{SIZE}}s ease-in-out;-webkit-transition: background-position {{SIZE}}s ease-in-out;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'image_border',
				'selector'  => '{{WRAPPER}} .bdt-scroll-image',
				'separator' => 'before',
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'    => 'image_shadow',
				'exclude' => [
					'shadow_position',
				],
				'selector' => '{{WRAPPER}} .bdt-scroll-image',
				'condition' => [
					'image_framing!' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label'     => __( 'Caption', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption!' => '',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label'   => __( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'caption_border',
				'label'       => __( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-scroll-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};overflow: hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label'      => __( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'caption_margin',
			[
				'label'      => __( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .bdt-scroll-image-caption',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon',
			[
				'label'      => esc_html__( 'Icon Style', 'bdthemes-element-pack' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'link_to',
							'operator' => '!=',
							'value'    => '',
						],
						[
							'name'     => 'link_icon',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'step' => 10,
						'min'  => 2,
						'max'  => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon' => 'font-size: {{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'icon_shadow',
				'selector' => '{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon',
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_control(
			'icon_spacing',
			[
				'label'      => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon:hover'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-container .bdt-link-icon:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_badge',
			[
				'label'     => __( 'Badge', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'badge' => 'yes',
				],
			]
		);

		$this->add_control(
			'badge_text_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-scroll-image-badge span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'badge_background',
				'selector'  => '{{WRAPPER}} .bdt-scroll-image-badge span', 
				'separator' => 'before', 
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'badge_border',
				'placeholder' => '1px',
				'separator'   => 'before',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-scroll-image-badge span'
			]
		);

		$this->add_responsive_control(
			'badge_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after', 
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-badge span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'badge_shadow',
				'selector' => '{{WRAPPER}} .bdt-scroll-image-badge span',
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => __( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-scroll-image-badge span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'badge_typography',
				'selector' => '{{WRAPPER}} .bdt-scroll-image-badge span',
			]
		);

		$this->end_controls_section();
	}

	protected function render_image($settings) {
		$image_url = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image_size', $settings);

		if ( ! $image_url ) {
			$image_url = $settings['image']['url'];
		}

		$frame      = $settings['frame'];
		$max_width  = '1280';
		$max_height = '720';
		
		if ('desktop' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('safari' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('chrome' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('chrome-dark' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('firefox' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('edge' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('edge-dark' === $frame) {
			$max_width  = '1280';
			$max_height = '720';
		} elseif ('macbookpro' === $frame) {
			$max_width  = '1280';
			$max_height = '815';
		} elseif ('macbookair' === $frame) {
			$max_width  = '1280';
			$max_height = '810';
		} elseif ('tablet' === $frame) {
			$max_width  = '768';
			$max_height = '1024';
		}
		
		$this->add_render_attribute( 'image-wrapper', 'bdt-responsive', 'width: ' . $max_width . '; height: ' . $max_height );
		$this->add_render_attribute( 'image-wrapper', 'class', 'bdt-responsive-width' );


		if ( 'top-bottom' == $settings['image_scroll_option'] ) {
			$this->add_render_attribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-top-bottom' );
		} elseif ( 'bottom-top' == $settings['image_scroll_option'] ) {
			$this->add_render_attribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-bottom-top' );
		} elseif ( 'left-right' == $settings['image_scroll_option'] ) {
			$this->add_render_attribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-left-right' );
		} elseif ( 'right-left' == $settings['image_scroll_option'] ) {
			$this->add_render_attribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-right-left' );
		}

		$this->add_render_attribute( 'image', 'style', 'background-image: url(' . esc_url($image_url) . ');' );

		if ( $settings['image_framing'] ) : ?>
			<div class="bdt-device-slider-device">
				<img src="<?php echo BDTEP_ASSETS_URL; ?>images/devices/<?php echo esc_attr( $frame ); ?>.svg" alt="">
				<div <?php echo $this->get_render_attribute_string( 'image-wrapper' ); ?>>
		<?php endif; ?>

			<div <?php echo $this->get_render_attribute_string( 'image' ); ?>></div>

		<?php if ( $settings['image_framing'] ) : ?>
			</div></div>
		<?php endif; ?>
		<?php
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		$has_caption = ! empty( $settings['caption'] );

		$this->add_render_attribute( 'wrapper', 'class', 'bdt-scroll-image-holder' );
		
		if ($settings['image_framing']) {
			$this->add_render_attribute( 'wrapper', 'class', 'bdt-device-slider bdt-device-slider-' . esc_attr($settings['frame']) );
			$link_icon_position = 'center';
		} else {
			$link_icon_position = $settings['link_icon_position'];
		}

		if ( '' !== $settings['link_to'] ) {			
			if ('lightbox' == $settings['link_to']) {
				$link = $settings['image']['url'];
			} else {
				$link = $settings['external_link']['url'];
			}

			$this->add_render_attribute( 'link', 'href', esc_url($link));

			if ( $settings['link_icon'] ) {
				$this->add_render_attribute( 'link', [
					'class'    => 'bdt-link-icon ',
				]);
				$this->add_render_attribute( 'link-wrapper', [
					'class'    => 'bdt-position-small bdt-position-' . esc_attr( $link_icon_position ),
				]);
			}
		}

		if ( 'lightbox' === $settings['link_to'] or 'modal' === $settings['link_to'] ) {
			$this->add_render_attribute('container', 'data-bdt-lightbox', 'toggle: .bdt-scroll-image-lightbox-item; animation: slide;');
			$this->add_render_attribute( 'link', 'data-elementor-open-lightbox', 'no');
			$this->add_render_attribute( 'link', 'class', 'bdt-scroll-image-lightbox-item');
		}

		if ('modal' === $settings['link_to']) {
			$this->add_render_attribute( 'link', 'data-type', 'iframe' );
		}

		$this->add_render_attribute( 'container', 'class', 'bdt-scroll-image-container' );

		if ( isset($settings['external_link']['is_external']) ) {
			$this->add_render_attribute( 'link', 'target', '_blank' );
		}

		if ( isset($settings['external_link']['nofollow']) ) {
			$this->add_render_attribute( 'link', 'rel', 'nofollow' );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'container' ); ?>>
			<?php if (( '' !== $settings['link_to'] ) and ( '' == $settings['link_icon'] )): ?>
				<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>

				<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
					<?php if ( $has_caption ) : ?>
						<figure class="wp-caption">
					<?php endif; ?>
						
						<?php $this->render_image($settings); ?>

						<?php if (('' !== $settings['link_to']) and ('' !== $settings['link_icon'])) : ?>
						<div <?php echo $this->get_render_attribute_string( 'link-wrapper' ); ?>>
							<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
								<i class="ep-icon-<?php echo esc_attr($settings['link_icon']); ?> fa-fw" aria-hidden="true"></i>
							</a>
						</div>
						<?php endif; ?>

					<?php if ( $has_caption ) : ?>
							<figcaption class="bdt-scroll-image-caption bdt-caption-text"><?php echo esc_attr($settings['caption']); ?></figcaption>
						</figure>
					<?php endif; ?>
				</div>

			<?php if (('' !== $settings['link_to']) and ('' == $settings['link_icon'])): ?>
				</a>
			<?php endif; ?>

			<?php if ( $settings['badge'] and '' != $settings['badge_text'] ) : ?>
			<div class="bdt-scroll-image-badge bdt-position-<?php echo esc_attr($settings['badge_position']); ?>">
					<span class="bdt-badge bdt-padding-small"><?php echo esc_html($settings['badge_text']); ?></span>
				</div>
			<?php endif; ?>

		</div>
		<?php
	}

	protected function content_template() {
		?>
		<# if ( settings.image.url ) {
			var image = {
				id        : settings.image.id,
				url       : settings.image.url,
				size      : settings.image_size,
				dimension : settings.image_custom_dimension,
				model     : view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );
			var link_url = '';

			if ( ! image_url ) {
				return;
			}

			var frame      = settings.frame;
			var max_width  = '1280';
			var max_height = '720';
			
			if ('desktop' === frame) {
				max_width  = '1280';
				max_height = '720';
			} else if ('safari' === frame) {
				max_width  = '1280';
				max_height = '815';
			} else if ('chrome' === frame) {
				$max_width  = '1280';
				$max_height = '720';
			} else if ('chrome-dark' === frame) {
				$max_width  = '1280';
				$max_height = '720';
			} else if ('firefox' === frame) {
				$max_width  = '1280';
				$max_height = '720';
			} else if ('edge' === frame) {
				$max_width  = '1280';
				$max_height = '720';
			} else if ('edge-dark' === frame) {
				$max_width  = '1280';
				$max_height = '720';
			} else if ('macbookpro' === frame) {
				max_width  = '1280';
				max_height = '815';
			} else if ('macbookair' === frame) {
				max_width  = '1280';
				max_height = '810';
			} else if ('tablet' === frame) {
				max_width  = '768';
				max_height = '1024';
			}

			view.addRenderAttribute( 'container', 'class', 'bdt-scroll-image-container' );

			view.addRenderAttribute( 'image-wrapper', 'bdt-responsive', 'width: ' + max_width + '; height: ' + max_height );
			view.addRenderAttribute( 'image-wrapper', 'class', 'bdt-responsive-width' );

			view.addRenderAttribute( 'wrapper', 'class', [ 'elementor-image', 'bdt-scroll-image-holder' ] );

			if ( settings.image_framing ) {
				view.addRenderAttribute( 'wrapper', 'class', [ 'bdt-device-slider', 'bdt-device-slider-' + settings.frame ] );
				var link_icon_position = 'center';
			} else {
				var link_icon_position = settings.link_icon_position;
			}

			var hasCaption = '' !== settings.caption;

			if ('' !== settings.link_to) {

				if ('lightbox' == settings.link_to) {
					link_url = image_url;
				} else {
					link_url = settings.external_link.url;
				}

				view.addRenderAttribute( 'link', 'href', 'link_url' );

				if ( 'lightbox' === settings.link_to || 'modal' === settings.link_to ) {
					view.addRenderAttribute('container', 'bdt-lightbox', 'toggle: .bdt-scroll-image-lightbox-item; animation: slide;');
					view.addRenderAttribute( 'link', 'data-elementor-open-lightbox', 'no');
					view.addRenderAttribute( 'link', 'class', 'bdt-scroll-image-lightbox-item');
				}

				if ('modal' === settings.link_to) {
					view.addRenderAttribute( 'link', 'data-type', 'iframe' );
				}

				if ('' !== settings.link_icon) {
					view.addRenderAttribute( 'link-wrapper', 'class', ['bdt-position-small', 'bdt-position-' + link_icon_position] );
					view.addRenderAttribute( 'link', 'class', ['bdt-link-icon'] );
				}
			}

			if ( 'top-bottom' == settings.image_scroll_option ) {
				view.addRenderAttribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-top-bottom' );
			} else if ( 'bottom-top' == settings.image_scroll_option ) {
				view.addRenderAttribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-bottom-top' );
			} else if ( 'left-right' == settings.image_scroll_option ) {
				view.addRenderAttribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-left-right' );
			} else if ( 'right-left' == settings.image_scroll_option ) {
				view.addRenderAttribute( 'image', 'class', 'bdt-scroll-image bdt-scroll-image-right-left' );
			}

			if ( settings.external_link.is_external ) {
					view.addRenderAttribute( 'link', 'target', '_blank' );
			}

			if ( settings.external_link.nofollow ) {
					view.addRenderAttribute( 'link', 'rel', 'nofollow' );
			}

			view.addRenderAttribute( 'image', 'style', 'background-image: url("' + settings.image.url + '");' );

			var container_print = view.getRenderAttributeString( 'container' );
			var wrapper_print   = view.getRenderAttributeString( 'wrapper' );
			var link_print      = view.getRenderAttributeString( 'link' );

			#>
			<div <# print(container_print); #>>
				<# if (('' !== settings.link_to) && ('' == settings.link_icon)) { #>
					<a <# print(link_print); #>>
				<# } #>

					<div <# print(wrapper_print); #>>

					<# if ( hasCaption ) { #>
						<figure class="wp-caption">
					<# } #>

						<# if ( settings.image_framing ) { #>
							<div class="bdt-device-slider-device">
								<img src="<?php echo esc_url(BDTEP_ASSETS_URL); ?>images/devices/{{{frame}}}.svg" alt="">
								<div <# print(view.getRenderAttributeString( 'image-wrapper' )); #>>
						<# } #>

							<div <# print(view.getRenderAttributeString( 'image' )); #>></div>

						<# if ( settings.image_framing ) { #>
							</div></div>
						<# } #>

						<# if (('' !== settings.link_to) && ('' !== settings.link_icon)) { #>
                            <div <# print(view.getRenderAttributeString( 'link-wrapper' )); #>>
                                <a <# print(link_print); #>>
									<i class="ep-{{{settings.link_icon}}} fa-fw" aria-hidden="true"></i>
                                </a>
                            </div>
						<# } #>

					<# if ( hasCaption ) { #>
							<figcaption class="bdt-scroll-image-caption bdt-caption-text">{{{ settings.caption }}}</figcaption>
						</figure>
					<# } #>

					</div>

				<# if (('' !== settings.link_to) && ('' == settings.link_icon)) { #>
					<a <# print(link_print); #>>
				<# } #>
			</div>

			<# if ( settings.badge && settings.badge_text != '' ) { #>
				<div class="bdt-scroll-image-badge bdt-position-{{{settings.badge_position}}}">
					<span class="bdt-badge bdt-padding-small">{{{settings.badge_text}}}</span>
				</div>
			<# } #>

		<# } #>
		<?php
	}
}
