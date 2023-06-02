<?php
namespace EssentialBlocks\Core;
use EssentialBlocks\Traits\HasSingletone;

/**
 * Load google fonts.
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class FontLoader {
    use HasSingletone;

    /**
     * Google fonts to enqueue
     *
     * @access public
     * @var array
     */
    public static $gfonts = [];

    /**
     * The Constructor.
     */
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'fonts_loader'] );
    }

    public static function get_fonts_family( $attributes ) {
        $keys             = preg_grep( '/^(\w+)FontFamily/i', array_keys( $attributes ), 0 );
        $googleFontFamily = [];
        foreach ( $keys as $key ) {
            $googleFontFamily[] = $attributes[$key];
        }
        return $googleFontFamily;
    }

    /**
     * Load fonts.
     *
     * @access public
     */
    public function fonts_loader() {
        $eb_settings = get_option( 'eb_settings', [] );
        $googleFont  = ! empty( $eb_settings['googleFont'] ) ? $eb_settings['googleFont'] : 'true';

        if ( 'false' !== $googleFont ) {
            $fonts = self::$gfonts;
            if (  ( $key = array_search( 'Default', $fonts ) ) !== false ) {
                unset( $fonts[$key] );
            }
            if ( ! empty( $fonts ) ) {
                $gfonts      = '';
                $gfonts_attr = ':100,100italic,200,200italic,300,300italic,400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
                foreach ( $fonts as $font ) {
                    $gfonts .= str_replace( ' ', '+', trim( $font ) ) . $gfonts_attr . '|';
                }
                if ( ! empty( $gfonts ) ) {
                    $query_args = [
                        'family' => $gfonts
                    ];
                    wp_register_style(
                        'eb-block-fonts',
                        add_query_arg( $query_args, '//fonts.googleapis.com/css' ),
                        []
                    );
                    wp_enqueue_style( 'eb-block-fonts' );
                }
                // Reset.
                $gfonts = '';
            }
        }
    }
    /**
     * save google font family for blocks
     * @since 4.0.0
     * @param array $fonts get fonts family array
     *
     * @return void
     */
    public static function load_gfonts( $attributes ) {
        $fonts = self::get_fonts_family( $attributes );

        self::$gfonts = array_unique( array_merge( self::$gfonts, $fonts ) );
    }
}
