<style>
.anc-6310-counter-<?php echo $ids ?> {
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
  margin: 10px auto 10px;
  padding: 50px 0px 30px;
  letter-spacing: 0.11em;
  box-sizing: border-box;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  height: calc(100% - 20px);
}
.anc-6310-counter-<?php echo $ids ?>:hover {
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-paralax {
  background-image: url("https://www.wpmart.org/wp-content/uploads/2020/12/counter-03-background.jpg");
  background-size: Cover;
  background-repeat: No-repeat;
  background-position: center center;
  background-attachment: fixed;
  overflow: hidden;
  font-size: 0;
  width: 100%;
}
.anc-6310-counter-<?php echo $ids ?>-common-overlay{
  background-color: <?php echo $cssData['image_overlay_color'] ?>;
  overflow: hidden;
  font-size: 0;
}
.anc-6310-counter-<?php echo $ids ?>-common-overlay:hover{
  background-color: <?php echo $cssData['image_overlay_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-row{
  padding: 100px 50px 70px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.anc-6310-counter-<?php echo $ids ?>-featured-item {
  position: absolute;
  top: 0;
  left: calc(50% - <?php echo $cssData['icon_background_size']/2; ?>px);
  -moz-transform: translateY(-50%);
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
}
.anc-6310-counter-<?php echo $ids ?>-featured-item span {
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
.anc-6310-counter-<?php echo $ids ?>-featured-item span:before {
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
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-featured-item span:before {
  -webkit-transform: scale(1.5) rotate(45deg);
  transform: scale(1.5) rotate(45deg);
}
.anc-6310-counter-<?php echo $ids ?>-featured-item i {
  color: rgba(255, 255, 255, 1);
  font-size: 40px;
  width: auto;
  height: auto;
  line-height: <?php echo $cssData['icon_line_height'] ?>px;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-featured-item i {
  color: rgba(255, 255, 255, 1);
}
.anc-6310-counter-<?php echo $ids ?>-count-content {
  text-align: <?php echo $cssData['number_text_align'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-count-number {
  display: inline-block;
  font-size: 40px;
  color: rgb(255, 255, 255);
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  line-height: <?php echo $cssData['number_line_height'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  margin-top: <?php echo $cssData['number_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-number {
  color: rgb(255, 255, 255);
}
.anc-6310-counter-<?php echo $ids ?>-count-title {
  font-size: 24px;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  color: rgb(255, 255, 255);
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
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-title {
  color: rgb(255, 255, 255);
}
</style>