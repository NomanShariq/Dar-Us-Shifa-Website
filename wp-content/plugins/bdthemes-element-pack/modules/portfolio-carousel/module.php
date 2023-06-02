<?php
namespace ElementPack\Modules\PortfolioCarousel;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'portfolio-carousel';
	}

	public function get_widgets() {

		$widgets = [
			'Portfolio_Carousel',
		];

		return $widgets;
	}
}
