<?php
namespace ElementPack\Modules\CryptoCurrency\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CryptoCurrencyTable extends Module_Base {

	protected $_has_template_content = false;

	public function get_name() {
		return 'bdt-crypto-currency-table';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Crypto Currency Table', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-crypto-currency-table';
	}

	public function get_categories() {
		return [ 'element-pack' ];
	}

	public function get_keywords() {
		return [ 'cryptocurrency', 'crypto', 'currency', 'table' ];
	}

	public function get_style_depends() {
        if ($this->ep_is_edit_mode()) {
            return ['ep-all-styles'];
        } else {
            return ['ep-crypto-currency'];
        }
    }

	public function get_custom_help_url() {
		return 'https://youtu.be/F13YPkFkLso';
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_cryptocurrency',
			[
				'label' => esc_html__( 'Crypto Currency', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'crypto_currency',
			[
				'label'       => __( 'Crypto Currency', 'bdthemes-element-pack' ),
				'description'       => __( 'If you want to show any selected crypto currency in your table so type those currency name here. For example: bitcoin,ethereum,litecoin', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'bitcoin,ethereum' , 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'currency',
			[
				'label'       => __( 'Currency', 'bdthemes-element-pack' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'usd' , 'bdthemes-element-pack' ),
				'placeholder' => __( 'usd' , 'bdthemes-element-pack' ),
				'label_block' => true,
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'market_cap_desc',
				'options' => [
					'market_cap_desc' => esc_html__( 'Market Capital Descending', 'bdthemes-element-pack' ),
					'market_cap_asc'  => esc_html__( 'Market Capital Ascending', 'bdthemes-element-pack' ),
					'gecko_desc'      => esc_html__( 'Gecko Descending', 'bdthemes-element-pack' ),
					'gecko_asc'       => esc_html__( 'Gecko Ascending', 'bdthemes-element-pack' ),
					'volume_desc'     => esc_html__( 'Volume Descending', 'bdthemes-element-pack' ),
					'volume_asc'      => esc_html__( 'Volume Ascending', 'bdthemes-element-pack' ),
				],
			]
		);

		$this->add_responsive_control(
			'limit',
			[
				'label' => __( 'Limit', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 250,
					],
				],
				'default' => [
					'size' => 100,
				],
			]
		);

		$this->add_control(
			'show_stripe',
			[
				'label'   => __( 'Row Stripe', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_row_hover',
			[
				'label' => __( 'Row Hover', 'bdthemes-element-pack' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);


		$this->add_control(
			'table_responsive_control',
			[
				'label'   => __( 'Responsive', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'table_responsive_2',
				'options' => [
					'table_responsive_no'     => esc_html__('No Responsive', 'bdthemes-element-pack'),
					'table_responsive_1' 	  => esc_html__('Responsive 1', 'bdthemes-element-pack'),
					'table_responsive_2' 	  => esc_html__('Responsive 2', 'bdthemes-element-pack'),
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_additional_option',
			[
				'label' => __( 'Additional Option', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'show_currency_image',
			[
				'label'   => __( 'Show Currency Image', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_name',
			[
				'label'   => __( 'Show Currency Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_short_name',
			[
				'label'   => __( 'Show Currency Short Name', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_marketing_rank',
			[
				'label'   => __( 'Show Marketing Rank', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_current_price',
			[
				'label'   => __( 'Show Current Price', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_change_price',
			[
				'label'   => __( 'Show Change Price', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_total_supply',
			[
				'label'   => __( 'Show Total Supply', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_market_cap',
			[
				'label'   => __( 'Show Market Cap', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_total_volume',
			[
				'label'   => __( 'Show Total Volume', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_circulating_supply',
			[
				'label'   => __( 'Show Circulating Supply', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_table_header_style',
			[
				'label' => __( 'Table Header', 'bdthemes-element-pack' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_cryptocurrency_table_header_style' );

		$this->start_controls_tab(
			'tab_cryptocurrency_table_header_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
		'cryptocurrency_header_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cryptocurrency_header_background_color',
			[
				'label' => __( 'Background Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cryptocurrency_header_hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
		'cryptocurrency_header_hover_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title:hover th' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cryptocurrency_header_background_hover_color',
			[
				'label' => __( 'Background Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title:hover' => 'background-color: {{VALUE}};',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'header_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title th',
			]
		);

		$this->add_responsive_control(
			'header_padding',
			[
				'label' => __( 'Padding', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr.bdt-cryptocurrency-title th' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();



		$this->start_controls_section(
			'section_style_body',
			[
				'label' => __( 'Table Body', 'bdthemes-element-pack' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cell_border_style',
			[
				'label'   => __( 'Border Style', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'none'   => __( 'None', 'bdthemes-element-pack' ),
					'solid'  => __( 'Solid', 'bdthemes-element-pack' ),
					'double' => __( 'Double', 'bdthemes-element-pack' ),
					'dotted' => __( 'Dotted', 'bdthemes-element-pack' ),
					'dashed' => __( 'Dashed', 'bdthemes-element-pack' ),
					'groove' => __( 'Groove', 'bdthemes-element-pack' ),
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr td' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cell_border_width',
			[
				'label'   => __( 'Border Width', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 5,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr td' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'cell_padding',
			[
				'label'      => __( 'Cell Padding', 'bdthemes-element-pack' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'top'    => 0.5,
					'bottom' => 0.5,
					'left'   => 1,
					'right'  => 1,
					'unit'   => 'em'
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'after',
			]
		);

		$this->start_controls_tabs('tabs_body_style');

		$this->start_controls_tab(
			'tab_normal',
			[
				'label' => __( 'Normal', 'bdthemes-element-pack' ),
			]
		);

		$this->add_control(
			'normal_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'normal_border_color',
			[
				'label'     => __( 'Border Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table tbody tr td' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hover',
			[
				'label' => __( 'Hover', 'bdthemes-element-pack' ),
				'condition' => [
					'show_row_hover' => 'yes',
				],
			]
		);

		$this->add_control(
			'row_hover_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table .bdt-table.bdt-table-hover tbody tr:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'row_hover_text_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table .bdt-table.bdt-table-hover tbody tr:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_stripe',
			[
				'label'     => __( 'Stripe', 'bdthemes-element-pack' ),
				'condition' => [
					'show_stripe' => 'yes',
				],
			]
		);

		$this->add_control(
			'stripe_background',
			[
				'label'     => __( 'Background', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table .bdt-table-striped tbody tr:nth-of-type(odd)' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stripe_color',
			[
				'label'     => __( 'Text Color', 'bdthemes-element-pack' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table .bdt-table-striped tbody tr:nth-of-type(odd)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_cryptocurrency_image_style',
			[
				'label' => __( 'Currency Image', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'show_currency_image' => 'yes',
                ],
			]
		);

		$this->add_responsive_control(
			'logo_image_width',
			[
				'label' => __( 'Width', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'unit' => 'px',
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr td img' => 'width: {{SIZE}}{{UNIT}};margin-left: auto;margin-right: auto;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_name_style',
			[
				'label' => __( 'Currency Name', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_currency_name' => 'yes',
				],
			]
		);

		$this->add_control(
		'cryptocurrency_name_color',
			[
				'label' => __( 'Name Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr td .bdt-cryptocurrency-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-table table tr td .bdt-cryptocurrency-name',
			]
		);

		$this->add_control(
		'cryptocurrency_short_name_color',
			[
				'label' => __( 'Short Name Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr td .bdt-currency-short-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'short_name_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-table table tr td .bdt-currency-short-name',
			]
		);

		$this->add_responsive_control(
            'cryptocurrency_name_spacing',
            [
                'label' => esc_html__( 'Spacing', 'bdthemes-element-pack' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-crypto-currency-table table tr td .bdt-cryptocurrency-fullname' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_text_style',
			[
				'label' => __( 'Currency Text', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		'cryptocurrency_text_color',
			[
				'label' => __( 'Text Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr td' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'text_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-table table tr td',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => __( 'Padding', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-table table tr td' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

	}

	protected function render_coin_api() {
		$settings        = $this->get_settings_for_display();
		$id              = $this->get_id();
		$crypto_currency = ($settings['crypto_currency']) ? $settings['crypto_currency'] : false;

		$api_url = 'https://api.coingecko.com/api/v3/coins/markets';


		// Parameters as array of key => value pairs
		$final_query =  add_query_arg( 
		    array( 
		        'vs_currency' => strtolower($settings['currency']),
		        'order'       => $settings['order'], //market_cap_desc
		        'per_page'    => $settings['limit']['size'], //limit
		        'page'        => 1,
		        'sparkline'   => 'false',
		        'ids'         => $crypto_currency,
		        
		    ), 
		    $api_url
		);



		$request = wp_remote_get($final_query, array('timeout' => 120));
		
		if (is_wp_error($request)) {
			return false; // Bail early
		}
		
		$body = wp_remote_retrieve_body($request);
		$coins = json_decode($body,true);
		
		$saved_coins = get_transient( 'element-pack-ccc' );

		if (false == $saved_coins) {
			set_transient( 'element-pack-ccc', $coins, 5 * MINUTE_IN_SECONDS );
			$coins = get_transient( 'element-pack-ccc' );
		}

		return $coins;

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = $this->get_id();
		$coins    = $this->render_coin_api();
		$currency = element_pack_currency_symbol($settings['currency']);



		if ('table_responsive_no' == $settings['table_responsive_control']) {
			$this->add_render_attribute('crypto-table', 'class', ['bdt-table']);
		}

		if ('table_responsive_1' == $settings['table_responsive_control']) {
			$this->add_render_attribute('crypto-table', 'class', ['bdt-table', 'bdt-table-responsive']);
		}
		
		if ('table_responsive_2' == $settings['table_responsive_control']) {
			$this->add_render_attribute('crypto-table', 'class', ['bdt-table', 'bdt-table-responsive-2']);
		}




		if ($settings['show_row_hover']) {
			$this->add_render_attribute('crypto-table', 'class', 'bdt-table-hover');
		}

		if ($settings['show_stripe']) {
			$this->add_render_attribute('crypto-table', 'class', 'bdt-table-striped');
		} else {
			$this->add_render_attribute('crypto-table', 'class', 'bdt-table-divider');
		}
	   	

		?>

		<div class="bdt-crypto-currency-table">

			<table <?php echo $this->get_render_attribute_string( 'crypto-table' ); ?>>
				
				<thead>
					<tr class="bdt-cryptocurrency-title">

						<?php if ($settings['show_currency_marketing_rank']) : ?>
						<th>#</th>
						<?php endif; ?>

						<th><?php esc_html_e('Currency', 'bdthemes-element-pack'); ?></th>

						<?php if ($settings['show_currency_current_price']) : ?>
						<th><?php echo esc_html( $currency ); ?> <?php esc_html_e('Price', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

						<?php if ($settings['show_currency_change_price']) : ?>
						<th><?php esc_html_e('24h % Change', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

						<?php if ($settings['show_currency_total_supply']) : ?>
						<th title="Total Market Supply"><?php esc_html_e('T. Supply', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

						<?php if ($settings['show_currency_market_cap']) : ?>
						<th><?php esc_html_e('Market cap.', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

						<?php if ($settings['show_currency_total_volume']) : ?>
						<th><?php esc_html_e('24h Volume', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

						<?php if ($settings['show_currency_circulating_supply']) : ?>
						<th title="Circulating Supply"><?php esc_html_e('C. Supply', 'bdthemes-element-pack'); ?></th>
						<?php endif; ?>

					</tr>
					
				</thead>
				

				<tbody>
					
					<?php foreach($coins as $coin) : ?>
						<tr class="bdt-cryptocurrency-list">

							<?php if ($settings['show_currency_marketing_rank']) : ?>
							<td role="main" class="bdt-table-shrink" title="<?php esc_html_e( 'Marketplace Rank', 'bdthemes-element-pack' ); ?>"><?php echo esc_html($coin['market_cap_rank']); ?></td>
							<?php endif; ?>

							<td role="main">
								
								<?php if ($settings['show_currency_image']) : ?>
								<span class="bdt-crypto-currency-image">
									<img alt="bdt-crypto-currency-image" src="<?php echo esc_attr($coin['image']); ?>"/>
								</span>
								<?php endif; ?>
								<span class="bdt-cryptocurrency-fullname">
									<span class="bdt-display-block">
										<?php if ($settings['show_currency_name']) : ?>
										<span class="bdt-cryptocurrency-name"><?php echo esc_html( $coin['name'] ); ?>
										</span>
										<?php endif; ?>
									</span>
									<span class="bdt-display-block bdt-currency-short-name">
										<?php if ($settings['show_currency_short_name']) : ?>
										<span class="bdt-text-uppercase"><?php echo esc_attr( $coin['symbol'] ); ?>
										</span>
										<?php endif; ?>
									</span>
								</span>
							</td>
							
							<?php if ($settings['show_currency_current_price']) : ?>
							<td role="main"><?php echo esc_html( $currency ); ?> <?php echo element_pack_money_format($coin['current_price']); ?></td>
							<?php endif; ?>

							<?php if ($settings['show_currency_change_price']) : ?>
							<td role="main"><?php echo esc_html($coin['price_change_24h']); ?></td>
							<?php endif; ?>

							<?php if ($settings['show_currency_total_supply']) : ?>
							<td role="main" title="<?php echo esc_html($coin['total_supply']); ?>" data-bdt-tooltip="pos: top-left;"><?php echo element_pack_currency_format($coin['total_supply']); ?></td>
							<?php endif; ?>

							<?php if ($settings['show_currency_market_cap']) : ?>
							<td role="main" title="<?php echo esc_html($coin['market_cap']); ?>" data-bdt-tooltip="pos: top-left;"><?php echo element_pack_currency_format($coin['market_cap']); ?></td>
							<?php endif; ?>

							<?php if ($settings['show_currency_total_volume']) : ?>
							<td role="main" title="<?php echo esc_html($coin['total_volume']); ?>" data-bdt-tooltip="pos: top-left;"><?php echo element_pack_currency_format($coin['total_volume']); ?></td>
							<?php endif; ?>

							<?php if ($settings['show_currency_circulating_supply']) : ?>
							<td role="main" title="<?php echo esc_html($coin['circulating_supply']); ?>" data-bdt-tooltip="pos: top-left;"><?php echo element_pack_currency_format($coin['circulating_supply']); ?></td>
							<?php endif; ?>

						</tr>
					
					<?php endforeach; ?>

				</tbody>

	    	</table>

	    </div>
     
		<?php
	}
}

