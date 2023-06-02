<?php

namespace ElementPack\Modules\FancyCard\Skins;

use Elementor\Skin_Base as Elementor_Skin_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Skin_Batty extends Elementor_Skin_Base
{

    public function get_id()
    {
        return 'batty';
    }

    public function get_title()
    {
        return __('Batty', 'bdthemes-element-pack');
    }

    public function render() {
		$settings  = $this->parent->get_settings_for_display();

		if ('yes' == $settings['global_link'] and $settings['global_link_url']['url']) {

			$target = $settings['global_link_url']['is_external'] ? '_blank' : '_self';

			$this->parent->add_render_attribute( 'fancy-card', 'onclick', "window.open('" . $settings['global_link_url']['url'] . "', '$target')" );
		}

		$this->parent->add_render_attribute( 'fancy-card', 'class', 'bdt-fancy-card bdt-skin-batty' );
		
		?>
		<div <?php echo $this->parent->get_render_attribute_string( 'fancy-card' ); ?>>
			<div class="bdt-batty-face bdt-batty-face1">
				<div class="bdt-content">
					<?php $this->parent->render_title(); ?>
					<?php $this->parent->render_text(); ?>
					<?php $this->parent->render_readmore(); ?>
				</div>
			</div>

			<div class="bdt-batty-face bdt-batty-face2">
				<?php $this->parent->render_icon(); ?>
			</div>
		</div>
		
		<?php $this->parent->render_indicator(); ?>
		<?php $this->parent->render_badge(); ?>	
		
        <?php
	}
}
