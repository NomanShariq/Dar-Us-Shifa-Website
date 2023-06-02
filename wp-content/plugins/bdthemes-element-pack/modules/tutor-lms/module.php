<?php
namespace ElementPack\Modules\TutorLms;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'tutor-lms';
	}

	public function get_widgets() {

		$tutor_lms_grid     = element_pack_option('tutor-lms-course-grid', 'element_pack_third_party_widget', 'off' );
		$tutor_lms_carousel = element_pack_option('tutor-lms-course-carousel', 'element_pack_third_party_widget', 'off' );

		$widgets = [];

		if ( 'on' === $tutor_lms_grid ) {
			$widgets[] = 'Tutor_Lms_Course_Grid';
		}

		if ( 'on' === $tutor_lms_carousel ) {
			$widgets[] = 'Tutor_Lms_Course_Carousel';
		}


		return $widgets;
	}
}
