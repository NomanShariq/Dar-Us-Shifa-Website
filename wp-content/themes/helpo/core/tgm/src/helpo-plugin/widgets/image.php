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
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Helpo_Image_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_image';
    }

    public function get_title() {
        return esc_html__('Image', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-image';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    protected function _register_controls() {

        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Image', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'helpo_plugin'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ]
            ]
        );

        $this->add_responsive_control(
            'image_align',
            [
                'label' => esc_html__('Image Alignment', 'helpo_plugin'),
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
                    '{{WRAPPER}} .helpo_image_container' => 'text-align: {{VALUE}};',
                ],
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
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'bg_image_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();

        // ------------------------------------ //
        // ---------- Image Settings ---------- //
        // ------------------------------------ //
        $this->start_controls_section(
            'section_heading_settings',
            [
                'label' => esc_html__('Image Settings', 'helpo_plugin'),
                'tab' => Controls_Manager::TAB_STYLE
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
                'condition' => [
                    'bg_image_status' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $image = $settings['image'];
        $bg_image_status = $settings['bg_image_status'];
        $bg_image_position = $settings['bg_image_position'];

        if ($bg_image_status == 'yes') {
            $bg_image = $settings['bg_image'];
        } else {
            $bg_image = array();
        }

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //

        $image_src = $image['url'];
        $image_meta = helpo_get_attachment_meta($image['id']);
        $image_alt_text = $image_meta['alt'];
        ?>

        <div class="helpo_image_widget">
            <div class="helpo_image_container helpo_bg_image_position_<?php echo esc_attr($bg_image_position); ?>">
                <img class="helpo_image_widget_main_image" src="<?php echo esc_url($image_src); ?>" alt="<?php echo esc_attr($image_alt_text); ?>" />

                <?php
                if ($bg_image_status == 'yes') {
                    $bg_image_src = $bg_image['url'];
                    $bg_metadata = wp_get_attachment_metadata($bg_image['id']);
                    $bg_image_width = $bg_metadata['width'];
                    $bg_image_height = $bg_metadata['height'];
                    $bg_image_meta = helpo_get_attachment_meta($bg_image['id']);
                    $bg_image_alt_text = $bg_image_meta['alt'];
                    ?>
                    <img class="helpo_image_widget_bg" src="<?php echo esc_url($bg_image_src) ?>" alt="<?php echo esc_attr($bg_image_alt_text); ?>" width="<?php echo esc_attr($bg_image_width); ?>" height="<?php echo esc_attr($bg_image_height); ?>" />
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
