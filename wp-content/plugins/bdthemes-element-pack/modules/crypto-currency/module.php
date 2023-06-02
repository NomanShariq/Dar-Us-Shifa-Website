<?php
namespace ElementPack\Modules\CryptoCurrency;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'crypto-currency';
	}

	public function get_widgets() {

		$cryptocurrency_card  = element_pack_option('crypto-currency-card', 'element_pack_active_modules', 'off' );
		$cryptocurrency_table = element_pack_option('crypto-currency-table', 'element_pack_active_modules', 'off' );

		$widgets = [];

		if ( 'on' === $cryptocurrency_card ) {
			$widgets[] = 'CryptoCurrencyCard';
		} 
		if ( 'on' === $cryptocurrency_table ) {
			$widgets[] = 'CryptoCurrencyTable';
		}

		return $widgets;
	}
}