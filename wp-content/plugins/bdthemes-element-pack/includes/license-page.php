<?php
namespace ElementPack;

use ElementPack\Base\Element_Pack_Base;
use ElementPack\Notices;
use Elementor\Settings;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Element_Pack_License_Page {

    const PAGE_ID       = 'element-pack-license';
    public $notice      = '';
    public $notice_type = 'info';
    private $hasLicense=false;

    public function register_page() {
        $menu_text = __( 'Element Pack License', 'bdthemes-element-pack' );

        add_submenu_page(
            Settings::PAGE_ID,
            $menu_text,
            $menu_text,
            'manage_options',
            self::PAGE_ID,
            [ $this, 'display_page' ]
        );
    }

    public static function get_url() {
        return admin_url( 'admin.php?page=' . self::PAGE_ID );
    }


    public function display_page() {

        $license_key   = self::get_license_key();
        $license_email = self::get_license_email();
        ?>

        <div class="wrap element-pack-license-wrapper">
            <h2>Element Pack License Settings</h2>
            <div class="element-pack-license-container">
                <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                    <?php

                    if( $this->hasLicense ) {
                        
                        $responseObj = Element_Pack_Base::GetRegisterInfo();
                        
                        if(!empty($responseObj)) {  ?>

                            <input type="hidden" name="action" value="element_pack_deactivate_license"/>

                            <ul class="element-pack-license-info">
                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'Status', 'bdthemes-element-pack' ); ?></span>

                                        <?php if ( $responseObj->is_valid ) : ?>
                                            <span class="license-valid">Valid</span>
                                        <?php else : ?>
                                            <span class="license-valid">Invalid</span>
                                        <?php endif; ?>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'License Type', 'bdthemes-element-pack' ); ?></span>
                                        <?php echo $responseObj->license_title; ?>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'License Expired on', 'bdthemes-element-pack' ); ?></span>
                                        <?php echo $responseObj->expire_date; ?>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'Support Expired on', 'bdthemes-element-pack' ); ?></span>
                                        <?php echo $responseObj->support_end; ?>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'License Email', 'bdthemes-element-pack' ); ?></span>
                                        <?php echo self::get_license_email(); ?>
                                    </div>
                                </li>

                                <li>
                                    <div>
                                        <span class="license-info-title"><?php _e( 'Your License Key', 'bdthemes-element-pack' ); ?></span>
                                        <span class="license-key"><?php echo esc_attr( self::get_hidden_license_key() ); ?></span>
                                    </div>
                                </li>
                            </ul>
                            
                            <?php wp_nonce_field( 'element-pack-license' ); ?>
                            <?php submit_button('Deactivate'); 
                    
                        }

                    } else { ?>

                        <p><?php _e( 'Enter your license key here, to activate Element Pack Pro, and get full feature updates and premium support.', 'bdthemes-element-pack' ); ?></p>

                        <ol>
                            <li><?php printf( __( 'Log in to your <a href="%1s" target="_blank">bdthemes</a> or <a href="%2s" target="_blank">envato</a> account to get your license key.', 'bdthemes-element-pack' ), 'https://bdthemes.onfastspring.com/account', 'https://codecanyon.net/downloads' ); ?></li>
                            <li><?php printf( __( 'If you don\'t yet have a license key, <a href="%s" target="_blank">get Element Pack now</a>.', 'bdthemes-element-pack' ), 'https://elementpack.pro/pricing/' ); ?></li>
                            <li><?php _e( 'Copy the license key from your account and paste it below.', 'bdthemes-element-pack' ); ?></li>
                        </ol>
                        
                        
                        <input type="hidden" name="action" value="element_pack_activate_license"/>
                        
                        <div class="bdt-ep-license-field">
                            <label for="element_pack_license_email">License Email</label>
                            <input type="text" class="regular-text code" name="element_pack_license_email" size="50" placeholder="example@email.com" value="<?php echo esc_attr($license_email); ?>" required="required">
                        </div>

                        <div class="bdt-ep-license-field">
                            <label for="element_pack_license_key">License code</label>
                            <input type="text" class="regular-text code" name="element_pack_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
                        </div>
                        
                        <div class="bdt-ep-license-active-btn">
                            <?php wp_nonce_field( 'element-pack-license' ); ?>
                            <?php submit_button('Activate'); ?>
                        </div>

                        <?php 
                    } ?>
                </form>
            </div>
        </div>
        
        <?php
    }

    private static function get_hidden_license_key() {
        $input_string = self::get_license_key();

        $start        = 9;
        $length       = mb_strlen( $input_string ) - $start - 9;

        $mask_string  = preg_replace( '/[a-zA-Z0-9]/', 'X', $input_string );
        $mask_string  = mb_substr( $mask_string, $start, $length );
        $input_string = substr_replace( $input_string, $mask_string, $start, $length );

        return $input_string;
    }

    public static function get_license_key() {
        return trim( get_option( 'element_pack_license_key' ) );
    }

    public static function get_license_email() {
        return trim( get_option( 'element_pack_license_email', get_bloginfo( 'admin_email' ) ) );
    }

    public static function set_license_key( $license_key ) {
        return update_option( 'element_pack_license_key', $license_key );
    }

    public static function set_license_email( $license_email ) {
        return update_option( 'element_pack_license_email', $license_email );
    }

    public function action_activate_license() {
        check_admin_referer( 'element-pack-license' );

        $license_key   = trim( $_POST['element_pack_license_key'] );
        $license_email = trim( $_POST['element_pack_license_email'] );

        if( Element_Pack_Base::CheckWPPlugin( $license_key, $license_email, $error, $responseObj, BDTEP__FILE__ ) ){

            self::set_license_key( $license_key );
            self::set_license_email( $license_email );
            
            $this->notice = $responseObj->msg;

            wp_die( $responseObj->msg, __( 'Element Pack', 'bdthemes-element-pack' ), [
                'link_url'  => $_POST['_wp_http_referer'],
                'link_text' => 'Go Back',
            ] );

        } else {

            $this->notice_type = 'warning';
            
            $this->notice = $error;

            wp_die( __( 'License Install failed! because: ', 'bdthemes-element-pack' ) . $error, __( 'Element Pack', 'bdthemes-element-pack' ), [
                'back_link' => true,
            ] );
           
        }

        wp_safe_redirect( $_POST['_wp_http_referer'] );
        
        die();
    }
    

    public function action_deactivate_license() {

        check_admin_referer( 'element-pack-license' );

        $message = __('Something wrong there! please go back and refresh the page.', 'bdthemes-element-pack');

        if (Element_Pack_Base::RemoveLicenseKey( BDTEP__FILE__ , $message ) ) {
            delete_option( 'element_pack_license_key' );  
            delete_option( 'element_pack_license_email' );  
        }

        wp_die( $message, __( 'Element Pack', 'bdthemes-element-pack' ), [
            'link_url'  => $_POST['_wp_http_referer'],
            'link_text' => 'Go Back',
        ] );


        wp_safe_redirect( $_POST['_wp_http_referer'] );

        die();
    }

    public function admin_notice(){

        Notices::add_notice(
            [
                'id'               => 'license-issue',
                'type'             => 'error',
                'dismissible'      => true,
                'dismissible-time' => 43200,
                'message'          => __( 'Thank you for purchase Element Pack. Please <a href="'.self::get_url().'">activate your license</a> to get feature updates, premium support. <br> Don\'t have Element Pack license? Purchase and download your license copy <a href="https://elementpack.pro/" target="_blank">from here</a>.', 'bdthemes-element-pack' ),
            ]
        );    
    }

    public function __construct() {
        add_action( 'admin_menu', [ $this, 'register_page' ], 800 );

        $license_key   = self::get_license_key();
        $license_email = self::get_license_email();

        Element_Pack_Base::addOnDelete(function(){
            delete_option( 'element_pack_license_email' );
            delete_option( 'element_pack_license_key' ); 
        });

        if( Element_Pack_Base::CheckWPPlugin( $license_key, $license_email, $error, $responseObj, BDTEP__FILE__ ) ){
            add_action( 'admin_post_element_pack_deactivate_license', [ $this, 'action_deactivate_license' ] );
            $this->hasLicense=true;
        } else {
	       add_action( 'admin_notices', [$this, 'admin_notice'] );
        }        
    	add_action( 'admin_post_element_pack_activate_license', [ $this, 'action_activate_license' ] );        
    }
}

new Element_Pack_License_Page();