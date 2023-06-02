<style>
.anc-6310-counter-03 {
  position: relative;
  border-style: solid;
  background-color: <?php echo $cssData['box_background_color'] ?>;
  -webkit-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['box_radius'] ?>px;
  border-radius: <?php echo $cssData['box_radius'] ?>px;
  border-width: <?php echo $cssData['box_border_width'] ?>px;
  border-color: <?php echo $cssData['box_border_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_color'] ?>;  
  width: calc(100% - <?php echo $cssData['box_border_width'] * 2 ?>px);
  margin: 10px auto 0px;
  padding: 50px 0px 0px;
  letter-spacing: 0.11em;
  box-sizing: border-box;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  height: calc(100% - <?php echo $cssData['box_border_width'] ?>px);
}
.anc-6310-counter-03:hover {
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
}
.anc-6310-counter-03-paralax {
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
.anc-6310-counter-03-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-03-common-overlay{
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  overflow: hidden;
  font-size: 0;
  position: relative;
}
.anc-6310-counter-03-common-overlay:hover{
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
}
.anc-6310-counter-03-row{
  padding: 100px 50px 70px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.anc-6310-counter-03-row .anc-6310-col-1,
.anc-6310-counter-03-row .anc-6310-col-2,
.anc-6310-counter-03-row .anc-6310-col-3,
.anc-6310-counter-03-row .anc-6310-col-4,
.anc-6310-counter-03-row .anc-6310-col-5,
.anc-6310-counter-03-row .anc-6310-col-6 {
 margin-bottom: <?php echo (floor($cssData['icon_background_size'] / 2) + 30) ?>px !important;
}
.anc-6310-counter-03-featured-item {
  position: absolute;
  top: 0;
  left: calc(50% - <?php echo $cssData['icon_background_size']/2; ?>px);
  -moz-transform: translateY(-50%);
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}
.anc-6310-counter-03-featured-item span {
  background-color: <?php echo $cssData['icon_background_color'] ?>;
  width: <?php echo $cssData['icon_background_size'] ?>px;
  height: <?php echo $cssData['icon_background_size'] ?>px;
  line-height: <?php echo $cssData['icon_background_size'] ?>px;
  -webkit-border-radius: <?php echo $cssData['icon_background_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['icon_background_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['icon_background_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['icon_background_radius'] ?>px;
  border-radius: <?php echo $cssData['icon_background_radius'] ?>px;
  display: inline-block;
  text-align: center;
  overflow: hidden;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
  position: relative;
}
.anc-6310-counter-03-featured-item span:before {
  content: "";
  position: absolute;
  z-index: -1;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: <?php echo $cssData['icon_background_hover_color'] ?>;
  -webkit-transform: scale(0) rotate(45deg);
  transform: scale(0) rotate(45deg);
  -webkit-transition-property: transform;
  transition-property: transform;
  -webkit-transition-duration: 0.3s;
  transition-duration: 0.3s;
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-featured-item span:before {
  -webkit-transform: scale(1.5) rotate(45deg);
  transform: scale(1.5) rotate(45deg);
}
.anc-6310-counter-03-featured-item i, .anc-6310-counter-03-featured-item img {
  color: <?php echo $cssData['icon_color'] ?>;
  font-size: <?php echo $cssData['icon_size'] ?>px;
  width: auto;
  height: auto;
  line-height: <?php echo $cssData['icon_line_height'] ?>px;
  vertical-align: middle;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-featured-item i, .anc-6310-counter-03:hover .anc-6310-counter-03-featured-item img {
  color: <?php echo $cssData['icon_hover_color'] ?>;
}
.anc-6310-counter-03-count-content {
  text-align: <?php echo $cssData['number_text_align'] ?>;
}
.anc-6310-counter-03-count-number {
  display: inline-block;
  font-size: <?php echo $cssData['number_font_size'] ?>px;
  color: <?php echo $cssData['number_font_color'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  line-height: <?php echo $cssData['number_line_height'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  margin-top: <?php echo $cssData['number_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-count-number {
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-03-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-03-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-03-count-title {
  font-size: <?php echo $cssData['title_font_size'] ?>px;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  color: <?php echo $cssData['title_font_color'] ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  text-align: <?php echo $cssData['title_text_align'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  margin-top: <?php echo $cssData['title_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  word-break: break-word;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-count-title {
  color: <?php echo $cssData['title_font_hover_color'] ?>;
}
.anc-6310-counter-03-description{
  font-size: <?php echo isset($cssData['description_font_size']) && $cssData['description_font_size'] !== '' ? $cssData['description_font_size'] : 14; ?>px;
  line-height: <?php echo isset($cssData['description_line_height']) && $cssData['description_line_height'] !== '' ? $cssData['description_line_height'] : 15; ?>px;
  color: <?php echo isset($cssData['description_font_color']) && $cssData['description_font_color'] !== '' ? $cssData['description_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['description_font_weight']) && $cssData['description_font_weight'] !== '' ? $cssData['description_font_weight'] : 400; ?>;
  text-transform: <?php echo isset($cssData['description_text_transform']) && $cssData['description_text_transform'] !== '' ? $cssData['description_text_transform'] : 'capitalize'; ?>;
  text-align: <?php echo isset($cssData['description_text_align']) && $cssData['description_text_align'] !== '' ? $cssData['description_text_align'] : 'center'; ?>;
  font-family: <?php echo isset($cssData['description_font_family']) && $cssData['description_font_family'] !== '' ? str_replace("+", " ", $cssData['description_font_family']) : 'roboto'; ?>;
  margin-top: <?php echo isset($cssData['description_margin_top']) && $cssData['description_margin_top'] !== '' ? $cssData['description_margin_top'] : 15; ?>px;
  margin-bottom: <?php echo isset($cssData['description_margin_bottom']) && $cssData['description_margin_bottom'] !== '' ? $cssData['description_margin_bottom'] : 20; ?>px;
  margin-left: <?php echo isset($cssData['description_margin_left']) && $cssData['description_margin_left'] !== '' ? $cssData['description_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['description_margin_right']) && $cssData['description_margin_right'] !== '' ? $cssData['description_margin_right'] : 0; ?>px;
  display: <?php echo isset($cssData['counter_description']) && $cssData['counter_description'] !== '' ? (($cssData['counter_description']) ? 'block' : 'none') : 'none' ; ?>;
  word-break: break-word;
}
.anc-6310-counter-03:hover .anc-6310-counter-03-description{
  color: <?php echo isset($cssData['description_font_hover_color']) && $cssData['description_font_hover_color'] !== '' ? $cssData['description_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-03-button{
  outline: none;
  display: <?php echo isset($cssData['counter_button']) && $cssData['counter_button'] !== '' ? (($cssData['counter_button']) ? 'block' : 'none') : 'none' ; ?>;
  width: <?php echo isset($cssData['button_width']) && $cssData['button_width'] !== '' ? $cssData['button_width'] : 110; ?>px;
  background-color: <?php echo isset($cssData['button_background_color']) && $cssData['button_background_color'] !== '' ? $cssData['button_background_color'] : 'rgba(0, 158, 226, 1)'; ?>;
  text-align: <?php echo isset($cssData['button_text_align']) && $cssData['button_text_align'] !== '' ? $cssData['button_text_align'] : 'center'; ?>;
  border-width: <?php echo isset($cssData['button_border_width']) && $cssData['button_border_width'] !== '' ? $cssData['button_border_width'] : "0px"; ?>;
  border-style: solid;
  border-color: <?php echo isset($cssData['button_border_color']) && $cssData['button_border_color'] !== '' ? $cssData['button_border_color'] : 'rgb(255, 255, 255)'; ?>;
  border-radius: <?php echo isset($cssData['button_border_radius']) && $cssData['button_border_radius'] !== '' ? $cssData['button_border_radius'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['button_margin_top']) && $cssData['button_margin_top'] !== '' ? $cssData['button_margin_top'] : 25; ?>px;
  margin-bottom: <?php echo isset($cssData['button_margin_bottom']) && $cssData['button_margin_bottom'] !== '' ? $cssData['button_margin_bottom'] : 0; ?>px;
  <?php 
  if(isset($cssData['button_align']) && $cssData['button_align'] !== ''){
    if ($cssData['button_align'] == 'center') {
               echo "margin-left: auto; margin-right: auto;";
            } elseif ($cssData['button_align'] == 'right') {
               echo "margin-left: auto;";
            } elseif ($cssData['button_align'] == 'left') {
               echo "margin-right: auto;";
            }
  } else {
    echo "margin-left: auto; margin-right: auto;";
  }
  ?>
}
.anc-6310-counter-03-button:hover {
  background-color: <?php echo isset($cssData['button_background_hover_color']) && $cssData['button_background_hover_color'] !== '' ? $cssData['button_background_hover_color'] : 'rgba(7, 144, 204, 0.8)'; ?>;
  border-color: <?php echo isset($cssData['button_border_hover_color']) && $cssData['button_border_hover_color'] !== '' ? $cssData['button_border_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-03-button a{
  padding: 5px;
  color: <?php echo isset($cssData['button_font_color']) && $cssData['button_font_color'] !== '' ? $cssData['button_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-size: <?php echo isset($cssData['button_font_size']) && $cssData['button_font_size'] !== '' ? $cssData['button_font_size'] : 13; ?>px !important;
  line-height: <?php echo isset($cssData['button_line_height']) && $cssData['button_line_height'] !== '' ? $cssData['button_line_height'] : 25; ?>px;
  font-family: <?php echo isset($cssData['button_font_family']) && $cssData['button_font_family'] !== '' ? str_replace("+", " ", $cssData['button_font_family']) : 'arimo'; ?>;
  font-weight: <?php echo isset($cssData['button_font_weight']) && $cssData['button_font_weight'] !== '' ? $cssData['button_font_weight'] : 400; ?>;
  text-transform: <?php echo isset($cssData['button_text_transform']) && $cssData['button_text_transform'] !== '' ? $cssData['button_text_transform'] : 'uppercase'; ?>;
  text-decoration: none;
  word-break: break-word;
}
.anc-6310-counter-03-button:hover a {
  color: <?php echo isset($cssData['button_font_hover_color']) && $cssData['button_font_hover_color'] !== '' ? $cssData['button_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
</style>