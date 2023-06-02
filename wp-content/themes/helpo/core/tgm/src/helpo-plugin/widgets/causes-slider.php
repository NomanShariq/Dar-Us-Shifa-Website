<?php
/*
 * Created by Artureanec
*/

namespace Helpo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\REPEATER;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helpo_Causes_Slider_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_causes_slider';
    }

    public function get_title() {
        return esc_html__('Causes Slider', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['causes_slider_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Causes Slider', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('Type 1', 'helpo_plugin'),
                    'type_2' => esc_html__('Type 2', 'helpo_plugin'),
                    'type_3' => esc_html__('Type 3', 'helpo_plugin'),
                    'type_4' => esc_html__('Type 4', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'slider_height',
            [
                'label' => esc_html__('Slider Height', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 450,
                    'unit' => 'px'
                ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 1000
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_causes_list_inner_container' => 'height: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter up title', 'helpo_plugin'),
                'default' => esc_html__('Up Title', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'heading_part_1',
            [
                'label' => esc_html__('Title Part One', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter title part 1', 'helpo_plugin'),
                'default' => esc_html__('Part 1', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'heading_part_2',
            [
                'label' => esc_html__('Title Part Two', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('Enter title part 2', 'helpo_plugin'),
                'default' => esc_html__('Part 2', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'showed_items',
            [
                'label' => esc_html__('Showed Items', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Showed Default Items', 'helpo_plugin'),
                    'custom' => esc_html__('Showed Custom Items', 'helpo_plugin')
                ],
                'separator' => 'before'
            ]
        );

        $args = array('post_type' => 'helpo-causes', 'numberposts' => '-1');
        $all_causes = get_posts($args);
        $causes_list = array();

        if ($all_causes > 0) {
            foreach ($all_causes as $cause) {
                setup_postdata($cause);
                $causes_list[$cause->ID] = $cause->post_title;
            }
        } else {
            $causes_list = array(
                'no_posts' => esc_html__('No Posts Were Found', 'helpo_plugin')
            );
        }

        $this->add_control(
            'causes_items_list',
            [
                'label' => esc_html__('Choose Items', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT2,
                'options' => $causes_list,
                'label_block' => true,
                'multiple' => true,
                'condition' => [
                    'showed_items' => 'custom'
                ]
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => esc_html__('Items Per Page', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'post_order_by',
            [
                'label' => esc_html__('Order By', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'date' => esc_html__('Post Date', 'helpo_plugin'),
                    'rand' => esc_html__('Random', 'helpo_plugin'),
                    'ID' => esc_html__('Post ID', 'helpo_plugin'),
                    'title' => esc_html__('Post Title', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'post_order',
            [
                'label' => esc_html__('Order', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'desc' => esc_html__('Descending', 'helpo_plugin'),
                    'asc' => esc_html__('Ascending', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'popup_button_text',
            [
                'label' => esc_html__('Donate Popup Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+ Donate', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Donate Popup Button Text', 'helpo_plugin'),
                'label_block' => true,
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_2'
                ]
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Animation Speed', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 500,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5000,
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__('Yes', 'helpo_plugin'),
                    'no' => esc_html__('No', 'helpo_plugin'),
                ],
                'condition' => [
                    'autoplay' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'rtl_support',
            [
                'label' => esc_html__('Rtl Support', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'full_mode',
            [
                'label' => esc_html__('Fullwidth Mode', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- General Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_typo_settings',
            [
                'label' => esc_html__('Causes Slider Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_post_title'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_post_excerpt'
            ]
        );

        $this->add_responsive_control(
            'excerpt_length',
            [
                'label' => esc_html__('Excerpt Length', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000
                    ]
                ]
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label' => esc_html__('Space After Excerpt', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_excerpt' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_button'
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__('Space Before Button', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 300
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_donate_button_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Color Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_general_settings',
            [
                'label' => esc_html__('Color Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_bg_color',
            [
                'label' => esc_html__('Causes Items Background Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_container, {{WRAPPER}} .helpo_view_type_3 .helpo_causes_list_wrapper' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'cat_bg',
            [
                'label' => esc_html__('Category Background Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_category_container' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__('Category Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_category_container span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title a' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_post_excerpt' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => esc_html__('Donation Details Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_progress_bar_marker, {{WRAPPER}} .give-goal-progress .raised span, {{WRAPPER}} .give-goal-progress .raised span:before' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => esc_html__('Button Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_bg',
            [
                'label' => esc_html__('Button Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_border',
            [
                'label' => esc_html__('Button Border Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_hover',
            [
                'label' => esc_html__('Button Hover Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_bg_hover',
            [
                'label' => esc_html__('Button Hover Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'button_border_hover',
            [
                'label' => esc_html__('Button Hover Border Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_button:hover' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label' => esc_html__('Slider Navigation Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'nav_bg',
            [
                'label' => esc_html__('Slider Navigation Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nav_border',
            [
                'label' => esc_html__('Slider Navigation Border Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nav_hover',
            [
                'label' => esc_html__('Slider Navigation Hover Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nav_bg_hover',
            [
                'label' => esc_html__('Slider Navigation Hover Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'background-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'nav_border_hover',
            [
                'label' => esc_html__('Slider Navigation Hover Border Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_slider_nav_button:hover' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_up_heading' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_1_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_2_color',
            [
                'label' => esc_html__('Title Part 2 Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_heading span' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $up_title = $settings['up_title'];
        $heading_part_1 = $settings['heading_part_1'];
        $heading_part_2 = $settings['heading_part_2'];
        $showed_items = $settings['showed_items'];
        $posts_per_page = $settings['posts_per_page'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];
        $popup_button_text = $settings['popup_button_text'];
        $full_mode = $settings['full_mode'];
        $excerpt_length = $settings['excerpt_length'];

        if ($showed_items == 'custom') {
            $causes_items_list = $settings['causes_items_list'];
        }

        if ($settings['rtl_support'] == 'yes') {
            $rtl = true;
        } else {
            $rtl = false;
        }

        $slider_options = [
            'pauseOnHover' => ('yes' === $settings['pause_on_hover']),
            'autoplay' => ('yes' === $settings['autoplay']),
            'infinite' => ('yes' === $settings['infinite']),
            'speed' => absint($settings['speed']),
            'rtl' => $rtl
        ];

        if ($settings['autoplay'] == 'yes') {
            $slider_options['autoplaySpeed'] = absint( $settings['autoplay_speed'] );
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_causes_slider_widget">
            <div class="helpo_causes_slider_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">

                <?php
                if ($view_type !== 'type_3') {
                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 helpo_causes_slider_title_part">
                                <?php
                                if ($up_title !== '' || $heading_part_1 !== '' || $heading_part_2 !== '') {
                                    ?>
                                    <div class="helpo_causes_slider_title_cont">
                                        <?php
                                        if ($up_title !== '') {
                                            ?>
                                            <div class="helpo_up_heading"><?php echo esc_html($up_title); ?></div>
                                            <?php
                                        }

                                        if ($heading_part_1 !== '' || $heading_part_2 !== '') {
                                            ?>
                                            <h2 class="helpo_heading">
                                                <?php echo helpo_output_code($heading_part_1); ?>
                                                <span><?php echo helpo_output_code($heading_part_2); ?></span>
                                            </h2>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="helpo_causes_slider_navigation_container">
                                    <div class="helpo_slider_arrows">
                                        <div class="helpo_slider_nav_button helpo_prev">
                                            <i class="fa fa-chevron-left"></i>
                                        </div>

                                        <div class="helpo_slider_nav_button helpo_next">
                                            <i class="fa fa-chevron-right"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="helpo_causes_slider_navigation_container">
                        <div class="helpo_slider_arrows">
                            <div class="helpo_slider_nav_button helpo_prev">
                                <i class="fa fa-chevron-left"></i>
                            </div>

                            <div class="helpo_slider_nav_button helpo_next">
                                <i class="fa fa-chevron-right"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                }

                if ($full_mode == 'yes') {
                    ?>
                    <div class="helpo_offset_container">
                        <div class="helpo_offset_container_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">
                            <?php
                            }
                            ?>

                            <div class="helpo_causes_slider helpo_slider_slick slider_<?php echo esc_attr($view_type); ?>" data-slider-options="<?php echo esc_attr(wp_json_encode($slider_options)); ?>">
                                <?php
                                $args = array(
                                    'post_type' => 'helpo-causes',
                                    'posts_per_page' => $posts_per_page,
                                    'orderby' => $post_order_by,
                                    'order' => $post_order
                                );

                                if ($showed_items == 'custom') {
                                    $args['post__in'] = $causes_items_list;
                                }

                                query_posts($args);

                                while (have_posts()) {
                                    the_post();

                                    ?>
                                    <div class="helpo_causes_list_item">
                                        <div class="helpo_causes_list_wrapper">
                                            <?php
                                            $featured_image_url = helpo_get_featured_image_url();
                                            $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                                            $terms = get_the_terms(get_the_ID(), 'causes-category');
                                            $categories = array();

                                            if (is_array($terms)) {
                                                foreach ($terms as $term) {
                                                    $categories[] = '
                                                    <span class="helpo_category">' . esc_html($term->name) . '</span>
                                                ';
                                                }
                                            }

                                            // ------------------- //
                                            // --- View Type 1 --- //
                                            // ------------------- //
                                            if ($view_type == 'type_1') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 640, 490, true, true, true);

                                                if ($excerpt_length['size'] == '') {
                                                    $excerpt_number = 100;
                                                } else {
                                                    $excerpt_number = $excerpt_length['size'];
                                                }

                                                $helpo_excerpt = substr(get_the_excerpt(), 0, $excerpt_number);

                                                ?>
                                                <div class="helpo_info_container">
                                                    <div class="helpo_causes_list_content_container">
                                                        <h6 class="helpo_post_title">
                                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                                        </h6>

                                                        <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>
                                                    </div>

                                                    <div class="helpo_featured_image_container">
                                                        <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                                        <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                                    </div>

                                                    <?php
                                                    if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                                        ?>
                                                        <div class="helpo_donation_details">
                                                            <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="helpo_donate_button_container">
                                                        <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html($popup_button_text); ?></a>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                            // ------------------- //
                                            // --- View Type 2 --- //
                                            // ------------------- //
                                            if ($view_type == 'type_2') {
                                                if ($excerpt_length['size'] == '') {
                                                    $excerpt_number = 100;
                                                } else {
                                                    $excerpt_number = $excerpt_length['size'];
                                                }

                                                $helpo_excerpt = substr(get_the_excerpt(), 0, $excerpt_number);
                                                ?>
                                                <div class="helpo_causes_list_inner_container">
                                                    <img src="<?php echo esc_url($featured_image_url) ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />

                                                    <div class="helpo_content_container">
                                                        <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                                        <h3 class="helpo_post_title">
                                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                                        </h3>

                                                        <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                                        <div class="helpo_post_meta">
                                                            <?php
                                                            if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                                                ?>
                                                                <div class="helpo_donation_details">
                                                                    <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>

                                                            <div class="helpo_post_date">
                                                                <span><?php echo esc_html__('Date:') ?></span> <?php echo get_the_date(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                            // ------------------- //
                                            // --- View Type 3 --- //
                                            // ------------------- //
                                            if ($view_type == 'type_3') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 770, 572, true, true, true);

                                                if ($excerpt_length['size'] == '') {
                                                    $excerpt_number = 130;
                                                } else {
                                                    $excerpt_number = $excerpt_length['size'];
                                                }

                                                $helpo_excerpt = substr(get_the_excerpt(), 0, $excerpt_number);
                                                ?>

                                                <div class="row align-items-center">
                                                    <div class="col-xl-8">
                                                        <div class="helpo_image_container">
                                                            <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-4">
                                                        <div class="helpo_content_container">
                                                            <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                                            <h6 class="helpo_post_title">
                                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                                            </h6>

                                                            <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                                            <?php
                                                            if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                                                ?>
                                                                <div class="helpo_donation_details">
                                                                    <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>

                                                            <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html($popup_button_text); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }

                                            // ------------------- //
                                            // --- View Type 4 --- //
                                            // ------------------- //
                                            if ($view_type == 'type_4') {
                                                $featured_image_src = aq_resize(esc_url($featured_image_url), 640, 490, true, true, true);

                                                if ($excerpt_length['size'] == '') {
                                                    $excerpt_number = 100;
                                                } else {
                                                    $excerpt_number = $excerpt_length['size'];
                                                }

                                                $helpo_excerpt = substr(get_the_excerpt(), 0, $excerpt_number);

                                                ?>
                                                <div class="helpo_info_container">
                                                    <div class="helpo_causes_list_content_container">
                                                        <h6 class="helpo_post_title">
                                                            <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(Get_the_title()); ?></a>
                                                        </h6>

                                                        <p class="helpo_post_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>
                                                    </div>

                                                    <div class="helpo_featured_image_container">
                                                        <div class="helpo_category_container"><?php echo (is_array($categories) ? join('', $categories) : ''); ?></div>

                                                        <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                                    </div>

                                                    <?php
                                                    if (helpo_get_post_option('cause_donation_shortcode') !== false) {
                                                        ?>
                                                        <div class="helpo_donation_details">
                                                            <?php echo helpo_output_code(helpo_get_post_option('cause_donation_shortcode')); ?>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                    <div class="helpo_donate_button_container">
                                                        <a href="<?php echo esc_js(get_permalink()); ?>" class="helpo_button helpo_button--primary"><?php echo esc_html($popup_button_text); ?></a>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>


                            <?php
                            if ($full_mode == 'yes') {
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
        wp_reset_query();
    }

    protected function content_template() {}

    public function render_plain_content() {}
}