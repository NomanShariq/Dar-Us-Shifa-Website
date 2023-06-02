<style>
  .anc-6310-counter-26-row {
    display: flex;
    flex-wrap: wrap;
  }

 .anc-6310-counter-26{
  position: relative;
  z-index: 1;
  width: 100%;
  float: left;
  text-align: center;
  margin-top: 30px;
  background: <?php echo $cssData['box_background_color']?>;
  border-radius: <?php echo $cssData['box_radius']?>px;
  border: <?php echo $cssData['box_border_width']?>px solid;
  border-color: <?php echo $cssData['box_border_color']?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_color'] ?>;
  height: calc(100% - 30px);
  box-sizing: border-box;
  transition: .5s;
}
.anc-6310-counter-26-paralax{
  <?php
  if($bgType == 1) {
    echo "background: transparent;";
  } else if($bgType == 2) {
    echo "background-color: " . (isset($cssData['template_background_color']) ? $cssData['template_background_color'] : 'rgba(255, 255, 255, 0)') . ";";
  } else if($bgType == 3) {
    echo "background-image: url('" . (isset($cssData['box_background_image']) ? $cssData['box_background_image'] : 'rgba(255, 255, 255, 0)') . "');";
  }
  ?>
  float: left;
  width: 100%; 
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background: <?php echo $cssData['full_background_color']?>;
  overflow: hidden;
}

.anc-6310-counter-26-common-overlay iframe {
  position: absolute;
  top: -100%;
  left: 0;
  width: 100%;
  height: 300%;
  pointer-events: none;
  opacity: .7;
}
.anc-6310-counter-26-common-overlay{
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  font-size: 0;
  position: relative;
}
.anc-6310-counter-26-common-overlay:hover{
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
}
.anc-6310-counter-26:after{
  background-color: transparent;
  border-top: 10px dotted #EB4700;
  height: 2px;
  width: 80px;
  transform: translateX(-50%) translateY(0) rotate(0);
  top: auto;
  left: 50%;
  bottom: 0;
}
.anc-6310-counter-26-content{
  text-align: center; 
  padding: 20px;
  margin: 0 auto;
  width: 100%;
  box-sizing: border-box;
  transition: all 0.3s;
}
.anc-6310-counter-26:hover {
   box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
   background: <?php echo $cssData['box_background_hover_color']?>;
   border-color:<?php echo $cssData['box_border_hover_color']?>;
}

.anc-6310-counter-26-icon{
  font-size: 40px;
  line-height: 70px;
  overflow: hidden;
  height: 70px;
  width: 70px;
  box-shadow: 0 0 10px rgba(0,0,0,0.5);
  border-radius: 50%;
  margin-bottom: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 0 auto;
  transition: all 0.3s;
}
.anc-6310-counter-26:hover .anc-6310-counter-26-icon{ 
  transform: rotateX(360deg);
 background-color: <?php echo $cssData['icon_background_hover_color']?>;

}
.anc-6310-animated-counter-26{
  font-size: 40px;
  font-weight: 700;
  margin-bottom: 30px;
  transition: all 0.3s;
}
.anc-6310-counter-26-title{
  font-size: 20px;
  letter-spacing: 1px;
  text-transform: uppercase;
  margin: 0;
  transition: all 0.3s;
}



.anc-6310-counter-26-title{
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
}
.anc-6310-counter-26:hover .anc-6310-counter-26-title {
  color: <?php echo $cssData['title_font_hover_color'] ?>;
}
.anc-6310-counter-26-description{
  font-size: <?php echo isset($cssData['description_font_size']) && $cssData['description_font_size'] !== '' ? $cssData['description_font_size'] : 15; ?>px;
  line-height: <?php echo isset($cssData['description_line_height']) && $cssData['description_line_height'] !== '' ? $cssData['description_line_height'] : 15; ?>px;
  color: <?php echo isset($cssData['description_font_color']) && $cssData['description_font_color'] !== '' ? $cssData['description_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['description_font_weight']) && $cssData['description_font_weight'] !== '' ? $cssData['description_font_weight'] : 400; ?>;
  text-transform: <?php echo isset($cssData['description_text_transform']) && $cssData['description_text_transform'] !== '' ? $cssData['description_text_transform'] : 'capitalize'; ?>;
  text-align: <?php echo isset($cssData['description_text_align']) && $cssData['description_text_align'] !== '' ? $cssData['description_text_align'] : 'center'; ?>;
  font-family: <?php echo isset($cssData['description_font_family']) && $cssData['description_font_family'] !== '' ? str_replace("+", " ", $cssData['description_font_family']) : 'Vollkorn'; ?>;
  margin-top: <?php echo isset($cssData['description_margin_top']) && $cssData['description_margin_top'] !== '' ? $cssData['description_margin_top'] : 20; ?>px;
  margin-bottom: <?php echo isset($cssData['description_margin_bottom']) && $cssData['description_margin_bottom'] !== '' ? $cssData['description_margin_bottom'] : 20; ?>px;
  margin-left: <?php echo isset($cssData['description_margin_left']) && $cssData['description_margin_left'] !== '' ? $cssData['description_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['description_margin_right']) && $cssData['description_margin_right'] !== '' ? $cssData['description_margin_right'] : 0; ?>px;
  display: <?php echo isset($cssData['counter_description']) && $cssData['counter_description'] !== '' ? (($cssData['counter_description']) ? 'block' : 'none') : 'none' ; ?>;
  word-break: break-word;
}
.anc-6310-counter-26:hover .anc-6310-counter-26-description{
  color: <?php echo isset($cssData['description_font_hover_color']) && $cssData['description_font_hover_color'] !== '' ? $cssData['description_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}

.anc-6310-counter-26-icon{
 width: <?php echo $cssData['icon_background_size'] ?>px;
 height: <?php echo $cssData['icon_background_size'] ?>px;
 line-height: 100px;
 border-radius: 50%;
 background: <?php echo $cssData ['icon_background_color'] ?>;
 font-size: 50px;
 color: #fff;
 transition: .5s;
 display: flex;
 justify-content: center;
 align-items: center;
 margin: 0 auto;
}

.anc-6310-counter-26:hover .anc-6310-counter-26-icon i, .anc-6310-counter-26:hover .anc-6310-counter-26-icon img {
  transform: rotateY(360deg);
}

.anc-6310-counter-26-icon i, .anc-6310-counter-26-icon img{
  transition: .8s;
  color: <?php echo $cssData['icon_color']?>;
  font-size: <?php echo $cssData['icon_size']?>px;
  border-radius: 50%;
}

.anc-6310-counter-26:hover .anc-6310-counter-26-icon i, .anc-6310-counter-26:hover .anc-6310-counter-26-icon img{
  color: <?php echo $cssData['icon_hover_color'] ?>;
}
.anc-6310-counter-26-number {
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
.anc-6310-counter-26:hover .anc-6310-counter-26-number{
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-26-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-26:hover .anc-6310-counter-26-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-26-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-26:hover .anc-6310-counter-26-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-26-button{
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
  margin-right: 10px;
  margin-left: 10px;
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
.anc-6310-counter-26-button:hover {
  background-color: <?php echo isset($cssData['button_background_hover_color']) && $cssData['button_background_hover_color'] !== '' ? $cssData['button_background_hover_color'] : 'rgba(7, 144, 204, 0.8)'; ?>;
  border-color: <?php echo isset($cssData['button_border_hover_color']) && $cssData['button_border_hover_color'] !== '' ? $cssData['button_border_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-26-button a{
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
.anc-6310-counter-26-button:hover a {
  color: <?php echo isset($cssData['button_font_hover_color']) && $cssData['button_font_hover_color'] !== '' ? $cssData['button_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
@media screen and (max-width:990px){
  .anc-6310-counter-26{margin-bottom: 30px;}
}
</style>