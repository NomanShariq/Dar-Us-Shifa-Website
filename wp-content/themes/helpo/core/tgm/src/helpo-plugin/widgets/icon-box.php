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

class Helpo_Icon_Box_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_icon_box';
    }

    public function get_title() {
        return esc_html__('Icon Box', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-icon-box';
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
                'label' => esc_html__('Icon Box', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'icon_type',
            [
                'label' => esc_html__('Type of Icon', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default Icon', 'helpo_plugin'),
                    'svg' => esc_html__('SVG Icon', 'helpo_plugin')
                ]
            ]
        );

        $this->add_control(
            'default_icon',
            [
                'label' => esc_html__('Icon', 'helpo_plugin'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid'
                ],
                'condition' => [
                    'icon_type' => 'default'
                ]
            ]
        );

        $this->add_control(
            'svg_icon',
            [
                'label' => esc_html__('SVG Icon', 'helpo_plugin'),
                'description' => esc_html__('Enter svg code', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'condition' => [
                    'icon_type' => 'svg'
                ]
            ]
        );

        $this->add_control(
            'bg_image_status',
            [
                'label' => esc_html__('Background Image', 'helpo_plugin'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'helpo_plugin'),
                'label_on' => esc_html__('On', 'helpo_plugin'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Choose Background Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [],
                'condition' => [
                    'bg_image_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Icon Box Title', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Title', 'helpo_plugin'),
                'placeholder' => esc_html__('Enter Icon Box Title', 'helpo_plugin'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info_type',
            [
                'label' => esc_html__('Type of Icon Box Information', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'info',
                'label_block' => true,
                'options' => [
                    'info' => esc_html__('Custom Information', 'helpo_plugin'),
                    'socials' => esc_html__('Social Icons', 'helpo_plugin')
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'info',
            [
                'label' => esc_html__('Icon Box Information', 'helpo_plugin'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => esc_html__('Enter Your Custom Information', 'helpo_plugin'),
                'condition' => [
                    'info_type' => 'info'
                ]
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label' => esc_html__('Icon', 'helpo_plugin'),
                'type' => Controls_Manager::ICONS,
                'label_block' => true,
                'fa4compatibility' => 'social',
                'default' => [
                    'value' => 'fab fa-wordpress',
                    'library' => 'brand'
                ]
            ]
        );

        $repeater->add_control(
            'social_link',
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
            'socials',
            [
                'label' => esc_html__('Social Icons', 'helpo_plugin'),
                'type' => Controls_Manager::REPEATER,
                'default' => [],
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{elementor.helpers.renderIcon(this, social_icon, {}, "i", "panel")}}}',
                'prevent_empty' => false,
                'condition' => [
                    'info_type' => 'socials'
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_box_align',
            [
                'label' => esc_html__('Icon Box Alignment', 'helpo_plugin'),
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_box_item' => 'text-align: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // --------------------------------------- //
        // ---------- Icon Box Settings ---------- //
        // --------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Icon Box Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_container i, {{WRAPPER}} .helpo_icon_container .icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .helpo_icon_container svg' => 'width: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Icon Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_container i, {{WRAPPER}} .helpo_icon_container .icon' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'bg_image_height',
            [
                'label' => esc_html__('Background Image Size', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 85,
                'min' => 10,
                'condition' => [
                    'bg_image_status' => 'yes'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'bg_image_position',
            [
                'label' => esc_html__('Background Image Position', 'helpo_plugin'),
                'type' => Controls_Manager::SELECT,
                'default' => 'center_center',
                'options' => [
                    'top_left' =>  esc_html__('Top Left', 'helpo_plugin'),
                    'top_center' =>  esc_html__('Top Center', 'helpo_plugin'),
                    'top_right' =>  esc_html__('Top Right', 'helpo_plugin'),
                    'center_left' =>  esc_html__('Center Left', 'helpo_plugin'),
                    'center_center' =>  esc_html__('Center Center', 'helpo_plugin'),
                    'center_right' =>  esc_html__('Center Right', 'helpo_plugin'),
                    'bottom_left' =>  esc_html__('Bottom Left', 'helpo_plugin'),
                    'bottom_center' =>  esc_html__('Bottom Center', 'helpo_plugin'),
                    'bottom_right' =>  esc_html__('Bottom Right', 'helpo_plugin'),
                ],
                'label_block' => true,
                'condition' => [
                    'bg_image_status' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_box_title' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__('Title Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_icon_box_title'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => esc_html__('Space Between Icon and Title', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_box_title' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => esc_html__('Information Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_container, {{WRAPPER}} .helpo_info_container a' => 'color: {{VALUE}};'
                ],
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => esc_html__('Information Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_info_container',
                'condition' => [
                    'info_type' => 'info'
                ]
            ]
        );

        $this->add_responsive_control(
            'socials_size',
            [
                'label' => esc_html__('Social Icons Size', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 5,
                        'max' => 100
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_icon_box_socials li a' => 'font-size: {{SIZE}}{{UNIT}};'
                ],
                'condition' => [
                    'info_type' => 'socials'
                ]
            ]
        );

        $this->add_responsive_control(
            'info_margin',
            [
                'label' => esc_html__('Space Between Title and Information Block', 'helpo_plugin'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .helpo_info_container' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $icon_type = $settings['icon_type'];
        $default_icon = $settings['default_icon'];
        $svg_icon = $settings['svg_icon'];
        $bg_image_status = $settings['bg_image_status'];
        $title = $settings['title'];
        $info_type = $settings['info_type'];
        $info = $settings['info'];
        $socials = $settings['socials'];
        $bg_image_height = $settings['bg_image_height'];
        $bg_image_position = $settings['bg_image_position'];

        if ($bg_image_status == 'yes') {
            $bg_image = $settings['bg_image'];
        } else {
            $bg_image = array();
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_icon_box_widget">
            <div class="helpo_icon_box_item">
                <div class="helpo_icon_container <?php echo (($bg_image_status == 'yes') ? 'helpo_bg_image_position_' . $bg_image_position . '' : ''); ?>">
                    <?php
                    if ($icon_type == 'default') {
                        ?>
                        <i class="<?php echo esc_attr($default_icon['value']); ?>"></i>
                        <?php
                    } else {
                        echo helpo_output_code($svg_icon);
                    }

                    if ($bg_image_status == 'yes') {
                        ?>
                        <img class="helpo_bg_image" src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php echo esc_html__('Background Image', 'helpo_plugin'); ?>" style="height: <?php echo esc_attr($bg_image_height); ?>px;" />
                        <?php
                    }
                    ?>
                </div>

                <?php
                if ($title !== '') {
                    ?>
                    <h4 class="helpo_icon_box_title"><?php echo helpo_output_code($title); ?></h4>
                    <?php
                }
                ?>

                <?php
                if ($info !== '' || !empty($socials)) {
                    ?>
                    <div class="helpo_info_container">
                        <?php
                        if ($info_type == 'info') {
                            if ($info !== '') {
                                ?>
                                <p><?php echo helpo_output_code($info); ?></p>
                                <?php
                            }
                        } else {
                            if (!empty($socials)) {
                                ?>
                                <ul class="helpo_icon_box_socials">
                                    <?php
                                    foreach ($socials as $social) {
                                        if ($social['social_link']['url'] !== '') {
                                            $social_url = $social['social_link']['url'];
                                        } else {
                                            $social_url = '#';
                                        }
                                        ?>

                                        <li>
                                            <a href="<?php echo esc_url($social_url); ?>" <?php echo (($social['social_link']['is_external'] == true) ? 'target="_blank"' : ''); echo (($social['social_link']['nofollow'] == 'on') ? 'rel="nofollow"' : ''); ?>><i class="<?php echo esc_attr($social['social_icon']['value']); ?>"></i></a>
                                        </li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                                <?php
                            }
                        }
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