<?php
namespace ElementPack\Modules\TestimonialCarousel\Skins;

use ElementPack\Base\Module_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Vyxo extends Elementor_Skin_Base {
	public function get_id() {
		return 'bdt-vyxo';
	}

	public function get_title() {
		return __( 'Vyxo', 'bdthemes-element-pack' );
	}

	public function _register_controls_actions() {
		parent::_register_controls_actions();

		add_action( 'elementor/element/bdt-testimonial-carousel/section_style_text/after_section_start', [ $this, 'register_vyxo_style_controls'   ] );
	}

	public function register_vyxo_style_controls( Module_Base $widget ) {
		$this->parent = $widget;

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'text_background_color',
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .bdt-testimonial-carousel .bdt-testimonial-carousel-text-wrap',
				'separator' => 'after',
			]
		);
	}

	public function render() {
		$settings = $this->parent->get_settings();

		$wp_query = $this->parent->render_query();

		if( $wp_query->have_posts() ) : ?>

			<?php $this->parent->render_header('vyxo'); ?>

				<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
			  		<div class="swiper-slide bdt-testimonial-carousel-item">
				  		<div class="bdt-testimonial-carousel-text-wrap bdt-padding bdt-background-primary">
			            	<?php $this->parent->render_excerpt(); ?>
				  		</div>
				  		<div class="bdt-testimonial-carousel-item-wrapper">
					  		<div class="testimonial-item-header bdt-position-top-center">
					  			<?php $this->parent->render_image( get_the_ID() ); ?>
				            </div>
							
							<div class="bdt-testimonial-meta <?php echo ($settings['meta_multi_line']) ? '' : 'bdt-meta-multi-line'; ?>">
							<?php
			            	$this->parent->render_title( get_the_ID() );
							$this->parent->render_address( get_the_ID() ); ?>
							</div>
							<?php 

	                        if ( $settings['show_rating'] && $settings['show_text'] ) : ?>
		                    	<div class="bdt-testimonial-carousel-rating bdt-display-inline-block">
								    <?php $this->parent->render_rating( get_the_ID() ); ?>
				                </div>
	                        <?php endif; ?>

		                </div>
	                </div>
				<?php endwhile;	wp_reset_postdata(); ?>

			<?php $this->parent->render_footer();
		 	
		endif;
	}
}

