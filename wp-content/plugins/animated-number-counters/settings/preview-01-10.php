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
    $counterids = "";

    if ($_POST['style'] == 'counter-01') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_background_color,number_background_hover_color,number_box_size,number_box_radius,number_font_size,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,counter_button,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!7||##||3||##||500||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||0||##||0||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(0, 0, 0, 0.8)||##||rgba(0, 0, 0, 0.8)||##||1||##||3||##||rgba(0, 0, 0, 0.2)||##||rgba(0, 0, 0, 0.4)||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||capitalize||##||center||##||Amaranth||##||0||##||0||##||80||##||17||##||1||##||12||##||15||##||rgb(82, 76, 76)||##||rgb(82, 76, 76)||##||400||##||capitalize||##||center||##||Roboto||##||0||##||0||##||10||##||20||##||rgba(0, 158, 226, 1)||##||rgba(0, 158, 226, 1)||##||120||##||60||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||Amaranth||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(219, 44, 44)||##||2||##||0||##||0||##||1||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||150||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||10||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-02') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,underline_background_color,underline_background_hover_color,underline_height,underline_margin_top,underline_radius,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!9||##||3||##||500||##||rgba(255, 255, 255, 0.35)||##||rgba(130, 128, 128, 0.5)||##||0||##||2||##||rgba(255, 255, 255, 0.55)||##||rgba(255, 255, 255, 0.55)||##||rgba(0, 0, 0, 0.75)||##||rgba(0, 0, 0, 0.75)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-02-background.jpeg||##||18||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||capitalize||##||center||##||Roboto||##||0||##||0||##||20||##||40||##||50||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||center||##||0||##||0||##||15||##||15||##||14||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Roboto||##||2||##||2||##||15||##||20||##||rgba(159, 54, 46, 0.8)||##||rgba(159, 54, 46, 0.8)||##||3||##||40||##||0||##||35||##||35||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||center||##||Droid+Sans||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||130||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||10||##||20||##||||##||Save";
    } else if ($_POST['style'] == 'counter-03') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_background_color,icon_background_hover_color,icon_background_size,icon_background_radius,icon_size,icon_line_height,icon_color,icon_hover_color,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!1||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0.3)||##||0||##||2||##||rgba(219, 219, 219, 0.55)||##||rgba(219, 219, 219, 0.55)||##||rgba(0, 0, 0, 0.7)||##||rgba(0, 0, 0, 0.7)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-03-background.jpg||##||24||##||26||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Open+Sans||##||0||##||0||##||5||##||10||##||rgba(254, 185, 0, 1)||##||rgba(255, 87, 51, 1)||##||75||##||0||##||40||##||75||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||14||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Roboto||##||0||##||0||##||15||##||20||##||40||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||center||##||Open+Sans||##||0||##||0||##||20||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(0, 158, 226, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||25||##||0||##||||##||Save";
    } else if ($_POST['style'] == 'counter-04') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_padding,box_margin_top,box_margin_bottom,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_top,title_margin_bottom,icon_background_color,icon_background_hover_color,icon_background_size,icon_background_radius,icon_padding,icon_size,icon_line_height,icon_hover_color,icon_color,arrow_color,arrow_hover_color,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_top,description_margin_bottom,number_font_size,number_font_color,number_font_hover_color,number_line_height,number_text_align,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!9||##||3||##||500||##||rgba(33, 42, 107, 1)||##||rgba(33, 42, 107, 1)||##||5||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||25||##||0||##||20||##||22||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||700||##||uppercase||##||center||##||Roboto||##||0||##||8||##||rgba(33, 42, 107, 1)||##||rgba(33, 42, 107, 1)||##||100||##||60||##||6||##||40||##||100||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(33, 42, 107, 1)||##||rgba(33, 42, 107, 1)||##||1||##||15||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Roboto||##||20||##||5||##||35||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||30||##||center||##||700||##||Roboto||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||5||##||||##||Save";
    } else if ($_POST['style'] == 'counter-05') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_color,icon_hover_color,icon_size,icon_line_height,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_right_border,number_margin_left,number_margin_right,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,suffix_icon_show_hide,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!13||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||2||##||rgba(219, 219, 219, 1)||##||rgba(219, 219, 219, 1)||##||rgba(0, 0, 0, 0.7)||##||rgba(0, 0, 0, 0.7)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-05-background.jpg||##||22||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||500||##||capitalize||##||center||##||PT+Serif||##||10||##||10||##||40||##||40||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||50||##||60||##||0||##||15||##||0||##||0||##||14||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Roboto||##||3||##||3||##||15||##||20||##||33||##||rgb(255, 122, 63)||##||rgb(255, 122, 63)||##||600||##||Roboto||##||80||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||1||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||25||##||30||##||||##||Save";
    } else if ($_POST['style'] == 'counter-06') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_blur,box_shadow_width,box_shadow_width_hover,box_shadow_color,box_shadow_hover_color,box_padding,bottom_line_hover_color,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,prefix_icon_show_hide,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,suffix_icon_show_hide,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!14||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||3||##||6||##||11||##||rgba(212, 212, 212, 1)||##||rgba(212, 212, 212, 1)||##||30||##||rgba(69, 114, 148, 0.8)||##||30||##||35||##||rgb(69, 114, 148)||##||rgb(69, 114, 148)||##||600||##||capitalize||##||center||##||Tinos||##||5||##||20||##||50||##||rgba(69, 114, 148, 1)||##||rgba(69, 114, 148, 1)||##||center||##||0||##||10||##||5||##||7||##||1||##||16||##||22||##||rgb(125, 125, 125)||##||rgb(125, 125, 125)||##||400||##||capitalize||##||center||##||Lato||##||25||##||15||##||40||##||40||##||rgb(69, 114, 148)||##||rgb(69, 114, 148)||##||600||##||Tinos||##||0||##||0||##||15||##||0||##||1||##||20||##||rgb(69, 114, 148)||##||rgb(69, 114, 148)||##||2||##||0||##||0||##||1||##||20||##||rgb(69, 114, 148)||##||rgb(69, 114, 148)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-07') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,box_background_image,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_text_align,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,prefix_icon_show_hide,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,suffix_icon_show_hide,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!15||##||3||##||500||##||rgba(255, 255, 255, 0)||##||rgba(12, 132, 207, 1)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||rgba(1, 0, 28, 0.66)||##||rgba(1, 0, 28, 0.66)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-07-background.jpg||##||20||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||600||##||uppercase||##||center||##||Droid+Sans||##||0||##||0||##||5||##||15||##||1||##||14||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||center||##||Droid+Sans||##||10||##||10||##||15||##||35||##||40||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||center||##||700||##||Droid+Sans+Mono||##||0||##||0||##||20||##||15||##||1||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||1||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||10||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-08') {
      $css = "id,item_per_row,animation_duration,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_text_align,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,counter_description,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!3||##||3||##||500||##||rgba(11, 11, 12, 0.7)||##||rgba(9, 76, 249, 0.85)||##||8||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||25||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||700||##||capitalize||##||left||##||Vollkorn||##||0||##||0||##||5||##||15||##||40||##||rgba(255, 169, 35, 1)||##||rgba(255, 169, 35, 1)||##||left||##||0||##||0||##||0||##||0||##||1||##||18||##||18||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||left||##||Vollkorn||##||0||##||0||##||20||##||15||##||32||##||32||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||700||##||left||##||Amaranth||##||0||##||0||##||20||##||0||##||20||##||rgb(174, 174, 174)||##||rgb(174, 174, 174)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(174, 174, 174)||##||rgb(174, 174, 174)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(26, 25, 22, 1)||##||rgba(235, 151, 5, 1)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||20||##||||##||Save";
    } else if ($_POST['style'] == 'counter-09') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_text_align,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_background_color,icon_background_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!19||##||3||##||500||##||,||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(210, 210, 210, 0.92)||##||rgba(162, 202, 77, 0.8)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||2||##||transparent||##||rgba(0, 0, 0, 0.88)||##||||##||||##||20||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||700||##||capitalize||##||left||##||Vollkorn||##||0||##||0||##||5||##||0||##||30||##||rgba(1, 170, 193, 1)||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 0.08)||##||rgba(1, 170, 193, 1)||##||0||##||10||##||0||##||0||##||14||##||15||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||capitalize||##||left||##||PT Sans||##||5||##||0||##||20||##||20||##||35||##||35||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||700||##||left||##||Amaranth||##||0||##||0||##||0||##||0||##||20||##||rgb(174, 174, 174)||##||rgb(174, 174, 174)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(174, 174, 174)||##||rgb(174, 174, 174)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(1, 170, 193, 1)||##||rgba(0, 168, 194, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||10||##||0||##||||##||Save";
    } else if ($_POST['style'] == 'counter-10') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_text_align,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!21||##||3||##||500||##||,||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||2||##||transparent||##||rgba(214, 214, 214, 0.61)||##||||##||||##||20||##||20||##||rgb(153, 153, 153)||##||rgb(153, 153, 153)||##||700||##||capitalize||##||Vollkorn||##||0||##||0||##||10||##||0||##||35||##||rgba(0, 168, 194, 1)||##||rgba(0, 168, 194, 1)||##||0||##||0||##||0||##||0||##||15||##||15||##||rgb(89, 82, 82)||##||rgb(89, 82, 82)||##||400||##||capitalize||##||center||##||Vollkorn||##||0||##||0||##||25||##||10||##||40||##||40||##||rgb(5, 32, 53)||##||rgb(5, 32, 53)||##||700||##||left||##||Vollkorn||##||0||##||0||##||5||##||10||##||20||##||rgb(153, 153, 153)||##||rgb(153, 153, 153)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(153, 153, 153)||##||rgb(153, 153, 153)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(11, 106, 194, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||0||##||||##||Save";
    }

    $data = $wpdb->get_results('SELECT * FROM ' . $counter_table . ' ORDER BY id DESC', ARRAY_A);
    if ($data) {
      foreach ($data as $value) {
        if ($counterids != '') {
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
      counter 1 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-01">
          <div class="anc-6310-counter-01-top-container" style="background-image: url('https://www.wpmart.org/wp-content/uploads/2020/counter/work-completed.png');">
            <div class="anc-6310-counter-01-top-inner-wrap">
              <div class="anc-6310-counter-01-count-title">work completed</div>
            </div>
          </div>
          <div class="anc-6310-counter-01-bottom-container">
            <div class="anc-6310-counter-01-count-content">
              <div class="anc-6310-counter-01-count-content-inner">
                <div 
                  class="anc-6310-counter-01-count-number anc-6310-animated-counter-01 anc-6310-counter-number" 
                  id="anc-6310-01-1"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="1200" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2"
                ></div>
              </div>
            </div>
            <div class="anc-6310-counter-01-count-subtitle"> Aolaboraively eenable vira niche markets Compe evsculate funcnal mndshare through forand goaloriented project.</div>
            <div class="anc-6310-counter-01-count-button"><a href="#" target="_blank">find out more</a></div>
          </div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-01">
          <div class="anc-6310-counter-01-top-container" style="background-image: url('https://www.wpmart.org/wp-content/uploads/2020/counter/line-of-codes.jpg');">
            <div class="anc-6310-counter-01-top-inner-wrap">
              <div class="anc-6310-counter-01-count-title">lines of code</div>
            </div>
          </div>
          <div class="anc-6310-counter-01-bottom-container">
            <div class="anc-6310-counter-01-count-content">
              <div class="anc-6310-counter-01-count-content-inner">
                <div class="anc-6310-counter-01-count-number anc-6310-animated-counter-01 anc-6310-counter-number" 
                  id="anc-6310-01-2"
                  data-anc-6310-start="100" 
                  data-anc-6310-end="10" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2"
                ></div>
              </div>
            </div>
            <div class="anc-6310-counter-01-count-subtitle"> Aolaboraively eenable vira niche markets Compe evsculate funcnal mndshare through forand goaloriented project.</div>
            <div class="anc-6310-counter-01-count-button"><a href="#" target="_blank">check out the link</a></div>
          </div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-01">
          <div class="anc-6310-counter-01-top-container" style="background-image: url('https://www.wpmart.org/wp-content/uploads/2020/counter/cups-of-coffee.png');">
            <div class="anc-6310-counter-01-top-inner-wrap">
              <div class="anc-6310-counter-01-count-title">cups of coffee</div>
            </div>
          </div>
          <div class="anc-6310-counter-01-bottom-container">
            <div class="anc-6310-counter-01-count-content">
              <div class="anc-6310-counter-01-count-content-inner">
                <div class="anc-6310-counter-01-count-number anc-6310-animated-counter-01 anc-6310-counter-number" 
                  id="anc-6310-01-3"
                  data-anc-6310-start="1" 
                  data-anc-6310-end="9.45" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2"></div>
              </div>
            </div>
            <div class="anc-6310-counter-01-count-subtitle"> Aolaboraively eenable vira niche markets Compe evsculate funcnal mndshare through forand goaloriented project.</div>
            <div class="anc-6310-counter-01-count-button"><a href="#" target="_blank">find out more</a></div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 1
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-01">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 1 end
    ****************************************** -->
  <!-- ******************************************
      counter 2 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-02-paralax">
        <div class="anc-6310-counter-02-common-overlay">
        <iframe src='https://www.youtube.com/embed/?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=rUWxSEwctFU&mute=1&allowfullscreen=1&allow=accelerometer&autoplay=1&rel=0' frameborder='0' allowfullscreen></iframe>
        
        <div class="anc-6310-counter-02-wrap">
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-02">
              <div class="anc-6310-counter-02-icon">
                <i class="fas fa-globe"></i>
              </div>
              <div class="anc-6310-counter-02-count-content">
                <div class="anc-6310-counter-02-count-content-inner">
                <div 
                  class="anc-6310-counter-02-count-number anc-6310-animated-counter-02 anc-6310-counter-number" 
                  id="anc-6310-02-1"
                  data-anc-6310-start="100" 
                  data-anc-6310-end="1000" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2"
                ></div>
                </div>
              </div>
              <div class="anc-6310-counter-02-count-title">worldwide centers</div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-02">
              <div class="anc-6310-counter-02-icon">
                <i class="fas fa-book-open"></i>
              </div>
              <div class="anc-6310-counter-02-count-content">
                <div class="anc-6310-counter-02-count-content-inner">
                <div 
                  class="anc-6310-counter-02-count-number anc-6310-animated-counter-02 anc-6310-counter-number" 
                  id="anc-6310-02-2"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="1200" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2"
                ></div>
                </div>
              </div>
              <div class="anc-6310-counter-02-count-title">courses involved</div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-02">
              <div class="anc-6310-counter-02-icon">
                <i class="fas fa-university"></i>
              </div>
              <div class="anc-6310-counter-02-count-content">
                <div class="anc-6310-counter-02-count-content-inner">
                <div 
                  class="anc-6310-counter-02-count-number anc-6310-animated-counter-02 anc-6310-counter-number" 
                  id="anc-6310-02-3"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="120" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2"
                ></div>
                </div>
              </div>
              <div class="anc-6310-counter-02-count-title">campus building</div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-02">
              <div class="anc-6310-counter-02-icon">
                <i class="fas fa-user-graduate"></i>
              </div>
              <div class="anc-6310-counter-02-count-content">
                <div class="anc-6310-counter-02-count-content-inner">
                <div 
                  class="anc-6310-counter-02-count-number anc-6310-animated-counter-02 anc-6310-counter-number" 
                  id="anc-6310-02-4"
                  data-anc-6310-start="5" 
                  data-anc-6310-end="500.25" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2"
                ></div>
                </div>
              </div>
              <div class="anc-6310-counter-02-count-title">No. Of Graduates</div>
            </div>
          </div>
        </div>
      </div>
    </div>
        </div>
    <div class="anc-6310-counter-list">
      Counter 2
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-02">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 2 end
    ****************************************** -->
  <!-- ******************************************
      counter 3 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-03-paralax">
        <div class="anc-6310-counter-03-common-overlay">       
          <iframe src='https://www.youtube.com/embed/2L515SmPbRw?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=2L515SmPbRw&mute=1&allowfullscreen=1&allow=accelerometer&autoplay=1&rel=0' frameborder='0' allowfullscreen></iframe>
        <div class="anc-6310-counter-03-wrap">
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-03">
              <div class="anc-6310-counter-03-featured-item">
              <span><i class="fas fa-play"></i></span>
              </div>
              <div class="anc-6310-counter-03-count-content-inner">
                <div class="anc-6310-counter-03-count-content">
                <div class="anc-6310-counter-03-count-number anc-6310-animated-counter-03 anc-6310-counter-number" 
                  id="anc-6310-03-1"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="800" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
                </div>

                <div class="anc-6310-counter-03-count-title">video player</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-03">
              <div class="anc-6310-counter-03-featured-item">
                <span><i class="fas fa-music"></i></span>
              </div>
              <div class="anc-6310-counter-03-count-content">
                <div class="anc-6310-counter-03-count-content-inner">
                <div class="anc-6310-counter-03-count-number anc-6310-animated-counter-03 anc-6310-counter-number" 
                  id="anc-6310-03-2"
                  data-anc-6310-start="1" 
                  data-anc-6310-end="9.45" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2">
                </div>
                </div>
              </div>
              <div class="anc-6310-counter-03-count-title">Music Player</div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-03">
              <div class="anc-6310-counter-03-featured-item">
                <span><i class="fas fa-camera"></i></span>
              </div>
              <div class="anc-6310-counter-03-count-content">
                <div class="anc-6310-counter-03-count-content-inner">
                <div class="anc-6310-counter-03-count-number anc-6310-animated-counter-03 anc-6310-counter-number" 
                  id="anc-6310-03-3"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="10" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
                </div>
              </div>
              <div class="anc-6310-counter-03-count-title">Photography</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 3
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-03">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 3 end
    ****************************************** -->
  <!-- ******************************************
      counter 4 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-04">
          <div class="anc-6310-counter-04-top-container">
            <div class="anc-6310-counter-04-top-inner-wrap">
              <div class="anc-6310-counter-04-count-content">
                <div class="anc-6310-counter-04-count-content-inner">
                  <div class="anc-6310-counter-04-count-number anc-6310-animated-counter-04 anc-6310-counter-number" 
                    id="anc-6310-04-1"
                    data-anc-6310-start="0" 
                    data-anc-6310-end="1000" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                </div>
              </div>
              <div class="anc-6310-counter-04-count-title">cups of coffee</div>
              <div class="anc-6310-counter-04-count-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elit lorem.</div>
            </div>
          </div>
          <div class="anc-6310-counter-04-bottom-container">
            <div class="anc-6310-counter-04-featured-item"><span><i class="fas fa-coffee"></i></span></div>
          </div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-04">
          <div class="anc-6310-counter-04-top-container">
            <div class="anc-6310-counter-04-top-inner-wrap">
              <div class="anc-6310-counter-04-count-content">
                <div class="anc-6310-counter-04-count-content-inner">
                    <div class="anc-6310-counter-04-count-number anc-6310-animated-counter-04 anc-6310-counter-number" 
                      id="anc-6310-04-2"
                      data-anc-6310-start="1" 
                      data-anc-6310-end="500" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                    </div>
                </div>
              </div>
              <div class="anc-6310-counter-04-count-title">CONFIGURATIONS</div>
              <div class="anc-6310-counter-04-count-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elit lorem.</div>
            </div>
          </div>
          <div class="anc-6310-counter-04-bottom-container">
            <div class="anc-6310-counter-04-featured-item"><span><i class="fas fa-wrench"></i></span></div>
          </div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-04">
          <div class="anc-6310-counter-04-top-container">
            <div class="anc-6310-counter-04-top-inner-wrap">
              <div class="anc-6310-counter-04-count-content">
                <div class="anc-6310-counter-04-count-content-inner">
                  <div class="anc-6310-counter-04-count-number anc-6310-animated-counter-04 anc-6310-counter-number" 
                    id="anc-6310-04-3"
                    data-anc-6310-start="1000" 
                    data-anc-6310-end="99.99" 
                    data-anc-6310-decimal="2" 
                    data-anc-6310-duration="2">
                  </div>
                </div>
              </div>
              <div class="anc-6310-counter-04-count-title">WORK COMPLETED</div>
              <div class="anc-6310-counter-04-count-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elit lorem.</div>
            </div>
          </div>
          <div class="anc-6310-counter-04-bottom-container">
            <div class="anc-6310-counter-04-featured-item"><span><i class="fas fa-lightbulb"></i></span></div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 4
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-04">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 4 end
    ****************************************** -->
  <!-- ******************************************
      counter 5 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-05-paralax">
        <div class="anc-6310-counter-05-common-overlay"></div>
        <div class="anc-6310-counter-05-wrap">
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-05">
              <div class="anc-6310-counter-05-top-bottom-container-wrap">
                <div class="anc-6310-counter-05-top-container">
                  <div class="anc-6310-counter-05-top-inner-wrap">
                    <div class="anc-6310-counter-05-featured-item">
                      <span><i class="far fa-star"></i></span>
                    </div>
                  </div>
                </div>
                <div class="anc-6310-counter-05-bottom-container">
                  <span class="span2"></span>
                  <span class="span1"></span>
                  <div class="anc-6310-counter-05-count-content">
                    <div class="anc-6310-counter-05-count-content-inner">
                      <div class="anc-6310-counter-05-count-number anc-6310-animated-counter-05 anc-6310-counter-number" 
                      id="anc-6310-05-1"
                      data-anc-6310-start="0" 
                      data-anc-6310-end="1000" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                      </div>
                      <span class="anc-6310-counter-05-count-suffix">+</span>
                    </div>
                  </div>
                  <div class="anc-6310-counter-05-count-title">5 star ratings</div>
                </div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-05">
              <div class="anc-6310-counter-05-top-bottom-container-wrap">
                <div class="anc-6310-counter-05-top-container">
                  <div class="anc-6310-counter-05-top-inner-wrap">
                    <div class="anc-6310-counter-05-featured-item">
                      <span><i class="fas fa-trophy"></i></span>
                    </div>
                  </div>
                </div>
                <div class="anc-6310-counter-05-bottom-container">
                  <span class="span2"></span>
                  <span class="span1"></span>
                  <div class="anc-6310-counter-05-count-content">
                    <div class="anc-6310-counter-05-count-content-inner">
                    <div class="anc-6310-counter-05-count-number anc-6310-animated-counter-05 anc-6310-counter-number" 
                      id="anc-6310-05-2"
                      data-anc-6310-start="100" 
                      data-anc-6310-end="500" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                      </div>
                      <span class="anc-6310-counter-05-count-suffix">+</span>
                    </div>
                  </div>
                  <div class="anc-6310-counter-05-count-title">Awards Won</div>
                </div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-3">
            <div class="anc-6310-counter-05">
              <div class="anc-6310-counter-05-top-bottom-container-wrap">
                <div class="anc-6310-counter-05-top-container">
                  <div class="anc-6310-counter-05-top-inner-wrap">
                    <div class="anc-6310-counter-05-featured-item">
                      <span><i class="far fa-thumbs-up"></i></span>
                    </div>
                  </div>
                </div>
                <div class="anc-6310-counter-05-bottom-container">
                  <span class="span2"></span>
                  <span class="span1"></span>
                  <div class="anc-6310-counter-05-count-content">
                    <div class="anc-6310-counter-05-count-content-inner">
                      <div class="anc-6310-counter-05-count-number anc-6310-animated-counter-05 anc-6310-counter-number" 
                        id="anc-6310-05-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="9.99" 
                        data-anc-6310-decimal="2" 
                        data-anc-6310-duration="2">
                      </div>
                      <span class="anc-6310-counter-05-count-suffix">+</span>
                    </div>
                  </div>
                  <div class="anc-6310-counter-05-count-title">Facebook Likes</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 5
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-05">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 5 end
    ****************************************** -->
  <!-- ******************************************
      counter 6 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-06">
          <div class="anc-6310-counter-06-icon">
            <i class="fa fa-briefcase"></i>
            <div class="anc-6310-counter-06-number anc-6310-animated-counter-06">
                <div class="anc-6310-counter-06-count-number anc-6310-animated-counter-06 anc-6310-counter-number" 
                  id="anc-6310-06-1"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="1200" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
            </div>
          </div>
          <div class="anc-6310-counter-06-count-title">clients worked</div>
          <div class="anc-6310-counter-06-count-subtitle"> There are many variations of it’s passages of Lorem fered in some jected umour</div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-06">
          <div class="anc-6310-counter-06-icon">
            <i class="fa fa-trophy"></i>
            <div class="anc-6310-counter-06-number anc-6310-animated-counter-06">
              <div class="anc-6310-counter-06-count-number anc-6310-animated-counter-06 anc-6310-counter-number" 
                  id="anc-6310-06-2"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="100" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
            </div>
          </div>
          <div class="anc-6310-counter-06-count-title">Awards Winner</div>
          <div class="anc-6310-counter-06-count-subtitle"> Aolaboraively eenable vira niche markets Compe evsculate funcnal mndshare through forand goaloriented project.</div>
        </div>
      </div>
      <div class="anc-6310-col-3">
        <div class="anc-6310-counter-06">
          <div class="anc-6310-counter-06-icon">
            <i class="fas fa-image"></i>
            <div class="anc-6310-counter-06-number anc-6310-animated-counter-06">
            <div class="anc-6310-counter-06-count-number anc-6310-animated-counter-06 anc-6310-counter-number" 
                  id="anc-6310-06-3"
                  data-anc-6310-start="100" 
                  data-anc-6310-end="9.99" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2">
              </div>
            </div>
          </div>
          <div class="anc-6310-counter-06-count-title">Image Slider</div>
          <div class="anc-6310-counter-06-count-subtitle"> There are many variations of it’s passages of Lorem fered in some jected umour</div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 6
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-06">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 6 end
    ****************************************** -->
  <!-- ******************************************
      counter 7 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-07-paralax">
        <div class="anc-6310-counter-07-common-overlay">
        <iframe src='https://www.youtube.com/embed/Ss1Nml_0yBY?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist=Ss1Nml_0yBY&mute=1&allowfullscreen=1&allow=accelerometer&autoplay=1&rel=0' frameborder='0' allowfullscreen></iframe>
        <div class="anc-6310-counter-07-wrap">
          <div class="anc-6310-col-4 no-ml-mr-0">
            <div class="anc-6310-counter-07">
              <div class="anc-6310-counter-07-count-content">
                <div class="anc-6310-counter-07-count-content-inner">
                  <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                    id="anc-6310-07-1"
                    data-anc-6310-start="100" 
                    data-anc-6310-end="550" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <span class="anc-6310-counter-07-count-suffix">+</span>
                </div>
              </div>
              <div class="anc-6310-counter-07-count-title">attendees</div>
              <div class="anc-6310-counter-07-count-subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</div>
            </div>
          </div>
          <div class="anc-6310-col-4 no-ml-mr-0">
            <div class="anc-6310-counter-07">
              <div class="anc-6310-counter-07-count-content">
                <div class="anc-6310-counter-07-count-content-inner">
                  <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                    id="anc-6310-07-2"
                    data-anc-6310-start="0" 
                    data-anc-6310-end="1000" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <span class="anc-6310-counter-07-count-suffix">+</span>
                </div>
              </div>
              <div class="anc-6310-counter-07-count-title">speakers</div>
              <div class="anc-6310-counter-07-count-subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</div>
            </div>
          </div>
          <div class="anc-6310-col-4 no-ml-mr-0">
            <div class="anc-6310-counter-07">
              <div class="anc-6310-counter-07-count-content">
                <div class="anc-6310-counter-07-count-content-inner">
                  <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                    id="anc-6310-07-3"
                    data-anc-6310-start="999" 
                    data-anc-6310-end="100" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <span class="anc-6310-counter-07-count-suffix">+</span>
                </div>
              </div>
              <div class="anc-6310-counter-07-count-title">hours</div>
              <div class="anc-6310-counter-07-count-subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</div>
            </div>
          </div>
          <div class="anc-6310-col-4 no-ml-mr-0">
            <div class="anc-6310-counter-07">
              <div class="anc-6310-counter-07-count-content">
                <div class="anc-6310-counter-07-count-content-inner">
                  <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                    id="anc-6310-07-4"
                    data-anc-6310-start="100" 
                    data-anc-6310-end="9.955" 
                    data-anc-6310-decimal="2" 
                    data-anc-6310-duration="2">
                  </div>
                  <span class="anc-6310-counter-07-count-suffix">+</span>
                </div>
              </div>
              <div class="anc-6310-counter-07-count-title">exciting stalls</div>
              <div class="anc-6310-counter-07-count-subtitle"> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 7
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-07">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 7 end
    ****************************************** -->
  <!-- ******************************************
      counter 8 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-08-row">
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-08">
            <div class="anc-6310-counter-08-featured-item"><i class="far fa-building"></i></div>
            <div class="anc-6310-counter-08-count-content anc-6310-animated-counter-08">
              <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                  id="anc-6310-08-1"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="1200" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
            </div>
            <div class="anc-6310-counter-08-count-title">university buildings</div>
            <div class="anc-6310-counter-08-count-subtitle">Give us a brief description of the service that you</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-08">
            <div class="anc-6310-counter-08-featured-item"><i class="fas fa-users"></i></div>
            <div class="anc-6310-counter-08-count-content anc-6310-animated-counter-08">
              <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                  id="anc-6310-08-2"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="500" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
            </div>
            <div class="anc-6310-counter-08-count-title">students Enrolled</div>
            <div class="anc-6310-counter-08-count-subtitle">Give us a brief description of the service that you</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-08">
            <div class="anc-6310-counter-08-featured-item"><i class="fas fa-list-alt"></i></div>
              <div class="anc-6310-counter-08-count-content anc-6310-animated-counter-08">
                <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                  id="anc-6310-08-3"
                  data-anc-6310-start="500" 
                  data-anc-6310-end="9.944" 
                  data-anc-6310-decimal="3" 
                  data-anc-6310-duration="2">
                </div>
              </div>
            <div class="anc-6310-counter-08-count-title">Courses Included</div>
            <div class="anc-6310-counter-08-count-subtitle">Give us a brief description of the service that you</div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-08">
            <div class="anc-6310-counter-08-featured-item"><i class="fas fa-book"></i></div>
            <div class="anc-6310-counter-08-count-content anc-6310-animated-counter-08">
              <div class="anc-6310-counter-07-count-number anc-6310-animated-counter-07 anc-6310-counter-number" 
                  id="anc-6310-08-4"
                  data-anc-6310-start="10" 
                  data-anc-6310-end="800" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
            </div>
            <div class="anc-6310-counter-08-count-title">No Of Books</div>
            <div class="anc-6310-counter-08-count-subtitle">Give us a brief description of the service that you</div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 8
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-08">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 8 end
    ****************************************** -->
  <!-- ******************************************
      counter 9 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-09-row">
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-09">
            <div class="anc-6310-counter-09-icon"><i class="fa fa-list-alt"></i></div>
            <div class="anc-6310-counter-09-inner-wrap">
              <div class="anc-6310-counter-09-number anc-6310-animated-counter-09">
              <div class="anc-6310-counter-09-count-number anc-6310-animated-counter-09 anc-6310-counter-number" 
                  id="anc-6310-09-1"
                  data-anc-6310-start="10" 
                  data-anc-6310-end="1000" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
              </div>
              <div class="anc-6310-counter-09-title">projects completed</div>
            </div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-09">
            <div class="anc-6310-counter-09-icon"><i class="fa fa-trophy"></i></div>
            <div class="anc-6310-counter-09-inner-wrap">
              <div class="anc-6310-counter-09-number anc-6310-animated-counter-09">
              <div class="anc-6310-counter-09-count-number anc-6310-animated-counter-09 anc-6310-counter-number" 
                  id="anc-6310-09-2"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="500" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
              </div>
              <div class="anc-6310-counter-09-title">Awards Winner</div>
            </div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-09">
            <div class="anc-6310-counter-09-icon"><i class="fa fa-briefcase"></i></div>
            <div class="anc-6310-counter-09-inner-wrap">
              <div class="anc-6310-counter-09-number anc-6310-animated-counter-09">
              <div class="anc-6310-counter-09-count-number anc-6310-animated-counter-09 anc-6310-counter-number" 
                  id="anc-6310-09-3"
                  data-anc-6310-start="10" 
                  data-anc-6310-end="55.55" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
              </div>
              </div>
              <div class="anc-6310-counter-09-title">Clients Worked</div>
            </div>
          </div>
        </div>
        <div class="anc-6310-col-4">
          <div class="anc-6310-counter-09">
            <div class="anc-6310-counter-09-icon"><i class="far fa-star"></i></div>
            <div class="anc-6310-counter-09-inner-wrap">
              <div class="anc-6310-counter-09-number anc-6310-animated-counter-09">
              <div class="anc-6310-counter-09-count-number anc-6310-animated-counter-09 anc-6310-counter-number" 
                  id="anc-6310-09-4"
                  data-anc-6310-start="0" 
                  data-anc-6310-end="11.256" 
                  data-anc-6310-decimal="3" 
                  data-anc-6310-duration="2">
              </div>
              </div>
              <div class="anc-6310-counter-09-title">5 Star Ratings</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 9
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-09">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 9 end
    ****************************************** -->
  <!-- ******************************************
      counter 10 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-10-paralax">
        <div class="anc-6310-counter-10-row">
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-10">
              <div class="anc-6310-counter-10-icon"><i class="fa fa-list-alt"></i></div>
              <div class="anc-6310-counter-10-inner-wrap">
                <div class="anc-6310-counter-10-number anc-6310-animated-counter-10">
                <div class="anc-6310-counter-10-count-number anc-6310-animated-counter-10 anc-6310-counter-number" 
                  id="anc-6310-10-1"
                  data-anc-6310-start="1000" 
                  data-anc-6310-end="500" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
                </div>
                <div class="anc-6310-counter-10-title">projects completed</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-10">
              <div class="anc-6310-counter-10-icon"><i class="fas fa-align-left"></i></div>
              <div class="anc-6310-counter-10-inner-wrap">
                <div class="anc-6310-counter-10-number anc-6310-animated-counter-10">
                <div class="anc-6310-counter-10-count-number anc-6310-animated-counter-10 anc-6310-counter-number" 
                  id="anc-6310-10-2"
                  data-anc-6310-start="500" 
                  data-anc-6310-end="55.45" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2">
                </div>
                </div>
                <div class="anc-6310-counter-10-title">works completed</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-10">
              <div class="anc-6310-counter-10-icon"><i class="fas fa-cloud-download-alt"></i></div>
              <div class="anc-6310-counter-10-inner-wrap">
                <div class="anc-6310-counter-10-number anc-6310-animated-counter-10">
                <div class="anc-6310-counter-10-count-number anc-6310-animated-counter-10 anc-6310-counter-number" 
                  id="anc-6310-10-3"
                  data-anc-6310-start="10" 
                  data-anc-6310-end="1000" 
                  data-anc-6310-decimal="0" 
                  data-anc-6310-duration="2">
                </div>
                </div>
                <div class="anc-6310-counter-10-title">download completed</div>
              </div>
            </div>
          </div>
          <div class="anc-6310-col-4">
            <div class="anc-6310-counter-10">
              <div class="anc-6310-counter-10-icon"><i class="fas fa-tasks"></i></div>
              <div class="anc-6310-counter-10-inner-wrap">
                <div class="anc-6310-counter-10-number anc-6310-animated-counter-10">
                <div class="anc-6310-counter-10-count-number anc-6310-animated-counter-10 anc-6310-counter-number" 
                  id="anc-6310-10-4"
                  data-anc-6310-start="500" 
                  data-anc-6310-end="99.94" 
                  data-anc-6310-decimal="2" 
                  data-anc-6310-duration="2">
                </div>
                </div>
                <div class="anc-6310-counter-10-title">Projects In Progress</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 10
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-10">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 10 end
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