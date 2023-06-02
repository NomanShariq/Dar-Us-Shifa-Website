<?php
namespace ElementPack\Modules\Buddypress;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'buddypress';
	}

	public function get_widgets() {


		$bp_member  = element_pack_option('bp_member', 'element_pack_third_party_widget', 'on' );
		$bp_group   = element_pack_option('bp_group', 'element_pack_third_party_widget', 'on' );
		$bp_friends = element_pack_option('bp_friends', 'element_pack_third_party_widget', 'on' );
		

		$widgets = [];

		if ( 'on' === $bp_member ) {
			$widgets[] = 'Buddypress_Member';
		}
		if ( 'on' === $bp_group ) {
			$widgets[] = 'Buddypress_Group';
		} 
		if ( 'on' === $bp_friends ) {
			$widgets[] = 'Buddypress_Friends';
		}

		return $widgets;
	}
}
