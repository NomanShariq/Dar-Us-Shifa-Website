<?php
namespace ElementPack\Modules\GoogleReviews\Widgets;

use Elementor\Plugin;
use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Google_Reviews extends Module_Base {

	protected $google_place_url = "https://maps.googleapis.com/maps/api/place/";

	public function get_name() {
		return 'bdt-google-reviews';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Google Reviews', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-google-reviews';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'Google', 'Reviews', 'Google Reviews' ];
	}
	
	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['element-pack-font', 'ep-google-reviews'];
        }
    }

	public function get_custom_help_url() {
		return 'https://youtu.be/pp0mQpyKqfs';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
            'google_place_id',
            [
                'label'       => esc_html__( 'Place ID', 'bdthemes-element-pack' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Google Place ID', 'bdthemes-element-pack' ),
                'description' => sprintf( __( 'Click %1s HERE %2s to find place ID  ', 'bdthemes-element-pack' ), '<a href="https://developers-dot-devsite-v2-prod.appspot.com/maps/documentation/javascript/examples/full/places-placeid-finder" target="_blank">', '</a>' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
			'cache_reviews',
			[
				'label'   => esc_html__( 'Cache Reviews', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

        $this->add_control(
            'refresh_reviews',
            array(
                'label'   => __( 'Reload Reviews after a', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'day',
                'options' => array(
                    'hour'  => __( 'Hour', 'bdthemes-element-pack' ),
                    'day'   => __( 'Day', 'bdthemes-element-pack' ),
                    'week'  => __( 'Week', 'bdthemes-element-pack' ),
                    'month' => __( 'Month', 'bdthemes-element-pack' ),
                    'year'  => __( 'Year', 'bdthemes-element-pack' ),
                ),
                'condition' => [
                	'cache_reviews' => 'yes'
                ]
            )
        );

		$this->add_control(
			'review_message',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => __( 'Note: You can show only 5 most popular review right now.', 'bdthemes-element-pack' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [
                	'cache_reviews' => 'yes'
                ]

			]
		);
		
		$this->add_control(
			'show_image',
			[
				'label'   => esc_html__( 'Show Image', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_time',
			[
				'label'   => esc_html__( 'Show Time', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_name',
			[
				'label'   => esc_html__( 'Show Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_rating',
			[
				'label'   => esc_html__( 'Show Rating', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label'   => esc_html__( 'Show Excerpt', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
        );

		$this->add_control(
			'excerpt_limit',
			[
				'label'     => esc_html__( 'Excerpt Limit', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 55,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);
		
        $this->end_controls_section();
        
		$this->start_controls_section(
			'section_content_additonal',
			[
				'label' => esc_html__( 'Additional', 'bdthemes-element-pack' ),
			]
		);

		$languageArr = array(
            ''=>'Language disable',
            'ar'=> 'Arabic',
            'bg'=> 'Bulgarian',
            'bn'=> 'Bengali',
            'ca'=> 'Catalan',
            'cs'=> 'Czech',
            'da'=> 'Danish',
            'de'=> 'German',
            'el'=> 'Greek',
            'en'=> 'English',
            'custom'=> 'Custom',
        );

        $languageArr = apply_filters('ep_google_reviews_review_language',$languageArr);
        $this->add_control(
            'reviews_lang',
            [
                'label'   => esc_html__( 'Filter Reviews language', 'bdthemes-element-pack' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '',
                'options' => $languageArr,
            ]
        );

        $this->add_control(
			'custom_lang',
			[
				'label'       => esc_html__( 'Custom Language', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'placeholder' => __( 'Your Language', 'bdthemes-element-pack' ),
				'description' => sprintf(__('Please write your Language code here. It supports only language code. For the language code,  please look <a href="%s" target="_blank">here</a>
					 Please delete your transient if not works. You can simply delete transient from Layout ( Cache Reviews ) by on/off.'), 'http://www.lingoes.net/en/translator/langcode.htm'),
				'condition'	  => [
					'reviews_lang' => 'custom'
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_slider_settins',
			[
				'label' => esc_html__( 'Slider Settings', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => esc_html__( 'Auto Play', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_interval',
			[
				'label'     => esc_html__( 'Autoplay Interval', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 7000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'   => esc_html__( 'Pause on Hover', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => esc_html__( 'Loop', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_navigation',
			[
				'label'     => __( 'Navigation', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'arrows',
				'options' => [
					'both'   => __( 'Arrows and Dots', 'bdthemes-element-pack' ),
					'arrows' => __( 'Arrows', 'bdthemes-element-pack' ),
					'dots'   => __( 'Dots', 'bdthemes-element-pack' ),
					'none'   => __( 'None', 'bdthemes-element-pack' ),
				],
				'prefix_class' => 'bdt-navigation-type-',
				'render_type'  => 'template',				
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'    => Controls_Manager::SELECT,
				'default' => '5',
				'options' => [
					'1' => esc_html__('Style 1', 'bdthemes-element-pack'),
					'2' => esc_html__('Style 2', 'bdthemes-element-pack'),
					'3' => esc_html__('Style 3', 'bdthemes-element-pack'),
					'4' => esc_html__('Style 4', 'bdthemes-element-pack'),
					'5' => esc_html__('Style 5', 'bdthemes-element-pack'),
					'6' => esc_html__('Style 6', 'bdthemes-element-pack'),
					'7' => esc_html__('Style 7', 'bdthemes-element-pack'),
					'8' => esc_html__('Style 8', 'bdthemes-element-pack'),
					'9' => esc_html__('Style 9', 'bdthemes-element-pack'),
					'10' => esc_html__('Style 10', 'bdthemes-element-pack'),
					'11' => esc_html__('Style 11', 'bdthemes-element-pack'),
					'12' => esc_html__('Style 12', 'bdthemes-element-pack'),
					'13' => esc_html__('Style 13', 'bdthemes-element-pack'),
					'14' => esc_html__('Style 14', 'bdthemes-element-pack'),
					'15' => esc_html__('Style 15', 'bdthemes-element-pack'),
					'16' => esc_html__('Style 16', 'bdthemes-element-pack'),
					'17' => esc_html__('Style 17', 'bdthemes-element-pack'),
					'18' => esc_html__('Style 18', 'bdthemes-element-pack'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-element-pack'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-element-pack'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-element-pack'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-element-pack'),
					'square-1' => esc_html__('Style 23', 'bdthemes-element-pack'),
				],
				'condition' => [
					'navigation' => ['both', 'arrows'],
				],
			]
		);
		
		$this->add_control(
			'both_position',
			[
				'label'     => __( 'Arrows and Dots Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => element_pack_navigation_position(),
				'condition' => [
					'navigation' => 'both',
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __( 'Arrows Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'center',
				'options'   => element_pack_navigation_position(),
				'condition' => [
					'navigation' => 'arrows',
				],				
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __( 'Dots Position', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'bottom-center',
				'options'   => element_pack_pagination_position(),
				'condition' => [
					'navigation' => 'dots',
				],				
			]
		);

		$this->end_controls_section();
        
		//Style
		$this->start_controls_section(
			'section_google_reviews_style',
			[
				'label' => __( 'Google Reviews', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_google_reviews_item_style' );

		$this->start_controls_tab(
			'google_reviews_item_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'google_reviews_item_background',
				'selector'  => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item',
			]
		);

		$this->add_responsive_control(
			'google_reviews_item_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'google_reviews_item_border',
				'selector'    => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item',
			]
		);

		$this->add_control(
			'google_reviews_item_radius',
			[
				'label'      => esc_html__('Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'google_reviews_item_shadow',
				'selector' => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item'
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'google_reviews_item_hover',
			[
				'label' => __( 'hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'google_reviews_item_hover_background',
				'selector'  => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item:hover',
			]
		);

		$this->add_control(
			'google_reviews_item_hover_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item:hover'  => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'google_reviews_item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'google_reviews_item_hover_shadow',
				'selector' => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__( 'Image', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_image' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'image_size',
			[
				'label' => esc_html__('Size', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-img img' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-img img' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			[
				'label'     => esc_html__( 'Name', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_name' => 'yes',
				],
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-name a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'name_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-name a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-name a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_time',
			[
				'label'     => esc_html__( 'Time', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_time' => 'yes',
				],
			]
		);

		$this->add_control(
			'time_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'time_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-date' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'time_typography',
				'selector' => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-date',
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
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating .bdt-rating-item' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating.bdt-rating-1 .bdt-rating-item:nth-child(1)'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating.bdt-rating-2 .bdt-rating-item:nth-child(-n+2)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating.bdt-rating-3 .bdt-rating-item:nth-child(-n+3)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating.bdt-rating-4 .bdt-rating-item:nth-child(-n+4)' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating.bdt-rating-5 .bdt-rating-item:nth-child(-n+5)' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-google-reviews .bdt-rating .bdt-rating-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-rating' => 'padding-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_excerpt',
			[
				'label'     => esc_html__( 'Excerpt', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_align',
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
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'excerpt_spacing',
			[
				'label'     => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-desc' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .bdt-google-reviews .bdt-google-reviews-item .bdt-google-reviews-desc',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'      => __( 'Navigation', 'bdthemes-element-pack' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'terms' => [
						[
							'name'     => 'navigation',
							'operator' => '!=',
							'value'    => 'none',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label' => __( 'Arrows Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev i,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_background',
			[
				'label'     => __( 'Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_background',
			[
				'label'     => __( 'Hover Background Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev:hover,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Arrows Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev svg,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next svg' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __( 'Arrows Hover Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev:hover svg,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next:hover svg' => 'color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_space',
			[
				'label' => __( 'Space', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev' => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'margin-left: {{SIZE}}px;',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev,
					{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'dots_size',
			[
				'label' => __( 'Dots Size', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-slider-nav li a' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-slider-nav li a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'active_dot_color',
			[
				'label'     => __( 'Active Dots Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-slider-nav li.bdt-active a' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_ncx_position',
			[
				'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_ncy_position',
			[
				'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-arrows-container' => 'transform: translate({{arrows_ncx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'     => 'arrows_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'arrows_acx_position',
			[
				'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'arrows',
						],
						[
							'name'  => 'arrows_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'dots_nnx_position',
			[
				'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'dots_nny_position',
			[
				'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-dots-container' => 'transform: translate({{dots_nnx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'dots',
						],
						[
							'name'     => 'dots_position',
							'operator' => '!=',
							'value'    => '',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_ncx_position',
			[
				'label'   => __( 'Horizontal Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_ncy_position',
			[
				'label'   => __( 'Vertical Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 40,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-arrows-dots-container' => 'transform: translate({{both_ncx_position.size}}px, {{SIZE}}px);',
				],
				'conditions'   => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'     => 'both_position',
							'operator' => '!=',
							'value'    => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_cx_position',
			[
				'label'   => __( 'Arrows Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => -60,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-prev' => 'left: {{SIZE}}px;',
					'{{WRAPPER}} .bdt-google-reviews .bdt-navigation-next' => 'right: {{SIZE}}px;',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->add_control(
			'both_cy_position',
			[
				'label'   => __( 'Dots Offset', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 30,
				],
				'range' => [
					'px' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-google-reviews .bdt-dots-container' => 'transform: translateY({{SIZE}}px);',
				],
				'conditions' => [
					'terms' => [
						[
							'name'  => 'navigation',
							'value' => 'both',
						],
						[
							'name'  => 'both_position',
							'value' => 'center',
						],
					],
				],
			]
		);

		$this->end_controls_section();

	}

    public function get_transient_expire( $settings ) {

        $expire_value = $settings['refresh_reviews'];
        $expire_time  = 24 * HOUR_IN_SECONDS;

        if ( 'hour' === $expire_value ) {
            $expire_time = 60 * MINUTE_IN_SECONDS;
        } elseif ( 'week' === $expire_value ) {
            $expire_time = 7 * DAY_IN_SECONDS;
        } elseif ( 'month' === $expire_value ) {
            $expire_time = 30 * DAY_IN_SECONDS;
        } elseif ( 'year' === $expire_value ) {
            $expire_time = 365 * DAY_IN_SECONDS;
        }

        return $expire_time;
    }

	public function get_transient_key($placeId){
        $placeId = strtolower($placeId);
        $transient = 'google_reviews_data_' . $placeId;
        return $transient;
    }

    public function get_api_url($api_key, $placeid, $language){
        $url = $this->google_place_url . 'details/json?placeid=' . $placeid . '&key=' . $api_key;
        if (strlen($language) > 0) {
            $url = $url . '&language=' . $language;
        }
        return $url;
    }

	public function get_cache_data($placeId){
		$settings   = $this->get_settings_for_display();
		
        $transient = $this->get_transient_key($placeId);
        $data      = get_transient($transient);

        if($settings['cache_reviews'] != 'yes'){
        	 delete_transient($transient);
        }

        if(is_array($data) && count($data) > 0){
            if($placeId == $data['place_id']){
                return $data;
            } else {
                delete_transient($transient);
            }
        }
        return false;
	}
	
	public function getReviews(){

        $settings   = $this->get_settings_for_display();
        $options    = get_option( 'element_pack_api_settings' );
        $placeId    = isset($settings['google_place_id']) ? esc_html($settings['google_place_id']):'';
        $ApiKey     = isset($options['google_map_key']) ? esc_html($options['google_map_key']):'';
        // $language   = isset($options['reviews_lang']) ? esc_html($options['reviews_lang']):'';

        $language = '';

    	if(isset($settings['reviews_lang'])){
    		if($settings['reviews_lang'] == 'custom'){
    			if(empty($settings['custom_lang'])){
    				$language = '';
    			}else{
    				$language = esc_html($settings['custom_lang']);
    			}
    		}else{
    			$language = esc_html($settings['reviews_lang']);
    		}
    	}else{
    		$language = '';
    	}

        //$language   = isset($settings['reviews_lang']) ? esc_html($settings['reviews_lang']):'';

        if(!$placeId || !$ApiKey){
            return false;
        }

 
        $reviewData = $this->get_cache_data($placeId);

        if($reviewData){
            return $reviewData;
        }else{
            $requestUrl = $this->get_api_url($ApiKey, $placeId, $language);  

            $response = wp_remote_get($requestUrl);

            if (is_wp_error($response)) {
                return array('error_message'=>$response->get_error_message());
            }
            $response   = json_decode($response[ 'body' ],true);
            $result     = (isset($response['result']) && is_array($response['result']))?$response['result']:'';

            if(is_array($result)){
                if(isset($result['error_message'])){
                    return $result;
                }

                $transient = $this->get_transient_key($placeId);
                $expireTime = $this->get_transient_expire($settings);

                set_transient($transient, $result, $expireTime); // One day
                return $result;
            }
            return $response;
        }
    }

    public function render_rating($rating) {
		$settings = $this->get_settings_for_display();

		if( ! $settings['show_rating'] ) {
			return;
		}

		?>
		<div class="bdt-google-reviews-rating">
			<ul class="bdt-rating bdt-grid bdt-grid-collapse bdt-rating-<?php echo esc_attr($rating); ?>" data-bdt-grid>
				<li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
				<li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
				<li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
				<li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
				<li class="bdt-rating-item"><i class="ep-icon-star-full" aria-hidden="true"></i></li>
			</ul>
		</div>
		<?php
	}

	public function render_excerpt($excerpt, $limit='', $trail = '') {
		$settings = $this->get_settings_for_display();

		$excerpt_limit = $settings['excerpt_limit'];
		$limit = $excerpt_limit;

		$output = strip_shortcodes( wp_trim_words( $excerpt, $limit, $trail ) );

		return $output;
	}
	
	public function render_footer() {
		$settings = $this->get_settings_for_display();

		?>
				</ul>
				<?php if ('both' == $settings['navigation']) : ?>
					<?php $this->render_both_navigation(); ?>

					<?php if ( 'center' === $settings['both_position'] ) : ?>
						<?php $this->render_dotnavs(); ?>
					<?php endif; ?>

				<?php elseif ('arrows' == $settings['navigation']) : ?>
					<?php $this->render_navigation(); ?>
				<?php elseif ('dots' == $settings['navigation']) : ?>
					<?php $this->render_dotnavs(); ?>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	public function render_navigation() {
		$settings = $this->get_settings_for_display();

		if (('both' == $settings['navigation']) and ('center' == $settings['both_position'])) {
			$arrows_position = 'center';
		} else {
			$arrows_position = $settings['arrows_position'];
		}

		?>
		<div class="bdt-position-z-index bdt-visible@m bdt-position-<?php echo esc_attr($arrows_position); ?>">
			<div class="bdt-arrows-container bdt-slidenav-container">
				<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav" data-bdt-slider-item="previous">
					<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
				</a>
				<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav" data-bdt-slider-item="next">
					<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
				</a>
			</div>
		</div>
		<?php
	}

	public function render_dotnavs() {
		$settings = $this->get_settings_for_display();

		if (('both' == $settings['navigation']) and ('center' == $settings['both_position'])) {
			$dots_position = 'bottom-center';
		} else {
			$dots_position = $settings['dots_position'];
		}

		?>
		<div class="bdt-position-z-index bdt-visible@m bdt-position-<?php echo esc_attr($dots_position); ?>">
			<div class="bdt-dotnav-wrapper bdt-dots-container">

				<ul class="bdt-slider-nav bdt-dotnav bdt-flex-center">
				</ul>

			</div>
		</div>
		<?php
	}

	public function render_both_navigation() {
		$settings = $this->get_settings_for_display();

		?>
		<div class="bdt-position-z-index bdt-position-<?php echo esc_attr($settings['both_position']); ?>">
			<div class="bdt-arrows-dots-container bdt-slidenav-container ">
				
				<div class="bdt-flex bdt-flex-middle">
					<div>
						<a href="" class="bdt-navigation-prev bdt-slidenav-previous bdt-icon bdt-slidenav" data-bdt-slider-item="previous">
						 	<i class="ep-icon-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						 </a>						
					</div>

					<?php if ('center' !== $settings['both_position']) : ?>
						<div class="bdt-dotnav-wrapper bdt-dots-container">
							<ul class="bdt-dotnav">
							</ul>
						</div>
					<?php endif; ?>
					
					<div>
						<a href="" class="bdt-navigation-next bdt-slidenav-next bdt-icon bdt-slidenav" data-bdt-slider-item="next">
							<i class="ep-icon-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</a>						
					</div>
					
				</div>
			</div>
		</div>		
		<?php
	}

	protected function render_header() {
        $settings = $this->get_settings_for_display();
	    $reviewData     = $this->getReviews();
        $is_editor      = Plugin::instance()->editor->is_edit_mode();

        $errorMessage   = "";
        if($is_editor){
            $errorMessage   = (isset($reviewData['error_message'])) ? $reviewData['error_message']: '';
        }
	    $clientReview = isset($reviewData['reviews']) ? $reviewData['reviews']: [];


        $this->add_render_attribute('google-reviews', 'class', 'bdt-google-reviews bdt-google-reviews-slider');
        
		?>

		<div <?php echo $this->get_render_attribute_string( 'google-reviews' ); ?>>
		<?php

		$this->add_render_attribute(
			[
				'slider-settings' => [
					'class' => [
						( 'both' == $settings['navigation'] ) ? 'bdt-arrows-dots-align-' . $settings['both_position'] : '',
						( 'arrows' == $settings['navigation'] or 'arrows-thumbnavs' == $settings['navigation'] ) ? 'bdt-arrows-align-' . $settings['arrows_position'] : '',
						( 'dots' == $settings['navigation'] ) ? 'bdt-dots-align-'. $settings['dots_position'] : '',
					],
					'data-bdt-slider' => [
						wp_json_encode(array_filter([
							"autoplay"          => $settings["autoplay"],
							"autoplay-interval" => $settings["autoplay_interval"],
							"finite"            => $settings["loop"] ? false : true,
							"pause-on-hover"    => $settings["pause_on_hover"] ? true : false
						]))
					]
				]
			]
		);

		?>
		<div <?php echo ( $this->get_render_attribute_string( 'slider-settings' ) ); ?>>
			<ul class="bdt-slider-items bdt-child-width-1-1 bdt-grid bdt-grid-match" data-bdt-grid>

				<?php
				foreach($clientReview as $review){
					$author_name    = $review['author_name'];
					$author_url     = $review['author_url'];
					//$language       = $review['language'];
					$profile_photo_url = $review['profile_photo_url'];
					$humanTime      = $review['relative_time_description'];
					$review_text    = $review['text'];
					//$timeStamp      = $review['time'];
					$rating      = $review['rating'];
	
					?>
	
					<li>
						<div class="bdt-google-reviews-item">

							<div class="bdt-flex bdt-flex-middle bdt-flex-center">
								<?php if ( 'yes' == $settings['show_image'] ) : ?>
								<div class="bdt-google-reviews-img">
									<img src="<?php echo esc_url($profile_photo_url); ?>" alt="<?php echo esc_html($author_name); ?>">
								</div>
								<?php endif; ?>

								<div>

									<?php if ( 'yes' == $settings['show_name'] ) : ?>
									<div class="bdt-google-reviews-name">
										<a href="<?php echo esc_url($author_url) ?>" target="_blank"><?php echo esc_html($author_name); ?></a>
									</div>
									<?php endif; ?>

									<?php if ( 'yes' == $settings['show_time'] ) : ?>
									<div class="bdt-google-reviews-date">
										<?php echo esc_attr($humanTime); ?>
									</div>
									<?php endif; ?>
			
									<?php $this->render_rating($rating); ?>
									
								</div>
								
							</div>
		
	
							<?php if ( 'yes' == $settings['show_excerpt'] ) : ?>
							<div class="bdt-google-reviews-desc">
								<?php echo $this->render_excerpt($review_text); ?>
							</div>
							<?php endif; ?>
	
						</div>
					</li>
	
					<?php
	
				}
	
				?>

		<?php
	}
	
	protected function render() {

		$this->render_header();
		$this->render_footer();

	}
}
