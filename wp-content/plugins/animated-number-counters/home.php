<?php
if (!defined('ABSPATH'))
   exit;

if (!empty($_POST['delete']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
   $nonce = $_REQUEST['_wpnonce'];
   if (!wp_verify_nonce($nonce, 'tss_nonce_field_delete')) {
      die('You do not have sufficient permissions to access this page.');
   } else {
      $id = (int) $_POST['id'];
      $wpdb->query($wpdb->prepare("DELETE FROM {$style_table} WHERE id = %d", $id));
   }
}
if (!empty($_POST['duplicate']) && isset($_POST['id']) && is_numeric($_POST['id'])) {
   $nonce = $_REQUEST['_wpnonce'];
   if (!wp_verify_nonce($nonce, 'tss_nonce_field_duplicate')) {
     die('You do not have sufficient permissions to access this page.');
   } else {
     $id = (int) $_POST['id'];
     $selectedData = $wpdb->get_row($wpdb->prepare("SELECT * FROM $style_table WHERE id = %d ", $id), ARRAY_A);
     $dupList = array(
             $selectedData['name'] . '-copy', 
             $selectedData['style_name'], 
             $selectedData['css'],
             $selectedData['counterids']);
     $wpdb->query($wpdb->prepare("INSERT INTO {$style_table} (name, style_name, css, counterids) VALUES ( %s, %s, %s, %s )", $dupList));
   }
 }

?>

<h3> Animated Number Counter</h3>
<table class="anc-6310-table">
   <tr height="45" style="background-color: #f5f5f5">
      <td style="width: 130px">Counter Name</td>
      <td style="width: 140px">Counter</td>
      <td>Shortcode</td>
      <td style="width: 120px">Edit Delete</td>
   </tr>
   <?php
   $data = $wpdb->get_results('SELECT * FROM ' . $style_table . ' ORDER BY id DESC', ARRAY_A);
   foreach ($data as $value) {
      $id = $value['id'];
      $temp = substr($value['style_name'], -2);
      if ($temp <= 10) {
         $temp = "01-10";
      } else if ($temp <= 20) {
         $temp = "11-20";
      } else if ($temp <= 30) {
         $temp = "21-30";
      } else if ($temp <= 40) {
         $temp = "31-40";
      } else if ($temp <= 50) {
         $temp = "41-50";
      } else if ($temp <= 60) {
         $temp = "51-60";
      }
      $style_name = explode("-", $value['style_name']);

      echo '<tr class="anc-6310-row-select">';
      echo '<td>' . $value['name'] . '</td>';
      echo '<td>' . ucfirst($style_name[0]) . " " . (int) $style_name[1] . '</td>';
      echo '<td><span>Shortcode <input type="text" style="width: 250px;" onclick="this.setSelectionRange(0, this.value.length)" value="[anc_6310_number_counter id=&quot;' . $id . '&quot;]"></span>';
      echo '<td>
                                    <a href="' . admin_url("admin.php?page=anc-6310-counter-{$temp}&styleid=$id") . '"  title="Edit"  class="anc-6310-btn-success anc-6310-margin-right-10" style="float:left; margin-right: 5px; margin-left: 5px; height: 17px"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                    <form method="post">
                                    ' . wp_nonce_field("tss_nonce_field_duplicate") . '
                                          <input type="hidden" name="id" value="' . $id . '">
                                           <button class="anc-6310-btn-primary" style="float:left; margin-right:5px;"  title="Duplicate"  type="submit" value="duplicate" name="duplicate" onclick="return confirm(\'Do you want to duplicate it?\');"><i class="fas fa-clone" aria-hidden="true"></i></button>
                                   </form>
                                    <form method="post">
                                     ' . wp_nonce_field("tss_nonce_field_delete") . '
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button class="anc-6310-btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="delete" onclick="return confirm(\'Do you want to delete?\');"><i class="far fa-times-circle" aria-hidden="true"></i></button>
                                    </form>

                             </td>';
      echo ' </tr>';
   }
   ?>
</table>