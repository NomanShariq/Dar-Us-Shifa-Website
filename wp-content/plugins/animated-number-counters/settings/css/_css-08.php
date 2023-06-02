<style>
.anc-6310-counter-08-row {
  padding: 90px 10px 60px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.anc-6310-counter-08-paralax {
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
.anc-6310-counter-08-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-08-common-overlay{
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  overflow: hidden;
  font-size: 0;
  position: relative;
}
.anc-6310-counter-08-common-overlay:hover{
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
}
.anc-6310-counter-08 {
  padding: 20px;
  background-color: <?php echo isset($cssData['box_background_color']) && $cssData['box_background_color'] !== '' ? $cssData['box_background_color'] : 'rgba(8, 72, 250, 0.7)'; ?>;
  border-radius: <?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>px;
  -webkit-border-radius: <?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>px;
  -o-border-radius: <?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>px;
  -moz-border-radius: <?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>px;
  -ms-border-radius: <?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>px;
  border-style: solid;
  border-width: <?php echo isset($cssData['box_border_width']) && $cssData['box_border_width'] !== '' ? $cssData['box_border_width'] : 0; ?>px;
  border-color: <?php echo isset($cssData['box_border_color']) && $cssData['box_border_color'] !== '' ? $cssData['box_border_color'] : 'rgba(255, 255, 255, 0)'; ?>;
  box-shadow: 0 0 <?php echo isset($cssData['box_shadow_blur']) && $cssData['box_shadow_blur'] !== '' ? ($cssData['box_shadow_blur'] * 2) : 0; ?>px <?php echo isset($cssData['box_shadow_width']) && $cssData['box_shadow_width'] !== '' ? $cssData['box_shadow_width'] : 0; ?>px <?php echo isset($cssData['box_shadow_color']) && $cssData['box_shadow_color'] !== '' ? $cssData['box_shadow_color'] : 'rgba(255, 255, 255, 0)'; ?>;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  height: calc(100% - 40px - 2 * <?php echo isset($cssData['box_border_width']) && $cssData['box_border_width'] !== '' ? $cssData['box_border_width'] : 0; ?>px);
}
.anc-6310-counter-08:hover {
  background-color: <?php echo isset($cssData['box_background_hover_color']) && $cssData['box_background_hover_color'] !== '' ? $cssData['box_background_hover_color'] : 'rgba(9, 76, 249, 0.85)'; ?>;
  border-color: <?php echo isset($cssData['box_border_hover_color']) && $cssData['box_border_hover_color'] !== '' ? $cssData['box_border_hover_color'] : 'rgba(255, 255, 255, 0)'; ?>;
  box-shadow: 0 0 <?php echo isset($cssData['box_shadow_blur']) && $cssData['box_shadow_blur'] !== '' ? ($cssData['box_shadow_blur'] * 2) : 0; ?>px <?php echo isset($cssData['box_shadow_width']) && $cssData['box_shadow_width'] !== '' ? $cssData['box_shadow_width'] : 0; ?>px <?php echo isset($cssData['box_shadow_hover_color']) && $cssData['box_shadow_hover_color'] !== '' ? $cssData['box_shadow_hover_color'] : 'rgba(255, 255, 255, 0)'; ?>;
}
.anc-6310-counter-08-icon {
  text-align: <?php echo isset($cssData['icon_text_align']) && $cssData['icon_text_align'] !== '' ? $cssData['icon_text_align'] : 'left'; ?>;
}
@-webkit-keyframes hvr-icon-pulse-shrink {
  to {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }
}
@keyframes hvr-icon-pulse-shrink {
  to {
    -webkit-transform: scale(0.8);
    transform: scale(0.8);
  }
}
.anc-6310-counter-08-icon i, .anc-6310-counter-08-icon img {
  font-size: <?php echo isset($cssData['icon_size']) && $cssData['icon_size'] !== '' ? $cssData['icon_size'] : 40; ?>px;
  color: <?php echo isset($cssData['icon_color']) && $cssData['icon_color'] !== '' ? $cssData['icon_color'] : 'rgba(255,169,35, 1)'; ?>;
  margin-left: <?php echo isset($cssData['icon_margin_left']) && $cssData['icon_margin_left'] !== '' ? $cssData['icon_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['icon_margin_right']) && $cssData['icon_margin_right'] !== '' ? $cssData['icon_margin_right'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['icon_margin_top']) && $cssData['icon_margin_top'] !== '' ? $cssData['icon_margin_top'] : 0; ?>px;
  margin-bottom: <?php echo isset($cssData['icon_margin_bottom']) && $cssData['icon_margin_bottom'] !== '' ? $cssData['icon_margin_bottom'] : 0; ?>px;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
  display: inline-block;
}
.anc-6310-counter-08-icon img {
  margin-left: <?php echo isset($cssData['icon_margin_left']) && $cssData['icon_margin_left'] !== '' ? $cssData['icon_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['icon_margin_right']) && $cssData['icon_margin_right'] !== '' ? $cssData['icon_margin_right'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['icon_margin_top']) && $cssData['icon_margin_top'] !== '' ? $cssData['icon_margin_top'] : 0; ?>px;
  margin-bottom: <?php echo isset($cssData['icon_margin_bottom']) && $cssData['icon_margin_bottom'] !== '' ? $cssData['icon_margin_bottom'] : 0; ?>px;
  -webkit-transform: translateZ(0);
  transform: translateZ(0);
  -webkit-transition-timing-function: ease-out;
  transition-timing-function: ease-out;
  display: inline-block;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-icon i, .anc-6310-counter-08:hover .anc-6310-counter-08-icon img{
  color: <?php echo isset($cssData['icon_hover_color']) && $cssData['icon_hover_color'] !== '' ? $cssData['icon_hover_color'] : 'rgb(255,169,35, 1)'; ?>;
  -webkit-animation-name: hvr-icon-pulse-shrink;
  animation-name: hvr-icon-pulse-shrink;
  -webkit-animation-duration: 0.3s;
  animation-duration: 0.3s;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
  -webkit-animation-direction: alternate;
  animation-direction: alternate;
}
.anc-6310-counter-08-count-content {
  text-align: <?php echo isset($cssData['number_text_align']) && $cssData['number_text_align'] !== '' ? $cssData['number_text_align'] : 'left'; ?>;
  margin-left: <?php echo isset($cssData['icon_margin_left']) && $cssData['icon_margin_left'] !== '' ? $cssData['number_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_margin_right']) && $cssData['number_margin_right'] !== '' ? $cssData['number_margin_right'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['number_margin_top']) && $cssData['number_margin_top'] !== '' ? $cssData['number_margin_top'] : 20; ?>px;
  margin-bottom: <?php echo isset($cssData['number_margin_bottom']) && $cssData['number_margin_bottom'] !== '' ? $cssData['number_margin_bottom'] : 0; ?>px;
}
.anc-6310-counter-08-number {
  font-size: <?php echo isset($cssData['number_font_size']) && $cssData['number_font_size'] !== '' ? $cssData['number_font_size'] : 32; ?>px;
  line-height: <?php echo isset($cssData['number_line_height']) && $cssData['number_line_height'] !== '' ? $cssData['number_line_height'] : 32; ?>px;
  color: <?php echo isset($cssData['number_font_color']) && $cssData['number_font_color'] !== '' ? $cssData['number_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-family: <?php echo isset($cssData['number_font_family']) && $cssData['number_font_family'] !== '' ? str_replace("+", " ", $cssData['number_font_family']) : 'Amaranth'; ?>;
  font-weight: <?php echo isset($cssData['number_font_weight']) && $cssData['number_font_weight'] !== '' ? $cssData['number_font_weight'] : '700'; ?>;
  display: inline-block;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-number{
  color: <?php echo isset($cssData['number_font_hover_color']) && $cssData['number_font_hover_color'] !== '' ? $cssData['number_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-08-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-08-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-08-count-title {
  font-size: <?php echo isset($cssData['title_font_size']) && $cssData['title_font_size'] !== '' ? $cssData['title_font_size'] : 25; ?>px;
  line-height: <?php echo isset($cssData['title_line_height']) && $cssData['title_line_height'] !== '' ? $cssData['title_line_height'] : 25; ?>px;
  color: <?php echo isset($cssData['title_font_color']) && $cssData['title_font_color'] !== '' ? $cssData['title_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['title_font_weight']) && $cssData['title_font_weight'] !== '' ? $cssData['title_font_weight'] : '700'; ?>;
  text-transform: <?php echo isset($cssData['title_text_transform']) && $cssData['title_text_transform'] !== '' ? $cssData['title_text_transform'] : 'capitalize'; ?>;
  font-family: <?php echo isset($cssData['title_font_family']) && $cssData['title_font_family'] !== '' ? str_replace("+", " ", $cssData['title_font_family']) : 'Vollkorn'; ?>;
  text-align: <?php echo isset($cssData['title_text_align']) && $cssData['title_text_align'] !== '' ? $cssData['title_text_align'] : 'left'; ?>;
  margin-left: <?php echo isset($cssData['title_margin_left']) && $cssData['title_margin_left'] !== '' ? $cssData['title_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['title_margin_right']) && $cssData['title_margin_right'] !== '' ? $cssData['title_margin_right'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['title_margin_top']) && $cssData['title_margin_top'] !== '' ? $cssData['title_margin_top'] : 5; ?>px;
  margin-bottom: <?php echo isset($cssData['title_margin_bottom']) && $cssData['title_margin_bottom'] !== '' ? $cssData['title_margin_bottom'] : 15; ?>px;
  word-break: break-word;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-count-title {
  color: <?php echo isset($cssData['title_font_hover_color']) && $cssData['title_font_hover_color'] !== '' ? $cssData['title_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-08-count-description {
  font-size: <?php echo isset($cssData['description_font_size']) && $cssData['description_font_size'] !== '' ? $cssData['description_font_size'] : 14; ?>px;
  line-height: <?php echo isset($cssData['description_line_height']) && $cssData['description_line_height'] !== '' ? $cssData['description_line_height'] : 14; ?>px;
  color: <?php echo isset($cssData['description_font_color']) && $cssData['description_font_color'] !== '' ? $cssData['description_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['description_font_weight']) && $cssData['description_font_weight'] !== '' ? $cssData['description_font_weight'] : '400'; ?>;
  text-transform: <?php echo isset($cssData['description_text_transform']) && $cssData['description_text_transform'] !== '' ? $cssData['description_text_transform'] : 'capitalize'; ?>;
  font-family: <?php echo isset($cssData['description_font_family']) && $cssData['description_font_family'] !== '' ? str_replace("+", " ", $cssData['description_font_family']) : "'Source Sans Pro', sans-serif"; ?>;
  text-align: <?php echo isset($cssData['description_text_align']) && $cssData['description_text_align'] !== '' ? $cssData['description_text_align'] : 'left'; ?>;
  margin-left: <?php echo isset($cssData['description_margin_left']) && $cssData['description_margin_left'] !== '' ? $cssData['description_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['description_margin_right']) && $cssData['description_margin_right'] !== '' ? $cssData['description_margin_right'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['description_margin_top']) && $cssData['description_margin_top'] !== '' ? $cssData['description_margin_top'] : 0; ?>px;
  margin-bottom: <?php echo isset($cssData['description_margin_bottom']) && $cssData['description_margin_bottom'] !== '' ? $cssData['description_margin_bottom'] : 15; ?>px;
  display: <?php echo isset($cssData['counter_description']) ? 'block' : 'none'; ?>;
  word-break: break-word;
}
.anc-6310-counter-08:hover .anc-6310-counter-08-count-description {
  color: <?php echo isset($cssData['description_font_hover_color']) && $cssData['description_font_hover_color'] !== '' ? $cssData['description_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-08-button{
  outline: none;
  display: <?php echo isset($cssData['counter_button']) && $cssData['counter_button'] !== '' ? (($cssData['counter_button']) ? 'block' : 'none') : 'none' ; ?>;
  width: <?php echo isset($cssData['button_width']) && $cssData['button_width'] !== '' ? $cssData['button_width'] : 110; ?>px;
  background-color: <?php echo isset($cssData['button_background_color']) && $cssData['button_background_color'] !== '' ? $cssData['button_background_color'] : 'rgba(0, 158, 226, 1)'; ?>;
  text-align: <?php echo isset($cssData['button_text_align']) && $cssData['button_text_align'] !== '' ? $cssData['button_text_align'] : 'center'; ?>;
  border-width: <?php echo isset($cssData['button_border_width']) && $cssData['button_border_width'] !== '' ? $cssData['button_border_width'] : "0px"; ?>;
  border-style: solid;
  border-color: <?php echo isset($cssData['button_border_color']) && $cssData['button_border_color'] !== '' ? $cssData['button_border_color'] : 'rgb(255, 255, 255)'; ?>;
  border-radius: <?php echo isset($cssData['button_border_radius']) && $cssData['button_border_radius'] !== '' ? $cssData['button_border_radius'] : 0; ?>px;
  margin-top: <?php echo isset($cssData['button_margin_top']) && $cssData['button_margin_top'] !== '' ? $cssData['button_margin_top'] : 20; ?>px;
  margin-bottom: <?php echo isset($cssData['button_margin_bottom']) && $cssData['button_margin_bottom'] !== '' ? $cssData['button_margin_bottom'] : 10; ?>px;
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
.anc-6310-counter-08-button:hover {
  background-color: <?php echo isset($cssData['button_background_hover_color']) && $cssData['button_background_hover_color'] !== '' ? $cssData['button_background_hover_color'] : 'rgba(7, 144, 204, 0.8)'; ?>;
  border-color: <?php echo isset($cssData['button_border_hover_color']) && $cssData['button_border_hover_color'] !== '' ? $cssData['button_border_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  cursor: pointer;
}
.anc-6310-counter-08-button a{
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
.anc-6310-counter-08-button:hover a {
  color: <?php echo isset($cssData['button_font_hover_color']) && $cssData['button_font_hover_color'] !== '' ? $cssData['button_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
</style>