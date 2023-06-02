<?php
namespace ElementPack\Modules\Mailchimp;

use ElementPack\Base\Element_Pack_Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Element_Pack_Module_Base {

	public function __construct() {
		parent::__construct();

		add_action('wp_ajax_element_pack_mailchimp_subscribe', [$this, 'mailchimp_subscribe']);
		add_action('wp_ajax_nopriv_element_pack_mailchimp_subscribe', [$this, 'mailchimp_subscribe']);
	}

	public function get_name() {
		return 'mailchimp';
	}

	public function get_widgets() {

		$widgets = ['Mailchimp'];

		return $widgets;
	}

	/**
	 * subscribe mailchimp with api key
	 * @param  string $email        any valid email
	 * @param  string $status       subscribe or unsubscribe
	 * @param  array  $merge_fields First name and last name of subscriber
	 * @return [type]               [description]
	 */
	public function mailchimp_subscriber_status( $email, $status, $merge_fields = array('FNAME' => '','LNAME' => '') ){

	    $options = get_option( 'element_pack_api_settings' );
	    $list_id = (!empty($options['mailchimp_list_id'])) ? $options['mailchimp_list_id'] : ''; // Your list is here
	    $api_key = (!empty($options['mailchimp_api_key'])) ? $options['mailchimp_api_key'] : ''; // Your mailchimp api key here

	    $data = array(
	        'apikey'        => $api_key,
	        'email_address' => $email,
	        'status'        => $status,
	        'merge_fields'  => $merge_fields
	    );
	    $mailchimp_api = curl_init(); // init cURL connection
	 
	    curl_setopt($mailchimp_api, CURLOPT_URL, 'https://' . substr($api_key,strpos($api_key,'-')+1) . '.api.mailchimp.com/3.0/lists/' . $list_id . '/members/' . md5(strtolower($data['email_address'])));
	    curl_setopt($mailchimp_api, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic '.base64_encode( 'user:'.$api_key )));
	    curl_setopt($mailchimp_api, CURLOPT_USERAGENT, 'PHP-MCAPI/2.0');
	    curl_setopt($mailchimp_api, CURLOPT_RETURNTRANSFER, true);
	    curl_setopt($mailchimp_api, CURLOPT_CUSTOMREQUEST, 'PUT');
	    curl_setopt($mailchimp_api, CURLOPT_TIMEOUT, 10);
	    curl_setopt($mailchimp_api, CURLOPT_POST, true);
	    curl_setopt($mailchimp_api, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($mailchimp_api, CURLOPT_POSTFIELDS, json_encode($data) );
	 
	    $result = curl_exec($mailchimp_api);

	    return $result;
	}


	public function mailchimp_subscribe(){
	    
	    $result  = json_decode( $this->mailchimp_subscriber_status($_POST['email'], 'subscribed' ) );

	    if( $result->status == 400 ){
	        echo '<div class="bdt-text-warning">' . esc_html_x( 'Your request could not be processed', 'Mailchimp String', 'bdthemes-element-pack' ) . '</div>';
	    } elseif( $result->status == 401 ){
	        echo '<div class="bdt-text-warning">' . esc_html_x( 'Error: You did not set the API keys or List ID in admin settings!', 'Mailchimp String', 'bdthemes-element-pack' ) . '</div>';
	    } elseif( $result->status == 'subscribed' ){
	        echo '<span bdt-icon="icon: check" class="bdt-icon"></span> ' . esc_html_x( 'Thank you, You have subscribed successfully', 'Mailchimp String', 'bdthemes-element-pack' );
	    } else {
            echo '<div class="bdt-text-danger">' . esc_html_x( 'An unexpected internal error has occurred. Please contact Support for more information.', 'Mailchimp String', 'bdthemes-element-pack' ) . '</div>';
	    }
	    die;
	}

	
}
