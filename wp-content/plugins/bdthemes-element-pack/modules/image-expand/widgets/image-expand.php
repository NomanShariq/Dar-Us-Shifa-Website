<?php
namespace ElementPack\Modules\ImageExpand\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use ElementPack\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Image_Expand extends Module_Base {

	public function get_name() {
		return 'bdt-image-expand';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Image Expand', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-image-expand';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'fancy', 'effects', 'image', 'accordion', 'hover', 'slideshow', 'wide', 'box', 'animated boxs', 'expand' ];
	}

	public function is_reload_preview_required() {
		return false;
	}

	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return [ 'ep-image-expand' ];
        }
    }

	public function get_script_depends() {
		return [ 'gsap', 'split-text' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/gNg7vpypycY';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_fancy_layout',
			[
				'label' => __( 'Image Expand', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'skin_type',
			[
				'label'	   => __( 'Skin', 'bdthemes-element-pack' ),
				'type' 	   => Controls_Manager::SELECT,
				'options'  => [
					'default' 	=> __( 'Default', 'bdthemes-element-pack' ),
					'vertical' 	=> __( 'Vertical', 'bdthemes-element-pack' ),
				],
				'default'  => 'default',
				'prefix_class' => 'bdt-image-expand--skin-',
			]
		);

		$this->add_control(
			'hr_divider',
			[
				'type' 	   => Controls_Manager::DIVIDER,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image_expand_title', 
			[
				'label'       => __( 'Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Tab Title' , 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_link', 
			[
				'label'         => esc_html__( 'Title Link', 'bdthemes-element-pack' ),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => ''],
				'show_external' => false,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'image_expand_title!' => ''
				]
			]
		);

		$repeater->add_control(
			'image_expand_sub_title', 
			[
				'label'       => __( 'Sub Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'image_expand_text', 
			[
				'type'       => Controls_Manager::WYSIWYG,
				'dynamic'    => [ 'active' => true ],
				'default'    => __( 'Box Content', 'bdthemes-element-pack' ),
			]
		);

		$repeater->add_control(
			'image_expand_button', 
			[
				'label'       => esc_html__( 'Button Text', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Read More' , 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'button_link', 
			[
				'label'         => esc_html__( 'Button Link', 'bdthemes-element-pack' ),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => '#'],
				'show_external' => false,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'image_expand_button!' => ''
				]
			]
		);

		$repeater->add_control(
			'slide_image', 
			[
				'label'   => esc_html__( 'Background Image', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => [ 'active' => true ],
				'default' => [
					'url' => BDTEP_ASSETS_URL . 'images/slide/item-'.rand(1,6).'.jpg',
				],
			]
		);

		$this->add_control(
			'image_expand_items',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'image_expand_sub_title'   => __( 'This is a label', 'bdthemes-element-pack' ),
						'image_expand_title'   	  => __( 'Image Expand Item One', 'bdthemes-element-pack' ),
						'image_expand_text' 	  => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni.', 'bdthemes-element-pack' ),
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-1.jpg']
					],
					[
						'image_expand_sub_title'   => __( 'This is a label', 'bdthemes-element-pack' ),
						'image_expand_title'   => __( 'Image Expand Item Two', 'bdthemes-element-pack' ),
						'image_expand_text' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni.', 'bdthemes-element-pack' ),
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-2.jpg']
					],
					[
						'image_expand_sub_title'   => __( 'This is a label', 'bdthemes-element-pack' ),
						'image_expand_title'   => __( 'Image Expand Item Three', 'bdthemes-element-pack' ),
						'image_expand_text' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni.', 'bdthemes-element-pack' ),
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-3.jpg']
					],
					[
						'image_expand_sub_title'   => __( 'This is a label', 'bdthemes-element-pack' ),
						'image_expand_title'   => __( 'Image Expand Item Four', 'bdthemes-element-pack' ),
						'image_expand_text' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni.', 'bdthemes-element-pack' ),
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-4.jpg']
					],
				],
				'title_field' => '{{{ image_expand_title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'         => 'thumbnail_size',
				'label'        => esc_html__( 'Image Size', 'bdthemes-element-pack' ),
				'exclude'      => [ 'custom' ],
				'default'      => 'full',
				'prefix_class' => 'bdt-image-expand--thumbnail-size-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_layout_hover_box',
			[
				'label' => esc_html__( 'Additional Settings', 'bdthemes-element-pack' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'image_expand_min_height',
			[
				'label' => esc_html__('Height', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_expand_width',
			[
				'label' => esc_html__('Content Width', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-item .bdt-image-expand-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'items_content_align',
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
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-item .bdt-image-expand-content' => 'text-align: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__( 'Show Title', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_sub_title',
			[
				'label'   => esc_html__( 'Show Sub Title', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_text',
			[
				'label'   => esc_html__( 'Show Text', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_button',
			[
				'label'   => esc_html__( 'Show Button', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_tags',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => element_pack_title_tags(),
				'condition' => [
					'show_title' => 'yes'
				]
			]
		); 


		$this->add_control(
			'animation_heading',
			[
				'label'   => esc_html__( 'Animation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::HEADING, 
				'separator' => 'before',
			]
		);

		$this->add_control(
			'default_animation_type',
			[
				'label'   => esc_html__( 'Basic Animation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => element_pack_transition_options(),
				'condition' => [
					'animation_status!' => 'yes'
				]
			]
		);

		$this->add_control(
			'animation_status',
			[
				'label'   => esc_html__( 'Advanced Animation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			]
		);

        $this->add_control(
			'animation_of',
			[
				'label'	   => __( 'Animation Of', 'bdthemes-element-pack' ),
				'type' 	   => Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => [
					'.bdt-image-expand-sub-title' 	=> __( 'Sub Title', 'bdthemes-element-pack' ),
					'.bdt-image-expand-title'  		=> __( 'Title', 'bdthemes-element-pack' ),
					'.bdt-image-expand-text' 		=> __( 'Text', 'bdthemes-element-pack' ),
				],
				'default'  => [ '.bdt-image-expand-sub-title', '.bdt-image-expand-title', '.bdt-image-expand-text' ],
				'condition'=> [
					'animation_status' => 'yes'
				]
			]
		);

		

		$this->end_controls_section();

		$this->start_controls_section(
            'anim_option',
            [
                'label' => esc_html__('Animation', 'bdthemes-element-pack'),
                'condition' => [
					'animation_status' => 'yes',
				]
            ]
        );


		$this->add_control(
			'animation_on',
			[
				'label'   => __( 'Animation On', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'words',
				'options' => [
					'chars'   => 'Chars',
					'words'   => 'Words',
					'lines'   => 'Lines',
				],
			]
		);

		$this->add_control(
			'animation_options',
			[
				'label' => __( 'Animation Options', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => __( 'Default', 'bdthemes-element-pack' ),
				'label_on' => __( 'Custom', 'bdthemes-element-pack' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_control(
			'anim_perspective',
			[
				'label' => esc_html__('Perspective', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'placeholder' => '400',
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 400,
					],
				],
			]
		);

		$this->add_control(
			'anim_duration',
			[
				'label' => esc_html__('Transition Duration', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0.1,
						'step'=> 0.1,
						'max' => 1,
					],
				],
			]
		);	

		$this->add_control(
			'anim_scale',
			[
				'label' => esc_html__('Scale', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
			]
		);

		$this->add_control(
			'anim_rotationY',
			[
				'label' => esc_html__('rotationY', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
					],
				],
			]
		);

		$this->add_control(
			'anim_rotationX',
			[
				'label' => esc_html__('rotationX', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -360,
						'max' => 360,
					],
				],
			]
		);

		$this->add_control(
			'anim_transform_origin',
			[
				'label'   => esc_html__('Transform Origin', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::TEXT,
				'default' => '0% 50% -50',
			]
		);


		$this->end_popover();

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_image_expand_style',
			[
				'label' => __( 'Image Expand Item', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'image_expand_overlay_color',
			[
				'label'     => __( 'Overlay Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-item:before'  => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'tabs_content_padding',
			[
				'label'      => __( 'Content Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// $this->add_control(
		// 	'image_expand_divider_heading',
		// 	[
		// 		'label'     => __( 'Divider', 'bdthemes-element-pack' ),
		// 		'type'      => Controls_Manager::HEADING,
		// 		'separator' => 'before',
		// 	]
		// );

		// $this->add_control(
		// 	'image_expand_divider_color',
		// 	[
		// 		'label'     => __( 'Color', 'bdthemes-element-pack' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'selectors' => [
		// 			'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-item:after'  => 'background: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'image_expand_divider_width',
		// 	[
		// 		'label' => esc_html__('Width', 'bdthemes-element-pack'),
		// 		'type'  => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 10,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-item:after' => 'width: {{SIZE}}{{UNIT}}; right: calc(-{{SIZE}}{{UNIT}} / 2);',
		// 		],
		// 	]
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'show_text_stroke',
			[
				'label'   => esc_html__('Text Stroke', 'bdthemes-element-pack') . BDTEP_NC,
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-text-stroke--',
			]
		);

		$this->add_responsive_control(
			'text_stroke_width',
			[
				'label' => esc_html__('Text Stroke Width', 'bdthemes-element-pack') . BDTEP_NC,
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-title' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_text_stroke' => 'yes'
				]
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-title' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-title' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label'     => esc_html__( 'Subtitle', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_sub_title' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label'     => esc_html__( 'Text', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_text' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-text' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__( 'Button', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'selector'  => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'selector'    => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'border_radius_advanced_show!' => 'yes',
				],
			]
		);

		$this->add_control(
			'border_radius_advanced_show',
			[
				'label' => __( 'Advanced Radius', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'border_radius_advanced',
			[
				'label'       => esc_html__('Radius', 'bdthemes-element-pack'),
				'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', 'bdthemes-element-pack'), '30% 70% 82% 18% / 46% 62% 38% 54%', 'https://9elements.github.io/fancy-border-radius/'),
				'type'        => Controls_Manager::TEXT,
				'size_units'  => [ 'px', '%' ],
				'separator'   => 'after',
				'default'     => '30% 70% 82% 18% / 46% 62% 38% 54%',
				'selectors'   => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a'     => 'border-radius: {{VALUE}}; overflow: hidden;',
				],
				'condition' => [
					'border_radius_advanced_show' => 'yes',
				],
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector'  => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a:hover'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a:hover',
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-image-expand .bdt-image-expand-content .bdt-image-expand-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

	}


	public function render() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();
 
	    $animation_of = (isset($settings['animation_of'])) ? implode(", ",$settings['animation_of']) : '.bdt-image-expand-sub-title';

	    $animation_of = (strlen($animation_of))>0 ? $animation_of : '.bdt-image-expand-sub-title';

		$animation_status = ($settings['animation_status'] == 'yes'?'yes':'no');

		if( $settings['animation_status'] == 'yes' ){
			$this->add_render_attribute(
				[
					'image-expand' => [
						'id' => 'bdt-image-expand-' . $this->get_id(),
						'class' => 'bdt-image-expand bdt-image-expand-default',
						'data-settings' => [
							wp_json_encode([
								'wide_id' 				=> 'bdt-image-expand-' . $this->get_id(),
								'animation_status'		=> $animation_status,
								'animation_of'			=> $animation_of,
								'animation_on'     		=> $settings['animation_on'],
								'anim_perspective'      => ($settings['anim_perspective']['size']) ? $settings['anim_perspective']['size'] : 400,
								'anim_duration'    		=> ($settings['anim_duration']['size']) ? $settings['anim_duration']['size'] : 0.1,
								'anim_scale'    		=> ($settings['anim_scale']['size']) ? $settings['anim_scale']['size'] : 0,
								'anim_rotation_y'    	=> ($settings['anim_rotationY']['size']) ? $settings['anim_rotationY']['size'] : 80,
								'anim_rotation_x'    	=> ($settings['anim_rotationX']['size']) ? $settings['anim_rotationX']['size'] : 180,
								'anim_transform_origin' => ($settings['anim_transform_origin']) ? $settings['anim_transform_origin'] : '0% 50% -50',
					        ])
						]
					]
				]
			);
		}else{
				$this->add_render_attribute(
				[
					'image-expand' => [
						'id' => 'bdt-image-expand-' . $this->get_id(),
						'class' => 'bdt-image-expand bdt-image-expand-default',
						'data-settings' => [
							wp_json_encode(array_filter([
								'wide_id' => 'bdt-image-expand-' . $this->get_id(),
								'animation_status'		=> $animation_status,
								'default_animation_type'=> (strlen($settings['default_animation_type'])>0 ? $settings['default_animation_type'] : 'fade')
							]))
						]
					]
				]
			);
		}

		

		?>

		<div <?php echo ( $this->get_render_attribute_string( 'image-expand' ) ); ?>>
			<?php foreach ( $settings['image_expand_items'] as $index => $item ) : 

                $slide_image = Group_Control_Image_Size::get_attachment_image_src( $item['slide_image']['id'], 'thumbnail_size', $settings);
                if ( ! $slide_image ) {
                    $slide_image = $item['slide_image']['url'];
                }

				$this->add_render_attribute( 'image-expand-item', 'class', 'bdt-image-expand-item', true );
				$this->add_render_attribute( 'bdt-image-expand-title', 'class', 'bdt-image-expand-title', true );
				$this->add_render_attribute( 'image-expand-item', 'id', $this->get_id().'-'.$item['_id'], true );

				?> 

				<div <?php echo $this->get_render_attribute_string( 'image-expand-item' ); ?> 
				style="background-image: url('<?php echo esc_url( $slide_image); ?>');">

					<div class="bdt-image-expand-content">
						<?php if ( $item['image_expand_sub_title'] && ( 'yes' == $settings['show_sub_title'] ) ) : ?>
							<div class="bdt-image-expand-sub-title">
								<?php echo wp_kses( $item['image_expand_sub_title'], element_pack_allow_tags('title') ); ?>
							</div>
						<?php endif; ?>
	
						<?php if ( $item['image_expand_title'] && ( 'yes' == $settings['show_title'] ) ) : ?>
							<<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('bdt-image-expand-title'); ?>>
								<?php if ( '' !== $item['title_link']['url'] ) : ?>
									<a href="<?php echo esc_url( $item['title_link']['url'] ); ?>">
								<?php endif; ?>
									<?php echo wp_kses( $item['image_expand_title'], element_pack_allow_tags('title') ); ?>
								<?php if ( '' !== $item['title_link']['url'] ) : ?>
									</a>
								<?php endif; ?>
							</<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?>>
						<?php endif; ?>
	
						<?php if ( $item['image_expand_text'] && ( 'yes' == $settings['show_text'] ) ) : ?>
							<div class="bdt-image-expand-text">
								<?php echo $this->parse_text_editor( $item['image_expand_text'] ); ?>
							</div>
						<?php endif; ?>
	
						<?php if ($item['image_expand_button'] && ( 'yes' == $settings['show_button'] )) : ?>
							<div class="bdt-image-expand-button">
								<?php if ( '' !== $item['button_link']['url'] ) : ?>
									<a href="<?php 
									if($item['button_link']['url'] == '#'){
										echo 'javascript:void(0);'; 
									}else{
										echo esc_url( $item['button_link']['url'] ); 
									}
									?>">
								<?php endif; ?>
									<?php echo wp_kses_post($item['image_expand_button']); ?>
								<?php if ( '' !== $item['button_link']['url'] ) : ?>
									</a>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php 
	}
 
} 