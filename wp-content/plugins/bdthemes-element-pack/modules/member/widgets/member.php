<?php

namespace ElementPack\Modules\Member\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Icons_Manager;

use ElementPack\Modules\Member\Skins;

if ( !defined('ABSPATH') ) {
    exit; // Exit if accessed directly.
}

class Member extends Module_Base {
    public function get_name() {
        return 'bdt-member';
    }

    public function get_title() {
        return BDTEP . esc_html__('Member', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-member';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['member', 'team', 'experts'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-member'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/m8_KOHzssPA';
    }

    protected function _register_skins() {
        $this->add_skin(new Skins\Skin_Band($this));
        $this->add_skin(new Skins\Skin_Calm($this));
        $this->add_skin(new Skins\Skin_Ekip($this));
        $this->add_skin(new Skins\Skin_Phaedra($this));
        $this->add_skin(new Skins\Skin_Partait($this));
        $this->add_skin(new Skins\Skin_Flip($this));
    }


    protected function _register_controls() {
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__('Layout', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'photo',
            [
                'label'   => esc_html__('Choose Photo', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => BDTEP_ASSETS_URL . 'images/member.svg',
                ],
            ]
        );

        $this->add_control(
            'member_alternative_photo',
            [
                'label' => esc_html__('Alternative Photo', 'bdthemes-element-pack'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'alternative_photo',
            [
                'label'     => esc_html__('Choose Photo', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::MEDIA,
                'dynamic'   => ['active' => true],
                'default'   => [
                    'url' => BDTEP_ASSETS_URL . 'images/member.svg',
                ],
                'condition' => [
                    'member_alternative_photo' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_mask_popover',
            [
                'label'        => __('Image Mask', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'render_type'  => 'ui',
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_control(
            'image_mask_shape',
            [
                'label'     => __('Masking Shape', 'bdthemes-element-pack'),
                'title'     => __('Masking Shape', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'default'   => 'default',
                'options'   => [
                    'default' => [
                        'title' => __('Default Shapes', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-star',
                    ],
                    'custom'  => [
                        'title' => __('Custom Shape', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-image-bold',
                    ],
                ],
                'toggle'    => false,
                'condition' => [
                    'image_mask_popover' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_mask_shape_default',
            [
                'label'          => _x('Default', 'Mask Image', 'bdthemes-element-pack'),
                'label_block'    => true,
                'show_label'     => false,
                'type'           => Controls_Manager::SELECT,
                'default'        => '',
                'options'        => element_pack_mask_shapes(),
                'selectors'      => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-image: url({{VALUE}}); mask-image: url({{VALUE}});',
                ],
                'condition'      => [
                    'image_mask_popover' => 'yes',
                    'image_mask_shape'   => 'default',
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'image_mask_shape_custom',
            [
                'label'      => _x('Custom Shape', 'Mask Image', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
                'selectors'  => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-image: url({{URL}}); mask-image: url({{URL}});',
                ],
                'condition'  => [
                    'image_mask_popover' => 'yes',
                    'image_mask_shape'   => 'custom',
                ],
            ]
        );

        $this->add_control(
            'image_mask_shape_position',
            [
                'label'                => __('Position', 'bdthemes-element-pack'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'center-center',
                'options'              => [
                    'center-center' => __('Center Center', 'bdthemes-element-pack'),
                    'center-left'   => __('Center Left', 'bdthemes-element-pack'),
                    'center-right'  => __('Center Right', 'bdthemes-element-pack'),
                    'top-center'    => __('Top Center', 'bdthemes-element-pack'),
                    'top-left'      => __('Top Left', 'bdthemes-element-pack'),
                    'top-right'     => __('Top Right', 'bdthemes-element-pack'),
                    'bottom-center' => __('Bottom Center', 'bdthemes-element-pack'),
                    'bottom-left'   => __('Bottom Left', 'bdthemes-element-pack'),
                    'bottom-right'  => __('Bottom Right', 'bdthemes-element-pack'),
                ],
                'selectors_dictionary' => [
                    'center-center' => 'center center',
                    'center-left'   => 'center left',
                    'center-right'  => 'center right',
                    'top-center'    => 'top center',
                    'top-left'      => 'top left',
                    'top-right'     => 'top right',
                    'bottom-center' => 'bottom center',
                    'bottom-left'   => 'bottom left',
                    'bottom-right'  => 'bottom right',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-position: {{VALUE}}; mask-position: {{VALUE}};',
                ],
                'condition'            => [
                    'image_mask_popover' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_mask_shape_size',
            [
                'label'     => __('Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'contain',
                'options'   => [
                    'auto'    => __('Auto', 'bdthemes-element-pack'),
                    'cover'   => __('Cover', 'bdthemes-element-pack'),
                    'contain' => __('Contain', 'bdthemes-element-pack'),
                    'initial' => __('Custom', 'bdthemes-element-pack'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-size: {{VALUE}}; mask-size: {{VALUE}};',
                ],
                'condition' => [
                    'image_mask_popover' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'image_mask_shape_custom_size',
            [
                'label'      => _x('Custom Size', 'Mask Image', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'responsive' => true,
                'size_units' => ['px', 'em', '%', 'vw'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'required'   => true,
                'selectors'  => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-size: {{SIZE}}{{UNIT}}; mask-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'image_mask_popover'    => 'yes',
                    'image_mask_shape_size' => 'initial',
                ],
            ]
        );

        $this->add_control(
            'image_mask_shape_repeat',
            [
                'label'                => __('Repeat', 'bdthemes-element-pack'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'no-repeat',
                'options'              => [
                    'repeat'          => __('Repeat', 'bdthemes-element-pack'),
                    'repeat-x'        => __('Repeat-x', 'bdthemes-element-pack'),
                    'repeat-y'        => __('Repeat-y', 'bdthemes-element-pack'),
                    'space'           => __('Space', 'bdthemes-element-pack'),
                    'round'           => __('Round', 'bdthemes-element-pack'),
                    'no-repeat'       => __('No-repeat', 'bdthemes-element-pack'),
                    'repeat-space'    => __('Repeat Space', 'bdthemes-element-pack'),
                    'round-space'     => __('Round Space', 'bdthemes-element-pack'),
                    'no-repeat-round' => __('No-repeat Round', 'bdthemes-element-pack'),
                ],
                'selectors_dictionary' => [
                    'repeat'          => 'repeat',
                    'repeat-x'        => 'repeat-x',
                    'repeat-y'        => 'repeat-y',
                    'space'           => 'space',
                    'round'           => 'round',
                    'no-repeat'       => 'no-repeat',
                    'repeat-space'    => 'repeat space',
                    'round-space'     => 'round space',
                    'no-repeat-round' => 'no-repeat round',
                ],
                'selectors'            => [
                    '{{WRAPPER}} .bdt-image-mask' => '-webkit-mask-repeat: {{VALUE}}; mask-repeat: {{VALUE}};',
                ],
                'condition'            => [
                    'image_mask_popover' => 'yes',
                ],
            ]
        );


        $this->end_popover();

        $this->add_control(
            'name',
            [
                'label'       => esc_html__('Name', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('John Doe', 'bdthemes-element-pack'),
                'placeholder' => esc_html__('Member Name', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'role',
            [
                'label'       => esc_html__('Role', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Managing Director', 'bdthemes-element-pack'),
                'placeholder' => esc_html__('Member Role', 'bdthemes-element-pack'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Description', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Type here some info about this team member, the man very important person of our company.', 'bdthemes-element-pack'),
                'placeholder' => esc_html__('Member Description', 'bdthemes-element-pack'),
                'rows'        => 10,
                'condition'   => ['_skin' => ['', 'bdt-partait', 'bdt-band', 'bdt-flip']],
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_control(
            'member_social_icon',
            [
                'label'   => esc_html__('Social Icon', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'skin_partait_align',
            [
                'label'     => esc_html__('Alignment', 'bdthemes-element-pack') . BDTEP_NC,
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member.bdt-member-skin-partait .bdt-member-desc-wrapper' => 'text-align: {{VALUE}} !important;',
                ],
                'condition' => [
                    '_skin' => 'bdt-partait'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_social_link',
            [
                'label'     => esc_html__('Social Icon', 'bdthemes-element-pack'),
                'condition' => ['member_social_icon' => 'yes'],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_link_title',
            [
                'label'   => esc_html__('Title', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'Facebook',
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label'   => esc_html__('Link', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::TEXT,
                'default' => 'http://www.facebook.com/bdthemes/',
            ]
        );

        $repeater->add_control(
            'social_share_icon',
            [
                'label'            => esc_html__('Choose Icon', 'bdthemes-element-pack'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'social_icon',
            ]
        );

        $repeater->add_control(
            'icon_background',
            [
                'label'     => esc_html__('Icon Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icons {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $repeater->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Icon Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icons {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'social_link_list',
            [
                'type'        => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default'     => [
                    [
                        'social_link'       => 'http://www.facebook.com/bdthemes/',
                        'social_share_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands'],
                        'social_link_title' => 'Facebook',
                    ],
                    [
                        'social_link'       => 'http://www.twitter.com/bdthemes/',
                        'social_share_icon' => ['value' => 'fab fa-twitter', 'library' => 'fa-brands'],
                        'social_link_title' => 'Twitter',
                    ],
                    [
                        'social_link'       => 'http://www.linkedin.com/bdthemes/',
                        'social_share_icon' => ['value' => 'fab fa-linkedin-in', 'library' => 'fa-brands'],
                        'social_link_title' => 'Linkedin',
                    ],
                ],
                'title_field' => '{{{ social_link_title }}}',
            ]
        );

        $this->end_controls_section();

        //style
        $this->start_controls_section(
            'section_style',
            [
                'label'     => esc_html__('Member', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_skin' => ['', 'bdt-band'],
                ],
            ]
        );

        $this->add_control(
            'band_item_background_color',
            [
                'label'     => __('Background Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member.bdt-member-skin-band .bdt-member-item-wrapper' => 'background: {{VALUE)}};',
                ],
                'condition' => [
                    '_skin' => ['bdt-band'],
                ],
            ]
        );

        $this->add_control(
            'band_overlay_color',
            [
                'label'     => __('Overlay Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member.bdt-member-skin-band .bdt-member-photo:before' => 'background: {{VALUE)}};',
                ],
                'condition' => [
                    '_skin' => ['bdt-band'],
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__('Text Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'desc_padding',
            [
                'label'      => esc_html__('Description Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member .bdt-member-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_flip_style',
			[
                'label' => __( 'Flip Style', 'bdthemes-element-pack' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_skin' => 'bdt-flip',
                ],
			]
        );

        $this->add_control(
			'back_background_color',
			[
				'label' => __( 'Back Background Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-skin-flip-back' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'member_alternative_photo' => '',
				],
			]
		);
        
        $this->add_responsive_control(
			'skin_flip_height',
			[
				'label' => __( 'Height', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'size_units' => [ 'px', 'vh' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-member.bdt-member-skin-flip' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'flip_border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-skin-flip-layer, {{WRAPPER}} .bdt-skin-flip-layer-overlay' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
        );

        $this->add_responsive_control(
            'flip_desc_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-skin-flip-layer-overlay' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'flip_text_align',
            [
                'label'     => esc_html__('Text Alignment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member.bdt-member-skin-flip .bdt-member-description' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'         => 'thumbnail_size',
				'label'        => esc_html__('Image Size', 'bdthemes-element-pack'),
				'exclude'      => ['custom'],
				'default'      => 'full',
				'prefix_class' => 'bdt-member--thumbnail-size-',
			]
		);

		$this->add_control(
			'flip_effect',
			[
				'label'   => __( 'Flip Effect', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'flip',
				'options' => [
					'flip'     => __( 'Flip', 'bdthemes-element-pack' ),
					'slide'    => __( 'Slide', 'bdthemes-element-pack' ),
					'push'     => __( 'Push', 'bdthemes-element-pack' ),
				],
				'prefix_class' => 'bdt-skin-flip-effect-',
			]
		);

		$this->add_control(
			'flip_direction',
			[
				'label'   => __( 'Flip Direction', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left'  => __( 'Left', 'bdthemes-element-pack' ),
					'right' => __( 'Right', 'bdthemes-element-pack' ),
					'up'    => __( 'Up', 'bdthemes-element-pack' ),
					'down'  => __( 'Down', 'bdthemes-element-pack' ),
				],
				'prefix_class' => 'bdt-skin-flip-direction-',
			]
		);

		$this->add_control(
			'flip_3d',
			[
				'label'        => __( '3D Depth', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'prefix_class' => 'bdt-skin-flip-3d-',
				'condition' => [
					'flip_effect' => 'flip',
				],
			]
		);

		$this->end_controls_section();

        $this->start_controls_section(
            'section_style_photo',
            [
                'label' => esc_html__('Photo', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_skin!' => 'bdt-flip',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_photo_style');

        $this->start_controls_tab(
            'tab_photo_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'photo_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'photo_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-member .bdt-member-photo',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'photo_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'photo_opacity',
            [
                'label'     => esc_html__('Opacity (%)', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'photo_spacing',
            [
                'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    '_skin!' => ['bdt-band'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_photo_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'photo_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'photo_hover_opacity',
            [
                'label'     => esc_html__('Opacity (%)', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 1,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-photo:hover img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'photo_hover_animation',
            [
                'label'   => esc_html__('Animation', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    ''     => 'None',
                    'up'   => 'Scale Up',
                    'down' => 'Scale Down',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_name',
            [
                'label' => esc_html__('Name', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .bdt-member .bdt-member-name',
            ]
        );

        $this->add_responsive_control(
            'name_bottom_space',
            [
                'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin!' => 'bdt-ekip',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekip_name_bottom_space',
            [
                'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member-skin-ekip:hover .bdt-member-name' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin' => 'bdt-ekip',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_role',
            [
                'label' => esc_html__('Role', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'role_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-role' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'role_bottom_space',
            [
                'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin!' => 'bdt-ekip',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekip_role_bottom_space',
            [
                'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member-skin-ekip:hover .bdt-member-role' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin' => 'bdt-ekip',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'role_typography',
                'selector' => '{{WRAPPER}} .bdt-member .bdt-member-role',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label'     => esc_html__('Text', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    '_skin' => ['', 'bdt-band', 'bdt-flip', 'bdt-partait'],
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .bdt-member .bdt-member-text',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_social_icon',
            [
                'label'     => esc_html__('Social Icon', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => ['member_social_icon' => 'yes'],
            ]
        );

        $this->add_control(
            'icon_content_background',
            [
                'label'     => esc_html__('Icons Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icons' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_content_padding',
            [
                'label'      => esc_html__('Icons Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_social_icon_style');

        $this->start_controls_tab(
            'tab_social_icon_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'band_icon_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member.bdt-member-skin-band .bdt-member-icons .bdt-member-icon:before' => 'background: {{VALUE}}',
                ],
                'condition' => [
                    '_skin' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-member .bdt-member-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'social_icons_top_border_color',
            [
                'label'     => esc_html__('Top Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icons' => 'border-top-color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'social_icon_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .bdt-member .bdt-member-icon',
                'condition'   => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'social_icon_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'social_icon_size',
            [
                'label'     => esc_html__('Icon Size', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon i'        => 'min-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-member .bdt-member-icon i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdt-member .bdt-member-icon svg'      => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'social_icon_indent',
            [
                'label'     => esc_html__('Icon Spacing', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon + .bdt-member-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'ekip_icon_vertical_space',
            [
                'label'      => esc_html__('Vertical Spacing', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => '%',
                ],
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-member-skin-ekip:hover .bdt-member-icons' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    '_skin' => 'bdt-ekip',
                ],
            ]
        );

        $this->add_control(
            'social_icon_tooltip',
            [
                'label'   => esc_html__('Tooltip', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_social_icon_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'icon_hover_background',
            [
                'label'     => esc_html__('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    '_skin!' => 'bdt-band',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon:hover i'   => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-member .bdt-member-icon:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'condition' => [
                    'social_icon_border_border!' => '',
                    '_skin!'                     => 'bdt-band',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-member .bdt-member-icon:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( !isset($settings['social_icon']) && !Icons_Manager::is_migration_allowed() ) {
            // add old default
            $settings['social_icon'] = 'fab fa-facebook-f';
        }

        ?>


        <div class="bdt-member bdt-member-skin-default bdt-transition-toggle">
            <?php

            if ( !empty($settings['photo']['url']) ) :
                $photo_hover_animation = ('' != $settings['photo_hover_animation']) ? ' bdt-transition-scale-' . $settings['photo_hover_animation'] : ''; ?>

                <div class="bdt-member-photo-wrapper bdt-image-mask">

                    <?php if (($settings['member_alternative_photo']) and (!empty($settings['alternative_photo']['url']))) : ?>
                    <div class="bdt-position-relative bdt-overflow-hidden"
                         bdt-toggle="target: > .bdt-member-photo-flip; mode: hover; animation: bdt-animation-fade; queued: true; duration: 300;">

                        <div class="bdt-member-photo-flip bdt-position-absolute bdt-position-z-index">
                            <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'alternative_photo'); ?>
                        </div>
                        <?php endif; ?>

                        <div class="bdt-member-photo">
                            <div class="<?php echo($photo_hover_animation); ?>">
                                <?php echo Group_Control_Image_Size::get_attachment_image_html($settings, 'photo'); ?>
                            </div>
                        </div>

                        <?php if (($settings['member_alternative_photo']) and (!empty($settings['alternative_photo']['url']))) : ?>
                    </div>
                <?php endif; ?>

                </div>
            <?php endif; ?>

            <div class="bdt-member-description">
                <?php if ( !empty($settings['name']) ) : ?>
                    <span class="bdt-member-name"><?php echo wp_kses($settings['name'], element_pack_allow_tags('title')); ?></span>
                <?php endif; ?>
                <?php if ( !empty($settings['role']) ) : ?>
                    <span class="bdt-member-role"><?php echo wp_kses($settings['role'], element_pack_allow_tags('title')); ?></span>
                <?php endif; ?>
                <?php if ( !empty($settings['description_text']) ) : ?>
                    <div class="bdt-member-text bdt-content-wrap"><?php echo wp_kses($settings['description_text'], element_pack_allow_tags('text')); ?></div>
                <?php endif; ?>
            </div>

            <?php if ( 'yes' == $settings['member_social_icon'] ) : ?>
                <div class="bdt-member-icons">
                    <?php
                    foreach ( $settings['social_link_list'] as $link ) :
                        $tooltip = ('yes' == $settings['social_icon_tooltip']) ? ' data-bdt-tooltip="' . $link['social_link_title'] . '"' : ''; ?>

                        <?php
                        $migrated = isset($link['__fa4_migrated']['social_share_icon']);
                        $is_new   = empty($link['social_icon']) && Icons_Manager::is_migration_allowed();
                        ?>

                        <a href="<?php echo esc_url($link['social_link']); ?>"
                           class="bdt-member-icon elementor-repeater-item-<?php echo esc_attr($link['_id']); ?>"
                           target="_blank"<?php echo wp_kses_post($tooltip); ?>>

                            <?php if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon($link['social_share_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']);
                            else : ?>
                                <i class="<?php echo esc_attr($link['social_icon']); ?>" aria-hidden="true"></i>
                            <?php endif; ?>

                        </a>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
        <?php
    }
}
