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

class Helpo_Cause_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_cause_item';
    }

    public function get_title() {
        return esc_html__('Cause Item', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-gallery-group';
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
                'label' => esc_html__('Cause Item', 'helpo_plugin')
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
            'cause_item',
            [
                'label' => esc_html__('Choose Cause Item', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT2,
                'options' => $causes_list,
                'label_block' => true,
                'multiple' => false
            ]
        );

        $this->add_control(
            'donate_goal',
            [
                'label' => esc_html__('Donation Goal', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Cause Item Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Image Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__img:after' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'overlay_opacity',
            [
                'label' => esc_html__('Overlay Opacity', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => .01
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__img:after' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control(
            'cat_color',
            [
                'label' => esc_html__('Category Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__badge' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'cat_bg_color',
            [
                'label' => esc_html__('Category Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__badge' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__title a' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .projects-masonry__title a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .projects-masonry__title'
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
                    '{{WRAPPER}} .projects-masonry__title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => esc_html__('Excerpt Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_excerpt' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => esc_html__('Excerpt Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_excerpt'
            ]
        );

        $this->add_control(
            'details_color',
            [
                'label' => esc_html__('Details Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__details-holder' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'details_typography',
                'label' => esc_html__('Details Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .projects-masonry__details-holder'
            ]
        );

        $this->add_control(
            'details_margin',
            [
                'label' => esc_html__('Space Before Details', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .projects-masonry__details-holder' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $cause_item_id = $settings['cause_item'];
        $donate_goal = $settings['donate_goal'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_cause_item_widget">
            <div class="helpo_cause_item_wrapper">
                <?php
                $cause_item = get_post($cause_item_id);
                $featured_image_url = get_the_post_thumbnail_url($cause_item_id, 'full');

                $terms = get_the_terms($cause_item_id, 'causes-category');
                $categories = array();

                if (is_array($terms)) {
                    foreach ($terms as $term) {
                        $categories[] = '
                                    <span class="projects-masonry__badge">' . esc_html($term->name) . '</span>
                                ';
                    }
                }

                $helpo_excerpt = substr($cause_item->post_excerpt, 0, 100);
                ?>

                <div class="projects-masonry__item projects-masonry__item--height-2 projects-masonry__item--primary">
                    <div class="projects-masonry__img">
                        <img class="img--bg" src="<?php echo esc_url($featured_image_url); ?>" alt="<?php echo esc_html__('Image', 'helpo_plugin'); ?>" />

                        <div class="projects-masonry__inner">
                            <?php echo (is_array($categories) ? join('', $categories) : ''); ?>

                            <h3 class="projects-masonry__title">
                                <a href="<?php echo esc_url(get_permalink($cause_item_id)); ?>"><?php echo esc_html($cause_item->post_title); ?></a>
                            </h3>

                            <p class="helpo_excerpt"><?php echo esc_html($helpo_excerpt); ?></p>

                            <div class="projects-masonry__details-holder">
                                <?php
                                if ($donate_goal !== '') {
                                    ?>
                                    <div class="projects-masonry__details-item">
                                        <span><?php echo esc_html__('Goal: ', 'helpo_plugin'); ?></span>
                                        <?php echo esc_html($donate_goal); ?>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="projects-masonry__details-item">
                                    <span><?php echo esc_html__('Date: ', 'helpo_plugin'); ?></span>
                                    <?php echo get_the_date(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}