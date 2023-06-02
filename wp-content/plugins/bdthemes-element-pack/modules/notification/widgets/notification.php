<?php

namespace ElementPack\Modules\Notification\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use ElementPack\Element_Pack_Loader;
use ElementPack\Includes\Controls\SelectInput\Dynamic_Select;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Notification extends Module_Base {

    public function get_name() {
        return 'bdt-notification';
    }

    public function get_title() {
        return BDTEP . esc_html__('Notification', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-notification';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['notification', 'alert', 'popup'];
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-notification'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/eI4UG1NYAYk';
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'section_notification_layout',
            [
                'label' => __('Notification', 'bdthemes-element-pack'),
            ]
        );

        $this->add_control(
            'important_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('If you will change the Source Type then sometimes it will not work properly in editor. But if it emergency on editor then you can reload your page to work it perfectly.', 'bdthemes-element-pack'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'condition' => [
                    'notification_type' => 'fixed'
                ]
            ]
        );


        $this->add_control(
            'notification_type',
            [
                'label' => __('Type', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'default' => 'popup',
                'options' => [
                    'popup' => __('Popup', 'bdthemes-element-pack'),
                    'fixed' => __('Fixed', 'bdthemes-element-pack'),
                ],
            ]
        );


        $this->add_control(
            'notification_event',
            [
                'label'   => __('Event', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'onload',
                'options' => [
                    'onload' => __('Page Onload', 'bdthemes-element-pack'),
                    'click'  => __('OnClick', 'bdthemes-element-pack'),
                    'mouseover' => __('OnHover', 'bdthemes-element-pack'),
                    'inDelay'  => __('In time delay', 'bdthemes-element-pack'),
                ]
            ]
        );

        $this->add_control(
            'notification_selector',
            [
                'label'       => __('Trigger Selector', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => __('Selector write here', 'bdthemes-element-pack'),
                'description' => 'Please write here your trigger id or class. Example: #test or .test',
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'notification_event' => ['click', 'mouseover'],
                ]
            ]
        );

        $this->add_control(
            'notification_in_delay',
            [
                'label'       => __('In time delay (ms)', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::SLIDER,
                'description' => 'Notification will visible after this delay time.',
                'dynamic'       => [
                    'active' => true,
                ],
                'range'     => [
                    'px' => [
                        'min' => 500,
                        'max' => 5000,
                    ],
                ],
                'condition' => [
                    'notification_event' => 'inDelay',
                ]
            ]
        );

        $this->add_control(
            'notification_timeout',
            [
                'label' => __('Timeout (ms)', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 5000,
                ],
                'range'     => [
                    'px' => [
                        'min' => 5000,
                        'max' => 10000,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'notification_type' => 'popup',
                ]
            ]
        );

        $this->add_control(
            'source',
            [
                'label'   => esc_html__('Select Source', 'bdthemes-element-pack') . BDTEP_NC,
                'type'    => Controls_Manager::SELECT,
                'default' => 'custom',
                'options' => [
                    'custom'    => esc_html__('Custom Content', 'bdthemes-element-pack'),
                    'elementor'      => esc_html__('Elementor Template', 'bdthemes-element-pack'),
                ],
                'render_type' => 'template',
                'condition' => [
                    'notification_type' => 'fixed'
                ]
            ]
        );
        $this->add_control(
            'template_id',
            [
                'label'       => __('Select Template', 'bdthemes-element-pack'),
                'type'        => Dynamic_Select::TYPE,
                'label_block' => true,
                'placeholder' => __('Type and select template', 'bdthemes-element-pack'),
                'query_args'  => [
                    'query'        => 'elementor_template',
                ],
                'condition'   => [
                    'source' => "elementor",
                    'notification_type' => "fixed"
                ],
            ]
        );


        $this->add_control(
            'notification_content',
            [
                'label'       => __('Content', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::WYSIWYG,
                'placeholder' => __('Notification message here', 'bdthemes-element-pack'),
                'default'     => __('Notification message here', 'bdthemes-element-pack'),
                'dynamic' => [
                    'active' => true,
                ],
                // 'condition'   => ['notification_type' => "popup"],
                'conditions'   => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name'  => 'notification_type',
                            'value' => 'popup',
                        ],
                        [
                            'name'     => 'source',
                            'value'    => 'custom',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'notification_position',
            [
                'label'   => esc_html__('Position', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top-center',
                'options' => [
                    'top-center'    => esc_html__('Top Center', 'bdthemes-element-pack'),
                    'top-left'      => esc_html__('Top Left', 'bdthemes-element-pack'),
                    'top-right'     => esc_html__('Top Right', 'bdthemes-element-pack'),
                    'bottom-center' => esc_html__('Bottom Center', 'bdthemes-element-pack'),
                    'bottom-left'   => esc_html__('Bottom Left', 'bdthemes-element-pack'),
                    'bottom-right'  => esc_html__('Bottom Right', 'bdthemes-element-pack'),
                ],
                'render_type' => 'template',
                'condition' => [
                    'notification_type' => 'popup',
                ]
            ]
        );

        $this->add_control(
            'notification_pos_fixed',
            [
                'label'   => esc_html__('Position', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'relative',
                'options' => [
                    'relative' => esc_html__('Inline', 'bdthemes-element-pack'),
                    'static'   => esc_html__('Static', 'bdthemes-element-pack'),
                    'top'      => esc_html__('Top', 'bdthemes-element-pack'),
                    'bottom'   => esc_html__('Bottom', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'notification_type' => 'fixed',
                ],
                'render_type'  => 'template',
            ]
        );

        $this->add_responsive_control(
            'content_max_width',
            [
                'label' => __('Content Max Width', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 991,
                        'max' => 1900,
                    ],
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'separator' => 'before',
                'condition' => [
                    'notification_type' => 'fixed',
                ],
                'selectors'  => [
                    '.bdt-notify-wrapper .bdt-notify-wrapper-container' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'   => __('Alignment', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'bdthemes-element-pack'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '.bdt-notify-wrapper .bdt-notify-wrapper-container' => 'text-align: {{VALUE}};',
                ],
                'condition' => [
                    'notification_type' => 'fixed',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional',
            [
                'label'     => __('Additional', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'display_times',
            [
                'label' => __('Display Times', 'bdthemes-element-pack') . BDTEP_NC,
                'type' => Controls_Manager::NUMBER,
            ]
        );

        $this->add_control(
            'display_times_time_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('If you want to visible the notification for custom times, it\'s possible by this feature. Please set the display time value as per your need. ', 'bdthemes-element-pack'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'notification_type' => 'fixed'
                ]
            ]
        );

        $this->add_control(
            'display_times_expire',
            [
                'label' => __('Display Times Expiry (Hour)', 'bdthemes-element-pack') . BDTEP_NC,
                'type' => Controls_Manager::NUMBER,
                'description' => __('Default 12 hours.', 'bdthemes-element-pack'),
                'default' => 12,
                'condition' => [
                    'display_times!' => ''
                ]
            ]
        );

        $this->add_control(
            'display_times_expire_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __('It\'s great, that you set the display times. This feature will help you to set an expiry time for the Notification. Example- If you set to display time 3 and expiry time 1 hour, that means a user will see the notification maximum 3 times in this 1 hour.', 'bdthemes-element-pack'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition' => [
                    'notification_type' => 'fixed',
                    'display_times!' => ''
                ]
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_notification_popup',
            [
                'label'     => __('Notification', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'notification_type' => 'popup'
                ]
            ]
        );

        $this->add_control(
            'notification_popup_style',
            [
                'label'   => esc_html__('Style', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'primary',
                'options' => [
                    'primary' => esc_html__('primary', 'bdthemes-element-pack'),
                    'success' => esc_html__('success', 'bdthemes-element-pack'),
                    'warning' => esc_html__('warning', 'bdthemes-element-pack'),
                    'danger'  => esc_html__('danger', 'bdthemes-element-pack'),
                ],
                'render_type'  => 'template',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_notification',
            [
                'label'     => __('Notification', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'notification_type' => 'fixed'
                ]
            ]
        );

        $this->add_control(
            'notification_text_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#bdt-notify-{{ID}}' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'notification_background_color',
                'selector'  => '#bdt-notify-{{ID}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'notification_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'selector'    => '#bdt-notify-{{ID}}',
            ]
        );

        $this->add_responsive_control(
            'notification_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '#bdt-notify-{{ID}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'notification_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#bdt-notify-{{ID}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'notification_box_shadow',
                'selector' => '#bdt-notify-{{ID}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'notification_typography',
                'selector' => '#bdt-notify-{{ID}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_close_icon',
            [
                'label'     => __('Close Button', 'bdthemes-element-pack'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'notification_type' => 'fixed'
                ]
            ]
        );

        $this->add_control(
            'notification_close_text_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'notification_close_background_color',
            [
                'label'     => __('Background Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'notification_close_border',
                'label'       => esc_html__('Border', 'bdthemes-element-pack'),
                'selector'    => '#bdt-notify-{{ID}} .bdt-alert-close',
            ]
        );

        $this->add_responsive_control(
            'notification_close_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'notification_close_padding',
            [
                'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'notification_close_box_shadow',
                'selector' => '#bdt-notify-{{ID}} .bdt-alert-close',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'notification_close_typography',
                'selector' => '#bdt-notify-{{ID}} .bdt-notify-wrapper-container>.bdt-alert-close',
            ]
        );

        $this->add_responsive_control(
            'notification_close_horizontal_offset',
            [
                'label'   => __('Horizontal Offset', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'notification_close_vertical_offset',
            [
                'label'   => __('Vertical Offset', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::SLIDER,
                'selectors' => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'top: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'notification_close_z_index',
            [
                'label' => __('Z-index', 'bdthemes-element-pack') . BDTEP_NC,
                'type' => Controls_Manager::NUMBER,
                'selectors' => [
                    '#bdt-notify-{{ID}} .bdt-alert-close' => 'z-index: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $content = 'Sorry! Notification message empty.';
        $content = $this->parse_text_editor($settings['notification_content']);
        $this->add_render_attribute('notify_attr', 'class', 'bdt-notification-wrapper');
        $this->add_render_attribute(
            [
                'notify_attr' => [
                    'data-settings' => [
                        wp_json_encode([
                            "id"                => 'bdt-notify-' . $this->get_id(),
                            'notifyType'        => $settings['notification_type'],
                            'notifyTimeout'     => (isset($settings['notification_timeout']['size'])) ? $settings['notification_timeout']['size'] : '',
                            "notifyEvent"       => $settings['notification_event'],
                            "notifyInDelay"     => (isset($settings['notification_in_delay']['size']) && !empty($settings['notification_in_delay']['size'])) ? $settings['notification_in_delay']['size'] : 500,
                            "notifySelector"    => (isset($settings['notification_selector']) && !empty($settings['notification_selector'])) ? $settings['notification_selector'] : 'none',
                            "msg"               => $content,
                            "notifyPosition"    => $settings['notification_position'],
                            "notifyFixPosition" => $settings['notification_pos_fixed'],
                            "notifyStatus"      => $settings['notification_popup_style'],
                            "displayTimes"      => !empty($settings['display_times']) ? $settings['display_times'] : false,
                            "displayTimesExpire" => isset($settings['display_times_expire']) && !empty($settings['display_times_expire']) ? (int) $settings['display_times_expire'] : 12,

                        ]),
                    ],
                ],
            ]
        );
?>
        <div <?php echo $this->get_render_attribute_string('notify_attr'); ?>>


            <?php if (
                $settings['notification_type'] == 'fixed' &&
                $settings['notification_pos_fixed'] == 'relative'
            ) : ?>
                <div id="bdt-notify-<?php echo $this->get_id(); ?>" class="bdt-notify-wrapper
                    bdt-notify-inline bdt-hidden bdt-alert-success" data-bdt-alert>
                    <div class="bdt-notify-wrapper-container">
                        <a class="bdt-alert-close" data-bdt-close></a>
                        <?php
                        if (isset($settings['source']) && ('elementor' == $settings['source'])) {
                            echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($settings['template_id']);
                        } else {
                            echo $content;
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (
                $settings['notification_type'] == 'fixed' &&
                $settings['notification_pos_fixed'] != 'relative'
            ) : ?>
                <?php
                $fixed = ($settings['notification_pos_fixed'] == 'top' || $settings['notification_pos_fixed'] == 'bottom') ? 'bdt-position-fixed' : ' ';
                ?>
                <div id="bdt-notify-<?php echo $this->get_id(); ?>" class="bdt-notify-wrapper bdt-hidden bdt-alert-success bdt-alert <?php echo $fixed; ?>
                    bdt-position-<?php echo $settings['notification_pos_fixed']; ?>
                    bdt-margin-remove-bottom bdt-margin-remove-top bdt-animation-fade" data-bdt-alert="">
                    <div class="bdt-notify-wrapper-container">
                        <a class="bdt-alert-close" data-bdt-close></a>
                        <?php
                        if (isset($settings['source']) && ('elementor' == $settings['source'])) {
                            echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($settings['template_id']);
                        } else {
                            echo $content;
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>


        </div>
<?php
    }
}
