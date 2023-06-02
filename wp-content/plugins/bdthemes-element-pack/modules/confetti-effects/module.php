<?php

namespace ElementPack\Modules\ConfettiEffects;

use Elementor\Controls_Manager;
use ElementPack;
use ElementPack\Base\Element_Pack_Module_Base;

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

class Module extends Element_Pack_Module_Base
{

	public function __construct()
	{
		parent::__construct();
		$this->add_actions();
	}

	public function get_name()
	{
		return 'bdt-confetti-effects';
	}

	public function register_section($element)
	{
		$element->start_controls_section(
			'section_element_pack_confetti_controls',
			[
				'tab'   => Controls_Manager::TAB_ADVANCED,
				'label' => BDTEP_CP . esc_html__('Confetti Effects', 'bdthemes-element-pack') . BDTEP_NC,
			]
		);
		$element->end_controls_section();
	}


	public function register_controls($widget, $args)
	{

		$widget->add_control(
			'ep_widget_cf_confetti',
			[
				'label'              => esc_html__('Use Confetti Effects?', 'bdthemes-element-pack'),
				'type'               => Controls_Manager::SWITCHER,
				'render_type'        => 'template',
				'frontend_available' => true,
				'frontend_available' => true,
			]
		);

		$widget->add_control(
			'ep_widget_cf_type',
			[
				'label'   => esc_html__('Confetti Type', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'basic'  => esc_html__('Basic', 'bdthemes-element-pack'),
					'random'  => esc_html__('Random Direction', 'bdthemes-element-pack'),
					'fireworks'  => esc_html__('Fireworks', 'bdthemes-element-pack'),
					'snow'  => esc_html__('Snow', 'bdthemes-element-pack'),
					'school-pride'  => esc_html__('School Pride', 'bdthemes-element-pack'),
				],
				'default' => 'basic',
				'render_type' => 'template',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_fireworks_duration',
			[
				'label'     => __('Animation End Time (ms)', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1000,
						'max' => 10000,
					],
				],
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_type' => ['fireworks', 'snow', 'school-pride'],
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_particle_count',
			[
				'label'     => __('Particle Count', 'bdthemes-element-pack'),
				'description'     => __('The number of confetti to launch. More is always fun... but be cool, there\'s a lot of math involved. (default: 50)', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_start_velocity',
			[
				'label'     => __('Start Velocity', 'bdthemes-element-pack'),
				'description'     => __('How fast the confetti will start going, in pixels. (default: 45)', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_spread',
			[
				'label'     => __('Spread', 'bdthemes-element-pack'),
				'description'     => __('How far off center the confetti can go, in degrees. 45 means the confetti will launch at the defined angle plus or minus 22.5 degrees.', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_angle',
			[
				'label'     => __('Angle', 'bdthemes-element-pack'),
				'description'     => __('The angle in which to launch the confetti, in degrees. 90 is straight up', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 360,
					],
				],
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_type' => ['random', 'school-pride'],
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_colors',
			[
				'label'       => __('Colors', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => 'Input your colors. example: red, #bada55, #ffffff (Colors must be not empty.)',
				'default' => '#D30C5C, #0EBCDC, #EAED41, #ED5A78, #DF33DF',
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);
		$widget->add_control(
			'ep_widget_cf_shapes',
			[
				'label'       => __('Shapes', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => 'The possible values are square and circle. The default is to use both shapes in an even mix. You can even change the mix by providing a value such as (circle, circle, square) to use two third circles and one third squares.',
				'render_type' => 'none',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes'
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_origin',
			[
				'label'              => __('Origin', 'bdthemes-element-pack'),
				'type'               => Controls_Manager::POPOVER_TOGGLE,
				'condition'          => [
					'ep_widget_cf_confetti' => 'yes',
				],
				'return_value'       => 'yes',
				//'render_type'        => 'none',
				'frontend_available' => true,
			]
		);

		$widget->start_popover();

		$widget->add_control(
			'ep_widget_cf_origin_x',
			[
				'label'     => __('X', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1
					],
				],
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_origin' => 'yes',
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_origin_y',
			[
				'label'     => __('Y', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 1,
						'step' => .1
					],
				],
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_origin' => 'yes',
				],
			]
		);

		$widget->end_popover();

		$widget->add_control(
			'ep_widget_cf_trigger_type',
			[
				'label'   => esc_html__('Trigger Action', 'bdthemes-element-pack'),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'load'  => esc_html__('On Load', 'bdthemes-element-pack'),
					'onview'  => esc_html__('On View', 'bdthemes-element-pack'),
					'click'  => esc_html__('On Click', 'bdthemes-element-pack'),
					'mouseenter'  => esc_html__('On Hover', 'bdthemes-element-pack'),
					'delay'  => esc_html__('Delay', 'bdthemes-element-pack'),
					'ajax-success'  => esc_html__('Ajax Success', 'bdthemes-element-pack'),
				],
				'default' => 'load',
				'render_type' => 'template',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_trigger_selector',
			[
				'label'       => __('Trigger Selector', 'bdthemes-element-pack'),
				'type'        => Controls_Manager::TEXT,
				'description'     => __('Place your selector. example:- #test-id, .test-class', 'bdthemes-element-pack'),
				'dynamic'     => [
					'active' => true,
				],
				'render_type' => 'template',
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_trigger_type' => ['click', 'mouseenter'],
				],
			]
		);

		$widget->add_control(
			'ep_widget_cf_trigger_delay',
			[
				'label'     => __('Delay Time (ms)', 'bdthemes-element-pack'),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 3000,
				],
				'range'     => [
					'px' => [
						'min' => 1000,
						'max' => 10000,
					],
				],
				'frontend_available' => true,
				'condition' => [
					'ep_widget_cf_confetti' => 'yes',
					'ep_widget_cf_trigger_type' => 'delay',
				],
			]
		);
	}


	public function widget_confetti_before_render($widget)
	{
		$settings = $widget->get_settings_for_display();


		if ($settings['ep_widget_cf_confetti'] == 'yes') {
			wp_enqueue_script('confetti');
		}
	}

	protected function add_actions()
	{

		add_action(
			'elementor/element/common/_section_style/after_section_end',
			[
				$this,
				'register_section'
			]
		);

		add_action(
			'elementor/element/common/section_element_pack_confetti_controls/before_section_end',
			[
				$this,
				'register_controls'
			],
			10,
			2
		);

		add_action('elementor/frontend/widget/before_render', [
			$this,
			'widget_confetti_before_render'
		], 10, 1);

		 // Add section for settings
             add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
            
             add_action('elementor/element/section/section_element_pack_confetti_controls/before_section_end', [$this, 'register_controls'], 10, 2);
            
             add_action('elementor/frontend/section/before_render', [$this, 'widget_confetti_before_render'], 10, 1);

	}
}
 