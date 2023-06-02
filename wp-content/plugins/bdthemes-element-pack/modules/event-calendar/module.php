<?php
namespace ElementPack\Modules\EventCalendar;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'event-calendar';
	}

	public function get_widgets() {

		$event_grid      = element_pack_option('event-grid', 'element_pack_third_party_widget', 'off' );
		$event_carousel   = element_pack_option('event-carousel', 'element_pack_third_party_widget', 'off' );
		$event_list   = element_pack_option('event-list', 'element_pack_third_party_widget', 'off' );

		$widgets = [];

		if ( 'on' === $event_grid ) {
			$widgets[] = 'Event_Grid';
		}
		if ( 'on' === $event_carousel ) {
			$widgets[] = 'Event_Carousel';
		}
		if ( 'on' === $event_list ) {
			$widgets[] = 'Event_List';
		}

		return $widgets;
	}
}