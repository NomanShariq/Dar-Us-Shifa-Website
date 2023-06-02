<style>
   .anc-6310-owl-carousel .anc-6310-item {
      padding: 5px 0;
      width: calc(100% - <?php echo ($allStyle[3] * 2) ?>px) !important;
   }
</style>


<div id="tab-6">
   <div class="row">
      <h3 class="anc-6310-tab-menu-settings">Contact Information Settings</h3>
      <div class="anc-6310-tab-6">
         <table class="table table-responsive anc_6310_admin_table">
            <tr height="45">
               <td width="55%">
                  <b>Activate Contact Information</b>
               </td>
               <td>
                  <input type="hidden" name="anc_6310_fun_counter_contact" id="anc_6310_fun_counter_contact" value="<?php echo $cssData['anc_6310_fun_counter_contact'] ?>">
                  <button type="button" value="1" class="anc-6310-btn-multi activate-contact<?php if ($cssData['anc_6310_fun_counter_contact'] == 1) echo " active" ?>">Yes</button>
                  <button type="button" value="0" class="anc-6310-btn-multi activate-contact<?php if ($cssData['anc_6310_fun_counter_contact'] == 0) echo " active" ?>">No</button>
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Label Font Size</b></td>
               <td>
                  <input type="number" min="0" name="contact_label_font_size" value="<?php echo $cssData['contact_label_font_size'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_contact_label_font_size" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Label Font Color</b></td>
               <td>
                  <input type="text" name="contact_label_font_color" id="anc_6310_contact_label_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['contact_label_font_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td><b>Label Font Hover Color</b></td>
               <td>
                  <input type="text" name="contact_label_font_hover_color" id="anc_6310_contact_label_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['contact_label_font_hover_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Label Font Weight</b></td>
               <td>
                  <select name="contact_label_font_weight" class="anc-6310-form-input" id="anc_6310_contact_label_font_weight">
                     <option value="100" <?php if ($cssData['contact_label_font_weight'] == '100') echo " selected=''" ?>>100</option>
                     <option value="200" <?php if ($cssData['contact_label_font_weight'] == '200') echo " selected=''" ?>>200</option>
                     <option value="300" <?php if ($cssData['contact_label_font_weight'] == '300') echo " selected=''" ?>>300</option>
                     <option value="400" <?php if ($cssData['contact_label_font_weight'] == '400') echo " selected=''" ?>>400</option>
                     <option value="500" <?php if ($cssData['contact_label_font_weight'] == '500') echo " selected=''" ?>>500</option>
                     <option value="600" <?php if ($cssData['contact_label_font_weight'] == '600') echo " selected=''" ?>>600</option>
                     <option value="700" <?php if ($cssData['contact_label_font_weight'] == '700') echo " selected=''" ?>>700</option>
                     <option value="800" <?php if ($cssData['contact_label_font_weight'] == '800') echo " selected=''" ?>>800</option>
                     <option value="900" <?php if ($cssData['contact_label_font_weight'] == '900') echo " selected=''" ?>>900</option>
                     <option value="normal" <?php if ($cssData['contact_label_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                     <option value="bold" <?php if ($cssData['contact_label_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                     <option value="lighter" <?php if ($cssData['contact_label_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                     <option value="initial" <?php if ($cssData['contact_label_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Font Size</b></td>
               <td>
                  <input type="number" min="0" name="contact_font_size" value="<?php echo $cssData['contact_font_size'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_contact_font_size" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Line Height</b></td>
               <td>
                  <input name="contact_line_height" id="anc_6310_contact_line_height" type="number" value="<?php echo $cssData['contact_line_height'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Font Color</b></td>
               <td>
                  <input type="text" name="contact_font_color" id="anc_6310_contact_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['contact_font_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td><b>Font Hover Color</b></td>
               <td>
                  <input type="text" name="contact_font_hover_color" id="anc_6310_contact_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['contact_font_hover_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Font Weight</b></td>
               <td>
                  <select name="contact_font_weight" class="anc-6310-form-input" id="anc_6310_contact_font_weight">
                     <option value="100" <?php if ($cssData['contact_font_weight'] == '100') echo " selected=''" ?>>100</option>
                     <option value="200" <?php if ($cssData['contact_font_weight'] == '200') echo " selected=''" ?>>200</option>
                     <option value="300" <?php if ($cssData['contact_font_weight'] == '300') echo " selected=''" ?>>300</option>
                     <option value="400" <?php if ($cssData['contact_font_weight'] == '400') echo " selected=''" ?>>400</option>
                     <option value="500" <?php if ($cssData['contact_font_weight'] == '500') echo " selected=''" ?>>500</option>
                     <option value="600" <?php if ($cssData['contact_font_weight'] == '600') echo " selected=''" ?>>600</option>
                     <option value="700" <?php if ($cssData['contact_font_weight'] == '700') echo " selected=''" ?>>700</option>
                     <option value="800" <?php if ($cssData['contact_font_weight'] == '800') echo " selected=''" ?>>800</option>
                     <option value="900" <?php if ($cssData['contact_font_weight'] == '900') echo " selected=''" ?>>900</option>
                     <option value="normal" <?php if ($cssData['contact_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                     <option value="bold" <?php if ($cssData['contact_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                     <option value="lighter" <?php if ($cssData['contact_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                     <option value="initial" <?php if ($cssData['contact_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
               </td>
            </tr>
         </table>
      </div>
      <div class="anc-6310-tab-6">
         <table class="table table-responsive anc_6310_admin_table">
            <tr height="45">
               <td width='55%'><b>Text Transform</b><?php
                                                      ?></td>
               <td>
                  <select name="contact_text_transform" class="anc-6310-form-input" id="anc_6310_contact_text_transform">
                     <option value="capitalize" <?php if ($cssData['contact_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
                     <option value="uppercase" <?php if ($cssData['contact_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
                     <option value="lowercase" <?php if ($cssData['contact_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
                     <option value="none" <?php if ($cssData['contact_text_transform'] == 'none') echo " selected=''" ?>>As Input</option>

                  </select>
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Text Align</b><?php
                                                ?></td>
               <td>
                  <select name="contact_text_align" class="anc-6310-form-input" id="anc_6310_contact_text_align">
                     <option value="center" <?php if ($cssData['contact_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                     <option value="left" <?php if ($cssData['contact_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                     <option value="right" <?php if ($cssData['contact_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Font Family</b><?php
                                       ?></td>
               <td>
                  <input name="contact_font_family" id="anc_6310_jquery_contact_font" type="text" value="<?php echo $cssData['contact_font_family'] ?>" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Margin Top</b></td>
               <td>
                  <input name="contact_margin_top" id="anc_6310_contact_margin_top" type="number" value="<?php echo $cssData['contact_margin_top'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Margin Bottom</b></td>
               <td>
                  <input name="contact_margin_bottom" id="anc_6310_contact_margin_bottom" type="number" value="<?php echo $cssData['contact_margin_bottom'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Border Bottom</b></td>
               <td>
                  <select name="contact_border_bottom" class="anc-6310-form-input" id="anc_6310_contact_border_bottom">
                     <option value="none" <?php if ($cssData['contact_border_bottom'] == 'none') echo " selected=''" ?>>None</option>
                     <option value="1px" <?php if ($cssData['contact_border_bottom'] == '1px') echo " selected=''" ?>>1px</option>
                     <option value="2px" <?php if ($cssData['contact_border_bottom'] == '2px') echo " selected=''" ?>>2px</option>
                     <option value="3px" <?php if ($cssData['contact_border_bottom'] == '3px') echo " selected=''" ?>>3px</option>
                     <option value="4px" <?php if ($cssData['contact_border_bottom'] == '4px') echo " selected=''" ?>>4px</option>
                     <option value="5px" <?php if ($cssData['contact_border_bottom'] == '5px') echo " selected=''" ?>>5px</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Border Bottom Color</b></td>
               <td>
                  <input type="text" name="contact_border_bottom_color" id="anc_6310_contact_border_bottom_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['contact_border_bottom_color'] ?>">
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>

<div id="tab-7">
   <div class="row anc_6310_padding_15_px">
      <h3 class="anc-6310-tab-menu-settings">Skills Settings</h3>
      <div class="anc-6310-tab-6">
         <table width="100%">
            <tr height="45">
               <td width="55%">
                  <b>Activate Skills</b>
               </td>
               <td>
                  <input type="hidden" name="anc_6310_fun_counter_skills" id="skills_activation" value="<?php echo $cssData['anc_6310_fun_counter_skills'] ?>" />
                  <button type="button" value="1" class="anc-6310-btn-multi activate-skills<?php if ($cssData['anc_6310_fun_counter_skills'] == 1) echo " active" ?>">Yes</button>
                  <button type="button" value="0" class="anc-6310-btn-multi activate-skills<?php if ($cssData['anc_6310_fun_counter_skills'] == 0) echo " active" ?>">No</button>
               </td>
            </tr>
            <tr height="45">
               <td width="55%">
                  <b>Skills Font Size</b>
               </td>
               <td width="55%">
                  <input type="number" min="0" name="skills_font_size" value="<?php echo $cssData['skills_font_size'] ?>" class="anc-6310-form-input" step="1" id="skills_font_size" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Skills Line Height</b></td>
               <td>
                  <input name="skills_line_height" id="skills_line_height" type="number" value="<?php echo $cssData['skills_line_height'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
            <tr height="45">
               <td width="55%">
                  <b>Skills Text Transform</b>
               </td>
               <td width="55%">
                  <select name="skills_text_transform" class="anc-6310-form-input" id="skills_text_transform">
                     <option value="" <?php if ($cssData['skills_text_transform'] == '') echo " selected=''" ?>>As Input</option>
                     <option value="capitalize" <?php if ($cssData['skills_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
                     <option value="uppercase" <?php if ($cssData['skills_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
                     <option value="lowercase" <?php if ($cssData['skills_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Skills Font Color</b></td>
               <td>
                  <input type="text" name="skills_font_color" id="skills_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['skills_font_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td><b>Skills Font Hover Color</b></td>
               <td>
                  <input type="text" name="skills_font_hover_color" id="skills_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['skills_font_hover_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td width='55%'><b>Font Weight</b></td>
               <td>
                  <select name="skills_font_weight" class="anc-6310-form-input" id="skills_font_weight">
                     <option value="100" <?php if ($cssData['skills_font_weight'] == '100') echo " selected=''" ?>>100</option>
                     <option value="200" <?php if ($cssData['skills_font_weight'] == '200') echo " selected=''" ?>>200</option>
                     <option value="300" <?php if ($cssData['skills_font_weight'] == '300') echo " selected=''" ?>>300</option>
                     <option value="400" <?php if ($cssData['skills_font_weight'] == '400') echo " selected=''" ?>>400</option>
                     <option value="500" <?php if ($cssData['skills_font_weight'] == '500') echo " selected=''" ?>>500</option>
                     <option value="600" <?php if ($cssData['skills_font_weight'] == '600') echo " selected=''" ?>>600</option>
                     <option value="700" <?php if ($cssData['skills_font_weight'] == '700') echo " selected=''" ?>>700</option>
                     <option value="800" <?php if ($cssData['skills_font_weight'] == '800') echo " selected=''" ?>>800</option>
                     <option value="900" <?php if ($cssData['skills_font_weight'] == '900') echo " selected=''" ?>>900</option>
                     <option value="normal" <?php if ($cssData['skills_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                     <option value="bold" <?php if ($cssData['skills_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                     <option value="lighter" <?php if ($cssData['skills_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                     <option value="initial" <?php if ($cssData['skills_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Font Family</b><?php
                                       ?></td>
               <td>
                  <input name="skills_font_family" id="skills_font_family" type="text" value="<?php echo $cssData['skills_font_family'] ?>" />
               </td>
            </tr>

            <tr height="45">
               <td width="55%">
                  <b>Progress Bar Height</b>
               </td>
               <td width="55%">
                  <input type="number" min="0" name="progress_bar_height" value="<?php echo $cssData['progress_bar_height'] ?>" class="anc-6310-form-input" step="1" id="progress_bar_height" />
               </td>
            </tr>
            <tr height="45">
               <td width="55%">
                  <b>Progress Bar Radius</b>
               </td>
               <td width="55%">
                  <input type="number" min="0" name="progress_bar_border_radius" value="<?php echo $cssData['progress_bar_border_radius'] ?>" class="anc-6310-form-input" step="1" id="progress_bar_border_radius" />
               </td>
            </tr>
         </table>
      </div>
      <div class="anc-6310-tab-6">
         <table width="100%">
            <tr height="45">
               <td width="55%">
                  <b>Progress Bar Border Size</b>
               </td>
               <td width="55%">
                  <input type="number" min="0" name="progress_bar_border_size" value="<?php echo $cssData['progress_bar_border_size'] ?>" class="anc-6310-form-input" step="1" id="progress_bar_border_size" />
               </td>
            </tr>
            <tr height="45">
               <td width="55%">
                  <b>Progress Bar Border Color</b>
               </td>
               <td width="55%">
                  <input type="text" name="progress_bar_border_color" id="progress_bar_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['progress_bar_border_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td width="55%">
                  <b>Progress Bar Type</b>
               </td>
               <td width="55%">
                  <select class="anc-6310-form-input" id="progress_bar_type" name="progress_bar_type">
                     <option value="1" <?php if ($cssData['progress_bar_type']) echo " selected=''" ?>>Striped</option>
                     <option value="0" <?php if (!$cssData['progress_bar_type']) echo " selected=''" ?>>Regular</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Progress Bar Background Color</b></td>
               <td>
                  <input type="text" name="progress_bar_background_color" id="progress_bar_background_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['progress_bar_background_color'] ?>">
               </td>
            </tr>
            <tr height="45">
               <td><b>Progress Bar Color</b></td>
               <td>
                  <input type="text" name="progress_bar_color" id="progress_bar_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['progress_bar_color'] ?>">
               </td>
            </tr>
            <tr height="45" class="striped_show">
               <td><b>Progress Bar Alternate Color</b></td>
               <td>
                  <input type="text" name="progress_bar_alternate_color" id="progress_bar_alternate_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['progress_bar_alternate_color'] ?>">
               </td>
            </tr>
            <tr height="45" class="striped_show">
               <td><b>Progress Bar Animaiton</b></td>
               <td>
                  <select class="anc-6310-form-input" id="progress_bar_animation" name="progress_bar_animation">
                     <option value="1" <?php if ($cssData['progress_bar_animation']) echo " selected=''" ?>>Yes</option>
                     <option value="0" <?php if (!$cssData['progress_bar_animation']) echo " selected=''" ?>>No</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Margin Top</b></td>
               <td>
                  <input name="progress_bar_margin_top" id="anc_6310_progress_bar_margin_top" type="number" value="<?php echo $cssData['progress_bar_margin_top'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
            <tr height="45">
               <td><b>Margin Bottom</b></td>
               <td>
                  <input name="progress_bar_margin_bottom" id="anc_6310_progress_bar_margin_bottom" type="number" value="<?php echo $cssData['progress_bar_margin_bottom'] ?>" class="anc-6310-form-input" />
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>
<div id="tab-8">
   <div class="row anc_6310_padding_15_px">
      <h3 class="anc-6310-tab-menu-settings">Slider Settings</h3>
      <div class="anc-6310-tab-6">
         <table width="100%">
            <tr height="45">
               <td width="55%">
                  <b>Activate Slider</b>
               </td>
               <td>
                  <select name="anc_6310_fun_counter_slider" id="anc_6310_fun_counter_slider" class="anc-6310-form-input">
                     <?php
                     $opt = ['Default', 'Slider', 'Category'];
                     for ($i = 0; $i <= 2; $i++) {
                        $selected = ($cssData['anc_6310_fun_counter_slider'] == $i) ? ' selected' : '';
                        echo "<option value='{$i}' {$selected}>{$opt[$i]}</option>";
                     }
                     ?>
                  </select>
               </td>
            </tr>
         </table>
         <table width="100%" class="anc_6310_carousel_field">
            <tr height="45">
               <td width="55%"><b>Effect Duration</b></td>
               <td>
                  <select name="effect_duration" id="anc_6310_slider_duration_<?php echo $styleId ?>" class="anc-6310-form-input">
                     <option value="1000" <?php if ($cssData['effect_duration'] == "1000") echo " selected" ?>>1 Second</option>
                     <?php
                     $n = 2000;
                     for ($m = 2; $m <= 20; $m++) {
                     ?>
                        <option value="<?php echo $n; ?>" <?php if ($cssData['effect_duration'] == $n) echo " selected" ?>><?php echo $m ?> Seconds</option>
                     <?php
                        $n += 1000;
                     }
                     ?>

                  </select>
               </td>
            </tr>
            <tr height="45">
               <td>
                  <b>Activate Previous/Next</b>
               </td>
               <td>
                  <input type="hidden" name="prev_next_active" id="prev_next_active" value="<?php echo $cssData['prev_next_active'] ?>" />
                  <button type="button" value="true" class="anc-6310-btn-multi prev_next_active<?php if ($cssData['prev_next_active'] == "true") echo " active" ?>">Yes</button>
                  <button type="button" value="false" class="anc-6310-btn-multi prev_next_active<?php if ($cssData['prev_next_active'] == "false") echo " active" ?>">No</button>
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td>
                  <b>Previous/Next Icon</b>
               </td>
               <td>
                  <select name="slider_icon_style" id="anc_6310_icon_style" class="anc-6310-form-input">
                     <option value="fas fa-angle" <?php if ($cssData['slider_icon_style'] == "fas fa-angle") echo " selected=''" ?>>Angle</option>
                     <option value="fas fa-arrow" <?php if ($cssData['slider_icon_style'] == "fas fa-arrow") echo " selected=''" ?>>Arrow</option>
                     <option value="fas fa-arrow-circle" <?php if ($cssData['slider_icon_style'] == "fas fa-arrow-circle") echo " selected=''" ?>>Arrow Circle</option>
                     <option value="far fa-arrow-alt-circle" <?php if ($cssData['slider_icon_style'] == "far fa-arrow-alt-circle") echo " selected=''" ?>>Arrow Circle2</option>
                     <option value="fas fa-caret" <?php if ($cssData['slider_icon_style'] == "fas fa-caret") echo " selected=''" ?>>Caret</option>
                     <option value="fas fa-caret-square" <?php if ($cssData['slider_icon_style'] == "fas fa-caret-square") echo " selected=''" ?>>Caret Square</option>
                     <option value="fas fa-chevron" <?php if ($cssData['slider_icon_style'] == "fas fa-chevron") echo " selected=''" ?>>Chevron</option>
                     <option value="fas fa-chevron-circle" <?php if ($cssData['slider_icon_style'] == "fas fa-chevron-circle") echo " selected=''" ?>>Chevron Circle</option>
                  </select>
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td>
                  <b>Previous/Next Icon Size</b>
               </td>
               <td>
                  <input type="number" min="0" name="slider_prev_next_icon_size" id="anc_6310_prev_next_icon_size" class="anc-6310-form-input" value="<?php echo $cssData['slider_prev_next_icon_size'] ?>" />
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td>
                  <b>Border Radius</b>
               </td>
               <td>
                  <input type="number" min="0" name="slider_prev_next_icon_border_radius" id="anc_6310_prev_next_icon_border_radius" class="anc-6310-form-input" value="<?php echo $cssData['slider_prev_next_icon_border_radius'] ?>" />
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td><b>Previous/Next Background Color</b></td>
               <td>
                  <input type="text" name="slider_prev_next_bgcolor" id="anc_6310_prev_next_bgcolor" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_prev_next_bgcolor'] ?>">
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td><b>Previous/Next Text Color</b></td>
               <td>
                  <input type="text" name="slider_prev_next_color" id="anc_6310_prev_next_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_prev_next_color'] ?>">
               </td>

            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td><b>Previous/Next Hover Background Color</b></td>
               <td>
                  <input type="text" name="slider_prev_next_hover_bgcolor" id="anc_6310_prev_next_hover_bgcolor" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_prev_next_hover_bgcolor'] ?>">
               </td>
            </tr>
            <tr height="45" class="anc_6310_prev_next_act">
               <td><b>Previous/Next Hover Text Color</b></td>
               <td>
                  <input type="text" name="slider_prev_next_hover_color" id="anc_6310_prev_next_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_prev_next_hover_color'] ?>">
               </td>
            </tr>
         </table>

         <!-- /********************* category section start ********************/ -->

         <table width="100%" class="anc_6310_category_field">
            <tr>
               <td width="55%"><b>Font Size</b></td>
               <td width="55%">
                  <input type="text" name="category_font_size" id="anc_6310_category_font_size" value="<?php echo $cssData['category_font_size'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Font Color</b></td>
               <td width="55%">
                  <input type="text" name="category_font_color" id="anc_6310_category_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['category_font_color'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Font Hover Color</b></td>
               <td width="55%">
                  <input type="text" name="category_font_hover_color" id="anc_6310_category_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['category_font_hover_color'] ?>">
               </td>
            </tr>


            <tr>
               <td width="55%"><b>Border Width</b></td>
               <td width="55%">
                  <input type="text" name="category_border_width" id="anc_6310_category_border_width" value="<?php echo $cssData['category_border_width'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Border Color</b></td>
               <td width="55%">
                  <input type="text" name="category_border_color" id="anc_6310_category_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['category_border_color'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Background Color</b></td>
               <td width="55%">
                  <input type="text" name="category_background_color" id="anc_6310_category_background_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['category_background_color'] ?>">
               </td>
            </tr>

            <tr>
               <td width="55%"><b>Active Background Color</b></td>
               <td width="55%">
                  <input type="text" name="category_active_background_color" id="anc_6310_category_active_background_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['category_active_background_color'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Active Font Color</b></td>
               <td width="55%">
                  <input type="text" name="category_active_font_color" id="anc_6310_category_active_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['category_active_font_color'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Active Border Color</b></td>
               <td width="55%">
                  <input type="text" name="category_active_border_color" id="anc_6310_category_active_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['category_active_border_color'] ?>">
               </td>
            </tr>
         </table>
         <!-- /********************* category section end ********************/ -->
      </div>
      <div class="anc-6310-tab-6">
         <table width="100%" class="anc_6310_carousel_field">
            <tr height="45">
               <td width="55%">
                  <b>Activate Indicator</b>
               </td>
               <td>
                  <input type="hidden" name="indicator_activation" id="indicator_activation" value="<?php echo $cssData['indicator_activation'] ?>" />
                  <button type="button" value="true" class="anc-6310-btn-multi indicator_activation<?php if ($cssData['indicator_activation'] == 'true') echo " active" ?>">Yes</button>
                  <button type="button" value="false" class="anc-6310-btn-multi indicator_activation<?php if ($cssData['indicator_activation'] == 'false') echo " active" ?>">No</button>
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td>
                  <b>Indicator Width</b>
               </td>
               <td>
                  <input type="number" min="0" name="slider_indicator_width" id="anc_6310_indicator_width" class="anc-6310-form-input" value="<?php echo $cssData['slider_indicator_width'] ?>" />
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td>
                  <b>Indicator Height</b>
               </td>
               <td>
                  <input type="number" min="0" name="slider_indicator_height" id="anc_6310_indicator_height" class="anc-6310-form-input" value="<?php echo $cssData['slider_indicator_height'] ?>" />
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td><b>Active Indicator Color</b></td>
               <td>
                  <input type="text" name="slider_indicator_active_color" id="anc_6310_indicator_active_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_indicator_active_color'] ?>">
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td><b>Indicator Color</b></td>
               <td>
                  <input type="text" name="slider_indicator_color" id="anc_6310_indicator_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".8" value="<?php echo $cssData['slider_indicator_color'] ?>">
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td><b>Border Radius</b></td>
               <td>
                  <input type="number" min="0" name="slider_indicator_border_radius" id="anc_6310_indicator_border_radius" class="anc-6310-form-input" value="<?php echo $cssData['slider_indicator_border_radius'] ?>">
               </td>
            </tr>
            <tr height="45" class="anc_6310_indicator_act">
               <td><b>Indicator Margin</b></td>
               <td>
                  <input type="number" min="0" name="slider_indicator_margin" id="anc_6310_indicator_margin" class="anc-6310-form-input" value="<?php echo $cssData['slider_indicator_margin'] ?>">
               </td>
            </tr>
         </table>
         <table width="100%" class="anc_6310_category_field">
            <tr height="45">
               <td width='55%'><b>Font Weight</b></td>
               <td>
                  <select name="category_font_weight" class="anc-6310-form-input" id="anc_6310_category_font_weight">
                     <option value="100" <?php if ($cssData['category_font_weight'] == '100') echo " selected=''" ?>>100</option>
                     <option value="200" <?php if ($cssData['category_font_weight'] == '200') echo " selected=''" ?>>200</option>
                     <option value="300" <?php if ($cssData['category_font_weight'] == '300') echo " selected=''" ?>>300</option>
                     <option value="400" <?php if ($cssData['category_font_weight'] == '400') echo " selected=''" ?>>400</option>
                     <option value="500" <?php if ($cssData['category_font_weight'] == '500') echo " selected=''" ?>>500</option>
                     <option value="600" <?php if ($cssData['category_font_weight'] == '600') echo " selected=''" ?>>600</option>
                     <option value="700" <?php if ($cssData['category_font_weight'] == '700') echo " selected=''" ?>>700</option>
                     <option value="800" <?php if ($cssData['category_font_weight'] == '800') echo " selected=''" ?>>800</option>
                     <option value="900" <?php if ($cssData['category_font_weight'] == '900') echo " selected=''" ?>>900</option>
                     <option value="normal" <?php if ($cssData['category_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                     <option value="bold" <?php if ($cssData['category_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                     <option value="lighter" <?php if ($cssData['category_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                     <option value="initial" <?php if ($cssData['category_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
               </td>
            </tr>
            <tr height="45">
               <td><b>Font Family</b><?php
                                       ?></td>
               <td>
                  <input name="category_font_family" id="anc_6310_jquery_category_font_family" type="text" value="<?php echo $cssData['category_font_family'] ?>" />
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Margin Bottom</b></td>
               <td width="55%">
                  <input type="text" name="category_margin_bottom" id="anc_6310_category_margin_bottom" value="<?php echo $cssData['category_margin_bottom'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Menu Height</b></td>
               <td width="55%">
                  <input type="text" name="category_menu_height" id="anc_6310_category_menu_height" value="<?php echo $cssData['category_menu_height'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Margin Right</b></td>
               <td width="55%">
                  <input type="text" name="category_margin_right" id="anc_6310_category_margin_right" value="<?php echo $cssData['category_margin_right'] ?>">
               </td>
            </tr>
            <tr>
               <td width="55%"><b>Padding Right Left</b></td>
               <td width="55%">
                  <input type="text" name="category_padding_right_left" id="anc_6310_category_padding_right_left" value="<?php echo $cssData['category_padding_right_left'] ?>">
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>
<div id="tab-9">
   <h3 class="anc-6310-tab-menu-settings">Custom CSS Settings</h3>
   <p for="" style="width: calc(100% - 30px); margin: 0 15px 5px; font-size: 14px; padding-top: 15px; color: #000"><b>Add Your Custom CSS Code Here </b></p><br />
   <div class="css-area">
      <textarea class="codemirror-textarea" name="custom_css" rows="8"><?php echo anc_6310_special_character_remove($cssData['custom_css']) ?></textarea>
   </div>
</div>

<script>
   var $ = jQuery;
   jQuery(document).ready(function() {
      jQuery("body").on("change", "#anc_6310_background_preview", function() {
         var value = jQuery(this).val();
         jQuery(".anc_6310_tabs_panel_preview").css({
            "background": value
         });
      });

      var owl = jQuery("#anc-6310-slider-<?php echo $styleId ?>");
      owl.anc6310OwlCarousel({
         autoplay: true,
         lazyLoad: true,
         loop: true,
         margin: 30,
         autoplayTimeout: <?php echo $cssData['effect_duration'] ?>,
         autoplayHoverPause: true,
         responsiveClass: true,
         autoHeight: true,
         nav: <?php echo $cssData['prev_next_active'] ?>,
         dots: <?php echo $cssData['indicator_activation'] ?>,
         navText: ["<i class='<?php echo $cssData['slider_icon_style']; ?>-left'></i>", "<i class='<?php echo $cssData['slider_icon_style']; ?>-right'></i>"],
         responsive: {
            0: {
               items: 1
            },
            600: {
               items: <?php echo ($cssData['item_per_row'] > 2) ? 2 : $cssData['item_per_row']; ?>
            },
            1024: {
               items: <?php echo $cssData['item_per_row'] ?>
            },
            1366: {
               items: <?php echo $cssData['item_per_row'] ?>
            }
         }
      });
      owl.on('mouseleave', function() {
         owl.trigger('stop.owl.autoplay'); //this is main line to fix it
         owl.trigger('play.owl.autoplay', [<?php echo $cssData['effect_duration'] ?>]);
      });


      <?php
      if ($cssData['anc_6310_fun_counter_slider'] == 1) {
         echo "jQuery('#anc-6310-noslider-{$styleId}, #anc-6310-category-filter-{$styleId}, .anc_6310_category_field').hide();";
         echo "jQuery('#anc-6310-slider-{$styleId}, .anc_6310_carousel_field').show();";
      } else if ($cssData['anc_6310_fun_counter_slider'] == 2) {
         echo "jQuery('#anc-6310-noslider-{$styleId}, #anc-6310-slider-{$styleId}, .anc_6310_carousel_field').hide();";
         echo "jQuery('#anc-6310-category-filter-{$styleId}, .anc_6310_category_field').show();";
      } else {
         echo "jQuery('#anc-6310-slider-{$styleId}, #anc-6310-category-filter-{$styleId}, .anc_6310_carousel_field, .anc_6310_category_field').hide();";
         echo "jQuery('#anc-6310-noslider-{$styleId}').show();";
      }

      if ($cssData['prev_next_active'] == 'true') {
         echo ' jQuery(".anc_6310_prev_next_act, #anc_6310_prev, #anc_6310_next, #anc_6310_prev_font_icon, #anc_6310_next_font_icon").show();';
      } else {
         echo ' jQuery(".anc_6310_prev_next_act, #anc_6310_prev, #anc_6310_next, #anc_6310_prev_font_icon, #anc_6310_next_font_icon").hide();';
      }


      ?>

      //################# Progress Bar Start ########################

      <?php
      if ($cssData['progress_bar_type'] == 0) {
         echo "jQuery('.striped_show').hide();";
      }
      ?>


      // ################# Progress Bar End ###################
      //################### Slider Start ################
      jQuery("body").on("change", "#anc_6310_fun_counter_slider", function() {
         var val = parseInt(jQuery(this).val());

         if (val == 0) {
            jQuery("#anc-6310-noslider-<?php echo $styleId ?>").show();
            jQuery(".anc_6310_category_field, .anc_6310_carousel_field, #anc-6310-slider-<?php echo $styleId ?>, #anc-6310-category-filter-<?php echo $styleId ?>").hide();
         } else if (val == 2) {
            jQuery(".anc_6310_category_field, #anc-6310-category-filter-<?php echo $styleId ?>").show();
            jQuery(".anc_6310_carousel_field, #anc-6310-slider-<?php echo $styleId ?>, #anc-6310-noslider-<?php echo $styleId ?>").hide();
         } else {
            jQuery(".anc_6310_carousel_field, #anc-6310-slider-<?php echo $styleId ?>").show();
            jQuery(".anc_6310_category_field, #anc-6310-noslider-<?php echo $styleId ?>, #anc-6310-category-filter-<?php echo $styleId ?>").hide();
         }
      });

      jQuery("body").on("change", "#anc_6310_slider_duration_<?php echo $styleId ?>", function() {
         jQuery('#anc-6310-slider-<?php echo $styleId ?>').data('owl.carousel').options.autoplayTimeout = jQuery('#anc_6310_slider_duration_<?php echo $styleId ?>').val();
         jQuery('#anc-6310-slider-<?php echo $styleId ?>').trigger('refresh.owl.carousel');
      });

      jQuery("body").on("click", ".prev_next_active", function() {
         var val = jQuery(this).val();
         jQuery(".prev_next_active").removeClass("active");
         jQuery(this).addClass("active");
         jQuery("#prev_next_active").val(val);
         if (val == "true") {
            jQuery(".anc_6310_prev_next_act, #anc_6310_prev, #anc_6310_next, #anc_6310_prev_font_icon, #anc_6310_next_font_icon").show();
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').data('owl.carousel').options.nav = true;
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').trigger('refresh.owl.carousel');
         } else {
            jQuery(".anc_6310_prev_next_act, #anc_6310_prev, #anc_6310_next, #anc_6310_prev_font_icon, #anc_6310_next_font_icon").hide();
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').data('owl.carousel').options.nav = false;
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').trigger('refresh.owl.carousel');
         }
      });


      jQuery("body").on("change", "#anc_6310_icon_style", function() {
         jQuery("#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div.anc-6310-owl-prev i").attr("class", "" + jQuery(this).val() + "-left");
         jQuery("#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div.anc-6310-owl-next i").attr("class", "" + jQuery(this).val() + "-right");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_icon_size", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div { font-size:" + parseInt(jQuery(this).val()) + "px !important; line-height:" + (parseInt(jQuery(this).val()) + 15) + "px !important; height:" + (parseInt(jQuery(this).val()) + 15) + "px !important; width:" + (parseInt(jQuery(this).val()) + 15) + "px !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_icon_border_radius", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div.anc-6310-owl-prev { border-radius:" + "0 " + parseInt(jQuery(this).val()) + "% " + parseInt(jQuery(this).val()) + "% 0" + " !important;} #anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div.anc-6310-owl-next { border-radius:" + parseInt(jQuery(this).val()) + "% 0 0 " + parseInt(jQuery(this).val()) + "%" + " !important;}</style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_bgcolor", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div { background:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_color", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div { color:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_hover_bgcolor", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div:hover { background:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_prev_next_hover_color", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-owl-nav div:hover { color:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("click", ".indicator_activation", function() {
         var val = jQuery(this).val();
         jQuery(".indicator_activation").removeClass("active");
         jQuery(this).addClass("active");
         jQuery("#indicator_activation").val(val);
         if (val == "true") {
            jQuery(".anc_6310_indicator_act, #anc_6310_carousel_indicators").show();
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').data('owl.carousel').options.dots = true;
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').trigger('refresh.owl.carousel');
         } else {
            jQuery(".anc_6310_indicator_act, #anc_6310_carousel_indicators").hide();
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').data('owl.carousel').options.dots = false;
            jQuery('#anc-6310-slider-<?php echo $styleId ?>').trigger('refresh.owl.carousel');
         }
      });

      jQuery("body").on("change", "#anc_6310_indicator_width", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div { width:" + parseInt(jQuery(this).val()) + "px !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_indicator_height", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div { height:" + parseInt(jQuery(this).val()) + "px !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_indicator_active_color", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div.active{ background-color:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_indicator_color", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div { background-color:" + jQuery(this).val() + " !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_indicator_border_radius", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div { border-radius:" + parseInt(jQuery(this).val()) + "% !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_indicator_margin", function() {
         jQuery("<style type='text/css'>#anc-6310-slider-<?php echo $styleId ?> .anc-6310-anc-6310-owl-dots div{ margin: 0 " + parseInt(jQuery(this).val()) + "px !important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      //##############   Live preview settings End  ##############################

      <?php
      if ($cssData['prev_next_active'] == "false") {
         echo 'jQuery(".anc_6310_prev_next_act").hide();';
      }
      if ($cssData['indicator_activation'] == "false") {
         echo 'jQuery(".anc_6310_indicator_act").hide();';
      }
      ?>
      //##############   Category Start  ##############################

      jQuery("body").on("change", "input[name='category_font_size']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ font-size:" + parseInt(jQuery(this).val()) + "px;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_font_color']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ color:" + jQuery(this).val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "input[name='category_font_hover_color']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>:hover{ color:" + jQuery(this).val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_category_border_color, #anc_6310_category_border_width", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ border:" + jQuery("#anc_6310_category_border_width").val() + "px solid " + jQuery("#anc_6310_category_border_color").val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_background_color']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ background-color:" + jQuery(this).val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });




      jQuery("body").on("change", "#anc_6310_category_font_weight", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ font-weight:" + jQuery(this).val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_font_family']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list-<?php echo $styleId ?>{ font-family:" + jQuery(this).val() + ";} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_margin_bottom']", function() {
         jQuery("<style type='text/css'>.anc_6310_category{ margin-bottom:" + parseInt(jQuery(this).val()) + "px;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_menu_height']", function() {
         jQuery("<style type='text/css'> .anc_6310_category{ height:" + parseInt(jQuery(this).val()) + "px; line-height:" + parseInt(jQuery(this).val()) + "px;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_category_margin_right", function() {
         jQuery("<style type='text/css'> .anc_6310_category .anc_6310_category_list{ margin-right:" + parseInt(jQuery(this).val()) + "px;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "input[name='category_padding_right_left']", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list{ padding-right:" + parseInt(jQuery(this).val()) + "px;padding-left:" + parseInt(jQuery(this).val()) + "px;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });
      jQuery("body").on("change", "#anc_6310_category_active_background_color", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list_active{ background-color:" + jQuery(this).val() + "!important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_category_active_font_color", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list_active{ color:" + jQuery(this).val() + "!important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      jQuery("body").on("change", "#anc_6310_category_active_border_color", function() {
         jQuery("<style type='text/css'>.anc_6310_category .anc_6310_category_list_active{ border-color:" + jQuery(this).val() + "!important;} </style>").appendTo(".anc_6310_tabs_panel_preview");
      });

      /********************* category section end ********************/
   });
</script>

<style>
   /********************* category section start ********************/
   .anc_6310_category {
      width: 100%;
      text-align: center;
      position: relative;
      height: <?php echo $cssData['category_menu_height'] ?>px;
      line-height: <?php echo $cssData['category_menu_height'] ?>px;
      margin-bottom: <?php echo $cssData['category_margin_bottom'] ?>px;
   }

   .anc_6310_category .anc_6310_category_list {
      display: inline-block;
      padding: 0 <?php echo $cssData['category_padding_right_left'] ?>px;
      position: relative;
      margin-right: <?php echo $cssData['category_margin_right'] ?>px;
      cursor: pointer;
      font-weight: <?php echo $cssData['category_font_weight'] ?>;
      color: <?php echo $cssData['category_font_color'] ?>;
      border: <?php echo $cssData['category_border_width'] ?>px solid <?php echo $cssData['category_border_color'] ?>;
      font-family: <?php echo $cssData['category_font_family'] ?>;
      background-color: <?php echo $cssData['category_background_color'] ?>;
      font-size: <?php echo $cssData['category_font_size'] ?>px;
      -webkit-transition: all 0.6s ease 0s;
      -moz-transition: all 0.6s ease 0s;
      -ms-transition: all 0.6s ease 0s;
      -o-transition: all 0.6s ease 0s;
      transition: all 0.6s ease 0s;
   }

   .anc_6310_category .anc_6310_category_list:hover {
      color: <?php echo $cssData['category_font_hover_color'] ?>;
   }

   .anc_6310_category_list_active {
      background-color: <?php echo $cssData['category_active_background_color']; ?> !important;
      color: <?php echo $cssData['category_active_font_color']; ?> !important;
      border-color: <?php echo $cssData['category_active_border_color']; ?> !important;
   }



   /********************* category section End ********************/

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-owl-nav div {
      position: absolute;
      top: calc(50% - 35px);
      background: <?php echo $cssData['slider_prev_next_bgcolor'] ?>;
      color: <?php echo $cssData['slider_prev_next_color'] ?>;
      margin: 0;
      transition: all 0.3s ease-in-out;
      font-size: <?php echo $cssData['slider_prev_next_icon_size'] ?>px;
      line-height: <?php echo ($cssData['slider_prev_next_icon_size'] + 15) ?>px;
      height: <?php echo ($cssData['slider_prev_next_icon_size'] + 15) ?>px;
      width: <?php echo ($cssData['slider_prev_next_icon_size'] + 15) ?>px;
      text-align: center;
      padding: 0;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-owl-nav div:hover {
      background: <?php echo $cssData['slider_prev_next_hover_bgcolor'] ?>;
      color: <?php echo $cssData['slider_prev_next_hover_color'] ?>;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-owl-nav div.anc-6310-owl-prev {
      left: 0;
      border-radius: 0 <?php echo $cssData['slider_prev_next_icon_border_radius'] ?>% <?php echo $cssData['slider_prev_next_icon_border_radius'] ?>% 0;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-owl-nav div.anc-6310-owl-next {
      right: 0;
      border-radius: <?php echo $cssData['slider_prev_next_icon_border_radius'] ?>% 0 0 <?php echo $cssData['slider_prev_next_icon_border_radius'] ?>%;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-anc-6310-owl-dots {
      text-align: center;
      padding-top: 15px;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-anc-6310-owl-dots div {
      width: <?php echo $cssData['slider_indicator_width'] ?>px;
      height: <?php echo $cssData['slider_indicator_height'] ?>px;
      border-radius: <?php echo $cssData['slider_indicator_border_radius'] ?>%;
      display: inline-block;
      background-color: <?php echo $cssData['slider_indicator_color'] ?>;
      margin: 0 <?php echo $cssData['slider_indicator_margin'] ?>px;
   }

   #anc-6310-slider-<?php echo $styleId ?>.anc-6310-anc-6310-owl-dots div.active {
      background-color: <?php echo $cssData['slider_indicator_active_color'] ?>;
   }
</style>
<script>
   jQuery(document).ready(function() {
      jQuery("body").on("mouseenter mouseleave", ".anc_6310_image_hover_effect", function(e) {

         e.preventDefault();
         var org_img = jQuery(this).find('img').attr('src');
         var hover_img = jQuery(this).find('img').attr('image_hover');



         if (hover_img.length > 5) {
            jQuery(this).find('img').attr("src", hover_img);
            jQuery(this).find('img').attr("image_hover", org_img);
         }
      });

      jQuery("body").on("click", ".anc_6310_category_list", function() {
         let attr = jQuery(this).attr('anc-6310-data-filter');
         jQuery('.anc_6310_category_list').removeClass('anc_6310_category_list_active');
         jQuery(this).addClass('anc_6310_category_list_active');
         if (attr != 'all') {
            jQuery('#anc-6310-category-filter-<?php echo $styleId ?>')
               .find('.anc-6310-category-filter-items')
               .hide();
            jQuery('.' + attr).show();
         } else {
            jQuery('#anc-6310-category-filter-<?php echo $styleId ?>')
               .find('.anc-6310-category-filter-items')
               .show();
         }
      });

   });
</script>