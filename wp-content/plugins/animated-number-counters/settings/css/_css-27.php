<style>
.anc-6310-counter-27-paralax {
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
  text-align: center;
  font-size: 0;
  background-size: Cover;
  background-repeat: No-repeat;
  background-position: center center;
  background-attachment: fixed;
  overflow: hidden;
}

.anc-6310-counter-27-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-27-common-overlay {
  overflow: hidden;
  font-size: 0;
  position: relative;
}

.anc-6310-counter-27-row {
  padding: 60px 10px 80px 15px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}


.anc-6310-counter-27{ 
  text-align: center;
  padding-bottom: 70px;
  position: relative;
  z-index: 1;
}
.anc-6310-counter-27:before{
  content: '';
  background: <?php echo $cssData['box_background_color']?>;
  height: <?php echo $cssData['box_border_width']?>px;
  width: <?php echo $cssData['box_border_width']?>px;
  box-shadow: 0 0 10px <?php echo $cssData['box_border_color_3']?> inset,
              0 0 0 12px <?php echo $cssData['box_border_color_2']?>, 0 0 0 17px <?php echo $cssData['box_border_color']?>, 0 0 35px darkcyan;
  transform: translateX(-50%) rotate(45deg);
  position: absolute;
  left: 50%;
  top: 70px;
  z-index: -2;
}
.anc-6310-counter-27:hover:before{
  background: <?php echo $cssData['box_background_hover_color']?>;
  box-shadow: 0 0 10px <?php echo $cssData['box_border_hover_color_3']?> inset,
              0 0 0 12px <?php echo $cssData['box_border_hover_color_2']?>, 0 0 0 17px <?php echo $cssData['box_border_hover_color']?>, 0 0 35px darkcyan;
  transform: translateX(-50%) rotate(45deg);
  
}
.anc-6310-counter-27-icon{
  background: <?php echo $cssData['icon_background_color']?>; 
  color: <?php echo $cssData['icon_color'] ?>;
  font-size: <?php echo $cssData['icon_size'] ?>px;
  line-height: <?php echo $cssData['icon_background_size']?>px;
  height: <?php echo $cssData['icon_background_size']?>px;
  width: <?php echo $cssData['icon_background_size']?>px;
  margin: 0 auto <?php echo $cssData['icon_margin_bottom']?>px;
  border: <?php echo $cssData['icon_border_size']?>px solid <?php echo $cssData['icon_border_color']?>;
  border-radius: 50%;
  transition: all 0.3s ease 0s;
  display: flex;
  justify-content: center;
  align-items: center;
}
.anc-6310-counter-27-icon img{
  background: <?php echo $cssData['icon_background_color']?>; 
  border-radius: 50%;
  box-sizing: border-box;
  transition: all 0.3s ease 0s;
}
.anc-6310-counter-27:hover .anc-6310-counter-27-icon{
   transform: rotate(360deg);   
   color: <?php echo $cssData['icon_hover_color'] ?>;
   border: <?php echo $cssData['icon_border_size']?>px solid <?php echo $cssData['icon_border_hover_color']?>;
   background: <?php echo $cssData['icon_background_hover_color']?>; 
}

.anc-6310-counter-27:hover .anc-6310-counter-27-icon img{
   transform: rotate(360deg);   
}
.anc-6310-counter-27-number {
  letter-spacing: 2px;
  width: inherit;
  display: inline-block;
  font-size: <?php echo $cssData['number_font_size'] ?>px;
  color: <?php echo $cssData['number_font_color'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  text-align: left;
  line-height: <?php echo $cssData['number_line_height'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  padding-top: <?php echo $cssData['number_margin_top'] ?>px;
  padding-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
}
.anc-6310-counter-27:hover .anc-6310-counter-27-number{
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-27-title{
  font-size: <?php echo $cssData['title_font_size'] ?>px;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  color: <?php echo $cssData['title_font_color'] ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  margin-top: <?php echo $cssData['title_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  word-wrap: break-word;
  transition: all 0.3s ease 0s;
}
.anc-6310-counter-27:hover .anc-6310-counter-27-title {
  color: <?php echo $cssData['title_font_hover_color'] ?>;
}

@media screen and (max-width:990px){
  .anc-6310-counter-27{ margin-bottom: 40px; }
}

.anc-6310-counter-27:hover .anc-6310-counter-27-icon i, .anc-6310-counter-27:hover .anc-6310-counter-27-icon img{
  color: <?php echo $cssData['icon_hover_color'] ?>;
}
.anc-6310-counter-27-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-27:hover .anc-6310-counter-27-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-27-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-27:hover .anc-6310-counter-27-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
</style>