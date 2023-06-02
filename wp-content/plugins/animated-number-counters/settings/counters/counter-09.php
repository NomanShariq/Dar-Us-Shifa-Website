<div class="anc-6310-6310">
  <div class="anc-6310-sm">
  <br class="anc-6310-clear" />
    <?php
    include anc_6310_plugin_url . 'settings/helper/number-counter-save.php';
    if (!empty($_POST['update_style_change']) && $_POST['update_style_change'] == 'Save' && $_POST['id'] != '') {
      $nonce = $_REQUEST['_wpnonce'];
      if (!wp_verify_nonce($nonce, 'anc_6310_nonce_field_form')) {
        die('You do not have sufficient permissions to access this pagess.');
      } else {
        $css = anc_6310_extract_data($_POST);
        $wpdb->query($wpdb->prepare("UPDATE $style_table SET css = %s WHERE id = %d", $css, sanitize_text_field($_POST['id'])));
      }
    }
    $styledata = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $styleId), ARRAY_A);
    $css = explode("!!##!!", $styledata['css']);
    $key = explode(",", $css[0]);
    $value = explode("||##||", $css[1]);
    $cssData = array_combine($key, $value);
    $counter_order  = explode(",", $styledata['counterids']);
    $bgType = isset($cssData['background_type']) ? $cssData['background_type'] : 2;
  
      include anc_6310_plugin_url . 'settings/form/_form-09.php';
      include anc_6310_plugin_url . 'settings/css/_css-09.php';
      include anc_6310_plugin_url . 'settings/helper/_helper-09.php';
      ?>
      <div class="anc-6310-plugin-setting-left">
      <div class="anc-6310-preview-box">
        <div class="anc-6310-preview">
          Preview
          <div style="display: inline; float: right">
            <input type="text" id="anc_6310_background_preview" class="anc-6310-form-input  anc-6310-pull-right anc_6310_color_picker anc_6310_preview_color_chooser" data-format="rgb" data-opacity=".8" value="rgba(255, 255, 255, .8)"></div>
        </div>
        <hr />
      </div>
      <div class="anc_6310_tabs_panel_preview">
        <div id="anc-6310-number-counter">
       <div class="anc-6310-counter-09-paralax">
        <div class="anc-6310-counter-09-common-overlay">
          <?php
              if($bgType == 4) {
                $youtube_video_url = $cssData['youtube_video_url'] ? explode('?v=', $cssData['youtube_video_url']) : [];
                if(isset($youtube_video_url[1])) {
                   echo "<iframe src='https://www.youtube.com/embed/{$youtube_video_url[1]}?controls=0&showinfo=0&rel=0&autoplay=1&loop=1&playlist={$youtube_video_url[1]}&mute=1&allowfullscreen=1&allow=accelerometer&autoplay=1&rel=0' frameborder='0' allowfullscreen></iframe>"; 
                }  
              }
            ?>
          <div class="anc-6310-counter-09-row">
            <?php
            $allCounters = array();
            if ($counter_order) {
              foreach ($counter_order as $coid) {
                if ($coid) {
                  $results = $wpdb->get_row("SELECT * FROM $counter_table WHERE id={$coid}", ARRAY_A);
                  if($results){
                      $allCounters[] = $results;
                  }
                }
              }
            }
            foreach ($allCounters as $allCounter) {
              $numbersPosition = ['', ''];
              if ($allCounter['commons'] != '') {
                $numbersPosition = explode('###|||###', $allCounter['commons']);
              }
            ?>
              <div class="anc-6310-col-<?php echo $cssData['item_per_row'] ?>">
                <div class="anc-6310-counter-09">
                  <div class="anc-6310-counter-09-top-wrap">
                    <div class="anc-6310-counter-09-icon"><?php anc_6310_icon_image_load($allCounter); ?></div>
                    <div class="anc-6310-counter-09-inner-wrap">
                      <div class="anc-6310-counter-09-count-content">
                        <div class="anc-6310-counter-09-count-prefix"><?php echo $numbersPosition[0] ?></div>
                          <div 
                              class="anc-6310-counter-09-number anc-6310-counter-number" 
                              id="anc-6310-<?php echo "{$styleId}-{$allCounter['id']}" ?>"
                              data-anc-6310-start="<?php echo $allCounter['numbers_start']; ?>" 
                              data-anc-6310-end="<?php echo $allCounter['numbers']; ?>" 
                              data-anc-6310-decimal="<?php echo anc_6310_number_format($allCounter['numbers']); ?>" 
                              data-anc-6310-duration="<?php echo isset($cssData['animation_duration']) && $cssData['animation_duration'] !== '' ? $cssData['animation_duration'] / 1000 : .5; ?>" 
                              data-anc-6310-thousands-separator="<?php echo isset($cssData['thousands_separator']) ? $cssData['thousands_separator'] : '' ?>" 
                            >
                              <?php echo $allCounter['numbers_start']; ?>
                            </div>
                            <?php anc_6310_counter_suffix($numbersPosition[1], $templateId);?>
                      </div>
                      <div class="anc-6310-counter-09-count-title"><?php echo anc_6310_special_character_remove($allCounter['title']) ?></div>
                    </div>
                  </div>
                  <div class="anc-6310-counter-09-count-description"><?php echo anc_6310_special_character_remove($allCounter['description']) ?></div>
                  <?php
                    if ($allCounter['readmore_text'] != '') {
                      anc_6310_counter_button_section($allCounter['readmore_url'], $allCounter['readmore_text'], $templateId);
                    }
                    ?>  
                </div>
              </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>

    <div class="anc-6310-plugin-setting-right">
      <?php anc_6310_add_or_edit_counter($styleId, $counter_order, $styledata['style_name']); ?>
    </div>