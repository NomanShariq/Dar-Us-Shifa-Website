<?php
namespace ElementPack\Modules\ScheduleContent;

use Elementor\Elementor_Base;
use Elementor\Controls_Manager;
use ElementPack;
use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'bdt-schedule-content';
	}
    
    public function register_section($element) {
        $element->start_controls_section(
            'section_scheduled_content_controls',
            [
                'tab'   => Controls_Manager::TAB_ADVANCED,
                'label' => BDTEP_CP . esc_html__('Schedule Content (deprecated)', 'visibility-logic-elementor'),
            ]
        );
        $element->end_controls_section();
    }

	public function register_controls($widget, $args) {
		
		$widget->add_control(
			'section_scheduled_content_deprecated',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( __( 'This extension is deprecated and will removed in next major version so please don\'t use this extension. Use our new visibility controls extension instead of this extension.' , 'bdthemes-element-pack' ) ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
			]
		);

		// Schedule content controls
		$widget->add_control(
			'section_scheduled_content_on',
			[
				'label'        => __( 'Schedule Content?', 'bdthemes-element-pack' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'yes',
				'description'  => __( 'Switch on to schedule the contents of this column|section!.', 'bdthemes-element-pack' ),
			]
		);
		
		$widget->add_control(
			'section_scheduled_content_start_date',
			[
				'label' => __( 'Start Date', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => '2021-04-15 00:00:00',
				'condition' => [
					'section_scheduled_content_on' => 'yes',
				],
				'description' => __( 'Set start date for show this section.', 'bdthemes-element-pack' ),
			]
		);
		
		$widget->add_control(
			'section_scheduled_content_end_date',
			[
				'label' => __( 'End Date', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DATE_TIME,
				'default' => '2021-04-30 00:00:00',
				'condition' => [
					'section_scheduled_content_on' => 'yes',
				],
				'description' => __( 'Set end date for hide the section.', 'bdthemes-element-pack' ),
			]
		);

	}
	
	public function schedule_before_render($should_render, $widget) {
        
        $settings = $widget->get_settings();
  
		if( 'yes' == $settings['section_scheduled_content_on'] ) {
			$star_date    = strtotime($settings['section_scheduled_content_start_date']);
			$end_date     = strtotime($settings['section_scheduled_content_end_date']);
			$current_date = strtotime(gmdate( 'Y-m-d H:i', ( time() + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ) ));

			if ( ($current_date >= $star_date) && ($current_date <= $end_date) ) {
				$widget->add_render_attribute( '_wrapper', 'class', 'bdt-schedule-expired' );
			} else {
				$widget->add_render_attribute( '_wrapper', 'class', 'bdt-schedule bdt-hidden' );
			}
		}
		
		return $should_render;
	}

	protected function add_actions() {

		//add_action( 'elementor/element/after_section_end', [ $this, 'register_controls' ], 10, 3 );
        
        add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
        
        add_action('elementor/element/common/section_scheduled_content_controls/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/element/section/section_scheduled_content_controls/before_section_end', [$this, 'register_controls'], 10, 2);
        
		add_action( 'elementor/frontend/section/should_render', [ $this, 'schedule_before_render' ], 10, 2 );
        add_filter('elementor/frontend/widget/should_render', [$this, 'schedule_before_render'], 10, 2 );

	}
}