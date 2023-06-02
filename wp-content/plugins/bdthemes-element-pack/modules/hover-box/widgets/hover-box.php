<?php
namespace ElementPack\Modules\HoverBox\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use ElementPack\Utils;
use ElementPack\Modules\HoverBox\Skins;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Hover_Box extends Module_Base {

	public function get_name() {
		return 'bdt-hover-box';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Hover Box', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-hover-box';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'fancy', 'effects', 'toggle', 'accordion', 'hover', 'slideshow', 'slider', 'box', 'animated boxs' ];
	}

	public function is_reload_preview_required() {
		return false;
	}

	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return [ 'ep-hover-box' ];
        }
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/lWdF9-SV-2I';
	}

	protected function _register_skins() {
		$this->add_skin( new Skins\Skin_Envelope( $this ) );
		$this->add_skin( new Skins\Skin_Flexure( $this ) );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_tabs_item',
			[
				'label' => __( 'Hover Box Items', 'bdthemes-element-pack' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'selected_icon', 
			[
				'label'            => __( 'Icon', 'bdthemes-element-pack' ),
				'type'             => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'hover_box_title', 
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
					'hover_box_title!' => ''
				]
			]
		);	


		$repeater->add_control(
			'hover_box_sub_title', 
			[
				'label'       => __( 'Sub Title', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'hover_box_content', 
			[

				'type'       => Controls_Manager::WYSIWYG,
				'dynamic'    => [ 'active' => true ],
				'default'    => __( 'Box Content', 'bdthemes-element-pack' ),
			]
		);	

		$repeater->add_control(
			'hover_box_button', 
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
				'show_external' => false,
				'dynamic'       => [ 'active' => true ],
				'condition'     => [
					'hover_box_button!' => ''
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
			'hover_box',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   	  => __( 'Hover Box One', 'bdthemes-element-pack' ),
						'hover_box_content' 	  => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'far fa-laugh', 'library' => 'fa-regular'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-1.jpg']
					],
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   => __( 'Hover Box Two', 'bdthemes-element-pack' ),
						'hover_box_content' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'fas fa-cog', 'library' => 'fa-solid'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-2.jpg']
					],
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   => __( 'Hover Box Three', 'bdthemes-element-pack' ),
						'hover_box_content' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'fas fa-dice-d6', 'library' => 'fa-solid'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-3.jpg']
					],
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   => __( 'Hover Box Four', 'bdthemes-element-pack' ),
						'hover_box_content' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'fas fa-ring', 'library' => 'fa-solid'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-4.jpg']
					],
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   => __( 'Hover Box Five', 'bdthemes-element-pack' ),
						'hover_box_content' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'fas fa-adjust', 'library' => 'fa-solid'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-5.jpg']
					],
					[
						'hover_box_sub_title'   => __( 'This is label', 'bdthemes-element-pack' ),
						'hover_box_title'   => __( 'Hover Box Six', 'bdthemes-element-pack' ),
						'hover_box_content' => __( 'Lorem ipsum dolor sit amet consect voluptate repell endus kilo gram magni illo ea animi.', 'bdthemes-element-pack' ),
						'selected_icon'  => ['value' => 'fas fa-cog', 'library' => 'fa-solid'],
						'slide_image' => ['url' => BDTEP_ASSETS_URL . 'images/slide/item-6.jpg']
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, selected_icon, {}, "i", "panel" ) }}} {{{ hover_box_title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'         => 'thumbnail_size',
				'label'        => esc_html__( 'Image Size', 'bdthemes-element-pack' ),
				'exclude'      => [ 'custom' ],
				'default'      => 'full',
				'prefix_class' => 'bdt-hover-box--thumbnail-size-',
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
			'hover_box_min_height',
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
					'{{WRAPPER}} .bdt-hover-box' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_skin!' => 'bdt-envelope',
				]
			]
		);

		$this->add_responsive_control(
			'skin_hover_box_min_height',
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
					'{{WRAPPER}} .bdt-hover-box, {{WRAPPER}} .bdt-hover-box-item' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_skin' => 'bdt-envelope',
				]
			]
		);

		$this->add_responsive_control(
			'hover_box_width',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-box-item-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'_skin!' => 'bdt-envelope',
				]
			]
		);

		$this->add_control(
			'default_content_position',
			[
				'label'          => esc_html__( 'Content Position', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'center',
				'options' => element_pack_position(),
				'condition' => [
					'_skin!' => 'bdt-envelope',
				]
			]
		);

		$this->add_control(
			'content_gap',
			[
				'label'          => esc_html__( 'Content Gap', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'medium',
				'options'        => [
					'small' => esc_html__( 'Small', 'bdthemes-element-pack' ),
					'medium' => esc_html__( 'Medium', 'bdthemes-element-pack' ),
					'large' => esc_html__( 'Large', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'_skin!' => 'bdt-envelope',
				]
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Columns', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
			]
		);

		$this->add_control(
			'content_position',
			[
				'label'          => esc_html__( 'Position', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'bottom',
				'options'        => [
					'top' 	 => 'Top',
					'center' => 'Center',
					'bottom' => 'Bottom',
				],
				'condition' => [
					'_skin' => 'bdt-envelope',
				]
			]
		);

		$this->add_control(
			'column_gap',
			[
				'label'   => esc_html__( 'Column Gap', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'small',
				'options' => [
					'small'    => esc_html__( 'Small', 'bdthemes-element-pack' ),
					'medium'   => esc_html__( 'Medium', 'bdthemes-element-pack' ),
					'large'    => esc_html__( 'Large', 'bdthemes-element-pack' ),
					'collapse' => esc_html__( 'Collapse', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'_skin' => '',
				]
			]
		);

		$this->add_control(
            'hover_box_event',
            [
                'label'   => __('Select Event ', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'mouseover',
                'options' => [
                    'click'     => __('Click', 'bdthemes-element-pack'),
                    'mouseover' => __('Hover', 'bdthemes-element-pack'),
                ],
            ]
        );

		$this->add_responsive_control(
			'tabs_content_align',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item' => 'text-align: {{VALUE}};',
				],
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label'   => esc_html__( 'Show Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
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
			'show_content',
			[
				'label'   => esc_html__( 'Show Description', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
			]
		);

		$this->add_control(
			'show_button',
			[
				'label'   => esc_html__( 'Show Button', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
			]
		);

		$this->add_control(
			'match_height',
			[
				'label' => __( 'Item Match Height', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin!' => 'bdt-flexure',
				]
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
			'hover_box_active_item',
			[
				'label'       => __( 'Active Item', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::NUMBER,
				'default'	  => 1,
				'description' => 'Type your item number.',
			]
		);

		$this->add_control(
			'box_image_effect',
			[
				'label' => __( 'Image Effect?', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'box_image_effect_select',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'effect-1',
				'options' => [
					'effect-1'   => 'Effect 01',
					'effect-2'   => 'Effect 02',
				],
				'condition' => [
					'box_image_effect' => 'yes'
				]
			]
		); 

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_hover_box_style',
			[
				'label' => __( 'Hover Box', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'hover_box_overlay_color',
			[
				'label'     => __( 'Overlay Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box:before'  => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'hover_box_divider_size',
			[
				'label' => __( 'Divider Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-envelope .bdt-box-item-wrapper>.bdt-active:before' => 'width: {{SIZE}}{{UNIT}}; left: calc(-{{SIZE}}{{UNIT}} / 2);',
				],
				'condition' => [
					'_skin' => 'bdt-envelope'
				]
			]
		);

		$this->add_control(
			'hover_box_divider_color',
			[
				'label'     => __( 'Divider Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-envelope .bdt-box-item-wrapper>.bdt-active:before'  => 'background: {{VALUE}};',
				],
				'condition' => [
					'_skin' => 'bdt-envelope'
				]
			]
		);

		$this->add_control(
			'box_item_heading',
			[
				'label'      => __( 'Item', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::HEADING,
				'separator'  => 'before',
			]
		);

		$this->start_controls_tabs( 'box_item_style' );

		$this->start_controls_tab(
			'box_item_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_item_background',
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item',
			]
		);

		$this->add_responsive_control(
			'box_item_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-default .bdt-hover-box-item, {{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-envelope .bdt-hover-box-item .bdt-hover-box-description, {{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-flexure .bdt-hover-box-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'box_item_border',
				'selector'    => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item',
			]
		);

		$this->add_control(
			'box_item_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'condition' => [
					'box_item_radius_advanced_show!' => 'yes',
				],
			]
		);

		$this->add_control(
			'box_item_radius_advanced_show',
			[
				'label' => __( 'Advanced Radius', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'box_item_radius_advanced',
			[
				'label'       => esc_html__('Radius', 'bdthemes-element-pack'),
				'description' => sprintf(__('For example: <b>%1s</b> or Go <a href="%2s" target="_blank">this link</a> and copy and paste the radius value.', 'bdthemes-element-pack'), '75% 25% 43% 57% / 46% 29% 71% 54%', 'https://9elements.github.io/fancy-border-radius/'),
				'type'        => Controls_Manager::TEXT,
				'size_units'  => [ 'px', '%' ],
				'default'     => '75% 25% 43% 57% / 46% 29% 71% 54%',
				'selectors'   => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item'     => 'border-radius: {{VALUE}}; overflow: hidden;',
				],
				'condition' => [
					'box_item_radius_advanced_show' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_item_shadow',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_item_hover',
			[
				'label' => __( 'hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_item_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover',
			]
		);

		$this->add_control(
			'box_item_hover_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'box_item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_item_hover_shadow',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'box_item_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'box_item_active_background',
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active',
			]
		);

		$this->add_control(
			'box_item_active_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'box_item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_item_active_shadow',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_icon_box',
			[
				'label'      => __( 'Icon', 'bdthemes-element-pack' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'condition'  => [
					'show_icon' => 'yes',
					'_skin!' => 'bdt-flexure',
				]
			]
		);

		$this->start_controls_tabs( 'icon_colors' );

		$this->start_controls_tab(
			'icon_colors_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Icon Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-icon-wrapper' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box .bdt-icon-wrapper svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'vh', 'vw' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-icon-wrapper' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rotate',
			[
				'label'   => __( 'Rotate', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => __( 'Icon Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-icon-wrapper' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-icon-wrapper svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_rotate',
			[
				'label'   => __( 'Rotate', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'deg',
					'size' => 90
				],
				'range' => [
					'deg' => [
						'max'  => 360,
						'min'  => -360,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-icon-wrapper i'   => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label'     => __( 'Icon Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-icon-wrapper' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-icon-wrapper svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

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
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-title, {{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-title a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-title, {{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-title, {{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-title a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-title, {{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-title a',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-flexure .bdt-hover-box-item .bdt-hover-box-sub-title:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-flexure .bdt-hover-box-item:hover .bdt-hover-box-sub-title:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-sub-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-flexure .bdt-hover-box-item.active .bdt-hover-box-sub-title:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .bdt-hover-box.bdt-hover-box-skin-flexure .bdt-hover-box-item .bdt-hover-box-sub-title' => 'margin-left: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label'     => esc_html__( 'Description', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_content' => [ 'yes' ],
					'_skin!' => 'bdt-flexure',
				],
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'description_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-text' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-text',
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
					'_skin!' => 'bdt-flexure',
				],
			]
		);

		$this->start_controls_tabs( 'hover_box_button_style' );

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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_background',
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'selector'    => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a'     => 'border-radius: {{VALUE}}; overflow: hidden;',
				],
				'condition' => [
					'border_radius_advanced_show' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button a',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-button a'  => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'button_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-button a',
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
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item:hover .bdt-hover-box-button a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_active',
			[
				'label' => __( 'Active', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'button_active_color',
			[
				'label'     => __( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_active_background_color',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-button a' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_active_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item.active .bdt-hover-box-button a' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'button_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .bdt-hover-box .bdt-hover-box-item .bdt-hover-box-button' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

	}

	public function activeItem($active_item, $totalItem){
		 $active_item = (int) $active_item; 
		 return $active_item = ($active_item <= 0 || $active_item > $totalItem ? 1 : $active_item);
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ($settings['hover_box_event']) {
			$hoverBoxEvent = $settings['hover_box_event'];
		} else {
			$hoverBoxEvent = false;
		}

		if ( 'yes' == $settings['box_image_effect'] and 'effect-1' == $settings['box_image_effect_select'] ) {
			$this->add_render_attribute( 'hover_box', 'class', 'bdt-hover-box-image-effect bdt-image-effect-1' );
		} elseif ( 'yes' == $settings['box_image_effect'] and 'effect-2' == $settings['box_image_effect_select'] ) {
			$this->add_render_attribute( 'hover_box', 'class', 'bdt-hover-box-image-effect bdt-image-effect-2' );
		}

		$this->add_render_attribute(
			[
				'hover_box' => [
					'id' => 'bdt-hover-box-' . $this->get_id(),
					'class' => 'bdt-hover-box bdt-hover-box-default',
					'data-settings' => [
						wp_json_encode(array_filter([
							'box_id' => 'bdt-hover-box-' . $this->get_id(),
							'mouse_event' => $hoverBoxEvent,
						]))
					]
				]
			]
		);

		?>
		<div <?php echo $this->get_render_attribute_string( 'hover_box' ); ?>>

			<?php $this->box_content(); ?>
			<?php $this->box_items(); ?>
			
		</div>

		<?php
	}

	public function box_content() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();

		?>

			<?php foreach ( $settings['hover_box'] as $index => $item ) : 
				$tab_count = $index + 1;
				$tab_id    = 'bdt-box-'. $tab_count . esc_attr($id);

                $slide_image = Group_Control_Image_Size::get_attachment_image_src( $item['slide_image']['id'], 'thumbnail_size', $settings);
                if ( ! $slide_image ) {
                    $slide_image = $item['slide_image']['url'];
                }
				if( $settings['_skin'] == 'bdt-flexure' ){
					$this->add_render_attribute( 'hover-box-content', 'class', 'bdt-hover-box-content', true );
				}else{
					$active_item = $this->activeItem($settings['hover_box_active_item'], count($settings['hover_box']));

					if ($tab_id    == 'bdt-box-'. $active_item . esc_attr($id)) {
						$this->add_render_attribute( 'hover-box-content', 'class', 'bdt-hover-box-content active', true );
					} else {
						$this->add_render_attribute( 'hover-box-content', 'class', 'bdt-hover-box-content', true );
					}
				}

				?>

				<div id="<?php echo esc_attr($tab_id); ?>" <?php echo ( $this->get_render_attribute_string( 'hover-box-content' ) ); ?>>
					
					<?php if ($item['slide_image']) : ?>
						<div class="bdt-hover-box-image" style="background-image: url('<?php echo esc_url( $slide_image); ?>');"></div>
					<?php endif; ?>

				</div>
			<?php endforeach; ?>

		<?php 
	}
 
	public function box_items() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();

		$desktop_cols = isset($settings["columns"]) ? (int)$settings["columns"] : 3;
		$tablet_cols  = isset($settings["columns_tablet"]) ? (int)$settings["columns_tablet"] : 2;
		$mobile_cols  = isset($settings["columns_mobile"]) ? (int)$settings["columns_mobile"] : 2;

		if ( 'yes' == $settings['match_height'] ) {
			$this->add_render_attribute( 'box-settings', 'bdt-height-match', 'target: > div > div > .bdt-hover-box-item; row: false;' );
		}

        $this->add_render_attribute( 'box-settings', 'data-bdt-hover-box-items', 'connect: #bdt-box-content-' .  esc_attr($id) . ';' );
        $this->add_render_attribute( 'box-settings', 'class', ['bdt-box-item-wrapper', 'bdt-position-' . $settings['content_gap'], 'bdt-position-' . $settings['default_content_position']] );
 

		?>
			<div <?php echo ( $this->get_render_attribute_string( 'box-settings' ) ); ?>>
				<div class="bdt-grid bdt-grid-<?php echo esc_attr($settings['column_gap']); ?> bdt-child-width-1-<?php echo esc_attr($mobile_cols); ?> bdt-child-width-1-<?php echo esc_attr($tablet_cols); ?>@s bdt-child-width-1-<?php echo esc_attr($desktop_cols); ?>@l" data-bdt-grid>
 
					<?php  foreach ( $settings['hover_box'] as $index => $item ) :
						
						$tab_count = $index + 1;
						$tab_id    = 'bdt-box-'. $tab_count . esc_attr($id);
 

						$active_item = $this->activeItem($settings['hover_box_active_item'], count($settings['hover_box']));

						if ($tab_id    == 'bdt-box-'. $active_item . esc_attr($id)) {
							$this->add_render_attribute( 'box-item', 'class', 'bdt-hover-box-item active', true );
						} else {
							$this->add_render_attribute( 'box-item', 'class', 'bdt-hover-box-item', true );
						}
						
						$this->add_render_attribute( 'bdt-hover-box-title', 'class', 'bdt-hover-box-title', true );
					
						$this->add_render_attribute(
							[
								'title-link' => [
									'class' => [
										'bdt-hover-box-title-link',
									],
									'href'   => $item['title_link']['url'] ? esc_url($item['title_link']['url']) : 'javascript:void(0);',
									'target' => $item['title_link']['is_external'] ? '_blank' : '_self'
								]
							], '', '', true
						);
 
						$this->add_render_attribute(
							[
								'button-link' => [
									'class' => [
										'bdt-hover-box-title',
									],
									'href'   => $item['button_link']['url'] ? esc_url($item['button_link']['url']) : 'javascript:void(0);',
									'target' => $item['button_link']['is_external'] ? '_blank' : '_self'
								]
							], '', '', true
						);
						
						?>
						<div>
							<div <?php echo ( $this->get_render_attribute_string( 'box-item' ) ); ?> data-id="<?php echo esc_attr($tab_id); ?>">

								<?php if ( 'yes' == $settings['show_icon'] ) : ?>
								<a class="bdt-hover-box-icon-box" href="javascript:void(0);" data-tab-index="<?php echo esc_attr($index); ?>" >
									<span class="bdt-icon-wrapper">
										<?php Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
								</a>
								<?php endif; ?>

								<?php if ( $item['hover_box_sub_title'] && ( 'yes' == $settings['show_sub_title'] ) ) : ?>
									<div class="bdt-hover-box-sub-title">
										<?php echo wp_kses( $item['hover_box_sub_title'], element_pack_allow_tags('title') ); ?>
									</div>
								<?php endif; ?>

								<?php if ( $item['hover_box_title'] && ( 'yes' == $settings['show_title'] ) ) : ?>
									<<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('bdt-hover-box-title'); ?>>
										
											<?php if ( '' !== $item['title_link']['url'] ) : ?>
												<a <?php echo $this->get_render_attribute_string( 'title-link' ); ?>>
											<?php endif; ?>
												<?php echo wp_kses( $item['hover_box_title'], element_pack_allow_tags('title') ); ?>
											<?php if ( '' !== $item['title_link']['url'] ) : ?>
												</a>
											<?php endif; ?>
										
									</<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?>>
								<?php endif; ?>

								<?php if ( $item['hover_box_content'] && ( 'yes' == $settings['show_content'] ) ) : ?>
									<div class="bdt-hover-box-text">
										<?php echo $this->parse_text_editor( $item['hover_box_content'] ); ?>
									</div>
								<?php endif; ?>

								<?php if ($item['hover_box_button'] && ( 'yes' == $settings['show_button'] )) : ?>
									<div class="bdt-hover-box-button">
										<a <?php echo $this->get_render_attribute_string( 'button-link' ); ?>>
											<?php echo wp_kses_post($item['hover_box_button']); ?>
										</a>
									</div>
								<?php endif; ?>

							</div>
						</div>
					<?php endforeach; ?>

				</div>
			</div>
		<?php
	}
	
}