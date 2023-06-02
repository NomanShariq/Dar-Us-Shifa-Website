<?php

namespace ElementPack\Modules\Woocommerce;

use Elementor\Core\Documents_Manager;
use ElementPack\Base\Element_Pack_Module_Base;
use ElementPack\Element_Pack_Loader;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	const TEMPLATE_MINI_CART = 'cart/mini-cart.php';
	const OPTION_NAME_USE_MINI_CART = 'use_mini_cart_template';

	public static function is_active() {
		return class_exists( 'woocommerce' );
	}

	public function get_name() {
		return 'bdt-woocommerce';
	}

	public function get_widgets() {

		$products       = element_pack_option( 'wc_products', 'element_pack_third_party_widget', 'on' );
		$wc_add_to_cart = element_pack_option( 'wc_add_to_cart', 'element_pack_third_party_widget', 'on' );
		$wc_elements    = element_pack_option( 'wc_elements', 'element_pack_third_party_widget', 'on' );
		$wc_categories  = element_pack_option( 'wc_categories', 'element_pack_third_party_widget', 'on' );
		$wc_carousel    = element_pack_option( 'wc_carousel', 'element_pack_third_party_widget', 'on' );
		$wc_slider      = element_pack_option( 'wc_slider', 'element_pack_third_party_widget', 'on' );
		$wc_mini_cart   = element_pack_option( 'wc_mini_cart', 'element_pack_third_party_widget', 'off' );


		$widgets = [];

		if ( 'on' === $products ) {
			$widgets[] = 'Products';
		}
		if ( 'on' === $wc_add_to_cart ) {
			$widgets[] = 'Add_To_Cart';
		}
		if ( 'on' === $wc_elements ) {
			$widgets[] = 'Elements';
		}
		if ( 'on' === $wc_categories ) {
			$widgets[] = 'Categories';
		}
		if ( 'on' === $wc_carousel ) {
			$widgets[] = 'WC_Carousel';
		}
		if ( 'on' === $wc_slider ) {
			$widgets[] = 'WC_Slider';
		}
		if ( 'on' === $wc_mini_cart ) {
			$widgets[] = 'WC_Mini_Cart';
		}

		return $widgets;
	}

	public function woocommerce_locate_template( $template, $template_name, $template_path ) {

		if ( self::TEMPLATE_MINI_CART !== $template_name ) {
			return $template;
		}

		$plugin_path = BDTEP_MODULES_PATH . 'woocommerce/wc-templates/';

		if ( file_exists( $plugin_path . $template_name ) ) {
			$template = $plugin_path . $template_name;
		}

		return $template;
	}

	public function element_pack_mini_cart_fragment( $fragments ) {
		global $woocommerce;

		ob_start();

		?>
        <span class="bdt-mini-cart-inner">
				<span class="bdt-cart-button-text">
					<span class="bdt-mini-cart-price-amount">
	                    <?php echo WC()->cart->get_cart_subtotal(); ?>
					</span>
				</span>
				<span class="bdt-mini-cart-button-icon">
					<span class="bdt-cart-badge">
						<?php echo WC()->cart->get_cart_contents_count(); ?>
					</span>
					<span class="bdt-cart-icon">
						<i class="eicon" aria-hidden="true"></i>
					</span>
				</span>
			</span>

		<?php
		$fragments['a.bdt-mini-cart-button .bdt-mini-cart-inner'] = ob_get_clean();

		return $fragments;
	}

	public function add_product_post_class( $classes ) {
		$classes[] = 'product';

		return $classes;
	}

	public function add_products_post_class_filter() {
		add_filter( 'post_class', [ $this, 'add_product_post_class' ] );
	}

	public function remove_products_post_class_filter() {
		remove_filter( 'post_class', [ $this, 'add_product_post_class' ] );
	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	public function maybe_init_cart() {
		$has_cart = is_a( WC()->cart, 'WC_Cart' );

		if ( ! $has_cart ) {
			$session_class = apply_filters( 'woocommerce_session_handler', 'WC_Session_Handler' );
			WC()->session  = new $session_class();
			WC()->session->init();
			WC()->cart     = new \WC_Cart();
			WC()->customer = new \WC_Customer( get_current_user_id(), true );
		}
	}


	public function __construct() {

		parent::__construct();

		if ( ! empty( $_REQUEST['action'] ) && 'elementor' === $_REQUEST['action'] && is_admin() ) {
			add_action( 'init', [ $this, 'register_wc_hooks' ], 5 );
		}

		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'maybe_init_cart' ] );

		$wc_mini_cart = element_pack_option( 'wc_mini_cart', 'element_pack_third_party_widget', 'off' );

		if ( 'on' === $wc_mini_cart ) {
			add_filter( 'woocommerce_add_to_cart_fragments', [ $this, 'element_pack_mini_cart_fragment' ] );
			add_filter( 'woocommerce_locate_template', [ $this, 'woocommerce_locate_template' ], 12, 3 );
		}

		/**
		 * Modal data
		 */
		add_action( 'wp_ajax_nopriv_element_pack_wc_product_quick_view_content', array(
			$this,
			'element_pack_wc_product_quick_view_content'
		) );
		add_action( 'wp_ajax_element_pack_wc_product_quick_view_content', array(
			$this,
			'element_pack_wc_product_quick_view_content'
		) );

		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_title' );
		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_rating' );
		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_price' );
		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_excerpt' );
		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_add_to_cart' );
		add_action( 'element_pack_wc_product_quick_view_data', 'woocommerce_template_single_meta' );

		add_action( 'element_pack_wc_product_quick_view_product_sale_flash', 'woocommerce_show_product_sale_flash' );
		add_action( 'element_pack_woocommerce_show_product_images', array(
			$this,
			'element_pack_woocommerce_show_product_images'
		) );
	}

	public function element_pack_wc_product_quick_view_content() {

		global $woocommerce;

		check_ajax_referer( 'ajax-ep-wc-product-nonce', 'security' );

		wp_enqueue_script( 'wc-add-to-cart-variation' );

		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			$product_id = intval( $_POST['product_id'] );

			wp( 'p=' . $product_id . '&post_type=product' );
			ob_start();
			?>
            <div class="bdt-product-quick-view bdt-modal-container bdt-woocommerce-single-product-modal-wrapper"
                 bdt-modal>
                <div class="bdt-modal-dialog bdt-modal-body">
                    <button class="bdt-modal-close-default" type="button" bdt-close></button>
					<?php while ( have_posts() ) : the_post(); ?>
                        <div class="product">
                            <div id="product-<?php the_ID(); ?>" <?php post_class( 'product' ); ?> >
                                <div class="bdt-child-width-expand@s bdt-flex-middle" bdt-grid>
                                    <div>
										<?php do_action( 'element_pack_woocommerce_show_product_images' ); ?>
                                    </div>
                                    <div>
										<?php do_action( 'element_pack_wc_product_quick_view_product_sale_flash' ); ?>
                                        <div class="summary scrollable">
                                            <div class="summary-content">
												<?php do_action( 'element_pack_wc_product_quick_view_data' ); ?>
                                            </div>
                                        </div>
                                        <div class="scrollbar_bg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
					<?php endwhile; ?>
                </div>
            </div>
			<?php
			$output = trim( ob_get_contents() );
			ob_end_clean();

			echo wp_json_encode( array( 'data' => $output ), 200 );
		}
		exit;
	}

	public function element_pack_woocommerce_show_product_images() {

		global $post, $product;

		?>
        <div class="images">
			<?php

			if ( has_post_thumbnail() ) {
				$attachment_count = count( $product->get_gallery_image_ids() );
				$gallery          = $attachment_count > 0 ? '[product-gallery]' : '';
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title' => $props['title'],
					'alt'   => $props['alt'],
				) );
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $props['url'], $props['caption'], $image ), $post->ID );
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}

			$attachment_ids = $product->get_gallery_image_ids();
			
			if ( $attachment_ids ) :
				$loop = 0;
				$columns    = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
				?>
                <div class="thumbnails <?php echo 'columns-' . $columns; ?>"><?php
					foreach ( $attachment_ids as $attachment_id ) {
						$classes = array( 'thumbnail' );
						if ( $loop === 0 || $loop % $columns === 0 ) {
							$classes[] = 'first';
						}
						if ( ( $loop + 1 ) % $columns === 0 ) {
							$classes[] = 'last';
						}
						$image_link = wp_get_attachment_url( $attachment_id );
						if ( ! $image_link ) {
							continue;
						}
						$image_title   = esc_attr( get_the_title( $attachment_id ) );
						$image_caption = esc_attr( get_post_field( 'post_excerpt', $attachment_id ) );
						$image         = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), 0, $attr = array(
							'title' => $image_title,
							'alt'   => $image_title
						) );
						$image_class   = esc_attr( implode( ' ', $classes ) );
						echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" >%s</a>', $image_link, $image_class, $image_caption, $image ), $attachment_id, $post->ID, $image_class );
						$loop ++;
					}
					?>
                </div>
			<?php endif; ?>
        </div>
		<?php
	}
}
