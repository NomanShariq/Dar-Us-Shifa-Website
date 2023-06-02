<?php

namespace Elementor;

/**
 * Elementor common class to use same field on multiple times
 * 
 * @since Bosa Elementor Addons for WooCommerce 1.0.0
 */
abstract class BEW_Settings extends Widget_Base {
	
	/**
     * Elementor Category
     * 
     * @since Bosa Elementor Addons for WooCommerce 1.0.0
     */
	public function get_categories() {
		return [ 'bosa-elementor-for-woocommerce' ];
	}

	public function get_items_no_res( $id = null, $label = null, $max = 4, $desktop_default = 4 ) {
		$this->add_responsive_control(
			$id,
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => $max,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'desktop_default' => [
					'size' => $desktop_default,
				],
				'tablet_default' => [
					'size' => 3,
				],
				'mobile_default' => [
					'size' => 1
				],
			]
		);
	}

	public function get_post_categories(){
		$this->add_control(
			'posts_categories',
			[
				'label' => __( 'Select Categories', 'bosa-elementor-for-woocommerce' ),
                'label_block' => true,
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [ '1' ],
				'options' => $this->_posts_categories(),
			]
		);
	}

	public function get_items_no( $id="items_no", $label = 'Number of Posts', $max = 100, $default = 10 ){
		$this->add_control(
			$id,
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'max' => $max,
				'step' => 1,
				'default' => $default,
				
			]
		);
	}

	public function get_item_visibility( $id = null, $label = null, $label_on = 'Show', $label_off = 'Hide', $default='no' ) {
		$this->add_control(
			$id,
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => $label_on,
				'label_off' => $label_off,
				'return_value' => 'yes',
				'default' => $default
			]
		);
	}

	public function get_title_typography($name = null, $selector = null) {
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => $name,
				'label' => __( 'Typography', 'bosa-elementor-for-woocommerce' ),
				'selector' => '{{WRAPPER}} ' . $selector,
				'fields_options' => [
					'typography' => ['default' => 'yes'],
					'font_family' => ['default' => 'Jost'],
				],
			]
		);
	}

	public function get_normal_color($name = null, $label = null, $selector = null, $property = null) {
		$this->add_control(
			$name,
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $selector => $property . ': {{VALUE}}',
				],
			]
		);
	}

	public function get_title_hover_color($selector = null) {
		$this->add_control(
			'hov_title_color',
			[
				'label' => esc_html__( 'Hover Color', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} ' . $selector => 'color: {{VALUE}}',
				],
			]
		);
	}

	public function get_border_attr($name = null, $selector = null) {
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => $name,
				'label' => esc_html__( 'Border', 'bosa-elementor-for-woocommerce' ),
				'selector' => '{{WRAPPER}} ' . $selector,
			]
		);
	}

	public function get_border_radius($name = null, $label = null, $selector = null, $property = 'border-radius') {
		$this->add_control(
			$name,
			[
				'label' => $label,
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ' . $selector => $property . ': {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public function get_margin($name = null, $selector = null) {
		$this->add_control(
			$name,
			[
				'label' => esc_html__( 'Margin', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ' . $selector => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	public function get_padding($name = null, $selector = null) {
		$this->add_control(
			$name,
			[
				'label' => esc_html__( 'Padding', 'bosa-elementor-for-woocommerce' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

    public function get_column_attr($settings){

        if(isset($settings['column_no']['size']) && !empty($settings['column_no']['size'])) {
			$desktop_col_no			= $settings['column_no']['size'];
		} else {
			$desktop_col_no			= '3';
		}
		if(isset($settings['column_no_tablet']['size']) && !empty($settings['column_no_tablet']['size'])) {
			$tablet_col_no          = $settings['column_no_tablet']['size'];
		} else {
			$tablet_col_no          = '3';
		}
		if(isset($settings['column_no_mobile']['size']) && !empty($settings['column_no_mobile']['size'])) {
			$mobile_col_no          = $settings['column_no_mobile']['size'];
		} else {
			$mobile_col_no          = '1';
		}

        return 'desktop-col="'.esc_attr( $desktop_col_no ).'" tablet-col="'.esc_attr( $tablet_col_no ).'" mobile-col="'. esc_attr( $mobile_col_no ).'"';

    }

	public function _woocommerce_category( $only_top_level = false ){

		$taxonomy     = 'product_cat';
		$orderby      = 'name';  
		$show_count   = 0;      // 1 for yes, 0 for no
		$pad_counts   = 0;      // 1 for yes, 0 for no
		$hierarchical = 1;      // 1 for yes, 0 for no  
		$title        = '';  
		$empty        = false;
		$args = array(
			'taxonomy'     => $taxonomy,
			'orderby'      => $orderby,
			'show_count'   => $show_count,
			
			'title_li'     => $title,
			'hide_empty'   => $empty
		);

		$woocommerce_categories = array();
		if( $only_top_level ) $woocommerce_categories[0] = __( 'Only Top Level', 'bosa-elementor-for-woocommerce' );
		$woocommerce_categories_obj = get_categories( $args );
		foreach( $woocommerce_categories_obj as $category ) {
			$woocommerce_categories[$category->term_id] = $category->name;
		}

		return $woocommerce_categories;
	}

	public function _posts_categories() {
		$blog_categories    			= [];
        $blog_categories_list 			= get_categories();
        foreach( $blog_categories_list as $blog_category ) {
            $blog_categories[$blog_category->cat_ID] = $blog_category->name;
        }
		return $blog_categories;
	}

	public function _contact_form_list() {
		$args = array(
				'numberposts' => 10,
				'post_type'   => 'wpcf7_contact_form'
			);
		$contact_forms = get_posts( $args );
		$contact_form_list = [];
		$contact_form_list[] = __( '- Select Contact Form -', 'bosa-elementor-for-woocommerce' );

		foreach( $contact_forms as $contact_form ) {
			$contact_form_list[$contact_form->ID] = $contact_form->post_title;
		}
		return $contact_form_list;
	}

	public function get_woocommerce_uncategorized_id() {
		$uncategorized_term_id = [];
		$uncategorized_term_id[0] = get_option( 'default_product_cat' );
		return $uncategorized_term_id;
	}	

	public function get_woocommerce_tags() {
		$terms = get_terms( 'product_tag' );
		$term_array = [];
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
			foreach ( $terms as $term ) {
				$term_array[$term->term_id] = $term->name;
			}
		}
		return $term_array;
	}

	public function get_woocommerce_products() {
		$args = array( 'post_type' => 'product', 'posts_per_page' => -1 );
		$products = new \WP_Query( $args );
		$products_list = [];
		while ( $products->have_posts() ) : $products->the_post();
			$products_list[get_the_ID()] = get_the_title();
		endwhile;
		\wp_reset_query();
		return $products_list;
	}


	/**
	 * Numbered Pagination
	 *
	 * @since	1.0.0
	 * @link	https://codex.wordpress.org/Function_Reference/paginate_links
	 */
	function bew_pagination($query = '', $echo = true) {

		// Arrows with RTL support
		$prev_arrow = is_rtl() ? 'fa fa-angle-right' : 'fa fa-angle-left';
		$next_arrow = is_rtl() ? 'fa fa-angle-left' : 'fa fa-angle-right';

		// Get global $query
		if (!$query) {
			global $wp_query;
			$query = $wp_query;
		}

		// Set vars
		$total = $query->max_num_pages;
		$big = 999999999;

		// Display pagination if total var is greater then 1 (current query is paginated)
		if ($total > 1) {

			// Get current page
			if ($current_page = get_query_var('paged')) {
				$current_page = $current_page;
			} elseif ($current_page = get_query_var('page')) {
				$current_page = $current_page;
			} else {
				$current_page = 1;
			}

			// Get permalink structure
			if (get_option('permalink_structure')) {
				if (is_page()) {
					$format = 'page/%#%/';
				} else {
					$format = '/%#%/';
				}
			} else {
				$format = '&paged=%#%';
			}

			$args = apply_filters('bew_pagination_args', array(
				'base' => str_replace($big, '%#%', html_entity_decode(get_pagenum_link($big))),
				'format' => $format,
				'current' => max(1, $current_page),
				'total' => $total,
				'mid_size' => 3,
				'type' => 'list',
				'prev_text' => '<i class="' . $prev_arrow . '"></i>',
				'next_text' => '<i class="' . $next_arrow . '"></i>',
			));

			// Output pagination
			if ($echo) {
				echo '<div class="bew-pagination clr">' . wp_kses_post(paginate_links($args)) . '</div>';
			} else {
				return '<div class="bew-pagination clr">' . wp_kses_post(paginate_links($args)) . '</div>';
			}
		}
	}

	public function get_img_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();
	    $get_intermediate_image_sizes = get_intermediate_image_sizes();
	 
	    // Create the full array with sizes and crop info
	    foreach($get_intermediate_image_sizes as $_size) {
	        if(in_array($_size, array('thumbnail', 'medium', 'medium_large', 'large'))) {
	            $sizes[ $_size ]['width'] 	= get_option($_size . '_size_w');
	            $sizes[ $_size ]['height'] 	= get_option($_size . '_size_h');
	            $sizes[ $_size ]['crop'] 	= (bool) get_option($_size . '_crop');
	        } elseif(isset($_wp_additional_image_sizes[ $_size ])) {
	            $sizes[ $_size ] = array(
	                'width' 	=> $_wp_additional_image_sizes[ $_size ]['width'],
	                'height' 	=> $_wp_additional_image_sizes[ $_size ]['height'],
	                'crop' 		=> $_wp_additional_image_sizes[ $_size ]['crop'],
	           );
	        }
	    }

	    $image_sizes = array();

		foreach($sizes as $size_key => $size_attributes) {
			$image_sizes[ $size_key ] = ucwords(str_replace('_', ' ', $size_key)) . sprintf(' - %d x %d', $size_attributes['width'], $size_attributes['height']);
		}

		$image_sizes['full'] 	= _x('Full', 'Image Size Control', 'etww');

	    return $image_sizes;
	}

	

}