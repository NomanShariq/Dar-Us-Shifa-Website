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

class Helpo_Tabs_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_tabs';
    }

    public function get_title() {
        return esc_html__('Tabs', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['tabs_widget'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Tabs', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'view_type',
            [
                'label' => esc_html__('View Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'helpo_plugin'),
                    'vertical' => esc_html__('Vertical', 'helpo_plugin')
                ],
                'separator' => 'after'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Tab Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Tab Title', 'helpo_plugin')
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label' => esc_html__('Content Type', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__('Text', 'helpo_plugin'),
                    'gallery' => esc_html__('Gallery', 'helpo_plugin'),
                    'video' => esc_html__('Video', 'helpo_plugin')
                ]
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Tab Content', 'helpo_plugin'),
                'type' => Controls_Manager::WYSIWYG,
                'condition' => [
                    'content_type' => 'text'
                ]
            ]
        );

        $repeater->add_control(
            'gallery',
            [
                'label' => esc_html__('Add Images', 'elementory'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
                'condition' => [
                    'content_type' => 'gallery'
                ]
            ]
        );

        $repeater->add_control(
            'video_link',
            [
                'label' => esc_html__('Enter Video Link', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => '',
                'default' => '',
                'condition' => [
                    'content_type' => 'video'
                ]
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Preview Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'content_type' => 'video'
                ]
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Play Button Text', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Enter Play Button Text', 'helpo_plugin'),
                'default' => esc_html__('Watch Our Video', 'helpo_plugin'),
                'condition' => [
                    'content_type' => 'video'
                ]
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Tabs', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{title}}}',
                'prevent_empty' => false
            ]
        );

        $this->end_controls_section();

        // ----------------------------------- //
        // ---------- Text Settings ---------- //
        // ----------------------------------- //
        $this->start_controls_section(
            'section_content_text_settings',
            [
                'label' => esc_html__('Text Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Tab Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_title_item a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'active_title_color',
            [
                'label' => esc_html__('Active Tab Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_title_item.active a, {{WRAPPER}} .helpo_tab_title_item a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'marker_color',
            [
                'label' => esc_html__('Active Tab Marker Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_title_item.active a, {{WRAPPER}} .helpo_tab_title_item a:hover' => 'border-color: {{VALUE}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => esc_html__('Text Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_tab_text_container'
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_text_container' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // -------------------------------------- //
        // ---------- Gallery Settings ---------- //
        // -------------------------------------- //
        $this->start_controls_section(
            'section_content_gallery_settings',
            [
                'label' => esc_html__('Gallery Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => esc_html__('Columns', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 4,
                'options' => [
                    2 => esc_html__('Two Columns', 'helpo_plugin'),
                    3 => esc_html__('Three Columns', 'helpo_plugin'),
                    4 => esc_html__('Four Columns', 'helpo_plugin')
                ]
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
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_gallery_container' => 'margin-left: -{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_tab_gallery_item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'gallery_radius',
            [
                'label' => esc_html__('Images Border Radius', 'helpo_plugin'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_gallery_wrapper a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'gallery_color',
            [
                'label' => esc_html__('Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_tab_gallery_wrapper a:before' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Video Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_content_video_settings',
            [
                'label' => esc_html__('Video Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label' => esc_html__('Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_overlay' => 'background: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
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
            'icon_button_size',
            [
                'label' => esc_html__('Trigger Button Size', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button_icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_button_icon i' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_button_icon i' => 'font-size: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Button Text Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_button_text'
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
                    'icon_color',
                    [
                        'label' => esc_html__('Icon Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button .helpo_button_icon' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_bg',
                    [
                        'label' => esc_html__('Icon Background', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button .helpo_button_icon' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_text_color',
                    [
                        'label' => esc_html__('Button Text Color', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button .helpo_button_text' => 'color: {{VALUE}};'
                        ]
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
                    'icon_hover',
                    [
                        'label' => esc_html__('Icon Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button:hover .helpo_button_icon' => 'color: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'icon_bg_hover',
                    [
                        'label' => esc_html__('Icon Background Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button:hover .helpo_button_icon' => 'background: {{VALUE}};'
                        ]
                    ]
                );

                $this->add_control(
                    'button_text_hover',
                    [
                        'label' => esc_html__('Button Text Hover', 'helpo_plugin'),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .helpo_video_trigger_button:hover .helpo_button_text' => 'color: {{VALUE}};'
                        ]
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $tabs = $settings['tabs'];
        $columns = $settings['columns'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_tabs_widget helpo_tabs_<?php echo esc_attr($view_type); ?>">
            <div class="helpo_tabs_titles_container">
                <?php
                $i = 1;

                foreach ($tabs as $tab) {
                    ?>
                    <div class="helpo_tab_title_item" data-id="helpo_tab_id_<?php echo esc_attr($this->get_id()); ?>_<?php echo esc_attr($i); ?>">
                        <a href="<?php echo esc_js('javascript:void(0)'); ?>"><?php echo esc_html($tab['title']); ?></a>
                    </div>
                    <?php

                    $i++;
                }
                ?>
            </div>

            <div class="helpo_tabs_content_container">
                <?php
                $i = 1;

                foreach ($tabs as $tab) {
                    ?>
                    <div class="helpo_tab_content_item" id="helpo_tab_id_<?php echo esc_attr($this->get_id()); ?>_<?php echo esc_attr($i); ?>">
                        <?php
                        // ----------------- //
                        // --- Text Type --- //
                        // ----------------- //
                        if ($tab['content_type'] == 'text') {
                            ?>
                            <div class="helpo_tab_text_container">
                                <?php
                                echo helpo_output_code($tab['text']);
                                ?>
                            </div>
                            <?php
                        }

                        // ------------------ //
                        // --- Video Type --- //
                        // ------------------ //
                        if ($tab['content_type'] == 'video') {
                            ?>
                            <div class="helpo_tab_video_container">
                                <div class="helpo_preview_container">
                                    <img src="<?php echo esc_url($tab['image']['url']); ?>" alt="<?php echo esc_html__('Video Preview Image', 'helpo_plugin'); ?>" />
                                    <div class="helpo_overlay"></div>
                                    <a class="helpo_video_trigger_button" href="<?php echo esc_js('javascript:void(0)'); ?>">
                                        <span class="helpo_button_icon"><i class="fa fa-play"></i></span>
                                        <?php
                                        if ($tab['button_text'] !== '') {
                                            ?>
                                            <span class="helpo_button_text"><?php echo esc_html($tab['button_text']); ?></span>
                                            <?php
                                        }
                                        ?>
                                    </a>
                                </div>

                                <?php
                                if ($tab['video_link'] !== '') {
                                    ?>
                                    <div class="helpo_video_container">
                                        <div class="helpo_close_popup_layer">
                                            <div class="helpo_close_button">
                                                <svg viewBox="0 0 40 40"><path d="M10,10 L30,30 M30,10 L10,30"></path></svg>
                                            </div>
                                        </div>
                                        <div class="helpo_video_wrapper" data-src="<?php echo esc_url($tab['video_link']); ?>"></div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }

                        // -------------------- //
                        // --- Gallery Type --- //
                        // -------------------- //
                        if ($tab['content_type'] == 'gallery') {
                            ?>
                            <div class="helpo_tab_gallery_container helpo_columns_<?php echo esc_attr($columns); ?>">
                                <?php
                                foreach ($tab['gallery'] as $image) {
                                    $image_url = $image['url'];
                                    $image_meta = helpo_get_attachment_meta($image['id']);
                                    $image_alt_text = $image_meta['alt'];

                                    if ($columns == 2) {
                                        $image_src = aq_resize(esc_url($image_url), 960, 960, true, true, true);
                                    }

                                    if ($columns == 3) {
                                        $image_src = aq_resize(esc_url($image_url), 640, 640, true, true, true);
                                    }

                                    if ($columns == 4) {
                                        $image_src = aq_resize(esc_url($image_url), 480, 480, true, true, true);
                                    }
                                    ?>
                                    <div class="helpo_tab_gallery_item">
                                        <div class="helpo_tab_gallery_wrapper">
                                            <a href="<?php echo esc_url($image_url); ?>" data-fancybox="simple-gallery" data-elementor-open-lightbox="no">
                                                <img src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                                            </a>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php

                    $i++;
                }
                ?>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}
