<?php

namespace Elementor;

class BEW_Products extends BEW_Settings {
	
	public function get_name() {
		return 'bew-elements-products';
	}
	
	public function get_title() {
		return __( 'Woo - Products', 'bosa-elementor-for-woocommerce' );
	}
	
	public function get_icon() {
		return 'bew-widget eicon-products';
	}
	
    protected function register_controls() {

		$this->start_controls_section(
			'bew_elements_products',
			[
				'label' => __( 'Content', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_items_no('items_no', __("Number of Products", 'bosa-elementor-for-woocommerce'));

		$this->get_items_no_res( 'column_no', esc_html__( 'Number of Columns', 'bosa-elementor-for-woocommerce' ), 6 );

		$this->get_item_visibility('pagination', __("Pagination", 'bosa-elementor-for-woocommerce'));

		$this->add_control(
			'pagination_position',
			[
				'label' => __('Pagination Position', 'bosa-elementor-for-woocommerce'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __('Left', 'bosa-elementor-for-woocommerce'),
						'icon' => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __('Center', 'bosa-elementor-for-woocommerce'),
						'icon' => 'eicon-h-align-center',
					],
					'right' => [
						'title' => __('Right', 'bosa-elementor-for-woocommerce'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.page-numbers' => 'text-align: {{VALUE}};',
				],
				'default' => 'center',
				'condition' => [
					'pagination' => 'yes',
				],
			]
		);

		$this->get_item_visibility( 'products_grid_equal_heights', esc_html__( 'Equal Heights', 'bosa-elementor-for-woocommerce' ), esc_html__( 'Yes', 'bosa-elementor-for-woocommerce' ), esc_html__( 'No', 'bosa-elementor-for-woocommerce' ), $default="no" );
		
		$this->get_item_visibility( 'products_rating_stars', esc_html__( 'Rating', 'bosa-elementor-for-woocommerce' ), esc_html__( 'Yes', 'bosa-elementor-for-woocommerce' ), esc_html__( 'No', 'bosa-elementor-for-woocommerce' ), $default="yes" );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_style',
			[
				'label' => __( 'Item', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product', 'background-color' );

		$this->get_border_attr( 'item_border', '.woocommerce ul.products li.product' );

		$this->get_border_radius( 'item_border_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product', 'border-radius' );

		$this->get_margin( 'item_margin', '.woocommerce ul.products li.product' );

		$this->get_padding( 'item_padding', '.woocommerce ul.products li.product' );

        $this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_img_style',
			[
				'label' => __( 'Image', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_border_attr( 'img_border', '.woocommerce ul.products li.product img' );

		$this->get_border_radius( 'img_border_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product img', 'border-radius' );

		$this->get_margin( 'img_margin', '.woocommerce ul.products li.product img' );

		$this->get_padding( 'img_padding', '.woocommerce ul.products li.product img' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_title',
			[
				'label' => __( 'Title', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'title_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .woocommerce-loop-product__title', 'color' );

		$this->get_normal_color( 'hov_title_color', esc_html__( 'Hover Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.product:hover h2.woocommerce-loop-product__title', 'color' );

		$this->get_title_typography( 'title_typography', '.woocommerce ul.products li.product .woocommerce-loop-product__title' );

		$this->get_margin( 'title_margin', '.woocommerce ul.products li.product .woocommerce-loop-product__title' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_price',
			[
				'label' => __( 'Price', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'price_color', esc_html__( 'Price Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .price', 'color' );

		$this->get_title_typography( 'price_typography', '.woocommerce ul.products li.product .price .amount' );

		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);		

		$this->get_normal_color( 'del_price_color', esc_html__( 'Del Price Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .price del', 'color' );

		$this->get_title_typography( 'del_price_typography', '.woocommerce ul.products li.product .price del .amount' );

		$this->get_margin( 'price_margin', '.woocommerce ul.products li.product .price' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_rating',
			[
				'label' => __( 'Rating', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_normal_color( 'rating_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .star-rating:before', 'color' );

		$this->get_normal_color( 'rating_active_color', esc_html__( 'Active Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .star-rating span:before', 'color' );

		$this->add_control(
			'rating_star_spacing',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'letter-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_star_size',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .star-rating' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_button',
			[
				'label' => __( 'Button', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_typography( 'button_typography', '.bew-elements-products a.button, .bew-elements-products a.product_type_grouped, .bew-elements-products a.product_type_external' );

		$this->start_controls_tabs(
			'button_tabs'
		);

		$this->start_controls_tab(
			'button_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'btn_txt_color', esc_html__( 'Text Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external', 'color' );

		$this->get_normal_color( 'btn_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external', 'background-color' );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'button_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'btn_hov_txt_color', esc_html__( 'Text Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.button:hover, {{WRAPPER}} .bew-elements-products a.product_type_grouped:hover, {{WRAPPER}} .bew-elements-products a.product_type_external:hover', 'color' );

		$this->get_normal_color( 'btn_hov_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.button:hover, {{WRAPPER}} .bew-elements-products a.product_type_grouped:hover, {{WRAPPER}} .bew-elements-products a.product_type_external:hover', 'background-color' );

		$this->get_normal_color( 'btn_hov_border_color', esc_html__( 'Border Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.button:hover, {{WRAPPER}} .bew-elements-products a.product_type_grouped:hover, {{WRAPPER}} .bew-elements-products a.product_type_external:hover', 'border-color' );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

		$this->get_border_attr( 'btn_border', '.bew-elements-products a.add_to_cart_button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external' );

		$this->get_border_radius( 'btn_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products a.add_to_cart_button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external', 'border-radius' );

		$this->get_margin( 'btn_margin', '.bew-elements-products a.add_to_cart_button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external' );

		$this->get_padding( 'btn_padding', '.bew-elements-products a.add_to_cart_button, {{WRAPPER}} .bew-elements-products a.product_type_grouped, {{WRAPPER}} .bew-elements-products a.product_type_external' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_sale',
			[
				'label' => __( 'Sale', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->get_title_typography( 'sale_typography', '.bew-elements-products .product .onsale' );

		$this->get_normal_color( 'sale_bg_color', esc_html__( 'Background Color', 'bosa-elementor-for-woocommerce' ), '.bew-elements-products .product .onsale', 'background-color' );

		$this->get_normal_color( 'sale_color', esc_html__( 'Color', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .onsale', 'color' );

		$this->get_border_attr( 'sale_border', '.woocommerce ul.products li.product .onsale' );

		$this->get_border_radius( 'sale_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), '.woocommerce ul.products li.product .onsale', 'border-radius' );

		$this->get_margin( 'sale_margin', '.woocommerce ul.products li.product .onsale' );

		$this->get_padding( 'sale_padding', '.woocommerce ul.products li.product .onsale' );

		$this->end_controls_section();

		$this->start_controls_section(
			'bew_elements_products_pagination',
			[
				'label' => __( 'Pagination', 'bosa-elementor-for-woocommerce' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'pagination_typography',
				'selector' => '{{WRAPPER}} ul.page-numbers .page-numbers',
			]
		);

		$this->start_controls_tabs(
			'pagination_tabs'
		);
		
		$this->start_controls_tab(
			'pagination_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'pagination_color', 'Color', 'ul.page-numbers .page-numbers', 'color' );

		$this->get_normal_color( 'pagination_background_color', 'Background Color', 'ul.page-numbers .page-numbers', 'background-color' );
		
		$this->end_controls_tab();

		$this->start_controls_tab(
			'pagination_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'bosa-elementor-for-woocommerce' ),
			]
		);

		$this->get_normal_color( 'pagination_hover_color', 'Color', 'ul.page-numbers .page-numbers:hover, {{WRAPPER}} ul.page-numbers .page-numbers.current', 'color' );

		$this->get_normal_color( 'pagination_hover_background_color', 'Background Color', 'ul.page-numbers .page-numbers:hover, {{WRAPPER}} ul.page-numbers .page-numbers.current', 'background-color' );

		$this->get_normal_color( 'pagination_hover_border_color', 'Border Color', 'ul.page-numbers .page-numbers:hover, {{WRAPPER}} ul.page-numbers .page-numbers.current', 'border-color' );
		
		$this->end_controls_tab();
		
		$this->end_controls_tabs();

		$this->add_control(
			'pagination_heading',
			[
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'pagination_border',
				'label' => esc_html__( 'Border', 'bosa-elementor-for-woocommerce' ),
				'selector' => '{{WRAPPER}} ul.page-numbers .page-numbers',
			]
		);

		$this->get_border_radius( 'pagination_border_radius', esc_html__( 'Border Radius', 'bosa-elementor-for-woocommerce' ), 'ul.page-numbers .page-numbers', 'border-radius' );

		$this->end_controls_section();
	}

	protected function render() {
        $settings       	= $this->get_settings_for_display();
        $products_no        = $settings['items_no'];
        $wrapper_classes = array();
		if('yes' === $settings['products_grid_equal_heights']) {
			$wrapper_classes[] = 'bew-match-height-product-grid';
		}
		if('yes' !== $settings['products_rating_stars']) {
			$wrapper_classes[] = 'bew-hide-product-rating';
		}
		$wrapper_classes = implode(' ', $wrapper_classes);
		?>
		<div class="bew-elements-widgets bew-elements-products-container woocommerce" <?php echo $this->get_column_attr($settings); ?>>
            <div class="bew-elements-products <?php echo esc_attr($wrapper_classes); ?>">
            	<?php
	                $args = array(
						'post_type' => 'product',
						'posts_per_page' => $products_no,
					);

					if ('yes' === $settings['pagination']) {

						// Paged
						global $paged;
						if (get_query_var('paged')) {
							$paged = get_query_var('paged');
						} else if (get_query_var('page')) {
							$paged = get_query_var('page');
						} else {
							$paged = 1;
						}
			
						$args['posts_per_page'] = $products_no;
			
						if (1 < $paged) {
							$args['paged'] = $paged;
						}
					}

	                $products_loop = new \WP_Query( $args );
	                if ( $products_loop->have_posts() ) {
						woocommerce_product_loop_start();
	                    while ( $products_loop->have_posts() ) : $products_loop->the_post();
	                        wc_get_template_part( 'content', 'product' );
	                    endwhile;
						woocommerce_product_loop_end();

						// Display pagination if enabled
						if ('yes' == $settings['pagination']) {
							$this->bew_pagination($products_loop);
						}
				
						woocommerce_reset_loop();

	                } else {
	                    echo __( 'No products found' );
	                }
	                \wp_reset_postdata();
	            ?>
            </div>
      	</div>
	<?php

	}
}