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

class Helpo_Linked_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_linked_item';
    }

    public function get_title() {
        return esc_html__('Linked Item', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-link';
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
                'label' => esc_html__('Linked Item', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'image_bg',
            [
                'label' => esc_html__('Background Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_control(
            'up_title',
            [
                'label' => esc_html__('Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Up Title', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Up Title', 'helpo_plugin')
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
            'text',
            [
                'label' => esc_html__('Description', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Text', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'link_type',
            [
                'label' => esc_html__('Link Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'all',
                'options' => [
                    'all' => esc_html__('Linked All Item', 'helpo_plugin'),
                    'button' => esc_html__('Linked Button', 'helpo_plugin'),
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'helpo_plugin'),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default' => [
                    'url' => '',
                    'is_external' => 'true',
                ],
                'placeholder' => esc_html__( 'http://your-link.com', 'helpo_plugin' )
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Button', 'helpo_plugin'),
                'condition' => [
                    'link_type' => 'button'
                ]
            ]
        );

        $this->add_responsive_control(
            'item_align',
            [
                'label' => esc_html__('Info Box Alignment', 'helpo_plugin'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'helpo_plugin'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'helpo_plugin'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'helpo_plugin'),
                        'icon' => 'fa fa-align-right',
                    ]
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------------ //
        // ---------- Linked Item Settings ---------- //
        // ------------------------------------------ //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Linked Item Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__('Linked Item Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item .helpo_linked_item_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_overlay' => 'background: {{VALUE}};'
                ],
                'separator' => 'before'
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
                    '{{WRAPPER}} .helpo_overlay' => 'opacity: {{SIZE}};'
                ]
            ]
        );

        $this->add_control(
            'up_title_margin',
            [
                'label' => esc_html__('Space After Up Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item_up_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'up_title_typography',
                'label' => esc_html__('Up Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_linked_item_up_title'
            ]
        );

        $this->add_control(
            'up_title_color',
            [
                'label' => esc_html__('Up Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item_up_title' => 'color: {{VALUE}};'
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
                    '{{WRAPPER}} .helpo_linked_item_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_linked_item_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item_title' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'text_margin',
            [
                'label' => esc_html__('Space After Description', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item_text' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Description Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_linked_item_text'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Description Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_linked_item_text' => 'color: {{VALUE}};'
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
                'label' => esc_html__('Button Settings', 'helpo_plugin'),
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

        $image_bg = $settings['image_bg'];
        $up_title = $settings['up_title'];
        $title = $settings['title'];
        $text = $settings['text'];
        $link_type = $settings['link_type'];
        $link = $settings['link'];
        $button_text = $settings['button_text'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        if ($link['url'] !== '') {
            $link_url = $link['url'];
        } else {
            $link_url = '#';
        }
        ?>

        <div class="helpo_linked_item_widget">
            <div class="helpo_linked_item">
                <?php
                if ($link_type == 'all') {
                    ?>
                    <a class="helpo_linked_item_wrapper" href="<?php echo esc_url($link_url); ?>" <?php echo (($link['is_external'] == true) ? 'target="_blank"' : ''); echo (($link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>>
                    <?php
                } else {
                    ?>
                    <div class="helpo_linked_item_wrapper">
                    <?php
                }
                    ?>
                    <img class="helpo_bg_image" src="<?php echo esc_url($image_bg['url']); ?>" alt="<?php echo esc_html__('Background Image', 'helpo_plugin'); ?>" />
                    <div class="helpo_overlay"></div>
                    <?php
                    if ($up_title !== '') {
                        ?>
                        <span class="helpo_linked_item_up_title"><?php echo helpo_output_code($up_title); ?></span>
                        <?php
                    }

                    if ($title !== '') {
                        ?>
                        <span class="helpo_linked_item_title"><?php echo helpo_output_code($title); ?></span>
                        <?php
                    }

                    if ($text !== '') {
                        ?>
                        <p class="helpo_linked_item_text"><?php echo helpo_output_code($text); ?></p>
                        <?php
                    }

                    if ($link_type == 'button') {
                        ?>
                        <div class="helpo_button_container">
                            <a class="helpo_button helpo_button--primary" href="<?php echo esc_url($link_url); ?>" <?php echo (($link['is_external'] == true) ? 'target="_blank"' : ''); echo (($link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($button_text); ?></a>
                        </div>
                        <?php
                    }

                if ($link_type == 'all') {
                    ?>
                    </a>
                    <?php
                } else {
                    ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}