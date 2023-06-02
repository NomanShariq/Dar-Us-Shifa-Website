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

class Helpo_Person_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_person';
    }

    public function get_title() {
        return esc_html__('Person', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-person';
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
                'label' => esc_html__('Person', 'helpo_plugin')
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
                    'type_3' => esc_html__('View Type 3', 'helpo_plugin'),
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'person_name',
            [
                'label' => esc_html__('Person Name', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'person_position',
            [
                'label' => esc_html__('Person Position', 'helpo_plugin'),
                'type' => Controls_Manager::TEXT,
                'default' => ''
            ]
        );

        $this->add_control(
            'person_image',
            [
                'label' => esc_html__('Person Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
                'separator' => 'before',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Choose Background Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'bg_image_status' => 'yes',
                    'view_type!' => 'type_3'
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
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // ------------------------------------- //
        // ---------- Person Settings ---------- //
        // ------------------------------------- //
        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Person Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label' => esc_html__('Person Image Size', 'helpo_plugin'),
                'type' => Controls_Manager::NUMBER,
                'default' => 170,
                'min' => 20,
                'separator' => 'after',
                'condition' => [
                    'view_type!' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'item_bg_hover',
            [
                'label' => esc_html__('Person Overlay Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '#343877',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_wrapper:hover' => 'background: {{VALUE}};'
                ],
                'separator' => 'after',
                'condition' => [
                    'view_type' => 'type_1'
                ]
            ]
        );

        $this->add_control(
            'item_type_3_bg_color',
            [
                'label' => esc_html__('Person Item Background', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_item_type_3' => 'background: {{VALUE}};'
                ],
                'condition' => [
                    'view_type' => 'type_3'
                ]
            ]
        );

        $this->add_control(
            'item_type_3_bg_hover',
            [
                'label' => esc_html__('Person Item Background Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '#343877',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_item_type_3:hover, {{WRAPPER}} .helpo_person_socials' => 'background: {{VALUE}};'
                ],
                'separator' => 'after',
                'condition' => [
                    'view_type' => 'type_3'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'name_typography',
                'label' => esc_html__('Person Name Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_person_name'
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Person Name Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_name' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'name_hover',
            [
                'label' => esc_html__('Person Name Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_wrapper:hover .helpo_person_name' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'position_typography',
                'label' => esc_html__('Person Position Typography', 'helpo_plugin'),
                'selector' => '{{WRAPPER}} .helpo_person_position'
            ]
        );

        $this->add_control(
            'position_color',
            [
                'label' => esc_html__('Person Position Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_position' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'position_hover',
            [
                'label' => esc_html__('Person Position Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_wrapper:hover .helpo_person_position' => 'color: {{VALUE}};'
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'socials_color',
            [
                'label' => esc_html__('Socials Color', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_socials a' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->add_control(
            'socials_hover',
            [
                'label' => esc_html__('Socials Hover', 'helpo_plugin'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .helpo_person_socials a:hover' => 'color: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $view_type = $settings['view_type'];
        $person_name = $settings['person_name'];
        $person_position = $settings['person_position'];
        $person_image = $settings['person_image'];
        $bg_image_status = $settings['bg_image_status'];
        $socials = $settings['socials'];
        $image_size = $settings['image_size'];

        if ($bg_image_status == 'yes') {
            $bg_image = $settings['bg_image'];
        } else {
            $bg_image = array();
        }

        $image_meta = helpo_get_attachment_meta($person_image['id']);
        $image_alt_text = $image_meta['alt'];

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_person_widget">
            <div class="helpo_person_wrapper helpo_view_<?php echo esc_attr($view_type); ?>">
                <?php
                // ------------------- //
                // --- View Type 1 --- //
                // ------------------- //
                if ($view_type == 'type_1') {
                    if (!empty($socials)) {
                        ?>
                        <ul class="helpo_person_socials">
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
                    ?>

                    <div class="helpo_person_image_container">
                        <?php
                        if ($bg_image_status == 'yes') {
                            ?>
                            <img class="helpo_person_bg_image" src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php esc_html__('Person Background Image', 'helpo_plugin') ?>" />
                            <?php
                        }
                        ?>
                        <div class="helpo_person_image_wrapper" style="width: <?php echo esc_attr($image_size); ?>px; height: <?php echo esc_attr($image_size); ?>px;">
                            <img src="<?php echo esc_url($person_image['url']); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                        </div>
                    </div>

                    <?php
                    if ($person_name !== '' || $person_position !== '') {
                        ?>
                        <div class="helpo_person_description_container">
                            <?php
                            if ($person_name !== '') {
                                ?>
                                <div class="helpo_person_name"><?php echo esc_html($person_name); ?></div>
                                <?php
                            }

                            if ($person_position !== '') {
                                ?>
                                <div class="helpo_person_position"><?php echo esc_html($person_position); ?></div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                }

                // ------------------- //
                // --- View Type 2 --- //
                // ------------------- //
                if ($view_type == 'type_2') {
                    ?>
                    <div class="helpo_person_item_type_2">
                        <div class="helpo_person_image_container">
                            <?php
                            if ($bg_image_status == 'yes') {
                                ?>
                                <img class="helpo_person_bg_image" src="<?php echo esc_url($bg_image['url']); ?>" alt="<?php esc_html__('Person Background Image', 'helpo_plugin') ?>" />
                                <?php
                            }
                            ?>
                            <div class="helpo_person_image_wrapper" style="width: <?php echo esc_attr($image_size); ?>px; height: <?php echo esc_attr($image_size); ?>px;">
                                <img src="<?php echo esc_url($person_image['url']); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />
                            </div>
                        </div>

                        <?php
                        if ($person_name !== '' || $person_position !== '' || !empty($socials)) {
                            ?>
                            <div class="helpo_person_info_container">
                                <?php
                                if ($person_name !== '') {
                                    ?>
                                    <div class="helpo_person_name"><?php echo esc_html($person_name); ?></div>
                                    <?php
                                }

                                if ($person_position !== '') {
                                    ?>
                                    <div class="helpo_person_position"><?php echo esc_html($person_position); ?></div>
                                    <?php
                                }

                                if (!empty($socials)) {
                                    ?>
                                    <ul class="helpo_person_socials">
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
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }

                // ------------------- //
                // --- View Type 3 --- //
                // ------------------- //
                if ($view_type == 'type_3') {
                    $person_image_src = aq_resize(esc_url($person_image['url']), 600, 669, true, true, true);

                    ?>
                    <div class="helpo_person_item_type_3">
                        <div class="helpo_person_image_part">
                            <img src="<?php echo esc_url($person_image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />

                            <?php
                            if (!empty($socials)) {
                                ?>
                                <ul class="helpo_person_socials">
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
                            ?>
                        </div>

                        <?php
                        if ($person_name !== '' || $person_position !== '') {
                            ?>
                            <div class="helpo_person_description_container">
                                <?php
                                if ($person_name !== '') {
                                    ?>
                                    <div class="helpo_person_name"><?php echo esc_html($person_name); ?></div>
                                    <?php
                                }

                                if ($person_position !== '') {
                                    ?>
                                    <div class="helpo_person_position"><?php echo esc_html($person_position); ?></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
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
