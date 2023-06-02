<style>
  .anc-6310-counter-31-paralax {
    background: #dd6666;
    position: relative;
    width: 100%;
    overflow: hidden;
    text-align: center;
    background-image: url("<?php echo $cssData['box_background_image'] ?>");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }

  .anc-6310-counter-31-row {
    padding: 75px 100px;
    overflow: hidden;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    width: 100%;
    box-sizing: border-box;
  }

  .anc-6310-counter-31-wrapper {
    float: left;
    width: 100%;
    height: 100%;
  }

  .anc-6310-counter-31 {
    position: relative;
    float: left;
    width: 100%;
    height: 100%;
    border-style: solid;
    border-width: <?php echo $cssData['box_border_width'] ?>px;
    border-color: <?php echo $cssData['box_border_color'] ?>;
    background-color: <?php echo $cssData['box_background_color'] ?>;
    box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_color'] ?>;
    transition: .5s;
  }

  .anc-6310-counter-31:hover {
    background-color: <?php echo $cssData['box_background_hover_color'] ?>;
    box-shadow: 0 0 <?php echo ($cssData['box_shadow_blur'] * 2) ?>px <?php echo $cssData['box_shadow_width'] ?>px <?php echo $cssData['box_shadow_hover_color'] ?>;
  }

  .anc-6310-counter-31::after {
    width: 43px;
    height: 43px;
    border-left: <?php echo $cssData['box_border_width'] ?>px solid  <?php echo $cssData['box_border_hover_color'] ?>;
    border-top: <?php echo $cssData['box_border_width'] ?>px solid  <?php echo $cssData['box_border_hover_color'] ?>;
    content: "";
    position: absolute;
    left: -<?php echo ($cssData['box_border_width'] ) ?>px;
    top:-<?php echo ($cssData['box_border_width'] ) ?>px;;
    transition: .5s;

  }

  .anc-6310-counter-31:hover::after {
    width: calc(100% + <?php echo $cssData['box_border_width'] ?>px);
    height: calc(100% + <?php echo $cssData['box_border_width'] ?>px);
  }

  .anc-6310-counter-31::before {
    width: 43px;
    height: 43px;
    border-right: <?php echo $cssData['box_border_width'] ?>px solid  <?php echo $cssData['box_border_hover_color'] ?>;
    border-bottom: <?php echo $cssData['box_border_width'] ?>px solid  <?php echo $cssData['box_border_hover_color'] ?>;
    content: "";
    position: absolute;
    right: -<?php echo ($cssData['box_border_width'] ) ?>px;
    bottom: -<?php echo ($cssData['box_border_width'] ) ?>px;
    transition: .5s;
  }

  .anc-6310-counter-31:hover::before {
    width: calc(100% + <?php echo $cssData['box_border_width'] ?>px);
    height: calc(100% + <?php echo $cssData['box_border_width'] ?>px);
  }

  .anc-6310-counter-31-icon {
  text-align: <?php echo $cssData['icon_text_align'] ?>;
  margin-left: <?php echo $cssData['icon_margin_left'] ?>px;
  margin-right: <?php echo $cssData['icon_margin_right'] ?>px;
  margin-top: <?php echo $cssData['icon_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['icon_margin_bottom'] ?>px;
}
.anc-6310-counter-31-icon i, .anc-6310-counter-31-icon img{
  color: <?php echo $cssData['icon_color'] ?>;
  font-size: <?php echo $cssData['icon_size'] ?>px;
  display: inline-block;
  vertical-align: middle;
  -webkit-transform: perspective(1px) translateZ(0);
  transform: perspective(1px) translateZ(0);
}


  .anc-6310-counter-31:hover .anc-6310-counter-31-icon {
    animation-duration: 3s;
    -webkit-animation-fill-mode: both;
    animation-fill-mode: both;
    animation-name: animtada;
  }

  .anc-6310-counter-31-number {
    font-size: 70px;
    font-family: 'Oswald', sans-serif;
    font-weight: 400;
    color: #7698ff;
    float: left;
    width: 100%;
    text-align: center;
  }


  @keyframes animtada {
    0% {
      transform: scale(1);
    }

    10%,
    20% {
      transform: scale(0.9) rotate(-3deg);
    }

    30%,
    50%,
    70%,
    90% {
      transform: scale(1.1) rotate(3deg);
    }

    40%,
    60%,
    80% {
      transform: scale(1.1) rotate(-3deg);
    }

    100% {
      transform: scale(1) rotate(0);
    }
  }

  @media only screen and (max-width: 767px) {
    .anc-6310-counter-31-row {
      display: inline-block;
    }
  }

  .anc-6310-counter-31-inner-wrap {
    float: left;
    width: 100%;
    text-align: center;
  }

  .anc-6310-counter-31-title {
    font-family: <?php echo str_replace("+", " ", $cssData['title_font_family']); ?>;
    font-weight: <?php echo $cssData['title_font_weight'] ?>;
    font-size: <?php echo $cssData['title_font_size'] ?>px;
    color: <?php echo $cssData['title_font_color'] ?>;
    text-transform: <?php echo $cssData['title_text_transform']; ?>;
    line-height: <?php echo $cssData['title_line_height'] ?>px;
    margin-top: <?php echo $cssData['title_margin_top'] ?>px;
    margin-bottom: <?php echo $cssData['title_margin_bottom'] ?>px;
    margin-left: <?php echo $cssData['title_margin_left'] ?>px;
    margin-right: <?php echo $cssData['title_margin_right'] ?>px;
    text-align: <?php echo $cssData['title_text_align'] ?>;
    word-break: break-word;
    padding: 0 5px;
  }

  .anc-6310-counter-31-count-content {
    margin-top: <?php echo $cssData['number_margin_top'] ?>px;
    margin-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
    margin-left: <?php echo $cssData['number_margin_left'] ?>px;
    margin-right: <?php echo $cssData['number_margin_right'] ?>px;
    text-align: <?php echo $cssData['number_text_align'] ?>;
  }

  .anc-6310-counter-31-count-content-inner {
    position: relative;
    display: inline-block;
    padding-bottom: 5px;
  }

  .anc-6310-counter-31-count-content-inner:after {
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

  .anc-6310-counter-31:hover .anc-6310-counter-31-count-content-inner:after {
    background-color: <?php echo $cssData['underline_background_hover_color'] ?>;
  }

  .anc-6310-counter-31-count-number {
    display: inline-block;
    font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
    font-weight: <?php echo $cssData['number_font_weight'] ?>;
    font-size: <?php echo $cssData['number_font_size'] ?>px;
    color: <?php echo $cssData['number_font_color'] ?>;
    line-height: <?php echo $cssData['number_line_height'] ?>px;
  }

  .anc-6310-counter-31:hover .anc-6310-counter-31-count-number {
    color: <?php echo $cssData['number_font_hover_color'] ?>;
  }

  .anc-6310-counter-31-count-prefix {
    display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block' : 'none' ?>;
    font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
    color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
    font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
    font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
    vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
    margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
    margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
  }

  .anc-6310-counter-31:hover .anc-6310-counter-31-count-prefix {
    color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  .anc-6310-counter-31-count-suffix {
    display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block' : 'none' ?>;
    font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
    color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
    font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
    font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
    vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
    margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
    margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
  }

  .anc-6310-counter-31:hover .anc-6310-counter-31-count-suffix {
    color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  .anc-6310-counter-31-description {
    font-size: <?php echo $cssData['description_font_size'] ?>px;
    line-height: <?php echo $cssData['description_line_height'] ?>px;
    color: <?php echo $cssData['description_font_color'] ?>;
    font-weight: <?php echo $cssData['description_font_weight'] ?>;
    text-transform: <?php echo $cssData['description_text_transform']; ?>;
    text-align: <?php echo $cssData['description_text_align'] ?>;
    font-family: <?php echo str_replace("+", " ", $cssData['description_font_family']); ?>;
    margin-top: <?php echo $cssData['description_margin_top'] ?>px;
    margin-bottom: <?php echo $cssData['description_margin_bottom'] ?>px;
    margin-left: <?php echo $cssData['description_margin_left'] ?>px;
    margin-right: <?php echo $cssData['description_margin_right'] ?>px;
    display: <?php echo isset($cssData['counter_description']) ? 'block' : 'none'; ?>;
    z-index: 1;
  }

  .anc-6310-counter-31:hover .anc-6310-counter-31-description {
    color: <?php echo $cssData['description_font_hover_color'] ?>;
  }

  .anc-6310-counter-31-button {
    display: <?php echo isset($cssData['counter_button']) && $cssData['counter_button'] !== '' ? (($cssData['counter_button']) ? 'block' : 'none') : 'none'; ?>;
    z-index: 1;
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

  .anc-6310-counter-31-button:hover {
    background-color: <?php echo $cssData['button_background_hover_color'] ?>;
    border-color: <?php echo $cssData['button_border_hover_color'] ?>;
  }

  .anc-6310-counter-31-button a {
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

  .anc-6310-counter-31-button:hover a {
    color: <?php echo $cssData['button_font_hover_color'] ?>;
  }

  .anc-6310-counter-31-count-content-inner {
    /* display: flex;
  justify-content: center; */
    float: left;
    width: 100%;
    text-align: <?php echo $cssData['number_text_align'] ?>;
  }
</style>