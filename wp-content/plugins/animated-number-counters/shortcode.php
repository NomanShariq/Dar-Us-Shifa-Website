<?php
anc_6310_check_field_exists();
anc_6310_version_status();
global $wpdb;
$style_table = $wpdb->prefix . 'anc_6310_style';
$icon_table = $wpdb->prefix . 'anc_6310_icons';
$counter_table = $wpdb->prefix . 'anc_6310_counter';

$styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $ids), ARRAY_A);
$css = explode("!!##!!", $styledata['css']);
$key = explode(",", $css[0]);
$value = explode("||##||", $css[1]);

$cssData = array_combine($key, $value);
$counter_order  = explode(",", $styledata['counterids']);

$allCounters = array();
if($counter_order){
   foreach($counter_order as $cid){
      if($cid != ''){
         $results = $wpdb->get_row("SELECT * FROM $counter_table WHERE id={$cid}", ARRAY_A);
         if($results){
            $allCounters[] = $results;
         }
      }
   }
}

if (file_exists(anc_6310_plugin_url . "output/{$styledata['style_name']}.php")) {
   $fonts = "";
   if(isset($cssData['title_font_family']) && $cssData['title_font_family']){
      $fonts = $cssData['title_font_family'];
   }
   if(isset($cssData['description_font_family']) && $cssData['description_font_family']){
      $fonts .= "|" . $cssData['description_font_family'];
   }
   if(isset($cssData['number_font_family']) && $cssData['number_font_family']){
      $fonts .= "|" . $cssData['number_font_family'];
   }
   if(isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family']){
      $fonts .= "|" . $cssData['number_prefix_font_family'];
   } 
   if(isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family']){
      $fonts .= "|" . $cssData['number_suffix_font_family'];
   }
   if(isset($cssData['button_font_family']) && $cssData['button_font_family']){
      $fonts .= "|" . $cssData['button_font_family'];
   }
 
   wp_enqueue_style('anc-6310-font-awesome-5-0-13', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
   wp_enqueue_style('anc-6310-font-awesome-4-07', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
   wp_enqueue_style("anc-6310-googlesss-font-{$ids}", "https://fonts.googleapis.com/css?family={$fonts}");
   echo "<div class='anc_6310_main_counter'>";
   include anc_6310_plugin_url . "output/{$styledata['style_name']}.php";
   echo "</div>";

   if ($cssData['custom_css']) {
      echo "<style type='text/css'>" . $cssData['custom_css'] . "</style>";
   }
}
else{
   echo "<p>This template is only available on the pro version.</p>";
}
