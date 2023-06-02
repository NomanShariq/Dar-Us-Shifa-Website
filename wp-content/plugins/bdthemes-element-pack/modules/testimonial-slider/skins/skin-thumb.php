<?php
namespace ElementPack\Modules\TestimonialSlider\Skins;


use Elementor\Skin_Base as Elementor_Skin_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Skin_Thumb extends Elementor_Skin_Base {
	public function get_id() {
		return 'bdt-thumb';
	}

	public function get_title() {
		return __( 'Thumb', 'bdthemes-element-pack' );
	}

	public function render_image( $bdt_counter ) {

		$testimonial_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' );		

		if ( ! $testimonial_thumb ) {
			$testimonial_thumb = BDTEP_ASSETS_URL.'images/member.svg';
		} else {
			$testimonial_thumb = $testimonial_thumb[0];
		}

		?>
		<li class="bdt-slider-thumbnav" data-bdt-slider-item="<?php echo esc_attr($bdt_counter); ?>">
			<div class="bdt-slider-thumbnav-inner bdt-position-relative">
				<a href="#">
					<img src="<?php echo esc_url( $testimonial_thumb ); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" />
				</a>
			</div>
		</li>
		<?php
	}

	public function render_thumbnavs($settings) {

		?>
		<div class="bdt-thumbnav-wrapper bdt-flex bdt-flex-<?php echo esc_attr($settings['alignment']); ?>">
    		<ul class="bdt-thumbnav">

				<?php		
				$bdt_counter = 0;

				$this->parent->query_posts();

				$wp_query = $this->parent->get_query();
				      
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					$this->render_image( $bdt_counter );
					
					$bdt_counter++;

				endwhile;
				
				wp_reset_postdata();

				?>
    		</ul>
		</div>
		
		<?php
	}

	public function render_header($skin, $id, $settings) {

        $this->parent->add_render_attribute('testimonial-slider', 'id', 'bdt-testimonial-slider-' . esc_attr($id));
        $this->parent->add_render_attribute('testimonial-slider', 'class', ['bdt-testimonial-slider', 'bdt-testimonial-slider-skin-' . esc_attr($skin)]);

        ?>

        <div <?php echo $this->parent->get_render_attribute_string('testimonial-slider'); ?>>
        <?php

        $this->parent->add_render_attribute(
            [
                'slider-settings' => [
                    'data-bdt-slider' => [
                        wp_json_encode(array_filter([
                            "autoplay"          => $settings["autoplay"],
                            "autoplay-interval" => $settings["autoplay_interval"],
                            "finite"            => $settings["loop"] ? false : true,
                            "pause-on-hover"    => $settings["pause_on_hover"] ? true : false,
                            "velocity"          => ($settings["velocity"]) ? $settings["velocity"] : 1,
                        ]))
                    ]
                ]
            ]
        );

        ?>
        <div <?php echo($this->parent->get_render_attribute_string('slider-settings')); ?>>
        <ul class="bdt-slider-items bdt-child-width-1-1 bdt-grid bdt-grid-match" data-bdt-grid>
        <?php
    }

	public function render_footer($settings) {

		?>
			</ul>
				<?php $this->render_thumbnavs($settings); ?>
		</div>
	</div>
	<?php
	}

	public function render() {
		$settings = $this->parent->get_settings_for_display();
		$id       = $this->parent->get_id();
		$index = 1;

    	$rating_align = ($settings['thumb']) ? '' : ' bdt-flex-' . esc_attr($settings['alignment']);

		$this->parent->query_posts();

		$wp_query = $this->parent->get_query();

		if ( ! $wp_query->found_posts ) {
			return;
		}
			$this->render_header('thumb', $id, $settings);
		?>
			<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

		  		<li class="bdt-slider-item">
			  		<div class="bdt-slider-item-inner bdt-box-shadow-small bdt-padding">

	                	
						<?php if ('after' == $settings['meta_position']) : ?>
		                	<div class="bdt-testimonial-text bdt-text-<?php echo esc_attr($settings['alignment']); ?> bdt-padding-remove-vertical">
		                		<?php $this->parent->render_excerpt(); ?>
		                			
	                		</div>
	                	<?php endif; ?>
	                	
                		<div class="bdt-flex bdt-flex-<?php echo esc_attr($settings['alignment']); ?> bdt-flex-middle">

		                    <?php $this->parent->render_meta('testmonial-meta-' . $index); ?>

		                </div>

    					<?php if ('before' == $settings['meta_position']) : ?>
                    		<div class="bdt-testimonial-text bdt-text-<?php echo esc_attr($settings['alignment']); ?> bdt-padding-remove-vertical">
		                		<?php $this->parent->render_excerpt(); ?>
		                			
	                		</div>
                   		<?php endif; ?>
	                </div>
                </li>
		  
				<?php 

				$index++;
			endwhile;	
			
			wp_reset_postdata();
			
		$this->render_footer($settings);
	}
}

