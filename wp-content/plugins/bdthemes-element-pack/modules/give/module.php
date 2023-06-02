<?php
namespace ElementPack\Modules\Give;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'give';
	}

	public function get_widgets() {

		$give_donation_history = element_pack_option('give-donation-history', 'element_pack_third_party_widget', 'off' );
		$give_donor_wall = element_pack_option('give-donor-wall', 'element_pack_third_party_widget', 'off' );
		$give_form_grid = element_pack_option('give-form-grid', 'element_pack_third_party_widget', 'off' );
		$give_form = element_pack_option('give-form', 'element_pack_third_party_widget', 'off' );
		$give_goal = element_pack_option('give-goal', 'element_pack_third_party_widget', 'off' );
		$give_login = element_pack_option('give-login', 'element_pack_third_party_widget', 'off' );
		$give_profile_editor = element_pack_option('give-profile-editor', 'element_pack_third_party_widget', 'off' );
		$give_receipt = element_pack_option('give-receipt', 'element_pack_third_party_widget', 'off' );
		$give_register = element_pack_option('give-register', 'element_pack_third_party_widget', 'off' );
		$give_totals = element_pack_option('give-totals', 'element_pack_third_party_widget', 'off' );

		$widgets = [];

		if ( 'on' === $give_donation_history ) {
			$widgets[] = 'Give_Donation_History';
		}

		if ( 'on' === $give_donor_wall ) {
			$widgets[] = 'Give_Donor_Wall';
		}

		if ( 'on' === $give_form_grid ) {
			$widgets[] = 'Give_Form_Grid';
		}

		if ( 'on' === $give_form ) {
			$widgets[] = 'Give_Form';
		}

		if ( 'on' === $give_goal ) {
			$widgets[] = 'Give_Goal';
		}

		if ( 'on' === $give_login ) {
			$widgets[] = 'Give_Login';
		}

		if ( 'on' === $give_profile_editor ) {
			$widgets[] = 'Give_Profile_Editor';
		}

		if ( 'on' === $give_receipt ) {
			$widgets[] = 'Give_Receipt';
		}

		if ( 'on' === $give_register ) {
			$widgets[] = 'Give_Register';
		}

		if ( 'on' === $give_totals ) {
			$widgets[] = 'Give_Totals';
		}

		return $widgets;
	}
}