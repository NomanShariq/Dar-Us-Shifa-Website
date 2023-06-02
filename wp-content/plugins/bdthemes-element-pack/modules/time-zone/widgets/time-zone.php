<?php
namespace ElementPack\Modules\TimeZone\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use ElementPack\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit();
}

class Time_Zone extends Module_Base
{

    public function get_name()
    {
        return 'bdt-time-zone';
    }

    public function get_title()
    {
        return BDTEP . esc_html__('Time Zone', 'bdthemes-element-pack');
    }

    public function get_icon()
    {
        return 'bdt-wi-time-zone';
    }

    public function get_categories()
    {
        return ['element-pack'];
    }

    public function get_keywords()
    {
        return ['time', 'zone'];
    }

    public function get_style_depends()
    {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-time-zone'];
        }
    }

    public function get_script_depends()
    {
        return ['jclock'];
    }

    public function get_custom_help_url()
    {
        return 'https://youtu.be/WOMIk_FVRz4';
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'section_content_additional',
            [
                'label' => __('Time Zone', 'bdthemes-element-pack'),
            ]
        );

        // $this->add_control(
        //     'custom_gmt',
        //     [
        //         'label'        => __('Custom GMT', 'bdthemes-element-pack'),
        //         'type'         => Controls_Manager::SWITCHER,
        //         'return_value' => 'yes',
        //     ]
        // );

        $this->add_control(
            'select_gmt',
            [
                'label' => __('Select GMT', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT2,
                'options' => [
                    'local' => 'Local GMT',
                    '-0' => 'UT or UTC - GMT -0',
                    '+1' => 'CET - GMT+1',
                    '+2' => 'EET - GMT+2',
                    '+3' => 'MSK - GMT+3',
                    '+4' => 'SMT - GMT+4',
                    '+5' => 'PKT - GMT+5',
                    '+5.5' => 'IND - GMT+5.5',
                    '+6' => 'OMSK / BD - GMT+6',
                    '+7' => 'CXT - GMT+7',
                    '+8' => 'CST / AWST / WST - GMT+8',
                    '+9' => 'JST - GMT+9',
                    '+10' => 'EAST - GMT+10',
                    '+11' => 'SAKT - GMT+11',
                    '+12' => 'IDLE  - GMT+12',
                    '+13' => 'NZDT  - GMT+13',
                    '-1' => 'WAT  - GMT-1',
                    '-2' => 'AT  - GMT-2',
                    '-3' => 'ART  - GMT-3',
                    '-4' => 'AST  - GMT-4',
                    '-5' => 'EST  - GMT-5',
                    '-6' => 'CST  - GMT-6',
                    '-7' => 'MST  - GMT-7',
                    '-8' => 'PST  - GMT-8',
                    '-9' => 'AKST  - GMT-9',
                    '-10' => 'HST  - GMT-10',
                    '-11' => 'NT  - GMT-11',
                    '-12' => 'IDLW  - GMT-12',
                    'custom' => 'Custom GMT',
                ],
                'default' => ['+1'],

            ]
        );

        $this->add_control(
            'local_gmt_note',
            [
                'type' => Controls_Manager::RAW_HTML,
                'raw' => __( 'Country name will not work dynamically on Local GMT. So in this case, you may deactivate Show Country Option.', 'bdthemes-element-pack' ),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
                'condition'     => [
                    'select_gmt' => 'local',
                ]
            ]
        );

        $this->add_control(
            'input_gmt',
            [
                'label' => __('Custom GMT ', 'bdthemes-element-pack'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => 'example: +6',
                'default' => '+6',
                'condition' => [
                    'select_gmt' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'time_hour',
            [
                'label' => __('Time Format', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '12h' => __('12 Hours', 'bdthemes-element-pack'),
                    '24h' => __('24 Hours', 'bdthemes-element-pack'),
                ],
                'default' => '12h',
            ]
        );

        $this->add_control(
            'show_date',
            [
                'label' => __('Show Date', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdthemes-element-pack'),
                'label_off' => __('Hide', 'bdthemes-element-pack'),
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'select_date_format',
            [
                'label' => __('Date Format', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '%m/%d/%y' => 'mm/dd/yy',
                    '%m/%d/%Y' => 'mm/dd/yyyy',
                    '%m-%d-%y' => 'mm-dd-yy',
                    '%m-%d-%Y' => 'mm-dd-yyyy',
                    '%m %d %y' => 'mm dd yy',
                    '%m %d %Y' => 'mm dd yyyy',

                    '%d/%m/%y' => 'dd/mm/yy',
                    '%d/%m/%Y' => 'dd/mm/yyyy',
                    '%d-%m-%Y' => 'dd-mm-yyyy',
                    '%d %m %Y' => 'dd mm yyyy',

                    '%d/%y' => 'dd/yy',
                    '%d-%y' => 'dd-yy',
                    '%d%y' => 'dd yy',
                    '%d/%Y' => 'dd/yyyy',
                    '%d-%Y' => 'dd-yyyy',
                    '%d %Y' => 'dd yyyy',

                    '%b %d, %y' => 'mm dd, yy',
                    '%b %d, %Y' => 'mm dd, yyyy',

                    '%d %b, %y' => 'dd mm yy',
                    '%d %b, %Y' => 'dd mm yyyy',

                    '%y %b %d' => 'yy mm dd',
                    '%Y %b %d' => 'yyyy mm dd',

                    '%d %b, %Y' => 'dd mm, yyyy',
                    '%b-%d-%Y' => 'mm-dd-yyyy',

                    '%a, %d %b' => 'day-dd-m',

                    'custom' => 'Custom Format',
                ],
                'default' => '%d %b, %Y',
                'condition' => [
                    'show_date' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'input_date_format',
            [
                'label' => __('Custom Date Format', 'bdthemes-element-pack'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('Type date format here', 'bdthemes-element-pack'),
                'default' => '%a, %d %b',
                'condition' => [
                    'select_date_format' => 'custom',
                ],
            ]
        );

        $this->add_control(
            'show_country',
            [
                'label' => __('Show Country', 'bdthemes-element-pack'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdthemes-element-pack'),
                'label_off' => __('Hide', 'bdthemes-element-pack'),
                'return_value' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'input_country',
            [
                'label' => __('Type Country name ', 'bdthemes-element-pack'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __('example: Bangladesh', 'bdthemes-element-pack'),
                'default' => __('Bangladesh', 'bdthemes-element-pack'),
                'condition' => [
                    'show_country' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'timer_layout',
            [
                'label' => __('Layout', 'bdthemes-element-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => __('Top', 'bdthemes-element-pack'),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => __('Bottom', 'bdthemes-element-pack'),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'top',
                'toggle' => false,
                'conditions' => [
                    'relation' => 'or',
                    'terms' => [
                        [
                            'name' => 'show_country',
                            'value' => 'yes',
                        ],
                        [
                            'name' => 'show_date',
                            'value' => 'yes',
                        ],
                    ],
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label' => __('Alignment', 'bdthemes-element-pack'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
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
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone-timer' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Style

        $this->start_controls_section(
            'section_style_time',
            [
                'label' => __('Time', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,

            ]
        );

        $this->add_control(
            'time_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'time_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-time',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_date',
            [
                'label' => __('Date', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_date' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'date_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'date_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-date',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_country',
            [
                'label' => __('Country', 'bdthemes-element-pack'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_country' => 'yes',
                ],

            ]
        );

        $this->add_control(
            'country_color',
            [
                'label' => __('Color', 'bdthemes-element-pack'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country' => 'color: {{VALUE}};',
                ],

            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'country_typography',
                'selector' => '{{WRAPPER}} .bdt-time-zone .bdt-time-zone-country',
            ]
        );

        $this->end_controls_section();

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['select_gmt'] == 'custom') {
            $select_gmt = $settings['input_gmt'];
        } else {
            $select_gmt = $settings['select_gmt'];
        }

        if ($settings['show_country'] == 'yes') {
            $country = $settings['input_country'];
        } else {
            $country = 'emptyCountry';
        }

        if ($settings['show_date'] == 'yes') {
            if ($settings['select_date_format'] == 'custom') {
                $dateFormat = $settings['input_date_format'];
            } else {
                $dateFormat = $settings['select_date_format'];
            }
        } else {
            $dateFormat = 'emptyDate';
        }

        $this->add_render_attribute(
            [
                'bdt_time_zone_data' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            "id" => 'bdt-time-zone-data-' . $this->get_id(),
                            "gmt" => $select_gmt,
                            "timeHour" => $settings['time_hour'],
                            "country" => $country,
                            "dateFormat" => $dateFormat,

                        ])
                        ),
                    ],
                ],
            ]
        );

        ?>
 
        <div class="bdt-time-zone bdt-time-zone-<?php echo $settings['timer_layout']; ?>" >
            <div class="bdt-time-zone-timer  " id="bdt-time-zone-data-<?php echo $this->get_id(); ?>"   <?php echo $this->get_render_attribute_string('bdt_time_zone_data'); ?>>

            </div>

        <!-- Time 24 / 12 hours
            AM / PM
            Date = Yes/ no + Date Formate
        -->

    </div>

    <?php
}

}
