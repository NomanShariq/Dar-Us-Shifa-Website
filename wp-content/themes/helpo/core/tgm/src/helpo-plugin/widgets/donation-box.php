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

class Helpo_Donation_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_donation_box';
    }

    public function get_title() {
        return esc_html__('Donation Box', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-featured-image';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['causes_listing_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Donation Box', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Title', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Title', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Featured Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'current_amount_title',
            [
                'label' => esc_html__('Current Donation Amount Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Donation So Far:', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Current Donation Amount Title', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'current_amount',
            [
                'label' => esc_html__('Current Donation Amount', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => esc_html__('Enter Current Donation Amount', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'donation_shortcode',
            [
                'label' => esc_html__('Donation Shortcode', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Donation Shortcode', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Donation Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('+ Donate', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Donation Button Text', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------------- //
        // ---------- Donation Box Settings ---------- //
        // ------------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Donation Box Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'info_bg',
            [
                'label' => esc_html__('Info Container Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_donate_info_container' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__('Space Between Image and Description Part', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_donate_info_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_donate_title h5'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_donate_title h5' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'amount_typography',
                'label' => esc_html__('Amount Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_current_amount'
            ]
        );

        $this->add_control(
            'amount_title_color',
            [
                'label' => esc_html__('Amount Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_current_amount' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'amount_color',
            [
                'label' => esc_html__('Amount Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_current_amount strong' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Button Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_button_settings',
            [
                'label' => esc_html__('Donate Button Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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

        $this->start_controls_tabs('button_settings_tabs');

            // ------------------------ //
            // ------ Normal Tab ------ //
            // ------------------------ //
            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__('Normal', 'helpo_plugin')
                ]
            );

                $this->add_control(
                    'button_color',
                    [
                        'label' => esc_html__('Button Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button' => 'color: {{VALUE}};'
                        ]
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
                        'label' => esc_html__('Button Border', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'selector' => '{{WRAPPER}} .helpo_button',
                    ]
                );

            $this->end_controls_tab();

            // ----------------------- //
            // ------ Hover Tab ------ //
            // ----------------------- //
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__('Hover', 'helpo_plugin')
                ]
            );

                $this->add_control(
                    'button_color_hover',
                    [
                        'label' => esc_html__('Button Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_bg_hover',
                    [
                        'label' => esc_html__('Button Background Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'background-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_border_hover',
                    [
                        'label' => esc_html__('Button Border Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_button:hover' => 'border-color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow_hover',
                        'selector' => '{{WRAPPER}} .helpo_button:hover',
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'button_radius',
            [
                'label' => esc_html__('Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => esc_html__('Button Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $title = $settings['title'];
        $image = $settings['image'];
        $current_amount_title = $settings['current_amount_title'];
        $current_amount = $settings['current_amount'];
        $donation_shortcode = $settings['donation_shortcode'];
        $button_text = $settings['button_text'];

        $image_src = $image['url'];
        $image_meta = helpo_get_attachment_meta($image['id']);
        $image_alt_text = $image_meta['alt'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_donate_box_widget">
            <div class="helpo_donate_box_item">
                <div class="helpo_image_container">
                    <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                </div>

                <div class="helpo_donate_info_container">
                    <div class="helpo_donate_wrapper">
                        <div class="helpo_donate_title">
                            <h5><?php echo esc_html($title); ?></h5>
                        </div>

                        <div class="helpo_current_amount"><?php echo esc_html($current_amount_title); ?> <strong><?php echo esc_html($current_amount); ?></strong></div>

                        <div class="helpo_donate_button_cont">
                            <a class="helpo_button helpo_button--primary helpo_donate_popup_button" href="<?php echo esc_js('javascript:void(0)'); ?>"><?php echo esc_html($button_text); ?></a>

                            <div class="helpo_close_popup_layer"></div>

                            <div class="helpo_donation_popup">
                                <?php echo helpo_output_code($donation_shortcode); ?>
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