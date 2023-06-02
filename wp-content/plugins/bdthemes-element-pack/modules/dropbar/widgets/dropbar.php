<?php

namespace ElementPack\Modules\Dropbar\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

use ElementPack\Element_Pack_Loader;
use ElementPack\Includes\Controls\SelectInput\Dynamic_Select;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Dropbar extends Module_Base {

	public function get_name() {
		return 'bdt-dropbar';
	}

	public function get_title() {
		return BDTEP . esc_html__('Dropbar', 'bdthemes-element-pack');
	}

	public function get_icon() {
		return 'bdt-wi-dropbar';
	}

	public function get_categories() {
		return ['element-pack'];
	}

	public function get_keywords() {
		return ['dropbar', 'popup', 'dropdown'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/cXMq8nOCdqk';
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_dropbar',
			[
				'label' => esc_html__('Dropbar Content', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'source',
			[
				'label'   => esc_html__('Select Source', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [
					'custom'    => esc_html__('Custom Content', 'bdthemes-element-pack'),
					"elementor" => esc_html__('Elementor Template', 'bdthemes-element-pack'),
					'anywhere'  => esc_html__('AE Template', 'bdthemes-element-pack'),
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__('Content', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::WYSIWYG,
				'dynamic'     => ['active' => true],
				'placeholder' => esc_html__('Dropbar content goes here', 'bdthemes-element-pack'),
				'show_label'  => false,
				'default'     => esc_html__('A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart.', 'bdthemes-element-pack'),
				'condition'   => ['source' => 'custom'],
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
				'condition'   => ['source' => "elementor"],
			]
		);
		$this->add_control(
			'anywhere_id',
			[
				'label'       => __('Select Template', 'bdthemes-element-pack'),
				'type'        => Dynamic_Select::TYPE,
				'label_block' => true,
				'placeholder' => __('Type and select template', 'bdthemes-element-pack'),
				'query_args'  => [
					'query'        => 'anywhere_template',
				],
				'condition'   => ['source' => "anywhere"],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_button',
			[
				'label' => esc_html__('Button', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'   => esc_html__('Text', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => ['active' => true],
				'default' => esc_html__('Open Dropbar', 'bdthemes-element-pack'),
			]
		);

		$this->add_responsive_control(
			'button_align',
			[
				'label'   => __('Alignment', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::CHOOSE,
				'default' => '',
				'options' => [
					'left'    => [
						'title' => __('Left', 'bdthemes-element-pack'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __('Center', 'bdthemes-element-pack'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __('Right', 'bdthemes-element-pack'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __('Justified', 'bdthemes-element-pack'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'condition'    => [
					'button_position' => '',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __('Size', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => element_pack_button_sizes(),
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => esc_html__('Icon', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
			]
		);

		$this->add_control(
			'button_icon_align',
			[
				'label'   => esc_html__('Icon Position', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'right',
				'options' => [
					'left'  => esc_html__('Before', 'bdthemes-element-pack'),
					'right' => esc_html__('After', 'bdthemes-element-pack'),
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'button_icon_indent',
			[
				'label'   => esc_html__('Icon Spacing', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-wrapper .bdt-dropbar-button-icon.bdt-flex-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .bdt-dropbar-wrapper .bdt-dropbar-button-icon.bdt-flex-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'button_position',
			[
				'label'   => esc_html__('Fixed Position', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => element_pack_position(),
			]
		);

		$this->add_responsive_control(
			'btn_horizontal_offset',
			[
				'label' => __('Horizontal Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -300,
						'step' => 2,
						'max'  => 300,
					],
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'btn_vertical_offset',
			[
				'label' => __('Vertical Offset', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -300,
						'step' => 2,
						'max'  => 300,
					],
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_rotate',
			[
				'label'   => esc_html__('Rotate', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => -180,
						'max'  => 180,
						'step' => 5,
					],
				],
				'selectors' => [
					'(desktop){{WRAPPER}} .bdt-dropbar-button' => 'transform: translate({{btn_horizontal_offset.SIZE}}px, {{btn_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
					'(tablet){{WRAPPER}} .bdt-dropbar-button' => 'transform: translate({{btn_horizontal_offset_tablet.SIZE}}px, {{btn_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
					'(mobile){{WRAPPER}} .bdt-dropbar-button' => 'transform: translate({{btn_horizontal_offset_mobile.SIZE}}px, {{btn_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				],
				'condition' => [
					'button_position!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_option',
			[
				'label'     => esc_html__('Dropbar Options', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'drop_position',
			[
				'label'   => esc_html__('Position', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bottom-left',
				'options' => element_pack_drop_position(),
			]
		);

		$this->add_control(
			'drop_mode',
			[
				'label'   => esc_html__('Mode', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [
					'click'    => esc_html__('Click', 'bdthemes-element-pack'),
					'hover'  => esc_html__('Hover', 'bdthemes-element-pack'),
				],
			]
		);

		$this->add_responsive_control(
			'drop_width',
			[
				'label' => esc_html__('Width', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 100,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-drop' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'drop_flip',
			[
				'label' => esc_html__('Flip Dropbar', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'drop_offset',
			[
				'label'   => esc_html__('Dropbar Offset', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 10,
				],
				'range' => [
					'px' => [
						'max' => 100,
						'step' => 5,
					],
				],
			]
		);

		$this->add_control(
			'drop_animation',
			[
				'label'     => esc_html__('Animation', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => element_pack_transition_options(),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'drop_duration',
			[
				'label'   => esc_html__('Animation Duration', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 200,
				],
				'range' => [
					'px' => [
						'max' => 4000,
						'step' => 50,
					],
				],
				'condition' => [
					'drop_animation!' => '',
				],
			]
		);

		$this->add_control(
			'drop_show_delay',
			[
				'label'   => esc_html__('Show Delay', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'max' => 1000,
						'step' => 100,
					],
				],
			]
		);

		$this->add_control(
			'drop_hide_delay',
			[
				'label'   => esc_html__('Hide Delay', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'max' => 10000,
						'step' => 100,
					],
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_style_button',
			[
				'label'     => esc_html__('Button', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'button_text!' => '',
				],
			]
		);

		$this->add_control(
			'heading_footer_button',
			[
				'label' => esc_html__('Button', 'bdthemes-element-pack'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'button_border',
				'label'       => esc_html__('Border', 'bdthemes-element-pack'),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .bdt-dropbar-button',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-dropbar-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_text_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-dropbar-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-dropbar-button',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => esc_html__('Typography', 'bdthemes-element-pack'),
				//'scheme'   => Schemes\Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .bdt-dropbar-button',
			]
		);

		$this->add_control(
			'dropbar_button_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button .bdt-dropbar-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-dropbar-button .bdt-dropbar-button-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-element-pack'),
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover_color',
			[
				'label'     => esc_html__('Background Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__('Border Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __('Hover Animation', 'bdthemes-element-pack'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_control(
			'dropbar_button_hover_icon_color',
			[
				'label'     => esc_html__('Icon Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-dropbar-button:hover .bdt-dropbar-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .bdt-dropbar-button:hover .bdt-dropbar-button-icon svg' => 'fill: {{VALUE}};',
				],
				'condition' => [
					'button_icon[value]!' => '',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_content',
			[
				'label'     => esc_html__('Dropbar Content', 'bdthemes-element-pack'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_text_color',
			[
				'label'     => esc_html__('Text Color', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#bdt-drop-{{ID}}.bdt-drop .bdt-card-body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_background',
			[
				'label'     => esc_html__('Background', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'#bdt-drop-{{ID}}.bdt-drop .bdt-card-body' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'#bdt-drop-{{ID}}.bdt-drop .bdt-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'content_border_radius',
			[
				'label'      => esc_html__('Border Radius', 'bdthemes-element-pack'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'#bdt-drop-{{ID}}.bdt-drop .bdt-card-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'content_box_shadow',
				'selector' => '#bdt-drop-{{ID}}.bdt-drop .bdt-card-body',
			]
		);

		$this->end_controls_section();
	}

	public function render() {
		$settings = $this->get_settings_for_display();
		$id       = 'bdt-drop-' . $this->get_id();

		$this->add_render_attribute(
			[
				'drop-settings' => [
					'id'       => $id,
					'class'    => 'bdt-drop',
					'data-bdt-drop' => [
						wp_json_encode([
							"pos"        => $settings["drop_position"],
							"mode"       => $settings["drop_mode"],
							"delay-show" => $settings["drop_show_delay"]["size"],
							"delay-hide" => $settings["drop_hide_delay"]["size"],
							"flip"       => $settings["drop_flip"] ? true : false,
							"offset"     => $settings["drop_offset"]["size"],
							"animation"  => $settings["drop_animation"] ? "bdt-animation-" . $settings["drop_animation"] : false,
							"duration"   => ($settings["drop_duration"]["size"] and $settings["drop_animation"]) ? $settings["drop_duration"]["size"] : "0"
						]),
					],
				],
			]
		);

		$this->add_render_attribute('button', 'class', ['bdt-dropbar-button', 'elementor-button']);

		if (!empty($settings['size'])) {
			$this->add_render_attribute('button', 'class', 'elementor-size-' . $settings['size']);
		}

		if ($settings['hover_animation']) {
			$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}

		$this->add_render_attribute('button', 'href', 'javascript:void(0)');

		$this->add_render_attribute('dropbar-wrapper', 'class', 'bdt-dropbar-wrapper');

		if ($settings['button_position']) {
			$this->add_render_attribute('dropbar-wrapper', 'class', ['bdt-position-fixed', 'bdt-position-' . $settings['button_position']]);
		}

?>
		<div <?php echo $this->get_render_attribute_string('dropbar-wrapper'); ?>>
			<a <?php echo $this->get_render_attribute_string('button'); ?>>
				<?php $this->render_text($settings); ?>
			</a>
			<div <?php echo $this->get_render_attribute_string('drop-settings'); ?>>
				<div class="bdt-card bdt-card-body bdt-card-default bdt-text-left">
					<?php
					if ('custom' == $settings['source'] and !empty($settings['content'])) {
						echo wp_kses_post($settings['content']);
					} elseif ("elementor" == $settings['source'] and !empty($settings['template_id'])) {
						echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($settings['template_id']);
						echo element_pack_template_edit_link($settings['template_id']);
					} elseif ('anywhere' == $settings['source'] and !empty($settings['anywhere_id'])) {
						echo Element_Pack_Loader::elementor()->frontend->get_builder_content_for_display($settings['anywhere_id']);
						echo element_pack_template_edit_link($settings['anywhere_id']);
					}
					?>


				</div>
			</div>
		</div>
	<?php
	}

	protected function render_text($settings) {

		$this->add_render_attribute('content-wrapper', 'class', 'elementor-button-content-wrapper');

		if ('left' == $settings['button_icon_align'] or 'right' == $settings['button_icon_align']) {
			$this->add_render_attribute('dropbar-button', 'class', 'bdt-flex bdt-flex-middle');
		}

		$this->add_render_attribute('icon-align', 'class', 'bdt-flex-align-' . $settings['button_icon_align']);

		$this->add_render_attribute('icon-align', 'class', 'bdt-dropbar-button-icon elementor-button-icon');

		$this->add_render_attribute('text', 'class', 'elementor-button-text');

		if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
			// add old default
			$settings['icon'] = 'fas fa-arrow-right';
		}

		$migrated  = isset($settings['__fa4_migrated']['button_icon']);
		$is_new    = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

	?>
		<span <?php echo $this->get_render_attribute_string('content-wrapper'); ?>>
			<span <?php echo $this->get_render_attribute_string('dropbar-button'); ?>>

				<span <?php echo $this->get_render_attribute_string('text'); ?>><?php echo wp_kses($settings['button_text'], element_pack_allow_tags('title')); ?></span>

				<?php if (!empty($settings['button_icon']['value'])) : ?>
					<span <?php echo $this->get_render_attribute_string('icon-align'); ?>>

						<?php if ($is_new || $migrated) :
							Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']);
						else : ?>
							<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
						<?php endif; ?>

					</span>
				<?php endif; ?>

			</span>
		</span>
<?php
	}
}
