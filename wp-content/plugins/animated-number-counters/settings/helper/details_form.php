<div id="tab-4">
  <div class="row">
    <h3 class="anc-6310-tab-menu-settings">Profile Details Settings</h3>
    <div class="anc-6310-tab-6">
      <table class="table table-responsive anc_6310_admin_table">
        <tr height="45">
          <td width="55%">
            <b>Activate Profile Details</b>
          </td>
          <td>
            <input type="hidden" name="anc_6310_fun_counter_profile_details" id="details_activation" value="<?php echo $cssData['anc_6310_fun_counter_profile_details'] ?>">
            <button type="button" value="1" class="anc-6310-btn-multi activate-details<?php if ($cssData['anc_6310_fun_counter_profile_details'] == 1) echo " active" ?>">Yes</button>
            <button type="button" value="0" class="anc-6310-btn-multi activate-details<?php if ($cssData['anc_6310_fun_counter_profile_details'] == 0) echo " active" ?>">No</button>
          </td>
        </tr>
        <tr height="45">
          <td width='55%'><b>Summary No. of Words</b></td>
          <td>
            <input type="number" min="0" name="details_summary_words" value="<?php echo $cssData['details_summary_words'] ?>" class="anc-6310-form-input anc-6310-no-preview" step="1" id="anc_6310_details_summary_words" />
          </td>
        </tr>
        <tr height="45">
          <td width='55%'><b>Font Size</b></td>
          <td>
            <input type="number" min="0" name="details_font_size" value="<?php echo $cssData['details_font_size'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_details_font_size" />
          </td>
        </tr>
        <tr height="45">
          <td><b>Line Height</b></td>
          <td>
            <input name="details_line_height" id="anc_6310_details_line_height" type="number" value="<?php echo $cssData['details_line_height'] ?>" class="anc-6310-form-input" />
          </td>
        </tr>
        <tr height="45">
          <td><b>Font Color</b></td>
          <td>
            <input type="text" name="details_font_color" id="anc_6310_details_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['details_font_color'] ?>">
          </td>
        </tr>
        <tr height="45">
          <td><b>Font Hover Color</b></td>
          <td>
            <input type="text" name="details_font_hover_color" id="anc_6310_details_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['details_font_hover_color'] ?>">
          </td>
        </tr>


        <!-- =================read more section add ============================= -->
        <tr>
          <td>
            <div id="hr"></div>
          </td>
          <td>
            <div id="hr"></div>
          </td>
        </tr>


        <tr height="45">


          <td width="55%">
            <b>Activate Raed More Read More</b>
          </td>
          <td>
            <input type="hidden" name="anc_6310_fun_counter_read_more" id="readmore_activation" value="<?php echo $cssData['anc_6310_fun_counter_read_more'] ?>">
            <button type="button" value="1" class="anc-6310-btn-multi readRore_activation<?php if ($cssData['anc_6310_fun_counter_read_more'] == 1) echo " active" ?>">Yes</button>
            <button type="button" value="0" class="anc-6310-btn-multi readRore_activation<?php if ($cssData['anc_6310_fun_counter_read_more'] == 0) echo " active" ?>">No</button>
          </td>
        </tr>

        <tr height="45" class="read_more_act_field">
          <td width='55%'><b>Read More Text</b></td>
          <td>
            <input type="text" min="0" name="read_more_text" value="<?php echo $cssData['read_more_text'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_read_more_text" />
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td width='55%'><b>Read More Height</b></td>
          <td>
            <input type="number" min="0" name="read_more_height" value="<?php echo $cssData['read_more_height'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_read_more_height" />
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td width='55%'><b>Read More Width</b><?php
                                                ?></td>
          <td>
            <input type="number" name="read_more_width" class="anc-6310-form-input" id="anc_6310_read_more_width" value="<?php echo $cssData['read_more_width'] ?>">
          </td>
        </tr>

        <tr height="45" class="read_more_act_field">
          <td width='55%'><b>Read More Font Size</b></td>
          <td>
            <input type="number" min="0" name="read_more_font_size" value="<?php echo $cssData['read_more_font_size'] ?>" class="anc-6310-form-input" step="1" id="anc_6310_read_more_font_size" />
          </td>
        </tr>

        <tr height="45" class="read_more_act_field">
          <td><b>Read More Font Color</b></td>
          <td>
            <input type="text" name="read_more_font_color" id="anc_6310_read_more_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['read_more_font_color'] ?>">
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Font Hover Color</b></td>
          <td>
            <input type="text" name="read_more_font_hover_color" id="anc_6310_read_more_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['read_more_font_hover_color'] ?>">
          </td>
        </tr>


        <tr height="45" class="read_more_act_field">
          <td width='55%'><b>Read More Border Width</b><?php
                                                        ?></td>
          <td>
            <select name="read_more_border_width" class="anc-6310-form-input" id="anc_6310_read_more_border_width">
              <option value="none" <?php if ($cssData['read_more_border_width'] == 'none') echo " selected=''" ?>>None
              </option>
              <option value="1px" <?php if ($cssData['read_more_border_width'] == '1px') echo " selected=''" ?>>1px
              </option>
              <option value="2px" <?php if ($cssData['read_more_border_width'] == '2px') echo " selected=''" ?>>2px
              </option>
              <option value="3px" <?php if ($cssData['read_more_border_width'] == '3px') echo " selected=''" ?>>3px
              </option>
              <option value="4px" <?php if ($cssData['read_more_border_width'] == '4px') echo " selected=''" ?>>4px
              </option>
              <option value="5px" <?php if ($cssData['read_more_border_width'] == '5px') echo " selected=''" ?>>5px
              </option>
            </select>
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Border Color</b></td>
          <td>
            <input type="text" name="read_more_border_color" id="anc_6310_read_more_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['read_more_border_color'] ?>">
          </td>
        </tr>

        <tr height="45" class="read_more_act_field">
          <td><b>Read More Border Radius</b></td>
          <td>
            <input type="number" name="read_more_border_radius" id="anc_6310_read_more_border_radius" class="anc-6310-form-input " value="<?php echo $cssData['read_more_border_radius'] ?>">
          </td>
        </tr>

      </table>
    </div>

    <div class="anc-6310-tab-6">
      <table class="table table-responsive anc_6310_admin_table">
        <tr height="45">
          <td width='55%'><b>Font Weight</b><?php
                                            ?></td>
          <td>
            <select name="details_font_weight" class="anc-6310-form-input" id="anc_6310_details_font_weight">
              <option value="100" <?php if ($cssData['details_font_weight'] == '100') echo " selected=''" ?>>100
              </option>
              <option value="200" <?php if ($cssData['details_font_weight'] == '200') echo " selected=''" ?>>200
              </option>
              <option value="300" <?php if ($cssData['details_font_weight'] == '300') echo " selected=''" ?>>300
              </option>
              <option value="400" <?php if ($cssData['details_font_weight'] == '400') echo " selected=''" ?>>400
              </option>
              <option value="500" <?php if ($cssData['details_font_weight'] == '500') echo " selected=''" ?>>500
              </option>
              <option value="600" <?php if ($cssData['details_font_weight'] == '600') echo " selected=''" ?>>600
              </option>
              <option value="700" <?php if ($cssData['details_font_weight'] == '700') echo " selected=''" ?>>700
              </option>
              <option value="800" <?php if ($cssData['details_font_weight'] == '800') echo " selected=''" ?>>800
              </option>
              <option value="900" <?php if ($cssData['details_font_weight'] == '900') echo " selected=''" ?>>900
              </option>
              <option value="normal" <?php if ($cssData['details_font_weight'] == 'normal') echo " selected=''" ?>>
                Normal</option>
              <option value="bold" <?php if ($cssData['details_font_weight'] == 'bold') echo " selected=''" ?>>Bold
              </option>
              <option value="lighter" <?php if ($cssData['details_font_weight'] == 'lighter') echo " selected=''" ?>>
                Lighter</option>
              <option value="initial" <?php if ($cssData['details_font_weight'] == 'initial') echo " selected=''" ?>>
                Initial</option>
            </select>
          </td>
        </tr>
        <tr height="45">
          <td width='55%'><b>Text Transform</b><?php
                                                ?></td>
          <td>
            <select name="details_text_transform" class="anc-6310-form-input" id="anc_6310_details_text_transform">
              <option value="capitalize" <?php if ($cssData['details_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
              <option value="uppercase" <?php if ($cssData['details_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
              <option value="lowercase" <?php if ($cssData['details_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
              <option value="none" <?php if ($cssData['details_text_transform'] == 'none') echo " selected=''" ?>>As
                Input</option>
            </select>
          </td>
        </tr>
        <tr height="45">
          <td width='55%'><b>Text Align</b><?php
                                            ?></td>
          <td>
            <select name="details_text_align" class="anc-6310-form-input" id="anc_6310_details_text_align">
              <option value="center" <?php if ($cssData['details_text_align'] == 'center') echo " selected=''" ?>>Center
              </option>
              <option value="left" <?php if ($cssData['details_text_align'] == 'left') echo " selected=''" ?>>Left
              </option>
              <option value="right" <?php if ($cssData['details_text_align'] == 'right') echo " selected=''" ?>>Right
              </option>
              <option value="justify" <?php if ($cssData['details_text_align'] == 'justify') echo " selected=''" ?>>
                Justify</option>
            </select>
          </td>
        </tr>
        <tr height="45">
          <td><b>Font Family</b><?php
                                ?></td>
          <td>
            <input name="details_font_family" id="anc_6310_jquery_profile_details_font" type="text" value="<?php echo $cssData['details_font_family'] ?>" />
          </td>
        </tr>
        <tr height="45">
          <td><b>Margin Top</b></td>
          <td>
            <input name="details_margin_top" id="anc_6310_details_margin_top" type="number" value="<?php echo $cssData['details_margin_top'] ?>" class="anc-6310-form-input" />
          </td>
        </tr>
        <tr height="45">
          <td><b>Margin Bottom</b></td>
          <td>
            <input name="details_margin_bottom" id="anc_6310_details_margin_bottom" type="number" value="<?php echo $cssData['details_margin_bottom'] ?>" class="anc-6310-form-input" />
          </td>
        </tr>

        <!-- -------------------------------button field ------------------------->
        <tr>
          <td>
            <div id="hr"></div>
          </td>
          <td>
            <div id="hr"></div>
          </td>
        </tr>

        <tr height="45" class="read_more_act_field">
          <td><b>Read More Backgrond Color</b></td>
          <td>
            <input type="text" name="read_more_backbround_color" id="anc_6310_read_more_backbround_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['read_more_backbround_color'] ?>">
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Backgrond Hover Color</b></td>
          <td>
            <input type="text" name="read_more_backbround_hover_color" id="anc_6310_read_more_backbround_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo $cssData['read_more_backbround_hover_color'] ?>">
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Font Weight</b><?php
                                          ?></td>
          <td>
            <select name="read_more_font_weight" class="anc-6310-form-input" id="anc_6310_read_more_font_weight">
              <option value="100" <?php if ($cssData['read_more_font_weight'] == '100') echo " selected=''" ?>>100
              </option>
              <option value="200" <?php if ($cssData['read_more_font_weight'] == '200') echo " selected=''" ?>>200
              </option>
              <option value="300" <?php if ($cssData['read_more_font_weight'] == '300') echo " selected=''" ?>>300
              </option>
              <option value="400" <?php if ($cssData['read_more_font_weight'] == '400') echo " selected=''" ?>>400
              </option>
              <option value="500" <?php if ($cssData['read_more_font_weight'] == '500') echo " selected=''" ?>>500
              </option>
              <option value="600" <?php if ($cssData['read_more_font_weight'] == '600') echo " selected=''" ?>>600
              </option>
              <option value="700" <?php if ($cssData['read_more_font_weight'] == '700') echo " selected=''" ?>>700
              </option>
              <option value="800" <?php if ($cssData['read_more_font_weight'] == '800') echo " selected=''" ?>>800
              </option>
              <option value="900" <?php if ($cssData['read_more_font_weight'] == '900') echo " selected=''" ?>>900
              </option>
              <option value="normal" <?php if ($cssData['read_more_font_weight'] == 'normal') echo " selected=''" ?>>
                Normal</option>
              <option value="bold" <?php if ($cssData['read_more_font_weight'] == 'bold') echo " selected=''" ?>>Bold
              </option>
              <option value="lighter" <?php if ($cssData['read_more_font_weight'] == 'lighter') echo " selected=''" ?>>
                Lighter</option>
              <option value="initial" <?php if ($cssData['read_more_font_weight'] == 'initial') echo " selected=''" ?>>
                Initial</option>
            </select>
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Text Transform</b><?php
                                              ?></td>
          <td>
            <select name="read_more_text_transform" class="anc-6310-form-input" id="anc_6310_read_more_text_transform">
              <option value="capitalize" <?php if ($cssData['read_more_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize
              </option>
              <option value="uppercase" <?php if ($cssData['read_more_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
              <option value="lowercase" <?php if ($cssData['read_more_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
              <option value="none" <?php if ($cssData['read_more_text_transform'] == 'none') echo " selected=''" ?>>As
                Input</option>
            </select>
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Text Align</b><?php
                                          ?></td>
          <td>
            <select name="read_more_text_align" class="anc-6310-form-input" id="anc_6310_read_more_text_align">
              <option value="center" <?php if ($cssData['read_more_text_align'] == 'center') echo " selected=''" ?>>
                Center</option>
              <option value="left" <?php if ($cssData['read_more_text_align'] == 'left') echo " selected=''" ?>>Left
              </option>
              <option value="right" <?php if ($cssData['read_more_text_align'] == 'right') echo " selected=''" ?>>Right
              </option>

            </select>
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Font Family</b><?php
                                          ?></td>

          <td>
            <input name="read_more_font_family" id="anc_6310_jquery_read_more_font_family" type="text" value="<?php echo $cssData['read_more_font_family'] ?>" />
          </td>

        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Margin Top</b></td>
          <td>
            <input name="read_more_margin_top" id="anc_6310_read_more_margin_top" type="number" value="<?php echo $cssData['read_more_margin_top'] ?>" class="anc-6310-form-input" />
          </td>
        </tr>
        <tr height="45" class="read_more_act_field">
          <td><b>Read More Margin Bottom</b></td>
          <td>
            <input name="read_more_margin_bottom" id="anc_6310_read_more_margin_bottom" type="number" value="<?php echo $cssData['read_more_margin_bottom'] ?>" class="anc-6310-form-input" />
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>

<style>
  #hr {
    width: 100%;
    background: #0073AA;
    height: 0;
    border: 2px solid #0073AA;
    margin: 10px 0;
  }
</style>