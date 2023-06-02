<?php
function anc_6310_counter_01_10()
{
  global $wpdb;
  $style_table = $wpdb->prefix . 'anc_6310_style';
  $icon_table = $wpdb->prefix . 'anc_6310_icons';
  $counter_table = $wpdb->prefix . 'anc_6310_counter';

  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));
  wp_enqueue_script('anc-6310-counterup', plugins_url('assets/js/jquery.counterup.js', __FILE__), array('jquery'), '1.1.0', true);

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';

  if (empty($_GET['styleid'])) {
    wp_enqueue_style('anc-6310-google-font', 'https://fonts.googleapis.com/css?family=Amaranth');
    wp_enqueue_style('anc-6310-style-01-10', plugins_url('assets/css/style-01-10.css', __FILE__));
    include anc_6310_plugin_url . 'settings/preview-01-10.php';
  } else if (!empty($_GET['styleid'])) {
    
    anc_6310_no_preview_available();
    anc_6310_color_picker_script();
    anc_6310_font_picker_script();
    $styleId = (int) ($_GET['styleid']);
    wp_enqueue_script('anc-6310-font-select-js', plugins_url('assets/js/fontselect.js', __FILE__), array('jquery'));
    wp_enqueue_script('anc-6310-admin-js', plugins_url('assets/js/anc-6310-admin-script.js', __FILE__), array('jquery'));
    wp_enqueue_style('anc-6310-font-select-style', plugins_url('assets/css/fontselect.css', __FILE__));
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $styleId), ARRAY_A);
    include anc_6310_plugin_url . 'settings/counters/' . $styledata['style_name'] . '.php';
    $templateId = substr($styledata['style_name'], -2);
  }
}

function anc_6310_counter_11_20()
{
  global $wpdb;
  $style_table = $wpdb->prefix . 'anc_6310_style';
  $icon_table = $wpdb->prefix . 'anc_6310_icons';
  $counter_table = $wpdb->prefix . 'anc_6310_counter';

  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));
  wp_enqueue_script('anc-6310-counterup', plugins_url('assets/js/jquery.counterup.js', __FILE__), array('jquery'), '1.1.0', true);

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';
  if (empty($_GET['styleid'])) {
    wp_enqueue_style('anc-6310-google-font', 'https://fonts.googleapis.com/css?family=Amaranth');
    wp_enqueue_style('anc-6310-style-11-20', plugins_url('assets/css/style-11-20.css', __FILE__));
    include anc_6310_plugin_url . 'settings/preview-11-20.php';
  } else if (!empty($_GET['styleid'])) {
    
    anc_6310_no_preview_available();
    anc_6310_color_picker_script();
    anc_6310_font_picker_script();
    $styleId = (int) ($_GET['styleid']);
    wp_enqueue_script('anc-6310-font-select-js', plugins_url('assets/js/fontselect.js', __FILE__), array('jquery'));
    wp_enqueue_script('anc-6310-admin-js', plugins_url('assets/js/anc-6310-admin-script.js', __FILE__), array('jquery'));
    wp_enqueue_style('anc-6310-font-select-style', plugins_url('assets/css/fontselect.css', __FILE__));
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $styleId), ARRAY_A);
    $templateId = substr($styledata['style_name'], -2);
    include anc_6310_plugin_url . 'settings/counters/' . $styledata['style_name'] . '.php';
  }
}

function anc_6310_counter_21_30()
{
  global $wpdb;
  $style_table = $wpdb->prefix . 'anc_6310_style';
  $icon_table = $wpdb->prefix . 'anc_6310_icons';
  $counter_table = $wpdb->prefix . 'anc_6310_counter';

  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));
  wp_enqueue_script('anc-6310-counterup', plugins_url('assets/js/jquery.counterup.js', __FILE__), array('jquery'), '1.1.0', true);

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';
  if (empty($_GET['styleid'])) {
    wp_enqueue_style('anc-6310-google-font', 'https://fonts.googleapis.com/css?family=Amaranth');
    wp_enqueue_style('anc-6310-style-21-30', plugins_url('assets/css/style-21-30.css', __FILE__));
    include anc_6310_plugin_url . 'settings/preview-21-30.php';
  } else if (!empty($_GET['styleid'])) {
    
    anc_6310_no_preview_available();
    anc_6310_color_picker_script();
    anc_6310_font_picker_script();
    $styleId = (int) ($_GET['styleid']);
    wp_enqueue_script('anc-6310-font-select-js', plugins_url('assets/js/fontselect.js', __FILE__), array('jquery'));
    wp_enqueue_script('anc-6310-admin-js', plugins_url('assets/js/anc-6310-admin-script.js', __FILE__), array('jquery'));
    wp_enqueue_style('anc-6310-font-select-style', plugins_url('assets/css/fontselect.css', __FILE__));
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $styleId), ARRAY_A);
    $templateId = substr($styledata['style_name'], -2);
    include anc_6310_plugin_url . 'settings/counters/' . $styledata['style_name'] . '.php';
  }
}

function anc_6310_number_counter_6310_icon()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';
  include anc_6310_plugin_url . 'settings/social-icon.php';
}

function anc_6310_number_counter_6310_lincense()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));
  anc_6310_link_css_js();
  include anc_6310_plugin_url . 'header.php';
  include anc_6310_plugin_url . 'license.php';
}

function anc_6310_accordion_add_edit()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));

   anc_6310_link_css_js();

   include anc_6310_plugin_url . 'header.php';
   include anc_6310_plugin_url . 'settings/counter.php';
}

function anc_6310_number_counter_6310_how_to_use()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));
  anc_6310_link_css_js();
  include anc_6310_plugin_url . 'header.php';
  include anc_6310_plugin_url . 'settings/how-to-use.php';
}
function anc_6310_wpmart_plugins()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';
  include anc_6310_plugin_url . 'settings/wpmart-plugins.php';
}
function anc_6310_import_export()
{
  global $wpdb;
  wp_enqueue_style('anc-6310-style', plugins_url('assets/css/style.css', __FILE__));

  anc_6310_link_css_js();

  include anc_6310_plugin_url . 'header.php';
  include anc_6310_plugin_url . 'settings/import-export-plugins.php';
}