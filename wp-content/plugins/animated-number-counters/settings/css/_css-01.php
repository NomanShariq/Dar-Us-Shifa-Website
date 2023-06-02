<style>
.anc-6310-counter-row{
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.anc-6310-counter-01-paralax{
  <?php
  if($bgType == 1) {
    echo "background: transparent;";
  } else if($bgType == 2) {
    echo "background-color: " . (isset($cssData['template_background_color']) ? $cssData['template_background_color'] : 'rgba(255, 255, 255, 0)') . ";";
  } else if($bgType == 3) {
    echo "background-image: url('" . (isset($cssData['box_background_image']) ? $cssData['box_background_image'] : 'rgba(255, 255, 255, 0)') . "');";
  }
  ?>
  background-size: Cover;
  background-repeat: No-repeat;
  background-position: center center;
  background-attachment: fixed;
  overflow: hidden;
  font-size: 0;
}
.anc-6310-counter-01-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-01-common-overlay{
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  overflow: hidden;
  font-size: 0;
  position: relative;
  padding-top: 30px;
}
.anc-6310-counter-01 {
  width: calc(100% - <?php echo $cssData['box_border_width'] * 2 ?>px);
  overflow: hidden;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_color'] ?>;
  font-family: Amaranth;
  letter-spacing: 0.11em;
  -webkit-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['box_radius'] ?>px;
  border-radius: <?php echo $cssData['box_radius'] ?>px;
  border-style: solid;
  border-width: <?php echo $cssData['box_border_width'] ?>px;
  border-color: <?php echo $cssData['box_border_color'] ?>;
  height: calc(100% - 2 * <?php echo $cssData['box_border_width'] ?>px);
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
}
.anc-6310-counter-01:hover {
  margin-top: -7px;
  margin-bottom: 7px;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
}
.anc-6310-counter-01-top-container {
  min-height: 210px;
  position: relative;
  background-size: cover;
  background-repeat: no-repeat;
  display: block;
}
.anc-6310-counter-01-top-container::before {
  content: '';
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-top-container::before {
  content: '';
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
.anc-6310-counter-01-count-title {
  position: relative;
  z-index: 1;
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  font-size: <?php echo $cssData['title_font_size'] ?>px;
  color: <?php echo $cssData['title_font_color'] ?>;
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  padding-top: <?php echo $cssData['title_margin_top'] ?>px;
  padding-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  text-align: <?php echo $cssData['title_text_align'] ?>;
  word-break: break-word;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-title {
  color: <?php echo $cssData['title_font_hover_color'] ?>;
}
.anc-6310-counter-01-bottom-container{
  background-color: <?php echo $cssData['box_background_color'] ?>;
  padding: 65px 20px 20px;
  position: relative;
  height: 100%;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-bottom-container {
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
}
.anc-6310-counter-01-count-content{
  position: absolute;
  top: -<?php echo ($cssData['number_box_size'])/2; ?>px;
  left: calc(50% - <?php echo $cssData['number_box_size']/2; ?>px);
  width: <?php echo $cssData['number_box_size'] ?>px;
  height: <?php echo $cssData['number_box_size'] ?>px;
  background-color: <?php echo $cssData['number_background_color'] ?>;
  -webkit-border-radius: <?php echo $cssData['number_box_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['number_box_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['number_box_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['number_box_radius'] ?>px;
  border-radius: <?php echo $cssData['number_box_radius'] ?>px;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-content {
  background-color: <?php echo $cssData['number_background_hover_color'] ?>;
}
.anc-6310-counter-01-count-content-inner{
  position: absolute;
  left: 0;
  right: 0;
  padding: 0 5px;
  text-align: center;
}
.anc-6310-counter-01-count-number{
  display: inline-block;
  font-size: <?php echo $cssData['number_font_size'] ?>px;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  color: <?php echo $cssData['number_font_color'] ?>;
  line-height: <?php echo $cssData['number_box_size'] ?>px;
  margin-left: <?php echo isset($cssData['number_margin_left']) && $cssData['number_margin_left'] !== '' ? $cssData['number_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_margin_right']) && $cssData['number_margin_right'] !== '' ? $cssData['number_margin_right'] : 0; ?>px;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-number {
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-01-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-01-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-01-count-subtitle{
  display: <?php echo (isset($cssData['counter_description']) && $cssData['counter_description']) ? 'block': 'none' ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['description_font_family']); ?>;
  font-weight: <?php echo $cssData['description_font_weight'] ?>;
  font-size: <?php echo $cssData['description_font_size'] ?>px;
  color: <?php echo $cssData['description_font_color'] ?>;
  line-height: <?php echo $cssData['description_line_height'] ?>px;
  text-align: <?php echo $cssData['description_text_align'] ?>;
  text-transform: <?php echo $cssData['description_text_transform']; ?>;
  margin-top: <?php echo isset($cssData['description_margin_top']) && $cssData['description_margin_top'] !== '' ? $cssData['description_margin_top'] : 10; ?>px;
  margin-bottom: <?php echo $cssData['description_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['description_margin_left'] ?>px;
  margin-right: <?php echo $cssData['description_margin_right'] ?>px;
  word-break: break-word;
}
.anc-6310-counter-01:hover .anc-6310-counter-01-count-subtitle {
  color: <?php echo $cssData['description_font_hover_color'] ?>;
}
.anc-6310-counter-01-button{
  display: <?php echo isset($cssData['counter_button']) && $cssData['counter_button'] !== '' ? (($cssData['counter_button']) ? 'block' : 'none') : 'none' ; ?>;
  width: <?php echo isset($cssData['button_width']) && $cssData['button_width'] !== '' ? $cssData['button_width'] : 150; ?>px;
  background-color: <?php echo $cssData['button_background_color'] ?>;
  text-align: <?php echo $cssData['button_text_align'] ?>;
  outline: none;
  border: <?php echo $cssData['button_border_width'] ?> solid <?php echo $cssData['button_border_color'] ?>;
  border-radius: <?php echo $cssData['button_border_radius'] ?>px;
  margin-top: <?php echo $cssData['button_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['button_margin_bottom'] ?>px;
  <?php if ($cssData['button_align'] == 'center') {
               echo "margin-left: auto; margin-right: auto;";
            } elseif ($cssData['button_align'] == 'right') {
               echo "margin-left: auto;";
            } elseif ($cssData['button_align'] == 'left') {
               echo "margin-right: auto;";
            }
  ?>
}
.anc-6310-counter-01-button:hover {
  background-color: <?php echo $cssData['button_background_hover_color'] ?>;
  border-color: <?php echo $cssData['button_border_hover_color'] ?>;
}
.anc-6310-counter-01-button a{
  padding: 5px;
  color: <?php echo $cssData['button_font_color'] ?>;
  line-height: <?php echo $cssData['button_line_height'] ?>px;
  font-family: <?php echo str_replace("+", " ", $cssData['button_font_family']); ?>;
  font-weight: <?php echo $cssData['button_font_weight'] ?>;
  font-size: <?php echo $cssData['button_font_size'] ?>px !important;
  text-transform: <?php echo $cssData['button_text_transform']; ?>;
  text-decoration: none;
  display: block;
}
.anc-6310-counter-01-button:hover a {
  color: <?php echo $cssData['button_font_hover_color'] ?>;
}
</style>