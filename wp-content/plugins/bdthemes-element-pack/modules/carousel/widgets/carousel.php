<?php
    
    namespace ElementPack\Modules\Carousel\Widgets;
    
    use Elementor\Controls_Manager;
    use Elementor\Group_Control_Image_Size;
    use Elementor\Group_Control_Border;
    use Elementor\Group_Control_Typography;
    use Elementor\Group_Control_Box_Shadow;
    use Elementor\Group_Control_Text_Shadow;
    use Elementor\Group_Control_Background;
    use Elementor\Icons_Manager;
    use ElementPack\Utils;

    use ElementPack\Base\Module_Base;
    use ElementPack\Traits\Global_Widget_Controls;
    use ElementPack\Traits\Global_Swiper_Controls;
    use ElementPack\Modules\QueryControl\Controls\Group_Control_Posts;
    use ElementPack\Includes\Controls\GroupQuery\Group_Control_Query;
    use ElementPack\Modules\QueryControl\Module;
    
    use ElementPack\Modules\Carousel\Skins;
    
    if ( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    class Carousel extends Module_Base {
        
        use Group_Control_Query;
	    use Global_Widget_Controls;
	    use Global_Swiper_Controls;
        
        private $_query = null;
        
        public function get_name() {
            return 'bdt-carousel';
        }
        
        public function get_title() {
            return BDTEP . __( 'Carousel', 'bdthemes-element-pack' );
        }
        
        public function get_icon() {
            return 'bdt-wi-carousel';
        }
        
        public function get_categories() {
            return ['element-pack'];
        }
        
        public function get_keywords() {
            return ['carousel', 'navigation'];
        }
        
        public function get_style_depends() {
            if ( $this->ep_is_edit_mode() ) {
                return ['ep-all-styles'];
            } else {
                return ['element-pack-font', 'ep-carousel'];
            }
        }
        
        public function get_script_depends() {
            return ['imagesloaded'];
        }
        
        public function on_import( $element ) {
            if ( !get_post_type_object( $element['settings']['posts_post_type'] ) ) {
                $element['settings']['posts_post_type'] = 'post';
            }
            
            return $element;
        }
        
        public function on_export( $element ) {
            $element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'posts' );
            return $element;
        }
        
        public function get_query() {
            return $this->_query;
        }
        
        public function _register_skins() {
            $this->add_skin( new Skins\Skin_Vertical( $this ) );
            $this->add_skin( new Skins\Skin_Alice( $this ) );
            $this->add_skin( new Skins\Skin_Ramble( $this ) );
        }
        
        public function get_custom_help_url() {
            return 'https://youtu.be/biF3GtBf0qc';
        }
        
        protected function _register_controls() {
            $this->register_query_section_controls();
        }
        
        private function register_query_section_controls() {
            $this->start_controls_section(
                'section_carousel_layout',
                [
                    'label' => __( 'Layout', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_responsive_control(
                'columns',
                [
                    'label'          => __( 'Columns', 'bdthemes-element-pack' ),
                    'type'           => Controls_Manager::SELECT,
                    'default'        => 3,
                    'tablet_default' => 2,
                    'mobile_default' => 1,
                    'options'        => [
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                        6 => '6',
                    ],
                ]
            );
            
            $this->add_control(
                'posts_per_page',
                [
                    'label'   => __( 'Limit', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 6,
                ]
            );
            
            $this->add_control(
                'item_gap',
                [
                    'label'   => __( 'Item Gap', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 35,
                    ],
                    'range'   => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                ]
            );

            $this->add_control(
                'match_height',
                [
                    'label' => __( 'Item Match Height', 'bdthemes-element-pack' ),
                    'type'  => Controls_Manager::SWITCHER,
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_layout_image',
                [
                    'label' => __( 'Image', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_control(
                'thumbnail_show',
                [
                    'label'   => __( 'Thumbnail Show', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name'         => 'thumbnail_size',
                    'label'        => __( 'Thumbnail Size', 'bdthemes-element-pack' ),
                    'exclude'      => ['custom'],
                    'default'      => 'medium',
                    'prefix_class' => 'bdt-carousel-thumbnail-size-',
                    'condition'    => [
                        'thumbnail_show' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_link_option',
                [
                    'label'     => __( 'Thumbnail Show Link?', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'thumbnail_show' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_caption',
                [
                    'label'     => __( 'Show Caption', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'thumbnail_show'   => 'yes',
                        'show_link_option' => 'yes',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_width',
                [
                    'label'          => __( 'Image Width', 'bdthemes-element-pack' ),
                    'type'           => Controls_Manager::SLIDER,
                    'default'        => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'size_units'     => ['%'],
                    'range'          => [
                        '%' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                    ],
                    'selectors'      => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail' => 'width: {{SIZE}}{{UNIT}};margin-left: auto;margin-right: auto;',
                    ],
                    'condition'      => [
                        'thumbnail_show' => 'yes',
                        '_skin'          => '',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'alice_background_height',
                [
                    'label'          => __( 'Height(px)', 'bdthemes-element-pack' ),
                    'type'           => Controls_Manager::SLIDER,
                    'tablet_default' => [
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'unit' => 'px',
                    ],
                    'size_units'     => ['px'],
                    'range'          => [
                        'px' => [
                            'min' => 100,
                            'max' => 350,
                        ],
                    ],
                    'selectors'      => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item .bdt-carousel-background' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'      => [
                        'thumbnail_show' => '',
                        '_skin'          => 'bdt-alice',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'vertical_layout_image_width',
                [
                    'label'          => __( 'Image Width', 'bdthemes-element-pack' ),
                    'type'           => Controls_Manager::SLIDER,
                    'default'        => [
                        'size' => 50,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'size_units'     => ['%'],
                    'range'          => [
                        '%' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                    ],
                    'selectors'      => [
                        '{{WRAPPER}} .bdt-carousel .bdt-grid .bdt-width-1-2\@m' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition'      => [
                        'thumbnail_show' => 'yes',
                        '_skin'          => 'bdt-vertical',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_ratio',
                [
                    'label'     => __( 'Image Ratio', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0.1,
                            'max'  => 2,
                            'step' => 0.01,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail'       => 'padding-bottom: calc( {{SIZE}} * 100% ); top: 0; left: 0; right: 0; bottom: 0;',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail img'   => 'height: 100%; width: auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); font-size: {{SIZE}};',
                    ],
                    'condition' => [
                        'thumbnail_show' => 'yes',
                        '_skin!'         => 'bdt-ramble',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'ramble_image_ratio',
                [
                    'label'     => __( 'Image Ratio', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0.1,
                            'max'  => 2,
                            'step' => 0.01,
                        ],
                    ],
                    'default'   => [
                        'size' => 1,
                        'unit' => 'px',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail'       => 'padding-bottom: calc( {{SIZE}} * 100% ); top: 0; left: 0; right: 0; bottom: 0;',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail img'   => 'height: 100%; width: auto; position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%); font-size: {{SIZE}};',
                    ],
                    'condition' => [
                        'thumbnail_show' => 'yes',
                        '_skin'          => 'bdt-ramble',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_layout_title',
                [
                    'label' => __( 'Title', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_control(
                'show_title',
                [
                    'label'   => __( 'Show Title', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'title_tag',
                [
                    'label'     => __( 'Title HTML Tag', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SELECT,
                    'options'   => element_pack_title_tags(),
                    'default'   => 'h4',
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_layout_meta',
                [
                    'label' => __( 'Meta', 'bdthemes-element-pack' ),
                
                ]
            );
            
            $this->add_control(
                'show_alice_category',
                [
                    'label'     => __( 'Category', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        '_skin' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->add_control(
                'meta_data',
                [
                    'label'       => __( 'Meta Data', 'bdthemes-element-pack' ),
                    'label_block' => true,
                    'type'        => Controls_Manager::SELECT2,
                    'default'     => ['date', 'comments'],
                    'multiple'    => true,
                    'options'     => [
                        'author'   => __( 'Author', 'bdthemes-element-pack' ),
                        'category' => __( 'Category', 'bdthemes-element-pack' ),
                        'date'     => __( 'Date', 'bdthemes-element-pack' ),
                        'time'     => __( 'Time', 'bdthemes-element-pack' ),
                        'comments' => __( 'Comments', 'bdthemes-element-pack' ),
                    ],
                    'condition'   => [
                        '_skin!' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_layout_excerpt',
                [
                    'label'     => __( 'Text', 'bdthemes-element-pack' ),
                    'condition' => [
                        '_skin!' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->add_control(
                'show_excerpt',
                [
                    'label'   => __( 'Show Text', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'excerpt_length',
                [
                    'label'       => __( 'Text Limit', 'bdthemes-element-pack' ),
                    'description' => esc_html__( 'It\'s just work for main content, but not working with excerpt. If you set 0 so you will get full main content.', 'bdthemes-element-pack' ),
                    'type'        => Controls_Manager::NUMBER,
                    'default'     => 15,
                    'condition'   => [
                        'show_excerpt' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'show_ellipse',
                [
                    'label'     => __( 'Show Ellipse', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'condition' => [
                        'show_excerpt' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'strip_shortcode',
                [
                    'label'     => esc_html__( 'Strip Shortcode', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SWITCHER,
                    'default'   => 'yes',
                    'condition' => [
                        'show_excerpt' => 'yes',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_layout_button',
                [
                    'label'     => __( 'Readmore Button', 'bdthemes-element-pack' ),
                    'condition' => [
                        '_skin!' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->add_control(
                'show_read_more',
                [
                    'label'   => __( 'Read More', 'bdthemes-element-pack' ),
                    'type'    => Controls_Manager::SWITCHER,
                    'default' => 'yes',
                ]
            );
            
            $this->add_control(
                'read_more_text',
                [
                    'label'       => __( 'Read More Text', 'bdthemes-element-pack' ),
                    'type'        => Controls_Manager::TEXT,
                    'default'     => __( 'Read More', 'bdthemes-element-pack' ),
                    'placeholder' => __( 'Read More', 'bdthemes-element-pack' ),
                    'condition'   => [
                        'show_read_more' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'button_size',
                [
                    'label'     => __( 'Button Size', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'sm',
                    'options'   => [
                        'xs' => __( 'Extra Small', 'bdthemes-element-pack' ),
                        'sm' => __( 'Small', 'bdthemes-element-pack' ),
                        'md' => __( 'Medium', 'bdthemes-element-pack' ),
                        'lg' => __( 'Large', 'bdthemes-element-pack' ),
                        'xl' => __( 'Extra Large', 'bdthemes-element-pack' ),
                    ],
                    'condition' => [
                        'read_more_text!' => '',
                        'show_read_more!' => '',
                    ],
                ]
            );
            
            $this->add_control(
                'carousel_icon',
                [
                    'label'            => esc_html__( 'Button Icon', 'bdthemes-element-pack' ),
                    'type'             => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'condition'        => [
                        'read_more_text!' => '',
                        'show_read_more!' => '',
                    ],
                    'label_block' => false,
				    'skin' => 'inline'
                ]
            );
            
            $this->add_control(
                'icon_align',
                [
                    'label'     => esc_html__( 'Icon Position', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SELECT,
                    'default'   => 'right',
                    'options'   => [
                        'left'  => esc_html__( 'Left', 'bdthemes-element-pack' ),
                        'right' => esc_html__( 'Right', 'bdthemes-element-pack' ),
                    ],
                    'condition' => [
                        'carousel_icon[value]!' => '',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'icon_indent',
                [
                    'label'     => esc_html__( 'Icon Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'default'   => [
                        'size' => 8,
                    ],
                    'range'     => [
                        'px' => [
                            'max' => 50,
                        ],
                    ],
                    'condition' => [
                        'carousel_icon[value]!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-flex-align-right' => is_rtl() ? 'margin-right: {{SIZE}}{{UNIT}};' : 'margin-left: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .bdt-carousel .bdt-flex-align-left'  => is_rtl() ? 'margin-left: {{SIZE}}{{UNIT}};' : 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->end_controls_section();
	
	        //New Query Builder Settings
	        $this->start_controls_section(
		        'section_post_query_builder',
		        [
			        'label' => __( 'Query', 'bdthemes-element-pack' ) . BDTEP_NC,
			        'tab' => Controls_Manager::TAB_CONTENT,
		        ]
	        );
	
	        $this->register_query_builder_controls();
	
	        $this->end_controls_section();
            
            //Global Query Controls
            $this->register_query_controls();
            
            //Navigation Controls
            $this->start_controls_section(
                'section_content_navigation',
                [
                    'label' => __( 'Navigation', 'bdthemes-element-pack' ),
                ]
            );

            //Global Navigation Controls
            $this->register_navigation_controls();

            $this->end_controls_section();

            //Global Carousel Settings Controls
		    $this->register_carousel_settings_controls();
            
            //Style
            $this->start_controls_section(
                'section_style_skin',
                [
                    'label'     => __( 'Items', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        '_skin' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->add_control(
                'skin_shadow_mode',
                [
                    'label'        => esc_html__( 'Shadow Mode', 'bdthemes-element-pack' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'prefix_class' => 'bdt-ep-shadow-mode-',
                ]
            );
            
            $this->add_control(
                'skin_shadow_color',
                [
                    'label'     => esc_html__( 'Shadow Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'skin_shadow_mode' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container:before' => is_rtl() ? 'background: linear-gradient(to left, {{VALUE}} 5%,rgba(255,255,255,0) 100%);' : 'background: linear-gradient(to right, {{VALUE}} 5%,rgba(255,255,255,0) 100%);',
                        '{{WRAPPER}} .elementor-widget-container:after'  => is_rtl() ? 'background: linear-gradient(to left, rgba(255,255,255,0) 0%, {{VALUE}} 95%);' : 'background: linear-gradient(to right, rgba(255,255,255,0) 0%, {{VALUE}} 95%);',
                    ],
                ]
            );
            
            $this->add_control(
                'overlay_blur_effect',
                [
                    'label'       => esc_html__( 'Blur Effect', 'bdthemes-element-pack' ) . BDTEP_NC,
                    'type'        => Controls_Manager::SWITCHER,
                    'description' => sprintf( __( 'This feature will not work in the Firefox browser untill you enable browser compatibility so please %1s look here %2s', 'bdthemes-element-pack' ), '<a href="https://developer.mozilla.org/en-US/docs/Web/CSS/backdrop-filter#Browser_compatibility" target="_blank">', '</a>' ),
                    'condition'   => [
                        'thumbnail_show' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'overlay_blur_level',
                [
                    'label'     => __( 'Blur Level', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0,
                            'step' => 1,
                            'max'  => 50,
                        ]
                    ],
                    'default'   => [
                        'size' => 5
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-custom-overlay' => 'backdrop-filter: blur({{SIZE}}px); -webkit-backdrop-filter: blur({{SIZE}}px); opacity: 1;'
                    ],
                    'condition' => [
                        'overlay_blur_effect' => 'yes',
                        'thumbnail_show'      => 'yes',
                    ]
                ]
            );
            
            $this->add_control(
                'skin_overlay_color',
                [
                    'label'     => esc_html__( 'Overlay Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#000',
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-custom-overlay' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'thumbnail_show' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'skin_item_color',
                [
                    'label'     => esc_html__( 'Item Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item .bdt-carousel-background' => 'background: {{VALUE}};',
                    ],
                    'condition' => [
                        'thumbnail_show' => '',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_layout',
                [
                    'label'     => __( 'Items', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        '_skin!' => 'bdt-alice'
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'content_alignment',
                [
                    'label'     => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'left'   => [
                            'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'right'  => [
                            'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item .bdt-carousel-desc' => 'text-align: {{VALUE}}',
                    ],
                ]
            );
            
            $this->start_controls_tabs( 'tabs_item_style' );
            
            $this->start_controls_tab(
                'tab_item_normal',
                [
                    'label' => __( 'Normal', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_control(
                'item_background',
                [
                    'label'     => __( 'Background', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'default'   => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'item_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-item',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'        => 'item_border',
                    'label'       => __( 'Border', 'bdthemes-element-pack' ),
                    'placeholder' => '1px',
                    'default'     => '1px',
                    'selector'    => '{{WRAPPER}} .bdt-carousel .bdt-carousel-item',
                ]
            );
            
            $this->add_responsive_control(
                'item_border_radius',
                [
                    'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item, {{WRAPPER}} .bdt-carousel .swiper-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'item_padding',
                [
                    'label'      => __( 'Padding', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            
            $this->add_control(
                'shadow_mode',
                [
                    'label'        => esc_html__( 'Shadow Mode', 'bdthemes-element-pack' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'prefix_class' => 'bdt-ep-shadow-mode-',
                ]
            );
            
            $this->add_control(
                'shadow_color',
                [
                    'label'     => esc_html__( 'Shadow Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'shadow_mode' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .elementor-widget-container:before' => is_rtl() ? 'background: linear-gradient(to left, {{VALUE}} 5%,rgba(255,255,255,0) 100%);' : 'background: linear-gradient(to right, {{VALUE}} 5%,rgba(255,255,255,0) 100%);',
                        '{{WRAPPER}} .elementor-widget-container:after'  => is_rtl() ? 'background: linear-gradient(to left, rgba(255,255,255,0) 0%, {{VALUE}} 95%);' : 'background: linear-gradient(to right, rgba(255,255,255,0) 0%, {{VALUE}} 95%);',
                    ],
                ]
            );
            
            $this->add_control(
                'item_opacity',
                [
                    'label'     => esc_html__( 'Opacity', 'bdthemes-element-pack' ) . BDTEP_NC,
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0,
                            'step' => 0.1,
                            'max'  => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            
            $this->end_controls_tab();
            
            $this->start_controls_tab(
                'tab_item_hover',
                [
                    'label' => __( 'Hover', 'bdthemes-element-pack' ),
                ]
            );
            
            $this->add_control(
                'item_hover_background',
                [
                    'label'     => __( 'Background', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item:hover' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'item_inner_hover_background',
                [
                    'label'     => __( 'Inner Background', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel-skin-ramble .bdt-carousel-item .bdt-carousel-desc' => 'background-color: {{VALUE}};',
                    ],
                    'condition' => [
                        '_skin' => 'bdt-ramble',
                    ],
                ]
            );
            
            $this->add_control(
                'item_hover_line_effect_color',
                [
                    'label'     => __( 'Inner Border Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item .bdt-carousel-thumbnail:before' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        '_skin' => 'bdt-ramble',
                    ],
                ]
            );
            
            $this->add_control(
                'item_hover_border_color',
                [
                    'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'item_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'item_hover_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-item:hover',
                ]
            );
            
            $this->add_responsive_control(
                'item_shadow_padding',
                [
                    'label'       => __( 'Match Padding', 'bdthemes-element-pack' ),
                    'description' => __( 'You have to add padding for matching overlaping normal/hover box shadow when you used Box Shadow option.', 'bdthemes-element-pack' ),
                    'type'        => Controls_Manager::SLIDER,
                    'range'       => [
                        'px' => [
                            'min'  => 0,
                            'step' => 1,
                            'max'  => 50,
                        ]
                    ],
                    'default'     => [
                        'size' => 10
                    ],
                    'selectors'   => [
                        '{{WRAPPER}} .swiper-container' => 'padding: {{SIZE}}{{UNIT}}; margin: 0 -{{SIZE}}{{UNIT}};'
                    ],
                ]
            );
            
            $this->add_control(
                'item_hover_opacity',
                [
                    'label'     => esc_html__( 'Opacity', 'bdthemes-element-pack' ) . BDTEP_NC,
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0,
                            'step' => 0.1,
                            'max'  => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item:hover' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            
            $this->end_controls_tab();
            
            $this->start_controls_tab(
                'tab_item_active',
                [
                    'label' => __( 'Active', 'bdthemes-element-pack' ) . BDTEP_NC,
                ]
            );
            
            $this->add_control(
                'item_active_background',
                [
                    'label'     => __( 'Background', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item.swiper-slide-active' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'item_active_border_color',
                [
                    'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'condition' => [
                        'item_border_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item.swiper-slide-active' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'item_active_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-item.swiper-slide-active',
                ]
            );
            
            $this->add_control(
                'item_active_opacity',
                [
                    'label'     => esc_html__( 'Opacity', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min'  => 0,
                            'step' => 0.1,
                            'max'  => 1,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item.swiper-slide-active' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            
            $this->end_controls_tab();
            
            $this->end_controls_tabs();
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_image',
                [
                    'label'     => __( 'Image', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'thumbnail_show' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'image_background',
                [
                    'label'     => __( 'Background', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_padding',
                [
                    'label'      => __( 'Padding', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_margin',
                [
                    'label'      => __( 'Margin', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_border_radius',
                [
                    'label'      => __( 'Border Radius', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    ],
                ]
            );
            
            $this->add_control(
                'image_opacity',
                [
                    'label'     => __( 'Opacity (%)', 'bdthemes-element-pack' ),
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
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail img' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'image_hover_opacity',
                [
                    'label'     => __( 'Hover Opacity (%)', 'bdthemes-element-pack' ),
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
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-item:hover .bdt-carousel-thumbnail img' => 'opacity: {{SIZE}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'image_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-thumbnail' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                    ],
                    // 'default'   => [
                    //     'size' => 20,
                    // ],
                    'condition' => [
                        '_skin' => '',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_categories',
                [
                    'label'     => __( 'Categories', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        '_skin' => 'bdt-alice',
                    ],
                ]
            );
            
            $this->add_control(
                'category_color',
                [
                    'label'     => __( 'Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'category_background',
                [
                    'label'     => esc_html__( 'Background Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a' => 'background-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'        => 'category_border',
                    'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
                    'placeholder' => '1px',
                    'default'     => '1px',
                    'selector'    => '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a',
                    'separator'   => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'category_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'category_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a',
                ]
            );
            
            $this->add_responsive_control(
                'category_padding',
                [
                    'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator'  => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'category_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'category_typography',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-categories a',
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_title',
                [
                    'label'     => __( 'Title', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        'show_title' => 'yes',
                    ],
                ]
            );
            
            $this->add_control(
                'title_color',
                [
                    'label'     => __( 'Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-title a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'title_hover_color',
                [
                    'label'     => __( 'Hover Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Text_Shadow::get_type(),
                [
                    'name'     => 'title_shadow',
                    'label'    => __( 'Text Shadow', 'bdthemes-element-pack' ) . BDTEP_NC,
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-title a',
                ]
            );
            
            $this->add_responsive_control(
                'title_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-title' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-title',
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_date',
                [
                    'label'     => __( 'Date', 'bdthemes-element-pack' ),
                    'tab'       => Controls_Manager::TAB_STYLE,
                    'condition' => [
                        '_skin' => 'bdt-alice',
                    ],
                ]
            );
            
            $this->add_control(
                'date_color',
                [
                    'label'     => __( 'Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-date' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'date_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-date' => 'margin-top: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'date_typography',
                    'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-date',
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_meta',
                [
                    'label'      => __( 'Meta', 'bdthemes-element-pack' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'conditions' => [
                        'terms' => [
                            [
                                'name'     => 'meta_data',
                                'operator' => '!=',
                                'value'    => '',
                            ],
                            [
                                'name'     => '_skin',
                                'operator' => '!=',
                                'value'    => 'bdt-alice',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_control(
                'meta_color',
                [
                    'label'     => __( 'Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta span *' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'meta_hover_color',
                [
                    'label'     => __( 'Hover Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta span:hover'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta span:hover a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_control(
                'meta_divider_color',
                [
                    'label'     => __( 'Divider Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta span:after' => 'background: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'meta_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'meta_typography',
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta span',
                ]
            );
            
            $this->add_responsive_control(
                'meta_alignment',
                [
                    'label'     => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::CHOOSE,
                    'options'   => [
                        'flex-start' => [
                            'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-left',
                        ],
                        'center'     => [
                            'title' => esc_html__( 'Center', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-center',
                        ],
                        'flex-end'   => [
                            'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
                            'icon'  => 'eicon-text-align-right',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-meta' => 'justify-content: {{VALUE}}',
                    ],
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_excerpt',
                [
                    'label'      => __( 'Text', 'bdthemes-element-pack' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'condition'  => [
                        'show_excerpt' => 'yes',
                    ],
                    'conditions' => [
                        'terms' => [
                            [
                                'name'  => 'show_excerpt',
                                'value' => 'yes',
                            ],
                            [
                                'name'     => '_skin',
                                'operator' => '!=',
                                'value'    => 'bdt-alice',
                            ],
                        ],
                    ],
                ]
            );
            
            $this->add_control(
                'excerpt_color',
                [
                    'label'     => __( 'Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-excerpt' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'excerpt_spacing',
                [
                    'label'     => __( 'Spacing', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'excerpt_typography',
                    'label'    => esc_html__( 'Typography', 'bdthemes-element-pack' ),
                    'selector' => '{{WRAPPER}} .bdt-carousel .bdt-carousel-excerpt',
                ]
            );
            
            $this->end_controls_section();
            
            $this->start_controls_section(
                'section_style_button',
                [
                    'label'      => __( 'Button', 'bdthemes-element-pack' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'conditions' => [
                        'terms' => [
                            [
                                'name'  => 'show_read_more',
                                'value' => 'yes',
                            ],
                            [
                                'name'     => 'read_more_text',
                                'operator' => '!=',
                                'value'    => '',
                            ],
                            [
                                'name'     => '_skin',
                                'operator' => '!=',
                                'value'    => 'bdt-alice',
                            ],
                        ],
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
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel-button' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'button_background_color',
                    'selector' => '{{WRAPPER}} .bdt-carousel-button',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Border::get_type(), [
                    'name'        => 'button_border',
                    'label'       => esc_html__( 'Border', 'bdthemes-element-pack' ),
                    'placeholder' => '1px',
                    'default'     => '1px',
                    'selector'    => '{{WRAPPER}} .bdt-carousel-button',
                ]
            );
            
            $this->add_responsive_control(
                'button_border_radius',
                [
                    'label'      => esc_html__( 'Border Radius', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_responsive_control(
                'button_text_padding',
                [
                    'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
                    'type'       => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors'  => [
                        '{{WRAPPER}} .bdt-carousel-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'button_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel-button',
                ]
            );
            
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'button_typography',
                    'selector' => '{{WRAPPER}} .bdt-carousel-button',
                ]
            );
            
            $this->add_control(
                'carousel_button_icon_color',
                [
                    'label'     => esc_html__( 'Icon Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-button .bdt-carousel-button-icon i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-button .bdt-carousel-button-icon svg' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'carousel_icon[value]!' => '',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->add_responsive_control(
                'carousel_icon_size',
                [
                    'label'     => __( 'Icon Size', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::SLIDER,
                    'range'     => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-button .bdt-carousel-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'carousel_icon[value]!' => '',
                    ],
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
                    'label'     => esc_html__( 'Text Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel-button:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name'     => 'button_background_hover_color',
                    'selector' => '{{WRAPPER}} .bdt-carousel-button:hover',
                
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
                        '{{WRAPPER}} .bdt-carousel-button:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );
            
            $this->add_group_control(
                Group_Control_Box_Shadow::get_type(),
                [
                    'name'     => 'button_hover_shadow',
                    'selector' => '{{WRAPPER}} .bdt-carousel-button:hover',
                ]
            );
            
            $this->add_control(
                'button_hover_animation',
                [
                    'label' => esc_html__( 'Animation', 'bdthemes-element-pack' ),
                    'type'  => Controls_Manager::HOVER_ANIMATION,
                ]
            );
            
            $this->add_control(
                'carousel_button_hover_icon_color',
                [
                    'label'     => esc_html__( 'Icon Color', 'bdthemes-element-pack' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-button:hover .bdt-carousel-button-icon i'   => 'color: {{VALUE}};',
                        '{{WRAPPER}} .bdt-carousel .bdt-carousel-button:hover .bdt-carousel-button-icon svg' => 'fill: {{VALUE}};',
                    ],
                    'condition' => [
                        'carousel_icon[value]!' => '',
                    ],
                    'separator' => 'before',
                ]
            );
            
            $this->end_controls_tab();
            
            $this->end_controls_tabs();
            
            $this->end_controls_section();

            //Navigation Style
            $this->start_controls_section(
                'section_style_navigation',
                [
                    'label'      => __( 'Navigation', 'bdthemes-element-pack' ),
                    'tab'        => Controls_Manager::TAB_STYLE,
                    'conditions' => [
                        'relation' => 'or',
                        'terms'    => [
                            [
                                'name'     => 'navigation',
                                'operator' => '!=',
                                'value'    => 'none',
                            ],
                            [
                                'name'  => 'show_scrollbar',
                                'value' => 'yes',
                            ],
                        ],
                    ],
                ]
            );
            
            //Global Navigation Style Controls
            $this->register_navigation_style_controls('carousel');
            
            $this->end_controls_section();
        }
        
        public function get_taxonomies() {
            $taxonomies = get_taxonomies( ['show_in_nav_menus' => true], 'objects' );
            
            $options = ['' => ''];
            
            foreach ( $taxonomies as $taxonomy ) {
                $options[$taxonomy->name] = $taxonomy->label;
            }
            
            return $options;
        }
        
        public function get_posts_tags() {
            $taxonomy = $this->get_settings( 'taxonomy' );
            
            foreach ( $this->_query->posts as $post ) {
                if ( !$taxonomy ) {
                    $post->tags = [];
                    
                    continue;
                }
                
                $tags = wp_get_post_terms( $post->ID, $taxonomy );
                
                $tags_slugs = [];
                
                foreach ( $tags as $tag ) {
                    $tags_slugs[$tag->term_id] = $tag;
                }
                
                $post->tags = $tags_slugs;
            }
        }
	
	
	
	    /**
	     * Get post query builder arguments
	     */
	    public function query_posts_v2( $args = [] ) {
		
		    $default = $this->getGroupControlQueryArgs();
		    $args = array_merge( $default, $args );
		
		    $this->_query = new \WP_Query( $args );
	    }
	
	    public function query_posts($posts_per_page) {
		    $settings = $this->get_settings();
		    if(isset($settings['is_replaced_deprecated_query']) &&
		       $settings['is_replaced_deprecated_query'] =='yes'){
			    $args = [];
			    if($posts_per_page){
				    $args['posts_per_page'] = $posts_per_page;
                    $args['paged']  = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
			    }
			    $this->query_posts_v2($args);
			
		    } else {
			    $query_args = Module::get_query_args( 'posts', $settings );
			    $query_args['posts_per_page'] = $posts_per_page;
			    $this->_query = new \WP_Query( $query_args );
		    }
	    }
	    
        
        public function render() {
	        $posts_per_page = $this->get_settings( 'posts_per_page' );
	        
            $this->query_posts($posts_per_page);
            
            $wp_query = $this->get_query();
            
            if ( !$wp_query->found_posts ) {
                return;
            }
            
            $this->get_posts_tags();
            
            $this->render_header();
            
            while ( $wp_query->have_posts() ) {
                $wp_query->the_post();
                
                $this->render_post();
            }
            
            $this->render_footer();
            
            wp_reset_postdata();
        }
        
        public function render_thumbnail() {
            $settings = $this->get_settings_for_display();
            
            if ( 'yes' !== $settings['thumbnail_show'] ) {
                return;
            }
            
            $settings['thumbnail_size'] = [
                'id' => get_post_thumbnail_id(),
            ];
            
            $thumbnail_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail_size' );
            $placeholder_image_src = Utils::get_placeholder_image_src();
            
            if ( !$thumbnail_html ) {
                $thumbnail_html = '<img src="' . esc_url( $placeholder_image_src ) . '" alt="' . get_the_title() . '">';
            }

            $thumbnail_caption = (wp_get_attachment_caption( get_post_thumbnail_id() )) ? : get_the_title();
            
            ?>
            <div class="bdt-carousel-thumbnail">
                
                <?php
                    if ( 'yes' == $settings['show_link_option'] ) { ?>
                <a href="<?php
                    echo get_permalink() ?>" title="<?php echo ( 'yes' == $settings['show_caption'] ) ? $thumbnail_caption : '' ?>">
                    <?php
                        } ?>
                    
                    <?php
                        echo wp_kses_post( $thumbnail_html ) ?>
                    
                    <?php
                        if ( 'yes' == $settings['show_link_option'] ) { ?>
                </a>
            <?php
                } ?>

            </div>
            <?php
        }
        
        public function render_meta_data() {
            $settings = $this->get_settings( 'meta_data' );
            if ( empty( $settings ) ) {
                return;
            }
            ?>
            <div class="bdt-carousel-meta bdt-subnav bdt-flex-middle bdt-margin-small-top" data-bdt-margin>
                <?php
                    if ( in_array( 'author', $settings ) ) {
                        $this->render_author();
                    }
                    
                    if ( in_array( 'category', $settings ) ) {
                        $this->render_category();
                    }
                    
                    if ( in_array( 'date', $settings ) ) {
                        $this->render_date();
                    }
                    
                    if ( in_array( 'time', $settings ) ) {
                        $this->render_time();
                    }
                    
                    if ( in_array( 'comments', $settings ) ) {
                        $this->render_comments();
                    }
                ?>
            </div>
            <?php
        }
        
        public function render_author() {
            ?>
            <span class="pc-author">
			<span><?php
                    the_author(); ?></span>
		    </span>
            <?php
        }
        
        public function render_category() {
            $settings = $this->get_settings_for_display();
            ?>
            <span class="pc-category">
			<span>
                <?php
                    if ( isset( $settings['is_replaced_deprecated_query'] ) && $settings['is_replaced_deprecated_query'] == 'yes' ) {
                        echo element_pack_get_category_list( $settings[ 'posts_source' ] );
                    } else {
                        echo get_the_category_list(' ');
                    }
                ?>
            </span>
		    </span>
            <?php
        }
        
        public function render_date() {
            ?>
            <span class="pc-date">
			<span><?php
                    echo apply_filters( 'the_date', get_the_date( get_option( 'date_format' ) ), '', '' ); ?></span>
		    </span>
            <?php
        }
        
        public function render_time() {
            ?>
            <span class="pc-time">
			<span><?php
                    the_time(); ?></span>
		    </span>
            <?php
        }
        
        public function render_comments() {
            ?>
            <span class="pc-avatar">
			<span><?php
                    comments_number(); ?></span>
		    </span>
            <?php
        }
        
        public function render_title() {
            if ( !$this->get_settings( 'show_title' ) ) {
                return;
            }
            
            $tag = $this->get_settings( 'title_tag' );
            $classes = ['bdt-carousel-title bdt-margin-small-bottom', 'bdt-margin-remove-top']
            ?>

            <<?php
            echo Utils::get_valid_html_tag( $tag ) ?> class="<?php
            echo implode( " ", $classes ); ?>">
            <a href="<?php
                echo get_permalink() ?>">
                <?php
                    the_title() ?>
            </a>
            </<?php
            echo Utils::get_valid_html_tag( $tag ) ?>>
            <?php
        }
        
        public function render_excerpt() {
            if ( !$this->get_settings( 'show_excerpt' ) ) {
                return;
            }
            
            $strip_shortcode = $this->get_settings_for_display( 'strip_shortcode' );

            $ellipse = ( $this->get_settings( 'show_ellipse' ) ) ? '…' : ''; 
            
            ?>
            <div class="bdt-carousel-excerpt">
                <?php
                    if ( has_excerpt() ) {
                        the_excerpt();
                    } else {
                        echo element_pack_custom_excerpt( $this->get_settings_for_display( 'excerpt_length' ), $strip_shortcode, $ellipse);
                    }
                ?>
            </div>
            <?php
        }
        
        public function render_readmore() {
            if ( !$this->get_settings( 'show_read_more' ) ) {
                return;
            }
            
            $settings = $this->get_settings_for_display();
            $animation = ( $settings['button_hover_animation'] ) ? ' elementor-animation-' . $settings['button_hover_animation'] : '';
            
            if ( 'left' == $settings['icon_align'] or 'right' == $settings['icon_align'] ) {
                $this->add_render_attribute( 'carousel-button', 'class', 'bdt-flex bdt-flex-middle', 'true' );
            }
            
            if ( !isset( $settings['icon'] ) && !Icons_Manager::is_migration_allowed() ) {
                // add old default
                $settings['icon'] = 'fas fa-arrow-right';
            }
            
            $migrated = isset( $settings['__fa4_migrated']['carousel_icon'] );
            $is_new = empty( $settings['icon'] ) && Icons_Manager::is_migration_allowed();
            
            ?>
            <a class="bdt-carousel-button elementor-button elementor-size-<?php
                echo esc_attr( $settings['button_size'] . $animation ); ?>" href="<?php
                echo get_permalink(); ?>">
			<span <?php
                echo $this->get_render_attribute_string( 'carousel-button' ); ?>>
				<?php
                    echo esc_html( $settings['read_more_text'] ); ?>
                
                <?php
                    if ( $settings['carousel_icon']['value'] ) : ?>
                        <span class="bdt-carousel-button-icon bdt-flex-align-<?php
                            echo esc_attr( $settings['icon_align'] ); ?>">

						<?php
                            if ( $is_new || $migrated ) :
                                Icons_Manager::render_icon( $settings['carousel_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw'] );
                            else : ?>
                                <i class="<?php
                                    echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
                            <?php
                            endif; ?>

					</span>
                    <?php
                    endif; ?>
			</span>

            </a>
            <?php
        }
        
        public function render_loop_header() {
            global $post;
            
            $tags_classes = array_map( function ( $tag ) {
                return 'bdt-carousel-filter-' . $tag->term_id;
            }, $post->tags );
            
            $classes = [
                'bdt-carousel-item',
                'swiper-slide',
                implode( ' ', $tags_classes ),
            ];
            
            ?>
            <div <?php
            post_class( $classes ); ?>>
            <?php
        }
        
        public function render_post_footer() {
            ?>
            </div>
            <?php
        }
        
        public function render_overlay_header() {
            $classes = ['bdt-carousel-desc'];
            if ( $this->get_settings( 'item_padding' ) == '' ) :
                $classes[] = 'bdt-margin-top';
            endif; ?>
            <div class="<?php
                echo implode( " ", $classes ); ?>">
            <?php
        }
        
        public function render_overlay_footer() {
            ?>
            </div>
            <?php
        }
        
        public function render_header( $skin = "default" ) {
            $settings = $this->get_settings_for_display();

            //Global Function
		    $this->render_swiper_header_attribute( 'carousel');

            if ( 'yes' == $settings['match_height'] ) {
                $this->add_render_attribute( 'carousel', 'bdt-height-match', 'target: > div > div > .bdt-carousel-item' );
            }
            
            $this->add_render_attribute( 'carousel', 'class', ['bdt-carousel', 'bdt-carousel-skin-' . $skin] );
            
            ?>
            <div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
            <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php
        }
        
        public function render_post() {
            $this->render_loop_header();
            $this->render_thumbnail();
            $this->render_overlay_header();
            $this->render_title();
            $this->render_meta_data();
            $this->render_excerpt();
            $this->render_readmore();
            $this->render_overlay_footer();
            $this->render_post_footer();
        }
    }
