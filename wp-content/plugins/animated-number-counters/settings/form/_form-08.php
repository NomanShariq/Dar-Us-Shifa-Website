<div class="anc_6310_tabs_panel_settings">
  <form method="post">
    <?php wp_nonce_field("anc_6310_nonce_field_form") ?>
    <input type="hidden" name="id" value="<?php echo $styleId ?>" />
    <div class="anc_6310_padding_15_px">
      <ul class="anc-6310-nav-tab">
        <li class="anc-6310-mytab active" id="tab1">General</li>
        <li class="anc-6310-mytab" id="tab2">Title</li>
        <li class="anc-6310-mytab" id="tab3">Icon</li>
        <li class="anc-6310-mytab" id="tab4">Description</li>
        <li class="anc-6310-mytab" id="tab5">Number</li>
        <li class="anc-6310-mytab" id="tab6">Button</li>
        <li class="anc-6310-mytab" id="tab7">Custom CSS</li>
      </ul>
    </div>
    <div class="anc-6310-tab-content">
      <div id="tab-1">
        <div class="row anc_6310_padding_15_px">
          <h3 class="anc-6310-tab-menu-settings">General Settings</h3>
          <div class="anc-6310-tab-6">
            <table width="100%">
              <tr height="45">
                <td width="55%">
                  <b>Item Per Row</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                  <div class="anc-6310-tooltip">(No preview available)</div>
                </td>
                <td>
                  <select name="item_per_row" class="anc-6310-form-input anc-6310-no-preview">
                    <option value="1" <?php if ($cssData['item_per_row'] == 1) echo " selected" ?>>1 Item per Row</option>
                    <option value="2" <?php if ($cssData['item_per_row'] == 2) echo " selected" ?>>2 Items per Row</option>
                    <option value="3" <?php if ($cssData['item_per_row'] == 3) echo " selected" ?>>3 Items per Row</option>
                    <option value="4" <?php if ($cssData['item_per_row'] == 4) echo " selected" ?>>4 Items per Row</option>
                    <option value="5" <?php if ($cssData['item_per_row'] == 5) echo " selected" ?>>5 Items per Row</option>
                    <option value="6" <?php if ($cssData['item_per_row'] == 6) echo " selected" ?>>6 Items per Row</option>
                  </select>
                </td>
              </tr>
              <tr height="45">
                <td>
                  <b>Animation Duration</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                  <div class="anc-6310-tooltip">(No preview available)</div>
                </td>
                <td>
                  <?php
                    anc_6310_animation_duration(isset($cssData['animation_duration']) && $cssData['animation_duration'] !== '' ? $cssData['animation_duration'] : 500);
                  ?>
                </td>
              </tr> 
              <tr height="45">
                <td>
                  <b>Thousands separator</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                  <div class="anc-6310-tooltip">(No preview available)</div>
                </td>
                <td>
                  <input type="text" name="thousands_separator" value="<?php echo isset($cssData['thousands_separator']) ? $cssData['thousands_separator'] : ',' ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Background Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_background_color" id="anc_6310_box_background_color" class="anc-6310-form-input anc_6310_color_picker" step="1" data-opacity="0" data-format="rgb" value="<?php echo isset($cssData['box_background_color']) && $cssData['box_background_color'] !== '' ? $cssData['box_background_color'] : 'rgba(8, 72, 250, 0.7)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width="55%"><b>Box Background Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_background_hover_color" id="anc_6310_box_background_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".5" data-format="rgb" value="<?php echo isset($cssData['box_background_hover_color']) && $cssData['box_background_hover_color'] !== '' ? $cssData['box_background_hover_color'] : 'rgba(9, 76, 249, 0.85)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Radius</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="box_radius" value="<?php echo isset($cssData['box_radius']) && $cssData['box_radius'] !== '' ? $cssData['box_radius'] : 8; ?>" class="anc-6310-form-input" id="anc_6310_box_radius" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Border Width</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="box_border_width" value="<?php echo isset($cssData['box_border_width']) && $cssData['box_border_width'] !== '' ? $cssData['box_border_width'] : 0; ?>" class="anc-6310-form-input" id="anc_6310_box_border_width" />
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45">
                <td><b>Box Border Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_border_color" id="anc_6310_box_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" data-opacity=".55" value="<?php echo isset($cssData['box_border_color']) && $cssData['box_border_color'] !== '' ? $cssData['box_border_color'] : 'rgba(255, 255, 255, 0)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width="55%"><b>Box Border Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_border_hover_color" id="anc_6310_box_border_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['box_border_hover_color']) && $cssData['box_border_hover_color'] !== '' ? $cssData['box_border_hover_color'] : 'rgba(255, 255, 255, 0)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Shadow Width</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="box_shadow_width" value="<?php echo isset($cssData['box_shadow_width']) && $cssData['box_shadow_width'] !== '' ? $cssData['box_shadow_width'] : 0; ?>" class="anc-6310-form-input" id="anc_6310_box_shadow_width" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Shadow Blur</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="box_shadow_blur" value="<?php echo isset($cssData['box_shadow_blur']) && $cssData['box_shadow_blur'] !== '' ? ($cssData['box_shadow_blur'] * 2) : 0; ?>" class="anc-6310-form-input" id="anc_6310_box_shadow_blur" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Shadow Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_shadow_color" id="anc_6310_box_shadow_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['box_shadow_color']) && $cssData['box_shadow_color'] !== '' ? $cssData['box_shadow_color'] : 'rgba(255, 255, 255, 0)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td><b>Box Shadow Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="box_shadow_hover_color" id="anc_6310_box_shadow_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['box_shadow_hover_color']) && $cssData['box_shadow_hover_color'] !== '' ? $cssData['box_shadow_hover_color'] : 'rgba(255, 255, 255, 0)'; ?>">
                </td>
              </tr>
              <?php                 
                anc_6310_background_setting($bgType, $cssData);
              ?>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-2">
        <div class="row">
          <h3 class="anc-6310-tab-menu-settings">Title Settings</h3>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45">
                <td width='55%'><b>Font Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="title_font_size" value="<?php echo isset($cssData['title_font_size']) && $cssData['title_font_size'] !== '' ? $cssData['title_font_size'] : 25; ?>" class="anc-6310-form-input" step="1" id="anc_6310_title_font_size" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Line Height</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_line_height" id="anc_6310_heading_line_height" type="number" value="<?php echo isset($cssData['title_line_height']) && $cssData['title_line_height'] !== '' ? $cssData['title_line_height'] : 25; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="title_font_color" id="anc_6310_title_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['title_font_color']) && $cssData['title_font_color'] !== '' ? $cssData['title_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="title_font_hover_color" id="anc_6310_title_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['title_font_hover_color']) && $cssData['title_font_hover_color'] !== '' ? $cssData['title_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Font Weight</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="title_font_weight" class="anc-6310-form-input" id="anc_6310_title_font_weight">
                    <option value="100" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['title_font_weight']) && $cssData['title_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Text Transform</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="title_text_transform" class="anc-6310-form-input" id="anc_6310_title_text_transform">
                    <option value="capitalize" <?php if (isset($cssData['title_text_transform']) && $cssData['title_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
                    <option value="uppercase" <?php if (isset($cssData['title_text_transform']) && $cssData['title_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
                    <option value="lowercase" <?php if (isset($cssData['title_text_transform']) && $cssData['title_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
                    <option value="none" <?php if (isset($cssData['title_text_transform']) && $cssData['title_text_transform'] == 'none') echo " selected=''" ?>>As Input</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45">
                <td width='55%'><b>Text Align</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="title_text_align" class="anc-6310-form-input" id="anc_6310_title_text_align">
                    <option value="center" <?php if (isset($cssData['title_text_align']) && $cssData['title_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['title_text_align']) && $cssData['title_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['title_text_align']) && $cssData['title_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Family</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_font_family" id="anc_6310_jquery_heading_font" type="text" value="<?php echo isset($cssData['title_font_family']) && $cssData['title_font_family'] !== '' ? $cssData['title_font_family'] : 'Vollkorn'; ?>" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_margin_left" id="anc_6310_title_margin_left" type="number" value="<?php echo isset($cssData['title_margin_left']) && $cssData['title_margin_left'] !== '' ? $cssData['title_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_margin_right" id="anc_6310_title_margin_right" type="number" value="<?php echo isset($cssData['title_margin_right']) && $cssData['title_margin_right'] !== '' ? $cssData['title_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Top</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_margin_top" id="anc_6310_title_margin_top" type="number" value="<?php echo isset($cssData['title_margin_top']) && $cssData['title_margin_top'] !== '' ? $cssData['title_margin_top'] : 5; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Bottom</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="title_margin_bottom" id="anc_6310_title_margin_bottom" type="number" value="<?php echo isset($cssData['title_margin_bottom']) && $cssData['title_margin_bottom'] !== '' ? $cssData['title_margin_bottom'] : 15; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-3">
        <div class="row">
          <h3 class="anc-6310-tab-menu-settings">Icon Settings</h3>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45">
                <td><b>Icon Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" name="icon_size" value="<?php echo isset($cssData['icon_size']) && $cssData['icon_size'] !== '' ? $cssData['icon_size'] : 40; ?>" class="anc-6310-form-input" id="anc_6310_icon_size">
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Icon Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="icon_color" id="anc_6310_icon_color" class="anc-6310-form-input anc_6310_color_picker" step="1" data-format="rgb" data-opacity=".8" value="<?php echo isset($cssData['icon_color']) && $cssData['icon_color'] !== '' ? $cssData['icon_color'] : 'rgb(255,169,35, 1)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Icon Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="icon_hover_color" id="anc_6310_icon_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['icon_hover_color']) && $cssData['icon_hover_color'] !== '' ? $cssData['icon_hover_color'] : 'rgb(255,169,35, 1)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Text Align</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="icon_text_align" class="anc-6310-form-input" id="anc_6310_icon_text_align">
                    <option value="center" <?php if (isset($cssData['icon_text_align']) && $cssData['icon_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['icon_text_align']) && $cssData['icon_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['icon_text_align']) && $cssData['icon_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
            <tr height="45">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="icon_margin_left" id="anc_6310_icon_margin_left" type="number" value="<?php echo isset($cssData['icon_margin_left']) && $cssData['icon_margin_left'] !== '' ? $cssData['icon_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="icon_margin_right" id="anc_6310_icon_margin_right" type="number" value="<?php echo isset($cssData['icon_margin_right']) && $cssData['icon_margin_right'] !== '' ? $cssData['icon_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Top</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="icon_margin_top" id="anc_6310_icon_margin_top" type="number" value="<?php echo isset($cssData['icon_margin_top']) && $cssData['icon_margin_top'] !== '' ? $cssData['icon_margin_top'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Bottom</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="icon_margin_bottom" id="anc_6310_icon_margin_bottom" type="number" value="<?php echo isset($cssData['icon_margin_bottom']) && $cssData['icon_margin_bottom'] !== '' ? $cssData['icon_margin_bottom'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-4">
        <div class="row">
          <h3 class="anc-6310-tab-menu-settings">Description Settings</h3>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table" width="100%">
              <tr height="45">
                <td width="55%">
                  <b>Activate Description</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <label class="switch">
                    <input type="checkbox" <?php echo (isset($cssData['counter_description']) && $cssData['counter_description']) ? ' checked' : '' ?> name="counter_description" value="1" id="anc_6310_counter_description" class="anc-6310-form-input" />
                    <span class="slider round description_icon_show_hide"></span>
                  </label>
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td width='55%'><b>Font Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="description_font_size" value="<?php echo isset($cssData['description_font_size']) && $cssData['description_font_size'] !== '' ? $cssData['description_font_size'] : 14; ?>" class="anc-6310-form-input" step="1" id="anc_6310_description_font_size" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Line Height</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_line_height" id="anc_6310_description_line_height" type="number" value="<?php echo isset($cssData['description_line_height']) && $cssData['description_line_height'] !== '' ? $cssData['description_line_height'] : 14; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Font Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="description_font_color" id="anc_6310_description_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['description_font_color']) && $cssData['description_font_color'] !== '' ? $cssData['description_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Font Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="description_font_hover_color" id="anc_6310_description_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['description_font_hover_color']) && $cssData['description_font_hover_color'] !== '' ? $cssData['description_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td width='55%'><b>Font Weight</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="description_font_weight" class="anc-6310-form-input" id="anc_6310_description_font_weight">
                    <option value="100" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['description_font_weight']) && $cssData['description_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td width='55%'><b>Text Transform</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="description_text_transform" class="anc-6310-form-input" id="anc_6310_description_text_transform">
                    <option value="capitalize" <?php if (isset($cssData['description_text_transform']) && $cssData['description_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
                    <option value="uppercase" <?php if (isset($cssData['description_text_transform']) && $cssData['description_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
                    <option value="lowercase" <?php if (isset($cssData['description_text_transform']) && $cssData['description_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
                    <option value="none" <?php if ($cssData['description_text_transform'] == 'none') echo " selected=''" ?>>As Input</option>
                  </select>
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45" class="description-act-field">
                <td width='55%'><b>Text Align</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="description_text_align" class="anc-6310-form-input" id="anc_6310_description_text_align">
                    <option value="center" <?php if (isset($cssData['description_text_align']) && $cssData['description_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['description_text_align']) && $cssData['description_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['description_text_align']) && $cssData['description_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Font Family</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_font_family" id="anc_6310_jquery_description_font" type="text" value="<?php echo isset($cssData['description_font_family']) && $cssData['description_font_family'] !== '' ? str_replace("+", " ", $cssData['description_font_family']) : 'Source Sans Pro'; ?>" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_margin_left" id="anc_6310_description_margin_left" type="number" value="<?php echo isset($cssData['description_margin_left']) && $cssData['description_margin_left'] !== '' ? $cssData['description_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_margin_right" id="anc_6310_description_margin_right" type="number" value="<?php echo isset($cssData['description_margin_right']) && $cssData['description_margin_right'] !== '' ? $cssData['description_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Margin Top</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_margin_top" id="anc_6310_description_margin_top" type="number" value="<?php echo isset($cssData['description_margin_top']) && $cssData['description_margin_top'] !== '' ? $cssData['description_margin_top'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="description-act-field">
                <td><b>Margin Bottom</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="description_margin_bottom" id="anc_6310_description_margin_bottom" type="number" value="<?php echo isset($cssData['description_margin_bottom']) && $cssData['description_margin_bottom'] !== '' ? $cssData['description_margin_bottom'] : 15; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-5">
        <div class="row">
          <h3 class="anc-6310-tab-menu-settings">Number Settings</h3>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45">
                <td width='55%'><b>Number Font Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="number_font_size" value="<?php echo isset($cssData['number_font_size']) && $cssData['number_font_size'] !== '' ? $cssData['number_font_size'] : 32; ?>" class="anc-6310-form-input" id="anc_6310_number_font_size" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Line Height</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="number_line_height" value="<?php echo isset($cssData['number_line_height']) && $cssData['number_line_height'] !== '' ? $cssData['number_line_height'] : 32; ?>" class="anc-6310-form-input" id="anc_6310_number_line_height" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_font_color" id="anc_6310_number_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_font_color']) && $cssData['number_font_color'] !== '' ? $cssData['number_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_font_hover_color" id="anc_6310_number_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_font_hover_color']) && $cssData['number_font_hover_color'] !== '' ? $cssData['number_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Font Weight</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="number_font_weight" class="anc-6310-form-input" id="anc_6310_number_font_weight">
                    <option value="100" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['number_font_weight']) && $cssData['number_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45">
                <td width='55%'><b>Text Align</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="number_text_align" class="anc-6310-form-input" id="anc_6310_number_text_align">
                    <option value="center" <?php if (isset($cssData['number_text_align']) && $cssData['number_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['number_text_align']) && $cssData['number_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['number_text_align']) && $cssData['number_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
              <tr height="45">
                <td><b>Font Family</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_font_family" id="anc_6310_jquery_number_font" type="text" value="<?php echo isset($cssData['number_font_family']) && $cssData['number_font_family'] !== '' ? str_replace("+", " ", $cssData['number_font_family']) : 'Amaranth'; ?>" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_margin_left" id="anc_6310_number_margin_left" type="number" value="<?php echo isset($cssData['number_margin_left']) && $cssData['number_margin_left'] !== '' ? $cssData['number_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_margin_right" id="anc_6310_number_margin_right" type="number" value="<?php echo isset($cssData['number_margin_right']) && $cssData['number_margin_right'] !== '' ? $cssData['number_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Top</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_margin_top" id="anc_6310_number_margin_top" type="number" value="<?php echo isset($cssData['number_margin_top']) && $cssData['number_margin_top'] !== '' ? $cssData['number_margin_top'] : 20; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td><b>Margin Bottom</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_margin_bottom" id="anc_6310_number_margin_bottom" type="number" value="<?php echo isset($cssData['number_margin_bottom']) && $cssData['number_margin_bottom'] !== '' ? $cssData['number_margin_bottom'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table" width="100%">
              <tr height="45">
                <td width="55%"><b>Activate Number Prefix</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <label class="switch">
                    <input type="checkbox" <?php echo (isset($cssData['prefix_icon_show_hide']) && $cssData['prefix_icon_show_hide']) ? ' checked' : '' ?> name="prefix_icon_show_hide" value="1" id="anc_6310_prefix_icon_show_hide" class="anc-6310-form-input" />
                    <span class="slider round prefix_icon_show_hide"></span>
                  </label>
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td width='55%'><b>Font Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="number_prefix_font_size" value="<?php echo isset($cssData['number_prefix_font_size']) && $cssData['number_prefix_font_size'] !== '' ? $cssData['number_prefix_font_size'] : 20; ?>" class="anc-6310-form-input" id="anc_6310_number_prefix_font_size" />
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Font Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_prefix_font_color" id="anc_6310_number_prefix_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_prefix_font_color']) && $cssData['number_prefix_font_color'] !== '' ? $cssData['number_prefix_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Font Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_prefix_font_hover_color" id="anc_6310_number_prefix_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_prefix_font_hover_color']) && $cssData['number_prefix_font_hover_color'] !== '' ? $cssData['number_prefix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td width='55%'><b>Font Weight</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="number_prefix_font_weight" class="anc-6310-form-input" id="anc_6310_number_prefix_font_weight">
                    <option value="100" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['number_prefix_font_weight']) && $cssData['number_prefix_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Font Family</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_prefix_font_family" id="anc_6310_jquery_number_prefix_font" type="text" value="<?php echo isset($cssData['number_prefix_font_family']) && $cssData['number_prefix_font_family'] !== '' ? $cssData['number_prefix_font_family'] : 'Amaranth'; ?>" />
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Top/Bottom Position</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" name="number_prefix_position" id="anc_6310_number_prefix_position" class="anc-6310-form-input" value="<?php echo isset($cssData['number_prefix_position']) && $cssData['number_prefix_position'] !== '' ? $cssData['number_prefix_position'] : 2; ?>">
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_prefix_margin_left" id="anc_6310_number_prefix_margin_left" type="number" value="<?php echo isset($cssData['number_prefix_margin_left']) && $cssData['number_prefix_margin_left'] !== '' ? $cssData['number_prefix_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="prefix-act-field">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_prefix_margin_right" id="anc_6310_number_prefix_margin_right" type="number" value="<?php echo isset($cssData['number_prefix_margin_right']) && $cssData['number_prefix_margin_right'] !== '' ? $cssData['number_prefix_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45">
                <td width="55%"><b>Activate Number Suffix</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <label class="switch">
                    <input type="checkbox" <?php echo (isset($cssData['suffix_icon_show_hide']) && $cssData['suffix_icon_show_hide']) ? ' checked' : '' ?> name="suffix_icon_show_hide" value="1" id="anc_6310_suffix_icon_show_hide" class="anc-6310-form-input" />
                    <span class="slider round suffix_icon_show_hide"></span>
                  </label>
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td width='55%'><b>Font Size</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" min="0" name="number_suffix_font_size" value="<?php echo isset($cssData['number_suffix_font_size']) && $cssData['number_suffix_font_size'] !== '' ? $cssData['number_suffix_font_size'] : 20; ?>" class="anc-6310-form-input" id="anc_6310_number_suffix_font_size" />
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Font Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_suffix_font_color" id="anc_6310_number_suffix_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_suffix_font_color']) && $cssData['number_suffix_font_color'] !== '' ? $cssData['number_suffix_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Font Hover Color</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="text" name="number_suffix_font_hover_color" id="anc_6310_number_suffix_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['number_suffix_font_hover_color']) && $cssData['number_suffix_font_hover_color'] !== '' ? $cssData['number_suffix_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td width='55%'><b>Font Weight</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <select name="number_suffix_font_weight" class="anc-6310-form-input" id="anc_6310_number_suffix_font_weight">
                  <option value="100" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['number_suffix_font_weight']) && $cssData['number_prefix_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Font Family</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_suffix_font_family" id="anc_6310_jquery_number_suffix_font" type="text" value="<?php echo isset($cssData['number_suffix_font_family']) && $cssData['number_suffix_font_family'] !== '' ? $cssData['number_suffix_font_family'] : 'Amaranth'; ?>" />
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Top/Bottom Position</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input type="number" name="number_suffix_position" id="anc_6310_number_suffix_position" class="anc-6310-form-input" value="<?php echo isset($cssData['number_suffix_position']) && $cssData['number_suffix_position'] !== '' ? $cssData['number_suffix_position'] : 2; ?>">
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Margin Left</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_suffix_margin_left" id="anc_6310_number_suffix_margin_left" type="number" value="<?php echo isset($cssData['number_suffix_margin_left']) && $cssData['number_suffix_margin_left'] !== '' ? $cssData['number_suffix_margin_left'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="suffix-act-field">
                <td><b>Margin Right</b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span></td>
                <td>
                  <input name="number_suffix_margin_right" id="anc_6310_number_suffix_margin_right" type="number" value="<?php echo isset($cssData['number_suffix_margin_right']) && $cssData['number_suffix_margin_right'] !== '' ? $cssData['number_suffix_margin_right'] : 0; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-6">
        <div class="row">
          <h3 class="anc-6310-tab-menu-settings">Button Settings</h3>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table" width="100%">
              <tr height="45">
                <td width="55%">
                  <b>Activate Button </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <label class="switch">
                    <input type="checkbox" <?php echo (isset($cssData['counter_button']) && $cssData['counter_button']) ? ' checked' : '' ?> name="counter_button" value="1" id="anc_6310_counter_button" class="anc-6310-form-input" />
                    <span class="slider round button_icon_show_hide"></span>
                  </label>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Background Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_background_color" id="anc_6310_button_background_color" class="anc-6310-form-input anc_6310_color_picker" step="1" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['button_background_color']) && $cssData['button_background_color'] !== '' ? $cssData['button_background_color'] : 'rgba(0, 158, 226, 1)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width="55%"><b>Background Hover Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_background_hover_color" id="anc_6310_button_background_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['button_background_hover_color']) && $cssData['button_background_hover_color'] !== '' ? $cssData['button_background_hover_color'] : 'rgba(7, 144, 204, 0.8)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Font Size </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="number" min="0" name="button_font_size" value="<?php echo isset($cssData['button_font_size']) && $cssData['button_font_size'] !== '' ? $cssData['button_font_size'] : 13; ?>" class="anc-6310-form-input" step="1" id="anc_6310_button_font_size" />
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Line Height </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input name="button_line_height" id="anc_6310_button_line_height" type="number" value="<?php echo isset($cssData['button_line_height']) && $cssData['button_line_height'] !== '' ? $cssData['button_line_height'] : 25; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Font Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_font_color" id="anc_6310_button_font_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['button_font_color']) && $cssData['button_font_color'] !== '' ? $cssData['button_font_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Font Hover Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_font_hover_color" id="anc_6310_button_font_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['button_font_hover_color']) && $cssData['button_font_hover_color'] !== '' ? $cssData['button_font_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Font Weight </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <select name="button_font_weight" class="anc-6310-form-input" id="anc_6310_button_font_weight">
                    <option value="100" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '100') echo " selected=''" ?>>100</option>
                    <option value="200" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '200') echo " selected=''" ?>>200</option>
                    <option value="300" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '300') echo " selected=''" ?>>300</option>
                    <option value="400" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '400') echo " selected=''" ?>>400</option>
                    <option value="500" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '500') echo " selected=''" ?>>500</option>
                    <option value="600" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '600') echo " selected=''" ?>>600</option>
                    <option value="700" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '700') echo " selected=''" ?>>700</option>
                    <option value="800" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '800') echo " selected=''" ?>>800</option>
                    <option value="900" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == '900') echo " selected=''" ?>>900</option>
                    <option value="normal" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == 'normal') echo " selected=''" ?>>Normal</option>
                    <option value="bold" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == 'bold') echo " selected=''" ?>>Bold</option>
                    <option value="lighter" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == 'lighter') echo " selected=''" ?>>Lighter</option>
                    <option value="initial" <?php if (isset($cssData['button_font_weight']) && $cssData['button_font_weight'] == 'initial') echo " selected=''" ?>>Initial</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Text Transform </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <select name="button_text_transform" class="anc-6310-form-input" id="anc_6310_button_text_transform">
                    <option value="capitalize" <?php if (isset($cssData['button_text_transform']) && $cssData['button_text_transform'] == 'capitalize') echo " selected=''" ?>>Capitalize</option>
                    <option value="uppercase" <?php if (isset($cssData['button_text_transform']) && $cssData['button_text_transform'] == 'uppercase') echo " selected=''" ?>>Uppercase</option>
                    <option value="lowercase" <?php if (isset($cssData['button_text_transform']) && $cssData['button_text_transform'] == 'lowercase') echo " selected=''" ?>>Lowercase</option>
                    <option value="none" <?php if (isset($cssData['button_text_transform']) && $cssData['button_text_transform'] == 'none') echo " selected=''" ?>>As Input</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Button Width </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="number" min="0" name="button_width" value="<?php echo isset($cssData['button_width']) && $cssData['button_width'] !== '' ? $cssData['button_width'] : 110; ?>" class="anc-6310-form-input" id="anc_6310_button_width" />
                </td>
              </tr>
            </table>
          </div>
          <div class="anc-6310-tab-6">
            <table class="table table-responsive anc_6310_admin_table">
              <tr height="45" class="button-act-field">
                <td><b>Font Family </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input name="button_font_family" id="anc_6310_jquery_button_font" type="text" value="<?php echo isset($cssData['button_font_family']) && $cssData['button_font_family'] !== '' ? str_replace("+", " ", $cssData['button_font_family']) : 'arimo'; ?>" />
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Button Align </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <select name="button_align" class="anc-6310-form-input" id="anc_6310_button_align">
                    <option value="center" <?php if (isset($cssData['button_align']) && $cssData['button_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['button_align']) && $cssData['button_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['button_align']) && $cssData['button_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Button Text Align </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <select name="button_text_align" class="anc-6310-form-input" id="anc_6310_button_text_align">
                    <option value="center" <?php if (isset($cssData['button_text_align']) && $cssData['button_text_align'] == 'center') echo " selected=''" ?>>Center</option>
                    <option value="left" <?php if (isset($cssData['button_text_align']) && $cssData['button_text_align'] == 'left') echo " selected=''" ?>>Left</option>
                    <option value="right" <?php if (isset($cssData['button_text_align']) && $cssData['button_text_align'] == 'right') echo " selected=''" ?>>Right</option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td width='55%'><b>Button Border Width </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <select name="button_border_width" class="anc-6310-form-input" id="anc_6310_button_border_width">
                    <option value="0px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '0px') echo " selected=''" ?>>None
                    </option>
                    <option value="1px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '1px') echo " selected=''" ?>>1px
                    </option>
                    <option value="2px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '2px') echo " selected=''" ?>>2px
                    </option>
                    <option value="3px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '3px') echo " selected=''" ?>>3px
                    </option>
                    <option value="4px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '4px') echo " selected=''" ?>>4px
                    </option>
                    <option value="5px" <?php if (isset($cssData['button_border_width']) && $cssData['button_border_width'] == '5px') echo " selected=''" ?>>5px
                    </option>
                  </select>
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Button Border Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_border_color" id="anc_6310_button_border_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['button_border_color']) && $cssData['button_border_color'] !== '' ? $cssData['button_border_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Button Border Hover Color </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="text" name="button_border_hover_color" id="anc_6310_button_border_hover_color" class="anc-6310-form-input anc_6310_color_picker" data-format="rgb" value="<?php echo isset($cssData['button_border_hover_color']) && $cssData['button_border_hover_color'] !== '' ? $cssData['button_border_hover_color'] : 'rgb(255, 255, 255)'; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Button Border Radius </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input type="number" name="button_border_radius" id="anc_6310_button_border_radius" class="anc-6310-form-input " value="<?php echo isset($cssData['button_border_radius']) && $cssData['button_border_radius'] !== '' ? $cssData['button_border_radius'] : 0; ?>">
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Margin Top </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input name="button_margin_top" id="anc_6310_button_margin_top" type="number" value="<?php echo isset($cssData['button_margin_top']) && $cssData['button_margin_top'] !== '' ? $cssData['button_margin_top'] : 10; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
              <tr height="45" class="button-act-field">
                <td><b>Margin Bottom </b> <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
                </td>
                <td>
                  <input name="button_margin_bottom" id="anc_6310_button_margin_bottom" type="number" value="<?php echo isset($cssData['button_margin_bottom']) && $cssData['button_margin_bottom'] !== '' ? $cssData['button_margin_bottom'] : 25; ?>" class="anc-6310-form-input" />
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div id="tab-7">
        <h3 class="anc-6310-tab-menu-settings">Custom CSS Settings</h3>
        <p for="" style="width: calc(100% - 30px); margin: 0 15px 5px; font-size: 14px; padding-top: 15px; color: #000"><b>Add Your Custom CSS Code Here </b> <span class="anc-6310-pro">(Pro)</span></p><br />
        <div class="css-area">
          <textarea class="codemirror-textarea" name="custom_css" rows="8" cols="50"><?php echo anc_6310_special_character_remove($cssData['custom_css']) ?></textarea>
        </div>
      </div>

      <br class="anc-6310-clear" />
      <br class="anc-6310-clear" />
      <hr />
      <input type="submit" name="update_style_change" value="Save" class="anc-6310-btn-primary anc-6310-pull-right" style="margin-right: 15px; margin-bottom: 10px; display: block" />
      <br class="anc-6310-clear" />
    </div>
  </form>
</div>