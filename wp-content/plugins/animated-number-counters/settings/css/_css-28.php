<style>
.anc-6310-counter-28-paralax {
  <?php
  if($bgType == 1) {
    echo "background: transparent;";
  } else if($bgType == 2) {
    echo "background-color: " . (isset($cssData['template_background_color']) ? $cssData['template_background_color'] : 'rgba(255, 255, 255, 0)') . ";";
  } else if($bgType == 3) {
    echo "background-image: url('" . (isset($cssData['box_background_image']) ? $cssData['box_background_image'] : 'rgba(255, 255, 255, 0)') . "');";
  }
  ?>
  position: relative;
  width: 100%;
  background-size: Cover;
  background-repeat: No-repeat;
  background-position: center center;
  background-attachment: fixed;
  overflow: hidden;
  text-align: center;
  font-size: 0;
}
.anc-6310-counter-28-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-28-common-overlay{
  overflow: hidden;
  font-size: 0;
  position: relative;
}

.anc-6310-counter-28-row {
  padding: 60px 10px 80px 15px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}


.anc-6310-counter-28{
  background: linear-gradient(-27deg,<?php echo $cssData['box_border_color_2']?> 50%,<?php echo $cssData['box_border_color']?> 51%);
  text-align: center;
  height: <?php echo $cssData['box_border_width']?>px;
  width: <?php echo $cssData['box_border_width']?>px;
  padding: 20px 20px;
  box-sizing: border-box;
  margin: 0 auto;
  position: relative;
  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
  transition: all 0.3s;
}
.anc-6310-counter-28:after{
  content: "";
  background: <?php echo $cssData['box_background_color']?>;
  position: absolute;
  top: 15px;
  left: 15px;
  right: 15px;
  bottom: 15px;
  z-index: -1;
  -webkit-clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
  clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
}
.anc-6310-counter-28:hover:after{
  background: <?php echo $cssData['box_background_hover_color']?>;
}
.anc-6310-counter-28:hover{
  background: linear-gradient(-27deg,<?php echo $cssData['box_border_hover_color']?> 50%,<?php echo $cssData['box_border_hover_color_2']?> 51%);

}
.anc-6310-counter-28-icon {
  color: <?php echo $cssData['icon_color'] ?>;
  font-size: <?php echo $cssData['icon_size'] ?>px;
  background: linear-gradient(-27deg,<?php echo $cssData['box_border_color_2']?> 49%,<?php echo $cssData['box_border_color']?> 50%);
  line-height: <?php echo $cssData['icon_background_height']?>px;
  width: <?php echo $cssData['icon_background_width']?>px;
  height: <?php echo $cssData['icon_background_height']?>px;
  margin: 0 auto <?php echo $cssData['icon_margin_bottom']?>px;
  border-radius: 0 0 15px 15px;
  box-shadow: 0 0 10px rgba(0,0,0,0.8);
  display: flex;
  justify-content: center;
  align-items: center;
}
.anc-6310-counter-28:hover .anc-6310-counter-28-icon i{
  color: <?php echo $cssData['icon_hover_color'] ?>;
  
}
.anc-6310-counter-28:hover .anc-6310-counter-28-number{ text-shadow: 2px 2px 0 #808080; }

@media screen and (max-width:990px){
  .anc-6310-counter-28{ margin-bottom: 40px; }
}


.anc-6310-counter-28:hover{
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
}
.anc-6310-counter-28-icon img {
    border-radius: 50%;
}
.anc-6310-counter-20-icon img{
  transition: .8s;
  border-radius: 50%;
  margin-left: <?php echo $cssData['icon_margin_left'] ?>px;
  padding-right: <?php echo $cssData['icon_margin_right'] ?>px;
  margin-top: <?php echo $cssData['icon_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['icon_margin_bottom'] ?>px;
}
.anc-6310-counter-20:hover .anc-6310-counter-20-icon i, .anc-6310-counter-20:hover .anc-6310-counter-20-icon img{
  color: <?php echo $cssData['icon_hover_color'] ?>;
  border-right: 2px solid <?php echo $cssData['icon_border_right_hover_color'] ?>;
}
.anc-6310-counter-28-inner-wrap {
    float: left;
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.anc-6310-counter-28-number {
  letter-spacing: 2px;
  width: inherit;
  display: inline-block;
  font-size: <?php echo $cssData['number_font_size'] ?>px;
  color: <?php echo $cssData['number_font_color'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  text-align: center;
  line-height: <?php echo $cssData['number_line_height'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  padding-top: <?php echo $cssData['number_margin_top'] ?>px;
  padding-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
}
.anc-6310-counter-28:hover .anc-6310-counter-28-number{
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-28-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-28:hover .anc-6310-counter-28-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-28-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-28:hover .anc-6310-counter-28-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-28-title {
  letter-spacing: 2px;
  float: left;
  font-size: <?php echo $cssData['title_font_size'] ?>px;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  color: <?php echo $cssData['title_font_color'] ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  text-align: center;
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  margin-top: <?php echo $cssData['title_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  word-wrap: break-word;
}
.anc-6310-counter-28:hover .anc-6310-counter-28-title {
  color: <?php echo $cssData['title_font_hover_color'] ?>;
}
</style>