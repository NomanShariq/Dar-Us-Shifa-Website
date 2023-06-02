<?php
namespace ElementPack\Modules\Charitable;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'charitable';
	}

	public function get_widgets() {

		$charitable_campaigns     = element_pack_option('charitable-campaigns', 'element_pack_third_party_widget', 'off' );
		$charitable_donations     = element_pack_option('charitable-donations', 'element_pack_third_party_widget', 'off' );
		$charitable_donors        = element_pack_option('charitable-donors', 'element_pack_third_party_widget', 'off' );
		$charitable_stat          = element_pack_option('charitable-stat', 'element_pack_third_party_widget', 'off' );
		$charitable_donation_form = element_pack_option('charitable-donation-form', 'element_pack_third_party_widget', 'off' );
		$charitable_login         = element_pack_option('charitable-login', 'element_pack_third_party_widget', 'off' );
		$charitable_profile       = element_pack_option('charitable-profile', 'element_pack_third_party_widget', 'off' );
		$charitable_registration  = element_pack_option('charitable-registration', 'element_pack_third_party_widget', 'off' );

		$widgets = [];

		if ( 'on' === $charitable_campaigns ) {
			$widgets[] = 'Charitable_Campaigns';
		}

		if ( 'on' === $charitable_donations ) {
			$widgets[] = 'Charitable_Donations';
		}

		if ( 'on' === $charitable_donors ) {
			$widgets[] = 'Charitable_Donors';
		}

		if ( 'on' === $charitable_stat ) {
			$widgets[] = 'Charitable_Stat';
		}

		if ( 'on' === $charitable_donation_form ) {
			$widgets[] = 'Charitable_Donation_Form';
		}

		if ( 'on' === $charitable_login ) {
			$widgets[] = 'Charitable_Login';
		}

		if ( 'on' === $charitable_registration ) {
			$widgets[] = 'Charitable_Registration';
		}

		if ( 'on' === $charitable_profile ) {
			$widgets[] = 'Charitable_Profile';
		}

		return $widgets;
	}
}