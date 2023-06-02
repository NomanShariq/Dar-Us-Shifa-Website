<style>
.anc-6310-counter-<?php echo $ids ?> {
  display: block;
  float: left;
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
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  height: 100%;
}
.anc-6310-counter-<?php echo $ids ?>:hover {
  margin-top: -7px;
  margin-bottom: 7px;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-top-container {
  min-height: 210px;
  position: relative;
  background-size: cover;
  background-repeat: no-repeat;
  display: block;
}
.anc-6310-counter-<?php echo $ids ?>-top-container::before {
  content: '';
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-top-container::before {
  content: '';
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
}
.anc-6310-counter-<?php echo $ids ?>-count-title {
  position: relative;
  z-index: 1;
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  font-size: 30px;
  color: rgb(255, 255, 255);
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  padding-top: <?php echo $cssData['title_margin_top'] ?>px;
  padding-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  text-align: <?php echo $cssData['title_text_align'] ?>;
  word-break: break-word;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-title {
  color: rgb(255, 255, 255);
}
.anc-6310-counter-<?php echo $ids ?>-bottom-container{
  background-color: <?php echo $cssData['box_background_color'] ?>;
  padding: 65px 20px 20px;
  position: relative;
  height: 100%;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-bottom-container {
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-count-content{
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
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-content {
  background-color: <?php echo $cssData['number_background_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-count-content-inner{
  position: absolute;
  left: 0;
  right: 0;
  padding: 0 5px;
  text-align: center;
}
.anc-6310-counter-<?php echo $ids ?>-count-number {
  display: inline-block;
  font-size: 36px;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  color: rgb(255, 255, 255);
  line-height: <?php echo $cssData['number_box_size'] ?>px;
  margin-left: 0px;
  margin-right: 0px;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-number {
  color: rgb(255, 255, 255);
}
.anc-6310-counter-<?php echo $ids ?>-count-subtitle{
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
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-subtitle {
  color: <?php echo $cssData['description_font_hover_color'] ?>;
}
</style>