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

    if ($_POST['style'] == 'counter-21') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,image_overlay_color,image_overlay_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,circle_size,circle_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_family,description_font_weight,description_text_transform,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!16||##||3||##||500||##||,||##||rgba(15, 49, 163, 0.46)||##||rgba(12, 17, 56, 0.4)||##||4||##||2||##||rgba(255, 255, 255, 1)||##||rgba(120, 184, 125, 0.87)||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||3||##||4||##||rgba(3, 3, 3, 0)||##||rgba(255, 217, 0, 0)||##||162||##||rgba(255, 255, 255, 1)||##||3||##||transparent||##||rgba(52, 104, 143, 1)||##||https://www.wpmart.org/wp-content/uploads/2020/12/counter-03-background.jpg||##||https://www.youtube.com/watch?v=lRTtMcx6rSM||##||25||##||26||##||rgb(255, 255, 255)||##||rgb(0, 0, 0)||##||100||##||uppercase||##||Allerta+Stencil||##||0||##||20||##||30||##||0||##||15||##||15||##||rgb(255, 255, 255)||##||rgb(0, 0, 0)||##||Amaranth||##||400||##||capitalize||##||18||##||18||##||rgb(255, 255, 255)||##||rgb(0, 0, 0)||##||600||##||Arvo||##||0||##||0||##||0||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(161, 131, 151, 0.62)||##||rgba(6, 141, 204, 0.49)||##||13||##||34||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||120||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||7||##||15||##||-4||##||||##||Save";
    }  else if ($_POST['style'] == 'counter-22') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_background_width,number_background_height,number_background_color,number_background_hover_color,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!26||##||3||##||500||##||||##||rgba(0, 0, 0, 0.5)||##||rgba(0, 0, 0, 0.5)||##||5||##||rgba(255, 111, 202, 1)||##||rgba(245, 24, 160, 1)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||3||##||transparent||##||rgba(255, 255, 255, 0)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-12-background.jpg||##||||##||22||##||22||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||10||##||15||##||40||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||10||##||10||##||6||##||10||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||200||##||80||##||rgb(255, 111, 202)||##||rgb(240, 19, 155)||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-23') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_border_color,icon_border_hover_color,icon_border_width,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!28||##||3||##||500||##||||##||rgba(0, 0, 0, 0.5)||##||rgba(0, 0, 0, 0.5)||##||0||##||0||##||0||##||rgba(255, 255, 255, 0)||##||rgba(255, 255, 255, 0)||##||3||##||transparent||##||rgba(191, 191, 191, 0.78)||##||https://blog.depositphotos.com/wp-content/uploads/2017/07/Soothing-nature-backgrounds-2.jpg.webp||##||y1ITlvCq5Ro||##||22||##||22||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||10||##||15||##||20||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(151, 240, 88, 1)||##||rgba(255, 255, 255, 1)||##||100||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||0||##||0||##||20||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-24') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_color_2,number_background_color,number_background_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_margin_left,icon_margin_right,icon_margin_top,icon_margin_bottom,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!29||##||3||##||500||##||||##||rgba(21, 191, 247, 1)||##||rgba(26, 136, 218, 1)||##||rgb(237, 237, 237)||##||rgb(237, 237, 237)||##||0||##||0||##||rgba(255, 255, 255, 0)||##||2||##||transparent||##||rgba(217, 217, 217, 0.81)||##||http://localhost/wordpress/wp-content/uploads/2021/02/schweiz-1.jpg||##||y1ITlvCq5Ro||##||22||##||22||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||10||##||15||##||50||##||rgba(26, 136, 218, 1)||##||rgba(26, 136, 218, 1)||##||0||##||0||##||6||##||11||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(69, 69, 69)||##||rgb(69, 69, 69)||##||400||##||Anton||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-25') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_border_color,box_border_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_border_size,icon_border_color,icon_border_hover_color,icon_background_size,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!30||##||3||##||500||##||||##||rgba(107, 13, 51, 1)||##||rgba(107, 13, 51, 1)||##||rgba(167, 73, 112, 1)||##||rgba(168, 72, 111, 1)||##||3||##||transparent||##||rgba(235, 115, 115, 0.71)||##||https://images.unsplash.com/photo-1623039925698-1f96229b1a51?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=750&q=80||##||y1ITlvCq5Ro||##||22||##||22||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||10||##||15||##||40||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||0||##||rgba(5, 5, 5, 0.8)||##||rgba(0, 0, 0, 1)||##||90||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-26') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_radius,box_border_width,box_border_color,box_border_hover_color,box_shadow_width,box_shadow_blur,box_shadow_color,box_shadow_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_background_size,icon_background_color,icon_background_hover_color,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!31||##||3||##||500||##||||##||rgba(235, 74, 0, 1)||##||rgba(235, 74, 0, 1)||##||0||##||5||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||2||##||3||##||rgba(0, 0, 0, 0)||##||rgba(0, 0, 0, 1)||##||2||##||transparent||##||rgba(214, 210, 210, 1)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-12-background.jpg||##||||##||22||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||uppercase||##||Arimo||##||0||##||0||##||10||##||15||##||26||##||rgba(235, 74, 0, 1)||##||rgba(235, 74, 0, 1)||##||||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||0||##||0||##||10||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-27') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_border_width,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,box_border_color,box_border_color_2,box_border_color_3,box_border_hover_color,box_border_hover_color_2,box_border_hover_color_3,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_background_size,icon_border_size,icon_margin_bottom,icon_color,icon_hover_color,icon_background_color,icon_background_hover_color,icon_border_color,icon_border_hover_color,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,custom_css,update_style_change!!##!!33||##||3||##||500||##||||##||rgba(250, 128, 114, 1)||##||rgba(250, 128, 114, 1)||##||150||##||2||##||transparent||##||rgba(214, 214, 214, 1)||##||||##||||##||rgba(240, 64, 5, 1)||##||rgba(0, 255, 255, 1)||##||rgba(171, 0, 250, 1)||##||rgba(240, 64, 5, 1)||##||rgba(0, 255, 255, 1)||##||rgba(171, 0, 250, 1)||##||22||##||22||##||rgb(0, 0, 0)||##||rgb(0, 0, 0)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||50||##||15||##||33||##||80||##||5||##||20||##||rgba(0, 0, 0, 1)||##||rgba(0, 0, 0, 1)||##||rgb(154, 205, 50)||##||rgb(247, 247, 247)||##||rgba(0, 0, 0, 1)||##||rgba(0, 0, 0, 1)||##||30||##||30||##||rgb(0, 0, 0)||##||rgb(5, 5, 5)||##||400||##||Amaranth||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||||##||Save";
    } else if ($_POST['style'] == 'counter-28') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_border_width,box_border_color,box_border_color_2,box_border_hover_color,box_border_hover_color_2,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_background_width,icon_background_height,icon_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,custom_css,update_style_change!!##!!34||##||3||##||500||##||,||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||220||##||rgba(105, 82, 255, 1)||##||rgba(72, 52, 212, 1)||##||rgba(105, 82, 255, 1)||##||rgba(72, 52, 212, 1)||##||3||##||transparent||##||rgba(184, 40, 40, 0.71)||##||https://www.wpmart.org/wp-content/uploads/2020/counter/counter-12-background.jpg||##||||##||16||##||23||##||rgb(72, 52, 212)||##||rgb(72, 52, 212)||##||bold||##||uppercase||##||Allerta||##||0||##||0||##||0||##||15||##||30||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||100||##||60||##||10||##||30||##||30||##||rgb(72, 52, 212)||##||rgb(72, 52, 212)||##||400||##||Amaranth||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||||##||Save";
    } else if ($_POST['style'] == 'counter-29') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_background_width,icon_background_height,description_font_size,description_line_height,description_font_color,description_font_hover_color,description_font_weight,description_text_transform,description_text_align,description_font_family,description_margin_left,description_margin_right,description_margin_top,description_margin_bottom,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,button_background_color,button_background_hover_color,button_font_size,button_line_height,button_font_color,button_font_hover_color,button_font_weight,button_text_transform,button_width,button_font_family,button_align,button_text_align,button_border_width,button_border_color,button_border_hover_color,button_border_radius,button_margin_top,button_margin_bottom,custom_css,update_style_change!!##!!35||##||4||##||500||##||||##||rgba(227, 50, 88, 1)||##||rgba(227, 50, 88, 1)||##||2||##||transparent||##||rgba(219, 219, 219, 0.86)||##||http://localhost/wordpress/wp-content/uploads/2021/02/schweiz-1.jpg||##||y1ITlvCq5Ro||##||22||##||22||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||uppercase||##||Arimo||##||0||##||0||##||4||##||0||##||35||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||70||##||60||##||15||##||20||##||rgb(214, 214, 214)||##||rgb(214, 214, 214)||##||400||##||capitalize||##||center||##||Allerta||##||0||##||0||##||10||##||5||##||30||##||30||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||Amaranth||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||rgba(0, 158, 226, 1)||##||rgba(7, 144, 204, 0.8)||##||13||##||25||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||400||##||uppercase||##||110||##||Arimo||##||center||##||center||##||0px||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||0||##||20||##||10||##||||##||Save";
    } else if ($_POST['style'] == 'counter-30') {
      $css = "id,item_per_row,animation_duration,thousands_separator,box_background_color,box_background_hover_color,box_border_color,background_type,background_transparent,template_background_color,box_background_image,youtube_video_url,title_font_size,title_line_height,title_font_color,title_font_hover_color,title_font_weight,title_text_transform,title_font_family,title_margin_left,title_margin_right,title_margin_top,title_margin_bottom,icon_size,icon_color,icon_hover_color,icon_background_color,icon_background_hover_color,icon_background_height,number_font_size,number_line_height,number_font_color,number_font_hover_color,number_font_weight,number_font_family,number_margin_left,number_margin_right,number_margin_top,number_margin_bottom,number_prefix_font_size,number_prefix_font_color,number_prefix_font_hover_color,number_prefix_font_weight,number_prefix_font_family,number_prefix_position,number_prefix_margin_left,number_prefix_margin_right,number_suffix_font_size,number_suffix_font_color,number_suffix_font_hover_color,number_suffix_font_weight,number_suffix_font_family,number_suffix_position,number_suffix_margin_left,number_suffix_margin_right,custom_css,update_style_change!!##!!36||##||3||##||500||##||||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(194, 194, 194, 0.96)||##||2||##||transparent||##||rgba(235, 235, 235, 1)||##||||##||||##||22||##||22||##||rgb(150, 150, 150)||##||rgb(171, 171, 171)||##||100||##||uppercase||##||Amaranth||##||0||##||0||##||10||##||15||##||50||##||rgba(255, 255, 255, 1)||##||rgba(255, 255, 255, 1)||##||rgba(68, 160, 199, 1)||##||rgba(68, 160, 199, 1)||##||97||##||30||##||30||##||rgb(68, 160, 199)||##||rgb(68, 160, 199)||##||400||##||Amaranth||##||0||##||0||##||0||##||10||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||20||##||rgb(255, 255, 255)||##||rgb(255, 255, 255)||##||100||##||Amaranth||##||2||##||0||##||0||##||||##||Save";
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
      $url = admin_url("admin.php?page=anc-6310-counter-21-30&styleid=$redirect_id");
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
      counter 21 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-21-paralax">
        <div class="anc-6310-counter-21-common-overlay">
          <div class="anc-6310-counter-21-wrap">
          <div class="anc-6310-counter-21-row">
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-21">
                  <div class="anc-6310-counter-21-wrapper">                  
                      <div class="final-animation anc-6310-counter-21-count-number anc-6310-animated-counter-21 anc-6310-counter-number" 
                        id="anc-6310-21-1"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="800" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>                 
                    <div class="anc-6310-circle-section-counter-21">
                      <div class="anc-6310-circle-span-counter-21">
                        <div class="anc-6310-circle-span-1-counter-21" id="clipped"></div>
                      </div>
                      <div class="anc-6310-circle-span-1-counter-21" id="fixed">
                      </div>
                    </div>
                  </div>                
                </div>
                <div class="anc-6310-counter-21-title">Design Awards</div>
              </div>
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-21">
                  <div class="anc-6310-counter-21-wrapper">                  
                      <div class="final-animation anc-6310-counter-21-count-number anc-6310-animated-counter-21 anc-6310-counter-number" 
                        id="anc-6310-21-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="500" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>                 
                    <div class="anc-6310-circle-section-counter-21">
                      <div class="anc-6310-circle-span-counter-21">
                        <div class="anc-6310-circle-span-1-counter-21" id="clipped"></div>
                      </div>
                      <div class="anc-6310-circle-span-1-counter-21" id="fixed">
                      </div>
                    </div>
                  </div>                
                </div>
                <div class="anc-6310-counter-21-title">Design Awards</div>
              </div>
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-21">
                  <div class="anc-6310-counter-21-wrapper">                  
                      <div class="final-animation anc-6310-counter-21-count-number anc-6310-animated-counter-21 anc-6310-counter-number" 
                        id="anc-6310-21-3"
                        data-anc-6310-start="1" 
                        data-anc-6310-end="785" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>                 
                    <div class="anc-6310-circle-section-counter-21">
                      <div class="anc-6310-circle-span-counter-21">
                        <div class="anc-6310-circle-span-1-counter-21" id="clipped"></div>
                      </div>
                      <div class="anc-6310-circle-span-1-counter-21" id="fixed">
                      </div>
                    </div>
                  </div>                
                </div>
                <div class="anc-6310-counter-21-title">Design Awards</div>
              </div>
              <div class="anc-6310-col-4">
                <div class="anc-6310-counter-21">
                  <div class="anc-6310-counter-21-wrapper">                  
                      <div class="final-animation anc-6310-counter-21-count-number anc-6310-animated-counter-21 anc-6310-counter-number" 
                        id="anc-6310-13-4"
                        data-anc-6310-start="1" 
                        data-anc-6310-end="10" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                        10
                      </div>                 
                    <div class="anc-6310-circle-section-counter-21">
                      <div class="anc-6310-circle-span-counter-21">
                        <div class="anc-6310-circle-span-1-counter-21" id="clipped"></div>
                      </div>
                      <div class="anc-6310-circle-span-1-counter-21" id="fixed">
                      </div>
                    </div>
                  </div>                
                </div>
                <div class="anc-6310-counter-21-title">Design Awards</div>
              </div>          
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 21
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-21">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 21 end
    ****************************************** -->
     <!-- ******************************************
      counter 22 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-22-paralax">
        <div class="anc-6310-counter-22-common-overlay">
          <div class="anc-6310-counter-22-wrap">
          <div class="anc-6310-counter-22-row">
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-22">
                          <div class="anc-6310-counter-22-icon"> 
                          <i class="fa fa-rocket"></i>
                          </div>
                          <div class="anc-6310-counter-22-count-number anc-6310-animated-counter-22 anc-6310-counter-number" 
                            id="anc-6310-22-1"
                            data-anc-6310-start="100" 
                            data-anc-6310-end="551" 
                            data-anc-6310-decimal="0" 
                            data-anc-6310-duration="2">
                          </div>
                    <div class="anc-6310-counter-22-title">Web Design</div>
                </div>
               </div>  
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-22">
                    <div class="anc-6310-counter-22-icon"> 
                    <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="anc-6310-counter-22-count-number anc-6310-animated-counter-22 anc-6310-counter-number" 
                    id="anc-6310-22-2"
                    data-anc-6310-start="1000" 
                    data-anc-6310-end="158" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                      <div class="anc-6310-counter-22-title">Web Design</div>
                  </div>
              </div>
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-22">
                    <div class="anc-6310-counter-22-icon"> 
                    <i class="fa fa-mobile"></i>
                    </div>
                    <div class="anc-6310-counter-22-count-number anc-6310-animated-counter-22 anc-6310-counter-number" 
                    id="anc-6310-22-3"
                    data-anc-6310-start="550" 
                    data-anc-6310-end="1090" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                      <div class="anc-6310-counter-22-title">Web Design</div>
                  </div>
              </div>
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-22">
                    <div class="anc-6310-counter-22-icon"> 
                    <i class="fa fa-globe"></i>
                    </div>
                    <div class="anc-6310-counter-22-count-number anc-6310-animated-counter-22 anc-6310-counter-number" 
                    id="anc-6310-22-4"
                    data-anc-6310-start="0" 
                    data-anc-6310-end="50" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                      <div class="anc-6310-counter-22-title">Web Design</div>
                  </div>
              </div>           
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 22
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-22">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 22 end
    ****************************************** -->
         <!-- ******************************************
      counter 23 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-23-paralax">
        <div class="anc-6310-counter-23-common-overlay">
          <div class="anc-6310-counter-23-wrap">
          <div class="anc-6310-counter-23-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-23">
                  <div class="anc-6310-counter-23-icon">
                  <i class="fas fa-coffee"></i>
                  </div>
                  <div class="anc-6310-counter-23-count-number anc-6310-animated-counter-23 anc-6310-counter-number" 
                    id="anc-6310-23-1"
                    data-anc-6310-start="100" 
                    data-anc-6310-end="908" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <div class="anc-6310-counter-23-title">Web Design</div>
                </div>
              </div>  
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-23">
                  <div class="anc-6310-counter-23-icon">
                  <i class="fas fa-wrench"></i>
                  </div>
                  <div class="anc-6310-counter-23-count-number anc-6310-animated-counter-23 anc-6310-counter-number" 
                    id="anc-6310-23-2"
                    data-anc-6310-start="100" 
                    data-anc-6310-end="787" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <div class="anc-6310-counter-23-title">Web Design</div>
                </div>
              </div>  
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-23">
                  <div class="anc-6310-counter-23-icon">
                  <i class="fas fa-lightbulb"></i>
                  </div>
                  <div class="anc-6310-counter-23-count-number anc-6310-animated-counter-23 anc-6310-counter-number" 
                    id="anc-6310-23-3"
                    data-anc-6310-start="550" 
                    data-anc-6310-end="1090" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <div class="anc-6310-counter-23-title">Web Design</div>
                </div>
              </div>  
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-23">
                  <div class="anc-6310-counter-23-icon">
                  <i class="far fa-thumbs-up"></i>
                  </div>
                  <div class="anc-6310-counter-23-count-number anc-6310-animated-counter-23 anc-6310-counter-number" 
                    id="anc-6310-23-4"
                    data-anc-6310-start="0" 
                    data-anc-6310-end="50" 
                    data-anc-6310-decimal="0" 
                    data-anc-6310-duration="2">
                  </div>
                  <div class="anc-6310-counter-23-title">Web Design</div>
                </div>
              </div>  
                  
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 23
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-23">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 23 end
    ****************************************** -->
             <!-- ******************************************
      counter 24 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-24-paralax">
        <div class="anc-6310-counter-24-common-overlay">
          <div class="anc-6310-counter-24-wrap">
          <div class="anc-6310-counter-24-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-24">
                  <div class="anc-6310-counter-24-content">
                    <div class="anc-6310-counter-24-icon"><i class="fas fa-trophy"></i></div>
                      <div class="anc-6310-counter-24-count-number anc-6310-animated-counter-24 anc-6310-counter-number" 
                      id="anc-6310-24-1"
                      data-anc-6310-start="100" 
                      data-anc-6310-end="908" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                    </div>
                  </div>
                  <div class="anc-6310-counter-24-title">web design</div>
                </div>
              </div>  
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-24">
                  <div class="anc-6310-counter-24-content">
                    <div class="anc-6310-counter-24-icon"><i class="far fa-star"></i></div>
                     <div class="anc-6310-counter-24-count-number anc-6310-animated-counter-24 anc-6310-counter-number" 
                      id="anc-6310-24-2"
                      data-anc-6310-start="100" 
                      data-anc-6310-end="808" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                    </div>
                  </div>
                  <div class="anc-6310-counter-24-title">web design</div>
                </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-24">
                  <div class="anc-6310-counter-24-content">
                    <div class="anc-6310-counter-24-icon"><i class="fas fa-users"></i></div>
                     <div class="anc-6310-counter-24-count-number anc-6310-animated-counter-24 anc-6310-counter-number" 
                      id="anc-6310-24-3"
                      data-anc-6310-start="100" 
                      data-anc-6310-end="788" 
                      data-anc-6310-decimal="0" 
                      data-anc-6310-duration="2">
                    </div>
                  </div>
                  <div class="anc-6310-counter-24-title">web design</div>
                </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-24">
                  <div class="anc-6310-counter-24-content">
                    <div class="anc-6310-counter-24-icon"><i class="fas fa-list-alt"></i></div>
                    <div class="anc-6310-counter-24-count-number anc-6310-animated-counter-24 anc-6310-counter-number" 
                     id="anc-6310-24-4"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="600" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
                  </div>
                  <div class="anc-6310-counter-24-title">web design</div>
                </div>
              </div> 
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 24
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-24">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 24 end
    ****************************************** -->

                 <!-- ******************************************
      counter 25 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-25-paralax">
        <div class="anc-6310-counter-25-common-overlay">
          <div class="anc-6310-counter-25-wrap">
          <div class="anc-6310-counter-25-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-25">
                    <div class="anc-6310-counter-25-content">
                      <div class="anc-6310-counter-25-title">web design</div>
                      <div class="anc-6310-counter-25-count-number anc-6310-animated-counter-25 anc-6310-counter-number" 
                        id="anc-6310-25-1"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="600" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                    <div class="anc-6310-counter-25-icon">
                    <i class="fas fa-align-left"></i>
                    </div>
                  </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-25">
                    <div class="anc-6310-counter-25-content">
                      <div class="anc-6310-counter-25-title">web design</div>
                      <div class="anc-6310-counter-25-count-number anc-6310-animated-counter-25 anc-6310-counter-number" 
                        id="anc-6310-25-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="310" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                    <div class="anc-6310-counter-25-icon">
                    <i class="fas fa-cloud-download-alt"></i>
                    </div>
                  </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-25">
                    <div class="anc-6310-counter-25-content">
                      <div class="anc-6310-counter-25-title">web design</div>
                      <div class="anc-6310-counter-25-count-number anc-6310-animated-counter-25 anc-6310-counter-number" 
                        id="anc-6310-25-3"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="601" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                    <div class="anc-6310-counter-25-icon">
                    <i class="fas fa-archway"></i>
                    </div>
                  </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-25">
                    <div class="anc-6310-counter-25-content">
                      <div class="anc-6310-counter-25-title">web design</div>
                      <div class="anc-6310-counter-25-count-number anc-6310-animated-counter-25 anc-6310-counter-number" 
                        id="anc-6310-25-4"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="50" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                    <div class="anc-6310-counter-25-icon">
                    <i class="fa fa-rocket"></i>
                    </div>
                  </div>
              </div> 
          </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 25
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-25">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 25 end
    ****************************************** -->
    
                 <!-- ******************************************
      counter 26 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-26-paralax">
        <div class="anc-6310-counter-26-common-overlay">
          <div class="anc-6310-counter-26-wrap">
          <div class="anc-6310-counter-26-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-26">
                  <div class="anc-6310-counter-26-content">
                      <div class="anc-6310-counter-26-icon">
                      <i class="fa fa-briefcase"></i>
                      </div>
                      <div class="anc-6310-counter-26-count-number anc-6310-animated-counter-26 anc-6310-counter-number" 
                     id="anc-6310-26-1"
                     data-anc-6310-start="1000" 
                     data-anc-6310-end="350" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
                      <div class="anc-6310-counter-26-title">web design</div>
                  </div>
                </div>
              </div>   
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-26">
                  <div class="anc-6310-counter-26-content">
                      <div class="anc-6310-counter-26-icon">
                      <i class="fa fa-mobile"></i>
                      </div>
                      <div class="anc-6310-counter-26-count-number anc-6310-animated-counter-26 anc-6310-counter-number" 
                     id="anc-6310-26-2"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="600" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
                      <div class="anc-6310-counter-26-title">web design</div>
                  </div>
                </div>
              </div>   
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-26">
                  <div class="anc-6310-counter-26-content">
                      <div class="anc-6310-counter-26-icon">
                      <i class="fa fa-globe"></i>
                      </div>
                      <div class="anc-6310-counter-26-count-number anc-6310-animated-counter-26 anc-6310-counter-number" 
                     id="anc-6310-26-3"
                     data-anc-6310-start="0" 
                     data-anc-6310-end="60" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
                      <div class="anc-6310-counter-26-title">web design</div>
                  </div>
                </div>
              </div>   
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-26">
                  <div class="anc-6310-counter-26-content">
                      <div class="anc-6310-counter-26-icon">
                      <i class="fas fa-coffee"></i>
                      </div>
                      <div class="anc-6310-counter-26-count-number anc-6310-animated-counter-26 anc-6310-counter-number" 
                     id="anc-6310-26-4"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="590" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
                      <div class="anc-6310-counter-26-title">web design</div>
                  </div>
                </div>
              </div>        
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 26
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-26">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 26 end
    ****************************************** -->
                     <!-- ******************************************
      counter 27 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-27-paralax">
        <div class="anc-6310-counter-27-common-overlay">
          <div class="anc-6310-counter-27-wrap">
          <div class="anc-6310-counter-27-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-27">
                  <div class="anc-6310-counter-27-icon">
                  <i class="fas fa-wrench"></i>
                  </div>
                  <div class="anc-6310-counter-27-content">
                    <div class="anc-6310-counter-27-title">web design</div>
                    <div class="anc-6310-counter-27-count-number anc-6310-animated-counter-27 anc-6310-counter-number" 
                        id="anc-6310-27-1"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="310" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-27">
                  <div class="anc-6310-counter-27-icon">
                  <i class="fas fa-lightbulb"></i>
                  </div>
                  <div class="anc-6310-counter-27-content">
                    <div class="anc-6310-counter-27-title">web design</div>
                    <div class="anc-6310-counter-27-count-number anc-6310-animated-counter-27 anc-6310-counter-number" 
                        id="anc-6310-27-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="408" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-27">
                  <div class="anc-6310-counter-27-icon">
                  <i class="far fa-thumbs-up"></i>
                  </div>
                  <div class="anc-6310-counter-27-content">
                    <div class="anc-6310-counter-27-title">web design</div>
                    <div class="anc-6310-counter-27-count-number anc-6310-animated-counter-27 anc-6310-counter-number" 
                        id="anc-6310-27-3"
                        data-anc-6310-start="1000" 
                        data-anc-6310-end="410" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                  </div>
                </div>
              </div> 
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-27">
                  <div class="anc-6310-counter-27-icon">
                  <i class="fas fa-trophy"></i>
                  </div>
                  <div class="anc-6310-counter-27-content">
                    <div class="anc-6310-counter-27-title">web design</div>
                    <div class="anc-6310-counter-27-count-number anc-6310-animated-counter-27 anc-6310-counter-number" 
                        id="anc-6310-27-4"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="350" 
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
      Counter 27
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-27">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 27 end
    ****************************************** -->
                         <!-- ******************************************
      counter 28 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-28-paralax">
        <div class="anc-6310-counter-28-common-overlay">
          <div class="anc-6310-counter-28-wrap">
          <div class="anc-6310-counter-28-row">
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-28">
									<div class="anc-6310-counter-28-icon">
                  <i class="far fa-star"></i>
									</div>
                  <div class="anc-6310-counter-28-count-number anc-6310-animated-counter-28 anc-6310-counter-number" 
                     id="anc-6310-28-1"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="590" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
									<div class="anc-6310-counter-28-title">web design</div>
                 
								</div>
              </div>    
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-28">
									<div class="anc-6310-counter-28-icon">
                  <i class="fas fa-users"></i>
									</div>
								 <div class="anc-6310-counter-28-count-number anc-6310-animated-counter-28 anc-6310-counter-number" 
                     id="anc-6310-28-2"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="595" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
									<div class="anc-6310-counter-28-title">web design</div>
								</div>
              </div>   

              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-28">
									<div class="anc-6310-counter-28-icon">
											<i class="fa fa-globe"></i>
									</div>
								 <div class="anc-6310-counter-28-count-number anc-6310-animated-counter-28 anc-6310-counter-number" 
                     id="anc-6310-28-3"
                     data-anc-6310-start="1000" 
                     data-anc-6310-end="190" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
									<div class="anc-6310-counter-28-title">web design</div>
								</div>
              </div>   
              <div class="anc-6310-col-4">           
                <div class="anc-6310-counter-28">
									<div class="anc-6310-counter-28-icon">
                  <i class="fas fa-list-alt"></i>
									</div>
								 <div class="anc-6310-counter-28-count-number anc-6310-animated-counter-28 anc-6310-counter-number" 
                     id="anc-6310-28-4"
                     data-anc-6310-start="100" 
                     data-anc-6310-end="870" 
                     data-anc-6310-decimal="0" 
                     data-anc-6310-duration="2">
                   </div>
									<div class="anc-6310-counter-28-title">web design</div>
								</div>
              </div>   
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 28
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-28">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 28 end
    ****************************************** -->
                             <!-- ******************************************
      counter 29 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-29-paralax">
        <div class="anc-6310-counter-29-common-overlay">
          <div class="anc-6310-counter-29-wrap">
          <div class="anc-6310-counter-29-row">
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-29">
                      <div class="anc-6310-counter-29-content">
                        <div class="anc-6310-counter-29-count-number anc-6310-animated-counter-29 anc-6310-counter-number" 
                          id="anc-6310-29-1"
                          data-anc-6310-start="100" 
                          data-anc-6310-end="789" 
                          data-anc-6310-decimal="0" 
                          data-anc-6310-duration="2">
                        </div>
                          <div class="anc-6310-counter-29-title">web design</div>
                      </div>
                      <div class="anc-6310-counter-29-icon">
                        <i class="fa fa-globe"></i>
                      </div>
                  </div>
              </div>   
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-29">
                      <div class="anc-6310-counter-29-content">
                        <div class="anc-6310-counter-29-count-number anc-6310-animated-counter-29 anc-6310-counter-number" 
                          id="anc-6310-29-2"
                          data-anc-6310-start="100" 
                          data-anc-6310-end="456" 
                          data-anc-6310-decimal="0" 
                          data-anc-6310-duration="2">
                        </div>
                          <div class="anc-6310-counter-29-title">web design</div>
                      </div>
                      <div class="anc-6310-counter-29-icon">
                      <i class="fas fa-align-left"></i>
                      </div>
                  </div>
              </div> 
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-29">
                      <div class="anc-6310-counter-29-content">
                        <div class="anc-6310-counter-29-count-number anc-6310-animated-counter-29 anc-6310-counter-number" 
                          id="anc-6310-29-3"
                          data-anc-6310-start="100" 
                          data-anc-6310-end="123" 
                          data-anc-6310-decimal="0" 
                          data-anc-6310-duration="2">
                        </div>
                          <div class="anc-6310-counter-29-title">web design</div>
                      </div>
                      <div class="anc-6310-counter-29-icon">
                      <i class="fas fa-cloud-download-alt"></i>
                      </div>
                  </div>
              </div> 
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-29">
                      <div class="anc-6310-counter-29-content">
                        <div class="anc-6310-counter-29-count-number anc-6310-animated-counter-29 anc-6310-counter-number" 
                          id="anc-6310-29-4"
                          data-anc-6310-start="100" 
                          data-anc-6310-end="578" 
                          data-anc-6310-decimal="0" 
                          data-anc-6310-duration="2">
                        </div>
                          <div class="anc-6310-counter-29-title">web design</div>
                      </div>
                      <div class="anc-6310-counter-29-icon">
                      <i class="fas fa-archway"></i>
                      </div>
                  </div>
              </div>  
           
          </div>
        </div>
        </div>
      </div>
    </div>
    <div class="anc-6310-counter-list">
      Counter 29
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-29">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 29 end
    ****************************************** -->
      <!-- ******************************************
      counter 30 start
    ****************************************** -->
  <div class="anc-6310-row anc-6310-6310_number-counterstyle-boxed">
    <div class="anc-6310-padding-15">
      <div class="anc-6310-counter-30-paralax">
        <div class="anc-6310-counter-30-common-overlay">
          <div class="anc-6310-counter-30-wrap">
          <div class="anc-6310-counter-30-row">
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-30">
                    <div class="anc-6310-counter-30-icon">
                    <i class="fas fa-archway"></i>
                    </div>
                    <div class="anc-6310-counter-30-content">
                      <div class="anc-6310-counter-30-title">web design</div>
                      <div class="anc-6310-counter-30-count-number anc-6310-animated-counter-30 anc-6310-counter-number" 
                        id="anc-6310-30-1"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="870" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                  </div>
              </div>  
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-30">
                    <div class="anc-6310-counter-30-icon">
                    <i class="fa fa-rocket"></i>
                    </div>
                    <div class="anc-6310-counter-30-content">
                      <div class="anc-6310-counter-30-title">web design</div>
                      <div class="anc-6310-counter-30-count-number anc-6310-animated-counter-30 anc-6310-counter-number" 
                        id="anc-6310-30-2"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="987" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                  </div>
              </div>  
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-30">
                    <div class="anc-6310-counter-30-icon">
                    <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="anc-6310-counter-30-content">
                      <div class="anc-6310-counter-30-title">web design</div>
                      <div class="anc-6310-counter-30-count-number anc-6310-animated-counter-30 anc-6310-counter-number" 
                        id="anc-6310-30-3"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="654" 
                        data-anc-6310-decimal="0" 
                        data-anc-6310-duration="2">
                      </div>
                    </div>
                  </div>
              </div>  
              <div class="anc-6310-col-4">           
                  <div class="anc-6310-counter-30">
                    <div class="anc-6310-counter-30-icon">
                    <i class="fa fa-mobile"></i>
                    </div>
                    <div class="anc-6310-counter-30-content">
                      <div class="anc-6310-counter-30-title">web design</div>
                      <div class="anc-6310-counter-30-count-number anc-6310-animated-counter-30 anc-6310-counter-number" 
                        id="anc-6310-30-4"
                        data-anc-6310-start="100" 
                        data-anc-6310-end="321" 
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
      Counter 30
      <button type="button" class="anc-6310-btn-success anc_6310_choosen_style" id="counter-30">Create Counter</button>
    </div>
    <br class="anc-6310-clear" />
  </div>
  <!-- ******************************************
      counter 30 end
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