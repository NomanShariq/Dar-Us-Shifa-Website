<style>
.anc-6310-counter-<?php echo $ids ?> {
  border-style: solid;
  font-family: Amaranth;
  letter-spacing: 0.11em;
  border-width: <?php echo $cssData['box_border_width'] ?>px;
  border-color: <?php echo $cssData['box_border_color'] ?>;
  background-color: <?php echo $cssData['box_background_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_color'] ?>;
  width: calc(100% - <?php echo $cssData['box_border_width'] * 2 ?>px);
  -webkit-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['box_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['box_radius'] ?>px;
  border-radius: <?php echo $cssData['box_radius'] ?>px;
  -webkit-transition: all 0.3s ease 0s;
  -moz-transition: all 0.3s ease 0s;
  -ms-transition: all 0.3s ease 0s;
  -o-transition: all 0.3s ease 0s;
  transition: all 0.3s ease 0s;
  height: 100%;
}
.anc-6310-counter-<?php echo $ids ?>:hover {
  background-color: <?php echo $cssData['box_background_hover_color'] ?>;
  border-color: <?php echo $cssData['box_border_hover_color'] ?>;
  box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-paralax {
  background-image: url("https://www.wpmart.org/wp-content/uploads/2020/counter/counter-02-background.jpeg");
  background-attachment: fixed;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
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
  padding: 110px 0 80px;
  overflow: hidden;
  font-size: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}
.anc-6310-counter-<?php echo $ids ?>-icon {
  text-align: <?php echo $cssData['icon_text_align'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-icon i{
  color: rgba(255, 255, 255, 1);
  font-size: 50px;
  margin-left: <?php echo $cssData['icon_margin_left'] ?>px;
  margin-right: <?php echo $cssData['icon_margin_right'] ?>px;
  margin-top: <?php echo $cssData['icon_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['icon_margin_bottom'] ?>px;
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
}
@-webkit-keyframes hvr-pulse {
  25% {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }
  75% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
}
@keyframes hvr-pulse {
  25% {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
  }
  75% {
    -webkit-transform: scale(0.9);
    transform: scale(0.9);
  }
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-icon i{
  color: rgba(255, 255, 255, 1);
  -webkit-animation-name: hvr-pulse;
  animation-name: hvr-pulse;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
.anc-6310-counter-<?php echo $ids ?>-count-content {
  margin-top: <?php echo $cssData['number_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  text-align: <?php echo $cssData['number_text_align'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-count-content-inner {
  position: relative;
  display: inline-block;
  padding-bottom: 5px;
}
.anc-6310-counter-<?php echo $ids ?>-count-content-inner:after{
  content: '';
  position: absolute;
  top: <?php echo $cssData['underline_margin_top'] ?>px;
  left: 0;
  right: 0;
  height: <?php echo $cssData['underline_height'] ?>px;
  -webkit-border-radius: <?php echo $cssData['underline_radius'] ?>px;
  -o-border-radius: <?php echo $cssData['underline_radius'] ?>px;
  -moz-border-radius: <?php echo $cssData['underline_radius'] ?>px;
  -ms-border-radius: <?php echo $cssData['underline_radius'] ?>px;
  border-radius: <?php echo $cssData['underline_radius'] ?>px;
  background-color: <?php echo $cssData['underline_background_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-content-inner:after {
  background-color: <?php echo $cssData['underline_background_hover_color'] ?>;
}
.anc-6310-counter-<?php echo $ids ?>-count-number {
  display: inline-block;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  font-size: 35px;
  color: rgb(255, 255, 255);
  line-height: <?php echo $cssData['number_line_height'] ?>px;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-number {
  color: rgb(255, 255, 255);
}
.anc-6310-counter-<?php echo $ids ?>-count-title {
  font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
  font-weight: <?php echo $cssData['title_font_weight'] ?>;
  font-size: 18px;
  color: rgb(255, 255, 255);
  text-transform: <?php echo $cssData['title_text_transform']; ?>;
  line-height: <?php echo $cssData['title_line_height'] ?>px;
  margin-top: <?php echo $cssData['title_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['title_margin_left'] ?>px;
  margin-right: <?php echo $cssData['title_margin_right'] ?>px;
  text-align: <?php echo $cssData['title_text_align'] ?>;
  word-break: break-word;
}
.anc-6310-counter-<?php echo $ids ?>:hover .anc-6310-counter-<?php echo $ids ?>-count-title {
  color: rgb(255, 255, 255);
}
</style>