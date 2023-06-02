<?php
function anc_6310_animation_duration($selected){
   $list = [
      '500' => '0.5 Second',
      '600' => '0.6 Second',
      '700' => '0.7 Second',
      '800' => '0.8 Second',
      '900' => '0.9 Second',
      '1000' => '1.0 Second',
      '1100' => '1.1 Second',
      '1200' => '1.2 Second',
      '1300' => '1.3 Second',
      '1400' => '1.4 Second',
      '1500' => '1.5 Second',
      '1600' => '1.6 Second',
      '1700' => '1.7 Second',
      '1800' => '1.8 Second',
      '1900' => '1.9 Second',
      '2000' => '2.0 Second',
      '2500' => '2.5 Second',
      '3000' => '3.0 Second'
   ];
   echo "<select name='animation_duration' class='anc-6310-form-input'>";
   foreach($list as $key => $value){      
      if($key == $selected){
         echo "<option selected value='{$key}'>{$value}</option>";
      }
      else{
         echo "<option value='{$key}'>{$value}</option>";
      }       
   }
   for($i = 4; $i <= 60; $i++){
      $sel = $i * 1000 == $selected ? 'selected' : '';
      echo "<option {$sel} value='".($i * 1000)."'>{$i} Second</option>";
   }
   echo "</select>";
}
function anc_6310_get_user_roles(){
   if(!function_exists('wp_get_current_user')) {
      include(ABSPATH . "wp-includes/pluggable.php"); 
   }
   $current_user = wp_get_current_user();
   if(isset($current_user->roles[0]) && $current_user->roles[0] == 'editor'){
      return 'edit_posts';
   }
   return 'manage_options';
}
function anc_6310_number_format($number){
   $numbers = explode('.', $number);
   return ((isset($numbers[1]) && $numbers[1] > 0) ? strlen($numbers[1]) : 0);
}
function anc_6310_special_character_remove($data) {
   if($data == '') return ''; 
   else if(strlen($data) == 0) return ''; 
   while(strpos($data, "\\") !== false) {
         $data = str_replace("\\", "", $data);
   }
   return $data;
}

   function anc_6310_extract_data($data)
   {
      $array_key = "";
      $array_value = "";
      $i = 0;

      foreach ($data as $key => $value) {
         if ($i >= 2) {
            if ($array_value) {
               $array_key .= ",";
               $array_value .= "||##||";
            }
            $array_key .= $key;
            if ($key == "custom_css") {
               $array_value .= $value;
            } else {
               $array_value .= sanitize_text_field($value);
            }
         }
         $i++;
      }
      return $array_key . "!!##!!" . $array_value;
   }

   function anc_6310_split_code($ids, $data)
   {
      $css = "";
      $data1 = explode("}", $data);
      if ($data1) {
         foreach ($data1 as $step1) {
            if ($step1 &&  strlen($step1) > 2) {
               $data2 = explode("{", $step1);
               if ($data2) {
                  $data3 = explode(",", $data2[0]);
                  $r = "";
                  foreach ($data3 as $value) {
                     if ($r) {
                        $r .= ", ";
                     }
                     $r .= $value;
                  }
                  $css .= $r . "{" . $data2[1] . "}";
               }
            }
         }
      }
      return $css;
   }

   function anc_6310_link_css_js()
   {
      wp_enqueue_style('anc-6310-font-awesome-5-0-13', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
		wp_enqueue_style('anc-6310-codemirror-style', anc_6310_plugin_dir_url . 'assets/css/codemirror.min.css');
		wp_enqueue_style('anc-6310-color-style', anc_6310_plugin_dir_url . 'assets/css/jquery.minicolors.min.css');
		wp_enqueue_script('anc-6310-color-js', anc_6310_plugin_dir_url . 'assets/js/jquery.minicolors.min.js', array('jquery'));
      wp_enqueue_script('anc-6310-codemirror-js', anc_6310_plugin_dir_url . 'assets/js/codemirror.min.js', array('jquery'));
   }

   function anc_6310_number_counter_install()
   {
      global $wpdb;

      $style_table = $wpdb->prefix . 'anc_6310_style';
      $icon_table = $wpdb->prefix . 'anc_6310_icons';
      $counter_table = $wpdb->prefix . 'anc_6310_counter';
      $charset_collate = $wpdb->get_charset_collate();

      $sql1 = "CREATE TABLE IF NOT EXISTS $style_table (
        id int UNSIGNED NOT NULL AUTO_INCREMENT,
        name varchar(100) DEFAULT NULL,
        style_name varchar(100) DEFAULT NULL,
        css text DEFAULT NULL,
        counterids text DEFAULT NULL,
        PRIMARY KEY  (id)
      ) $charset_collate;";

      $sql2 = "CREATE TABLE IF NOT EXISTS $icon_table (
        id int UNSIGNED NOT NULL AUTO_INCREMENT,
        name varchar(100) DEFAULT NULL,
        class_name varchar(100) DEFAULT NULL,
        color varchar(100) DEFAULT NULL,
        bgcolor varchar(100) DEFAULT NULL,
        PRIMARY KEY  (id)
      ) $charset_collate;";

      $sql3 = "CREATE TABLE IF NOT EXISTS $counter_table (
        id int UNSIGNED NOT NULL AUTO_INCREMENT,
        title varchar(100) DEFAULT NULL,
        description text DEFAULT NULL,
        numbers_start varchar(100) DEFAULT 0,
        numbers varchar(100) DEFAULT NULL,
        icons varchar(100) DEFAULT NULL,
        readmore_text varchar(100) DEFAULT NULL,
        readmore_url text DEFAULT NULL,
        image text DEFAULT NULL,
        hoverimage text DEFAULT NULL,
        commons text DEFAULT NULL,
        styleid int DEFAULT NULL,
        PRIMARY KEY(id)
      ) $charset_collate;";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');     
      dbDelta($sql1);
      dbDelta($sql2);
      dbDelta($sql3);

      $iconData = $wpdb->query("select id from $icon_table LIMIT 1");
      if (!($iconData)) {
			$wpdb->query("INSERT INTO {$icon_table} (name, class_name, color, bgcolor) VALUES
				('Linkedin', 'fab fa-linkedin-in', '#ffffff', 'rgba(0, 119, 181, 1)'),
				('Twitter', 'fab fa-twitter', '#ffffff', 'rgba(85, 172, 238, 1)'),
				('Facebook', 'fab fa-facebook-f', '#ffffff', 'rgba(59, 89, 153, 1)'),
				('Skype', 'fab fa-skype', '#ffffff', 'rgba(0, 175, 240, 1)'),
				('Dropbox', 'fab fa-dropbox', '#ffffff', 'rgba(0, 126, 229, 1)'),
				('Wordpress', 'fab fa-wordpress', '#ffffff', 'rgba(33, 117, 155, 1)'),
				('vimeo', 'fab fa-vimeo-v', '#ffffff', 'rgba(26, 183, 234, 1)'),
				('Slideshare', 'fab fa-slideshare', '#ffffff', 'rgba(0, 119, 181, 1)'),
				('Vk', 'fab fa-vk', '#ffffff', 'rgba(76, 117, 163, 1)'),
				('Tumblr', 'fab fa-tumblr', '#ffffff', 'rgba(52, 70, 93, 1)'),
				('Yahoo', 'fab fa-yahoo', '#ffffff', 'rgba(65, 0, 147, 1)'),
				('Google Plus', 'fab fa-google-plus-g', '#ffffff', 'rgba(221, 75, 57, 1)'),
				('Pinterest', 'fab fa-pinterest-p', '#ffffff', 'rgba(189, 8, 28, 1)'),
				('Youtube', 'fab fa-youtube', '#ffffff', 'rgba(205, 32, 31, 1)'),
				('Stumbleupon', 'fab fa-stumbleupon', '#ffffff', 'rgba(235, 73, 36, 1)'),
				('Reddit', 'fab fa-reddit-alien', '#ffffff', 'rgba(255, 87, 0, 1)'),
				('Quora', 'fab fa-quora', '#ffffff', 'rgba(185, 43, 39, 1)'),
				('Yelp', 'fab fa-yelp', '#ffffff', 'rgba(175, 6, 6, 1)'),
				('Weibo', 'fab fa-weibo', '#fafafa', 'rgba(223, 32, 41, 1)'),
				('Producthunt', 'fab fa-product-hunt', '#ffffff', 'rgba(218, 85, 47, 1)'),
				('Hackernews', 'fab fa-hacker-news', '#ffffff', 'rgba(255, 102, 0, 1)'),
				('Soundcloud', 'fab fa-soundcloud', '#ffffff', 'rgba(255, 51, 0, 1)'),
				('Blogger', 'fab fa-blogger-b', '#ffffff', 'rgba(245, 125, 0, 1)'),
				('Whatsapp', 'fab fa-whatsapp', '#ffffff', 'rgba(37, 211, 102, 1)'),
				('Wechat', 'fab fa-weixin', '#ffffff', 'rgba(9, 184, 62, 1)'),
				('Medium', 'fab fa-medium-m', '#ffffff', 'rgba(2, 184, 117, 1)'),
				('Vine', 'fab fa-vine', '#ffffff', 'rgba(0, 180, 137, 1)'),
				('Slack', 'fab fa-slack-hash', '#ffffff', 'rgba(58, 175, 133, 1)'),
				('Instagram', 'fab fa-instagram', '#e4405f', 'rgba(255, 255, 255, 1)'),
				('Dribbble', 'fab fa-dribbble', '#ffffff', 'rgba(234, 76, 137, 1)'),
				('Flickr', 'fab fa-flickr', '#ffffff', 'rgba(255, 0, 132, 1)'),
				('Foursquare', 'fab fa-foursquare', '#ffffff', 'rgba(249, 72, 119, 1)'),
				('Behance', 'fab fa-behance', '#ffffff', 'rgba(19, 20, 24, 1)'),
				('Snapchat', 'fab fa-snapchat-ghost', '#ffffff', 'rgba(255, 252, 0, 1)'),
				('Paypal', 'fab fa-paypal', '#ffffff', 'rgba(0, 48, 135, 1)'),
				('Bandcamp', 'fab fa-bandcamp', '#ffffff', 'rgba(0, 150, 136, 1)'),
				('Email', 'fas fa-envelope', '#ffffff', 'rgba(0, 150, 136, 1)'),
				('Phone', 'fas fa-phone-square-alt', '#ffffff', 'rgba(0, 150, 136, 1)'),
				('Fax', 'fas fa-fax', '#ffffff', 'rgba(0, 150, 136, 1)')
				");
      }   

      $counter = $wpdb->query("select id from $counter_table LIMIT 1");
      if(!$counter){
         $description = 'Aolaboraively eenable vira niche markets Compe evsculate funcnal mndshare through forand goaloriented project.';
         $sql = "INSERT INTO {$counter_table} (title, description, numbers_start, numbers, icons, readmore_text, readmore_url, image) VALUES
         ('Work Completed', '{$description}', '10000', '500', 'fas fa-globe', 'Read More', 'https://www.wpmart.com/accordion-faq-pro', 'https://www.wpmart.org/wp-content/uploads/2020/counter/work-completed.png')
         ";
         $wpdb->query($sql);

         $sql = "INSERT INTO {$counter_table} (title, description, numbers, icons, readmore_text, readmore_url, image) VALUES
         ('Lines Of Code', '{$description}', '1427', 'fas fa-book-open', 'Read More', 'https://www.wpmart.com/accordion-faq-pro', 'https://www.wpmart.org/wp-content/uploads/2020/counter/work-completed.png')
         ";
         $wpdb->query($sql);

         $sql = "INSERT INTO {$counter_table} (title, description, numbers, icons, readmore_text, readmore_url, image) VALUES
         ('Cups Of Coffee', '{$description}', '2100', 'fas fa-university', 'Read More', 'https://www.wpmart.com/accordion-faq-pro', 'https://www.wpmart.org/wp-content/uploads/2020/counter/work-completed.png')
         ";
         $wpdb->query($sql);
      }
   }


   function anc_6310_add_or_edit_counter($id, $counter_order, $style_name)
   {
      global $wpdb;
      $style_table = $wpdb->prefix . 'anc_6310_style';
      $counter_table = $wpdb->prefix . 'anc_6310_counter';
      wp_enqueue_media();
?>
      <div class="anc_6310_add_media" style='margin-top: 30px'>
         <h6>Customize Counters</h6>
         <div class="anc_6310_add_media_body" id="anc_6310_add_or_edit_counter">
            <i class="fas fa-plus-circle anc_6310_add_media_add_new_icon"></i><br />
            Add/Edit Counters
         </div>
      </div>
      <br />
      <div class="anc_6310_add_media">
         <h6>
            Rearrange Counter
            <span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
         </h6>
         <div class="anc_6310_add_media_body" id="anc_6310_rearrange_counter">
            <i class="fas fa-cogs anc_6310_add_media_add_new_icon"></i>
         </div>
      </div>
      <br />
      <div class="anc_6310_add_media">
         <h6>Shortcode</h6>
         <div class="anc_6310_add_media_body_shortcode">
            <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value='[anc_6310_number_counter id="<?php echo $id; ?>"]' />
         </div>
      </div>
      <br />
      <div class="anc_6310_add_media">
         <h6>How to Use</h6>
         <div class="anc_6310_add_media_body">
            <a href="https://www.youtube.com/watch?v=g2edJTnyAvA" target="_blank">
               <i class="fas fa-video fa-2x"></i><br />
               Watch Video Tutorial
            </a>
         </div>
      </div>

      <?php
      $counterArray = [];
      $counterOrderList = [];
      $counterList = $wpdb->get_results("SELECT * FROM $counter_table order by title ASC", ARRAY_A);
      if($counterList){
         if($counter_order){
            foreach($counter_order as $co){
               if($co){
                  $results = $wpdb->get_row("SELECT * FROM $counter_table where id='".$co."'", ARRAY_A);
                  if ($results) {
                     $counterArray[] = $results;
                  }
               }
            }
         }
         $counterOrderList = $counterArray;

         foreach ($counterList as $allCounter) {
            if($counter_order && !in_array($allCounter['id'], $counter_order)){
               $counterArray[] = $allCounter;
            }
            else if(!$counter_order){
               $counterArray[] = $allCounter;
            }
         }
      }
         
      ?>
       <!-- Customize Counters -->
       <div id="anc_6310_add_or_edit_counter_modal" class="anc-6310-modal" style="display: none">
         <div class="anc-6310-modal-content anc-6310-modal-md">
            <form action="" method="post">
            <?php wp_nonce_field("anc_6310_nonce_add_edit_counter") ?>
               <input type="hidden" name="add_edit_counter_id" value="<?php echo $id ?>" />
               <div class="anc-6310-modal-header">
                  Customize Counter
                  <span class="anc-6310-close">&times;</span>
               </div>
               <div class="anc-6310-modal-body-form">
                  <table border="0" width="100%" cellpadding="0" cellspacing="0" class="anc-member-table">
                     <tr height="40" style="font-weight: bold; background: #ccc">
                        <td></td>
                        <td>Title</td>
                        <td>Numbers</td>
                        <td>Icon</td>
                     </tr>
                     <?php
                     if ($counterArray) {                                 
                        foreach ($counterArray as $allCounter) {
                           $checked = '';
                           if($counter_order && in_array($allCounter['id'], $counter_order)){
                              $checked = ' checked';
                           }
                           echo "<tr class='anc-row-select' id='{$allCounter['id']}' height='40'>";
                           echo "<td width='20'><input type='checkbox' name='counterid[]' value='{$allCounter['id']}' id='chk-box-{$allCounter['id']}' class='anc-row-select-checkbox' {$checked} /></td>";
                           echo "<td>".anc_6310_special_character_remove($allCounter['title'])."</td>";
                           echo "<td align='center' width='100'>{$allCounter['numbers']}</td>";
                           echo '<td width="60" align="center">' . (($allCounter['icons']) ? "<i class='{$allCounter['icons']}' style='font-size: 20px'></i>" : '---') . '</td>';
                           echo "</tr>";
                        }
                     }
                     else {
                        echo "
                           <tr>
                              <td colspan='3'>
                                 <h4><i class='fas fa-exclamation-circle'></i> No counter profile available. <a href='" . admin_url('admin.php?page=anc-6310-accordion-add-edit') . "' class='anc-6310-btn-success' id='add-accordion'>Create Counter Profile</a></h4>
                              </td>
                           </tr>
                        ";
                     }                   
                     ?>
                  </table>
               </div>
               <div class="anc-6310-modal-form-footer">
                  <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
                  <input type="submit" name="customize-counter-save" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" value="Save" />
               </div>
            </form>
            <br class="anc-6310-clear" />
         </div>
      </div>

      <!-- Rearrange Counter -->
      <div id="anc_6310_rearrange_counter_modal" class="anc-6310-modal" style="display: none">
         <div class="anc-6310-modal-content anc-6310-modal-sm">
            <form action="" method="post">
            <?php wp_nonce_field("anc_6310_nonce_rearrange_counter") ?>
               <input type="hidden" name="rearrange_counter_id" value="<?php echo $id ?>" />
               <input type="hidden" name="rearrange_counter_list" id="rearrange_counter_list" value="<?php echo implode(',', $counter_order) ?>" />
               <div class="anc-6310-modal-header">
                  Rearrange Counter
                  <span class="anc-6310-close">&times;</span>
               </div>
               <div class="anc-6310-modal-body-form">
                  <ul id="anc-6310-sortable-counter">
                     <?php   
                        if($counterOrderList) {
                           foreach ($counterOrderList as $allCounter) {
                              echo "<li class='ui-state-default anc-6310-ui-state-default' id='{$allCounter['id']}'>".anc_6310_special_character_remove($allCounter['title'])."</li>";
                           }        
                        }
                        else {
                           echo "
                              <div>
                                 <h4 style='text-align: center'><i class='fas fa-exclamation-circle'></i> No counter profile available. <a href='" . admin_url('admin.php?page=anc-6310-accordion-add-edit') . "' class='anc-6310-btn-success' id='add-accordion'>Create Counter Profile</a></h4>
                              </div>
                           ";
                        }      
                     ?>
                  </ul>
               </div>
               <?php
               if ($counterOrderList) {
               ?>
               <div class="anc-6310-modal-form-footer">
                  <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
                  <input type="submit" name="rearrange-counter-save" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" id="anc-6310-sortable-counter-sub" value="Save" />
               </div>
               <?php } ?>
            </form>
            <br class="anc-6310-clear" />
         </div>
      </div>

      <style>
      .anc_6310_6310-ui-state-default{
         padding: 8px 10px;
         cursor: move;
         border-radius: 3px;
      }
   </style>
   <script>
      
      jQuery(function () {
         jQuery("#anc-6310-sortable-counter").sortable();
         jQuery("#anc-6310-sortable-counter").disableSelection();
      });
      jQuery(document).ready(function () {
         //Add/Edit Counter Start
         jQuery("body").on("click", ".anc-row-select-checkbox", function (event) {
            event.stopPropagation();
         });
         jQuery("body").on("click", ".anc-row-select", function () {
            var id = jQuery(this).attr("id");
            if (jQuery("#chk-box-" + id).prop('checked') == true) {
               jQuery("#chk-box-" + id).prop('checked', false);
               return false;
            } else {
               jQuery("#chk-box-" + id).prop('checked', true);
               return true;
            }
         });

         

         jQuery("#anc-6310-sortable-counter-sub").click(function () {
            var list_sortable = jQuery('#anc-6310-sortable-counter').sortable('toArray').toString();
            jQuery("#rearrange_counter_list").val(list_sortable);
         });

         jQuery("body").on("click", "#anc_6310_add_or_edit_counter", function () {
            jQuery("#anc_6310_add_or_edit_counter_modal").fadeIn(500);
            jQuery("body").css({
               "overflow": "hidden"
            });
            return false;
         });

         

         jQuery("body").on("click", "#anc_6310_rearrange_counter", function () {
            jQuery("#anc_6310_rearrange_counter_modal").fadeIn(500);
            jQuery("body").css({
               "overflow": "hidden"
            });
            return false;
         });

         jQuery("body").on("click", "#anc_6310_add_new_media", function () {
            jQuery("#anc_6310_add_new_media_modal").fadeIn(500);
            jQuery("body").css({
               "overflow": "hidden"
            });
            return false;
         });
         jQuery("body").on("click", ".anc-6310-close, .anc-6310-btn-danger", function () {
            jQuery("#anc_6310_add_new_media_modal, #anc_6310_rearrange_counter_modal, #anc_6310_add_or_edit_counter_modal").fadeOut(500);
            jQuery("body").css({
               "overflow": "initial"
            });
         });
         jQuery(window).click(function (event) {
            if (event.target == document.getElementById('anc_6310_rearrange_counter_modal')) {
               jQuery("#anc_6310_rearrange_counter_modal").fadeOut(500);
               jQuery("body").css({
                  "overflow": "initial"
               });
            }
            if (event.target == document.getElementById('anc_6310_add_or_edit_counter_modal')) {
               jQuery("#anc_6310_add_or_edit_counter_modal").fadeOut(500);
               jQuery("body").css({
                  "overflow": "initial"
               });
            }
            if (event.target == document.getElementById('anc_6310_add_new_media_modal')) {
               jQuery("#anc_6310_add_new_media_modal").fadeOut(500);
               jQuery("body").css({
                  "overflow": "initial"
               });
            }
         });
      });
   </script>

      <?php 
      }


   function anc_6310_color_picker_script()
   {
   ?>
      <script>
         jQuery(document).ready(function() {
            jQuery('.anc_6310_color_picker').each(function() {
               jQuery(this).minicolors({
                  control: jQuery(this).attr('data-control') || 'hue',
                  defaultValue: jQuery(this).attr('data-defaultValue') || '',
                  format: jQuery(this).attr('data-format') || 'hex',
                  keywords: jQuery(this).attr('data-keywords') || '',
                  inline: jQuery(this).attr('data-inline') === 'true',
                  letterCase: jQuery(this).attr('data-letterCase') || 'lowercase',
                  opacity: jQuery(this).attr('data-opacity'),
                  position: jQuery(this).attr('data-position') || 'bottom left',
                  swatches: jQuery(this).attr('data-swatches') ? jQuery(this).attr('data-swatches').split('|') : [],
                  change: function(value, opacity) {
                     if (!value)
                        return;
                     if (opacity)
                        value += ', ' + opacity;
                     if (typeof console === 'object') {
                        console.log(value);
                     }
                  },
                  theme: 'bootstrap'
               });
            });
         });
      </script>
   <?php
   }

   function anc_6310_font_picker_script()
   {
   ?>
      <script>
         var $ = jQuery;
         jQuery(document).ready(function() {
            jQuery('#anc_6310_jquery_button_font, #anc_6310_jquery_heading_font, #anc_6310_jquery_designation_font, #anc_6310_jquery_heading_font_style1, #anc_6310_jquery_designation_font_style1, #anc_6310_jquery_heading_font_style, #anc_6310_jquery_designation_font_style, #anc-6310-front-end-load, #anc_6310_jquery_description_font, #anc_6310_jquery_contact_font, #anc_6310_jquery_profile_details_font, #anc_6310_jquery_category_font_family, #anc_6310_jquery_read_more_font_family, #anc_6310_jquery_number_font, #anc_6310_jquery_number_prefix_font, #anc_6310_jquery_number_suffix_font').fontselect();
         });
      </script>
   <?php
   }


   function anc_6310_items_per_row($id, $rows = NULL)
   {
   ?>
      <div id="anc-6310-modal-add" class="anc-6310-modal" style="display: none">
         <div class="anc-6310-modal-content anc-6310-modal-sm">
            <form action="" method="post">
               <div class="anc-6310-modal-header">
                  Numbers of item per row
                  <span class="anc-6310-close">&times;</span>
               </div>
               <div class="anc-6310-modal-body-form">
                  <?php wp_nonce_field("anc_6310_nonce_field_form") ?>
                  <input type="hidden" name="id" value="<?php echo $id ?>" />
                  <table border="0" width="100%" cellpadding="10" cellspacing="0">
                     <tr>
                        <td width="50%"><label class="anc-6310-form-label" for="icon_name">Item Per Row:</label></td>
                        <td>
                           <select name="item_per_row_data" class="anc-6310-form-input">
                              <option value="1" <?php if ($rows == 1) echo " selected" ?>>1 Item per Row</option>
                              <option value="2" <?php if ($rows == 2) echo " selected" ?>>2 Items per Row</option>
                              <option value="3" <?php if ($rows == 3) echo " selected" ?>>3 Items per Row</option>
                              <option value="4" <?php if ($rows == 4) echo " selected" ?>>4 Items per Row</option>
                              <option value="5" <?php if ($rows == 5) echo " selected" ?>>5 Items per Row</option>
                              <option value="6" <?php if ($rows == 6) echo " selected" ?>>6 Items per Row</option>
                           </select>
                        </td>
                     </tr>
                  </table>

               </div>
               <div class="anc-6310-modal-form-footer">
                  <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
                  <input type="submit" name="item_per_row_sub" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" value="Update" />
               </div>
            </form>
            <br class="anc-6310-clear" />
         </div>
      </div>
      <script>
         var $ = jQuery;
         jQuery(document).ready(function() {
            jQuery("body").on("click", "#anc_6310_items_per_row", function() {
               jQuery("#anc-6310-modal-add").fadeIn(500);
               jQuery("body").css({
                  "overflow": "hidden"
               });
               return false;
            });

            jQuery("body").on("click", ".anc-6310-close, .anc-6310-btn-danger", function() {
               jQuery("#anc-6310-modal-add, #anc-6310-modal-edit").fadeOut(500);
               jQuery("body").css({
                  "overflow": "initial"
               });
            });
            jQuery(window).click(function(event) {
               if (event.target == document.getElementById('anc-6310-modal-add')) {
                  jQuery("#anc-6310-modal-add").fadeOut(500);
                  jQuery("body").css({
                     "overflow": "initial"
                  });
               } else if (event.target == document.getElementById('anc-6310-modal-edit')) {
                  jQuery("#anc-6310-modal-edit").fadeOut(500);
                  jQuery("body").css({
                     "overflow": "initial"
                  });
               }
            });

         });
      </script>
   <?php
   }



   function anc_6310_no_preview_available()
   {
   ?>
      <div class="anc-6310-no-preview-available">No preview available <br />for this option.</div>
      <script>
         jQuery(document).ready(function() {
            jQuery("body").on("change", ".anc-6310-no-preview", function(e) {
               e.preventDefault();
               $('.anc-6310-no-preview-available').fadeIn().delay(3000).fadeOut();
            });
            jQuery("body").on("blur", "input[name='social_border_width']", function(e) {
               e.preventDefault();
               $('.anc-6310-no-preview-available').fadeIn().delay(3000).fadeOut();
            });
         });
      </script>
<?php
   }


   if (!function_exists('anc_6310_version_status')) {
      function anc_6310_version_status() {
         global $wpdb;
         $db_version = get_option( 'anc_6310_version_info');
         if(!$db_version){
               $wpdb->query("INSERT INTO {$wpdb->prefix}options(option_name, option_value) VALUES ('anc_6310_version_info', '".anc_6310_PLUGIN_CURRENT_VERSION."')");
         }
         else{
            $key = get_option( 'anc_6310_license_key');
            if($db_version != anc_6310_PLUGIN_CURRENT_VERSION && $key){
               anc_6310_check_license($key, true);
               $wpdb->query("UPDATE {$wpdb->prefix}options set 
                           option_value='". anc_6310_PLUGIN_CURRENT_VERSION ."' 
                           where option_name = 'anc_6310_version_info'");
            }	
         }
      } 
   }
   
   if (!function_exists('anc_6310_check_license')) {
      function anc_6310_check_license($key, $autoUpdate = false)
      {
         global $wpdb;
   
         $db_key = get_option('anc_6310_license_key');
         if(!$db_key){
            $wpdb->query($wpdb->prepare("INSERT INTO {$wpdb->prefix}options SET option_name = %s, option_value = %s", 'anc_6310_license_key', "{$key}"));
            if(!$wpdb->insert_id) {
               $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}options SET option_value = %s where option_name = %s", "{$key}", 'anc_6310_license_key'));
            }
         }else if($db_key != $key){
            $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}options SET option_value = %s where option_name = %s", "{$key}", 'anc_6310_license_key'));
         }
         
         if(!class_exists('ZipArchive')){
            $api_params = array(
               'edd_action' => 'activate_license',
               'license' => $key,
               'item_name' => urlencode('Animated Number Counter'),
               'url' => home_url(),
               'type' => 'anc'
            );
            $url = "http://demo.tcsesoft.com/";
            $response = wp_remote_post($url, array("body" => $api_params));
            $license_data = json_decode(wp_remote_retrieve_body($response));
      
            if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
               if (is_wp_error($response)) {
                  $message = $response->get_error_message();
               } else {
                  $message = __('An error occurred, please try again.');
               }
            } else {
               if (false === $license_data->success) {
                  switch ($license_data->error) {
                     case 'invalid_key':
                        $message = __('<p class="anc_6310_error-message">Your have enter invalid license key.</p>');
                        break;
                     case 'site_inactive':
                        $message = __('<p class="anc_6310_error-message">Your license is not active for this URL.</p>');
                        break;
                     default:
                        $message = __('<p class="anc_6310_error-message">An error occurred, please try again.</p>');
                        break;
                  }
                  return;
               }
            }
      
            if (!empty($message)) {
               echo $message;
               return;
            }
      
         
            if (!function_exists('download_url')) {
               require_once ABSPATH . 'wp-admin/includes/file.php';
               require_once(ABSPATH . 'wp-includes/pluggable.php');
            }
      
            $file_url = $license_data->download_url;
            $tmp_file = download_url($file_url);
            $filepath = ABSPATH . 'wp-content/plugins';
            WP_Filesystem();
            $unzipfile = unzip_file($tmp_file, $filepath);
      
            if (is_wp_error($unzipfile)) {
               echo '<p class="anc_6310_error-message">There was an error unzipping the file.</p>';
               return;
            } else {
               
               if(!$autoUpdate){
                  echo "<p class='anc_6310_success-message'>Congratulations! Your license activated successfully.</p>";		
                  wp_remote_post($url, array("body" => ['file_name' => $license_data->file_name]));
                  return;
               }				
            }
            
         
   
   
            echo "<p style='font-size: 16px; color: red;'><b>Activation Error: </b> ZipArchive extension is not activated in your cPanel. Please check the video on how to activate it.</p>";
            echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/6Lv1psR94_A" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> <br /><br />';
            return;
         }
         
      
   
         $api_params = array(
            'edd_action' => 'activate_license',
            'license' => $key,
            'item_name' => urlencode('Animated Number Counter'),
            'url' => home_url(),
            'type' => 'anc'
         );
         $url = "http://demo.tcsesoft.com/";
         $response = wp_remote_post($url, array("body" => $api_params));
         $license_data = json_decode(wp_remote_retrieve_body($response));
   
         if (is_wp_error($response) || 200 !== wp_remote_retrieve_response_code($response)) {
            if (is_wp_error($response)) {
               $message = $response->get_error_message();
            } else {
               $message = __('An error occurred, please try again.');
            }
         } else {
            if (false === $license_data->success) {
               switch ($license_data->error) {
                  case 'invalid_key':
                     $message = __('<p class="anc_6310_error-message">Your have enter invalid license key.</p>');
                     break;
                  case 'site_inactive':
                     $message = __('<p class="anc_6310_error-message">Your license is not active for this URL.</p>');
                     break;
                  default:
                     $message = __('<p class="anc_6310_error-message">An error occurred, please try again.</p>');
                     break;
               }
            }
         }
   
         if (!empty($message)) {
            echo $message;
            return;
         }
   
         if (!function_exists('download_url')) {
            require_once ABSPATH . 'wp-admin/includes/file.php';
            require_once(ABSPATH . 'wp-includes/pluggable.php');
         }
         $file_url = $license_data->download_url;
         $tmp_file = download_url($file_url);
         $filepath = WP_CONTENT_DIR . '/plugins';
         WP_Filesystem();
         copy($tmp_file, $filepath . "/{$license_data->file_name}");
         @unlink($tmp_file);
   
         $zip = new ZipArchive;
         $res = $zip->open($filepath . "/{$license_data->file_name}");
         if (!$res) {
            echo '<p class="anc_6310_error-message">There was an error unzipping the file.</p>';
         } else {
            $zip->extractTo($filepath . "/");
            $zip->close();
         
            if(!$autoUpdate){
               echo "<p class='anc_6310_success-message'>Congratulations! Your license activated successfully.</p>";		
            }				
         }
         wp_remote_post($url, array("body" => ['file_name' => $license_data->file_name]));
      }
   }

   function anc_6310_fa_icon_list($startTag, $endTag) {
      $iconArray = array (
         'fab fa-500px' => ['500px', '\f26e'],
         'fab fa-accessible-icon' => ['accessibility, handicap, person, wheelchair, wheelchair-alt', '\f368'],
         'fab fa-accusoft' => ['Accusoft', '\f369'],
         'fab fa-acquisitions-incorporated' => ['Dungeons & Dragons, d&d, dnd, fantasy, game, gaming, tabletop', '\f6af'],
         'fas fa-ad' => ['advertisement, media, newspaper, promotion, publicity', '\f641'],
         'fas fa-address-book' => ['contact, directory, index, little black book, rolodex', '\f2b9'],
         'fas fa-address-card' => ['about, contact, id, identification, postcard, profile', '\f2bb'],
         'fas fa-adjust' => ['contrast, dark, light, saturation', '\f042'],
         'fab fa-adn' => ['App.net', '\f170'],
         'fab fa-adversal' => ['Adversal', '\f36a'],
         'fab fa-affiliatetheme' => ['affiliatetheme', '\f36b'],
         'fas fa-air-freshener' => ['car, deodorize, fresh, pine, scent', '\f5d0'],
         'fab fa-airbnb' => ['Airbnb', '\f834'],
         'fab fa-algolia' => ['Algolia', '\f36c'],
         'fas fa-align-center' => ['format, middle, paragraph, text', '\f037'],
         'fas fa-align-justify' => ['format, paragraph, text', '\f039'],
         'fas fa-align-left' => ['format, paragraph, text', '\f036'],
         'fas fa-align-right' => ['format, paragraph, text', '\f038'],
         'fab fa-alipay' => ['Alipay', '\f642'],
         'fas fa-allergies' => ['allergy, freckles, hand, hives, pox, skin, spots', '\f461'],
         'fab fa-amazon' => ['Amazon', '\f270'],
         'fab fa-amazon-pay' => ['Amazon Pay', '\f42c'],
         'fas fa-ambulance' => ['covid-19, emergency, emt, er, help, hospital, support, vehicle', '\f0f9'],
         'fas fa-american-sign-language-interpreting' => ['asl, deaf, finger, hand, interpret, speak', '\f2a3'],
         'fab fa-amilia' => ['Amilia', '\f36d'],
         'fas fa-anchor' => ['berth, boat, dock, embed, link, maritime, moor, secure', '\f13d'],
         'fab fa-android' => ['robot', '\f17b'],
         'fab fa-angellist' => ['AngelList', '\f209'],
         'fas fa-angle-double-down' => ['arrows, caret, download, expand', '\f103'],
         'fas fa-angle-double-left' => ['arrows, back, caret, laquo, previous, quote', '\f100'],
         'fas fa-angle-double-right' => ['arrows, caret, forward, more, next, quote, raquo', '\f101'],
         'fas fa-angle-double-up' => ['arrows, caret, collapse, upload', '\f102'],
         'fas fa-angle-down' => ['arrow, caret, download, expand', '\f107'],
         'fas fa-angle-left' => ['arrow, back, caret, less, previous', '\f104'],
         'fas fa-angle-right' => ['arrow, care, forward, more, next', '\f105'],
         'fas fa-angle-up' => ['arrow, caret, collapse, upload', '\f106'],
         'fas fa-angry' => ['disapprove, emoticon, face, mad, upset', '\f556'],
         'fab fa-angrycreative' => ['Angry Creative', '\f36e'],
         'fab fa-angular' => ['Angular', '\f420'],
         'fas fa-ankh' => ['amulet, copper, coptic christianity, copts, crux ansata, egypt, venus', '\f644'],
         'fab fa-app-store' => ['App Store', '\f36f'],
         'fab fa-app-store-ios' => ['iOS App Store', '\f370'],
         'fab fa-apper' => ['Apper Systems AB', '\f371'],
         'fab fa-apple' => ['fruit, ios, mac, operating system, os, osx', '\f179'],
         'fas fa-apple-alt' => ['fall, fruit, fuji, macintosh, orchard, seasonal, vegan', '\f5d1'],
         'fab fa-apple-pay' => ['Apple Pay ', '\f415'],
         'fas fa-archive' => ['box, package, save, storage', '\f187'],
         'fas fa-archway' => ['arc, monument, road, street, tunnel', '\f557'],
         'fas fa-arrow-alt-circle-down' => ['arrow-circle-o-down, download', '\f358'],
         'fas fa-arrow-alt-circle-left' => ['arrow-circle-o-left, back, previous', '\f359'],
         'fas fa-arrow-alt-circle-right' => ['arrow-circle-o-right, forward, next', '\f35a'],
         'fas fa-arrow-alt-circle-up' => ['arrow-circle-o-up', '\f35b'],
         'fas fa-arrow-circle-down' => ['download', '\f0ab'],
         'fas fa-arrow-circle-left' => ['back, previous', '\f0a8'],
         'fas fa-arrow-circle-right' => ['forward, next', '\f0a9'],
         'fas fa-arrow-circle-up' => ['upload', '\f0aa'],
         'fas fa-arrow-down' => ['download', '\f063'],
         'fas fa-arrow-left' => ['back, previous', '\f060'],
         'fas fa-arrow-right' => ['forward, next', '\f061'],
         'fas fa-arrow-up' => ['forward, upload', '\f062'],
         'fas fa-arrows-alt' => ['arrow, arrows, bigger, enlarge, expand, fullscreen, move, position, reorder, resize', '\f0b2'],
         'fas fa-arrows-alt-h' => ['arrows-h, expand, horizontal, landscape, resize, wide', '\f337'],
         'fas fa-arrows-alt-v' => ['arrows-v, expand, portrait, resize, tall, vertical', '\f338'],
         'fab fa-artstation' => ['Artstation', '\f77a'],
         'fas fa-assistive-listening-systems' => ['amplify, audio, deaf, ear, headset, hearing, sound', '\f2a2'],
         'fas fa-asterisk' => ['annotation, details, reference, star', '\f069'],
         'fab fa-asymmetrik' => ['Asymmetrik, Ltd', '\f372'],
         'fas fa-at' => ['address, author, e-mail, email, handle', '\f1fa'],
         'fas fa-atlas' => ['book, directions, geography, globe, map, travel, wayfinding', '\f558'],
         'fab fa-atlassian' => ['Atlassian', '\f77b'],
         'fas fa-atom' => ['atheism, chemistry, electron, ion, isotope, neutron, nuclear, proton, science', '\f5d2'],
         'fab fa-audible' => ['Audible', '\f373'],
         'fas fa-audio-description' => ['blind, narration, video, visual', '\f29e'],
         'fab fa-autoprefixer' => ['Autoprefixer', '\f41c'],
         'fab fa-avianex' => ['avianex ', '\f374'],
         'fab fa-aviato' => ['Aviato', '\f421'],
         'fas fa-award' => ['honor, praise, prize, recognition, ribbon, trophy', '\f559'],
         'fab fa-aws' => ['Amazon Web Services (AWS)', '\f375'],
         'fas fa-baby' => ['child, diaper, doll, human, infant, kid, offspring, person, sprout', '\f77c'],
         'fas fa-baby-carriage' => ['buggy, carrier, infant, push, stroller, transportation, walk, wheels', '\f77d'],
         'fas fa-backspace' => ['command, delete, erase, keyboard, undo', '\f55a'],
         'fas fa-backward' => ['previous, rewind', '\f04a'],
         'fas fa-bacon' => ['blt, breakfast, ham, lard, meat, pancetta, pork, rasher', '\f7e5'],
         'fas fa-bahai' => ["bahai, bahá'í, star", '\f666'],
         'fas fa-balance-scale' => ['balanced, justice, legal, measure, weight', '\f24e'],
         'fas fa-balance-scale-left' => ['justice, legal, measure, unbalanced, weight', '\f515'],
         'fas fa-balance-scale-right' => ['justice, legal, measure, unbalanced, weight', '\f516'],
         'fas fa-ban' => ['abort, ban, block, cancel, delete, hide, prohibit, remove, stop, trash', '\f05e'],
         'fas fa-band-aid' => ['bandage, boo boo, first aid, ouch', '\f462'],
         'fab fa-bandcamp' => ['Bandcamp ', '\f2d5'],
         'fas fa-barcode' => ['info, laser, price, scan, upc', '\f02a'],
         'fas fa-bars' => ['checklist, drag, hamburger, list, menu, nav, navigation, ol, reorder, settings, todo, ul', '\f0c9'],
         'fas fa-baseball-ball' => ['foul, hardball, league, leather, mlb, softball, sport', '\f433'],
         'fas fa-basketball-ball' => ['dribble, dunk, hoop, nba', '\f434'],
         'fas fa-bath' => ['clean, shower, tub, wash', '\f2cd'],
         'fas fa-battery-empty' => ['charge, dead, power, status', '\f244'],
         'fas fa-battery-full' => ['charge, power, status', '\f240'],
         'fas fa-battery-half' => ['charge, power, status', '\f242'],
         'fas fa-battery-quarter' => ['charge, low, power, status', '\f243'],
         'fas fa-battery-three-quarters' => ['charge, power, status', '\f241'],
         'fab fa-battle-net' => ['Battle.net', '\f835'],
         'fas fa-bed' => ['lodging, mattress, rest, sleep, travel', '\f236'],
         'fas fa-beer' => ['alcohol, ale, bar, beverage, brewery, drink, lager, liquor, mug, stein', '\f0fc'],
         'fab fa-behance' => ['Behance ', '\f1b4'],
         'fab fa-behance-square' => ['Behance Square', '\f1b5'],
         'fas fa-bell' => ['alarm, alert, chime, notification, reminder', '\f0f3'],
         'fas fa-bell-slash' => ['alert, cancel, disabled, notification, off, reminder', '\f1f6'],
         'fas fa-bezier-curve' => ['curves, illustrator, lines, path, vector', '\f55b'],
         'fas fa-bible' => ['book, catholicism, christianity, god, holy', '\f647'],
         'fas fa-bicycle' => ['bike, gears, pedal, transportation, vehicle', '\f206'],
         'fas fa-biking' => ['bicycle, bike, cycle, cycling, ride, wheel', '\f84a'],
         'fab fa-bimobject' => ['BIMobject ', '\f378'],
         'fas fa-binoculars' => ['glasses, magnify, scenic, spyglass, view', '\f1e5'],
         'fas fa-biohazard ' => ['covid-19, danger, dangerous, hazmat, medical, radioactive, toxic, waste, zombie', '\f780'],
         'fas fa-birthday-cake' => ['anniversary, bakery, candles, celebration, dessert, frosting, holiday, party, pastry', '\f1fd'],
         'fab fa-bitbucket' => ['atlassian, bitbucket-square, git', '\f171'],
         'fab fa-bitcoin' => ['Bitcoin', '\f379'],
         'fab fa-bity' => ['Bity', '\f37a'],
         'fab fa-black-tie' => ['Font Awesome Black Tie', '\f27e'],
         'fab fa-blackberry' => ['BlackBerry', '\f37b'],
         'fas fa-blender' => ['cocktail, milkshake, mixer, puree, smoothie', '\f517'],
         'fas fa-blender-phone' => ['appliance, cocktail, communication, fantasy, milkshake, mixer, puree, silly, smoothie', '\f6b6'],
         'fas fa-blind' => ['cane, disability, person, sight', '\f29d'],
         'fas fa-blog' => ['journal, log, online, personal, post, web 2.0, wordpress, writing', '\f781'],
         'fab fa-blogger' => ['Blogger', '\f37c'],
         'fab fa-blogger-b' => ['Blogger B', '\f37d'],
         'fab fa-bluetooth' => ['Bluetooth', '\f293'],
         'fab fa-bluetooth-b' => ['Bluetooth ', '\f294'],
         'fas fa-bold' => ['emphasis, format, text', '\f032'],
         'fas fa-bolt' => ['electricity, lightning, weather, zap', '\f0e7'],
         'fas fa-bomb' => ['error, explode, fuse, grenade, warning', '\f1e2'],
         'fas fa-bone' => ['calcium, dog, skeletal, skeleton, tibia', '\f5d7'],
         'fas fa-bong' => ['aparatus, cannabis, marijuana, pipe, smoke, smoking', '\f55c'],
         'fas fa-book' => ['diary, documentation, journal, library, read', '\f02d'],
         'fas fa-book-dead' => ['Dungeons & Dragons, crossbones, d&d, dark arts, death, dnd, documentation, evil, fantasy, halloween, holiday, necronomicon, read, skull, spell', '\f6b7'],
         'fas fa-book-medical' => ['diary, documentation, health, history, journal, library, read, record', '\f7e6'],
         'fas fa-book-open' => ['flyer, library, notebook, open book, pamphlet, reading', '\f518'],
         'fas fa-book-reader' => ['flyer, library, notebook, open book, pamphlet, reading', '\f5da'],
         'fas fa-bookmark' => ['favorite, marker, read, remember, save', '\f02e'],
         'fab fa-bootstrap' => ['Bootstrap ', '\f836'],
         'fas fa-border-all' => ['cell, grid, outline, stroke, table', '\f84c'],
         'fas fa-border-none' => ['cell, grid, outline, stroke, table', '\f850'],
         'fas fa-border-style' => ['Border Style', '\f853'],
         'fas fa-bowling-ball' => ['alley, candlepin, gutter, lane, strike, tenpin', '\f436'],
         'fas fa-box' => ['archive, container, package, storage', '\f466'],
         'fas fa-box-open' => ['archive, container, package, storage, unpack', '\f49e'],
         'fas fa-box-tissue' => ['cough, covid-19, kleenex, mucus, nose, sneeze, snot', '\f95b'],
         'fas fa-boxes' => ['archives, inventory, storage, warehouse', '\f468'],
         'fas fa-braille' => ['alphabet, blind, dots, raised, vision', '\f2a1'],
         'fas fa-brain' => ['cerebellum, gray matter, intellect, medulla oblongata, mind, noodle, wit', '\f5dc'],
         'fas fa-bread-slice' => ['bake, bakery, baking, dough, flour, gluten, grain, sandwich, sourdough, toast, wheat, yeast', '\f7ec'],
         'fas fa-briefcase' => ['ag, business, luggage, office, work', '\f0b1'],
         'fas fa-briefcase-medical' => ['doctor, emt, first aid, health', '\f469'],
         'fas fa-broadcast-tower' => ['airwaves, antenna, radio, reception, waves', '\f519'],
         'fas fa-broom' => ['clean, firebolt, fly, halloween, nimbus 2000, quidditch, sweep, witch', '\f51a'],
         'fas fa-brush' => ['art, bristles, color, handle, paint', '\f55d'],
         'fab fa-btc' => ['BTC', '\f15a'],
         'fab fa-buffer' => ['Buffer ', '\f837'],
         'fas fa-bug' => ['beetle, error, insect, report', '\f188'],
         'fas fa-building' => ['apartment, business, city, company, office, work', '\f1ad'],
         'fas fa-bullhorn' => ['announcement, broadcast, louder, megaphone, share', '\f0a1'],
         'fas fa-bullseye' => ['archery, goal, objective, target', '\f140'],
         'fas fa-burn' => ['caliente, energy, fire, flame, gas, heat, hot', '\f46a'],
         'fab fa-buromobelexperte' => ['Büromöbel-Experte GmbH & Co. KG.', '\f37f'],
         'fas fa-bus' => ['public transportation, transportation, travel, vehicle', '\f207'],
         'fas fa-bus-alt' => ['mta, public transportation, transportation, travel, vehicle', '\f55e'],
         'fas fa-business-time' => ['alarm, briefcase, business socks, clock, flight of the conchords, reminder, wednesday', '\f64a'],
         'fab fa-buy-n-large' => ['Buy n Large', '\f8a6'],
         'fab fa-buysellads' => ['BuySellAds', '\f20d'],
         'fas fa-calculator' => ['abacus, addition, arithmetic, counting, math, multiplication, subtraction', '\f1ec'],
         'fas fa-calendar' => ['calendar-o, date, event, schedule, time, when', '\f133'],
         'fas fa-calendar-alt' => ['calendar, date, event, schedule, time, when', '\f073'],
         'fas fa-calendar-check' => ['accept, agree, appointment, confirm, correct, date, done, event, ok, schedule, select, success, tick, time, todo, when', '\f274'],
         'fas fa-calendar-day' => ['date, detail, event, focus, schedule, single day, time, today, when', '\f783'],
         'fas fa-calendar-minus' => ['calendar, date, delete, event, negative, remove, schedule, time, when', '\f272'],
         'fas fa-calendar-plus' => ['add, calendar, create, date, event, new, positive, schedule, time, when', '\f271'],
         'fas fa-calendar-times ' => ['archive, calendar, date, delete, event, remove, schedule, time, when, x', '\f273'],
         'fas fa-calendar-week' => ['date, detail, event, focus, schedule, single week, time, today, when', '\f784'],
         'fas fa-camera' => ['image, lens, photo, picture, record, shutter, video', '\f030'],
         'fas fa-camera-retro' => ['image, lens, photo, picture, record, shutter, video', '\f083'],
         'fas fa-campground' => ['camping, fall, outdoors, teepee, tent, tipi', '\f6bb'],
         'fab fa-canadian-maple-leaf' => ['canada, flag, flora, nature, plant', '\f785'],
         'fas fa-candy-cane' => ['candy, christmas, holiday, mint, peppermint, striped, xmas', '\f786'],
         'fas fa-cannabis' => ['bud, chronic, drugs, endica, endo, ganja, marijuana, mary jane, pot, reefer, sativa, spliff, weed, whacky-tabacky', '\f55f'],
         'fas fa-capsules' => ['drugs, medicine, pills, prescription', '\f46b'],
         'fas fa-car' => ['auto, automobile, sedan, transportation, travel, vehicle', '\f1b9'],
         'fas fa-car-alt' => ['auto, automobile, sedan, transportation, travel, vehicle', '\f5de'],
         'fas fa-car-battery' => ['auto, electric, mechanic, power', '\f5df'],
         'fas fa-car-crash' => ['accident, auto, automobile, insurance, sedan, transportation, vehicle, wreck', '\f5e1'],
         'fas fa-car-side' => ['auto, automobile, sedan, transportation, travel, vehicle', '\f5e4'],
         'fas fa-caravan' => ['camper, motor home, rv, trailer, travel', '\f8ff'],
         'fas fa-caret-down' => ['arrow, dropdown, expand, menu, more, triangle', '\f0d7'],
         'fas fa-caret-left' => ['arrow, back, previous, triangle', '\f0d9'],
         'fas fa-caret-right' => ['arrow, forward, next, triangle', '\f0da'],
         'fas fa-caret-square-down' => ['arrow, caret-square-o-down, dropdown, expand, menu, more, triangle', '\f150'],
         'fas fa-caret-square-left' => ['arrow, back, caret-square-o-left, previous, triangle', '\f191'],
         'fas fa-caret-square-right' => ['arrow, caret-square-o-right, forward, next, triangle', '\f152'],
         'fas fa-caret-square-up' => ['arrow, caret-square-o-up, collapse, triangle, upload', '\f151'],
         'fas fa-caret-up' => ['arrow, collapse, triangle', '\f0d8'],
         'fas fa-carrot' => ['bugs bunny, orange, vegan, vegetable', '\f787'],
         'fas fa-cart-arrow-down' => ['download, save, shopping', '\f218'],
         'fas fa-cart-plus' => ['add, create, new, positive, shopping', '\f217'],
         'fas fa-cash-register' => ['buy, cha-ching, change, checkout, commerce, leaerboard, machine, pay, payment, purchase, store', '\f788'],
         'fas fa-cat' => ['feline, halloween, holiday, kitten, kitty, meow, pet', '\f6be'],
         'fab fa-cc-amazon-pay' => ['Amazon Pay Credit Card', '\f42d'],
         'fab fa-cc-amex' => ['amex', '\f1f3'],
         'fab fa-cc-apple-pay' => ['Apple Pay Credit Card', '\f416'],
         'fab fa-cc-diners-club' => ["Diner's Club Credit Card", '\f24c'],
         'fab fa-cc-discover' => ['Discover Credit Card', '\f1f2'],
         'fab fa-cc-jcb' => ['JCB Credit Card', '\f24b'],
         'fab fa-cc-mastercard' => ['MasterCard Credit Card', '\f1f1'],
         'fab fa-cc-paypal' => ['Paypal Credit Card', '\f1f4'],
         'fab fa-cc-stripe' => ['Stripe Credit Card', '\f1f5'],
         'fab fa-cc-visa' => ['Visa Credit Card', '\f1f0'],
         'fab fa-centercode' => ['Centercode', '\f380'],
         'fab fa-centos' => ['linux, operating system, os', '\f789'],
         'fas fa-certificate' => ['badge, star, verified', '\f0a3'],
         'fas fa-chair' => ['furniture, seat, sit', '\f6c0'],
         'fas fa-chalkboard' => ['blackboard, learning, school, teaching, whiteboard, writing', '\f51b'],
         'fas fa-chalkboard-teacher' => ['Anblackboard, instructor, learning, professor, school, whiteboard, writinggular', '\f51c'],
         'fas fa-charging-station' => ['electric, ev, tesla, vehicle', '\f5e7'],
         'fas fa-chart-area' => ['analytics, area, chart, graph', '\f1fe'],
         'fas fa-chart-bar' => ['analytics, bar, chart, graph', '\f080'],
         'fas fa-chart-line' => ['activity, analytics, chart, dashboard, gain, graph, increase, line', '\f201'],
         'fas fa-chart-pie' => ['analytics, chart, diagram, graph, pie', '\f200'],
         'fas fa-check' => ['accept, agree, checkmark, confirm, correct, done, notice, notification, notify, ok, select, success, tick, todo, yes', '\f00c'],
         'fas fa-check-circle' => ['accept, agree, confirm, correct, done, ok, select, success, tick, todo, yes', '\f058'],
         'fas fa-check-double' => ['accept, agree, checkmark, confirm, correct, done, notice, notification, notify, ok, select, success, tick, todo', '\f560'],
         'fas fa-check-square' => ['accept, agree, checkmark, confirm, correct, done, ok, select, success, tick, todo, yes', '\f14a'],
         'fas fa-cheese' => ['cheddar, curd, gouda, melt, parmesan, sandwich, swiss, wedge', '\f7ef'],
         'fas fa-chess' => ['board, castle, checkmate, game, king, rook, strategy, tournament', '\f439'],
         'fas fa-chess-bishop' => ['board, checkmate, game, strategy', '\f43a'],
         'fas fa-chess-board' => ['board, checkmate, game, strategy', '\f43c'],
         'fas fa-chess-king' => ['board, checkmate, game, strategy', '\f43f'],
         'fas fa-chess-knight' => ['board, checkmate, game, horse, strategy', '\f441'],
         'fas fa-chess-pawn' => ['board, checkmate, game, strategy', '\f443'],
         'fas fa-chess-queen' => ['board, checkmate, game, strategy', '\f445'],
         'fas fa-chess-rook' => ['board, castle, checkmate, game, strategy', '\f447'],
         'fas fa-chevron-circle-down' => ['arrow, download, dropdown, menu, more', '\f13a'],
         'fas fa-chevron-circle-left' => ['arrow, back, previous', '\f137'],
         'fas fa-chevron-circle-right' => ['arrow, forward, next', '\f138'],
         'fas fa-chevron-circle-up' => ['arrow, collapse, upload', '\f139'],
         'fas fa-chevron-down' => ['arrow, download, expand', '\f078'],
         'fas fa-chevron-left' => ['arrow, back, bracket, previous', '\f053'],
         'fas fa-chevron-right' => ['arrow, bracket, forward, next', '\f054'],
         'fas fa-chevron-up' => ['arrow, collapse, upload', '\f077'],
         'fas fa-child' => ['boy, girl, kid, toddler, young', '\f1ae'],
         'fab fa-chrome' => ['browser', '\f268'],
         'fab fa-chromecast' => ['Chromecast', '\f838'],
         'fas fa-church' => ['building, cathedral, chapel, community, religion', '\f51d'],
         'fas fa-circle' => ['circle-thin, diameter, dot, ellipse, notification, round', '\f111'],
         'fas fa-circle-notch' => ['circle-o-notch, diameter, dot, ellipse, round, spinner', '\f1ce'],
         'fas fa-city' => ['buildings, busy, skyscrapers, urban, windows', '\f64f'],
         'fas fa-clinic-medical' => ['covid-19, doctor, general practitioner, hospital, infirmary, medicine, office, outpatient', '\f7f2'],
         'fas fa-clipboard' => ['copy, notes, paste, record', '\f328'],
         'fas fa-clipboard-check' => ['accept, agree, confirm, done, ok, select, success, tick, todo, yes', '\f46c'],
         'fas fa-clipboard-list' => ['hecklist, completed, done, finished, intinerary, ol, schedule, tick, todo, ul', '\f46d'],
         'fas fa-clock' => ['date, late, schedule, time, timer, timestamp, watch', '\f017'],
         'fas fa-clone' => ['arrange, copy, duplicate, paste', '\f24d'],
         'fas fa-closed-captioning' => ['cc, deaf, hearing, subtitle, subtitling, text, video', '\f20a'],
         'fas fa-cloud' => ['atmosphere, fog, overcast, save, upload, weather', '\f0c2'],
         'fas fa-cloud-download-alt' => ['download, export, save', '\f381'],
         'fas fa-cloud-meatball ' => ['FLDSMDFR, food, spaghetti, storm', '\f73b'],
         'fas fa-cloud-moon' => ['crescent, evening, lunar, night, partly cloudy, sky', '\f6c3'],
         'fas fa-cloud-moon-rain' => ['rescent, evening, lunar, night, partly cloudy, precipitation, rain, sky, storm', '\f73c'],
         'fas fa-cloud-rain' => ['precipitation, rain, sky, storm', '\f73d'],
         'fas fa-cloud-showers-heavy' => ['precipitation, rain, sky, storm', '\f740'],
         'fas fa-cloud-sun' => ['clear, day, daytime, fall, outdoors, overcast, partly cloudy', '\f6c4'],
         'fas fa-cloud-sun-rain' => ['day, overcast, precipitation, storm, summer, sunshower', '\f743'],
         'fas fa-cloud-upload-alt' => ['cloud-upload, import, save, upload', '\f382'],
         'fab fa-cloudscale' => ['cloudscale.ch', '\f383'],
         'fab fa-cloudsmith' => ['Cloudsmith', '\f384'],
         'fab fa-cloudversify' => ['cloudversify ', '\f385'],
         'fas fa-cocktail' => ['alcohol, beverage, drink, gin, glass, margarita, martini, vodka', '\f561'],
         'fas fa-code' => ['brackets, code, development, html', '\f121'],
         'fas fa-code-branch' => ['branch, code-fork, fork, git, github, rebase, svn, vcs, version', '\f126'],
         'fab fa-codepen' => ['Codepen', '\f1cb'],
         'fab fa-codiepie' => ['Codie Pie', '\f284'],
         'fas fa-coffee' => ['beverage, breakfast, cafe, drink, fall, morning, mug, seasonal, tea', '\f0f4'],
         'fas fa-cog' => ['gear, mechanical, settings, sprocket, wheel', '\f013'],
         'fas fa-cogs' => ['gears, mechanical, settings, sprocket, wheel', '\f085'],
         'fas fa-coins' => ['currency, dime, financial, gold, money, penny', '\f51e'],
         'fas fa-columns' => ['browser, dashboard, organize, panes, split', '\f0db'],
         'fas fa-comment' => ['bubble, chat, commenting, conversation, feedback, message, note, notification, sms, speech, texting', '\f075'],
         'fas fa-comment-alt' => ['bubble, chat, commenting, conversation, feedback, message, note, notification, sms, speech, texting', '\f27a'],
         'fas fa-comment-dollar' => ['bubble, chat, commenting, conversation, feedback, message, money, note, notification, pay, sms, speech, spend, texting, transfer', '\f651'],
         'fas fa-comment-dots' => ['bubble, chat, commenting, conversation, feedback, message, more, note, notification, reply, sms, speech, texting', '\f4ad'],
         'fas fa-comment-medical ' => ['advice, bubble, chat, commenting, conversation, diagnose, feedback, message, note, notification, prescription, sms, speech, texting', '\f7f5'],
         'fas fa-comment-slash' => ['bubble, cancel, chat, commenting, conversation, feedback, message, mute, note, notification, quiet, sms, speech, texting', '\f4b3'],
         'fas fa-comments' => ['bubble, chat, commenting, conversation, feedback, message, note, notification, sms, speech, texting', '\f086'],
         'fas fa-comments-dollar' => ['bubble, chat, commenting, conversation, feedback, message, money, note, notification, pay, sms, speech, spend, texting, transfer', '\f653'],
         'fas fa-compact-disc' => ['album, bluray, cd, disc, dvd, media, movie, music, record, video, vinyl', '\f420'],
         'fas fa-compass' => ['directions, directory, location, menu, navigation, safari, travel', '\f14e'],
         'fas fa-compress' => ['collapse, fullscreen, minimize, move, resize, shrink, smaller', '\f066'],
         'fas fa-compress-alt' => ['collapse, fullscreen, minimize, move, resize, shrink, smaller', '\f422'],
         'fas fa-compress-arrows-alt ' => ['collapse, fullscreen, minimize, move, resize, shrink, smaller', '\f78c'],
         'fas fa-concierge-bell' => ['attention, hotel, receptionist, service, support', '\f562'],
         ' fab fa-confluence' => ['atlassian', '\f78d'],
         'fab fa-connectdevelop' => ['Connect Develop', '\f20e'],
         'fab fa-contao' => ['Contao', '\f26d'],
         'fas fa-cookie' => ['baked good, chips, chocolate, eat, snack, sweet, treat', '\f563'],

         'fas fa-cookie-bite' => ['baked good, bitten, chips, chocolate, eat, snack, sweet, treat', '\f564'],
         'fas fa-copy' => ['clone, duplicate, file, files-o, paper, paste', '\f0c5'],
         'fas fa-copyright' => ['brand, mark, register, trademark', '\f1f9'],
         'fab fa-cotton-bureau' => ['clothing, t-shirts, tshirts', '\f89e'],
         'fas fa-couch' => ['chair, cushion, furniture, relax, sofa', '\f4b8'],
         'fab fa-cpanel' => ['cPanel ', '\f388'],
         'fab fa-creative-commons' => ['Creative Commons', '\f25e'],
         'fab fa-creative-commons-by' => ['Creative Commons Attribution', '\f4e7'],
         'fab fa-creative-commons-nc' => ['Creative Commons Noncommercial', '\f4e8'],
         'fab fa-creative-commons-nc-eu' => ['Creative Commons Noncommercial (Euro Sign)', '\f4e9'],
         'fab fa-creative-commons-nc-jp' => ['Creative Commons Noncommercial (Yen Sign)', '\f4ea'],
         'fab fa-creative-commons-nd' => ['Creative Commons No Derivative Works', '\f4eb'],
         'fab fa-creative-commons-pd' => ['Creative Commons Public Domain', '\f4ec'],
         'fab fa-creative-commons-pd-alt' => ['Alternate Creative Commons Public Domain', '\f4ed'],
         'fab fa-creative-commons-remix' => ['Creative Commons Remix', '\f4ee'],
         'fab fa-creative-commons-sa' => ['Creative Commons Share Alike', '\f4ef'],
         'fab fa-creative-commons-sampling' => ['Creative Commons Sampling', '\f4f0'],
         'fab fa-creative-commons-sampling-plus' => ['Creative Commons Sampling +', '\f4f1'],
         'fab fa-creative-commons-share' => ['Creative Commons Share', '\f4f2'],
         'fab fa-creative-commons-zero' => ['Creative Commons CC0', '\f4f3'],
         'fas fa-credit-card' => ['buy, checkout, credit-card-alt, debit, money, payment, purchase', '\f09d'],
         'fab fa-critical-role' => ['Dungeons & Dragons, d&d, dnd, fantasy, game, gaming, tabletop', '\f6c9'],
         'fas fa-crop' => ['design, frame, mask, resize, shrink', '\f125'],
         'fas fa-crop-alt' => ['design, frame, mask, resize, shrink', '\f565'],
         'fas fa-cross' => ['catholicism, christianity, church, jesus', '\f654'],
         'fas fa-crosshairs' => ['aim, bullseye, gpd, picker, position', '\f05b'],
         'fas fa-crow' => ['bird, bullfrog, fauna, halloween, holiday, toad', '\f520'],
         'fas fa-crown' => ['award, favorite, king, queen, royal, tiara', '\f521'],
         'fas fa-crutch' => ['cane, injury, mobility, wheelchair', '\f7f7'],
         'fab fa-css3' => ['code', '\f13c'],
         'fab fa-css3-alt' => ['Alternate CSS3 Logo', '\f38b'],
         'fas fa-cube' => ['3d, block, dice, package, square, tesseract', '\f1b2'],
         'fas fa-cubes' => ['3d, block, dice, package, pyramid, square, stack, tesseract', '\f1b3'],
         'fas fa-cut' => ['clip, scissors, snip', '\f0c4'],
         'fab fa-cuttlefish' => ['Cuttlefish ', '\f38c'],
         'fab fa-d-and-d' => ['Dungeons & Dragons', '\f38d'],
         'fab fa-d-and-d-beyond' => ['Dungeons & Dragons, d&d, dnd, fantasy, gaming, tabletop', '\f6ca'],
         'fab fa-dailymotion' => ['dailymotion', '\f952'],
         'fab fa-dashcube' => ['DashCube', '\f210'],
         'fas fa-database' => ['computer, development, directory, memory, storage', '\f1c0'],
         'fas fa-deaf' => ['ear, hearing, sign language', '\f2a4'],
         'fab fa-delicious' => ['Delicious', '\f1a5'],
         'fas fa-democrat' => ['american, democratic party, donkey, election, left, left-wing, liberal, politics, usa', '\f747'],
         'fab fa-deploydog' => ['deploy.dog', '\f38e'],
         'fab fa-deskpro' => ['Deskpro ', '\f38f'],
         'fas fa-desktop' => ['computer, cpu, demo, desktop, device, imac, machine, monitor, pc, screen', '\f108'],
         'fab fa-dev' => ['DEV', '\f6cc'],
         'fab fa-deviantart' => ['deviantART ', '\f1bd'],
         'fas fa-dharmachakra' => ['buddhism, buddhist, wheel of dharma', '\f655'],
         'fab fa-dhl' => ['Dalsey, Hillblom and Lynn, german, package, shipping', '\f790'],
         'fas fa-diagnoses' => ['analyze, detect, diagnosis, examine, medicine', '\f470'],
         'fab fa-diaspora' => ['Diaspora ', '\f791'],
         'fas fa-dice' => ['chance, gambling, game, roll', '\f522'],
         'fas fa-dice-d20' => ['Dungeons & Dragons, chance, d&d, dnd, fantasy, gambling, game, roll', '\f6cf'],
         'fas fa-dice-d6' => ['Dungeons & Dragons, chance, d&d, dnd, fantasy, gambling, game, roll', '\f6d1'],
         'fas fa-dice-five' => ['chance, gambling, game, roll', '\f523'],
         'fas fa-dice-four' => ['chance, gambling, game, roll', '\f524'],
         'fas fa-dice-one' => ['chance, gambling, game, roll', '\f525'],
         'fas fa-dice-six' => ['chance, gambling, game, roll', '\f526'],
         'fas fa-dice-three' => ['chance, gambling, game, roll', '\f527'],
         'fas fa-dice-two' => ['chance, gambling, game, roll', '\f528'],
         'fab fa-digg' => ['Digg Logo', '\f1a6'],
         'fab fa-digital-ocean' => ['Digital Ocean', '\f391'],
         'fas fa-digital-tachograph' => ['data, distance, speed, tachometer', '\f566'],
         'fas fa-directions' => ['map, navigation, sign, turn', '\f5eb'],
         'fab fa-discord' => ['Discord', '\f392'],
         'fab fa-discourse' => ['Discourse', '\f393'],
         'fas fa-disease' => ['bacteria, cancer, covid-19, illness, infection, sickness, virus', '\f7fa'],
         'fas fa-divide' => ['arithmetic, calculus, division, math', '\f529'],
         'fas fa-dizzy' => ['dazed, dead, disapprove, emoticon, face', '\f567'],
         'fas fa-dna' => ['double helix, genetic, helix, molecule, protein', '\f471'],
         'fab fa-dochub' => ['DocHub', '\f394'],
         'fab fa-docker' => ['Docker', '\f395'],
         'fas fa-dog' => ['animal, canine, fauna, mammal, pet, pooch, puppy, woof', '\f6d3'],
         'fas fa-dollar-sign' => ['$, cost, dollar-sign, money, price, usd', '\f155'],
         'fas fa-dolly' => ['carry, shipping, transport', '\f472'],
         'fas fa-dolly-flatbed' => ['carry, inventory, shipping, transport', '\f474'],
         'fas fa-donate' => ['contribute, generosity, gift, give', '\f4b9'],
         'fas fa-door-closed' => ['enter, exit, locked', '\f52a'],
         'fas fa-door-open' => ['enter, exit, welcome', '\f52b'],
         'fas fa-dot-circle' => ['bullseye, notification, target', '\f192'],
         'fas fa-dove' => ['bird, fauna, flying, peace, war', '\f4ba'],
         'fas fa-download' => ['export, hard drive, save, transfer', '\f019'],
         'fab fa-draft2digital' => ['Draft2digital', '\f396'],
         'fas fa-drafting-compass' => ['design, map, mechanical drawing, plot, plotting', '\f568'],
         'fas fa-dragon' => ['Dungeons & Dragons, d&d, dnd, fantasy, fire, lizard, serpent', '\f6d5'],
         'fas fa-draw-polygon' => ['anchors, lines, object, render, shape', '\f5ee'],
         'fab fa-dribbble' => ['Dribbble', '\f17d'],
         'fab fa-dribbble-square' => ['Dribbble Square', '\f397'],
         'fab fa-dropbox' => ['Dropbox', '\f16b'],
         'fas fa-drum' => ['instrument, music, percussion, snare, sound', '\f569'],
         'fas fa-drum-steelpan' => ['calypso, instrument, music, percussion, reggae, snare, sound, steel, tropical', '\f56a'],
         'fas fa-drumstick-bite' => ['bone, chicken, leg, meat, poultry, turkey', '\f6d7'],
         'fab fa-drupal' => ['Drupal Logo', '\f1a9'],
         'fas fa-dumbbell' => ['exercise, gym, strength, weight, weight-lifting', '\f44b'],
         'fas fa-dumpster' => ['alley, bin, commercial, trash, waste', '\f793'],
         'fas fa-dumpster-fire' => ['alley, bin, commercial, danger, dangerous, euphemism, flame, heat, hot, trash, waste', '\f794'],
         'fab fa-dyalog' => ['Dyalog', '\f399'],
         'fab fa-earlybirds' => ['Earlybirds', '\f39a'],
         'fab fa-ebay' => ['eBay', '\f4f4'],
         'fab fa-edge' => ['browser, ie', '\f282'],
         'fas fa-edit' => ['edit, pen, pencil, update, write', '\f044'],
         'fas fa-egg' => ['breakfast, chicken, easter, shell, yolk', '\f7fb'],
         'fas fa-eject' => ['abort, cancel, cd, discharge', '\f052'],
         'fab fa-elementor' => ['Elementor', '\f430'],
         'fas fa-ellipsis-h' => ['dots, drag, kebab, list, menu, nav, navigation, ol, reorder, settings, ul', '\f141'],
         'fas fa-ellipsis-v' => ['dots, drag, kebab, list, menu, nav, navigation, ol, reorder, settings, ul', '\f142'],
         'fab fa-ello' => ['Ello', '\f5f1'],
         'fab fa-ember' => ['Ember', '\f423'],
         'fab fa-empire' => ['Galactic Empire', '\f1d1'],
         'fas fa-envelope' => ['e-mail, email, letter, mail, message, notification, support', '\f0e0'],
         'fas fa-envelope-open' => ['e-mail, email, letter, mail, message, notification, support', '\f2b6'],
         'fas fa-envelope-open-text' => ['e-mail, email, letter, mail, message, notification, support', '\f658'],
         'fas fa-envelope-square' => ['e-mail, email, letter, mail, message, notification, support', '\f199'],
         'fab fa-envira' => ['leaf', '\f299'],
         'fas fa-equals' => ['arithmetic, even, match, math', '\f52c'],
         'fas fa-eraser' => ['art, delete, remove, rubber', '\f12d'],
         'fab fa-erlang' => ['Erlang', '\f39d'],
         'fab fa-ethereum' => ['Ethereum', '\f42e'],
         'fas fa-ethernet' => ['cable, cat 5, cat 6, connection, hardware, internet, network, wired', '\f796'],
         'fab fa-etsy' => ['Etsy', '\f2d7'],
         'fas fa-euro-sign' => ['currency, dollar, exchange, money', '\f153'],
         'fab fa-evernote' => ['Evernote', '\f839'],
         'fas fa-exchange-alt' => ['arrow, arrows, exchange, reciprocate, return, swap, transfer', '\f362'],
         'fas fa-exclamation' => ['alert, danger, error, important, notice, notification, notify, problem, warning', '\f12a'],
         'fas fa-exclamation-circle' => ['alert, danger, error, important, notice, notification, notify, problem, warning', '\f06a'],
         'fas fa-expand' => ['bigger, enlarge, fullscreen, resize', '\f065'],
         'fas fa-expand-alt' => ['arrows, bigger, enlarge, fullscreen, resize', '\f424'],
         'fas fa-expand-arrows-alt' => ['bigger, enlarge, fullscreen, move, resize', '\f31e'],
         'fab fa-expeditedssl' => ['ExpeditedSSL ', '\f23e'],
         'fas fa-external-link-alt' => ['external-link, new, open, share', '\f35d'],
         'fas fa-external-link-square-alt' => ['external-link-square, new, open, share', '\f360'],
         'fas fa-eye' => ['look, optic, see, seen, show, sight, views, visible', '\f06e'],
         'fas fa-eye-dropper' => ['beaker, clone, color, copy, eyedropper, pipette', '\f1fb'],
         'fas fa-eye-slash' => ['blind, hide, show, toggle, unseen, views, visible, visiblity', '\f070'],
         'fab fa-facebook' => ['facebook-official, social network', '\f09a'],
         'fab fa-facebook-f' => ['facebook', '\f39e'],
         'fab fa-facebook-messenger' => ['Facebook Messenger', '\f39f'],
         'fab fa-facebook-square' => ['social network', '\f082'],
         'fas fa-fan' => ['ac, air conditioning, blade, blower, cool, hot', '\f863'],
         'fab fa-fantasy-flight-games' => ['Dungeons & Dragons, d&d, dnd, fantasy, game, gaming, tabletop', '\f6dc'],
         'fas fa-fast-backward' => ['beginning, first, previous, rewind, start', '\f049'],
         'fas fa-fast-forward' => ['end, last, next', '\f050'],
         'fas fa-faucet' => ['covid-19, drip, house, hygiene, kitchen, sink, water', '\f905'],
         'fas fa-fax' => ['business, communicate, copy, facsimile, send', '\f1ac'],
         'fas fa-feather' => ['bird, light, plucked, quill, write', '\f52d'],
         'fas fa-feather-alt' => ['bird, light, plucked, quill, write', '\f56b'],
         'fab fa-fedex' => ['Federal Express, package, shipping', '\f797'],
         'fab fa-fedora' => ['linux, operating system, os', '\f798'],
         'fas fa-female' => ['human, person, profile, user, woman', '\f182'],
         'fas fa-fighter-jet' => ['airplane, fast, fly, goose, maverick, plane, quick, top gun, transportation, travel', '\f0fb'],
         'fab fa-figma' => ['app, design, interface', '\f799'],
         'fas fa-file' => ['document, new, page, pdf, resume', '\f15b'],
         'fas fa-file-alt' => ['document, file-text, invoice, new, page, pdf', '\f15c'],
         'fas fa-file-archive' => ['.zip, bundle, compress, compression, download, zip', '\f1c6'],
         'fas fa-file-audio' => ['document, mp3, music, page, play, sound', '\f1c7'],
         'fas fa-file-code' => ['css, development, document, html', '\f1c9'],
         'fas fa-file-contract' => ['agreement, binding, document, legal, signature', '\f56c'],
         'fas fa-file-csv' => ['document, excel, numbers, spreadsheets, table', '\f6dd'],
         'fas fa-file-download' => ['document, export, save', '\f56d'],
         'fas fa-file-excel' => ['csv, document, numbers, spreadsheets, table', '\f1c3'],
         'fas fa-file-export' => ['download, save', '\f56e'],
         'fas fa-file-image' => ['document, image, jpg, photo, png', '\f1c5'],
         'fas fa-file-import' => ['copy, document, send, upload', '\f56f'],
         'fas fa-file-invoice' => ['account, bill, charge, document, payment, receipt', '\f570'],
         'fas fa-file-invoice-dollar' => ['$, account, bill, charge, document, dollar-sign, money, payment, receipt, usd', '\f571'],
         'fas fa-file-medical' => ['document, health, history, prescription, record', '\f477'],
         'fas fa-file-medical-alt' => ['document, health, history, prescription, record', '\f478'],
         'fas fa-file-pdf' => ['acrobat, document, preview, save', '\f1c1'],
         'fas fa-file-powerpoint' => ['display, document, keynote, presentation', '\f1c4'],
         'fas fa-file-prescription' => ['document, drugs, medical, medicine, rx', '\f572'],
         'fas fa-file-signature' => ['John Hancock, contract, document, name', '\f573'],
         'fas fa-file-upload' => ['document, import, page, save', '\f574'],
         'fas fa-file-video' => ['document, m4v, movie, mp4, play', '\f1c8'],
         'fas fa-file-word' => ['document, edit, page, text, writing', '\f1c2'],
         'fas fa-fill' => ['bucket, color, paint, paint bucket', '\f575'],
         'fas fa-fill-drip' => ['bucket, color, drop, paint, paint bucket, spill', '\f576'],
         'fas fa-film' => ['cinema, movie, strip, video', '\f008'],
         'fas fa-filter' => ['funnel, options, separate, sort', '\f0b0'],
         'fas fa-fingerprint' => ['human, id, identification, lock, smudge, touch, unique, unlock', '\f577'],
         'fas fa-fire' => ['burn, caliente, flame, heat, hot, popular', '\f06d'],
         'fas fa-fire-alt' => ['burn, caliente, flame, heat, hot, popular', '\f7e4'],
         'fas fa-fire-extinguisher' => ['burn, caliente, fire fighter, flame, heat, hot, rescue', '\f134'],
         'fab fa-firefox' => ['browser', '\f269'],
         'fab fa-firefox-browser' => ['browser', '\f907'],
         'fas fa-first-aid' => ['emergency, emt, health, medical, rescue', '\f479'],
         'fab fa-first-order' => ['First Order', '\f2b0'],
         'fab fa-first-order-alt' => ['Alternate First Order', '\f50a'],
         'fab fa-firstdraft' => ['firstdraft', '\f3a1'],
         'fas fa-fish' => ['fauna, gold, seafood, swimming', '\f578'],
         'fas fa-fist-raised' => ['Dungeons & Dragons, d&d, dnd, fantasy, hand, ki, monk, resist, strength, unarmed combat', '\f6de'],
         'fas fa-flag' => ['country, notice, notification, notify, pole, report, symbol', '\f024'],
         'fas fa-flag-checkered' => ['notice, notification, notify, pole, racing, report, symbol', '\f11e'],
         'fas fa-flag-usa' => ['betsy ross, country, old glory, stars, stripes, symbol', '\f74d'],
         'fas fa-flask' => ['beaker, experimental, labs, science', '\f0c3'],
         'fab fa-flickr' => ['Flickr', '\f16e'],
         'fab fa-flipboard' => ['Flipboard', '\f44d'],
         'fas fa-flushed' => ['embarrassed, emoticon, face', '\f579'],
         'fab fa-fly' => ['Fly', '\f417'],
         'fas fa-folder' => ['archive, directory, document, file', '\f07b'],
         'fas fa-folder-minus' => ['archive, delete, directory, document, file, negative, remove', '\f65d'],
         'fas fa-folder-open' => ['archive, directory, document, empty, file, new', '\f07c'],
         'fas fa-folder-plus' => ['add, archive, create, directory, document, file, new, positive', '\f65e'],
         'fas fa-font' => ['alphabet, glyph, text, type, typeface', '\f031'],
         'fab fa-font-awesome' => ['meanpath', '\f2b4'],
         'fab fa-font-awesome-alt' => ['Alternate Font Awesome', '\f35c'],
         'fab fa-font-awesome-flag' => ['Font Awesome Flag', '\f425'],
         'fab fa-fonticons' => ['Fonticons', '\f280'],
         'fab fa-fonticons-fi' => ['Fonticons Fi', '\f3a2'],
         'fas fa-football-ball' => ['ball, fall, nfl, pigskin, seasonal', '\f44e'],
         'fab fa-fort-awesome' => ['castle', '\f286'],
         'fab fa-fort-awesome-alt' => ['castle', '\f3a3'],
         'fab fa-forumbee' => ['Forumbee', '\f211'],
         'fas fa-forward' => ['forward, next, skip', '\f04e'],
         'fab fa-foursquare' => ['Foursquare', '\f180'],
         'fab fa-free-code-camp' => ['freeCodeCamp', '\f2c5'],
         'fab fa-freebsd' => ['FreeBSD', '\f3a4'],
         'fas fa-frog' => ['amphibian, bullfrog, fauna, hop, kermit, kiss, prince, ribbit, toad, wart', '\f52e'],
         'fas fa-frown' => ['disapprove, emoticon, face, rating, sad', '\f119'],
         'fas fa-frown-open' => ['disapprove, emoticon, face, rating, sad', '\f57a'],
         'fab fa-fulcrum' => ['Fulcrum', '\f50b'],
         'fas fa-funnel-dollar' => ['filter, money, options, separate, sort', '\f662'],
         'fas fa-futbol' => ['ball, football, mls, soccer', '\f1e3'],
         'fab fa-galactic-republic' => ['politics, star wars', '\f50c'],
         'fab fa-galactic-senate' => ['Galactic Senate', '\f50d'],
         'fas fa-gamepad' => ['arcade, controller, d-pad, joystick, video, video game', '\f11b'],
         'fas fa-gas-pump' => ['car, fuel, gasoline, petrol', '\f52f'],
         'fas fa-gavel' => ['hammer, judge, law, lawyer, opinion', '\f0e3'],
         'fas fa-gem' => ['diamond, jewelry, sapphire, stone, treasure', '\f3a5'],
         'fas fa-genderless' => ['androgynous, asexual, sexless', '\f22d'],
         'fab fa-get-pocket' => ['Get Pocket', '\f265'],
         'fab fa-gg' => ['GG Currency', '\f260'],
         'fab fa-gg-circle' => ['GG Currency Circle', '\f261'],
         'fas fa-ghost' => ['apparition, blinky, clyde, floating, halloween, holiday, inky, pinky, spirit', '\f6e2'],
         'fas fa-gift' => ['christmas, generosity, giving, holiday, party, present, wrapped, xmas', '\f06b'],
         'fas fa-gifts' => ['christmas, generosity, giving, holiday, party, present, wrapped, xmas', '\f79c'],
         'fab fa-git' => ['Git', '\f1d3'],
         'fab fa-git-alt' => ['Git Alt', '\f841'],
         'fab fa-git-square' => ['Git Square', '\f1d2'],
         'fab fa-github' => ['octocat', '\f09b'],
         'fab fa-github-alt' => ['octocat', '\f113'],
         'fab fa-github-square' => ['octocat', '\f092'],
         'fab fa-gitkraken' => ['GitKraken', '\f3a6'],
         'fab fa-gitlab' => ['Axosoft', '\f296'],
         'fab fa-gitter' => ['Gitter', '\f426'],
         'fas fa-glass-cheers' => ["alcohol, bar, beverage, celebration, champagne, clink, drink, holiday, new year's eve, party, toast", '\f79f'],
         'fas fa-glass-martini' => ['alcohol, bar, beverage, drink, liquor', '\f000'],
         'fas fa-glass-martini-alt' => ['alcohol, bar, beverage, drink, liquor', '\f57b'],
         'fas fa-glass-whiskey' => ['alcohol, bar, beverage, bourbon, drink, liquor, neat, rye, scotch, whisky', '\f7a0'],
         'fas fa-glasses' => ['hipster, nerd, reading, sight, spectacles, vision', '\f530'],
         'fab fa-glide' => ['Glide', '\f2a5'],
         'fab fa-glide-g' => ['Glide G', '\f2a6'],
         'fas fa-globe' => ['all, coordinates, country, earth, global, gps, language, localize, location, map, online, place, planet, translate, travel, world', '\f0ac'],
         'fas fa-globe-africa' => ['all, country, earth, global, gps, language, localize, location, map, online, place, planet, translate, travel, world', '\f57c'],
         'fas fa-globe-americas' => ['all, country, earth, global, gps, language, localize, location, map, online, place, planet, translate, travel, world', '\f57d'],
         'fas fa-globe-asia' => ['all, country, earth, global, gps, language, localize, location, map, online, place, planet, translate, travel, world', '\f57e'],
         'fas fa-globe-europe' => ['all, country, earth, global, gps, language, localize, location, map, online, place, planet, translate, travel, world', '\f7a2'],
         'fab fa-gofore' => ['Gofore', '\f3a7'],
         'fas fa-golf-ball' => ['caddy, eagle, putt, tee', '\f450'],
         'fab fa-goodreads' => ['Goodreads', '\f3a8'],
         'fab fa-goodreads-g' => ['Goodreads G', '\f3a9'],
         'fab fa-google' => ['Google Logo', '\f1a0'],
         'fab fa-google-drive' => ['Google Drive', '\f3aa'],
         'fab fa-google-play' => ['Google Play', '\f3ab'],
         'fab fa-google-plus' => ['google-plus-circle, google-plus-official', '\f2b3'],
         'fab fa-google-plus-g' => ['google-plus, social network', '\f0d5'],
         'fab fa-google-plus-square' => ['social network', '\f0d4'],
         'fab fa-google-wallet' => ['Google Wallet', '\f1ee'],
         'fas fa-gopuram' => ['building, entrance, hinduism, temple, tower', '\f664'],
         'fas fa-graduation-cap' => ['eremony, college, graduate, learning, school, student', '\f19d'],
         'fab fa-gratipay' => ['favorite, heart, like, love', '\f184'],
         'fab fa-grav' => ['Grav', '\f2d6'],
         'fas fa-greater-than' => ['arithmetic, compare, math', '\f531'],
         'fas fa-greater-than-equal' => ['arithmetic, compare, math', '\f532'],
         'fas fa-grimace' => ['cringe, emoticon, face, teeth', '\f57f'],
         'fas fa-grin' => ['emoticon, face, laugh, smile', '\f580'],
         'fas fa-grin-alt' => ['emoticon, face, laugh, smile', '\f581'],
         'fas fa-grin-beam' => ['emoticon, face, laugh, smile', '\f582'],
         'fas fa-grin-beam-sweat' => ['embarass, emoticon, face, smile', '\f583'],
         'fas fa-grin-hearts' => ['emoticon, face, love, smile', '\f584'],
         'fas fa-grin-squint' => ['emoticon, face, laugh, smile', '\f585'],
         'fas fa-grin-squint-tears' => ['emoticon, face, happy, smile', '\f586'],
         'fas fa-grin-stars' => ['emoticon, face, star-struck', '\f587'],
         'fas fa-grin-tears' => ['LOL, emoticon, face', '\f588'],
         'fas fa-grin-tongue' => ['LOL, emoticon, face', '\f589'],
         'fas fa-grin-tongue-squint' => ['LOL, emoticon, face', '\f58a'],
         'fas fa-grin-tongue-wink' => ['LOL, emoticon, face', '\f58b'],
         'fas fa-grin-wink' => ['emoticon, face, flirt, laugh, smile', '\f58c'],
         'fas fa-grip-horizontal' => ['affordance, drag, drop, grab, handle', '\f58d'],
         'fas fa-grip-lines' => ['affordance, drag, drop, grab, handle', '\f7a4'],
         'fas fa-grip-lines-vertical' => ['affordance, drag, drop, grab, handle', '\f7a5'],
         'fas fa-grip-vertical' => ['affordance, drag, drop, grab, handle', '\f58e'],
         'fab fa-gripfire' => ['Gripfire, Inc', '\f3ac'],
         'fab fa-grunt' => ['Grunt', '\f3ad'],
         'fas fa-guitar' => ['acoustic, instrument, music, rock, rock and roll, song, strings', '\f7a6'],
         'fab fa-gulp' => ['Gulp', '\f3ae'],
         'fas fa-h-square' => ['directions, emergency, hospital, hotel, map', '\f0fd'],
         'fab fa-hacker-news' => ['Hacker News', '\f1d4'],
         'fab fa-hacker-news-square' => ['Hacker News Square', '\f3af'],
         'fab fa-hackerrank' => ['Hackerrank', '\f5f7'],
         'fas fa-hamburger' => ['bacon, beef, burger, burger king, cheeseburger, fast food, grill, ground beef, mcdonalds, sandwich', '\f805'],
         'fas fa-hammer' => ['admin, fix, repair, settings, tool', '\f6e3'],
         'fas fa-hamsa' => ['fas fa-hamsa', '\f665'],
         'fas fa-hand-holding' => ['carry, lift', '\f4bd'],
         'fas fa-hand-holding-heart' => ['carry, charity, gift, lift, package', '\f4be'],
         'fas fa-hand-holding-medical' => ['care, covid-19, donate, help', '\f95c'],
         'fas fa-hand-holding-usd' => ['$, carry, dollar sign, donation, giving, lift, money, price', '\f4c0'],
         'fas fa-hand-holding-water' => ['carry, covid-19, drought, grow, lift', '\f4c1'],
         'fas fa-hand-lizard' => ['game, roshambo', '\f258'],
         'fas fa-hand-middle-finger' => ['flip the bird, gesture, hate, rude', '\f806'],
         'fas fa-hand-paper' => ['game, halt, roshambo, stop', '\f256'],
         'fas fa-hand-peace' => ['rest, truce', '\f25b'],
         'fas fa-hand-point-down' => ['finger, hand-o-down, point', '\f0a7'],
         'fas fa-hand-point-left' => ['back, finger, hand-o-left, left, point, previous', '\f0a5'],
         'fas fa-hand-point-right' => ['finger, forward, hand-o-right, next, point, right', '\f0a4'],
         'fas fa-hand-point-up' => ['finger, hand-o-up, point', '\f0a6'],
         'fas fa-hand-pointer' => ['arrow, cursor, select', '\f25a'],
         'fas fa-hand-rock' => ['fist, game, roshambo', '\f255'],
         'fas fa-hand-scissors' => ['cut, game, roshambo', '\f257'],
         'fas fa-hand-sparkles' => ['clean, covid-19, hygiene, magic, soap, wash', '\f95d'],
         'fas fa-hand-spock' => ['live long, prosper, salute, star trek, vulcan', '\f259'],
         'fas fa-hands' => ['carry, hold, lift', '\f4c2'],
         'fas fa-hands-helping' => ['aid, assistance, handshake, partnership, volunteering', '\f4c4'],
         'fas fa-hands-wash' => ['covid-19, hygiene, soap, wash', '\f95e'],
         'fas fa-handshake' => ['agreement, greeting, meeting, partnership', '\f2b5'],
         'fas fa-handshake-alt-slash' => ['broken, covid-19, social distance', '\f95f'],
         'fas fa-handshake-slash' => ['broken, covid-19, social distance', '\f960'],
         'fas fa-hanukiah' => ['candle, hanukkah, jewish, judaism, light', '\f6e6'],
         'fas fa-hard-hat' => ['construction, hardhat, helmet, safety', '\f807'],
         'fas fa-hashtag' => ['Twitter, instagram, pound, social media, tag', '\f292'],
         'fas fa-hat-cowboy' => ['buckaroo, horse, jackeroo, john b., old west, pardner, ranch, rancher, rodeo, western, wrangler', '\f8c0'],
         'fas fa-hat-cowboy-side' => ['buckaroo, horse, jackeroo, john b., old west, pardner, ranch, rancher, rodeo, western, wrangler', '\f8c1'],
         'fas fa-hat-wizard' => ['Dungeons & Dragons, accessory, buckle, clothing, d&d, dnd, fantasy, halloween, head, holiday, mage, magic, pointy, witch', '\f6e8'],
         'fas fa-hdd' => ['cpu, hard drive, harddrive, machine, save, storage', '\f0a0'],
         'fas fa-head-side-cough' => ['cough, covid-19, germs, lungs, respiratory, sick', '\f961'],
         'fas fa-head-side-cough-slash' => ['cough, covid-19, germs, lungs, respiratory, sick', '\f962'],
         'fas fa-head-side-mask' => ['breath, covid-19, filter, respirator, virus', '\f963'],
         'fas fa-head-side-virus' => ['cold, covid-19, flu, sick', '\f964'],
         'fas fa-heading' => ['format, header, text, title', '\f1dc'],
         'fas fa-headphones' => ['audio, listen, music, sound, speaker', '\f025'],
         'fas fa-headphones-alt' => ['audio, listen, music, sound, speaker', '\f58f'],
         'fas fa-headset' => ['audio, gamer, gaming, listen, live chat, microphone, shot caller, sound, support, telemarketer', '\f590'],
         'fas fa-heart' => ['favorite, like, love, relationship, valentine', '\f004'],
         'fas fa-heart-broken' => ['breakup, crushed, dislike, dumped, grief, love, lovesick, relationship, sad', '\f7a9'],
         'fas fa-heartbeat' => ['ekg, electrocardiogram, health, lifeline, vital signs', '\f21e'],
         'fas fa-helicopter' => ['airwolf, apache, chopper, flight, fly, travel', '\f533'],
         'fas fa-highlighter' => ['edit, marker, sharpie, update, write', '\f591'],
         'fas fa-hiking' => ['activity, backpack, fall, fitness, outdoors, person, seasonal, walking', '\f6ec'],
         'fas fa-hippo' => ['animal, fauna, hippopotamus, hungry, mammal', '\f6ed'],
         'fab fa-hips' => ['Hips', '\f452'],
         'fab fa-hire-a-helper' => ['HireAHelper', '\f3b0'],
         'fas fa-history' => ['Rewind, clock, reverse, time, time machine', '\f1da'],
         'fas fa-hockey-puck' => ['ice, nhl, sport', '\f453'],
         'fas fa-holly-berry' => ['catwoman, christmas, decoration, flora, halle, holiday, ororo munroe, plant, storm, xmas', '\f7aa'],
         'fas fa-home' => ['abode, building, house, main', '\f015'],
         'fab fa-hooli' => ['Hooli', '\f427'],
         'fab fa-hornbill' => ['Hornbill', '\f592'],
         'fas fa-horse' => ['equus, fauna, mammmal, mare, neigh, pony', '\f6f0'],
         'fas fa-horse-head' => ['equus, fauna, mammmal, mare, neigh, pony', '\f7ab'],
         'fas fa-hospital' => ['building, covid-19, emergency room, medical center', '\f0f8'],
         'fas fa-hospital-alt' => ['building, covid-19, emergency room, medical center', '\f47d'],
         'fas fa-hospital-symbol' => ['clinic, covid-19, emergency, map', '\f47e'],
         'fas fa-hospital-user' => ['covid-19, doctor, network, patient, primary care', '\f80d'],
         'fas fa-hot-tub' => ['bath, jacuzzi, massage, sauna, spa', '\f593'],
         'fas fa-hotdog' => ['bun, chili, frankfurt, frankfurter, kosher, polish, sandwich, sausage, vienna, weiner', '\f80f'],
         'fas fa-hotel' => ['building, inn, lodging, motel, resort, travel', '\f594'],
         'fab fa-hotjar' => ['Hotjar', '\f3b1'],
         'fas fa-hourglass' => ['hour, minute, sand, stopwatch, time', '\f254'],
         'fas fa-hourglass-end' => ['hour, minute, sand, stopwatch, time', '\f253'],
         'fas fa-hourglass-half' => ['hour, minute, sand, stopwatch, time', '\f252'],
         'fas fa-hourglass-start' => ['hour, minute, sand, stopwatch, time', '\f251'],
         'fas fa-house-damage' => ['building, devastation, disaster, home, insurance', '\f6f1'],
         'fas fa-house-user' => ['covid-19, home, isolation, quarantine', '\f965'],
         'fab fa-houzz' => ['Houzz', '\f27c'],
         'fas fa-hryvnia' => ['currency, money, ukraine, ukrainian', '\f6f2'],
         'fab fa-html5' => ['HTML 5 Logo', '\f13b'],
         'fab fa-hubspot' => ['HubSpot', '\f3b2'],
         'fas fa-i-cursor' => ['editing, i-beam, type, writing', '\f246'],
         'fas fa-ice-cream' => ['chocolate, cone, dessert, frozen, scoop, sorbet, vanilla, yogurt', '\f810'],
         'fas fa-icicles' => ['cold, frozen, hanging, ice, seasonal, sharp', '\f7ad'],
         'fas fa-icons' => ['bolt, emoji, heart, image, music, photo, symbols', '\f86d'],
         'fas fa-id-badge' => ['address, contact, identification, license, profile', '\f2c1'],
         'fas fa-id-card' => ['contact, demographics, document, identification, issued, profile', '\f2c2'],
         'fas fa-id-card-alt' => ['ontact, demographics, document, identification, issued, profile', '\f47f'],
         'fab fa-ideal' => ['iDeal', '\f913'],
         'fas fa-igloo' => ['dome, dwelling, eskimo, home, house, ice, snow', '\f7ae'],
         'fas fa-image' => ['album, landscape, photo, picture', '\f03e'],
         'fas fa-images' => ['album, landscape, photo, picture', '\f302'],
         'fab fa-imdb' => ['IMDB', '\f2d8'],
         'fas fa-inbox' => ['archive, desk, email, mail, message', '\f01c'],
         'fas fa-indent' => ['align, justify, paragraph, tab', '\f03c'],
         'fas fa-industry' => ['building, factory, industrial, manufacturing, mill, warehouse', '\f275'],
         'fas fa-infinity' => ['eternity, forever, math', '\f534'],
         'fas fa-info' => ['details, help, information, more, support', '\f129'],
         'fas fa-info-circle' => ['details, help, information, more, support', '\f05a'],
         'fab fa-instagram' => ['Instagram', '\f16d'],
         'fab fa-instagram-square' => ['Instagram Square', '\f955'],
         'fab fa-intercom' => ['app, customer, messenger', '\f7af'],
         'fab fa-internet-explorer' => ['browser, ie', '\f26b'],
         'fab fa-invision' => ['app, design, interface', '\f7b0'],
         'fab fa-ioxhost' => ['ioxhost', '\f208'],
         'fas fa-italic' => ['edit, emphasis, font, format, text, type', '\f033'],
         'fab fa-itch-io' => ['itch.io', '\f83a'],
         'fab fa-itunes' => ['iTunes', '\f3b4'],
         'fab fa-itunes-note' => ['Itunes Note', '\f3b5'],
         'fab fa-java' => ['Java', '\f4e4'],
         'fas fa-jedi' => ['crest, force, sith, skywalker, star wars, yoda', '\f669'],
         'fab fa-jedi-order' => ['star wars', '\f50e'],
         'fab fa-jenkins' => ['Jenkis', '\f3b6'],
         'fab fa-jira' => ['atlassian', '\f7b1'],
         'fab fa-joget' => ['Joget', '\f3b7'],
         'fas fa-joint' => ['blunt, cannabis, doobie, drugs, marijuana, roach, smoke, smoking, spliff', '\f595'],
         'fab fa-joomla' => ['Joomla Logo', '\f1aa'],
         'fas fa-journal-whills' => ['book, force, jedi, sith, star wars, yoda', '\f66a'],
         'fab fa-js' => ['JavaScript (JS)', '\f3b8'],
         'fab fa-js-square' => ['JavaScript (JS) Square', '\f3b9'],
         'fab fa-jsfiddle' => ['jsFiddle', '\f1cc'],
         'fas fa-kaaba' => ['building, cube, islam, muslim', '\f66b'],
         'fab fa-kaggle' => ['Kaggle', '\f5fa'],
         'fas fa-key' => ['lock, password, private, secret, unlock', '\f084'],
         'fab fa-keybase' => ['Keybase ', '\f4f5'],
         'fas fa-keyboard' => ['accessory, edit, input, text, type, write', '\f11c'],
         'fab fa-keycdn' => ['KeyCDN', '\f3ba'],
         'fas fa-khanda' => ['chakkar, sikh, sikhism, sword', '\f66d'],
         'fab fa-kickstarter' => ['Kickstarter', '\f3bb'],
         'fab fa-kickstarter-k' => ['Kickstarter K', '\f3bc'],
         'fas fa-kiss' => ['beso, emoticon, face, love, smooch', '\f596'],
         'fas fa-kiss-beam' => ['beso, emoticon, face, love, smooch', '\f597'],
         'fas fa-kiss-wink-heart' => ['beso, emoticon, face, love, smooch', '\f598'],
         'fas fa-kiwi-bird' => ['bird, fauna, new zealand', '\f535'],
         'fab fa-korvue' => ['KORVUE', '\f42f'],
         'fas fa-landmark' => ['building, historic, memorable, monument, politics', '\f66f'],
         'fas fa-language' => ['dialect, idiom, localize, speech, translate, vernacular', '\f1ab'],
         'fas fa-laptop' => ['computer, cpu, dell, demo, device, mac, macbook, machine, pc', '\f109'],
         'fas fa-laptop-code' => ['computer, cpu, dell, demo, develop, device, mac, macbook, machine, pc', '\f5fc'],
         'fas fa-laptop-house' => ['computer, covid-19, device, office, remote, work from home', '\f966'],
         'fas fa-laptop-medical' => ['computer, device, ehr, electronic health records, history', '\f812'],
         'fab fa-laravel' => ['Laravel', '\f3bd'],
         'fab fa-lastfm' => ['last.fm', '\f202'],
         'fab fa-lastfm-square' => ['last.fm Square', '\f203'],
         'fas fa-laugh' => ['LOL, emoticon, face, laugh, smile', '\f599'],
         'fas fa-laugh-beam' => ['LOL, emoticon, face, happy, smile', '\f59a'],
         'fas fa-laugh-squint' => ['LOL, emoticon, face, happy, smile', '\f59b'],
         'fas fa-laugh-wink' => ['LOL, emoticon, face, happy, smile', '\f59c'],
         'fas fa-layer-group' => ['arrange, develop, layers, map, stack', '\f5fd'],
         'fas fa-leaf' => ['eco, flora, nature, plant, vegan', '\f06c'],
         'fab fa-leanpub' => ['Leanpub', '\f212'],
         'fas fa-lemon' => ['itrus, lemonade, lime, tart', '\f094'],
         'fab fa-less' => ['Less', '\f41d'],
         'fas fa-less-than' => ['arithmetic, compare, math', '\f536'],
         'fas fa-less-than-equal' => ['arithmetic, compare, math', '\f537'],
         'fas fa-level-down-alt' => ['arrow, level-down', '\f3be'],
         'fas fa-level-up-alt' => ['arrow, level-up', '\f3bf'],
         'fas fa-life-ring' => ['coast guard, help, overboard, save, support', '\f1cd'],
         'fas fa-lightbulb' => ['energy, idea, inspiration, light', '\f0eb'],
         'fab fa-line' => ['Line', '\f3c0'],
         'fas fa-link' => ['attach, attachment, chain, connect', '\f0c1'],
         'fab fa-linkedin' => ['linkedin-square', '\f08c'],
         'fab fa-linkedin-in' => ['linkedin', '\f0e1'],
         'fab fa-linode' => ['Linode', '\f2b8'],
         'fab fa-linux' => ['tux', '\f17c'],
         'fas fa-lira-sign' => ['currency, money, try, turkish', '\f195'],
         'fas fa-list' => ['checklist, completed, done, finished, ol, todo, ul', '\f03a'],
         'fas fa-list-alt' => ['checklist, completed, done, finished, ol, todo, ul', '\f022'],
         'fas fa-list-ol' => ['checklist, completed, done, finished, numbers, ol, todo, ul', '\f0cb'],
         'fas fa-list-ul' => ['checklist, completed, done, finished, ol, todo, ul', '\f0ca'],
         'fas fa-location-arrow' => ['address, compass, coordinate, direction, gps, map, navigation, place', '\f124'],
         'fas fa-lock' => ['admin, lock, open, password, private, protect, security', '\f023'],
         'fas fa-lock-open' => ['admin, lock, open, password, private, protect, security', '\f3c1'],
         'fas fa-long-arrow-alt-down' => ['download, long-arrow-down', '\f309'],
         'fas fa-long-arrow-alt-left' => ['back, long-arrow-left, previous', '\f30a'],
         'fas fa-long-arrow-alt-right' => ['forward, long-arrow-right, next', '\f30b'],
         'fas fa-long-arrow-alt-up' => ['long-arrow-up, upload', '\f30c'],
         'fas fa-low-vision' => ['blind, eye, sight', '\f2a8'],
         'fas fa-luggage-cart' => ['bag, baggage, suitcase, travel', '\f59d'],
         'fas fa-lungs' => ['air, breath, covid-19, organ, respiratory', '\f604'],
         'fas fa-lungs-virus' => ['breath, covid-19, respiratory, sick', '\f967'],
         'fab fa-lyft' => ['lyft', '\f3c3'],
         'fab fa-magento' => ['Magento', '\f3c4'],
         'fas fa-magic' => ['autocomplete, automatic, mage, magic, spell, wand, witch, wizard', '\f0d0'],
         'fas fa-magnet' => ['Attract, lodestone, tool', '\f076'],
         'fas fa-mail-bulk' => ['archive, envelope, letter, post office, postal, postcard, send, stamp, usps', '\f674'],
         'fab fa-mailchimp' => ['Mailchimp', '\f59e'],
         'fas fa-male' => ['human, man, person, profile, user', '\f183'],
         'fab fa-mandalorian' => ['Mandalorian', '\f50f'],
         'fas fa-map' => ['address, coordinates, destination, gps, localize, location, map, navigation, paper, pin, place, point of interest, position, route, travel', '\f279'],
         'fas fa-map-marked' => ['address, coordinates, destination, gps, localize, location, map, navigation, paper, pin, place, point of interest, position, route, travel', '\f59f'],
         'fas fa-map-marked-alt' => ['address, coordinates, destination, gps, localize, location, map, navigation, paper, pin, place, point of interest, position, route, travel', '\f5a0'],
         'fas fa-map-marker' => ['address, coordinates, destination, gps, localize, location, map, navigation, paper, pin, place, point of interest, position, route, travel', '\f041'],
         'fas fa-map-marker-alt' => ['address, coordinates, destination, gps, localize, location, map, navigation, paper, pin, place, point of interest, position, route, travel', '\f3c5'],
         'fas fa-map-pin' => ['address, agree, coordinates, destination, gps, localize, location, map, marker, navigation, pin, place, position, travel', '\f276'],
         'fas fa-map-signs' => ['directions, directory, map, signage, wayfinding', '\f277'],
         'fab fa-markdown' => ['Markdown', '\f60f'],
         'fas fa-marker' => ['design, edit, sharpie, update, write', '\f5a1'],
         'fas fa-mars' => ['male', '\f222'],
         'fas fa-mars-double' => ['Mars Double', '\f227'],
         'fas fa-mars-stroke' => ['Mars Stroke', '\f229'],
         'fas fa-mars-stroke-h' => ['Mars Stroke Horizontal', '\f22b'],
         'fas fa-mars-stroke-v' => ['Mars Stroke Vertical', '\f22a'],
         'fas fa-mask' => ['carnivale, costume, disguise, halloween, secret, super hero', '\f6fa'],
         'fab fa-mastodon' => ['Mastodon', '\f4f6'],
         'fab fa-maxcdn' => ['MaxCDN', '\f136'],
         'fab fa-mdb' => ['Material Design for Bootstrap', '\f8ca'],
         'fas fa-medal' => ['award, ribbon, star, trophy', '\f5a2'],
         'fab fa-medapps' => ['MedApps', '\f3c6'],
         'fab fa-medium' => ['Medium ', '\f23a'],
         'fab fa-medium-m' => ['Medium M', '\f3c7'],
         'fas fa-medkit' => ['first aid, firstaid, health, help, support', '\f0fa'],
         'fab fa-medrt' => ['MRT', '\f3c8'],
         'fab fa-meetup' => ['Meetup', '\f2e0'],
         'fab fa-megaport' => ['Megaport', '\f5a3'],
         'fas fa-meh' => ['emoticon, face, neutral, rating', '\f11a'],
         'fas fa-meh-blank' => ['emoticon, face, neutral, rating', '\f5a4'],
         'fas fa-meh-rolling-eyes' => ['emoticon, face, neutral, rating', '\f5a5'],
         'fas fa-memory' => ['DIMM, RAM, hardware, storage, technology', '\f538'],
         'fab fa-mendeley' => ['Mendeley', '\f7b3'],
         'fas fa-menorah' => ['candle, hanukkah, jewish, judaism, light', '\f676'],
         'fas fa-mercury' => ['transgender', '\f223'],
         'fas fa-meteor' => ['armageddon, asteroid, comet, shooting star, space', '\f753'],
         'fab fa-microblog' => ['Micro.blog', '\f91a'],
         'fas fa-microchip' => ['cpu, hardware, processor, technology', '\f2db'],
         'fas fa-microphone' => ['audio, podcast, record, sing, sound, voice', '\f130'],
         'fas fa-microphone-alt' => ['audio, podcast, record, sing, sound, voice', '\f3c9'],
         'fas fa-microphone-alt-slash' => ['audio, disable, mute, podcast, record, sing, sound, voice', '\f539'],
         'fas fa-microphone-slash' => ['audio, disable, mute, podcast, record, sing, sound, voice', '\f131'],
         'fas fa-microscope' => ['covid-19, electron, lens, optics, science, shrink', '\f610'],
         'fab fa-microsoft' => ['Microsoft', '\f3ca'],
         'fas fa-minus' => ['collapse, delete, hide, minify, negative, remove, trash', '\f068'],
         'fas fa-minus-circle' => ['delete, hide, negative, remove, shape, trash', '\f056'],
         'fas fa-minus-square' => ['collapse, delete, hide, minify, negative, remove, shape, trash', '\f146'],
         'fas fa-mitten' => ['clothing, cold, glove, hands, knitted, seasonal, warmth', '\f7b5'],
         'fab fa-mix' => ['Mix', '\f3cb'],
         'fab fa-mixcloud' => ['Mixcloud', '\f289'],
         'fab fa-mixer' => ['Mixer', '\f956'],
         'fab fa-mizuni' => ['Mizuni', '\f3cc'],
         'fas fa-mobile' => ['pple, call, cell phone, cellphone, device, iphone, number, screen, telephone', '\f10b'],
         'fas fa-mobile-alt' => ['apple, call, cell phone, cellphone, device, iphone, number, screen, telephone', '\f3cd'],
         'fab fa-modx' => ['MODX', '\f285'],
         'fab fa-monero' => ['Monero', '\f3d0'],
         'fas fa-money-bill' => ['buy, cash, checkout, money, payment, price, purchase', '\f0d6'],
         'fas fa-money-bill-alt' => ['buy, cash, checkout, money, payment, price, purchase', '\f3d1'],
         'fas fa-money-bill-wave' => ['buy, cash, checkout, money, payment, price, purchase', '\f53a'],
         'fas fa-money-bill-wave-alt' => ['buy, cash, checkout, money, payment, price, purchase', '\f53b'],
         'fas fa-money-check' => ['bank check, buy, checkout, cheque, money, payment, price, purchase', '\f53c'],
         'fas fa-money-check-alt' => ['bank check, buy, checkout, cheque, money, payment, price, purchase', '\f53d'],
         'fas fa-monument' => ['building, historic, landmark, memorable', '\f5a6'],
         'fas fa-moon' => ['contrast, crescent, dark, lunar, night', '\f186'],
         'fas fa-mortar-pestle' => ['crush, culinary, grind, medical, mix, pharmacy, prescription, spices', '\f5a7'],
         'fas fa-mosque' => ['building, islam, landmark, muslim', '\f678'],
         'fas fa-motorcycle' => ['bike, machine, transportation, vehicle', '\f21c'],
         'fas fa-mountain' => ['glacier, hiking, hill, landscape, travel, view', '\f6fc'],
         'fas fa-mouse' => ['click, computer, cursor, input, peripheral', '\f8cc'],
         'fas fa-mouse-pointer' => ['arrow, cursor, select', '\f245'],
         'fas fa-mug-hot' => ['caliente, cocoa, coffee, cup, drink, holiday, hot chocolate, steam, tea, warmth', '\f7b6'],
         'fas fa-music' => ['lyrics, melody, note, sing, sound', '\f001'],
         'fab fa-napster' => ['Napster', '\f3d2'],
         'fab fa-neos' => ['Neos', '\f612'],
         'fas fa-network-wired' => ['computer, connect, ethernet, internet, intranet', '\f6ff'],
         'fas fa-neuter' => ['Neuter', '\f22c'],
         'fas fa-newspaper' => ['article, editorial, headline, journal, journalism, news, press', '\f1ea'],
         'fab fa-nimblr' => ['Nimblr', '\f5a8'],
         'fab fa-node' => ['Node.js', '\f419'],
         'fab fa-node-js' => ['Node.js JS', '\f3d3'],
         'fas fa-not-equal' => ['arithmetic, compare, math', '\f53e'],
         'fas fa-notes-medical' => ['lipboard, doctor, ehr, health, history, records', '\f481'],
         'fab fa-npm' => ['npm', '\f3d4'],
         'fab fa-ns8' => ['NS8', '\f3d5'],
         'fab fa-nutritionix' => ['Nutritionix ', '\f3d6'],
         'fas fa-object-group' => ['combine, copy, design, merge, select', '\f247'],
         'fas fa-object-ungroup' => ['copy, design, merge, select, separate', '\f248'],
         'fab fa-odnoklassniki' => ['Odnoklassniki', '\f263'],
         'fab fa-odnoklassniki-square' => ['Odnoklassniki Square', '\f264'],
         'fas fa-oil-can' => ['auto, crude, gasoline, grease, lubricate, petroleum', '\f613'],
         'fab fa-old-republic' => ['politics, star wars', '\f510'],
         'fas fa-om' => ['buddhism, hinduism, jainism, mantra', '\f679'],
         'fab fa-opencart' => ['OpenCart', '\f23d'],
         'fab fa-openid' => ['OpenID', '\f19b'],
         'fab fa-opera' => ['Opera', '\f26a'],
         'fab fa-optin-monster' => ['Optin Monster', '\f23c'],
         'fab fa-orcid' => ['ORCID', '\f8d2'],
         'fab fa-osi' => ['Open Source Initiative', '\f41a'],
         'fas fa-otter' => ['animal, badger, fauna, fur, mammal, marten', '\f700'],
         'fas fa-outdent' => ['lign, justify, paragraph, tab', '\f03b'],
         'fab fa-page4' => ['page4 Corporation', '\f3d7'],
         'fab fa-pagelines' => ['eco, flora, leaf, leaves, nature, plant, tree', '\f18c'],
         'fas fa-pager' => ['beeper, cellphone, communication', '\f815'],
         'fas fa-paint-brush' => ['acrylic, art, brush, color, fill, paint, pigment, watercolor', '\f1fc'],
         'fas fa-paint-roller' => ['acrylic, art, brush, color, fill, paint, pigment, watercolor', '\f5aa'],
         'fas fa-palette' => ['acrylic, art, brush, color, fill, paint, pigment, watercolor', '\f53f'],
         'fab fa-palfed' => ['Palfed', '\f3d8'],
         'fas fa-pallet' => ['archive, box, inventory, shipping, warehouse', '\f482'],
         'fas fa-paper-plane' => ['air, float, fold, mail, paper, send', '\f1d8'],
         'fas fa-paperclip' => ['attach, attachment, connect, link', '\f0c6'],
         'fas fa-parachute-box' => ['aid, assistance, rescue, supplies', '\f4cd'],
         'fas fa-paragraph' => ['edit, format, text, writing', '\f1dd'],
         'fas fa-parking' => ['auto, car, garage, meter', '\f540'],
         'fas fa-passport' => ['document, id, identification, issued, travel', '\f5ab'],
         'fas fa-pastafarianism' => ['agnosticism, atheism, flying spaghetti monster, fsm', '\f67b'],
         'fas fa-paste' => ['clipboard, copy, document, paper', '\f0ea'],
         'fab fa-patreon' => ['Patreon', '\f3d9'],
         'fas fa-pause' => ['hold, wait', '\f04c'],
         'fas fa-pause-circle' => ['hold, wait', '\f28b'],
         'fas fa-paw' => ['animal, cat, dog, pet, print', '\f1b0'],
         'fab fa-paypal' => ['Paypal', '\f1ed'],
         'fas fa-peace' => ['serenity, tranquility, truce, war', '\f67c'],
         'fas fa-pen' => ['design, edit, update, write', '\f304'],
         'fas fa-pen-alt' => ['design, edit, update, write', '\f305'],
         'fas fa-pen-fancy' => ['design, edit, fountain pen, update, write', '\f5ac'],
         'fas fa-pen-nib' => ['design, edit, fountain pen, update, write', '\f5ad'],
         'fas fa-pen-square' => ['edit, pencil-square, update, write', '\f14b'],
         'fas fa-pencil-alt' => ['design, edit, pencil, update, write', '\f303'],
         'fas fa-pencil-ruler' => ['design, draft, draw, pencil', '\f5ae'],
         'fab fa-penny-arcade' => ['Dungeons & Dragons, d&d, dnd, fantasy, game, gaming, pax, tabletop', '\f704'],
         'fas fa-people-arrows' => ['covid-19, personal space, social distance, space, spread, users', '\f968'],
         'fas fa-people-carry' => ['box, carry, fragile, help, movers, package', '\f4ce'],
         'fas fa-pepper-hot' => ['buffalo wings, capsicum, chili, chilli, habanero, jalapeno, mexican, spicy, tabasco, vegetable', '\f816'],
         'fas fa-percent' => ['discount, fraction, proportion, rate, ratio', '\f295'],
         'fas fa-percentage' => ['discount, fraction, proportion, rate, ratio', '\f541'],
         'fab fa-periscope' => ['Periscope', '\f3da'],
         'fas fa-person-booth' => ['changing, changing room, election, human, person, vote, voting', '\f756'],
         'fab fa-phabricator' => ['Phabricator', '\f3db'],
         'fab fa-phoenix-framework' => ['Phoenix Framework', '\f3dc'],
         'fab fa-phoenix-squadron' => ['Phoenix Squadron', '\f511'],
         'fas fa-phone' => ['call, earphone, number, support, telephone, voice', '\f095'],
         'fas fa-phone-alt' => ['call, earphone, number, support, telephone, voice', '\f879'],
         'fas fa-phone-slash' => ['call, cancel, earphone, mute, number, support, telephone, voice', '\f3dd'],
         'fas fa-phone-square' => ['call, earphone, number, support, telephone, voice', '\f098'],
         'fas fa-phone-square-alt' => ['call, earphone, number, support, telephone, voice', '\f87b'],
         'fas fa-phone-volume' => ['call, earphone, number, sound, support, telephone, voice, volume-control-phone', '\f2a0'],
         'fas fa-photo-video' => ['av, film, image, library, media', '\f87c'],
         'fab fa-php' => ['PHP', '\f457'],
         'fab fa-pied-piper' => ['Pied Piper Logo', '\f2ae'],
         'fab fa-pied-piper-alt' => ['Alternate Pied Piper Logo (Old)', '\f1a8'],
         'fab fa-pied-piper-hat' => ['clothing', '\f4e5'],
         'fab fa-pied-piper-pp' => ['Pied Piper PP Logo (Old)', '\f1a7'],
         'fab fa-pied-piper-square' => ['Pied Piper Square Logo (Old)', '\f91e'],
         'fas fa-piggy-bank' => ['bank, save, savings', '\f4d3'],
         'fas fa-pills' => ['drugs, medicine, prescription, tablets', '\f484'],
         'fab fa-pinterest' => ['Pinterest', '\f0d2'],
         'fab fa-pinterest-p' => ['Pinterest P', '\f231'],
         'fab fa-pinterest-square' => ['Pinterest Square', '\f0d3'],
         'fas fa-pizza-slice' => ['cheese, chicago, italian, mozzarella, new york, pepperoni, pie, slice, teenage mutant ninja turtles, tomato', '\f818'],
         'fas fa-place-of-worship' => ['building, church, holy, mosque, synagogue', '\f67f'],
         'fas fa-plane' => ['airplane, destination, fly, location, mode, travel, trip', '\f072'],
         'fas fa-plane-arrival' => ['airplane, arriving, destination, fly, land, landing, location, mode, travel, trip', '\f5af'],
         'fas fa-plane-departure' => ['airplane, departing, destination, fly, location, mode, take off, taking off, travel, trip', '\f5b0'],
         'fas fa-plane-slash' => ['airplane mode, canceled, covid-19, delayed, grounded, travel', '\f969'],
         'fas fa-play' => ['audio, music, playing, sound, start, video', '\f04b'],
         'fas fa-play-circle' => ['audio, music, playing, sound, start, video', '\f144'],
         'fab fa-playstation' => ['PlayStation', '\f3df'],
         'fas fa-plug' => ['connect, electric, online, power', '\f1e6'],
         'fas fa-plus' => ['add, create, expand, new, positive, shape', '\f067'],
         'fas fa-plus-circle' => ['add, create, expand, new, positive, shape', '\f055'],
         'fas fa-plus-square' => ['add, create, expand, new, positive, shape', '\f0fe'],
         'fas fa-podcast' => ['audio, broadcast, music, sound', '\f2ce'],
         'fas fa-poll' => ['results, survey, trend, vote, voting', '\f681'],
         'fas fa-poll-h' => ['results, survey, trend, vote, voting', '\f682'],
         'fas fa-poo' => ['crap, poop, shit, smile, turd', '\f2fe'],
         'fas fa-poo-storm' => ['bolt, cloud, euphemism, lightning, mess, poop, shit, turd', '\f75a'],
         'fas fa-poop' => ['crap, poop, shit, smile, turd', '\f619'],
         'fas fa-portrait' => ['id, image, photo, picture, selfie', '\f3e0'],
         'fas fa-pound-sign' => ['currency, gbp, money', '\f154'],
         'fas fa-power-off' => ['cancel, computer, on, reboot, restart', '\f011'],
         'fas fa-pray' => ['kneel, preach, religion, worship', '\f683'],
         'fas fa-praying-hands' => ['kneel, preach, religion, worship', '\f684'],
         'fas fa-prescription' => ['drugs, medical, medicine, pharmacy, rx', '\f5b1'],
         'fas fa-prescription-bottle' => ['drugs, medical, medicine, pharmacy, rx', '\f485'],
         'fas fa-prescription-bottle-alt' => ['drugs, medical, medicine, pharmacy, rx', '\f486'],
         'fas fa-print' => ['business, copy, document, office, paper', '\f02f'],
         'fas fa-procedures' => ['EKG, bed, electrocardiogram, health, hospital, life, patient, vital', '\f487'],
         'fab fa-product-hunt' => ['Product Hunt', '\f288'],
         'fas fa-project-diagram' => ['chart, graph, network, pert', '\f542'],
         'fas fa-pump-medical' => ['anti-bacterial, clean, covid-19, disinfect, hygiene, medical grade, sanitizer, soap', '\f96a'],
         'fas fa-pump-soap' => ['anti-bacterial, clean, covid-19, disinfect, hygiene, sanitizer, soap', '\f96b'],
         'fab fa-pushed' => ['Pushed', '\f3e1'],
         'fas fa-puzzle-piece' => ['add-on, addon, game, section', '\f12e'],
         'fab fa-python' => ['Python', '\f3e2'],
         'fab fa-qq' => ['QQ', '\f1d6'],
         'fas fa-qrcode' => ['barcode, info, information, scan', '\f029'],
         'fas fa-question' => ['help, information, support, unknown', '\f128'],
         'fas fa-question-circle' => ['help, information, support, unknown', '\f059'],
         'fas fa-quidditch' => ['ball, bludger, broom, golden snitch, harry potter, hogwarts, quaffle, sport, wizard', '\f458'],
         'fab fa-quinscape' => ['QuinScape', '\f459'],
         'fab fa-quora' => ['Quora', '\f2c4'],
         'fas fa-quote-left' => ['mention, note, phrase, text, type', '\f10d'],
         'fas fa-quote-right' => ['mention, note, phrase, text, type', '\f10e'],
         'fas fa-quran' => ['book, islam, muslim, religion', '\f687'],
         'fab fa-r-project' => ['R Project', '\f4f7'],
         'fas fa-radiation' => ['danger, dangerous, deadly, hazard, nuclear, radioactive, warning', '\f7b9'],
         'fas fa-radiation-alt' => ['danger, dangerous, deadly, hazard, nuclear, radioactive, warning', '\f7ba'],
         'fas fa-rainbow' => ['gold, leprechaun, prism, rain, sky', '\f75b'],
         'fas fa-random' => ['arrows, shuffle, sort, swap, switch, transfer', '\f074'],
         'fab fa-raspberry-pi' => ['Raspberry Pi', '\f7bb'],
         'fab fa-ravelry' => ['Ravelry', '\f2d9'],
         'fab fa-react' => ['React', '\f41b'],
         'fab fa-reacteurope' => ['ReactEurope', '\f75d'],
         'fab fa-readme' => ['ReadMe', '\f4d5'],
         'fab fa-rebel' => ['Rebel Alliance', '\f1d0'],
         'fas fa-receipt' => ['check, invoice, money, pay, table', '\f543'],
         'fas fa-record-vinyl' => ['LP, album, analog, music, phonograph, sound', '\f8d9'],
         'fas fa-recycle' => ['Waste, compost, garbage, reuse, trash', '\f1b8'],
         'fab fa-red-river' => ['red river', '\f3e3'],
         'fab fa-reddit' => ['reddit Logo', '\f1a1'],
         'fab fa-reddit-alien' => ['reddit Alien', '\f281'],
         'fab fa-reddit-square' => ['reddit Square', '\f1a2'],
         'fab fa-redhat' => ['linux, operating system, os', '\f7bc'],
         'fas fa-redo' => ['forward, refresh, reload, repeat', '\f01e'],
         'fas fa-redo-alt' => ['forward, refresh, reload, repeat', '\f2f9'],
         'fas fa-registered' => ['copyright, mark, trademark', '\f25d'],
         'fas fa-remove-format' => ['cancel, font, format, remove, style, text', '\f87d'],
         'fab fa-renren' => ['Renren', '\f18b'],
         'fas fa-reply' => ['mail, message, respond', '\f3e5'],
         'fas fa-reply-all' => ['mail, message, respond', '\f122'],
         'fab fa-replyd' => ['replyd', '\f3e6'],
         'fas fa-republican' => ['american, conservative, election, elephant, politics, republican party, right, right-wing, usa', '\f75e'],
         'fab fa-researchgate' => ['Researchgate', '\f4f8'],
         'fab fa-resolving' => ['Resolving', '\f3e7'],
         'fas fa-restroom' => ['bathroom, john, loo, potty, washroom, waste, wc', '\f7bd'],
         'fas fa-retweet' => ['refresh, reload, share, swap', '\f079'],
         'fab fa-rev' => ['Rev.io', '\f5b2'],
         'fas fa-ribbon' => ['badge, cause, lapel, pin', '\f4d6'],
         'fas fa-ring' => ['Dungeons & Dragons, Gollum, band, binding, d&d, dnd, engagement, fantasy, gold, jewelry, marriage, precious', '\f70b'],
         'fas fa-road' => ['highway, map, pavement, route, street, travel', '\f018'],
         'fas fa-robot' => ['android, automate, computer, cyborg', '\f544'],
         'fas fa-rocket' => ['aircraft, app, jet, launch, nasa, space', '\f135'],
         'fab fa-rocketchat' => ['Rocket.Chat', '\f3e8'],
         'fab fa-rockrms' => ['Rockrms', '\f3e9'],
         'fas fa-route' => ['directions, navigation, travel', '\f4d7'],
         'fas fa-rss' => ['blog, feed, journal, news, writing', '\f09e'],
         'fas fa-rss-square' => ['blog, feed, journal, news, writing', '\f143'],
         'fas fa-ruble-sign' => ['currency, money, rub', '\f158'],
         'fas fa-ruler' => ['design, draft, length, measure, planning', '\f545'],
         'fas fa-ruler-combined' => ['design, draft, length, measure, planning', '\f546'],
         'fas fa-ruler-horizontal' => ['design, draft, length, measure, planning', '\f547'],
         'fas fa-ruler-vertical' => ['design, draft, length, measure, planning', '\f548'],
         'fas fa-running' => ['exercise, health, jog, person, run, sport, sprint', '\f70c'],
         'fas fa-rupee-sign' => ['currency, indian, inr, money,', '\f156'],
         'fas fa-sad-cry' => ['emoticon, face, tear, tears', '\f5b3'],
         'fas fa-sad-tear' => ['emoticon, face, tear, tears', '\f5b4'],
         'fab fa-safari' => ['browser', '\f267'],
         'fab fa-salesforce' => ['Salesforce', '\f83b'],
         'fab fa-sass' => ['Sass', '\f41e'],
         'fas fa-satellite' => ['communications, hardware, orbit, space', '\f7bf'],
         'fas fa-satellite-dish' => ['SETI, communications, hardware, receiver, saucer, signal, space', '\f7c0'],
         'fas fa-save' => ['disk, download, floppy, floppy-o', '\f0c7'],
         'fab fa-schlix' => ['SCHLIX', '\f3ea'],
         'fas fa-school' => ['building, education, learn, student, teacher', '\f549'],
         'fas fa-screwdriver' => ['admin, fix, mechanic, repair, settings, tool', '\f54a'],
         'fab fa-scribd' => ['Scribd', '\f28a'],
         'fas fa-scroll' => ['Dungeons & Dragons, announcement, d&d, dnd, fantasy, paper, script', '\f70e'],
         'fas fa-sd-card' => ['image, memory, photo, save', '\f7c2'],
         'fas fa-search' => ['bigger, enlarge, find, magnify, preview, zoom', '\f002'],
         'fas fa-search-dollar' => ['bigger, enlarge, find, magnify, money, preview, zoom', '\f688'],
         'fas fa-search-location' => ['bigger, enlarge, find, magnify, preview, zoom', '\f689'],
         'fas fa-search-minus' => ['minify, negative, smaller, zoom, zoom out', '\f010'],
         'fas fa-search-plus' => ['bigger, enlarge, magnify, positive, zoom, zoom in', '\f00e'],
         'fab fa-searchengin' => ['Searchengin', '\f3eb'],
         'fas fa-seedling' => ['flora, grow, plant, vegan', '\f4d8'],
         'fab fa-sellcast' => ['eercast', '\f2da'],
         'fab fa-sellsy' => ['Sellsy', '\f213'],
         'fas fa-server' => ['computer, cpu, database, hardware, network', '\f233'],
         'fab fa-servicestack' => ['Servicestack', '\f3ec'],
         'fas fa-shapes' => ['blocks, build, circle, square, triangle', '\f61f'],
         'fas fa-share' => ['forward, save, send, social', '\f064'],
         'fas fa-share-alt' => ['forward, save, send, social', '\f1e0'],
         'fas fa-share-alt-square' => ['forward, save, send, social', '\f1e1'],
         'fas fa-share-square' => ['forward, save, send, social', '\f14d'],
         'fas fa-shekel-sign' => ['currency, ils, money', '\f20b'],
         'fas fa-shield-alt' => ['achievement, award, block, defend, security, winner', '\f3ed'],
         'fas fa-shield-virus' => ['antibodies, barrier, covid-19, health, protect', '\f96c'],
         'fas fa-ship' => ['boat, sea, water', '\f21a'],
         'fas fa-shipping-fast' => ['express, fedex, mail, overnight, package, ups', '\f48b'],
         'fab fa-shirtsinbulk' => ['Shirts in Bulk', '\f214'],
         'fas fa-shoe-prints' => ['feet, footprints, steps, walk', '\f54b'],
         'fab fa-shopify' => ['Shopify', '\f957'],
         'fas fa-shopping-bag' => ['buy, checkout, grocery, payment, purchase', '\f290'],
         'fas fa-shopping-basket' => ['buy, checkout, grocery, payment, purchase', '\f291'],
         'fas fa-shopping-cart' => ['buy, checkout, grocery, payment, purchase', '\f07a'],
         'fab fa-shopware' => ['Shopware', '\f5b5'],
         'fas fa-shower' => ['bath, clean, faucet, water', '\f2cc'],
         'fas fa-shuttle-van' => ['airport, machine, public-transportation, transportation, travel, vehicle', '\f5b6'],
         'fas fa-sign' => ['directions, real estate, signage, wayfinding', '\f4d9'],
         'fas fa-sign-in-alt' => ['arrow, enter, join, log in, login, sign in, sign up, sign-in, signin, signup', '\f2f6'],
         'fas fa-sign-language' => ['Translate, asl, deaf, hands', '\f2a7'],
         'fas fa-sign-out-alt' => ['arrow, exit, leave, log out, logout, sign-out', '\f2f5'],
         'fas fa-signal' => ['bars, graph, online, reception, status', '\f012'],
         'fas fa-signature' => ['John Hancock, cursive, name, writing', '\f5b7'],
         'fas fa-sim-card' => ['hard drive, hardware, portable, storage, technology, tiny', '\f7c4'],
         'fab fa-simplybuilt' => ['SimplyBuilt', '\f215'],
         'fab fa-sistrix' => ['SISTRIX', '\f3ee'],
         'fas fa-sitemap' => ['directory, hierarchy, ia, information architecture, organization', '\f0e8'],
         'fab fa-sith' => ['Sith', '\f512'],
         'fas fa-skating' => ['activity, figure skating, fitness, ice, person, winter', '\f7c5'],
         'fab fa-sketch' => ['app, design, interface', '\f7c6'],
         'fas fa-skiing' => ['activity, downhill, fast, fitness, olympics, outdoors, person, seasonal, slalom', '\f7c9'],
         'fas fa-skiing-nordic' => ['activity, cross country, fitness, outdoors, person, seasonal', '\f7ca'],
         'fas fa-skull' => ['bones, skeleton, x-ray, yorick', '\f54c'],
         'fas fa-skull-crossbones' => ['Dungeons & Dragons, alert, bones, d&d, danger, dead, deadly, death, dnd, fantasy, halloween, holiday, jolly-roger, pirate, poison, skeleton, warning', '\f714'],
         'fab fa-skyatlas' => ['skyatlas', '\f216'],
         'fab fa-skype' => ['Skype', '\f17e'],
         'fab fa-slack' => ['anchor, hash, hashtag', '\f198'],
         'fab fa-slack-hash' => ['anchor, hash, hashtag', '\f3ef'],
         'fas fa-slash' => ['cancel, close, mute, off, stop, x', '\f715'],
         'fas fa-sleigh' => ['christmas, claus, fly, holiday, santa, sled, snow, xmas', '\f7cc'],
         'fas fa-sliders-h' => ['adjust, settings, sliders, toggle', '\f1de'],
         'fab fa-slideshare' => ['Slideshare', '\f1e7'],
         'fas fa-smile' => ['approve, emoticon, face, happy, rating, satisfied', '\f118'],
         'fas fa-smile-beam' => ['emoticon, face, happy, positive', '\f5b8'],
         'fas fa-smile-wink' => ['emoticon, face, happy, hint, joke', '\f4da'],
         'fas fa-smog' => ['dragon, fog, haze, pollution, smoke, weather', '\f75f'],
         'fas fa-smoking' => ['cancer, cigarette, nicotine, smoking status, tobacco', '\f48d'],
         'fas fa-smoking-ban' => ['ban, cancel, no smoking, non-smoking', '\f54d'],
         'fas fa-sms' => ['chat, conversation, message, mobile, notification, phone, sms, texting', '\f7cd'],
         'fab fa-snapchat' => ['Snapchat', '\f2ab'],
         'fab fa-snapchat-ghost' => ['Snapchat Ghost', '\f2ac'],
         'fab fa-snapchat-square' => ['Snapchat Square', '\f2ad'],
         'fas fa-snowboarding' => ['activity, fitness, olympics, outdoors, person', '\f7ce'],
         'fas fa-snowflake' => ['precipitation, rain, winter', '\f2dc'],
         'fas fa-snowman' => ['decoration, frost, frosty, holiday', '\f7d0'],
         'fas fa-snowplow' => ['clean up, cold, road, storm, winter', '\f7d2'],
         'fas fa-soap' => ['bubbles, clean, covid-19, hygiene, wash', '\f96e'],
         'fas fa-socks' => ['business socks, business time, clothing, feet, flight of the conchords, wednesday', '\f696'],
         'fas fa-solar-panel' => ['clean, eco-friendly, energy, green, sun', '\f5ba'],
         'fas fa-sort' => ['filter, order', '\f0dc'],
         'fas fa-sort-alpha-down' => ['alphabetical, arrange, filter, order, sort-alpha-asc', '\f15d'],
         'fas fa-sort-alpha-down-alt' => ['alphabetical, arrange, filter, order, sort-alpha-asc', '\f881'],
         'fas fa-sort-alpha-up' => ['alphabetical, arrange, filter, order, sort-alpha-desc', '\f15e'],
         'fas fa-sort-alpha-up-alt' => ['alphabetical, arrange, filter, order, sort-alpha-desc', '\f882'],
         'fas fa-sort-amount-down' => ['arrange, filter, number, order, sort-amount-asc', '\f160'],
         'fas fa-sort-amount-down-alt' => ['arrange, filter, order, sort-amount-asc', '\f884'],
         'fas fa-sort-amount-up' => ['arrange, filter, order, sort-amount-desc', '\f161'],
         'fas fa-sort-amount-up-alt' => ['arrange, filter, order, sort-amount-desc', '\f885'],
         'fas fa-sort-down' => ['arrow, descending, filter, order, sort-desc', '\f0dd'],
         'fas fa-sort-numeric-down' => ['arrange, filter, numbers, order, sort-numeric-asc', '\f162'],
         'fas fa-sort-numeric-down-alt' => ['arrange, filter, numbers, order, sort-numeric-asc', '\f886'],
         'fas fa-sort-numeric-up' => ['arrange, filter, numbers, order, sort-numeric-desc', '\f163'],
         'fas fa-sort-numeric-up-alt' => ['arrange, filter, numbers, order, sort-numeric-desc', '\f887'],
         'fas fa-sort-up' => ['arrow, ascending, filter, order, sort-asc', '\f0de'],
         'fab fa-soundcloud' => ['SoundCloud', '\f1be'],
         'fab fa-sourcetree' => ['Sourcetree', '\f7d3'],
         'fas fa-spa' => ['flora, massage, mindfulness, plant, wellness', '\f5bb'],
         'fas fa-space-shuttle' => ['astronaut, machine, nasa, rocket, space, transportation', '\f197'],
         'fab fa-speakap' => ['Speakap', '\f3f3'],
         'fab fa-speaker-deck' => ['Speaker Deck', '\f83c'],
         'fas fa-spell-check' => ['dictionary, edit, editor, grammar, text', '\f891'],
         'fas fa-spider' => ['arachnid, bug, charlotte, crawl, eight, halloween', '\f717'],
         'fas fa-spinner' => ['circle, loading, progress', '\f110'],
         'fas fa-splotch' => ['Ink, blob, blotch, glob, stain', '\f5bc'],
         'fab fa-spotify' => ['Spotify', '\f1bc'],
         'fas fa-spray-can' => ['Paint, aerosol, design, graffiti, tag', '\f5bd'],
         'fas fa-square' => ['block, box, shape', '\f0c8'],
         'fas fa-square-full' => ['block, box, shape', '\f45c'],
         'fas fa-square-root-alt' => ['arithmetic, calculus, division, math', '\f698'],
         'fab fa-squarespace' => ['Squarespace', '\f5be'],
         'fab fa-stack-exchange' => ['Stack Exchange', '\f18d'],
         'fab fa-stack-overflow' => ['Stack Overflow', '\f16c'],
         'fab fa-stackpath' => ['Stackpath', '\f842'],
         'fas fa-stamp' => ['art, certificate, imprint, rubber, seal', '\f5bf'],
         'fas fa-star' => ['achievement, award, favorite, important, night, rating, score', '\f005'],
         'fas fa-star-and-crescent' => ['islam, muslim, religion', '\f699'],
         'fas fa-star-half' => ['achievement, award, rating, score, star-half-empty, star-half-full', '\f089'],
         'fas fa-star-half-alt' => ['achievement, award, rating, score, star-half-empty, star-half-full', '\f5c0'],
         'fas fa-star-of-david' => ['jewish, judaism, religion', '\f69a'],
         'fas fa-star-of-life' => ['doctor, emt, first aid, health, medical', '\f621'],
         'fab fa-staylinked' => ['StayLinked', '\f3f5'],
         'fab fa-steam' => ['Steam', '\f1b6'],
         'fab fa-steam-square' => ['Steam Square', '\f1b7'],
         'fab fa-steam-symbol' => ['Steam Symbol', '\f3f6'],
         'fas fa-step-backward' => ['beginning, first, previous, rewind, start', '\f048'],
         'fas fa-step-forward' => ['end, last, next', '\f051'],
         'fas fa-stethoscope' => ['covid-19, diagnosis, doctor, general practitioner, hospital, infirmary, medicine, office, outpatient', '\f0f1'],
         'fab fa-sticker-mule' => ['Sticker Mule', '\f3f7'],
         'fas fa-sticky-note' => ['message, note, paper, reminder, sticker', '\f249'],
         'fas fa-stop' => ['block, box, square', '\f04d'],
         'fas fa-stop-circle' => ['block, box, circle, square', '\f28d'],
         'fas fa-stopwatch' => ['clock, reminder, time', '\f2f2'],
         'fas fa-stopwatch-20' => ['ABCs, countdown, covid-19, happy birthday, i will survive, reminder, seconds, time, timer', '\f96f'],
         'fas fa-store' => ['building, buy, purchase, shopping', '\f54e'],
         'fas fa-store-alt' => ['building, buy, purchase, shopping', '\f54f'],
         'fas fa-store-alt-slash' => ['building, buy, closed, covid-19, purchase, shopping', '\f970'],
         'fas fa-store-slash' => ['building, buy, closed, covid-19, purchase, shopping', '\f971'],
         'fab fa-strava' => ['Strava', '\f428'],
         'fas fa-stream' => ['flow, list, timeline', '\f550'],
         'fas fa-street-view' => ['directions, location, map, navigation', '\f21d'],
         'fas fa-strikethrough' => ['cancel, edit, font, format, text, type', '\f0cc'],
         'fab fa-stripe' => ['Stripe', '\f429'],
         'fab fa-stripe-s' => ['Stripe S', '\f42a'],
         'fas fa-stroopwafel' => ['caramel, cookie, dessert, sweets, waffle', '\f551'],
         'fab fa-studiovinari' => ['Studio Vinari', '\f3f8'],
         'fab fa-stumbleupon' => ['StumbleUpon Logo', '\f1a4'],
         'fab fa-stumbleupon-circle' => ['StumbleUpon Circle', '\f1a3'],
         'fas fa-subscript' => ['edit, font, format, text, type', '\f12c'],
         'fas fa-subway' => ['machine, railway, train, transportation, vehicle', '\f239'],
         'fas fa-suitcase' => ['baggage, luggage, move, suitcase, travel, trip', '\f0f2'],
         'fas fa-suitcase-rolling' => ['baggage, luggage, move, suitcase, travel, trip', '\f5c1'],
         'fas fa-sun' => ['brighten, contrast, day, lighter, sol, solar, star, weather', '\f185'],
         'fab fa-superpowers' => ['Superpowers', '\f2dd'],
         'fas fa-superscript' => ['edit, exponential, font, format, text, type', '\f12b'],
         'fab fa-supple' => ['Supple', '\f3f9'],
         'fas fa-surprise' => ['emoticon, face, shocked', '\f5c2'],
         'fab fa-suse' => ['linux, operating system, os', '\f7d6'],
         'fas fa-swatchbook' => ['Pantone, color, design, hue, palette', '\f5c3'],
         'fab fa-swift' => ['Swift', '\f8e1'],
         'fas fa-swimmer' => ['athlete, head, man, olympics, person, pool, water', '\f5c4'],
         'fas fa-swimming-pool' => ['ladder, recreation, swim, water', '\f5c5'],
         'fab fa-symfony' => ['Symfony', '\f83d'],
         'fas fa-synagogue' => ['building, jewish, judaism, religion, star of david, temple', '\f69b'],
         'fas fa-sync' => ['exchange, refresh, reload, rotate, swap', '\f021'],
         'fas fa-sync-alt' => ['exchange, refresh, reload, rotate, swap', '\f2f1'],
         'fas fa-syringe' => ['covid-19, doctor, immunizations, medical, needle', '\f48e'],
         'fas fa-table' => ['data, excel, spreadsheet', '\f0ce'],
         'fas fa-table-tennis' => ['ball, paddle, ping pong', '\f45d'],
         'fas fa-tablet' => ['apple, device, ipad, kindle, screen', '\f10a'],
         'fas fa-tablet-alt' => ['apple, device, ipad, kindle, screen', '\f3fa'],
         'fas fa-tablets' => ['drugs, medicine, pills, prescription', '\f490'],
         'fas fa-tachometer-alt' => ['dashboard, fast, odometer, speed, speedometer', '\f3fd'],
         'fas fa-tag' => ['discount, label, price, shopping', '\f02b'],
         'fas fa-tags' => ['discount, label, price, shopping', '\f02c'],
         'fas fa-tape' => ['design, package, sticky', '\f4db'],
         'fas fa-tasks' => ['checklist, downloading, downloads, loading, progress, project management, settings, to do', '\f0ae'],
         'fas fa-taxi' => ['cab, cabbie, car, car service, lyft, machine, transportation, travel, uber, vehicle', '\f1ba'],
         'fab fa-teamspeak' => ['TeamSpeak', '\f4f9'],
         'fas fa-teeth' => ['bite, dental, dentist, gums, mouth, smile, tooth', '\f62e'],
         'fas fa-teeth-open' => ['dental, dentist, gums bite, mouth, smile, tooth', '\f62f'],
         'fab fa-telegram' => ['Telegram', '\f2c6'],
         'fab fa-telegram-plane' => ['Telegram Plane', '\f3fe'],
         'fas fa-temperature-high' => ['cook, covid-19, mercury, summer, thermometer, warm', '\f769'],
         'fas fa-temperature-low' => ['cold, cool, covid-19, mercury, thermometer, winter', '\f76b'],
         'fab fa-tencent-weibo' => ['Tencent Weibo', '\f1d5'],
         'fas fa-tenge' => ['currency, kazakhstan, money, price', '\f7d7'],
         'fas fa-terminal' => ['code, command, console, development, prompt', '\f120'],
         'fas fa-text-height' => ['edit, font, format, text, type', '\f034'],
         'fas fa-text-width' => ['edit, font, format, text, type', '\f035'],
         'fas fa-th' => ['blocks, boxes, grid, squares', '\f00a'],
         'fas fa-th-large' => ['blocks, boxes, grid, squares', '\f009'],
         'fas fa-th-list' => ['checklist, completed, done, finished, ol, todo, ul', '\f00b'],
         'fab fa-the-red-yeti' => ['The Red Yeti', '\f69d'],
         'fas fa-theater-masks' => ['comedy, perform, theatre, tragedy', '\f630'],
         'fab fa-themeco' => ['Themeco', '\f5c6'],
         'fab fa-themeisle' => ['ThemeIsle', '\f2b2'],
         'fas fa-thermometer' => ['covid-19, mercury, status, temperature', '\f491'],
         'fas fa-thermometer-empty' => ['cold, mercury, status, temperature', '\f2cb'],
         'fas fa-thermometer-full' => ['fever, hot, mercury, status, temperature', '\f2c7'],
         'fas fa-thermometer-half' => ['mercury, status, temperature', '\f2c9'],
         'fas fa-thermometer-quarter' => ['mercury, status, temperature', '\f2ca'],
         'fas fa-thermometer-three-quarters' => ['mercury, status, temperature', '\f2c8'],
         'fab fa-think-peaks' => ['Think Peaks', '\f731'],
         'fas fa-thumbs-down' => ['disagree, disapprove, dislike, hand, social, thumbs-o-down', '\f165'],
         'fas fa-thumbs-up' => ['agree, approve, favorite, hand, like, ok, okay, social, success, thumbs-o-up, yes, you got it dude', '\f164'],
         'fas fa-thumbtack' => ['coordinates, location, marker, pin, thumb-tack', '\f08d'],
         'fas fa-ticket-alt' => ['movie, pass, support, ticket', '\f3ff'],
         'fas fa-times' => ['close, cross, error, exit, incorrect, notice, notification, notify, problem, wrong, x', '\f00d'],
         'fas fa-times-circle' => ['close, cross, exit, incorrect, notice, notification, notify, problem, wrong, x', '\f057'],
         'fas fa-tint' => ['color, drop, droplet, raindrop, waterdrop', '\f043'],
         'fas fa-tint-slash' => ['color, drop, droplet, raindrop, waterdrop', '\f5c7'],
         'fas fa-tired' => ['angry, emoticon, face, grumpy, upset', '\f5c8'],
         'fas fa-toggle-off' => ['switch', '\f204'],
         'fas fa-toggle-on' => ['switch', '\f205'],
         'fas fa-toilet' => ['bathroom, flush, john, loo, pee, plumbing, poop, porcelain, potty, restroom, throne, washroom, waste, wc', '\f7d8'],
         'fas fa-toilet-paper' => ['bathroom, covid-19, halloween, holiday, lavatory, prank, restroom, roll', '\f71e'],
         'fas fa-toilet-paper-slash' => ['bathroom, covid-19, halloween, holiday, lavatory, leaves, prank, restroom, roll, trouble, ut oh', '\f972'],
         'fas fa-toolbox' => ['admin, container, fix, repair, settings, tools', '\f552'],
         'fas fa-tools' => ['admin, fix, repair, screwdriver, settings, tools, wrench', '\f7d9'],
         'fas fa-tooth' => ['bicuspid, dental, dentist, molar, mouth, teeth', '\f5c9'],
         'fas fa-torah' => ['book, jewish, judaism, religion, scroll', '\f6a0'],
         'fas fa-torii-gate' => ['building, shintoism', '\f6a1'],
         'fas fa-tractor' => ['agriculture, farm, vehicle', '\f722'],
         'fab fa-trade-federation' => ['Trade Federation', '\f513'],
         'fas fa-trademark' => ['copyright, register, symbol', '\f25c'],
         'fas fa-traffic-light' => ['direction, road, signal, travel', '\f637'],
         'fas fa-trailer' => ['carry, haul, moving, travel', '\f941'],
         'fas fa-train' => ['bullet, commute, locomotive, railway, subway', '\f238'],
         'fas fa-tram' => ['crossing, machine, mountains, seasonal, transportation', '\f7da'],
         'fas fa-transgender' => ['intersex', '\f224'],
         'fas fa-transgender-alt' => ['intersex', '\f225'],
         'fas fa-trash' => ['delete, garbage, hide, remove', '\f1f8'],
         'fas fa-trash-alt' => ['delete, garbage, hide, remove, trash-o', '\f2ed'],
         'fas fa-trash-restore' => ['back, control z, oops, undo', '\f829'],
         'fas fa-trash-restore-alt' => ['back, control z, oops, undo', '\f82a'],
         'fas fa-tree' => ['bark, fall, flora, forest, nature, plant, seasonal', '\f1bb'],
         'fab fa-trello' => ['atlassian', '\f181'],
         'fab fa-tripadvisor' => ['TripAdvisor', '\f262'],
         'fas fa-trophy' => ['achievement, award, cup, game, winner', '\f091'],
         'fas fa-truck' => ['cargo, delivery, shipping, vehicle', '\f0d1'],
         'fas fa-truck-loading' => ['box, cargo, delivery, inventory, moving, rental, vehicle', '\f4de'],
         'fas fa-truck-monster' => ['offroad, vehicle, wheel', '\f63b'],
         'fas fa-truck-moving' => ['cargo, inventory, rental, vehicle', '\f4df'],
         'fas fa-truck-pickup' => ['cargo, vehicle', '\f63c'],
         'fas fa-tshirt' => ['clothing, fashion, garment, shirt', '\f553'],
         'fas fa-tty' => ['communication, deaf, telephone, teletypewriter, text', '\f1e4'],
         'fab fa-tumblr' => ['Tumblr', '\f173'],
         'fab fa-tumblr-square' => ['Tumblr Square', '\f174'],
         'fas fa-tv' => ['computer, display, monitor, television', '\f26c'],
         'fab fa-twitch' => ['Twitch', '\f1e8'],
         'fab fa-twitter' => ['social network, tweet', '\f099'],
         'fab fa-twitter-square' => ['social network, tweet', '\f081'],
         'fab fa-typo3' => ['Typo3', '\f42b'],
         'fab fa-uber' => ['Uber', '\f402'],
         'fab fa-ubuntu' => ['linux, operating system, os', '\f7df'],
         'fab fa-uikit' => ['UIkit', '\f403'],
         'fab fa-umbraco' => ['Umbraco', '\f8e8'],
         'fas fa-umbrella' => ['protection, rain, storm, wet', '\f0e9'],
         'fas fa-umbrella-beach' => ['protection, recreation, sand, shade, summer, sun', '\f5ca'],
         'fas fa-underline' => ['edit, emphasis, format, text, writing', '\f0cd'],
         'fas fa-undo' => ['back, control z, exchange, oops, return, rotate, swap', '\f0e2'],
         'fas fa-undo-alt' => ['back, control z, exchange, oops, return, swap', '\f2ea'],
         'fab fa-uniregistry' => ['Uniregistry', '\f404'],
         'fab fa-unity' => ['Unity 3D', '\f949'],
         'fas fa-universal-access' => ['accessibility, hearing, person, seeing, visual impairment', '\f29a'],
         'fas fa-university' => ['bank, building, college, higher education - students, institution', '\f19c'],
         'fas fa-unlink' => ['attachment, chain, chain-broken, remove', '\f127'],
         'fas fa-unlock' => ['admin, lock, password, private, protect', '\f09c'],
         'fas fa-unlock-alt' => ['admin, lock, password, private, protect', '\f13e'],
         'fab fa-untappd' => ['Untappd', '\f405'],
         'fas fa-upload' => ['hard drive, import, publish', '\f093'],
         'fab fa-ups' => ['United Parcel Service, package, shipping', '\f7e0'],
         'fab fa-usb' => ['USB', '\f287'],
         'fas fa-user' => ['account, avatar, head, human, man, person, profile', '\f007'],
         'fas fa-user-alt' => ['account, avatar, head, human, man, person, profile', '\f406'],
         'fas fa-user-alt-slash' => ['account, avatar, head, human, man, person, profile', '\f4fa'],
         'fas fa-user-astronaut' => ['avatar, clothing, cosmonaut, nasa, space, suit', '\f4fb'],
         'fas fa-user-check' => ['accept, check, person, verified', '\f4fc'],
         'fas fa-user-circle' => ['account, avatar, head, human, man, person, profile', '\f2bd'],
         'fas fa-user-clock' => ['alert, person, remind, time', '\f4fd'],
         'fas fa-user-cog' => ['admin, cog, person, settings', '\f4fe'],
         'fas fa-user-edit' => ['edit, pen, pencil, person, update, write', '\f4ff'],
         'fas fa-user-friends' => ['group, people, person, team, users', '\f500'],
         'fas fa-user-graduate' => ['cap, clothing, commencement, gown, graduation, person, student', '\f501'],
         'fas fa-user-injured' => ['cast, injury, ouch, patient, person, sling', '\f728'],
         'fas fa-user-lock' => ['admin, lock, person, private, unlock', '\f502'],
         'fas fa-user-md' => ['covid-19, job, medical, nurse, occupation, physician, profile, surgeon', '\f0f0'],
         'fas fa-user-minus' => ['delete, negative, remove', '\f503'],
         'fas fa-user-ninja' => ['assassin, avatar, dangerous, deadly, sneaky', '\f504'],
         'fas fa-user-nurse' => ['covid-19, doctor, midwife, practitioner, surgeon', '\f82f'],
         'fas fa-user-plus' => ['add, avatar, positive, sign up, signup, team', '\f234'],
         'fas fa-user-secret' => ['clothing, coat, hat, incognito, person, privacy, spy, whisper', '\f21b'],
         'fas fa-user-shield' => ['admin, person, private, protect, safe', '\f505'],
         'fas fa-user-slash' => ['ban, delete, remove', '\f506'],
         'fas fa-user-tag' => ['avatar, discount, label, person, role, special', '\f507'],
         'fas fa-user-tie' => ['avatar, business, clothing, formal, professional, suit', '\f508'],
         'fas fa-user-times' => ['archive, delete, remove, x', '\f235'],
         'fas fa-users' => ['friends, group, people, persons, profiles, team', '\f0c0'],
         'fas fa-users-cog' => ['admin, cog, group, person, settings, team', '\f509'],
         'fab fa-usps' => ['american, package, shipping, usa', '\f7e1'],
         'fab fa-ussunnah' => ['us-Sunnah Foundation', '\f407'],
         'fas fa-utensil-spoon' => ['cutlery, dining, scoop, silverware, spoon', '\f2e5'],
         'fas fa-utensils' => ['cutlery, dining, dinner, eat, food, fork, knife, restaurant', '\f2e7'],
         'fab fa-vaadin' => ['Vaadin', '\f408'],
         'fas fa-vector-square' => ['anchors, lines, object, render, shape', '\f5cb'],
         'fas fa-venus' => ['female', '\f221'],
         'fas fa-venus-double' => ['female', '\f226'],
         'fas fa-venus-mars' => ['Gender', '\f228'],
         'fab fa-viacoin' => ['Viacoin', '\f237'],
         'fab fa-viadeo' => ['Video', '\f2a9'],
         'fab fa-viadeo-square' => ['Video Square', '\f2aa'],
         'fas fa-vial' => ['experiment, lab, sample, science, test, test tube', '\f492'],
         'fas fa-vials' => ['experiment, lab, sample, science, test, test tube', '\f493'],
         'fab fa-viber' => ['Viber', '\f409'],
         'fas fa-video' => ['camera, film, movie, record, video-camera', '\f03d'],
         'fas fa-video-slash' => ['add, create, film, new, positive, record, video', '\f4e2'],
         'fas fa-vihara' => ['buddhism, buddhist, building, monastery', '\f6a7'],
         'fab fa-vimeo' => ['Vimeo', '\f40a'],
         'fab fa-vimeo-square' => ['Vimeo Square', '\f194'],
         'fab fa-vimeo-v' => ['vimeo', '\f27d'],
         'fab fa-vine' => ['Vine', '\f1ca'],
         'fas fa-virus' => ['bug, covid-19, flu, health, sick, viral', '\f974'],
         'fas fa-virus-slash' => ['bug, covid-19, cure, eliminate, flu, health, sick, viral', '\f975'],
         'fas fa-viruses' => ['bugs, covid-19, flu, health, multiply, sick, spread, viral', '\f976'],
         'fab fa-vk' => ['VK', '\f189'],
         'fab fa-vnv' => ['VNV', '\f40b'],
         'fas fa-voicemail' => ['answer, inbox, message, phone', '\f897'],
         'fas fa-volleyball-ball' => ['beach, olympics, sport', '\f45f'],
         'fas fa-volume-down' => ['audio, lower, music, quieter, sound, speaker', '\f027'],
         'fas fa-volume-mute' => ['audio, music, quiet, sound, speaker', '\f6a9'],
         'fas fa-volume-off' => ['audio, ban, music, mute, quiet, silent, sound', '\f026'],
         'fas fa-volume-up' => ['audio, higher, louder, music, sound, speaker', '\f028'],
         'fas fa-vote-yea' => ['accept, cast, election, politics, positive, yes', '\f772'],
         'fas fa-vr-cardboard' => ['3d, augment, google, reality, virtual', '\f729'],
         'fab fa-vuejs' => ['Vue.js', '\f41f'],
         'fas fa-walking' => ['exercise, health, pedometer, person, steps', '\f554'],
         'fas fa-wallet' => ['billfold, cash, currency, money', '\f555'],
         'fas fa-warehouse' => ['building, capacity, garage, inventory, storage', '\f494'],
         'fas fa-water' => ['lake, liquid, ocean, sea, swim, wet', '\f773'],
         'fas fa-wave-square' => ['frequency, pulse, signal', '\f83e'],
         'fab fa-waze' => ['Waze', '\f83f'],
         'fab fa-weebly' => ['Weebly', '\f5cc'],
         'fab fa-weibo' => ['Weibo', '\f18a'],
         'fas fa-weight' => ['Angular', '\health, measurement, scale, weight'],
         'fas fa-weight-hanging' => ['anvil, heavy, measurement', '\f5cd'],
         'fab fa-weixin' => ['Weixin (WeChat)', '\f1d7'],
         'fab fa-whatsapp' => ["What's App", '\f232'],
         'fab fa-whatsapp-square' => ["What's App Square", '\f40c'],
         'fas fa-wheelchair' => ['accessible, handicap, person', '\f193'],
         'fab fa-whmcs' => ['WHMCS', '\f40d'],
         'fas fa-wifi' => ['connection, hotspot, internet, network, wireless', '\f1eb'],
         'fab fa-wikipedia-w' => ['Wikipedia W', '\f266'],
         'fas fa-wind' => ['air, blow, breeze, fall, seasonal, weather', '\f72e'],
         'fas fa-window-close' => ['browser, cancel, computer, development', '\f410'],
         'fas fa-window-maximize' => ['browser, computer, development, expand', '\f2d0'],
         'fas fa-window-minimize' => ['browser, collapse, computer, development', '\f2d1'],
         'fas fa-window-restore' => ['browser, computer, development', '\f2d2'],
         'fab fa-windows' => ['microsoft, operating system, os', '\f17a'],
         'fas fa-wine-bottle' => ['alcohol, beverage, cabernet, drink, glass, grapes, merlot, sauvignon', '\f72f'],
         'fas fa-wine-glass' => ['alcohol, beverage, cabernet, drink, grapes, merlot, sauvignon', '\f4e3'],
         'fas fa-wine-glass-alt' => ['alcohol, beverage, cabernet, drink, grapes, merlot, sauvignon', '\f5ce'],
         'fab fa-wix' => ['Wix', '\f5cf'],
         'fab fa-wizards-of-the-coast' => ['Dungeons & Dragons, d&d, dnd, fantasy, game, gaming, tabletop', '\f730'],
         'fab fa-wolf-pack-battalion' => ['Wolf Pack Battalion', '\f514'],
         'fas fa-won-sign' => ['currency, krw, money', '\f159'],
         'fab fa-wordpress' => ['WordPress Logo', '\f19a'],
         'fab fa-wordpress-simple' => ['Wordpress Simple', '\f411'],
         'fab fa-wpbeginner' => ['WPBeginner', '\f297'],
         'fab fa-wpexplorer' => ['WPExplorer', '\f2de'],
         'fab fa-wpforms' => ['WPForms', '\f298'],
         'fab fa-wpressr' => ['rendact', '\f3e4'],
         'fas fa-wrench' => ['construction, fix, mechanic, plumbing, settings, spanner, tool, update', '\f0ad'],
         'fas fa-x-ray' => ['health, medical, radiological images, radiology, skeleton', '\f497'],
         'fab fa-xbox' => ['Xbox', '\f412'],
         'fab fa-xing' => ['Xing', '\f168'],
         'fab fa-xing-square' => ['Xing Square', '\f169'],
         'fab fa-y-combinator' => ['Y Combinator', '\f23b'],
         'fab fa-yahoo' => ['Yahoo Logo', '\f19e'],
         'fab fa-yammer' => ['Yammer', '\f840'],
         'fab fa-yandex' => ['Yandex', '\f413'],
         'fab fa-yandex-international' => ['Yandex International', '\f414'],
         'fab fa-yarn' => ['Yarn', '\f7e3'],
         'fab fa-yelp' => ['Yelp', '\f1e9'],
         'fas fa-yen-sign' => ['currency, jpy, money', '\f157'],
         'fas fa-yin-yang' => ['daoism, opposites, taoism', '\f6ad'],
         'fab fa-yoast' => ['Yoast', '\f2b1'],
         'fab fa-youtube' => ['film, video, youtube-play, youtube-square', '\f167'],
         'fab fa-youtube-square' => ['YouTube Square', '\f431'],
         'fab fa-zhihu' => ['Zhihu', '\f63f'],
      );

      $icons = '';
      foreach ($iconArray as $iKey => $iValue) {
         $name = explode(',', $iValue[0]);
         $name = ucwords($name[0]);
         $icons .= "<{$startTag} data-icon-name='{$iValue[0]}'> {$name}<i class='{$iKey}'></i>{$endTag}";
      }
      return $icons;
   }

   function anc_6310_check_field_exists(){
      global $wpdb;
      $counter_table = $wpdb->prefix . 'anc_6310_counter';
      $charset_collate = $wpdb->get_charset_collate();

      $wpdb->query("SHOW COLUMNS FROM {$counter_table} LIKE 'numbers_start'");
      if(!($wpdb->num_rows)){
         $wpdb->query("alter table {$counter_table} add (numbers_start varchar(100) DEFAULT 0)");
      }

      $wpdb->query("SHOW COLUMNS FROM {$counter_table} LIKE 'icon_type'");
      if(!($wpdb->num_rows)){
         $wpdb->query("alter table {$counter_table} add (icon_type tinyint DEFAULT 0)");
      }

      $wpdb->query("SHOW COLUMNS FROM {$counter_table} LIKE 'custom_icon'");
      if(!($wpdb->num_rows)){
         $wpdb->query("alter table {$counter_table} add (custom_icon text DEFAULT NULL)");
      }
   }

   function anc_6310_icon_image_load($allCounter) {
      if($allCounter['icon_type']) {
         echo "<img src='{$allCounter['custom_icon']}' />";
      } else{
         echo "<i class='{$allCounter['icons']}'></i>";
      }
   }

   function anc_6310_background_setting($bgType, $cssData) {
      $bgTypeList = ['', 'Transparent', 'Background Color', 'Background Image', 'Youtube Video'];
      ?>
      <tr height="45">
         <td width="55%">
            <b>Template Background Type</b><span class="anc-6310-pro">(Pro) <div class="anc-6310-pro-text">This feature is available on the pro version only. You can view changes in the admin panel, not in the output.</div></span>
            <div class="anc-6310-tooltip">(No preview available)</div>
         </td>
         <td>
            <select name="background_type" id="background_type" class="anc-6310-form-input">
               <?php
                  for($i = 1; $i < count($bgTypeList); $i++) {
                     $selected = ($bgType == $i) ? ' selected':'';
                     echo "<option value='{$i}'{$selected}>{$bgTypeList[$i]}</option>";
                  }
               ?>
            </select>
         </td>
      </tr>
      <input type="hidden" name="background_transparent" value="transparent" />
      <tr height="45" id='background-type-2'>
         <td width="55%">
            <b>Template Background Color</b>
            <div class="anc-6310-tooltip">(No preview available)</div>
         </td>
         <td>
            <input type="text" name="template_background_color" class="anc-6310-form-input anc_6310_color_picker" step="1" data-opacity="0" data-format="rgb" value="<?php echo isset($cssData['template_background_color']) ? $cssData['template_background_color'] : 'rgba(255, 255, 255, 0)' ?>">
         </td>
      </tr>
      <tr height="45" id='background-type-3'>
         <td width="55%">
            <b>Template Background Image</b>
            <div class="anc-6310-tooltip">(No preview available)</div>
         </td>
         <td>
         <input type="text" name="box_background_image" id="anc_6310_box_background_image" class="anc-6310-form-input" data-opacity=".8" data-format="rgb" value="<?php echo isset($cssData['box_background_image']) ? $cssData['box_background_image'] : '' ?>">
         <input type="button" id="anc_6310_box_background_image_button" value="Upload Image" class="anc-6310-btn-default" style='margin-top: 5px;'>
         </td>
      </tr>
      <tr height="45" id='background-type-4'>
         <td width="55%">
            <b>Youtube Video URL</b>
            <div class="anc-6310-tooltip">(No preview available)</div>
         </td>
         <td>
         <input type="text" name="youtube_video_url" class="anc-6310-form-input" value="<?php echo isset($cssData['youtube_video_url']) ? $cssData['youtube_video_url'] : '' ?>">
         </td>
      </tr>

      <script type="text/javascript">
         jQuery(document).ready(function(){
            jQuery('#background-type-2, #background-type-3, #background-type-4').hide();
            jQuery('#background-type-<?php echo $bgType ?>').show();

            jQuery("body").on("change", '#background_type', function(){
               var val = jQuery(this).val();
               jQuery('#background-type-2, #background-type-3, #background-type-4').hide();
               jQuery(`#background-type-${val}`).show();
            });

            jQuery("body").on("click", "#anc_6310_box_background_image_button", function(e) {
               e.preventDefault();
               var image = wp.media({
                  title: 'Upload Image',
                  multiple: false
               }).open()
               .on('select', function(e) {
                  var uploaded_image = image.state().get('selection').first();
                  var image_url = uploaded_image.toJSON().url;

                  jQuery(`#anc_6310_box_background_image`).val(image_url);
                  //jQuery("#vkcmu-favicon-image").attr("src", image_url);
               });

               jQuery("#wpm_6310_add_new_media").css({
               "overflow-x": "hidden",
               "overflow-y": "auto"
               });
            });
         });
      </script>
      <?php
   } 
   
   function anc_6310_counter_suffix($data, $ids){
      if(!$data) return;
      echo "<div class='anc-6310-counter-{$ids}-count-suffix'>{$data}</div>";
   }

   function anc_6310_counter_description($data, $ids){
      if(!$data) return;
      echo "<div class='anc-6310-counter-{$ids}-count-subtitle'>".anc_6310_special_character_remove($data)."</div>";
   }
   function anc_6310_counter_button_section($url, $data, $ids){
      if(!$data) return;
      echo "<div class='anc-6310-counter-{$ids}-button'><a href='{$url}' target='_blank'>". anc_6310_special_character_remove($data) ."</a></div>";
   }