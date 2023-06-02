<?php

/*
  Plugin Name: Animated Number Counter
  Plugin URI: https://www.wordpress.org/downloads/animated-number-counter
  Description: Animated Number Counter is a powerful &amp; robust but easy to represent your team/staff members and their profiles with animated &amp; beautiful styled descriptions, skills &amp; links to social media.
  Author: Sk. Abul Hasan
  Author URI: http://www.wpmart.org/
  Version: 1.5
 */
if (!defined('ABSPATH'))
   exit;

define('anc_6310_plugin_url', plugin_dir_path(__FILE__));
define('anc_6310_plugin_dir_url', plugin_dir_url(__FILE__));
define ( 'anc_6310_PLUGIN_CURRENT_VERSION', 1.5 );

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

add_shortcode('anc_6310_number_counter', 'anc_6310_number_counter_shortcode');

function anc_6310_number_counter_shortcode($atts)
{
   extract(shortcode_atts(array('id' => ' ',), $atts));
   $ids = (int) $atts['id'];

   ob_start();
   include(anc_6310_plugin_url . 'shortcode.php');
   return ob_get_clean();
}


add_action('admin_menu', 'anc_6310_animated_number_counter');

function anc_6310_animated_number_counter()
{
   $options =  anc_6310_get_user_roles();
   add_menu_page('Animated Number Counter', 'Number Counter', $options, 'anc-6310-animated-number-counter', 'anc_6310_home', 'dashicons-id-alt', 100);
   add_submenu_page('anc-6310-animated-number-counter', 'Animated Number Counter', 'All Created Templates', $options, 'anc-6310-animated-number-counter', 'anc_6310_home');
   add_submenu_page('anc-6310-animated-number-counter', 'Counter 01-10', 'Template 01-10', $options, 'anc-6310-counter-01-10', 'anc_6310_counter_01_10');
   add_submenu_page('anc-6310-animated-number-counter', 'Counter 11-20', 'Template 11-20', $options, 'anc-6310-counter-11-20', 'anc_6310_counter_11_20');
   add_submenu_page('anc-6310-animated-number-counter', 'Counter 21-30', 'Template 21-30', $options, 'anc-6310-counter-21-30', 'anc_6310_counter_21_30');
   add_submenu_page('anc-6310-animated-number-counter', 'Add Counter', 'Manage Counter Profiles', $options, 'anc-6310-accordion-add-edit', 'anc_6310_accordion_add_edit');
   add_submenu_page('anc-6310-animated-number-counter', 'Import / Export Plugin', 'Import/Export Plugin', 'manage_options', 'anc-6310-animated-number-counter-import-export', 'anc_6310_import_export');
   add_submenu_page('anc-6310-animated-number-counter', 'License', 'License', 'manage_options', 'anc-6310-animated-number-counter-license', 'anc_6310_number_counter_6310_lincense');
   add_submenu_page('anc-6310-animated-number-counter', 'How to use', 'How to use', $options, 'anc-6310-animated-number-counter-use', 'anc_6310_number_counter_6310_how_to_use');
   add_submenu_page('anc-6310-animated-number-counter', 'WpMart Plugins', 'WpMart Plugins', $options, 'anc-6310-wpmart-plugins', 'anc_6310_wpmart_plugins');
}

function anc_6310_home()
{
   global $wpdb;
   wp_enqueue_style('anc-6310-font-awesome-5-0-13', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
   wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));

   $style_table = $wpdb->prefix . 'anc_6310_style';
   include anc_6310_plugin_url . 'header.php';
   include anc_6310_plugin_url . 'home.php';
}

include anc_6310_plugin_url . 'counter-menu.php';
add_action('wp_ajax_anc_6310_number_counter_info', 'anc_6310_number_counter_info');

if (is_admin()) {
   add_action('wp_ajax_anc_6310_number_counter_details', 'anc_6310_number_counter_details');
} else {
   add_action('wp_ajax_nopriv_anc_6310_number_counter_details', 'anc_6310_number_counter_details');
}

add_action('wp_ajax_nopriv_anc_6310_number_counter_details', 'anc_6310_number_counter_details');

include_once(anc_6310_plugin_url . 'settings/helper/functions.php');
register_activation_hook(__FILE__, 'anc_6310_number_counter_install');

function anc_6310_ajax_enqueue()
{
   wp_enqueue_script('anc-6310-ajax-script', plugins_url('assets/js/ajaxdata.js', __FILE__), array('jquery'));
   wp_localize_script('anc-6310-ajax-script', 'anc_6310_ajax_object', array('anc_6310_ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'anc_6310_ajax_enqueue');

function anc_6310_activation_redirect( $plugin ) {
   if( $plugin == plugin_basename( __FILE__ ) ) {
       exit( wp_redirect( admin_url( 'admin.php?page=anc-6310-animated-number-counter-use' ) ) );
   }
}
add_action( 'activated_plugin', 'anc_6310_activation_redirect' );

function anc_6310_enqueue_with_footer() {
   wp_enqueue_script('anc-6310-counterup', plugins_url('assets/js/jquery.counterup.js', __FILE__), array('jquery'), '1.1.0', true);
   wp_enqueue_script('anc-6310-output', plugins_url('assets/js/anc-6310-output.js', __FILE__), array('jquery'), '1.1.0', true);
}

function anc_6310_enqueue_without_footer() {
   wp_enqueue_script('anc-6310-counterup', plugins_url('assets/js/jquery.counterup.js', __FILE__), array('jquery'));
   wp_enqueue_script('anc-6310-output', plugins_url('assets/js/anc-6310-output.js', __FILE__), array('jquery'));
}

function anc_6310_did_footer(){
   if(did_action( 'wp_footer' )) {
      update_option( 'anc_6310_wp_footer_exist', 'anc' );
   } else{
      delete_option( 'anc_6310_wp_footer_exist' );

   }
}
add_action( 'shutdown',  'anc_6310_did_footer'  );

if( 'anc' == get_option( 'anc_6310_wp_footer_exist' ) ){
   add_action('wp_enqueue_scripts', 'anc_6310_enqueue_with_footer');
}   
else{
   add_action('wp_enqueue_scripts', 'anc_6310_enqueue_without_footer');
} 