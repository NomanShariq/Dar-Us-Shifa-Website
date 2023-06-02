<?php
namespace ElementPack\Modules\Woocommerce\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Products_Tab extends Module_Base {

	public function get_name() {
		return 'bdt-wc-products-tab';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'WC - Products Tab', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-woocommerce';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'product', 'woocommerce', 'table', 'tab', 'wc' ];
	}

	public function get_script_depends() {
      return [ 'datatables' ];
    }

	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return [ 'ep-woocommerce', 'datatables' ];
        }
    }

	// public function get_custom_help_url() {
	// 	return 'https://youtu.be/3VkvEpVaNAM';
	// }

	protected function _register_controls() {

		$this->start_controls_section(
			'section_woocommerce_layout',
			[
				'label' => esc_html__( 'Layout', 'bdthemes-element-pack' ),
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__( 'Columns', 'bdthemes-element-pack' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'   => esc_html__( 'Column Gap', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-wrapper.bdt-grid'     => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-wrapper.bdt-grid > *' => 'padding-left: {{SIZE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'   => esc_html__( 'Row Gap', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 5,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-wrapper.bdt-grid'     => 'margin-top: -{{SIZE}}px',
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-wrapper.bdt-grid > *' => 'margin-top: {{SIZE}}px',
				],
			]
		);


		$this->add_responsive_control(
			'text_align',
			[
				'label'   => __( 'Text Align', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'label'     => esc_html__( 'Image Size', 'bdthemes-element-pack' ),
				'exclude'   => [ 'custom' ],
				'default'   => 'medium',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_woocommerce_additional',
			[
				'label' => esc_html__( 'Additional', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'   => esc_html__( 'Show Thumbnail', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_badge',
			[
				'label'   => esc_html__( 'Show Badge', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'   => esc_html__( 'Rating', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_price',
			[
				'label'   => esc_html__( 'Price', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_cart',
			[
				'label'   => esc_html__( 'Add to Cart', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_add_to_link',
			[
				'label'   => esc_html__( 'Add to Link', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_query',
			[
				'label' => esc_html__( 'Query', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'   => _x( 'Source', 'Posts Query Control', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''        => esc_html__( 'Show All', 'bdthemes-element-pack' ),
					'by_name' => esc_html__( 'Manual Selection', 'bdthemes-element-pack' ),
				],
				'label_block' => true,
			]
		);


		$product_categories = get_terms( 'product_cat' );

		$options = [];
		foreach ( $product_categories as $category ) {
			$options[ $category->slug ] = $category->name;
		}

		$this->add_control(
			'product_categories',
			[
				'label'       => esc_html__( 'Categories', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SELECT2,
				'options'     => $options,
				'default'     => [],
				'label_block' => true,
				'multiple'    => true,
				'condition'   => [
					'source'    => 'by_name',
				],
			]
		);

		$this->add_control(
			'exclude_products',
			[
				'label'       => esc_html__( 'Exclude Product(s)', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder'     => 'product_id',
				'label_block' => true,
				'description' => __( 'Write product id here, if you want to exclude multiple products so use comma as separator. Such as 1 , 2', '' ),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__( 'Product Limit', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
			]
		);

		$this->add_control(
			'meta_key',
			[
				'label'   => esc_html__( 'Meta Key', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'total_sales',
				'options' => [
					'total_sales'    => esc_html__( 'Total Sales', 'bdthemes-element-pack' ),
					'_regular_price' => esc_html__( 'Regular Price', 'bdthemes-element-pack' ),
					'_sale_price'    => esc_html__( 'Sale Price', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order by', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'     => esc_html__( 'Date', 'bdthemes-element-pack' ),
					'title'    => esc_html__( 'Title', 'bdthemes-element-pack' ),
					'category' => esc_html__( 'Category', 'bdthemes-element-pack' ),
					'rand'     => esc_html__( 'Random', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'Descending', 'bdthemes-element-pack' ),
					'ASC'  => esc_html__( 'Ascending', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_item',
			[
				'label'     => esc_html__( 'Item', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_item_style' );

		$this->start_controls_tab(
			'tab_item_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'item_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'label'       => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'item_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_shadow',
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__( 'Item Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__( 'Description Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_item_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'item_hover_background',
			[
				'label'     => esc_html__( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'item_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_hover_shadow',
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-products-skin-inner:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__( 'Image', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => esc_html__( 'Image Border', 'bdthemes-element-pack' ),
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-image',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'    => 'image_shadow',
				'exclude' => [
					'shadow_position',
				],
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-image',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__( 'Title', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_title_color',
			[
				'label'     => esc_html__( 'Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-title a',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_rating',
			[
				'label'     => esc_html__( 'Rating', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_rating' => 'yes',
				],
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e7e7e7',
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .star-rating:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'active_rating_color',
			[
				'label'     => esc_html__( 'Active Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFCC00',
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .star-rating span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .star-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			[
				'label'     => esc_html__( 'Price', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_control(
			'old_price_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price del' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'old_price_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'old_price_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price del',
			]
		);

		$this->add_control(
			'sale_price_heading',
			[
				'label'     => esc_html__( 'Sale Price', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price, {{WRAPPER}} .bdt-products-tab .bdt-products-skin-price ins' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sale_price_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price, {{WRAPPER}} .bdt-products-tab .bdt-products-skin-price ins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sale_price_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-price, {{WRAPPER}} .bdt-products-tab .bdt-products-skin-price ins',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__( 'Add To Cart', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_cart' => 'yes',
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
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a' => 'background-color: {{VALUE}};',
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
				'selector'    => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__( 'Typography', 'bdthemes-element-pack' ),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a',
				'separator' => 'before',
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
			'hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-cart a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_add_to_link',
			[
				'label'     => esc_html__( 'Add To Link', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_add_to_link' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_add_to_link_style' );

		$this->start_controls_tab(
			'tab_add_to_link_normal',
			[
				'label' => esc_html__( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'add_to_link_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'add_to_link_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'add_to_link_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'add_to_link_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'add_to_link_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'add_to_link_shadow',
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_add_to_link_hover',
			[
				'label' => esc_html__( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'add_to_link_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'add_to_link_background_hover_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'add_to_link_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-products-skin-add-to-links a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_badge',
			[
				'label'     => esc_html__( 'Badge', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'badge_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'badge_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'badge_border',
				'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'badge_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_shadow',
				'selector' => '{{WRAPPER}} .bdt-products-tab .bdt-item-skin-hidie .bdt-badge',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	public function render_image() {
		$settings = $this->get_settings_for_display();
		?>
		<?php if ('yes' == $settings['show_thumb']) : ?>
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size']); ?>">
			</a>
		<?php endif; ?>
		<?php
	}

	public function render_header() {

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('wc-products', 'class', ['bdt-products-tab']);


		?>
		<div <?php echo $this->get_render_attribute_string( 'wc-products' ); ?>>

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

		$exclude_products = ($settings['exclude_products']) ? explode(',', $settings['exclude_products']) : [];

		$args = array(
			'post_type'           => 'product',
			'post_bdt-products-skin-status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'posts_per_page'      => $settings['posts_per_page'],
			'meta_key'            => $settings['meta_key'],
			'orderby'             => $settings['orderby'],
			'order'               => $settings['order'],
			'paged'               => $paged,
			'post__not_in'        => $exclude_products,
		);

		if ( 'by_name' === $settings['source'] and !empty($settings['product_categories']) ) {			  
			$args['tax_query'][] = array(
				'taxonomy'           => 'product_cat',
				'field'              => 'slug',
				'terms'              => $settings['product_categories'],
				'post__not_in'       => $exclude_products,
			);
		}

		$wp_query = new \WP_Query($args);

		return $wp_query;
	}

	public function render_loop_item() {
		$settings = $this->get_settings_for_display();
		$id       = 'bdt-products-skin-' . $this->get_id();

		$text_align = $settings['text_align'] ? : 'left';

		$wp_query = $this->render_query();

		if($wp_query->have_posts()) {

			$this->add_render_attribute('wc-products-wrapper', 'data-bdt-grid', '');

			$this->add_render_attribute(
				[
					'wc-products-wrapper' => [
						'class' => [
							'bdt-products-skin-wrapper',
							'bdt-grid',
							'bdt-grid-medium',
							'bdt-child-width-1-'. $settings['columns_mobile'],
							'bdt-child-width-1-'. $settings['columns_tablet'] .'@s',
							'bdt-child-width-1-'. $settings['columns'] .'@m',
						],
						'id' => esc_attr( $id ),
					],
				]
			);

			?>
			<div <?php echo $this->get_render_attribute_string( 'wc-products-wrapper' ); ?>>
			<?php			

			$this->add_render_attribute( 'wc-product', 'class', 'bdt-products-tab-item' );

			while ( $wp_query->have_posts() ) : $wp_query->the_post(); global $product; ?>
				

		  		<div <?php echo $this->get_render_attribute_string( 'wc-product' ); ?>>

		  			<div class="bdt-item-skin-hidie">
			  			<div class="bdt-products-skin-inner">
			  				<div class="bdt-products-skin-image">
			  					
				  				<?php if ( 'yes' == $settings['show_badge'] and $product->is_on_sale() ) : ?>
						  			<div class="bdt-badge bdt-position-top-left bdt-position-small">
							  			<?php woocommerce_show_product_loop_sale_flash(); ?>
						  			</div>
					  			<?php endif; ?>

				               <?php $this->render_image(); ?>

				               <?php if ('yes' == $settings['show_cart']) : ?>
				                	<div class="bdt-products-skin-add-to-cart">
										<?php woocommerce_template_loop_add_to_cart();?>
									</div>
								<?php endif; ?>

								<?php if ('yes' == $settings['show_add_to_link']) : ?>
								<div class="bdt-products-skin-add-to-links">
		                            <ul>
		                                <li class="wishlist"><a href="#" data-bdt-tooltip="Add to Wishlist" class="ep-icon-heart-empty"></a></li>
		                                <li class="quick"><a href="#" data-bdt-tooltip="Add to Quick" class="ep-icon-search"></a></li>
		                                <li class="compare"><a href="#" data-bdt-tooltip="Add to Compare" class="ep-icon-shrink"></a></li>
		                            </ul>
		                        </div>
		                    	<?php endif; ?>

	                        </div>

		           			<div class="bdt-products-skin-desc bdt-text-<?php echo esc_attr($text_align); ?>">
			               		<?php if ( 'yes' == $settings['show_title']) : ?>
				           			<h2 class="bdt-products-skin-title">
				           				<a href="<?php the_permalink(); ?>" class="bdt-link-reset">
							               <?php the_title(); ?>
							           </a>
					               </h2>
					            <?php endif; ?>

			           			<?php if (('yes' == $settings['show_price']) or ('yes' == $settings['show_rating'])) : ?>
			           			
					               	<?php if ('yes' == $settings['show_rating']) : ?>
						               	<div class="bdt-wc-rating">
						           			<?php woocommerce_template_loop_rating(); ?>
					           			</div>
				                	<?php endif; ?>

				               		<?php if ( 'yes' == $settings['show_price']) : ?>
					           			<span class="bdt-products-skin-price"><?php woocommerce_template_single_price(); ?></span>
						            <?php endif; ?>

			                	<?php endif; ?>
							</div>
						</div>
					</div>

				</div>


			<?php endwhile;	?>
			</div>
			<?php

			wp_reset_postdata();
			
		} else {
			echo '<div class="bdt-alert-warning" data-bdt-alert>' . esc_html__( 'Ops! There is no product.', 'bdthemes-element-pack' ) .'<div>';
		}
	}

	public function render() {
		$this->render_header();
		$this->render_loop_item();
		$this->render_footer(); 

	}
		
}
