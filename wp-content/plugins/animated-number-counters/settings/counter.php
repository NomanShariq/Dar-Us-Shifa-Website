<?php
if (!defined('ABSPATH'))
  exit;
?>
<div class="anc-6310">
  <h1>Counter Profiles <button class="anc-6310-btn-success" id="add-accordion">Add New</button></h1>
  <?php
  $counter_table = $wpdb->prefix . 'anc_6310_counter';
  wp_enqueue_media();

  if (!empty($_POST['rearrange-icon-list-save']) && isset($_POST['member_id']) && is_numeric($_POST['member_id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-update-icon-order')) {
      die('You do not have sufficient permissions to access this pageddd.');
    } else {
      $selMember = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $_POST['member_id']), ARRAY_A);
      if ($selMember['iconids']) {
        $iconUrl = explode("||||", $selMember['iconurl']);
        $iconIds = explode(",", $selMember['iconids']);
        $icons = explode(",", $_POST['rearrange_list']);
        $url = "";
        for ($i = 0; $i < count($icons); $i++) {
          if ($url) {
            $url .= "||||";
          }
          $index = array_search($icons[$i], $iconIds);
          $url .= $iconUrl[$index];
        }
        if ($url) {
          $wpdb->query($wpdb->prepare("UPDATE $counter_table SET iconids = %s, iconurl = %s WHERE id = %d", $_POST['rearrange_list'], $url, $_POST['member_id']));
        }
      }
    }
  }

  if (!empty($_POST['rearrange-contact-list-save']) && isset($_POST['member_id']) && is_numeric($_POST['member_id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-update-contacts-order')) {
      die('You do not have sufficient permissions to access this pageddd.');
    } else {

      $idList = explode("####||||####", $_POST['rearrange_list']);
      $selMember = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $_POST['member_id']), ARRAY_A);
      $iconList = explode("####||||####", $selMember['contact_info']);
      $iconsArray = [];
      foreach ($idList as $list) {
        $iconsArray[] = $iconList[$list];
      }
      $iconsArray = implode("####||||####", $iconsArray);
      $wpdb->query($wpdb->prepare("UPDATE $counter_table SET contact_info = %s WHERE id = %d", $iconsArray, $_POST['member_id']));
    }
  }
  if (!empty($_POST['duplicate']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'tss_nonce_field_duplicate')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) $_POST['id'];
      $selectedData = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $id), ARRAY_A);
      $dupList = array(
              $selectedData['title'] , 
              $selectedData['description'], 
              $selectedData['numbers_start'],
              $selectedData['numbers'],
              $selectedData['icons'],
              $selectedData['readmore_text'],
              $selectedData['readmore_url'],
              $selectedData['image'],
              $selectedData['hoverimage'],
              $selectedData['commons'],
              $selectedData['styleid'],
              $selectedData['icon_type'],
              $selectedData['custom_icon']);
      $wpdb->query($wpdb->prepare("INSERT INTO {$counter_table} (title, description, numbers_start, numbers, icons, readmore_text, readmore_url, image, hoverimage, commons, styleid, icon_type, custom_icon) VALUES ( %s, %s, %d, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s )", $dupList));
    }
  }

  if (!empty($_POST['delete']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field-delete')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) $_POST['id'];
      $wpdb->query($wpdb->prepare("DELETE FROM {$counter_table} WHERE id = %d", $id));
    }
  } else if (!empty($_POST['save']) && $_POST['save'] == 'Save') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-add')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $myData = array();
      $myData[] = $_POST['title'];
      $myData[] = $_POST['description'];
      $myData[] = $_POST['numbers'];
      $myData[] = $_POST['icons'];
      $myData[] = $_POST['readmore_text'];
      $myData[] = $_POST['readmore_url'];
      $myData[] = $_POST['image'];
      $myData[] = $_POST['number_prefix'] . "###|||###" . $_POST['number_suffix'];
      $myData[] = $_POST['numbers_start'];
      $myData[] = $_POST['icon_type'];
      $myData[] = $_POST['custom_icon'];

      $wpdb->query($wpdb->prepare(
        "INSERT INTO {$counter_table} set
                     title = %s,
                     description = %s,
                     numbers = %s,
                     icons = %s,
                     readmore_text = %s,
                     readmore_url = %s, 
                     image = %s, 
                     commons = %s,
                     numbers_start = %s,
                     icon_type = %s,
                     custom_icon = %s",
        $myData
      ));
    }
  } else if (!empty($_POST['update']) && $_POST['update'] == 'Update') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-update')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) sanitize_text_field($_POST['eid']);
      $myData = array();
      $myData[] = $_POST['title'];
      $myData[] = $_POST['description'];
      $myData[] = $_POST['numbers'];
      $myData[] = $_POST['icons'];
      $myData[] = $_POST['readmore_text'];
      $myData[] = $_POST['readmore_url'];
      $myData[] = $_POST['image'];
      $myData[] = $_POST['number_prefix'] . "###|||###" . $_POST['number_suffix'];
      $myData[] = $_POST['numbers_start'];
      $myData[] = $_POST['icon_type'];
      $myData[] = $_POST['custom_icon'];
      $myData[] = $id;

      $wpdb->query($wpdb->prepare("UPDATE {$counter_table} set
                     title = %s,
                     description = %s,
                     numbers = %s,
                     icons = %s,
                     readmore_text = %s,
                     readmore_url = %s, 
                     image = %s, 
                     commons = %s,
                     numbers_start = %s,
                     icon_type = %s,
                     custom_icon = %s
                     where id = %d", $myData));
    }
  } else if (!empty($_POST['edit']) && $_POST['edit'] == 'Edit') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field-edit')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) $_POST['id'];
      $counter = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $id), ARRAY_A);
      $numbersPosition = ['', ''];
      if ($counter['commons'] != '') {
        $numbersPosition = explode('###|||###', $counter['commons']);
      }
  ?>
      <div id="anc-6310-modal-edit" class="anc-6310-modal" style="display: none">
        <div class="anc-6310-modal-content anc-6310-modal-lg">
          <form action="" method="post">
            <?php wp_nonce_field("anc-6310-nonce-update") ?>
            <input type="hidden" name="eid" value="<?php echo $id; ?>" />
            <div class="anc-6310-modal-header">
              Edit Counter
              <span class="anc-6310-close">&times;</span>
            </div>
            <div class="anc-6310-modal-body-form">
              <table border="0" width="100%" cellpadding="10" cellspacing="0">
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="title">Title:</label></td>
                  <td><input type="text" name="title" id="title" value="<?php echo anc_6310_special_character_remove($counter['title']) ?>" class="anc-6310-form-input lg" placeholder="Counter Title" /></td>
                </tr>
                <tr>
                  <td><label class="anc-6310-form-label" for="description">Description:</label></td>
                  <td>
                    <textarea name="description" id="description" class="anc-6310-form-input lg"><?php echo anc_6310_special_character_remove($counter['description']) ?></textarea>
                  </td>
                </tr>
                <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="number_prefix">Number Prefix <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
              <td><input type="text" name="number_prefix" id="number_prefix" value="<?php echo $numbersPosition[0] ?>" class="anc-6310-form-input lg" placeholder="Number Prefix" /></td>
            </tr>
            <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="numbers">Start Number <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
                  <td><input type="text" name="numbers_start" id="numbers" value="<?php echo $counter['numbers_start'] ?>" class="anc-6310-form-input lg" placeholder="0" /></td>
                </tr>
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="numbers">End Number :</label></td>
                  <td><input type="text" name="numbers" id="numbers" value="<?php echo $counter['numbers'] ?>" class="anc-6310-form-input lg" placeholder="100" /></td>
                </tr>
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="number_suffix">Number Suffix <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
                  <td><input type="text" name="number_suffix" id="number_suffix" value="<?php echo $numbersPosition[1] ?>" class="anc-6310-form-input lg" placeholder="Number Suffix" /></td>
                </tr>
                <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="icons">Icons Type:</label></td>
              <td>
                <input type="radio" name='icon_type' class='icon_type_edit' value='0' checked /> Font Awesome Icon
                <input type="radio" name='icon_type' class="icon_type_edit" value='1' <?php echo $counter['icon_type'] == 1 ? ' checked': '' ?> style='margin-left: 30px' /> Custom Icon<span class="anc-6310-tooltip">(Pro)</span> :
              </td>
            </tr>
            <tr class="custom-icon-edit">
              <td style="width: 150px;"><label class="anc-6310-form-label" for="picture">Custom Icon:</label></td>
              <td>
                <input type="text" name="custom_icon" id="custom_icon" class="anc-6310-form-input" value="<?php echo $counter['custom_icon'] ?>">
                <input type="button" id="custom-icon-image" value="Upload Custom Icon" class="anc-6310-btn-default anc-6310-icon-upload-edit">
              </td>
            </tr>
                <tr height="40px" class="anc-6310-form-icon font-awesome-icon-edit" id="1">
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="icons">Icons:</label></td>
                  <td>
                    <input type="text" name="icons" id="icons" class="anc-6310-form-input lg" value="<?php echo $counter['icons'] ?>" readonly="">
                    <div class="anc-plus-icons"><i class="fas fa-plus-circle"></i></div>
                  </td>
                </tr>
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="readmore">Button Text <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
                  <td><input type="text" name="readmore_text" id="readmore" value="<?php echo anc_6310_special_character_remove($counter['readmore_text']) ?>" class="anc-6310-form-input lg" placeholder="Read More"></td>
                </tr>
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="readmoreurl">Button URL <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
                  <td><input type="text" name="readmore_url" value="<?php echo $counter['readmore_url'] ?>" id="readmoreurl" class="anc-6310-form-input lg" placeholder="https://www.wpmart.org"></td>
                </tr>
                <tr class="anc-6310-form-image">
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="picture">Picture:</label></td>
                  <td>
                    <input type="text" name="image" id="image" value="<?php echo $counter['image'] ?>" class="anc-6310-form-input">
                    <input type="button" id="btn-image" value="Upload Image" class="anc-6310-btn-default anc-6310-image-upload">
                  </td>
                </tr>
              </table>

            </div>
            <div class="anc-6310-modal-form-footer">
              <button type="button" name="close" id="anc-6310-from-close-edit" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
              <input type="submit" name="update" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" value="Update" />
            </div>
            <br class="anc-6310-clear" />
          </form>
        </div>
        <br class="anc-6310-clear" />
      </div>
      <script>
        jQuery(document).ready(function() {
          //Custom Icon
          <?php
            echo ($counter['icon_type'] != 1) ? "jQuery('.custom-icon-edit').hide();":"jQuery('.font-awesome-icon-edit').hide();"; 
          ?>
          jQuery('body').on('change', '.icon_type_edit', function(){
            let val = Number(jQuery(this).val());
            jQuery('.custom-icon-edit, .font-awesome-icon-edit').hide();
            val ? (jQuery('.custom-icon-edit').show()) : (jQuery('.font-awesome-icon-edit').show());
          });
          /* ######### Custom Icon Media Start ########### */
          jQuery("body").on("click", ".anc-6310-icon-upload-edit", function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Icon',
                multiple: false
              }).open()
              .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                jQuery(`#custom_icon`).val(image_url);
              });

            jQuery("#wpm_6310_add_new_media").css({
              "overflow-x": "hidden",
              "overflow-y": "auto"
            });
          });

          jQuery('#anc-6310-modal-edit').fadeIn(500);
          jQuery("body").css({
            "overflow": "hidden"
          });

          jQuery("body").on("click", ".anc_6310_icon_remove-edit", function(e) {
            jQuery(this).parent().parent().remove();
            return false;
          });
          jQuery("body").on("click", ".anc_6310_icon_remove-edit-exist", function(e) {
            jQuery(this).parent().remove();
            return false;
          });
          /* Social Icon End */

          jQuery("body").on("click", ".anc-6310-close-edit, #anc-6310-from-close-edit", function() {
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

          /* ######### Media Start ########### */
          jQuery("body").on("click", "#anc_6310_upload_team_member_image-edit", function(e) {
            e.preventDefault();
            var image = wp.media({
                title: 'Upload Image',
                multiple: false
              }).open()
              .on('select', function(e) {
                var uploaded_image = image.state().get('selection').first();
                var image_url = uploaded_image.toJSON().url;
                jQuery("#anc_6310_upload_team_member_image_src-edit").val(image_url);
                //jQuery("#vkcmu-favicon-image").attr("src", image_url);
              });

            jQuery("#anc_6310_add_new_media").css({
              "overflow-x": "hidden",
              "overflow-y": "auto"

            });

          });


          /* ######### Media End ########### */

        });
      </script>

      </script>
    <?php
    }
  } else if (!empty($_POST['rearrange-contacts']) && $_POST['rearrange-contacts'] == 'Rearrange') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field-reorder-contacts')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) $_POST['id'];
    ?>

      <div id="anc_6310_rearrange_team_modal" class="anc-6310-modal" style="display: none">
        <div class="anc-6310-modal-content anc-6310-modal-sm">
          <form action="" method="post">
            <?php wp_nonce_field("anc-6310-nonce-update-contacts-order") ?>
            <input type="hidden" name="member_id" value="<?php echo $id ?>" />
            <input type="hidden" name="rearrange_list" id="rearrange_list" value="" />
            <div class="anc-6310-modal-header">
              Rearrange Contacts Order
              <span class="anc-6310-close">&times;</span>
            </div>
            <div class="anc-6310-modal-body-form">
              <ul id="anc-6310-sortable">
                <?php
                $selMember = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $id), ARRAY_A);
                $contactNumber = 0;
                if ($selMember['contact_info']) {
                  $contacts = explode("####||||####", $selMember['contact_info']);
                  foreach ($contacts as $key => $contact) {
                    $temp = explode("||||", $contact);
                    $cls = str_replace("\\", "", $temp[0]);
                    $contact = str_replace("\\", "", $contact);
                    echo "<li class='ui-state-default anc-6310-ui-state-default' id='{$contactNumber}'>" . $cls . ": {$temp[1]}</li>";
                    $contactNumber++;
                  }
                }
                ?>
              </ul>
            </div>
            <div class="anc-6310-modal-form-footer">
              <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
              <input type="submit" name="rearrange-contact-list-save" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" id="anc-6310-sortable-sub" value="Save" />
            </div>
          </form>
          <br class="anc-6310-clear" />
        </div>
      </div>
      <style>
        .anc-6310-ui-state-default {
          padding: 8px 10px !important;
          cursor: pointer !important;
          border-radius: 3px !important;
        }
      </style>
      <script>
        var $ = jQuery;
        jQuery(document).ready(function() {
          jQuery('#anc_6310_rearrange_team_modal').fadeIn(500);
          jQuery("body").css({
            "overflow": "hidden"
          });
        });
        jQuery(function() {
          jQuery("#anc-6310-sortable").sortable();
          jQuery("#anc-6310-sortable").disableSelection();
        });
        jQuery(document).ready(function() {
          jQuery("#anc-6310-sortable-sub").click(function() {
            var list_sortable = jQuery('#anc-6310-sortable').sortable('toArray').join("####||||####");
            jQuery("#rearrange_list").val(list_sortable);
          });

          jQuery("body").on("click", ".anc-6310-row-select-checkbox", function(event) {
            event.stopPropagation();
          });


          jQuery("body").on("click", "#anc_6310_rearrange_team", function() {
            jQuery("#anc_6310_rearrange_team_modal").fadeIn(500);
            jQuery("body").css({
              "overflow": "hidden"
            });
            return false;
          });

          jQuery("body").on("click", "#anc_6310_add_new_media", function() {
            jQuery("#anc_6310_add_new_media_modal").fadeIn(500);
            jQuery("body").css({
              "overflow": "hidden"
            });
            return false;
          });
          jQuery("body").on("click", ".anc-6310-close, .anc-6310-btn-danger", function() {
            jQuery("#anc_6310_add_new_media_modal, #anc_6310_rearrange_team_modal").fadeOut(500);
            jQuery("body").css({
              "overflow": "initial"
            });
          });
          jQuery(window).click(function(event) {
            if (event.target == document.getElementById('anc_6310_rearrange_team_modal')) {
              jQuery("#anc_6310_rearrange_team_modal").fadeOut(500);
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
  } else if (!empty($_POST['rearrange-icon']) && $_POST['rearrange-icon'] == 'Rearrange') {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'anc-6310-nonce-field-reorder-icon')) {
      die('You do not have sufficient permissions to access this page.');
    } else {
      $id = (int) $_POST['id'];
    ?>

      <div id="anc_6310_rearrange_team_modal" class="anc-6310-modal" style="display: none">
        <div class="anc-6310-modal-content anc-6310-modal-sm">
          <form action="" method="post">
            <?php wp_nonce_field("anc-6310-nonce-update-icon-order") ?>
            <input type="hidden" name="member_id" value="<?php echo $id ?>" />
            <input type="hidden" name="rearrange_list" id="rearrange_list" value="" />
            <div class="anc-6310-modal-header">
              Rearrange Social Icon Order
              <span class="anc-6310-close">&times;</span>
            </div>
            <div class="anc-6310-modal-body-form">
              <ul id="anc-6310-sortable">
                <?php
                $selMember = $wpdb->get_row($wpdb->prepare("SELECT * FROM $counter_table WHERE id = %d ", $id), ARRAY_A);
                if ($selMember['iconids']) {
                  $iconIds = explode(",", $selMember['iconids']);
                  for ($i = 0; $i < count($iconIds); $i++) {
                    if ($iconIds[$i]) {
                      $icons = $wpdb->get_row("SELECT * FROM $icon_table WHERE id={$iconIds[$i]}", ARRAY_A);
                      echo "<li class='ui-state-default anc-6310-ui-state-default' id='{$icons['id']}'><b>{$icons['name']}: </b> <button class='anc-6310-btn-icon' style='color:" . $icons['color'] . "; background-color: " . $icons['bgcolor'] . "; margin-right: 5px; margin-bottom: 5px;'><i class='" . $icons['class_name'] . "'></i></button></li>";
                    }
                  }
                }
                ?>
              </ul>
            </div>
            <div class="anc-6310-modal-form-footer">
              <button type="button" name="close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
              <input type="submit" name="rearrange-icon-list-save" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" id="anc-6310-sortable-sub" value="Save" />
            </div>
          </form>
          <br class="anc-6310-clear" />
        </div>
      </div>
      <style>
        #anc-6310-sortable li {
          color: black !important;
          background: transparent !important;
          border: 1px solid #4e994e;
        }

        .anc-6310-ui-state-default {
          padding: 8px 5px !important;
          cursor: pointer !important;
          border-radius: 3px !important;
        }
      </style>
      <script>
        var $ = jQuery;
        jQuery(document).ready(function() {
          jQuery('#anc_6310_rearrange_team_modal').fadeIn(500);
          jQuery("body").css({
            "overflow": "hidden"
          });
        });
        jQuery(function() {
          jQuery("#anc-6310-sortable").sortable();
          jQuery("#anc-6310-sortable").disableSelection();
        });
        jQuery(document).ready(function() {
          jQuery("#anc-6310-sortable-sub").click(function() {
            var list_sortable = jQuery('#anc-6310-sortable').sortable('toArray').join(",");
            jQuery("#rearrange_list").val(list_sortable);
          });

          jQuery("body").on("click", ".anc-6310-row-select-checkbox", function(event) {
            event.stopPropagation();
          });


          jQuery("body").on("click", "#anc_6310_rearrange_team", function() {
            jQuery("#anc_6310_rearrange_team_modal").fadeIn(500);
            jQuery("body").css({
              "overflow": "hidden"
            });
            return false;
          });

          jQuery("body").on("click", "#anc_6310_add_new_media", function() {
            jQuery("#anc_6310_add_new_media_modal").fadeIn(500);
            jQuery("body").css({
              "overflow": "hidden"
            });
            return false;
          });
          jQuery("body").on("click", ".anc-6310-close, .anc-6310-btn-danger", function() {
            jQuery("#anc_6310_add_new_media_modal, #anc_6310_rearrange_team_modal").fadeOut(500);
            jQuery("body").css({
              "overflow": "initial"
            });
          });
          jQuery(window).click(function(event) {
            if (event.target == document.getElementById('anc_6310_rearrange_team_modal')) {
              jQuery("#anc_6310_rearrange_team_modal").fadeOut(500);
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
  }
  ?>

  <table class="anc-6310-table">
    <tr>
      <td style="width: 120px">Title</td>
      <td>Description</td>
      <td style="width: 80px">Start Number</td>
      <td style="width: 80px">End Number</td>
      <td style="width: 30px">Icon</td>
      <td style="width: 100px">Button Text</td>
      <td style="width: 80px">Edit Delete</td>
    </tr>

    <?php
    $data = $wpdb->get_results('SELECT * FROM ' . $counter_table . ' ORDER BY id DESC', ARRAY_A);
    foreach ($data as $value) {
      $numbersPosition = ['', ''];
      if ($value['commons'] != '') {
        $numbersPosition = explode('###|||###', $value['commons']);
      }
      echo '<tr>';
      echo '<td>' . anc_6310_special_character_remove($value['title']) . '</td>';
      echo '<td>' . anc_6310_special_character_remove($value['description']) . '</td>';
      echo "<td>{$numbersPosition[0]}{$value['numbers_start']}{$numbersPosition[1]}</td>";
      echo "<td>{$numbersPosition[0]}{$value['numbers']}{$numbersPosition[1]}</td>";
      if($value['icon_type']) {
        echo '<td align="center">' . (($value['icons']) ? "<img src='{$value['custom_icon']}' style='max-width: 30px' />" : '---') . '</td>';
      } else{
        echo '<td align="center">' . (($value['icons']) ? "<i class='{$value['icons']}' style='font-size: 20px'></i>" : '---') . '</td>';
      }
      
      echo '<td align="center">' . anc_6310_special_character_remove($value['readmore_text']) . '</td>';
      echo '<td>
                 <form method="post">
                   ' . wp_nonce_field("anc-6310-nonce-field-edit") . '
                          <input type="hidden" name="id" value="' . $value['id'] . '">
                          <button class="anc-6310-btn-success anc-6310-margin-right-10" style="float:left"  title="Edit"  type="submit" value="Edit" name="edit"><i class="fas fa-edit" aria-hidden="true"></i></button>
                  </form>
                  <form method="post">
                    ' . wp_nonce_field("tss_nonce_field_duplicate") . '
                          <input type="hidden" name="id" value="' . $value['id'] . '">
                            <button class="anc-6310-btn-primary" style="float:left; margin-right:5px;"  title="Duplicate"  type="submit" value="duplicate" name="duplicate" onclick="return confirm(\'Do you want to duplicate it?\');"><i class="fas fa-clone" aria-hidden="true"></i></button>
                    </form>
                  <form method="post">
                   ' . wp_nonce_field("anc-6310-nonce-field-delete") . '
                          <input type="hidden" name="id" value="' . $value['id'] . '">
                          <button class="anc-6310-btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="delete" onclick="return confirm(\'Do you want to delete?\');"><i class="far fa-times-circle" aria-hidden="true"></i></button>
                  </form>

                             </td>';
    }
    ?>
  </table>
  <div id="anc-6310-modal-add" class="anc-6310-modal" style="display: none">
    <div class="anc-6310-modal-content anc-6310-modal-md">
      <form action="" method="post">
        <div class="anc-6310-modal-header">
          Add Counter
          <span class="anc-6310-close">&times;</span>
        </div>
        <div class="anc-6310-modal-body-form">
          <?php wp_nonce_field("anc-6310-nonce-add") ?>
          <table border="0" width="100%" cellpadding="10" cellspacing="0">
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="title">Title:</label></td>
              <td><input type="text" name="title" id="title" value="" class="anc-6310-form-input lg" placeholder="Counter Title" /></td>
            </tr>
            <tr>
              <td><label class="anc-6310-form-label" for="description">Description:</label></td>
              <td>
                <textarea name="description" id="description" class="anc-6310-form-input lg"></textarea>
              </td>
            </tr>
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="number_prefix">Number Prefix:</label></td>
              <td><input type="text" name="number_prefix" id="number_prefix" value="" class="anc-6310-form-input lg" placeholder="Number Prefix" /></td>
            </tr>
            <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="numbers">Start Number <span class="anc-6310-tooltip">(Pro)</span> :</label></td>
                  <td><input type="text" name="numbers_start" id="numbers" value="0" class="anc-6310-form-input lg" placeholder="0" /></td>
                </tr>
                <tr>
                  <td style="width: 150px;"><label class="anc-6310-form-label" for="numbers">End Number:</label></td>
                  <td><input type="text" name="numbers" id="numbers" value="10000" class="anc-6310-form-input lg" placeholder="10000" /></td>
                </tr>
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="number_suffix">Number Suffix:</label></td>
              <td><input type="text" name="number_suffix" id="number_suffix" value="" class="anc-6310-form-input lg" placeholder="Number Suffix" /></td>
            </tr>
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="icons">Icons Type:</label></td>
              <td>
                <input type="radio" name='icon_type' class='icon_type_new' value='0' checked /> Font Awesome Icon
                <input type="radio" name='icon_type' class="icon_type_new" value='1' style='margin-left: 30px' /> Custom Icon <span class="anc-6310-tooltip">(Pro)</span> :
              </td>
            </tr>
            <tr height="40px" class="anc-6310-form-icon font-awesome-icon-new" id="1">
              <td style="width: 150px;"><label class="anc-6310-form-label" for="icons">Icons:</label></td>
              <td>
                <input type="text" name="icons" id="icons" class="anc-6310-form-input lg" placeholder="fas fa-globe" readonly="">
                <div class="anc-plus-icons"><i class="fas fa-plus-circle"></i></div>
              </td>
            </tr>
            <tr class="custom-icon-new">
              <td style="width: 150px;"><label class="anc-6310-form-label" for="picture">Custom Icon:</label></td>
              <td>
                <input type="text" name="custom_icon" id="custom_icon" class="anc-6310-form-input">
                <input type="button" id="custom-icon-image" value="Upload Custom Icon" class="anc-6310-btn-default anc-6310-icon-upload">
              </td>
            </tr>
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="readmore">Button Text:</label></td>
              <td><input type="text" name="readmore_text" id="readmore" class="anc-6310-form-input lg" placeholder="Read More"></td>
            </tr>
            <tr>
              <td style="width: 150px;"><label class="anc-6310-form-label" for="readmoreurl">Button URL:</label></td>
              <td><input type="text" name="readmore_url" id="readmoreurl" class="anc-6310-form-input lg" placeholder="https://www.wpmart.org"></td>
            </tr>
            <tr class="anc-6310-form-image">
              <td style="width: 150px;"><label class="anc-6310-form-label" for="picture">Picture:</label></td>
              <td>
                <input type="text" name="image" id="image" class="anc-6310-form-input">
                <input type="button" id="btn-image" value="Upload Image" class="anc-6310-btn-default anc-6310-image-upload">
              </td>
            </tr>
          </table>

        </div>
        <div class="anc-6310-modal-form-footer">
          <button type="button" name="close" id="anc-6310-from-close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
          <input type="submit" name="save" class="anc-6310-btn-primary anc-6310-pull-right anc-6310-margin-right-10" value="Save" />
        </div>
        <br class="anc-6310-clear" />
      </form>
    </div>
    <br class="anc-6310-clear" />
  </div>
</div>

<!-- Icon Modal Start -->
<div id="anc_6310_social_icon" class="anc-6310-modal" style="display: none">
  <div class="anc-6310-modal-content anc-6310-modal-xl">
    <form action="" method="post">
      <?php wp_nonce_field("anc-6310-nonce-update-icon-order") ?>

      <input type="hidden" name="rearrange_list" id="rearrange_list" value="" />
      <div class="anc-6310-modal-header">
        <span style="float: left; margin-right: 15px;">Choose your Icon</span>
        <input type="text" id="icon-filter" class="anc-form-input" placeholder="Search Icon" />
        <span class="anc-6310-close">&times;</span>
      </div>
      <div class="anc-6310-modal-body-form">
        <ul class="anc-6310-choose-icon">
          <?php echo anc_6310_fa_icon_list('li', '</li>'); ?>
        </ul>
      </div>
      <div class="anc-6310-modal-form-footer">
        <button type="button" name="close" id="anc-6310-font-icon-close" class="anc-6310-btn-danger anc-6310-pull-right">Close</button>
      </div>
    </form>
    <br class="anc-6310-clear" />
  </div>
</div>

<script>
  jQuery(document).ready(function() {
    //Custom Icon
    jQuery('.custom-icon-new').hide();
    jQuery('body').on('change', '.icon_type_new', function(){
      let val = Number(jQuery(this).val());
      jQuery('.custom-icon-new, .font-awesome-icon-new').hide();
      val ? (jQuery('.custom-icon-new').show()) : (jQuery('.font-awesome-icon-new').show());
    });
    /* ######### Custom Icon Media Start ########### */
    jQuery("body").on("click", ".anc-6310-icon-upload", function(e) {
      e.preventDefault();
      var image = wp.media({
          title: 'Upload Image',
          multiple: false
        }).open()
        .on('select', function(e) {
          var uploaded_image = image.state().get('selection').first();
          var image_url = uploaded_image.toJSON().url;
          jQuery(`#custom_icon`).val(image_url);
        });

      jQuery("#wpm_6310_add_new_media").css({
        "overflow-x": "hidden",
        "overflow-y": "auto"
      });
    });

    jQuery("#profile_details, #effect-appearance").hide();
    jQuery("body").on("click", "#add-accordion", function() {
      jQuery("#anc-6310-modal-add").fadeIn(500);
      jQuery("body").css({
        "overflow": "hidden"
      });
      return false;
    });

    /* ######### Media Start ########### */
    jQuery("body").on("click", ".anc-6310-image-upload", function(e) {
      e.preventDefault();
      var image = wp.media({
          title: 'Upload Image',
          multiple: false
        }).open()
        .on('select', function(e) {
          var uploaded_image = image.state().get('selection').first();
          var image_url = uploaded_image.toJSON().url;
          jQuery(`#image`).val(image_url);
        });

      jQuery("#wpm_6310_add_new_media").css({
        "overflow-x": "hidden",
        "overflow-y": "auto"
      });
    });
    /* ######### Media End ########### */

    /* Modal Close Start */
    jQuery("body").on("click", ".anc-6310-close, #anc-6310-from-close", function() {
      jQuery("#anc-6310-modal-add, #anc-6310-modal-edit, #anc_6310_social_icon").fadeOut(500);
      jQuery("body").css({
        "overflow": "initial"
      });
    });
    jQuery("body").on("click", ".anc-6310-close-2", function() {
      jQuery("#anc_6310_social_icon").fadeOut(500);
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
    /* Modal Close End */



    //Icon Modal and Filter start Here
    jQuery("#icon-filter").on("keyup", function() {

      var value = jQuery(this).val().toLowerCase();
      jQuery(".anc-6310-choose-icon li").filter(function() {
        jQuery(this).toggle(jQuery(this).attr(`data-icon-name`).toLowerCase().indexOf(value) > -1);
      });
    });



    jQuery("body").on("click", "#anc-6310-font-icon-close, .anc-6310-icon-close", function() {
      jQuery("#anc_6310_social_icon").fadeOut(500);
    });

    jQuery(window).click(function(event) {
      if (event.target == document.getElementById('anc_6310_social_icon')) {
        jQuery("#anc_6310_social_icon").fadeOut(500);
      }
    });

    jQuery("body").on("click", ".anc-plus-icons i", function() {
      if (jQuery('#icon-filter').val()) {
        jQuery('#icon-filter').val('');
        jQuery(".anc-6310-choose-icon li").filter(function() {
          jQuery(this).toggle();
        });
      }
      jQuery("#anc_6310_social_icon").fadeIn(500);
      jQuery("body").css({
        "overflow": "hidden"
      });
      jQuery('#icon-filter').focus();
      return false;
    });

    jQuery("body").on("click", "ul.anc-6310-choose-icon li", function() {
      let cls = jQuery(this).find('i').attr('class');
      jQuery(`#icons`).val(cls);
      jQuery("#anc_6310_social_icon").fadeOut(500);
    });
    //Icon Modal and Filter end Here  
  });
</script>