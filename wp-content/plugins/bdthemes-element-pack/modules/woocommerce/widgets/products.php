<?php

namespace ElementPack\Modules\Woocommerce\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use ElementPack\Utils;
use ElementPack\Includes\Controls\GroupQuery\Group_Control_Query;
use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;
use ElementPack\Traits\Global_Widget_Controls;
use ElementPack\Modules\Woocommerce\Skins;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Products extends Module_Base {
	use Group_Control_Query;
	use Global_Widget_Controls;
	public function get_name() {
		return 'bdt-wc-products';
	}

	public function get_title() {
		return BDTEP . esc_html__('WC - Products', 'bdthemes-element-pack');
	}

	public function get_icon() {
		return 'bdt-wi-woocommerce';
	}

	public function get_categories() {
		return ['element-pack'];
	}

	public function get_keywords() {
		return ['product', 'woocommerce', 'table', 'wc'];
	}

	public function get_script_depends() {
		return ['datatables', 'datatables-uikit', 'wc-add-to-cart-variation'];
	}

	public function get_style_depends() {
		if ($this->ep_is_edit_mode()) {
			return ['ep-all-styles'];
		} else {
			return ['ep-woocommerce', 'datatables-uikit', 'datatables', 'element-pack-font'];
		}
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/3VkvEpVaNAM';
	}
	public function on_import($element) {
		if (!get_post_type_object($element['settings']['posts_post_type'])) {
			$element['settings']['posts_post_type'] = 'product';
		}

		return $element;
	}

	public function on_export($element) {
		$element = Group_Control_Posts::on_export_remove_setting_from_element($element, 'posts');
		return $element;
	}

	public function get_query() {
		return $this->_query;
	}

	public function _register_skins() {
		$this->add_skin(new Skins\Skin_Table($this));
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_woocommerce_layout',
			[
				'label' => esc_html__('Layout', 'bdthemes-element-pack'),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__('Product Limit', 'bdthemes-element-pack') . BDTEP_NC,
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'          => esc_html__('Columns', 'bdthemes-element-pack'),
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
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'   => esc_html__('Column Gap', 'bdthemes-element-pack'),
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-products-wrapper.bdt-grid'     => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-products-wrapper.bdt-grid > *' => 'padding-left: {{SIZE}}px',
				],
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'   => esc_html__('Row Gap', 'bdthemes-element-pack'),
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-products-wrapper.bdt-grid'     => 'margin-top: -{{SIZE}}px',
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-products-wrapper.bdt-grid > *' => 'margin-top: {{SIZE}}px',
				],
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label'   => esc_html__('Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .star-rating' => 'text-align: {{VALUE}}; display: inline-block !important',
				],
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'hide_header',
			[
				'label'   => esc_html__('Hide Header', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'return'  => 'yes',
				'condition'    => [
					'_skin'      => 'bdt-table',
				],

			]
		);

		$this->add_control(
			'table_header_alignment',
			[
				'label'   => esc_html__('Header Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table th' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'_skin!' => '',
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'table_data_alignment',
			[
				'label'   => esc_html__('Data Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table td' => 'text-align: {{VALUE}}',
				],
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      => 'image',
				'label'     => esc_html__('Image Size', 'bdthemes-element-pack'),
				'exclude'   => ['custom'],
				'default'   => 'medium',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_filter_bar',
			[
				'label' => esc_html__('Show Filter', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
				'condition'    => [
					'_skin'      => '',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'active_hash',
			[
				'label'       => esc_html__('Hash Location', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SWITCHER,
				'default'     => 'no',
				'condition' => [
					'show_filter_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'hash_top_offset',
			[
				'label'     => esc_html__('Top Offset ', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['px', ''],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1000,
						'step' => 5,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 70,
				],
				'condition' => [
					'active_hash' => 'yes',
					'show_filter_bar' => 'yes',
				],
			]
		);

		$this->add_control(
			'hash_scrollspy_time',
			[
				'label'     => esc_html__('Scrollspy Time', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'size_units' => ['ms', ''],
				'range' => [
					'px' => [
						'min' => 500,
						'max' => 5000,
						'step' => 1000,
					],
				],
				'default'   => [
					'unit' => 'px',
					'size' => 1000,
				],
				'condition' => [
					'active_hash' => 'yes',
					'show_filter_bar' => 'yes',
				],
			]
		);
		$this->add_control(
			'show_pagination',
			[
				'label' => esc_html__('Show Pagination', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
		$this->add_control(
			'masonry',
			[
				'label'       => esc_html__('Masonry', 'bdthemes-element-pack'),
				'description' => esc_html__('Masonry will not work if you not set filter.', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SWITCHER,
				'condition'   => [
					'columns!' => '1',
					'_skin'		=> '',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_info',
			[
				'label'   => esc_html__('Footer Info', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition'    => [
					'_skin'           => 'bdt-table',
					'show_pagination' => 'yes',
				],
			]
		);

		$this->end_controls_section();
		//New Query Builder Settings
		$this->start_controls_section(
			'section_post_query_builder',
			[
				'label' => __('Query', 'bdthemes-element-pack') . BDTEP_NC,
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);
		$this->register_query_builder_controls();

		$this->update_control(
			'posts_source',
			[
				'type'      => Controls_Manager::SELECT,
				'default'   => 'product',
				'options' => [
					'product' => "Product",
					'manual_selection'   => __('Manual Selection', 'bdthemes-element-pack'),
					'current_query'      => __('Current Query', 'bdthemes-element-pack'),
					'_related_post_type' => __('Related', 'bdthemes-element-pack'),
				],
				'condition' => [
					'is_replaced_deprecated_query' => 'yes',
				]
			]
		);
		$this->update_control(
			'posts_orderby',
			[
				'label'     => __('Order By', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => [
					'title'         => __('Title', 'bdthemes-prime-slider'),
					'ID'            => __('ID', 'bdthemes-prime-slider'),
					'date'          => __('Date', 'bdthemes-prime-slider'),
					'author'        => __('Author', 'bdthemes-prime-slider'),
					'comment_count' => __('Comment Count', 'bdthemes-prime-slider'),
					'menu_order'    => __('Menu Order', 'bdthemes-prime-slider'),
					'rand'          => __('Random', 'bdthemes-prime-slider'),
					'price'          => __('Price', 'bdthemes-prime-slider'),
					'sales'          => __('Sales', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'_skin!' => 'bdt-table',
					'is_replaced_deprecated_query' => 'yes',
				]
			]
		);
		$this->add_control(
			'product_order_column',
			[
				'label'   => esc_html__('Order by', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default'  => esc_html__('Default', 'bdthemes-element-pack'),
					'title'  => esc_html__('Title', 'bdthemes-element-pack'),
					'excerpt' => esc_html__('Description', 'bdthemes-element-pack'),
					'categories' => esc_html__('Categories', 'bdthemes-element-pack'),
					'price' => esc_html__('Price', 'bdthemes-element-pack'),
				],
				'condition' => [
					'_skin' => 'bdt-table',
					'is_replaced_deprecated_query' => 'yes',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_query',
			[
				'label' => esc_html__('Query (Deprecated)', 'bdthemes-element-pack'),
				'condition' => [
					'is_replaced_deprecated_query!' => 'yes'
				]
			]
		);

		$this->add_control(
			'source',
			[
				'label'   => _x('Source', 'Posts Query Control', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					''        => esc_html__('Show All', 'bdthemes-element-pack'),
					'by_name' => esc_html__('Manual Selection', 'bdthemes-element-pack'),
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'product_categories',
			[
				'label'       => esc_html__('Categories', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SELECT2,
				'options'     => element_pack_get_terms('product_cat'),
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
				'label'       => esc_html__('Exclude Product(s)', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::TEXT,
				'placeholder'     => 'product_id',
				'label_block' => true,
				'description' => __('Write product id here, if you want to exclude multiple products so use comma as separator. Such as 1 , 2', ''),
			]
		);

		// $this->add_control(
		// 	'posts_per_page',
		// 	[
		// 		'label'   => esc_html__('Product Limit', 'bdthemes-element-pack'),
		// 		'type'    => Controls_Manager::NUMBER,
		// 		'default' => 8,
		// 	]
		// );

		// $this->add_control(
		// 	'show_pagination',
		// 	[
		// 		'label' => esc_html__('Pagination', 'bdthemes-element-pack'),
		// 		'type'  => Controls_Manager::SWITCHER,
		// 	]
		// );

		$this->add_control(
			'show_per_page',
			[
				'label'       => esc_html__('Show Per Page', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::SELECT,
				'default' => '10',
				'options' => [
					'10'  => '10',
					'25'  => '25',
					'50'  => '50',
					'100' => '100',
				],
				'condition' => [
					'show_pagination' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_product_type',
			[
				'label'   => esc_html__('Show Product', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'      => esc_html__('All Products', 'bdthemes-element-pack'),
					'onsale'   => esc_html__('On Sale', 'bdthemes-element-pack'),
					'featured' => esc_html__('Featured', 'bdthemes-element-pack'),
				],

			]
		);


		$this->add_control(
			'hide_free',
			[
				'label'   => esc_html__('Hide Free', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'hide_out_stock',
			[
				'label'   => esc_html__('Hide Out of Stock', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__('Order by', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  => esc_html__('Date', 'bdthemes-element-pack'),
					'price' => esc_html__('Price', 'bdthemes-element-pack'),
					'sales' => esc_html__('Sales', 'bdthemes-element-pack'),
					'rand'  => esc_html__('Random', 'bdthemes-element-pack'),
				],
				'condition' => [
					'_skin' => '',
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
				'condition' => [
					'_skin' => '',
				],
			]
		);


		$this->add_control(
			'orderColumn',
			[
				'label'   => esc_html__('Order by', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'separator' => 'before',
				'default' => 'default',
				'options' => [
					'default'  => esc_html__('Default', 'bdthemes-element-pack'),
					'title'  => esc_html__('Title', 'bdthemes-element-pack'),
					'excerpt' => esc_html__('Description', 'bdthemes-element-pack'),
					'categories' => esc_html__('Categories', 'bdthemes-element-pack'),
					'price' => esc_html__('Price', 'bdthemes-element-pack'),
				],
				'condition' => [
					'_skin' => 'bdt-table',
				],
			]
		);

		$this->add_control(
			'orderColumnQry',
			[
				'label'   => esc_html__('Order', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'desc' => esc_html__('Descending', 'bdthemes-element-pack'),
					'asc'  => esc_html__('Ascending', 'bdthemes-element-pack'),
				],
				'condition' => [
					'orderColumn!' => 'default',
					'_skin' => 'bdt-table',
				]
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_woocommerce_additional',
			[
				'label' => esc_html__('Additional', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'match_height',
			[
				'label' => __('Item Match Height', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'show_badge',
			[
				'label'     => esc_html__('Show Badge', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'show_change_length',
			[
				'label'   => esc_html__('Show Change Length', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'_skin'           => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'show_searching',
			[
				'label'   => esc_html__('Search', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'_skin'           => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'show_ordering',
			[
				'label'   => esc_html__('Ordering', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'after',
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'show_thumb',
			[
				'label'   => esc_html__('Show Thumbnail', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [
					'_skin'      => 'bdt-table',
				],
			]
		);

		$this->add_control(
			'open_thumb_in_lightbox',
			[
				'label'      => esc_html__('Open Thumb in Lightbox', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::SWITCHER,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'show_thumb',
							'value'    => 'yes',
						],
						[
							'name'  => '_skin',
							'value' => 'bdt-table',
						],
					],
				],
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
			'title_tags',
			[
				'label'   => __('Title HTML Tag', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => element_pack_title_tags(),
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'     => esc_html__('Excerpt', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->add_control(
			'excerpt_limit',
			[
				'label'      => esc_html__('Excerpt Limit', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::NUMBER,
				'default'    => 10,
				'conditions' => [
					'terms' => [
						[
							'name'  => 'show_excerpt',
							'value' => 'yes',
						],
						[
							'name'     => '_skin',
							'operator' => '!=',
							'value'    => '',
						],
					],
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
			'show_price',
			[
				'label'   => esc_html__('Price', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_categories',
			[
				'label'     => esc_html__('Categories', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin' => 'bdt-table',
				],
			]
		);


		$this->add_control(
			'show_tags',
			[
				'label'     => esc_html__('Tags', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin' => 'bdt-table',
				],
			]
		);

		$this->add_control(
			'show_quantity',
			[
				'label'   => esc_html__('Quantity', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin' => 'bdt-table',
				],
			]
		);

		$this->add_control(
			'show_cart',
			[
				'label'   => esc_html__('Add to Cart', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'cart_hide_mobile',
			[
				'label'   => esc_html__('Cart Hide On Mobile ?', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'show_cart' => 'yes',
					'_skin!' => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'show_quick_view',
			[
				'label'   => esc_html__('Quick View', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'quick_view_hide_mobile',
			[
				'label'   => esc_html__('Quick View Hide On Mobile ?', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'show_quick_view' => 'yes',
					'_skin!' => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'thumb_hide_on_mobile',
			[
				'label'        => esc_html__('Thumb Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-thumb-hide-on-mobile-',
				'condition'    => [
					'show_thumb' => 'yes',
					'_skin'      => 'bdt-table',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_hide_on_mobile',
			[
				'label'        => esc_html__('Title Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-title-hide-on-mobile-',
				'condition'    => [
					'show_title' => 'yes',
					'_skin'      => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'excerpt_hide_on_mobile',
			[
				'label'        => esc_html__('Description Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-excerpt-hide-on-mobile-',
				'condition'    => [
					'show_excerpt' => 'yes',
					'_skin'        => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'price_hide_on_mobile',
			[
				'label'        => esc_html__('Price Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-price-hide-on-mobile-',
				'condition'    => [
					'show_price' => 'yes',
					'_skin'      => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'categories_hide_on_mobile',
			[
				'label'        => esc_html__('Categories Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-categories-hide-on-mobile-',
				'condition'    => [
					'show_categories' => 'yes',
					'_skin'           => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'tags_hide_on_mobile',
			[
				'label'        => esc_html__('Tags Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-tags-hide-on-mobile-',
				'condition'    => [
					'show_tags' => 'yes',
					'_skin'     => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'rating_hide_on_mobile',
			[
				'label'        => esc_html__('Rating Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-rating-hide-on-mobile-',
				'condition'    => [
					'show_rating' => 'yes',
					'_skin'       => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'cart_hide_on_mobile',
			[
				'label'        => esc_html__('Cart Hide on mobile ?', 'bdthemes-element-pack'),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-cart-hide-on-mobile-',
				'condition'    => [
					'show_cart' => 'yes',
					'_skin'     => 'bdt-table',
				]
			]
		);


		$this->add_control(
			'grid_animation_type',
			[
				'label'   => esc_html__('Grid Entrance Animation', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => element_pack_transition_options(),
				'separator' => 'before',
				'condition'    => [
					'_skin!'     => 'bdt-table',
				]
			]
		);

		$this->add_control(
			'grid_anim_delay',
			[
				'label'      => esc_html__('Animation delay', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => ['ms', ''],
				'range'      => [
					'ms' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'ms',
					'size' => 300,
				],
				'condition' => [
					'grid_animation_type!' => '',
				],
			]
		);




		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_item',
			[
				'label'     => esc_html__('Item', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'item_border',
				'label'       => esc_html__('Border Color', 'bdthemes-element-pack'),
				'selector'    => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner',
				'fields_options' => [
					'border' => [
						'default' => 'solid',
					],
					'width' => [
						'default' => [
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'isLinked' => false,
						],
					],
					'color' => [
						'default' => '#eee',
					],
				],
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_shadow',
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label'      => esc_html__('Item Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_padding',
			[
				'label'      => esc_html__('Description Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner:hover' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_hover_shadow',
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-inner:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_table',
			[
				'label'     => esc_html__('Table', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->start_controls_tabs('tabs_table_style');

		$this->start_controls_tab(
			'tab_table_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'table_header_typography',
				'label'    => esc_html__('Header Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-products table th',
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'table_heading_background',
			[
				'label'     => esc_html__('Heading Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table th' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'table_heading_color',
			[
				'label'     => esc_html__('Heading Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table th' => 'color: {{VALUE}};',
				],
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'cell_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table td'                  => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-wc-products table th'                  => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-wc-products table.dataTable.no-footer' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'cell_border' => 'yes',
				],
			]
		);

		$this->add_control(
			'table_odd_row_background',
			[
				'label'     => esc_html__('Odd Row Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table.dataTable.stripe tbody tr.odd' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'stripe' => 'yes',
				],
			]
		);

		$this->add_control(
			'table_even_row_background',
			[
				'label'     => esc_html__('Even Row Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table.dataTable.stripe tbody tr.even' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'stripe' => 'yes',
				],
			]
		);

		$this->add_control(
			'cell_border',
			[
				'label'     => esc_html__('Cell Border', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->add_control(
			'stripe',
			[
				'label'     => esc_html__('stripe', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->add_control(
			'hover_effect',
			[
				'label'     => esc_html__('Hover Effect', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'_skin!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'table_cell_padding',
			[
				'label'      => esc_html__('Cell Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products table.bdt-wc-product td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sorting_style',
			[
				'label'     => esc_html__('Sorting Style', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->add_control(
			'sorting_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products.bdt-wc-products-skin-table table.dataTable thead th:before, {{WRAPPER}} .bdt-wc-products.bdt-wc-products-skin-table table.dataTable thead th:after' => 'color: {{VALUE}};',
				],
				'condition' => [
					'hide_header!' => 'yes'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_table_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'table_odd_row_hover_background',
			[
				'label'     => esc_html__('Odd Row Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products table.dataTable.stripe tbody tr:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'stripe' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_field_style',
			[
				'label' => esc_html__('Search Field', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_searching' => 'yes',
					'_skin'           => 'bdt-table',
				],
			]
		);

		$this->start_controls_tabs('tabs_search_field_style');

		$this->start_controls_tab(
			'tab_search_field_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'search_field_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_field_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'search_field_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-wc-products input[type*="search"], {{WRAPPER}} .bdt-wc-products select',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'search_field_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_field_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_control(
			'search_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .dataTables_filter label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'search_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .dataTables_filter' => 'margin-bottom: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'search_text_typography',
				'label'     => esc_html__('Text Typography', 'bdthemes-element-pack'),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-wc-products .dataTables_filter label',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_search_field_focus',
			[
				'label' => esc_html__('Focus', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'search_field_focus_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_field_focus_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_field_focus_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'search_field_focus_border_width',
			[
				'label'   => __('Border Width', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]:focus' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'search_field_focus_border_radius',
			[
				'label'   => __('Border Radius', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products input[type*="search"]:focus' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_select_field_style',
			[
				'label'     => esc_html__('Select Field', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
					'_skin'           => 'bdt-table',
				],
			]
		);

		$this->start_controls_tabs('tabs_select_field_style');

		$this->start_controls_tab(
			'tab_select_field_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'select_field_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products select'   => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'select_field_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products select' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'select_field_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-wc-products select',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'select_field_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'select_field_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'select_text_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'select_field_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .dataTables_length label' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'select_text_typography',
				'label'     => esc_html__('Text Typography', 'bdthemes-element-pack'),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-wc-products .dataTables_length label',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_select_field_focus',
			[
				'label' => esc_html__('Focus', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'select_field_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'select_field_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products select:focus'   => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => esc_html__('Image', 'bdthemes-element-pack'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => esc_html__('Image Border', 'bdthemes-element-pack'),
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-image',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-image',
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_title_color',
			[
				'label'     => esc_html__('Hover Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-title:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label'     => esc_html__('Excerpt', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-excerpt',
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
					'{{WRAPPER}} .bdt-wc-products .star-rating:before' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-wc-products .star-rating span' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-wc-products .star-rating span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_price',
			[
				'label'     => esc_html__('Price', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_price' => 'yes',
				],
			]
		);

		$this->add_control(
			'old_price_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-price .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'old_price_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'old_price_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-price del .amount',
			]
		);

		$this->add_control(
			'sale_price_heading',
			[
				'label'     => esc_html__('Sale Price', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sale_price_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-price, {{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-wc-product-price ins .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sale_price_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product-price, {{WRAPPER}} .bdt-wc-products .bdt-wc-product-price ins' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sale_price_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product-price, {{WRAPPER}} .bdt-wc-products .bdt-wc-product-price ins .amount, {{WRAPPER}} .bdt-wc-products .bdt-wc-product-price .amount',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__('Button', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_cart' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_fullwidth',
			[
				'label'     => esc_html__('Fullwidth Button', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SWITCHER,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a' => 'width: 100%;',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_shadow',
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'button_typography',
				'label'     => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'    => Schemes\Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-add-to-cart a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_quick_view',
			[
				'label'     => esc_html__('Quick View Button', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_quick_view' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_quick_view_style');

		$this->start_controls_tab(
			'tab_quick_view_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'quick_view_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'quick_view_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-wc-products .bdt-quick-view a',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'quick_view_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quick_view_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'quick_view_shadow',
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-quick-view a',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'quick_view_typography',
				'selector'  => '{{WRAPPER}} .bdt-wc-products .bdt-quick-view a i',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_quick_view_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'quick_view_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_background_hover_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'quick_view_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-quick-view a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_quick_view_modal',
			[
				'label'     => esc_html__('Quick View Modal', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_quick_view' => 'yes',
				],
			]
		);


		$this->add_control(
			'quick_view_modal_body_color',
			[
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view.bdt-modal-container .bdt-modal-dialog' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_title_heading',
			[
				'label'     => esc_html__('Title', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .product_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_title_spacing',
			[
				'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'.bdt-product-quick-view .product .product_title' => 'padding-bottom: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_title_typography',
				'selector' => '.bdt-product-quick-view .product .product_title',
			]
		);

		$this->add_control(
			'quick_view_modal_excerpt_heading',
			[
				'label'     => esc_html__('Excerpt', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_excerpt_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .woocommerce-product-details__short-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_excerpt_spacing',
			[
				'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'.bdt-product-quick-view .product .woocommerce-product-details__short-description' => 'padding-bottom: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_excerpt_typography',
				'selector' => '.bdt-product-quick-view .product .woocommerce-product-details__short-description',
			]
		);

		$this->add_control(
			'quick_view_modal_rating_heading',
			[
				'label'     => esc_html__('Rating', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_rating_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#e7e7e7',
				'selectors' => [
					'.bdt-product-quick-view .product .star-rating:before' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'quick_view_modal_active_rating_color',
			[
				'label'     => esc_html__('Active Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFCC00',
				'selectors' => [
					'.bdt-product-quick-view .product .star-rating span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_rating_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .woocommerce-product-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_price_heading',
			[
				'label'     => esc_html__('Old Price', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_old_price_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product del .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_old_price_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .product del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_old_price_typography',
				'selector' => '.bdt-product-quick-view .product del',
			]
		);

		$this->add_control(
			'quick_view_modal_sale_price_heading',
			[
				'label'     => esc_html__('Sale Price', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_sale_price_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product ins .amount, .bdt-product-quick-view .product .price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_sale_price_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .product ins, .bdt-product-quick-view .product .price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_sale_price_typography',
				'selector' => '.bdt-product-quick-view .product ins, .bdt-product-quick-view .product .price',
			]
		);

		$this->add_control(
			'quick_view_modal_badge_heading',
			[
				'label'     => esc_html__('Badge', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_badge_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'.bdt-product-quick-view .product .onsale' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_badge_bg_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .onsale' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_badge_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 100
					],
				],
				'selectors' => [
					'.bdt-product-quick-view .product .onsale' => 'width: {{SIZE}}px; height: {{SIZE}}px; line-height: {{SIZE}}px;'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'quick_view_modal_badge_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'selector'    => '.bdt-product-quick-view .product .onsale',
			]
		);

		$this->add_control(
			'quick_view_modal_badge_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .product .onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'quick_view_modal_badge_typography',
				'selector'  => '.bdt-product-quick-view .product .onsale',
			]
		);

		$this->add_control(
			'quick_view_modal_meta_heading',
			[
				'label'     => esc_html__('Meta', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_meta_color',
			[
				'label'     => esc_html__('Type Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .product_meta>span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_meta_typography',
				'label'     => esc_html__('Type Typography', 'bdthemes-element-pack'),
				'selector' => '.bdt-product-quick-view .product .product_meta>span',
			]
		);

		$this->add_control(
			'quick_view_modal_tag_color',
			[
				'label'     => esc_html__('Category/Tags Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .product_meta a, .bdt-product-quick-view .product .product_meta>span span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'quick_view_modal_tag_typography',
				'label'     => esc_html__('Category/Tags Typography', 'bdthemes-element-pack'),
				'selector' => '.bdt-product-quick-view .product .product_meta a,  .bdt-product-quick-view .product .product_meta>span span',
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_meta_top_spacing',
			[
				'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'.bdt-product-quick-view .product .product_meta' => 'padding-top: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'quick_view_modal_close_heading',
			[
				'label'     => esc_html__('Close Button', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_close_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .bdt-modal-dialog .bdt-close svg' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_close_size',
			[
				'label'      => esc_html__('Size', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50
					],
				],
				'selectors' => [
					'.bdt-product-quick-view .bdt-modal-dialog .bdt-close svg' => 'width: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'quick_view_modal_quantity_heading',
			[
				'label'     => esc_html__('Quantity', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'quick_view_modal_quantity_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_quantity_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'quick_view_modal_quantity_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '.bdt-product-quick-view .cart .quantity .qty',
			]
		);

		$this->add_control(
			'quick_view_modal_quantity_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_quantity_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'quick_view_modal_quantity_shadow',
				'selector' => '.bdt-product-quick-view .cart .quantity .qty',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'quick_view_modal_quantity_typography',
				'selector'  => '.bdt-product-quick-view .cart .quantity .qty',
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_quantity_width',
			[
				'label'      => esc_html__('Width', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'selectors' => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'width: {{SIZE}}px;'
				]
			]
		);

		$this->add_responsive_control(
			'quick_view_modal_quantity_spacing',
			[
				'label'      => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 50
					],
				],
				'selectors' => [
					'.bdt-product-quick-view .cart .quantity .qty' => 'margin-right: {{SIZE}}px;'
				]
			]
		);

		$this->add_control(
			'quick_view_modal_button_heading',
			[
				'label'     => esc_html__('Add To Cart', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs('tabs_quick_view_modal_style');

		$this->start_controls_tab(
			'tab_quick_view_modal_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'quick_view_modal_text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .cart .button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .cart .button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'quick_view_modal_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '.bdt-product-quick-view .product .cart .button',
			]
		);

		$this->add_control(
			'quick_view_modal_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .product .cart .button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'.bdt-product-quick-view .product .cart .button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'quick_view_modal_shadow',
				'selector' => '.bdt-product-quick-view .product .cart .button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'quick_view_modal_typography',
				'selector'  => '.bdt-product-quick-view .product .cart .button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_quick_view_modal_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'quick_view_modal_hover_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .cart .button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_background_hover_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'.bdt-product-quick-view .product .cart .button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'quick_view_modal_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'quick_view_modal_border_border!' => '',
				],
				'selectors' => [
					'.bdt-product-quick-view .product .cart .button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_badge',
			[
				'label'     => esc_html__('Badge', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_control(
			'badge_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_bg_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'badge_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'badge_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'badge_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'badge_shadow',
				'selector' => '{{WRAPPER}} .bdt-wc-products .bdt-wc-product .bdt-badge',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_pagination',
			[
				'label'     => esc_html__('Footer', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_pagination' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_datatable_footer_style');

		$this->start_controls_tab(
			'tab_datatable_pagination',
			[
				'label' => esc_html__('Pagination', 'bdthemes-element-pack'),
			]
		);

		$this->add_responsive_control(
			'pagination_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination'    => 'margin-top: {{SIZE}}px;',
					'{{WRAPPER}} .dataTables_paginate' => 'margin-top: {{SIZE}}px;',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a'    => 'color: {{VALUE}};',
					'{{WRAPPER}} ul.bdt-pagination li span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .paginate_button'          => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'active_pagination_color',
			[
				'label'     => esc_html__('Active Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .paginate_button.current'          => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->add_control(
			'pagination_background',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a'    => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'_skin!' => 'bdt-table'
				]
			]
		);

		$this->add_control(
			'active_pagination_background',
			[
				'label'     => esc_html__('Active Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li.bdt-active a' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'_skin!' => 'bdt-table'
				]
			]
		);

		$this->add_responsive_control(
			'pagination_margin',
			[
				'label'     => esc_html__('Margin', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a'    => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} ul.bdt-pagination li span' => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
					'{{WRAPPER}} .paginate_button'          => 'margin: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_arrow_size',
			[
				'label'     => esc_html__('Arrow Size', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} ul.bdt-pagination li a svg' => 'height: {{SIZE}}px; width: auto;',
				],
				'condition' => [
					'_skin' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} ul.bdt-pagination li a, {{WRAPPER}} ul.bdt-pagination li span, {{WRAPPER}} .dataTables_paginate',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_datatable_info',
			[
				'label' => __('Page Info', 'bdthemes-element-pack'),
				'condition' => [
					'_skin' => 'bdt-table'
				]
			]
		);

		$this->add_responsive_control(
			'info_spacing',
			[
				'label'     => esc_html__('Spacing', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .dataTables_info' => 'margin-top: {{SIZE}}px;',
				],
				'condition' => [
					'_skin' => 'bdt-table'
				]
			]
		);

		$this->add_control(
			'info_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dataTables_info' => 'color: {{VALUE}};',
				],
				'condition' => [
					'_skin' => 'bdt-table'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'info_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .dataTables_info',
				'condition' => [
					'_skin' => 'bdt-table'
				]
			]
		);

		$this->end_controls_tab();


		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_categories',
			[
				'label'      => esc_html__('Categories', 'bdthemes-element-pack'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'  => '_skin',
							'value' => 'bdt-table',
						],
						[
							'name'  => 'show_categories',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'categories_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-product-categories a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-wc-product-categories'   => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'categories_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-product-categories, {{WRAPPER}} .bdt-wc-product-categories a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_tags',
			[
				'label'      => esc_html__('Tags', 'bdthemes-element-pack'),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'  => '_skin',
							'value' => 'bdt-table',
						],
						[
							'name'  => 'show_tags',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'tags_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-wc-product-tags'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-wc-product-tags a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tags_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-wc-product-tags, {{WRAPPER}} .bdt-wc-product-tags a',
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
				'label'   => esc_html__('Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'bdthemes-element-pack'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
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
				'label' => __('Button Width(%)', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
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
	}

	public function render_image() {
		$settings = $this->get_settings_for_display(); ?>
		<div class="bdt-wc-product-image bdt-position-relative bdt-background-cover">
			<a href="<?php the_permalink(); ?>">
				<img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), $settings['image_size']); ?>" alt="<?php echo get_the_title(); ?>">
			</a>

			<?php if ('yes' == $settings['show_cart']) : ?>
				<div class="bdt-wc-add-to-cart <?php echo esc_attr($settings['cart_hide_mobile'] ? 'bdt-visible@s' : '') ?>">
					<?php woocommerce_template_loop_add_to_cart(); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	public function render_quick_view($product_id) {
		$settings = $this->get_settings_for_display();
		if ('yes' == $settings['show_quick_view']) : ?>
			<div class="bdt-quick-view <?php echo esc_attr($settings['quick_view_hide_mobile'] ? 'bdt-visible@s' : '') ?>">
				<?php wp_nonce_field('ajax-ep-wc-product-nonce', 'bdt-wc-product-modal-sc'); ?>
				<input type="hidden" class="bdt_modal_spinner_message" value="<?php echo __('Please wait...', 'bdthemes-element-pack'); ?>" />
				<a href="javascript:void(0)" data-id="<?php echo absint($product_id); ?>" data-bdt-tooltip="title: <?php echo __('Quick View', 'bdthemes-element-pack'); ?>; pos: left;">
					<i class="ep-icon-eye"></i>
				</a>
			</div>
		<?php endif;
	}

	public function render_header() {

		$settings = $this->get_settings_for_display();

		if ('yes' == $settings['match_height']) {
			$this->add_render_attribute('wc-products', 'data-bdt-height-match', 'target: > div > div > .bdt-wc-product-inner');
		}

		$this->add_render_attribute('wc-products', 'class', ['bdt-wc-products', 'bdt-wc-products-skin-default']);

		if ($settings['show_filter_bar']) {
			$this->add_render_attribute('wc-products', 'data-bdt-filter', 'target: #bdt-wc-product-' . $this->get_id());
		}

		?>
		<div <?php echo $this->get_render_attribute_string('wc-products'); ?>>

			<?php if ($settings['show_filter_bar']) {
				$this->render_filter_menu();
			}
		}

		public function render_footer() {
			?>

		</div>
	<?php
		}

		public function render_new_query($posts_limit) {
			$default = $this->getGroupControlQueryArgs();
			$args['posts_per_page'] = $posts_limit;
			$args         = array_merge($default, $args);
			return new WP_Query($default);
		}

		public function render_query() {
			$settings = $this->get_settings_for_display();
			if (get_query_var('paged')) {
				$paged = get_query_var('paged');
			} elseif (get_query_var('page')) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;
			}

			$exclude_products = ($settings['exclude_products']) ? explode(',', $settings['exclude_products']) : [];

			$query_args = array(
				'post_type'           => 'product',
				'post_status'         => 'publish',
				'posts_per_page'      => $settings['posts_per_page'],
				'ignore_sticky_posts' => 1,
				'meta_query'          => [],
				'tax_query'           => ['relation' => 'AND'],
				'paged'               => $paged,
				'order'               => $settings['order'],
				'post__not_in'        => $exclude_products,
			);

			$product_visibility_term_ids = wc_get_product_visibility_term_ids();


			if ('by_name' === $settings['source'] and !empty($settings['product_categories'])) {
				$query_args['tax_query'][] = [
					'taxonomy'           => 'product_cat',
					'field'              => 'slug',
					'terms'              => $settings['product_categories'],
					'post__not_in'       => $exclude_products,
				];
			}

			if ('yes' == $settings['hide_free']) {
				$query_args['meta_query'][] = [
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				];
			}

			if ('yes' == $settings['hide_out_stock']) {
				$query_args['tax_query'][] = [
					[
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['outofstock'],
						'operator' => 'NOT IN',
					],
				]; // WPCS: slow query ok.
			}


			switch ($settings['show_product_type']) {
				case 'featured':
					$query_args['tax_query'][] = [
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['featured'],
					];
					break;
				case 'onsale':
					$product_ids_on_sale    = wc_get_product_ids_on_sale();
					$product_ids_on_sale[]  = 0;
					$query_args['post__in'] = $product_ids_on_sale;
					break;
			}


			switch ($settings['orderby']) {
				case 'price':
					$query_args['meta_key'] = '_price'; // WPCS: slow query ok.
					$query_args['orderby']  = 'meta_value_num';
					break;
				case 'rand':
					$query_args['orderby'] = 'rand';
					break;
				case 'sales':
					$query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
					$query_args['orderby']  = 'meta_value_num';
					break;
				default:
					$query_args['orderby'] = 'date';
			}
			return new WP_Query($query_args);
		}

		public function render_filter_menu() {
			$settings           = $this->get_settings_for_display();
			$product_categories = [];
			if (isset($settings['is_replaced_deprecated_query']) && $settings['is_replaced_deprecated_query'] === 'yes') {
				$wp_query = $this->render_new_query($settings['posts_per_page']);
			} else {
				$wp_query = $this->render_query();
			}
			if ('by_name' === $settings['source'] and !empty($settings['product_categories'])) {
				$product_categories = $settings['product_categories'];
			} else {

				while ($wp_query->have_posts()) : $wp_query->the_post();
					$terms = get_the_terms(get_the_ID(), 'product_cat');
					foreach ($terms as $term) {
						$product_categories[] = esc_attr($term->slug);
					};
				endwhile;

				wp_reset_postdata();

				$product_categories = array_unique($product_categories);
			}
			$this->add_render_attribute(
				[
					'portfolio-gallery-hash-data' => [
						'data-hash-settings' => [
							wp_json_encode(
								array_filter([
									"id"       => 'bdt-products-' . $this->get_id(),
									'activeHash'  		=> $settings['active_hash'],
									'hashTopOffset'  	=> isset($settings['hash_top_offset']) ? $settings['hash_top_offset']['size'] : 70,
									'hashScrollspyTime' => isset($settings['hash_scrollspy_time']) ? $settings['hash_scrollspy_time']['size'] : 1000,
								])
							),
						],
					],
				]
			); ?>

		<div class="bdt-ep-grid-filters-wrapper" id="<?php echo 'bdt-products-' . $this->get_id(); ?>" <?php echo $this->get_render_attribute_string('portfolio-gallery-hash-data'); ?>>

			<button class="bdt-button bdt-button-default bdt-hidden@m" type="button"><?php esc_html_e('Filter', 'bdthemes-element-pack'); ?></button>
			<div data-bdt-dropdown="mode: click;" class="bdt-dropdown bdt-margin-remove-top bdt-margin-remove-bottom">
				<ul class="bdt-nav bdt-dropdown-nav">

					<li class="bdt-ep-grid-filter bdt-active" data-bdt-filter-control><?php esc_html_e('All Products', 'bdthemes-element-pack'); ?></li>

					<?php foreach ($product_categories as $product_category => $value) : ?>
						<?php $filter_name = get_term_by('slug', $value, 'product_cat'); ?>
						<li class="bdt-ep-grid-filter" data-bdt-filter-control="[data-filter*='bdtf-<?php echo esc_attr(trim($value)); ?>']">
							<?php echo esc_html($filter_name->name); ?>
						</li>
					<?php endforeach; ?>

				</ul>
			</div>


			<ul class="bdt-ep-grid-filters bdt-visible@m" data-bdt-margin>
				<li class="bdt-ep-grid-filter bdt-active" data-bdt-filter-control><?php esc_html_e('All Products', 'bdthemes-element-pack'); ?></li>

				<?php foreach ($product_categories as $product_category => $value) : ?>
					<?php $filter_name = get_term_by('slug', $value, 'product_cat'); ?>
					<li class="bdt-ep-grid-filter" data-bdt-filter-control="[data-filter*='bdtf-<?php echo esc_attr(trim($value)); ?>']">
						<?php echo esc_html($filter_name->name); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
		<?php
		}

		public function render_loop_item() {
			$settings = $this->get_settings_for_display();
			$id       = 'bdt-wc-product-' . $this->get_id();
			if (isset($settings['is_replaced_deprecated_query']) && $settings['is_replaced_deprecated_query'] === 'yes') {
				$wp_query = $this->render_new_query($settings['posts_per_page']);
			} else {
				$wp_query = $this->render_query();
			}
			if ($wp_query->have_posts()) {

				$this->add_render_attribute('wc-products-wrapper', 'data-bdt-grid', '');

				if ($settings['masonry']) {
					$this->add_render_attribute('wc-products-wrapper', 'data-bdt-grid', 'masonry: true');
				}

				$this->add_render_attribute(
					[
						'wc-products-wrapper' => [
							'class' => [
								'bdt-wc-products-wrapper',
								'bdt-grid',
								'bdt-grid-medium',
								'bdt-child-width-1-' . $settings['columns_mobile'],
								'bdt-child-width-1-' . $settings['columns_tablet'] . '@s',
								'bdt-child-width-1-' . $settings['columns'] . '@m',
							],
							'id' => esc_attr($id),
						],
					]
				);

				if ($settings['grid_animation_type'] !== '') {
					$this->add_render_attribute('wc-products-wrapper', 'data-bdt-scrollspy', 'cls: bdt-animation-' . esc_attr($settings['grid_animation_type']) . ';');
					$this->add_render_attribute('wc-products-wrapper', 'data-bdt-scrollspy', 'delay: ' . esc_attr($settings['grid_anim_delay']['size']) . ';');
					$this->add_render_attribute('wc-products-wrapper', 'data-bdt-scrollspy', 'target: > div > .bdt-wc-product-inner' . ';');
				}

		?>
			<div <?php echo $this->get_render_attribute_string('wc-products-wrapper'); ?>>
				<?php

				$this->add_render_attribute('wc-product', 'class', 'bdt-wc-product');

				$this->add_render_attribute('bdt-wc-product-title', 'class', 'bdt-wc-product-title');

				while ($wp_query->have_posts()) : $wp_query->the_post();
					global $post, $product; ?>

					<?php if ($settings['show_filter_bar']) {
						$terms = get_the_terms(get_the_ID(), 'product_cat');
						$product_filter_cat = [];
						foreach ($terms as $term) {
							$product_filter_cat[] = 'bdtf-' . esc_attr($term->slug);
						};
						$this->add_render_attribute('wc-product', 'data-filter', implode(' ', $product_filter_cat), true);
					} ?>

					<div <?php echo $this->get_render_attribute_string('wc-product'); ?>>
						<div class="bdt-wc-product-inner">

							<?php if ($settings['show_badge'] and !$product->is_in_stock()) : ?>
								<div class="bdt-badge bdt-position-top-left bdt-position-small">
									<?php //woocommerce_show_product_loop_sale_flash();
									?>
									<?php echo apply_filters('woocommerce_product_is_in_stock', '<span class="bdt-onsale">' . esc_html__('Sold Out!', 'woocommerce') . '</span>', $post, $product); ?>
								</div>
							<?php elseif ($settings['show_badge'] and $product->is_on_sale()) : ?>
								<div class="bdt-badge bdt-position-top-left bdt-position-small">
									<?php //woocommerce_show_product_loop_sale_flash();
									?>
									<?php echo apply_filters('woocommerce_sale_flash', '<span class="bdt-onsale">' . esc_html__('Sale!', 'woocommerce') . '</span>', $post, $product); ?>
								</div>
							<?php endif; ?>

							<?php $this->render_image(); ?>

							<?php $this->render_quick_view($product->get_id()) ?>

							<div class="bdt-wc-product-desc">
								<?php if ('yes' == $settings['show_title']) : ?>
									<<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?> <?php echo $this->get_render_attribute_string('bdt-wc-product-title'); ?>>
										<a href="<?php the_permalink(); ?>" class="bdt-link-reset">
											<?php the_title(); ?>
										</a>
									</<?php echo Utils::get_valid_html_tag($settings['title_tags']); ?>>
								<?php endif; ?>

								<?php if (('yes' == $settings['show_price']) or ('yes' == $settings['show_rating'])) : ?>
									<?php if ('yes' == $settings['show_price']) : ?>
										<div class="bdt-wc-product-price">
											<?php woocommerce_template_single_price(); ?>
										</div>
									<?php endif; ?>

									<?php if ('yes' == $settings['show_rating']) : ?>
										<div class="bdt-wc-rating">
											<?php woocommerce_template_loop_rating(); ?>
										</div>
									<?php endif; ?>
								<?php endif; ?>
							</div>

						</div>
					</div>
				<?php endwhile;	?>
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
				echo '<div class="bdt-alert-warning" data-bdt-alert>' . esc_html__('Ops! There no product to display.', 'bdthemes-element-pack') . '<div>';
			}
		}

		public function render() {
			$this->render_header();
			$this->render_loop_item();
			$this->render_footer();
		}
	}
