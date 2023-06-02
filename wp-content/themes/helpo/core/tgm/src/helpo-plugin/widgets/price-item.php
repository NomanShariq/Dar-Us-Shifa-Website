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

class Helpo_Price_Item_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_price_item';
    }

    public function get_title() {
        return esc_html__('Price Item', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-price-table';
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
                'label' => esc_html__('Price Item', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'vertical',
                'options' => [
                    'vertical' => esc_html__('Vertical', 'helpo_plugin'),
                    'horizontal' => esc_html__('Horizontal', 'helpo_plugin')
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'currency',
            [
                'label' => esc_html__('Currency', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '$',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'currency_position',
            [
                'label' => esc_html__('Currency Position', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'before',
                'options' => [
                    'before' => esc_html__('Before Price', 'helpo_plugin'),
                    'after' => esc_html__('After Price', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'price',
            [
                'label' => esc_html__('Price', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'period',
            [
                'label' => esc_html__('Period', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('month', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'custom_fields',
            [
                'label' => esc_html__('Custom Fields', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => [
                    [
                        'name' => 'text',
                        'label' => esc_html__( 'Text', 'helpo_plugin' ),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => '',
                        'placeholder' => esc_html__( 'Enter Text', 'helpo_plugin' ),
                    ],

                    [
                        'name' => 'active_field_status',
                        'label' => esc_html__( 'Active Field', 'helpo_plugin' ),
                        'type' => Controls_Manager::SWITCHER,
                        'label_off' => esc_html__('No', 'helpo_plugin'),
                        'label_on' => esc_html__('Yes', 'helpo_plugin'),
                        'default' => 'yes'
                    ]
                ],
                'title_field' => '{{{text}}}',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'separator' => 'before',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->add_control(
            'price_button_text',
            [
                'label' => esc_html__('Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Get Started', 'helpo_plugin'),
                'placeholder' => esc_html__('Button Text', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Link', 'helpo_plugin'),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://your-link.com',
                'default' => [
                    'url' => '#',
                ]
            ]
        );

        $this->end_controls_section();

        // ----------------------------------------- //
        // ---------- Price Item Settings ---------- //
        // ----------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Price Item Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => esc_html__('Price Item Padding', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'item_bg',
            [
                'label' => esc_html__('Price Item Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_item' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'item_radius',
            [
                'label' => esc_html__('Price Item Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__( 'Price Item Border', 'elementory' ),
                'placeholder' => '2px',
                'default' => '2px',
                'selector' => '{{WRAPPER}} .helpo_price_item',
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'item_shadow',
                'selector' => '{{WRAPPER}} .helpo_price_item',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Content Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_content_settings',
            [
                'label' => esc_html__('Content Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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
                    '{{WRAPPER}} .helpo_price_title' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_price_title'
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'price_margin',
            [
                'label' => esc_html__('Space After Price', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_container' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'price_typography',
                'label' => esc_html__('Price Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_price, {{WRAPPER}} .helpo_currency'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'period_typography',
                'label' => esc_html__('Period Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_period'
            ]
        );

        $this->add_control(
            'price_color',
            [
                'label' => esc_html__('Price Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_container, {{WRAPPER}} .helpo_price_container .helpo_price' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'fields_margin',
            [
                'label' => esc_html__('Space Between Custom Fields', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_custom_field' => 'margin-bottom: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'fields_typography',
                'label' => esc_html__('Custom Fields Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_custom_field',
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'fields_color',
            [
                'label' => esc_html__('Custom Fields Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_custom_field' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_control(
            'active_fields_color',
            [
                'label' => esc_html__('Active Fields Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_custom_field.helpo_active_field' => 'color: {{VALUE}};'
                ],
                'separator' => 'after',
                'condition' => [
                    'view_type' => 'vertical'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => esc_html__('Description Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_price_description',
                'condition' => [
                    'view_type' => 'horizontal'
                ]
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('description Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_description' => 'color: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'horizontal'
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

        $this->add_control(
            'button_margin',
            [
                'label' => esc_html__('Space Before Button', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_price_button_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'view_type' => 'vertical'
                ]
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

        $view_type = $settings['view_type'];
        $title = $settings['title'];
        $currency = $settings['currency'];
        $currency_position = $settings['currency_position'];
        $price = $settings['price'];
        $period = $settings['period'];
        $custom_fields = $settings['custom_fields'];
        $description = $settings['description'];
        $price_button_text = $settings['price_button_text'];
        $button_link = $settings['button_link'];

        if ($button_link['url'] !== '') {
            $button_url = $button_link['url'];
        } else {
            $button_url = '#';
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_price_item_widget">
            <div class="helpo_price_item helpo_type_<?php echo esc_attr($view_type); ?>">
                <?php
                // -------------------------- //
                // --- View Type Vertical --- //
                // -------------------------- //
                if ($view_type == 'vertical') {
                    if ($title !== '') {
                        ?>
                        <h6 class="helpo_price_title"><?php echo esc_html($title); ?></h6>
                        <?php
                    }

                    if ($price !== '') {
                        ?>
                        <div class="helpo_price_container helpo_currency_position_<?php echo esc_attr($currency_position); ?>">
                            <span class="helpo_price_wrapper">
                                <?php
                                if ($currency !== '') {
                                    if ($currency_position == 'before') {
                                        ?>
                                        <span class="helpo_currency"><?php echo esc_html($currency); ?></span>
                                        <?php
                                    }
                                }
                                ?>

                                <span class="helpo_price"><?php echo esc_html($price); ?></span>

                                <?php
                                if ($currency !== '') {
                                    if ($currency_position == 'after') {
                                        ?>
                                        <span class="helpo_currency"><?php echo esc_html($currency); ?></span>
                                        <?php
                                    }
                                }
                                ?>
                            </span>

                            <?php
                            if ($period !== '') {
                                ?>
                                <span class="helpo_period"><?php echo esc_html($period); ?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }

                    if (!empty($custom_fields)) {
                        ?>
                        <div class="helpo_custom_fields_container">
                            <?php
                            foreach ($custom_fields as $field) {
                                if ($field['active_field_status'] == 'yes') {
                                    $field_status_class = 'helpo_active_field';
                                } else {
                                    $field_status_class = '';
                                }
                                ?>

                                <div class="helpo_custom_field <?php echo esc_attr($field_status_class); ?>"><?php echo esc_html($field['text']); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="helpo_price_button_container">
                        <a class="helpo_button helpo_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($price_button_text); ?></a>
                    </div>
                    <?php
                }

                // ---------------------------- //
                // --- View Type Horizontal --- //
                // ---------------------------- //
                if ($view_type == 'horizontal') {
                    ?>
                    <div class="row align-items-center">
                        <div class="col-lg-2">
                            <?php
                            if ($title !== '') {
                                ?>
                                <h6 class="helpo_price_title"><?php echo esc_html($title); ?></h6>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-5">
                            <?php
                            if ($description !== '') {
                                ?>
                                <span class="helpo_price_description"><?php echo esc_html($description); ?></span>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-2">
                            <?php
                            if ($price !== '') {
                                ?>
                                <div class="helpo_price_container helpo_currency_position_<?php echo esc_attr($currency_position); ?>">
                                    <span class="helpo_price_wrapper">
                                        <?php
                                        if ($currency !== '') {
                                            if ($currency_position == 'before') {
                                                ?>
                                                <span class="helpo_currency"><?php echo esc_html($currency); ?></span>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <span class="helpo_price"><?php echo esc_html($price); ?></span>

                                        <?php
                                        if ($currency !== '') {
                                            if ($currency_position == 'after') {
                                                ?>
                                                <span class="helpo_currency"><?php echo esc_html($currency); ?></span>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </span>

                                    <?php
                                    if ($period !== '') {
                                        ?>
                                        <span class="helpo_period"><?php echo esc_html($period); ?></span>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <div class="col-lg-3">
                            <div class="helpo_price_button_container">
                                <a class="helpo_button helpo_button--primary" href="<?php echo esc_url($button_url); ?>" <?php echo (($button_link['is_external'] == true) ? 'target="_blank"' : ''); echo (($button_link['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><?php echo esc_html($price_button_text); ?></a>
                            </div>
                        </div>
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