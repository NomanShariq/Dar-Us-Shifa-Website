<?php 
namespace ElementPack\Modules\Chart\Widgets;

use Elementor\Repeater;
use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use ElementPack\Modules\Chart\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Chart extends Module_Base {

	public function get_name() {
		return 'bdt-chart';
	}

	public function get_title() {
		return BDTEP . __( 'Chart', 'bdthemes-element-pack' );
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'chart', 'statistics', 'history' ];
	}

	public function get_icon() {
		return 'bdt-wi-chart';
	}
	
	public function get_script_depends() {
		return [ 'chart' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/-1WVTzTyti0';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_chart',
			[
				'label' => __( 'Chart', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label'   => __( 'Type', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'bar',
				'options' => [
					'bar'           => __( 'Bar (Vertical)', 'bdthemes-element-pack' ),
					'horizontalBar' => __( 'Bar (Horozontal)', 'bdthemes-element-pack' ),
					'line'          => __( 'Line', 'bdthemes-element-pack' ),
					'radar'         => __( 'Radar', 'bdthemes-element-pack' ),
					'doughnut'      => __( 'Doughnut', 'bdthemes-element-pack' ),
					'pie'           => __( 'Pie', 'bdthemes-element-pack' ),
					'polarArea'     => __( 'Polar Area', 'bdthemes-element-pack' ),
					'bubble'        => __( 'Bubble', 'bdthemes-element-pack' ),
				],
			]
		);

		// $this->add_control(
		// 	'data_source',
		// 	[
		// 		'label'   => __( 'Data Source', 'bdthemes-element-pack' ),
		// 		'type'    => Controls_Manager::SELECT,
		// 		'default' => 'custom',
		// 		'options' => [
		// 			'custom' => __( 'Custom', 'bdthemes-element-pack' ),
		// 			'csv'      => __( 'CSV File', 'bdthemes-element-pack' ),
		// 		],
		// 	]
		// );

		$this->add_control(
			'labels',
			[
				'label'       => __( 'Label Values', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'January; February; March; April; May', 'bdthemes-element-pack' ),
				'description' => __( 'Write multiple label by semicolon separated(;). Example: January; February; March etc', 'bdthemes-element-pack' ),
			]
		);

		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_datasets',
			[
				'label'     => __( 'Datasets', 'bdthemes-element-pack' ),
				'condition' => [
					'type!' => [ 'bubble', 'pie', 'doughnut', 'polarArea' ]
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'label', 
			[
				'label'       => __( 'Label', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Dataset Label', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'data',
			[
				'label'       => __( 'Data', 'bdthemes-element-pack' ),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => '2; 4; 8; 16; 32',
				'description' => __( 'Enter data values by semicolon separated(;). Example: 2; 4; 8; 16; 32 etc', 'bdthemes-element-pack' ),
			]
		);

		$repeater->add_control(
			'advanced_bg_color',
			[
				'label'   => __( 'Advanced Background Color', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no'
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label'       => __( 'Background Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'default'     => 'rgba(255, 99, 132, 0.2)',
				'type'        => Controls_Manager::COLOR,
				'condition'   => [
					'advanced_bg_color!' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'bg_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Background Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'description' => __( 'Write multiple color values by semicolon separated(;). Example: #dddddd; #ff8844; #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
				'condition'   => [
					'advanced_bg_color' => 'yes'
				]
			]
		); 

		$repeater->add_control(
			'advanced_border_color',
			[
				'label'     => __( 'Advanced Color', 'bdthemes-element-pack' ),
				'separator' => 'before',
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label'       => __( 'Border Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'type'        => Controls_Manager::COLOR,
				'condition'   => [
					'advanced_border_color!' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'border_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Border Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'description' => __( 'Write multiple color values by semicolon separated(;). Example: #dddddd; #ff8844; #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
				'condition'   => [
					'advanced_border_color' => 'yes'
				]
			]
		);

		$this->add_control(
			'datasets',
			[
				'label'   => __( 'Datasets', 'bdthemes-element-pack' ),
				'type'   => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'label'     => __( 'Dataset Label #1', 'bdthemes-element-pack' ),
						'data'      => '2; 4; 8; 16; 32',
						'bg_color'  => 'rgba(255, 99, 132, 0.2)',
						'bg_colors' => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2); rgba(75, 192, 192, 0.2); rgba(153, 102, 255, 0.2)',
					],
					[
						'label'     => __( 'Dataset Label #2', 'bdthemes-element-pack' ),
						'data'      => '8; 25; 6; 8; 10',
						'bg_color'  => 'rgba(54, 162, 235, 0.2)',
						'bg_colors' => 'rgba(153, 102, 255, 0.2); rgba(75, 192, 192, 0.2); rgba(255, 206, 86, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 99, 132, 0.2)',
					],
					[
						'label'     => __( 'Dataset Label #3', 'bdthemes-element-pack' ),
						'data'      => '9; 4; 30; 8; 32',
						'bg_color'  => 'rgba(75, 192, 192, 0.2)',
						'bg_colors' => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2); rgba(75, 192, 192, 0.2); rgba(153, 102, 255, 0.2)',
					],
					[
						'label'     => __( 'Dataset Label #4', 'bdthemes-element-pack' ),
						'data'      => '10; 15; 16; 28; 15',
						'bg_color'  => 'rgba(255, 206, 86, 0.2)',
						'bg_colors' => 'rgba(153, 102, 255, 0.2); rgba(75, 192, 192, 0.2); rgba(255, 206, 86, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 99, 132, 0.2)',
					],
					[
						'label'     => __( 'Dataset Label #5', 'bdthemes-element-pack' ),
						'data'      => '32; 15; 8; 4; 2',
						'bg_color'  => 'rgba(153, 102, 255, 0.2)',
						'bg_colors' => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2); rgba(75, 192, 192, 0.2); rgba(153, 102, 255, 0.2)',
					],
				],
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_single_datasets',
			[
				'label'     => __( 'Datasets', 'bdthemes-element-pack' ),
				'condition' => [
					'type' => ['polarArea', 'pie', 'doughnut']
				]
			]
		);

		$this->add_control(
			'single_label',
			[
				'label'       => __( 'Label', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Polar Dataset Label', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'single_datasets',
			[
				'label'       => __( 'Data', 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
				'type'        => Controls_Manager::TEXT,
				'default'     => '10; 20; 30; 40; 50',
				'description' => __( 'Enter data values by semicolon separated(;). Example: 10; 20; 30; 40; 50 etc', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'single_bg_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Background Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'default'     => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2); rgba(75, 192, 192, 0.2); rgba(153, 102, 255, 0.2)',
				'description' => __( 'Write multiple color values by semicolon separated(;). Example: #dddddd; #ff8844; #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'single_border_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Border Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'description' => __( 'Write multiple color values by semicolon separated(;). Example: #dddddd; #ff8844; #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_bubble_datasets',
			[
				'label'     => __( 'Datasets', 'bdthemes-element-pack' ),
				'condition' => [
					'type' => 'bubble'
				]
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'label',
			[
				'label'       => __( 'Label', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => __( 'Bubble Dataset Label', 'bdthemes-element-pack' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'data',
			[
				'label'       => __( 'Data', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [ 'active' => true ],
				'default'     => '[20;30;15][40;10;10]',
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'advanced_bg_color',
			[
				'label'   => __( 'Advanced Background Color', 'bdthemes-element-pack' ),
				'default' => 'no',
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$repeater->add_control(
			'bg_color',
			[
				'label'       => __( 'Background Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'default'     => 'rgba(255, 99, 132, 0.2)',
				'type'        => Controls_Manager::COLOR,
				'condition'   => [
					'advanced_bg_color!' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'bg_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Background Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'description' => __( 'Write multiple color values by semicolon separated(,). Example: #dddddd, #ff8844, #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
				'condition'   => [
					'advanced_bg_color' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'advanced_border_color',
			[
				'label'     => __( 'Advanced Border Color', 'bdthemes-element-pack' ),
				'separator' => 'before',
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no'
			]
		);

		$repeater->add_control(
			'border_color',
			[
				'label'       => __( 'Border Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'type'        => Controls_Manager::COLOR,
				'condition'   => [
					'advanced_border_color!' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'border_colors',
			[
				'type'        => Controls_Manager::TEXT,
				'label'       => __( 'Border Color', 'bdthemes-element-pack' ),
				'label_block' => true,
				'description' => __( 'Write multiple color values by semicolon separated(;). Example: #dddddd; #ff8844; #232323 etc<br><strong>N.B: it will not work for line, radar charts</strong>', 'bdthemes-element-pack' ),
				'condition'   => [
					'advanced_border_color' => 'yes'
				]
			]
		);


		$this->add_control(
			'bubble_datasets',
			[
				'label'   => __( 'Bubble Datasets', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'label'     => __( 'Bubble Dataset Label #1', 'bdthemes-element-pack' ),
						'data'      => '[20;30;15][40;10;10]',
						'bg_color'  => 'rgba(255, 99, 132, 0.2)',
						'bg_colors' => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2);',
					],
					[
						'label'     => __( 'Bubble Dataset Label #2', 'bdthemes-element-pack' ),
						'data'      => '[15;25;5][50;60;8]',
						'bg_color'  => 'rgba(54, 162, 235, 0.2)',
						'bg_colors' => 'rgba(153, 102, 255, 0.2); rgba(75, 192, 192, 0.2); rgba(255, 206, 86, 0.2);',
					],
					[
						'label'     => __( 'Bubble Dataset Label #3', 'bdthemes-element-pack' ),
						'data'      => '[60;5;20][100;50;15]',
						'bg_color'  => 'rgba(75, 192, 192, 0.2)',
						'bg_colors' => 'rgba(255, 99, 132, 0.2); rgba(54, 162, 235, 0.2); rgba(255, 206, 86, 0.2);',
					],
				],
				'title_field' => '{{{ label }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_additional',
			[
				'label'     => __( 'Additional', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'show_grid_lines',
			[
				'label'   => __( 'Grid Lines', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'   => esc_html__( 'Labels', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_legend',
			[
				'label'   => esc_html__( 'Legends', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
			'legend_align',
			[
				'label'   => esc_html__( 'Alignment', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-arrow-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-arrow-up',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-arrow-down',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bdthemes-element-pack' ),
						'icon'  => 'eicon-arrow-right',
					],
				],
				'condition' => [
					'show_legend' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_tooltip',
			[
				'label'   => esc_html__( 'Tooltip', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		

		$this->add_control(
			'aspect_ratio',
			[
				'label'   => esc_html__( 'Squire Size', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'maintain_aspect_ratio',
			[
				'label'   => esc_html__( 'Maintain Aspect Ratio', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_prefix',
			[
				'label'   => esc_html__( 'Show Prefix', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no', 
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'x_custom_prefix',
			[
				'label'   => esc_html__( 'Custom Prefix xAxes', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$', 
				'placeholder' => __( 'Type your prefix here', 'bdthemes-element-pack' ),
				'condition' => [
					'show_prefix' => 'yes'
				]
			]
		);

		$this->add_control(
			'y_custom_prefix',
			[
				'label'   => esc_html__( 'Custom Prefix yAxes', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$', 
				'placeholder' => __( 'Type your prefix here', 'bdthemes-element-pack' ),
				'condition' => [
					'show_prefix' => 'yes'
				]
			]
		);	

		$this->add_control(
			'show_suffix',
			[
				'label'   => esc_html__( 'Show Suffix', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no', 
				'separator' => 'before',
			]
		);	

		$this->add_control(
			'x_custom_suffix',
			[
				'label'   => esc_html__( 'Custom Suffix xAxes', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '%', 
				'placeholder' => __( 'Type your suffix here', 'bdthemes-element-pack' ),
				'condition' => [
					'show_suffix' => 'yes'
				]
			]
		);

		
		$this->add_control(
			'y_custom_suffix',
			[
				'label'   => esc_html__( 'Custom Suffix yAxes', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '%', 
				'placeholder' => __( 'Type your suffix here', 'bdthemes-element-pack' ),
				'condition' => [
					'show_suffix' => 'yes'
				]
			]
		);	

		$this->add_control(
			'value_sep_heading',
			[
				'label' => esc_html__( 'Thousand Separator ', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'value_separator',
			[
				'label'   => esc_html__( 'Show Separator', 'bdthemes-element-pack' ) . BDTEP_NC,
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',  
			]
		);

		$this->add_control(
			'separator_symbol',
			[
				'label' => esc_html__( 'Separator Symbol', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::TEXT,
				'default' => ',',
				'placeholder' => __( 'Type your symbol here', 'bdthemes-element-pack' ),
				'condition' => [
					'value_separator' => 'yes'
				] 
			]
		);

		$this->add_control(
			'k_formatter',
			[
				'label'   => esc_html__( 'K Formatter', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER, 
				'condition' => [
					'value_separator' => 'yes'
				] 
			]
		);

		$this->add_control(
			'xAxes_separator',
			[
				'label'   => esc_html__( 'xAxes Separator', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no', 
				'condition' => [
					'value_separator' => 'yes'
				] 
			]
		);

		$this->add_control(
			'yAxes_separator',
			[
				'label'   => esc_html__( 'yAxes Separator', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes', 
				'condition' => [
					'value_separator' => 'yes'
				] 
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_chart',
			[
				'label' => esc_html__( 'Style', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'legend_color',
			[
				'label'     => esc_html__( 'Legend Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'show_legend' => 'yes',
				]
			]
		);

		$this->add_control(
			'xAxes_color',
			[
				'label'   => esc_html__( 'xAxes Color', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::COLOR,
				'condition' => [
					'type!' => [ 'doughnut', 'pie' ],
				]
			]
		);

		$this->add_control(
			'yAxes_color',
			[
				'label'   => esc_html__( 'yAxes Color', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::COLOR,
				'condition' => [
					'type!' => [ 'doughnut', 'pie' ],
				]
			]
		);

		$this->add_control(
			'border_width',
			[
				'label'   => esc_html__( 'Border Width', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1
				],
			]
		);

		$this->add_control(
			'grid_color',
			[
				'label'   => esc_html__( 'Grid Color', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::COLOR,
				'default' => 'rgba(0,0,0,0.05)',
			]
		);

		$this->add_control(
			'tooltip_background',
			[
				'label'   => esc_html__( 'Tooltip Background Color', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::COLOR,
				'separator' => 'after',
			]
		);

		$this->end_controls_section();

	}

	public function bubble_values( $cdata ) {
		$cdata = trim( $cdata );
		$splitData = preg_match_all( '#\[([^\]]+)\]#U', $cdata, $matches );
		if ( !$splitData ) {
			return []; // if not get any data
		} else {
			$values = $matches[1];
			$output = [];
			foreach ( $values as $value ) {
				$value = trim( $value, '][ ' );
				$value = explode( ';', $value );
				
				if ( 3 != count( $value ) ) continue; // if not valid bubble data
				
				$point    = new \stdClass();
				$point->x = floatval( trim( $value[0] ) );
				$point->y = floatval( trim( $value[1] ) );
				$point->r = floatval( trim( $value[2] ) );
				$output[] = $point;
			}
			return $output;
		}
	}

	protected function render() {
		$settings       = $this->get_settings_for_display();
		$id             = 'bdt-chart-' . $this->get_id();
		$datasets       = [];
		$all_datasets   = [];
		$chart_datasets = [];
		$options        = [];

		$settings['data_source'] = false;

		if ('csv' == $settings['data_source']) { // TODO

			// print_r($csv_data);



		} else {
			if ( 'pie' == $settings['type'] or 'doughnut' == $settings['type'] or 'polarArea' == $settings['type'] ) {

				$single_data    = array_map('floatval', explode(';', $settings['single_datasets']));
				$all_datasets[] = [ 'data' => $single_data, 'backgroundColor' => explode('; ', $settings['single_bg_colors']) ];

				if ( $settings['single_border_colors'] ) {
					$all_datasets[] = [ 'borderColor' => $settings['single_border_colors'] ];
				}

			} else {

				$chart_datasets = ( 'bubble' == $settings['type'] ) ?  $settings['bubble_datasets'] : $settings['datasets'];

				foreach ( $chart_datasets as $dataset ) {

					$datasets['label'] = $dataset['label'];

					if ('bubble' == $settings['type']) {
						$datasets['data'] = $this->bubble_values($dataset['data']);
					} else {
						$datasets['data']  =  array_map('floatval', explode(';', $dataset['data']));				
					}

					if ( 'yes' == $dataset['advanced_bg_color'] and '' != $dataset['bg_colors'] ) {
						$datasets['backgroundColor'] = explode('; ', $dataset['bg_colors']);
					} else {
						$datasets['backgroundColor'] = $dataset['bg_color'];
					}

					if ( 'yes' == $dataset['advanced_border_color'] and '' != $dataset['border_colors'] ) {
						$datasets['borderColor'] = explode(';', $dataset['border_colors']);
					} else {
						$datasets['borderColor'] = $dataset['border_color'];
					}
					
					$all_datasets[] = $datasets;
				}
			}
			
			if ($settings['show_tooltip']) {
				if ($settings['tooltip_background']) {
					$options['tooltips'] = [ 
						'backgroundColor' => $settings['tooltip_background'],
					];
				}
			} else {
				$options['tooltips'] = [ 'enabled' => false ];
			}

			if ($settings['show_legend']) {
				if ($settings['legend_align']) {
					$options['legend'] = [ 'position' => $settings['legend_align'] ];
				}

				if(isset($settings['legend_color'])){
					$options['legend'] = [ 
						'labels' => [
							'fontColor' => $settings['legend_color'],
						]
					];
				}

			} else {
				$options['legend'] = [ 'display' => false ];
			}

			

			if ( 'pie' == $settings['type'] ) {
				$options['cutoutPercentage'] = 0;
			} else if ( 'doughnut' == $settings['type'] ) {
				$options['cutoutPercentage'] = 50;
			} else {
				if ($settings['show_grid_lines']) {
					
					$xAxesColor = '#666666';
					if(isset($settings['xAxes_color']) && !empty($settings['xAxes_color'])){
						$xAxesColor = $settings['xAxes_color'];
					}

					$yAxes_color = '#666666';
					if(isset($settings['yAxes_color']) && !empty($settings['yAxes_color'])){
						$yAxes_color = $settings['yAxes_color'];
					}

					$options['scales'] = [
						'yAxes' => [[
							'ticks' => [
								'display' => ( $settings['show_labels'] ) ? true : false,
								'fontColor' => $xAxesColor,
							],
							'gridLines' => [
								'drawBorder' => false,
								'color'      => $settings['grid_color'],
							]
						]],
						'xAxes' => [[
							'ticks' => [
								'display' => ( $settings['show_labels'] ) ? true : false,
								'fontColor' => $yAxes_color,
							],
							'gridLines' => [
								'drawBorder' => false,
								'color'      => $settings['grid_color'],
							]
						]]
					];
				} else {
					$options['scales'] = [
						'yAxes' => [[
							'ticks' => [
								'display' => ( $settings['show_labels'] ) ? true : false,
							],
							'gridLines' => [
								'display'    => false,
							]
						]],
						'xAxes' => [[
							'ticks' => [
								'display' => ( $settings['show_labels'] ) ? true : false,
							],
							'gridLines' => [
								'display'    => false,
							]
						]]
					];
				}
			}
		}
		

		if ($settings['aspect_ratio']) {
			$options['aspectRatio'] = 1;
		}

		if (!$settings['maintain_aspect_ratio']) {
			$options['maintainAspectRatio'] = false;
		}

		$this->add_render_attribute(
			[
				'chart' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"type"        => $settings["type"],
							"borderWidth" => $settings["border_width"]["size"],
							"data"        => [
								"labels" => explode(";", $settings["labels"]),
								"datasets" => $all_datasets,
							],
							"options" => $options,
							//"aspectRatio" => 1,
							'valueSeparator' =>   (isset($settings['value_separator']) && $settings['value_separator'] == 'yes') ? 'yes' : 'no',
							'sepratorSymbol' => $settings['separator_symbol'],
							'xAxesSeparator' => $settings['xAxes_separator'],
							'yAxesSeparator' => $settings['yAxes_separator'],
							'kFormatter' => $settings['k_formatter'],
						]))							
					]
				]
			]
		);

		$this->add_render_attribute(
			[
				'chart' => [
					'data-suffixPrefix' => [
						wp_json_encode(array_filter([
							"id"           			=> 'bdt-chart-' . $this->get_id(),
							"suffix_prefix_status"	=> ($settings['show_prefix'] == 'yes' || $settings['show_suffix']  == 'yes') ? 'yes' : 'no',
							"x_custom_prefix" 		=> $settings['x_custom_prefix'],
							"x_custom_suffix" 		=> $settings['x_custom_suffix'],
							"y_custom_prefix" 		=> $settings['y_custom_prefix'],
							"y_custom_suffix" 		=> $settings['y_custom_suffix'],
						])),
					],
				],
			]
		);
		
		?>
		<div class="bdt-chart" <?php echo $this->get_render_attribute_string( 'chart' ); ?>>
			<canvas id="<?php echo esc_attr( $id ); ?>"></canvas>
		</div>		
		<?php
	}
}
