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

class Helpo_Gallery_Widget extends Widget_Base {

    public function get_name() {
        return 'helpo_gallery';
    }

    public function get_title() {
        return esc_html__('Gallery', 'helpo_plugin');
    }

    public function get_icon() {
        return 'eicon-inner-section';
    }

    public function get_categories() {
        return ['helpo_widgets'];
    }

    public function get_script_depends() {
        return ['causes_grid_widget'];
    }

    protected function _register_controls() {
        // ----------------------------- //
        // ---------- Content ---------- //
        // ----------------------------- //
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Gallery', 'helpo_plugin')
            ]
        );

        $this->add_control(
            'images',
            [
                'label' => esc_html__('Add Images', 'helpo_plugin'),
                'type' => Controls_Manager::GALLERY,
                'default' => []
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $images = $settings['images'];

        $i = 1;

        // ------------------------------------ //
        // ---------- Widget Content ---------- //
        // ------------------------------------ //
        ?>

        <div class="helpo_gallery_widget">
            <div class="helpo_gallery_wrapper">
                <div class="row no-gutters gallery-masonry">
                    <?php
                    foreach ($images as $image) {
                        $img_meta = helpo_get_attachment_meta($image['id']);
                        $image_caption = $img_meta['caption'];

                        if ($i == 5 || $i == 7) {
                            $item_class = 'col-6 col-md-8';
                        } else {
                            $item_class = 'col-6 col-md-4';
                        }

                        if ($i == 5) {
                            $height_class = 'gallery-masonry__item--height-1';
                        } elseif ($i == 7) {
                            $height_class = 'gallery-masonry__item--height-3';
                        } else {
                            $height_class = 'gallery-masonry__item--height-2';
                        }
                        ?>

                        <div class="<?php echo esc_attr($item_class); ?> gallery-masonry__item helpo_item_<?php echo esc_attr($i); ?>">
                            <a class="gallery-masonry__img <?php echo esc_attr($height_class); ?>" href="<?php echo esc_url($image['url']); ?>" data-fancybox="gallery" data-elementor-open-lightbox="no">
                                <img class="img--bg" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_html__('Image', 'helpo_plugin'); ?>" />

                                <h6 class="gallery-masonry__description"><?php echo esc_html($image_caption); ?></h6>
                            </a>
                        </div>
                        <?php

                        if ($i < 8) {
                            $i++;
                        } else {
                            $i = 1;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template() {}

    public function render_plain_content() {}
}