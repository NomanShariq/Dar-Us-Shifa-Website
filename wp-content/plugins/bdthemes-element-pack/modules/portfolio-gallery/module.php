<?php
namespace ElementPack\Modules\PortfolioGallery;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function get_name() {
		return 'portfolio-gallery';
	}

	public function get_widgets() {

		$widgets = [
			'Portfolio_Gallery',
		];

		return $widgets;
	}
}
