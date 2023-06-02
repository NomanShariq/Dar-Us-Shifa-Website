<?php
namespace ElementPack\Modules\SvgImage\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Utils;

use ElementPack\Element_Pack_Loader;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Svg_Image extends Module_Base {

	public function get_name() {
		return 'bdt-svg-image';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'SVG', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-svg-image';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'image', 'svg image', 'svg' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/XRbjpcp5dJ0';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'Svg', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label' => __( 'Choose Svg', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => BDTEP_ASSETS_URL.'images/crane.svg',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'caption_source',
			[
				'label' => __( 'Caption', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => __( 'None', 'bdthemes-element-pack' ),
					'attachment' => __( 'Attachment Caption', 'bdthemes-element-pack' ),
					'custom' => __( 'Custom Caption', 'bdthemes-element-pack' ),
				],
				'default' => 'none',
			]
		);

		$this->add_control(
			'caption',
			[
				'label' => __( 'Custom Caption', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => __( 'Enter your image caption', 'bdthemes-element-pack' ),
				'condition' => [
					'caption_source' => 'custom',
				],
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __( 'Link', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'bdthemes-element-pack' ),
					'file'   => __( 'Media File', 'bdthemes-element-pack' ),
					'custom' => __( 'Custom URL', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'bdthemes-element-pack' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'show_label' => false,
			]
		);

		$this->add_control(
			'open_lightbox',
			[
				'label' => __( 'Lightbox', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'bdthemes-element-pack' ),
					'no' => __( 'No', 'bdthemes-element-pack' ),
				],
				'condition' => [
					'link_to' => 'file',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => __( 'View', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_svg_additionl',
			[
				'label' => __( 'Additional', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'on_hover_animation',
			[
				'label' => __( 'On Hover Animation', 'bdthemes-element-pack' ),
				'description' => __( 'Make sure you select a stroke based svg image, otherwise hover animation will not work.', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'on_hover_reverse_animation',
			[
				'label' => __( 'Reverse Animation', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [
					'on_hover_animation' => 'yes',
				],
				'separator'	=> 'after',
			]
		);

		$this->add_control(
			'svg_parallax_effects_show',
			[
				'label'       => __( 'Stroke Parallax Animation', 'bdthemes-element-pack' ),
				'description' => __( 'Make sure you select a stroke based svg image, otherwise parallax stroke animation will not work.', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'parallax_effects_stroke_value',
			[
				'label'       => esc_html__( 'Stroke Start Point', 'bdthemes-element-pack' ),
				'description' => esc_html__( 'Set your stroke start value where from you start the stroke parallax.', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'%' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition'    => [
					'svg_parallax_effects_show' => 'yes',
				],
			]
		);

		$this->add_control(
			'parallax_effects_viewport_value',
			[
				'label'       => esc_html__( 'Viewport', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => 0.1,
						'max'  => 1,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.7,
				],
				'condition'    => [
					'svg_parallax_effects_show' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Svg', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'svg_color_preserved',
			[
				'label' => __( 'Preserved Original Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'svg_fill_color',
			[
				'label'     => esc_html__( 'Fill Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-image svg *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'svg_stroke_color',
			[
				'label'     => esc_html__( 'Stroke Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-image svg *' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'width',
			[
				'label' => __( 'Width', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
					'vw' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'space',
			[
				'label' => __( 'Max Width', 'bdthemes-element-pack' ) . ' (%)',
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => '%',
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image svg' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_panel_style',
			[
				'type' => Controls_Manager::DIVIDER,
				'style' => 'thick',
			]
		);

		$this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => __( 'Opacity', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image svg' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .bdt-svg-image svg',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'opacity_hover',
			[
				'label' => __( 'Opacity', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image:hover svg' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .bdt-svg-image:hover svg',
			]
		);

		$this->add_control(
			'background_hover_transition',
			[
				'label' => __( 'Transition Duration', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image svg' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'selector' => '{{WRAPPER}} .bdt-svg-image svg',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-svg-image svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'exclude' => [
					'box_shadow_position',
				],
				'selector' => '{{WRAPPER}} .bdt-svg-image svg',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => __( 'Caption', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'caption_source!' => 'none',
				],
			]
		);

		$this->add_control(
			'caption_align',
			[
				'label' => __( 'Alignment', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'bdthemes-element-pack' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'color: {{VALUE}};',
				],
				// 'scheme' => [
				// 	'type' => Schemes\Color::get_type(),
				// 	'value' => Schemes\Color::COLOR_3,
				// ],
			]
		);

		$this->add_control(
			'caption_background_color',
			[
				'label' => __( 'Background Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .widget-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .widget-image-caption',
				//'scheme' => Schemes\Typography::TYPOGRAPHY_3,
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'caption_text_shadow',
				'selector' => '{{WRAPPER}} .widget-image-caption',
			]
		);

		$this->add_responsive_control(
			'caption_space',
			[
				'label' => __( 'Spacing', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .widget-image-caption' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	

	private function has_caption( $settings ) {
		return ( ! empty( $settings['caption_source'] ) && 'none' !== $settings['caption_source'] );
	}

	private function get_caption( $settings ) {
		$caption = '';
		if ( ! empty( $settings['caption_source'] ) ) {
			switch ( $settings['caption_source'] ) {
				case 'attachment':
					$caption = wp_get_attachment_caption( $settings['image']['id'] );
					break;
				case 'custom':
					$caption = ! Utils::is_empty( $settings['caption'] ) ? $settings['caption'] : '';
			}
		}
		return $caption;
	}

	public function render_image() {
		$settings = $this->get_settings_for_display();

		if ($settings['on_hover_animation']) {
			$this->add_render_attribute( 'svg-image', 'class', 'bdt-animation-stroke' );
			$this->add_render_attribute( 'svg-image', 'data-bdt-svg', 'stroke-animation: true' );
		}

		if ($settings['on_hover_reverse_animation']) {
			$this->add_render_attribute( 'svg-image', 'class', 'bdt-animation-reverse' );
		}

		if ($settings['svg_color_preserved']) {
			$this->add_render_attribute( 'svg-image', 'class', 'bdt-preserve' );
		}

		$this->add_render_attribute( 'svg-image', 'data-bdt-svg', '' );

		if ($settings['image']['id']) {
		    $settings['image_size'] = 'full';
			$image_html        = Group_Control_Image_Size::get_attachment_image_src($settings['image']['id'], 'image', $settings );
		} else {
			$image_html = BDTEP_ASSETS_URL.'images/crane.svg';
		}

		?>

			<img src="<?php echo esc_url($image_html); ?>" alt="<?php echo get_the_title(); ?>" <?php echo $this->get_render_attribute_string( 'svg-image' ); ?>>

		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		}

		$has_caption = $this->has_caption( $settings );

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-image bdt-svg-image bdt-animation-toggle' );
		
		$parallax_stroke   = 100 - (isset($settings['parallax_effects_stroke_value']['size']) ? $settings['parallax_effects_stroke_value']['size'] : 0);
		$parallax_viewport = (isset($settings['parallax_effects_viewport_value']['size']) ? $settings['parallax_effects_viewport_value']['size'] : 0.7);

		if ( $settings['svg_parallax_effects_show'] ) {
			$this->add_render_attribute( 'wrapper', 'bdt-parallax', 'stroke: ' . $parallax_stroke . '%;' );
			$this->add_render_attribute( 'wrapper', 'bdt-parallax', 'viewport: ' . $parallax_viewport . ';' );
		}

		if ( ! empty( $settings['shape'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-image-shape-' . $settings['shape'] );
		}

		$link = $this->get_link_url( $settings );

		if ( $link ) {

			$this->add_render_attribute( 'link', 'href', $link['url'] );
			$this->add_render_attribute( 'link', 'data-elementor-open-lightbox', 'no');

			if ( 'yes' == $settings['open_lightbox'] ) {
				$this->add_render_attribute( 'wrapper', 'bdt-lightbox', '' );
			}

			if ( Element_Pack_Loader::elementor()->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', [
					'class' => 'elementor-clickable',
				] );
			}

			if ( ! empty( $link['is_external'] ) ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( ! empty( $link['nofollow'] ) ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		} ?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $has_caption ) : ?>
				<figure class="wp-caption">
			<?php endif; ?>
			<?php if ( $link ) : ?>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
			<?php endif; ?>
				<?php $this->render_image(); ?>
			<?php if ( $link ) : ?>
					</a>
			<?php endif; ?>
			<?php if ( $has_caption ) : ?>
				<figcaption class="widget-image-caption wp-caption-text"><?php echo $this->get_caption( $settings ); ?></figcaption>
			<?php endif; ?>
			<?php if ( $has_caption ) : ?>
				</figure>
			<?php endif; ?>
		</div>
		<?php
	}

	private function get_link_url( $settings ) {
		if ( 'none' === $settings['link_to'] ) {
			return false;
		}

		if ( 'custom' === $settings['link_to'] ) {
			if ( empty( $settings['link']['url'] ) ) {
				return false;
			}
			return $settings['link'];
		}

		return [
			'url' => $settings['image']['url'],
		];
	}

}
