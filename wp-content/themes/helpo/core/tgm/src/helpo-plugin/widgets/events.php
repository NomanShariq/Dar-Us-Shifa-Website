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

class Helpo_Events_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_events';
    }

    public function get_title() {
        return esc_html__('Events', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    protected function _register_controls() {
        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Events', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'type_1',
                'options' => [
                    'type_1' => esc_html__('View Type 1', 'helpo_plugin'),
                    'type_2' => esc_html__('View Type 2', 'helpo_plugin'),
                ],
                'separator' => 'after'
            ]
        );

        $args = array('post_type' => 'helpo-events', 'numberposts' => '-1');
        $all_events = get_posts($args);
        $events_list = array();

        if ($all_events > 0) {
            foreach ($all_events as $event) {
                setup_postdata($event);
                $events_list[$event->ID] = $event->post_title;
            }
        } else {
            $events_list = array(
                'no_posts' => esc_html__('No Posts Were Found', 'helpo_plugin')
            );
        }

        $this->add_control(
            'events',
            [
                'label' => esc_html__('Choose Event Items', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT2,
                'options' => $events_list,
                'label_block' => true,
                'multiple' => true
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
                ],
                'separator' => 'before'
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

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Events Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'items_padding',
            [
                'label' => esc_html__('Spaces Between Items', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_item' => 'padding-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_events_wrapper' => 'margin-left: -{{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'items_margin',
            [
                'label' => esc_html__('Spaces After Items', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_item_wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'items_wrapper_padding',
            [
                'label' => esc_html__('Item Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_item_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'items_bg_color',
            [
                'label' => esc_html__('Item Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_item_wrapper' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .helpo_event_item_wrapper',
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => esc_html__('Content Part Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_content_container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Space After Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_title, {{WRAPPER}} .upcoming-item__title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_event_title, {{WRAPPER}} .upcoming-item__title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_title a, {{WRAPPER}} .upcoming-item__title a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_hover',
            [
                'label' => esc_html__('Title Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_title a:hover, {{WRAPPER}} .upcoming-item__title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'info_fields_margin',
            [
                'label' => esc_html__('Spaces Between Info Fields', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_content_container p, {{WRAPPER}} .upcoming-item__details p:not(:last-of-type)' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_fields_typography',
                'label' => esc_html__('Info Fields Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_event_content_container p, {{WRAPPER}} .upcoming-item__details p'
            ]
        );

        $this->add_control(
            'info_fields_color',
            [
                'label' => esc_html__('Info Fields Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_content_container p, {{WRAPPER}} .upcoming-item__details p' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_event_content_container .helpo_excerpt'
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_event_content_container .helpo_excerpt' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $events = $settings['events'];
        $post_order_by = $settings['post_order_by'];
        $post_order = $settings['post_order'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_events_widget">
            <div class="helpo_events_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">
                <?php
                $args = array(
                    'post_type' => 'helpo-events',
                    'posts_per_page' => 3,
                    'post__in' => $events,
                    'orderby' => $post_order_by,
                    'order' => $post_order
                );

                query_posts($args);

                while (have_posts()) {
                    the_post();

                    $featured_image_url = helpo_get_featured_image_url();
                    $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                    $featured_image_src = aq_resize(esc_url($featured_image_url), 640, 489, true, true, true);
                    $helpo_excerpt = substr(get_the_excerpt(), 0, 110);

                    // ------------------- //
                    // --- View Type 1 --- //
                    // ------------------- //
                    if ($view_type == 'type_1') {
                        ?>
                        <div class="helpo_event_item">
                            <div class="helpo_event_item_wrapper">
                                <div class="helpo_image_container">
                                    <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                </div>

                                <div class="helpo_event_content_container">
                                    <?php
                                    if (helpo_get_post_option('event_date') !== false) {
                                        ?>
                                        <p><?php echo helpo_output_code(helpo_get_post_option('event_date')); ?></p>
                                        <?php
                                    }
                                    ?>

                                    <h6 class="helpo_event_title">
                                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                    </h6>

                                    <div class="helpo_excerpt">
                                        <?php echo esc_html($helpo_excerpt); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    // ------------------- //
                    // --- View Type 2 --- //
                    // ------------------- //
                    if ($view_type == 'type_2') {
                        $featured_image_url = helpo_get_featured_image_url();
                        $image_alt_text = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
                        $featured_image_src = aq_resize(esc_url($featured_image_url), 640, 546, true, true, true);
                        $helpo_excerpt = substr(get_the_excerpt(), 0, 100);
                        ?>

                        <div class="helpo_event_item">
                            <div class="helpo_event_item_wrapper">
                                <div class="row align-items-center">
                                    <div class="col-lg-5 col-xl-4">
                                        <div class="upcoming-item__img">
                                            <img src="<?php echo esc_url($featured_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                        </div>
                                    </div>

                                    <div class="col-lg-7 col-xl-8">
                                        <div class="upcoming-item__description">
                                            <h6 class="upcoming-item__title">
                                                <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                                            </h6>

                                            <p class="helpo_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                                            <div class="upcoming-item__details">
                                                <?php
                                                if (helpo_get_post_option('event_date') !== false) {
                                                    ?>
                                                    <p class="helpo_event_date">
                                                        <svg class="icon">
                                                            <svg viewBox="0 0 488.878 488.878" id="check-<?php echo mt_rand(0, 99999); ?>" xmlns="http://www.w3.org/2000/svg"><path d="M143.294 340.058l-92.457-92.456L0 298.439l122.009 122.008.14-.141 22.274 22.274L488.878 98.123l-51.823-51.825z"/></svg>
                                                        </svg>
                                                        <?php echo helpo_output_code(helpo_get_post_option('event_date')); ?>
                                                    </p>
                                                    <?php
                                                }

                                                if (helpo_get_post_option('event_time') !== false) {
                                                    ?>
                                                    <p class="helpo_event_time">
                                                        <svg class="icon">
                                                            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ahfeather ahfeather-clock" viewBox="0 0 24 24" id="clock-<?php echo mt_rand(0, 99999); ?>" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                                        </svg>
                                                        <?php echo helpo_output_code(helpo_get_post_option('event_time')); ?>
                                                    </p>
                                                    <?php
                                                }

                                                if (helpo_get_post_option('event_address') !== false) {
                                                    ?>
                                                    <p class="helpo_event_address">
                                                        <svg class="icon">
                                                            <svg fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="aufeather aufeather-map-pin" viewBox="0 0 24 24" id="placeholder-<?php echo mt_rand(0, 99999); ?>" xmlns="http://www.w3.org/2000/svg"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                                        </svg>
                                                        <?php echo helpo_output_code(helpo_get_post_option('event_address')); ?>
                                                    </p>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
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