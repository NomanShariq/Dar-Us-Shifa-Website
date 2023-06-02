<?php

namespace ElementPack\Modules\Search\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use ElementPack\Includes\Controls\SelectInput\Dynamic_Select;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Search extends Module_Base {

	public function get_name() {
		return 'bdt-search';
	}

	public function get_title() {
		return BDTEP . esc_html__('Search', 'bdthemes-element-pack');
	}

	public function get_icon() {
		return 'bdt-wi-search';
	}

	public function get_categories() {
		return ['element-pack'];
	}

	public function get_keywords() {
		return ['search', 'find'];
	}

	public function get_style_depends() {
		if ($this->ep_is_edit_mode()) {
			return ['ep-all-styles'];
		} else {
			return ['ep-search'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/H3F1LHc97Gk';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_search_layout',
			[
				'label' => esc_html__('Search Layout', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'skin',
			[
				'label'   => esc_html__('Skin', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__('Default', 'bdthemes-element-pack'),
					'dropbar'  => esc_html__('Dropbar', 'bdthemes-element-pack'),
					'dropdown' => esc_html__('Dropdown', 'bdthemes-element-pack'),
					'modal'    => esc_html__('Modal', 'bdthemes-element-pack'),
				],
				'prefix_class' => 'elementor-search-form-skin-',
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'search_query',
			[
				'label'       => esc_html__('Specific Post Type', 'bdthemes-element-pack'),
				'description' => esc_html__('Select post type if you need to search only this post type content.', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 0,
				'options'     => element_pack_get_post_types(),
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label'     => esc_html__('Placeholder', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => ['active' => true],
				'separator' => 'before',
				'default'   => esc_html__('Search', 'bdthemes-element-pack') . '...',
			]
		);

		$this->add_control(
			'search_icon',
			[
				'label'   => esc_html__('Search Icon', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'search_icon_flip',
			[
				'label'     => esc_html__('Icon Flip', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'search_icon' => 'yes',
					'search_button' => '',
				],
			]
		);

		$this->add_control(
			'search_toggle_icon',
			[
				'label'       => esc_html__('Choose Toggle Icon', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::ICONS,
				'fa4compatibility' => 'toggle_icon',
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'fa-solid',
				],
				'condition'   => ['skin!' => 'default'],
			]
		);

		$this->add_responsive_control(
			'search_align',
			[
				'label'   => esc_html__('Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-element-pack'),
						'icon'  => 'fas fa-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-element-pack'),
						'icon'  => 'fas fa-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-element-pack'),
						'icon'  => 'fas fa-align-right',
					],
				],
				// 'prefix_class' => 'elementor-align%s-',
				'selectors' => [
					'{{WRAPPER}}.elementor-widget-bdt-search' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropbar_position',
			[
				'label'   => esc_html__('Dropbar Position', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'bottom-left'    => esc_html('Bottom Left', 'bdthemes-element-pack'),
					'bottom-center'  => esc_html('Bottom Center', 'bdthemes-element-pack'),
					'bottom-right'   => esc_html('Bottom Right', 'bdthemes-element-pack'),
					'bottom-justify' => esc_html('Bottom Justify', 'bdthemes-element-pack'),
					'top-left'       => esc_html('Top Left', 'bdthemes-element-pack'),
					'top-center'     => esc_html('Top Center', 'bdthemes-element-pack'),
					'top-right'      => esc_html('Top Right', 'bdthemes-element-pack'),
					'top-justify'    => esc_html('Top Justify', 'bdthemes-element-pack'),
					'left-top'       => esc_html('Left Top', 'bdthemes-element-pack'),
					'left-center'    => esc_html('Left Center', 'bdthemes-element-pack'),
					'left-bottom'    => esc_html('Left Bottom', 'bdthemes-element-pack'),
					'right-top'      => esc_html('Right Top', 'bdthemes-element-pack'),
					'right-center'   => esc_html('Right Center', 'bdthemes-element-pack'),
					'right-bottom'   => esc_html('Right Bottom', 'bdthemes-element-pack'),
				],
				'condition' => [
					'skin' => ['dropbar', 'dropdown']
				],
			]
		);

		$this->add_control(
			'dropbar_offset',
			[
				'label' => esc_html__('Dropbar Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'size' => 0,
				],
				'condition' => [
					'skin' => ['dropbar', 'dropdown']
				],
			]
		);

		$this->add_responsive_control(
			'search_width',
			[
				'label' => esc_html__('Search Width', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-search-container .bdt-search-default,
					 {{WRAPPER}} .bdt-search-container .bdt-navbar-dropdown,
					 {{WRAPPER}} .bdt-search-container .bdt-drop' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'skin!' => ['modal']
				],
			]
		);
		$this->add_control(
			'show_ajax_search',
			[
				'label'   => esc_html__('Ajax Search', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'skin' => ['default']
				],
				'separator' => 'before'
			]
		);
		$this->add_control(
			'anchor_target',
			[
				'label'        => esc_html__('Link open in new window', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'condition' => [
					'skin'             => 'default',
					'show_ajax_search' => 'yes',
				],
			]
		);
		$this->add_control(
			'search_button',
			[
				'label'   => esc_html__('Search Button', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'skin' => 'default',
					'show_ajax_search' => '',
					'search_icon_flip' => '',
				],
			]
		);
		$this->add_control(
			'button_text',
			[
				'label'     => esc_html__('Button Text', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => ['active' => true],
				'default'   => esc_html__('Submit', 'bdthemes-element-pack'),
				'condition' => [
					'search_button' => 'yes',
					'show_ajax_search' => '',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'            => __('Icon', 'bdthemes-element-pack'),
				'type'             => Controls_Manager::ICONS,
				'render_type'      => 'template',
				'condition'        => [
					'search_button' => 'yes',
					'show_ajax_search' => '',
				]
			]
		);

		$this->add_responsive_control(
			'button_position',
			[
				'label' => esc_html__('Button Position', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-button' => 'right: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'search_button' => 'yes',
					'show_ajax_search' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__('Icon Spacing', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-button i, {{WRAPPER}} .bdt-search .bdt-search-button svg' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'search_button' => 'yes',
					'show_ajax_search' => '',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'ajax_search_query',
			[
				'label' => esc_html__('Ajax Query', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);
		$this->add_control(
			'ajax_item_limit',
			[
				'label'     => esc_html__('Item Limit', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);
		$this->start_controls_tabs(
			'tabs_posts_include_exclude',
			[
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);

		$this->start_controls_tab(
			'tab_posts_include',
			[
				'label'     => __('Include', 'ultimate-post-kit-pro'),
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);

		$this->add_control(
			'posts_include_by',
			[
				'label'       => __('Include By', 'ultimate-post-kit-pro'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'authors' => __('Authors', 'ultimate-post-kit-pro'),
					'terms'   => __('Terms', 'ultimate-post-kit-pro'),
				],
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);

		$this->add_control(
			'posts_include_author_ids',
			[
				'label'       => __('Authors', 'ultimate-post-kit-pro'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query' => 'authors',
				],
				'condition'   => [
					'posts_include_by' => 'authors',
					'show_ajax_search' => 'yes',
				]
			]
		);

		$this->add_control(
			'posts_include_term_ids',
			[
				'label'       => __('Terms', 'ultimate-post-kit-pro'),
				'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'ultimate-post-kit-pro'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => __('Type and select terms', 'ultimate-post-kit-pro'),
				'query_args'  => [
					'query'        => 'terms',
					'widget_props' => [
						'post_type' => 'search_query'
					]
				],
				'condition'   => [
					'posts_include_by' => 'terms',
					'show_ajax_search' => 'yes',
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_posts_exclude',
			[
				'label'     => __('Exclude', 'ultimate-post-kit-pro'),
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);

		$this->add_control(
			'posts_exclude_by',
			[
				'label'       => __('Exclude By', 'ultimate-post-kit-pro'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'authors'          => __('Authors', 'ultimate-post-kit-pro'),
					'current_post'     => __('Current Post', 'ultimate-post-kit-pro'),
					'manual_selection' => __('Manual Selection', 'ultimate-post-kit-pro'),
					'terms'            => __('Terms', 'ultimate-post-kit-pro'),
				],
				'condition' => [
					'show_ajax_search' => 'yes'
				]
			]
		);

		$this->add_control(
			'posts_exclude_ids',
			[
				'label'       => __('Search & Select', 'ultimate-post-kit-pro'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query'        => 'posts',
					'widget_props' => [
						'post_type' => 'search_query'
					]
				],
				'condition'   => [
					'show_ajax_search' => 'yes',
					'posts_exclude_by' => 'manual_selection',
				]
			]
		);

		$this->add_control(
			'posts_exclude_author_ids',
			[
				'label'       => __('Authors', 'ultimate-post-kit-pro'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query' => 'authors',
				],
				'condition'   => [
					'posts_exclude_by' => 'authors',
					'show_ajax_search' => 'yes',
				]
			]
		);

		$this->add_control(
			'posts_exclude_term_ids',
			[
				'label'       => __('Terms', 'ultimate-post-kit-pro'),
				'description' => __('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'ultimate-post-kit-pro'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => __('Type and select terms', 'ultimate-post-kit-pro'),
				'query_args'  => [
					'query'        => 'terms',
					'widget_props' => [
						'post_type' => 'search_query'
					]
				],
				'condition'   => [
					'posts_exclude_by' => 'terms',
					'show_ajax_search!' => 'yes',
				]
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_toggle_icon',
			[
				'label'     => esc_html__('Toggle Icon', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'skin!' => 'default'
				]
			]
		);

		$this->add_control(
			'toggle_icon_size',
			[
				'label'     => esc_html__('Size', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'toggle_icon_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-toggle' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-search-toggle svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'toggle_icon_background',
			[
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-toggle' => 'background-color: {{VALUE}};'
				]
			]
		);

		$this->add_responsive_control(
			'toggle_icon_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search-toggle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'toggle_icon_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-search-toggle'
			]
		);

		$this->add_control(
			'toggle_icon_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search-toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'toggle_icon_shadow',
				'selector' => '{{WRAPPER}} .bdt-search-toggle'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_layout_style',
			[
				'label' => esc_html__('Search Container', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'search_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-navbar-dropdown-close.bdt-icon.bdt-close svg' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin!' => 'default',
				],
			]
		);

		$this->add_control(
			'search_container_background',
			[
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-container .bdt-search:not(.bdt-search-navbar),
					 {{WRAPPER}} .bdt-search-container .bdt-navbar-dropdown,
					 {{WRAPPER}} .bdt-search-container .bdt-drop' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_container_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search-container .bdt-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_container_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search-container .bdt-search:not(.bdt-search-navbar),
					 {{WRAPPER}} .bdt-search-container .bdt-navbar-dropdown,
					 {{WRAPPER}} .bdt-search-container .bdt-drop' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'search_container_shadow',
				'selector' => '{{WRAPPER}} .bdt-search-container .bdt-search:not(.bdt-search-navbar),
							   {{WRAPPER}} .bdt-search-container .bdt-navbar-dropdown,
					           {{WRAPPER}} .bdt-search-container .bdt-drop',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_style',
			[
				'label' => esc_html__('Input', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'input_typography',
				'selector' => '{{WRAPPER}} .bdt-search-input, #modal-search-{{ID}} .bdt-search-input',
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_control(
			'search_icon_size',
			[
				'label'     => esc_html__('Icon Size', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition' => [
					'skin' => 'default'
				]
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__('Icon Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-icon svg' => 'color: {{VALUE}};',
				],
				'condition' => [
					'skin' => 'default'
				]
			]
		);

		$this->add_control(
			'modal_search_icon_size',
			[
				'label'     => esc_html__('Icon Size', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'#modal-search-{{ID}} .bdt-search-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
				'condition' => [
					'skin' => 'modal'
				]
			]
		);

		$this->start_controls_tabs('tabs_input_colors');

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'input_text_color',
			[
				'label'  => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'   => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input,
					 #modal-search-{{ID}} .bdt-search-icon svg' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_control(
			'input_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-container .bdt-search .bdt-search-input' => 'background-color: {{VALUE}}',
					'#modal-search-{{ID}} .bdt-search-container .bdt-search .bdt-search-input' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin!' => 'modal',
				],
			]
		);

		$this->add_control(
			'input_placeholder_color',
			[
				'label'     => esc_html__('Placeholder Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input::placeholder' => 'color: {{VALUE}}',
					'#modal-search-{{ID}} .bdt-search-input::placeholder' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input' => 'border-color: {{VALUE}}',
					'#modal-search-{{ID}} .bdt-search-input' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'button_border_width',
			[
				'label'     => esc_html__('Border Size', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#modal-search-{{ID}} .bdt-search-input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'default' => [
					'size' => 3,
					'unit' => 'px',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input' => 'border-radius: {{SIZE}}{{UNIT}}',
					'#modal-search-{{ID}} .bdt-search-input' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'input_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'#modal-search-{{ID}} .bdt-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'input_shadow',
				'selector'       => '{{WRAPPER}} .bdt-search-input',
				'fields_options' => [
					'shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition' => [
					'skin!' => 'modal',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => esc_html__('Focus', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'input_text_color_focus',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input:focus' => 'color: {{VALUE}}',
					'#modal-search-{{ID}} .bdt-search-input:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'input_background_color_focus',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-container .bdt-search .bdt-search-input:focus' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'skin!' => 'modal',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-input:focus' => 'border-color: {{VALUE}}',
					'#modal-search-{{ID}} .bdt-search-input:focus' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'input_shadow_focus',
				'selector'       => '{{WRAPPER}} .bdt-search-input:focus',
				'fields_options' => [
					'shadow_type' => [
						'separator' => 'default',
					],
				],
				'condition' => [
					'skin!' => 'modal',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_search_ajax_style',
			[
				'label' => esc_html__('Ajax Search Dropdown', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'and',
					'terms'    => [
						[
							'name'  => 'skin',
							'value' => 'default',
						],
						[
							'name'  => 'show_ajax_search',
							'value' => 'yes',
						],
					],
				],
			]
		);


		$this->add_control(
			'search_ajax_background_color',
			[
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-results-wrap, {{WRAPPER}} .bdt-search-results-wrap:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'search_ajax_shadow',
				'selector'       => '{{WRAPPER}} .bdt-search-result',
			]
		);
		$this->add_control(
			'search_ajax_loader_background_color',
			[
				'label'     => esc_html__('Search Loader Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search.bdt-search-loading:after' => 'background-color: {{VALUE}};',
				],
				// 'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'tabs_ajax_search_style'
		);
		$this->start_controls_tab(
			'tab_ajax_heading',
			[
				'label' => esc_html__('Heading', 'bdtheme-element-pack'),
			]
		);
		$this->add_control(
			'search_ajax_heading_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-results-head-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ajax_heading_typography',
				'selector' => '{{WRAPPER}} .bdt-search-results-head-title a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ajax_title',
			[
				'label' => esc_html__('Title', 'bdtheme-element-pack'),
			]
		);
		$this->add_control(
			'search_ajax_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-result .bdt-doc-article a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'search_ajax_title_background',
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .bdt-search-result .bdt-doc-article a',
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ajax_title_typography',
				'selector' => '{{WRAPPER}} .bdt-search-result .bdt-doc-article a',
			]
		);
		$this->add_control(
			'heading_search_ajax_title',
			[
				'label'     => esc_html__('H O V E R', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'search_ajax_title_h_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-result .bdt-doc-article a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'search_ajax_title_h_background',
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'types'     => ['classic', 'gradient'],
				'selector'  => '{{WRAPPER}} .bdt-search-result .bdt-doc-article a:hover',
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_ajax_category',
			[
				'label' => esc_html__('Category', 'bdtheme-element-pack'),
			]
		);
		$this->add_control(
			'search_ajax_category_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-result .bdt-doc-section a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'search_ajax_category_h_color',
			[
				'label'     => esc_html__('Hover Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search-result .bdt-doc-section a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'ajax_category_typography',
				'selector' => '{{WRAPPER}} .bdt-search-result .bdt-doc-section a',
			]
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_ajax_no_posts',
			[
				'label' => esc_html__('No Posts', 'bdtheme-element-pack'),
			]
		);
		$this->add_control(
			'ajax_empty_content',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-empty' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'ajax_no_posts_typography',
				'label'     => esc_html__('Typography', 'bdthemes-element-pack'),
				'selector'  => '{{WRAPPER}} .bdt-search .bdt-empty',
			]
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_search_button',
			[
				'label'     => __('Search Button', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'search_button'       => 'yes',
					'show_ajax_search!'    => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_search_button_style');

		$this->start_controls_tab(
			'tab_search_button_normal',
			[
				'label' => __('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'search_button_text_color',
			[
				'label'     => __('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-button' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-search .bdt-search-button svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'search_button_background',
				'selector'  => '{{WRAPPER}} .bdt-search .bdt-search-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'search_button_border',
				'selector'    => '{{WRAPPER}} .bdt-search .bdt-search-button'
			]
		);

		$this->add_responsive_control(
			'search_button_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search .bdt-search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'search_button_shadow',
				'selector' => '{{WRAPPER}} .bdt-search .bdt-search-button',
			]
		);

		$this->add_responsive_control(
			'search_button_padding',
			[
				'label'      => __('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-search .bdt-search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'search_button_typography',
				'selector' => '{{WRAPPER}} .bdt-search .bdt-search-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_search_button_hover',
			[
				'label' => __('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'search_button_hover_text_color',
			[
				'label'     => __('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-button:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-search .bdt-search-button:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'search_button_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-search .bdt-search-button:hover',
			]
		);

		$this->add_control(
			'search_button_hover_border_color',
			[
				'label'     => __('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-search .bdt-search-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'search_button_border_border!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'search_button_hover_shadow',
				'selector' => '{{WRAPPER}} .bdt-search .bdt-search-button:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function render() {
		$settings    = $this->get_settings_for_display();
		$current_url = remove_query_arg('fake_arg');
		$id          = $this->get_id();

?>
		<div class="bdt-search-container">
			<?php $this->search_form($settings); ?>
		</div>
		<?php
	}

	public function search_form($settings) {
		$current_url = remove_query_arg('fake_arg');
		$id          = $this->get_id();

		$search            = [];
		$attrs['class']    = array_merge(['bdt-search'], isset($attrs['class']) ? (array) $attrs['class'] : []);
		$search['class']   = [];
		$search['class'][] = 'bdt-search-input';

		$this->add_render_attribute(
			'input',
			[
				'placeholder' => $settings['placeholder'],
				'class'       => 'bdt-search-input',
				'type'        => 'search',
				'name'        => 's',
				'title'       => esc_html__('Search', 'bdthemes-element-pack'),
				'value'       => get_search_query(),
			]
		);

		$this->add_render_attribute('search', 'class', 'bdt-search');
		$this->add_render_attribute('search', 'role', 'search');
		$this->add_render_attribute('search', 'method', 'get');
		$this->add_render_attribute('search', 'action', esc_url(home_url('/')));

		if ($settings['show_ajax_search']) {
			$this->add_render_attribute('search', [
				'class' => 'bdt-ajax-search',
				'anchor-target' => [
					$settings['anchor_target']
				],
				'autocomplete' => [
					'off'
				],
				'data-settings' => [
					wp_json_encode(array_filter([
						'post_type'          => $settings['search_query'],
						'per_page'           => $settings['ajax_item_limit'],
						'include_by'         => $settings['posts_include_by'],
						'exclude_by'         => $settings['posts_exclude_by'],
						'include_author_ids' => $settings['posts_include_author_ids'],
						'exclude_author_ids' => $settings['posts_exclude_author_ids'],
						'include_term_ids'   => $settings['posts_include_term_ids'],
						'exclude_term_ids'   => $settings['posts_exclude_term_ids'],
						'exclude_ids'        => $settings['posts_exclude_ids'],
					])),
				],
			]);
		}

		if ('default' === $settings['skin']) : ?>

			<?php $this->add_render_attribute('search', 'class', 'bdt-search-default'); ?>

			<form <?php echo $this->get_render_attribute_string('search'); ?>>
				<div class="bdt-position-relative">
					<?php $this->search_icon($settings); ?>
					<?php if ($settings['search_query']) : ?>
						<input name="post_type" id="post_type" type="hidden" value="<?php echo $settings['search_query']; ?>">
					<?php endif; ?>
					<input <?php echo $this->get_render_attribute_string('input'); ?>>
					<?php $this->search_button(); ?>
				</div>


				<?php if ($settings['show_ajax_search']) : ?>
					<div class="bdt-search-result"></div>
				<?php endif; ?>
			</form>

		<?php elseif ('dropbar' === $settings['skin']) :

			$this->add_render_attribute(
				[
					'dropbar' => [
						'bdt-drop' => [
							wp_json_encode(array_filter([
								"mode"           => "click",
								"boundary"       => false,
								"pos"            => ($settings["dropbar_position"]) ? $settings["dropbar_position"] : "left-center",
								"flip"           => "x",
								"offset"         => $settings["dropbar_offset"]["size"],
							]))
						],
						'class' => 'bdt-drop',
					]
				]
			);

			$this->add_render_attribute('search', 'class', 'bdt-search-navbar bdt-width-1-1');

		?>

			<?php $this->render_toggle_icon($settings); ?>
			<div <?php echo $this->get_render_attribute_string('dropbar'); ?>>
				<form <?php echo $this->get_render_attribute_string('search'); ?>>
					<div class="bdt-position-relative">
						<?php $this->add_render_attribute('input', 'class', 'bdt-padding-small'); ?>
						<?php if ($settings['search_query']) : ?>
							<input name="post_type" id="post_type" type="hidden" value="<?php echo $settings['search_query']; ?>">
						<?php endif; ?>
						<input <?php echo $this->get_render_attribute_string('input'); ?> autofocus>
					</div>

				</form>
			</div>

		<?php elseif ('dropdown' === $settings['skin']) :

			$this->add_render_attribute(
				[
					'dropdown' => [
						'bdt-drop' => [
							wp_json_encode(array_filter([
								"mode"     => "click",
								"boundary" => false,
								"pos"      => ($settings["dropbar_position"]) ? $settings["dropbar_position"] : "bottom-right",
								"flip"     => "x",
								"offset"   => $settings["dropbar_offset"]["size"],
							]))
						],
						'class' => 'bdt-navbar-dropdown',
					]
				]
			);
			$this->add_render_attribute('search', 'class', 'bdt-search-navbar bdt-width-1-1');
		?>
			<?php $this->render_toggle_icon($settings); ?>

			<div <?php echo $this->get_render_attribute_string('dropdown'); ?>>

				<div class="bdt-grid-small bdt-flex-middle" bdt-grid>
					<div class="bdt-width-expand">
						<form <?php echo $this->get_render_attribute_string('search'); ?>>
							<div class="bdt-position-relative">
								<?php $this->add_render_attribute('input', 'class', 'bdt-padding-small'); ?>
								<?php if ($settings['search_query']) : ?>
									<input name="post_type" id="post_type" type="hidden" value="<?php echo $settings['search_query']; ?>">
								<?php endif; ?>
								<input <?php echo $this->get_render_attribute_string('input'); ?> autofocus>
							</div>
						</form>
					</div>
					<div class="bdt-width-auto">
						<a class="bdt-navbar-dropdown-close" href="#" bdt-close></a>
					</div>
				</div>

			</div>

		<?php elseif ('modal' === $settings['skin']) :


			$this->add_render_attribute('search', 'class', 'bdt-search-large');
		?>

			<?php $this->render_toggle_icon($settings); ?>

			<div id="modal-search-<?php echo esc_attr($id); ?>" class="bdt-modal-full bdt-modal" bdt-modal>
				<div class="bdt-modal-dialog bdt-flex bdt-flex-center bdt-flex-middle" bdt-height-viewport>
					<button class="bdt-modal-close-full" type="button" bdt-close></button>
					<form <?php echo $this->get_render_attribute_string('search'); ?>>
						<div class="bdt-position-relative">
							<?php $this->add_render_attribute('input', ['class' => 'bdt-text-center']); ?>
							<?php $this->search_icon($settings); ?>
							<?php if ($settings['search_query']) : ?>
								<input name="post_type" id="post_type" type="hidden" value="<?php echo $settings['search_query']; ?>">
							<?php endif; ?>
							<input <?php echo $this->get_render_attribute_string('input'); ?> autofocus>
						</div>

					</form>
				</div>
			</div>
		<?php endif;
	}

	private function search_icon($settings) {
		$icon_class = ($settings['search_icon_flip']) ? 'bdt-search-icon-flip' : '';

		if ($settings['search_icon']) :
			echo '<span class="' . esc_attr($icon_class) . '" data-bdt-search-icon></span>';
		endif;
	}

	private function search_button() {
		$settings = $this->get_settings_for_display();

		if (!$this->get_settings('search_button')) {
			return;
		}

		?>

		<?php if ('' == $settings['show_ajax_search']) : ?>
			<button type="submit" class="bdt-search-button">
				<?php echo esc_html($settings['button_text']); ?>
				<?php Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']); ?>
			</button>
		<?php endif; ?>

	<?php
	}

	private function render_toggle_icon($settings) {
		$id                = $this->get_id();

		$this->add_render_attribute('toggle-icon', 'class', 'bdt-search-toggle');

		if ('modal' === $settings['skin']) {
			$this->add_render_attribute('toggle-icon', 'bdt-toggle');
			$this->add_render_attribute('toggle-icon', 'href', '#modal-search-' . esc_attr($id));
		} else {
			$this->add_render_attribute('toggle-icon', 'href', '#');
		}

		if (!isset($settings['toggle_icon']) && !Icons_Manager::is_migration_allowed()) {
			// add old default
			$settings['toggle_icon'] = 'fas fa-search';
		}

		$migrated  = isset($settings['__fa4_migrated']['search_toggle_icon']);
		$is_new    = empty($settings['toggle_icon']) && Icons_Manager::is_migration_allowed();

	?>

		<a <?php echo $this->get_render_attribute_string('toggle-icon'); ?>>

			<?php if ($is_new || $migrated) :
				Icons_Manager::render_icon($settings['search_toggle_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']);
			else : ?>
				<i class="<?php echo esc_attr($settings['toggle_icon']); ?>" aria-hidden="true"></i>
			<?php endif; ?>

		</a>
<?php

	}
}
