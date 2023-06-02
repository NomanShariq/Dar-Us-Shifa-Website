<?php
namespace ElementPack\Modules\CryptoCurrency\Widgets;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class CryptoCurrencyCard extends Module_Base {

	protected $_has_template_content = false;

	public function get_name() {
		return 'bdt-crypto-currency-card';
	}

	public function get_title() {
		return BDTEP . esc_html__( 'Crypto Currency Card', 'bdthemes-element-pack' );
	}

	public function get_icon() {
		return 'bdt-wi-crypto-currency-card';
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
		return 'https://youtu.be/TnSjwUKrw00';
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
				'default' 	  => 'bitcoin',
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
			'show_currency_marketing_rank',
			[
				'label'   => __( 'Show Marketing Rank', 'bdthemes-element-pack' ),
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
				'label'   => __( 'Show 24h Volume', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_currency_high_low',
			[
				'label'   => __( 'Show 24h High/Low', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		//Style
		$this->start_controls_section(
			'section_cryptocurrency_image_style',
			[
				'label' => __( 'Logo', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
                    'show_currency_image' => 'yes',
                ],
			]
		);

		$this->add_responsive_control(
			'currency_logo_image_width',
			[
				'label' => __( 'Size', 'bdthemes-element-pack' ),
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
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-image img' => 'width: {{SIZE}}{{UNIT}}; margin-left: auto;margin-right: auto;',
				],
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
                    '{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-name' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_name_style',
			[
				'label' => __( 'Currency Name', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'show_currency_name',
							'value' => 'yes',
						],
						[
							'name'     => 'show_currency_short_name',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
		'cryptocurrency_name_heading',
			[
				'label' => __( 'Name', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_currency_name' => 'yes'
				]
			]
		);

		$this->add_control(
		'cryptocurrency_name_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-name span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_currency_name' => 'yes'
				]
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'name_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-name span',
				'condition' => [
					'show_currency_name' => 'yes'
				]
			]
		);

		$this->add_control(
			'ccc_shortname_heading',
			[
				'label' => __( 'Short Name', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_currency_short_name' => 'yes'
				]
			]
		);

		$this->add_control(
		'cryptocurrency_short_name_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-short-name span' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_currency_short_name' => 'yes'
				]
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'short_name_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-short-name span',
				'condition' => [
					'show_currency_short_name' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
            'ccc_short_name_spacing',
            [
                'label' => esc_html__( 'Spacing', 'bdthemes-element-pack' ) . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-crypto-currency-card .bdt-currency .bdt-currency-short-name' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'show_currency_short_name' => 'yes'
				]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_current_price_style',
			[
				'label' => __( 'Currency Price', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'show_currency_current_price',
							'value' => 'yes',
						],
						[
							'name'     => 'show_currency_change_price',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'ccc_price_heading',
			[
				'label' => __( 'Price', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::HEADING,
				'condition' => [
					'show_currency_current_price' => 'yes'
				]
			]
		);

		$this->add_control(
		'cryptocurrency_current_price_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-current-price .bdt-price' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_currency_current_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'cryptocurrency_price_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-current-price .bdt-price',
				'condition' => [
					'show_currency_current_price' => 'yes'
				]
			]
		);

		$this->add_control(
			'ccc_percentage_heading',
			[
				'label' => __( 'Percentage (Change Price)', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_currency_change_price' => 'yes'
				]
			]
		);

		$this->add_control(
		'cryptocurrency_percentage_color',
			[
				'label' => __( 'Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-current-price .bdt-percentage' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_currency_change_price' => 'yes'
				]
			]
		);

		$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name' => 'cryptocurrency_percentage_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-current-price .bdt-percentage',
				'condition' => [
					'show_currency_change_price' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
            'ccc_change_price_spacing',
            [
                'label' => esc_html__( 'Spacing', 'bdthemes-element-pack' ) . BDTEP_NC,
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-crypto-currency-card .bdt-current-price .bdt-percentage' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
				'condition' => [
					'show_currency_change_price' => 'yes'
				]
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cryptocurrency_text_style',
			[
				'label' => __( 'Currency List', 'bdthemes-element-pack' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'conditions'   => [
					'relation' => 'or',
					'terms' => [
						[
							'name'  => 'show_currency_marketing_rank',
							'value' => 'yes',
						],
						[
							'name'     => 'show_currency_market_cap',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_currency_total_volume',
							'value'    => 'yes',
						],
						[
							'name'     => 'show_currency_high_low',
							'value'    => 'yes',
						],
					],
				],
			]
		);

		$this->add_control(
			'cryptocurrency_text_secondary_color',
			[
				'label' => __( 'Atribute Name Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute .bdt-item-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cryptocurrency_text_primary_color',
			[
				'label' => __( 'Atribute Value Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'cryptocurrency_text_typography',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute span',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'cryptocurrency_card_text_item_border',
				'selector' => '{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute',
			]
		);

		$this->add_control(
			'crypto_currency_card_test_item_border_color',
			[
				'label' => __( 'Border Color', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'cryptocurrency_text_padding',
			[
				'label' => __( 'Padding', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'cryptocurrency_text_margin',
			[
				'label' => __( 'Margin', 'bdthemes-element-pack' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .bdt-crypto-currency-card .bdt-ccc-atribute span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		        'order'       => false, //market_cap_desc
		        'per_page'    => 1, //limit
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
		$settings        = $this->get_settings_for_display();
		$id              = $this->get_id();
		$coins           = $this->render_coin_api();
		$currency        = $settings['currency'];
		$currency_symbol = element_pack_currency_symbol($settings['currency']);
		$crypto_currency = ($settings['crypto_currency']) ? $settings['crypto_currency'] : false;
		$locale          = explode('-', get_bloginfo('language'));
		$locale          = $locale[0];
	   	
		?>
		<div class="bdt-crypto-currency-card">
			<div data-bdt-grid>

				<?php foreach($coins as $coin) : ?>

				<div class="bdt-width-1-1 bdt-width-1-2@s">
					<div class="bdt-currency">

						<?php if ($settings['show_currency_image']) : ?>
    					<div class="bdt-currency-image">
    						<img alt="bdt-currency-image" src="<?php echo esc_url($coin['image']); ?>"/>
    					</div>
    					<?php endif; ?>

    					<?php if ($settings['show_currency_name']) : ?>
    					<div class="bdt-currency-name">
    						<span><?php echo esc_html( $coin['name'] ); ?></span>
    					</div>
    					<?php endif; ?>

    					<?php if ($settings['show_currency_short_name']) : ?>
    					<div class="bdt-currency-short-name">
    						<span><?php echo esc_attr( $coin['symbol'] ); ?> / <?php echo esc_html( $currency ); ?></span>
    					</div>
    					<?php endif; ?>

					</div>
				</div>

				<div class="bdt-width-1-1 bdt-width-1-2@s">
					<div class="bdt-current-price">

						<?php if ($settings['show_currency_current_price']) : ?>
						<div class="bdt-price">
							<?php echo esc_html( $currency_symbol ); ?><?php echo element_pack_money_format($coin['current_price']); ?>
						</div>
						<?php endif; ?>

						<?php if ($settings['show_currency_change_price']) : ?>
						<div class="bdt-percentage">(<?php echo element_pack_money_format($coin['price_change_24h']) ; ?>%)</div>
						<?php endif; ?>

					</div>
				</div>

				<div class="bdt-width-1-1 bdt-margin-small-top bdt-ccc-atributes">

					<?php if ($settings['show_currency_marketing_rank']) : ?>
					<div class="bdt-ccc-atribute">
						<span class="bdt-item-text"><?php esc_html_e('Market Cap Rank: ', 'bdthemes-element-pack'); ?></span>
						<span>#<?php echo esc_html($coin['market_cap_rank']); ?></span>
					</div>
					<?php endif; ?>

					<?php if ($settings['show_currency_market_cap']) : ?>
					<div class="bdt-ccc-atribute">
						<span class="bdt-item-text"><?php esc_html_e('Market Cap: ', 'bdthemes-element-pack'); ?></span>
						<span><?php echo esc_html( $currency_symbol ); ?><?php echo esc_html($coin['market_cap']); ?></span>
					</div>
					<?php endif; ?>

					<?php if ($settings['show_currency_total_volume']) : ?>
					<div class="bdt-ccc-atribute">
						<span class="bdt-item-text"><?php esc_html_e('24H Volume: ', 'bdthemes-element-pack'); ?></span>
						<span><?php echo esc_html( $currency_symbol ); ?><?php echo esc_html($coin['total_volume']); ?></span>
					</div>
					<?php endif; ?>

					<?php if ($settings['show_currency_high_low']) : ?>
					<div class="bdt-ccc-atribute">
						<span class="bdt-item-text"><?php esc_html_e('24H High/Low: ', 'bdthemes-element-pack'); ?></span>
						<span><?php echo esc_html( $currency_symbol ); ?><?php echo esc_html($coin['high_24h']); ?>/<?php echo esc_html( $currency_symbol ); ?><?php echo esc_html($coin['low_24h']); ?></span>
					</div>
					<?php endif; ?>

				</div>

				<?php endforeach; ?>

			</div>
		</div>
     
		<?php
	}
}

