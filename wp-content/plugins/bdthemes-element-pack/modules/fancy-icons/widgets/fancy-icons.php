<?php

namespace ElementPack\Modules\FancyIcons\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use Elementor\Repeater;

if ( !defined('ABSPATH') ) exit; // Exit if accessed directly

class Fancy_Icons extends Module_Base {

    public function get_name() {
        return 'bdt-fancy-icons';
    }

    public function get_title() {
        return BDTEP . esc_html__('Fancy Icons', 'bdthemes-element-pack');
    }

    public function get_icon() {
        return 'bdt-wi-fancy-icons';
    }

    public function get_categories() {
        return ['element-pack'];
    }

    public function get_keywords() {
        return ['social', 'share', 'fancy', 'advanced', 'brand', 'icons'];
    }

    public function is_reload_preview_required() {
        return false;
    }

    public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-fancy-icons'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/Y4NoiuW2yBM';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_layout_fancy_icons',
            [
                'label' => esc_html__('Fancy Icons', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_type', 
            [
                'label'        => esc_html__('Social Type', 'bdthemes-element-pack'),
                'type'         => Controls_Manager::CHOOSE,
                'toggle'       => false,
                'default'      => 'icon',
                'prefix_class' => 'bdt-social-type-',
                'options'      => [
                    'icon' => [
                        'title' => esc_html__('Icon', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-star'
                    ],
                    'text' => [
                        'title' => esc_html__('Text', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-text-width',
                    ],
                ],
                'render_type'  => 'template'
            ]
        );

        $repeater->add_control(
            'social_icon', 
            [
                'label'     => __('Icon', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'condition' => [
                    'social_type' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'social_name', 
             [
                'label'       => __('Custom Label', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => ['active' => true],
                'default'     => __('Facebook', 'bdthemes-element-pack'),
                'label_block' => true,
                'condition'   => [
                    'social_type' => 'text',
                ],
                'render_type' => 'template'
            ]
        );

        $repeater->add_control(
            'social_link', 
             [
                'label'         => esc_html__('Custom Link', 'bdthemes-element-pack'),
                'type'          => Controls_Manager::URL,
                'default'       => ['url' => '#'],
                'show_external' => false,
                'dynamic'       => ['active' => true],
                'condition'     => [
                    'social_type!' => ''
                ]
            ]
        ); 

        $repeater->add_control(
            'icon_color', 
             [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons {{CURRENT_ITEM}}.bdt-fancy-icons-item a'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-fancy-icons {{CURRENT_ITEM}}.bdt-fancy-icons-item a.icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'icon_hover_color', 
             [
                'label'     => __('Hover Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons {{CURRENT_ITEM}}.bdt-fancy-icons-item:hover a'          => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-fancy-icons {{CURRENT_ITEM}}.bdt-fancy-icons-item:hover a.icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'icon_background_color', 
             [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons {{CURRENT_ITEM}}.bdt-fancy-icons-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'share_items',
            [
                'label'       => esc_html__('Social Items', 'bdthemes-element-pack'),
                'type'        => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default'     => [
                    [
                        'social_name' => __('Facebook', 'bdthemes-element-pack'),
                        'social_icon' => ['value' => 'fab fa-facebook-f', 'library' => 'fa-brands'],
                    ],
                    [
                        'social_name' => __('Twitter', 'bdthemes-element-pack'),
                        'social_icon' => ['value' => 'fab fa-twitter', 'library' => 'fa-brands'],
                    ],
                    [
                        'social_name' => __('Linkedin', 'bdthemes-element-pack'),
                        'social_icon' => ['value' => 'fab fa-linkedin-in', 'library' => 'fa-brands'],
                    ],
                    [
                        'social_name' => __('Instagram', 'bdthemes-element-pack'),
                        'social_icon' => ['value' => 'fab fa-instagram', 'library' => 'fa-brands'],
                    ],
                ],
                'title_field' => '{{{ social_name }}}',
            ]
        );

        $this->add_responsive_control(
            'columns',
            [
                'label'          => esc_html__('Columns', 'bdthemes-element-pack'),
                'type'           => Controls_Manager::SELECT,
                'default'        => '2',
                'tablet_default' => '2',
                'mobile_default' => '1',
                'options'        => [
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
                'separator'      => 'before'
            ]
        );

        $this->add_control(
            'background_type',
            [
                'label'   => esc_html__('Background Type', 'bdthemes-element-pack'),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'image',
                'options' => [
                    'image'   => [
                        'title' => esc_html__('Image', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-image',
                    ],
                    'video'   => [
                        'title' => esc_html__('Video', 'bdthemes-element-pack'),
                        'icon'  => 'fas fa-play-circle',
                    ],
                    'youtube' => [
                        'title' => esc_html__('Youtube', 'bdthemes-element-pack'),
                        'icon'  => 'fab fa-youtube',
                    ],
                ],
            ]
        );


        $this->add_control(
            'background_image',
            [
                'label'     => __('Background Image', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => BDTEP_ASSETS_URL . 'images/slide/item-5.jpg',
                ],
                'condition' => [
                    'background_type' => 'image'
                ],
            ]
        );

        $this->add_control(
            'background_attachment',
            [
                'label'     => esc_html__('Background Attachment', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'inherit',
                'options'   => [
                    'inherit' => esc_html__('Default', 'bdthemes-element-pack'),
                    'scroll'  => esc_html__('Scroll', 'bdthemes-element-pack'),
                    'fixed'   => esc_html__('Fixed', 'bdthemes-element-pack'),
                ],
                'condition' => [
                    'background_type' => 'image'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'         => 'thumbnail_size',
                'label'        => esc_html__('Image Size', 'bdthemes-element-pack'),
                'exclude'      => ['custom'],
                'default'      => 'full',
                'prefix_class' => 'bdt-fancy-icons--thumbnail-size-',
                'condition'    => [
                    'background_type' => 'image'
                ],
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label'     => esc_html__('Video Link', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'background_type' => 'video'
                ],
                'default'   => '//clips.vorwaerts-gmbh.de/big_buck_bunny.mp4',
                'dynamic'   => ['active' => true],
            ]
        );

        $this->add_control(
            'youtube_link',
            [
                'label'     => esc_html__('Youtube Link', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::TEXT,
                'condition' => [
                    'background_type' => 'youtube'
                ],
                'default'   => 'https://youtu.be/YE7VzlLtp-4',
                'dynamic'   => ['active' => true],
            ]
        );

        $this->end_controls_section();

        //Style
        $this->start_controls_section(
            'section_style_fancy_icons',
            [
                'label' => esc_html__('Fancy Icons', 'bdthemes-element-pack'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        // $this->add_control(
        // 	'share_items_background_heading',
        // 	[
        // 		'label'     => esc_html__( 'Item', 'bdthemes-element-pack' ),
        // 		'type'      => Controls_Manager::HEADING,
        // 	]
        // );

        $this->add_control(
            'item_background_color',
            [
                'label'     => __('Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_hover_background_color',
            [
                'label'     => __('Hover Background', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'fancy_ixons_item_border',
                'selector' => '{{WRAPPER}} .bdt-fancy-icons',
            ]
        );

        $this->add_responsive_control(
            'fancy_ixons_item_radius',
            [
                'label'      => __('Radius', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-icons' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_icon_text_rotate',
            [
                'label'     => esc_html__('Hover Rotate', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'selectors' => [
                    '(desktop){{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a' => 'transform: rotate({{SIZE}}deg);',
                    '(tablet){{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a'  => 'transform: rotate({{SIZE}}deg);',
                    '(mobile){{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a'  => 'transform: rotate({{SIZE}}deg);',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => __('Padding', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'share_items_icon',
            [
                'label'     => esc_html__('Icon', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'item_icon_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_icon_hover_color',
            [
                'label'     => __('Hover Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a.icon'     => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a.icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'      => __('Size', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['vw'],
                'range'      => [
                    'vw' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'unit' => 'vw',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'share_items_text',
            [
                'label'     => esc_html__('Text', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'show_text_stroke',
			[
				'label'   => esc_html__('Text Stroke', 'bdthemes-element-pack') . BDTEP_NC,
				'type'    => Controls_Manager::SWITCHER,
				'prefix_class' => 'bdt-text-stroke--',
			]
		);

        $this->add_responsive_control(
            'text_stroke_width',
            [
                'label' => esc_html__('Text Stroke Width', 'bdthemes-element-pack') . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.text' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_text_stroke' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'item_text_color',
            [
                'label'     => __('Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_text_hover_color',
            [
                'label'     => __('Hover Color', 'bdthemes-element-pack'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item:hover a.text' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_size',
            [
                'label'      => __('Size', 'bdthemes-element-pack'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['vw'],
                'range'      => [
                    'vw' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default'    => [
                    'unit' => 'vw',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .bdt-fancy-icons .bdt-fancy-icons-item a.text' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }


    protected function rendar_item_video($link) {
        $video_src = $link['video_link'];

        ?>
      <video autoplay loop muted playsinline>
        <source src="<?php echo $video_src; ?>" type="video/mp4">
      </video>
        <?php
    }

    protected function rendar_item_youtube($link) {

        $id  = (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $link['youtube_link'], $match)) ? $match[1] : false;
        $url = '//www.youtube.com/embed/' . $id . '?autoplay=1&mute=1&amp;controls=0&amp;showinfo=0&amp;rel=0&amp;loop=1&amp;modestbranding=1&amp;wmode=transparent&amp;playsinline=1&playlist=' . $id;

        ?>
      <iframe src="<?php echo esc_url($url); ?>" allowfullscreen></iframe>
        <?php
    }

    public function render() {
        $settings = $this->get_settings_for_display();
        $id       = $this->get_id();

        $desktop_cols = $settings['columns'];
        $tablet_cols  = $settings['columns_tablet'];
        $mobile_cols  = $settings['columns_mobile'];

        $this->add_render_attribute('advanced-icons', 'class', 'bdt-fancy-icons');

        $thumb_url = Group_Control_Image_Size::get_attachment_image_src($settings['background_image']['id'], 'thumbnail_size', $settings);

        if ( !$thumb_url ) {
            $thumb_url = $settings['background_image']['url'];
        }

        if ( $settings['background_type'] == 'image' ) {
            $thumb_url = $thumb_url;
        }

        ?>
      <div <?php echo($this->get_render_attribute_string('advanced-icons')); ?>
          style="background-image: url('<?php echo esc_url($thumb_url); ?>'); background-attachment: <?php echo esc_attr($settings['background_attachment']); ?>">

        <div class="bdt-fancy-icons-background">
            <?php if ( ($settings['background_type'] == 'youtube') && $settings['youtube_link'] ) : ?>
                <?php $this->rendar_item_youtube($settings); ?>

            <?php elseif ( ($settings['background_type'] == 'video') && $settings['video_link'] ) : ?>
                <?php $this->rendar_item_video($settings); ?>
            <?php endif; ?>
        </div>

        <div
            class="bdt-grid bdt-grid-collapse bdt-child-width-1-<?php echo esc_attr($mobile_cols); ?> bdt-child-width-1-<?php echo esc_attr($tablet_cols); ?>@s bdt-child-width-1-<?php echo esc_attr($desktop_cols); ?>@l"
            data-bdt-grid>

            <?php
            foreach ( $settings['share_items'] as $item ) :

                $this->add_render_attribute('share-item', 'class', 'bdt-fancy-icons-item bdt-flex bdt-flex-middle bdt-flex-center elementor-repeater-item-' . esc_attr($item['_id']), true);

                $this->add_render_attribute('share-link', 'class', [ esc_attr($item['social_type']) ], true);

                $has_icon = !empty($item['social_icon']);
                $has_text = !empty($item['social_name']);

                if ( ! empty( $item['social_link']['url'] ) ) {
                    $this->add_render_attribute( 'share-link', 'href', $item['social_link']['url'], true );
        
                    if ( $item['social_link']['is_external'] ) {
                        $this->add_render_attribute( 'share-link', 'target', '_blank', true );
                    }
        
                    if ( $item['social_link']['nofollow'] ) {
                        $this->add_render_attribute( 'share-link', 'rel', 'nofollow', true );
                    }
        
                }

                ?>
              <div <?php echo($this->get_render_attribute_string('share-item')); ?>>
                <a <?php echo($this->get_render_attribute_string('share-link')); ?>>

                    <?php if ( $has_icon or $has_text ) : ?>
                      <span class="bdt-icon-wrapper">
									<?php if ( $has_icon and 'icon' == $item['social_type'] ) { ?>

                      <?php Icons_Manager::render_icon($item['social_icon'], ['aria-hidden' => 'true']); ?>

                  <?php } elseif ( $has_text and 'text' == $item['social_type'] ) { ?>
                      <?php echo wp_kses($item['social_name'], element_pack_allow_tags('title')); ?>
                  <?php } ?>
								</span>
                    <?php endif; ?>

                </a>

              </div>
            <?php endforeach; ?>

        </div>

      </div>
        <?php
    }

}