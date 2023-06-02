<style>
  .anc-6310-counter-32-row {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
  }

  .anc-6310-counter-32-paralax {
    background-image: url("https://i.pinimg.com/originals/3b/8a/d2/3b8ad2c7b1be2caf24321c852103598a.jpg");
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    width: 100%;
  }

  .anc-6310-counter-32-wrapper {
    float: left;
    width: 100%;
    height: 100%;
    padding: 20px;
    box-sizing: border-box;
    /* display: flex; */
  }

  .anc-6310-counter-32 {
    float: left;
    width: 100%;
    background: rgba(11, 235, 205, 0.152);
    margin-top: 15px;
    /* display: flex; */
    /* flex-direction: column; */
    height: 100%;
  }

  .anc-6310-counter-32-icon {
    float: left;
    width: 100px;
    height: 100px;
    border: 2px solid rgb(255, 255, 255);
    transform: rotate(45deg);
    margin: 25px 0;
    position: relative;
    transition: .5s;
  }

  .anc-6310-counter-32-icon-wrapper {
    float: left;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .anc-6310-counter-32-count-content-inner {
    display: flex;
    justify-content: <?php echo $cssData['number_text_align']?>;
    float: left;
    width: 100%;
  }

  .anc-6310-counter-32-icon i {
    transform: rotate(-45deg);
    width: 100%;
    height: 100%;
    display: block;
    line-height: 100px;
    text-align: center;
    font-size: 30px;
    color: #ffff;
    transition: .5s;
  }

  .anc-6310-counter-32-number {
    float: left;
    /* width: 100%; */
    text-align: center;
    font-size: 30px;
    line-height: 30px;
    color: #fff;
  }

  /* .anc-6310-counter-32-title{
    float: left;
    width: 100%;
    text-align: center;
    font-size: 30px;
    line-height: 30px;
    font-family: cursive;
    font-weight: 300;
    margin-bottom: 4px;
    color: #fff;
    
  } */
  .anc-6310-counter-32-icon::before,
  .anc-6310-counter-32-icon::after {
    width: 100%;
    height: 100%;
    z-index: 3;
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    box-sizing: border-box;
    transform: scale(0);
    transition: 0.5s;
  }

  .anc-6310-counter-32:hover .anc-6310-counter-32-icon::after,
  .anc-6310-counter-32:hover .anc-6310-counter-32-icon::before {
    transform: scale(1);
  }

  .anc-6310-counter-32-icon::before {
    border-bottom: 3px solid #FFF;
    border-left: 3px solid #FFF;
    transform-origin: 100% 0%;
  }

  .anc-6310-counter-32-icon::after {
    border-top: 3px solid #FFF;
    border-right: 3px solid #FFF;
    transform-origin: 0% 100%;
  }

  .anc-6310-counter-32:hover .anc-6310-counter-32-icon {
    transform: scale(1.1) rotate(45deg);
    color: rgb(0, 255, 98);
  }

  /* .anc-6310-counter-32-count-content {
    text-align: <?php echo $cssData['number_text_align'] ?>;
  }

  .anc-6310-counter-32-count-number {
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

  .anc-6310-counter-32:hover .anc-6310-counter-32-count-number {
    color: <?php echo $cssData['number_font_hover_color'] ?>;
  }

  .anc-6310-counter-32-count-prefix {
    float: left;
    display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block' : 'none' ?>;
    font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
    color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
    font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
    font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
    vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
    margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
    margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
  }

  .anc-6310-counter-32:hover .anc-6310-counter-32-count-prefix {
    color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  .anc-6310-counter-32-count-suffix {
    float: left;
    display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block' : 'none' ?>;
    font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
    color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
    font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
    font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
    vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
    margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
    margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
  }

  .anc-6310-counter-32:hover .anc-6310-counter-32-count-suffix {
    color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  } */

  .anc-6310-counter-32-count-content {
  margin-top: <?php echo $cssData['number_margin_top'] ?>px;
  margin-bottom: <?php echo $cssData['number_margin_bottom'] ?>px;
  margin-left: <?php echo $cssData['number_margin_left'] ?>px;
  margin-right: <?php echo $cssData['number_margin_right'] ?>px;
  text-align: <?php echo $cssData['number_text_align'] ?>;
}
.anc-6310-counter-32-count-content-inner {
  position: relative;
  display: inline-block;
  padding-bottom: 5px;
}
.anc-6310-counter-32-count-content-inner:after{
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
.anc-6310-counter-32:hover .anc-6310-counter-32-count-content-inner:after {
  background-color: <?php echo $cssData['underline_background_hover_color'] ?>;
}
.anc-6310-counter-32-count-number {
  display: inline-block;
  font-family: <?php echo str_replace("+", " ", $cssData['number_font_family']); ?>;
  font-weight: <?php echo $cssData['number_font_weight'] ?>;
  font-size: <?php echo $cssData['number_font_size'] ?>px;
  color: <?php echo $cssData['number_font_color'] ?>;
  line-height: <?php echo $cssData['number_line_height'] ?>px;
}
.anc-6310-counter-32:hover .anc-6310-counter-32-count-number {
  color: <?php echo $cssData['number_font_hover_color'] ?>;
}
.anc-6310-counter-32-count-prefix {
  display: <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] !== '' ? $cssData['number_prefix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_prefix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-32:hover .anc-6310-counter-32-count-prefix {
  color: <?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}
.anc-6310-counter-32-count-suffix {
  display: <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? 'inline-block': 'none' ?>;
  font-size: <?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>px;
  color: <?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>;
  font-weight: <?php echo isset($cssData['number_suffix_font_weight']) && $cssData['number_suffix_font_weight'] !== '' ? $cssData['number_suffix_font_weight'] : '100'; ?>;
  font-family: <?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? str_replace("+", " ", $cssData['number_suffix_font_family']) : 'Amaranth'; ?>;
  vertical-align: <?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>px;
  margin-left: <?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>px;
  margin-right: <?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>px;
}
.anc-6310-counter-32:hover .anc-6310-counter-32-count-suffix {
  color: <?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
}

  .anc-6310-counter-32-count-title {
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

  .anc-6310-counter-32:hover .anc-6310-counter-32-count-title {
    color: <?php echo $cssData['title_font_hover_color'] ?>;
  }

  .anc-6310-counter-32-description {
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
    display: <?php echo isset($cssData['counter_description']) && $cssData['counter_description'] !== '' ? (($cssData['counter_description']) ? 'block' : 'none') : 'none'; ?>;
    word-break: break-word;
  }

  .anc-6310-counter-32:hover .anc-6310-counter-32-description {
    color: <?php echo isset($cssData['description_font_hover_color']) && $cssData['description_font_hover_color'] !== '' ? $cssData['description_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  .anc-6310-counter-32-button {
    outline: none;
    display: <?php echo isset($cssData['counter_button']) && $cssData['counter_button'] !== '' ? (($cssData['counter_button']) ? 'block' : 'none') : 'none'; ?>;
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
    if (isset($cssData['button_align']) && $cssData['button_align'] !== '') {
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

  .anc-6310-counter-32-button:hover {
    background-color: <?php echo isset($cssData['button_background_hover_color']) && $cssData['button_background_hover_color'] !== '' ? $cssData['button_background_hover_color'] : 'rgba(7, 144, 204, 0.8)'; ?>;
    border-color: <?php echo isset($cssData['button_border_hover_color']) && $cssData['button_border_hover_color'] !== '' ? $cssData['button_border_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  .anc-6310-counter-32-button a {
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

  .anc-6310-counter-32-button:hover a {
    color: <?php echo isset($cssData['button_font_hover_color']) && $cssData['button_font_hover_color'] !== '' ? $cssData['button_font_hover_color'] : 'rgb(255, 255, 255)'; ?>;
  }

  @media only screen and (max-width: 767px) {
    .anc-6310-counter-32-row {
      display: inline-block;
    }
  }
</style>