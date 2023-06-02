<?php
if (!defined('ABSPATH'))
  exit;
  
if (!empty($_POST['submit']) && $_POST['submit'] == 'Save' && $_POST['style'] != '') {
  $nonce = $_REQUEST['_wpnonce'];
  if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field')) {
    die('You do not have sufficient permissions to access this page.');
  } else {

    $name = sanitize_text_field($_POST['style_name']);
    $style_name = sanitize_text_field($_POST['style']);

    //$members = $wpdb->get_results('SELECT * FROM ' . $counter_table . ' ORDER BY name ASC', ARRAY_A);
    $counterids = "";
    $counterList = [];

    if ($_POST['style'] == 'counter-11') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_background_color,icon_background_hover_color,icon_background_size,icon_background_radius,icon_color,icon_hover_color,icon_size,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!4||##||2||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-11-background.jpg||##||18||##||18||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||600||##||uppercase||##||center||##||Allerta+Stencil||##||0||##||0||##||30||##||0||##||rgba(30, 115, 190, 1)||##||rgba(18, 216, 250, 1)||##||60||##||0||##||rgba(255, 255, 255, 1)||##||rgba(31, 40, 51, 1)||##||23||##||20||##||0||##||15||##||15||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||400||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||15||##||15||##||18||##||18||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||600||##||Arvo||##||0||##||0||##||22||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||15||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-12') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_line_height,icon_color,icon_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!19||##||3||##||500||##||rgba(0, 0, 0, 0.5)||##||rgba(0, 0, 0, 0.5)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-12-background.jpg||##||22||##||22||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||100||##||uppercase||##||center||##||Amaranth||##||0||##||0||##||10||##||15||##||20||##||20||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||10||##||10||##||6||##||10||##||1||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-13') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_circle_size,icon_circle_border_width,icon_color,icon_hover_color,icon_left_circle_color,icon_left_circle_hover_color,icon_right_circle_color,icon_right_circle_hover_color,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!6||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-13-background.jpg||##||20||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||center||##||PT+Sans||##||0||##||0||##||45||##||0||##||40||##||130||##||10||##||rgba(255, 255, 255, 1)||##||rgba(53, 53, 53, 1)||##||rgba(255, 255, 255, 1)||##||rgba(53, 53, 53, 1)||##||rgba(53, 53, 53, 1)||##||rgba(255, 255, 255, 1)||##||42||##||0||##||15||##||15||##||rgb(82, 76, 76)||##||rgb(82, 76, 76)||##||400||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||15||##||20||##||45||##||45||##||rgb(53, 53, 53)||##||rgb(53, 53, 53)||##||400||##||center||##||Amaranth||##||0||##||0||##||35||##||15||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-14') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_margin_top,icon_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,underline_background_color,underline_background_hover_color,underline_height,underline_margin_top,underline_radius,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!21||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(36, 72, 125, 0.5)||##||rgba(36, 72, 125, 0.5)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-14-background.jpg||##||18||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||45||##||10||##||60||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||20||##||10||##||1||##||16||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||20||##||15||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||800||##||Vollkorn||##||0||##||0||##||14||##||10||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||3||##||55||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||15||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-15') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_circle_color,icon_circle_hover_color,icon_circle_size,icon_circle_border_width,icon_margin_top,icon_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!22||##||3||##||500||##||,||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||2||##||transparent||##||rgba(247, 103, 0, 0.93)||##||||##||||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||18||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||center||##||Vollkorn||##||0||##||0||##||20||##||10||##||65||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||125||##||2||##||10||##||10||##||1||##||16||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||20||##||20||##||30||##||35||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||800||##||center||##||Vollkorn||##||0||##||0||##||20||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||10||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-16') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!12||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0.05)||##||2||##||2||##||rgba(204, 204, 204, 1)||##||rgba(204, 204, 204, 1)||##||rgba(0, 0, 0, 0.5)||##||rgba(0, 0, 0, 0.5)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-16-background.jpg||##||20||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||center||##||Vollkorn||##||0||##||0||##||20||##||10||##||25||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||center||##||0||##||10||##||10||##||5||##||15||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Arimo||##||0||##||0||##||20||##||0||##||30||##||27||##||rgb(57, 177, 238)||##||rgb(57, 177, 238)||##||600||##||Vollkorn||##||0||##||0||##||10||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-17') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!24||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(0, 0, 0, 0.5)||##||rgba(0, 0, 0, 0.5)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-17-background.jpg||##||23||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||0||##||20||##||50||##||rgba(222, 193, 27, 1)||##||rgba(222, 193, 27, 1)||##||center||##||0||##||15||##||18||##||0||##||15||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||20||##||10||##||40||##||40||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||||##||0||##||0||##||25||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||25||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-18') {
      $css = "id,item_per_row,animation_duration,box_background_color_1,box_background_hover_color_1,box_background_color_2,box_background_hover_color_2,box_background_color_3,box_background_hover_color_3,box_background_color_4,box_background_hover_color_4,box_background_color_5,box_background_hover_color_5,box_background_color_6,box_background_hover_color_6,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!25||##||3||##||500||##||rgba(221, 51, 51, 1)||##||rgba(221, 51, 51, 1)||##||rgba(129, 215, 66, 1)||##||rgba(129, 215, 66, 1)||##||rgba(163, 50, 157, 1)||##||rgba(163, 50, 157, 1)||##||rgba(30, 115, 190, 1)||##||rgba(30, 115, 190, 1)||##||rgba(8, 192, 209, 1)||##||rgba(8, 192, 209, 1)||##||rgba(178, 191, 31, 1)||##||rgba(172, 184, 40, 1)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||18||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||center||##||Vollkorn||##||0||##||0||##||20||##||0||##||50||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||center||##||0||##||10||##||0||##||0||##||15||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Amaranth||##||8||##||8||##||10||##||20||##||35||##||35||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||800||##||||##||0||##||0||##||10||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-19') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!26||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-19-background.jpg||##||22||##||24||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||600||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||20||##||0||##||60||##||rgba(0, 0, 0, 1)||##||rgba(0, 0, 0, 1)||##||center||##||0||##||0||##||20||##||0||##||15||##||15||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||400||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||10||##||15||##||35||##||35||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||center||##||Vollkorn||##||10||##||0||##||20||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||2||##||0||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||15||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-20') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_border_right_color,icon_border_right_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!24||##||3||##||500||##||,||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||2||##||transparent||##||rgba(230, 104, 104, 1)||##||||##||||##||17||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||Vollkorn||##||0||##||0||##||15||##||0||##||40||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||0||##||15||##||20||##||0||##||15||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||20||##||20||##||36||##||36||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Vollkorn||##||0||##||0||##||5||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    }

    $data = $wpdb->get_results('SELECT * FROM ' . $counter_table . ' ORDER BY id DESC', ARRAY_A);
    if($data){
      foreach ($data as $value) {
        if($counterids != ''){
          $counterids .= ",";
        }
        $counterids .= $value['id'];
      }
    }
    

    $wpdb->query($wpdb->prepare("INSERT INTO {$style_table} (name, style_name, css, counterids) VALUES ( %s, %s, %s, %s)", array($name, $style_name, $css, $counterids)));
    $redirect_id = $wpdb->insert_id;
    $counterids = "";

    if ($redirect_id == 0) {
      $url = admin_url("admin.php?page=anc-6310-animated-number-counter");
    } else if ($redirect_id != 0) {
      $url = admin_url("admin.php?page=anc-6310-counter-01-10&styleid=$redirect_id");
    }
    echo '<script type="text/javascript"> document.location.href = "' . $url . '"; </script>';
    exit;
  }
}

$icons = array(
  '<li><a href="https://www.linkedin.com" class="open_in_new_tab_class anc-6310-social-link-linkedin" title="Linkedin" target="_blank" id=""><i class="fab fa-linkedin-in"></i></a></li>',
  '<li><a href="https://www.facebook.com" class="open_in_new_tab_class anc-6310-social-link-facebook" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>',
  '<li><a href="https://www.youtube.com" class="open_in_new_tab_class anc-6310-social-link-youtube" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a></li>',
  '<li><a href="https://www.twitter.com" class="open_in_new_tab_class anc-6310-social-link-twitter" title="Twitter" target="_blank"><i class="fab fa-twitter"></i></a></li>',
  '<li><a href="https://www.google.com" class="open_in_new_tab_class anc-6310-social-link-google" title="Google Plus" target="_blank"><i class="fab fa-google-plus-g"></i></a></li>',
  '<li><a href="https://www.pinterest.com" class="open_in_new_tab_class anc-6310-social-link-pinterest" title="Pinterest" target="_blank"><i class="fab fa-pinterest-p"></i></a></li>',
  '<li><a href="https://www.whatsapp.com" class="open_in_new_tab_class anc-6310-social-link-whatsapp" title="Whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a></li>'
);
?>
<div class="anc-6310-6310">
  <h1>Select Counter</h1>

  <!-- ******************************************
      counter 11 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-11-paralax">
        <div class="anc-6310-counter-11-common-overlay">
          <div class="anc-6310-counter-11-row">
            <div class="anc-6310-counter-11-row-item">
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-11">
                  <div class="anc-6310-counter-11-icon"><i class="fa fa-bullhorn"></i></div>
                  <div class="anc-6310-counter-11-title">Projects Completed</div>
                  <div class="anc-6310-counter-11-number anc-6310-animated-counter-11">
                  <div class="anc-6310-counter-11-count-number anc-6310-animated-counter-11 anc-6310-counter-number" 
                      id="anc-6310-11-1"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="500" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
              </div>
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-11">
                  <div class="anc-6310-counter-11-icon"><i class="fa fa-camera-retro"></i></div>
                  <div class="anc-6310-counter-11-title">Happy Clients</div>
                  <div class="anc-6310-counter-11-number anc-6310-animated-counter-11">
                  <div class="anc-6310-counter-11-count-number anc-6310-animated-counter-11 anc-6310-counter-number" 
                      id="anc-6310-11-2"
                      data-anc-6310-start="50" 
                      data-anc-6310-end="1200" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-counter-11-row-item">
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-11">
                  <div class="anc-6310-counter-11-icon"><i class="fa fa-coffee"></i></div>
                  <div class="anc-6310-counter-11-title">Cups Of Coffee</div>
                  <div class="anc-6310-counter-11-number anc-6310-animated-counter-11">
                  <div class="anc-6310-counter-11-count-number anc-6310-animated-counter-11 anc-6310-counter-number" 
                      id="anc-6310-11-3"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="99.99" 
                      data-anc-6310-decimal="2" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
              </div>
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-11">
                  <div class="anc-6310-counter-11-icon"><i class="fa fa-laptop"></i></div>
                  <div class="anc-6310-counter-11-title">Design Awards</div>
                  <div class="anc-6310-counter-11-number anc-6310-animated-counter-11">
                  <div class="anc-6310-counter-11-count-number anc-6310-animated-counter-11 anc-6310-counter-number" 
                      id="anc-6310-11-4"
                      data-anc-6310-start="500" 
                      data-anc-6310-end="3.456" 
                      data-anc-6310-decimal="3" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 11
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-11">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 11 end
    ****************************************** -->
  <!-- ******************************************
      counter 12 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-12-paralax">
        <div class="anc-6310-counter-12-common-overlay">
          <div class="anc-6310-counter-12-row">
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-12">
                <div class="anc-6310-counter-12-title">Team Workers</div>
                <div class="anc-6310-counter-12-icon">
                  <i class="fa fa-bullhorn"></i>
                  <div class="anc-6310-counter-12-number anc-6310-animated-counter-12">
                  <div class="anc-6310-counter-12-count-number anc-6310-animated-counter-12 anc-6310-counter-number" 
                      id="anc-6310-12-1"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="100" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
                <div class="anc-6310-counter-12-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-12">
                <div class="anc-6310-counter-12-title">Happy Clients</div>
                <div class="anc-6310-counter-12-icon">
                  <i class="fab fa-apple"></i>
                  <div class="anc-6310-counter-12-number anc-6310-animated-counter-12">
                  <div class="anc-6310-counter-12-count-number anc-6310-animated-counter-12 anc-6310-counter-number" 
                      id="anc-6310-12-2"
                      data-anc-6310-start="100" 
                      data-anc-6310-end="1200" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
                <div class="anc-6310-counter-12-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit consectetur adipiscing</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-12">
                <div class="anc-6310-counter-12-title">Design Awards</div>
                <div class="anc-6310-counter-12-icon">
                  <i class="fa fa-ambulance"></i>
                  <div class="anc-6310-counter-12-number anc-6310-animated-counter-12">
                  <div class="anc-6310-counter-12-count-number anc-6310-animated-counter-12 anc-6310-counter-number" 
                      id="anc-6310-12-3"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="99.99" 
                      data-anc-6310-decimal="2" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
                <div class="anc-6310-counter-12-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-12">
                <div class="anc-6310-counter-12-title">Project Ideas</div>
                <div class="anc-6310-counter-12-icon">
                  <i class="fa fa-laptop"></i>
                  <div class="anc-6310-counter-12-number anc-6310-animated-counter-12">
                  <div class="anc-6310-counter-12-count-number anc-6310-animated-counter-12 anc-6310-counter-number" 
                      id="anc-6310-12-4"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="700" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                  </div>
                </div>
                <div class="anc-6310-counter-12-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 12
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-12">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 12 end
    ****************************************** -->
  <!-- ******************************************
      counter 13 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-13-paralax">
        <div class="anc-6310-counter-13-common-overlay">
          <div class="anc-6310-counter-13-row">
            <div class="anc-6310-col-5">
              <div class="anc-6310-counter-13">
                <div class="anc-6310-counter-13-icon">
                  <div class="anc-6310-counter-13-span-1"></div>
                  <div class="anc-6310-counter-13-span-2"></div>
                  <i class="far fa-thumbs-up"></i>
                </div>
                <div class="anc-6310-counter-13-title">Team Workers</div>
                <div class="anc-6310-counter-13-number anc-6310-animated-counter-13">
                  <div class="anc-6310-counter-13-count-number anc-6310-animated-counter-13 anc-6310-counter-number" 
                      id="anc-6310-13-1"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="800" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-col-5">
              <div class="anc-6310-counter-13">
                <div class="anc-6310-counter-13-icon">
                  <div class="anc-6310-counter-13-span-1"></div>
                  <div class="anc-6310-counter-13-span-2"></div>
                  <i class="fa fa-laptop"></i>
                </div>
                <div class="anc-6310-counter-13-title">Happy Clients</div>
                <div class="anc-6310-counter-13-number anc-6310-animated-counter-13">
                  <div class="anc-6310-counter-13-count-number anc-6310-animated-counter-13 anc-6310-counter-number" 
                      id="anc-6310-13-2"
                      data-anc-6310-start="1000" 
                      data-anc-6310-end="100" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-col-5">
              <div class="anc-6310-counter-13">
                <div class="anc-6310-counter-13-icon">
                  <div class="anc-6310-counter-13-span-1"></div>
                  <div class="anc-6310-counter-13-span-2"></div>
                  <i class="far fa-star"></i>
                </div>
                <div class="anc-6310-counter-13-title">Design Awards</div>
                <div class="anc-6310-counter-13-number anc-6310-animated-counter-13">
                  <div class="anc-6310-counter-13-count-number anc-6310-animated-counter-13 anc-6310-counter-number" 
                        id="anc-6310-13-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="89.88" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 13
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-13">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 13 end
    ****************************************** -->
  <!-- ******************************************
      counter 14 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-14-paralax">
        <div class="anc-6310-counter-14-common-overlay">
          <div class="anc-6310-counter-14-row">
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-14">
                <div class="anc-6310-counter-14-icon"><i class="fa fa-laptop"></i></div>
                <div class="anc-6310-counter-14-count-content">
                  <div class="anc-6310-counter-14-count-number anc-6310-animated-counter-14 anc-6310-counter-number" 
                        id="anc-6310-14-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                  </div>
                </div>
                <div class="anc-6310-counter-14-title">Projects Completed</div>
                <div class="anc-6310-counter-14-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-14">
                <div class="anc-6310-counter-14-icon"><i class="far fa-smile"></i></div>
                <div class="anc-6310-counter-14-count-content">
                  <div class="anc-6310-counter-14-count-number anc-6310-animated-counter-14 anc-6310-counter-number" 
                        id="anc-6310-14-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="1200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                  </div>
                </div>
                <div class="anc-6310-counter-14-title">Happy Clients</div>
                <div class="anc-6310-counter-14-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-14">
                <div class="anc-6310-counter-14-icon"><i class="far fa-gem"></i></div>
                <div class="anc-6310-counter-14-count-content">
                <div class="anc-6310-counter-14-count-number anc-6310-animated-counter-14 anc-6310-counter-number" 
                        id="anc-6310-14-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="89.88" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                  </div>
                </div>
                <div class="anc-6310-counter-14-title">Design Awards</div>
                <div class="anc-6310-counter-14-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-14">
                <div class="anc-6310-counter-14-icon"><i class="fa fa-coffee"></i></div>
                <div class="anc-6310-counter-14-count-content">
                <div class="anc-6310-counter-14-count-number anc-6310-animated-counter-14 anc-6310-counter-number" 
                        id="anc-6310-14-4"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="9.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                  </div>
                </div>
                <div class="anc-6310-counter-14-title">Cups Of Coffee</div>
                <div class="anc-6310-counter-14-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 14
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-14">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 14 end
    ****************************************** -->
  <!-- ******************************************
      counter 15 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-15-paralax">
        <div class="anc-6310-counter-15-row">
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-15">
              <div class="anc-6310-counter-15-icon"><i class="fab fa-codepen"></i></div>
              <div class="anc-6310-counter-15-title">Projects Completed</div>
              <div class="anc-6310-counter-15-number anc-6310-animated-counter-15">
                  <div class="anc-6310-counter-15-count-number anc-6310-animated-counter-15 anc-6310-counter-number" 
                        id="anc-6310-15-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                  </div>
              </div>
              <div class="anc-6310-counter-15-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-15">
              <div class="anc-6310-counter-15-icon"><i class="fab fa-angellist"></i></div>
              <div class="anc-6310-counter-15-title">Happy Clients</div>
              <div class="anc-6310-counter-15-number anc-6310-animated-counter-15">
                <div class="anc-6310-counter-15-count-number anc-6310-animated-counter-15 anc-6310-counter-number" 
                        id="anc-6310-15-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="1200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                  </div>
              </div>
              <div class="anc-6310-counter-15-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-15">
              <div class="anc-6310-counter-15-icon"><i class="fa fa-fire"></i></div>
              <div class="anc-6310-counter-15-title">Design Awards</div>
              <div class="anc-6310-counter-15-number anc-6310-animated-counter-15">
                 <div class="anc-6310-counter-15-count-number anc-6310-animated-counter-15 anc-6310-counter-number" 
                        id="anc-6310-15-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="99.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                  </div>
              </div>
              <div class="anc-6310-counter-15-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 15
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-15">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 15 end
    ****************************************** -->
  <!-- ******************************************
      counter 16 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-16-paralax">
        <div class="anc-6310-counter-16-common-overlay">
          <div class="anc-6310-counter-16-row">
            <div class="anc-6310-col-3">
              <div class="anc-6310-counter-16">
                <div class="anc-6310-counter-16-icon">
                  <i class="far fa-smile"></i>
                  <div class="anc-6310-counter-16-number anc-6310-animated-counter-16">
                     <div class="anc-6310-counter-16-count-number anc-6310-animated-counter-16 anc-6310-counter-number" 
                        id="anc-6310-16-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="500" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
                <div class="anc-6310-counter-16-title">Happy Clients</div>
              </div>
            </div>
            <div class="anc-6310-col-3">
              <div class="anc-6310-counter-16">
                <div class="anc-6310-counter-16-icon">
                  <i class="fa fa-trophy"></i>
                  <div class="anc-6310-counter-16-number anc-6310-animated-counter-16">
                    <div class="anc-6310-counter-16-count-number anc-6310-animated-counter-16 anc-6310-counter-number" 
                        id="anc-6310-16-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="1200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
                <div class="anc-6310-counter-16-title">Design Awards</div>
              </div>
            </div>
            <div class="anc-6310-col-3">
              <div class="anc-6310-counter-16">
                <div class="anc-6310-counter-16-icon">
                  <i class="fa fa-users"></i>
                  <div class="anc-6310-counter-16-number anc-6310-animated-counter-16">
                    <div class="anc-6310-counter-16-count-number anc-6310-animated-counter-16 anc-6310-counter-number" 
                        id="anc-6310-16-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="99.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
                <div class="anc-6310-counter-16-title">Team Workers</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 16
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-16">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 16 end
    ****************************************** -->
  <!-- ******************************************
      counter 17 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-17-paralax">
        <div class="anc-6310-counter-17-common-overlay">
          <div class="anc-6310-counter-17-row">
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-17">
                <div class="anc-6310-counter-17-title">Happy Clients</div>
                <div class="anc-6310-counter-17-icon">
                  <i class="far fa-smile"></i>
                  <div class="anc-6310-counter-17-number anc-6310-animated-counter-17">
                      <div class="anc-6310-counter-17-count-number anc-6310-animated-counter-17 anc-6310-counter-number" 
                        id="anc-6310-17-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="550" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-17">
                <div class="anc-6310-counter-17-title">Design Awards</div>
                <div class="anc-6310-counter-17-icon">
                  <i class="fa fa-trophy"></i>
                  <div class="anc-6310-counter-17-number anc-6310-animated-counter-17">
                      <div class="anc-6310-counter-17-count-number anc-6310-animated-counter-17 anc-6310-counter-number" 
                        id="anc-6310-17-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="1110" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-17">
                <div class="anc-6310-counter-17-title">Project Ideas</div>
                <div class="anc-6310-counter-17-icon">
                  <i class="far fa-gem"></i>
                  <div class="anc-6310-counter-17-number anc-6310-animated-counter-17">
                      <div class="anc-6310-counter-17-count-number anc-6310-animated-counter-17 anc-6310-counter-number" 
                        id="anc-6310-17-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="99.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="anc-6310-col-4">
              <div class="anc-6310-counter-17">
                <div class="anc-6310-counter-17-title">Team Workers</div>
                <div class="anc-6310-counter-17-icon">
                  <i class="fa fa-users"></i>
                  <div class="anc-6310-counter-17-number anc-6310-animated-counter-17">
                      <div class="anc-6310-counter-17-count-number anc-6310-animated-counter-17 anc-6310-counter-number" 
                        id="anc-6310-17-4"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 17
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-17">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 17 end
    ****************************************** -->
  <!-- ******************************************
      counter 18 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-18-row">
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-18 anc-6310-counter-18-box-1">
            <div class="anc-6310-counter-18-icon">
              <i class="fa fa-laptop"></i>
              <div class="anc-6310-counter-18-number anc-6310-animated-counter-18">
                  <div class="anc-6310-counter-18-count-number anc-6310-animated-counter-18 anc-6310-counter-number" 
                        id="anc-6310-18-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
              </div>
            </div>
            <div class="anc-6310-counter-18-title">Team Workers</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-18 anc-6310-counter-18-box-2">
            <div class="anc-6310-counter-18-icon">
              <i class="far fa-gem"></i>
              <div class="anc-6310-counter-18-number anc-6310-animated-counter-18">
                  <div class="anc-6310-counter-18-count-number anc-6310-animated-counter-18 anc-6310-counter-number" 
                        id="anc-6310-18-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="1100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
              </div>
            </div>
            <div class="anc-6310-counter-18-title">Design Awards</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-18 anc-6310-counter-18-box-3">
            <div class="anc-6310-counter-18-icon">
              <i class="far fa-smile"></i>
              <div class="anc-6310-counter-18-number anc-6310-animated-counter-18">
                  <div class="anc-6310-counter-18-count-number anc-6310-animated-counter-18 anc-6310-counter-number" 
                        id="anc-6310-18-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="89.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                   </div>
              </div>
            </div>
            <div class="anc-6310-counter-18-title">Happy Clients</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-18 anc-6310-counter-18-box-4">
            <div class="anc-6310-counter-18-icon">
              <i class="fa fa-camera-retro"></i>
              <div class="anc-6310-counter-18-number anc-6310-animated-counter-18">
                  <div class="anc-6310-counter-18-count-number anc-6310-animated-counter-18 anc-6310-counter-number" 
                        id="anc-6310-18-4"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="10" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
              </div>
            </div>
            <div class="anc-6310-counter-18-title">Project Ideas</div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 18
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-18">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 18 end
    ****************************************** -->
  <!-- ******************************************
      counter 19 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-19-paralax">
        <div class="anc-6310-counter-19-common-overlay">
          <div class="anc-6310-counter-19-row">
            <div class="anc-6310-counter-19-row-item">
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fa fa-child"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                    <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="100" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Projects Completed</div>
                </div>
              </div>
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fa fa-camera-retro"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                    <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-2"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="3200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Happy Clients</div>
                </div>
              </div>
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fab fa-apple"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                    <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="10.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Design Awards</div>
                </div>
              </div>
            </div>
            <div class="anc-6310-counter-19-row-item">
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fa fa-coffee"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                    <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-4"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="500" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Cups Of Coffee</div>
                </div>
              </div>
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fa fa-laptop"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                    <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-5"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="1200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                    </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Lines Of Code</div>
                </div>
              </div>
              <div class="anc-6310-col-3">
                <div class="anc-6310-counter-19">
                  <div class="anc-6310-counter-19-icon"><i class="fa fa-users"></i></div>
                  <div class="anc-6310-counter-19-number anc-6310-animated-counter-19">
                  <div class="anc-6310-counter-19-count-number anc-6310-animated-counter-19 anc-6310-counter-number" 
                        id="anc-6310-19-6"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="89.98" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-19-title">Team Workers</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 19
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-19">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 19 end
    ****************************************** -->
  <!-- ******************************************
      counter 20 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-20-paralax">
        <div class="anc-6310-counter-20-row">
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-20">
              <div class="anc-6310-counter-20-icon"><i class="fa fa-code"></i></div>
              <div class="anc-6310-counter-20-inner-wrap">
                <div class="anc-6310-counter-20-number anc-6310-animated-counter-20">
                  <div class="anc-6310-counter-20-count-number anc-6310-animated-counter-20 anc-6310-counter-number" 
                        id="anc-6310-20-1"
                        data-anc-6310-start="0" 
                        data-anc-6310-end="1200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                </div>
                <div class="anc-6310-counter-20-title">LINE OF CODES</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-20">
              <div class="anc-6310-counter-20-icon"><i class="fa fa-user"></i></div>
              <div class="anc-6310-counter-20-inner-wrap">
                <div class="anc-6310-counter-20-number anc-6310-animated-counter-20">
                  <div class="anc-6310-counter-20-count-number anc-6310-animated-counter-20 anc-6310-counter-number" 
                        id="anc-6310-20-2"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="200" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                   </div>
                </div>
                <div class="anc-6310-counter-20-title">Happy Clients</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-20">
              <div class="anc-6310-counter-20-icon"><i class="far fa-paper-plane"></i></div>
              <div class="anc-6310-counter-20-inner-wrap">
                <div class="anc-6310-counter-20-number anc-6310-animated-counter-20">
                  <div class="anc-6310-counter-20-count-number anc-6310-animated-counter-20 anc-6310-counter-number" 
                        id="anc-6310-20-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="89.98" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                   </div>
                </div>
                <div class="anc-6310-counter-20-title">PROJECTS DONE</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 20
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-20">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 20 end
    ****************************************** -->

  <div id="anc-6310-modal-add" class="anc-6310-modal" style="display: none">
    <div class="anc-6310-modal-content anc-6310-modal-sm">
      <form action="" method="post">
        <div class="anc-6310-modal-header">
          Create Counter
          <div class="anc-6310-close">&times;</div>
        </div>
        <div class="anc-6310-modal-body-form">
          <?php wp_nonce_field("anc-6310-nonce-field") ?>
          <input type="hidden" name="style" id="anc-6310-style-hidden" />
          <table border="0" width="100%" cellpadding="10" cellspacing="0">
            <tr>
              <td width="150"><label class="anc-6310-form-label" for="icon_name">Counter Name:</label></td>
              <td><input type="text" required="" name="style_name" id="style_name" value="" class="anc-6310-form-input" placeholder="Counter Name" style="width: 240px" /></td>
            </tr>
          </table>
        </div>
        <div class="anc-6310-modal-form-footer">
          <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
          <input type="submit" name="submit" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" value="Save" />
        </div>
      </form>
      <br class="anc-6310-clear" />
    </div>
  </div>

  <script>
    var $ = jQuery;
    jQuery(document).ready(function() {
      jQuery("body").on("click", ".anc_6310_choosen_style", function() {
        jQuery("#anc-6310-modal-add").fadeIn(500);
        jQuery("#anc-6310-style-hidden").val(jQuery(this).attr("id"));
        jQuery("body").css({
          "overflow": "hidden"
        });
        return false;
      });

      jQuery("body").on("click", ".anc-6310-close, .anc-6310-btn-danger", function() {
        jQuery("#anc-6310-modal-add").fadeOut(500);
        jQuery("body").css({
          "overflow": "initial"
        });
      });
      jQuery(window).click(function(event) {
        if (event.target == document.getElementById('anc-6310-modal-add')) {
          jQuery("#anc-6310-modal-add").fadeOut(500);
          jQuery("body").css({
            "overflow": "initial"
          });
        }
      });   
    });
  </script>