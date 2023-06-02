<?php

namespace Elementor;

class BEW_Carousel_Products extends BEW_Settings {

	public function get_name() {
		return 'bew-elements-carousel-products';
	}
	
	public function get_title() {
		return __( 'Woo - Carousel', 'bosa-elementor-for-woocommerce' );
	}
	
	public function get_icon() {
		return 'bew-widget eicon-carousel';
	}
	
    protected function register_controls() {

		$this->start_controls_section(
			'bew_elements_carousel_products',
			[
				'label' => __( 'Slider', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->get_item_visibility( 'show_arrows', esc_html__( 'Arrows', 'bosa-elementor-for-woocommerce' ) );

		$this->get_item_visibility( 'dots', esc_html__( 'Dots', 'bosa-elementor-for-woocommerce' ) );

		$this->get_items_no_res( 'products_display_no', esc_html__( 'Products to Display', 'bosa-elementor-for-woocommerce' ), 6 );

		$this->get_items_no_res( 'products_scroll_no', esc_html__( 'Products to Scroll', 'bosa-elementor-for-woocommerce' ), 4, 1 );

		$this->get_item_visibility( 'auto_play', esc_html__( 'Auto Play', 'bosa-elementor-for-woocommerce' ), esc_html__( 'Yes', 'bosa-elementor-for-woocommerce' ), esc_html__( 'No', 'bosa-elementor-for-woocommerce' ) );

		$this->get_item_visibility( 'infinite_loop', esc_html__( 'Infinite Loop', 'bosa-elementor-for-woocommerce' ), esc_html__( 'Yes', 'bosa-elementor-for-woocommerce' ), esc_html__( 'No', 'bosa-elementor-for-woocommerce' ) );

		$this->get_items_no( 'transition_speed', esc_html__( 'Transition Speed (ms)', 'bosa-elementor-for-woocommerce' ), 5000, 2000 );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_carousel_products_query',
			[
				'label' => __( 'Query', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label' => esc_html__( 'Source', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'  => esc_html__( 'All Products', 'bosa-elementor-for-woocommerce' ),
					'custom-query' => esc_html__( 'Custom Query', 'bosa-elementor-for-woocommerce' ),
					'manual-selection' => esc_html__( 'Manual Selection', 'bosa-elementor-for-woocommerce' ),
				],
			]
		);

		$this->add_control(
			'cat_filter_rule',
			[
				'label' => esc_html__( 'Cat Filter Rule', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'match',
				'options' => [
					'match'  => esc_html__( 'Match Categories', 'bosa-elementor-for-woocommerce' ),
					'exclude' => esc_html__( 'Exclude Categories', 'bosa-elementor-for-woocommerce' ),
				],
				'condition' => [
					'source' => 'custom-query',
				],
			]
		);

		$this->add_control(
			'product_categories',
			[
				'label' => __( 'Select Categories', 'bosa-elementor-for-woocommerce' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => '',
				'options' => $this->_woocommerce_category(),
				'condition' => [
					'source' => 'custom-query',
				],
			]
		);

		$this->add_control(
			'tag_filter_rule',
			[
				'label' => esc_html__( 'Tag Filter Rule', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'match',
				'options' => [
					'match'  => esc_html__( 'Match Tags', 'bosa-elementor-for-woocommerce' ),
					'exclude' => esc_html__( 'Exclude Tags', 'bosa-elementor-for-woocommerce' ),
				],
				'condition' => [
					'source' => 'custom-query',
				],
			]
		);
		
		$this->add_control(
			'product_tags',
			[
				'label' => __( 'Select Tags', 'bosa-elementor-for-woocommerce' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => '',
				'options' => $this->get_woocommerce_tags(),
				'condition' => [
					'source' => 'custom-query',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label' => esc_html__( 'Offset', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 200,
				'step' => 1,
				'default' => '',
				'condition' => [
					'source' => 'custom-query',
				],
			]
		);

		$this->add_control(
			'exclude_products',
			[
				'label' => esc_html__( 'Exclude Products', 'bosa-elementor-for-woocommerce' ),
				'label_block' => true,
				'description' => esc_html__( 'Select products to exclude from the query.', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_woocommerce_products(),
				'default' => '',
				'condition' => [
					'source!' => ['manual-selection'],
				]
			]
		);

		$this->add_control(
			'manual_products',
			[
				'label' => esc_html__( 'Select Products', 'bosa-elementor-for-woocommerce' ),
				'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_woocommerce_products(),
				'default' => '',
				'condition' => [
					'source!' => ['all', 'custom-query'],
				]
			]
		);

		$this->add_control(
			'exclude_current_product',
			[
				'label' => esc_html__( 'Exclude Current Product', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'bosa-elementor-for-woocommerce' ),
				'label_off' => esc_html__( 'No', 'bosa-elementor-for-woocommerce' ),
				'return_value' => 'yes',
				'default' => '',
				'condition' => [
					'source!' => ['manual-selection'],
				]
			]
		);

		$this->get_items_no( 'items_no', esc_html__( 'Number of Products', 'bosa-elementor-for-woocommerce' ), 200 );

		$this->add_control(
			'advanced',
			[
				'label' => __('Advanced', 'bosa-elementor-for-woocommerce'),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'source!' => 'manual-selection',
				],
			]
		);

		$this->add_control(
			'filter_by',
			[
				'label' => esc_html__( 'Filter By', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'  => esc_html__( 'None', 'bosa-elementor-for-woocommerce' ),
					'featured' => esc_html__( 'Featured', 'bosa-elementor-for-woocommerce' ),
					'sale' => esc_html__( 'Sale', 'bosa-elementor-for-woocommerce' ),
				],
			]
		);

		$this->add_control(
			'order_by',
			[
				'label' => esc_html__( 'Order By', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'  		=> esc_html__( 'Date', 'bosa-elementor-for-woocommerce' ),
					'title' 		=> esc_html__( 'Title', 'bosa-elementor-for-woocommerce' ),
					'price' 		=> esc_html__( 'Price', 'bosa-elementor-for-woocommerce' ),
					'popularity' 	=> esc_html__( 'Popularity', 'bosa-elementor-for-woocommerce' ),
					'rating'		=> esc_html__( 'Rating', 'bosa-elementor-for-woocommerce' ),	
					'random'		=> esc_html__( 'Random', 'bosa-elementor-for-woocommerce' ),	
					'menu-order'	=> esc_html__( 'Menu Order', 'bosa-elementor-for-woocommerce' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc'  => esc_html__( 'ASC', 'bosa-elementor-for-woocommerce' ),
					'desc' => esc_html__( 'DESC', 'bosa-elementor-for-woocommerce' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_item_style',
			[
				'label' => __( 'Item', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products li.product', 'background-color' );

		$this->get_border_attr( 'item_border', '.bew-elements-carousel-products li.product' );

		$this->get_border_radius( 'item_border_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products li.product', 'border-radius' );

		$this->get_margin( 'item_margin', '.bew-elements-carousel-products li.product' );

		$this->get_padding( 'item_padding', '.bew-elements-carousel-products li.product' );

        $this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_img_style',
			[
				'label' => __( 'Image', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_border_attr( 'img_border', '.bew-elements-carousel-products li.product img' );

		$this->get_border_radius( 'img_border_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products li.product img', 'border-radius' );

		$this->get_margin( 'img_margin', '.bew-elements-carousel-products li.product img' );

		$this->get_padding( 'img_padding', '.bew-elements-carousel-products li.product img' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_title_style',
			[
				'label' => __( 'Title', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'title_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.product .woocommerce-loop-product__title', 'color' );

		$this->get_normal_color( 'hov_title_color', esc_html__( 'Hover Color', 'bosa-elementor-for-woocommerce' ), '.product:hover h2.woocommerce-loop-product__title', 'color' );

		$this->get_title_typography('title_typography', '.product .woocommerce-loop-product__title');

		$this->get_margin( 'title_margin', '.product .woocommerce-loop-product__title' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_price_style',
			[
				'label' => __( 'Price', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'price_color', esc_html__( 'Price Color', 'bosa-elementor-for-woocommerce' ), '.product .price', 'color' );

		$this->get_title_typography( 'price_typography', '.product .price .amount' );

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		

		$this->get_normal_color( 'del_price_color', esc_html__( 'Del Price Color', 'bosa-elementor-for-woocommerce' ), '.product .price del', 'color' );

		$this->get_title_typography( 'del_price_typography', '.product .price del .amount' );

		$this->get_margin( 'price_margin', '.bew-elements-carousel-products .price' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_rating_style',
			[
				'label' => __( 'Rating', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'rating_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce .owl-stage-outer ul.products li.product .star-rating:before', 'color' );

		$this->get_normal_color( 'carousel_rating_active_color', esc_html__( 'Active Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce .owl-stage-outer ul.products li.product .star-rating span:before', 'color' );

		$this->add_control(
			'carousel_rating_star_spacing',
			[
				'label' => esc_html__( 'Star Spacing', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 5,
						'step'	=> 0.5
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 1,
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .owl-stage-outer ul.products li.product .star-rating' => 'letter-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'carousel_rating_star_size',
			[
				'label' => esc_html__( 'Star Size', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 30,
						'step'	=> 1
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 14,
				],
				'selectors' => [
					'{{WRAPPER}} .woocommerce .owl-stage-outer ul.products li.product .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_button_style',
			[
				'label' => __( 'Button', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_typography( 'button_typography', '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external' );

		$this->start_controls_tabs(
			'button_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'btn_txt_color', esc_html__( 'Text Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external', 'color' );

		$this->get_normal_color( 'btn_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external', 'background-color' );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'btn_hov_txt_color', esc_html__( 'Text Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button:hover, .bew-elements-carousel-products a.product_type_grouped:hover, .bew-elements-carousel-products a.product_type_external:hover', 'color' );

		$this->get_normal_color( 'btn_hov_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button:hover, .bew-elements-carousel-products a.product_type_grouped:hover, .bew-elements-carousel-products a.product_type_external:hover', 'background-color' );

		$this->get_normal_color( 'btn_hov_border_color', esc_html__( 'Border Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button:hover, .bew-elements-carousel-products a.product_type_grouped:hover, .bew-elements-carousel-products a.product_type_external:hover', 'border-color' );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->get_border_attr( 'btn_border', '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external' );

		$this->get_border_radius( 'btn_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external', 'border-radius' );

		$this->get_margin( 'btn_margin', '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external' );

		$this->get_padding( 'btn_padding', '.bew-elements-carousel-products a.add_to_cart_button, .bew-elements-carousel-products a.product_type_grouped, .bew-elements-carousel-products a.product_type_external' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_sale_style',
			[
				'label' => __( 'Sale', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_typography( 'sale_typography', '.bew-elements-carousel-products .product .onsale' );

		$this->get_normal_color( 'sale_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products .product .onsale', 'background-color' );

		$this->get_normal_color( 'sale_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products .product .onsale', 'color' );

		$this->get_border_attr( 'sale_border', '.bew-elements-carousel-products .product .onsale' );

		$this->get_border_radius( 'sale_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products .product .onsale', 'border-radius' );

		$this->get_margin( 'sale_margin', '.bew-elements-carousel-products .product .onsale' );

		$this->get_padding( 'sale_padding', '.bew-elements-carousel-products .product .onsale' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_icon_group_style',
			[
				'label' => __( 'Icon Group', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'carousel_icon_group_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products .product-compare-wishlist a i', 'background-color' );

		$this->get_normal_color( 'carousel_icon_group_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-carousel-products .product-compare-wishlist a i', 'color' );

		$this->end_controls_section();

	}

	protected function render() {
		global $post;
        $settings       			= $this->get_settings_for_display();
		$source						= $settings['source'];
		$cat_filter_rule 			= $settings['cat_filter_rule'];
		$tag_filter_rule			= $settings['tag_filter_rule'];
		$exclude_products			= $settings['exclude_products'];
		$exclude_current_product 	= $settings['exclude_current_product'];
		$manual_products			= $settings['manual_products'];
        $arrows 					= ( $settings['show_arrows'] == 'yes' ) ? true : false;
		$dots 						= ( $settings['dots'] == 'yes' ) ? true : false;
		$auto_play          		= ( $settings['auto_play'] == 'yes' ) ? true : false;
		$infinite_loop 				= ( $settings['infinite_loop'] == 'yes' ) ? true : false;
		$transition_speed   		= $settings['transition_speed'];
		$products_no 				= $settings['items_no'];
		$filter_by 					= $settings['filter_by'];
		$order_by					= $settings['order_by'];
		$order						= $settings['order'];
		$offset						= $settings['offset'];
		$product_categories 		= $settings['product_categories'];
		$product_tags				= $settings['product_tags'];
		if( isset( $settings['products_scroll_no']['size'] ) && ( $settings['products_scroll_no']['size'] != '' ) ) {
			$products_scroll_no = $settings['products_scroll_no']['size'];
		} else {
			$products_scroll_no = 1;
		}
		if( isset( $settings['products_scroll_no_tablet']['size'] ) ) {
			$products_scroll_no_tablet = $settings['products_scroll_no_tablet']['size'];
		} else {
			$products_scroll_no_tablet = 1;
		}
		if( isset( $settings['products_scroll_no_mobile']['size'] ) ) {
			$products_scroll_no_mobile = $settings['products_scroll_no_mobile']['size'];
		} else {
			$products_scroll_no_mobile = 1;
		}

		// print_r( $settings );
		if( isset( $settings['products_display_no']['size'] ) && ( $settings['products_display_no']['size'] != '' ) ) {
			$products_display_no = $settings['products_display_no']['size'];
		} else {
			$products_display_no = 4;
		}
		if( isset( $settings['products_display_no_tablet']['size'] ) && ( $settings['products_display_no_tablet']['size'] != '' ) ) {
			$products_display_no_tablet = $settings['products_display_no_tablet']['size'];
		} else {
			$products_display_no_tablet = 3;
		}
		if( isset( $settings['products_display_no_mobile']['size'] ) && ( $settings['products_display_no_mobile']['size'] != '' ) ) {
			$products_display_no_mobile = $settings['products_display_no_mobile']['size'];
		} else {
			$products_display_no_mobile = 3;
		}


		if( $source === 'all' ) {
			$args = array(
						'post_type' 		=> 'product',
						'posts_per_page'	=> $products_no,
					);
			if( isset( $exclude_products ) && !empty( $exclude_products ) ) {
				$args['post__not_in'] = $exclude_products;
			}
			if( isset( $exclude_current_product ) && $exclude_current_product == 'yes' ) {
				$args['post__not_in'][] = $post->ID;
			}
			if( $filter_by === 'none' || $filter_by === 'sale' ) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					)
				); 
			}
			if( $filter_by === 'featured' ) {
				$args['tax_query'] = array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'product_visibility',
											'field' => 'name',
											'terms'    => 'featured',
										), 
										array(
											'taxonomy' => 'product_visibility',
											'field' => 'name',
											'terms' => 'exclude-from-catalog',
											'operator' => 'NOT IN',
										)
									);
			}
			if( $filter_by === 'sale' ) {
				$args['meta_query'] = array(
										'relation' => 'OR',
										array( // Simple products type
											'key'           => '_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										),
										array( // Variable products type
											'key'           => '_min_variation_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										)
									);
			}
		} else if( $source === 'custom-query' ) {
			$args = array(
				'post_type' 		=> 'product',
				'posts_per_page'	=> $products_no,
			);
			if( $filter_by === 'sale' ) {
				$args['meta_query'] = array(
										'relation' => 'OR',
										array( // Simple products type
											'key'           => '_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										),
										array( // Variable products type
											'key'           => '_min_variation_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										)
									);
			}
			if( $cat_filter_rule === 'match' && $tag_filter_rule === 'match' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
					array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'product_cat',
							'terms' => $product_categories,
							'operator' => 'IN',
						),
						array(
							'taxonomy' => 'product_tag',
							'terms' => $product_tags,
							'operator' => 'IN',
						)
					)
				);
			} else if( $cat_filter_rule === 'match' && $tag_filter_rule === 'exclude' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'terms' => $product_categories,
						'operator' => 'IN',
					),
					array(
						'taxonomy' => 'product_tag',
						'terms' => $product_tags,
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
				);
			} else if( $cat_filter_rule === 'exclude' && $tag_filter_rule === 'match' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
					array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'product_cat',
							'terms' => $product_categories,
							'operator' => 'NOT IN',
						),
						array(
							'taxonomy' => 'product_tag',
							'terms' => $product_tags,
							'operator' => 'IN',
						)
					)
				);
			} else if( $cat_filter_rule === 'exclude' && $tag_filter_rule === 'exclude' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_cat',
						'terms' => $product_categories,
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_tag',
						'terms' => $product_tags,
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
				);
			} 
			if( isset( $exclude_products ) && !empty( $exclude_products ) ) {
				$args['post__not_in'] = $exclude_products;
			}
			if( isset( $exclude_current_product ) && $exclude_current_product == 'yes' ) {
				$args['post__not_in'][] = $post->ID;
			}
			if( isset( $offset ) && !empty( $offset ) ) {
				$args['offset'] = $offset;
			}

			if( $cat_filter_rule === 'match' && $tag_filter_rule === 'match' && $filter_by === 'featured' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'product_cat',
							'terms' => $product_categories,
							'operator' => 'IN',
						),
						array(
							'taxonomy' => 'product_tag',
							'terms' => $product_tags,
							'operator' => 'IN',
						),
					),					
					array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_visibility',
							'field' => 'name',
							'terms'    => 'featured',
						), 
						array(
							'taxonomy' => 'product_visibility',
							'field' => 'name',
							'terms' => 'exclude-from-catalog',
							'operator' => 'NOT IN',
						),
					)
				);
			}
			
			if( $cat_filter_rule === 'match' && $tag_filter_rule === 'exclude' && $filter_by === 'featured' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms'    => 'featured',
					), 
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_cat',
						'terms' => $product_categories,
						'operator' => 'IN',
					),
					array(
						'taxonomy' => 'product_tag',
						'terms' => $product_tags,
						'operator' => 'NOT IN',
					)
				);
			}

			if( $cat_filter_rule === 'exclude' && $tag_filter_rule === 'match' && $filter_by === 'featured' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array( 
						'relation' => 'AND',
						array(
							'taxonomy' => 'product_visibility',
							'field' => 'name',
							'terms'    => 'featured',
						), 
						array(
							'taxonomy' => 'product_visibility',
							'field' => 'name',
							'terms' => 'exclude-from-catalog',
							'operator' => 'NOT IN',
						),
					),
					array(
						'relation' => 'OR',
						array(
							'taxonomy' => 'product_cat',
							'terms' => $product_categories,
							'operator' => 'NOT IN',
						),
						array(
							'taxonomy' => 'product_tag',
							'terms' => $product_tags,
							'operator' => 'IN',
						)
					)
				);
			}

			if( $cat_filter_rule === 'exclude' && $tag_filter_rule === 'exclude' && $filter_by === 'featured' ) {
				$args['tax_query'] = array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms'    => 'featured',
					), 
					array(
						'taxonomy' => 'product_visibility',
						'field' => 'name',
						'terms' => 'exclude-from-catalog',
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_cat',
						'terms' => $product_categories,
						'operator' => 'NOT IN',
					),
					array(
						'taxonomy' => 'product_tag',
						'terms' => $product_tags,
						'operator' => 'NOT IN',
					)
				);
			}

		} else {
			$args = array(
						'post_type' 		=> 'product',
						'posts_per_page'	=> $products_no,
						'post__in'			=> $manual_products,
					);
			if( $filter_by === 'none' || $filter_by === 'sale' ) {
				$args['tax_query'] = array(
										array(
											'taxonomy' => 'product_visibility',
											'field' => 'name',
											'terms' => 'exclude-from-catalog',
											'operator' => 'NOT IN',
										)
									);
			}
			if( $filter_by === 'featured' ) {
				$args['tax_query'] = array(
										'relation' => 'AND',
										array(
											'taxonomy' => 'product_visibility',
											'field' => 'name',
											'terms'    => 'featured',
										), 
										array(
											'taxonomy' => 'product_visibility',
											'field' => 'name',
											'terms' => 'exclude-from-catalog',
											'operator' => 'NOT IN',
										)
									);
			}
			if( $filter_by === 'sale' ) {
				$args['meta_query'] = array(
										'relation' => 'OR',
										array( // Simple products type
											'key'           => '_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										),
										array( // Variable products type
											'key'           => '_min_variation_sale_price',
											'value'         => 0,
											'compare'       => '>',
											'type'          => 'numeric'
										)
									);
			}
		}

		switch( $order_by ) {
			case 'date':
				$args['orderby'] 	= 'date';
				$args['order'] 		= $order;
				break;
			case 'title':
				$args['orderby'] 	= 'title';
				$args['order'] 		= $order;
				break;
			case 'price':
				$args['orderby'] 	= 'meta_value_num';
				$args['meta_key'] 	= '_price';
				$args['order'] 		= $order;
				break;
			case 'popularity':
				$args['orderby'] 	= 'meta_value_num';
				$args['meta_key'] 	= 'total_sales';
				$args['order'] 		= $order;
				break;
			case 'rating':
				$args['orderby'] 	= 'meta_value_num';
				$args['meta_key'] 	= '_wc_average_rating';
				$args['order'] 		= $order;
				break;
			case 'random':
				$args['orderby'] = 'rand';
				break;
			case 'menu-order':
				$args['orderby'] 	= 'menu_order title';
				$args['order'] 		= $order;
				break;
		}

		?>

		<div class="bew-elements-widgets bew-elements-carousel-products owl-carousel" <?php echo $this->get_column_attr($settings); ?> slider-products="<?php echo esc_attr( $products_display_no ); ?>" slider-products-tablet="<?php echo esc_attr( $products_display_no_tablet ); ?>" slider-products-mobile="<?php echo esc_attr( $products_display_no_mobile ) ?>" products-scroll="<?php echo esc_attr( $products_scroll_no ); ?>" products-scroll-tablet="<?php echo esc_attr( $products_scroll_no_tablet ); ?>" products-scroll-mobile="<?php echo esc_attr( $products_scroll_no_mobile ); ?>" slider-arrows="<?php echo esc_attr( $arrows ); ?>" slider-dots="<?php echo esc_attr( $dots ); ?>" auto-play="<?php echo esc_attr( $auto_play ); ?>" infinite-loop="<?php echo esc_attr( $infinite_loop ); ?>" transition-speed="<?php echo esc_attr( $transition_speed ); ?>">
            <?php	
                
                $products_loop = new \WP_Query( $args );
				
                if ( $products_loop->have_posts() ) { 
                	while ( $products_loop->have_posts() ) : $products_loop->the_post(); ?>
                		<ul class="bew-products-carousel">
                			<?php
                			global $product;

							// Ensure visibility.
							if ( empty( $product ) || ! $product->is_visible() ) {
								return;
							}
							?>
							<li <?php wc_product_class( '', $product ); ?>>
								<div class="product-inner text-center">
									<figure class="woo-product-image">
										<?php
										woocommerce_template_loop_product_link_open();
										woocommerce_show_product_loop_sale_flash();
										woocommerce_template_loop_product_thumbnail();
										woocommerce_template_loop_product_link_close();

										do_action( 'bew_yith_icon_group' );
										?>
									</figure>
									<div class="product-inner-contents woocommerce">
										<?php 
										woocommerce_template_loop_product_link_open();
										woocommerce_template_loop_product_title();
										woocommerce_template_loop_rating();
										woocommerce_template_loop_price();
										
										woocommerce_template_loop_product_link_close();
										?>
									</div>
									<div class="button-cart_button">
										<?php
										woocommerce_template_loop_add_to_cart();
										?>
									</div>
								</div>
							</li>
                    	</ul>
                    <?php endwhile;
                } else {
                    echo __( 'No products found' );
                }
                \wp_reset_postdata();
            ?>
      	</div>
	
	<?php

	}
	
}